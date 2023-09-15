<?php
namespace App\Http\Controllers;

use Tests\TestCase;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{
    public function index()
    {
        
        $posts = Post::with('tags')->get();
        $posts = Post::paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        
        $tags = Tag::all();

        return view('posts.create', compact('tags'));
    }
    public function show($id)
    {
        
        $post = Post::find($id);

        
        if (!$post) {
            return redirect()->route('posts.index')->with('error', 'Post o podanym ID nie istnieje.');
        }
    
        return view('posts.show', compact('post'));
    }

    public function store(Request $request)
    {
        
        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

       
        $post->tags()->sync($request->input('tags'));

        return redirect()->route('posts.index')->with('success', 'Wpis został dodany.');
    }

    public function edit($id)
    {
        
        $post = Post::find($id);

        $tags = Tag::all();

        return view('posts.edit', compact('post', 'tags'));
    }

    public function update(Request $request, $id)
    {
        
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

       
        $post->tags()->sync($request->input('tags'));

        return redirect()->route('posts.index')->with('success', 'Wpis został zaktualizowany.');
    }

    public function destroy($id)
    {
        
        $post = Post::find($id);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Wpis został usunięty.');
    }
    public function testCreatePost()
    {
        $postData = [
            'title' => 'Tytuł testowego posta',
            'content' => 'Treść testowego posta',
        ];

        $response = $this->post('/api/posts', $postData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('posts', ['title' => 'Tytuł testowego posta']);
    }
    public function testShowPost()
    {
        $post = Post::factory()->create();

        $response = $this->get("/api/posts/{$post->id}");

        $response->assertStatus(200);
        $response->assertJson(['title' => $post->title]);
    }
    public function testUpdatePost()
    {
        $post = Post::factory()->create();
        $updatedPostData = [
            'title' => 'Nowy Tytuł',
            'content' => 'Nowa Treść',
        ];

        $response = $this->put("/api/posts/{$post->id}", $updatedPostData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('posts', ['title' => 'Nowy Tytuł']);
    }
    public function testDeletePost()
    {
        $post = Post::factory()->create();

        $response = $this->delete("/api/posts/{$post->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

























}