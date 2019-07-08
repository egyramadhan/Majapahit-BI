<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libraries\JsonResponse;
use App\Libraries\TransactionService;
// use Cookie;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = $request->input('email');
        $password = $request->input('password');
        
        $transaction = TransactionService::methodlogin($user, $password);
        if ($transaction['error']) {
            return view('index');
        }
        \Session::put('full_name', $transaction['message']['full_name']);  # constant | User that's currently logged in
        \Session::save();
        $a = \Session::get('full_name');
        return redirect()->route('admin-dashboard', ['full_name' => $a]);
    }
}
