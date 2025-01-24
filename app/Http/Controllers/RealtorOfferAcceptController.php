<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class RealtorOfferAcceptController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Offer $offer, Request $request)
    {
        $listing = $offer->listing;
        $this->authorize('update', $listing);

        //Accept selected offer
        $offer->update([
            'accepted_at' => now()
        ]);

        $offer->listing->sold_at = now();
        $offer->listing->save();

        //Reject all other offers
        $offer->listing->offers()->except($offer)->update(['rejected_at' => now()]);

        return redirect()->back()->with('success', "offer {$offer->id} accepted, all other rejected");

    }
}
