<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Default admin credentials (in production, use database)
    private const ADMIN_USERNAME = 'admin';
    private const ADMIN_PASSWORD = 'admin123'; // Change this in production!

    /**
     * Show login form
     */
    public function showLogin()
    {
        // Redirect if already authenticated
        if (session()->has('admin_authenticated')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($request->username === self::ADMIN_USERNAME && 
            $request->password === self::ADMIN_PASSWORD) {
            
            session(['admin_authenticated' => true, 'admin_username' => self::ADMIN_USERNAME]);
            
            return redirect()->route('admin.dashboard')->with('success', 'Welcome back, Admin!');
        }

        return back()->withErrors(['credentials' => 'Invalid username or password.'])->withInput();
    }

    /**
     * Handle logout
     */
    public function logout()
    {
        session()->forget(['admin_authenticated', 'admin_username']);
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }

    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
