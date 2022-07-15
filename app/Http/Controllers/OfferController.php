<?php

namespace App\Http\Controllers;

use App\Benefit;
use App\Business;
use App\Candidates;
use App\Http\Requests\CreateOfferRequest;
use App\Http\Requests\OfferEditRequest;
use App\Offers;
use App\UserEducation;
use App\UserExperience;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;

class OfferController extends Controller
{
    public function index()
    {
        $id = session()->get('id');
        $role = session()->get('role');

        $count = $this->getCountFeatured($id);
        $ads = $this->ads(session()->get('role_id'));

        session()->put('ads', $ads - $count);


        $role_id = session()->get('role_id');

        $role_name = '';

        switch ($role_id) {
            case 10 :
                $role_name = 'Básico';
                break;
            case 11 :
                $role_name = 'Premium';
                break;
            case 12 :
                $role_name = 'Corporativo A1';
                break;
            case 13 :
                $role_name = 'Corporativo A2';
                break;
            case 14 :
                $role_name = 'Corporativo A3';
                break;
            case 15 :
                $role_name = 'Corporativo A4';
                break;
            case 90:
                $role_name = 'Gratis';
                break;
        }

        if (!$id) {
            return redirect()->route('home');
        }
        $offers = Offers::where('id_business', $id)
            ->select(['id', 'title', 'visit', 'featured', 'slug', 'created_at', 'expirated_at'])
            ->withCount('Candidates')
            ->whereDate('expirated_at', '>=', Carbon::now())
            ->with(['businessMeta', 'Benefits', 'candidates', 'User'])
            ->orderBy('created_at', 'desc')
            ->paginate(25);

        $expired = Offers::where('id_business', $id)
            ->whereDate('expirated_at', '<', Carbon::now())
            ->orderBy('created_at')
            ->paginate(25);

        $business = Business::where('id', '=', $id)
            ->with('business_meta')
            ->withcount('offers')
            ->first();

        $candidates = [];

        foreach ($offers->all() as $candidate) {
            $item = $candidate->User->all();
            if (count($item) > 0) {
                foreach ($item as $i) {
                    $candidates[] = $i;
                }
            }
        }
        $collection = Collection::make($candidates);

        $featured = $this->ads(session()->get('role_id'));

        return view('offers.index')
            ->with([
                'expired' => $expired,
                'business' => $business,
                'offers' => $offers,
                'candidates' => $collection->groupBy('id'),
                'role' => $role_name,
                'featured' => $featured,
            ]);
    }

    public function detail(Offers $offer)
    {
        $id = session()->get('id');

        if ($offer->id_business == $id) {
            $business = Business::whereId($id)->with('business_meta')->first();
            $benefits = Benefit::whereOfferId($offer->id)->get();

            //dd($offer);

            return view('offers.detail')
                ->with('business', $business)
                ->with('benefits', $benefits)
                ->with('offer', $offer);
        } else {
            $offers = Offers::where('id_business', $id)->paginate(25);

            return redirect()->route('offer.admin', compact('offers'))->with('message', ['danger', 'No estas autorizado para administrar esta oferta']);
        }
    }

    public function create(Request $request)
    {
       $request->validate([
            'title' => 'required',
            'position' => 'required',
            'salary_opt' => 'required',
            'description' => 'required',
            'area' => 'required',
            'experience' => 'required'
        ], [
            'salary_opt.required' => 'Debe ingresar una opcion de renta',
            'salary.integer' => "Renta ofrecida no puede contener puntos ni comas",
            'salary.numeric' => 'Renta ofrecida debe ser un valor numérico',
            'salary.min' => 'Renta ofrecida debe tener un valor de al menos 1',
            'position.required' => 'La Jornada es un campo obligatorio',
            'description.required' => 'La descripción es un campo obligatorio',
        ]);

        //if ($validate->fails()) {
        //    return redirect()->back()->withErrors($validate)->withInput();
        //}

        $opt = $request->input('salary_opt');

        if ($opt == '0') {
            $salary = 0;
        } else if ($opt == '1') {
            $salary = $request->input('salary');
        } else {
            $salary = $request->input('salaryMin') . ' - ' . $request->input('salaryMax');
        };

        $request->merge(['salary_array' => $opt]);
        $request->request->remove('salary');
        $request->merge(['salary' => $salary]);
        $last_id = \DB::table('aquabe_offers')->latest()->first();
        $business_id = session()->get('id');
        $slug = Str::slug($request->get('title') . '-' . $last_id->id);

        $expiration = Carbon::now()->addDays(30);

        $request->merge(['id_business' => $business_id]);
        $request->merge(["sub_area" => "NULL"]);
        $request->merge(['slug' => $slug]);
        $request->merge(['expirated_at' => $expiration]);

        $benefits = null;
        if (is_array($request->benefits)) {
            $benefits = $request->benefits;
            $request->request->remove('benefits');
        }
        $offer = Offers::create($request->input());
        $offer_id = $offer->id;

        if (!is_null($benefits)) {
            foreach ($benefits as $benefit) {
                Benefit::create([
                    'offer_id' => $offer_id,
                    'benefit' => $benefit
                ]);
            }
        }

        return redirect()->route('offer.show', $offer->slug)->with('message', ['success', 'Publicación de nueva oferta exitosa']);
    }

