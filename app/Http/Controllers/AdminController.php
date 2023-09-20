<?php

namespace App\Http\Controllers;

use App\Http\Resources\StoryCollection;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function showLogin()
    {
        return Inertia::render('Admin/Login');
    }

    public function doLogin()
    {
        $credentials = request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();

            return redirect()->intended('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid email/password combination.',
        ]);
    }

    public function dashboard()
    {
        return Inertia::render('Admin/Dashboard', [
            'stories' => StoryCollection::collection(Story::where([['approved', 0], ['deleted', 0]])->get()),
        ]);
    }

    public function approve(Story $story)
    {
        $story->approved = true;
        $story->save();

        return redirect()->route('admin.dashboard')->with('success', 'Story has been approved.');
    }

    public function reject(Story $story)
    {
        $story->deleted = true;
        $story->save();

        return redirect()->route('admin.dashboard')->with('success', 'Story has been rejected.');
    }
}
