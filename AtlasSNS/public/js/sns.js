

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
  // モーダルを開くボタン
  var openModalButton = document.getElementById('open_modal_button');
  // モーダルを閉じるボタン
  var closeModalButton = document.getElementById('close_modal_button');
  // モーダル要素
  var modalMenu = document.getElementById('modal_menu');

  // モーダルを開くボタンがクリックされたときの処理
  openModalButton.addEventListener('click', function () {
    modalMenu.style.display = 'block';

    // 投稿内容を取得してテキストエリアにセットする
    var postContent = this.closest('tr').querySelector('.post-content').textContent.trim();
    modalMenu.querySelector('#post-content').value = postContent;
  });

  // モーダルを閉じるボタンがクリックされたときの処理
  closeModalButton.addEventListener('click', function () {
    modalMenu.style.display = 'none';
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
});
