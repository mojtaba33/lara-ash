<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blog()
    {
        $blogs = Blog::latest()->paginate(9);
        return view('default.blog.blog',compact('blogs'));
    }

    public function single(Blog $blog)
    {
        $next = Blog::where('id', '>', $blog->id)->first();
        $previous = Blog::where('id', '<', $blog->id)->first();

        $tags = explode(',',$blog->tags);

        $related = Blog::where('id','!=',$blog->id)
            ->where(function($query) use ($blog,$tags)
            {
                $query->Where('category_id',$blog->category_id)
                    ->orWhere(function($query) use ($blog,$tags){
                        foreach ($tags as $tag)
                        {
                            $query->orWhere('tags','like',"%$tag%");
                        }
                    });
            })->latest()->take(3)->get();

        $categories = Category::where('parent_id' , '!=' , 0)->get();

        $comments = $blog->comments()
            ->where('approved',1)
            ->where('parent_id',0)
            ->latest()
            ->paginate(20)->withQueryString();

        return view('default.blog.single',compact(
            'blog','categories','next','previous','related','comments'
        ));
    }

    public function category(Category $category)
    {
        $blogs = $category->blogs()->latest()->paginate(9);

        return view('default.blog.category',compact('blogs'));
    }

    public function tag($tag)
    {
        $blogs = Blog::where('tags','like',"%$tag%")->latest()->paginate(12);

        return view('default.blog.category',compact('blogs'));
    }
}
