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

/***/ "./node_modules/@babel/runtime/helpers/arrayLikeToArray.js":
/*!*****************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/arrayLikeToArray.js ***!
  \*****************************************************************/
/***/ ((module) => {

eval("function _arrayLikeToArray(arr, len) {\n  if (len == null || len > arr.length) len = arr.length;\n\n  for (var i = 0, arr2 = new Array(len); i < len; i++) {\n    arr2[i] = arr[i];\n  }\n\n  return arr2;\n}\n\nmodule.exports = _arrayLikeToArray;\nmodule.exports.default = module.exports, module.exports.__esModule = true;\n\n//# sourceURL=././node_modules/@babel/runtime/helpers/arrayLikeToArray.js");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/arrayWithHoles.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/arrayWithHoles.js ***!
  \***************************************************************/
/***/ ((module) => {

eval("function _arrayWithHoles(arr) {\n  if (Array.isArray(arr)) return arr;\n}\n\nmodule.exports = _arrayWithHoles;\nmodule.exports.default = module.exports, module.exports.__esModule = true;\n\n//# sourceURL=././node_modules/@babel/runtime/helpers/arrayWithHoles.js");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/assertThisInitialized.js":
/*!**********************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/assertThisInitialized.js ***!
  \**********************************************************************/
/***/ ((module) => {

eval("function _assertThisInitialized(self) {\n  if (self === void 0) {\n    throw new ReferenceError(\"this hasn't been initialised - super() hasn't been called\");\n  }\n\n  return self;\n}\n\nmodule.exports = _assertThisInitialized;\nmodule.exports.default = module.exports, module.exports.__esModule = true;\n\n//# sourceURL=././node_modules/@babel/runtime/helpers/assertThisInitialized.js");

/***/ }),

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

/***/ "./node_modules/@babel/runtime/helpers/createSuper.js":
/*!************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/createSuper.js ***!
  \************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

eval("var getPrototypeOf = __webpack_require__(/*! ./getPrototypeOf.js */ \"./node_modules/@babel/runtime/helpers/getPrototypeOf.js\");\n\nvar isNativeReflectConstruct = __webpack_require__(/*! ./isNativeReflectConstruct.js */ \"./node_modules/@babel/runtime/helpers/isNativeReflectConstruct.js\");\n\nvar possibleConstructorReturn = __webpack_require__(/*! ./possibleConstructorReturn.js */ \"./node_modules/@babel/runtime/helpers/possibleConstructorReturn.js\");\n\nfunction _createSuper(Derived) {\n  var hasNativeReflectConstruct = isNativeReflectConstruct();\n  return function _createSuperInternal() {\n    var Super = getPrototypeOf(Derived),\n        result;\n\n    if (hasNativeReflectConstruct) {\n      var NewTarget = getPrototypeOf(this).constructor;\n      result = Reflect.construct(Super, arguments, NewTarget);\n    } else {\n      result = Super.apply(this, arguments);\n    }\n\n    return possibleConstructorReturn(this, result);\n  };\n}\n\nmodule.exports = _createSuper;\nmodule.exports.default = module.exports, module.exports.__esModule = true;\n\n//# sourceURL=././node_modules/@babel/runtime/helpers/createSuper.js");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/defineProperty.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/defineProperty.js ***!
  \***************************************************************/
/***/ ((module) => {

eval("function _defineProperty(obj, key, value) {\n  if (key in obj) {\n    Object.defineProperty(obj, key, {\n      value: value,\n      enumerable: true,\n      configurable: true,\n      writable: true\n    });\n  } else {\n    obj[key] = value;\n  }\n\n  return obj;\n}\n\nmodule.exports = _defineProperty;\nmodule.exports.default = module.exports, module.exports.__esModule = true;\n\n//# sourceURL=././node_modules/@babel/runtime/helpers/defineProperty.js");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/getPrototypeOf.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/getPrototypeOf.js ***!
  \***************************************************************/
/***/ ((module) => {

eval("function _getPrototypeOf(o) {\n  module.exports = _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) {\n    return o.__proto__ || Object.getPrototypeOf(o);\n  };\n  module.exports.default = module.exports, module.exports.__esModule = true;\n  return _getPrototypeOf(o);\n}\n\nmodule.exports = _getPrototypeOf;\nmodule.exports.default = module.exports, module.exports.__esModule = true;\n\n//# sourceURL=././node_modules/@babel/runtime/helpers/getPrototypeOf.js");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/inherits.js":
/*!*********************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/inherits.js ***!
  \*********************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

eval("var setPrototypeOf = __webpack_require__(/*! ./setPrototypeOf.js */ \"./node_modules/@babel/runtime/helpers/setPrototypeOf.js\");\n\nfunction _inherits(subClass, superClass) {\n  if (typeof superClass !== \"function\" && superClass !== null) {\n    throw new TypeError(\"Super expression must either be null or a function\");\n  }\n\n  subClass.prototype = Object.create(superClass && superClass.prototype, {\n    constructor: {\n      value: subClass,\n      writable: true,\n      configurable: true\n    }\n  });\n  if (superClass) setPrototypeOf(subClass, superClass);\n}\n\nmodule.exports = _inherits;\nmodule.exports.default = module.exports, module.exports.__esModule = true;\n\n//# sourceURL=././node_modules/@babel/runtime/helpers/inherits.js");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/interopRequireDefault.js":
/*!**********************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/interopRequireDefault.js ***!
  \**********************************************************************/
/***/ ((module) => {

eval("function _interopRequireDefault(obj) {\n  return obj && obj.__esModule ? obj : {\n    \"default\": obj\n  };\n}\n\nmodule.exports = _interopRequireDefault;\nmodule.exports.default = module.exports, module.exports.__esModule = true;\n\n//# sourceURL=././node_modules/@babel/runtime/helpers/interopRequireDefault.js");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/isNativeReflectConstruct.js":
/*!*************************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/isNativeReflectConstruct.js ***!
  \*************************************************************************/
/***/ ((module) => {

eval("function _isNativeReflectConstruct() {\n  if (typeof Reflect === \"undefined\" || !Reflect.construct) return false;\n  if (Reflect.construct.sham) return false;\n  if (typeof Proxy === \"function\") return true;\n\n  try {\n    Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {}));\n    return true;\n  } catch (e) {\n    return false;\n  }\n}\n\nmodule.exports = _isNativeReflectConstruct;\nmodule.exports.default = module.exports, module.exports.__esModule = true;\n\n//# sourceURL=././node_modules/@babel/runtime/helpers/isNativeReflectConstruct.js");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/iterableToArrayLimit.js":
/*!*********************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/iterableToArrayLimit.js ***!
  \*********************************************************************/
/***/ ((module) => {

eval("function _iterableToArrayLimit(arr, i) {\n  var _i = arr && (typeof Symbol !== \"undefined\" && arr[Symbol.iterator] || arr[\"@@iterator\"]);\n\n  if (_i == null) return;\n  var _arr = [];\n  var _n = true;\n  var _d = false;\n\n  var _s, _e;\n\n  try {\n    for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) {\n      _arr.push(_s.value);\n\n      if (i && _arr.length === i) break;\n    }\n  } catch (err) {\n    _d = true;\n    _e = err;\n  } finally {\n    try {\n      if (!_n && _i[\"return\"] != null) _i[\"return\"]();\n    } finally {\n      if (_d) throw _e;\n    }\n  }\n\n  return _arr;\n}\n\nmodule.exports = _iterableToArrayLimit;\nmodule.exports.default = module.exports, module.exports.__esModule = true;\n\n//# sourceURL=././node_modules/@babel/runtime/helpers/iterableToArrayLimit.js");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/nonIterableRest.js":
/*!****************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/nonIterableRest.js ***!
  \****************************************************************/
/***/ ((module) => {

eval("function _nonIterableRest() {\n  throw new TypeError(\"Invalid attempt to destructure non-iterable instance.\\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.\");\n}\n\nmodule.exports = _nonIterableRest;\nmodule.exports.default = module.exports, module.exports.__esModule = true;\n\n//# sourceURL=././node_modules/@babel/runtime/helpers/nonIterableRest.js");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/possibleConstructorReturn.js":
/*!**************************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/possibleConstructorReturn.js ***!
  \**************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

eval("var _typeof = __webpack_require__(/*! @babel/runtime/helpers/typeof */ \"./node_modules/@babel/runtime/helpers/typeof.js\").default;\n\nvar assertThisInitialized = __webpack_require__(/*! ./assertThisInitialized.js */ \"./node_modules/@babel/runtime/helpers/assertThisInitialized.js\");\n\nfunction _possibleConstructorReturn(self, call) {\n  if (call && (_typeof(call) === \"object\" || typeof call === \"function\")) {\n    return call;\n  }\n\n  return assertThisInitialized(self);\n}\n\nmodule.exports = _possibleConstructorReturn;\nmodule.exports.default = module.exports, module.exports.__esModule = true;\n\n//# sourceURL=././node_modules/@babel/runtime/helpers/possibleConstructorReturn.js");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/setPrototypeOf.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/setPrototypeOf.js ***!
  \***************************************************************/
/***/ ((module) => {

eval("function _setPrototypeOf(o, p) {\n  module.exports = _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) {\n    o.__proto__ = p;\n    return o;\n  };\n\n  module.exports.default = module.exports, module.exports.__esModule = true;\n  return _setPrototypeOf(o, p);\n}\n\nmodule.exports = _setPrototypeOf;\nmodule.exports.default = module.exports, module.exports.__esModule = true;\n\n//# sourceURL=././node_modules/@babel/runtime/helpers/setPrototypeOf.js");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/slicedToArray.js":
/*!**************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/slicedToArray.js ***!
  \**************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

eval("var arrayWithHoles = __webpack_require__(/*! ./arrayWithHoles.js */ \"./node_modules/@babel/runtime/helpers/arrayWithHoles.js\");\n\nvar iterableToArrayLimit = __webpack_require__(/*! ./iterableToArrayLimit.js */ \"./node_modules/@babel/runtime/helpers/iterableToArrayLimit.js\");\n\nvar unsupportedIterableToArray = __webpack_require__(/*! ./unsupportedIterableToArray.js */ \"./node_modules/@babel/runtime/helpers/unsupportedIterableToArray.js\");\n\nvar nonIterableRest = __webpack_require__(/*! ./nonIterableRest.js */ \"./node_modules/@babel/runtime/helpers/nonIterableRest.js\");\n\nfunction _slicedToArray(arr, i) {\n  return arrayWithHoles(arr) || iterableToArrayLimit(arr, i) || unsupportedIterableToArray(arr, i) || nonIterableRest();\n}\n\nmodule.exports = _slicedToArray;\nmodule.exports.default = module.exports, module.exports.__esModule = true;\n\n//# sourceURL=././node_modules/@babel/runtime/helpers/slicedToArray.js");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/typeof.js":
/*!*******************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/typeof.js ***!
  \*******************************************************/
/***/ ((module) => {

eval("function _typeof(obj) {\n  \"@babel/helpers - typeof\";\n\n  if (typeof Symbol === \"function\" && typeof Symbol.iterator === \"symbol\") {\n    module.exports = _typeof = function _typeof(obj) {\n      return typeof obj;\n    };\n\n    module.exports.default = module.exports, module.exports.__esModule = true;\n  } else {\n    module.exports = _typeof = function _typeof(obj) {\n      return obj && typeof Symbol === \"function\" && obj.constructor === Symbol && obj !== Symbol.prototype ? \"symbol\" : typeof obj;\n    };\n\n    module.exports.default = module.exports, module.exports.__esModule = true;\n  }\n\n  return _typeof(obj);\n}\n\nmodule.exports = _typeof;\nmodule.exports.default = module.exports, module.exports.__esModule = true;\n\n//# sourceURL=././node_modules/@babel/runtime/helpers/typeof.js");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/unsupportedIterableToArray.js":
/*!***************************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/unsupportedIterableToArray.js ***!
  \***************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

eval("var arrayLikeToArray = __webpack_require__(/*! ./arrayLikeToArray.js */ \"./node_modules/@babel/runtime/helpers/arrayLikeToArray.js\");\n\nfunction _unsupportedIterableToArray(o, minLen) {\n  if (!o) return;\n  if (typeof o === \"string\") return arrayLikeToArray(o, minLen);\n  var n = Object.prototype.toString.call(o).slice(8, -1);\n  if (n === \"Object\" && o.constructor) n = o.constructor.name;\n  if (n === \"Map\" || n === \"Set\") return Array.from(o);\n  if (n === \"Arguments\" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return arrayLikeToArray(o, minLen);\n}\n\nmodule.exports = _unsupportedIterableToArray;\nmodule.exports.default = module.exports, module.exports.__esModule = true;\n\n//# sourceURL=././node_modules/@babel/runtime/helpers/unsupportedIterableToArray.js");

/***/ }),

/***/ "./assets/dev/js/editor/component.js":
/*!*******************************************!*\
  !*** ./assets/dev/js/editor/component.js ***!
  \*******************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";
eval("\n\nvar _interopRequireDefault = __webpack_require__(/*! @babel/runtime/helpers/interopRequireDefault */ \"./node_modules/@babel/runtime/helpers/interopRequireDefault.js\");\n\nObject.defineProperty(exports, \"__esModule\", ({\n  value: true\n}));\nexports.default = void 0;\n\nvar _classCallCheck2 = _interopRequireDefault(__webpack_require__(/*! @babel/runtime/helpers/classCallCheck */ \"./node_modules/@babel/runtime/helpers/classCallCheck.js\"));\n\nvar _createClass2 = _interopRequireDefault(__webpack_require__(/*! @babel/runtime/helpers/createClass */ \"./node_modules/@babel/runtime/helpers/createClass.js\"));\n\nvar _assertThisInitialized2 = _interopRequireDefault(__webpack_require__(/*! @babel/runtime/helpers/assertThisInitialized */ \"./node_modules/@babel/runtime/helpers/assertThisInitialized.js\"));\n\nvar _inherits2 = _interopRequireDefault(__webpack_require__(/*! @babel/runtime/helpers/inherits */ \"./node_modules/@babel/runtime/helpers/inherits.js\"));\n\nvar _createSuper2 = _interopRequireDefault(__webpack_require__(/*! @babel/runtime/helpers/createSuper */ \"./node_modules/@babel/runtime/helpers/createSuper.js\"));\n\nvar _defineProperty2 = _interopRequireDefault(__webpack_require__(/*! @babel/runtime/helpers/defineProperty */ \"./node_modules/@babel/runtime/helpers/defineProperty.js\"));\n\nvar _controlsHook = _interopRequireDefault(__webpack_require__(/*! ./hooks/ui/controls-hook */ \"./assets/dev/js/editor/hooks/ui/controls-hook.js\"));\n\nvar _default = /*#__PURE__*/function (_$e$modules$Component) {\n  (0, _inherits2[\"default\"])(_default, _$e$modules$Component);\n\n  var _super = (0, _createSuper2[\"default\"])(_default);\n\n  function _default() {\n    var _this;\n\n    (0, _classCallCheck2[\"default\"])(this, _default);\n\n    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {\n      args[_key] = arguments[_key];\n    }\n\n    _this = _super.call.apply(_super, [this].concat(args));\n    (0, _defineProperty2[\"default\"])((0, _assertThisInitialized2[\"default\"])(_this), \"pages\", {});\n    return _this;\n  }\n\n  (0, _createClass2[\"default\"])(_default, [{\n    key: \"getNamespace\",\n    value: function getNamespace() {\n      return 'hello-elementor';\n    }\n  }, {\n    key: \"defaultHooks\",\n    value: function defaultHooks() {\n      return this.importHooks({\n        ControlsHook: _controlsHook[\"default\"]\n      });\n    }\n  }]);\n  return _default;\n}($e.modules.ComponentBase);\n\nexports.default = _default;\n\n//# sourceURL=././assets/dev/js/editor/component.js");

/***/ }),

/***/ "./assets/dev/js/editor/hello-editor.js":
/*!**********************************************!*\
  !*** ./assets/dev/js/editor/hello-editor.js ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

"use strict";
eval("\n\nvar _interopRequireDefault = __webpack_require__(/*! @babel/runtime/helpers/interopRequireDefault */ \"./node_modules/@babel/runtime/helpers/interopRequireDefault.js\");\n\nvar _component = _interopRequireDefault(__webpack_require__(/*! ./component */ \"./assets/dev/js/editor/component.js\"));\n\n$e.components.register(new _component[\"default\"]());\n\n//# sourceURL=././assets/dev/js/editor/hello-editor.js");

/***/ }),

/***/ "./assets/dev/js/editor/hooks/ui/controls-hook.js":
/*!********************************************************!*\
  !*** ./assets/dev/js/editor/hooks/ui/controls-hook.js ***!
  \********************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";
eval("\n\nvar _interopRequireDefault = __webpack_require__(/*! @babel/runtime/helpers/interopRequireDefault */ \"./node_modules/@babel/runtime/helpers/interopRequireDefault.js\");\n\nObject.defineProperty(exports, \"__esModule\", ({\n  value: true\n}));\nexports.default = void 0;\n\nvar _slicedToArray2 = _interopRequireDefault(__webpack_require__(/*! @babel/runtime/helpers/slicedToArray */ \"./node_modules/@babel/runtime/helpers/slicedToArray.js\"));\n\nvar _classCallCheck2 = _interopRequireDefault(__webpack_require__(/*! @babel/runtime/helpers/classCallCheck */ \"./node_modules/@babel/runtime/helpers/classCallCheck.js\"));\n\nvar _createClass2 = _interopRequireDefault(__webpack_require__(/*! @babel/runtime/helpers/createClass */ \"./node_modules/@babel/runtime/helpers/createClass.js\"));\n\nvar _inherits2 = _interopRequireDefault(__webpack_require__(/*! @babel/runtime/helpers/inherits */ \"./node_modules/@babel/runtime/helpers/inherits.js\"));\n\nvar _createSuper2 = _interopRequireDefault(__webpack_require__(/*! @babel/runtime/helpers/createSuper */ \"./node_modules/@babel/runtime/helpers/createSuper.js\"));\n\nvar ControlsHook = /*#__PURE__*/function (_$e$modules$hookUI$Af) {\n  (0, _inherits2[\"default\"])(ControlsHook, _$e$modules$hookUI$Af);\n\n  var _super = (0, _createSuper2[\"default\"])(ControlsHook);\n\n  function ControlsHook() {\n    (0, _classCallCheck2[\"default\"])(this, ControlsHook);\n    return _super.apply(this, arguments);\n  }\n\n  (0, _createClass2[\"default\"])(ControlsHook, [{\n    key: \"getCommand\",\n    value: function getCommand() {\n      // Command to listen.\n      return 'document/elements/settings';\n    }\n  }, {\n    key: \"getId\",\n    value: function getId() {\n      // Unique id for the hook.\n      return 'hello-elementor-editor-controls-handler';\n    }\n    /**\n     * Get Hello Theme Controls\n     *\n     * Returns an object in which the keys are control IDs, and the values are the selectors of the elements that need\n     * to be targeted in the apply() method.\n     *\n     * Example return value:\n     *   {\n     *      hello_elementor_show_logo: '.site-header .site-header-logo',\n     *      hello_elementor_show_menu: '.site-header .site-header-menu',\n     *   }\n     */\n\n  }, {\n    key: \"getHelloThemeControls\",\n    value: function getHelloThemeControls() {\n      var _this = this;\n\n      return {\n        hello_header_logo_display: {\n          selector: '.site-header .site-logo, .site-header .site-title',\n          callback: function callback($element, args) {\n            _this.toggleShowHideClass($element, args.settings.hello_header_logo_display);\n          }\n        },\n        hello_header_menu_display: {\n          selector: '.site-header .site-navigation, .site-header .site-navigation-toggle-holder',\n          callback: function callback($element, args) {\n            _this.toggleShowHideClass($element, args.settings.hello_header_menu_display);\n          }\n        },\n        hello_header_tagline_display: {\n          selector: '.site-header .site-description',\n          callback: function callback($element, args) {\n            _this.toggleShowHideClass($element, args.settings.hello_header_tagline_display);\n          }\n        },\n        hello_header_logo_type: {\n          selector: '.site-header .site-branding',\n          callback: function callback($element, args) {\n            var classPrefix = 'show-',\n                inputOptions = args.container.controls.hello_header_logo_type.options,\n                inputValue = args.settings.hello_header_logo_type;\n\n            _this.toggleLayoutClass($element, classPrefix, inputOptions, inputValue);\n          }\n        },\n        hello_header_layout: {\n          selector: '.site-header',\n          callback: function callback($element, args) {\n            var classPrefix = 'header-',\n                inputOptions = args.container.controls.hello_header_layout.options,\n                inputValue = args.settings.hello_header_layout;\n\n            _this.toggleLayoutClass($element, classPrefix, inputOptions, inputValue);\n          }\n        },\n        hello_header_width: {\n          selector: '.site-header',\n          callback: function callback($element, args) {\n            var classPrefix = 'header-',\n                inputOptions = args.container.controls.hello_header_width.options,\n                inputValue = args.settings.hello_header_width;\n\n            _this.toggleLayoutClass($element, classPrefix, inputOptions, inputValue);\n          }\n        },\n        hello_header_menu_layout: {\n          selector: '.site-header',\n          callback: function callback($element, args) {\n            var classPrefix = 'menu-layout-',\n                inputOptions = args.container.controls.hello_header_menu_layout.options,\n                inputValue = args.settings.hello_header_menu_layout; // No matter what, close the mobile menu\n\n            $element.find('.site-navigation-toggle-holder').removeClass('elementor-active');\n            $element.find('.site-navigation-dropdown').removeClass('show');\n\n            _this.toggleLayoutClass($element, classPrefix, inputOptions, inputValue);\n          }\n        },\n        hello_header_menu_dropdown: {\n          selector: '.site-header',\n          callback: function callback($element, args) {\n            var classPrefix = 'menu-dropdown-',\n                inputOptions = args.container.controls.hello_header_menu_dropdown.options,\n                inputValue = args.settings.hello_header_menu_dropdown;\n\n            _this.toggleLayoutClass($element, classPrefix, inputOptions, inputValue);\n          }\n        },\n        hello_footer_logo_display: {\n          selector: '.site-footer .site-logo, .site-footer .site-title',\n          callback: function callback($element, args) {\n            _this.toggleShowHideClass($element, args.settings.hello_footer_logo_display);\n          }\n        },\n        hello_footer_tagline_display: {\n          selector: '.site-footer .site-description',\n          callback: function callback($element, args) {\n            _this.toggleShowHideClass($element, args.settings.hello_footer_tagline_display);\n          }\n        },\n        hello_footer_menu_display: {\n          selector: '.site-footer .site-navigation',\n          callback: function callback($element, args) {\n            _this.toggleShowHideClass($element, args.settings.hello_footer_menu_display);\n          }\n        },\n        hello_footer_copyright_display: {\n          selector: '.site-footer .copyright',\n          callback: function callback($element, args) {\n            var $footerContainer = $element.closest('#site-footer'),\n                inputValue = args.settings.hello_footer_copyright_display;\n\n            _this.toggleShowHideClass($element, inputValue);\n\n            $footerContainer.toggleClass('footer-has-copyright', 'yes' === inputValue);\n          }\n        },\n        hello_footer_logo_type: {\n          selector: '.site-footer .site-branding',\n          callback: function callback($element, args) {\n            var classPrefix = 'show-',\n                inputOptions = args.container.controls.hello_footer_logo_type.options,\n                inputValue = args.settings.hello_footer_logo_type;\n\n            _this.toggleLayoutClass($element, classPrefix, inputOptions, inputValue);\n          }\n        },\n        hello_footer_layout: {\n          selector: '.site-footer',\n          callback: function callback($element, args) {\n            var classPrefix = 'footer-',\n                inputOptions = args.container.controls.hello_footer_layout.options,\n                inputValue = args.settings.hello_footer_layout;\n\n            _this.toggleLayoutClass($element, classPrefix, inputOptions, inputValue);\n          }\n        },\n        hello_footer_width: {\n          selector: '.site-footer',\n          callback: function callback($element, args) {\n            var classPrefix = 'footer-',\n                inputOptions = args.container.controls.hello_footer_width.options,\n                inputValue = args.settings.hello_footer_width;\n\n            _this.toggleLayoutClass($element, classPrefix, inputOptions, inputValue);\n          }\n        },\n        hello_footer_copyright_text: {\n          selector: '.site-footer .copyright',\n          callback: function callback($element, args) {\n            var inputValue = args.settings.hello_footer_copyright_text;\n            $element.find('p').text(inputValue);\n          }\n        }\n      };\n    }\n    /**\n     * Toggle show and hide classes on containers\n     *\n     * This will remove the .show and .hide clases from the element, then apply the new class\n     *\n     */\n\n  }, {\n    key: \"toggleShowHideClass\",\n    value: function toggleShowHideClass(element, inputValue) {\n      element.removeClass('hide').removeClass('show').addClass(inputValue ? 'show' : 'hide');\n    }\n    /**\n     * Toggle layout classes on containers\n     *\n     * This will cleanly set classes onto which ever container we want to target, removing the old classes and adding the new one\n     *\n     */\n\n  }, {\n    key: \"toggleLayoutClass\",\n    value: function toggleLayoutClass(element, classPrefix, inputOptions, inputValue) {\n      // Loop through the possible classes and remove the one that's not in use\n      Object.entries(inputOptions).forEach(function (_ref) {\n        var _ref2 = (0, _slicedToArray2[\"default\"])(_ref, 1),\n            key = _ref2[0];\n\n        element.removeClass(classPrefix + key);\n      }); // Append the class which we want to use onto the element\n\n      if ('' !== inputValue) {\n        element.addClass(classPrefix + inputValue);\n      }\n    }\n    /**\n     * Set the conditions under which the hook will run.\n     */\n\n  }, {\n    key: \"getConditions\",\n    value: function getConditions(args) {\n      var isKit = 'kit' === elementor.documents.getCurrent().config.type,\n          changedControls = Object.keys(args.settings),\n          isSingleSetting = 1 === changedControls.length; // If the document is not a kit, or there are no changed settings, or there is more than one single changed\n      // setting, don't run the hook.\n\n      if (!isKit || !args.settings || !isSingleSetting) {\n        return false;\n      } // If the changed control is in the list of theme controls, return true to run the hook.\n      // Otherwise, return false so the hook doesn't run.\n\n\n      return !!Object.keys(this.getHelloThemeControls()).includes(changedControls[0]);\n    }\n    /**\n     * The hook logic.\n     */\n\n  }, {\n    key: \"apply\",\n    value: function apply(args) {\n      var allThemeControls = this.getHelloThemeControls(),\n          // Extract the control ID from the passed args\n      controlId = Object.keys(args.settings)[0],\n          controlConfig = allThemeControls[controlId],\n          // Find the element that needs to be targeted by the control.\n      $element = elementor.$previewContents.find(controlConfig.selector);\n      controlConfig.callback($element, args);\n    }\n  }]);\n  return ControlsHook;\n}($e.modules.hookUI.After);\n\nexports.default = ControlsHook;\n\n//# sourceURL=././assets/dev/js/editor/hooks/ui/controls-hook.js");

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
/******/ 	var __webpack_exports__ = __webpack_require__("./assets/dev/js/editor/hello-editor.js");
/******/ 	
/******/ })()
;