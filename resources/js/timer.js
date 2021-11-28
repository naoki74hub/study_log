'use strict';

let timer1; 

window.onload = function cntStart()
{
  document.timer.elements[2].disabled=true;
  timer1=setInterval("countDown()",1000);
}

//タイマー停止関数
window.onload = function cntStop()
{
  document.timer.elements[2].disabled=false;
  clearInterval(timer1);
}

//カウントダウン関数
window.onload = function countDown()
{
  let min=document.timer.elements[0].value;
  let sec=document.timer.elements[1].value;
  
  if( (min=="") && (sec=="") )
  {
    alert("時刻を設定してください！");
    /*global $ */
    reSet();
  }
  else
  {
    if (min=="") min=0;
    min=parseInt(min);
    
    if (sec=="") sec=0;
    sec=parseInt(sec);
    /*global tmWrite*/
    tmWrite(min*60+sec-1);
  }
}

//残り時間を書き出す関数
window.onload = function tmWrite(int)
{
  int=parseInt(int);
  
  if (int<=0)
  {
    /*global reSet */
    reSet();
    alert("時間です！");
  }
  else
  {
    //残り分数はintを60で割って切り捨てる
    document.timer.elements[0].value=Math.floor(int/60);
    //残り秒数はintを60で割った余り
    document.timer.elements[1].value=int % 60;
  }
}

//フォームを初期状態に戻す（リセット）関数
window.onload = function reSet()
{
  document.timer.elements[0].value="0";
  document.timer.elements[1].value="0";
  document.timer.elements[2].disabled=false;
  clearInterval(timer1);
}  
