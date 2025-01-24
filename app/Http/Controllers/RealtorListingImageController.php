<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RealtorListingImageController extends Controller
{
    public function create(Listing $listing)
    {
        $listing->load('images');
        return inertia('Realtor/ListingImages/Create', [
            'listing' => $listing
        ]);
    }

    public function store(Listing $listing, Request $request)
    {
        if ($request->hasFile('images')) {
            $request->validate([
                'images.*' => 'mimes:jpeg,jpg,png,webp:5000'
            ],['images.*.mimes' => 'Only jpeg, jpg, png are allowed']);

            $images = $request->file('images');
            foreach ($images as $image) {
                $path = $image->store('listing-images', 'public');

                $listing->images()->save(new ListingImage([
                    'filename' => $path,
                ]));
            }
        }

        return redirect()->back()->with('success', 'Images uploaded successfully.');

    }

    public function destroy(Listing $listing, ListingImage $image)
    {
        Storage::disk('public')->delete($image->filename);
        $image->delete();

        return redirect()->back()->with('success', 'Image was deleted!');
    }
}
