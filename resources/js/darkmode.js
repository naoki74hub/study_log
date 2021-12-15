const btn = document.querySelector('#modeChange');
 
// チェックした時の挙動
btn.addEventListener('change', () => {
  if (btn.checked === true) {
    // ダークモード
    document.body.classList.add('darkTheme');
    let darkmode = document.getElementsByClassName('darkmode-post');
　　for(let i=0;i<darkmode.length;i++) {
    darkmode[i].classList.add('darkTheme2');
       /*global localStorage*/
    localStorage.setItem('dark-mode-settings', 'darkTheme');
     }
   
  } else {
    // ライトモード
    document.body.classList.remove('darkTheme');
    let darkmode = document.getElementsByClassName('darkmode-post');
    for(let i=0;i<darkmode.length;i++) {
    darkmode[i].classList.remove('darkTheme2');
    localStorage.setItem('dark-mode-settings', 'light');
    }
  }
});
   window.addEventListener('DOMContentLoaded', function(){
  if(localStorage.getItem('dark-mode-settings') ==='darkTheme') {
    let cp_ipcheck = document.getElementById('modeChange');
    cp_ipcheck.checked = true;
   document.body.classList.add('darkTheme');
   let darkmode = document.getElementsByClassName('darkmode-post');
    for(let i=0;i<darkmode.length;i++) {
    darkmode[i].classList.add('darkTheme2');
    }
  }else if (localStorage.getItem('dark-mode-settings')==='light') {
    let cp_ipcheck = document.getElementById('modeChange');
    cp_ipcheck.checked = false;
      document.body.classList.add("light");
       let darkmode = document.getElementsByClassName('darkmode-post');
    for(let i=0;i<darkmode.length;i++) {
    darkmode[i].classList.remove('darkTheme2');
    }
  }
});