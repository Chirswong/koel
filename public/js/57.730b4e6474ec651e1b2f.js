(window.webpackJsonp=window.webpackJsonp||[]).push([[57],{"C+sE":function(e,t,a){"use strict";a.r(t);var s=a("c8RX"),i=a("JspL"),n=function(e,t,a,s){return new(a||(a=Promise))((function(i,n){function r(e){try{o(s.next(e))}catch(e){n(e)}}function d(e){try{o(s.throw(e))}catch(e){n(e)}}function o(e){var t;e.done?i(e.value):(t=e.value,t instanceof a?t:new a((function(e){e(t)}))).then(r,d)}o((s=s.apply(e,t||[])).next())}))},r=i.a.extend({components:{Btn:()=>a.e(0).then(a.bind(null,"i0GK")),SoundBar:()=>a.e(1).then(a.bind(null,"yt5i"))},props:{user:{type:Object,required:!0}},data:()=>({loading:!1,mutatedUser:null}),methods:{submit(){return n(this,void 0,void 0,(function*(){this.loading=!0,yield s.l.update(this.user,this.mutatedUser.name,this.mutatedUser.email,this.mutatedUser.password,this.mutatedUser.is_admin),this.loading=!1,this.close()}))},close(){this.$emit("close")}},created(){this.mutatedUser=Object.assign({},this.user)}}),d=a("KHd+"),o=Object(d.a)(r,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"edit-user"},[e.loading?a("sound-bar"):a("form",{staticClass:"user-edit",on:{submit:function(t){return t.preventDefault(),e.submit(t)}}},[a("header",[a("h1",[e._v("Edit User")])]),e._v(" "),a("div",[a("div",{staticClass:"form-row"},[a("label",[e._v("Name")]),e._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:e.mutatedUser.name,expression:"mutatedUser.name"},{name:"koel-focus",rawName:"v-koel-focus"}],attrs:{title:"Name",type:"text",name:"name",required:""},domProps:{value:e.mutatedUser.name},on:{input:function(t){t.target.composing||e.$set(e.mutatedUser,"name",t.target.value)}}})]),e._v(" "),a("div",{staticClass:"form-row"},[a("label",[e._v("Email")]),e._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:e.mutatedUser.email,expression:"mutatedUser.email"}],attrs:{title:"Email",type:"email",name:"email",required:""},domProps:{value:e.mutatedUser.email},on:{input:function(t){t.target.composing||e.$set(e.mutatedUser,"email",t.target.value)}}})]),e._v(" "),a("div",{staticClass:"form-row"},[a("label",[e._v("Password")]),e._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:e.mutatedUser.password,expression:"mutatedUser.password"}],attrs:{name:"password",placeholder:"Leave blank for no changes",type:"password"},domProps:{value:e.mutatedUser.password},on:{input:function(t){t.target.composing||e.$set(e.mutatedUser,"password",t.target.value)}}})]),e._v(" "),a("div",{staticClass:"form-row"},[a("label",[a("input",{directives:[{name:"model",rawName:"v-model",value:e.mutatedUser.is_admin,expression:"mutatedUser.is_admin"}],attrs:{type:"checkbox",name:"is_admin"},domProps:{checked:Array.isArray(e.mutatedUser.is_admin)?e._i(e.mutatedUser.is_admin,null)>-1:e.mutatedUser.is_admin},on:{change:function(t){var a=e.mutatedUser.is_admin,s=t.target,i=!!s.checked;if(Array.isArray(a)){var n=e._i(a,null);s.checked?n<0&&e.$set(e.mutatedUser,"is_admin",a.concat([null])):n>-1&&e.$set(e.mutatedUser,"is_admin",a.slice(0,n).concat(a.slice(n+1)))}else e.$set(e.mutatedUser,"is_admin",i)}}}),e._v(" User is an admin\n          "),a("i",{staticClass:"fa fa-question-circle help-trigger",attrs:{title:"Admins can perform administrative tasks like manage users and upload songs."}})])])]),e._v(" "),a("footer",[a("btn",{staticClass:"btn-update",attrs:{type:"submit"}},[e._v("Update")]),e._v(" "),a("btn",{staticClass:"btn-cancel",attrs:{white:""},on:{click:function(t){return t.preventDefault(),e.close(t)}}},[e._v("Cancel")])],1)])],1)}),[],!1,null,null,null);t.default=o.exports}}]);