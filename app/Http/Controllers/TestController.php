<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;

class TestController extends Controller
{
    public function create()
    {
        return view('createTest');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' =>'required',
            'details' => 'required',
        ]);

        Test::create([
            'title'=> $request->input('title'),
            'details' => $request->input('details')
        ]);
        return redirect('/')->with('message', 'Your post has been added!');
    }
}
