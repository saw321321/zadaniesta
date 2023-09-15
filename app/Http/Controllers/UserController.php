<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function searchUser(Request $request)
{
    
    $searchTerm = $request->input('searchTerm'); 

    
    $users = User::where('name', 'LIKE', "%$searchTerm%")
                ->orWhere('email', 'LIKE', "%$searchTerm%")
                ->paginate(10); 

    
    return view('admin.users.index', compact('users'));
}
public function destroy(User $user)
{
    
    $user->delete();
 
    return redirect()->route('users.index');
}
public function getUserById($userId)
{
    
    $user = User::find($userId);

    
    if (!$user) {
        return response()->json(['error' => 'Użytkownik nie znaleziony'], 404);
    }

   
    return response()->json($user);
}
public function update(Request $request, $id)
{
    
    $user = User::findOrFail($id);

    
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'role' => 'required|in:user,admin',
    ]);

    
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->role = $request->input('role');
    $user->save();

   
    return redirect()->route('users.index')->with('success', 'Użytkownik został zaktualizowany.');
}

    public function create()
    {
        return view('admin\users.create',);
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin\users.edit', ['id' => $id]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8',
            'role' => 'required|in:user,admin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            
        ]);

        return redirect()->route('users.index')->with('success', 'Użytkownik został zaktualizowany.');
    }
    public function show($id)
    {
        try {
            
            $user = User::findOrFail($id);
    
            
            return view('users.show', compact('user'));
        } catch (\Exception $e) {
            
            return redirect()->route('users.index')->with('error', 'Nie znaleziono użytkownika o podanym ID.');
        }
    }
    public function testCreateUser()
    {
        $userData = [
            'name' => 'Testowy Użytkownik',
            'email' => 'test@example.com',
            'password' => 'password123',
        ];

        $response = $this->post('/api/users', $userData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

    public function testUpdateUser()
    {
        $user = User::factory()->create();
        $updatedUserData = [
            'name' => 'Nowa Nazwa',
            'email' => 'nowy_email@example.com',
        ];

        $response = $this->put("/api/users/{$user->id}", $updatedUserData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', ['email' => 'nowy_email@example.com']);
    }
    public function testDeleteUser()
    {
        $user = User::factory()->create();

        $response = $this->delete("/api/users/{$user->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }



}
