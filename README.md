# STUDY MANAGEMENT

勉強内容や勉強時間を記録できるという意味で、 **「STUDY MANAGEMENT」** という名前にしました。
略して **「スタマネ」** です。

**勉強時間を記録でき、継続にもつながるSNSアプリです。**

**URL:** https://whispering-dusk-09126.herokuapp.com

# アプリの概要

こちらのアプリのコンセプトは以下の2点です。

1. 勉強仲間を作り、コツコツ継続できる。
2. 勉強が楽しくなる。

Twitterのような、いいねやフォロー、コメントなどの機能に加えて、以下のような機能があります。

* 勉強したもののタイトル、内容や感想、勉強時間を投稿できる。
* 投稿した勉強時間は、総学習時間に記録され、今までに勉強した時間がわかる。
* 10時間勉強するごとにレベルが1上がる。ゲーム感覚で楽しめる。
* 活動日数、継続日数がわかる。
* ポモドーロタイマーがあり、効率よく勉強することができる。
* ToDoリストでタスク管理ができる。
* 試験日などの大切な日までのカウントダウンができる。
* 達成したい目標を記録し、同じ目標をもつ人と繋がれる。

# 開発した背景

コロナウイルスが流行し、緊急事態宣言が発令され、家にいる時間が長くなった時に、「家でできることはないか」
、「この時間を無駄にしたくない」と思ったのがキッカケで、勉強にのめりこむようになりました。
私は、勉強した内容や勉強時間を「lifebear」というカレンダーアプリに記録していました。
自分が何をどれだけ勉強したかを記録として残すことができ、すごく達成感と充実感を味わえました。

私も、勉強のモチベーションアップにつながるアプリを作ってみたいと考えたことが背景にあります。

# 使用画面のイメージ
   
   ![1064CD41-7BA1-4D86-A0CE-7E923031CDEF](https://user-images.githubusercontent.com/90256385/147174255-3fbd9dfa-3292-488a-afd8-01b056131e58.jpeg)

   
   ![5A2513F3-16DC-4DA6-B4F8-2DAB8231CC87](https://user-images.githubusercontent.com/90256385/147175020-037b1bc3-51a1-478e-8623-ae35ac32f42f.jpeg)
 
   
   ![728FDDAB-DE4E-46C9-B881-0958D1273B90](https://user-images.githubusercontent.com/90256385/147175401-727a0427-4bcf-41fd-b411-b3bff26ef32b.jpeg)
   
   
   ![90867828-A2CF-4452-B95F-BE484F675811](https://user-images.githubusercontent.com/90256385/147175872-f499bbcd-9c13-4a5b-ab57-e7b60fbbae57.jpeg)

  
  **ユーザー詳細画面↓**
  
  ![75DC836A-96A8-4D59-9822-0FC68BB5567F](https://user-images.githubusercontent.com/90256385/146680914-eee64845-8c31-4802-8b8e-f35ad6b4a70d.jpeg)
  
  
  **プロフィール編集画面↓**
  
  ![6D90EBF0-3DAD-47F7-876D-3A9AE2CF679F](https://user-images.githubusercontent.com/90256385/146680977-4377bc19-8267-44ba-a48c-ff56b1bf7ab3.jpeg)
  
  
  **時間、タスク管理画面↓**
  
  ![E40B9E6D-544E-4508-8810-29ABE9055038](https://user-images.githubusercontent.com/90256385/146681062-6ca44906-433d-4816-86fc-3018b309cb0c.jpeg)
  
  
  **レベルが上がった時↓**
  
  ![347A4A55-9852-45EC-969E-A8DB4D610D5E](https://user-images.githubusercontent.com/90256385/146681225-5e4934e9-1199-4491-a56c-224e849f32c3.jpeg)
  
  
  **ダークモード↓**
  
  ![59E266B1-5868-4AB5-BB15-AD91D9AEB67F](https://user-images.githubusercontent.com/90256385/146681238-06753e9a-ebcb-4d8e-9285-b19f2239b83e.jpeg)
  
  # 使用技術
  
 * フロントエンド
   * **jQuery 3.2**
   * **HTML/CSS/Sass/JavaScript/Bootstrap**

 * バックエンド
   * **PHP 8.0.12**
   * **Laravel 6**
   * **Twitter API**
   * **Google API**
 
 * インフラ
 　* **myssql 15.1**
 　* **AWS**

# 機能一覧

 * **ユーザー登録**
   * アカウント新規登録
   * ログイン・ログアウト機能
   * Googleログイン・Twitterログイン（API）
   * 簡易ログイン(ゲストユーザーログイン)
   * パスワード変更
 
 * **投稿機能**
   * 勉強したもののタイトル（タイトル）、その内容や感想(本文)、勉強時間を投稿できる。
   * 投稿したら、活動日数、継続日数が1日増える。もし投稿しない日があれば、継続日数は0に戻る。（例：9日間連続で投稿していたが、10日目は投稿しなかった。→活動日数は9日、継続日数は0日となる。）
   * １０時間勉強するごとにレベルが1上がる。

 * **コメント機能**
   * コメント一覧

 * **タグ機能**
   * タグ毎の投稿一覧 

 * **検索機能**
   * あいまい検索ができる。 投稿欄のタイトル、本文から抽出する。

 * **いいね機能**
   * いいね機能
 
 * **フォロー機能**
   * フォロー中のユーザーの投稿表示。
   * フォロー中、フォロワー一覧
  
 * **画像アップロード機能**
   
   * AWS S3バケット（投稿時とプロフィールのアバター時）

 * **ストップウォッチ機能**
 
 * **ポモドーロタイマー機能**
   * 勉強時間を15〜60分、休憩時間を5分〜20分の中から選べる。勉強時間終了時と休憩時間終了時にカウントダウン音が鳴る。
  
 * **ToDo機能**
   * フォルダーごとに管理できる。フォルダー内にさらに細かくタスクを分けることができる。
   * タスクの進捗状況（未着手・着手中・完了）や、見積もり時間、期限を記録できる。
  
 * **プロフィール欄編集機能**
   * 自己紹介、達成目標、試験日などの大切な日までのカウントダウンを設定できる。
 
 * **ダークモード機能**
 
 * **※今後追加したい機能**
  
   * 日、週、月の勉強時間を集計。日毎の勉強時間をグラフ化
   * 月毎の勉強時間ランキングTOP10の表示
   * コメントやいいねされたときに、通知がくるようにする。

# DB設計

ER図（IE記法）

![0FA04982-C9D2-4D18-81E2-2C73B6611026](https://user-images.githubusercontent.com/90256385/146972647-c3c074fb-2f32-41a0-a614-1d70345c196c.jpeg)


# 各テーブルについて

![E87C199F-B758-46BA-8793-C2249D49FAD7](https://user-images.githubusercontent.com/90256385/146690433-47d14cc0-501a-4339-a2b3-93b258fcfa1d.jpeg)
