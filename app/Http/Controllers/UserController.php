<?php

namespace App\Http\Controllers;

use App\Candidates;
use App\Http\Requests\PersonalDataRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Offers;
use App\Search;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Validator;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(Request $request)
    {
        $usr = $request->email;
        $user = User::where('email', $usr)->first();
        $offers = Offers::withCount('candidates')
            ->with('business')
            ->with('businessMeta')
            ->latest()
            ->paginate(10);

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                session([
                    'id' => $user->id,
                    'role' => 'user',
                    'name' => $user->name . ' ' . $user->surname
                ]);
                return back();
            } else {
                return redirect(route('home'))->with('message', ['danger', 'Combinación email y clave no corresponden']);
            }
        } else {
            return back()->with('message', ['danger', 'Usuario no existe']);
        }
    }

    public function logout(Request $request)
    {
        session()->flush();

        return redirect()->route('home');
    }

    /**
     * @param UserRegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRegisterRequest $request)
    {

        $pass = Hash::make($request->passwordUser);

        $request->merge(['password' => $pass]);
        $request->merge(['rut_user' => $request->rut_candidate]);

        User::create($request->input());

        return back()->with('message', ['success', 'Registro exitoso']);
    }

    public function alerts()
    {
        $id = session()->get("id");

        $searches = Search::whereUserId($id)->select('search_term')->get();

        if ($searches->count() > 0) {
            $alerts = Offers::where(function ($q) use ($searches) {
                foreach ($searches as $search) {
                    $q->orWhere('title', 'like', '%' . $search->search_term . '%');
                }
            })
                ->with(['business', 'businessMeta'])
                ->whereDate('expirated_at', '>=', Carbon::now())
                ->get();
        } else {
            $alerts = Offers::where('title', 'LIKE', '%trabajo%')
                ->whereDate('expirated_at', '>=', Carbon::now())->get();
        }

        $postulated = Candidates::whereIdUser($id)
            ->select([
                'aquabe_offers_candidates.id',
                'aquabe_offers_candidates.status',
                'aquabe_offers.title',
                'aquabe_business_meta.business_name',
                'aquabe_offers.created_at',
                'aquabe_offers_candidates.status'])
            ->leftJoin('aquabe_offers', 'aquabe_offers_candidates.id_offer', '=', 'aquabe_offers.id')
            ->leftJoin('aquabe_business_meta', 'aquabe_offers.id_business', '=', 'aquabe_business_meta.id_business')
            ->whereDate('aquabe_offers.expirated_at', '>=', Carbon::now())
            ->get();

        $user = User::whereId($id)
            ->with(['userMeta', 'userExperience', 'userSkills', 'userEducation', 'userReferences'])
            ->first();

        return view("user.alerts")->with([
            'alerts' => $alerts,
            'user' => $user,
            'postulated' => $postulated
        ]);
    }

    public function showoffers()
    {
        $id = session()->get('id');
        $user = User::where('id', $id)->select(['name', 'rut_user'])->first();

        $candidates = Candidates::whereIdUser($id)
            ->select([
                'aquabe_offers_candidates.id',
                'aquabe_offers_candidates.status',
                'aquabe_offers.slug',
                'aquabe_offers.title',
                'aquabe_business_meta.fantasy_name',
                'aquabe_business_meta.comune',
                'aquabe_business_meta.id_business',
                'aquabe_offers.created_at',
                'aquabe_offers_candidates.status'])
            ->leftJoin('aquabe_offers', 'aquabe_offers_candidates.id_offer', '=', 'aquabe_offers.id')
            ->leftJoin('aquabe_business_meta', 'aquabe_offers.id_business', '=', 'aquabe_business_meta.id_business')
            ->whereDate('aquabe_offers.expirated_at', '>=', Carbon::now())
            ->get();

//        dd($candidates);

        return view('user.offers', compact('candidates', 'user'));
    }

    public function file(User $id, $offer = null)
    {
        if (!is_null($offer)) {
            Candidates::where('id_user', '=', $id->id)
                ->where('id_offer', '=', $offer)
                ->update(['status' => Candidates::REVIEWED]);
        }
        $user = $id->with('userMeta', 'userExperience', 'userLanguage', 'userSkills', 'userEducation')->first();

        return view('user.file', compact('user'));
    }
}
