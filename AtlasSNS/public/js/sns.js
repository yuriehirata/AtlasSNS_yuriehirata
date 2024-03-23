
//ハンバーガーメニュー
document.addEventListener('DOMContentLoaded', function () {
  // メニュートグルボタンをクリックしたときの処理
  document.querySelector('.menu-toggle').addEventListener('click', function () {
    // メニューを開閉する
    document.getElementById('menu').classList.toggle('active');

    // ボタンのアニメーション
    this.classList.toggle('active');
    this.classList.toggle('dli-chevron-down'); // 矢印を下向きにするクラスを追加
    this.classList.toggle('dli-chevron-up');   // 矢印を上向きにするクラスを追加

    // メニューが開いているかどうかを示すaria-expanded属性の値を切り替える
    var expanded = this.getAttribute('aria-expanded') === 'true' || false;
    this.setAttribute('aria-expanded', !expanded);
  });
});


$(function () {
  // 編集ボタン(class="js-modal-open")が押されたら発火
  $('.js-modal-open').on('click', function () {
    // モーダルの中身(class="js-modal")の表示
    $('.js-modal').fadeIn();
    // 押されたボタンから投稿内容を取得し変数（var）へ格納
    var post = $(this).attr('post');
    // 押されたボタンから投稿のidを取得し変数へ格納（どの投稿を編集するか特定するのに必要な為）
    var post_id = $(this).attr('post_id');

    // 取得した投稿内容をモーダルの中身へ渡す
    $('.modal_post').val(post);
    // 取得した投稿のidをモーダルの中身へ渡す
    $('.modal_id').val(post_id);
    return false;
  });
});

// モーダル内でのフォームの送信処理
function submitModalForm() {
  // フォームデータを取得
  var formData = $('.modal_form').serialize();

  // フォームデータをサーバーに送信
  $.ajax({
    url: '/posts/update', // 送信先のURLを指定
    type: 'POST', // POSTリクエストを送信
    data: formData, // フォームデータを送信
    success: function (response) {
      // 送信が成功した場合の処理
      console.log('Form submitted successfully!');
      // 必要な処理を追加
    },
    error: function (xhr, status, error) {
      // 送信が失敗した場合の処理
      console.error('Form submission failed:', error);
      // 必要なエラー処理を追加
    }
  });
}

// 背景部分や閉じるボタン(js-modal-close)が押されたらモーダルを閉じる処理を実行
$('.js-modal-close').on('click', function () {
  $('.js-modal').fadeOut();
  return false;
});


//   // 背景部分や閉じるボタン(js-modal-close)が押されたら発火
//   $('.js-modal-close').on('click', function () {
//     // モーダルの中身(class="js-modal")を非表示
//     $('.js-modal').fadeOut();
//     return false;
//   });
// });




// // Ajaxリクエストを使用してデータを送信
// var xhr = new XMLHttpRequest();
// xhr.open('POST', '/posts/' + postId + '/update', true);
// xhr.setRequestHeader('Content-Type', 'application/json');
// xhr.onload = function () {
//   if (xhr.status === 200) {
//     // 成功した場合の処理
//     alert('投稿内容が更新されました');
//   } else {
//     // 失敗した場合の処理
//     alert('更新に失敗しました');
//   }
// };
// xhr.send(JSON.stringify({ content: postContent }));
// }
