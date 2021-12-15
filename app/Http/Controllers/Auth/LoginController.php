<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite; 
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    /**
     * ログアウトしたときの画面遷移先
     */
    protected function loggedOut(\Illuminate\Http\Request $request)
    {
        return redirect('login');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // ゲストユーザー用のユーザーIDを定数として定義
    private const GUEST_USER_ID = 1;

    // ゲストログイン処理
     public function guestLogin()
    {
        // id=1 のゲストユーザー情報がDBに存在すれば、ゲストログインする
        if (Auth::loginUsingId(self::GUEST_USER_ID)) {
            return redirect()->route('posts.index');
        }

        return redirect()->route('posts.index');
    } 
    
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
     public function redirectToGoogle()
    {
        // Google へのリダイレクト
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        // Google 認証後の処理
        $gUser = Socialite::driver('google')->stateless()->user();
        // email が合致するユーザーを取得
        $user = User::where('email', $gUser->email)->first();
        // 見つからなければ新しくユーザーを作成
        if ($user == null) {
            $user = $this->createUserByGoogle($gUser);
        }
        // ログイン処理
        \Auth::login($user, true);
        return redirect()->route('posts.index');
    }

    public function createUserByGoogle($gUser)
    {
        $user = User::create([
            'name'     => $gUser->name,
            'email'    => $gUser->email,
            'password' => \Hash::make(uniqid()),
        ]);
        return $user;
    }
    
    public function redirectToTwitterProvider()
   {
       return Socialite::driver('twitter')->redirect();
   }
   
    public function handleTwitterProviderCallback(){

       try {
           $user = Socialite::with("twitter")->user();
       } 
       catch (\Exception $e) {
           return redirect('/login')->with('oauth_error', 'ログインに失敗しました');
           // エラーならログイン画面へ転送
       }
       
       $myinfo = User::firstOrCreate(['token' => $user->token ],
                 ['name' => $user->nickname,'email' => $user->getEmail()]);
                 Auth::login($myinfo);
                 return redirect()->to('posts/index'); // homeへ転送
    
    }
}
