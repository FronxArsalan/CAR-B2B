<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendCredentialsMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    // List users
    public function list()
    {
        $users = User::all();
        return view('admin.users.list', compact('users'));
    }

    // Show create form
    public function create()
    {
        return view('admin.users.create');
    }

    // Store new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'user_name' => 'required|string|max:255|unique:users,user_name',
            'email' => 'required|email|unique:users,email',
            'phone_no' => 'nullable|string|numeric|',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,user,stock_manager',
        ]);

        $plainPassword = $request->password;

        $user = new User();
        $user->name = $request->name;
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->phone_no = $request->phone_no;
        $user->password = $plainPassword;
        $user->role = $request->role;
        $user->save();

         // Send the email with credentials
        Mail::to($user->email)->send(new SendCredentialsMail($user->email, $plainPassword));

        return redirect()->route('user.index')->with('success', 'User added successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Update existing user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'user_name' => 'required|string|max:255|unique:users,user_name,' . $id, // Avoids unique constraint for the same user
            'email' => 'required|email|unique:users,email,' . $id, // Avoids unique constraint for the same user
            'phone_no' => 'nullable|string|numeric|',
            'role' => 'required|in:admin,user,stock_manager', // NEW validation for role
        ]);


        $user->name = $request->name;
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->phone_no = $request->phone_no;
        $user->role = $request->role; // NEW line to update role
        $user->save();


        

       

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    // Delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
    public function status($id)
{
    $user = User::findOrFail($id);
    $user->status = $user->status == 1 ? 0 : 1;
    $user->save();

    $statusText = $user->status == 1 ? 'activated' : 'deactivated';
    return redirect()->route('user.index')->with('success', "User has been {$statusText} successfully.");
}

}
