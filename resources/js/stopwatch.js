'use strict';

{
  const timer = document.getElementById('timer');
  const start = document.getElementById('start');
  const stop = document.getElementById('stop');
  const reset = document.getElementById('reset');

  let startTime;       // Startボタンクリック時の時刻
  let timeoutid;       // ID
  let elapsedTime = 0; // StartからStopまでの経過時間

  function countUp() {
    const d = new Date(Date.now() - startTime + elapsedTime);
    /* padStart()で二桁または三桁固定表示とする */
    const m = String(d.getMinutes()).padStart(2, '0');
    const s = String(d.getSeconds()).padStart(2, '0');
    /* 描画 */
    timer.textContent = `${m}:${s}`;

    timeoutid = setTimeout(() => {
      //再帰呼び出し
      countUp();
    }, 10);
  }

  // 状態:初期 または Reset直後
  function setButtonStateInitial() {
    start.classList.remove('inactive'); // 活性
    stop.classList.add('inactive')    // 非活性
    reset.classList.add('inactive')   // 非活性
  }

  // 状態:タイマー動作中
  function setButtonStateRunning() {
    start.classList.add('inactive')   // 非活性
    stop.classList.remove('inactive');  // 活性
    reset.classList.add('inactive')   // 非活性
  }

  // 状態:タイマー停止中
  function setButtonStateStopped() {
    start.classList.remove('inactive'); // 活性
    stop.classList.add('inactive')    // 非活性
    reset.classList.remove('inactive'); // 活性
  }

  // ボタンを'初期'状態とする
  setButtonStateInitial()

  // Startボタンクリック
  // …タイマーを開始します
  start.addEventListener('click', () => {
    if (start.classList.contains('inactive') === true) {
      return;
    }
    // ボタンをタイマー'動作中'状態とする
    setButtonStateRunning();
    startTime = Date.now();
    countUp();
  });

  // Stopボタンクリック
  // …タイマーを停止します
  stop.addEventListener('click', () => {
    if (stop.classList.contains('inactive') === true) {
      return;
    }
    // タイマーを'停止中'状態とする
    setButtonStateStopped();
    clearTimeout(timeoutid);
    elapsedTime += Date.now() - startTime;
  });

  // Resetボタンクリック
  // …タイマーを「00:00.000」で上書きします
  reset.addEventListener('click', () => {
    if (reset.classList.contains('inactive') === true) {
      return;
    }
    // ボタンを'初期'状態とする
    setButtonStateInitial()
    timer.textContent = '00:00';
    elapsedTime = 0;
  });
}