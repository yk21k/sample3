$('.modal-overlay').hide();  // モーダルは最初は非表示

const scrollPos = $(window).scrollTop();  // モーダル表示前のスクロール位置を取得

setTimeout(() => {  // 一定時間経過後に
  $('.modal-overlay').fadeIn(400);  // 0.4秒かけてモーダルを表示
  $('.app').css({position: 'fixed', top: -scrollPos, left: '0'});  // オーバーレイ背面のbodyを固定（スクロール制御）
},100);  // 一定時間を1分(60000ミリ秒）に設定

$('button, .modal-mask').click(function() {  // モーダルの右上の閉じる（×）ボタン、若しくはモーダルのオーバーレイをクリックしたら
  $('.modal-overlay').fadeOut(400);  // 0.4秒かけてモーダルを非表示
  $(window).scrollTop(scrollPos);  // スクロール位置を元に戻す
});


// 「同意する」のチェックボックスを取得
const agreeCheckbox = document.getElementById("agree");
// 送信ボタンを取得
const closeBtn = document.getElementById("modal1-close");

// チェックボックスをクリックした時
agreeCheckbox.addEventListener("click", () => {
  // チェックされている場合
  if (agreeCheckbox.checked === true) {
    closeBtn.disabled = false; // disabledを外す
  }
  // チェックされていない場合
  else {
    closeBtn.disabled = true; // disabledを付与
  }
});