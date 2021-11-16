<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\PostRequest;

use App\Models\Post;

use App\Models\Tag;

use App\Models\Comment;

class PostController extends Controller
{
   
   //index
   public function index(Request $request, Comment $comment, Post $post)
    {
        
        $q = $request->query();
        
        if(isset($q['tag_name'])) {
            $posts = Post::latest()->where('body','like',"%{$q['tag_name']}%")->get();
            return view('posts.index', [
                'posts'=> $posts,
                'tag_name'=> $q['tag_name']
                ]);
                
       } else {
        $posts = Post::latest()->get();
        return view('posts.index',compact('posts'));
        }
        
        return view('posts.index', $param);
        
    }
    
    //create
    public function create()
    {
        return view('posts.create');
    }
    
    //store
    public function store(PostRequest $request, Post $post)
    {
        $post->title = $request->input('title');
        $post->time = $request->input('time');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
         
        $filePath = $request->file('image_url')->store('images');
        $post->image_url = basename($filePath);
        //bodyからtagを抽出
        preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u',$request->body,$match);
        
        $tags = [];
        foreach($match[1] as $tag) {
            $found = Tag::firstOrCreate(['tag_name' => $tag]);
            
            array_push($tags,$found);
        }
        
        $tag_ids = [];
        foreach($tags as $tag) {
            array_push($tag_ids,$tag['id']);
        }
        
        $post->save();
        return redirect('posts/index');
    }
    
    
    //edit
    public function edit(Post $post)
    {
        return view('posts/edit',['post'=>$post]);
    }
    
    
    //update
    public function update(PostRequest $request,Post $post)
    {
        $post->fill($request->all())->save();
        return redirect('posts/index');
    }
    
    
    //destroy
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('posts/index');
    }
    
    //show
    public function show(Post $post)
    {
        return view('posts.show',['post'=>$post]);
    }
    
    
    //search
    public function search(Request $request)
    {
        $posts = Post::where('title','like',"%{$request->search}%")
               ->orWhere('body','like',"%{$request->search}%")
               ->latest()
               ->get();
        
        $search_result = '「'.$request->search.'」'.'の検索結果'.count($posts).'件';
        
        return view('posts.index',[
            'posts'=>$posts,
            'search_result'=>$search_result
            ]);
    }
    
    
    //time
    public function time()
    {
        return view('time');
    }
    
    //like
    public function like(Request $request)
{
    $user_id = Auth::user()->id; //1.ログインユーザーのid取得
    $post_id = $request->post_id; //2.投稿idの取得
    $already_liked = Like::where('user_id', $user_id)->where('post_id', $post_id)->first(); //3.

    if (!$already_liked) { //もしこのユーザーがこの投稿にまだいいねしてなかったら
        $like = new Like; //4.Likeクラスのインスタンスを作成
        $like->post_id = $post_id; //Likeインスタンスにreview_id,user_idをセット
        $like->user_id = $user_id;
        $like->save();
    } else { //もしこのユーザーがこの投稿に既にいいねしてたらdelete
        Like::where('post_id', $post_id)->where('user_id', $user_id)->delete();
    }
    //5.この投稿の最新の総いいね数を取得
    $post_likes_count = Post::withCount('likes')->findOrFail($post_id)->likes_count;
    $param = [
        'post_likes_count' => $post_likes_count,
    ];
    return response()->json($param); //6.JSONデータをjQueryに返す
}
}

        
    

