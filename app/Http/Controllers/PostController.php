<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        // dd(
        //     Storage::disk('public')->setVisibility('uploads/2022/Jun/3625488651655288745.png', 'private'),
        //     Storage::disk('public')->getVisibility('uploads/2022/Jun/3625488651655288745.png')
        // );
        $post = Post::orderBy('id', 'DESC')->get();
        // dd(Storage::disk('private')->exists($post[0]->image) ? Storage::disk('private')->get($post[0]->image) : 'no');
        return view('post', compact('post'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required',
            'description' => 'required'
        ]);
        $data = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        // $fileName = rand() . time() . '.' . $request->image->extension();
        // $path = "uploads/" . Carbon::now()->format('Y') . "/" . Carbon::now()->format('M') . '/';
        // $filePath = $path . $fileName;

        // $data['image'] = $filePath;
        
        DB::beginTransaction();
        $post = Post::create($data);
        
        // $request->image->storeAs($path, $fileName, 'public');
        $post->addMedia($request->image)->toMediaCollection('media', 's3');
        DB::commit();


        $post = Post::orderBy('id', 'DESC')->get();
        foreach($post as $post) {
            dd($post->getMedia());
        }
        return view('post', compact('post'));
        // return url('storage/' . $this->path);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
