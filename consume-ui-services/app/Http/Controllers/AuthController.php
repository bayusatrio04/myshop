<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $response = Http::post('http://localhost:1234/api/register', $request->all());
        $result = $response->json();
        
        if ($response->successful()) {
            
            $name = $result['name'];
            $email = $result['email'];
            $message = $result['message'];
            
            
            return redirect()->route('login')->with('success', compact('name', 'email', 'message'));
        } else {
           
            return redirect()->route('register')->with('error', 'Pendaftaran gagal. Silakan coba lagi.');
        }
    }
    
    public function login(Request $request)
    {
        $response = Http::post('http://localhost:1234/api/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);
    
        if ($response->successful()) {
            $data = $response->json();
    
            if (isset($data['access_token'])) {
  
                $accessToken = $data['access_token'];
                $id = $data['id'];
                $name = $data['name'];
                $email = $data['email'];
                $password = $data['password'];
                session(['access_token' => $accessToken]);
                session(['id' => $id]);
                session(['name' => $name]);
                session(['email' => $email]);
                session(['password' => $password]);
    
                
                return redirect()->intended('/')->with('success', 'Berhasil Login');
            }
        }
    
      
        return redirect()->route('login')->with('error', 'Email atau password tidak valid.');
    }
    
    public function logout(Request $request)
    {
        $accessToken = session('access_token');
        
        if ($accessToken) {
     
            session()->forget('access_token');
            
          
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->post('http://localhost:1234/api/logout');
    
            if ($response->successful()) {
                return redirect()->route('login')->with('success', 'Logout berhasil');
            } else {
             
                return redirect()->route('login')->with('error', 'Logout berhasil. Tks');
            }
        }
    
   
        return redirect()->route('login');
    }

    public function authenticatedUser(Request $request)
    {
        $response = Http::get('http://localhost:1234/api/authenticated-user', [
            'Authorization' => $request->header('Authorization'),
        ]);

        return $response->json();
    }
}