    public function store(OfferEditRequest $request, Offers $offer)
    {
        $money = str_replace('.', '', $request->salary);
        $salary = intval($money);

        $request->merge(['salary' => $salary]);
        $id = session()->get('id');

        if ($id == $offer->id_business) {
            $offer_id = $offer->id;


            if (is_array($request->benefits)) {
                $benefits = $request->benefits;
                $request->request->remove('benefits');
                Benefit::where('offer_id', $offer_id)->delete();

                foreach ($benefits as $benefit) {
                    Benefit::create([
                        'offer_id' => $offer_id,
                        'benefit' => $benefit
                    ]);
                }

            }

            //dd($request->input());
//            if ($request->title !== $offer->title) {
//                $newSlug = Str::slug($request->title . '-' . $offer_id);
//                $request->merge(['slug' => $newSlug]);
//            }

            $offer->fill($request->input())->save();

            if (!is_null($request->benefit)) {
                Benefit::create([
                    'offer_id' => $offer_id,
                    'benefit' => $request->benefit
                ]);
            }

            return back()->with('message', ['success', 'Datos actualizados']);
        } else {
            return redirect()->route('offer.admin')->with('message', ['danger', 'No estás autorizado para corregir estos datos']);
        }

    }

    public function show(Request $request)
    {
        $slug = $request->route('slug');
        $search = $request->route('search');
        $featured = request()->featured;

        //dd($featured);

        $id = session()->get('id');

        $academics = UserEducation::whereIdUser($id)->count();

        if (is_null($search)) {
            if ($featured) {
                $query = Offers::whereDate('expirated_at', '>=', Carbon::now())
                    ->where('featured', '=', '1')
                    ->with(['businessMeta', 'business', 'Benefits', 'candidates'])
                    ->latest()->paginate(15);
            } else {
                $query = Offers::whereDate('expirated_at', '>=', Carbon::now())
                    ->with(['businessMeta', 'business', 'Benefits', 'candidates'])
                    ->latest()->paginate(15);
            }
        } else {
            if ($featured) {
                $query = Offers::where('title', 'LIKE', "%{$search}%")
                    ->where('featured', '=', '1')
                    ->whereDate('expirated_at', '>=', Carbon::now())
                    ->with(['businessMeta', 'business', 'Benefits', 'candidates'])
                    ->latest()
                    ->paginate(15);

            } else {
                $query = Offers::where('title', 'LIKE', "%{$search}%")
                    ->whereDate('expirated_at', '>=', Carbon::now())
                    ->with(['businessMeta', 'business', 'Benefits', 'candidates'])
                    ->latest()
                    ->paginate(15);
            }
        }

        $offer = Offers::whereSlug($slug)->with('candidates')->first();

        if(is_object($offer)) {
            if ( $offer->id_business != $id ) {
                Offers::whereSlug($slug)->update([
                    'visit' => $offer->visit + 1
                ]);
            }
            $offer_id = $offer->id;
        } else {
            $offer_id = null;
        }


//        $allFeatured = Offers::whereDate('expirated_at', '>', Carbon::now())
//            ->where('featured', '=', '1')
//            ->with(['business', 'businessMeta', 'candidates'])
//            ->orderBy('created_at', 'DESC')
//            ->get();
//
//        $featured = $allFeatured->filter(function ($model) {
//            return $model->featured_end_date >= Carbon::now();
//        });

        $candidate = Candidates::whereIdUser($id)->where('id_offer', '=', $offer_id)->first();

        $postuled = is_null($candidate) ? false : true;

        return view('offers.postulate')
            ->with([
                'search' => $search,
                'academics' => $academics,
                'offer' => $offer,
                'slug' => $slug,
                'offers' => $query,
                'postuled' => $postuled,
                'featured' => $featured
            ]);
    }

    public function postulate(Offers $offer)
    {
        $id = session()->get('id');

        if (!is_null($id)) {

            $candidate = new Candidates;

            $candidate->id_user = $id;
            $candidate->id_offer = $offer->id;

            $candidate->save();
        }
        return back()->with('message', ['success', 'Has postulado a esta oferta de trabajo']);
    }

    public function destroy(Offers $offer)
    {
        try {
            $offer->delete();

            return back()->with('message', ['success', 'Oferta eliminada correctamente']);
        } catch (\Exception $exc) {
            return back()->with('message', ['danger', 'Error: $exc->getmessage()']);
        }
    }

    public function republish($slug)
    {
        $id = session()->get('id');

        if ($id) {
            $new_exp = Carbon::now()->addDays(30);
            $new_creation = Carbon::now();
            Offers::whereSlug($slug)->update([
                'expirated_at' => $new_exp,
                'created_at' => $new_creation
            ]);
        }

        return redirect()->route('offer.admin');
    }

