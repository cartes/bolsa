<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOfferRequest;
use App\Offers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OfferController extends Controller
{
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

        return back()->with('message', ['success', 'Publicación de nueva oferta exitosa']);
    }

    public function generateSlug($title, $id = 0)
    {
        $slug = Str::slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        $offersCount = Offers::count();

        if (!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }

        for ($i = 1; $i<= $offersCount; $i++) {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)){
                return $newSlug;
            }
        }

        throw new \Exception('No se puede crear un único slug');

    }

    public function getRelatedSlugs($slug, $id = 0)
    {
        return Offers::where('slug', 'LIKE', "%{$slug}%")
            ->select('slug')
            ->get();
    }
}
