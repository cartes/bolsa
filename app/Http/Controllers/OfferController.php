<?php

namespace App\Http\Controllers;

use App\Candidates;
use App\Http\Requests\CreateOfferRequest;
use App\Http\Requests\OfferEditRequest;
use App\Offers;
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
        $offers = Offers::where('id_business', $id)->paginate(25);

        return view('offers.index', compact('offers'));
    }

    public function detail(Offers $offer)
    {
        $id = session()->get('id');

        if ($offer->id_business == $id) {
            return view('offers.detail', compact('offer'));
        } else {
            $offers = Offers::where('id_business', $id)->paginate(25);

            return redirect()->route('offer.admin', compact('offers'))->with('message', ['danger', 'No estas autorizado para administrar esta oferta']);
        }
    }

    public function create(CreateOfferRequest $request)
    {
        $offer = new Offers;
        $business_id = session()->get('id');

        $slug = $this->generateSlug($request->title);

        $offer->id_business = $business_id;
        $offer->title = $request->title;
        $offer->slug = $slug;
        $offer->description = $request->description;
        $offer->area = $request->area;
        $offer->sub_area = $request->subarea;
        $offer->country = $request->country;
        $offer->state = $request->state;
        $offer->city = $request->city;
        $offer->comune = $request->comune;
        $offer->address = $request->address;
        $offer->salary = $request->salary;

        $offer->save();

        return redirect()->route('offer.admin')->with('message', ['success', 'Publicación de nueva oferta exitosa']);
    }

    public function store(OfferEditRequest $request, Offers $offer)
    {
        $id = session()->get('id');

        if ($id == $offer->id_business) {
            if ($request->title !== $offer->title) {
                $newSlug = $this->generateSlug($request->title);

                $request->merge(['slug' => $newSlug]);
            }
            $offer->fill($request->input())->save();
            return redirect()->route('offer.admin')->with('message', ['success', 'Datos actualizados']);
        } else {
            return redirect()->route('offer.admin')->with('message', ['danger', 'No estás autorizado para corregir estos datos']);
        }

    }

    public function show($slug)
    {
        $offer = Offers::with(['business', 'businessMeta', 'candidates'])
            ->withCount('candidates')
            ->whereSlug($slug)
            ->first();

        $postulate = Candidates::where([
            'id_offer' => $offer->id,
            'id_user' => session()->get('id')
        ])->first();

        return view('offers.postulate', compact('offer', 'postulate'));
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

    public function generateSlug($title, $id = 0)
    {
        $slug = Str::slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        $offersCount = Offers::count();

        if (!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }

        for ($i = 1; $i <= $offersCount; $i++) {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new \Exception('No se puede crear un único slug');

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
