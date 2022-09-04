$(function () {
  // F5、Ctrl + r、ブラウザのリロードボタン、右クリックで表示されたメニューから再読み込み
  if (window.performance.navigation.type === 1) {
    // 中断
    return false;
  }
});