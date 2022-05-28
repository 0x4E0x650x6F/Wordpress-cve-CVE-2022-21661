/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/@babel/runtime/helpers/classCallCheck.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/classCallCheck.js ***!
  \***************************************************************/
/***/ ((module) => {

eval("function _classCallCheck(instance, Constructor) {\n  if (!(instance instanceof Constructor)) {\n    throw new TypeError(\"Cannot call a class as a function\");\n  }\n}\n\nmodule.exports = _classCallCheck;\nmodule.exports.default = module.exports, module.exports.__esModule = true;\n\n//# sourceURL=././node_modules/@babel/runtime/helpers/classCallCheck.js");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/createClass.js":
/*!************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/createClass.js ***!
  \************************************************************/
/***/ ((module) => {

eval("function _defineProperties(target, props) {\n  for (var i = 0; i < props.length; i++) {\n    var descriptor = props[i];\n    descriptor.enumerable = descriptor.enumerable || false;\n    descriptor.configurable = true;\n    if (\"value\" in descriptor) descriptor.writable = true;\n    Object.defineProperty(target, descriptor.key, descriptor);\n  }\n}\n\nfunction _createClass(Constructor, protoProps, staticProps) {\n  if (protoProps) _defineProperties(Constructor.prototype, protoProps);\n  if (staticProps) _defineProperties(Constructor, staticProps);\n  return Constructor;\n}\n\nmodule.exports = _createClass;\nmodule.exports.default = module.exports, module.exports.__esModule = true;\n\n//# sourceURL=././node_modules/@babel/runtime/helpers/createClass.js");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/interopRequireDefault.js":
/*!**********************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/interopRequireDefault.js ***!
  \**********************************************************************/
/***/ ((module) => {

eval("function _interopRequireDefault(obj) {\n  return obj && obj.__esModule ? obj : {\n    \"default\": obj\n  };\n}\n\nmodule.exports = _interopRequireDefault;\nmodule.exports.default = module.exports, module.exports.__esModule = true;\n\n//# sourceURL=././node_modules/@babel/runtime/helpers/interopRequireDefault.js");

/***/ }),

/***/ "./assets/dev/js/frontend/hello-frontend.js":
/*!**************************************************!*\
  !*** ./assets/dev/js/frontend/hello-frontend.js ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

"use strict";
eval("\n\nvar _interopRequireDefault = __webpack_require__(/*! @babel/runtime/helpers/interopRequireDefault */ \"./node_modules/@babel/runtime/helpers/interopRequireDefault.js\");\n\nvar _classCallCheck2 = _interopRequireDefault(__webpack_require__(/*! @babel/runtime/helpers/classCallCheck */ \"./node_modules/@babel/runtime/helpers/classCallCheck.js\"));\n\nvar _createClass2 = _interopRequireDefault(__webpack_require__(/*! @babel/runtime/helpers/createClass */ \"./node_modules/@babel/runtime/helpers/createClass.js\"));\n\nvar elementorHelloThemeHandler = /*#__PURE__*/function () {\n  function elementorHelloThemeHandler() {\n    (0, _classCallCheck2[\"default\"])(this, elementorHelloThemeHandler);\n    this.initSettings();\n    this.initElements();\n    this.bindEvents();\n  }\n\n  (0, _createClass2[\"default\"])(elementorHelloThemeHandler, [{\n    key: \"initSettings\",\n    value: function initSettings() {\n      this.settings = {\n        selectors: {\n          header: 'header.site-header',\n          footer: 'footer.site-footer',\n          menuToggle: '.site-header .site-navigation-toggle',\n          menuToggleHolder: '.site-header .site-navigation-toggle-holder',\n          dropdownMenu: '.site-header .site-navigation-dropdown'\n        }\n      };\n    }\n  }, {\n    key: \"initElements\",\n    value: function initElements() {\n      this.elements = {\n        $window: jQuery(window),\n        $document: jQuery(document),\n        $header: jQuery(this.settings.selectors.header),\n        $footer: jQuery(this.settings.selectors.footer),\n        $menuToggle: jQuery(this.settings.selectors.menuToggle),\n        $menuToggleHolder: jQuery(this.settings.selectors.menuToggleHolder),\n        $dropdownMenu: jQuery(this.settings.selectors.dropdownMenu)\n      };\n    }\n  }, {\n    key: \"bindEvents\",\n    value: function bindEvents() {\n      var _this = this;\n\n      this.elements.$menuToggle.on('click', function () {\n        return _this.handleMenuToggle();\n      });\n      this.elements.$dropdownMenu.on('click', '.menu-item-has-children > a', this.handleMenuChildren);\n    }\n  }, {\n    key: \"closeMenuItems\",\n    value: function closeMenuItems() {\n      var _this2 = this;\n\n      this.elements.$menuToggleHolder.removeClass('elementor-active');\n      this.elements.$window.off('resize', function () {\n        return _this2.closeMenuItems();\n      });\n    }\n  }, {\n    key: \"handleMenuToggle\",\n    value: function handleMenuToggle() {\n      var _this3 = this;\n\n      var isDropdownVisible = !this.elements.$menuToggleHolder.hasClass('elementor-active');\n      this.elements.$menuToggle.attr('aria-expanded', isDropdownVisible);\n      this.elements.$dropdownMenu.attr('aria-hidden', !isDropdownVisible);\n      this.elements.$menuToggleHolder.toggleClass('elementor-active', isDropdownVisible); // Always close all sub active items.\n\n      this.elements.$dropdownMenu.find('.elementor-active').removeClass('elementor-active');\n\n      if (isDropdownVisible) {\n        this.elements.$window.on('resize', function () {\n          return _this3.closeMenuItems();\n        });\n      } else {\n        this.elements.$window.off('resize', function () {\n          return _this3.closeMenuItems();\n        });\n      }\n    }\n  }, {\n    key: \"handleMenuChildren\",\n    value: function handleMenuChildren(event) {\n      var $anchor = jQuery(event.currentTarget),\n          $parentLi = $anchor.parent('li'),\n          isSubmenuVisible = $parentLi.hasClass('elementor-active');\n\n      if (!isSubmenuVisible) {\n        $parentLi.addClass('elementor-active');\n      } else {\n        $parentLi.removeClass('elementor-active');\n      }\n    }\n  }]);\n  return elementorHelloThemeHandler;\n}();\n\njQuery(function () {\n  new elementorHelloThemeHandler();\n});\n\n//# sourceURL=././assets/dev/js/frontend/hello-frontend.js");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = __webpack_require__("./assets/dev/js/frontend/hello-frontend.js");
/******/ 	
/******/ })()
;