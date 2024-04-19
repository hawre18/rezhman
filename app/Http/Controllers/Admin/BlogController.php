<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (view::exists('index.v1.admin.blogs.add')){
            $blogs=Blog::all();
            return view('index.v1.admin.blogs.add',compact(['blogs']));
        }else{
            abort(Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $blog=new Blog();
            $blog->title=$request->input('title');
            $blog->body=$request->input('body');
            $blog->image_id=$request->input('image_id');
            $blog->admin_id=$request->input('admin_id');
            $blog->save();
            Session::flash('blog_success','با موفقیت ایجاد شد');
            return redirect('admin/blogs');
        }catch (\Exception $er){
            Session::flash('blog_error','خطا در ذخیره سازی');
            return redirect('admin/blogs/create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        try{
            $blog=Blog::findorfail($id);
            $blog->delete();
            Session::flash('blog_success','عملیات موفقیت آمیز بود');
            return redirect('admin/blogs');
        }catch (\Exception $er){
            Session::flash('blog_error','خطا در انجام عملیات');
            return redirect('admin/blogs');
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        //
    }
}
