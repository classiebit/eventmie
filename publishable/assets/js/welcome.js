(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/publishable/assets/js/welcome"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/welcome/components/BannerSlider.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/welcome/components/BannerSlider.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue_carousel__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue-carousel */ "./node_modules/vue-carousel/dist/vue-carousel.min.js");
/* harmony import */ var vue_carousel__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue_carousel__WEBPACK_IMPORTED_MODULE_0__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

Vue.prototype.base_url = window.base_url;
/* harmony default export */ __webpack_exports__["default"] = ({
  components: {
    Carousel: vue_carousel__WEBPACK_IMPORTED_MODULE_0__["Carousel"],
    Slide: vue_carousel__WEBPACK_IMPORTED_MODULE_0__["Slide"]
  },
  props: ['banners', 'is_logged', 'is_customer', 'is_admin', 'demo_mode'],
  methods: {
    // return route with event slug
    getRoute: function getRoute(name) {
      return route(name);
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/welcome/components/BannerSlider.vue?vue&type=template&id=16e6452a&":
/*!***********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/welcome/components/BannerSlider.vue?vue&type=template&id=16e6452a& ***!
  \***********************************************************************************************************************************************************************************************************************/
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
  return _c(
    "carousel",
    {
      attrs: {
        autoplay: true,
        autoplayTimeout: 5000,
        scrollPerPage: false,
        perPage: 1,
        paginationEnabled: false
      }
    },
    _vm._l(_vm.banners, function(item, index) {
      return _c(
        "slide",
        {
          key: index,
          class: "lgx-item-common",
          attrs: { item: item, index: index }
        },
        [
          _c("div", { staticClass: "slider-text-single" }, [
            _c("figure", [
              _c("img", { attrs: { src: "/storage/" + item.image, alt: "" } }),
              _vm._v(" "),
              _c("figcaption", [
                _c("div", { staticClass: "lgx-container" }, [
                  _c("div", { staticClass: "lgx-hover-link" }, [
                    _c("div", { staticClass: "lgx-vertical" }, [
                      _c("div", { staticClass: "lgx-banner-info" }, [
                        _c(
                          "h3",
                          { staticClass: "subtitle lgx-delay lgx-fadeInDown" },
                          [_vm._v(_vm._s(item.subtitle))]
                        ),
                        _vm._v(" "),
                        _c(
                          "h2",
                          { staticClass: "title lgx-delay lgx-fadeInDown" },
                          [_vm._v(_vm._s(item.title))]
                        ),
                        _vm._v(" "),
                        _c("div", { staticClass: "action-area" }, [
                          _vm.demo_mode
                            ? _c("div", { staticClass: "lgx-video-area" }, [
                                _c(
                                  "a",
                                  {
                                    staticClass: "lgx-btn lgx-btn-white",
                                    attrs: {
                                      target: "_blank",
                                      href: "https://classiebit.com/eventmie"
                                    }
                                  },
                                  [
                                    _c("i", {
                                      staticClass: "fas fa-cloud-download-alt"
                                    }),
                                    _vm._v(" Download FREE ")
                                  ]
                                ),
                                _vm._v(" "),
                                _c(
                                  "a",
                                  {
                                    staticClass: "lgx-btn lgx-btn-success",
                                    attrs: {
                                      target: "_blank",
                                      href:
                                        "https://classiebit.com/eventmie-pro"
                                    }
                                  },
                                  [
                                    _c("i", {
                                      staticClass: "fas fa-shopping-cart"
                                    }),
                                    _vm._v(" Purchase PRO ")
                                  ]
                                ),
                                _vm._v(" "),
                                _c(
                                  "a",
                                  {
                                    staticClass: "lgx-btn lgx-btn-white",
                                    attrs: {
                                      target: "_blank",
                                      href:
                                        "https://eventmie-docs.classiebit.com"
                                    }
                                  },
                                  [
                                    _c("i", { staticClass: "fas fa-book" }),
                                    _vm._v(" Docs ")
                                  ]
                                )
                              ])
                            : _c("div", { staticClass: "lgx-video-area" }, [
                                _c(
                                  "a",
                                  {
                                    staticClass: "lgx-btn lgx-btn-red",
                                    attrs: {
                                      href: _vm.getRoute(
                                        "eventmie.events_index"
                                      )
                                    }
                                  },
                                  [
                                    _c("i", {
                                      staticClass: "fas fa-calendar-day"
                                    }),
                                    _vm._v(
                                      " " +
                                        _vm._s(_vm.trans("em.browse")) +
                                        " " +
                                        _vm._s(_vm.trans("em.events"))
                                    )
                                  ]
                                ),
                                _vm._v(" "),
                                !_vm.is_logged
                                  ? _c(
                                      "a",
                                      {
                                        staticClass: "lgx-btn",
                                        attrs: {
                                          href: _vm.getRoute(
                                            "eventmie.register"
                                          )
                                        }
                                      },
                                      [
                                        _c("i", {
                                          staticClass: "fas fa-door-open"
                                        }),
                                        _vm._v(
                                          " " +
                                            _vm._s(_vm.trans("em.register")) +
                                            "\n                                            "
                                        )
                                      ]
                                    )
                                  : _vm._e(),
                                _vm._v(" "),
                                _vm.is_logged && _vm.is_admin
                                  ? _c(
                                      "a",
                                      {
                                        staticClass: "lgx-btn",
                                        attrs: {
                                          href: _vm.getRoute(
                                            "eventmie.myevents_form"
                                          )
                                        }
                                      },
                                      [
                                        _c("i", {
                                          staticClass: "fas fa-calendar-plus"
                                        }),
                                        _vm._v(
                                          " " +
                                            _vm._s(_vm.trans("em.create")) +
                                            " " +
                                            _vm._s(_vm.trans("em.event")) +
                                            "\n                                            "
                                        )
                                      ]
                                    )
                                  : _vm._e()
                              ])
                        ])
                      ])
                    ])
                  ])
                ])
              ])
            ])
          ])
        ]
      )
    }),
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/welcome/components/BannerSlider.vue":
/*!**********************************************************!*\
  !*** ./resources/js/welcome/components/BannerSlider.vue ***!
  \**********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _BannerSlider_vue_vue_type_template_id_16e6452a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./BannerSlider.vue?vue&type=template&id=16e6452a& */ "./resources/js/welcome/components/BannerSlider.vue?vue&type=template&id=16e6452a&");
/* harmony import */ var _BannerSlider_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./BannerSlider.vue?vue&type=script&lang=js& */ "./resources/js/welcome/components/BannerSlider.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _BannerSlider_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _BannerSlider_vue_vue_type_template_id_16e6452a___WEBPACK_IMPORTED_MODULE_0__["render"],
  _BannerSlider_vue_vue_type_template_id_16e6452a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/welcome/components/BannerSlider.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/welcome/components/BannerSlider.vue?vue&type=script&lang=js&":
/*!***********************************************************************************!*\
  !*** ./resources/js/welcome/components/BannerSlider.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_BannerSlider_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./BannerSlider.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/welcome/components/BannerSlider.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_BannerSlider_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/welcome/components/BannerSlider.vue?vue&type=template&id=16e6452a&":
/*!*****************************************************************************************!*\
  !*** ./resources/js/welcome/components/BannerSlider.vue?vue&type=template&id=16e6452a& ***!
  \*****************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_BannerSlider_vue_vue_type_template_id_16e6452a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./BannerSlider.vue?vue&type=template&id=16e6452a& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/welcome/components/BannerSlider.vue?vue&type=template&id=16e6452a&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_BannerSlider_vue_vue_type_template_id_16e6452a___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_BannerSlider_vue_vue_type_template_id_16e6452a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/welcome/index.js":
/*!***************************************!*\
  !*** ./resources/js/welcome/index.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * This is a page specific seperate vue instance initializer
 */
// include vue common libraries, plugins and components
__webpack_require__(/*! ../vue_common */ "./resources/js/vue_common.js");
/**
 * Below are the page specific plugins and components
  */
// for using time


window.moment = __webpack_require__(/*! moment-timezone */ "./node_modules/moment-timezone/index.js"); // Image slider

window.VueCarousel = __webpack_require__(/*! vue-carousel */ "./node_modules/vue-carousel/dist/vue-carousel.min.js");
Vue.use(VueCarousel);
Vue.component('event-listing', __webpack_require__(/*! ../common_components/EventListing */ "./resources/js/common_components/EventListing.vue")["default"]);
Vue.component('banner-slider', __webpack_require__(/*! ./components/BannerSlider */ "./resources/js/welcome/components/BannerSlider.vue")["default"]);
/**
 * This is where we finally create a page specific
 * vue instance with required configs
 * element=app will remain common for all vue instances
 *
 * make sure to use window.app to make new Vue instance
 * so that we can access vue instance from anywhere
 * e.g interceptors 
 */

window.app = new Vue({
  el: '#eventmie_app'
});

/***/ }),

/***/ 5:
/*!*********************************************!*\
  !*** multi ./resources/js/welcome/index.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\Products\Eventmie\Dev\eventmie-lite\eventmie\resources\js\welcome\index.js */"./resources/js/welcome/index.js");


/***/ })

},[[5,"/publishable/assets/js/manifest","/publishable/assets/js/vendor"]]]);