<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterByAdminController extends Controller
{
    public function registerByAdmin(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required  | string | max:255',
            'email' => 'required | email | unique:users',
            'password' => 'required | string | min:8 | confirmed',
        ]);

        $user = User::create($validateData);

        return back();
    }
}
