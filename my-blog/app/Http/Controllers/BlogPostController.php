<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //SELECT * FROM blog_posts;
        $blogs = BlogPost::all();
        return view('blog.index', ['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blogPost = BlogPost::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::User()->id
        ]);

        return redirect(route('blog.show', $blogPost->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPost $blogPost)
    {   //$blogPost =select * from blog_posts where id = $blogPost
        //return $blogPost;

      //  $blogPost = BlogPost::find($blogPost)   UNI

     // $blogPost = BlogPost::select()->where('id', 14)->get(); // MULTI

     /*$blogPost = BlogPost::select()
                ->join("users", "users.id", "user_id")
                ->where("blog_posts.id", 14)
                ->get();
    
                return $blogPost[0];*/

        return view('blog.show', ['blogPost' => $blogPost]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPost $blogPost)
    {
        return view('blog.edit', ['blogPost' => $blogPost]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        $blogPost->update([
            'title' => $request->title,
            'body'  => $request->body
        ]);

        return redirect(route('blog.show', $blogPost->id))->withSuccess('Article mis à jour avec success');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();
        return redirect(route('blog.index'));
    }

    public function query(){
        //select * from blog_posts;
        //JSON
        //$blog = BlogPost::all();
        

        //$blog = BlogPost::select('title')
        //        ->get();

        /*insert into blog_posts (title, body) values (?, ?);
        prepare
        execute
        RETURN select * from blog_posts where id = last_id
        $blog = BlogPost::create([
            'title' => 'Title 1',
            'body'  => 'Message 1'
        ]);
        */
        /*select * from blog_posts where id = ?
        prepare
        execute
        uni array
        */
       // $blog = BlogPost::find(3);

        /*
        update blog_posts set title = ?, body = ? where id = 3
         prepare
        execute
        uni array
         */
      /*  $blog->update([
            'title' => 'Title 1',
            'body'  => 'Message 1'
        ]);*/

        //UPDATE V2
        /*$blog->title = 'Title 1'; //fillAll(request)
        $blog->save();
        */
        
        /*delete from blog_posts where id = 3/?
        prepare
        execute
        T/F */
        //$blog->delete();

        /*$user = User::select()
                ->where('email', 'cremin.asa@example.com')
                ->get();
        return $user[0];
        */

        //$blog = BlogPost::where('user_id', '>', 8)->get();
        
        /*$blog = BlogPost::select('title', 'user_id')
                ->where('user_id', '>', 8)
                ->get();
        */

        /*$blog = BlogPost::select('title', 'user_id')
                ->where('id', 8)
                ->get();
        */

        /* AND
        SELECT * FROM blog_posts where user_id = ? AND title = ?
        
        $blog = BlogPost::select()
                ->where('user_id', 1)
                ->where('title', '=', 'Abc')
                ->get();
        */

        /* OR
        SELECT * FROM blog_posts where user_id = ? OR title = ?
        $blog = BlogPost::select()
                ->where('user_id', 2)
                ->orwhere('title', '=', 'Abc')
                ->get();        
        */

        /*ORDER BY 
        $blog = BlogPost::select()
                ->orderBy('title', 'desc')
                ->get();
        */

        /*LIMIT 
        $blog = BlogPost::select()
                ->orderBy('id', 'desc')
                ->limit(5)
                ->get();
        */
        /*JOIN 
            SELECT * FROM blog_posts
            INNER JOIN users ON blog_posts.user_id = users.id
        
        $blog = BlogPost::select()
                ->join("users", "users.id", "user_id")
                ->get();
        */
        /*OUTER JOIN 
            SELECT * FROM blog_posts RIGHT OUTER JOIN users ON blog_posts.user_id = users.id
        
        $blog = BlogPost::select()
                ->rightJoin("users", "users.id", "user_id")
                ->get();
        */

        /* Aggregation Function
         */
        //$blog = BlogPost::max('id');
        //$blog = BlogPost::count();

       /*$blog = BlogPost::select('title', 'user_id')
                ->where('user_id', '>', 8)
                ->count();*/

        /*GROUP BY 
        SELECT count(id), user_id
        FROM blog_posts
        GROUP BY user_id;
        */
        $blog = BlogPost::select('user_id',(DB::raw('count(*) as blog')))
        ->groupBy('user_id')
        ->get();

        return $blog;
    }

    public function page(){
        $blogs = BlogPost::select()
                ->paginate(5);
                return view('blog.page', ['blogs' => $blogs]);
    }

}
