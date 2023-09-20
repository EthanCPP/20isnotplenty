<?php

namespace App\Http\Controllers;

use App\Http\Resources\StoryCollection;
use App\Models\Story;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home', [
            'stories' => StoryCollection::collection(Story::where('approved', 1)->get()),
        ]);
    }
}
