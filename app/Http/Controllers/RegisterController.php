<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('register');
    }

    /**
     * Handle the registration request.
     */
    public function register(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50|unique:accounts',
            'password' => 'required|string|min:8',
            'email' => 'required|string|email|max:100|unique:accounts',
            'role' => 'required|in:admin,coach,player,physio,doctor',
            'name' => 'nullable|string|max:100',
            'position' => 'nullable|string|max:100',
            'contact_info' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create a new account
        $account = new Account();
        $account->username = $request->username;
        $account->password = Hash::make($request->password); // Hash the password
        $account->email = $request->email;
        $account->role = $request->role;
        $account->name = $request->name;
        $account->position = $request->position;
        $account->contact_info = $request->contact_info;
        $account->save();

        // Redirect to a success page or login page
        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }
}
