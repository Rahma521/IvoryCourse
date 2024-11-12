<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FAQs;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function uploadFromEditor (Request $request)
    {
        return response()->json([

            'url'=> 'https://i.pinimg.com/236x/de/f1/9d/def19de19ac7fc4bbb11b7bc35b89d32--beautiful-sunset-beautiful-places.jpg'
        ]);
    }
}
