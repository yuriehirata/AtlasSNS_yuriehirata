
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
document.addEventListener('DOMContentLoaded', function () {
  var openModalButtons = document.getElementsByClassName('open_modal_button');


  //モーダル
  // 各モーダルのイベントを設定
  for (var i = 0; i < openModalButtons.length; i++) {
    openModalButtons[i].addEventListener('click', function () {
      var postId = this.getAttribute('data-post-id');
      var post = this.getAttribute('aria-controls');
      var modalMenu = document.getElementById('modal_menu_' + postId);
      //var postText = document.getElementById('post-content_');
      var modalOverlay = document.getElementById('modal_overlay_' + postId);
      // var postContent = document.getElementById('post-content_' + post).textContent.trim();
      // var postText = document.getElementByName('post-content_' + postId).textContent.trim();
      modalMenu.style.display = 'block';
      modalOverlay.classList.add('active');
      // modalMenu.querySelector('textarea').value = postContent;
    });
  }

  var closeModalButtons = document.getElementsByClassName('close_modal_button');

  // 各閉じるボタンのイベントを設定
  for (var j = 0; j < closeModalButtons.length; j++) {
    closeModalButtons[j].addEventListener('click', function () {
      var postId = this.getAttribute('data-post-id');
      var modalMenu = document.getElementById('modal_menu_' + postId);
      var modalOverlay = document.getElementById('modal_overlay_' + postId);
      modalMenu.style.display = 'none';
      modalOverlay.classList.remove('active');
    });
  }
});


// // 投稿フォームのサブミット処理
// var postForm = document.getElementById('post-form');
// postForm.addEventListener('submit', function (event) {
//   // フォームのデフォルトの送信アクションを防ぐ
//   event.preventDefault();

//   // フォームデータを取得
//   var formData = new FormData(postForm);

//   // Ajaxリクエストを作成
//   var xhr = new XMLHttpRequest();

//   // リクエストの設定
//   xhr.open('POST', '/posts', true);
//   xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}'); // CSRFトークンの設定
//   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

//   // リクエストが完了した際の処理
//   xhr.onload = function () {
//     if (xhr.status === 200) {
//       // 成功した場合の処理を記述
//       console.log('投稿が更新されました。');
//     } else {
//       // エラーが発生した場合の処理を記述
//       console.error('投稿の更新中にエラーが発生しました。');
//     }
//   };

//   // リクエストを送信
//   xhr.send(formData);
// });
