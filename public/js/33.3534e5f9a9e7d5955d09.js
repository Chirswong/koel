(window.webpackJsonp=window.webpackJsonp||[]).push([[33],{"1m//":function(t,e,s){var n=s("h+tx");"string"==typeof n&&(n=[[t.i,n,""]]);var o={hmr:!0,transform:void 0,insertInto:void 0};s("aET+")(n,o);n.locals&&(t.exports=n.locals)},"9AbS":function(t,e,s){"use strict";s.r(e);var n=s("ilaN"),o=s("uhNi"),a=s("c8RX"),l=s("f4RB"),r=s("mF3K"),i=Object(r.a)(l.a).extend({filters:{pluralize:n.v},data:()=>({state:a.h.state}),methods:{getSongsToPlay(){return this.state.songs}},created(){n.f.on({[o.b.LOAD_MAIN_CONTENT]:t=>{"RecentlyPlayed"===t&&a.h.fetchAll()}})}}),c=(s("qa5h"),s("KHd+")),g=Object(c.a)(i,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("section",{attrs:{id:"recentlyPlayedWrapper"}},[s("h1",{staticClass:"heading"},[s("span",[t._v("Recently Played\n      "),s("controls-toggler",{attrs:{"showing-controls":t.showingControls},on:{toggleControls:t.toggleControls}}),t._v(" "),s("span",{directives:[{name:"show",rawName:"v-show",value:t.meta.songCount,expression:"meta.songCount"}],staticClass:"meta"},[t._v("\n        "+t._s(t._f("pluralize")(t.meta.songCount,"song"))+"\n        •\n        "+t._s(t.meta.totalLength)+"\n      ")])],1),t._v(" "),s("song-list-controls",{directives:[{name:"show",rawName:"v-show",value:t.state.songs.length&&(!t.isPhone||t.showingControls),expression:"state.songs.length && (!isPhone || showingControls)"}],attrs:{songs:t.state.songs,config:t.songListControlConfig,selectedSongs:t.selectedSongs},on:{playAll:t.playAll,playSelected:t.playSelected}})],1),t._v(" "),s("song-list",{directives:[{name:"show",rawName:"v-show",value:t.state.songs.length,expression:"state.songs.length"}],attrs:{items:t.state.songs,type:"recently-played",sortable:!1}}),t._v(" "),t.state.songs.length?t._e():s("div",{staticClass:"none"},[t._v("\n    This playlist will be automatically filled with the songs you most recently played, so start playing!\n  ")])],1)}),[],!1,null,null,null);e.default=g.exports},"h+tx":function(t,e,s){(t.exports=s("I1BE")(!1)).push([t.i,"#recentlyPlayedWrapper .none {\n  color: #a0a0a0;\n  padding: 16px 24px;\n}\n#recentlyPlayedWrapper .none a {\n  color: #ff7d2e;\n}",""])},qa5h:function(t,e,s){"use strict";var n=s("1m//");s.n(n).a}}]);