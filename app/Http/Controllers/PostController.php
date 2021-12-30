<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\User;
use Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(Request $request, Comment $comment, Post $post, User $user)
    {
        $image = $post->image_url;
        $q = $request->query();
        if (isset($q['tag_name'])) {
            $posts = Post::latest()->where('body', 'like', "%{$q['tag_name']}%")->get();
            
            return view('posts.index', [
                'posts'=> $posts,
                'tag_name'=> $q['tag_name']
                ]);
                
       } else {
        $posts = Post::latest()->get();
        
        return view('posts/index', compact('posts', 'user', 'image'));
        }
    }
    
    public function create()
    {
        return view('posts/create');
    }
    
    public function store(PostRequest $request, Post $post, User $user)
    {
        $post->title = $request->input('title');
        $post->time = $request->input('time');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        
        //s3アップロード開始
        if (!empty($request->file('image_url'))) {
            $image = $request->file('image_url');
            // バケットの`image_url`フォルダへアップロード
            $path = Storage::disk('s3')->putFile('image', $image, 'public');
            // アップロードした画像のフルパスを取得
            $post->image_url = Storage::disk('s3')->url($path);
        }
        
        $post->save();
        
        $user = Auth::user();
        $post_times = $user->posts;
        $level = $user->level;
        $total_hour = 0;
        $total_minutes = 0;
        foreach ($post_times as $post_time) {
            //timeカラムの値から、「時間」の部分のみ取得し、$total_hourに足していく    
            $total_hour += substr($post_time->time,0,2);
            //timeカラムの値から、「分」の部分のみ取得し、$total_hourに足していく
            $total_minutes += substr($post_time->time,3,2);
            //$total_minutesが「60」以上であれば、「時間」に+1する
            if ($total_minutes >= 60) {
                $total_minutes = $total_minutes - 60;  
                $total_hour ++;
            }
        }
        
        //レベルを算出
        $level = floor($total_hour / 10 );
        $flg = 'false';
        //レベルが上がれば、＄flgにtrueを代入
        if ($level > $user->level) {
            $flg = 'true';
        }
    
        $user->total_hour = $total_hour;
        $user->level = $level;
        $user->save();
        
        //bodyからtagを抽出
        preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u', $request->body, $match);
        $tags = [];
        foreach ($match[1] as $tag) {
            //特定のキー（tag_name）でモデルを探し、一致したらモデルを返す。一致しなかったら新規のモデル作成。
            $found = Tag::firstOrCreate(['tag_name' => $tag]);
            //配列$tagsに、$foundを1つずつ格納する
            array_push($tags, $found);
        }
        
        //タグのidだけを抽出する配列を作成
        $tag_ids = [];
        foreach ($tags as $tag) {
            //配列$tag_idsに、$tagのidを1つずつ格納する
            array_push($tag_ids, $tag['id']);
        }
        
        //中間テーブルpost_tagに保存
        $post->tags()->attach($tag_ids);
        
        return redirect()->route('posts.index')->with('status', $flg);
    }
    
    public function edit(Post $post)
    {
        return view('posts/edit', compact('post'));
    }
    
    public function update(PostRequest $request, Post $post)
    {
        //bodyからtagを抽出
        preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u', $request->body, $match);
        $tags = [];
        foreach ($match[1] as $tag) {
            $found = Tag::firstOrCreate(['tag_name' => $tag]);
            
            array_push($tags, $found);
        }
        
        $tag_ids = [];
        foreach ($tags as $tag) {
            array_push($tag_ids, $tag['id']);
        }
        
        $post->fill($request->all())->save();
        $post->tags()->attach($tag_ids);
        
        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('posts/show', compact('post'));
    }
    
    public function destroy(Post $post)
    {
        $post->delete();
        
        return redirect()->route('posts.index');
    }
    
    public function search(Request $request)
    {
        //あいまい検索　titleとbodyから抽出
        $posts = Post::where('title', 'like', "%{$request->search}%")
            ->orWhere('body', 'like', "%{$request->search}%")
            ->latest()
            ->get();
           
        $search_result = '「'.$request->search.'」'.'の検索結果'.count($posts).'件';
        
        return view('posts.index', compact('posts', 'search_result'));
    }
    
    public function follow(Post $post)
    {
        $follower = auth()->user();
        //フォローしているか
        $is_following = $follower->isFollowing($post->user->id);
        if (!$is_following) {
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
        if ($is_following) {
            //フォローしていればフォロー解除する
            $follower->unfollow($post->user->id);
            
            return back();
        }
    }
    
    /**
     * フォローしているユーザーの投稿を取得し、表示する
     */
    public function timeline(User $user) {
        $posts = Post::query()->whereIn('user_id', Auth::user()->follows()->pluck('followed_id'))->latest()->get();
        return view('posts.timeline', compact('posts'));
    }
    
    /**
     *いいねしたユーザー一覧を取得し、表示 
     */
     public function getLikesUsers(Post $post)
    {
        return view('posts/likes_users', compact('post'));
    }
}

        
    

