/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/stopwatch.js":
/*!***********************************!*\
  !*** ./resources/js/stopwatch.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


{
  // StartからStopまでの経過時間
  var countUp = function countUp() {
    var d = new Date(Date.now() - startTime + elapsedTime);
    /* padStart()で二桁または三桁固定表示とする */

    var m = String(d.getMinutes()).padStart(2, '0');
    var s = String(d.getSeconds()).padStart(2, '0');
    /* 描画 */

    timer.textContent = "".concat(m, ":").concat(s);
    timeoutid = setTimeout(function () {
      //再帰呼び出し
      countUp();
    }, 10);
  }; // 状態:初期 または Reset直後


  var setButtonStateInitial = function setButtonStateInitial() {
    start.classList.remove('inactive'); // 活性

    stop.classList.add('inactive'); // 非活性

    reset.classList.add('inactive'); // 非活性
  }; // 状態:タイマー動作中


  var setButtonStateRunning = function setButtonStateRunning() {
    start.classList.add('inactive'); // 非活性

    stop.classList.remove('inactive'); // 活性

    reset.classList.add('inactive'); // 非活性
  }; // 状態:タイマー停止中


  var setButtonStateStopped = function setButtonStateStopped() {
    start.classList.remove('inactive'); // 活性

    stop.classList.add('inactive'); // 非活性

    reset.classList.remove('inactive'); // 活性
  }; // ボタンを'初期'状態とする


  var timer = document.getElementById('timer');
  var start = document.getElementById('start');
  var stop = document.getElementById('stop');
  var reset = document.getElementById('reset');
  var startTime; // Startボタンクリック時の時刻

  var timeoutid; // ID

  var elapsedTime = 0;
  setButtonStateInitial(); // Startボタンクリック
  // …タイマーを開始します

  start.addEventListener('click', function () {
    if (start.classList.contains('inactive') === true) {
      return;
    } // ボタンをタイマー'動作中'状態とする


    setButtonStateRunning();
    startTime = Date.now();
    countUp();
  }); // Stopボタンクリック
  // …タイマーを停止します

  stop.addEventListener('click', function () {
    if (stop.classList.contains('inactive') === true) {
      return;
    } // タイマーを'停止中'状態とする


    setButtonStateStopped();
    clearTimeout(timeoutid);
    elapsedTime += Date.now() - startTime;
  }); // Resetボタンクリック
  // …タイマーを「00:00.000」で上書きします

  reset.addEventListener('click', function () {
    if (reset.classList.contains('inactive') === true) {
      return;
    } // ボタンを'初期'状態とする


    setButtonStateInitial();
    timer.textContent = '00:00';
    elapsedTime = 0;
  });
}

/***/ }),

/***/ 6:
/*!*****************************************!*\
  !*** multi ./resources/js/stopwatch.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/ec2-user/environment/study_log/resources/js/stopwatch.js */"./resources/js/stopwatch.js");


/***/ })

/******/ });