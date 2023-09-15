<?php
namespace App\Http\Controllers;

use Tests\TestCase;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return response()->json($tags);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tags',
        ]);

        $tag = Tag::create([
            'name' => $request->input('name'),
        ]);

        return response()->json(['message' => 'Tag został dodany'], 200);

    }

    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        return response()->json($tag);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:tags,name,' . $id,
        ]);

        $tag = Tag::findOrFail($id);
        $tag->name = $request->input('name');
        $tag->save();

        return redirect()->route('posts.create'); ;   }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return response()->json(null, 204);
    }

    public function testCreateTag()
    {
        $tagData = [
            'name' => 'Nowy Tag',
        ];

        $response = $this->post('/api/tags', $tagData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tags', ['name' => 'Nowy Tag']);
    }
}