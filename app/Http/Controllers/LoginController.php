<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class LoginController extends Controller
{
    public function index()
    {
        // if (!Auth::user()) {
            return view('login');
        // }
        // return redirect()->to('/dashboard');
    }

    

    public function login(Request $request)
    {
        $data = $request->validated();

        if (Auth::attempt($data)) {
            // $request->session()->regenerate();
            return Auth::user();
        }

        return response()->json([
            'errors' => [
                'message' => 'Username or password wrong !'
            ]
        ], 401);
    }

}
