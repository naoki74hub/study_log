<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Comment;
use App\User;
use Storage;
use Illuminate\Support\Facades\Auth;
use Abraham\TwitterOAuth\TwitterOAuth;

class PostController extends Controller
{
   
   //index
   public function index(Request $request, Comment $comment, Post $post,User $user)
   {
        $image = $post->image_url;
        $q = $request->query();
       if(isset($q['tag_name'])) {
            $posts = Post::latest()->where('body','like',"%{$q['tag_name']}%")->get();
            return view('posts.index', [
                'posts'=> $posts,
                'tag_name'=> $q['tag_name']
                ]);
                
       } else {
        $posts = Post::latest()->get();
       
        return view('posts/index',compact('posts','user','image'));
        }
    }
    
    //create
    public function create()
    {
        return view('posts/create');
    }
    
    //store
    public function store(PostRequest $request, Post $post)
    {
        $post->title = $request->input('title');
        $post->time = $request->input('time');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        //s3アップロード開始
        if(!empty($request->file('image_url'))) {
        $image = $request->file('image_url');
        // バケットの`image_url`フォルダへアップロード
        $path = Storage::disk('s3')->putFile('image', $image, 'public');
        // アップロードした画像のフルパスを取得
        $post->image_url = Storage::disk('s3')->url($path);
        }
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
        $post->tags()->attach($tag_ids);
        
        return redirect()->route('posts.index');
    }
    
    
    //edit
    public function edit(Post $post)
    {
        return view('posts/edit',['post'=>$post]);
    }
    
    
    //update
    public function update(PostRequest $request,Post $post)
    {
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
        
        $post->fill($request->all())->save();
        $post->tags()->attach($tag_ids);
        return redirect('posts/index');
    }
    
    //show
    public function show(Post $post)
    {
        return view('posts/show',['post'=>$post]);
        
    }
    
    //destroy
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('posts/index');
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
    
    
    //フォロー
    public function follow(Post $post)
    {
        $follower = auth()->user();
        //フォローしているか
        $is_following = $follower->isFollowing($post->user->id);
        if(!$is_following) {
            //フォローしていなければフォローする
            $follower->follow($post->user->id);
            return back();
        }
    }  
    
    
    public function unfollow(Post $post)
    {
        $follower = auth()->user();
        //フォローしているか
        $is_following = $follower->isFollowing($post->user->id);
        if($is_following) {
            //フォローしていればフォロー解除する
            $follower->unfollow($post->user->id);
            return back();
        }
    }
    
    //フォローしているユーザーの投稿を取得
    public function timeline(User $user) {
        $posts = Post::query()->whereIn('user_id', Auth::user()->follows()->pluck('followed_id'))->latest()->get();
        return view('posts.timeline')->with([
            'posts' => $posts,
            ]);
    }
    
}

        
    

