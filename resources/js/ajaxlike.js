// $(function () {
// let like = $('.js-like-toggle');
// let likePostId;

// like.on('click', function () {
//     let $this = $(this);
//     likePostId = $this.data('postid');
//     $.ajax({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             url: "{{ action('LikeController@store', ['post' => $post]) }}",  //routeの記述
//             type: 'POST', //受け取り方法の記述（GETもある）
//             data: {
//                 'post_id': likePostId //コントローラーに渡すパラメーター
//             },
//     })

//         // Ajaxリクエストが成功した場合
//         .done(function (data) {
// //lovedクラスを追加
//             $this.toggleClass('btn-danger'); 

// //.likesCountの次の要素のhtmlを「data.postLikesCount」の値に書き換える
//             $this.next('. js-like-toggle').html(data.post_likes_count); 

//         })
//         // Ajaxリクエストが失敗した場合
//         .fail(function (data, xhr, err) {
// //ここの処理はエラーが出た時にエラー内容をわかるようにしておく。
// //とりあえず下記のように記述しておけばエラー内容が詳しくわかります。笑
//             console.log('エラー');
//             console.log(err);
//             console.log(xhr);
//         });
    
//     return false;
// });
// });