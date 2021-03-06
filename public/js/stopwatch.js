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
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
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
  // Start??????Stop?????????????????????
  var countUp = function countUp() {
    var d = new Date(Date.now() - startTime + elapsedTime);
    /* padStart()????????????????????????????????????????????? */

    var m = String(d.getMinutes()).padStart(2, '0');
    var s = String(d.getSeconds()).padStart(2, '0');
    /* ?????? */

    timer.textContent = "".concat(m, ":").concat(s);
    timeoutid = setTimeout(function () {
      //??????????????????
      countUp();
    }, 10);
  }; // ??????:?????? ????????? Reset??????


  var setButtonStateInitial = function setButtonStateInitial() {
    start.classList.remove('inactive'); // ??????

    stop.classList.add('inactive'); // ?????????

    reset.classList.add('inactive'); // ?????????
  }; // ??????:?????????????????????


  var setButtonStateRunning = function setButtonStateRunning() {
    start.classList.add('inactive'); // ?????????

    stop.classList.remove('inactive'); // ??????

    reset.classList.add('inactive'); // ?????????
  }; // ??????:?????????????????????


  var setButtonStateStopped = function setButtonStateStopped() {
    start.classList.remove('inactive'); // ??????

    stop.classList.add('inactive'); // ?????????

    reset.classList.remove('inactive'); // ??????
  }; // ????????????'??????'???????????????


  var timer = document.getElementById('timer');
  var start = document.getElementById('start');
  var stop = document.getElementById('stop');
  var reset = document.getElementById('reset');
  var startTime; // Start?????????????????????????????????

  var timeoutid; // ID

  var elapsedTime = 0;
  setButtonStateInitial(); // Start?????????????????????
  // ?????????????????????????????????

  start.addEventListener('click', function () {
    if (start.classList.contains('inactive') === true) {
      return;
    } // ????????????????????????'?????????'???????????????


    setButtonStateRunning();
    startTime = Date.now();
    countUp();
  }); // Stop?????????????????????
  // ?????????????????????????????????

  stop.addEventListener('click', function () {
    if (stop.classList.contains('inactive') === true) {
      return;
    } // ???????????????'?????????'???????????????


    setButtonStateStopped();
    clearTimeout(timeoutid);
    elapsedTime += Date.now() - startTime;
  }); // Reset?????????????????????
  // ?????????????????????00:00.000????????????????????????

  reset.addEventListener('click', function () {
    if (reset.classList.contains('inactive') === true) {
      return;
    } // ????????????'??????'???????????????


    setButtonStateInitial();
    timer.textContent = '00:00';
    elapsedTime = 0;
  });
}

/***/ }),

/***/ 5:
/*!*****************************************!*\
  !*** multi ./resources/js/stopwatch.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/ec2-user/environment/study_log/resources/js/stopwatch.js */"./resources/js/stopwatch.js");


/***/ })

/******/ });