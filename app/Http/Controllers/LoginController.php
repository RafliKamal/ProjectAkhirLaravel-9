<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $a)
    {
        $cek = $a->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if (Auth::attempt($cek)) {
            $a->session()->regenerate();
    
           
            
            if (Auth::user()->role == 'Mahasiswa') {
                return redirect()->intended('/lihatUjian');
            } else {
                return redirect()->intended('/dashboard');
            }
        }
    
        return back()->with('loginError', 'Maaf! Login Gagal');
    }
    
    public function logout(Request $a)
    {
       
        Auth::logout();
            $a->session()->invalidate();
            $a->session()->regenerateToken();
            return redirect('/login');
        
      
    }

}
