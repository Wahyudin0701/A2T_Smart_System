<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //
    }


    //menu home
    public function home()
    {
        $total_members = Member::count();

        $widget = [
            'total_members' => $total_members,
        ];

        return view('admin.home', compact('widget'));
    }

    //menu profile
    public function profile()
    {
        return view('admin.profile');
    }

    public function profile_update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:12|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password'
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');

        if (!is_null($request->input('current_password'))) {
            if (Hash::check($request->input('current_password'), $user->password)) {
                $user->password = $request->input('new_password');
            } else {
                return redirect()->back()->withInput();
            }
        }

        $user->save();

        return redirect()->route('profile')->withSuccess('Profile updated successfully.');
    }


    // menu data members
    public function get_members()
    {
        $members = Member::all();
        return view('admin.data-members', compact('members'));
    }

    public function save_member(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'gender' => 'required|in:laki-laki,perempuan',
            'membership_start' => 'required|date',
            'membership_end' => 'required|date|after_or_equal:membership_start',
            'status' => 'required|in:active,inactive',
        ]);

        Member::create([
            'name' => $request->name,
            'age' => $request->age,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'membership_start' => $request->membership_start,
            'membership_end' => $request->membership_end,
            'status' => $request->status,
        ]);

        return redirect()->route('data-members')->with('success', 'Data member berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()->back()->with('success', 'Data member berhasil dihapus.');
    }
}
