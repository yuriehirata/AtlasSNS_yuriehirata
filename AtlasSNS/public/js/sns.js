<script>
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
</script>
