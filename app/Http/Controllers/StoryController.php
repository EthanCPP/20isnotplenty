<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StoryController extends Controller
{
    public function show()
    {
        return Inertia::render('Story/New');
    }

    public function create()
    {
        $validated = request()->validate([
            'name' => 'max:50',
            'story' => 'required|min:20|max:3000',
        ]);

        $story = new Story;
        $story->author = $validated['name'];
        $story->story = strip_tags(htmlspecialchars($validated['story']));
        $story->save();

        return redirect()->route('home')->with('success', 'Thank you! Your story has been added. It will appear when we have approved it.');
    }
}
