<?php

namespace App\Http\Controllers;

use App\Models\Like;
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
        $story->author = $validated['name'] ?: 'Anonymous';
        $story->story = nl2br(strip_tags(htmlspecialchars($validated['story'])));
        $story->save();

        return redirect()->route('home')->with('success', 'Thank you! Your story has been added. It will appear when we have approved it.');
    }

    public function addLike(Story $story)
    {
        if (!$story->visitorLikesIt()) {
            $like = new Like;
            $like->ip = $_SERVER['REMOTE_ADDR'];
            $story->likes()->save($like);

            return response('done', 200);
        }

        return response('error', 200);
    }

    public function removeLike(Story $story)
    {
        if ($story->visitorLikesIt()) {
            $ip = $_SERVER['REMOTE_ADDR'];

            $like = Like::where([
                ['story_id', $story->id],
                ['ip', $ip]
            ])->first();

            if ($like) {
                $like->delete();

                return response('done', 200);
            }
        }

        return response('error', 200);
    }
}
