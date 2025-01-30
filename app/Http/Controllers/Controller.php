<?php

namespace App\Http\Controllers;

// use GuzzleHttp\Psr7\Request;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function dashboard(Request  $request)
    {
        try {
            return view('index');
        } catch (\Exception $e) {
            Log::error('View loading index error: ' . $e->getMessage());
            return redirect('login')->with('error', 'An error occurred. Please try again.');
        }
    }


    public function login(Request $request)
    {
        try {
            if (Auth::check()) {
                return redirect('dashboard');
            }

            if ($request->isMethod('post')) {
                $request->validate([
                    'email' => 'required|email',
                    'password' => 'required',
                    'remember' => 'nullable',
                ]);

                $credentials = ['email' => $request->email, 'password' => $request->password];

                if (Auth::guard('web')->attempt($credentials, $request->filled('remember'))) {
                    return redirect()->route('dashboard')->with('success', 'You have Successfully logged in!');
                } else {
                    return redirect()->back()->with('error', 'Invalid Email or Password...');
                }
            } else {
                return view('authentication.loginPage');
            }
        } catch (\Throwable $e) {
            Log::error('Login error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred during login. Please try again later.');
        }
    }



    // logout
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'You have logged out successfully.');
    }


    //Register new User
    public function registerNewUser(Request $request)
    {
        if ($request->isMethod('post')) {

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'role' => 'required',
                'password' => [
                    'required',
                    'confirmed',
                    'min:8',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                    'regex:/[\W_]/',
                ],
            ]);

            try {

                $this->authorize('User-create');

                $validated['password'] = Hash::make($validated['password']);

                $user = User::create($validated);
                $role = Role::find($request->role);
                $user->assignRole($role);

                return redirect()->back()->with('success', "$request->name has registered successfully.");
            } catch (\Exception $e) {
                Log::error('Registration error: ' . $e->getMessage());
                return redirect('login')->with('error', 'An error occurred. Please try again.');
            }
        } else {
            try {
                $this->authorize('User-create');

                $roles = Role::all();
                return view('authentication.registerUser', compact('roles'));
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred during register. Please try again later.');
            }
        }
    }


    //fetch all users
    public function userList(Request $request)
    {
        try {
            $users = User::with('roles')->where('id', '>', 1)->get();
            return view('authentication.userList', compact('users'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred during view users. Please try again later.');
        }
    }



    //reset password
    public function resetPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'password' => [
                    'required',
                    'confirmed',
                    'min:8',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                    'regex:/[\W_]/',
                ],
            ], [
                'password.required' => 'Password is required.',
                'password.confirmed' => 'Password confirmation does not match.',
                'password.min' => 'Password must be at least 8 characters.',
                'password.regex' => 'Password must include at least one uppercase letter, one lowercase letter, one number, and one special character.',
            ]);

            try {
                $user = User::find($request->userId);

                if ($user) {
                    $user->update([
                        'password' => Hash::make($request->password)
                    ]);

                    Auth::guard('web')->logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return redirect('/')->with('success', 'Your password has been updated successfully.');

                    // return redirect()->route('login')->with('success', 'Your password has been updated successfully.');
                } else {
                    return redirect()->back()->with('error', 'User not found.');
                }
            } catch (\Exception $e) {
                Log::error('Password reset error: ' . $e->getMessage());
                return redirect()->back()->with('error', 'An error occurred. Please try again.');
            }
        } else {
            try {
                $user = Auth::user();
                return view('authentication.resetPassword', compact('user'));
            } catch (\Exception $e) {
                Log::error('Password reset form error: ' . $e->getMessage());
                return redirect()->back()->with('error', 'An error occurred. Please try again.');
            }
        }
    }


    public function profile(Request $request)
    {
        if ($request->isMethod('post')) {
            try {
                $request->validate([
                    'name' => 'required',
                ]);
                Auth::user()->update(['name' => $request->input('name')]);
                return redirect()->back()->with('success', 'Your profile has been updated successfully.');
            } catch (\Exception $e) {
                Log::error('edit profile' . $e->getMessage());
                return redirect()->back()->with('error', 'An error occurred. Please try again.');
            }
        } else {
            try {
                $user = Auth::user();
                return view('profile', compact('user'));
            } catch (\Exception $e) {
                Log::error('Open Profile ' . $e->getMessage());
                return redirect()->back()->with('error', 'An error occurred. Please try again.');
            }
        }
    }
}
