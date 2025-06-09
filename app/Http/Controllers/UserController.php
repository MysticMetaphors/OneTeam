<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tasks;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Create a placeholder user with sample data
        // $users = collect([
        //     [
        //     'id' => 1,
        //     'name' => 'John Doe',
        //     'email' => 'johndoe@example.com',
        //     'role' => 'member',
        //     'department' => 'Engineering',
        //     'position' => 'Developer',
        //     'birthdate' => '1990-01-01',
        //     'location' => 'New York',
        //     'contact' => '12345678901',
        //     'password' => '',
        //     'email_verified_at' => now(),
        //     'remember_token' => null,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        //     ],
        //     [
        //     'id' => 2,
        //     'name' => 'Jane Smith',
        //     'email' => 'janesmith@example.com',
        //     'role' => 'admin',
        //     'department' => 'HR',
        //     'position' => 'Manager',
        //     'birthdate' => '1985-05-15',
        //     'location' => 'Los Angeles',
        //     'contact' => '23456789012',
        //     'password' => '',
        //     'email_verified_at' => now(),
        //     'remember_token' => null,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        //     ],
        //     [
        //     'id' => 3,
        //     'name' => 'Alice Johnson',
        //     'email' => 'alicej@example.com',
        //     'role' => 'member',
        //     'department' => 'Marketing',
        //     'position' => 'Coordinator',
        //     'birthdate' => '1992-03-10',
        //     'location' => 'Chicago',
        //     'contact' => '34567890123',
        //     'password' => '',
        //     'email_verified_at' => now(),
        //     'remember_token' => null,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        //     ],
        //     [
        //     'id' => 4,
        //     'name' => 'Bob Lee',
        //     'email' => 'boblee@example.com',
        //     'role' => 'member',
        //     'department' => 'Sales',
        //     'position' => 'Salesperson',
        //     'birthdate' => '1988-07-22',
        //     'location' => 'Houston',
        //     'contact' => '45678901234',
        //     'password' => '',
        //     'email_verified_at' => now(),
        //     'remember_token' => null,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        //     ],
        //     [
        //     'id' => 5,
        //     'name' => 'Charlie Kim',
        //     'email' => 'charliekim@example.com',
        //     'role' => 'member',
        //     'department' => 'Engineering',
        //     'position' => 'QA Engineer',
        //     'birthdate' => '1995-11-30',
        //     'location' => 'Seattle',
        //     'contact' => '56789012345',
        //     'password' => '',
        //     'email_verified_at' => now(),
        //     'remember_token' => null,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        //     ],
        //     [
        //     'id' => 6,
        //     'name' => 'Diana Prince',
        //     'email' => 'dianap@example.com',
        //     'role' => 'member',
        //     'department' => 'Support',
        //     'position' => 'Support Specialist',
        //     'birthdate' => '1993-09-18',
        //     'location' => 'Miami',
        //     'contact' => '67890123456',
        //     'password' => '',
        //     'email_verified_at' => now(),
        //     'remember_token' => null,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        //     ],
        //     [
        //     'id' => 7,
        //     'name' => 'Ethan Hunt',
        //     'email' => 'ethanh@example.com',
        //     'role' => 'member',
        //     'department' => 'Operations',
        //     'position' => 'Operator',
        //     'birthdate' => '1987-12-05',
        //     'location' => 'Boston',
        //     'contact' => '78901234567',
        //     'password' => '',
        //     'email_verified_at' => now(),
        //     'remember_token' => null,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        //     ],
        //     [
        //     'id' => 8,
        //     'name' => 'Fiona Gallagher',
        //     'email' => 'fionag@example.com',
        //     'role' => 'member',
        //     'department' => 'Finance',
        //     'position' => 'Accountant',
        //     'birthdate' => '1991-04-25',
        //     'location' => 'San Francisco',
        //     'contact' => '89012345678',
        //     'password' => '',
        //     'email_verified_at' => now(),
        //     'remember_token' => null,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        //     ],
        //     [
        //     'id' => 9,
        //     'name' => 'George Martin',
        //     'email' => 'georgem@example.com',
        //     'role' => 'member',
        //     'department' => 'Engineering',
        //     'position' => 'DevOps',
        //     'birthdate' => '1989-08-14',
        //     'location' => 'Denver',
        //     'contact' => '90123456789',
        //     'password' => '',
        //     'email_verified_at' => now(),
        //     'remember_token' => null,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        //     ],
        //     [
        //     'id' => 10,
        //     'name' => 'Hannah Lee',
        //     'email' => 'hannahlee@example.com',
        //     'role' => 'member',
        //     'department' => 'Design',
        //     'position' => 'Designer',
        //     'birthdate' => '1994-06-12',
        //     'location' => 'Austin',
        //     'contact' => '01234567890',
        //     'password' => '',
        //     'email_verified_at' => now(),
        //     'remember_token' => null,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        //     ],
        // ])->map(function ($user) {
        //     return (object) $user;
        // });

        $users = User::all();

        return view('pages.Team', ['users' => $users]);
    }

        public function profile()
    {

        $tasks = Tasks::all();
        return view('pages.Profile', [
            // 'users' => $users
            'tasks' => $tasks
        ]);
    }


    public function login(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        // dd($validateData);

        if (Auth::attempt(['email' => $validateData['email'], 'password' => $validateData['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('Dashboard')->with('success', 'Logged in successfully!');
        }

        return back()->withErrors([
            'email' => '* Invalid email or password',
        ])->onlyInput('email');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Form.Team.create');
    }
    /**
     * Validate the incoming request data for creating or updating a user.
     */
    protected function validateRequest(Request $request)
    {

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
            'repeat-password' => 'required|string|min:6',
            'role' => 'required|string|in:admin,member', // Assuming roles are 'admin' or 'member'
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'department' => 'nullable|string',
            'position' => 'required|string',
            'birthdate' => 'required|date',
            'location' => 'required|string',
            'contact' => 'required|string|max:20',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('profile', $imageName);
        } else {
            $imageName = 'default_images.png';
        }

        if ($validatedData['password'] != $validatedData['repeat-password']) {
            return back()->with('password', 'The password and repeat password must match.');
        }

        $validatedData['password'] = bcrypt($validatedData['password']);
        unset($validatedData['repeat-password']);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'role' => $validatedData['role'],
            'image' => $imageName,
            // 'department' => $validatedData['department'] ?? null,
            'position' => $validatedData['position'],
            'birthdate' => $validatedData['birthdate'],
            'location' => $validatedData['location'],
            'contact' => $validatedData['contact'],
        ]);
        return redirect()->route('user.create')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $User)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $User)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $User)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $User)
    {
        //
    }
}
