<?php

namespace App\Http\Controllers;

use App\Business;
use App\BusinessMeta;
use App\Helpers\Helper;
use App\Http\Requests\BusinessLoginRequest;
use App\Http\Requests\BusinessProfileRequest;
use App\Http\Requests\BusinessRegisterRequest;
use App\Offers;
use App\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class BusinessController extends Controller
{
    public function index()
    {
        return view('business.index');
    }

    public function login(BusinessLoginRequest $request)
    {
        $business = Business::where('email_user', $request->email)
            ->with('business_meta', 'roles')
            ->withCount('offers')
            ->first();


        if ($business) {
            if (Hash::check($request->password, $business->password)) {

                if ($business->business_meta) {
                    if (!empty($business->roles)) {
                        $role_id = $business->roles->role;
                        switch ($business->roles->role) {
                            case '0' :
                                $role = 'administrador';
                                break;
                            case '10' :
                                $role = 'business';
                                break;
                            case '11' :
                                $role = 'business';
                                break;
                            case '12' :
                                $role = 'business';
                                break;
                            case '13' :
                                $role = 'business';
                                break;
                            case '14' :
                                $role = 'business';
                                break;
                            case '15' :
                                $role = 'business';
                                break;
                            case '90' :
                                $role = 'business';
                                break;
                            default :
                                $role = 'business';
                                break;
                        }
                    } else {
                        $role_id = '90';
                        $role = "business";
                    }

                    session([
                        'id' => $business->id,
                        'name' => $business->business_meta->business_name,
                        'role' => $role,
                        'role_id' => $role_id,
                    ]);

                    if ($business->migrated) {
                        return redirect(route('business.passform'));
                    }


                    if (!is_null($request->redirect)) {
                        return redirect()->route($request->redirect);
                    } else {
                        return redirect()->route('offer.admin');
                    }
                } else {
                    session([
                        'id' => $business->id,
                        'name' => $business->firstname . ' ' . $business->surname,
                        'role' => 'business'
                    ]);
                    return redirect()->route('business.profile')->with('message', ['secondary', 'Ingrese los datos de su empresa o negocio']);
                }
            } else {
                return back()->with('message', ['danger', 'Contraseña no coincide, inténtelo de nuevo']);
            }
        } else {
            return back()->with('message', ['warning', 'Email no está registrado como empresa']);
        }
    }

    public function profileIndex(Request $request)
    {
        $id = session()->get('id');
        $business = Business::where('id', $id)
            ->with(['business_meta', 'offers'])
            ->first();

        $candidates_number = 0;
        foreach ($business->offers as $offer) {
            $candidates_number += (int)$offer->candidates_count;
        }

        return view('business.profile')
            ->with([
                'candidates' => $candidates_number,
                'business' => $business]);
    }

    public function register(BusinessRegisterRequest $request)
    {
        $pass = Hash::make($request->passbusiness);
        $request->merge(['email_user' => $request->email_business]);
        $request->merge(['phone_user' => $request->phone_business]);
        $request->merge(['password' => $pass]);
        $rut = str_replace('.', '', $request->rut_user);

        if (substr($rut, -2, 1) !== '-') {
            $rut = substr($rut, 0, -1) . '-' . substr($rut, -1, 1);
        }

        $request->merge(['rut_user' => $rut]);

        $business = Business::create($request->input());
        BusinessMeta::create([
            "id_business" => $business->id
        ]);
        Role::create([
            "id_business" => $business->id,
            "role" => 90
        ]);

        session([
            'id' => $business->id,
            'name' => $business->firstname . ' ' . $business->surname,
            'role' => 'business'
        ]);

        return redirect()->route("business.edit")->with('message', ['success', 'Registro exitoso']);
    }

    public function updateProfile(BusinessProfileRequest $request)
    {
        $id = session()->get('id');

        if (!is_null($request->picture)) {
            $picture = Helper::uploadFile('picture', 'business');
            $request->merge(['path' => $picture->hashName()]);
            $request->merge(['picture' => $picture->getClientOriginalName()]);
        }

        $rutbusiness = preg_replace('/\s+/', '', $request->rut_business);
        $request->merge(['rut_business' => $rutbusiness]);
        BusinessMeta::updateOrCreate(['id_business' => $id], $request->input());
        Business::whereId($id)->update([
            'rut_user' => $request->rut_user,
            'firstname' => $request->firstname,
            'surname' => $request->surname,
            'email_user' => $request->email_user,
            'position' => $request->position,
            'phone_user' => $request->phone_user
        ]);

        return redirect()->route('business.profile')->with('message', ['success', 'Perfil editado correctamente']);
    }

    public function file($id)
    {
        $business = Business::whereId($id)->withCount('offers')->with('business_meta', 'offers')->first();

        return view('business.file', compact('business'));
    }

    public function edit()
    {
        $id = session()->get('id');
        $business = Business::where('id', $id)
            ->with(['business_meta', 'offers'])
            ->first();

        return view("business.edit")->with(["business" => $business]);
    }

    public function change_passw(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate);
        }
        $id = session()->get('id');
        $passw = Hash::make($request->password);

        Business::whereId($id)->update([
            'migrated' => false,
            'password' => $passw
        ]);
        session()->flush();

        return redirect(route('home'));
    }

    public function list()
    {
        $business = Business::where('id', '!=', session()->get('id'))
            ->select('id', 'rut_user', 'firstname', 'surname', 'email_user')
            ->with(['business_meta', 'roles'])
            ->paginate(25);

        return view('business.roles')->with(['business' => $business]);
    }

    public function ajax()
    {
        $role = DB::table('aquabe_business')->where('aquabe_business.id', '!=', session()->get('id'))
            ->leftJoin('aquabe_business_meta', 'aquabe_business.id', '=', 'aquabe_business_meta.id_business')
            ->leftJoin('aquabe_roles', 'aquabe_business.id', '=', 'aquabe_roles.id_business')
            ->select('aquabe_business.id', 'aquabe_business.rut_user', 'aquabe_business.firstname', 'aquabe_business.surname', 'aquabe_business_meta.business_name', 'aquabe_business.email_user', 'aquabe_roles.role')
            ->get();

        return DataTables::of($role)
            ->addColumn('action', function ($row) {
                $action = '<form class="form-group" action="' . route('role.edit', ["id" => $row->id]) . '" method="post">';
                $action .= '<input type="hidden" name="_token" value="' . csrf_token() .'" />';
                $action .= '<input type="hidden" name="_method" value="PUT" />';
                $action .= '<select class="d-inline-block form-control" name="role[]">';
                $action .= '<option  value="90"';
                $action .= ( $row->role== '90' || is_null($row->role) ) ? ' selected' : '';
                $action .= '>Gratis</option>';
                $action .= '<option  value="10"';
                $action .= ( $row->role== '10') ? ' selected' : '';
                $action .= '>Básico</option>';
                $action .= '<option value="11"';
                $action .= ( $row->role== '11' )  ? ' selected' : '';
                $action .= '>Premium</option>';
                $action .= '<option value="12"';
                $action .= ( $row->role== '12' )  ? ' selected' : '';
                $action .= '>Corporativo A1</option>';
                $action .= '<option value="13"';
                $action .= ( $row->role== '13' )  ? ' selected' : '';
                $action .= '>Corporativo A2</option>';
                $action .= '<option value="14"';
                $action .= ( $row->role== '14' )  ? ' selected' : '';
                $action .= '>Corporativo A3</option>';
                $action .= '<option value="15"';
                $action .= ( $row->role== '15' )  ? ' selected' : '';
                $action .= '>Corporativo A4</option>';
                $action .= '</select>';
                $action .= '<input type="submit" class="d-inline-block ml-2 btn btn-primary" value="Cambiar"/>';
                $action .= '</form>';

                return $action;
            })->rawColumns(['action'])
            ->make(true);
    }
}
