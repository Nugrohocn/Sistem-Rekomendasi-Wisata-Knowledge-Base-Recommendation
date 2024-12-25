<?php

namespace App\Http\Controllers;

use App\Models\Place;

use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index()
    {
        $placeCount = Place::count();
        $places = Place::with(['rating', 'category', 'location'])->paginate(3);
        return view('wisata.index', compact('placeCount', 'places'));
    }

    public function getPlaces(Request $request)
    {
        if ($request->ajax()) {
            $places = Place::with('location', 'rating')->paginate(3);

            // Debugging: Memastikan data tersedia
            dd($places); // Atau gunakan log()

            return response()->json([
                'data' => $places->items(), // Mengambil data tempat wisata
                'nextPage' => $places->nextPageUrl() // URL untuk halaman berikutnya
            ]);
        }

        $places = Place::with('location', 'rating')->paginate(3);
        dd($places); // Debugging

        return view('places.index', compact('places'));
    }
}
