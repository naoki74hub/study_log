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
* 総勉強時間ランキング、月毎の勉強時間ランキングを表示（1〜100位まで表示）

# 開発した背景

コロナウイルスが流行し、緊急事態宣言が発令され、家にいる時間が長くなった時に、「家でできることはないか」
、「この時間を無駄にしたくない」と思ったのがキッカケで、勉強にのめりこむようになりました。
私は、勉強した内容や勉強時間を「lifebear」というカレンダーアプリに記録していました。
自分が何をどれだけ勉強したかを記録として残すことができ、すごく達成感と充実感を味わえました。

私も、勉強のモチベーションアップにつながるアプリを作ってみたいと考えたことが背景にあります。

# 使用画面のイメージ
   
   ![E4CBBF6B-7041-4A84-A5B4-DBA195595C4C](https://user-images.githubusercontent.com/90256385/147176501-c92cff79-8ba7-4a90-b20a-38b95373a720.jpeg)

   ![5A2513F3-16DC-4DA6-B4F8-2DAB8231CC87](https://user-images.githubusercontent.com/90256385/147175020-037b1bc3-51a1-478e-8623-ae35ac32f42f.jpeg)
 
   ![728FDDAB-DE4E-46C9-B881-0958D1273B90](https://user-images.githubusercontent.com/90256385/147175401-727a0427-4bcf-41fd-b411-b3bff26ef32b.jpeg)
   
   ![90867828-A2CF-4452-B95F-BE484F675811](https://user-images.githubusercontent.com/90256385/147175872-f499bbcd-9c13-4a5b-ab57-e7b60fbbae57.jpeg)
   
   ![08BFC6B5-47DD-4704-B040-BB2529744F31](https://user-images.githubusercontent.com/90256385/147176181-72b0d703-ce70-4c29-9130-a4a148c25fa8.jpeg)
   
   ![ranking](https://user-images.githubusercontent.com/90256385/148499527-966fe4a9-d729-47e7-8b6c-8a4a406aafc1.jpeg)

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
 
 * **ランキング機能**
   * 総勉強時間ランキング、月毎の勉強時間ランキング表示 
 
 * **※今後追加したい機能**
  
   * 日、週、月の勉強時間を集計。日毎の勉強時間をグラフ化
   * コメントやいいねされたときに、通知がくるようにする。
   * いいねしたときの非同期通信

# DB設計

ER図（IE記法）

![ER](https://user-images.githubusercontent.com/90256385/148501737-a3f76632-e164-447f-9a7d-3b4a804b94bf.jpeg)

# 各テーブルについて

![E87C199F-B758-46BA-8793-C2249D49FAD7](https://user-images.githubusercontent.com/90256385/146690433-47d14cc0-501a-4339-a2b3-93b258fcfa1d.jpeg)
