<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;

class RealtorListingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    public function index(Request $request)
    {
//        dd(\Auth::user()->listings);

        $filters =
            [
                'deleted' => request()->boolean('deleted'),
                ...$request->only(['by', 'order'])
            ];

        return inertia('Realtor/Index', [
            'listings'=>\Auth::user()->listings()->filter($filters)->withCount('images')->withCount('offers')->paginate(5)->withQueryString(), 'filters'=>$filters
        ]);
    }

    public function show(Listing $listing)
    {
        $listing->load('offers', 'offers.bidder');

        return inertia('Realtor/Show', [
            'listing'=>$listing
        ]);
    }



    public function edit(Listing $listing)
    {

        return inertia('Realtor/Edit', [
            'listing'=> $listing
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        $listing->update(
            $request->validate([
                'beds' => 'required|integer|min:1|max:20',
                'baths' => 'required|integer|min:1|max:5',
                'area' => 'required|integer|min:15|max:1000',
                'price' => 'required',
                'city' => 'required',
                'code'=> 'required',
                'street_nr'=>'required|integer|min:1|max:1000',
                'street'=>'required',
            ])
        );

        return redirect()
            ->route('realtor.listing.index')
            ->with('success', 'Listing updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Realtor/Create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->user()->listings()->create($request->validate([
            'beds' => 'required|integer|min:1|max:20',
            'baths' => 'required|integer|min:1|max:5',
            'area' => 'required|integer|min:15|max:1000',
            'price' => 'required',
            'city' => 'required',
            'code'=> 'required',
            'street_nr'=>'required|integer|min:1|max:1000',
            'street'=>'required',
        ])
        );
//        Listing::create(
//            $request->validate([
//                'beds' => 'required|integer|min:1|max:20',
//                'baths' => 'required|integer|min:1|max:5',
//                'area' => 'required|integer|min:15|max:1000',
//                'price' => 'required',
//                'city' => 'required',
//                'code'=> 'required|integer|min:1|max:1000',
//                'street_nr'=>'required|integer|min:1|max:1000',
//                'street'=>'required',
//            ])
//        );

        return redirect()
            ->route('realtor.listing.index')
            ->with('success', 'Listing created successfully.');
    }

    public function destroy(Listing $listing)
    {

        $listing->deleteOrFail();
        return redirect()
            ->back()
            ->with('success', 'Listing was deleted!');
    }

    public function restore(Listing $listing)
    {
        $listing->restore();

        return redirect()
            ->back()
            ->with('success', 'Listing was restored!');
    }

}
