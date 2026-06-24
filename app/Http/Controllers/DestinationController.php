<?php

namespace App\Http\Controllers;

use App\Models\TravelItem;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        // Logika untuk filter (search & category)
        $query = TravelItem::query()->where('is_active', 1);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $destinations = $query->latest()->get();

        return view('destination', compact('destinations'));
    }
}