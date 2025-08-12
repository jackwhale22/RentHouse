<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kos;

class HomeController extends Controller
{
    public function index()
    {
        $featuredKos = Kos::verified()->available()->latest()->take(6)->get();
        $totalKos = Kos::verified()->count();
        $totalOwners = \App\Models\User::where('role', 'pemilik')->count();
        
        return view('welcome', compact('featuredKos', 'totalKos', 'totalOwners'));
    }

    public function publicSearch(Request $request)
    {
        $query = Kos::verified()->available()->with('pemilik');

        // Search by name or location
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_kos', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('harga', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('harga', '<=', $request->max_price);
        }

        // Filter by location
        if ($request->filled('lokasi')) {
            $query->where('lokasi', 'like', "%{$request->lokasi}%");
        }

        $kosList = $query->paginate(12);

        return view('public-search', compact('kosList'));
    }

    public function showKos($id)
    {
        $kos = Kos::verified()->available()->with('pemilik')->findOrFail($id);
        return view('public-kos-detail', compact('kos'));
    }
}
