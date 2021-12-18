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

/***/ "./resources/js/darkmode.js":
/*!**********************************!*\
  !*** ./resources/js/darkmode.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

var btn = document.querySelector('#modeChange'); // チェックした時の挙動

btn.addEventListener('change', function () {
  if (btn.checked === true) {
    // ダークモード
    document.body.classList.add('darkTheme');
    var darkmode = document.getElementsByClassName('darkmode-post');

    for (var i = 0; i < darkmode.length; i++) {
      darkmode[i].classList.add('darkTheme2');
      /*global localStorage*/

      localStorage.setItem('dark-mode-settings', 'darkTheme');
    }
  } else {
    // ライトモード
    document.body.classList.remove('darkTheme');

    var _darkmode = document.getElementsByClassName('darkmode-post');

    for (var _i = 0; _i < _darkmode.length; _i++) {
      _darkmode[_i].classList.remove('darkTheme2');

      localStorage.setItem('dark-mode-settings', 'light');
    }
  }
});
window.addEventListener('DOMContentLoaded', function () {
  if (localStorage.getItem('dark-mode-settings') === 'darkTheme') {
    var cp_ipcheck = document.getElementById('modeChange');
    cp_ipcheck.checked = true;
    document.body.classList.add('darkTheme');
    var darkmode = document.getElementsByClassName('darkmode-post');

    for (var i = 0; i < darkmode.length; i++) {
      darkmode[i].classList.add('darkTheme2');
    }
  } else if (localStorage.getItem('dark-mode-settings') === 'light') {
    var _cp_ipcheck = document.getElementById('modeChange');

    _cp_ipcheck.checked = false;
    document.body.classList.add("light");

    var _darkmode2 = document.getElementsByClassName('darkmode-post');

    for (var _i2 = 0; _i2 < _darkmode2.length; _i2++) {
      _darkmode2[_i2].classList.remove('darkTheme2');
    }
  }
});

/***/ }),

/***/ 1:
/*!****************************************!*\
  !*** multi ./resources/js/darkmode.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/ec2-user/environment/study_log/resources/js/darkmode.js */"./resources/js/darkmode.js");


/***/ })

/******/ });