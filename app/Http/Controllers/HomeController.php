<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        if ($request->isMethod('post')){
            $token = Str::random(80);
            $user = auth()->user();
            $user->token_api = hash('sha256', $token);
            $user->save();

            return  redirect('home')->with('token', $token);
        }

        return view('home');
    }


}
