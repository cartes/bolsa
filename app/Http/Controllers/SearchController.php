<?php

namespace App\Http\Controllers;

use App\Offers;
use App\Search;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function result(Request $request) {
        $id = null!==session()->get('id') ? session()->get('id') : null;
        $search = $request->input('query');
        $quantity = Search::where('search_term', $search)->select('quantity')->get();
        $added = isset($quantity[0]) ? (int)$quantity[0]->quantity + 1 : 1;

        $offers = Offers::where('description', 'LIKE', "%{$search}%")
            ->orWhere('title', 'LIKE', "%{$search}%")
            ->paginate(25);

        Search::updateOrCreate(
            ['search_term' => $search, 'user_id' => $id],
            ['search_term' => $search, 'user_id' => $id, 'quantity' => $added]
        );

        return view('search.results')
            ->with([
                'offers' => $offers,
                'search' => $search,
                'featured' => null
            ]);
    }
}
