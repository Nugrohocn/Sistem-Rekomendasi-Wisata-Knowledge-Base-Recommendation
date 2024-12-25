<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RekomendasiController extends Controller
{

    public function index()
    {
        $places = Place::orderBy('harga_tiket', 'asc')->get();
        $categories = $this->getUniqueCategories();
        $locations = $this->getUniqueLocations();
        $ratings = $this->getUniqueRatings();

        return view('rekomendasi.index', compact('places', 'categories', 'locations', 'ratings'));
    }

    public function getUniqueCategories()
    {
        return Place::with('category')
            ->get()
            ->pluck('category')
            ->unique('id');
    }

    public function getUniqueLocations()
    {
        return Place::with('location')
            ->get()
            ->pluck('location')
            ->unique('id');
    }

    public function getUniqueRatings()
    {
        return Place::orderBy('rating_id', 'asc')
            ->get()
            ->pluck('rating')
            ->unique('id');
    }
}
