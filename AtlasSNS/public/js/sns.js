
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



document.getElementById('upload_area').addEventListener('dragover', function (event) {
  event.preventDefault();
  this.style.border = '2px dashed #666';
});

document.getElementById('upload_area').addEventListener('dragleave', function (event) {
  event.preventDefault();
  this.style.border = '2px dashed #ccc';
});

document.getElementById('upload_area').addEventListener('drop', function (event) {
  event.preventDefault();
  this.style.border = '2px dashed #ccc';
  var file = event.dataTransfer.files[0];
  previewImage(file);
});

document.getElementById('file_input').addEventListener('change', function (event) {
  var file = event.target.files[0];
  previewImage(file);
});

function previewImage(file) {
  var reader = new FileReader();
  reader.onload = function (event) {
    var img = document.createElement('img');
    img.src = event.target.result;
    img.style.maxWidth = '100%';
    document.getElementById('upload_area').innerHTML = '';
    document.getElementById('upload_area').appendChild(img);
  };
  reader.readAsDataURL(file);
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
