(window.webpackJsonp=window.webpackJsonp||[]).push([[34],{"/MXW":function(t,e,a){"use strict";var n=a("tl0y");a.n(n).a},UHEv:function(t,e,a){(t.exports=a("I1BE")(!1)).push([t.i,"#settingsWrapper input[type=text] {\n  width: 384px;\n  margin-top: 12px;\n}\n@media only screen and (max-width: 667px) {\n#settingsWrapper input[type=text] {\n    width: 100%;\n}\n}",""])},tl0y:function(t,e,a){var n=a("UHEv");"string"==typeof n&&(n=[[t.i,n,""]]);var i={hmr:!0,transform:void 0,insertInto:void 0};a("aET+")(n,i);n.locals&&(t.exports=n.locals)},xzKh:function(t,e,a){"use strict";a.r(e);var n=a("JspL"),i=a("c8RX"),s=a("ilaN"),r=a("2Bgu"),o=function(t,e,a,n){return new(a||(a=Promise))((function(i,s){function r(t){try{l(n.next(t))}catch(t){s(t)}}function o(t){try{l(n.throw(t))}catch(t){s(t)}}function l(t){var e;t.done?i(t.value):(e=t.value,e instanceof a?e:new a((function(t){t(e)}))).then(r,o)}l((n=n.apply(t,e||[])).next())}))},l=n.a.extend({components:{Btn:()=>a.e(0).then(a.bind(null,"i0GK"))},data:()=>({state:i.i.state,sharedState:i.j.state}),computed:{shouldWarn(){return!(!this.sharedState.originalMediaPath||!this.state.settings.media_path)&&this.sharedState.originalMediaPath!==this.state.settings.media_path.trim()}},methods:{confirmThenSave(){this.shouldWarn?s.b.confirm("Warning: Changing the media path will essentially remove all existing data – songs, artists,           albums, favorites, everything – and empty your playlists! Sure you want to proceed?",this.save):this.save()},save:()=>o(void 0,void 0,void 0,(function*(){Object(s.x)();try{yield i.i.update(),r.a.go("home"),Object(s.i)()}catch(t){let e="Unknown error.";422===t.response.status&&(e=Object(s.u)(t.response.data)[0]),Object(s.l)(),s.b.error(e)}}))}}),c=(a("/MXW"),a("KHd+")),h=Object(c.a)(l,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("section",{attrs:{id:"settingsWrapper"}},[t._m(0),t._v(" "),a("form",{staticClass:"main-scroll-wrap",on:{submit:function(e){return e.preventDefault(),t.confirmThenSave(e)}}},[a("div",{staticClass:"form-row"},[a("label",{attrs:{for:"inputSettingsPath"}},[t._v("Media Path")]),t._v(" "),t._m(1),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.state.settings.media_path,expression:"state.settings.media_path"}],attrs:{"aria-describedby":"mediaPathHelp",id:"inputSettingsPath",type:"text"},domProps:{value:t.state.settings.media_path},on:{input:function(e){e.target.composing||t.$set(t.state.settings,"media_path",e.target.value)}}})]),t._v(" "),a("div",{staticClass:"form-row"},[a("btn",{attrs:{type:"submit"}},[t._v("Scan")])],1)])])}),[function(){var t=this.$createElement,e=this._self._c||t;return e("h1",{staticClass:"heading"},[e("span",[this._v("Settings")])])},function(){var t=this.$createElement,e=this._self._c||t;return e("p",{staticClass:"help",attrs:{id:"mediaPathHelp"}},[this._v("\n        The "),e("em",[this._v("absolute")]),this._v(" path to the server directory containing your media.\n        Koel will scan this directory for songs and extract any available information."),e("br"),this._v("\n        Scanning may take a while, especially if you have a lot of songs, so be patient.\n      ")])}],!1,null,null,null);e.default=h.exports}}]);