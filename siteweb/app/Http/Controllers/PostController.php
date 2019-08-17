<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate;

class PostController extends Controller
{
    // si le membre ne se connecte(authentifié) pas ne verra pas ce formulaire

    public function __construct()
    {
        $this->middleware('auth');
    }

    // formulaire de création des articles

    public function create()
   {
       return view('posts.create');
   }

   public function store()
   {
       $data = request()->validate
       (
           [
            'legende'=> ['required','string'],
            'image'=> ['required','image']
           ]
           );
           $imagePath = request('image')->store('uploads','public');
           auth()->user()->posts()->create([
               'legende' => $data ['legende'],
               'image' => $imagePath
           ]);
           return redirect()->route('profiles.show', ['user'=>auth()->user() ]);
   }
}
