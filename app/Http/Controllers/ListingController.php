<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ListingController extends Controller
{
//   public function __construct()
//   {
//       $this->authorizeResource(Listing::class, 'listing');
//   }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize(
            'viewAny',
            Listing::class
        );
        $filters = $request->only('priceFrom', 'priceTo', 'areaFrom', 'areaTo', 'beds', 'baths');
        $query =Listing::orderByDesc('created_at');

        //#2
//        $query = Listing::orderByDesc('created_at')
//            ->when(
//                $filters['priceFrom'] ?? false,
//                fn ($query, $value) => $query->where('price', '>=', $value)
//            )->when(
//                $filters['priceTo'] ?? false,
//                fn ($query, $value) => $query->where('price', '<=', $value)
//            )->when(
//                $filters['beds'] ?? false,
//                fn ($query, $value) => $query->where('beds', (int)$value < 6 ? '=' : '>=', $value)
//            )->when(
//                $filters['baths'] ?? false,
//                fn ($query, $value) => $query->where('baths', (int)$value < 6 ? '=' : '>=', $value)
//            )->when(
//                $filters['areaFrom'] ?? false,
//                fn ($query, $value) => $query->where('area', '>=', $value)
//            )->when(
//                $filters['areaTo'] ?? false,
//                fn ($query, $value) => $query->where('area', '<=', $value)
//            );

// #1
//        if($filters['priceFrom'] ?? false) {
//            $query->where('price', '>=', $filters['priceFrom']);
//        }

        //#3 scopeFilter
        return inertia('Listing/Index', [
            'filter' => $filters,
            'listings' => $query->filter($filters)->withoutSold()->paginate(10)->withQueryString(),
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        Gate::authorize(
            'view',
            $listing
        );
//        if(\Auth::user()->cannot('view', $listing)){
//            abort(403);
//        }
//        $this->authorize('view', $listing);

        $listing->load('images');

        //if there is no user we're not bothering db for querying
        $offer = !\Auth::user() ? null :
            $listing->offers()->byMe()->first();

        return inertia('Listing/Show', [
            'listing'=> $listing,
            'offerMade' => $offer,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */


}
