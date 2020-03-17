<?php

namespace App\Http\Controllers;

use App\Benefit;
use App\Business;
use App\Candidates;
use App\Http\Requests\CreateOfferRequest;
use App\Http\Requests\OfferEditRequest;
use App\Offers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OfferController extends Controller
{
    public function index()
    {
        $id = session()->get('id');
        if (!$id) {
            return redirect()->route('home');
        }
        $offers = Offers::where('id_business', $id)
            ->whereDate('expirated_at', '>=', Carbon::now())
            ->with(['businessMeta', 'Benefits'])
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

        return view('offers.index')
            ->with('expired', $expired)
            ->with('business', $business)
            ->with('offers', $offers);
    }

    public function detail(Offers $offer)
    {
        $id = session()->get('id');

        if ($offer->id_business == $id) {
            $business = Business::whereId($id)->with('business_meta')->first();
            $benefits = Benefit::whereOfferId($offer->id)->get();
            return view('offers.detail')
                ->with('business', $business)
                ->with('benefits', $benefits)
                ->with('offer', $offer);
        } else {
            $offers = Offers::where('id_business', $id)->paginate(25);

            return redirect()->route('offer.admin', compact('offers'))->with('message', ['danger', 'No estas autorizado para administrar esta oferta']);
        }
    }

    public function create(CreateOfferRequest $request)
    {
        $last_id = \DB::table('aquabe_offers')->latest()->first();
        $business_id = session()->get('id');
        $slug = Str::slug($request->get('title') . '-' . $last_id->id);

        $expiration = Carbon::now()->addDays(30);

        $request->merge(['id_business' => $business_id]);
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

        return redirect()->route('offer.admin')->with('message', ['success', 'Publicación de nueva oferta exitosa']);
    }

    public function store(OfferEditRequest $request, Offers $offer)
    {
        $id = session()->get('id');

        if ($id == $offer->id_business) {
            $offer_id = $offer->id;
            if (is_array($request->benefits)) {
                $benefits = $request->benefits;
                $request->request->remove('benefits');
                Benefit::where('offer_id', $offer_id)->delete();
            }

            if ($request->title !== $offer->title) {
                $newSlug = Str::slug($request->title . '-' . $offer_id);
                $request->merge(['slug' => $newSlug]);
            }
            $offer->fill($request->input())->save();
            foreach ($benefits as $benefit) {
                Benefit::create([
                    'offer_id' => $offer_id,
                    'benefit' => $benefit
                ]);
            }

            return redirect()->route('offer.admin')->with('message', ['success', 'Datos actualizados']);
        } else {
            return redirect()->route('offer.admin')->with('message', ['danger', 'No estás autorizado para corregir estos datos']);
        }

    }

    public function show($slug, $search = null)
    {
        $id = session()->get('id');

        if (is_null($search)) {
            $query = Offers::whereDate('expirated_at', '>=', Carbon::now())
                ->where('featured', '!=', '1')
                ->orWhereNull('featured')
                ->with(['businessMeta', 'Benefits', 'candidates'])
                ->latest()->paginate(15);
        } else {
            $query = Offers::where(function($q) use ($search) {
                $q->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%');
            })
                ->whereDate('expirated_at', '>=', Carbon::now())
                ->with(['businessMeta', 'Benefits', 'candidates'])
                ->get();
        }
        $offer = Offers::whereSlug($slug)->with('candidates')->first();

        $offer_id = $offer->id;

        $featured = Offers::whereDate('expirated_at', '>=', Carbon::now())
            ->where('featured', '=', '1')
            ->with(['businessMeta', 'Benefits'])
            ->latest()->get();

        $candidate = Candidates::whereIdUser($id)->where('id_offer', '=', $offer_id)->first();
        $postuled = is_null($candidate) ? false : true;

        return view('offers.postulate')
            ->with([
                'search' => $search,
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

        $candidate = new Candidates;

        $candidate->id_user = $id;
        $candidate->id_offer = $offer->id;

        $candidate->save();

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
            Offers::whereSlug($slug)->update([
                'expirated_at' => $new_exp
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

    public function list()
    {
        $id = session()->get('id');

        $featured = Offers::whereDate('expirated_at', '>', Carbon::now())
            ->where('featured', '=', '1')
            ->with(['business', 'businessMeta', 'candidates'])
            ->orderBy('created_at')
            ->get();

        $offers = Offers::whereDate('expirated_at', '>', Carbon::now())
            ->where('featured', '!=', '1')
            ->orWhereNull('featured')
            ->orderBy('created_at', 'desc')
            ->with(['business', 'businessMeta', 'candidates'])
            ->paginate(15);
        $offer_id = $offers[0]->id;

        $candidate = Candidates::whereIdUser($id)->where('id_offer', '=', $offer_id)->first();
        $postuled = is_null($candidate) ? false : true;

        return view('offers.list')
            ->with([
                'offers' => $offers,
                'featured'=> $featured,
                'postuled' => $postuled
            ]);
    }

    public function candidates($slug)
    {
        $offer = Offers::whereSlug($slug)->with('candidates', 'candidates.user', 'candidates.user.userMeta')->first();

        return view('business.candidates', compact('offer'));
    }

    public function getRelatedSlugs($slug, $id = 0)
    {
        return Offers::where('slug', 'LIKE', "%{$slug}%")
            ->select('slug')
            ->get();
    }
}