    public function ajax($slug)
    {
        $offer = Offers::whereSlug($slug)
            ->with(['businessMeta', 'Benefits'])
            ->first();

        return response()->json($offer);
    }

    private function getCountFeatured($id)
    {
        $featured = Offers::whereDate('expirated_at', '>', Carbon::now())
            ->where('featured', '=', '1')
            ->where('id_business', '=', $id)
            ->get();

        return count($featured);
    }

    public function featured(Request $request)
    {
        $id = session()->get('id');
        $action = filter_var($request->get('feature'), FILTER_VALIDATE_BOOLEAN);
        $adId = $request->get('id');

        $ads = $this->ads(session()->get('role_id'));
        $count = $this->getCountFeatured($id);

        if (!$action) {
            $count--;
        }

        $offer = Offers::select('created_at')->where('id', '=', $adId)->first();

        $expiration = Carbon::parse($offer->created_at)->addDays(45);


        if (intval($ads) == 0 || $count >= intval($ads)) {
            Offers::where('id_business', '=', $id)
                ->where('featured', '=', true)
                ->update(['featured' => false]);

            $message = 'Excedió o no tiene acceso a avisos destacados';

            session()->put('ads', $ads);
            session()->put('message', ['danger', $message]);

            return \Response::json([
                'code' => 401,
                'message' => $message,
            ], 400);
        } else {
            Offers::where('id_business', '=', $id)
                ->where('id', '=', $adId)
                ->update([
                    'featured' => $action,
                    'expirated_at' => $expiration,
                ]);
            $message = ($action) ? "La oferta de trabajo $adId se ha destacado" : "La oferta de trabajo $adId se ha dejado normal";

            $count = $this->getCountFeatured($id);

            session()->put('ads', $ads - $count);
            session()->put('message', ['success', $message]);

            return \Response::json([
                'code' => 200,
                'message' => $message,
            ], 200);
        }
    }

    public function list()
    {
        $id = session()->get('id');

        $allFeatured = Offers::whereDate('expirated_at', '>', Carbon::now())
            ->where('featured', '=', '1')
            ->with(['business', 'businessMeta', 'candidates'])
            ->orderBy('created_at', 'DESC')
            ->get();

        $featured = $allFeatured->filter(function ($model) {
            return $model->featured_end_date >= Carbon::now();
        });

        $offers = Offers::whereDate('expirated_at', '>', Carbon::now())
//            ->where('featured', '!=', '1')
//            ->orWhereNull('featured')
            ->orderBy('created_at', 'desc')
            ->with(['business', 'businessMeta', 'candidates'])
            ->paginate(15);

        if (count($featured) > 0) {
            $offer_id = $featured->first()->id;

            $merged = $featured->merge($offers)->sortBy('created_at');

            $candidate = Candidates::whereIdUser($id)->where('id_offer', '=', $offer_id)->first();
        } else {
            $candidate = null;
        }
        $postuled = is_null($candidate) ? false : true;

        return view('offers.list')
            ->with([
                'offers' => $offers,
                'featured' => null,
                'postuled' => $postuled
            ]);
    }

    public function list_featured() {
        $offers = Offers::whereDate('expirated_at', '>', Carbon::now())
            ->where('featured', '=', '1')
            ->with(['business', 'businessMeta', 'candidates'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('offers.list')
            ->with([
                'offers' => $offers,
                'featured' => true,
                'postuled' => false
            ]);
    }

    public function candidates($slug)
    {
        $offer = Offers::whereSlug($slug)
            ->first();


        $take = $this->records(session()->get('role_id'));


        $candidates = Candidates::where("id_offer", "=", $offer->id)
            ->take($take)
            ->with('user', 'user.userMeta')
            ->get();

        return view('business.candidates')->with([
            'offer' => $offer,
            'candidates' => $candidates
        ]);
    }

    public function getRelatedSlugs($slug, $id = 0)
    {
        return Offers::where('slug', 'LIKE', "%{$slug}%")
            ->select('slug')
            ->get();
    }

    public function remakeSlug()
    {
        $offers = Offers::all();
        $i = 1;
        foreach ($offers as $offer) {
            Offers::whereId($offer->id)->update([
                'slug' => Str::slug($offer->title)
            ]);
            $i++;
        }

        echo $i;
    }

    private function ads($role)
    {
        switch ($role) {
            case '90':
                $take = 0;
                break;
            case '10':
                $take = 2;
                break;
            case '11':
                $take = 3;
                break;
            case '12':
                $take = 10;
                break;
            case '13':
                $take = 12;
                break;
            case '14':
                $take = 15;
                break;
            case '15':
                $take = 30;
                break;
            default:
                $take = 0;
                break;
        }

        return $take;

    }

    private function records($role)
    {
        switch ($role) {
            case '90':
                $take = 3;
                break;
            case '10':
                $take = 15;
                break;
            case '11':
                $take = 30;
                break;
            case '12':
                $take = -1;
                break;
            case '13':
                $take = -1;
                break;
            case '14':
                $take = -1;
                break;
            case '15':
                $take = -1;
                break;
            default:
                $take = 3;
                break;
        }

        return $take;
    }
}
