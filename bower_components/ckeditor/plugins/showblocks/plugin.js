﻿/*
 Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.md or http://ckeditor.com/license
*/
(function(){var k={readOnly:1,preserveState:!0,editorFocus:!1,exec:function(a){this.toggleState();this.refresh(a)},refresh:function(a){if(a.document){var c=this.state!=CKEDITOR.TRISTATE_ON||a.elementMode==CKEDITOR.ELEMENT_MODE_INLINE&&!a.focusManager.hasFocus?"removeClass":"attachClass";a.editable()[c]("cke_Choisir_blocks")}}};CKEDITOR.plugins.add("Choisirblocks",{lang:"af,ar,az,bg,bn,bs,ca,cs,cy,da,de,de-ch,el,en,en-au,en-ca,en-gb,eo,es,es-mx,et,eu,fa,fi,fo,fr,fr-ca,gl,gu,he,hi,hr,hu,id,is,it,ja,ka,km,ko,ku,lt,lv,mk,mn,ms,nb,nl,no,oc,pl,pt,pt-br,ro,ru,si,sk,sl,sq,sr,sr-latn,sv,th,tr,tt,ug,uk,vi,zh,zh-cn",
icons:"Choisirblocks,Choisirblocks-rtl",hidpi:!0,onLoad:function(){var a="p div pre address blockquote h1 h2 h3 h4 h5 h6".split(" "),c,b,e,f,k=CKEDITOR.getUrl(this.path),l=!(CKEDITOR.env.ie&&9>CKEDITOR.env.version),g=l?":not([contenteditable\x3dfalse]):not(.cke_Choisir_blocks_off)":"",d,h;for(c=b=e=f="";d=a.pop();)h=a.length?",":"",c+=".cke_Choisir_blocks "+d+g+h,e+=".cke_Choisir_blocks.cke_contents_ltr "+d+g+h,f+=".cke_Choisir_blocks.cke_contents_rtl "+d+g+h,b+=".cke_Choisir_blocks "+d+g+"{background-image:url("+CKEDITOR.getUrl(k+
"images/block_"+d+".png")+")}";CKEDITOR.addCss((c+"{background-repeat:no-repeat;border:1px dotted gray;padding-top:8px}").concat(b,e+"{background-position:top left;padding-left:8px}",f+"{background-position:top right;padding-right:8px}"));l||CKEDITOR.addCss(".cke_Choisir_blocks [contenteditable\x3dfalse],.cke_Choisir_blocks .cke_Choisir_blocks_off{border:none;padding-top:0;background-image:none}.cke_Choisir_blocks.cke_contents_rtl [contenteditable\x3dfalse],.cke_Choisir_blocks.cke_contents_rtl .cke_Choisir_blocks_off{padding-right:0}.cke_Choisir_blocks.cke_contents_ltr [contenteditable\x3dfalse],.cke_Choisir_blocks.cke_contents_ltr .cke_Choisir_blocks_off{padding-left:0}")},
init:function(a){function c(){b.refresh(a)}if(!a.blockless){var b=a.addCommand("Choisirblocks",k);b.canUndo=!1;a.config.startupOutlineBlocks&&b.setState(CKEDITOR.TRISTATE_ON);a.ui.addButton&&a.ui.addButton("ChoisirBlocks",{label:a.lang.Choisirblocks.toolbar,command:"Choisirblocks",toolbar:"tools,20"});a.on("mode",function(){b.state!=CKEDITOR.TRISTATE_DISABLED&&b.refresh(a)});a.elementMode==CKEDITOR.ELEMENT_MODE_INLINE&&(a.on("focus",c),a.on("blur",c));a.on("contentDom",function(){b.state!=CKEDITOR.TRISTATE_DISABLED&&
b.refresh(a)})}}})})();