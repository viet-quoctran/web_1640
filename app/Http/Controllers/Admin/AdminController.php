<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Middleware\IsAdmin;
use App\Models\Contribution;
use App\Models\Image;
use App\Models\Word;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\SendPasswordEmail;
use Illuminate\Support\Str;
use App\Models\Role;
class AdminController extends Controller
{
    public function dashboard(){
        $users = User::all();
        $roles = Role::all();
        $contributions = Contribution::with(['words', 'images', 'user'])->get();

        return view('admin.dashboard.index', compact('contributions','users','roles'));
    }
    public function storeUser(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->back()->withErrors('You must be logged in to perform this action.');
        }

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|exists:roles,id',
        ]);

        $password = Str::random(10);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($password),
            'role_id' => $validated['role_id'],
        ]);

        if ($user) {
            try {
                Mail::to($validated['email'])->send(new SendPasswordEmail(Auth::user()->email, $password));

                return redirect()->route('your.route.here')->with('success', 'User has been successfully added, and the password has been emailed.');
            } catch (\Exception $e) {
                // Handle if there's an error sending the email
                return redirect()->back()->withErrors('The user was created, but the email failed to send.');
            }
        } else {
            // Handle if the user couldn't be created
            return redirect()->back()->withErrors('Unable to create new user.');
        }
    }
    public function updateUser(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->back()->withErrors('You must be logged in to perform this action.');
        }

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->withErrors('User not found.');
        }

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role_id' => $validated['role_id'],
        ]);

        return redirect()->route('dashboard')->with('success', 'User has been successfully updated.');
    }
    public function deleteUser($id)
    {
        if (!Auth::check()) {
            return redirect()->back()->withErrors('You must be logged in to perform this action.');
        }

        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->withErrors('User not found.');
        }

        $user->delete();

        return redirect()->route('dashboard')->with('success', 'User has been successfully deleted.');
    }


}
