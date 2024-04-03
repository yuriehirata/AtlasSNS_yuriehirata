
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


// function submitForm() {
//   // 入力されたテキストを取得してフォームに設定
//   var content = document.getElementById('contentWrapper').innerText;
//   document.querySelector('input[name="content"]').value = content.trim();
//   // フォームを送信
//   document.querySelector('form').submit();
// }

// function handleKeyDown(event) {
//   // Shift + Enterの場合は改行せずにフォームを送信
//   if (event.key === 'Enter' && !event.shiftKey) {
//     event.preventDefault(); // デフォルトのEnterの動作を無効化
//     submitForm(); // フォームを送信
//   }
// }

// function checkLength() {
//   // 入力文字数をチェックし、150文字を超えた場合はカット
//   var content = document.getElementById('contentWrapper').innerText;
//   if (content.length > 150) {
//     document.getElementById('contentWrapper').innerText = content.slice(0, 150);
//   }
// }

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

// 背景部分や閉じるボタン(js-modal-close)が押されたらモーダルを閉じる処理を実行
$(function () {
  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });
});

function changeImageAndStyle(elementId, newImageSrc) {
  var element = document.getElementById(elementId);
  if (element) {
    element.src = newImageSrc;
  }
}

function submitForm(formId) {
  document.getElementById(formId).submit();
}

function handleFollow(action, formId) {
  submitForm(formId); // フォームを送信
  // フォロー解除の場合はリロード
  if (action === 'unfollow') {
    location.reload();
  }
}
