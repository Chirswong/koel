(window.webpackJsonp=window.webpackJsonp||[]).push([[37],{AJU9:function(n,t,e){"use strict";var a=e("W7DU");e.n(a).a},IVyl:function(n,t,e){"use strict";e.r(t);var a=e("ilaN"),o=e("uhNi"),s=e("c8RX"),i=e("OUsP"),l=e("JspL").a.extend({props:{song:{type:Object,required:!0},topPlayCount:{type:Number,default:0}},filters:{pluralize:a.v},computed:{showPlayCount(){return Boolean(this.topPlayCount&&this.song.playCount)}},methods:{requestContextMenu(n){a.f.emit(o.b.CONTEXT_MENU_REQUESTED,n,this.song)},play(){s.g.contains(this.song)||s.g.queueAfterCurrent(this.song),i.h.play(this.song)},changeSongState(){"Stopped"===this.song.playbackState?this.play():"Paused"===this.song.playbackState?i.h.resume():i.h.pause()},dragStart(n){Object(a.y)(n,this.song,"Song")}}}),r=(e("AJU9"),e("KHd+")),c=Object(r.a)(l,(function(){var n=this,t=n.$createElement,e=n._self._c||t;return e("li",{staticClass:"song-item-home",class:{playing:"Playing"===n.song.playbackState||"Paused"===n.song.playbackState},attrs:{draggable:"true",tabindex:"0"},on:{contextmenu:function(t){return t.preventDefault(),n.requestContextMenu(t)},dblclick:function(t){return t.preventDefault(),n.play(t)},dragstart:n.dragStart}},[e("span",{staticClass:"cover",style:{backgroundImage:"url("+n.song.album.cover+")"}},[e("a",{staticClass:"control",on:{click:function(t){return t.preventDefault(),n.changeSongState(t)}}},["Playing"!==n.song.playbackState?e("i",{staticClass:"fa fa-play"}):e("i",{staticClass:"fa fa-pause"})])]),n._v(" "),e("span",{staticClass:"details"},[n.showPlayCount?e("span",{staticClass:"play-count",style:{width:100*n.song.playCount/n.topPlayCount+"%"}}):n._e(),n._v("\n    "+n._s(n.song.title)+"\n    "),e("span",{staticClass:"by"},[e("a",{attrs:{href:"#!/artist/"+n.song.artist.id}},[n._v(n._s(n.song.artist.name))]),n._v(" "),n.showPlayCount?[n._v("- "+n._s(n._f("pluralize")(n.song.playCount,"play")))]:n._e()],2)])])}),[],!1,null,"872fa988",null);t.default=c.exports},W7DU:function(n,t,e){var a=e("n/yz");"string"==typeof a&&(a=[[n.i,a,""]]);var o={hmr:!0,transform:void 0,insertInto:void 0};e("aET+")(a,o);a.locals&&(n.exports=a.locals)},"n/yz":function(n,t,e){(n.exports=e("I1BE")(!1)).push([n.i,'.song-item-home[data-v-872fa988] {\n  display: flex;\n  margin-bottom: 8px;\n}\n.song-item-home.playing[data-v-872fa988] {\n  color: #ff7d2e;\n}\n.song-item-home:hover .cover .control[data-v-872fa988], .song-item-home:focus .cover .control[data-v-872fa988] {\n  display: block;\n}\n.song-item-home:hover .cover[data-v-872fa988]::before, .song-item-home:focus .cover[data-v-872fa988]::before {\n  opacity: 0.7;\n}\n.song-item-home .cover[data-v-872fa988] {\n  flex: 0 0 48px;\n  height: 48px;\n  background-size: cover;\n  position: relative;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n.song-item-home .cover[data-v-872fa988]::before {\n  content: " ";\n  position: absolute;\n  top: 0;\n  left: 0;\n  width: 100%;\n  height: 100%;\n  pointer-events: none;\n  background: #000;\n  opacity: 0;\n}\nhtml.touchevents .song-item-home .cover[data-v-872fa988]::before {\n  opacity: 0.7;\n}\n.song-item-home .cover .control[data-v-872fa988] {\n  border-radius: 50%;\n  width: 28px;\n  height: 28px;\n  background: rgba(0, 0, 0, 0.7);\n  line-height: 2rem;\n  font-size: 1rem;\n  text-align: center;\n  z-index: 1;\n  display: none;\n  color: #fff;\n  transition: 0.3s;\n}\nhtml.touchevents .song-item-home .cover .control[data-v-872fa988] {\n  display: block;\n}\n.song-item-home .details[data-v-872fa988] {\n  flex: 1;\n  padding: 4px 8px;\n  position: relative;\n  display: flex;\n  flex-direction: column;\n  justify-content: center;\n}\n.song-item-home .details .play-count[data-v-872fa988] {\n  background: rgba(255, 255, 255, 0.08);\n  position: absolute;\n  height: 100%;\n  top: 0;\n  left: 0;\n  pointer-events: none;\n}\n.song-item-home .details .by[data-v-872fa988] {\n  display: block;\n  font-size: 0.9rem;\n  margin-top: 2px;\n  color: #a0a0a0;\n  opacity: 0.8;\n}\n.song-item-home .details .by a[data-v-872fa988] {\n  color: #fff;\n}\n.song-item-home .details .by a[data-v-872fa988]:hover {\n  color: #ff7d2e;\n}',""])}}]);