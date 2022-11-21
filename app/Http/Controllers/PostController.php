<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Post;

class PostController extends Controller
{
    public function show(Post $post) {
        return view('blog-post',['post' => $post]);
    }

    public function create() {
        $this->authorize('create',Post::class);
        return view('admin.posts.create');
    }

    public function store(){
        
        $inputs = request()->validate([
            'title' => 'required',
            'post_image' => 'file',
            'body' => 'required'
        ]);

        if(request('post_image')) {
            $inputs['post_image'] = request('post_image')->store('images');
        }

        auth()->user()->posts()->create($inputs);
        Session::flash('post-create-message', 'Post was created successfully'); 
        return redirect()->route('posts.index');
    }

    public function index() {
        //$posts = Post::all();
        $posts = auth()->user()->posts;
        return view('admin.posts.index',['posts'=>$posts]);
    }

    public function destroy(Post $post) {
        $this->authorize('delete', $post)
;        $post->delete();
        Session::flash('message', 'Post was deleted'); 
        return back();
    }

    public function Edit(Post $post) {
        $this->authorize('view',$post);

      return view('admin.posts.edit',['post' =>$post]);
    }

    public function update(Post $post) {
        $inputs = request()->validate([
            'title' => 'required',
            'post_image' => 'file',
            'body' => 'required'
        ]);

        if(request('post_image')) {
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }
        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        $this->authorize('update', $post);
        /* it will change the user */
        //auth()->user()->posts()->save($post);

        /* will save with existing user */
        $post->save();

        Session::flash('post-update-message', 'Post was updated successfully'); 
        return redirect()->route('posts.index');
    }
 }
