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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pomodoro_timer.js":
/*!****************************************!*\
  !*** ./resources/js/pomodoro_timer.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


{
  // ??????????????????????????????
  var countDown = function countDown() {
    if (workFlg == true) {
      count = 60000 * parseInt(dropDown1.textContent);
    } else {
      count = 60000 * parseInt(dropDown2.textContent);
    }

    var d = new Date(startTime - Date.now() + elapsedTime + count);
    var m = String(d.getMinutes()).padStart(2, '0');
    var s = String(d.getSeconds()).padStart(2, '0');
    pomodoro_timer.textContent = "".concat(m, ":").concat(s); // ??????3????????????????????????????????????

    if ("".concat(m) == '00' && "".concat(s) == '03') {
      if (count3 == true) {
        document.getElementById('sound-file-decision1').play();
        count3 = false;
      }
    }

    if ("".concat(m) == '00' && "".concat(s) == '02') {
      if (count2 == true) {
        document.getElementById('sound-file-decision1').play();
        count2 = false;
      }
    }

    if ("".concat(m) == '00' && "".concat(s) == '01') {
      if (count1 == true) {
        document.getElementById('sound-file-decision1').play();
        count1 = false;
      }
    } // ??????????????????????????????????????????


    if ("".concat(m) == '00' && "".concat(s) == '00') {
      // ???????????????
      startTime = Date.now();
      elapsedTime = 0; // soundFlg = true;

      count1 = true;
      count2 = true;
      count3 = true; // // ??????????????????
      // document.getElementById( 'sound-file-decision4' ).play();

      if (workFlg == true) {
        workFlg = false;
        workText.textContent = '?????????';
      } else {
        workFlg = true;
        workText.textContent = '?????????';
      }
    }

    timeoutId = setTimeout(function () {
      countDown();
    }, 10);
  };

  /* ???????????? */
  var startBtn = document.getElementById('startBtn');
  var stopBtn = document.getElementById('stopBtn');
  var cancelBtn = document.getElementById('cancelBtn');
  var dropDown1 = document.getElementById('dropdownMenu1');
  var dropDown2 = document.getElementById('dropdownMenu2');
  var workText = document.getElementById('work');
  var pomodoro_timer = document.getElementById('pomodoro-timer');
  var startTime;
  var timeoutId;
  var elapsedTime = 0;
  var count;
  var workFlg = true; // true = ?????????  ,  false = ??????????????????

  var count1 = true;
  var count2 = true;
  var count3 = true; // ???????????????????????????????????????

  window.addEventListener('DOMContentLoaded', function () {
    $('.dropdown-menu .dropdown-item').click(function () {
      var visibleItem = $('.dropdown-toggle', $(this).closest('.dropdown'));
      visibleItem.text($(this).attr('value'));
    });
  }); // ?????????????????????????????????????????????

  startBtn.addEventListener('click', function () {
    // page????????????
    document.getElementById('page1').classList.add("displayNone");
    document.getElementById('page2').classList.remove("displayNone");
    startTime = Date.now();
    countDown();
  }); // ?????????????????????????????????????????????

  stopBtn.addEventListener('click', function () {
    if (stopBtn.textContent == '????????????') {
      clearTimeout(timeoutId);
      elapsedTime += startTime - Date.now();
      stopBtn.textContent = '????????????';
    } else {
      stopBtn.textContent = '????????????';
      startTime = Date.now();
      countDown();
    }
  }); // ????????????????????????????????????????????????

  cancelBtn.addEventListener('click', function () {
    // page????????????
    document.getElementById('page1').classList.remove("displayNone");
    document.getElementById('page2').classList.add("displayNone"); // ?????????

    count1 = true;
    count2 = true;
    count3 = true;
    elapsedTime = 0;
    workText.textContent = '?????????';
    stopBtn.textContent = '????????????';
    clearTimeout(timeoutId);
    workFlg = true;
  });
}

/***/ }),

/***/ 1:
/*!**********************************************!*\
  !*** multi ./resources/js/pomodoro_timer.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/ec2-user/environment/study_log/resources/js/pomodoro_timer.js */"./resources/js/pomodoro_timer.js");


/***/ })

/******/ });