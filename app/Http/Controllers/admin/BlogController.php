<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Blog::latest()->paginate(10);
        return view('admin.blog.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        // return $request->all();
        // dd($request->all());
        try {
            $validatedData = $request->validate([
                'blog_title' => 'required',
                'blog_description' => 'required',
                'blog_author' => 'required',
                'blog_image' => 'required',
            ]);
          
    
            if ($request->hasFile('blog_image')) {
             
                $image = $request->file('blog_image');
                $imageName = 'blog'.'-' . time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('uploads/blogs');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $validatedData['blog_image'] = $imageName;
                $image->move($path, $imageName);
                
                 Blog::create($validatedData);
                return back()->with('success', 'Blog created successfully.');
            }
        } 
        catch (Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        
        return view('admin.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
