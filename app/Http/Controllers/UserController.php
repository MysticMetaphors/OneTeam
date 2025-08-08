<?php

namespace App\Http\Controllers;

use App\Models\Activity_log;
use App\Models\User;
use App\Models\Tasks;
use App\Models\Project;
use App\Models\Team_members;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Request as req;
use Illuminate\Support\Str;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return Inertia::render('Team', [
            'users' => $users
        ]);
    }

    public function profile()
    {
        $act_logs = Activity_log::where('user_id', Auth::user()->id)->limit(5)->get();
        // dd($act_logs);
        // $tasks = Tasks::all();
        return Inertia::render('Profile', [
            // 'tasks' => $tasks,
            'log' => $act_logs,
            'user' => Auth::user()
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
            Activity_log::create([
                'user_id' => Auth::id(),
                'ip_address' => req::ip(),
                'user_agent' => req::userAgent(),
            ]);
            return response()->json([
                'success' =>  true,
                'id' => Auth::user()->id,
                'role' => Auth::user()->role,
            ]);
        }

        return back()->withErrors([
            'email' => '* Invalid email or password',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'))->with('success', 'Logged out successfully!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Form/UserCreate');
    }
    /**
     * Validate the incoming request data for creating or updating a user.
     */
    protected function validateRequest(Request $request) {}
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //return response()->json(['message' => $request->all()]);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
            'repeatPassword' => 'required|string|min:6',
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

        if ($validatedData['password'] != $validatedData['repeatPassword']) {
            return back()->with('password', 'The password and repeat password must match.');
        }

        $validatedData['password'] = bcrypt($validatedData['password']);
        unset($validatedData['repeatPassword']);

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
        return response()->json(['message' => 'User created succesfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $decryptedId = Crypt::decryptString($id);
            $team_members = Team_members::where('project_id', $decryptedId)->get();
            $proj_name = Project::where('id', $decryptedId)->value('name');
            $users = User::all();
            $team = [];

            foreach ($team_members as $member) {
                $user = $users->find($member->user_id);
                $users = $users->reject(fn($user) => $user->id === $member->user_id);
                $team[] = $user;
            }

            return Inertia::render('Team', [
                'users' => $team,
                'all_users' => $users,
                'project' => $proj_name,
            ]);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404);
        }
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
