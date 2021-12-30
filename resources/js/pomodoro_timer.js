'use strict';

{

  /* 変数定義 */
  const startBtn = document.getElementById('startBtn');
  const stopBtn = document.getElementById('stopBtn');
  const cancelBtn = document.getElementById('cancelBtn');
  const dropDown1 = document.getElementById('dropdownMenu1');
  const dropDown2 = document.getElementById('dropdownMenu2');
  const workText = document.getElementById('work');
  const pomodoro_timer = document.getElementById('pomodoro-timer');

  let startTime;
  let timeoutId;
  let elapsedTime = 0;
  let count;
  let workFlg = true; // true = 活動中  ,  false = インターバル
  let count1 = true;
  let count2 = true;
  let count3 = true;


  // ドロップダウンの項目を変更
  window.addEventListener('DOMContentLoaded', function () {
    $('.dropdown-menu .dropdown-item').click(function () {
      let visibleItem = $('.dropdown-toggle', $(this).closest('.dropdown'));
      visibleItem.text($(this).attr('value'));
    });
  });

  // スタートボタンを押した時の処理
  startBtn.addEventListener('click', () => {
    // page切り替え
    document.getElementById('page1').classList.add("displayNone");
    document.getElementById('page2').classList.remove("displayNone");

    startTime = Date.now();
    countDown();
  });

  // 一時停止ボタンを押した時の処理
  stopBtn.addEventListener('click', () => {
    if (stopBtn.textContent == '一時停止') {
      clearTimeout(timeoutId);
      elapsedTime += startTime - Date.now();
      stopBtn.textContent = 'スタート'
    } else {
      stopBtn.textContent = '一時停止'
      startTime = Date.now();
      countDown();
    }
    
  });

  // キャンセルボタンを押した時の処理
  cancelBtn.addEventListener('click', () => {
    // page切り替え
    document.getElementById('page1').classList.remove("displayNone");
    document.getElementById('page2').classList.add("displayNone");

    // 初期化
    count1 = true;
    count2 = true;
    count3 = true;
    elapsedTime = 0;
    workText.textContent = '活動中';
    stopBtn.textContent = '一時停止'

    clearTimeout(timeoutId);
    workFlg = true;
  });

  // カウントダウン用関数
  function countDown() {
    if (workFlg == true) {
      count = 60000 * parseInt(dropDown1.textContent);
    } else {
      count = 60000 * parseInt(dropDown2.textContent);
    }

    const d = new Date(startTime - Date.now()  + elapsedTime + count);
    const m = String(d.getMinutes()).padStart(2, '0');
    const s = String(d.getSeconds()).padStart(2, '0');
    pomodoro_timer.textContent = `${m}:${s}`;

    // 残り3秒でカウントダウン音開始
    if (`${m}` == '00' && `${s}` == '03') {
      if (count3 == true) {
        document.getElementById( 'sound-file-decision1' ).play();
        count3 = false;
      }
    }
    if (`${m}` == '00' && `${s}` == '02') {
      if (count2 == true) {
        document.getElementById( 'sound-file-decision1' ).play();
        count2 = false;
      }
    }
    if (`${m}` == '00' && `${s}` == '01') {
      if (count1 == true) {
        document.getElementById( 'sound-file-decision1' ).play();
        count1 = false;
      }
    }

    // カウントが０になった時の処理
    if (`${m}` == '00' && `${s}` == '00') {
      // 初期化処理
      startTime = Date.now();
      elapsedTime = 0;
      // soundFlg = true;
      count1 = true;
      count2 = true;
      count3 = true;

      // // 終了サウンド
      // document.getElementById( 'sound-file-decision4' ).play();
      if (workFlg == true) {
        workFlg = false;
        workText.textContent = '休憩中';
      } else {
        workFlg = true;
        workText.textContent = '活動中';
      }
    }

    timeoutId = setTimeout(() => {
      countDown();
    }, 10);
  }
}