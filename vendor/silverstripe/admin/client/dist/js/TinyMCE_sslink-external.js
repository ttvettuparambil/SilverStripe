!function(e){function n(i){if(t[i])return t[i].exports;var r=t[i]={i:i,l:!1,exports:{}};return e[i].call(r.exports,r,r.exports,n),r.l=!0,r.exports}var t={};n.m=e,n.c=t,n.d=function(e,t,i){n.o(e,t)||Object.defineProperty(e,t,{configurable:!1,enumerable:!0,get:i})},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,n){return Object.prototype.hasOwnProperty.call(e,n)},n.p="",n(n.s="./client/src/legacy/TinyMCE_sslink-external.js")}({"./client/src/legacy/TinyMCE_sslink-external.js":function(e,n,t){"use strict";function i(e){return e&&e.__esModule?e:{default:e}}Object.defineProperty(n,"__esModule",{value:!0});var r=t("i18n"),o=i(r),a=t("lib/TinyMCEActionRegistrar"),l=i(a),s=t("react"),c=i(s),d=t("react-dom"),u=i(d),f=t("jquery"),p=i(f),x=t("containers/InsertLinkModal/InsertLinkModal"),m=t("lib/Injector");l.default.addAction("sslink",{text:o.default._t("Admin.LINKLABEL_EXTERNALURL","Link to external URL"),onclick:function(e){return e.execCommand("sslinkexternal")},priority:70},editorIdentifier);var k={init:function(e){e.addCommand("sslinkexternal",function(){window.jQuery("#"+e.id).entwine("ss").openLinkExternalDialog()})}},g="insert-link__dialog-wrapper--external",y=(0,m.loadComponent)((0,x.createInsertLinkModal)("SilverStripe\\Admin\\LeftAndMain","EditorExternalLink"));p.default.entwine("ss",function(e){e("textarea.htmleditor").entwine({openLinkExternalDialog:function(){var n=e("#"+g);n.length||(n=e('<div id="'+g+'" />'),e("body").append(n)),n.addClass("insert-link__dialog-wrapper"),n.setElement(this),n.open()}}),e("#"+g).entwine({renderModal:function(e){var n=this,t=function(){return n.close()},i=function(){return n.handleInsert.apply(n,arguments)},r=this.getOriginalAttributes(),a=tinymce.activeEditor.selection,l=a.getContent()||"",s=a.getNode().tagName,d="A"!==s&&""===l.trim();u.default.render(c.default.createElement(y,{isOpen:e,onInsert:i,onClosed:t,title:o.default._t("Admin.LINK_EXTERNAL","Insert external link"),bodyClassName:"modal__dialog",className:"insert-link__dialog-wrapper--external",fileAttributes:r,identifier:"Admin.InsertLinkExternalModal",requireLinkText:d}),this[0])},buildAttributes:function(e){var n=this._super(e),t=n.href;return t.match(/:\/\//)||(t=window.location.protocol+"//"+t),t=t.replace(/.*:\/\/(#.*)$/,"$1"),t.match(/:\/\/$/)&&(t=""),n.href=t,n}})}),tinymce.PluginManager.add("sslinkexternal",function(e){return k.init(e)}),n.default=k},"containers/InsertLinkModal/InsertLinkModal":function(e,n){e.exports=InsertLinkModal},i18n:function(e,n){e.exports=i18n},jquery:function(e,n){e.exports=jQuery},"lib/Injector":function(e,n){e.exports=Injector},"lib/TinyMCEActionRegistrar":function(e,n){e.exports=TinyMCEActionRegistrar},react:function(e,n){e.exports=React},"react-dom":function(e,n){e.exports=ReactDom}});