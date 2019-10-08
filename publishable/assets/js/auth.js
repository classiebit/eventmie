(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/publishable/assets/js/auth"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/auth/components/AlertComponent.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/auth/components/AlertComponent.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['errors', 'message'],
  methods: {
    showErrors: function showErrors() {
      // show server errors in toast
      Vue.helpers.serverErrors(this.errors);
    },
    showMessage: function showMessage() {
      // show server message in toast
      Vue.helpers.serverMessage(this.message);
    }
  },
  mounted: function mounted() {
    if (this.message != null) this.showMessage();else this.showErrors();
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/auth/components/GdprComponent.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/auth/components/GdprComponent.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  methods: {
    getRoute: function getRoute(url) {
      return route(url).url();
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/auth/components/GdprComponent.vue?vue&type=template&id=574b7884&":
/*!*********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/auth/components/GdprComponent.vue?vue&type=template&id=574b7884& ***!
  \*********************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _vm._v("\n    " + _vm._s(_vm.trans("em.accept_cookie")) + " "),
    _c("a", { attrs: { href: _vm.getRoute("eventmie.privacy") } }, [
      _vm._v(_vm._s(_vm.trans("em.privacy")))
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/auth/components/AlertComponent.vue":
/*!*********************************************************!*\
  !*** ./resources/js/auth/components/AlertComponent.vue ***!
  \*********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _AlertComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AlertComponent.vue?vue&type=script&lang=js& */ "./resources/js/auth/components/AlertComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");
var render, staticRenderFns




/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__["default"])(
  _AlertComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"],
  render,
  staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/auth/components/AlertComponent.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/auth/components/AlertComponent.vue?vue&type=script&lang=js&":
/*!**********************************************************************************!*\
  !*** ./resources/js/auth/components/AlertComponent.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AlertComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./AlertComponent.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/auth/components/AlertComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AlertComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/auth/components/GdprComponent.vue":
/*!********************************************************!*\
  !*** ./resources/js/auth/components/GdprComponent.vue ***!
  \********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _GdprComponent_vue_vue_type_template_id_574b7884___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./GdprComponent.vue?vue&type=template&id=574b7884& */ "./resources/js/auth/components/GdprComponent.vue?vue&type=template&id=574b7884&");
/* harmony import */ var _GdprComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./GdprComponent.vue?vue&type=script&lang=js& */ "./resources/js/auth/components/GdprComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _GdprComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _GdprComponent_vue_vue_type_template_id_574b7884___WEBPACK_IMPORTED_MODULE_0__["render"],
  _GdprComponent_vue_vue_type_template_id_574b7884___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/auth/components/GdprComponent.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/auth/components/GdprComponent.vue?vue&type=script&lang=js&":
/*!*********************************************************************************!*\
  !*** ./resources/js/auth/components/GdprComponent.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GdprComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./GdprComponent.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/auth/components/GdprComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GdprComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/auth/components/GdprComponent.vue?vue&type=template&id=574b7884&":
/*!***************************************************************************************!*\
  !*** ./resources/js/auth/components/GdprComponent.vue?vue&type=template&id=574b7884& ***!
  \***************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GdprComponent_vue_vue_type_template_id_574b7884___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./GdprComponent.vue?vue&type=template&id=574b7884& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/auth/components/GdprComponent.vue?vue&type=template&id=574b7884&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GdprComponent_vue_vue_type_template_id_574b7884___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GdprComponent_vue_vue_type_template_id_574b7884___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/auth/index.js":
/*!************************************!*\
  !*** ./resources/js/auth/index.js ***!
  \************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! lodash */ "./node_modules/lodash/lodash.js");
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(lodash__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _helpers__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../helpers */ "./resources/js/helpers.js");
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/** 
 * This is the default file for auth and gdpr components
 * This file will be included as common vue instance for
 * login purposes
 */
__webpack_require__(/*! ../bootstrap */ "./resources/js/bootstrap.js");

window.Vue = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.common.js");

Vue.use(lodash__WEBPACK_IMPORTED_MODULE_0___default.a);

window.trans = function (string) {
  return _.get(window.i18n, string);
};

Vue.prototype.trans = function (string) {
  return _.get(window.i18n, string);
};

Vue.prototype.base_url = window.base_url; // Vue Global Config

Vue.config.productionTip = true;
Vue.config.devtools = true; // import GDPR 

window.CookieLaw = __webpack_require__(/*! vue-cookie-law */ "./node_modules/vue-cookie-law/dist/vue-cookie-law.js");
Vue.use(CookieLaw); // import custom helpers


var plugin = {
  install: function install() {
    Vue.helpers = _helpers__WEBPACK_IMPORTED_MODULE_1__["default"];
    Vue.prototype.$helpers = _helpers__WEBPACK_IMPORTED_MODULE_1__["default"];
  }
};
Vue.use(plugin); // these are the common components that need to available in all vue instances

Vue.component('gdpr-message', __webpack_require__(/*! ./components/GdprComponent.vue */ "./resources/js/auth/components/GdprComponent.vue")["default"]);
Vue.component('alert-message', __webpack_require__(/*! ./components/AlertComponent.vue */ "./resources/js/auth/components/AlertComponent.vue")["default"]);
/**
 * Init auth instance
 * 
 * CookieLaw component need to be included in only in auth instance
 */

window.auth_app = new Vue({
  el: '#eventmie_auth_app',
  data: function data() {
    return {
      lastScrollTop: 0
    };
  },
  components: {
    CookieLaw: CookieLaw
  },
  methods: {
    handleScroll: function handleScroll() {
      var el = document.getElementById('navbar_vue');
      var st = window.pageYOffset || document.documentElement.scrollTop;

      if (st > this.lastScrollTop) {// scroll down
      } else {// scroll up
        }

      this.lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling

      if (window.scrollY > 50) {
        el.classList.add('menu-onscroll');
      } else {
        el.classList.remove('menu-onscroll');

        if (el.classList.contains('is-active')) {
          el.classList.add('is-mobile');
        }
      }
    },
    mobileMenu: function mobileMenu() {
      var el = document.getElementById('navbar');
      var el2 = document.getElementById('mobile_menu_vue');
      var el3 = document.getElementById('navbar_vue'); // burger button

      if (el.classList.contains('in')) el.classList.remove('in');else el.classList.add('in');
    }
  },
  created: function created() {
    window.addEventListener('scroll', this.handleScroll);
  },
  destroyed: function destroyed() {
    window.removeEventListener('scroll', this.handleScroll);
  },
  mounted: function mounted() {}
});

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/vendor.scss":
/*!************************************!*\
  !*** ./resources/sass/vendor.scss ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************************************************!*\
  !*** multi ./resources/js/auth/index.js ./resources/sass/app.scss ./resources/sass/vendor.scss ***!
  \*************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! D:\Products\Eventmie\Dev\eventmie-lite\eventmie\resources\js\auth\index.js */"./resources/js/auth/index.js");
__webpack_require__(/*! D:\Products\Eventmie\Dev\eventmie-lite\eventmie\resources\sass\app.scss */"./resources/sass/app.scss");
module.exports = __webpack_require__(/*! D:\Products\Eventmie\Dev\eventmie-lite\eventmie\resources\sass\vendor.scss */"./resources/sass/vendor.scss");


/***/ })

},[[0,"/publishable/assets/js/manifest","/publishable/assets/js/vendor"]]]);