/**
 * i18n - Javascript Internationalization System
 *
 * @author Platform Team
 */

(function() {
    var $i18n = {

        /**
         * Messages
         * @var array
         * {
         *     'DOMAIN NAME' : {
         *         'KEY NAME' : 'value',
         *         'KEY NAME(Plurals) : ['value', 'value', ...]
         *         ...
         *     },
         *     ...
         * }
         */
        _lang : {},

        /**
         * Plurals Expressions
         * @var array
         * {
         *     'DOMAIN NAME' : function(n) {
         *         expressions
         *     },
         *     ...
         * }
         */
        _pluralsExp : {},

        /**
         * Current Domain
         * @var string
         */
        _currDomain : false,

        /**
         * override the current domain for a single message lookup
         *
         * @param string domain
         * @param string key
         * @return string
         */
        __d : function(domain, key, __idx__) {

            var t = $i18n._lang;

            if ($i18n._isEmpty(t) === true) {
                return key;
            }

            if (typeof t[domain] == 'undefined') {
                return key;
            }

            if (typeof t[domain][key] == 'undefined') {
                return key;
            }

            if (typeof t[domain][key] == 'object') {
                __idx__ = __idx__ ? __idx__ : 0;
                return t[domain][key][__idx__];
            }

            return t[domain][key];

        },

        /**
         * Plural version of __d
         *
         * @param string domain
         * @param string key1
         * @param string key2
         * @param int cnt
         * @return string
         */
        __dn : function(domain, key1, key2, cnt) {

            var n = parseInt(cnt);
            var idx = $i18n._getPluralsIndex(domain, n);

            if (idx == 0) {
                return $i18n.__d(domain, key1, 0);
            } else {
                return $i18n.__d(domain, key2, idx);
            }
        },

        _init : function() {
            $i18n._pluralsExp.__reserved_default_exp__ = function(n) {
                return n == 1 ? 0 : 1;
            };

            window['__d'] = function(domain, key) {
                return $i18n.__d(domain, key, 0);
            };

            window['__dn'] = function(domain, key1, key2, cnt) {
                return $i18n.__dn(domain, key1, key2, cnt);
            };

            window['__'] = function(key) {
                return $i18n.__d($i18n._currDomain, key, 0);
            };

            window['__n'] = function(key1, key2, cnt) {
                return $i18n.__dn($i18n._currDomain, key1, key2, cnt);
            };

            window['__i18n_regist__']           = this._regist;
            window['__i18n_bind__']             = this._bind;
            window['__i18n_plurals_exp_bind__'] = this._pluralsExpBind;
        },

        _isEmpty : function(val) {

            if (!val) return true;
            if (val == null) return true;
            if (val == undefined) return true;
            if (val == '') return true;
            if (typeof val == 'object') {
                for (var i in val) {
                    return false;
                }

                return true;
            }

            return false;

        },

        _trim : function(str) {
            if(typeof str != 'string') return '';

            return str.replace(/(^\s*)|(\s*$)/g, '');
        },

        _apply : function(method, func) {

            this[method] = func;

        },

        _regist : function(lang) {

            if (typeof lang != 'object') return false;

            $i18n._lang = lang;

            return true;

        },

        _bind : function(domain) {

            if ($i18n._isEmpty(domain) === true) return false;

            $i18n._currDomain = domain;

            return true;

        },

        _pluralsExpBind : function(domain, exp) {
            if (typeof exp != 'function') {
                return;
            }

            $i18n._pluralsExp[domain] = exp;
        },

        _getPluralsIndex : function(domain, n) {
            if (typeof $i18n._pluralsExp[domain] == 'undefined') {
                return $i18n._pluralsExp.__reserved_default_exp__(n);
            }

            return $i18n._pluralsExp[domain](n);
        }
    };

    $i18n._init();
})();
__i18n_regist__({"front":{"__VERSION__":"201"}});__i18n_bind__("front");
/*!
 * jQuery JavaScript Library v1.4.4
 * http://jquery.com/
 *
 * Copyright 2010, John Resig
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * Includes Sizzle.js
 * http://sizzlejs.com/
 * Copyright 2010, The Dojo Foundation
 * Released under the MIT, BSD, and GPL Licenses.
 *
 * Date: Thu Nov 11 19:04:53 2010 -0500
 */
(function(E,B){function ka(a,b,d){if(d===B&&a.nodeType===1){d=a.getAttribute("data-"+b);if(typeof d==="string"){try{d=d==="true"?true:d==="false"?false:d==="null"?null:!c.isNaN(d)?parseFloat(d):Ja.test(d)?c.parseJSON(d):d}catch(e){}c.data(a,b,d)}else d=B}return d}function U(){return false}function ca(){return true}function la(a,b,d){d[0].type=a;return c.event.handle.apply(b,d)}function Ka(a){var b,d,e,f,h,l,k,o,x,r,A,C=[];f=[];h=c.data(this,this.nodeType?"events":"__events__");if(typeof h==="function")h=
h.events;if(!(a.liveFired===this||!h||!h.live||a.button&&a.type==="click")){if(a.namespace)A=RegExp("(^|\\.)"+a.namespace.split(".").join("\\.(?:.*\\.)?")+"(\\.|$)");a.liveFired=this;var J=h.live.slice(0);for(k=0;k<J.length;k++){h=J[k];h.origType.replace(X,"")===a.type?f.push(h.selector):J.splice(k--,1)}f=c(a.target).closest(f,a.currentTarget);o=0;for(x=f.length;o<x;o++){r=f[o];for(k=0;k<J.length;k++){h=J[k];if(r.selector===h.selector&&(!A||A.test(h.namespace))){l=r.elem;e=null;if(h.preType==="mouseenter"||
h.preType==="mouseleave"){a.type=h.preType;e=c(a.relatedTarget).closest(h.selector)[0]}if(!e||e!==l)C.push({elem:l,handleObj:h,level:r.level})}}}o=0;for(x=C.length;o<x;o++){f=C[o];if(d&&f.level>d)break;a.currentTarget=f.elem;a.data=f.handleObj.data;a.handleObj=f.handleObj;A=f.handleObj.origHandler.apply(f.elem,arguments);if(A===false||a.isPropagationStopped()){d=f.level;if(A===false)b=false;if(a.isImmediatePropagationStopped())break}}return b}}function Y(a,b){return(a&&a!=="*"?a+".":"")+b.replace(La,
"`").replace(Ma,"&")}function ma(a,b,d){if(c.isFunction(b))return c.grep(a,function(f,h){return!!b.call(f,h,f)===d});else if(b.nodeType)return c.grep(a,function(f){return f===b===d});else if(typeof b==="string"){var e=c.grep(a,function(f){return f.nodeType===1});if(Na.test(b))return c.filter(b,e,!d);else b=c.filter(b,e)}return c.grep(a,function(f){return c.inArray(f,b)>=0===d})}function na(a,b){var d=0;b.each(function(){if(this.nodeName===(a[d]&&a[d].nodeName)){var e=c.data(a[d++]),f=c.data(this,
e);if(e=e&&e.events){delete f.handle;f.events={};for(var h in e)for(var l in e[h])c.event.add(this,h,e[h][l],e[h][l].data)}}})}function Oa(a,b){b.src?c.ajax({url:b.src,async:false,dataType:"script"}):c.globalEval(b.text||b.textContent||b.innerHTML||"");b.parentNode&&b.parentNode.removeChild(b)}function oa(a,b,d){var e=b==="width"?a.offsetWidth:a.offsetHeight;if(d==="border")return e;c.each(b==="width"?Pa:Qa,function(){d||(e-=parseFloat(c.css(a,"padding"+this))||0);if(d==="margin")e+=parseFloat(c.css(a,
"margin"+this))||0;else e-=parseFloat(c.css(a,"border"+this+"Width"))||0});return e}function da(a,b,d,e){if(c.isArray(b)&&b.length)c.each(b,function(f,h){d||Ra.test(a)?e(a,h):da(a+"["+(typeof h==="object"||c.isArray(h)?f:"")+"]",h,d,e)});else if(!d&&b!=null&&typeof b==="object")c.isEmptyObject(b)?e(a,""):c.each(b,function(f,h){da(a+"["+f+"]",h,d,e)});else e(a,b)}function S(a,b){var d={};c.each(pa.concat.apply([],pa.slice(0,b)),function(){d[this]=a});return d}function qa(a){if(!ea[a]){var b=c("<"+
a+">").appendTo("body"),d=b.css("display");b.remove();if(d==="none"||d==="")d="block";ea[a]=d}return ea[a]}function fa(a){return c.isWindow(a)?a:a.nodeType===9?a.defaultView||a.parentWindow:false}var t=E.document,c=function(){function a(){if(!b.isReady){try{t.documentElement.doScroll("left")}catch(j){setTimeout(a,1);return}b.ready()}}var b=function(j,s){return new b.fn.init(j,s)},d=E.jQuery,e=E.$,f,h=/^(?:[^#<]*(<[\w\W]+>)[^>]*$|#([\w\-]+)$)/,l=/\S/,k=/^\s+/,o=/\s+$/,x=/\W/,r=/\d/,A=/^<(\w+)\s*\/?>(?:<\/\1>)?$/,
C=/^[\],:{}\s]*$/,J=/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,w=/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,I=/(?:^|:|,)(?:\s*\[)+/g,L=/(webkit)[ \/]([\w.]+)/,g=/(opera)(?:.*version)?[ \/]([\w.]+)/,i=/(msie) ([\w.]+)/,n=/(mozilla)(?:.*? rv:([\w.]+))?/,m=navigator.userAgent,p=false,q=[],u,y=Object.prototype.toString,F=Object.prototype.hasOwnProperty,M=Array.prototype.push,N=Array.prototype.slice,O=String.prototype.trim,D=Array.prototype.indexOf,R={};b.fn=b.prototype={init:function(j,
s){var v,z,H;if(!j)return this;if(j.nodeType){this.context=this[0]=j;this.length=1;return this}if(j==="body"&&!s&&t.body){this.context=t;this[0]=t.body;this.selector="body";this.length=1;return this}if(typeof j==="string")if((v=h.exec(j))&&(v[1]||!s))if(v[1]){H=s?s.ownerDocument||s:t;if(z=A.exec(j))if(b.isPlainObject(s)){j=[t.createElement(z[1])];b.fn.attr.call(j,s,true)}else j=[H.createElement(z[1])];else{z=b.buildFragment([v[1]],[H]);j=(z.cacheable?z.fragment.cloneNode(true):z.fragment).childNodes}return b.merge(this,
j)}else{if((z=t.getElementById(v[2]))&&z.parentNode){if(z.id!==v[2])return f.find(j);this.length=1;this[0]=z}this.context=t;this.selector=j;return this}else if(!s&&!x.test(j)){this.selector=j;this.context=t;j=t.getElementsByTagName(j);return b.merge(this,j)}else return!s||s.jquery?(s||f).find(j):b(s).find(j);else if(b.isFunction(j))return f.ready(j);if(j.selector!==B){this.selector=j.selector;this.context=j.context}return b.makeArray(j,this)},selector:"",jquery:"1.4.4",length:0,size:function(){return this.length},
toArray:function(){return N.call(this,0)},get:function(j){return j==null?this.toArray():j<0?this.slice(j)[0]:this[j]},pushStack:function(j,s,v){var z=b();b.isArray(j)?M.apply(z,j):b.merge(z,j);z.prevObject=this;z.context=this.context;if(s==="find")z.selector=this.selector+(this.selector?" ":"")+v;else if(s)z.selector=this.selector+"."+s+"("+v+")";return z},each:function(j,s){return b.each(this,j,s)},ready:function(j){b.bindReady();if(b.isReady)j.call(t,b);else q&&q.push(j);return this},eq:function(j){return j===
-1?this.slice(j):this.slice(j,+j+1)},first:function(){return this.eq(0)},last:function(){return this.eq(-1)},slice:function(){return this.pushStack(N.apply(this,arguments),"slice",N.call(arguments).join(","))},map:function(j){return this.pushStack(b.map(this,function(s,v){return j.call(s,v,s)}))},end:function(){return this.prevObject||b(null)},push:M,sort:[].sort,splice:[].splice};b.fn.init.prototype=b.fn;b.extend=b.fn.extend=function(){var j,s,v,z,H,G=arguments[0]||{},K=1,Q=arguments.length,ga=false;
if(typeof G==="boolean"){ga=G;G=arguments[1]||{};K=2}if(typeof G!=="object"&&!b.isFunction(G))G={};if(Q===K){G=this;--K}for(;K<Q;K++)if((j=arguments[K])!=null)for(s in j){v=G[s];z=j[s];if(G!==z)if(ga&&z&&(b.isPlainObject(z)||(H=b.isArray(z)))){if(H){H=false;v=v&&b.isArray(v)?v:[]}else v=v&&b.isPlainObject(v)?v:{};G[s]=b.extend(ga,v,z)}else if(z!==B)G[s]=z}return G};b.extend({noConflict:function(j){E.$=e;if(j)E.jQuery=d;return b},isReady:false,readyWait:1,ready:function(j){j===true&&b.readyWait--;
if(!b.readyWait||j!==true&&!b.isReady){if(!t.body)return setTimeout(b.ready,1);b.isReady=true;if(!(j!==true&&--b.readyWait>0))if(q){var s=0,v=q;for(q=null;j=v[s++];)j.call(t,b);b.fn.trigger&&b(t).trigger("ready").unbind("ready")}}},bindReady:function(){if(!p){p=true;if(t.readyState==="complete")return setTimeout(b.ready,1);if(t.addEventListener){t.addEventListener("DOMContentLoaded",u,false);E.addEventListener("load",b.ready,false)}else if(t.attachEvent){t.attachEvent("onreadystatechange",u);E.attachEvent("onload",
b.ready);var j=false;try{j=E.frameElement==null}catch(s){}t.documentElement.doScroll&&j&&a()}}},isFunction:function(j){return b.type(j)==="function"},isArray:Array.isArray||function(j){return b.type(j)==="array"},isWindow:function(j){return j&&typeof j==="object"&&"setInterval"in j},isNaN:function(j){return j==null||!r.test(j)||isNaN(j)},type:function(j){return j==null?String(j):R[y.call(j)]||"object"},isPlainObject:function(j){if(!j||b.type(j)!=="object"||j.nodeType||b.isWindow(j))return false;if(j.constructor&&
!F.call(j,"constructor")&&!F.call(j.constructor.prototype,"isPrototypeOf"))return false;for(var s in j);return s===B||F.call(j,s)},isEmptyObject:function(j){for(var s in j)return false;return true},error:function(j){throw j;},parseJSON:function(j){if(typeof j!=="string"||!j)return null;j=b.trim(j);if(C.test(j.replace(J,"@").replace(w,"]").replace(I,"")))return E.JSON&&E.JSON.parse?E.JSON.parse(j):(new Function("return "+j))();else b.error("Invalid JSON: "+j)},noop:function(){},globalEval:function(j){if(j&&
l.test(j)){var s=t.getElementsByTagName("head")[0]||t.documentElement,v=t.createElement("script");v.type="text/javascript";if(b.support.scriptEval)v.appendChild(t.createTextNode(j));else v.text=j;s.insertBefore(v,s.firstChild);s.removeChild(v)}},nodeName:function(j,s){return j.nodeName&&j.nodeName.toUpperCase()===s.toUpperCase()},each:function(j,s,v){var z,H=0,G=j.length,K=G===B||b.isFunction(j);if(v)if(K)for(z in j){if(s.apply(j[z],v)===false)break}else for(;H<G;){if(s.apply(j[H++],v)===false)break}else if(K)for(z in j){if(s.call(j[z],
z,j[z])===false)break}else for(v=j[0];H<G&&s.call(v,H,v)!==false;v=j[++H]);return j},trim:O?function(j){return j==null?"":O.call(j)}:function(j){return j==null?"":j.toString().replace(k,"").replace(o,"")},makeArray:function(j,s){var v=s||[];if(j!=null){var z=b.type(j);j.length==null||z==="string"||z==="function"||z==="regexp"||b.isWindow(j)?M.call(v,j):b.merge(v,j)}return v},inArray:function(j,s){if(s.indexOf)return s.indexOf(j);for(var v=0,z=s.length;v<z;v++)if(s[v]===j)return v;return-1},merge:function(j,
s){var v=j.length,z=0;if(typeof s.length==="number")for(var H=s.length;z<H;z++)j[v++]=s[z];else for(;s[z]!==B;)j[v++]=s[z++];j.length=v;return j},grep:function(j,s,v){var z=[],H;v=!!v;for(var G=0,K=j.length;G<K;G++){H=!!s(j[G],G);v!==H&&z.push(j[G])}return z},map:function(j,s,v){for(var z=[],H,G=0,K=j.length;G<K;G++){H=s(j[G],G,v);if(H!=null)z[z.length]=H}return z.concat.apply([],z)},guid:1,proxy:function(j,s,v){if(arguments.length===2)if(typeof s==="string"){v=j;j=v[s];s=B}else if(s&&!b.isFunction(s)){v=
s;s=B}if(!s&&j)s=function(){return j.apply(v||this,arguments)};if(j)s.guid=j.guid=j.guid||s.guid||b.guid++;return s},access:function(j,s,v,z,H,G){var K=j.length;if(typeof s==="object"){for(var Q in s)b.access(j,Q,s[Q],z,H,v);return j}if(v!==B){z=!G&&z&&b.isFunction(v);for(Q=0;Q<K;Q++)H(j[Q],s,z?v.call(j[Q],Q,H(j[Q],s)):v,G);return j}return K?H(j[0],s):B},now:function(){return(new Date).getTime()},uaMatch:function(j){j=j.toLowerCase();j=L.exec(j)||g.exec(j)||i.exec(j)||j.indexOf("compatible")<0&&n.exec(j)||
[];return{browser:j[1]||"",version:j[2]||"0"}},browser:{}});b.each("Boolean Number String Function Array Date RegExp Object".split(" "),function(j,s){R["[object "+s+"]"]=s.toLowerCase()});m=b.uaMatch(m);if(m.browser){b.browser[m.browser]=true;b.browser.version=m.version}if(b.browser.webkit)b.browser.safari=true;if(D)b.inArray=function(j,s){return D.call(s,j)};if(!/\s/.test("\u00a0")){k=/^[\s\xA0]+/;o=/[\s\xA0]+$/}f=b(t);if(t.addEventListener)u=function(){t.removeEventListener("DOMContentLoaded",u,
false);b.ready()};else if(t.attachEvent)u=function(){if(t.readyState==="complete"){t.detachEvent("onreadystatechange",u);b.ready()}};return E.jQuery=E.$=b}();(function(){c.support={};var a=t.documentElement,b=t.createElement("script"),d=t.createElement("div"),e="script"+c.now();d.style.display="none";d.innerHTML="   <link/><table></table><a href='/a' style='color:red;float:left;opacity:.55;'>a</a><input type='checkbox'/>";var f=d.getElementsByTagName("*"),h=d.getElementsByTagName("a")[0],l=t.createElement("select"),
k=l.appendChild(t.createElement("option"));if(!(!f||!f.length||!h)){c.support={leadingWhitespace:d.firstChild.nodeType===3,tbody:!d.getElementsByTagName("tbody").length,htmlSerialize:!!d.getElementsByTagName("link").length,style:/red/.test(h.getAttribute("style")),hrefNormalized:h.getAttribute("href")==="/a",opacity:/^0.55$/.test(h.style.opacity),cssFloat:!!h.style.cssFloat,checkOn:d.getElementsByTagName("input")[0].value==="on",optSelected:k.selected,deleteExpando:true,optDisabled:false,checkClone:false,
scriptEval:false,noCloneEvent:true,boxModel:null,inlineBlockNeedsLayout:false,shrinkWrapBlocks:false,reliableHiddenOffsets:true};l.disabled=true;c.support.optDisabled=!k.disabled;b.type="text/javascript";try{b.appendChild(t.createTextNode("window."+e+"=1;"))}catch(o){}a.insertBefore(b,a.firstChild);if(E[e]){c.support.scriptEval=true;delete E[e]}try{delete b.test}catch(x){c.support.deleteExpando=false}a.removeChild(b);if(d.attachEvent&&d.fireEvent){d.attachEvent("onclick",function r(){c.support.noCloneEvent=
false;d.detachEvent("onclick",r)});d.cloneNode(true).fireEvent("onclick")}d=t.createElement("div");d.innerHTML="<input type='radio' name='radiotest' checked='checked'/>";a=t.createDocumentFragment();a.appendChild(d.firstChild);c.support.checkClone=a.cloneNode(true).cloneNode(true).lastChild.checked;c(function(){var r=t.createElement("div");r.style.width=r.style.paddingLeft="1px";t.body.appendChild(r);c.boxModel=c.support.boxModel=r.offsetWidth===2;if("zoom"in r.style){r.style.display="inline";r.style.zoom=
1;c.support.inlineBlockNeedsLayout=r.offsetWidth===2;r.style.display="";r.innerHTML="<div style='width:4px;'></div>";c.support.shrinkWrapBlocks=r.offsetWidth!==2}r.innerHTML="<table><tr><td style='padding:0;display:none'></td><td>t</td></tr></table>";var A=r.getElementsByTagName("td");c.support.reliableHiddenOffsets=A[0].offsetHeight===0;A[0].style.display="";A[1].style.display="none";c.support.reliableHiddenOffsets=c.support.reliableHiddenOffsets&&A[0].offsetHeight===0;r.innerHTML="";t.body.removeChild(r).style.display=
"none"});a=function(r){var A=t.createElement("div");r="on"+r;var C=r in A;if(!C){A.setAttribute(r,"return;");C=typeof A[r]==="function"}return C};c.support.submitBubbles=a("submit");c.support.changeBubbles=a("change");a=b=d=f=h=null}})();var ra={},Ja=/^(?:\{.*\}|\[.*\])$/;c.extend({cache:{},uuid:0,expando:"jQuery"+c.now(),noData:{embed:true,object:"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000",applet:true},data:function(a,b,d){if(c.acceptData(a)){a=a==E?ra:a;var e=a.nodeType,f=e?a[c.expando]:null,h=
c.cache;if(!(e&&!f&&typeof b==="string"&&d===B)){if(e)f||(a[c.expando]=f=++c.uuid);else h=a;if(typeof b==="object")if(e)h[f]=c.extend(h[f],b);else c.extend(h,b);else if(e&&!h[f])h[f]={};a=e?h[f]:h;if(d!==B)a[b]=d;return typeof b==="string"?a[b]:a}}},removeData:function(a,b){if(c.acceptData(a)){a=a==E?ra:a;var d=a.nodeType,e=d?a[c.expando]:a,f=c.cache,h=d?f[e]:e;if(b){if(h){delete h[b];d&&c.isEmptyObject(h)&&c.removeData(a)}}else if(d&&c.support.deleteExpando)delete a[c.expando];else if(a.removeAttribute)a.removeAttribute(c.expando);
else if(d)delete f[e];else for(var l in a)delete a[l]}},acceptData:function(a){if(a.nodeName){var b=c.noData[a.nodeName.toLowerCase()];if(b)return!(b===true||a.getAttribute("classid")!==b)}return true}});c.fn.extend({data:function(a,b){var d=null;if(typeof a==="undefined"){if(this.length){var e=this[0].attributes,f;d=c.data(this[0]);for(var h=0,l=e.length;h<l;h++){f=e[h].name;if(f.indexOf("data-")===0){f=f.substr(5);ka(this[0],f,d[f])}}}return d}else if(typeof a==="object")return this.each(function(){c.data(this,
a)});var k=a.split(".");k[1]=k[1]?"."+k[1]:"";if(b===B){d=this.triggerHandler("getData"+k[1]+"!",[k[0]]);if(d===B&&this.length){d=c.data(this[0],a);d=ka(this[0],a,d)}return d===B&&k[1]?this.data(k[0]):d}else return this.each(function(){var o=c(this),x=[k[0],b];o.triggerHandler("setData"+k[1]+"!",x);c.data(this,a,b);o.triggerHandler("changeData"+k[1]+"!",x)})},removeData:function(a){return this.each(function(){c.removeData(this,a)})}});c.extend({queue:function(a,b,d){if(a){b=(b||"fx")+"queue";var e=
c.data(a,b);if(!d)return e||[];if(!e||c.isArray(d))e=c.data(a,b,c.makeArray(d));else e.push(d);return e}},dequeue:function(a,b){b=b||"fx";var d=c.queue(a,b),e=d.shift();if(e==="inprogress")e=d.shift();if(e){b==="fx"&&d.unshift("inprogress");e.call(a,function(){c.dequeue(a,b)})}}});c.fn.extend({queue:function(a,b){if(typeof a!=="string"){b=a;a="fx"}if(b===B)return c.queue(this[0],a);return this.each(function(){var d=c.queue(this,a,b);a==="fx"&&d[0]!=="inprogress"&&c.dequeue(this,a)})},dequeue:function(a){return this.each(function(){c.dequeue(this,
a)})},delay:function(a,b){a=c.fx?c.fx.speeds[a]||a:a;b=b||"fx";return this.queue(b,function(){var d=this;setTimeout(function(){c.dequeue(d,b)},a)})},clearQueue:function(a){return this.queue(a||"fx",[])}});var sa=/[\n\t]/g,ha=/\s+/,Sa=/\r/g,Ta=/^(?:href|src|style)$/,Ua=/^(?:button|input)$/i,Va=/^(?:button|input|object|select|textarea)$/i,Wa=/^a(?:rea)?$/i,ta=/^(?:radio|checkbox)$/i;c.props={"for":"htmlFor","class":"className",readonly:"readOnly",maxlength:"maxLength",cellspacing:"cellSpacing",rowspan:"rowSpan",
colspan:"colSpan",tabindex:"tabIndex",usemap:"useMap",frameborder:"frameBorder"};c.fn.extend({attr:function(a,b){return c.access(this,a,b,true,c.attr)},removeAttr:function(a){return this.each(function(){c.attr(this,a,"");this.nodeType===1&&this.removeAttribute(a)})},addClass:function(a){if(c.isFunction(a))return this.each(function(x){var r=c(this);r.addClass(a.call(this,x,r.attr("class")))});if(a&&typeof a==="string")for(var b=(a||"").split(ha),d=0,e=this.length;d<e;d++){var f=this[d];if(f.nodeType===
1)if(f.className){for(var h=" "+f.className+" ",l=f.className,k=0,o=b.length;k<o;k++)if(h.indexOf(" "+b[k]+" ")<0)l+=" "+b[k];f.className=c.trim(l)}else f.className=a}return this},removeClass:function(a){if(c.isFunction(a))return this.each(function(o){var x=c(this);x.removeClass(a.call(this,o,x.attr("class")))});if(a&&typeof a==="string"||a===B)for(var b=(a||"").split(ha),d=0,e=this.length;d<e;d++){var f=this[d];if(f.nodeType===1&&f.className)if(a){for(var h=(" "+f.className+" ").replace(sa," "),
l=0,k=b.length;l<k;l++)h=h.replace(" "+b[l]+" "," ");f.className=c.trim(h)}else f.className=""}return this},toggleClass:function(a,b){var d=typeof a,e=typeof b==="boolean";if(c.isFunction(a))return this.each(function(f){var h=c(this);h.toggleClass(a.call(this,f,h.attr("class"),b),b)});return this.each(function(){if(d==="string")for(var f,h=0,l=c(this),k=b,o=a.split(ha);f=o[h++];){k=e?k:!l.hasClass(f);l[k?"addClass":"removeClass"](f)}else if(d==="undefined"||d==="boolean"){this.className&&c.data(this,
"__className__",this.className);this.className=this.className||a===false?"":c.data(this,"__className__")||""}})},hasClass:function(a){a=" "+a+" ";for(var b=0,d=this.length;b<d;b++)if((" "+this[b].className+" ").replace(sa," ").indexOf(a)>-1)return true;return false},val:function(a){if(!arguments.length){var b=this[0];if(b){if(c.nodeName(b,"option")){var d=b.attributes.value;return!d||d.specified?b.value:b.text}if(c.nodeName(b,"select")){var e=b.selectedIndex;d=[];var f=b.options;b=b.type==="select-one";
if(e<0)return null;var h=b?e:0;for(e=b?e+1:f.length;h<e;h++){var l=f[h];if(l.selected&&(c.support.optDisabled?!l.disabled:l.getAttribute("disabled")===null)&&(!l.parentNode.disabled||!c.nodeName(l.parentNode,"optgroup"))){a=c(l).val();if(b)return a;d.push(a)}}return d}if(ta.test(b.type)&&!c.support.checkOn)return b.getAttribute("value")===null?"on":b.value;return(b.value||"").replace(Sa,"")}return B}var k=c.isFunction(a);return this.each(function(o){var x=c(this),r=a;if(this.nodeType===1){if(k)r=
a.call(this,o,x.val());if(r==null)r="";else if(typeof r==="number")r+="";else if(c.isArray(r))r=c.map(r,function(C){return C==null?"":C+""});if(c.isArray(r)&&ta.test(this.type))this.checked=c.inArray(x.val(),r)>=0;else if(c.nodeName(this,"select")){var A=c.makeArray(r);c("option",this).each(function(){this.selected=c.inArray(c(this).val(),A)>=0});if(!A.length)this.selectedIndex=-1}else this.value=r}})}});c.extend({attrFn:{val:true,css:true,html:true,text:true,data:true,width:true,height:true,offset:true},
attr:function(a,b,d,e){if(!a||a.nodeType===3||a.nodeType===8)return B;if(e&&b in c.attrFn)return c(a)[b](d);e=a.nodeType!==1||!c.isXMLDoc(a);var f=d!==B;b=e&&c.props[b]||b;var h=Ta.test(b);if((b in a||a[b]!==B)&&e&&!h){if(f){b==="type"&&Ua.test(a.nodeName)&&a.parentNode&&c.error("type property can't be changed");if(d===null)a.nodeType===1&&a.removeAttribute(b);else a[b]=d}if(c.nodeName(a,"form")&&a.getAttributeNode(b))return a.getAttributeNode(b).nodeValue;if(b==="tabIndex")return(b=a.getAttributeNode("tabIndex"))&&
b.specified?b.value:Va.test(a.nodeName)||Wa.test(a.nodeName)&&a.href?0:B;return a[b]}if(!c.support.style&&e&&b==="style"){if(f)a.style.cssText=""+d;return a.style.cssText}f&&a.setAttribute(b,""+d);if(!a.attributes[b]&&a.hasAttribute&&!a.hasAttribute(b))return B;a=!c.support.hrefNormalized&&e&&h?a.getAttribute(b,2):a.getAttribute(b);return a===null?B:a}});var X=/\.(.*)$/,ia=/^(?:textarea|input|select)$/i,La=/\./g,Ma=/ /g,Xa=/[^\w\s.|`]/g,Ya=function(a){return a.replace(Xa,"\\$&")},ua={focusin:0,focusout:0};
c.event={add:function(a,b,d,e){if(!(a.nodeType===3||a.nodeType===8)){if(c.isWindow(a)&&a!==E&&!a.frameElement)a=E;if(d===false)d=U;else if(!d)return;var f,h;if(d.handler){f=d;d=f.handler}if(!d.guid)d.guid=c.guid++;if(h=c.data(a)){var l=a.nodeType?"events":"__events__",k=h[l],o=h.handle;if(typeof k==="function"){o=k.handle;k=k.events}else if(!k){a.nodeType||(h[l]=h=function(){});h.events=k={}}if(!o)h.handle=o=function(){return typeof c!=="undefined"&&!c.event.triggered?c.event.handle.apply(o.elem,
arguments):B};o.elem=a;b=b.split(" ");for(var x=0,r;l=b[x++];){h=f?c.extend({},f):{handler:d,data:e};if(l.indexOf(".")>-1){r=l.split(".");l=r.shift();h.namespace=r.slice(0).sort().join(".")}else{r=[];h.namespace=""}h.type=l;if(!h.guid)h.guid=d.guid;var A=k[l],C=c.event.special[l]||{};if(!A){A=k[l]=[];if(!C.setup||C.setup.call(a,e,r,o)===false)if(a.addEventListener)a.addEventListener(l,o,false);else a.attachEvent&&a.attachEvent("on"+l,o)}if(C.add){C.add.call(a,h);if(!h.handler.guid)h.handler.guid=
d.guid}A.push(h);c.event.global[l]=true}a=null}}},global:{},remove:function(a,b,d,e){if(!(a.nodeType===3||a.nodeType===8)){if(d===false)d=U;var f,h,l=0,k,o,x,r,A,C,J=a.nodeType?"events":"__events__",w=c.data(a),I=w&&w[J];if(w&&I){if(typeof I==="function"){w=I;I=I.events}if(b&&b.type){d=b.handler;b=b.type}if(!b||typeof b==="string"&&b.charAt(0)==="."){b=b||"";for(f in I)c.event.remove(a,f+b)}else{for(b=b.split(" ");f=b[l++];){r=f;k=f.indexOf(".")<0;o=[];if(!k){o=f.split(".");f=o.shift();x=RegExp("(^|\\.)"+
c.map(o.slice(0).sort(),Ya).join("\\.(?:.*\\.)?")+"(\\.|$)")}if(A=I[f])if(d){r=c.event.special[f]||{};for(h=e||0;h<A.length;h++){C=A[h];if(d.guid===C.guid){if(k||x.test(C.namespace)){e==null&&A.splice(h--,1);r.remove&&r.remove.call(a,C)}if(e!=null)break}}if(A.length===0||e!=null&&A.length===1){if(!r.teardown||r.teardown.call(a,o)===false)c.removeEvent(a,f,w.handle);delete I[f]}}else for(h=0;h<A.length;h++){C=A[h];if(k||x.test(C.namespace)){c.event.remove(a,r,C.handler,h);A.splice(h--,1)}}}if(c.isEmptyObject(I)){if(b=
w.handle)b.elem=null;delete w.events;delete w.handle;if(typeof w==="function")c.removeData(a,J);else c.isEmptyObject(w)&&c.removeData(a)}}}}},trigger:function(a,b,d,e){var f=a.type||a;if(!e){a=typeof a==="object"?a[c.expando]?a:c.extend(c.Event(f),a):c.Event(f);if(f.indexOf("!")>=0){a.type=f=f.slice(0,-1);a.exclusive=true}if(!d){a.stopPropagation();c.event.global[f]&&c.each(c.cache,function(){this.events&&this.events[f]&&c.event.trigger(a,b,this.handle.elem)})}if(!d||d.nodeType===3||d.nodeType===
8)return B;a.result=B;a.target=d;b=c.makeArray(b);b.unshift(a)}a.currentTarget=d;(e=d.nodeType?c.data(d,"handle"):(c.data(d,"__events__")||{}).handle)&&e.apply(d,b);e=d.parentNode||d.ownerDocument;try{if(!(d&&d.nodeName&&c.noData[d.nodeName.toLowerCase()]))if(d["on"+f]&&d["on"+f].apply(d,b)===false){a.result=false;a.preventDefault()}}catch(h){}if(!a.isPropagationStopped()&&e)c.event.trigger(a,b,e,true);else if(!a.isDefaultPrevented()){var l;e=a.target;var k=f.replace(X,""),o=c.nodeName(e,"a")&&k===
"click",x=c.event.special[k]||{};if((!x._default||x._default.call(d,a)===false)&&!o&&!(e&&e.nodeName&&c.noData[e.nodeName.toLowerCase()])){try{if(e[k]){if(l=e["on"+k])e["on"+k]=null;c.event.triggered=true;e[k]()}}catch(r){}if(l)e["on"+k]=l;c.event.triggered=false}}},handle:function(a){var b,d,e,f;d=[];var h=c.makeArray(arguments);a=h[0]=c.event.fix(a||E.event);a.currentTarget=this;b=a.type.indexOf(".")<0&&!a.exclusive;if(!b){e=a.type.split(".");a.type=e.shift();d=e.slice(0).sort();e=RegExp("(^|\\.)"+
d.join("\\.(?:.*\\.)?")+"(\\.|$)")}a.namespace=a.namespace||d.join(".");f=c.data(this,this.nodeType?"events":"__events__");if(typeof f==="function")f=f.events;d=(f||{})[a.type];if(f&&d){d=d.slice(0);f=0;for(var l=d.length;f<l;f++){var k=d[f];if(b||e.test(k.namespace)){a.handler=k.handler;a.data=k.data;a.handleObj=k;k=k.handler.apply(this,h);if(k!==B){a.result=k;if(k===false){a.preventDefault();a.stopPropagation()}}if(a.isImmediatePropagationStopped())break}}}return a.result},props:"altKey attrChange attrName bubbles button cancelable charCode clientX clientY ctrlKey currentTarget data detail eventPhase fromElement handler keyCode layerX layerY metaKey newValue offsetX offsetY pageX pageY prevValue relatedNode relatedTarget screenX screenY shiftKey srcElement target toElement view wheelDelta which".split(" "),
fix:function(a){if(a[c.expando])return a;var b=a;a=c.Event(b);for(var d=this.props.length,e;d;){e=this.props[--d];a[e]=b[e]}if(!a.target)a.target=a.srcElement||t;if(a.target.nodeType===3)a.target=a.target.parentNode;if(!a.relatedTarget&&a.fromElement)a.relatedTarget=a.fromElement===a.target?a.toElement:a.fromElement;if(a.pageX==null&&a.clientX!=null){b=t.documentElement;d=t.body;a.pageX=a.clientX+(b&&b.scrollLeft||d&&d.scrollLeft||0)-(b&&b.clientLeft||d&&d.clientLeft||0);a.pageY=a.clientY+(b&&b.scrollTop||
d&&d.scrollTop||0)-(b&&b.clientTop||d&&d.clientTop||0)}if(a.which==null&&(a.charCode!=null||a.keyCode!=null))a.which=a.charCode!=null?a.charCode:a.keyCode;if(!a.metaKey&&a.ctrlKey)a.metaKey=a.ctrlKey;if(!a.which&&a.button!==B)a.which=a.button&1?1:a.button&2?3:a.button&4?2:0;return a},guid:1E8,proxy:c.proxy,special:{ready:{setup:c.bindReady,teardown:c.noop},live:{add:function(a){c.event.add(this,Y(a.origType,a.selector),c.extend({},a,{handler:Ka,guid:a.handler.guid}))},remove:function(a){c.event.remove(this,
Y(a.origType,a.selector),a)}},beforeunload:{setup:function(a,b,d){if(c.isWindow(this))this.onbeforeunload=d},teardown:function(a,b){if(this.onbeforeunload===b)this.onbeforeunload=null}}}};c.removeEvent=t.removeEventListener?function(a,b,d){a.removeEventListener&&a.removeEventListener(b,d,false)}:function(a,b,d){a.detachEvent&&a.detachEvent("on"+b,d)};c.Event=function(a){if(!this.preventDefault)return new c.Event(a);if(a&&a.type){this.originalEvent=a;this.type=a.type}else this.type=a;this.timeStamp=
c.now();this[c.expando]=true};c.Event.prototype={preventDefault:function(){this.isDefaultPrevented=ca;var a=this.originalEvent;if(a)if(a.preventDefault)a.preventDefault();else a.returnValue=false},stopPropagation:function(){this.isPropagationStopped=ca;var a=this.originalEvent;if(a){a.stopPropagation&&a.stopPropagation();a.cancelBubble=true}},stopImmediatePropagation:function(){this.isImmediatePropagationStopped=ca;this.stopPropagation()},isDefaultPrevented:U,isPropagationStopped:U,isImmediatePropagationStopped:U};
var va=function(a){var b=a.relatedTarget;try{for(;b&&b!==this;)b=b.parentNode;if(b!==this){a.type=a.data;c.event.handle.apply(this,arguments)}}catch(d){}},wa=function(a){a.type=a.data;c.event.handle.apply(this,arguments)};c.each({mouseenter:"mouseover",mouseleave:"mouseout"},function(a,b){c.event.special[a]={setup:function(d){c.event.add(this,b,d&&d.selector?wa:va,a)},teardown:function(d){c.event.remove(this,b,d&&d.selector?wa:va)}}});if(!c.support.submitBubbles)c.event.special.submit={setup:function(){if(this.nodeName.toLowerCase()!==
"form"){c.event.add(this,"click.specialSubmit",function(a){var b=a.target,d=b.type;if((d==="submit"||d==="image")&&c(b).closest("form").length){a.liveFired=B;return la("submit",this,arguments)}});c.event.add(this,"keypress.specialSubmit",function(a){var b=a.target,d=b.type;if((d==="text"||d==="password")&&c(b).closest("form").length&&a.keyCode===13){a.liveFired=B;return la("submit",this,arguments)}})}else return false},teardown:function(){c.event.remove(this,".specialSubmit")}};if(!c.support.changeBubbles){var V,
xa=function(a){var b=a.type,d=a.value;if(b==="radio"||b==="checkbox")d=a.checked;else if(b==="select-multiple")d=a.selectedIndex>-1?c.map(a.options,function(e){return e.selected}).join("-"):"";else if(a.nodeName.toLowerCase()==="select")d=a.selectedIndex;return d},Z=function(a,b){var d=a.target,e,f;if(!(!ia.test(d.nodeName)||d.readOnly)){e=c.data(d,"_change_data");f=xa(d);if(a.type!=="focusout"||d.type!=="radio")c.data(d,"_change_data",f);if(!(e===B||f===e))if(e!=null||f){a.type="change";a.liveFired=
B;return c.event.trigger(a,b,d)}}};c.event.special.change={filters:{focusout:Z,beforedeactivate:Z,click:function(a){var b=a.target,d=b.type;if(d==="radio"||d==="checkbox"||b.nodeName.toLowerCase()==="select")return Z.call(this,a)},keydown:function(a){var b=a.target,d=b.type;if(a.keyCode===13&&b.nodeName.toLowerCase()!=="textarea"||a.keyCode===32&&(d==="checkbox"||d==="radio")||d==="select-multiple")return Z.call(this,a)},beforeactivate:function(a){a=a.target;c.data(a,"_change_data",xa(a))}},setup:function(){if(this.type===
"file")return false;for(var a in V)c.event.add(this,a+".specialChange",V[a]);return ia.test(this.nodeName)},teardown:function(){c.event.remove(this,".specialChange");return ia.test(this.nodeName)}};V=c.event.special.change.filters;V.focus=V.beforeactivate}t.addEventListener&&c.each({focus:"focusin",blur:"focusout"},function(a,b){function d(e){e=c.event.fix(e);e.type=b;return c.event.trigger(e,null,e.target)}c.event.special[b]={setup:function(){ua[b]++===0&&t.addEventListener(a,d,true)},teardown:function(){--ua[b]===
0&&t.removeEventListener(a,d,true)}}});c.each(["bind","one"],function(a,b){c.fn[b]=function(d,e,f){if(typeof d==="object"){for(var h in d)this[b](h,e,d[h],f);return this}if(c.isFunction(e)||e===false){f=e;e=B}var l=b==="one"?c.proxy(f,function(o){c(this).unbind(o,l);return f.apply(this,arguments)}):f;if(d==="unload"&&b!=="one")this.one(d,e,f);else{h=0;for(var k=this.length;h<k;h++)c.event.add(this[h],d,l,e)}return this}});c.fn.extend({unbind:function(a,b){if(typeof a==="object"&&!a.preventDefault)for(var d in a)this.unbind(d,
a[d]);else{d=0;for(var e=this.length;d<e;d++)c.event.remove(this[d],a,b)}return this},delegate:function(a,b,d,e){return this.live(b,d,e,a)},undelegate:function(a,b,d){return arguments.length===0?this.unbind("live"):this.die(b,null,d,a)},trigger:function(a,b){return this.each(function(){c.event.trigger(a,b,this)})},triggerHandler:function(a,b){if(this[0]){var d=c.Event(a);d.preventDefault();d.stopPropagation();c.event.trigger(d,b,this[0]);return d.result}},toggle:function(a){for(var b=arguments,d=
1;d<b.length;)c.proxy(a,b[d++]);return this.click(c.proxy(a,function(e){var f=(c.data(this,"lastToggle"+a.guid)||0)%d;c.data(this,"lastToggle"+a.guid,f+1);e.preventDefault();return b[f].apply(this,arguments)||false}))},hover:function(a,b){return this.mouseenter(a).mouseleave(b||a)}});var ya={focus:"focusin",blur:"focusout",mouseenter:"mouseover",mouseleave:"mouseout"};c.each(["live","die"],function(a,b){c.fn[b]=function(d,e,f,h){var l,k=0,o,x,r=h||this.selector;h=h?this:c(this.context);if(typeof d===
"object"&&!d.preventDefault){for(l in d)h[b](l,e,d[l],r);return this}if(c.isFunction(e)){f=e;e=B}for(d=(d||"").split(" ");(l=d[k++])!=null;){o=X.exec(l);x="";if(o){x=o[0];l=l.replace(X,"")}if(l==="hover")d.push("mouseenter"+x,"mouseleave"+x);else{o=l;if(l==="focus"||l==="blur"){d.push(ya[l]+x);l+=x}else l=(ya[l]||l)+x;if(b==="live"){x=0;for(var A=h.length;x<A;x++)c.event.add(h[x],"live."+Y(l,r),{data:e,selector:r,handler:f,origType:l,origHandler:f,preType:o})}else h.unbind("live."+Y(l,r),f)}}return this}});
c.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error".split(" "),function(a,b){c.fn[b]=function(d,e){if(e==null){e=d;d=null}return arguments.length>0?this.bind(b,d,e):this.trigger(b)};if(c.attrFn)c.attrFn[b]=true});E.attachEvent&&!E.addEventListener&&c(E).bind("unload",function(){for(var a in c.cache)if(c.cache[a].handle)try{c.event.remove(c.cache[a].handle.elem)}catch(b){}});
(function(){function a(g,i,n,m,p,q){p=0;for(var u=m.length;p<u;p++){var y=m[p];if(y){var F=false;for(y=y[g];y;){if(y.sizcache===n){F=m[y.sizset];break}if(y.nodeType===1&&!q){y.sizcache=n;y.sizset=p}if(y.nodeName.toLowerCase()===i){F=y;break}y=y[g]}m[p]=F}}}function b(g,i,n,m,p,q){p=0;for(var u=m.length;p<u;p++){var y=m[p];if(y){var F=false;for(y=y[g];y;){if(y.sizcache===n){F=m[y.sizset];break}if(y.nodeType===1){if(!q){y.sizcache=n;y.sizset=p}if(typeof i!=="string"){if(y===i){F=true;break}}else if(k.filter(i,
[y]).length>0){F=y;break}}y=y[g]}m[p]=F}}}var d=/((?:\((?:\([^()]+\)|[^()]+)+\)|\[(?:\[[^\[\]]*\]|['"][^'"]*['"]|[^\[\]'"]+)+\]|\\.|[^ >+~,(\[\\]+)+|[>+~])(\s*,\s*)?((?:.|\r|\n)*)/g,e=0,f=Object.prototype.toString,h=false,l=true;[0,0].sort(function(){l=false;return 0});var k=function(g,i,n,m){n=n||[];var p=i=i||t;if(i.nodeType!==1&&i.nodeType!==9)return[];if(!g||typeof g!=="string")return n;var q,u,y,F,M,N=true,O=k.isXML(i),D=[],R=g;do{d.exec("");if(q=d.exec(R)){R=q[3];D.push(q[1]);if(q[2]){F=q[3];
break}}}while(q);if(D.length>1&&x.exec(g))if(D.length===2&&o.relative[D[0]])u=L(D[0]+D[1],i);else for(u=o.relative[D[0]]?[i]:k(D.shift(),i);D.length;){g=D.shift();if(o.relative[g])g+=D.shift();u=L(g,u)}else{if(!m&&D.length>1&&i.nodeType===9&&!O&&o.match.ID.test(D[0])&&!o.match.ID.test(D[D.length-1])){q=k.find(D.shift(),i,O);i=q.expr?k.filter(q.expr,q.set)[0]:q.set[0]}if(i){q=m?{expr:D.pop(),set:C(m)}:k.find(D.pop(),D.length===1&&(D[0]==="~"||D[0]==="+")&&i.parentNode?i.parentNode:i,O);u=q.expr?k.filter(q.expr,
q.set):q.set;if(D.length>0)y=C(u);else N=false;for(;D.length;){q=M=D.pop();if(o.relative[M])q=D.pop();else M="";if(q==null)q=i;o.relative[M](y,q,O)}}else y=[]}y||(y=u);y||k.error(M||g);if(f.call(y)==="[object Array]")if(N)if(i&&i.nodeType===1)for(g=0;y[g]!=null;g++){if(y[g]&&(y[g]===true||y[g].nodeType===1&&k.contains(i,y[g])))n.push(u[g])}else for(g=0;y[g]!=null;g++)y[g]&&y[g].nodeType===1&&n.push(u[g]);else n.push.apply(n,y);else C(y,n);if(F){k(F,p,n,m);k.uniqueSort(n)}return n};k.uniqueSort=function(g){if(w){h=
l;g.sort(w);if(h)for(var i=1;i<g.length;i++)g[i]===g[i-1]&&g.splice(i--,1)}return g};k.matches=function(g,i){return k(g,null,null,i)};k.matchesSelector=function(g,i){return k(i,null,null,[g]).length>0};k.find=function(g,i,n){var m;if(!g)return[];for(var p=0,q=o.order.length;p<q;p++){var u,y=o.order[p];if(u=o.leftMatch[y].exec(g)){var F=u[1];u.splice(1,1);if(F.substr(F.length-1)!=="\\"){u[1]=(u[1]||"").replace(/\\/g,"");m=o.find[y](u,i,n);if(m!=null){g=g.replace(o.match[y],"");break}}}}m||(m=i.getElementsByTagName("*"));
return{set:m,expr:g}};k.filter=function(g,i,n,m){for(var p,q,u=g,y=[],F=i,M=i&&i[0]&&k.isXML(i[0]);g&&i.length;){for(var N in o.filter)if((p=o.leftMatch[N].exec(g))!=null&&p[2]){var O,D,R=o.filter[N];D=p[1];q=false;p.splice(1,1);if(D.substr(D.length-1)!=="\\"){if(F===y)y=[];if(o.preFilter[N])if(p=o.preFilter[N](p,F,n,y,m,M)){if(p===true)continue}else q=O=true;if(p)for(var j=0;(D=F[j])!=null;j++)if(D){O=R(D,p,j,F);var s=m^!!O;if(n&&O!=null)if(s)q=true;else F[j]=false;else if(s){y.push(D);q=true}}if(O!==
B){n||(F=y);g=g.replace(o.match[N],"");if(!q)return[];break}}}if(g===u)if(q==null)k.error(g);else break;u=g}return F};k.error=function(g){throw"Syntax error, unrecognized expression: "+g;};var o=k.selectors={order:["ID","NAME","TAG"],match:{ID:/#((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,CLASS:/\.((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,NAME:/\[name=['"]*((?:[\w\u00c0-\uFFFF\-]|\\.)+)['"]*\]/,ATTR:/\[\s*((?:[\w\u00c0-\uFFFF\-]|\\.)+)\s*(?:(\S?=)\s*(['"]*)(.*?)\3|)\s*\]/,TAG:/^((?:[\w\u00c0-\uFFFF\*\-]|\\.)+)/,CHILD:/:(only|nth|last|first)-child(?:\((even|odd|[\dn+\-]*)\))?/,
POS:/:(nth|eq|gt|lt|first|last|even|odd)(?:\((\d*)\))?(?=[^\-]|$)/,PSEUDO:/:((?:[\w\u00c0-\uFFFF\-]|\\.)+)(?:\((['"]?)((?:\([^\)]+\)|[^\(\)]*)+)\2\))?/},leftMatch:{},attrMap:{"class":"className","for":"htmlFor"},attrHandle:{href:function(g){return g.getAttribute("href")}},relative:{"+":function(g,i){var n=typeof i==="string",m=n&&!/\W/.test(i);n=n&&!m;if(m)i=i.toLowerCase();m=0;for(var p=g.length,q;m<p;m++)if(q=g[m]){for(;(q=q.previousSibling)&&q.nodeType!==1;);g[m]=n||q&&q.nodeName.toLowerCase()===
i?q||false:q===i}n&&k.filter(i,g,true)},">":function(g,i){var n,m=typeof i==="string",p=0,q=g.length;if(m&&!/\W/.test(i))for(i=i.toLowerCase();p<q;p++){if(n=g[p]){n=n.parentNode;g[p]=n.nodeName.toLowerCase()===i?n:false}}else{for(;p<q;p++)if(n=g[p])g[p]=m?n.parentNode:n.parentNode===i;m&&k.filter(i,g,true)}},"":function(g,i,n){var m,p=e++,q=b;if(typeof i==="string"&&!/\W/.test(i)){m=i=i.toLowerCase();q=a}q("parentNode",i,p,g,m,n)},"~":function(g,i,n){var m,p=e++,q=b;if(typeof i==="string"&&!/\W/.test(i)){m=
i=i.toLowerCase();q=a}q("previousSibling",i,p,g,m,n)}},find:{ID:function(g,i,n){if(typeof i.getElementById!=="undefined"&&!n)return(g=i.getElementById(g[1]))&&g.parentNode?[g]:[]},NAME:function(g,i){if(typeof i.getElementsByName!=="undefined"){for(var n=[],m=i.getElementsByName(g[1]),p=0,q=m.length;p<q;p++)m[p].getAttribute("name")===g[1]&&n.push(m[p]);return n.length===0?null:n}},TAG:function(g,i){return i.getElementsByTagName(g[1])}},preFilter:{CLASS:function(g,i,n,m,p,q){g=" "+g[1].replace(/\\/g,
"")+" ";if(q)return g;q=0;for(var u;(u=i[q])!=null;q++)if(u)if(p^(u.className&&(" "+u.className+" ").replace(/[\t\n]/g," ").indexOf(g)>=0))n||m.push(u);else if(n)i[q]=false;return false},ID:function(g){return g[1].replace(/\\/g,"")},TAG:function(g){return g[1].toLowerCase()},CHILD:function(g){if(g[1]==="nth"){var i=/(-?)(\d*)n((?:\+|-)?\d*)/.exec(g[2]==="even"&&"2n"||g[2]==="odd"&&"2n+1"||!/\D/.test(g[2])&&"0n+"+g[2]||g[2]);g[2]=i[1]+(i[2]||1)-0;g[3]=i[3]-0}g[0]=e++;return g},ATTR:function(g,i,n,
m,p,q){i=g[1].replace(/\\/g,"");if(!q&&o.attrMap[i])g[1]=o.attrMap[i];if(g[2]==="~=")g[4]=" "+g[4]+" ";return g},PSEUDO:function(g,i,n,m,p){if(g[1]==="not")if((d.exec(g[3])||"").length>1||/^\w/.test(g[3]))g[3]=k(g[3],null,null,i);else{g=k.filter(g[3],i,n,true^p);n||m.push.apply(m,g);return false}else if(o.match.POS.test(g[0])||o.match.CHILD.test(g[0]))return true;return g},POS:function(g){g.unshift(true);return g}},filters:{enabled:function(g){return g.disabled===false&&g.type!=="hidden"},disabled:function(g){return g.disabled===
true},checked:function(g){return g.checked===true},selected:function(g){return g.selected===true},parent:function(g){return!!g.firstChild},empty:function(g){return!g.firstChild},has:function(g,i,n){return!!k(n[3],g).length},header:function(g){return/h\d/i.test(g.nodeName)},text:function(g){return"text"===g.type},radio:function(g){return"radio"===g.type},checkbox:function(g){return"checkbox"===g.type},file:function(g){return"file"===g.type},password:function(g){return"password"===g.type},submit:function(g){return"submit"===
g.type},image:function(g){return"image"===g.type},reset:function(g){return"reset"===g.type},button:function(g){return"button"===g.type||g.nodeName.toLowerCase()==="button"},input:function(g){return/input|select|textarea|button/i.test(g.nodeName)}},setFilters:{first:function(g,i){return i===0},last:function(g,i,n,m){return i===m.length-1},even:function(g,i){return i%2===0},odd:function(g,i){return i%2===1},lt:function(g,i,n){return i<n[3]-0},gt:function(g,i,n){return i>n[3]-0},nth:function(g,i,n){return n[3]-
0===i},eq:function(g,i,n){return n[3]-0===i}},filter:{PSEUDO:function(g,i,n,m){var p=i[1],q=o.filters[p];if(q)return q(g,n,i,m);else if(p==="contains")return(g.textContent||g.innerText||k.getText([g])||"").indexOf(i[3])>=0;else if(p==="not"){i=i[3];n=0;for(m=i.length;n<m;n++)if(i[n]===g)return false;return true}else k.error("Syntax error, unrecognized expression: "+p)},CHILD:function(g,i){var n=i[1],m=g;switch(n){case "only":case "first":for(;m=m.previousSibling;)if(m.nodeType===1)return false;if(n===
"first")return true;m=g;case "last":for(;m=m.nextSibling;)if(m.nodeType===1)return false;return true;case "nth":n=i[2];var p=i[3];if(n===1&&p===0)return true;var q=i[0],u=g.parentNode;if(u&&(u.sizcache!==q||!g.nodeIndex)){var y=0;for(m=u.firstChild;m;m=m.nextSibling)if(m.nodeType===1)m.nodeIndex=++y;u.sizcache=q}m=g.nodeIndex-p;return n===0?m===0:m%n===0&&m/n>=0}},ID:function(g,i){return g.nodeType===1&&g.getAttribute("id")===i},TAG:function(g,i){return i==="*"&&g.nodeType===1||g.nodeName.toLowerCase()===
i},CLASS:function(g,i){return(" "+(g.className||g.getAttribute("class"))+" ").indexOf(i)>-1},ATTR:function(g,i){var n=i[1];n=o.attrHandle[n]?o.attrHandle[n](g):g[n]!=null?g[n]:g.getAttribute(n);var m=n+"",p=i[2],q=i[4];return n==null?p==="!=":p==="="?m===q:p==="*="?m.indexOf(q)>=0:p==="~="?(" "+m+" ").indexOf(q)>=0:!q?m&&n!==false:p==="!="?m!==q:p==="^="?m.indexOf(q)===0:p==="$="?m.substr(m.length-q.length)===q:p==="|="?m===q||m.substr(0,q.length+1)===q+"-":false},POS:function(g,i,n,m){var p=o.setFilters[i[2]];
if(p)return p(g,n,i,m)}}},x=o.match.POS,r=function(g,i){return"\\"+(i-0+1)},A;for(A in o.match){o.match[A]=RegExp(o.match[A].source+/(?![^\[]*\])(?![^\(]*\))/.source);o.leftMatch[A]=RegExp(/(^(?:.|\r|\n)*?)/.source+o.match[A].source.replace(/\\(\d+)/g,r))}var C=function(g,i){g=Array.prototype.slice.call(g,0);if(i){i.push.apply(i,g);return i}return g};try{Array.prototype.slice.call(t.documentElement.childNodes,0)}catch(J){C=function(g,i){var n=0,m=i||[];if(f.call(g)==="[object Array]")Array.prototype.push.apply(m,
g);else if(typeof g.length==="number")for(var p=g.length;n<p;n++)m.push(g[n]);else for(;g[n];n++)m.push(g[n]);return m}}var w,I;if(t.documentElement.compareDocumentPosition)w=function(g,i){if(g===i){h=true;return 0}if(!g.compareDocumentPosition||!i.compareDocumentPosition)return g.compareDocumentPosition?-1:1;return g.compareDocumentPosition(i)&4?-1:1};else{w=function(g,i){var n,m,p=[],q=[];n=g.parentNode;m=i.parentNode;var u=n;if(g===i){h=true;return 0}else if(n===m)return I(g,i);else if(n){if(!m)return 1}else return-1;
for(;u;){p.unshift(u);u=u.parentNode}for(u=m;u;){q.unshift(u);u=u.parentNode}n=p.length;m=q.length;for(u=0;u<n&&u<m;u++)if(p[u]!==q[u])return I(p[u],q[u]);return u===n?I(g,q[u],-1):I(p[u],i,1)};I=function(g,i,n){if(g===i)return n;for(g=g.nextSibling;g;){if(g===i)return-1;g=g.nextSibling}return 1}}k.getText=function(g){for(var i="",n,m=0;g[m];m++){n=g[m];if(n.nodeType===3||n.nodeType===4)i+=n.nodeValue;else if(n.nodeType!==8)i+=k.getText(n.childNodes)}return i};(function(){var g=t.createElement("div"),
i="script"+(new Date).getTime(),n=t.documentElement;g.innerHTML="<a name='"+i+"'/>";n.insertBefore(g,n.firstChild);if(t.getElementById(i)){o.find.ID=function(m,p,q){if(typeof p.getElementById!=="undefined"&&!q)return(p=p.getElementById(m[1]))?p.id===m[1]||typeof p.getAttributeNode!=="undefined"&&p.getAttributeNode("id").nodeValue===m[1]?[p]:B:[]};o.filter.ID=function(m,p){var q=typeof m.getAttributeNode!=="undefined"&&m.getAttributeNode("id");return m.nodeType===1&&q&&q.nodeValue===p}}n.removeChild(g);
n=g=null})();(function(){var g=t.createElement("div");g.appendChild(t.createComment(""));if(g.getElementsByTagName("*").length>0)o.find.TAG=function(i,n){var m=n.getElementsByTagName(i[1]);if(i[1]==="*"){for(var p=[],q=0;m[q];q++)m[q].nodeType===1&&p.push(m[q]);m=p}return m};g.innerHTML="<a href='#'></a>";if(g.firstChild&&typeof g.firstChild.getAttribute!=="undefined"&&g.firstChild.getAttribute("href")!=="#")o.attrHandle.href=function(i){return i.getAttribute("href",2)};g=null})();t.querySelectorAll&&
function(){var g=k,i=t.createElement("div");i.innerHTML="<p class='TEST'></p>";if(!(i.querySelectorAll&&i.querySelectorAll(".TEST").length===0)){k=function(m,p,q,u){p=p||t;m=m.replace(/\=\s*([^'"\]]*)\s*\]/g,"='$1']");if(!u&&!k.isXML(p))if(p.nodeType===9)try{return C(p.querySelectorAll(m),q)}catch(y){}else if(p.nodeType===1&&p.nodeName.toLowerCase()!=="object"){var F=p.getAttribute("id"),M=F||"__sizzle__";F||p.setAttribute("id",M);try{return C(p.querySelectorAll("#"+M+" "+m),q)}catch(N){}finally{F||
p.removeAttribute("id")}}return g(m,p,q,u)};for(var n in g)k[n]=g[n];i=null}}();(function(){var g=t.documentElement,i=g.matchesSelector||g.mozMatchesSelector||g.webkitMatchesSelector||g.msMatchesSelector,n=false;try{i.call(t.documentElement,"[test!='']:sizzle")}catch(m){n=true}if(i)k.matchesSelector=function(p,q){q=q.replace(/\=\s*([^'"\]]*)\s*\]/g,"='$1']");if(!k.isXML(p))try{if(n||!o.match.PSEUDO.test(q)&&!/!=/.test(q))return i.call(p,q)}catch(u){}return k(q,null,null,[p]).length>0}})();(function(){var g=
t.createElement("div");g.innerHTML="<div class='test e'></div><div class='test'></div>";if(!(!g.getElementsByClassName||g.getElementsByClassName("e").length===0)){g.lastChild.className="e";if(g.getElementsByClassName("e").length!==1){o.order.splice(1,0,"CLASS");o.find.CLASS=function(i,n,m){if(typeof n.getElementsByClassName!=="undefined"&&!m)return n.getElementsByClassName(i[1])};g=null}}})();k.contains=t.documentElement.contains?function(g,i){return g!==i&&(g.contains?g.contains(i):true)}:t.documentElement.compareDocumentPosition?
function(g,i){return!!(g.compareDocumentPosition(i)&16)}:function(){return false};k.isXML=function(g){return(g=(g?g.ownerDocument||g:0).documentElement)?g.nodeName!=="HTML":false};var L=function(g,i){for(var n,m=[],p="",q=i.nodeType?[i]:i;n=o.match.PSEUDO.exec(g);){p+=n[0];g=g.replace(o.match.PSEUDO,"")}g=o.relative[g]?g+"*":g;n=0;for(var u=q.length;n<u;n++)k(g,q[n],m);return k.filter(p,m)};c.find=k;c.expr=k.selectors;c.expr[":"]=c.expr.filters;c.unique=k.uniqueSort;c.text=k.getText;c.isXMLDoc=k.isXML;
c.contains=k.contains})();var Za=/Until$/,$a=/^(?:parents|prevUntil|prevAll)/,ab=/,/,Na=/^.[^:#\[\.,]*$/,bb=Array.prototype.slice,cb=c.expr.match.POS;c.fn.extend({find:function(a){for(var b=this.pushStack("","find",a),d=0,e=0,f=this.length;e<f;e++){d=b.length;c.find(a,this[e],b);if(e>0)for(var h=d;h<b.length;h++)for(var l=0;l<d;l++)if(b[l]===b[h]){b.splice(h--,1);break}}return b},has:function(a){var b=c(a);return this.filter(function(){for(var d=0,e=b.length;d<e;d++)if(c.contains(this,b[d]))return true})},
not:function(a){return this.pushStack(ma(this,a,false),"not",a)},filter:function(a){return this.pushStack(ma(this,a,true),"filter",a)},is:function(a){return!!a&&c.filter(a,this).length>0},closest:function(a,b){var d=[],e,f,h=this[0];if(c.isArray(a)){var l,k={},o=1;if(h&&a.length){e=0;for(f=a.length;e<f;e++){l=a[e];k[l]||(k[l]=c.expr.match.POS.test(l)?c(l,b||this.context):l)}for(;h&&h.ownerDocument&&h!==b;){for(l in k){e=k[l];if(e.jquery?e.index(h)>-1:c(h).is(e))d.push({selector:l,elem:h,level:o})}h=
h.parentNode;o++}}return d}l=cb.test(a)?c(a,b||this.context):null;e=0;for(f=this.length;e<f;e++)for(h=this[e];h;)if(l?l.index(h)>-1:c.find.matchesSelector(h,a)){d.push(h);break}else{h=h.parentNode;if(!h||!h.ownerDocument||h===b)break}d=d.length>1?c.unique(d):d;return this.pushStack(d,"closest",a)},index:function(a){if(!a||typeof a==="string")return c.inArray(this[0],a?c(a):this.parent().children());return c.inArray(a.jquery?a[0]:a,this)},add:function(a,b){var d=typeof a==="string"?c(a,b||this.context):
c.makeArray(a),e=c.merge(this.get(),d);return this.pushStack(!d[0]||!d[0].parentNode||d[0].parentNode.nodeType===11||!e[0]||!e[0].parentNode||e[0].parentNode.nodeType===11?e:c.unique(e))},andSelf:function(){return this.add(this.prevObject)}});c.each({parent:function(a){return(a=a.parentNode)&&a.nodeType!==11?a:null},parents:function(a){return c.dir(a,"parentNode")},parentsUntil:function(a,b,d){return c.dir(a,"parentNode",d)},next:function(a){return c.nth(a,2,"nextSibling")},prev:function(a){return c.nth(a,
2,"previousSibling")},nextAll:function(a){return c.dir(a,"nextSibling")},prevAll:function(a){return c.dir(a,"previousSibling")},nextUntil:function(a,b,d){return c.dir(a,"nextSibling",d)},prevUntil:function(a,b,d){return c.dir(a,"previousSibling",d)},siblings:function(a){return c.sibling(a.parentNode.firstChild,a)},children:function(a){return c.sibling(a.firstChild)},contents:function(a){return c.nodeName(a,"iframe")?a.contentDocument||a.contentWindow.document:c.makeArray(a.childNodes)}},function(a,
b){c.fn[a]=function(d,e){var f=c.map(this,b,d);Za.test(a)||(e=d);if(e&&typeof e==="string")f=c.filter(e,f);f=this.length>1?c.unique(f):f;if((this.length>1||ab.test(e))&&$a.test(a))f=f.reverse();return this.pushStack(f,a,bb.call(arguments).join(","))}});c.extend({filter:function(a,b,d){if(d)a=":not("+a+")";return b.length===1?c.find.matchesSelector(b[0],a)?[b[0]]:[]:c.find.matches(a,b)},dir:function(a,b,d){var e=[];for(a=a[b];a&&a.nodeType!==9&&(d===B||a.nodeType!==1||!c(a).is(d));){a.nodeType===1&&
e.push(a);a=a[b]}return e},nth:function(a,b,d){b=b||1;for(var e=0;a;a=a[d])if(a.nodeType===1&&++e===b)break;return a},sibling:function(a,b){for(var d=[];a;a=a.nextSibling)a.nodeType===1&&a!==b&&d.push(a);return d}});var za=/ jQuery\d+="(?:\d+|null)"/g,$=/^\s+/,Aa=/<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/ig,Ba=/<([\w:]+)/,db=/<tbody/i,eb=/<|&#?\w+;/,Ca=/<(?:script|object|embed|option|style)/i,Da=/checked\s*(?:[^=]|=\s*.checked.)/i,fb=/\=([^="'>\s]+\/)>/g,P={option:[1,
"<select multiple='multiple'>","</select>"],legend:[1,"<fieldset>","</fieldset>"],thead:[1,"<table>","</table>"],tr:[2,"<table><tbody>","</tbody></table>"],td:[3,"<table><tbody><tr>","</tr></tbody></table>"],col:[2,"<table><tbody></tbody><colgroup>","</colgroup></table>"],area:[1,"<map>","</map>"],_default:[0,"",""]};P.optgroup=P.option;P.tbody=P.tfoot=P.colgroup=P.caption=P.thead;P.th=P.td;if(!c.support.htmlSerialize)P._default=[1,"div<div>","</div>"];c.fn.extend({text:function(a){if(c.isFunction(a))return this.each(function(b){var d=
c(this);d.text(a.call(this,b,d.text()))});if(typeof a!=="object"&&a!==B)return this.empty().append((this[0]&&this[0].ownerDocument||t).createTextNode(a));return c.text(this)},wrapAll:function(a){if(c.isFunction(a))return this.each(function(d){c(this).wrapAll(a.call(this,d))});if(this[0]){var b=c(a,this[0].ownerDocument).eq(0).clone(true);this[0].parentNode&&b.insertBefore(this[0]);b.map(function(){for(var d=this;d.firstChild&&d.firstChild.nodeType===1;)d=d.firstChild;return d}).append(this)}return this},
wrapInner:function(a){if(c.isFunction(a))return this.each(function(b){c(this).wrapInner(a.call(this,b))});return this.each(function(){var b=c(this),d=b.contents();d.length?d.wrapAll(a):b.append(a)})},wrap:function(a){return this.each(function(){c(this).wrapAll(a)})},unwrap:function(){return this.parent().each(function(){c.nodeName(this,"body")||c(this).replaceWith(this.childNodes)}).end()},append:function(){return this.domManip(arguments,true,function(a){this.nodeType===1&&this.appendChild(a)})},
prepend:function(){return this.domManip(arguments,true,function(a){this.nodeType===1&&this.insertBefore(a,this.firstChild)})},before:function(){if(this[0]&&this[0].parentNode)return this.domManip(arguments,false,function(b){this.parentNode.insertBefore(b,this)});else if(arguments.length){var a=c(arguments[0]);a.push.apply(a,this.toArray());return this.pushStack(a,"before",arguments)}},after:function(){if(this[0]&&this[0].parentNode)return this.domManip(arguments,false,function(b){this.parentNode.insertBefore(b,
this.nextSibling)});else if(arguments.length){var a=this.pushStack(this,"after",arguments);a.push.apply(a,c(arguments[0]).toArray());return a}},remove:function(a,b){for(var d=0,e;(e=this[d])!=null;d++)if(!a||c.filter(a,[e]).length){if(!b&&e.nodeType===1){c.cleanData(e.getElementsByTagName("*"));c.cleanData([e])}e.parentNode&&e.parentNode.removeChild(e)}return this},empty:function(){for(var a=0,b;(b=this[a])!=null;a++)for(b.nodeType===1&&c.cleanData(b.getElementsByTagName("*"));b.firstChild;)b.removeChild(b.firstChild);
return this},clone:function(a){var b=this.map(function(){if(!c.support.noCloneEvent&&!c.isXMLDoc(this)){var d=this.outerHTML,e=this.ownerDocument;if(!d){d=e.createElement("div");d.appendChild(this.cloneNode(true));d=d.innerHTML}return c.clean([d.replace(za,"").replace(fb,'="$1">').replace($,"")],e)[0]}else return this.cloneNode(true)});if(a===true){na(this,b);na(this.find("*"),b.find("*"))}return b},html:function(a){if(a===B)return this[0]&&this[0].nodeType===1?this[0].innerHTML.replace(za,""):null;
else if(typeof a==="string"&&!Ca.test(a)&&(c.support.leadingWhitespace||!$.test(a))&&!P[(Ba.exec(a)||["",""])[1].toLowerCase()]){a=a.replace(Aa,"<$1></$2>");try{for(var b=0,d=this.length;b<d;b++)if(this[b].nodeType===1){c.cleanData(this[b].getElementsByTagName("*"));this[b].innerHTML=a}}catch(e){this.empty().append(a)}}else c.isFunction(a)?this.each(function(f){var h=c(this);h.html(a.call(this,f,h.html()))}):this.empty().append(a);return this},replaceWith:function(a){if(this[0]&&this[0].parentNode){if(c.isFunction(a))return this.each(function(b){var d=
c(this),e=d.html();d.replaceWith(a.call(this,b,e))});if(typeof a!=="string")a=c(a).detach();return this.each(function(){var b=this.nextSibling,d=this.parentNode;c(this).remove();b?c(b).before(a):c(d).append(a)})}else return this.pushStack(c(c.isFunction(a)?a():a),"replaceWith",a)},detach:function(a){return this.remove(a,true)},domManip:function(a,b,d){var e,f,h,l=a[0],k=[];if(!c.support.checkClone&&arguments.length===3&&typeof l==="string"&&Da.test(l))return this.each(function(){c(this).domManip(a,
b,d,true)});if(c.isFunction(l))return this.each(function(x){var r=c(this);a[0]=l.call(this,x,b?r.html():B);r.domManip(a,b,d)});if(this[0]){e=l&&l.parentNode;e=c.support.parentNode&&e&&e.nodeType===11&&e.childNodes.length===this.length?{fragment:e}:c.buildFragment(a,this,k);h=e.fragment;if(f=h.childNodes.length===1?h=h.firstChild:h.firstChild){b=b&&c.nodeName(f,"tr");f=0;for(var o=this.length;f<o;f++)d.call(b?c.nodeName(this[f],"table")?this[f].getElementsByTagName("tbody")[0]||this[f].appendChild(this[f].ownerDocument.createElement("tbody")):
this[f]:this[f],f>0||e.cacheable||this.length>1?h.cloneNode(true):h)}k.length&&c.each(k,Oa)}return this}});c.buildFragment=function(a,b,d){var e,f,h;b=b&&b[0]?b[0].ownerDocument||b[0]:t;if(a.length===1&&typeof a[0]==="string"&&a[0].length<512&&b===t&&!Ca.test(a[0])&&(c.support.checkClone||!Da.test(a[0]))){f=true;if(h=c.fragments[a[0]])if(h!==1)e=h}if(!e){e=b.createDocumentFragment();c.clean(a,b,e,d)}if(f)c.fragments[a[0]]=h?e:1;return{fragment:e,cacheable:f}};c.fragments={};c.each({appendTo:"append",
prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},function(a,b){c.fn[a]=function(d){var e=[];d=c(d);var f=this.length===1&&this[0].parentNode;if(f&&f.nodeType===11&&f.childNodes.length===1&&d.length===1){d[b](this[0]);return this}else{f=0;for(var h=d.length;f<h;f++){var l=(f>0?this.clone(true):this).get();c(d[f])[b](l);e=e.concat(l)}return this.pushStack(e,a,d.selector)}}});c.extend({clean:function(a,b,d,e){b=b||t;if(typeof b.createElement==="undefined")b=b.ownerDocument||
b[0]&&b[0].ownerDocument||t;for(var f=[],h=0,l;(l=a[h])!=null;h++){if(typeof l==="number")l+="";if(l){if(typeof l==="string"&&!eb.test(l))l=b.createTextNode(l);else if(typeof l==="string"){l=l.replace(Aa,"<$1></$2>");var k=(Ba.exec(l)||["",""])[1].toLowerCase(),o=P[k]||P._default,x=o[0],r=b.createElement("div");for(r.innerHTML=o[1]+l+o[2];x--;)r=r.lastChild;if(!c.support.tbody){x=db.test(l);k=k==="table"&&!x?r.firstChild&&r.firstChild.childNodes:o[1]==="<table>"&&!x?r.childNodes:[];for(o=k.length-
1;o>=0;--o)c.nodeName(k[o],"tbody")&&!k[o].childNodes.length&&k[o].parentNode.removeChild(k[o])}!c.support.leadingWhitespace&&$.test(l)&&r.insertBefore(b.createTextNode($.exec(l)[0]),r.firstChild);l=r.childNodes}if(l.nodeType)f.push(l);else f=c.merge(f,l)}}if(d)for(h=0;f[h];h++)if(e&&c.nodeName(f[h],"script")&&(!f[h].type||f[h].type.toLowerCase()==="text/javascript"))e.push(f[h].parentNode?f[h].parentNode.removeChild(f[h]):f[h]);else{f[h].nodeType===1&&f.splice.apply(f,[h+1,0].concat(c.makeArray(f[h].getElementsByTagName("script"))));
d.appendChild(f[h])}return f},cleanData:function(a){for(var b,d,e=c.cache,f=c.event.special,h=c.support.deleteExpando,l=0,k;(k=a[l])!=null;l++)if(!(k.nodeName&&c.noData[k.nodeName.toLowerCase()]))if(d=k[c.expando]){if((b=e[d])&&b.events)for(var o in b.events)f[o]?c.event.remove(k,o):c.removeEvent(k,o,b.handle);if(h)delete k[c.expando];else k.removeAttribute&&k.removeAttribute(c.expando);delete e[d]}}});var Ea=/alpha\([^)]*\)/i,gb=/opacity=([^)]*)/,hb=/-([a-z])/ig,ib=/([A-Z])/g,Fa=/^-?\d+(?:px)?$/i,
jb=/^-?\d/,kb={position:"absolute",visibility:"hidden",display:"block"},Pa=["Left","Right"],Qa=["Top","Bottom"],W,Ga,aa,lb=function(a,b){return b.toUpperCase()};c.fn.css=function(a,b){if(arguments.length===2&&b===B)return this;return c.access(this,a,b,true,function(d,e,f){return f!==B?c.style(d,e,f):c.css(d,e)})};c.extend({cssHooks:{opacity:{get:function(a,b){if(b){var d=W(a,"opacity","opacity");return d===""?"1":d}else return a.style.opacity}}},cssNumber:{zIndex:true,fontWeight:true,opacity:true,
zoom:true,lineHeight:true},cssProps:{"float":c.support.cssFloat?"cssFloat":"styleFloat"},style:function(a,b,d,e){if(!(!a||a.nodeType===3||a.nodeType===8||!a.style)){var f,h=c.camelCase(b),l=a.style,k=c.cssHooks[h];b=c.cssProps[h]||h;if(d!==B){if(!(typeof d==="number"&&isNaN(d)||d==null)){if(typeof d==="number"&&!c.cssNumber[h])d+="px";if(!k||!("set"in k)||(d=k.set(a,d))!==B)try{l[b]=d}catch(o){}}}else{if(k&&"get"in k&&(f=k.get(a,false,e))!==B)return f;return l[b]}}},css:function(a,b,d){var e,f=c.camelCase(b),
h=c.cssHooks[f];b=c.cssProps[f]||f;if(h&&"get"in h&&(e=h.get(a,true,d))!==B)return e;else if(W)return W(a,b,f)},swap:function(a,b,d){var e={},f;for(f in b){e[f]=a.style[f];a.style[f]=b[f]}d.call(a);for(f in b)a.style[f]=e[f]},camelCase:function(a){return a.replace(hb,lb)}});c.curCSS=c.css;c.each(["height","width"],function(a,b){c.cssHooks[b]={get:function(d,e,f){var h;if(e){if(d.offsetWidth!==0)h=oa(d,b,f);else c.swap(d,kb,function(){h=oa(d,b,f)});if(h<=0){h=W(d,b,b);if(h==="0px"&&aa)h=aa(d,b,b);
if(h!=null)return h===""||h==="auto"?"0px":h}if(h<0||h==null){h=d.style[b];return h===""||h==="auto"?"0px":h}return typeof h==="string"?h:h+"px"}},set:function(d,e){if(Fa.test(e)){e=parseFloat(e);if(e>=0)return e+"px"}else return e}}});if(!c.support.opacity)c.cssHooks.opacity={get:function(a,b){return gb.test((b&&a.currentStyle?a.currentStyle.filter:a.style.filter)||"")?parseFloat(RegExp.$1)/100+"":b?"1":""},set:function(a,b){var d=a.style;d.zoom=1;var e=c.isNaN(b)?"":"alpha(opacity="+b*100+")",f=
d.filter||"";d.filter=Ea.test(f)?f.replace(Ea,e):d.filter+" "+e}};if(t.defaultView&&t.defaultView.getComputedStyle)Ga=function(a,b,d){var e;d=d.replace(ib,"-$1").toLowerCase();if(!(b=a.ownerDocument.defaultView))return B;if(b=b.getComputedStyle(a,null)){e=b.getPropertyValue(d);if(e===""&&!c.contains(a.ownerDocument.documentElement,a))e=c.style(a,d)}return e};if(t.documentElement.currentStyle)aa=function(a,b){var d,e,f=a.currentStyle&&a.currentStyle[b],h=a.style;if(!Fa.test(f)&&jb.test(f)){d=h.left;
e=a.runtimeStyle.left;a.runtimeStyle.left=a.currentStyle.left;h.left=b==="fontSize"?"1em":f||0;f=h.pixelLeft+"px";h.left=d;a.runtimeStyle.left=e}return f===""?"auto":f};W=Ga||aa;if(c.expr&&c.expr.filters){c.expr.filters.hidden=function(a){var b=a.offsetHeight;return a.offsetWidth===0&&b===0||!c.support.reliableHiddenOffsets&&(a.style.display||c.css(a,"display"))==="none"};c.expr.filters.visible=function(a){return!c.expr.filters.hidden(a)}}var mb=c.now(),nb=/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi,
ob=/^(?:select|textarea)/i,pb=/^(?:color|date|datetime|email|hidden|month|number|password|range|search|tel|text|time|url|week)$/i,qb=/^(?:GET|HEAD)$/,Ra=/\[\]$/,T=/\=\?(&|$)/,ja=/\?/,rb=/([?&])_=[^&]*/,sb=/^(\w+:)?\/\/([^\/?#]+)/,tb=/%20/g,ub=/#.*$/,Ha=c.fn.load;c.fn.extend({load:function(a,b,d){if(typeof a!=="string"&&Ha)return Ha.apply(this,arguments);else if(!this.length)return this;var e=a.indexOf(" ");if(e>=0){var f=a.slice(e,a.length);a=a.slice(0,e)}e="GET";if(b)if(c.isFunction(b)){d=b;b=null}else if(typeof b===
"object"){b=c.param(b,c.ajaxSettings.traditional);e="POST"}var h=this;c.ajax({url:a,type:e,dataType:"html",data:b,complete:function(l,k){if(k==="success"||k==="notmodified")h.html(f?c("<div>").append(l.responseText.replace(nb,"")).find(f):l.responseText);d&&h.each(d,[l.responseText,k,l])}});return this},serialize:function(){return c.param(this.serializeArray())},serializeArray:function(){return this.map(function(){return this.elements?c.makeArray(this.elements):this}).filter(function(){return this.name&&
!this.disabled&&(this.checked||ob.test(this.nodeName)||pb.test(this.type))}).map(function(a,b){var d=c(this).val();return d==null?null:c.isArray(d)?c.map(d,function(e){return{name:b.name,value:e}}):{name:b.name,value:d}}).get()}});c.each("ajaxStart ajaxStop ajaxComplete ajaxError ajaxSuccess ajaxSend".split(" "),function(a,b){c.fn[b]=function(d){return this.bind(b,d)}});c.extend({get:function(a,b,d,e){if(c.isFunction(b)){e=e||d;d=b;b=null}return c.ajax({type:"GET",url:a,data:b,success:d,dataType:e})},
getScript:function(a,b){return c.get(a,null,b,"script")},getJSON:function(a,b,d){return c.get(a,b,d,"json")},post:function(a,b,d,e){if(c.isFunction(b)){e=e||d;d=b;b={}}return c.ajax({type:"POST",url:a,data:b,success:d,dataType:e})},ajaxSetup:function(a){c.extend(c.ajaxSettings,a)},ajaxSettings:{url:location.href,global:true,type:"GET",contentType:"application/x-www-form-urlencoded",processData:true,async:true,xhr:function(){return new E.XMLHttpRequest},accepts:{xml:"application/xml, text/xml",html:"text/html",
script:"text/javascript, application/javascript",json:"application/json, text/javascript",text:"text/plain",_default:"*/*"}},ajax:function(a){var b=c.extend(true,{},c.ajaxSettings,a),d,e,f,h=b.type.toUpperCase(),l=qb.test(h);b.url=b.url.replace(ub,"");b.context=a&&a.context!=null?a.context:b;if(b.data&&b.processData&&typeof b.data!=="string")b.data=c.param(b.data,b.traditional);if(b.dataType==="jsonp"){if(h==="GET")T.test(b.url)||(b.url+=(ja.test(b.url)?"&":"?")+(b.jsonp||"callback")+"=?");else if(!b.data||
!T.test(b.data))b.data=(b.data?b.data+"&":"")+(b.jsonp||"callback")+"=?";b.dataType="json"}if(b.dataType==="json"&&(b.data&&T.test(b.data)||T.test(b.url))){d=b.jsonpCallback||"jsonp"+mb++;if(b.data)b.data=(b.data+"").replace(T,"="+d+"$1");b.url=b.url.replace(T,"="+d+"$1");b.dataType="script";var k=E[d];E[d]=function(m){if(c.isFunction(k))k(m);else{E[d]=B;try{delete E[d]}catch(p){}}f=m;c.handleSuccess(b,w,e,f);c.handleComplete(b,w,e,f);r&&r.removeChild(A)}}if(b.dataType==="script"&&b.cache===null)b.cache=
false;if(b.cache===false&&l){var o=c.now(),x=b.url.replace(rb,"$1_="+o);b.url=x+(x===b.url?(ja.test(b.url)?"&":"?")+"_="+o:"")}if(b.data&&l)b.url+=(ja.test(b.url)?"&":"?")+b.data;b.global&&c.active++===0&&c.event.trigger("ajaxStart");o=(o=sb.exec(b.url))&&(o[1]&&o[1].toLowerCase()!==location.protocol||o[2].toLowerCase()!==location.host);if(b.dataType==="script"&&h==="GET"&&o){var r=t.getElementsByTagName("head")[0]||t.documentElement,A=t.createElement("script");if(b.scriptCharset)A.charset=b.scriptCharset;
A.src=b.url;if(!d){var C=false;A.onload=A.onreadystatechange=function(){if(!C&&(!this.readyState||this.readyState==="loaded"||this.readyState==="complete")){C=true;c.handleSuccess(b,w,e,f);c.handleComplete(b,w,e,f);A.onload=A.onreadystatechange=null;r&&A.parentNode&&r.removeChild(A)}}}r.insertBefore(A,r.firstChild);return B}var J=false,w=b.xhr();if(w){b.username?w.open(h,b.url,b.async,b.username,b.password):w.open(h,b.url,b.async);try{if(b.data!=null&&!l||a&&a.contentType)w.setRequestHeader("Content-Type",
b.contentType);if(b.ifModified){c.lastModified[b.url]&&w.setRequestHeader("If-Modified-Since",c.lastModified[b.url]);c.etag[b.url]&&w.setRequestHeader("If-None-Match",c.etag[b.url])}o||w.setRequestHeader("X-Requested-With","XMLHttpRequest");w.setRequestHeader("Accept",b.dataType&&b.accepts[b.dataType]?b.accepts[b.dataType]+", */*; q=0.01":b.accepts._default)}catch(I){}if(b.beforeSend&&b.beforeSend.call(b.context,w,b)===false){b.global&&c.active--===1&&c.event.trigger("ajaxStop");w.abort();return false}b.global&&
c.triggerGlobal(b,"ajaxSend",[w,b]);var L=w.onreadystatechange=function(m){if(!w||w.readyState===0||m==="abort"){J||c.handleComplete(b,w,e,f);J=true;if(w)w.onreadystatechange=c.noop}else if(!J&&w&&(w.readyState===4||m==="timeout")){J=true;w.onreadystatechange=c.noop;e=m==="timeout"?"timeout":!c.httpSuccess(w)?"error":b.ifModified&&c.httpNotModified(w,b.url)?"notmodified":"success";var p;if(e==="success")try{f=c.httpData(w,b.dataType,b)}catch(q){e="parsererror";p=q}if(e==="success"||e==="notmodified")d||
c.handleSuccess(b,w,e,f);else c.handleError(b,w,e,p);d||c.handleComplete(b,w,e,f);m==="timeout"&&w.abort();if(b.async)w=null}};try{var g=w.abort;w.abort=function(){w&&Function.prototype.call.call(g,w);L("abort")}}catch(i){}b.async&&b.timeout>0&&setTimeout(function(){w&&!J&&L("timeout")},b.timeout);try{w.send(l||b.data==null?null:b.data)}catch(n){c.handleError(b,w,null,n);c.handleComplete(b,w,e,f)}b.async||L();return w}},param:function(a,b){var d=[],e=function(h,l){l=c.isFunction(l)?l():l;d[d.length]=
encodeURIComponent(h)+"="+encodeURIComponent(l)};if(b===B)b=c.ajaxSettings.traditional;if(c.isArray(a)||a.jquery)c.each(a,function(){e(this.name,this.value)});else for(var f in a)da(f,a[f],b,e);return d.join("&").replace(tb,"+")}});c.extend({active:0,lastModified:{},etag:{},handleError:function(a,b,d,e){a.error&&a.error.call(a.context,b,d,e);a.global&&c.triggerGlobal(a,"ajaxError",[b,a,e])},handleSuccess:function(a,b,d,e){a.success&&a.success.call(a.context,e,d,b);a.global&&c.triggerGlobal(a,"ajaxSuccess",
[b,a])},handleComplete:function(a,b,d){a.complete&&a.complete.call(a.context,b,d);a.global&&c.triggerGlobal(a,"ajaxComplete",[b,a]);a.global&&c.active--===1&&c.event.trigger("ajaxStop")},triggerGlobal:function(a,b,d){(a.context&&a.context.url==null?c(a.context):c.event).trigger(b,d)},httpSuccess:function(a){try{return!a.status&&location.protocol==="file:"||a.status>=200&&a.status<300||a.status===304||a.status===1223}catch(b){}return false},httpNotModified:function(a,b){var d=a.getResponseHeader("Last-Modified"),
e=a.getResponseHeader("Etag");if(d)c.lastModified[b]=d;if(e)c.etag[b]=e;return a.status===304},httpData:function(a,b,d){var e=a.getResponseHeader("content-type")||"",f=b==="xml"||!b&&e.indexOf("xml")>=0;a=f?a.responseXML:a.responseText;f&&a.documentElement.nodeName==="parsererror"&&c.error("parsererror");if(d&&d.dataFilter)a=d.dataFilter(a,b);if(typeof a==="string")if(b==="json"||!b&&e.indexOf("json")>=0)a=c.parseJSON(a);else if(b==="script"||!b&&e.indexOf("javascript")>=0)c.globalEval(a);return a}});
if(E.ActiveXObject)c.ajaxSettings.xhr=function(){if(E.location.protocol!=="file:")try{return new E.XMLHttpRequest}catch(a){}try{return new E.ActiveXObject("Microsoft.XMLHTTP")}catch(b){}};c.support.ajax=!!c.ajaxSettings.xhr();var ea={},vb=/^(?:toggle|show|hide)$/,wb=/^([+\-]=)?([\d+.\-]+)(.*)$/,ba,pa=[["height","marginTop","marginBottom","paddingTop","paddingBottom"],["width","marginLeft","marginRight","paddingLeft","paddingRight"],["opacity"]];c.fn.extend({show:function(a,b,d){if(a||a===0)return this.animate(S("show",
3),a,b,d);else{d=0;for(var e=this.length;d<e;d++){a=this[d];b=a.style.display;if(!c.data(a,"olddisplay")&&b==="none")b=a.style.display="";b===""&&c.css(a,"display")==="none"&&c.data(a,"olddisplay",qa(a.nodeName))}for(d=0;d<e;d++){a=this[d];b=a.style.display;if(b===""||b==="none")a.style.display=c.data(a,"olddisplay")||""}return this}},hide:function(a,b,d){if(a||a===0)return this.animate(S("hide",3),a,b,d);else{a=0;for(b=this.length;a<b;a++){d=c.css(this[a],"display");d!=="none"&&c.data(this[a],"olddisplay",
d)}for(a=0;a<b;a++)this[a].style.display="none";return this}},_toggle:c.fn.toggle,toggle:function(a,b,d){var e=typeof a==="boolean";if(c.isFunction(a)&&c.isFunction(b))this._toggle.apply(this,arguments);else a==null||e?this.each(function(){var f=e?a:c(this).is(":hidden");c(this)[f?"show":"hide"]()}):this.animate(S("toggle",3),a,b,d);return this},fadeTo:function(a,b,d,e){return this.filter(":hidden").css("opacity",0).show().end().animate({opacity:b},a,d,e)},animate:function(a,b,d,e){var f=c.speed(b,
d,e);if(c.isEmptyObject(a))return this.each(f.complete);return this[f.queue===false?"each":"queue"](function(){var h=c.extend({},f),l,k=this.nodeType===1,o=k&&c(this).is(":hidden"),x=this;for(l in a){var r=c.camelCase(l);if(l!==r){a[r]=a[l];delete a[l];l=r}if(a[l]==="hide"&&o||a[l]==="show"&&!o)return h.complete.call(this);if(k&&(l==="height"||l==="width")){h.overflow=[this.style.overflow,this.style.overflowX,this.style.overflowY];if(c.css(this,"display")==="inline"&&c.css(this,"float")==="none")if(c.support.inlineBlockNeedsLayout)if(qa(this.nodeName)===
"inline")this.style.display="inline-block";else{this.style.display="inline";this.style.zoom=1}else this.style.display="inline-block"}if(c.isArray(a[l])){(h.specialEasing=h.specialEasing||{})[l]=a[l][1];a[l]=a[l][0]}}if(h.overflow!=null)this.style.overflow="hidden";h.curAnim=c.extend({},a);c.each(a,function(A,C){var J=new c.fx(x,h,A);if(vb.test(C))J[C==="toggle"?o?"show":"hide":C](a);else{var w=wb.exec(C),I=J.cur()||0;if(w){var L=parseFloat(w[2]),g=w[3]||"px";if(g!=="px"){c.style(x,A,(L||1)+g);I=(L||
1)/J.cur()*I;c.style(x,A,I+g)}if(w[1])L=(w[1]==="-="?-1:1)*L+I;J.custom(I,L,g)}else J.custom(I,C,"")}});return true})},stop:function(a,b){var d=c.timers;a&&this.queue([]);this.each(function(){for(var e=d.length-1;e>=0;e--)if(d[e].elem===this){b&&d[e](true);d.splice(e,1)}});b||this.dequeue();return this}});c.each({slideDown:S("show",1),slideUp:S("hide",1),slideToggle:S("toggle",1),fadeIn:{opacity:"show"},fadeOut:{opacity:"hide"},fadeToggle:{opacity:"toggle"}},function(a,b){c.fn[a]=function(d,e,f){return this.animate(b,
d,e,f)}});c.extend({speed:function(a,b,d){var e=a&&typeof a==="object"?c.extend({},a):{complete:d||!d&&b||c.isFunction(a)&&a,duration:a,easing:d&&b||b&&!c.isFunction(b)&&b};e.duration=c.fx.off?0:typeof e.duration==="number"?e.duration:e.duration in c.fx.speeds?c.fx.speeds[e.duration]:c.fx.speeds._default;e.old=e.complete;e.complete=function(){e.queue!==false&&c(this).dequeue();c.isFunction(e.old)&&e.old.call(this)};return e},easing:{linear:function(a,b,d,e){return d+e*a},swing:function(a,b,d,e){return(-Math.cos(a*
Math.PI)/2+0.5)*e+d}},timers:[],fx:function(a,b,d){this.options=b;this.elem=a;this.prop=d;if(!b.orig)b.orig={}}});c.fx.prototype={update:function(){this.options.step&&this.options.step.call(this.elem,this.now,this);(c.fx.step[this.prop]||c.fx.step._default)(this)},cur:function(){if(this.elem[this.prop]!=null&&(!this.elem.style||this.elem.style[this.prop]==null))return this.elem[this.prop];var a=parseFloat(c.css(this.elem,this.prop));return a&&a>-1E4?a:0},custom:function(a,b,d){function e(l){return f.step(l)}
var f=this,h=c.fx;this.startTime=c.now();this.start=a;this.end=b;this.unit=d||this.unit||"px";this.now=this.start;this.pos=this.state=0;e.elem=this.elem;if(e()&&c.timers.push(e)&&!ba)ba=setInterval(h.tick,h.interval)},show:function(){this.options.orig[this.prop]=c.style(this.elem,this.prop);this.options.show=true;this.custom(this.prop==="width"||this.prop==="height"?1:0,this.cur());c(this.elem).show()},hide:function(){this.options.orig[this.prop]=c.style(this.elem,this.prop);this.options.hide=true;
this.custom(this.cur(),0)},step:function(a){var b=c.now(),d=true;if(a||b>=this.options.duration+this.startTime){this.now=this.end;this.pos=this.state=1;this.update();this.options.curAnim[this.prop]=true;for(var e in this.options.curAnim)if(this.options.curAnim[e]!==true)d=false;if(d){if(this.options.overflow!=null&&!c.support.shrinkWrapBlocks){var f=this.elem,h=this.options;c.each(["","X","Y"],function(k,o){f.style["overflow"+o]=h.overflow[k]})}this.options.hide&&c(this.elem).hide();if(this.options.hide||
this.options.show)for(var l in this.options.curAnim)c.style(this.elem,l,this.options.orig[l]);this.options.complete.call(this.elem)}return false}else{a=b-this.startTime;this.state=a/this.options.duration;b=this.options.easing||(c.easing.swing?"swing":"linear");this.pos=c.easing[this.options.specialEasing&&this.options.specialEasing[this.prop]||b](this.state,a,0,1,this.options.duration);this.now=this.start+(this.end-this.start)*this.pos;this.update()}return true}};c.extend(c.fx,{tick:function(){for(var a=
c.timers,b=0;b<a.length;b++)a[b]()||a.splice(b--,1);a.length||c.fx.stop()},interval:13,stop:function(){clearInterval(ba);ba=null},speeds:{slow:600,fast:200,_default:400},step:{opacity:function(a){c.style(a.elem,"opacity",a.now)},_default:function(a){if(a.elem.style&&a.elem.style[a.prop]!=null)a.elem.style[a.prop]=(a.prop==="width"||a.prop==="height"?Math.max(0,a.now):a.now)+a.unit;else a.elem[a.prop]=a.now}}});if(c.expr&&c.expr.filters)c.expr.filters.animated=function(a){return c.grep(c.timers,function(b){return a===
b.elem}).length};var xb=/^t(?:able|d|h)$/i,Ia=/^(?:body|html)$/i;c.fn.offset="getBoundingClientRect"in t.documentElement?function(a){var b=this[0],d;if(a)return this.each(function(l){c.offset.setOffset(this,a,l)});if(!b||!b.ownerDocument)return null;if(b===b.ownerDocument.body)return c.offset.bodyOffset(b);try{d=b.getBoundingClientRect()}catch(e){}var f=b.ownerDocument,h=f.documentElement;if(!d||!c.contains(h,b))return d||{top:0,left:0};b=f.body;f=fa(f);return{top:d.top+(f.pageYOffset||c.support.boxModel&&
h.scrollTop||b.scrollTop)-(h.clientTop||b.clientTop||0),left:d.left+(f.pageXOffset||c.support.boxModel&&h.scrollLeft||b.scrollLeft)-(h.clientLeft||b.clientLeft||0)}}:function(a){var b=this[0];if(a)return this.each(function(x){c.offset.setOffset(this,a,x)});if(!b||!b.ownerDocument)return null;if(b===b.ownerDocument.body)return c.offset.bodyOffset(b);c.offset.initialize();var d,e=b.offsetParent,f=b.ownerDocument,h=f.documentElement,l=f.body;d=(f=f.defaultView)?f.getComputedStyle(b,null):b.currentStyle;
for(var k=b.offsetTop,o=b.offsetLeft;(b=b.parentNode)&&b!==l&&b!==h;){if(c.offset.supportsFixedPosition&&d.position==="fixed")break;d=f?f.getComputedStyle(b,null):b.currentStyle;k-=b.scrollTop;o-=b.scrollLeft;if(b===e){k+=b.offsetTop;o+=b.offsetLeft;if(c.offset.doesNotAddBorder&&!(c.offset.doesAddBorderForTableAndCells&&xb.test(b.nodeName))){k+=parseFloat(d.borderTopWidth)||0;o+=parseFloat(d.borderLeftWidth)||0}e=b.offsetParent}if(c.offset.subtractsBorderForOverflowNotVisible&&d.overflow!=="visible"){k+=
parseFloat(d.borderTopWidth)||0;o+=parseFloat(d.borderLeftWidth)||0}d=d}if(d.position==="relative"||d.position==="static"){k+=l.offsetTop;o+=l.offsetLeft}if(c.offset.supportsFixedPosition&&d.position==="fixed"){k+=Math.max(h.scrollTop,l.scrollTop);o+=Math.max(h.scrollLeft,l.scrollLeft)}return{top:k,left:o}};c.offset={initialize:function(){var a=t.body,b=t.createElement("div"),d,e,f,h=parseFloat(c.css(a,"marginTop"))||0;c.extend(b.style,{position:"absolute",top:0,left:0,margin:0,border:0,width:"1px",
height:"1px",visibility:"hidden"});b.innerHTML="<div style='position:absolute;top:0;left:0;margin:0;border:5px solid #000;padding:0;width:1px;height:1px;'><div></div></div><table style='position:absolute;top:0;left:0;margin:0;border:5px solid #000;padding:0;width:1px;height:1px;' cellpadding='0' cellspacing='0'><tr><td></td></tr></table>";a.insertBefore(b,a.firstChild);d=b.firstChild;e=d.firstChild;f=d.nextSibling.firstChild.firstChild;this.doesNotAddBorder=e.offsetTop!==5;this.doesAddBorderForTableAndCells=
f.offsetTop===5;e.style.position="fixed";e.style.top="20px";this.supportsFixedPosition=e.offsetTop===20||e.offsetTop===15;e.style.position=e.style.top="";d.style.overflow="hidden";d.style.position="relative";this.subtractsBorderForOverflowNotVisible=e.offsetTop===-5;this.doesNotIncludeMarginInBodyOffset=a.offsetTop!==h;a.removeChild(b);c.offset.initialize=c.noop},bodyOffset:function(a){var b=a.offsetTop,d=a.offsetLeft;c.offset.initialize();if(c.offset.doesNotIncludeMarginInBodyOffset){b+=parseFloat(c.css(a,
"marginTop"))||0;d+=parseFloat(c.css(a,"marginLeft"))||0}return{top:b,left:d}},setOffset:function(a,b,d){var e=c.css(a,"position");if(e==="static")a.style.position="relative";var f=c(a),h=f.offset(),l=c.css(a,"top"),k=c.css(a,"left"),o=e==="absolute"&&c.inArray("auto",[l,k])>-1;e={};var x={};if(o)x=f.position();l=o?x.top:parseInt(l,10)||0;k=o?x.left:parseInt(k,10)||0;if(c.isFunction(b))b=b.call(a,d,h);if(b.top!=null)e.top=b.top-h.top+l;if(b.left!=null)e.left=b.left-h.left+k;"using"in b?b.using.call(a,
e):f.css(e)}};c.fn.extend({position:function(){if(!this[0])return null;var a=this[0],b=this.offsetParent(),d=this.offset(),e=Ia.test(b[0].nodeName)?{top:0,left:0}:b.offset();d.top-=parseFloat(c.css(a,"marginTop"))||0;d.left-=parseFloat(c.css(a,"marginLeft"))||0;e.top+=parseFloat(c.css(b[0],"borderTopWidth"))||0;e.left+=parseFloat(c.css(b[0],"borderLeftWidth"))||0;return{top:d.top-e.top,left:d.left-e.left}},offsetParent:function(){return this.map(function(){for(var a=this.offsetParent||t.body;a&&!Ia.test(a.nodeName)&&
c.css(a,"position")==="static";)a=a.offsetParent;return a})}});c.each(["Left","Top"],function(a,b){var d="scroll"+b;c.fn[d]=function(e){var f=this[0],h;if(!f)return null;if(e!==B)return this.each(function(){if(h=fa(this))h.scrollTo(!a?e:c(h).scrollLeft(),a?e:c(h).scrollTop());else this[d]=e});else return(h=fa(f))?"pageXOffset"in h?h[a?"pageYOffset":"pageXOffset"]:c.support.boxModel&&h.document.documentElement[d]||h.document.body[d]:f[d]}});c.each(["Height","Width"],function(a,b){var d=b.toLowerCase();
c.fn["inner"+b]=function(){return this[0]?parseFloat(c.css(this[0],d,"padding")):null};c.fn["outer"+b]=function(e){return this[0]?parseFloat(c.css(this[0],d,e?"margin":"border")):null};c.fn[d]=function(e){var f=this[0];if(!f)return e==null?null:this;if(c.isFunction(e))return this.each(function(l){var k=c(this);k[d](e.call(this,l,k[d]()))});if(c.isWindow(f))return f.document.compatMode==="CSS1Compat"&&f.document.documentElement["client"+b]||f.document.body["client"+b];else if(f.nodeType===9)return Math.max(f.documentElement["client"+
b],f.body["scroll"+b],f.documentElement["scroll"+b],f.body["offset"+b],f.documentElement["offset"+b]);else if(e===B){f=c.css(f,d);var h=parseFloat(f);return c.isNaN(h)?f:h}else return this.css(d,typeof e==="string"?e:e+"px")}})})(window);

/*
* php의 sprintf와 사용방법은 비슷하나 문자열 포멧의 type specifier는 %s만 사용
* 참조 : http://wiki.simplexi.com/pages/viewpage.action?pageId=125338699
*/
function sprintf()
{
    var pattern = /%([0-9]+)\$s/g;
    
    var text = arguments[0];
    var extract = text.match(pattern, text);

    if (extract == null || extract.length < 0) {
        var split = text.split('%s');
        var count = split.length;
        var tmp = new Array();
        
        for (var i = 0; i < count; i++) {
            if (typeof arguments[i + 1] != 'undefined') {
                tmp.push(split[i] + arguments[i + 1]);
            } else {
                tmp.push(split[i]);
            }
        }
        
        return tmp.join('');
    } else {
        var count = extract.length;
        
        for (var i = 0; i < count; i++) {
            var index = extract[i].replace(pattern, '$1');
            if (typeof arguments[index] != 'undefined') {
                text = text.replace('%' + index + '$s', arguments[index]);
            }
        }
        
        return text;
    }
}
/*
 * 각개체 별 항목 컨트롤 을 위해서 차후 확장을 고려 하여 별도로 추출
 * 
 */

secondZipcodeHidden();

function secondZipcodeHidden () {
    
    //Front Page 우편번호 2번째 엘레멘트 리스트
    var secondZipcodeElementId = new Array (
            "postcode2",
            "rzipcode2",
            "ozipcode2",
            "zip2",
            "address_zip2"
            );

    for (var i in secondZipcodeElementId) {
        try {
            document.getElementById(secondZipcodeElementId[i]).style.display = "none";
        } catch (e){ }
    }

    // 구디자인 회원 가입수정 zip2 제거
    try {
        document.frm.zip2.style.display = "none";
    } catch (e) { }

    // 구디자인 배송목록 zip2 제거
    try {
        document.addr_set.rcv_zipcode2.style.display = "none";
    } catch (e) { }

    // 구디자인 주문서 작성 zip2 제거
    try {
        document.frm.rzipcode2.style.display = "none";
        document.frm.ozipcode2.style.display = "none";
    } catch (e) { }

    // 구디자인 세금계산서 신청약식 zip2 제거
    try {
        document.frm.mall_zipcode2.style.display = "none";
    } catch (e) { }
}

var EC_FRONT_XANS_INTERPRETER = (function() {
    // 변수 정규표현식
    var XANS_VAR_FULL_NAME_REGEXP = '\\{\\$([a-z0-9_\\.]+)(?:[\\s]*[\\|][\\s]*([a-z0-9]+)[\\s]*[:]?((?:[^\\{\\}]+)*))?\\}';

    // 템플릿에서 모든 변수를 찾기 위한 정규식
    var regexpFindSDEVarFullName = new RegExp(XANS_VAR_FULL_NAME_REGEXP, 'ig');

    // '{$var_name|display}'과 같은 문자열에서 변수명과 모디파이어를 분리하기 위한 정규식
    var regexpSDEVarFullname = new RegExp('^' + XANS_VAR_FULL_NAME_REGEXP + '$', 'i');

    // 모디파이어
    var aSDEModifier = {
        display: function(sVar)
        {
            if (sVar) {
                return '';
            } else{
                return 'displaynone';
            }
        },
        numberformat: function(sVar)
        {
            if (isFinite(sVar)) {
                return number_format(sVar);
            } else {
                return '';
            }
        }
    };

    /**
     * 숫자를 3자리씩 콤마(,)로 끊어서 문자열로 변환하여 리턴합니다.
     * @param string sNumber 숫자
     * @returns {string} 콤마 반영된 문자열
     */
    function number_format(sNumber)
    {
        // 3자리씩 ,로 끊어서 리턴
        var sNumber = String(parseInt(sNumber));
        var regexp = /^(-?[0-9]+)([0-9]{3})($|\.|,)/;
        while (regexp.test(sNumber)) {
            sNumber = sNumber.replace(regexp, "$1,$2$3");
        }
        return sNumber;
    }

    /**
     * 전체 변수명에서 실제 변수명과 모디파이어 등을 분리하여 리턴합니다.
     * @param string sVarFullName '{$var_name|display}' 형태의 전체 변수명
     * @returns {{var_name: *, modifire: *}}
     */
    function parseVariableInfo(sVarFullName)
    {
        var aMatches = sVarFullName.match(regexpSDEVarFullname);

        return {
            var_name: aMatches[1],
            modifire: aMatches[2]
        };
    }

    /**
     * XANS 템플릿에서 변수를 반영하여 리턴합니다.
     * @param string sTemplate 템플릿 (HTML)
     * @param array aVars 변수 리스트
     * @return string 완성된 HTML
     */
    function fetch(sTemplate, aVars)
    {
        var aHtml = sTemplate.split('<!--#-->');
        var sHtml = '';

        $(aHtml).each(function(iIndex, sModuleHtml) {
            if (iIndex < 1 || (iIndex % 2) !== 1) {
                sHtml += convertHtmlVars(sModuleHtml, aVars);
            } else {
                var oObj = $(sModuleHtml);
                var sChildNode = $('<div>').append(oObj.find(':first-child').clone()).html();

                var sModuleClass = $(oObj).attr('class');
                var sModuleName = ucfirst(sModuleClass.match(/xans-product-([^- ]+)/)[1]);

                if (typeof(aVars['@' + sModuleName]) === 'object') {
                    var s = '';
                    $(aVars['@' + sModuleName]).each(function(i, aData) {
                        s += convertHtmlVars(sChildNode, aData);
                    });

                    if (s !== '') {
                        sHtml += $('<div>').append(oObj.html(s).clone()).html();
                    }
                }
            }
        });

        return sHtml;
    }

    function ucfirst(sString)
    {
        if (typeof(sString) !== 'string') {
            return '';
        }
        return sString.substring(0, 1).toUpperCase() + sString.substring(1).toLowerCase();
    }

    function convertHtmlVars(sTemplate, aVars)
    {
        return sTemplate.replace(regexpFindSDEVarFullName, function(sVarFullName) {
            var aVarInfo = parseVariableInfo(sVarFullName);

            var sValue = '';
            if (aVars[aVarInfo.var_name] || aVars[aVarInfo.var_name] === 0) {
                sValue = aVars[aVarInfo.var_name];
            }

            if (aVarInfo.modifire !== undefined && aSDEModifier.hasOwnProperty(aVarInfo.modifire) === true) {
                return aSDEModifier[aVarInfo.modifire](sValue);

            } else {
                return sValue;

            }
        });
    }

    /**
     * XANS 템플릿에서 변수 리스트를 얻어서 리턴합니다.
     * @param string sTemplate 템플릿 (HTML)
     * @return array 변수 리스트 (ex: ['{$var_name}', '{$var_name|display}'])
     */
    function getVariables(sTemplate)
    {
        return sTemplate.match(regexpFindSDEVarFullName);
    }

    return {
        getVariables: getVariables,
        parseVariableInfo: parseVariableInfo,
        fetch: fetch
    };
})();
var EC_FRONT_XANS_TEMPLATE = (function() {
    // 모듈별 템플릿
    var aModuleTemplates = {};

    /**
     * 모듈별 템플릿을 셋팅합니다.
     * @param string sModuleName 모듈명 (xans-product-listmain-1)
     * @param string sModuleTemplate 모듈 템플릿
     */
    function setTemplate(sModuleName, sModuleTemplate)
    {
        aModuleTemplates[sModuleName] = sModuleTemplate;

        if (/^xans-product-list|^xans-product-hashtaglist/.test(sModuleName) === true) {
            var sTemplateForVDOM = getTemplateForVDOM(sModuleName);
            var $li = $(sTemplateForVDOM).find('li:first');
            var sLiHTMLForVDOM = $('<ul>').append($li).html();

            // 해시태그 모듈에 대한 별도 캐싱 처리
            if (/^xans-product-hashtaglist/.test(sModuleName) === true) {
                aModuleTemplates[sModuleName] = convertVDomHtmlToHTML(sLiHTMLForVDOM);
            } else {
                // oMobileDomData를 여전히 사용중인 사용자js와의 호환성을 위한 예외처리 - ECHOSTING-142586
                window.oMobileDomData = {
                    dom: convertVDomHtmlToHTML(sLiHTMLForVDOM),
                    data: EC_FRONT_XANS_INTERPRETER.getVariables(sLiHTMLForVDOM)
                };
            }
        }
    }

    /**
     * 모듈별 템플릿을 가져옵니다.
     * @param string sModuleName 모듈명
     * @return string 모듈별 템플릿
     */
    function getTemplate(sModuleName)
    {
        if (aModuleTemplates.hasOwnProperty(sModuleName)) {
            return aModuleTemplates[sModuleName];
        } else {
            return undefined;
        }
    }

    /**
     * Virtual DOM 에서 사용할 모듈별 템플릿을 가져옵니다.
     * @param string sModuleName 모듈명
     * @return string 모듈별 템플릿
     */
    function getTemplateForVDOM(sModuleName)
    {
        var sTemplate = getTemplate(sModuleName) || '';

        // src 속성에 대해 "//:0" 처리해줍니다.
        var sTemplateForVDOM = sTemplate.replace(/(\s+src\s*=\s*["'])/g, '$1//:0#xansjs');

        return sTemplateForVDOM;
    }

    /**
     * "Virtual DOM"용 HTML을 일반 HTML로 변환하여 리턴합니다.
     * @param string sTemplateForVDOM "Virtual DOM"용 사용한 템플릿 HTML
     * @return string 일반 HTML
     */
    function convertVDomHtmlToHTML(sTemplateForVDOM)
    {
        // src 속성에서 "//:0#xansjs"를 삭제합니다.
        var sTemplate = sTemplateForVDOM.replace(/(\s+src\s*=\s*["'])\/\/:0#xansjs/g, '$1');

        return sTemplate;
    }

    return {
        setTemplate: setTemplate,
        getTemplate: getTemplate,
        getTemplateForVDOM: getTemplateForVDOM,
        convertVDomHtmlToHTML: convertVDomHtmlToHTML
    };

})();
/**
 * 모바일 전용 Util
 * @package app/Mobile
 * @subpackage Front/Disp/Product
 * @version 1.0
 */

var EC_MOBILE_UTIL = {
    /*
     * get li
     */
    convertNode : function(node) {
        return EC_FRONT_XANS_INTERPRETER.fetch(oMobileDomData.dom, node);
    },

    /*
     * set default img
     */
    setDefaultImage : function(string, orgStr, repStr) {
        $(".thumbnail img,img.ThumbImage,img.BigImage").each(function($i,$item){
            var $img = new Image();
            $img.onerror = function () {
                    $item.src="//img.echosting.cafe24.com/thumb/img_product_big.gif";
            }
            $img.src = this.src;
        });
    },

    /*
     * get ajax url
     */
    getAjaxUrl : function(sModule) {
        var aAjax = [];

        aAjax['xans-product-listnormal'] = '/exec/front/Product/ApiProductNormal';
        aAjax['xans-product-listmain'] = '/exec/front/Product/ApiProductMain';

        return aAjax[sModule];
    },

    /*
     * set param
     */
    setAjaxParam : function(aData, sModule) {
        var aParam = [];

        if (typeof(aData['cate_no']) === 'number' && aData['cate_no'] > 0) { aParam.push('cate_no=' + aData['cate_no']); }
        if (typeof(aData['display_group']) === 'number' && aData['display_group'] > 0) { aParam.push('display_group=' + aData['display_group']); }
        if (typeof(aData['sort_method']) === 'number' && aData['sort_method'] > 0) { aParam.push('sort_method=' + aData['sort_method']); }
        if (typeof(aData['supplier_code']) === 'string' && aData['supplier_code'] !== '') { aParam.push('supplier_code=' + aData['supplier_code']); }
        if (typeof(aData['ec_soldout_display']) === 'string' && aData['ec_soldout_display'] !== '') { aParam.push('ec_soldout_display=' + aData['ec_soldout_display']); }
        aParam.push('page=' + aData['page']);
        aParam.push('bInitMore=' + aData['bInitMore']);
        aParam.push('count=' + aData['count']);

        return this.getAjaxUrl(sModule) + '?' + aParam.join('&');
    }
};



/*
 * Swipe 1.0
 *
 * Brad Birdsall, Prime
 * Copyright 2011, Licensed GPL & MIT
 *
*/
;window.SwipeClient = function(element, options) {
    // return immediately if element doesn't exist
    if (! element) {
        return null;
    }

    var _this = this;

    // retreive options
    this.options = options || {};
    this.index = this.options.startSlide || 0;
    this.speed = this.options.speed || 300;
    this.callback = this.options.callback || function() {};
    this.delay = this.options.auto || 0;
    this.postback = this.options.postback || true;

    // 캐싱 사용유무 (기본값으로 이미 넘어오지만 그래도 no로 한번 더 저장)
    this.cache = this.options.cache || 'no';

    // 현재 슬라이드 개별 모듈의 순서(인덱스)를 저장하기 위해 저장 (상품번호, 카테코리 번호 등으로 조합된 상품별 유니크 값)
    this.storageId = this.options.elementId || '';

    // reference dom elements
    this.container = element;
    this.element = this.container.getElementsByTagName('ul')[0]; // the slide pane

    // static css
    this.container.style.overflow = 'hidden';
    this.element.style.listStyle = 'none';
    this.element.style.margin = 0;

    // trigger slider initialization
    this.setup();

    // begin auto slideshow
    this.begin();

    // add event listeners
    if (this.element.addEventListener) {
        this.element.addEventListener('touchstart', this, false);
        this.element.addEventListener('touchmove', this, false);
        this.element.addEventListener('touchend', this, false);
        this.element.addEventListener('touchcancel', this, false);
        this.element.addEventListener('webkitTransitionEnd', this, false);
        this.element.addEventListener('msTransitionEnd', this, false);
        this.element.addEventListener('oTransitionEnd', this, false);
        this.element.addEventListener('transitionend', this, false);

        window.addEventListener('resize', this, false);
    }
};

SwipeClient.prototype = {
    setup: function() {
        // get and measure amt of slides
        this.slides = this.element.children;
        this.length = this.slides.length;

        // return immediately if their are less than two slides
        if (this.length < 2) {
            return null;
        }

        // determine width of each slide
        this.width = Math.ceil(('getBoundingClientRect' in this.container) ? this.container.getBoundingClientRect().width : this.container.offsetWidth);

        // Fix width for Android WebView (i.e. PhoneGap)
        if (this.width === 0 && typeof window.getComputedStyle === 'function') {
            this.width = window.getComputedStyle(this.container, null).width.replace('px','');
        }

        // return immediately if measurement fails
        if (! this.width) {
            return null;
        }

        // hide slider element but keep positioning during setup
        var origVisibility = this.container.style.visibility;

        this.container.style.visibility = 'hidden';

        // dynamic css
        this.element.style.width = Math.ceil(this.slides.length * this.width) + 'px';

        var index = this.slides.length;

        while (index--) {
            var el = this.slides[index];

            el.style.width = this.width + 'px';
            el.style.display = 'table-cell';
            el.style.verticalAlign = 'top';
        }

        // set start position and force translate to remove initial flickering

        // 캐싱 사용중일 경우에만 처리
        if (this.cache === 'yes') {
            // 저장된 세선 스토리지 읽어와 처리
            // 각 스와이프의 개별 모듈에 해당되는 세션 스토리지 값
            // NaN 보다는 parseInt(null)로 명확하게 구분
            var iStorageIndexData = parseInt(null);

            // 상품 상세페이지에서 생성된 세션 스토리지 키
            var sStorageDetailName = 'sStorageDetail';

            // 상품 상세페이지에서 생성된 세션 스토리지 값 (Unix Timestamp)
            // NaN 보다는 parseInt(null)로 명확하게 구분
            var iStorageDetailData = parseInt(null);

            // 현재 시간 Unix Timstamp
            var iNowTime = Math.floor(new Date().getTime() / 1000);

            // 세션 스토리지 유지 시간
            var iSessionTime = 60 * 5;

            // 값 할당 (int)
            try {
                iStorageIndexData = parseInt(sessionStorage.getItem(this.storageId));
                iStorageDetailData = parseInt(sessionStorage.getItem(sStorageDetailName));
            } catch (e) {
            }

            // 저장된 값(추가 이미지)이 삭제된 경우 빈 페이지로 스와이프 되므로, 저장된 인덱스에 해당되는 이미지가 없는 경우는 세션 스토리지 삭제
            if (typeof($S.aButton[iStorageIndexData]) === 'undefined') {
                // 할당된 값 초기화
                iStorageIndexData = parseInt(null);

                // 실제 세션 스토리지에서도 삭제
                try {
                    sessionStorage.removeItem(this.storageId);
                } catch (e) {
                }
            }

            // 값이 있다면 moveTab을 해야 Circle(페이징 원)까지 변경됨
            // 상세페이지에서 생성된 세션 스토리지가 특정 시간이 경과하지 않은 경우에만 처리
            // 만약 모듈에서 상품번호 등의 정보(this.storageId)를 가져오지 못한 경우에는 처리하지 않음
            if (this.storageId !== '' && isNaN(iStorageIndexData) === false && isNaN(iStorageDetailData) === false && iStorageDetailData + iSessionTime >= iNowTime) {
                // 실제 이동 처리
                this.moveTab(iStorageIndexData, 0);
            } else {
                this.slide(this.index, 0);
            }
        } else {
            this.slide(this.index, 0);
        }

        this.container.style.visibility = origVisibility;
    },

    slide: function(index, duration) {
        // if useing ajax load
        try {
            if (oMobileSliderData.sPictorialLoad === true) {
                if ($S.iAjax === index + 1 && $S.bAjax === true) {
                    $S.callAjax();
                }
            }
        } catch (e) {}

        var style = this.element.style;

        // fallback to default speed
        if (duration == undefined) {
          duration = this.speed;
        }

        // set duration speed (0 represents 1-to-1 scrolling)
        style.webkitTransitionDuration = style.MozTransitionDuration = style.msTransitionDuration = style.OTransitionDuration = style.transitionDuration = duration + 'ms';

        // translate to given index position
        style.MozTransform = style.webkitTransform = 'translate3d(' + -(index * this.width) + 'px, 0, 0)';
        style.msTransform = style.OTransform = 'translateX(' + -(index * this.width) + 'px)';

        // set new index to allow for expression arguments
        this.index = index;

        // 현재 모듈의 인덱스를 세선 스토리지에 저장
        // 캐시 사용중이며 인덱스가 있으면서 저장할 스토리지 ID 값이 있는 경우에만 처리
        if (this.cache === 'yes' && isNaN(this.index) === false && this.storageId !== '') {
            try {
                sessionStorage.setItem(this.storageId, this.index);
            } catch (e) {
            }
        }
    },

    getPos: function() {
        // return current index position
        return this.index;
    },

    prev: function(delay, postback) {
        // cancel next scheduled automatic transition, if any
        this.delay = delay || 0;
        this.postback = (postback == undefined) ? true : postback;

        clearTimeout(this.interval);

        if (this.index) {
            this.slide(this.index - 1, this.speed);
        } else {
            if (this.postback !== false) {
                this.slide(this.length - 1, this.speed); //if first slide return to end
            }
        }
    },

    next: function(delay, postback) {
        // cancel next scheduled automatic transition, if any
        this.delay = delay || 0;
        this.postback = (postback == undefined) ? true : postback;

        clearTimeout(this.interval);

        if (this.index < this.length - 1) {
            this.slide(this.index + 1, this.speed);
        } else {
            if (this.postback !== false) {
                this.slide(0, this.speed); //if last slide return to start
            }
        }
    },

    moveTab: function(iPage, delay) {
        // control current tab action
        // 모바일 상품상세에서 slide영역을 다시 원복함
        this.index = iPage;
        this.delay = delay || 0;

        clearTimeout(this.interval);

        this.slide(this.index, this.speed);

        if (typeof(EC_SHOP_FRONT_NEW_OPTION_EXTRA_IMAGE) !== 'undefined') {
            EC_SHOP_FRONT_NEW_OPTION_EXTRA_IMAGE.setSwipeImage('', true, iPage);
        }
    },

    begin: function() {
        var _this = this;

        this.interval = (this.delay) ? setTimeout(function() {
            _this.next(_this.delay);
        }, this.delay) : 0;
    },

    stop: function() {
      this.delay = 0;

      clearTimeout(this.interval);
    },

    resume: function() {
      this.delay = this.options.auto || 0;
      this.begin();
    },

    setLength: function(expand) {
        this.length = expand;
    },

    handleEvent: function(e) {
        switch (e.type) {
            case 'touchstart':
                this.onTouchStart(e);
                break;
            case 'touchmove':
                this.onTouchMove(e);
                break;
            case 'touchcancel':
            case 'touchend':
                this.onTouchEnd(e);
                break;
            case 'webkitTransitionEnd':
            case 'msTransitionEnd':
            case 'oTransitionEnd':
            case 'transitionend':
                this.transitionEnd(e);
                break;
            case 'resize':
                this.setup();
                break;
        }
    },

    transitionEnd: function(e) {
      if (this.delay) {
          this.begin();
      }

      this.callback(e, this.index, this.slides[this.index], this);
    },

    onTouchStart: function(e) {
        this.start = {
          // get touch coordinates for delta calculations in onTouchMove
          pageX: e.touches[0].pageX,
          pageY: e.touches[0].pageY,

          // set initial timestamp of touch sequence
          time: Number(new Date())
        };

        // used for testing first onTouchMove event
        this.isScrolling = undefined;

        // reset deltaX
        this.deltaX = 0;

        // set transition time to 0 for 1-to-1 touch movement
        this.element.style.MozTransitionDuration = this.element.style.webkitTransitionDuration = 0;

        e.stopPropagation();
    },

    onTouchMove: function(e) {
        // ensure swiping with one touch and not pinching
        if (e.touches.length > 1 || e.scale && e.scale !== 1) {
            return;
        }

        this.deltaX = e.touches[0].pageX - this.start.pageX;

        // determine if scrolling test has run - one time test
        if (typeof this.isScrolling == 'undefined') {
            this.isScrolling = !! (this.isScrolling || Math.abs(this.deltaX) < Math.abs(e.touches[0].pageY - this.start.pageY));
        }

        // if user is not trying to scroll vertically
        if (! this.isScrolling) {
            // prevent native scrolling
            e.preventDefault();

            // cancel slideshow
            clearTimeout(this.interval);

            // increase resistance if first or last slide
            this.deltaX =
            this.deltaX /
            ((! this.index && this.deltaX > 0            // if first slide and sliding left
            || this.index == this.length - 1            // or if last slide and sliding right
            && this.deltaX < 0                          // and if sliding at all
            ) ?
            (Math.abs(this.deltaX) / this.width + 1)    // determine resistance level
            : 1);                                       // no resistance if false

            // translate immediately 1-to-1
            this.element.style.MozTransform = this.element.style.webkitTransform = 'translate3d(' + (this.deltaX - this.index * this.width) + 'px,0,0)';

            e.stopPropagation();
        }
    },

    onTouchEnd: function(e) {
        // determine if slide attempt triggers next/prev slide
        var isValidSlide =
            Number(new Date()) - this.start.time < 250      // if slide duration is less than 250ms
            && Math.abs(this.deltaX) > 20                   // and if slide amt is greater than 20px
            || Math.abs(this.deltaX) > this.width/2,        // or if slide amt is greater than half the width

        // determine if slide attempt is past start and end
        isPastBounds =
            ! this.index && this.deltaX > 0                          // if first slide and slide amt is greater than 0
            || this.index == this.length - 1 && this.deltaX < 0;    // or if last slide and slide amt is less than 0

        // if not scrolling vertically
        if (! this.isScrolling) {
            // call slide function with slide end value based on isValidSlide and isPastBounds tests
            this.slide(this.index + (isValidSlide && ! isPastBounds ? (this.deltaX < 0 ? 1 : -1) : 0 ), this.speed);
        }

        e.stopPropagation();
    }
};

/**
 * 모바일 상품 더보기 모듈
 * @package app/Mobile
 * @subpackage Front/Disp/Product
 * @version 2.2
 *
 *
 * version 2.2 변경사항
 * 1. cache = yes 설정으로 더보기 리스트 유지
 * 2. 사용자 html 수정 유무에 상관없이 리스팅
 * 3. api에 $review_cnt 추가
 */
var $M = {
    /*
     * current module name
     */
    sModule : 'xans-product-listnormal',
    /*
     * current module name
     */
    sMore : 'xans-product-listmore',

    /*
     * 더보기 버튼에 대한 중복 실행을 막기 위한 flag
     */
    bLoading : false,

    /*
     * 모듈별로 object 값
     */
    oModuleLoading : {},

    /*
     * init
     */
    init : function() {
        if (this.sModule == 'xans-product-listnormal') {
            // 일반상품에 대해 더보기 기능 적용시 페이징 모듈 자동 삭제
            $('.xans-product-normalpaging').remove();
        }
    },
    /*
     * show more
     * @param int iActive 모듈 key
     * @param int iDisplayGroup 추천/신상품 분류
     * @param int iCategoryNo 카테고리 번호
     * @param int iCount 주석변수 상품 수
     * @param int iSortMethod 정렬방법
     * @param string sSupplierCode 공급사코드
     * @param bool bInitMore 더보기 기능 초기화 여부
     * @param string 품절상품 표시 여부
     */
    displayMore : function(iActive, iDisplayGroup, iCategoryNo, iCount, iSortMethod, bCache, sSupplierCode, bInitMore, sSoldoutDisplay) {

        if (this.oModuleLoading[iDisplayGroup] === true) {
            // 로딩 중에는 실행 안함
            return;
        }

        var EC_MORE = (function() {
            var sTargetModuleName,
                sLiTemplate,
                sFirstLiTemplate,
                $moreButton,
                $currentPageText,
                sCurrentPageCookieName,
                iRequestPageNum;

            /**
             * 추가될 상품 정보가 append될 모듈명
             * @returns {string}
             */
            function getTargetModuleName()
            {
                if (iActive > 0) {
                    return $M.sModule + '-' + iActive;
                } else {
                    return $M.sModule;
                }
            }
            /**
             * LI 템플릿을 리턴합니다.
             * @returns {string}
             */
            function getLiTemplate(sPos)
            {
                var sModuleHtmlForVDOM = EC_FRONT_XANS_TEMPLATE.getTemplateForVDOM(sTargetModuleName);
                var $li = $(sModuleHtmlForVDOM).find('ul:first > li:'+sPos);
                var sLiHtmlForVDOM = $('<ul>').append($li).html();

                return EC_FRONT_XANS_TEMPLATE.convertVDomHtmlToHTML(sLiHtmlForVDOM);
            }
            /**
             * "더보기" 버튼 모듈
             * @returns {jQuery}
             */
            function getMoreButtonElement()
            {
                if (iActive > 0) {
                    return $('.' + $M.sMore + '-' + iActive);
                } else {
                    return $('.' + $M.sMore);
                }
            }
            /**
             * "현재페이지 표시" 영역
             * @returns {jQuery}
             */
            function getCurrentPageTextElement()
            {
                if (iDisplayGroup > 1) {
                    return $('#more_current_page_' + iDisplayGroup);
                } else {
                    return $('#more_current_page');
                }
            }
            /**
             * "캐쉬된 현재페이지" 쿠키명
             * @returns {string}
             */
            function getCachedCurrentPageCookieName()
            {
                var aCookieName = ['mobile_more_current_page'];
                if (iCategoryNo > 0) {
                    aCookieName.push(iCategoryNo);
                }
                if (iDisplayGroup > 1) {
                    aCookieName.push(iDisplayGroup);
                }
                return aCookieName.join('_');
            }
            /**
             * 요청할 페이지 번호를 구하여 리턴합니다.
             * @return int
             *      "더보기 유지 기능 사용" + "더보기 초기화"인 경우 현재 쿠키에 저장된 페이지 번호
             *      그 외에는 다음에 가져올 페이지 번호
             */
            function getRequestPageNum()
            {
                if (bCache === true && bInitMore === true) {
                    // "더보기 유지 기능 사용" + "더보기 초기화"인 경우
                    var sCookieCurrentPage = $.cookie(sCurrentPageCookieName);

                    if (sCookieCurrentPage) {
                        return parseInt(sCookieCurrentPage, 10);
                    } else {
                        return 1;
                    }

                } else {
                    // 그 외
                    var iCurrentPage = $moreButton.data('current_page');

                    if (iCurrentPage === undefined) {
                        iCurrentPage = 1;
                    }

                    return iCurrentPage + 1;
                }
            }
            /**
             * 다음 페이지 상품 정보를 가져올 수 있는 ajax URL을 리턴합니다.
             * @returns string
             */
            function getAjaxUrl()
            {

                var aParam = {
                    cate_no : iCategoryNo,
                    display_group : iDisplayGroup,
                    supplier_code : sSupplierCode,
                    sort_method : iSortMethod,
                    page : iRequestPageNum,
                    count : iCount,
                    bInitMore : (bInitMore === true) ? 'T' : 'F',
                    ec_soldout_display : sSoldoutDisplay
                };

                return EC_MOBILE_UTIL.setAjaxParam(aParam, $M.sModule);
            }
            /**
             * 다음 페이지 상품 정보를 UL Element에 추가해줍니다.
             * @param array aData 상품 정보
             */
            function appendMoreData(aData)
            {
                var aHtml = [];
                var sTemplate = sLiTemplate;
                $(aData).each(function(iIndex, aVar) {
                    if (iIndex === 0) {
                        sTemplate = sFirstLiTemplate;
                    } else {
                        sTemplate = sLiTemplate;
                    }
                    aHtml.push(EC_FRONT_XANS_INTERPRETER.fetch(sTemplate, aVar));
                });
                var sHtml = aHtml.join('');

                $('.' + sTargetModuleName).each(function() {
                    $(this).find('ul:first').append(sHtml);
                });

                $currentPageText.text(iRequestPageNum);
                $moreButton.data('current_page', iRequestPageNum);

                // 캐시 기능 사용이면 쿠키에 현재 페이지 저장
                if (bCache === true) {
                    $.cookie(sCurrentPageCookieName, iRequestPageNum, { expires: 1 });
                }
            }
            /**
             * '더보기' 버튼을 숨김 처리합니다.
             */
            function hideMoreButton()
            {
                $moreButton.remove();
            }

            /**
             * Ajax 요청 여부를 리턴합니다.
             * @return bool true이면 ajax 요청, false이면 ajax 요청 안함
             */
            function isCallAjax()
            {
                if (bInitMore === true && iRequestPageNum <= 1) {
                    // 더보기 유지 기능 동작이고 iRequestPageNum 값이 1이하이면 요청 안함
                    return false;
                }

                return true;
            }

            function setMoreAction(data)
            {
                if (data.rtn_data.end === true) {
                    EC_MORE.hideMoreButton();
                }

                if (data.is_new_product === true) {
                    EC_SHOP_FRONT_REVIEW_TALK_REVIEW_COUNT.setReviewTalkCnt();
                }
            }

            sTargetModuleName = getTargetModuleName();
            sFirstLiTemplate = getLiTemplate('first');
            sLiTemplate = getLiTemplate('last');
            $moreButton = getMoreButtonElement();
            $currentPageText = getCurrentPageTextElement();
            sCurrentPageCookieName = getCachedCurrentPageCookieName();
            iRequestPageNum = getRequestPageNum();

            return {
                isCallAjax: isCallAjax,
                getAjaxUrl: getAjaxUrl,
                appendMoreData: appendMoreData,
                hideMoreButton: hideMoreButton,
                setMoreAction: setMoreAction
            };
        })();

        // ajax
        if (EC_MORE.isCallAjax() === true) {

            var aParamData = {};
            if ($('#ec-product-searchdata-form').length > 0 ) {

                $('#ec-product-searchdata-catenum').val(iCategoryNo);
                EC_FRONT_PRODUCT_SEARCH_DATA.setSearchPriceData();

                $('#ec-product-searchdata-form .ec-product-searchdata-form:checked').each(function(idx) {
                    $(this).val(encodeURIComponent($(this).val()));
                });

                aParamData = $('#ec-product-searchdata-form').serialize();

                $('#ec-product-searchdata-form .ec-product-searchdata-form:checked').each(function(idx) {
                    $(this).val(decodeURIComponent($(this).val()));
                });
            }

            var iGetCategory = iCategoryNo;
            var iGetDisplay = iDisplayGroup;

            if (iGetCategory === 0) {
                iGetCategory = 1;
            }

            if (iGetDisplay === 0) {
                iGetDisplay = 1;
            }

            // 저장된 세선 스토리지 읽어와 처리
            // 각 더보기의 개별 모듈에 해당되는 세션 스토리지 키
            var sStorageListName = 'sStorageList_' + iGetCategory + '_' + iGetDisplay;

            // 각 더보기의 개별 모듈에 해당되는 세션 스토리지 값
            var sStorageListData = null;

            // 상품 상세페이지에서 생성된 세션 스토리지 키
            var sStorageDetailName = 'sStorageDetail';

            // 상품 상세페이지에서 생성된 세션 스토리지 값 (Unix Timestamp)
            var sStorageDetailData = null;

            // 현재 시간 Unix Timstamp
            var iNowTime = Math.floor(new Date().getTime() / 1000);

            // 세션 스토리지 유지 시간
            var iSessionTime = 60 * 5;

            try {
                sStorageListData = sessionStorage.getItem(sStorageListName);
                sStorageDetailData = sessionStorage.getItem(sStorageDetailName);
            } catch (e) {
            }

            // 상세페이지에서 생성된 세션 스토리지가 특정 시간이 경과하지 않은 경우에만 캐싱 데이터 사용
            if (sStorageDetailData !== null && parseInt(sStorageDetailData) + iSessionTime >= iNowTime) {
                if (bInitMore === true && sStorageListData !== null) {
                    var oReturnData = JSON.parse(sStorageListData);

                    EC_MORE.appendMoreData(oReturnData.rtn_data.data);
                    EC_MORE.setMoreAction(oReturnData);

                    return;
                }
            }

            $.ajax({
                type: 'get',
                url: EC_MORE.getAjaxUrl(),
                data: aParamData,
                dataType: 'json',
                success: function(data) {
                    if (data.rtn_code === '1000') {
                        EC_MORE.appendMoreData(data.rtn_data.data);
                        EC_MORE.setMoreAction(data);

                        // 초기 구동이 아니면서 세션 스토리지에 데이터가 있는 경우에는 append
                        if (bInitMore === false && sStorageListData !== null) {
                            data.rtn_data.data = JSON.parse(sStorageListData).rtn_data.data.concat(data.rtn_data.data);
                        }

                        // 최종 생성된 데이터 세션 스토리지에 저장
                        try {
                            sessionStorage.setItem(sStorageListName, JSON.stringify(data));
                        } catch (e) {
                        }
                    } else {
                        alert('상품을 추가로 더 불러오는 과정에 문제가 발생했습니다. 지속적으로 발생할 경우 운영자에게 문의하세요.');

                        EC_MORE.hideMoreButton();

                        return false;
                    }
                },
                error: function (xhr, status, error) {
                    return false;
                },
                beforeSend: function () {
                    $M.oModuleLoading[iDisplayGroup] = true;
                },
                complete: function () {
                    $M.oModuleLoading[iDisplayGroup] = false;
                }
            });
        }
    } ,
    setDisplayPageMore : function(iActive, iDisplayGroup, iCategoryNo, iCount, iSortMethod, bCache, sSupplierCode, bInitMore, sSoldoutDisplay) {
        this.displayMore(iActive, iDisplayGroup, iCategoryNo, iCount, iSortMethod, bCache, sSupplierCode, true, sSoldoutDisplay);
    }
};
/**
 * 모바일 상품 스와이프 모듈
 * @package app/Shop
 * @subpackage Front/Disp/Product
 * @since 2014. 2. 12.
 * @update 2014. 5. 29.
 * @version 2.2
 *
 * 2.2 개선사항
 * 1. 데이터 ajax 로딩 추가
 * 2. multi, single 형태 추가
 */
var $S = {
    /*
     * current module name
     */
    sModule : 'xans-product-listmain',

    /*
     * swipe action name
     */
    sModuleSwipe : '',

    /*
     * mode
     */
    sMode : 'multi',

    /*
     * slider
     */
    bSlider : false,

    /*
     * swipeable
     */
    sSwipeable : 'yes',

    /*
     * sParam
     */
    sParam : '',

    /*
     * grid
     */
    sGrid : 'grid3',

    /*
     * grid array
     */
    aGrid : {'grid2':2, 'grid3':3, 'grid4':4, 'grid5':5},

    /*
     * start slide
     */
    iStart : 0,

    /*
     * page
     */
    iPage : 1,

    /*
     * page block
     */
    iPageBlock : 3,

    /*
     * line
     */
    iLine : 1,

    /*
     * limit circle
     */
    iLimit : 9,

    /*
     * active div
     */
    iActive : 0,

    /*
     * save li element
     */
    aElement : [],

    /*
     * save circle element
     */
    aButton : [],

    /*
     * product class
     */
    $product : null,

    /*
     * product ul
     */
    $productModule : null,

    /*
     * product list li
     */
    $productList : null,

    /*
     * ajax loading
     */
    bAjax : true,

    /*
     * generate dom
     */
    bGenerate : false,

    /*
     * ajax count
     */
    iAjax : 0,

    /*
     * auto slide interval
     */
    iAutoSlideInterval : 0,

    /*
     *  paging ui
     */
    sPagingType : 'circle',

    iProductTotal : 0,

    /*
     * cache 사용여부
     */
    sCache : 'no',

    /*
     * init
     */
    init : function() {
        // set param
        this.setParam();

         // set obejct
        this.setObject();

        // set block
        this.setBlock();

        // validate
        if (this.validate() === false) return;

         // generate
        this.generate();

        // load swipe
        this.load();
    },

    /*
     * set param
     */
    setParam : function() {
        try
        {
            this.sModuleSwipe = this.sModule.replace(/-/g, "_");
            this.iAjax = oMobileSliderData.iSliderLimit;
        }
        catch (e) { }
    },

    /*
     * set block
     */
    setBlock : function() {
        // set block num
        this.iPageBlock = (this.sMode == 'multi') ? this.iLine * this.aGrid[this.sGrid] : 1;
    },

    /*
     * set obejct
     */
    setObject : function() {
        try
        {
            // current module class
            this.sActiveProduct = this.iActive > 0 ? this.sModule + '-'+this.iActive : this.sModule;

            // div
            this.$product = $('.' + this.sActiveProduct);

            // div > ul
            this.$productModule = this.$product.find('ul:first');
            this.$productModule.css('webkit-backface-visibility', 'hidden');

            // div > ul > li > ul > li
            this.$productList = this.$productModule.find('>li');
        }
        catch (e) { }
    },

    /*
     * validate
     */
    validate : function() {
        // not use swipe
        if (this.sSwipeable != 'yes') return false;

        // empty ul
        if (this.$productModule.size() < 1) return false;

        // empty li
        if (this.$productList.size() < 1) return false;

        // mobilemaincategory-slider exception
        if (this.$productModule.find('.afterNone').size() > 0) return true;

        // no condition swipe
        if (this.$productList.size() <= this.iPageBlock) return false;
    },

    /*
     * ganerate swipe single dom
     */
    generate : function() {
        if (this.sMode == 'single') { this.generateSingle(); }
        else { this.generateMulti(); }
    },

    /*
     * prepare for element
     */
    prepare : function() {
        var $prepare = {
            /*
             * reset element and circle
             */
            reset : function() {
                $S.aElement = [];
                $S.aButton = [];
            },

            /*
             * set target id
             */
            setId : function() {
                $S.$product.attr('id', $S.sModule + '-slider-' + $S.iActive);
            }
        }
        $prepare.reset();
        $prepare.setId();
    },

    /*
     * ganerate swipe single dom
     */
    generateSingle : function() {
        // prepare
        this.prepare();

        // make li > ul > li
        for (var i=0; i<this.$productList.size(); i++) {
            this.makeButton(i);
        }

        // call pagenate
        this.makePagenate();
    },


    /*
     * reset grid
     */
    resetGrid : function() {
        for (var sKey in this.aGrid) {
            if (this.$productModule.hasClass(sKey) === true) { this.$productModule.empty().removeClass(sKey); }
        }
    },

    /*
     * ganerate swipe multi dom
     */
    generateMulti : function() {
        // prepare
        this.prepare();

        if (this.bGenerate === false) return;

        // save li
        this.$productList.each(function(){ $S.aElement.push($(this).clone(true)); });

        // delete li and grid2, gird3, grid4
        this.resetGrid();

        this.iProductTotal = this.aElement.length;
        this.iTotalPage = Math.ceil(this.iProductTotal / this.iPageBlock);

        // make li > ul > li
        for (var i=0, k=1, j=0; i<this.iProductTotal; i++, k++)
        {
            // templete for li > ul
            var $template = (j == 0) ? $("<li>", { html: $("<ul>", {'class': this.sGrid} ) } ) : $('<li>', { html: $("<ul>", {'class': this.sGrid} ), css: {'display': 'none'} } );

            // add li > ul
            if (k == 1)
            {
                this.$productModule.append($template);
                // <  현재페이지 / 총페이지 >
                if (this.sPagingType !== 'number') {
                    this.makeButton(j);
                }
            }

            // add li > ul > li
            this.$product.children('ul').children('li').eq(j).children('ul').append(this.aElement[i]);

            // see block
            if (k == this.iPageBlock)
            {
                k = 0;
                j++;
            }
        }

        if (this.sPagingType === 'number') {
            this.makeNumber();
        }
        // not necessary pagenate
        if (i < (parseInt(this.iPageBlock) + 1)) return;

        // call pagenate
        this.makePagenate();
    },

    makeButton : function(iCnt) {
        // ECQAINT-14112 롤링 및 넘버링 타입은 '모바일 환경설정'의 기본 사양에 따라 최대 갯수 5개로 설정
        if (this.sPagingType == 'rolling' || this.sPagingType == 'numbering') {
            this.iLimit = 5;
        } else if (this.sPagingType !== 'circle') {
            this.iLimit = 4;
        }

        var iNum = iCnt + 1,
        sSelected = (iCnt == 0) ? 'selected' : '',
        iPage = Math.ceil(iNum / this.iLimit),
        sLimitStyle = (iNum > this.iLimit) ? 'style="display:none"' : '',
        sName = this.sActiveProduct + '_page_'+iPage+'_'+iNum;

        if (this.sPagingType === 'fix') {
            var sSelected = (iCnt == 0) ? 'this' : 'other';
            this.divPaginateName = 'typeList';
            this.aButton.push( '<li name="'+sName+'" ' + sLimitStyle +'><a class="' + sSelected + '" onclick="$' + this.sModuleSwipe + '_slider_' + this.iActive + '.moveTab(' + iCnt + ', ' + this.iAutoSlideInterval  +');return false;">' + iNum +'</a></li>' );
        } else if (this.sPagingType === 'numbering') {
            this.divPaginateName = 'typeNumber';
        } else if (this.sPagingType === 'rolling') {
            this.divPaginateName = 'typeRoll';
            this.aButton.push('<li class="' + sSelected + '" name="' + sName + '"><a href="#none" onclick="$' + this.sModuleSwipe + '_slider_' + this.iActive + '.moveTab(' + iCnt + ', ' + this.iAutoSlideInterval  +');return false;">' + iNum + '</a></li>');
        } else {
            // circle
            this.divPaginateName = 'typeSwipe';
            this.aButton.push( '<button name="'+sName+'" type="button" ' + sLimitStyle +' class="circle  ' + sSelected + '" onclick="$' + this.sModuleSwipe + '_slider_' + this.iActive + '.moveTab(' + iCnt + ', ' + this.iAutoSlideInterval  +');return false;"><span>' + iNum +'번째 리스트</span></button>' );
        }
    },

    /*
     * make fix number
     */
    makeNumber : function() {
        this.divPaginateName = 'typeTotal';
        sName = this.sModule+'-'+this.iActive+'_page';
        this.aButton.push('<span name="' + sName + '" class="page"><strong>1</strong> / <span>' + this.iTotalPage + '</span></span>');
    },

    /*
     * make pagenation
     */
    makePagenate : function() {
        var sSwipeId = this.sModule + '-swipe-button-' + this.iActive;
        var sPaginateStyle = '';
        var aBtn = [];
        if (this.sPagingType === 'fix') {
            aBtn.push('<p class="prev" onclick="$' + this.sModuleSwipe + '_slider_' + this.iActive + '.prev();return false;"><a href="#none"><span>이전 페이지</span></a></p>');
            aBtn.push('<ol id='+ sSwipeId +'>'+this.aButton.join('')+'</ol>');
            aBtn.push('<p class="next" onclick="$' + this.sModuleSwipe + '_slider_' + this.iActive + '.next();return false;"><a href="#none"><span>다음 페이지</span></a></p>');
        } else if (this.sPagingType === 'numbering') {
            aBtn.push('<p><strong>1</strong> / <span>' + this.$productList.size() + '</span></p>');
        } else if (this.sPagingType === 'rolling') {
            sPaginateStyle = 'position:static;';
            aBtn.push('<ol id='+ sSwipeId +' class="grid' + this.$productList.size() + '">'+this.aButton.join('')+'</ol>');
        } else if (this.sPagingType === 'number') {
            aBtn.push('<p class="prev" onclick="$' + this.sModuleSwipe + '_slider_' + this.iActive + '.prev();return false;"><a href="#none"><span>이전 페이지</span></a></p>');
            aBtn.push(this.aButton.join(''));
            aBtn.push('<p class="next" onclick="$' + this.sModuleSwipe + '_slider_' + this.iActive + '.next();return false;"><a href="#none"><span>다음 페이지</span></a></p>');
        } else {
            aBtn.push( '<button type="button" class="prev" onclick="$' + this.sModuleSwipe + '_slider_' + this.iActive + '.prev();return false;"><span>이전 리스트</span></button>' );
            aBtn.push( '<span id="' + sSwipeId + '">' +  this.aButton.join('') +'</span>' );
            aBtn.push( '<button type="button" class="next" onclick="$' + this.sModuleSwipe + '_slider_' + this.iActive + '.next();return false;"><span>다음 리스트</span></button>' );
        }

        var sPaginateForm = '<div class="paginate '+this.divPaginateName+'" style="' + sPaginateStyle + '">' + aBtn.join('') + '</div>';

        if ($S.bSlider === false) { this.$product.append(sPaginateForm); }
    },

    /*
     * call ajax
     */
    callAjax : function() {
        this.iPage++;
        this.setAjaxParam();

        var $ajaxLoadContainer = {
            load : function() {
                var $load = '<div class="loading"><img src="//img.echosting.cafe24.com/design/skin/mobile/img_loading.gif" alt="" /></div>',
                    $dimmed = '<div class="dimmed"></div>';
                $('body').append($load + $dimmed);
            },
            remove : function() {
                $('body').find('div.loading, div.dimmed').remove();
            }
        };

        $.ajax({
            type : "get",
            url : this.sParam,
            dataType : "json",
            success : function(data){
                try{
                    if (data.rtn_code == '1000') {
                        $(data.rtn_data.data).each(function(index, node) {
                            // new index
                            var newElementIndex = $S.iAjax + index;
                            // append new element
                            $S.$productModule.append(EC_MOBILE_UTIL.convertNode(node));
                            // set onerror img
                            EC_MOBILE_UTIL.setDefaultImage();
                            // element setting
                            $S.$product.find('li').eq(newElementIndex).css({
                                width : $(window).width() + 'px',
                                display : 'table-cell',
                                'vertical-align' : 'top'
                            }).bind('click', function(){ globalPictorlControl($S.$product); });
                        });

                        var len = data.rtn_data.data.length, currentSlider = '$' + $S.sModuleSwipe + '_slider_' + $S.iActive;

                        // set swipe scale
                        $S.$productModule.width($S.$productModule.width() + ($(window).width() * len));
                        // add ajax condition
                        $S.iAjax += len;
                        // stop ajax control
                        if (len < oMobileSliderData.iSliderLimit) { $S.bAjax = false; }
                    } else {
                        alert('상품을 추가로 더 불러오는 과정에 문제가 발생했습니다. 지속적으로 발생할 경우 운영자에게 문의하세요.');
                        return false;
                    }
                } catch(e) {
                    $ajaxLoadContainer.remove();
                }
            },
            error: function(xhr,status,error){
                //alert('네크워크나 상품API연동에 문제가 있습니다. 지속적으로 발생할 경우 운영자에게 문의하세요.');
                return false;
            },
            beforeSend:function(){
                $ajaxLoadContainer.load();
            },
            complete:function() {
                $ajaxLoadContainer.remove();
                // set swipe module length && excute next slider
                var currentSlider = '$' + $S.sModuleSwipe + '_slider_' + $S.iActive;
                eval(currentSlider + '.setLength(' + $S.iAjax + ');');
            }
        });
    },

    /*
     * set Param
     */
    setAjaxParam : function() {
        var aParam = [];

        aParam['cate_no']          = oMobileSliderData.iCategoryNo;
        aParam['page']             = this.iPage;
        aParam['count']            = oMobileSliderData.iSliderLimit;

        this.sParam = EC_MOBILE_UTIL.setAjaxParam(aParam, this.sModule);
    },

    /*
     * load swipe js
     */
    load : function() {
        try
        {
            var aSwipeVars = [],
                $swipe = document.getElementById('' + this.sModule + '-slider-' + this.iActive + ''),
                $now = this.$product.find('div.swipePage').find('span.now');

            if (this.sPagingType !== 'circle') {
                this.$product.find('.typeSwipe .prev, .typeSwipe .next').show();
            }

            // 상품의 고유한 값(상품 번호 및 카테고리 번호 등)을 지정
            // 이렇게 하지 않으면 스와이프 모듈을 하나로 인식하여 처리되기 때문
            var sProductInfo = '';

            // try-catch로 모듈의 상품 정보를 불러와서 처리하고, 정보가 없으면 처리하지 않음
            try {
                sProductInfo = this.$productModule.find('li:first').attr('data-param').replace(/\?/gi, '').replace(/\&\=/gi, '_');
            } catch(e) {
            }

            aSwipeVars.push( '$' + this.sModuleSwipe + '_slider_' + this.iActive + ' = new SwipeClient($swipe, {' );
            aSwipeVars.push( '    startSlide: ' + this.iStart + ',' );
            aSwipeVars.push( '    auto: ' + this.iAutoSlideInterval + ',' );
            aSwipeVars.push( '    cache: \'' + this.sCache + '\',' );
            aSwipeVars.push( '    elementId: \'' + this.sModuleSwipe + '_slider_' + sProductInfo + '\',' );
            aSwipeVars.push( '    callback: function(e, pos, ele, obj) {' );
            aSwipeVars.push( '        if (obj.container.id == "xans-layout-mobilemaincategory-slider-0") { globalCategorySetUi(mode = "init", pos); }' );
            aSwipeVars.push( '        try { if (globalPictorialLoad === true) { globalPictorialSetUi($S.$product, pos) } } catch(e) {}' );
            aSwipeVars.push( '        var iSelectedPos = pos + 1;' );
            aSwipeVars.push( '        if ($S.bSlider === true) { $now.text(iSelectedPos); }' );
            aSwipeVars.push(this.getSwipeButtonDisplay());
            aSwipeVars.push( '    }' );
            aSwipeVars.push( '});' );

            eval(aSwipeVars.join(''));
        }
        catch(e) { }
    },

    getSwipeButtonDisplay : function() {
        var sSelected = 'selected';
        var sChildSelector = '';
        if (this.sPagingType === 'fix') {
            sSelected = 'this';
            sChildSelector = ' > a';
        }

        var sSwipeVars = '';
        if (this.sPagingType === 'number') {
            sSwipeVars = '        $("[name^=\'' + this.sActiveProduct + '_page\'] > strong").text(iSelectedPos);' ;
        } else if (this.sPagingType === 'numbering') {
            sSwipeVars = '$(".' + this.divPaginateName + ' > p > strong").text(iSelectedPos);';
        } else if (this.sPagingType === 'rolling') {
            sSwipeVars = '         $("[name^=\'' + this.sActiveProduct + '_page\']").removeClass(\'' + sSelected + '\');';
            sSwipeVars += '        $("[name=\'' + this.sActiveProduct + '_page_1_"+iSelectedPos+"\']").addClass(\'' + sSelected + '\');';
        } else {
            sSwipeVars = '         var iPage = pos === ' + this.iTotalPage + ' ? Math.ceil(' + this.iTotalPage + ' / $S.iLimit) : Math.ceil(iSelectedPos / $S.iLimit);' ;

            /*
                ECHOSTING-251668 show/hide 조건 삭제

                sSwipeVars += '        if ((pos % $S.iLimit === 0) || (iSelectedPos % $S.iLimit === 0 || iSelectedPos === ' + this.iTotalPage + ')) {';
                sSwipeVars += '        $("[name^=\'' + this.sActiveProduct + '_page\']").hide();';
                sSwipeVars += '        $("[name^=\'' + this.sActiveProduct + '_page_"+iPage+"\']").show();';
                sSwipeVars += '        }';
                sSwipeVars += '        $("[name^=\'' + this.sActiveProduct + '_page\']' + sChildSelector + '").removeClass(\'' + sSelected + '\');';
                sSwipeVars += '        $("[name=\'' + this.sActiveProduct + '_page_"+iPage+"_"+iSelectedPos+"\']' + sChildSelector + '").addClass(\'' + sSelected + '\');';
            */

            sSwipeVars += '        $("[name^=\'' + this.sActiveProduct + '_page\']").hide();';
            sSwipeVars += '        $("[name^=\'' + this.sActiveProduct + '_page_"+iPage+"\']").show();';
            sSwipeVars += '        $("[name^=\'' + this.sActiveProduct + '_page\']' + sChildSelector + '").removeClass(\'' + sSelected + '\');';
            sSwipeVars += '        $("[name=\'' + this.sActiveProduct + '_page_"+iPage+"_"+iSelectedPos+"\']' + sChildSelector + '").addClass(\'' + sSelected + '\');';
        }
        return sSwipeVars;
    }

};
/*! Copyright (c) 2013 Brandon Aaron (http://brandonaaron.net)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Version 3.0.0
 */

(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else {
        // Browser globals
        factory(jQuery);
    }
}(function ($) {
    $.fn.bgiframe = function(s) {
        s = $.extend({
            top         : 'auto', // auto == borderTopWidth
            left        : 'auto', // auto == borderLeftWidth
            width       : 'auto', // auto == offsetWidth
            height      : 'auto', // auto == offsetHeight
            opacity     : true,
            src         : 'javascript:false;',
            conditional : /MSIE 6.0/.test(navigator.userAgent) // expresion or function. return false to prevent iframe insertion
        }, s);

        // wrap conditional in a function if it isn't already
        if (!$.isFunction(s.conditional)) {
            var condition = s.conditional;
            s.conditional = function() { return condition; };
        }

        var $iframe = $('<iframe class="bgiframe"frameborder="0"tabindex="-1"src="'+s.src+'"'+
                           'style="display:block;position:absolute;z-index:-1;"/>');

        return this.each(function() {
            var $this = $(this);
            if ( s.conditional(this) === false ) { return; }
            var existing = $this.children('iframe.bgiframe');
            var $el = existing.length === 0 ? $iframe.clone() : existing;
            $el.css({
                'top': s.top == 'auto' ?
                    ((parseInt($this.css('borderTopWidth'),10)||0)*-1)+'px' : prop(s.top),
                'left': s.left == 'auto' ?
                    ((parseInt($this.css('borderLeftWidth'),10)||0)*-1)+'px' : prop(s.left),
                'width': s.width == 'auto' ? (this.offsetWidth + 'px') : prop(s.width),
                'height': s.height == 'auto' ? (this.offsetHeight + 'px') : prop(s.height),
                'opacity': s.opacity === true ? 0 : undefined
            });

            if ( existing.length === 0 ) {
                $this.prepend($el);
            }
        });
    };

    // old alias
    $.fn.bgIframe = $.fn.bgiframe;

    function prop(n) {
        return n && n.constructor === Number ? n + 'px' : n;
    }

}));
/**
 * Cookie plugin
 *
 * Copyright (c) 2006 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */

/**
 * Create a cookie with the given name and value and other optional parameters.
 *
 * @example $.cookie('the_cookie', 'the_value');
 * @desc Set the value of a cookie.
 * @example $.cookie('the_cookie', 'the_value', { expires: 7, path: '/', domain: 'jquery.com', secure: true });
 * @desc Create a cookie with all available options.
 * @example $.cookie('the_cookie', 'the_value');
 * @desc Create a session cookie.
 * @example $.cookie('the_cookie', null);
 * @desc Delete a cookie by passing null as value. Keep in mind that you have to use the same path and domain
 *       used when the cookie was set.
 *
 * @param String name The name of the cookie.
 * @param String value The value of the cookie.
 * @param Object options An object literal containing key/value pairs to provide optional cookie attributes.
 * @option Number|Date expires Either an integer specifying the expiration date from now on in days or a Date object.
 *                             If a negative value is specified (e.g. a date in the past), the cookie will be deleted.
 *                             If set to null or omitted, the cookie will be a session cookie and will not be retained
 *                             when the the browser exits.
 * @option String path The value of the path atribute of the cookie (default: path of page that created the cookie).
 * @option String domain The value of the domain attribute of the cookie (default: domain of page that created the cookie).
 * @option Boolean secure If true, the secure attribute of the cookie will be set and the cookie transmission will
 *                        require a secure protocol (like HTTPS).
 * @type undefined
 *
 * @name $.cookie
 * @cat Plugins/Cookie
 * @author Klaus Hartl/klaus.hartl@stilbuero.de
 */

/**
 * Get the value of a cookie with the given name.
 *
 * @example $.cookie('the_cookie');
 * @desc Get the value of a cookie.
 *
 * @param String name The name of the cookie.
 * @return The value of the cookie.
 * @type String
 *
 * @name $.cookie
 * @cat Plugins/Cookie
 * @author Klaus Hartl/klaus.hartl@stilbuero.de
 */
jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options = $.extend({}, options); // clone object since it's unexpected behavior if the expired property were changed
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        // NOTE Needed to parenthesize options.path and options.domain
        // in the following expressions, otherwise they evaluate to undefined
        // in the packed version for some reason...
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};
/* Copyright (c) 2007 Paul Bakaus (paul.bakaus@googlemail.com) and Brandon Aaron (brandon.aaron@gmail.com || http://brandonaaron.net)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * $LastChangedDate: 2007-12-20 08:46:55 -0600 (Thu, 20 Dec 2007) $
 * $Rev: 4259 $
 *
 * Version: 1.2
 *
 * Requires: jQuery 1.2+
 */

(function($){

$.dimensions = {
    version: '1.2'
};

// Create innerHeight, innerWidth, outerHeight and outerWidth methods
$.each( [ 'Height', 'Width' ], function(i, name){

    // innerHeight and innerWidth
    $.fn[ 'inner' + name ] = function() {
    if (!this[0]) return;

    var torl = name == 'Height' ? 'Top'    : 'Left',  // top or left
        borr = name == 'Height' ? 'Bottom' : 'Right'; // bottom or right

    return this.is(':visible') ? this[0]['client' + name] : num( this, name.toLowerCase() ) + num(this, 'padding' + torl) + num(this, 'padding' + borr);
    };

    // outerHeight and outerWidth
    $.fn[ 'outer' + name ] = function(options) {
    if (!this[0]) return;

    var torl = name == 'Height' ? 'Top'    : 'Left',  // top or left
        borr = name == 'Height' ? 'Bottom' : 'Right'; // bottom or right

    options = $.extend({ margin: false }, options || {});

    var val = this.is(':visible') ?
    this[0]['offset' + name] :
    num( this, name.toLowerCase() )
    + num(this, 'border' + torl + 'Width') + num(this, 'border' + borr + 'Width')
    + num(this, 'padding' + torl) + num(this, 'padding' + borr);

    return val + (options.margin ? (num(this, 'margin' + torl) + num(this, 'margin' + borr)) : 0);
    };
});

// Create scrollLeft and scrollTop methods
$.each( ['Left', 'Top'], function(i, name) {
    $.fn[ 'scroll' + name ] = function(val) {
    if (!this[0]) return;

    return val != undefined ?

    // Set the scroll offset
    this.each(function() {
    this == window || this == document ?
    window.scrollTo(
    name == 'Left' ? val : $(window)[ 'scrollLeft' ](),
    name == 'Top'  ? val : $(window)[ 'scrollTop'  ]()
    ) :
    this[ 'scroll' + name ] = val;
    }) :

    // Return the scroll offset
    this[0] == window || this[0] == document ?
    self[ (name == 'Left' ? 'pageXOffset' : 'pageYOffset') ] ||
    $.boxModel && document.documentElement[ 'scroll' + name ] ||
    document.body[ 'scroll' + name ] :
    this[0][ 'scroll' + name ];
    };
});

$.fn.extend({
    position: function() {
    var left = 0, top = 0, elem = this[0], offset, parentOffset, offsetParent, results;

    if (elem) {
    // Get *real* offsetParent
    offsetParent = this.offsetParent();

    // Get correct offsets
    offset       = this.offset();
    parentOffset = offsetParent.offset();

    // Subtract element margins
    offset.top  -= num(elem, 'marginTop');
    offset.left -= num(elem, 'marginLeft');

    // Add offsetParent borders
    parentOffset.top  += num(offsetParent, 'borderTopWidth');
    parentOffset.left += num(offsetParent, 'borderLeftWidth');

    // Subtract the two offsets
    results = {
    top:  offset.top  - parentOffset.top,
    left: offset.left - parentOffset.left
    };
    }

    return results;
    },

    offsetParent: function() {
    var offsetParent = this[0].offsetParent;
    while ( offsetParent && (!/^body|html$/i.test(offsetParent.tagName) && $.css(offsetParent, 'position') == 'static') )
    offsetParent = offsetParent.offsetParent;
    return $(offsetParent);
    }
});

function num(el, prop) {
    return parseInt($.curCSS(el.jquery?el[0]:el,prop,true))||0;
};

})(jQuery);

/*
 * jQuery Easing v1.1.1 - http://gsgd.co.uk/sandbox/jquery.easing.php
 *
 * Uses the built in easing capabilities added in jQuery 1.1
 * to offer multiple easing options
 *
 * Copyright (c) 2007 George Smith
 * Licensed under the MIT License:
 *   http://www.opensource.org/licenses/mit-license.php
 */

jQuery.extend(jQuery.easing, {
    easein: function(x, t, b, c, d) {
    return c*(t/=d)*t + b; // in
    },
    easeinout: function(x, t, b, c, d) {
    if (t < d/2) return 2*c*t*t/(d*d) + b;
    var ts = t - d/2;
    return -2*c*ts*ts/(d*d) + 2*c*ts/d + c/2 + b;
    },
    easeout: function(x, t, b, c, d) {
    return -c*t*t/(d*d) + 2*c*t/d + b;
    },
    expoin: function(x, t, b, c, d) {
    var flip = 1;
    if (c < 0) {
    flip *= -1;
    c *= -1;
    }
    return flip * (Math.exp(Math.log(c)/d * t)) + b;
    },
    expoout: function(x, t, b, c, d) {
    var flip = 1;
    if (c < 0) {
    flip *= -1;
    c *= -1;
    }
    return flip * (-Math.exp(-Math.log(c)/d * (t-d)) + c + 1) + b;
    },
    expoinout: function(x, t, b, c, d) {
    var flip = 1;
    if (c < 0) {
    flip *= -1;
    c *= -1;
    }
    if (t < d/2) return flip * (Math.exp(Math.log(c/2)/(d/2) * t)) + b;
    return flip * (-Math.exp(-2*Math.log(c/2)/d * (t-d)) + c + 1) + b;
    },
    bouncein: function(x, t, b, c, d) {
    return c - jQuery.easing['bounceout'](x, d-t, 0, c, d) + b;
    },
    bounceout: function(x, t, b, c, d) {
    if ((t/=d) < (1/2.75)) {
    return c*(7.5625*t*t) + b;
    } else if (t < (2/2.75)) {
    return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
    } else if (t < (2.5/2.75)) {
    return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
    } else {
    return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
    }
    },
    bounceinout: function(x, t, b, c, d) {
    if (t < d/2) return jQuery.easing['bouncein'] (x, t*2, 0, c, d) * .5 + b;
    return jQuery.easing['bounceout'] (x, t*2-d,0, c, d) * .5 + c*.5 + b;
    },
    elasin: function(x, t, b, c, d) {
    var s=1.70158;var p=0;var a=c;
    if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
    if (a < Math.abs(c)) { a=c; var s=p/4; }
    else var s = p/(2*Math.PI) * Math.asin (c/a);
    return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
    },
    elasout: function(x, t, b, c, d) {
    var s=1.70158;var p=0;var a=c;
    if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
    if (a < Math.abs(c)) { a=c; var s=p/4; }
    else var s = p/(2*Math.PI) * Math.asin (c/a);
    return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
    },
    elasinout: function(x, t, b, c, d) {
    var s=1.70158;var p=0;var a=c;
    if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
    if (a < Math.abs(c)) { a=c; var s=p/4; }
    else var s = p/(2*Math.PI) * Math.asin (c/a);
    if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
    return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
    },
    backin: function(x, t, b, c, d) {
    var s=1.70158;
    return c*(t/=d)*t*((s+1)*t - s) + b;
    },
    backout: function(x, t, b, c, d) {
    var s=1.70158;
    return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
    },
    backinout: function(x, t, b, c, d) {
    var s=1.70158;
    if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
    return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
    }
});
/*
 * Metadata - jQuery plugin for parsing metadata from elements
 *
 * Copyright (c) 2006 John Resig, Yehuda Katz, J�örn Zaefferer, Paul McLanahan
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 *
 * Revision: $Id$
 *
 */

/**
 * Sets the type of metadata to use. Metadata is encoded in JSON, and each property
 * in the JSON will become a property of the element itself.
 *
 * There are three supported types of metadata storage:
 *
 *   attr:  Inside an attribute. The name parameter indicates *which* attribute.
 *
 *   class: Inside the class attribute, wrapped in curly braces: { }
 *
 *   elem:  Inside a child element (e.g. a script tag). The
 *          name parameter indicates *which* element.
 *
 * The metadata for an element is loaded the first time the element is accessed via jQuery.
 *
 * As a result, you can define the metadata type, use $(expr) to load the metadata into the elements
 * matched by expr, then redefine the metadata type and run another $(expr) for other elements.
 *
 * @name $.metadata.setType
 *
 * @example <p id="one" class="some_class {item_id: 1, item_label: 'Label'}">This is a p</p>
 * @before $.metadata.setType("class")
 * @after $("#one").metadata().item_id == 1; $("#one").metadata().item_label == "Label"
 * @desc Reads metadata from the class attribute
 *
 * @example <p id="one" class="some_class" data="{item_id: 1, item_label: 'Label'}">This is a p</p>
 * @before $.metadata.setType("attr", "data")
 * @after $("#one").metadata().item_id == 1; $("#one").metadata().item_label == "Label"
 * @desc Reads metadata from a "data" attribute
 *
 * @example <p id="one" class="some_class"><script>{item_id: 1, item_label: 'Label'}</script>This is a p</p>
 * @before $.metadata.setType("elem", "script")
 * @after $("#one").metadata().item_id == 1; $("#one").metadata().item_label == "Label"
 * @desc Reads metadata from a nested script element
 *
 * @param String type The encoding type
 * @param String name The name of the attribute to be used to get metadata (optional)
 * @cat Plugins/Metadata
 * @descr Sets the type of encoding to be used when loading metadata for the first time
 * @type undefined
 * @see metadata()
 */

(function($) {

$.extend({
    metadata : {
    defaults : {
    type: 'class',
    name: 'metadata',
    cre: /({.*})/,
    single: 'metadata'
    },
    setType: function( type, name ){
    this.defaults.type = type;
    this.defaults.name = name;
    },
    get: function( elem, opts ){
    var settings = $.extend({},this.defaults,opts);
    // check for empty string in single property
    if ( !settings.single.length ) settings.single = 'metadata';

    var data = $.data(elem, settings.single);
    // returned cached data if it already exists
    if ( data ) return data;

    data = "{}";

    if ( settings.type == "class" ) {
    var m = settings.cre.exec( elem.className );
    if ( m )
    data = m[1];
    } else if ( settings.type == "elem" ) {
    if( !elem.getElementsByTagName )
    return undefined;
    var e = elem.getElementsByTagName(settings.name);
    if ( e.length )
    data = $.trim(e[0].innerHTML);
    } else if ( elem.getAttribute != undefined ) {
    var attr = elem.getAttribute( settings.name );
    if ( attr )
    data = attr;
    }

    if ( data.indexOf( '{' ) <0 )
    data = "{" + data + "}";

    data = eval("(" + data + ")");

    $.data( elem, settings.single, data );
    return data;
    }
    }
});

/**
 * Returns the metadata object for the first member of the jQuery object.
 *
 * @name metadata
 * @descr Returns element's metadata object
 * @param Object opts An object contianing settings to override the defaults
 * @type jQuery
 * @cat Plugins/Metadata
 */
$.fn.metadata = function( opts ){
    return $.metadata.get( this[0], opts );
};

})(jQuery);

/**
 * Validator
 *
 */
var utilValidator = {
    // focus 위치 설정 number
    iElementNumber: 0,

    /**
     * 휴대폰 패턴 체크
     * @param string|array mMobile
     * @returns {boolean}
     */
    checkMobile : function(mMobile)
    {
        // 국문몰인경우 유효성체크
        if (SHOP.getLanguage() != 'ko_KR') return true;

        var mobile_number_pattern = /01[016789][0-9]{3,4}[0-9]{4}$/;

        // 유효성 체크
        if (typeof(mMobile) == 'string') {
            if (!mobile_number_pattern.test(mMobile)) return false;
            return true;
        }

        // 초기화
        this.iElementNumber = 0;

        if (typeof(mMobile.mobile2) == 'undefined' || typeof(mMobile.mobile3) == 'undefined') return false;

        var mobile2_pattern = /^\d{3,4}$/;
        var mobile3_pattern = /^\d{4}$/;

        if (!mobile2_pattern.test(mMobile['mobile2'])) {
            // mobile2 focus 위치 하도록 설정
            this.iElementNumber = 2;
            return false;
        }

        if (!mobile3_pattern.test(mMobile['mobile3'])) {
            // mobile3 focus 위치 하도록 설정
            this.iElementNumber = 3;
            return false;
        }

        if (!mobile_number_pattern.test(mMobile.mobile1 + mMobile.mobile2 + mMobile.mobile3)) {

            // mobile1 focus 위치 하도록 설정
            this.iElementNumber = 1;
            return false;
        }
        return true;
    },

    /**
     * 일반전화 패턴 체크
     * @param string|array mPhone
     * @returns {boolean}
     */
    checkPhone : function(mPhone)
    {
        // 국문몰인경우 유효성체크
        if (SHOP.getLanguage() != 'ko_KR') return true;

        // 초기화
        this.iElementNumber = 0;

        if (typeof(mPhone.phone2) == 'undefined' || typeof(mPhone.phone3) == 'undefined') return false;

        var phone2_pattern = /^\d{3,4}$/;
        var phone3_pattern = /^\d{4}$/;

        if (!phone2_pattern.test(mPhone['phone2'])) {
            // phone2 focus 위치 하도록 설정
            this.iElementNumber = 2;
            return false;
        }

        if (!phone3_pattern.test(mPhone['phone3'])) {
            // phone3 focus 위치 하도록 설정
            this.iElementNumber = 3;
            return false;
        }

        return true;
    }
};
/**
 * Validator
 *
 */
var utilvalidatorJp = {
    // focus 위치 설정 number
    iElementNumber: 0,

    // 일본 국가 코드
    iCountryPhoneCode: 81,

    /**
     * 휴대폰 패턴 체크
     * @param string|array mMobile
     * @returns {boolean}
     */
    checkMobile : function(mMobile)
    {
        // 국문몰 외 유효성체크
        if (SHOP.getLanguage() == 'ko_KR') return true;

        // 일본국가코드 11자리
        var mobile_number_pattern = /^\d{11}$/;

        // 초기화
        this.iElementNumber = 0;

        if (typeof(mMobile.mobile2) == 'undefined') return false;

        // 국가 번호 일본
        if (this.iCountryPhoneCode != mMobile['mobile1']) {
            return true;
        }

        if (!mobile_number_pattern.test(mMobile.mobile2)) {
            // mobile2 focus 위치 하도록 설정
            this.iElementNumber = 2;
            return false;
        }

        return true;
    },

    /**
     * 일반전화 패턴 체크
     * @param string|array mMobile
     * @returns {boolean}
     */
    checkPhone : function(mPhone)
    {
        // 국문몰 외 유효성체크
        if (SHOP.getLanguage() == 'ko_KR') return true;

        // 10~11 자리
        var phone_number_pattern = /^\d{10,11}$/;

        // 초기화
        this.iElementNumber = 0;

        if (typeof(mPhone.phone2) == 'undefined') return false;

        // 국가 번호 일본
        if (this.iCountryPhoneCode != mPhone['phone1']) {
            return true;
        }

        if (!phone_number_pattern.test(mPhone['phone2'])) {
            // phone2 focus 위치 하도록 설정
            this.iElementNumber = 2;
            return false;
        }

        return true;
    }
};
function utilValidatorFactory() {
    this.createValidator = function () {
        var oValidatorObject;

        if (SHOP.getLanguage() == "ko_KR") {
            oValidatorObject = utilValidator;
        } else {
            oValidatorObject = utilvalidatorJp;
        }
        return oValidatorObject;
    }
}
var utilValidatorController = {
    utilvalidator: "",

    init : function() {
        var utilValidatorFactoryObject = new utilValidatorFactory();
        this.utilvalidator = utilValidatorFactoryObject.createValidator();
    },

    isValidatorObject : function() {
        var sReturn = 'T';
        if (this.utilvalidator == undefined || this.utilvalidator == "") {
            this.init();
        }

        if (this.utilvalidator == undefined || this.utilvalidator == "") {
            sReturn = 'F';
        }
        return sReturn
    },

    existsFunction : function(sMethodName) {
        var sReturn = "F";

        if (typeof this.utilvalidator[sMethodName] === "function") {
            sReturn = "T";
        }
        return sReturn;
    },

    checkMobile : function(mMobile) {
        if (this.isValidatorObject() == "F") {
            return true;
        }

        if (this.existsFunction("checkMobile") == "F") {
            return true;
        }

        return this.utilvalidator.checkMobile(mMobile);
    },

    checkPhone : function(mMobile) {
        if (this.isValidatorObject() == "F") {
            return true;
        }

        if (this.existsFunction("checkPhone") == "F") {
            return true;
        }

        return this.utilvalidator.checkPhone(mMobile);
    },

    getElementNumber : function() {
        if (this.isValidatorObject() == "F") {
            return true;
        }

        return this.utilvalidator.iElementNumber;
    }
}
/**
 * 인증 display
 */

$(document).ready(function(){

    //인증 display
    var displayAuth = new DisplayAuth();
    displayAuth.display();

    $('input[name=member_type], input[name=personal_type], input[name=company_type], input[name=foreigner_type]').bind('click', function(){
        displayAuth.display();
    });


});



var DisplayAuth = function()
{

    this.isNameAuthUse = $('#is_name_auth_use').val();
    this.isIpinAuthUse = $('#is_ipin_auth_use').val();
    this.isEmailAuthUse = $('#is_email_auth_use').val();



    /**
     * 인증 display toggle
     */
    this.display = function()
    {
        // 해외몰의 경우 없어서 그냥 return;
        var $oMemberType = $('input[name=member_type]:checked');
        if ($oMemberType.length < 1) return false;
        
        //회원구분
        var checkMemberType = $('input[name=member_type]:checked').val();
        var memberTypeMap = {'p' :'Person', 'c' : 'Company', 'f' : 'Foreigner'};
        var memberType = memberTypeMap[checkMemberType];

        this.init();

        //사업자 구분은 tr 이 다르기 때문에 따로
        this.displayCompany(memberType);


        this['type' + memberType]();//레이어 toggle (회원 구분에 의한 상세 controll)



    };

    /**
     * 일단 모두 끄고 인증 영역만 show
     */
    this.init = function()
    {
        //인증영역
        $('#authWrap div').hide();//모두 off
        $('#companyWrap').hide();//사업자구분 off

        //사업자가 보여지지 않아야 하는 경우 감춤
        if (displayMemberType.business != 'T') {
            $('#member_type1').hide();
            $('label[for=member_type1]').hide();
        }

        //실명인증 안쓰면 인증wrap 비워버림
        if ($('#member_name_cert_flag').val() == 'F') {
            $('#realNameAuth').html('');
            $('#ipinWrap').html('');
            $('#mobileWrap').html('');
            $('#emailWrap').html('');
            $('#authMember').hide();//회원인증 tr
        } else {
            $('#authWrap').show();//회원인증 wrap
        }

        //기본정보 영역
        $('#nation').hide();

        //상호명 숨김
        $('#companyRow').hide();

        //사업자 번호 숨김
        $('#companyNoRow').hide();

        $('#realNameEncrypt').val('');
    };

    /**
     * 사업자 구분 보여주는 method
     */
    this.displayCompany = function(memberType)
    {
        if (memberType == 'Company') $('#companyWrap').show();//법인사업자 인증
        else  $('#companyWrap').hide();

    };



    /**
     * 개인 회원 인증 영역
     */
    this.typePerson = function()
    {
        $('#personAuth').show();
        $('#personalTypeWrap').show();
        
        // 모바일 웹
        // ECHOSTING-16798 신규 도입 - 휴대폰 인증 처리로 오픈으로 기존 로직 주석처리
        //if ( $('input[name=personal_type]').length < 1 ) {
        //    
        //    $('#auth_tr').hide(); $('#ipin_tr').hide();
        //    
        //    if ($('input[name=personal_type]:checked').val() == 'n' && $('#member_name_cert_flag').val() == 'T') {
        //        $('#auth_tr').show();
        //        $('#rname_tr').show();
        //        $('#rssn_tr').show();
        //       $('#ipin_tr').hide();
        //    } else if ($('input[name=personal_type]:checked').val() == 'i') {
        //        $('#auth_tr').show();
        //        $('#rname_tr').hide();
        //        $('#rssn_tr').hide();
        //        $('#ipin_tr').show();
        //    }
        // }

        $('#nameContents').html('');
        // ECHOSTING-89438 개인 또는 사업자에 따라 이메일 인증 제공 설정
        if ($('#is_email_auth_use').val() == 'T') {
            try {
                // 사업자 + 개인사업자
                if ($('input[name=member_type]:checked').val() == 'c' && $('input[name=company_type]:checked').val() == 'p') {
                    // 이메일 인증 체크시 체크 해제 후 첫번째 인증 수단 체크
                    if ($('input[name=personal_type]:checked').val() == 'e') {
                        $('input[name=personal_type]:eq(0)').attr('checked','checked');
                    }
                    // 인증수단이 이메일 인증인 경우(개인사업자 이메일인증 제공안함)
                    if (mobileWeb) {
                        $("input[name='personal_type'][value='e']").attr('checked',false).attr('fw-filter','').parent().hide();
                    } else {
                        $("input[name='personal_type'][value='e']").attr('checked',false).attr('fw-filter','').hide().next().hide();
                    }
                }
                // 개인회원
                if ($('input[name=member_type]:checked').val() == 'p') {
                        $("input[name='personal_type'][value='e']").attr('fw-filter','isFill').parent().show();
                    if (mobileWeb) {
                    } else {
                        $("input[name='personal_type'][value='e']").attr('fw-filter','isFill').show().next().show();
                    }
                }
            } catch (e) {}
        }

        // 실명인증
        if ($('input[name=personal_type]:checked').val() == 'n' && $('#member_name_cert_flag').val() == 'T') {
            $('#realNameAuth').show();
            this.changeText(userOption['personalName'], userOption['personalSsn']);
        }
        // 아이핀 인증 
        else if ($('input[name=personal_type]:checked').val() == 'i') {
            $('#ipinWrap').show();
            this.changeText(userOption['personalName'], '');
        }
        // 휴대폰 인증 
        else if ($('input[name=personal_type]:checked').val() == 'm') {
            $('#mobileWrap').show();
            this.changeText(userOption['personalName'], '');
        }
        // 이메일 인증 
        else if ($('input[name=personal_type]:checked').val() == 'e') {
            $("input[name='personal_type'][value='e']").attr("checked","checked");
            $('#emailWrap').show();
            this.changeText(userOption['personalName'], '');
            $('#nameContents').html('<input type="text" name="name" id="name" maxlength="20">');
            $('#realNameEncrypt').val('EMAIL_AUTH');
        }
        else {
            $('#realNameAuth').show();

            if ($('#is_display_register_ssn').val() != 'T')  {//주민번호 사용 안하면
                var sSsnText = '';
            } else{
                var sSsnText = userOption['personalSsn'];

                var sSsnContentsHtml = '<input name="ssn1" id="ssn1" type="text" maxLength="6"';

                // 14세 미만 가입 제한 및 인증 필요 시
                if ($('#is_under14_joinable').val() != 'T') {
                    sSsnContentsHtml += 'onchange="checkIsUnder14({ ssn1 : this.value })"';
                }

                sSsnContentsHtml += '> - ';
                sSsnContentsHtml += '<input name="ssn2" id="ssn2" type="password" maxLength="7"/>';

                $('#ssnContents').html(sSsnContentsHtml);
            }

            $('#nameContents').html('<input type="text" name="name" id="name" maxlength="20">');
            this.changeText(userOption['personalName'], sSsnText);
            $('#identification_check_nonauth').show();
        }
      

    };


    /**
     * 사업자 회원 인증 영역
     */
    this.typeCompany = function()
    {

        if ($('input[name=company_type]:checked').val() == 'p') {//개인 사업자
            //개인 인증
            $('#personAuth').show();
            $('#personalTypeWrap').show();          

            //인증방법
            if ($('input[name=personal_type]:checked').val() == 'n') $('#realNameAuth').show();
            else if ($('input[name=personal_type]:checked').val() == 'i') $('#ipinWrap').show();
            else if ($('input[name=personal_type]:checked').val() == 'm') $('#mobileWrap').show();
            else {
                $('#companyRow').show();
                $('#nameContents').html('<input type="text" name="name" id="name">');
            }

            this.changeText(userOption['personalName'], '');
            $('#joinForm #name').show();
            $('#cname').show();//상호명 input
            $('#companyNoRow').show();//사업자 번호

            $('#companyRow').show(); // 상호명 tr show
            $('#companyName').html('<input name="cname" class="inputTypeText" id="cname" type="text" maxLength="20" fw-msg="" fw-label="상호명" fw-filter="isMax[20]" value=""/>');

            this['typePerson']();
        } else {//법인
            $('#businessAuth').show();
            $('#authMember').show();
            $('#authWrap').show();
            $('#businessAuth').show();
            $('#joinForm #name').hide();

            $('#ssnContents').html('');//법인번호
            $('#companyRow').show();//상호명 tr
            $('#cname').hide();//상호명 input
            $('#companyNoRow').show();//사업자번호


            this.changeText(userOption['companyName'], userOption['companySsn']);
        }


    };


    /**
     * 외국인
     */
    this.typeForeigner = function()
    {
        $('#authMember').show();//인증 tr
        $('#authWrap').show();//회원인증 wrap
        $('#foreignerAuth').show();
        $('#nameContents').html('');
        $('#ssnContents').html('');
        //$('#member_type1').hide();

        var sForeignerType = $('input[name=foreigner_type]:checked').val();
        var sTypeMap = {'f' : userOption['foreignerSsn1'], 'p' : userOption['foreignerSsn2'], 'd' : userOption['foreignerSsn3']};
        var sTitle = sTypeMap[sForeignerType];
        if (sForeignerType == 'e') {
            $('#foreignerEmailWrap').show();
            $('#foreigner_ssn').val('').hide().next().hide();
            $('#realNameEncrypt').val('EMAIL_AUTH');
            // 기본정보 영역
            $('#ssnTitle').parent().hide();
            $('#nameContents').html($('#foreigner_name').val());
        } else {
            $('#foreignerPersonWrap').show();
            $('#foreigner_ssn').val('').show().next().show();
            // 기본정보 영역
            $('#ssnTitle').parent().show();
            this.changeText(userOption['personalName'], sTitle);
        }
        $('#nameTitle').parent().show();
        $('#nation').show();
    };





    /**
     * 기본 정보 영역에 있는 부분 text 바꿔주기
     * @param sName 이름 title 영역에 들어갈 text
     * @param sSsn 주민번호 title 영역에 들어갈 text
     */
    this.changeText = function(sName, sSsn)
    {
        //var sReqIcon = ' <img src="//img.echosting.cafe24.com/design/skin/default/member/ico_required.gif" alt="필수" />';
        //$('#nameTitle').html(sName+sReqIcon);
        $('#identification_check_nonauth').hide();

        if ( sSsn == '') {
            $('#ssnTitle').parent().hide();
            $('#identification_check_nonauth').hide();

        } else {
            $('#ssnTitle').parent().show();
        }
        $('#ssnTitle').html(sSsn);
    };


};

//실명인증 encrypt
function checkRealName()
{
    var aTarget = ['joinForm::check_member_type', 'joinForm::real_name', 'joinForm::real_ssn1', 'joinForm::real_ssn2'];
    if (typeof(bModify) == "boolean") {
        aTarget = ['editForm::real_name', 'editForm::real_ssn1', 'editForm::real_ssn2']
    }
    var name = $('#real_name').val();
    var ssn1 = $('#real_ssn1').val();
    var ssn2 = $('#real_ssn2').val();

    if (!name) {
        alert(__('이름을 입력해 주세요.'));
        $('#real_name').focus();
        return false;
    }

    if (!ssn1 || !ssn2) {
        if (!ssn1) { $('#real_ssn1').focus(); } else { $('#real_ssn2').focus(); }
        alert(__('주민등록 번호를 입력해 주세요.'));
        return false;
    }

    if ($('#identification_check0:visible').length > 0) {
        if ($('#identification_check0:visible')[0].checked === false) {
            alert(__('고유식별정보 처리에 동의해 주세요.'));
            $('#identification_check0:visible').focus();
            return false;
        }
    }

    AuthSSL.encrypt(aTarget, 'encryptRequest');
}



//실명인증 callback Ajax
function encryptRequest(sOutput)
{
    var reqData = 'encrypted_str=' + encodeURIComponent(sOutput);

    if (typeof opener_object != 'undefined' && opener_object == 'board') {
        reqData += '&no_dupl_chk=y';
    }
    if (typeof(bModify) == "boolean") {
        reqData += '&bModify=T';
    }

    $.ajax({
        type: 'POST',
        url:  '/exec/front/Member/Realname/',
        data: reqData,
        dataType: 'json',
        success: function(response){
            try {
                alert(response['msg']);

                if (response['passed'] == true) {
                    $('#realNameEncrypt').val(response.registNameAuth);

                    // Protected 실명인증을 위해서 추가한 부분
                    if ($('#nameauth_result').length > 0) {
                        $('#nameauth_search').fadeOut(function() {
                            $('#nameauth_result').html(response.msg).fadeIn();
                        });
                    }

                    AuthSSLManager.weave({
                        'auth_mode'           : 'decryptClient',
                        'auth_string'         : response['data'],
                        'auth_callbackName'   : 'callBackNameAuth'
                   });
                
                 try{
                     // 남 세팅 
                     if ( response['sex'] == '1' ) { $('input[name="is_sex"]')['0'].click(); }
    
                     // 여 세팅
                     else{ $('input[name="is_sex"]')['1'].click(); }
                 }catch(e){}
                 
                }                
            } catch(e) {}

        }

    });
}

function callBackNameAuth(output){
    try {
            var output = decodeURIComponent(output);
            if ( AuthSSLManager.isError(output) == true ) {
                alert(output);
                return;
            }
            var data = AuthSSLManager.unserialize(output);

            $('#nameContents').html(data['name']);
            $('#ssnContents').html(data['ssn1'] + '- *******');

            if (response.needToCheckUnderFourteen == true) checkIsUnder14({ ssn1 : data['ssn1'] });

            if (opener_object == 'board') {
                opener.bNameAuth = false;
            }

            $('div#notify_'+opener_object).show();

    } catch(e) {}
}

function getNameauthValidate()
{
    var name = $('#real_name').val();
    var ssn1 = $('#real_ssn1').val();
    var ssn2 = $('#real_ssn2').val();

    if (!name) {
        alert(__('이름을 입력해 주세요.'));
        $('#real_name').focus();
        return false;
    }

    if (!ssn1 || !ssn2) {
        if (!ssn1) { $('#real_ssn1').focus(); } else { $('#real_ssn2').focus(); }
        alert(__('주민등록 번호를 입력해 주세요.'));
        return false;
    }

    return true;
}
$(document).ready(function() {
    $('#nameauth_bt').unbind().click(function() {
        if (getNameauthValidate() === true) {
            if ($('#identification_check')[0].checked !== true) {
                alert(__('고유식별정보 처리에 동의해 주세요.'));
                $('#identification_check').focus();
                return false;
            }
            AuthSSL.encrypt([ 'nameauth_form::real_name', 'nameauth_form::real_ssn1', 'nameauth_form::real_ssn2'], 'encryptRequest');
        } else {
            return false;
        }
    });
});

/**
 * 만 14세 미만 체크
 * @param object params { birth : 'Ymd', ssn1 : '주민등록번호 앞 7자리' }. 둘 중 하나 필요
 */
function checkIsUnder14(params)
{
    var iBirthYear, iAge;

    params = params || {};

    iBirth = params.ssn1 ? (params.ssn1[0] == '0' ? '20' : '19') + params.ssn1.substring(0, 6) :
                 params.birth ? params.birth : null;    if (iBirth == null) return;

    dateUtil.init({'format' : 'yyyymmdd'});

    iDiff = dateUtil.toDay() - parseInt(iBirth) - 140000;

    if (iDiff < 0) {
        // 14세 미만 회원가입 설정에 따른 안내 메세지 설정
        switch ($('#is_under14_joinable').val()) {
            case 'F':
                $('#under14Msg').text('* 14세 미만 아동은 회원가입 할 수 없습니다.');
                break;
            case 'M':
                $('#under14Msg').text('* 14세 미만 사용자는 법정대리인 동의가 필요합니다.');
                break;
            default:
                $('#under14Msg').text('');
                break;
        }

        $('#under14Msg').removeClass('displaynone');
    } else {
        $('#under14Msg').addClass('displaynone');
    }
}


/**
 *  ipin popup
 */
function ipinPopup( sMallId )
{
    if ( sMallId == "" ) { alert(__('올바르지 않은 요청입니다.')); return false; }

    window.name = 'ipin_parent_window';
    if (bMobileWeb == false) window.open('', 'popupIpin','width=448, height=500');

    //SSL 안타기 위해 joinForm 에서 보내지 않고 직접 만들어 보냄
    var sIpinForm = '<form id="ipinForm" method="post" action="https://i-pin.cafe24.com/ipin/ipin_auth_request.php" class="testClass">';
    sIpinForm += '<input id="ipin_param1" name="ipin_param1" value="join" type="hidden"  />';
    sIpinForm += '<input id="ipin_param2" name="ipin_param2" value="" type="hidden"  />';
    sIpinForm += '<input id="mallId" name="mallId" value="'+sMallId+'" type="hidden"  />';
    sIpinForm += '<input id="version" name="version" value="shop19" type="hidden"  />';
    sIpinForm += '<input id="ipin_returnUrl" name="ipin_returnUrl" value="' + EC_COMMON_UTIL.getProtocol() + '://' + document.domain + '/exec/front/Member/IpinResult/" type="hidden"  />';
    sIpinForm += '</form>';

    if ( $('#ipinForm').html() == null ) $('body').append(sIpinForm);

    $('#ipinForm').attr('target', 'popupIpin');
    $('#ipinForm').submit();
}

/**
 *  mobile auth popup
 */
function mobilePopup( sMallId , AuthModule )
{
    if ( sMallId == "" ) { alert(__('올바르지 않은 요청입니다.')); return false; }

    //SSL 안타기 위해 joinForm 에서 보내지 않고 직접 만들어 보냄
    var sMobileForm = '<form id="MauthForm" name="MauthForm" method="post" action="https://i-pin.cafe24.com/namecheck/echosting/?action=auth" class="testClass">';

    sMobileForm += '<input id="authModule" name="authModule" value="'+AuthModule+'" type="hidden"  />';
    sMobileForm += '<input id="param1" name="param1" value="join" type="hidden"  />';
    sMobileForm += '<input id="param2" name="param2" value="" type="hidden"  />';
    sMobileForm += '<input id="param3" name="param3" value="" type="hidden"  />';
    sMobileForm += '<input id="mallId" name="mallId" value="'+sMallId+'" type="hidden"  />';
    sMobileForm += '<input id="mallVersion" name="mallVersion" value="shop19" type="hidden"  />';
    sMobileForm += '<input id="authType" name="authType" value="mobile" type="hidden"  />';
    sMobileForm += '<input id="returnUrl" name="returnUrl" value="' + EC_COMMON_UTIL.getProtocol() + '://' + document.domain + '/exec/front/Member/MauthResult/" type="hidden"  />';
    sMobileForm += '</form>';    

    if ( $('#MauthForm').html() == null ) $('body').append(sMobileForm);

    fnMobilePopup();
}

/**
 *  mobile auth popup call ECHOSTING-54546 이슈로 추가됨.
 */
function fnMobilePopup() {
    var popupName = 'auth_popup';
    var width  = 410;
    var height = 500;
    var leftpos = screen.width  / 2 - ( width  / 2 );
    var toppos  = screen.height / 2 - ( height / 2 );
    var winopts  = "width=" + width   + ", height=" + height + ", toolbar=no,status=no,statusbar=no,menubar=no,scrollbars=no,resizable=no";
    var position = ",left=" + leftpos + ", top="    + toppos;
    if (bMobileWeb == false) var AUTH_POP = window.open('', popupName, winopts + position);
    document.forms['MauthForm'].target = popupName;
    document.forms['MauthForm'].submit();
}

/**
 * 사업자 인증
 *
 * @package app/Member
 * @subpackage Resource
 * @author 이장규
 * @since 2011. 10. 13.
 * @version 1.0
 *
 */
var CompanyCheck = new function()
{
    /**
     * 사업자 인증 체크 main method
     * @return bool (성공, 실패)
     */
    this.checkDupl = function()
    {
        if ( action() == false) return false;
        
        AuthSSLManager.weave({
            'auth_mode': 'encrypt'
            , 'aEleId': ['joinForm::bname', 'joinForm::bssn1', 'joinForm::bssn2']
            , 'auth_callbackName': 'CompanyCheck.process'
        });
        
    }
    
    /**
     * 인증 process
     */
    this.process = function(sOutput)
    {
        
        $.ajax({
            url: '/exec/front/Member/CheckCompany',
            cache: false,
            type: 'POST',
            dataType: 'json',
            data: '&encrypted_str='+encodeURIComponent(sOutput),
            timeout: 1000,   
            success: function(response){
                alert(response['msg']);
                if (response['passed'] == true) {
                    $('#nameContents').html($('#bname').val());//법인명
                    $('#ssnContents').html($('#bssn1').val() + '-*******');//법인번호
                    $('#companyName').html($('#bname').val());
                    $('#realNameEncrypt').val(response['registNameAuth']);
                }
            }
        });
    }
    
    /**
     * validate
     * @return bool validate 결과
     */
    var action = function()
    {
        if ( $.trim($('#bname').val()).length < 1 ) {
            alert(__('법인명을 입력하세요.'));
            $('#bname').focus();
            return false;
        }
        
        if ($.trim($('#bssn1').val()).length < 1) {
            alert(__('법인번호를 입력하세요.'));
            $('#bssn1').focus();
            return false;
        }
        
        if ($.trim($('#bssn2').val()).length < 1) {
            alert(__('법인번호를 입력하세요.'));
            $('#bssn2').focus();
            return false;
        }
        
        return true;

    }
    

    
    
    
}

/**
 * 외국인 번호 체크
 *
 * @package app/Member
 * @subpackage Resource
 * @author 백충덕, 이장규
 * @since 2011. 10. 17.
 * @version 1.0
 *
 */

/**
 * 외국인 번호 체크
 */
function checkForeignerNumber()
{

    var foreignerType = $('input[name=foreigner_type]:checked').val();
    var foreignerName = $('#foreigner_name').val();
    var foreignerSsn  = $('#foreigner_ssn').val();

    if ($.trim(foreignerName).length < 1) {
        alert(__('이름을 입력해 주세요.'));
        $('#foreigner_name').focus();
        return false;
    }

    if ($.trim(foreignerSsn).length < 1) {
        var sType = '';
        if (foreignerType == 'f') sType = __('외국인 등록번호');
        else if (foreignerType == 'p') sType = __('여권번호');
        else if (foreignerType == 'd') sType = __('국제운전면허증번호');

        alert(sprintf(__('%s를 입력해 주세요.'), sType));
        $('#foreigner_ssn').focus();
        return false;
    }
    
    if ($('#f_identification_check0').length > 0) {
        if ($('#f_identification_check0')[0].checked === false) {
            alert(__('고유식별정보 처리에 동의해 주세요.'));
            $('#f_identification_check0').focus();
            return false;
        }
    }    

    
    AuthSSLManager.weave({
        'auth_mode': 'encrypt'
        , 'aEleId': ['joinForm::foreigner_name', 'joinForm::foreigner_type', 'joinForm::foreigner_ssn']
        , 'auth_callbackName': 'callbackForeignerCheck'
    });
}

/**
 * 외국인 번호 체크 callback
 * */
function callbackForeignerCheck(sOutput)
{
    $.ajax({
        url: '/exec/front/Member/CheckForeigner',
        cache: false,
        type: 'POST',
        dataType: 'json',
        data: '&encrypted_str='+encodeURIComponent(sOutput),
        timeout: 1000,
        success: function(response){
            alert(response['msg']);
            if (response['passed'] == true) {
                $('#realNameEncrypt').val(response['registNameAuth']);
                $('#nameContents').html($('#foreigner_name').val());
                $('#ssnContents').html($('#foreigner_ssn').val());
            }
        }
    });
}

/**
 * 닉네임 중복 체크
 */
function checkNick()
{
    var sNickName = $.trim($('#nick_name').val());
    var bIsLength = checkLength(sNickName);
    
    if (bIsLength['passed'] == false) {
        $('#nickMsg').html(bIsLength['msg']);
        return false;
    }
    
    $.ajax({
        url: '/exec/front/Member/CheckNick',
        cache: false,
        type: 'POST',
        dataType: 'json',
        data: '&nickName=' + sNickName,
        timeout: 1000,   
        success: function(response){
            
            $('#nickMsg').html(response['msg']);
            
            if (response['passed'] == true) { 
                $('#nick_name_confirm').val('T');
            } else {
                $('#nick_name_confirm').val('F');
            }
            
        }
    });
}

/**
 * 닉네임 글자수 체크
 * @param sNickName 닉네임
 * @returns {Boolean}
 */
function checkLength(sNickName)
{
        
    if ($('#nick_name_flag').val() != 'T') return {'passed' : true};//닉네임 사용 안함    
    
    var iBtye = 0;
    
    for (var i = 0; i < sNickName.length; i++) {
        
        if (sNickName.charCodeAt(i) > 128) {
            iBtye += 2;
        } else {
            iBtye += 1;
        }
    }
    
    if (iBtye < 4)
        return {'passed' : false, 'msg' : __('한글 2자 이상/영문 대소문자 4자/숫자 혼용 사용 가능합니다.')};        


    if (iBtye > 20)        
        return {'passed' : false, 'msg' : __('한글 10자 이하/영문 대소문자 20자/숫자 혼용 사용 가능합니다.')};

    return {'passed' : true};
}

/**
 * 아이디 중복 체크
 */
function checkDuplId()
{
    if ($('#etc_subparam_member_id').length > 0) {
        var sMemberId = $('#etc_subparam_member_id').val();
        var aEleId = [$('#etc_subparam_member_id')];
    } else {
        var sMemberId = $.trim($('#joinForm').find('#member_id').val());
        var aEleId = [$('#joinForm #member_id')];
    }

    var bCheck = checkIdValidation(sMemberId);

    if (bCheck['passed'] == false) {
        $('#idMsg').addClass('error').html(bCheck['msg']);
        return false;
    }

    AuthSSLManager.weave({
        'auth_mode': 'encrypt',
        'aEleId': aEleId,
        'auth_callbackName': 'checkIdEncryptedResultForMobile'
    });
}

/**
 * 아이디중복체크 암호화 처리 (모바일)
 * @param output
 */
function checkIdEncryptedResultForMobile(output)
{
    var sEncrypted = encodeURIComponent(output);

    if (AuthSSLManager.isError(sEncrypted) == true) {
        return;
    }

    $.ajax({
        url: '/exec/front/Member/CheckId',
        cache: false,
        type: 'POST',
        dataType: 'json',
        data: '&encrypted_str=' + sEncrypted + '&Country=' + SHOP.getLanguage(),
        timeout: 1000,
        success: function(response){
            var msg = response['msg'];

            try {
                msg = decodeURIComponent(msg);
            } catch (err) {}

            if (response['passed'] == true) {
                $('#idMsg').removeClass('error');
                $('#idMsg').html(msg);
                $('#idDuplCheck').val('T');
            } else {
                $('#idMsg').addClass('error').html(msg);
                $('#idDuplCheck').val('F');
            }
        }
    });
}

/**
 * 글자수 체크
 * @param 회원아이디 닉네임
 * @returns {Boolean}
 */
function checkIdValidation(sMemberId)
{
    if (sMemberId.length == 0 )
        return {'passed' : false, 'msg' : __('아이디를 입력해 주세요.')};

    if (sMemberId.length < 4 || sMemberId.length > 16)
        return {'passed' : false, 'msg' : __('아이디는 영문소문자 또는 숫자 4~16자로 입력해 주세요.')};

    return {'passed' : true};
}

/**
 * 비밀번호 확인 체크
 */
function checkPwConfirm(sType) {

    if (sType == 'new_passwd_confirm') {
        var sPasswdInput = '#new_passwd';
        var sPasswdConfirmInput = '#new_passwd_confirm';
        var sElementIdMsg = '#new_pwConfirmMsg';
    } else if (sType == 'etc_subparam_user_passwd_confirm') {
        var sPasswdInput = '#etc_subparam_passwd';
        var sPasswdConfirmInput = '#etc_subparam_user_passwd_confirm';
        var sElementIdMsg = '#pwConfirmMsg';
    } else {
        var sPasswdInput = '#passwd';
        var sPasswdConfirmInput = '#user_passwd_confirm';
        var sElementIdMsg = '#pwConfirmMsg';
    }

    var sPasswd = $.trim($(sPasswdInput).val());
    var sPasswdConfirm = $.trim($(sPasswdConfirmInput).val());
    
    if (sPasswd != sPasswdConfirm) {
        $(sElementIdMsg).addClass('error').html(__('비밀번호가 일치하지 않습니다.'));        
    } else {
        $(sElementIdMsg).html(' ');
    }
}

/**
 * 이메일 중복 체크
 */
function checkDuplEmail()
{
    var aEleId = [];

    if ( $('#member_id').val() != '' && $('#member_id').val() != undefined ) {
        aEleId.push('member_id');
    }

    if (SHOP.getLanguage() == 'ko_KR') {
        var sEmail = $.trim($('#email1').val())+'@'+$.trim($('#email2').val());

        aEleId.push('email1', 'email2');
    } else {
        if ( $('#etc_subparam_email1').val() != undefined ) {
            var sEmail = $.trim($('#etc_subparam_email1').val());
            aEleId.push('etc_subparam_email1');
        } else {
            var sEmail = $.trim($('#email1').val());
            aEleId.push('email1');
        }
    }

    var bCheck = checkEmailValidation(sEmail);
    if (bCheck['passed'] == false) {
        $('#emailMsg').addClass('error').html(bCheck['msg']);
        return false;
    }

    AuthSSLManager.weave({
        'auth_mode': 'encrypt',
        'aEleId': aEleId,
        'auth_callbackName': 'checkEmailEncryptedResult'
    });

}

/**
 *  * 아이디중복체크 암호화 처리 (모바일)
 *   * @param output
 *    */
function checkEmailEncryptedResult(output)
{
    var sEncrypted = encodeURIComponent(output);

    if (AuthSSLManager.isError(sEncrypted) == true) {
        return;
    }

    $.ajax({
        url: '/exec/front/Member/CheckEmail',
        cache: false,
        type: 'POST',
        dataType: 'json',
        data: '&encrypted_str=' + sEncrypted,
        timeout: 3000,   
        success: function(response){
            var msg = response['msg'];
            try {
                msg = decodeURIComponent(msg);
            } catch (err) {}
            
            if (response['passed'] == true) {
                $('#emailMsg').removeClass('error').html(msg);
                $('#emailDuplCheck').val('T');

                if (SHOP.getLanguage() == 'ja_JP' && response['jp_email_check'] != '') {
                    checkSoftbankEmail(response['jp_email_check']);
                }

                // 중복 체크 성공 
                bCheckedEmailDupl = true;
            } else {
                $('#emailMsg').addClass('error').html(msg);
                $('#emailDuplCheck').val('F');
                bCheckedEmailDupl = false;
            }
            
            // 추천아이디 중복체크 완료 (회원가입, 수정페이지 둘다쓰임)
            var $oMemberId = '';
            if ( $('#etc_subparam_member_id').val() != undefined ) {
                $oMemberId = $('#etc_subparam_member_id');
            } else {
                $oMemberId = $('#joinForm').find('#member_id');
            }
            if ( response['id'] != null && $oMemberId.val() == '' && $('#login_id_type').val() == 'email') {
                $oMemberId.val(response['id']);
                $('#idDuplCheck').val('T');
                $('#idMsg').removeClass('error').html( __('추천아이디이므로 그대로 사용할 수 있으며, 수정도 가능합니다.') );
            }
        }
    });
}

/**
 * 글자수 체크
 * @param 회원아이디 닉네임
 * @returns {Boolean}
 */
function checkEmailValidation(sEmail)
{       
    if (sEmail.length == 0 )
        return {'passed' : false, 'msg' : __('이메일을 입력해 주세요.')};
    
    if (FwValidator.Verify.isEmail(sEmail) == false || sEmail.length > 255)
        return {'passed' : false, 'msg' : __('유효한 이메일을 입력해 주세요.')};

    return {'passed' : true};
}

/**
 * 소프트뱅크 메일여부 체크
 * @param sEmail 이메일주소
 */
function checkSoftbankEmail(jp_email_check)
{
    if (SHOP.getLanguage() != 'ja_JP') return;
    
    // 모바일 구디자인의 경우 emailMsg가 없어서 처리 해줌 ( memberJoin에 같은 소스가 있는데 모바일일 경우 중복 노출 되어 위치 이동 시킴 )
    if ( $("#emailMsg").length > 0) {
        
        if (jp_email_check == 'jp_email_wanning') {
            $('#emailMsg').html('ご入力のアドレスはMMSサービスとなり、大容量のデータ受信ができかねます。');
        }
    } else {
        
        var bExistEmailBtn = false;
        if ($('#check_email_button').length > 0) bExistEmailBtn = true;
        (bExistEmailBtn == true) ? $('#check_email_button').next('p').remove() : $('#email1').next('p').remove();
        
        if (jp_email_check == 'jp_email_wanning') {
            $sInfoText = '<p style="color:#747474;">ご入力のアドレスはMMSサービスとなり、大容量のデータ受信ができかねます。</p>';
            if (bExistEmailBtn) {
                $('#check_email_button').after($sInfoText);
            } else {
                $('#email1').after($sInfoText);
            }
        }
    }
}

/**
 * 가입 정보 확인
 */

$(document).ready(function(){
    $("#ec_shop_confirm-checkingjoininfo_action").click(function(){
        return CheckingJoinInfoOk();
    });
});

function CheckingJoinInfoLayerClose()
{
    $('#ec_shop_member_confirm-infolayer').css("display","none");    
    return false;
}

function CheckingJoinInfoOk()
{
    $("#is_use_checking_join_info").val('F');
    return memberJoinAction();
}

function CheckingJoinInfo() {
    var obj;
    var pobj=$("#ec_shop_member_confirm-infolayer");
    if (pobj.length === 0) {
        return false;
    }
    
    var bExits = true;
    // 가입 사전 체크
    try{
        if (AuthSSL.bIsSsl) {
            var aEleId = FormSSLContainer.aFormSSL['joinForm'].aEleId;        
            AuthSSLManager.weave({
                'auth_mode'        : 'encrypt',
                'aEleId'           : aEleId,
                'auth_callbackName': "CheckingJoinInfoAuthsslSuccess"
            });    
        }
    }catch(e) {    
        bExits=false;
    }
        
    return bExits;
}

function CheckingJoinInfoAuthsslSuccess(sOutput) {
    if ( AuthSSLManager.isError(sOutput) == true ) {
        alert('[Error]\n'+sOutput);
        return;
    }

    $.ajax({
        type: 'POST',
        url:  '/exec/front/Member/Join/',
        data: {"encrypted_str":sOutput,"is_checking_join_info":"T"},
        dataType: 'json',
        success : CheckingJoinInfoCallback
    });
}

function CheckingJoinInfoCallback(response)
{
    try{        
        if (response.result!='1') {
            alert(__(response.msg));
            return true;
        }
    }catch(e){        
    }
    

    var obj;
    var pobj=$("#ec_shop_member_confirm-infolayer");
    pobj.css("display","block");    
    
    // 이름
    if ($("#nameContents > :input").length>0) {
        pobj.find("#ec_shop_member_confirm-name_contents").html( $("#nameContents > :input").val() );        
    } else {
        pobj.find("#ec_shop_member_confirm-name_contents").html( $("#nameContents").text() );        
    }    
    
    // 사업자        
    if ($("#companyRow").css("display")!=="none") {
        
        if ($("#companyName > :input").length>0) {
            $("#ec_shop_member_confirm-company_name").show().find("td").html( $("#companyName > :input").val() );
        } else {
            $("#ec_shop_member_confirm-company_name").show().find("td").html( $("#companyName").text() );
        }
        
        $("#ec_shop_member_confirm-company_ssn").show().find("td").html( $("#cssn").val() );
    } else {
        $("#ec_shop_member_confirm-company_name").hide();
        $("#ec_shop_member_confirm-company_ssn").hide();        
    }
    
    // 인증정보
    obj = $("#ec_shop_member_confirm-ssn_title");
    if(obj.length!==0) {        
        $("#ec_shop_member_confirm-ssn_title").parent().show();        
        if ($("#ssnTitle").parent().css("display")!=="none") {
            pobj.find("#ec_shop_member_confirm-ssn_title").html( $("#ssnTitle").text() );
            pobj.find("#ec_shop_member_confirm-ssn_contents").html( $("#ssnContents").text() );
        }else{            
            $("#ec_shop_member_confirm-ssn_title").parent().hide();            
        }
    }
    
    // 국적
    obj = $("#ec_shop_member_confirm-nation");
    if(obj.length!==0) {        
        $("#ec_shop_member_confirm-nation").show();        
        if ($("#nation").css("display")==="none") {
            $("#ec_shop_member_confirm-nation").hide();            
        }
    }
    
    // city-name, state
    var display="";
    
    display = $('tr:has(td:has(#city_name))').css("display");
    $('tr:has(td:has(#ec_shop_member_confirm_field-city_name))').css("display",display);
    
    display = $('tr:has(td:has(#state_name))').css("display");
    $('tr:has(td:has(#ec_shop_member_confirm_field-state_name))').css("display",display);
    
    // field    
    pobj.find("tr[class!='displaynone'] > td").find("span[id^='ec_shop_member_confirm_field-']").each(function(){
        var name = $(this).attr("id");
        name = name.replace("ec_shop_member_confirm_field-","");

        var query = "[name='"+name+"']";

        if (name==="") {
            return;
        }
        
        // 추가정보 체크박스 처리
        if (name.match(/add\d+/)) {
            query+=",:input[name='"+name+"[]']";
        }        
        else if ( name==="phone" || name==="mobile" || name==="inter_check") {
            query+=",:input[name='"+name+"[]']";
        }


        
        obj = $("#joinForm").find(":input"+query);        
                
        if (obj.length===0) {
            return;
        }

        var type = obj.attr("type");
        var value;        
        if (name==="phone" || name==="mobile") {
            value = obj.map(function () {
                return $(this).val();
            }).get().join('-');
        } else if (name == "is_sms" || name == "is_news_mail" || name == "is_lifetime") {
            value = __('동의안함');
            if (obj.is(":checked") === true) {
                var sTempId = obj.filter(":checked").attr("id");
                value = $("#joinForm").find("label[for='"+sTempId+"']").text();
            }

            if (mobileWeb == true && obj.val() == 'T' && type !== "checkbox") {
                value = __('동의함');
            }
        } else if (type==="text" && obj.length===1) {
            value = obj.val();
        } else if (type==="checkbox" && obj.length>0) {            
            if (name.match(/add\d+/)) {
                value = obj.filter(":checked").map(function(){
                    return $(this).val();
                }).get().join(', ');                                
            } else if (name==="inter_check") {
                value = obj.filter(":checked").map(function(){
                    var sTempId = $(this).attr("id");
                    return $("#joinForm").find("label[for='"+sTempId+"']").text();                    
                }).get().join(', ');
            }
        } else if (type==="select-one") {        
            if (obj.find("option:selected").val()=="") {
                value="";
            } else {
                value = obj.find("option:selected").text();
            }            
        } else if (type==="radio") {            
            var sTempId = obj.filter(":checked").attr("id");
            value = $("#joinForm").find("label[for='"+sTempId+"']").text();
        } else if (name == "addr1" && type==="hidden") {
            // 주소 input 창 변경으로 추가
            value = obj.val();
        }

        if ($('#sUseSeparationNameFlag').val() == "T") {
            var aLastNameObject = ["name", "name_en", "name_phonetic"];
            var iLastNameObjectKey = $.inArray(name, aLastNameObject);
            if (iLastNameObjectKey > -1) {
                if ($("#joinForm").find(':input[name=last_' + aLastNameObject[iLastNameObjectKey] + ']').val() != undefined) {
                    value = obj.val() + " " + $("#joinForm").find(':input[name=last_' + aLastNameObject[iLastNameObjectKey] + ']').val();
                }
            }
        }

        $(this).html(value);
    });
    
    // 미입력값 삭제    
    obj = pobj.find("#ec_shop_member_confirm_field-birth_year");
    if (obj.length!==0) {
        obj.parent().find("span").show();
        if (
                pobj.find("#ec_shop_member_confirm_field-birth_year").text()==="" &&
                pobj.find("#ec_shop_member_confirm_field-birth_month").text()==="" &&
                pobj.find("#ec_shop_member_confirm_field-birth_day").text()===""
        ) {
            obj.parent().find("span").hide();
        }        
    }
    
    obj = pobj.find("#ec_shop_member_confirm_field-marry_year");
    if (obj.length!==0) {
        obj.parent().find("span").show();
        if (
                pobj.find("#ec_shop_member_confirm_field-marry_year").text()==="" &&
                pobj.find("#ec_shop_member_confirm_field-marry_month").text()==="" &&
                pobj.find("#ec_shop_member_confirm_field-marry_day").text()===""
        ) {
            obj.parent().find("span").hide();
        }
    }
    
    obj = pobj.find("#ec_shop_member_confirm_field-partner_year");
    if (obj.length!==0) {
        obj.parent().find("span").show();
        if (
                pobj.find("#ec_shop_member_confirm_field-partner_year").text()==="" &&
                pobj.find("#ec_shop_member_confirm_field-partner_month").text()==="" &&
                pobj.find("#ec_shop_member_confirm_field-partner_day").text()===""
        ) {
            obj.parent().find("span").hide();
        }
    }
    
    return true;
}
var memberCommon = (function() {

    var oAgreeCheckbox = [
        {"obj": $('input:checkbox[name="agree_service_check[]"]')},//이용약관 동의
        {"obj": $('input:checkbox[name="agree_privacy_check[]"]')}, // 개인정보 수집 및 이용 동의
        {"obj": $('input:checkbox[name="agree_information_check[]"]'), "sIsDisplayFlagId":"display_agree_information_check_flag"}, // 개인정보 제3자 제공 동의(선택)
        {"obj": $('input:checkbox[name="agree_consignment_check[]"]'), "sIsDisplayFlagId":"display_agree_consignment_check_flag"}, // 개인정보 처리 위탁 동의
        {"obj": $('input:checkbox[name="is_sms"]'), "sIsDisplayFlagId":"required_is_sms_flag"}, // sms 수신 동의
        {"obj": $('input:checkbox[name="is_news_mail"]'), "sIsDisplayFlagId":"required_is_news_mail_flag"}, // 이메일 수신 동의
        {"obj": $('#sMarketingAgreeAllChecked')} // mobile 이메일 수신, sms 수신 동의 전체 체크
    ];

    var oMarketingAgreeCheckbox = [
        {"obj": $('input:checkbox[name="is_sms"]'), "sIsDisplayFlagId":"required_is_sms_flag"}, // sms 수신 동의
        {"obj": $('input:checkbox[name="is_news_mail"]'), "sIsDisplayFlagId":"required_is_sms_flag"}, // 이메일 수신 동의
    ];

    var oMarketingAgreeAllChecked = $('input:checkbox[id="sMarketingAgreeAllChecked"]');

    /**
     * 약관 일괄 동의 체크
     */
    function agreeAllChecked()
    {
        var bAgreeAllChecked = $('input:checkbox[id="sAgreeAllChecked"]').is(":checked");

        if (bAgreeAllChecked.length < 1) {
            return;
        }

        $.each(oAgreeCheckbox, function(i, oVal) {
            if (oVal.obj.length < 1) {
                // continue
                return true;
            }

            if (bAgreeAllChecked === true) {
                if ($('#'+oVal.sIsDisplayFlagId).length > 0) {
                    if ($('#'+oVal.sIsDisplayFlagId).val() != "T") {
                        return true;
                    }
                }
                oVal.obj.attr("checked", true);
            } else {
                oVal.obj.attr("checked", false);
            }
        });
    }

    /**
     * 약관 일괄 동의 체크 or 해제 처리
     */
    function agreeAllUnChecked(obj)
    {
        if (obj.length < 1) {
            return;
        }
        var sIsUnchecked = "F";
        if (obj.is(":checked") === false) {
            if ($('input:checkbox[id="sAgreeAllChecked"]').length > 0) {
                $('input:checkbox[id="sAgreeAllChecked"]').attr("checked", false);
            }
            sIsUnchecked = "T";

            // 모바일 쇼핑정보 수신 동의 선택 박스 언체크
            if (obj.attr("name") == "is_sms" || obj.attr("name") == "is_news_mail") {
                if (memberCommon.oMarketingAgreeAllChecked.length > 0) {
                    memberCommon.oMarketingAgreeAllChecked.attr("checked", false);
                }
            }
        }
        return sIsUnchecked;
    }

    /**
     * 모바일 마케팅 약관 일괄 동의 체크
     */
    function marketingAgreeAllCheckboxIsChecked()
    {
        var sIsAllChecked = "T";

        $.each(memberCommon.oMarketingAgreeCheckbox, function(i, oVal) {
            if (oVal.length < 1) {
                // continue
                return true;
            }

            if (oVal.obj.is(":checked") === false) {
                sIsAllChecked = "F";
                return false;
            }
        });

        if (sIsAllChecked == "T") {
            if (memberCommon.oMarketingAgreeAllChecked.length > 0) {
                memberCommon.oMarketingAgreeAllChecked.attr("checked", true);
            }
        }
    }

    /**
     * 모바일 sms, email 수신 동의 전체 선택
     */
    function marketingAllChecked()
    {
        if (memberCommon.oMarketingAgreeAllChecked.length < 1) {
            return;
        }
        var bAgreeAllChecked = memberCommon.oMarketingAgreeAllChecked.is(":checked");

        $.each(memberCommon.oMarketingAgreeCheckbox, function(i, oVal) {
            if (oVal.obj.length < 1) {
                // continue
                return true;
            }

            if (bAgreeAllChecked === true) {
                if ($('#'+oVal.sIsDisplayFlagId).length > 0) {
                    if ($('#'+oVal.sIsDisplayFlagId).val() != "T") {
                        return true;
                    }
                }
                oVal.obj.attr("checked", true);
            } else {
                oVal.obj.attr("checked", false);
            }
        });
    }

    /**
     * 모바일 sms, email 수신 동의 필수 입력 제거
     */
    function marketingRemoveFilter()
    {
        // sms 수신 동의
        if ($('input:checkbox[name="is_sms"]').length > 0) {
            if ($('input:checkbox[name="is_sms"]').attr("fw-filter").indexOf("isFill") > -1) {
                $('input:checkbox[name="is_sms"]').removeAttr("fw-filter");
            }
        }

        // 이메일 수신 동의
        if ($('input:checkbox[name="is_news_mail"]').length > 0) {
            if ($('input:checkbox[name="is_news_mail"]').attr("fw-filter").indexOf("isFill") > -1) {
                $('input:checkbox[name="is_news_mail"]').removeAttr("fw-filter");
            }
        }
    }

    /**
     * 전체 동의 외 체크박스 모두 체크시 전체 동의 체크
     */
    function eachCheckboxAgreeAllChecked()
    {
        var sIsAllChecked = "T";

        $.each($('.agreeArea'), function(i, oVal) {
            if (($(oVal).hasClass('displaynone')) === true) {
                return true;
            }

            $.each($(oVal).find("input:checkbox"), function(j, oVal2) {
                // 심플디자인 전체 동의 버튼 제외 처리
                if ($(oVal2).attr('id') == "sAgreeAllChecked") {
                    return true;
                }
                
                if ($(oVal2).is(":checked") === false) {
                    sIsAllChecked = "F";
                    return false;
                }
            });
        });

        if (sIsAllChecked == "T") {
            $('input:checkbox[id="sAgreeAllChecked"]').attr("checked", true);
        }
    }

    /**
     * 모바일 유효성 패턴 체크
     */
    function isValidMobile()
    {
        // 모바일 등록 여부
        if ($('#mobile2').length < 1 && $('#mobile3').length < 1) {
            return true;
        }

        // 모바일 등록 여부
        if ( SHOP.getLanguage() == 'ko_KR' ) {
            if ($('#mobile1').length < 1 && $('#mobile2').length < 1 && $('#mobile3').length < 1) {
                return true;
            }
        } else {
            if ($('#mobile1').length < 1 && $('#mobile2').length < 1) {
                return true;
            }
        }

        // 휴대폰 패턴체크
        var aMobile = {};

        if ($('#mobile1').length > 0) {
            aMobile.mobile1 = $('#mobile1').val();
        }

        if ($('#mobile2').length > 0) {
            aMobile.mobile2 = $('#mobile2').val();
        }

        if ($('#mobile3').length > 0) {
            aMobile.mobile3 = $('#mobile3').val();
        }

        if (utilValidatorController.checkMobile(aMobile) === true) {
            return true;
        }

        alert(__('올바른 휴대전화번호를 입력 하세요.'));

        var iElementNumber = utilValidatorController.getElementNumber();

        // focus 처리
        if (iElementNumber == 1) {
            $('#mobile1').focus();
        } else if (iElementNumber == 2) {
            $('#mobile2').focus();
        } else if (iElementNumber == 3) {
            $('#mobile3').focus();
        }
        return false;
    }

    /**
     * 모바일번호 회원가입 유효성 체크
     * @return boolean
     */
    function checkJoinMobile()
    {
        // 회원 가입 휴대전화 필수입력 체크를 기존에 추가로 해 주고 있는 부분 추가
        if ($('#is_display_register_mobile').val() == 'T') {
            if ( $.trim($('#mobile1').val()) == '' || $.trim($('#mobile2').val()) == '' || ($('#mobile3').length > 0 && $.trim($('#mobile3').val()) == '')) {
                alert(__('휴대전화를  입력해주세요.'));
                $('#mobile1').focus();
                return false;
            }
        }

        if (memberCommon.isJoinMobileValidPassConditionCheck() === true) {
            return true;
        }

        if (memberCommon.isValidMobile() === true) {
            return true;
        }
        return false;
    }

    /**
     * 모바일번호 유효성 체크
     * @return boolean
     */
    function checkEditMobile()
    {
        // 회원 정보 수정 휴대전화 필수입력 체크를 기존에 추가로 해 주고 있는 부분 추가
        if ($('#is_display_register_mobile').val() == 'T') {
            if ($.trim($('#mobile1').val()) == '' || $.trim($('#mobile2').val()) == '') {
                alert(__('올바른 휴대전화번호를 입력하세요.'));
                $('#mobile2').focus();
                return false;
            }
        }

        if (memberCommon.isEditMobileValidPassConditionCheck() === true) {
            return true;
        }

        if (memberCommon.isValidMobile() === true) {
            return true;
        }
        return false;
    }

    /**
     * 회원가입 유효성 체크 통과 케이스
     * @returns {boolean}
     */
    function isJoinMobileValidPassConditionCheck()
    {
        // 회원 가입 항목 상세 설정 && 일반전화 항목 등록 설정 후 다시 기본 항목 설정으로 변경시  일반전화 항목 미입력으로 설정으로 복구 되지 않는다.
        // 기존 설정 유지되는 부분이 있어 예외처리
        if ($("#useSimpleSignin").length > 0) {
            // 기본 회원가입항목
            if ($("#useSimpleSignin").val() == 'T') {
                // 휴대전화 항목 등록 항목 노출 && 휴대전화 필수입력
                if ($('#display_register_mobile').val() != "T" || $('#display_required_cell').val() != "T") {
                    return true;
                }
            }
        }

        if (SHOP.getLanguage() == 'ko_KR') {
            // 상세항목 회원가입 모바일 필수입력만 체크
            if ($('#display_required_cell').val() != "T") {
                return true;
            }
        } else {
            // 해외몰 모바일사용여부 && 필수입력 체크
            if ($('#is_display_register_mobile').val() != "T" || $('#display_required_cell').val() != "T") {
                return true;
            }
        }
        return false;
    }

    /**
     * 회원정보 수정 유효성 체크 통과 케이스
     * 회원가입과 동일하게 유지
     * @returns {boolean}
     */
    function isEditMobileValidPassConditionCheck()
    {
        if (memberCommon.isJoinMobileValidPassConditionCheck() === true) {
            return true;
        }
        return false;
    }

    /**
     * 일반전화 유효성 체크
     * @return boolean
     */
    function isValidPhone()
    {
        // 일반전화 등록 여부
        if ( SHOP.getLanguage() == 'ko_KR' ) {
            if ($('#phone1').length < 1 && $('#phone2').length < 1 && $('#phone3').length < 1) {
                return true;
            }
        } else {
            if ($('#phone1').length < 1 && $('#phone2').length < 1) {
                return true;
            }
        }

        // 일반전화 패턴체크
        var aPhone = {};

        if ($('#phone1').length > 0) {
            aPhone.phone1 = $('#phone1').val();
        }

        if ($('#phone2').length > 0) {
            aPhone.phone2 = $('#phone2').val();
        }

        if ($('#phone3').length > 0) {
            aPhone.phone3 = $('#phone3').val();
        }

        if (utilValidatorController.checkPhone(aPhone) === true) {
            return true;
        }

        alert(__('올바른 전화번호를 입력하세요.'));

        var iElementNumber = utilValidatorController.getElementNumber();

        // focus 처리
        if (iElementNumber == 1) {
            $('#phone1').focus();
        } else if (iElementNumber == 2) {
            $('#phone2').focus();
        } else if (iElementNumber == 3) {
            $('#phone3').focus();
        }
        return false;
    }

    /**
     * 일반전화 회원가입 유효성 체크 통과 케이스
     */
    function isJoinPhoneValidPassConditionCheck()
    {
        // 회원 가입 항목 상세 설정 && 일반전화 항목 등록 설정 후 다시 기본 항목 설정으로 변경시  일반전화 항목 미입력으로 설정으로 복구 되지 않는다.
        // 기존 설정 유지되는 부분이 있어 예외처리
        if ($("#useSimpleSignin").length > 0) {
            if ($("#useSimpleSignin").val() == 'T') {
                return true;
            }
        }

        if (SHOP.getLanguage() == 'ko_KR') {
            // 상세항목 회원가입 일반전화 필수입력만 체크
            if ($('#display_required_phone').val() != "T") {
                return true;
            }
        } else {
            // 해외몰 일반전화 사용여부 && 필수입력 체크
            if ($('#is_display_register_phone').val() != "T" || $('#display_required_phone').val() != "T") {
                return true;
            }
        }
    }

    /**
     * 일반전화 회원정보 수정 유효성 체크 통과 케이스
     */
    function isEditPhoneValidPassConditionCheck()
    {
        if (SHOP.getLanguage() == 'ko_KR') {
            // 상세항목 회원가입 일반전화 필수입력만 체크
            if ($('#display_required_phone').val() != "T") {
                return true;
            }
        } else {
            // 해외몰 일반전화 사용여부 && 필수입력 체크
            if ($('#is_display_register_phone').val() != "T" || $('#display_required_phone').val() != "T") {
                return true;
            }
        }
    }

    /**
     * 일반전화 회원가입 유효성 체크
     * @return boolean
     */
    function checkJoinPhone()
    {
        if (memberCommon.isJoinPhoneValidPassConditionCheck() === true) {
            return true;
        }

        if (memberCommon.isValidPhone() === true) {
            return true;
        }
        return false;
    }

    /**
     * 일반전화 회원정보 수정 유효성 체크
     * @return boolean
     */
    function checkEditPhone()
    {
        if (memberCommon.isEditPhoneValidPassConditionCheck() === true) {
            return true;
        }

        if (memberCommon.isValidPhone() === true) {
            return true;
        }
        return false;
    }

    return {
        oAgreeCheckbox: oAgreeCheckbox,
        oMarketingAgreeCheckbox: oMarketingAgreeCheckbox,
        oMarketingAgreeAllChecked: oMarketingAgreeAllChecked,
        agreeAllChecked: agreeAllChecked,
        marketingAgreeAllCheckboxIsChecked: marketingAgreeAllCheckboxIsChecked,
        marketingAllChecked: marketingAllChecked,
        agreeAllUnChecked: agreeAllUnChecked,
        marketingRemoveFilter: marketingRemoveFilter,
        eachCheckboxAgreeAllChecked: eachCheckboxAgreeAllChecked,
        checkJoinMobile: checkJoinMobile,
        checkEditMobile: checkEditMobile,
        isJoinMobileValidPassConditionCheck: isJoinMobileValidPassConditionCheck,
        isEditMobileValidPassConditionCheck: isEditMobileValidPassConditionCheck,
        isJoinPhoneValidPassConditionCheck: isJoinPhoneValidPassConditionCheck,
        isEditPhoneValidPassConditionCheck: isEditPhoneValidPassConditionCheck,
        checkJoinPhone: checkJoinPhone,
        checkEditPhone: checkEditPhone,
        isValidPhone: isValidPhone,
        isValidMobile: isValidMobile
    }
})();

var obj_checkessn = {

        getradioinx : function(obj_name) {
            var obj = document.getElementsByName(obj_name);
            for ( var i = 0; i < obj.length; i++) {
                if (obj[i].checked == true) { return i; }
            }
        },

        init : function(sFormName) {
            String.prototype.trim=function() {
                  var str=this.replace(/(\s+$)/g,"");
                  return str.replace(/(^\s*)/g,"");
            }

            //파라미터가 있는경우 해당 폼
            if (typeof(sFormName) != "undefined") {
                this.registForm = document.forms[sFormName];
            }
            
            //파라미터 없는경우 회원 가입 폼
            else {
            this.registForm = document.joinForm;
            }

            
            this.msg_tail = __("은(는) 필수 항목 입니다.");
        },

        // 각 항목별로 체크로직 호출 성공 시 this.successCnt 증가
        switch_action : function( key ) {
            var result;
            if (key.indexOf('|') > -1) {
                var keys = key.split('|');
                result = eval('this.check_'+keys['0']+'('+keys['1']+');');
            } else {
                result = eval('this.check_'+key+'();');
            }
            
            if ( result == false ) { return false; }
        },

        // 닉네임 체크 //
        check_nick_name_flag : function( ) {

            check_nick_name_essn = true; // 닉네임이 필수항목이라고 알려줌.

            if ( this.registForm.nick_name.value.trim() == "" ) {
                alert( this.complete_alert_msg(__('별명')) );
                this.registForm.nick_name.focus();
                return false;
            }
        },

        // 생일 체크 //
        check_is_birthday : function() {
            if ( this.registForm.birth_year && this.registForm.birth_month && this.registForm.birth_day ) {
                if ( this.registForm.birth_year.value.trim() == "" || this.registForm.birth_month.value.trim() == "" || this.registForm.birth_day.value.trim() == "") {
                    alert( this.complete_alert_msg(__('생년월일')) );
                    this.registForm.birth_year.focus();
                    return false;
                }
            }
        },

        // 결혼 기념일 체크 //
        check_is_wedding_anniversary : function() {
            if ( this.registForm.marry_year.value.trim() == "" || this.registForm.marry_month.value.trim() == "" || this.registForm.marry_day.value.trim() == "") {
                alert( this.complete_alert_msg(__('결혼기념일')) );
                this.registForm.marry_year.focus();
                return false;
            }
        },

        // 배우자 생일 체크 //
        check_is_life_partner : function() {
            if ( this.registForm.partner_year.value.trim() == "" || this.registForm.partner_month.value.trim() == "" || this.registForm.partner_day.value.trim() == "") {
                alert( this.complete_alert_msg(__('배우자생일')) );
                this.registForm.partner_year.focus();
                return false;
            }
        },
        
        // 추가항목5~15 체크
        check_addEtc : function(key) {
            var bValid = true;
            
            var iGroupNo = $(this.registForm).find("input[name='addEtc"+key+"']").val();
            
            var oForm = $(this.registForm).find("input[name='add"+iGroupNo+"']");
            if (oForm.attr("type") == 'text' && oForm.length == 1) {
                if ( oForm.val().trim() == "" ) {
                    $(this.registForm).find("input[name='add"+iGroupNo+"']")[0].focus();
                    bValid = false;
                }    
            } else {
                bValid = this.add_option_check('add'+iGroupNo);
            }
            
            if (bValid == false) {
                alert( this.complete_alert_msg($('#add'+iGroupNo+'_name').val()) );
            }
            
            return bValid;
        },

        // 추가항목1 체크
        check_add1 : function() {
            var bValid = true;
            
            var oForm = $(this.registForm).find("input[name='add1']");
            if (oForm.attr("type") == 'text' && oForm.length == 1) {
                if ( oForm.val().trim() == "" ) {
                    $(this.registForm.add1)[0].focus();
                    bValid = false;
                }    
            } else {
                bValid = this.add_option_check('add1');
            }
            
            if (bValid == false) {
                alert( this.complete_alert_msg(this.registForm.add1_name.value) );
            }
            
            return bValid;
        },

        // 추가항목2 체크 //
        check_add2 : function() {
            var bValid = true;
            
            var oForm = $(this.registForm).find("input[name='add2']");
            if (oForm.attr("type") == 'text' && oForm.length == 1) {
                if ( oForm.val().trim() == "" ) {
                    $(this.registForm.add2)[0].focus();
                    bValid = false;
                }    
            } else {
                bValid = this.add_option_check('add2');
            }
            
            if (bValid == false) {
                alert( this.complete_alert_msg(this.registForm.add2_name.value) );
            }
            
            return bValid;
        },


        // 추가항목3 체크 //
        check_add3 : function() {
            var bValid = true;
            
            var oForm = $(this.registForm).find("input[name='add3']");
            if (oForm.attr("type") == 'text' && oForm.length == 1) {
                if ( oForm.val().trim() == "" ) {
                    $(this.registForm.add3)[0].focus();
                    bValid = false;
                }    
            } else {
                bValid = this.add_option_check('add3');
            }
            
            if (bValid == false) {
                alert( this.complete_alert_msg(this.registForm.add3_name.value) );
            }
            
            return bValid;
        },

        // 추가항목4 체크 //
        check_add4 : function() {
            var bValid = true;
            
            var oForm = $(this.registForm).find("input[name='add4']");
            if (oForm.attr("type") == 'text' && oForm.length == 1) {
                if ( oForm.val().trim() == "" ) {
                    $(this.registForm.add4)[0].focus();
                    bValid = false;
                }    
            } else {
                bValid = this.add_option_check('add4');
            }
            
            if (bValid == false) {
                alert( this.complete_alert_msg(this.registForm.add4_name.value) );
            }
            
            return bValid;
        },
        
        //추가항목 라디오 또는 체크박스의 경우 필수 체크
        add_option_check : function(sGroupName)
        {
            var sSelectorName = '';
            var oForm = $(this.registForm).find("input[name='"+ sGroupName +"']");
            if (oForm.attr("type") == 'radio') {
                sSelectorName = "input[name='"+ sGroupName +"']";
            } else {
                sSelectorName = "input[name='"+ sGroupName +"[]']";
            }
            
            if ($(this.registForm).find(sSelectorName + ":checked").length == 0){
                $(this.registForm).find(sSelectorName)[0].focus();
                return false;
            } else {
                return true;
            }
        },

        //  인터넷 사용장소  //
        check_internet : function() {
            if ( this.registForm.internet.value.trim() == "internet_00" ) {
                alert( this.complete_alert_msg(__('인터넷 이용장소')) );
                this.registForm.internet.focus();
                return false;
            }
        },

        //  자동차    //
        check_car : function() {

            if ( this.registForm.car.value.trim() == "car_00" ) {
                alert( this.complete_alert_msg(__('자동차')) );
                this.registForm.car.focus();
                return false;
            }
        },

        //  자녀    //
        check_child : function() {
            if ( this.registForm.child.value.trim() == "child_00" ) {
                alert( this.complete_alert_msg(__('자녀')) );
                this.registForm.child.focus();
                return false;
            }
        },

        //  연소득    //
        check_earning : function() {
            if ( this.registForm.earning.value.trim() == "earning_00" ) {
                alert( this.complete_alert_msg(__('연소득')) );
                this.registForm.earning.focus();
                return false;
            }
        },

        //  직종    //
        check_job_class : function() {
            if ( this.registForm.job_class.value.trim() == "job_class_04" ) {
                alert( this.complete_alert_msg(__('직종')) );
                this.registForm.job_class.focus();
                return false;
            }
        },

        //  지역    //
        check_region : function() {
            if ( this.registForm.region.value.trim() == "region_00" ) {
                alert( this.complete_alert_msg(__('지역')) );
                this.registForm.region.focus();
                return false;
            }
        },

        //  관심분야    //
        check_interest : function() {

            for ( var i = 0; i < this.registForm.length; i++) {
                if ( this.registForm[i].type == 'checkbox') {
                    if ( this.registForm[i].name == 'inter_check[]') {
                        if ( this.registForm[i].checked == true ) { var check_value = true;break; }
                    }
                }
            }

            if ( check_value != true ) {
                alert( this.complete_alert_msg(__('관심분야')) );
                return false;
            }
        },

        //  성별
        check_sex : function() {

            try{

                var result_sex = this.getradioinx('is_sex');
                if ( isNaN( result_sex ) == true  ) {
                    alert( this.complete_alert_msg(__('성별')) );
                    this.registForm.is_sex[0].focus();
                    return false;
                }
            }
            catch(e){ return false;}


        },

        // 전화번호
        check_phone : function() {
            if (this.registForm.phone1 && this.registForm.phone1.value.trim() == "") {
                alert( this.complete_alert_msg(__('전화번호')) );
                this.registForm.phone1.focus();
                return false;
            }

            if (this.registForm.phone2 && this.registForm.phone2.value.trim() == "") {
                alert( this.complete_alert_msg(__('전화번호')) );
                this.registForm.phone2.focus();
                return false;
            }
            if (this.registForm.phone3 && this.registForm.phone3.value.trim() == "") {
                alert( this.complete_alert_msg(__('전화번호')) );
                this.registForm.phone3.focus();
                return false;
            }
        },
        
        // 휴대전화
        check_cell : function() {
            if ( this.registForm.mobile1 && this.registForm.mobile1.value.trim() == "") {
                alert( this.complete_alert_msg(__('휴대전화')) );
                this.registForm.mobile1.focus();
                return false;
            }

            if (this.registForm.mobile2 && this.registForm.mobile2.value.trim() == "") {
                alert( this.complete_alert_msg(__('휴대전화')) );
                this.registForm.mobile2.focus();
                return false;
            }

            if (this.registForm.mobile3 && this.registForm.mobile3.value.trim() == "") {
                alert( this.complete_alert_msg(__('휴대전화')) );
                this.registForm.mobile3.focus();
                return false;
            }
        },

        // 추천인아이디
        check_reco_id : function() {
            if ( this.registForm.reco_id.value.trim() == "" ) {
                alert( this.complete_alert_msg(__('추천인ID')) );
                this.registForm.reco_id.focus();
                return false;
            }
        },

        //  최종학력
        check_school : function() {
            if ( this.registForm.school.value.trim() == "school_00" ) {
                alert( this.complete_alert_msg(__('최종학력')) );
                this.registForm.school.focus();
                return false;
            }
        },

        //  직업
        check_job : function() {
            if ( this.registForm.job.value.trim() == "job_00" ) {
                alert( this.complete_alert_msg(__('직업')) );
                this.registForm.job.focus();
                return false;
            }
        },

        // 에러 메세지 반환
        complete_alert_msg : function(label) {
            return sprintf(__('%s은(는) 필수 항목 입니다.'), label);
        }


// end - obj
}


/**
 * 폼 필수 데이터 호출결과 callback
 * */
function callbackEssnFormCheck( sUrl )
{

    $.get(sUrl, function(data) {

        if (!data) { return; }
        try{ eval( 'var aResData =' + data ); }catch(e) { return; }
        if (!aResData) return;
        if ( aResData.code == '0000') { essn_array = aResData.value; }
        else{ essn_array = null; }

    });


}

function set_essn() {

    try {
        var sUrl = '/common/api/apiGetMemberFormInfo.php?mode=getMemberFormInfo';
        callbackEssnFormCheck( sUrl ) ;
    }
    catch (e) {}

}

// 필수항목로딩 후 변수에 세팅
function callback_essn(oj) {

    if (!oj) return;
    if (!oj.responseText) return;
    try{ eval( 'var aResData =' + oj.responseText ); }catch(e) { return; }
    if (!aResData) return;

    if ( aResData.code == '0000') { essn_array = aResData.value; }
    else{ essn_array = null; }

}

function check_essn(sFormName) {

    try {

        // 모바일웹일 경우 추가항목( 관리자 필수/선택 연동 여부 ) 체크안함.
        // if (mobileWeb == true) { return true; } // ECHOSTING-35394로 인해 주석처리함.

        if ( essn_array != null ) {

            // 체크 객체 초기화
            obj_checkessn.init(sFormName);

            // 체크항목 탐색 (모바일도 PC와 동일하게 체크 -  SUB-9864)
            for ( var i = 0; i < essn_array.length; i++) {
                var result = obj_checkessn.switch_action( essn_array[i] );
                if ( result == false ) { break; }
            }
            return result;
        }

    } catch (e) { return true; }


}



// 이메일 중복 체크 여부
var bCheckedEmailDupl = false;
// 아이디 중복체크 공통 url
var sIdDuplicateCheckUrl = '';

$(document).ready(function(){
    $('[onclick^="findAddress"]').attr('onclick','').unbind('click');
    $('[onclick^="findAddress"]').bind('click', {
            'zipId1' : 'postcode1',
            'zipId2' : 'postcode2',
            'addrId' : 'addr1',
            'cityId' : '',
            'stateId' : '',
            'type' : 'mobile',
            'sLanguage' : SHOP.getLanguage(),
            'addrId2' : ''
        }, ZipcodeFinder.Opener.Event.onClickBtnPopup);
    
    // 회원가입 설정 항목 필수 아이콘 숨김 처리 - ECHOSTING-115627
    $(':hidden[name^="display_required_"]').each(function (i) {
        bDisplayFlag = ($(this).val() == 'T') ? true : false;
        sExtractId = $(this).attr('id').substr(17);

        if (sExtractId == 'bank_account_no') { // 환불계좌 쪽은 id값이 매칭이 되지 않아 예외 처리
            sDisplayTargetId = 'icon_is_display_bank';
        } else if (sExtractId == 'name_phonetic') { // 이름 발음 쪽은 id값이 매칭이 되지 않아 예외 처리
            sDisplayTargetId = 'icon_phonetic';
        } else {
            sDisplayTargetId = 'icon_' + sExtractId;
        }

        // 한국어 몰은 이름 항목은 무조건 '필수' 
        if (SHOP.getLanguage() == 'ko_KR' && sDisplayTargetId == 'icon_name') {
            bDisplayFlag = true;
        }

        if (bDisplayFlag == false) {
            $('#' + sDisplayTargetId).hide();
        } else {
            $('#' + sDisplayTargetId).show();
        }
    });

    $('#nozip').bind('change', function () {
        if ($(this).is(':checked') == true) {

            $('#postcode1').attr("disabled", true);
            //주소정보 초기화
            $('#postcode1').val("");
            $('#addr1').focus();
            if (SHOP.getLanguage() == 'en_US') {
                return;
            }

            //우편번호 백업
            $('#postcode1').attr('backup_postcode', $('#postcode1').val());

            //주소정보 초기화
            $('#postcode2, #addr1, #addr2, #city_name, #state_name, #__addr1, #__city_name, #__state_name').val("");

            //우편번호 버튼 비활성
            $('#postcode1, #addr1').removeAttr("readonly").val('');

            $('#postBtn').attr('onclick', '').unbind('click').css('cursor', 'unset');
            $('#SearchAddress').attr('src', $('#SearchAddress').attr('off'));
        } else {
            $('#postcode1').removeAttr("disabled");
            //주소정보 초기화
            $('#postcode1').val("");
            if (SHOP.getLanguage() == 'en_US') {
                return;
            }

            //우편번호 버튼 활성화
            $('#postcode2, #addr1').val('');

            $('#postBtn').bind('click', {
                    'zipId1' : 'postcode1',
                    'zipId2' : 'postcode2',
                    'addrId' : 'addr1',
                    'cityId' : 'city_name',
                    'stateId' : 'state_name',
                    'type' : 'layer',
                    'sLanguage' : SHOP.getLanguage(),
                    'addrId2' : 'addr2'
                }, ZipcodeFinder.Opener.Event.onClickBtnPopup);
            $('#postBtn').css('cursor','pointer');
            $('#SearchAddress').attr('src', $('#SearchAddress').attr('on'));
            setFindZipcode();
        }
    });
    $('#direct_input_postcode1_addr0').bind('change', function(){
        var oPostBtn = $("#postBtn");
        var oPostcode1 = $("#postcode1");
        var oAddr1 = $("#addr1");
        oPostcode1.val('');
        oAddr1.val('');
        if ($(this).is(':checked') == true) {
            oPostBtn.hide();
            oPostcode1.attr('readonly', false);
            oAddr1.attr('readonly', false);
        } else {
            oPostBtn.show();
            oPostcode1.attr('readonly', true);
            oAddr1.attr('readonly', true);
        }
    });
    if (mobileWeb == true && $('#mobilemailduplecheckbutton').size() > 0) {
        if ($("#useCheckEmailDuplication").val() == "T") {
            $('#mobilemailduplecheckbutton').css('display', '');
        }
        else {
            $('#mobilemailduplecheckbutton').css('display', 'none');
        }
    }

    // 초기 로딩시 이메일 입력 메시지 
    if ($("#useCheckEmailDuplication").val() == "T") {
        setDuplEmail();
    }

    // 닉네임 체크
    $('#nick_name').bind('blur', function(){
        checkNick();
    });

    // 이메일 중복 체크
    $('#email1').bind('change', function() {

        // 국내몰일 경우 이메일 중복 체크 기능을 사용하는 경우에만 호출.
        if (SHOP.getLanguage() == 'ko_KR') {
            if ($("#useCheckEmailDuplication").val() == "T") {
                setDuplEmail();
            }
        }
        // 해외 몰일경우 그냥 호출.
        else {
            setDuplEmail();
        }

    });

    // 이메일 중복 체크
    $('#etc_subparam_email1').bind('change', function() {

        // 국내몰일 경우 이메일 중복 체크 기능을 사용하는 경우에만 호출.
        if ( SHOP.getLanguage() == 'ko_KR' ) {
            if ( $("#useCheckEmailDuplication").val() == "T" ) { setDuplEmail(); }
        }
        // 해외 몰일경우 그냥 호출.
        else {
            setDuplEmail();
        }

    });
    
    if (SHOP.getLanguage() == 'ko_KR') {
        $('#email2').bind('change', function() {
            if ($("#useCheckEmailDuplication").val() == "T") {
                setDuplEmail();
            }
        });
    }

    function setDuplEmail() {

        if (SHOP.getLanguage() == 'ko_KR') {
            var sEmail = $('#email1').val()+'@'+$('#email2').val();
        } else {
            var sEmail = $('#email1').val();
        }

        if ($('#email1').val() != undefined) {

            if ($('#email1').val().length == 0) {
                $('#emailMsg').addClass('error').html(__('이메일을 입력해 주세요.'));
                return false;
            } else {
                if (FwValidator.Verify.isEmail(sEmail) == false || sEmail.length > 255) {
                    $('#emailMsg').addClass('error').html(__('유효한 이메일을 입력해 주세요.'));
                    return false;
                }
            }
        }

        if ( $('#etc_subparam_email1').val() != undefined && SHOP.getLanguage() != 'ko_KR') {

            var sEmail = $('#etc_subparam_email1').val();

            if ($('#etc_subparam_email1').val().length == 0 ) {
                $('#emailMsg').addClass('error').html(__('이메일을 입력해 주세요.'));
                return false;
            } else {
                if (FwValidator.Verify.isEmail(sEmail) == false || sEmail.length > 255) {
                    $('#emailMsg').addClass('error').html(__('유효한 이메일을 입력해 주세요.'));
                    return false;
                }
            }
        }

        /* checkDuplEmail에 중복 로직이 있어서 모바일일 경우 같은 메세지가 두번씩 뿌려짐
        if (SHOP.getLanguage() == 'ja_JP' && mobileWeb == true) {
            var bExistEmailBtn = false;
            if ($('#check_email_button').length > 0) bExistEmailBtn = true;
            (bExistEmailBtn == true) ? $('#check_email_button').next('p').remove() : $('#email1').next('p').remove();
            
            var aEmailAddr = sEmail.split('@');
            if (aEmailAddr[1] == 'softbank.ne.jp') {
                $sInfoText = '<p style="color:#747474;">「@softbank.ne.jp」アドレスは、MMSサ?ビスとなり、大容量のデ?タ受信ができかねます。</p>';
                if (bExistEmailBtn) {
                    $('#check_email_button').after($sInfoText);
                } else {
                    $('#email1').after($sInfoText);
                }
            }
        }*/

        checkDuplEmail();
    };

    if (SHOP.getLanguage() != 'ko_KR' && $('#idMsg').length > 0) {
        $('#idMsg').html(__('아이디는 영문소문자 또는 숫자 4~16자로 입력해 주세요.'));
    }

    if (SHOP.getLanguage() != 'ko_KR' && $('#emailMsg').length > 0) {
        if ($('#login_id_type').val() == 'email') {
            $('#emailMsg').html(__('로그인 아이디로 사용할 이메일을 입력해 주세요.'));
        }
    }

    // 아이디 중복 체크
    $('#joinForm').find('#member_id').bind('blur', function(){
        //if ( SHOP.getLanguage() == 'ko_KR' ) return;
        if (mobileWeb) return;
        checkDuplId();
    });

    // 아이디 중복 체크
    $('#etc_subparam_member_id').bind('blur', function(){
        //if ( SHOP.getLanguage() == 'ko_KR' ) return;
        if ( mobileWeb ) return;
        checkDuplId();
    });

    // 비밀번호 확인 체크
    $('#user_passwd_confirm').bind('blur', function() {
        if ($('#pwConfirmMsg').length < 1) return;
        if ($('#user_passwd_confirm').val() == '' && $('#passwd').val() == '') return;
        checkPwConfirm('user_passwd_confirm');
    });

    // 비밀번호 확인 체크
    $('#etc_subparam_user_passwd_confirm').bind('blur', function(){
        if ( $('#pwConfirmMsg').length < 1 ) return;
        if ( $('#etc_subparam_user_passwd_confirm').val() == '' && $('#etc_subparam_passwd').val() == '') return;
        checkPwConfirm('etc_subparam_user_passwd_confirm');
    });
    
    // 국가선택시
    $('#country').bind('change', function(){

        var sCountryText = $('#country option:selected').text();

        //전화번호로 변경
        var oPhone1 = $('#phone1');
        if (oPhone1.length > 0) {
            $('#phone1 > option:contains("'+sCountryText+'")').eq(0).attr('selected', true);
        }
        var oMobile1 = $('#mobile1');
        if (oMobile1.length > 0) {
            $('#mobile1 > option:contains("'+sCountryText+'")').eq(0).attr('selected', true);
        }
        setFindZipcode();

        try {
            // 일문 주소 readonly 설정
            zipcodeCommonController.setJapanCountryAddr1($(this).val(), $('#addr1'), $('#postcode1'));
        } catch (e) {
        }

        try {
            if (isCountryOfLanguage == 'T') {
                setAddressOfLanguage.changeCountry();
            }
        } catch (e) {}
    });

    //주소입력시 입력값 동기화
    $('#addr1, #city_name, #state_name').bind('change', function() {
        $('#__'+$(this).attr('id')).val($(this).val());
    });

    $('#bank_account_no').keyup(function(){
        filterBankAccountNo($(this));
    });

    $('#bank_account_no').blur(function(){
        filterBankAccountNo($(this));
    });

    function filterBankAccountNo(oObj)
    {
        var iLimit = 50;
        var value = oObj.val();
        if (/^[\-0-9]+$/.test(value) == false) {

            value = value.replace(/[^0-9\-]/g, '');
            value = value.substr(0, 1) + value.substr(1).replace(/[^\-0-9]/g, '');

            if (value.length > iLimit) {
                value = value.substr(0, iLimit);
            }

            oObj.val(value);
        } else {
            if (value.length > iLimit) {
                value = value.substr(0, iLimit);
                oObj.val(value);
            }
        }
    }

    //ECHOSTING-16798 새로 추가된 모바일 인증 HTML 없을경우 기존 회원인증 로직 숨김 처리
    if (mobileWeb) {
        if ($('#member_name_cert_flag').val() == 'T'
            && $('#is_mobile_auth_use').val() == 'T'
            && $('#realNameEncrypt').val() == '') {
            if (!$("#authMember").get(0)) {
                if ($("#is_ipin_auth_use").val() == "F") {
                    $("#auth_tr").empty();
                    $("#ipin_tr").css('display', 'none');
                    $("#name_tr").css('display', 'table-row');
                    $("#name_tr").find("td").empty().append('<input id="name" name="name" fw-filter="isFill&amp;isMax[20]" fw-label="이름" fw-msg="" class="inputTypeText" maxlength="20" value="" type="text" autocomplete="off">');
                } else if ($("#is_ipin_auth_use").val() == "T") {
                    //아이핀 인증 사용중이면서 디자인가이드가 추가 안되었을 때 휴대폰 인증 삭제 처리
                    $("#auth_tr").find("input[value='m']").next().remove().end().remove();
                }
                ;
            }
            ;
        }
        ;
    }
    ;
    //  회원가입 페이지 내디폴트 인증수단
    if ($("#default_auth_reg_page_flag").get(0)) {

        // 아이핀, 휴대폰 인증 둘다 존재할때
        if ($("#ipinWrap").get(0) && $("#mobileWrap").get(0)) {

            var sDefaultAuth = $("#default_auth_reg_page_flag").val();
            $("input[name='personal_type']").attr("checked", "");

            if (sDefaultAuth == "I") {
                $("input[name='personal_type'][value='i']").attr("checked", "checked");
            }

            if (sDefaultAuth == "H") {
                $("input[name='personal_type'][value='m']").attr("checked", "checked");

                $('#ipinWrap').hide();
                $('#mobileWrap').show();
                $('#emailWrap').hide();
            }

            // 둘다 없을때는 디폴트
            if ($("input[name='personal_type']:checked").length <= 0) {
                $("input[name='personal_type'][value='i']").attr("checked", "checked");
            }

            // 기본설정이 아이핀이고, 아이핀설정을 사용하지않을경우 모바일 셋팅으로
            if ($("#is_ipin_auth_use").val() == "F" && sDefaultAuth == "I") {
                $("input[name='personal_type'][value='m']").attr("checked", "checked");

                $('#ipinWrap').hide();
                $('#mobileWrap').show();
                $('#emailWrap').hide();
            }
            // ECHOSTING-89438 이메일 인증 디폴트 처리
            if (sDefaultAuth == "E") {
                $("input[name='personal_type'][value='e']").attr("checked", "checked");

                $('#ipinWrap').hide();
                $('#mobileWrap').hide();
                $('#emailWrap').show();
            }
        };
    };

    if (SHOP.getLanguage() != 'ko_KR') {
        var sCounty = '';
        if (SHOP.getLanguage() == 'en_US') {
            sCounty = 'USA';
        } else if (SHOP.getLanguage() == 'zh_CN') {
            sCounty = 'CHN';
        } else if (SHOP.getLanguage() == 'zh_TW') {
            sCounty = 'TWN';
        } else if (SHOP.getLanguage() == 'ja_JP') {
            sCounty = 'JPN';
        } else if (SHOP.getLanguage() == 'es_ES') {
            sCounty = 'ESP';
        } else if (SHOP.getLanguage() == 'pt_PT') {
            sCounty = 'PRT';
        }
        try {
            setAddressOfLanguage.joinInit();
        } catch (e) {}
        $("#country").val(sCounty).change();
    };

    // ECHOSTING-89438 외국인 이름 설정
    $('#foreigner_name').bind('blur', function(){
        if ($('input[name=foreigner_type]:checked').val() == 'e') {
            $('#nameContents').html($('#foreigner_name').val());
        } else {
            $('#nameContents').html('');
        }
    });

    $('#si_name_addr').bind('change', function () {
        setAddressOfLanguage.setZipcode(this);
        setAddressOfLanguage.setLastZipcode();
    });
    $('#ci_name_addr').bind('change', function () {
        setAddressOfLanguage.setZipcode(this);
        setAddressOfLanguage.setLastZipcode();
    });
    $('#gu_name_addr').bind('change', function () {
        setAddressOfLanguage.setZipcode('last');
        setAddressOfLanguage.setLastZipcode();
    });

    try {
        setAddressCommon.setUseCountryNumberModifyUi($('#phone1'), $('#mobile1'));
    } catch(e) {}

    // 약관 동의 관련 함수들
    try {
        // sms, email 수신동의 필수 입력 제거
        memberCommon.marketingRemoveFilter();

        // 약관 전체 동의 체크
        $('input:checkbox[id="sAgreeAllChecked"]').bind('change', function () {
            memberCommon.agreeAllChecked();
        });

        // 모바일 마케팅 영역 약관 전체 체크
        $('input:checkbox[id="sMarketingAgreeAllChecked"]').bind('change', function () {
            memberCommon.marketingAllChecked();
        });

        // 모바일 마케팅 영역 each 체크
        $.each(memberCommon.oMarketingAgreeCheckbox, function (i, oVal) {
            if (oVal.length < 1) {
                // continue
                return true;
            }
            oVal.obj.bind('change', function () {
                memberCommon.marketingAgreeAllCheckboxIsChecked();
            });
        });

        // 전체 약관 each 체크
        $.each($('.agreeArea'), function (i, oVal) {
            if (($(oVal).hasClass('displaynone')) === true) {
                return true;
            }

            $.each($(oVal).find("input:checkbox"), function (j, oVal2) {
                $(oVal2).bind('change', function () {
                    memberCommon.eachCheckboxAgreeAllChecked();
                });
            });
        });

        // each 전체 동의 체크 언체크
        $.each(memberCommon.oAgreeCheckbox, function (i, oVal) {
            if (oVal.obj.length < 1) {
                // continue
                return true;
            }

            oVal.obj.bind('change', function () {
                sIsUnchecked = memberCommon.agreeAllUnChecked(oVal.obj);
                if (sIsUnchecked == "T") {
                    return false;
                }
            });
        });
    } catch(e) {}
});


var globalJoinData = [];
var essn_array = null;
var check_nick_name_essn = false;
var iRerun = 0;

//필수항목 체크 변수 세팅
set_essn();

// 해당국가 외에는 직접 우편번호를 넣는다.
function setFindZipcode()
{

    var sCountry = $('#country').val();
    var sLanguage = SHOP.getLanguage();

    //주소정보 초기화
    $('#postcode1, #postcode2, #addr1, #addr2, #city_name, #state_name, #__addr1, #__city_name, #__state_name').val("");

    //우편번호 복원
    $('#postcode1').val($('#postcode1').attr('backup_postcode'));

    //멀티샵언어와 국가정보가 일치하는지 체크
    if ( ( sLanguage == 'zh_CN' && ( sCountry != 'CHN' && sCountry != 'TWN') ) ||
        ( sLanguage == 'ja_JP' && sCountry != 'JPN') ||
        ( sLanguage == 'zh_TW' && sCountry != 'TWN') ) {

        //우편번호찾기 버튼제어
        $('#SearchAddress').hide();

        if (mobileWeb == true) {
            $('#postBtn').hide();
        }

        //city, state 입력가능하도록
        //$('tr:has(td:has(#city_name)), tr:has(td:has(#state_name))').show();
    } else {
        if ( sLanguage != 'en_US' && sLanguage != 'es_ES' && sLanguage != 'pt_PT') {
            $('#SearchAddress').show();

            if (mobileWeb == true) {
                $('#postBtn').show();
            }

            if ($('#nozip').attr('checked') == true) {
                $('#nozip').attr('checked', false).change();
                $('#nozip').attr('checked', false);
            }

            //city, state 히든처리
            $('tr:has(td:has(#city_name)), tr:has(td:has(#state_name))').hide();
        }
    }
}

/**
 * 회원가입하기 개인정보 이용약관 체크박스 확인 후 회원가입페이지로 이동
 * @returns void
 */
function checkAgreement( sUrl )
{
    var checkAgree = [];
    $("input[type='checkbox']").each(function(){
        var attrName = $(this).attr('name');
        var bAgree = /agree_service_check/ig.test( attrName );
        var bPerson = /agree_privacy_check/ig.test( attrName );
        if ( bAgree ) {
            if ( $(this).attr("checked")  ) {
                checkAgree[0] = "";
            } else {
                checkAgree[0] = $(this).attr("fw-msg");
            }
        }
        if ( bPerson )  {
            if ( $(this).attr("checked")  ) {
                checkAgree[1] = "";
            } else {
                checkAgree[1] = $(this).attr("fw-msg");
            };
        };
    });
    if ( checkAgree[0] != "" ) {
        alert( checkAgree[0] );
        return false;
    }
    if ( checkAgree[1] != "" ) {
        alert( checkAgree[1] );
        return false;
    }

    /**
     * 모바일 회원가입일때 3자 정보제공동의 값을 회원가입폼으로 전달하기 위해 처리 by sskim02
     * @returns void
     */
    var isSubmit = "F";
    var sHidden = "";
    var $agree_information = $("input:checkbox:[name='agree_information_check[]']");
    var $agree_consignment = $("input:checkbox:[name='agree_consignment_check[]']");
    if (($agree_information.length > 0 && $agree_information[0].checked) || ($agree_consignment.length > 0 && $agree_consignment[0].checked)) {
        sHidden = '<input type="hidden" name="agree_information" value="'+($agree_information[0].checked ? '1':'') +'"/><input type="hidden" name="agree_consignment" value="'+($agree_consignment[0].checked ? '1' : '')+'"/>';
        isSubmit = "T";
    }

    var oMarketingCheckbox = [
        {obj: $('input:checkbox[name="is_sms"]'), hiddenName: "is_sms_check"}, // sms 수신 동의
        {obj: $('input:checkbox[name="is_news_mail"]'), hiddenName: "is_news_mail_check"} // 이메일 수신 동의
    ];

    $.each(oMarketingCheckbox, function(i, oVal) {
        if (oVal.obj.length < 1) {
            // continue
            return true;
        }

        isSubmit = "T";
        if (oVal.obj.is(":checked") === true) {
            sHidden += '<input type="hidden" name="'+oVal.hiddenName+'" value="T" />';
        } else {
            sHidden += '<input type="hidden" name="'+oVal.hiddenName+'" value="F" />';
        }
    });


    if (isSubmit == "T") {
        $(document.body).append('<form id="formAgreement" method="post" action="' + sUrl + '">'+sHidden+'</form>');
        $('#formAgreement').trigger('submit');
        return false;
    }
    location.href = sUrl;
}


/**
 * submit 할 때 display none 되어 있는 부분 전부 지워버리고 submit
 * post value name 이 겹치지 않기 위해 삭제
 */
function memberJoinAction()
{

    // 실명인증 체크
    if ( EC_SDE_SHOP_NUM == 1 && $('#member_name_cert_flag').val() == 'T' && $('#is_name_auth_use').val() == 'T' && $('#realNameEncrypt').val() == '') {
        alert(__('회원 인증을 해주세요.'));
        return false;
    }

    //아이핀 인증 체크
    if ( EC_SDE_SHOP_NUM == 1 && $('#member_name_cert_flag').val() == 'T' && $('#is_ipin_auth_use').val() == 'T' && $('#realNameEncrypt').val() == '') {
        alert(__('회원 인증을 해주세요.'));
        return false;
    }

    // 휴대폰 인증 체크
    if ( EC_SDE_SHOP_NUM == 1 && $('#member_name_cert_flag').val() == 'T' && $('#is_mobile_auth_use').val() == 'T' && $('#realNameEncrypt').val() == '') {
        // 모바일일때 회원 모바일 인증 HTML 삽입되어 있는지 확인 후 모바일 인증체크, 기존 모바일인증 사용자 회원가입 정상 동작 때문
        if ( mobileWeb ) {
            if ( $("#authMember").get(0) ) { 
                alert(__('회원 인증을 해주세요.'));
                return false;
            }
        } else {
            alert(__('회원 인증을 해주세요.'));
            return false;
        }
    }

    // 필수항목 체크 필터 성공시 이후 진행 // 2012.11.07 : jhpark04
    if ($("#useSimpleSignin").val() != "T") { // 심플 가입이 아닐 경우만
        // SNS 통한 가입시 SNS 추가정보는 다른 js에서 체크하였으므로 이곳에서 체크하지 않는다
        if ($("#sns_name").text()) {
        } else {
            var checked_essn = check_essn();
            if ( checked_essn == false) { return false; }
        }
    }

    //주민번호 검사
    //실명인증 안할때만 검사
    if ($('#is_display_register_ssn').val() == 'T' && $('input[name=member_type]:checked').val() == 'p' && $('#member_name_cert_flag').val() != 'T') {
        if ($('#ssn1').val() == '' || $('#ssn2').val() == ''){
            alert(__('주민등록번호를 입력 해주세요.'));
            $('#ssn1').focus();
            return false;
        }

        if (isSsn($('#ssn1').val(), $('#ssn2').val()) == false) {
            alert(__('올바른 주민등록번호를 입력해 주세요.'));
            $('#ssn1').focus();
            return false;
        }

    }

    // EC-14044
    if ($('input[id^="identification_check"]:visible').length > 0) {
        if ($('input[id^="identification_check"]:visible')[0].checked !== true) {
            $('input[id^="identification_check"]:visible')[0].focus();
            alert(__('고유식별정보 처리에 동의해 주세요.'));
            return false;
        }
    }
    // EC-14044
    if ($('input[id^="f_identification_check"]:visible').length > 0) {
        if ($('input[id^="f_identification_check"]:visible')[0].checked !== true) {
            $('input[id^="f_identification_check"]:visible')[0].focus();
            alert(__('고유식별정보 처리에 동의해 주세요.'));
            return false;
        }
    }

    //id 중복 체크
    if ($('#joinForm #member_id').val() != '' && $('#idDuplCheck').val() != 'T') {
        // ECHOSTING-198247 id 잘못되어진 패턴인경우에 대한 alert 문구 보완 
        var sMsg = ''
        // id 관련 에러 메시지가 있는경우만 띄워준다
        if ($("#idMsg").attr('id') =='idMsg' && $("#idMsg.error").attr('id')) {
            sMsg = $("#idMsg").text().split('.').join(".\n");
        }
        sMsg = (sMsg) ? sMsg : __('아이디 중복을 확인해 주세요.');
        alert(sMsg);
        $('#member_id').focus();
        return false;
    }
    
    if ($('#email1').val() == '' || $('#email2').val() == '') {
        alert(__('이메일을 입력하세요.'));

        if ($('#email1').val() == '')            $('#email1').focus();
        else if ($('#email2').val() == '')       $('#email2').focus();

        return false;
     }
    
    // 이메일 중복 체크 기능 사용하는경우 이메일 중복 확인이 되지 않으면 alert 메시지 띄워주고 폼전송 못하게 막는다.,
    if ($("#useCheckEmailDuplication").val() == "T" && bCheckedEmailDupl == false ) {
        if (mobileWeb == true) {
            alert( __('이메일 중복여부를 확인해 주세요.') );
        } else {
            alert( __("이미 가입된 이메일 주소입니다.\n쇼핑몰 가입여부를 다시 확인하여 주시거나 관리자에게 문의하여 주세요.") );
        }
        return false;
    }
    
    //email 중복체크
    if ($('#emailDuplCheck').val() != 'T' && $('#use_email_confirm').val() == 'T') {
        
        // 이메일 중복 확인 전 실행 방지 처리
        if ($('#emailDuplCheck').val() == '' && iRerun < 10) {
            iRerun++;
            setTimeout(function(){ memberJoinAction(); }, 500);
            return false;
        }
        alert(__('입력하신 이메일을 사용할 수 없습니다.'));
        $('#email1').focus();
        return false;
    }

    //별명체크 / 별명이 필수 일때만 체크함.
    //need to include memberJoinCheckNick.js
    if ($('#nick_name_flag').val() == 'T' && check_nick_name_essn== true ) {
        var aCheckNick = checkLength($('#nick_name').val());

        if ($('#nick_name_confirm').val() == 'F') {
            alert(__('별명이 잘못 되었습니다.'));
            $('#nick_name').focus();
            return false;
        }

        if (aCheckNick['passed'] == false) {
            alert(aCheckNick['msg']);
            $('#nick_name').focus();
            return false;
        }
    }

    // ECHOSTING-136604 직접 우편번호 입력시에는 입력내용에 대해 체크를 한다
    var bCheckKrZipcode = true;
    if ($('#direct_input_postcode1_addr0')) {
        if ($('#direct_input_postcode1_addr0').attr('checked')){ 
            if ($("#postcode1").val().match(/^[a-zA-Z0-9- ]{2,14}$/g) == null) {
                alert(__("우편번호는 영문, 숫자, 대시(-)만 입력가능합니다.\n입력내용을 확인해주세요."));
                $("#postcode1").focus();
                return false;
            }
            bCheckKrZipcode = false;
        }
    }

    // 주소 필수시 체크 ( 심플 가입이 아닐때만 ) 
    if ( $('#is_display_register_addr').val() == 'T'  && $("#useSimpleSignin").val() !='T' ) {
        
        if ( SHOP.getLanguage() == 'ko_KR') {
            if ( $('#postcode1').val() == '') {
                alert(__('주소를 입력해주세요'));
                $('#postcode1').focus();
                return false;
            }
        } else {
            if ($('#nozip').is(':checked') == false) {
                if ($.trim($('#postcode1').val()) == '' ) {
                    alert(__('우편번호를 입력해주세요.'));
                    $('#postcode1').focus();
                    return false;
                }
                
                if ($("#postcode1").val().length < 2 || $("#postcode1").val().length > 14) {
                    alert(__("우편번호는 2자 ~ 14자까지 입력가능합니다."));
                    $("#postcode1").focus();
                    return false;
                }
                
                if ($("#postcode1").val().match(/^[a-zA-Z0-9- ]{2,14}$/g) == null) {
                    alert(__("우편번호는 영문, 숫자, 대시(-)만 입력가능합니다.\n입력내용을 확인해주세요."));
                    $("#postcode1").focus();
                    return false;
                }
            }
        }

        if ( $('#display_required_address').val() == 'T' && $('#addr1').val() == '' ) {
            alert(__('주소를 입력해주세요'));
            var sisDesignPosibbleFlag = "F";
            if (SHOP.getLanguage() == 'zh_CN' || SHOP.getLanguage() == 'zh_TW') {
                sisDesignPosibbleFlag = setAddressOfLanguage.isDesignPosibbleController();
            }
            if (sisDesignPosibbleFlag == "F") {
                $('#addr1').focus();
            }
            return false;
        }
        
        if ( $('#display_required_address2').val() == 'T' && $('#addr2').val() == '' ) {
            alert(__('주소를 입력해주세요'));
            $('#addr2').focus();
            return false;
        }
    }
    
    // 주소가 입력되어 있으면 우편번호 벨리데이션 체크
    if ( SHOP.getLanguage() == 'ko_KR' && $('#postcode1').val() != '' && $('#postcode1').val() != undefined && bCheckKrZipcode == true) {

        var zipcode = $('#postcode1').val();
        zipcode = zipcode.replace('-', '');
        
        // 숫자가 아니거나 5자리 미만이면 체크
        if (FwValidator.Verify.isNumber(zipcode) == false || zipcode.length < 5 || zipcode.length > 6) {
            alert('우편번호를 확인해주세요');
            $('#postcode2').val('');
            $('#postcode1').focus();
            return false;
        }
    }

    if ($('#is_display_register_name').val() == 'T' && $("#useSimpleSignin").val() !='T') {
        if (SHOP.getLanguage() != 'ko_KR') {
            if ($('#sUseSeparationNameFlag').val() == 'T' && $('#last_name').length < 1) {
                alert(sprintf(__('%s 항목은 필수 입력값입니다.'), __('이름')));
                return false;
            } else if ($('#sUseSeparationNameFlag').val() == 'T' && $('#last_name').length > 0) {
                if ($.trim($('#last_name').val()) == '') {
                    alert(sprintf(__('%s 항목은 필수 입력값입니다.'), __('이름')));
                    $('#last_name').focus();
                    return false;
                }
            }
        }
    }

    // 영문이름 체크
    if ( $('#is_display_register_eng_name').val() == 'T'  && $("#useSimpleSignin").val() !='T' ) {
        if ( $('#name_en').val() == '' && $('#name_en').length > 0) {
            alert(sprintf(__('%s를 입력해 주세요.'), __('이름(영문)')));
            $('#name_en').focus();
            return false;
        }

        if (SHOP.getLanguage() != 'ko_KR') {
            if ($('#sUseSeparationNameFlag').val() == 'T' && $('#last_name_en').length < 1) {
                alert(sprintf(__('%s를 입력해 주세요.'), __('이름(영문)')));
                return false;
            } else if ($('#sUseSeparationNameFlag').val() == 'T' && $('#last_name_en').length > 0) {
                if ($.trim($('#last_name_en').val()) == '') {
                    alert(sprintf(__('%s를 입력해 주세요.'), __('이름(영문)')));
                    $('#last_name_en').focus();
                    return false;
                }
            }
        }
    }

    // 이름(발음) 체크
    if ( $('#is_display_register_name_phonetic').val() == 'T'  && $("#useSimpleSignin").val() !='T' ) {
        if ( $('#name_phonetic').val() == '' && $('#name_phonetic').length > 0) {
            alert(sprintf(__('%s를 입력해 주세요.'), __('이름발음')));
            $('#name_phonetic').focus();
            return false;
        }

        if (SHOP.getLanguage() != 'ko_KR') {
            if ($('#sUseSeparationNameFlag').val() == 'T' && $('#last_name_phonetic').length < 1) {
                alert(sprintf(__('%s를 입력해 주세요.'), __('이름발음')));
                return false;
            } else if ($('#sUseSeparationNameFlag').val() == 'T' && $('#last_name_phonetic').length > 0) {
                if ($.trim($('#last_name_phonetic').val()) == '') {
                    alert(sprintf(__('%s를 입력해 주세요.'), __('이름발음')));
                    $('#last_name_phonetic').focus();
                    return false;
                }
            }
        }
    }

    // 일반전화 체크
    if (memberCommon.checkJoinPhone() === false) {
        return false;
    }

    // 휴대전화 체크
    if (memberCommon.checkJoinMobile() === false) {
        return false;
    }

    // 회원구분 타입에 따른 '이름(법인명)' 체크
    var sName = '';
    var sId   = '';
    if ($('#member_type0').attr('checked')) {
        // 개인회원
        
        if ($("input[name='personal_type']:checked").val() == 'e') sId = 'name';
        else if ($('#personal_type0').val() == 'i' || $('#personal_type0').val() == 'm') sId = ''; // 실명 인증으로 아이핀만 사용할 경우 예외 처리
        else if ( $('#personal_type0').val() == 'i' && $('#personal_type1').val() == 'm' ) sId = '';
        else if ($('#name').length) sId = 'name';
        else if ($('#personal_type0').attr('checked')) sId = 'real_name';

        if (sId != '' && ($('#is_display_register_name').val() == 'T' || $('#is_email_auth_use').val() == 'T') ) {
            sName = $.trim($('#'+sId).val());
            if (sName.length == 0) {
                alert(sprintf(__('%s 항목은 필수 입력값입니다.'), __('이름')));
                $('#'+sId).focus();
                return false;
            }
        }
        // 개인회원일때 국제 체크제거
        if ( $("#citizenship").get(0) ) {
            globalJoinData['citizenship'] = {"fw-filter" : $("#citizenship").attr('fw-filter')};
            $("#citizenship").removeAttr("fw-filter");
        }

    }
    else if ($('#member_type1').attr('checked')) {

        // 사업자회원
        if ($('#company_type0').attr('checked')) {

            // 개인사업자
            if ($('#personal_type0').val() == 'i' || $('#personal_type0').val() == 'm') sId = ''; // 실명 인증으로 아이핀만 사용할 경우 예외 처리
            else if ( $('#personal_type0').val() == 'i' && $('#personal_type1').val() == 'm' ) sId = 'name';
            else if (!$('#personal_type0').attr('name')) sId = 'name';
            else if ($('#personal_type0').attr('checked')) sId = 'real_name';

            if (sId != '' && $('#is_display_register_name').val() == 'T' ) {
                sName = $.trim($('#'+sId).val());
                if (sName.length == 0) {
                    alert(sprintf(__('%s 항목은 필수 입력값입니다.'), __('이름')));
                    $('#'+sId).focus();
                    return false;
                }

            }
            sCname = $.trim($('#cname').val());
            if (sCname.length == 0) {
                alert(__('상호명을 입력해 주세요.'));
                $('#cname').focus();
                return false;
            }
        } else if ($('#company_type1').attr('checked')) {
            // 법인사업자
            sName = $.trim($('#bname').val());
            if (sName.length == 0) {
                alert(__('법인명을 입력해 주세요.'));
                $('#bname').focus();
                return false;
            }
            
            var bssn1 = $('#bssn1').val();
            var bssn2 = $('#bssn2').val();
            var realNameEncrypt = $('#realNameEncrypt').val();
            
            if ($.trim(bssn1).length < 1 || $.trim(bssn2).length < 1 ) {
                alert( __('법인 번호를 입력하여 주세요.') );
                $('#bssn1').focus();
                return false;
            }            
            if ($.trim(realNameEncrypt).length < 1) {                        
                alert( __('법인번호 중복체크를 해주세요.') );
                $('#bssn1').focus();
                return false;
            }            
        }

        sCssn = $.trim($('#cssn').val());
        if (sCssn.length == 0) {
            alert(__('사업자번호를 입력해 주세요.'));
            $('#cssn').focus();
            return false;
        }
        
        // 개인회원일때 국제 체크제거
        if ( $("#citizenship").get(0) ) {
            globalJoinData['citizenship'] = {"fw-filter" : $("#citizenship").attr('fw-filter')};
            $("#citizenship").removeAttr("fw-filter");
        }
    } else if ($('#member_type2').attr('checked') && ($('#is_display_register_name').val() == 'T' || $('#is_email_auth_use').val() == 'T')) {
        //개인회원과 외국인회원 반복했을때 attr 지워진거 복구
        if ( globalJoinData['citizenship'] && globalJoinData['citizenship']['fw-filter'] ) {
            $("#citizenship").attr('fw-filter',globalJoinData['citizenship']['fw-filter'] || '');
        }

        // 외국인회원
        if ($("input[name='foreigner_type']:checked").val() == 'e') {
            sName = $.trim($('#foreigner_name').val());
            if (sName.length == 0) {
                alert(sprintf(__('%s 항목은 필수 입력값입니다.'), __('이름')));
                $('#foreigner_name').focus();
                return false;
            }
        }
        // ECHOSTING-89438 이메일 인증시 외국인 번호 체크 제외
        if ($('#is_display_register_name').val() == 'T' && $("input[name='foreigner_type']:checked").val() != 'e') {
            var foreignerType = $('input[name=foreigner_type]:checked').val();
            var foreignerSsn  = $('#foreigner_ssn').val();        
            var realNameEncrypt = $('#realNameEncrypt').val();
            var sType = '';

            if (foreignerType == 'f') sType = __('외국인 등록번호');
            else if (foreignerType == 'p') sType = __('여권번호');
            else if (foreignerType == 'd') sType = __('국제운전면허증번호');
            
            if ($.trim(foreignerSsn).length < 1) {
                alert(sprintf(__('%s를 입력해 주세요.'), sType));
                $('#foreigner_ssn').focus();
                return false;
            }
            
            if ($.trim(realNameEncrypt).length < 1) {                        
                alert(sprintf(__('%s 중복체크를 해주세요.'), sType));
                $('#foreigner_ssn').focus();
                return false;            
            }
        }
        
    }

    // 이메일 (직접입력)
    if (SHOP.getLanguage() == 'ko_KR') {
        var sEmail = null;
        // 이메일 input 정보가 존재할경우
        if ($('#email1').length > 0 && $('#email2').length > 0) {
            sEmail = $('#email1').val()+'@'+$('#email2').val();
        }
    } else {
        var sEmail = $('#email1').val();
    }

    if ($('#email1').val() != undefined) {
        if ((FwValidator.Verify.isEmail(sEmail) == false && sEmail != null) || sEmail.length > 255) {
            alert(__('입력하신 이메일을 사용할 수 없습니다.'));
            $('#email1').focus();
            return false;
        }
    }

    //날짜 체크
    var aCheckDateMap = [{'idPrefix' : 'birth', 'idName' : __('생년월일')}, {'idPrefix' : 'marry', 'idName' : __('결혼기념일')}, {'idPrefix' : 'partner', 'idName' : __('배우자 생일')}];

    for (var i = 0; i < aCheckDateMap.length; i++) {
        var bDateResult = checkDate(aCheckDateMap[i]['idPrefix'], aCheckDateMap[i]['idName']);
        if (bDateResult == false) return false;
    }

    // 환불계좌 정보 체크
    if ( $('#is_display_bank').val() == 'T'  && $("#useSimpleSignin").val() !='T' ) {
        if ($('#bank_account_owner').val() == '') {
            alert('예금주를 입력해주세요');
            $('#bank_account_owner').focus();

            return false;
        } else if ($('#refund_bank_code').val() == '') {
            alert('은행명을 선택해주세요');
               $('#refund_bank_code').focus();

               return false;
        } else if ($('#bank_account_no').val() == '') {
            alert('환불 계좌번호를 입력해주세요');
            $('#bank_account_no').focus();
            
            return false;
        }
    }
    
/*
    var bank_account_no = $('#bank_account_no').val();
    if ($.trim(bank_account_no) && isNaN(bank_account_no)) {
        alert('계좌번호는 숫자만 입력해 주세요');
        $('#bank_account_no').focus();

        return false;
    }
*/
    // 추천인 ID 체크
    var sRecoId = $('#joinForm #reco_id').val();
    if ($.trim(sRecoId) != '') {
        if (sRecoId == $.trim($('#joinForm').find('#member_id').val())) {
            alert(__('자기자신을 추천인으로 등록할 수 없습니다.'));
            $('#joinForm #reco_id').focus();
            return false;
        }
    }

    if ($('#passwd').val() == '' || $('#user_passwd_confirm').val() == '' ) {
        alert(__('비밀번호 항목은 필수 입력값입니다.'));
        return false;
    }

    var passwd_type =  ($('#passwd_type').val() == '' || $('#passwd_type').length < 1 ) ? 'A' : $('#passwd_type').val();

    
    // 비밀번호 조합 체크
    var passwd_chk = ckPwdPattern($('#passwd').val(), passwd_type);
    
    if (passwd_chk !== true) {
        if (passwd_type == 'A') {
            if (passwd_chk == 'F')
                alert(__('공백 또는 허용 불가한 특수문자는 사용할 수 없습니다.'));
            else
                alert(__('4~16자로 입력해 주세요.'));
        }
        if (passwd_type == 'B') {
            if (passwd_chk == 'F')
                alert(__("공백 또는 허용된 특수문자 (~ ` ! @ # $ % ^ ( ) _ - = { [ } ] ; : < > , . ? /) 외의 특수문자는 사용할 수 없습니다."));
            else
                alert(__('영문 대소문자, 숫자, 또는 특수문자 중 2가지 이상 조합하여 8~16자로 입력해 주세요.'));
        }
        if (passwd_type == 'C') {
            if (passwd_chk == 'F')
                alert(__("공백 또는 허용된 특수문자 (~ ` ! @ # $ % ^ ( ) _ - = { [ } ] ; : < > , . ? /) 외의 특수문자는 사용할 수 없습니다."));
            else
                alert(__('영문 대소문자, 숫자, 또는 특수문자 중 2가지 이상 조합하여 10~16자로 입력해 주세요.'));
        }
        if (passwd_type == 'D') {
            if (passwd_chk == 'F')
                alert(__("공백 또는 허용된 특수문자 (~ ` ! @ # $ % ^ ( ) _ - = { [ } ] ; : < > , . ? /) 외의 특수문자는 사용할 수 없습니다."));
            else
                alert(__('비밀번호는 영문 대소문자/숫자/특수문자 중 3가지 이상 조합,8자 ~ 16자로 설정하셔야 합니다.'));
        }
        $('#passwd').focus();
        return false;
    }

    var result = FwValidator.inspection('joinForm');

    if (result.passed == true) {
        if ($("#is_use_checking_join_info").val()==="T") {
            if (CheckingJoinInfo()===true) return false;
        }
        // sns 가입창일경우 joinForm 진행하지 않는다
        if ($('#mCafe24SnsAgree').css('display') == 'block') {
            // sns 가입진행
            snsJoin();
            return false;
        }
        $('#joinForm').submit();
    }
}




/**
 * 주민번호 검사
 * @param ssn1 주민번호 앞자리
 * @param ssn2 주민번호 뒷자리
 * @returns {Boolean}
 */
function isSsn( ssn1, ssn2 )
{
    check_arr = new Array( 2, 3, 4, 5, 6, 7, 8, 9, 2, 3, 4, 5 );
    buff = new Array();

    ssn_len = 13;
    ssn = ssn1 + ssn2;

    for ( i = 0; i < ssn_len; i++ ) {
        buff[i] = ssn.substr( i, 1 );
    }

    for ( i = sum = 0; i < 12; i++ ) {
        sum += ( buff[i] *= check_arr[i] );
    }

    if ( ( ( 11 - ( sum % 11 ) ) % 10 ) != buff[12] )
        return false;

    return true;
}



/**
 * 유선전화
 * @param sElementName 체크 할 엘리먼트 id
 */
function checkPhone(sElementName)
{
    var sFirstNumber = $('#' + sElementName + '2').val();//국번
    var sLastNumber = $('#' + sElementName + '3').val();//뒷번호

    var regexp = /^\d{3,4}$/;
    var bResultFirst = regexp.test(sFirstNumber);

    regexp = /^\d{4}$/;
    var bResultLast = regexp.test(sLastNumber);

    return ((bResultFirst && bResultLast));
}

/**
 * 휴대전화 체크
 * @param sElementName 체크 할 엘리먼트 id
 */
function checkMobile(sElementName)
{

    var sTelComp = $('#' + sElementName + '1').val();//통신사
    var sFirstNumber = $('#' + sElementName + '2').val();//국번
    var sLastNumber = $('#' + sElementName + '3').val();//뒷번호

    var regexp = /^\d{3}$/;
    var bResultTelComp = regexp.test(sTelComp);

    var regexp = /^\d{3,4}$/;
    var bResultFirst = regexp.test(sFirstNumber);

    regexp = /^\d{4}$/;
    var bResultLast = regexp.test(sLastNumber);

    return ((bResultTelComp && bResultFirst && bResultLast));
}


/**
 * 생일, 결혼기념일, 배우자 생일 체크
 * @param string sIdPrefix 검사항목의 id prefix
 * @param string sIdName alert 에 띄울 항목명
 * @returns {Boolean}
 */
var oDate = new Date();
nowMonth = (oDate.getMonth()+1).toString();
nowDay = oDate.getDate().toString();
nowMonth = nowMonth.length == 1 ? '0' + nowMonth : nowMonth;
nowDay = nowDay.length == 1 ? '0' + nowDay : nowDay;        
var FIX_NOW_DATE = parseInt(oDate.getFullYear().toString() + nowMonth + nowDay);
var FIX_MIN_DATE = 19000101;
function checkDate(sIdPrefix, sIdName)
{
    if ($('#' + sIdPrefix + '_year').length == 0 || $('#' + sIdPrefix + '_month').length == 0 || $('#' + sIdPrefix + '_day').length == 0) {
        return true;
    }

    if ($('#' + sIdPrefix + '_year').val() != '' || $('#' + sIdPrefix + '_month').val() != '' || $('#' + sIdPrefix + '_day').val() != '') {
        
        year = $.trim($('#' + sIdPrefix + '_year').val());
        month = $.trim($('#' + sIdPrefix + '_month').val());
        month = month.length == 1 ? '0' + month : month;
        day = $.trim($('#' + sIdPrefix + '_day').val());
        day = day.length == 1 ? '0' + day : day;
        userDate = parseInt(year + month + day);
        lastday = new Date(year, month, 0).getDate();
        
        if (userDate.toString().length < 8 || userDate.toString().length > 8) {
            alert(__('존재하지 않는 날짜 입니다.'));
            $("input[name^='"+sIdPrefix+"']").val('').first().focus();
            return false;
        } else if (month < 1 || month > 12) {
            alert(__('존재하지 않는 날짜 입니다.'));
            $('#' + sIdPrefix + '_month').val('').focus();
            return false;
        } else if (day < 1 || day > lastday) {
            alert(__('존재하지 않는 날짜 입니다.'));
            $('#' + sIdPrefix + '_day').val('').focus();
            return false;
        } else if (userDate < FIX_MIN_DATE) {        
            alert(__('1900년 이후부터 입력 가능 합니다.'));
            $("input[name^='"+sIdPrefix+"']").val('').first().focus();
            return false;
        } else if (userDate > FIX_NOW_DATE) {        
            alert(__('오늘날짜 까지 입력 할 수 있습니다.'));
            $("input[name^='"+sIdPrefix+"']").val('').first().focus();
            return false;
        }
    }
    return true;
}

/**
 * 아이디 중복 체크
 */
function checkId(url)
{
    if (url) {
        sIdDuplicateCheckUrl = url;
    }

    if (mobileWeb == true && $('#idMsg').size() > 0) {
        checkDuplId();
    } else {
        AuthSSLManager.weave({
            'auth_mode': 'encrypt',
            'aEleId': [$("#joinForm #member_id")],
            'auth_callbackName': 'checkIdEncryptedResult'
        });
    }
}

/**
 * 이메일 중복 체크
 */
function checkEmail(url)
{
    if (mobileWeb == true && $('#emailMsg').size() > 0) {
        checkDuplEmail();
    } else {
        var oEmail = $('#joinForm input:[name=email1]');
        var agent = navigator.userAgent.toLowerCase();
        var bodyHeight = $('body').height();

        oEmail.val(sEmail = $.trim(oEmail.val()));

        // 모바일웹일 경우 레이어창으로 오픈
        if (agent.indexOf('iphone') != -1 || agent.indexOf('android') != -1) {
            $('body').append('<div id="emailLayer" style="position:absolute; top:0; left:0; width:100%; height:'+bodyHeight+'px; background:#fff; z-index:999;"><iframe src="'+url+'?email='+sEmail+'" style="width:100%; height:'+bodyHeight+'px; border:0;"></iframe></div>');
            //$('input, a, select, button, textarea, .trigger').hide();//ECHOSTING-42532
            $(window).scrollTop(0);
        } else {
            //상단 또는 좌우측에 에 로그인 form 이 있을 수 있기 때문에 id가 아닌 form으로 접근 함
            window.open( url + '?email=' + sEmail , 'echost_email_check', 'width=400, height=400')
        }
    }
}

/**
 * 아이디중복체크 암호화 처리 (일반)
 * @param output
 */
function checkIdEncryptedResult(output)
{
    var sEncrypted = encodeURIComponent(output);

    if (AuthSSLManager.isError(sEncrypted) == true) {
        return;
    }

    var oMemberId = $('#joinForm input:[name=member_id]');
    var agent = navigator.userAgent.toLowerCase();
    var bodyHeight = $('body').height();

    oMemberId.val($.trim(oMemberId.val()));

    // 모바일웹일 경우 레이어창으로 오픈
    if (agent.indexOf('iphone') != -1 || agent.indexOf('android') != -1) {
        $('body').append('<div id="idLayer" style="position:absolute; top:0; left:0; width:100%; height:'+bodyHeight+'px; background:#fff; z-index:999;"><iframe src=' + sIdDuplicateCheckUrl + '?encrypted_str=' + sEncrypted + '" style="width:100%; height:'+bodyHeight+'px; border:0;"></iframe></div>');
        //$('input, a, select, button, textarea, .trigger').hide();//ECHOSTING-42532
        $(window).scrollTop(0);
    } else {
        //상단 또는 좌우측에 에 로그인 form 이 있을 수 있기 때문에 id가 아닌 form으로 접근 함
        window.open(sIdDuplicateCheckUrl + '?encrypted_str=' + sEncrypted , 'echost_id_check', 'width=400, height=400')
    }
}

/**
 * 아이디중복체크 암호화 처리 (레이어)
 * @param output
 */
function checkIdEncryptedResultForLayer(output)
{
    var sEncrypted = encodeURIComponent(output);

    if (AuthSSLManager.isError(sEncrypted) == true) {
        return;
    }

    var oMemberId = $('#joinForm input:[name=member_id]');
    var sFormMemberId = $.trim(oMemberId.val());

    if ($('#idLayer').length < 1) {
        oMemberId.val(sFormMemberId);
        var iWidth = 440;
        var iHeight = 270;
        var sHtml = '<div id="idLayer" style="overflow:hidden; position:absolute; top:50%; left:50%; z-index:999; width:' + iWidth + 'px; margin:-120px 0 0 -220px; border:1px solid #7f8186; color:#747474; background:#fff; display:none">' + '<iframe id="checkIdLayerFrame" src=' + sIdDuplicateCheckUrl + '?encrypted_str=' + sEncrypted + '" style="width:' + iWidth + 'px; height:' + iHeight + 'px; border:0;" frameborder="0"></iframe>' + '</div>';
        $('body').append(sHtml);
    } else {
        var oFrame = $('#checkIdLayerFrame').contents();
        oFrame.find('#popup').hide();
        oFrame.find('#member_id').val(sFormMemberId);
        oFrame.find('#checkIdForm').submit();
    }

    $('#idLayer').show();
}

/**
 * 아이디 중복 체크 레이어
 */
function checkIdLayer(url)
{
    sIdDuplicateCheckUrl = url;

    AuthSSLManager.weave({
        'auth_mode': 'encrypt',
        'aEleId': [$("#joinForm #member_id")],
        'auth_callbackName': 'checkIdEncryptedResultForLayer'
    });
}

/**
 * 비밀번호 체크
 */
function ckPwdPattern(sPwd, sPwdType)
{
    if (sPwdType == 'A') {
        var pattern = /^[a-zA-Z0-9]{4,16}$/; //조합없이 4~16
        var chk = (pattern.test(sPwd)) ? true : 'F';
        // 4보다 작거나 16보다 큰경우
        if (sPwd.length < 4 || 16 < sPwd.length) {
            chk = false;
        }
        return chk;
    } else {
        var chars1 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; //영대소문자
        var chars2 = '0123456789'; //숫자
        var chars3 = '\~\`\!\@\#\$\%\^\(\)\_\-\=\{\}\[\]\|\;\:\<\>\,\.\?\/';

        var s = containsChar(sPwd, chars1, chars2, chars3);
        var s1 = s.split("/");
        var check_length = 0;

        if (s1[0] > 0) {
            check_length = parseInt(check_length)+parseInt(s1[0]);
            s1[0] = 1;
        }
        if (s1[1] > 0) {
            check_length = parseInt(check_length)+parseInt(s1[1]);
            s1[1] = 1;
        }
        if (s1[2] > 0) {
            check_length = parseInt(check_length)+parseInt(s1[2]);
            s1[2] = 1;
        }

        //영대문자, 숫자, 특수문자 중 2가지 이상 조합이면
        if ((parseInt(s1[0]) + parseInt(s1[1]) + parseInt(s1[2])) >= 2) {
            if (sPwdType == 'B') {
                if (sPwd.length >= 8 && sPwd.length <=16) {
                    if (sPwd.length > check_length) {//허용되지 않은 문자가 포함된 경우
                        return 'F';//허용되지 않은 문자가 포함됨
                    } else {
                        return true;
                    }
                } else {
                    return false;//8자~16자가 안됨
                }
            } else if (sPwdType == 'C') {
                if (sPwd.length >= 10 && sPwd.length <=16) {
                    if (sPwd.length > check_length) {
                        return 'F';
                    } else {
                        return true;
                    }
                } else {
                    return false;//10자~16자가 안됨
                }
            } else if (sPwdType == 'D') {
                if (parseInt(s1[0]) + parseInt(s1[1]) + parseInt(s1[2]) != 3)
                    return false;

                if (sPwd.length >= 8 && sPwd.length <=16) {
                    if (sPwd.length > check_length) {
                        return 'F';
                    } else {
                        return true;
                    }
                } else {
                    return false;//8자~16자가 안됨
                }
            } else {
                return false;
            }
        } else {
            return false; //영문대소문자, 숫자, 특수문자 2가지 조합이 안됨
        }
    }
}

function containsChar(input, chars1, chars2, chars3)
{
    var cnt1 = 0;
    var cnt2 = 0;
    var cnt3 = 0;

    for (var i=0;i<input.length;i++)
    {
        //영대소문자 포함여부
        if (chars1.indexOf(input.charAt(i))!= -1) {
            cnt1++;
        }
        //숫자 포함여부
        if (chars2.indexOf(input.charAt(i))!= -1) {
            cnt2++;
        }
        //특수문자 포함여부
        if (chars3.indexOf(input.charAt(i))!= -1) {
            cnt3++;
        }
    }
    return (cnt1+"/"+cnt2+"/"+cnt3);
}

/**
 * 휴대폰, 아이폰 인증 후 이름, 휴대폰 번호등 Decrypt
 */
function callEncryptFunction() {
    AuthSSLManager.weave({
        'auth_mode' : 'decryptClient', //mode
        'auth_string' : document.getElementById('realNameEncrypt').value, //auth_string
        'auth_callbackName'  : 'setDisplayMember'      //callback function
    });
}


/**
 * 휴대폰, 아이폰 인증 후 이름, 휴대폰 번호등 display
 */
function setDisplayMember(sEncodeMember)
{
    var output = decodeURIComponent(sEncodeMember);

    if ( AuthSSLManager.isError(output) == true ) {
        alert(output);
        return;
    }

    var aMember = AuthSSLManager.unserialize(output);
    
    if ($('#nameContents') != undefined) {
        $('#nameContents').html(aMember.name);
    }
    
    try{
        $('#birth_year').val(aMember.birth_year);
        $('#birth_month').val(aMember.birth_month);
        $('#birth_day').val(aMember.birth_day);

        if ($('#editForm') != null) {
            $('#mobile1').val(aMember.mobile1);
            $('#mobile2').val(aMember.mobile2);
            $('#mobile3').val(aMember.mobile3);
        }
    }catch(e){}
    
    if (aMember.sIsUnder14Joinable == 'F' || aMember.sIsUnder14Joinable == 'M') {
        checkIsUnder14({ birth : aMember.birth });
    }
}

/**
 * Date 관련 util
 *
 * @package resource
 * @subpackage util
 * @author 이장규
 * @since 2011. 10. 14.
 * @version 1.0
 *
 */

var utilDate = new function() {
    
    /**
     * valid 한 날짜 체크
     * @param string sYear 년도
     * @param string sMonth 월
     * @param string sDay 일
     * @return bool
     */
    this.checkDate = function(sYear, sMonth, sDay) {

        if (sMonth.substr(0, 1) == '0') sMonth = sMonth.substr(1, 1);
        if (sDay.substr(0, 1) == '0') sDay = sDay.substr(1, 1);

        sMonth -= 1;
        var sNewDate = new Date(sYear, sMonth, sDay);
        
        return (sNewDate.getFullYear() == sYear && (sNewDate.getMonth()) == sMonth && sNewDate.getDate() == sDay)
    }


}

/**
 * dateUtil 날짜 간격 계산 스크립트
 *
 * 시작일, 종료일, 기준일 (standardDate) 을 기점으로 시작일과, 종료일을 출력합니다.
 *
 * @example
 *
 * var opts = {
 *     'startDate' : '#pr_start_date',
 *     'endDate' : '#pr_end_date'
 *  };
 *
 * standardDate = pr_start_date :: 선택적 .. 시적일, 종료일의 id 명
 * var sdate = dateUtil.init(options);
 *
 * @since 2011-03-11
 * @author jsyang < jsyang@simplexi.com >
 *
 */
var dateUtil = (function(){

    var $sDate, $eDate, opts = {
        'format'    : 'yyyy-mm-dd',
        'startDate' : false,
        'endDate'   : false,
        'year'      : null,
        'month'     : null,
        'day'       : null,
        'standardDate' : false
    };

    var formatLen = function(str){
        return str = (""+str).length<2 ? "0"+str : str;
    };

    var initDate = function(){
        opts.year  = null;
        opts.month = null;
        opts.day   = null;
    };

    var getLastDay = function(year, month){
        var dates = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        if ((year % 4) == 0) dates[1] = 29;
        return dates[month];
    };

    var targetMonth = function(std, add) {
        std = Number(std);
        var mod = add % 12;
        var sum = std + mod;

        if (sum < 0) {
            return 12 + sum;
        } else if (sum < 12) {
            return sum;
        }

        return sum - 12;
    };

    var calDate  = function(){

        var retDate  = new Date(), $standardDate = $("#" + opts.standardDate);

        opts.year  = (opts.year  == null) ? 0 : Number(opts.year);
        opts.month = (opts.month == null) ? 0 : Number(opts.month);
        opts.day   = (opts.day   == null) ? 0 : Number(opts.day);

        if ( opts.standardDate && $("#" + opts.standardDate ).get(0) && $("#" + opts.standardDate ).val() != "" ) {

            var dt = $("#" + opts.standardDate ).val(),
                yy = Number(dt.substring( opts.format.indexOf('yyyy') , opts.format.indexOf('yyyy') + 4)),
                mm = Number(dt.substring( opts.format.indexOf('mm') , opts.format.indexOf('mm')+ 2)),
                dd = Number(dt.substring( opts.format.indexOf('dd') , opts.format.indexOf('dd')+ 2));

            retDate.setYear(yy);
            retDate.setMonth(mm -1);
            retDate.setDate(dd);
        }

        var  yy = Number(retDate.getFullYear()) + opts.year,
             mm = Number(retDate.getMonth()) + opts.month,
             dd = Number(retDate.getDate()) + opts.day;

        if (getLastDay(yy, targetMonth(retDate.getMonth(), opts.month)) < dd) {
            retDate.setYear(yy);
            retDate.setDate(getLastDay(yy, targetMonth(retDate.getMonth(), opts.month)));
            retDate.setMonth(mm);
        } else {
            retDate.setYear(yy);
            retDate.setMonth(mm);
            retDate.setDate(dd);
        }

        return dateUtil.formatDate(retDate);

    };

    return {
        init : function(o){
            opts = $.extend({}, opts, o);
            this.setInputDate(opts.startDate,opts.endDate);

            function dateDiff(){
                var sdate = opts.startDate;
                var edate = opts.endDate;

                function settings(date, num){
                    dateUtil.setInputDate(sdate,edate);
                    dateUtil.setDate(date, num);
                };

                function clear(){
                    dateUtil.setInputDate(sdate,edate);
                    dateUtil.clearDate();
                };

                return {
                    'setDate' : settings,
                    'clearDate' : clear
                };
            }

            return new dateDiff;
        },

        setDate : function(date, num){
            initDate();

            if ( ( date == 'year' || date == 'month' || date == "" || date == 'day' ) ) {
                opts[ date ]  = num;
            } else if ( date == 'betweenMonth' ) {
                this.betweenMonth(num);
                return;
            }

            if ( opts.standardDate && $("#" + opts.standardDate ).get(0) && $("#" + opts.standardDate ).val() != "" ) {
                if(  $sDate.val() == "" && $eDate.val() == ""  ) {
                    this.setDefault();
                } else {
                    if ( opts.standardDate  == $sDate.attr("id") ) {
                        $eDate.val(calDate());
                    } else if ( opts.standardDate  == $eDate.attr("id") ) {
                        $sDate.val(calDate());
                    } else {
                        this.setDefault();
                    }
                }
            } else {
                this.setDefault();
            }
        },

        getLastDay : function(year, month){
            return getLastDay(year, month);
        },

        betweenMonth : function(month, year){
            var retDate  = new Date();
            retDate.setDate(1);

            if ( month && month > 0 ) {
                retDate.setMonth(month - 1);
            }

            if ( year && year > 0 ) {
                retDate.setYear(year);
            }

            var sdate = dateUtil.formatDate(retDate);

            retDate.setDate(this.getLastDay(retDate.getFullYear(), retDate.getMonth()));
            var edate = dateUtil.formatDate(retDate);

            $sDate.val(sdate);
            $eDate.val(edate);
        },

        setDefault: function(){
            $sDate.val(calDate());
            $eDate.val(this.toDay());
        },

        setInputDate : function(ss,ee){
            $sDate = $(ss);
            $eDate = $(ee);
        },

        formatDate : function(date){
            return opts.format.replace('yyyy' , date.getFullYear()).replace('mm', formatLen(date.getMonth() + 1)).replace('dd', formatLen(date.getDate()));
        },

        toDay : function(){
            return this.formatDate(new Date());
        },

        clearDate : function(){
            $sDate.val("");
            $eDate.val("");
        }
    };

})();

var agent = navigator.userAgent.toLowerCase();
var bMobileWeb = '';

$(document).ready(function(){

     // 모바일웹인지 확인
    if (window.location.hostname.substr(0, 2) == 'm.' ||
        window.location.hostname.substr(0, 12) == 'mobile--shop' ||
        window.location.hostname.substr(0, 11) == 'skin-mobile' ) {
        bMobileWeb = true;
    }

    // 모바일웹이 아닐경우만 포커스
    if (bMobileWeb !== true) {
        $('#zipcode_keyword').focus();
    }
});

var ZipcodeFinder = {};


/**
 * 부모창 객체
 */
ZipcodeFinder.Opener = {


    /**
     * 초기화 - 이벤트 바인딩
     */
    bind : function(btnId, zipId1, zipId2, addrId, type, cityId , stateId, sLanguage, addrId2, form) {

        var elmBtn = $('#' + btnId);
        if (elmBtn.data("btnEvent") != true) {
            var ci_name_item = "";
            // 기본 바인딩
            elmBtn.bind('click', {
                'zipId1' : zipId1,
                'zipId2' : zipId2,
                'addrId' : addrId,
                'cityId' : cityId,
                'stateId' : stateId,
                'type' : type,
                'sLanguage' : sLanguage,
                'addrId2' : addrId2,
                'form' : form
            }, this.Event.onClickBtnPopup)
            .data("btnEvent", true);
            // 우편번호 처리
            $('#postcode1').attr('fw-filter', 'isLengthRange[1][14]');
            $('#postcode2').attr('disabled', 'disabled');
        }
    }
};

/**
 * 부모창 객체 - 이벤트 핸들러
 */
ZipcodeFinder.Opener.Event = {

    /**
     * 클릭 - 우편번호 팝업 오픈
     */
    onClickBtnPopup : function(evt) {

        var zipId1 = evt.data.zipId1;
        var zipId2 = evt.data.zipId2;
        var addrId = evt.data.addrId;
        var stateId = evt.data.stateId;
        var cityId = evt.data.cityId;
        var type = evt.data.type;
        var sLanguage = evt.data.sLanguage;
        var addrId2 = evt.data.addrId2;
        var form = evt.data.form;

        var iWidth = 308;
        var iHeigth = 340;
        var posY = "60%";
        var posX = "35%";


        if (bMobileWeb === true || type == 'mobile') {
            var body_height = document.documentElement.clientHeight;
            
            var sTpl = "";
            switch (sLanguage) {
                case "ja_JP" :
                    sTpl = "zipcode_mobile_jp";
                    tmp$ = $;
                    break;
                case "zh_CN" :
                    sTpl = "zipcode_mobile_cn";
                    tmp$ = $;
                    break;
                case "zh_TW" :
                    sTpl = "zipcode_mobile_tw";
                    tmp$ = $;
                    break;
                default : 
                    sTpl = "zipcode_mobile";
                    break;
            }
            
            var source = '<div id="zipcodeLayer" style="position:fixed; top:-1px; left:0; bottom:0; right:0; width:100%; '
                + '-webkit-overflow-scrolling:touch; overflow-y:auto; background:#f1f1f1; z-index:999;"></div>';

            $.get('/protected/'+sTpl+'.html?form='+form+'&zip1='+zipId1+'&zip2='+zipId2+'&addr='+addrId+'&cityId='+cityId+'&stateId='+stateId+'&type=mobile&sLanguage='+sLanguage+'&addr2='+addrId2, function(data){
                $('body').append(source);
                $("#zipcodeLayer").html(data);
                if (sTpl == 'zipcode_mobile') {
                    $('body').addClass('eMobilePopup');
                } else {
                    $('body').attr('id', 'popup');
                }
            });

        } else if ( type == 'layer' || type == undefined ) {

            if ($('#zipcodeLayer').length > 0) return false;

            var sTpl = "";
            switch (sLanguage) {
                case "ja_JP" :
                    sTpl = "zipcode_layer_jp";
                    iWidth = 502;
                    iHeigth = 530;
                    var frameborder = 'frameborder="0"';
                    break;
                case "zh_CN" :
                    sTpl = "zipcode_layer_zh";
                    iWidth = 502;
                    iHeigth = 236;
                    var frameborder = 'frameborder="0"';
                    break;
                case "zh_TW" :
                    sTpl = "zipcode_layer_tw";
                    iWidth = 502;
                    iHeigth = 217;
                    var frameborder = 'frameborder="0"';
                    break;
                default : sTpl = "zipcode_layer_kr";
                    iHeigth = 420;
                    var frameborder = 'frameborder="0"';
                    break;
            }

            posY = $('#'+zipId1).offset().top-100 + 'px';
            posX = $('#'+zipId1).offset().left-100+'px';

            $('body').append('<div id="zipcodeLayer" class="zipcodeLayer" style="position:absolute; top:'+posY+'; left:'+posX+'; width:'+iWidth+'px; height:'+iHeigth+'px; background:#fff; z-index:999;"><iframe src="/protected/'+sTpl+'.html?form='+form+'&zip1='+zipId1+'&zip2='+zipId2+'&addr='+addrId+'&cityId='+cityId+'&stateId='+stateId+'&type=layer&sLanguage='+sLanguage+'&addr2=' + addrId2 + '" id="iframeZipcode" ' + frameborder + ' style="width:100%; height:100%; border:0;"></iframe></div>');

        } else {

            switch (sLanguage) {
            case "ja_JP" :
                sTpl = "zipcode_jp";
                break;
            case "zh_CN" :
                sTpl = "zipcode_zh";
                break;
            default : sTpl = "zipcode";
            }

            var url = '/protected/'+sTpl+'.html?zip1=' + zipId1 + '&zip2=' + zipId2 + '&addr=' + addrId;
            window.open(url, 'Zipcode', 'width=462, height=435, toolbar=0, menubar=0, scrollbars=0');

        }
    }

};


/**
 * 팝업 객체
 */
ZipcodeFinder.Popup = {

    /**
     * 초기화 - 이벤트 바인딩
     */
    bind : function(zipId1, zipId2, addrId, type,  cityId , stateId, sLanguage) {

        var elmKeyword = $('#zipcode_keyword');
        var elmBtnSearch = $('#zipcode_btn_search');
        var elmResult = $('#zipcode_result');
        var elmApply = $('#zipcode_apply');

        // 모바일웹일 경우 타켓 변경
        if ( (bMobileWeb === true || type == 'layer') && parent.$('#zipcodeLayer').length > 0 ) {

            var elmZip1 = parent.$('#' + zipId1);
            var elmAddr = parent.$('#' + addrId);

            if ( zipId2 != '') {
                var elmZip2 = parent.$('#' + zipId2);
            } else {
                var elmZip2 = parent.$('#ice0917');
            }
            if ( cityId != '') {
                var elmCity = parent.$('#' + cityId);
            } else {
                var elmCity = parent.$('#ice0918');
            }
            if ( stateId != '') {
                var elmState = parent.$('#' + stateId);
            } else {
                var elmState = parent.$('#ice0919');
            }

        } else {
            var elmZip1 = opener.$('#' + zipId1);
            if ( zipId2 != '') { var elmZip2 = opener.$('#' + zipId2); }
            var elmAddr = opener.$('#' + addrId);
            var elmCity = top.$('#ice0918');
            var elmState = top.$('#ice0919');
        }

        elmBtnSearch.bind('click', {
            'parent' : this,
            'elements' : {
                'keyword' : elmKeyword,
                'result' : elmResult,
                'zip1' : elmZip1,
                'zip2' : elmZip2,
                'addr' : elmAddr,
                'cityId' : elmCity,
                'stateId' : elmState,
                'type' : type,
                'sLanguage' : sLanguage
            }
        }, this.Event.onClickBtnSearch);

        window.resizeTo('500',$('div#wrap').outerHeight() + 85);
        elmKeyword.bind('keyup', {
            'parent' : this,
            'elements' : {
                'keyword' : elmKeyword,
                'result' : elmResult,
                'zip1' : elmZip1,
                'zip2' : elmZip2,
                'addr' : elmAddr,
                'cityId' : elmCity,
                'stateId' : elmState,
                'type' : type,
                'sLanguage' : sLanguage
            }
        }, this.Event.onClickBtnSearch);

        // 레이어 적용 버튼
        elmApply.bind('click', {
            'parent' : this,
            'elements' : {
                'keyword' : elmKeyword,
                'result' : elmResult,
                'zip1' : elmZip1,
                'zip2' : elmZip2,
                'addr' : elmAddr,
                'cityId' : elmCity,
                'stateId' : elmState,
                'type' : type,
                'sLanguage' : sLanguage
            }
        }, this.Event.onClickLayerResult);

    },

    /**
     * 성공시 출력 데이터 완성
     */
    makeSearchSuccess : function(elements, data) {

        if (elements.type == 'layer') {
            if ( elements.sLanguage == 'ja_JP') { // 일본 우편번호
                this.makeResultLayer_jp( elements, data );
            } else { // 국내 우편번호
                this.makeResultLayer(elements, data);
            }
        } else {
            this.makeResult(elements, data);
        }

    },

    /**
     * 성공시 출력 데이터 완성(Popup) - KR
     */
    makeResult : function(elements, data) {
        var count = data.length;
        var elmItem = '';

        elements.result.html('');

        for (var i=0; i < count; ++i) {

          //<tr><td>156-012</td><td>서울 동작구 신대방2동</td></tr>
            var address = '<td>' + data[i].zipcode + '</td><td>'
                        + data[i].addr + ' '
                        + data[i].bunji + '</td> ';

            var sAddr = (data[i].bunji.indexOf("∼") > -1) ? '' : ' '+data[i].bunji;

            elmItem = $('<tr addr="' + data[i].addr + sAddr + '">' + address + '</tr>').bind('click', {'elements' : elements}, this.Event.onClickResult);

            elements.result.append(elmItem);
        }
    },

    /**
     * 성공시 출력 데이터 완성(Layer) - JP
     */
    makeResultLayer_jp : function(elements, data) {

        var count = data.length;
        var elmItem = '';

        elements.result.html('');

        for (var i=0; i < count; ++i) {
            var _zipcode = data[i].zipcode;
            var _addr = data[i].sido_name + ' ' + data[i].gugun_name + ' ' + data[i].dong_name;

            var address = '<td class="left">' + _addr + '</td>'
                        + '<td>' + _zipcode + '</td>'
                        + '<td><a href="#none" class="btnNormal"><span>Select</span></a></td>';

            elmItem = $('<tr addr="' + data[i].sido_name + '|' + data[i].gugun_name + '|' + data[i].dong_name + '">' + address + '</tr>').bind('click', {'elements' : elements, 'zipcode' : _zipcode}, this.Event.onClickLayerResultJP);

            elements.result.append(elmItem);
        }
    },

    /**
     * 성공시 출력 데이터 완성(Layer) - KR
     */
    makeResultLayer : function(elements, data) {

        var count = data.length;
        var elmItem = '';

        elements.result.html('');

        for (var i=0; i < count; ++i) {
            //<tr><td>156-012</td><td>서울 동작구 신대방2동</td></tr>
            var address = '<td>' + data[i].zipcode + '</td><td>'
                        + data[i].addr + ' '
                        + data[i].bunji + '</td> ';

            var sAddr = (data[i].bunji.indexOf("∼") > -1) ? '' : ' '+data[i].bunji;

            elmItem = $('<tr addr="' + data[i].addr + sAddr + '">' + address + '</tr>').bind('click', {'elements' : elements}, this.Event.onClickLayerResult);

            elements.result.append(elmItem);
        }
    },

    /**
     * 실패시 출력 데이터 완성
     */
    makeSearchFail : function(elements) {

        if ( elements.sLanguage != 'ko_KR') { // 일본 우편번호
            var elm = $('<tr><td colspan="3">No Result</td></tr>');
        } else {
            var elm = $('<tr><td colspan="2">우편번호 검색 내역이 없습니다.</td></tr>');
        }

        elements.result.html('');
        elements.result.append(elm);
    }

};

/**
 * 팝업 객체 - 이벤트 핸들러
 */
ZipcodeFinder.Popup.Event = {

    /**
     * 레이어 선택
     */
    onClickLayer : function() {
        $(this).parents().find('.selected').removeClass('selected');
        $(this).addClass("selected");
    },

    /**
     * 클릭 - 검색버튼
     */
    onClickBtnSearch : function(evt) {
        if ( (evt.type == 'keyup' && evt.which != 13 )) return false;//enter 로 검색

        var parent = evt.data.parent;
        var elements = evt.data.elements;

        var keyword = elements.keyword.val();
        if (keyword == '') return false;

        var url = '/exec/front/zipcode/find/';
        var params = {
            'keyword' : keyword,
            'sLanguage' : elements.sLanguage
        };

        $.ajax({
            type : 'post',
            url : url,
            data : params,
            success : function(response){
                if (response.result === true) {
                    parent.makeSearchSuccess(elements, response.data);
                } else {
                    parent.makeSearchFail(elements);
                }

            }
        });
    },

    /**
     * 부모창에 주소,우편번호 입력 - JP
     */
    onClickLayerResultJP : function(evt) {

        var elements = evt.data.elements;

        var zip1 = evt.data.zipcode.substr(0, 3);
        var zip2 = evt.data.zipcode.substr(4, 4);
        var aAddr = $(this).attr('addr').split("|",3);

        if (elements.cityId.length > 0 && elements.stateId.length > 0 ) {
            elements.cityId.val( aAddr[0] );
            elements.stateId.val( aAddr[1] );
            elements.addr.val( aAddr[2] );
        } else {
            elements.addr.val( $(this).attr('addr') );
        }

        if ( elements.zip2.length > 0 ) {
            elements.zip1.val(zip1);
            elements.zip2.val(zip2);
        } else {
            elements.zip1.val( zip1+'-'+zip2 );
        }

        // 해외몰 지역별배송비 부과를 위해 event발생
        try {
            if (elements.zip1.attr('id') == 'fzipcode') {
                parent.$('#' + elements.zip1.attr('id') + ', #' + elements.addr.attr('id')).blur();
            }
        } catch (e) {}

        top.$('#zipcodeLayer').remove();
    },

    /**
     * 부모창에 주소,우편번호 입력 - KR
     */
    onClickLayerResult : function(evt) {

        var elements = evt.data.elements;

        var zip1 = $(this).text().substr(0, 3);
        var zip2 = $(this).text().substr(4, 3);
        var addr = $(this).attr('addr');

        addr = $.trim(addr);
        elements.addr.val(addr);

        elements.zip1.val(zip1);
        elements.zip2.val(zip2);

        if (parent.$('.tSubmit2').offset() != undefined) parent.$('html, body').animate({scrollTop: parent.$('.tSubmit2').offset().top}, 0);

        // 국내몰 지역별 배송비 부과를 위해 event 발생
        try{ 
            opener.EC_SHOP_FRONT_ORDERFORM_SHIPPING.exec(); 
        } catch (e){}

        // 해외몰 지역별배송비 부과를 위해 event발생
        try {
            if (elements.zip1.attr('id') == 'fzipcode') {
                parent.$('#' + elements.zip1.attr('id') + ', #' + elements.addr.attr('id')).blur();
            }
        } catch (e) {}

        parent.$('#zipcodeLayer').remove();
    },

    /**
     * 클릭 - 검색 결과 항목
     */
    onClickResult : function(evt) {

        var elements = evt.data.elements;

        var zip1 = $(this).text().substr(0, 3);
        var zip2 = $(this).text().substr(4, 3);
        var addr = $(this).attr('addr');

        addr = $.trim(addr);

        if ( elements.zip2 != undefined ) {
            elements.zip1.val(zip1);
            elements.zip2.val(zip2);
        } else {
            elements.zip1.val( $(this).text() );
        }

        elements.addr.val(addr);

        // 모바일웹일 경우 레이어창 닫기
        if (agent.indexOf('iphone') != -1 || agent.indexOf('android') != -1) {
            if (window.top.document.getElementById('frm_order_act')) {//ECHOSTING-42532
                //frm_order_act는 주문서작성페이지에 있는 폼객체의 id값
                //order.html같은 페이지주소를 이용하지 않는 이유는
                //스디의 특성상 페이지주소는 사용자에 의해 변동될수있기때문에 페이지주소보다는 사용자가 파일명을 수정한다고해도
                //주문서작성페이지라면 꼭 존재하는 객체를 기준으로 잡았음
               top.$('input, a, select, button, textarea, .trigger').show();
            }
            if (top.$('.tSubmit2').offset() != undefined) top.$('html, body').animate({scrollTop: top.$('.tSubmit2').offset().top}, 0);

            // 해외몰 지역별배송비 부과를 위해 event발생
            try {
                if (elements.zip1.attr('id') == 'fzipcode') {
                    top.$('#' + elements.zip1.attr('id') + ', #' + elements.addr.attr('id')).blur();
                }
            } catch (e) {}

            top.$('#zipcodeLayer').remove();
        } else {
            window.self.close();
        }
    }
};
;

/**
 * FwValidator
 *
 * @package     jquery
 * @subpackage  validator
 */

var FwValidator = {

    /**
     * 디버그 모드
     */
    DEBUG_MODE : false,

    /**
     * 결과 코드
     */
    CODE_SUCCESS    : true,
    CODE_FAIL       : false,

    /**
     * 어트리뷰트 명
     */
    ATTR_FILTER     : 'fw-filter',
    ATTR_MSG        : 'fw-msg',
    ATTR_LABEL      : 'fw-label',
    ATTR_FIREON     : 'fw-fireon',
    ATTR_ALONE      : 'fw-alone',

    /**
     * 응답객체들
     */
    responses       : {},

    /**
     * 엘리먼트별 필수 입력 에러 메세지
     */
    requireMsgs     : {},

    /**
     * 엘리먼트의 특정 필터별 에러 메세지
     */
    elmFilterMsgs   : {},

    /**
     * Validator 기본 이벤트 등록
     */
    bind : function(formId, expand) {

        var self = this;
        var formInfo = this.Helper.getFormInfo(formId);

        if (formInfo === false) {
            alert('The form does not exist - bind');
            return false;
        }

        var elmForm = formInfo.instance;

        var Response = this._response(formId);

        this._fireon(formId, elmForm, Response);
        this._submit(formId, elmForm, expand);

        return true;

    },

    /**
     * Validator 검사 진행
     *
     * @param string formId
     * @return object | false
     */
    inspection : function(formId, expand) {

        expand = (expand === true) ? true : false;

        var self = this;
        var Response = this._response(formId);

        if (Response === false) {
            alert('The form does not exist - inspection');
            return false;
        }

        if (Response.elmsTarget.length == 0) {
            return this.Helper.getResult(Response, this.CODE_SUCCESS);
        }

        Response.elmsTarget.each(function(){
            self._execute(Response, this);
        });

        if (Response.elmsCurrErrorField.length > 0) {

            if (expand !== true) {
                this.Handler.errorHandler(Response.elmsCurrErrorField[0]);
            } else {
                this.Handler.errorHandlerByExapnd(Response);
            }

            return Response.elmsCurrErrorField[0];

        }

        return this.Helper.getResult(Response, this.CODE_SUCCESS);

    },

    /**
     * submit 이벤트 등록
     *
     * @param string    formId
     * @param object    elmForm
     */
    _submit : function(formId, elmForm, expand) {
        var self = this;

        elmForm.unbind('submit');
        elmForm.bind('submit', function(){
            var result = false;

            try{
                result = self.inspection(formId, expand);
            }catch(e){
                alert(e);
                return false;
            }

            if(!result || result.passed === self.CODE_FAIL){
                return false;
            };

            var callback = self._beforeSubmit(elmForm);

            return callback !== false ? true : false;
        });
    },

    /**
     * fireon 이벤트 등록
     *
     * @param string                formId
     * @param object                elmForm
     * @param FwValidator.Response  Response
     */
    _fireon : function(formId, elmForm, Response) {
        var self = this;
        var formInfo = this.Helper.getFormInfo(formId);

        $(formInfo.selector).find('*['+this.ATTR_FILTER+']['+this.ATTR_FIREON+']').each(function(){
            var elm = $(this);
            var evtName = $.trim(elm.attr(self.ATTR_FIREON));
            var elmMsg = '';

            elm.unbind(evtName);
            elm.bind(evtName, function(){
                var result = self._execute(Response, this);
                var targetField = Response.elmCurrField;

                //에러 메세지가 출력되 있다면 일단 지우고 체킹을 시작한다.
                if(typeof elmMsg == 'object'){
                    elmMsg.remove();
                }

                if(result > -1){
                    elmMsg = self.Handler.errorHandlerByFireon(Response.elmsCurrErrorField[result]);
                }else{
                    self.Handler.successHandlerByFireon(self.Helper.getResult(Response, self.CODE_FAIL));
                }
            });
        });
    },

    /**
     * Response 객체 생성
     *
     * @param string formId
     * @return FwValidator.Response | false
     */
    _response : function(formId) {

        var formInfo = this.Helper.getFormInfo(formId);

        if (formInfo === false) {
            alert('The form does not exist - find');
            return false;
        }

        var elmForm = formInfo.instance;
        var elmsTarget = $(formInfo.selector).find('*[' + this.ATTR_FILTER + ']');

        this.responses[formId] = new FwValidator.Response();

        this.responses[formId].formId = formId;
        this.responses[formId].elmForm = elmForm;
        this.responses[formId].elmsTarget = elmsTarget;

        return this.responses[formId];

    },

    /**
     * BeforeExecute 콜백함수 실행
     *
     * @param FwValidator.Response Response
     */
    _beforeExecute : function(Response) {

        var count = this.Handler.beforeExecute.length;

        if (count == 0) return;

        for (var i in this.Handler.beforeExecute) {
            this.Handler.beforeExecute[i].call(this, Response);
        }

    },

    /**
     * BeforeSubmit 콜백함수 실행
     *
     * @param object elmForm (jquery 셀렉터 문법으로 찾아낸 폼 객체)
     */
    _beforeSubmit : function(elmForm) {

        if(typeof this.Handler.beforeSubmit != 'function') return true;

        return this.Handler.beforeSubmit.call(this, elmForm);

    },

    /**
     * 엘리먼트별 유효성 검사 실행
     *
     * @param FwValidator.Response  Response
     * @param htmlElement           elmTarget
     * @return int(에러가 발생한 elmCurrField 의 인덱스값) | -1(성공)
     */
    _execute : function(Response, elmTarget) {

        var RESULT_SUCCESS = -1;

        Response.elmCurrField = $(elmTarget);
        Response.elmCurrLabel = Response.elmCurrField.attr(this.ATTR_LABEL);
        Response.elmCurrFieldType = this.Helper.getElmType(Response.elmCurrField);
        Response.elmCurrFieldDisabled = elmTarget.disabled;
        Response.elmCurrValue = this.Helper.getValue(Response.formId, Response.elmCurrField);
        Response.elmCurrErrorMsg = Response.elmCurrField.attr(this.ATTR_MSG);

        //_beforeExecute 콜백함수 실행
        this._beforeExecute(Response);

        //필드가 disabled 일 경우는 체크하지 않음.
        if (Response.elmCurrFieldDisabled === true) {
            return RESULT_SUCCESS;
        }

        var filter = $.trim( Response.elmCurrField.attr(this.ATTR_FILTER) );

        if (filter == '') {
            return RESULT_SUCCESS;
        }

        //is로 시작하지 않는것들은 정규표현식으로 간주
        if (/^is/i.test(filter)) {
            var filters = filter.split('&');
            var count = filters.length;

            //필수항목이 아닌경우 빈값이 들어왔을경우는 유효성 체크를 통과시킴

            if ((/isFill/i.test(filter) === false) && !Response.elmCurrValue) {
                return RESULT_SUCCESS;
            }

            for (var i=0; i < count; ++i) {
                var filter = filters[i];
                var param = '';
                var filtersInfo = this.Helper.getFilterInfo(filter);

                filter = Response.elmCurrFilter = filtersInfo.id;
                param = filtersInfo.param;

                //필수 입력 필터의 경우 항목관리에서 사용자가 메세지를 직접 지정하는 부분이 있어 이렇게 처리
                if (filter == 'isFill') {
                    Response.elmCurrValue = $.trim(Response.elmCurrValue);
                    Response.elmCurrErrorMsg = this.requireMsgs[elmTarget.id] ? this.requireMsgs[elmTarget.id] : this.msgs['isFill'];
                } else {
                    var msg = Response.elmCurrField.attr(this.ATTR_MSG);

                    if (msg) {
                        Response.elmCurrErrorMsg = msg;
                    } else if (this.Helper.getElmFilterMsg(elmTarget.id, filter)) {
                        Response.elmCurrErrorMsg = this.Helper.getElmFilterMsg(elmTarget.id, filter);
                    } else {
                        Response.elmCurrErrorMsg = this.msgs[filter];
                    }

                }

                //존재하지 않는 필터인 경우 에러코드 반환
                if(this.Filter[filter] === undefined){
                    Response.elmCurrErrorMsg = this.msgs['notMethod'];
                    var result = this.Helper.getResult(Response, this.CODE_FAIL);

                    Response.elmsCurrErrorField.push(result);
                    return Response.elmsCurrErrorField.length - 1;
                }

                //필터 실행
                var result = this.Filter[filter](Response, param);

                if (result == undefined || result.passed === this.CODE_FAIL) {
                    Response.elmsCurrErrorField.push(result);

                    //Debug를 위해 넣어둔 코드(확장형 필터를 잘못 등록해서 return값이 없는 경우를 체크하기 위함)
                    if (result == undefined) {
                        alert('Extension Filter Return error - ' + filter);
                    }

                    return Response.elmsCurrErrorField.length - 1;
                }
            }
        } else {
            var msg = Response.elmCurrErrorMsg;
            Response.elmCurrErrorMsg = msg ? msg : this.msgs['isRegex'];
            var result = this.Filter.isRegex(Response, filter);

            if(result.passed === this.CODE_FAIL){
                Response.elmsCurrErrorField.push(result);

                return Response.elmsCurrErrorField.length - 1;
            }
        }

        return RESULT_SUCCESS;
    }
};

/**
 * FwValidator.Response
 *
 * @package     jquery
 * @subpackage  validator
 */

FwValidator.Response = function() {

    this.formId = null;
    this.elmForm = null;
    this.elmsTarget = null;
    this.elmsCurrErrorField = [];

    this.elmCurrField = null;
    this.elmCurrFieldType = null;
    this.elmCurrFieldDisabled = null;
    this.elmCurrLabel = null;
    this.elmCurrValue = null;
    this.elmCurrFilter = null;
    this.elmCurrErrorMsg = null;

    this.requireMsgs = {};

};

/**
 * FwValidator.Helper
 *
 * @package     jquery
 * @subpackage  validator
 */

FwValidator.Helper = {

    parent : FwValidator,

    /**
     * 메세지 엘리먼트의 아이디 prefix
     */
    msgIdPrefix : 'msg_',

    /**
     * 메세지 엘리먼트의 클래스 명 prefix
     */
    msgClassNamePrefix : 'msg_error_mark_',

    /**
     * 결과 반환
     */
    getResult : function(Response, code, param) {

        //특수 파라미터 정보(특정 필터에서만 사용함)
        param = param != undefined ? param : {};

        var msg = '';

        if (code === this.parent.CODE_FAIL) {

            try {
                msg = Response.elmCurrErrorMsg.replace(/\{label\}/i, Response.elmCurrLabel);
            } catch(e) {
                msg = 'No Message';
            }

        } else {

            msg = 'success';

        }

        var result = {};
        result.passed = code;
        result.formid = Response.formId;
        result.msg = msg;
        result.param = param;

        try {
        result.element = Response.elmCurrField;
        result.elmid = Response.elmCurrField.attr('id');
        result.filter = Response.elmCurrFilter;
        } catch(e) {}

        return result;

    },

    /**
     * 필터 정보 반환(필터이름, 파라미터)
     */
    getFilterInfo : function(filter) {
        var matches = filter.match(/(is[a-z]*)((?:\[.*?\])*)/i);

        return {
            id : matches[1],
            param : this.getFilterParams(matches[2])
        };
    },

    /**
     * 필터의 파라미터 스트링 파싱
     * isFill[a=1][b=1][c=1] 이런식의 멀티 파라미터가 지정되어 있는 경우는 배열로 반환함
     * isFill[a=1] 단일 파라미터는 파라미터로 지정된 스트링값만 반환함
     */
    getFilterParams : function(paramStr) {
        if (paramStr == undefined || paramStr == null || paramStr == '') {
            return '';
        }

        var matches = paramStr.match(/\[.*?\]/ig);

        if (matches == null) {
            return '';
        }

        var count = matches.length;
        var result = [];

        for (var i=0; i < count; i++) {
            var p = matches[i].match(/\[(.*?)\]/);
            result.push(p[1]);
        }

        if (result.length == 1) {
            return result[0];
        }

        return result;
    },

    /**
     * 필드 타입 반환(select, checkbox, radio, textbox)
     */
    getElmType : function(elmField) {
        elmField = $(elmField);

        var elTag = elmField[0].tagName;
        var result = null;

        switch (elTag) {
            case 'SELECT' :
                result = 'select';
                break;

            case 'INPUT' :
                var _type = elmField.attr('type').toLowerCase();
                if(_type == 'checkbox') result = 'checkbox';
                else if(_type =='radio') result = 'radio';
                else result = 'textbox';

                break;

            case 'TEXTAREA' :
                result = 'textbox';
                break;

            default :
                result = 'textbox';
                break;
        }

        return result;
    },

    /**
     * 필드 값 반환
     */
    getValue : function(formId, elmField) {
        var result = '';
        var elmName = elmField.attr('name');
        var fieldType = this.getElmType(elmField);

        //checkbox 나 radio 박스는 value값을 반환하지 않음
        if (fieldType == 'checkbox' || fieldType == 'radio') {
            if(elmField.get(0).checked === true){
                result = elmField.val();
            }
            return result;
        }

        //alonefilter 속성이 Y 로 되어 있다면 해당 엘리먼트의 값만 반환함
        var aloneFilter = elmField.attr(this.parent.ATTR_ALONE);
        if(aloneFilter == 'Y' || aloneFilter == 'y'){
            return elmField.val();
        }

        //name이 배열형태로 되어 있다면 값을 모두 합쳐서 반환
        if( /\[.*?\]/.test(elmName) ){
            var formInfo = this.getFormInfo(formId);

            var groupElms = $(formInfo.selector +' [name="'+elmName+'"]');
            groupElms.each(function(i){
                var elm = $(this);
                result += elm.val();
            });
        }else{
            result = elmField.val();
        }

        return result;
    },

    /**
     * 에러메세지 엘리먼트 생성
     */
    createMsg : function(elm, msg, formId) {
        var elmMsg = document.createElement('span');

        elmMsg.id = this.msgIdPrefix + elm.attr('id');
        elmMsg.className = this.msgClassNamePrefix + formId;
        elmMsg.innerHTML = msg;

        return $(elmMsg);
    },

    /**
     * 에러메세지 엘리먼트 제거
     */
    removeMsg : function(elm) {
        var id = this.msgIdPrefix + elm.attr('id');
        var elmErr = $('#'+id);

        if (elmErr) elmErr.remove();
    },

    /**
     * 에러메세지 엘리먼트 모두 제거
     */
    removeAllMsg : function(formId) {
        var className = this.msgClassNamePrefix + formId;

        $('.' + className).remove();
    },

    /**
     * 문자열의 Byte 수 반환
     */
    getByte : function(str) {
        var encode = encodeURIComponent(str);
        var totalBytes = 0;
        var chr;
        var bytes;
        var code;

        for(var i = 0; i < encode.length; i++)
        {
            chr = encode.charAt(i);
            if(chr != "%") totalBytes++;
            else
            {
                code = parseInt(encode.substr(i+1,2),16);
                if(!(code & 0x80)) totalBytes++;
                else
                {
                    if((code & 0xE0) == 0xC0) bytes = 2;
                    else if((code & 0xF0) == 0xE0) bytes = 3;
                    else if((code & 0xF8) == 0xF0) bytes = 4;
                    else return -1;

                    i += 3 * (bytes - 1);

                    totalBytes += 2;
                }
                i += 2;
            }
        }

        return totalBytes;
    },

    /**
     * 지정한 엘리먼트의 필터 메세지가 존재하는가
     *
     * @param elmId (엘리먼트 아이디)
     * @param filter (필터명)
     * @return string | false
     */
    getElmFilterMsg : function(elmId, filter) {
        if (this.parent.elmFilterMsgs[elmId] == undefined) return false;
        if (this.parent.elmFilterMsgs[elmId][filter] == undefined) return false;

        return this.parent.elmFilterMsgs[elmId][filter];
    },

    /**
     * 폼 정보 반환
     *
     * @param formId (폼 아이디 혹은 네임)
     * @return array(
     *   'selector' => 셀렉터 문자,
     *   'instance' => 셀렉터 문법으로 검색해낸 폼 객체
     * ) | false
     */
    getFormInfo : function(formId) {
        var result = {};
        var selector = '#' + formId;
        var instance = $(selector);

        if (instance.length > 0) {
            result.selector = selector;
            result.instance = instance;

            return result;
        }

        selector = 'form[name="' + formId + '"]';
        instance = $(selector);

        if (instance.length > 0) {
            result.selector = selector;
            result.instance = instance;

            return result;
        }

        return false;
    },

    /**
     * 숫자형태의 문자열로 바꿔줌
     * 123,123,123
     * 123123,123
     * 123%
     * 123  %
     * 123.4
     * -123
     * ,123
     *
     * @param value
     * @return float
     */
    getNumberConv : function(value) {
        if (!value || value == undefined || value == null) return '';

        value = value + "";

        value = value.replace(/,/g, '');
        value = value.replace(/%/g, '');
        value = value.replace(/[\s]/g, '');

        if (this.parent.Verify.isFloat(value) === false) return '';

        return parseFloat(value);
    }
};

/**
 * FwValidator.Handler
 *
 * @package     jquery
 * @subpackage  validator
 */

FwValidator.Handler = {

    parent : FwValidator,

    /**
     * 사용자 정의형 에러핸들러(엘리먼트 아이디별로 저장됨)
     */
    customErrorHandler : {},

    /**
     * 사용자 정의형 에러핸들러(필터별로 저장됨)
     */
    customErrorHandlerByFilter : {},

    /**
     * 사용자 정의형 성공핸들러(엘리먼트 아이디별로 저장됨)
     */
    customSuccessHandler : {},

    /**
     * 사용자 정의형 성공핸들러(필터별로 저장됨)
     */
    customSuccessHandlerByFilter : {},

    /**
     * FwValidator._execute에 의해 검사되기 전 실행되는 콜백함수
     */
    beforeExecute : [],

    /**
     * FwValidator._submit에서 바인딩한 onsubmit 이벤트 발생후 실행되는 콜백함수
     * {폼아이디 : 콜백함수, ...}
     */
    beforeSubmit : {},

    /**
     * 기본 메세지 전체를 오버라이딩
     */
    overrideMsgs : function(msgs) {
        if (typeof msgs != 'object') return;

        this.parent.msgs = msgs;
    },

    /**
     * 필드에 따른 필수 입력 에러메세지 설정
     */
    setRequireErrorMsg : function(field, msg) {
        this.parent.requireMsgs[field] = msg;
    },

    /**
     * 필터 타입에 따른 에러메세지 설정
     */
    setFilterErrorMsg : function(filter, msg) {
        this.parent.msgs[filter] = msg;
    },

    /**
     * 엘리먼트의 특정 필터에만 에러메세지를 설정
     */
    setFilterErrorMsgByElement : function(elmId, filter, msg) {
        if (this.parent.elmFilterMsgs[elmId] == undefined) {
            this.parent.elmFilterMsgs[elmId] = {};
        }

        this.parent.elmFilterMsgs[elmId][filter] = msg;
    },

    /**
     * 엘리먼트 아이디별 사용자정의형 에러핸들러 등록
     */
    setCustomErrorHandler : function(elmId, func) {
        if (typeof func != 'function') return;

        this.customErrorHandler[elmId] = func;
    },

    /**
     * 필터 타입별 사용자정의형 에러핸들러 등록
     */
    setCustomErrorHandlerByFilter : function(filter, func) {
        if (typeof func != 'function') return;

        this.customErrorHandlerByFilter[filter] = func;
    },

    /**
     * 엘리먼트 아이디별 사용자정의형 성공핸들러 등록
     */
    setCustomSuccessHandler : function(elmId, func) {
        if (typeof func != 'function') return;

        this.customSuccessHandler[elmId] = func;
    },

    /**
     * 필터 타입별 사용자정의형 성공핸들러 등록
     */
    setCustomSuccessHandlerByFilter : function(filter, func) {
        if (typeof func != 'function') return;

        this.customSuccessHandlerByFilter[filter] = func;
    },

    /**
     * 확장형 필터 등록
     */
    setExtensionFilter : function(filter, func) {
        if (typeof func != 'function') return;

        if (this.parent.Filter[filter] == undefined) {
            this.parent.Filter[filter] = func;
        }
    },

    /**
     * 각 엘리먼트가 FwValidator._execute에 의해 검사되기 전 실행되는 콜백함수 등록
     */
    setBeforeExecute : function(func) {
        if (typeof func != 'function') return;

        this.beforeExecute.push(func);
    },

    /**
     * FwValidator._submit 에서 바인딩된 onsubmit 이벤트의 콜백함수 등록(유효성 검사가 성공하면 호출됨)
     */
    setBeforeSubmit : function(func) {
        if (typeof func != 'function') return;

        this.beforeSubmit = func;
    },

    /**
     * 에러핸들러 - 기본
     */
    errorHandler : function(resultData) {
        if (this._callCustomErrorHandler(resultData) === true) return;

        alert(resultData.msg);
        resultData.element.focus();
    },

    /**
     * 에러핸들러 - 전체 펼침 모드
     */
    errorHandlerByExapnd : function(Response) {
        var count = Response.elmsCurrErrorField.length;

        //해당 폼에 출력된 에러메세지를 일단 모두 지운다.
        this.parent.Helper.removeAllMsg(Response.formId);

        for (var i=0; i < count; ++i) {
            var resultData = Response.elmsCurrErrorField[i];

            if (this._callCustomErrorHandler(resultData) === true) continue;

            var elmMsg = this.parent.Helper.createMsg(resultData.element, resultData.msg, resultData.formid).css({'color':'#FF3300'});
            elmMsg.appendTo(resultData.element.parent());
        }
    },

    /**
     * 에러핸들러 - fireon
     */
    errorHandlerByFireon : function(resultData) {
        if (this._callCustomErrorHandler(resultData) === true) return;

        //해당 항목의 에러메세지 엘리먼트가 있다면 먼저 삭제한다.
        this.parent.Helper.removeMsg(resultData.element);

        var elmMsg = this.parent.Helper.createMsg(resultData.element, resultData.msg, resultData.formid).css({'color':'#FF3300'});
        elmMsg.appendTo(resultData.element.parent());

        return elmMsg;
    },

    /**
     * 성공핸들러 - fireon
     */
    successHandlerByFireon : function(resultData) {

        this._callCustomSuccessHandler(resultData);

    },

    /**
     * 정의형 에러 핸들러 호출
     *
     * @return boolean (정의형 에러핸들러를 호출했을 경우 true 반환)
     */
    _callCustomErrorHandler : function(resultData) {
        //resultData 가 정의되어 있지 않은 경우
        if (resultData == undefined) {
            alert('errorHandler - resultData is not found');
            return true;
        }

        //해당 엘리먼트에 대한 Custom에러핸들러가 등록되어 있다면 탈출
        if (this.customErrorHandler[resultData.elmid] != undefined) {
            this.customErrorHandler[resultData.elmid].call(this.parent, resultData);
            return true;
        }

        //해당 필터에 대한 Custom에러핸들러가 등록되어 있다면 탈출
        if (this.customErrorHandlerByFilter[resultData.filter] != undefined) {
            this.customErrorHandlerByFilter[resultData.filter].call(this.parent, resultData);
            return true;
        }

        return false;
    },

    /**
     * 정의형 성공 핸들러 호출 - 기본적으로 fireon 속성이 적용된 엘리먼트에만 적용됨.
     */
    _callCustomSuccessHandler : function(resultData) {

        if (this.customSuccessHandler[resultData.elmid] != undefined) {
            this.customSuccessHandler[resultData.elmid].call(this.parent, resultData);
            return;
        }

        if (this.customSuccessHandlerByFilter[resultData.filter] != undefined) {
            this.customSuccessHandlerByFilter[resultData.filter].call(this.parent, resultData);
            return;
        }

    }
};

/**
 * FwValidator.Verify
 *
 * @package     jquery
 * @subpackage  validator
 */

FwValidator.Verify = {

    parent : FwValidator,

    isNumber : function(value, cond) {
        if (value == '') return true;

        if (!cond) {
            cond = 1;
        }

        cond = parseInt(cond);

        pos = 1;
        nga = 2;
        minpos = 4;
        minnga = 8;

        result = 0;

        if ((/^[0-9]+$/).test(value) === true) {
            result = pos;
        } else if ((/^[-][0-9]+$/).test(value) === true) {
            result = nga;
        } else if ((/^[0-9]+[.][0-9]+$/).test(value) === true) {
            result = minpos;
        } else if ((/^[-][0-9]+[.][0-9]+$/).test(value) === true) {
            result = minnga;
        }

        if (result & cond) {
            return true;
        }

        return false;
    },

    isFloat : function(value) {
        if (value == '') return true;

        return (/^[\-0-9]([0-9]+[\.]?)*$/).test(value);
    },

    isIdentity : function(value) {
        if (value == '') return true;

        return (/^[a-z]+[a-z0-9_]+$/i).test(value);
    },

    isKorean : function(value) {
        if (value == '') return true;

        var count = value.length;

        for(var i=0; i < count; ++i){
            var cCode = value.charCodeAt(i);

            //공백은 무시
            if(cCode == 0x20) continue;

            if(cCode < 0x80){
                return false;
            }
        }

        return true;
    },

    isAlpha : function(value) {
        if (value == '') return true;

        return (/^[a-z]+$/i).test(value);
    },

    isAlphaUpper : function(value) {
        if (value == '') return true;

        return (/^[A-Z]+$/).test(value);
    },

    isAlphaLower : function(value) {
        if (value == '') return true;

        return (/^[a-z]+$/).test(value);
    },

    isAlphaNum : function(value) {
        if (value == '') return true;

        return (/^[a-z0-9]+$/i).test(value);
    },

    isAlphaNumUpper : function(value) {
        if (value == '') return true;

        return (/^[A-Z0-9]+$/).test(value);
    },

    isAlphaNumLower : function(value) {
        if (value == '') return true;

        return (/^[a-z0-9]+$/).test(value);
    },

    isAlphaDash : function(value) {
        if (value == '') return true;

        return (/^[a-z0-9_-]+$/i).test(value);
    },

    isAlphaDashUpper : function(value) {
        if (value == '') return true;

        return (/^[A-Z0-9_-]+$/).test(value);
    },

    isAlphaDashLower : function(value) {
        if (value == '') return true;

        return (/^[a-z0-9_-]+$/).test(value);
    },

    isSsn : function(value) {
        value = value.replace(/-/g, '');
        if (value == '') return true;

        if ( (/[0-9]{2}[01]{1}[0-9]{1}[0123]{1}[0-9]{1}[1234]{1}[0-9]{6}$/).test(value) === false ) {
            return false;
        }

        var sum = 0;
        var last = value.charCodeAt(12) - 0x30;
        var bases = "234567892345";
        for (var i=0; i<12; i++) {
            sum += (value.charCodeAt(i) - 0x30) * (bases.charCodeAt(i) - 0x30);
        };
        var mod = sum % 11;

        if ( (11 - mod) % 10 != last ) {
            return false;
        }

        return true;
    },

    isForeignerNo : function(value) {
        value = value.replace(/-/g, '');
        if (value == '') return true;

        if ( (/[0-9]{2}[01]{1}[0-9]{1}[0123]{1}[0-9]{1}[5678]{1}[0-9]{1}[02468]{1}[0-9]{2}[6789]{1}[0-9]{1}$/).test(value) === false ) {
            return false;
        }

        var sum = 0;
        var last = value.charCodeAt(12) - 0x30;
        var bases = "234567892345";
        for (var i=0; i<12; i++) {
            sum += (value.charCodeAt(i) - 0x30) * (bases.charCodeAt(i) - 0x30);
        };
        var mod = sum % 11;
        if ( (11 - mod + 2) % 10 != last ) {
            return false;
        }

        return true;
    },

    isBizNo : function(value) {
        value = value.replace(/-/g, '');
        if (value == '') return true;

        if ( (/[0-9]{3}[0-9]{2}[0-9]{5}$/).test(value) === false ) {
            return false;
        }

        var sum = parseInt(value.charAt(0));
        var chkno = [0, 3, 7, 1, 3, 7, 1, 3];
        for (var i = 1; i < 8; i++) {
            sum += (parseInt(value.charAt(i)) * chkno[i]) % 10;
        }
        sum += Math.floor(parseInt(parseInt(value.charAt(8))) * 5 / 10);
        sum += (parseInt(value.charAt(8)) * 5) % 10 + parseInt(value.charAt(9));

        if (sum % 10 != 0) {
            return false;
        }

        return true;
    },

    isJuriNo : function(value) {
        value = value.replace(/-/g, '');
        if (value == '') return true;

        if ( (/^([0-9]{6})-?([0-9]{7})$/).test(value) === false ) {
            return false;
        }

        var sum = 0;
        var last = parseInt(value.charAt(12), 10);
        for (var i=0; i<12; i++) {
            if (i % 2 == 0) {  // * 1
                sum += parseInt(value.charAt(i), 10);
            } else {    // * 2
                sum += parseInt(value.charAt(i), 10) * 2;
            };
        };

        var mod = sum % 10;
        if( (10 - mod) % 10 != last ){
            return false;
        }

        return true;
    },

    isPhone : function(value) {
        value = value.replace(/-/g, '');
        if (value == '') return true;

        return (/^(02|0[0-9]{2,3})[1-9]{1}[0-9]{2,3}[0-9]{4}$/).test(value);
    },

    isMobile : function(value) {
        value = value.replace(/-/g, '');
        if (value == '') return true;

        return (/^01[016789][1-9]{1}[0-9]{2,3}[0-9]{4}$/).test(value);
    },

    isZipcode : function(value) {
        value = value.replace(/-/g, '');
        if (value == '') return true;

        return (/^[0-9]{3}[0-9]{3}$/).test(value);
    },

    isIp : function(value) {
        if (value == '') return true;

        return (/^([1-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])(\.([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])){2,}$/).test(value);
    },

    isEmail : function(value) {
        if (value == '') return true;

        return (/^([a-z0-9\_\-\.]+)@([a-z0-9\_\-]+\.)+[a-z]{2,63}$/i).test(value);
    },

    isUrl : function(value) {
        if (value == '') return true;

        return (/http[s]?:\/\/[a-z0-9_\-]+(\.[a-z0-9_\-]+)+/i).test(value);
    },

    isDate : function(value) {
        value = value.replace(/-/g, '');
        if (value == '') return true;

        return (/^[12][0-9]{3}(([0]?[1-9])|([1][012]))[0-3]?[0-9]$/).test(value);
    },

    isPassport : function(value) {
        if (value == '') return true;

        //일반 여권
        if ( (/^[A-Z]{2}[0-9]{7}$/).test(value) === true ) {
            return true;
        }

        //전자 여권
        if ( (/^[A-Z]{1}[0-9]{8}$/).test(value) === true ) {
            return true;
        }

        return false;
    },

    isNumberMin : function(value, limit) {
        value = this.parent.Helper.getNumberConv(value);
        limit = this.parent.Helper.getNumberConv(limit);

        if (value < limit) {
            return false;
        }

        return true;
    },

    isNumberMax : function(value, limit) {
        value = this.parent.Helper.getNumberConv(value);
        limit = this.parent.Helper.getNumberConv(limit);

        if (value > limit) {
            return false;
        }

        return true;
    },

    isNumberRange : function(value, min, max) {
        value = this.parent.Helper.getNumberConv(value);

        min = this.parent.Helper.getNumberConv(min);
        max = this.parent.Helper.getNumberConv(max);

        if (value < min || value > max) {
            return false;
        }

        return true;
    }
};

/**
 * FwValidator.Filter
 *
 * @package     jquery
 * @subpackage  validator
 */

FwValidator.Filter = {

    parent : FwValidator,

    isFill : function(Response, cond) {
        if (typeof cond != 'string') {
            var count = cond.length;
            var result = this.parent.Helper.getResult(Response, parent.CODE_SUCCESS);

            for (var i = 0; i < count; ++i) {
                result = this._fillConditionCheck(Response, cond[i]);

                if (result.passed === true) {
                    return result;
                }
            }

            return result;
        }

        return this._fillConditionCheck(Response, cond);
    },

    isMatch : function(Response, sField) {
        if(Response.elmCurrValue == ''){
            return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
        }

        //Radio 나 Checkbox의 경우 무시
        if(Response.elmCurrFieldType == 'radio' || Response.elmCurrFieldType == 'checkbox'){
            return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
        }

        var elmTarget = $('#'+sField);
        var elmTargetValue = elmTarget.val();

        if (Response.elmCurrValue != elmTargetValue) {
            var label = elmTarget.attr(this.parent.ATTR_LABEL);
            var match = label ? label : sField;

            Response.elmCurrErrorMsg = Response.elmCurrErrorMsg.replace(/\{match\}/i, match);

            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isMax : function(Response, iLen) {
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        if (Response.elmCurrFieldType == 'radio' || Response.elmCurrFieldType == 'checkbox') {
            var chkCount = 0;
            var sName = Response.elmCurrField.attr('name');

            $('input[name="'+sName+'"]').each(function(i){
                if ($(this).get(0).checked === true) {
                    ++chkCount;
                }
            });

            if (chkCount > iLen) {
                result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            }

        } else {
            var len = Response.elmCurrValue.length;

            if (len > iLen) {
                result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            }
        }

        if (result.passed === this.parent.CODE_FAIL) {
            result.msg = result.msg.replace(/\{max\}/i, iLen);
        }

        return result;
    },

    isMin : function(Response, iLen) {
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        if(Response.elmCurrFieldType == 'radio' || Response.elmCurrFieldType == 'checkbox'){
            var chkCount = 0;
            var sName = Response.elmCurrField.attr('name');

            $('input[name="'+sName+'"]').each(function(i){
                if($(this).get(0).checked === true){
                    ++chkCount;
                }
            });

            if (chkCount < iLen) {
                result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            }

        }else{
            var len = Response.elmCurrValue.length;

            if(len < iLen){
                result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            }
        }

        if(result.passed === this.parent.CODE_FAIL){
            result.msg = result.msg.replace(/\{min\}/i, iLen);
        }

        return result;
    },

    isNumber : function(Response, iCond) {
        var result = this.parent.Verify.isNumber(Response.elmCurrValue, iCond);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isIdentity : function(Response){
        var result = this.parent.Verify.isIdentity(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isKorean : function(Response){
        var result = this.parent.Verify.isKorean(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlpha : function(Response){
        var result = this.parent.Verify.isAlpha(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlphaLower : function(Response){
        var result = this.parent.Verify.isAlphaLower(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlphaUpper : function(Response){
        var result = this.parent.Verify.isAlphaUpper(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlphaNum : function(Response){
        var result = this.parent.Verify.isAlphaNum(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlphaNumLower : function(Response){
        var result = this.parent.Verify.isAlphaNumLower(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlphaNumUpper : function(Response){
        var result = this.parent.Verify.isAlphaNumUpper(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlphaDash : function(Response){
        var result = this.parent.Verify.isAlphaDash(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlphaDashLower : function(Response){
        var result = this.parent.Verify.isAlphaDashLower(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlphaDashUpper : function(Response){
        var result = this.parent.Verify.isAlphaDashUpper(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isSsn : function(Response){
        var result = this.parent.Verify.isSsn(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isForeignerNo : function(Response){
        var result = this.parent.Verify.isForeignerNo(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isBizNo : function(Response){
        var result = this.parent.Verify.isBizNo(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isJuriNo : function(Response){
        var result = this.parent.Verify.isJuriNo(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isPhone : function(Response){
        var result = this.parent.Verify.isPhone(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isMobile : function(Response){
        var result = this.parent.Verify.isMobile(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isZipcode : function(Response){
        var result = this.parent.Verify.isZipcode(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isIp : function(Response){
        var result = this.parent.Verify.isIp(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isEmail : function(Response){
        var result = this.parent.Verify.isEmail(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isUrl : function(Response){
        var result = this.parent.Verify.isUrl(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isDate : function(Response){
        var result = this.parent.Verify.isDate(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isRegex : function(Response, regex){
        regex = eval(regex);

        if( regex.test(Response.elmCurrValue) === false ){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isPassport : function(Response){
        var result = this.parent.Verify.isPassport(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isSimplexEditorFill : function(Response){

        var result = eval(Response.elmCurrValue + ".isEmptyContent();");

        if(result === true){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

    },

    isMaxByte : function(Response, iLen) {
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        var len = this.parent.Helper.getByte(Response.elmCurrValue);

        if (len > iLen) {
            result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            result.msg = result.msg.replace(/\{max\}/i, iLen);
        }

        return result;
    },

    isMinByte : function(Response, iLen) {
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        var len = this.parent.Helper.getByte(Response.elmCurrValue);

        if (len < iLen) {
            result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            result.msg = result.msg.replace(/\{min\}/i, iLen);
        }

        return result;
    },

    isByteRange : function(Response, range) {
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        var rangeInfo = this._getRangeNum(range);
        var iMin = rangeInfo.min;
        var iMax = rangeInfo.max;

        var len = this.parent.Helper.getByte(Response.elmCurrValue);

        if (len < iMin || len > iMax) {
            result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            result.msg = result.msg.replace(/\{min\}/i, iMin);
            result.msg = result.msg.replace(/\{max\}/i, iMax);
        }

        return result;
    },

    isLengthRange : function(Response, range) {
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        var rangeInfo = this._getRangeNum(range);
        var iMin = rangeInfo.min;
        var iMax = rangeInfo.max;

        var resultMin = this.isMin(Response, iMin);
        var resultMax = this.isMax(Response, iMax);

        if (resultMin.passed === this.parent.CODE_FAIL || resultMax.passed === this.parent.CODE_FAIL) {
            result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            result.msg = result.msg.replace(/\{min\}/i, iMin);
            result.msg = result.msg.replace(/\{max\}/i, iMax);
        }

        return result;
    },

    isNumberMin : function(Response, iLimit) {
        var check = this.parent.Verify.isNumberMin(Response.elmCurrValue, iLimit);
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        if(check === false){
            result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            result.msg = result.msg.replace(/\{min\}/i, iLimit);
        }

        return result;
    },

    isNumberMax : function(Response, iLimit) {
        var check = this.parent.Verify.isNumberMax(Response.elmCurrValue, iLimit);
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        if(check === false){
            result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            result.msg = result.msg.replace(/\{max\}/i, iLimit);
        }

        return result;
    },

    isNumberRange : function(Response, range) {
        var iMin = range[0];
        var iMax = range[1];

        var check = this.parent.Verify.isNumberRange(Response.elmCurrValue, iMin, iMax);
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        if(check === false){
            result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            result.msg = result.msg.replace(/\{min\}/i, iMin);
            result.msg = result.msg.replace(/\{max\}/i, iMax);
        }

        return result;
    },

    _getRangeNum : function(range) {
        var result = {};

        result.min = range[0] <= 0 ? 0 : parseInt(range[0]);
        result.max = range[1] <= 0 ? 0 : parseInt(range[1]);

        return result;
    },

    _fillConditionCheck : function(Response, cond) {
        cond = $.trim(cond);

        var parent = this.parent;

        //조건식이 들어오면 조건식에 맞을 경우만 필수값을 체크함
        if (cond) {
            var conditions = cond.split('=');
            var fieldId = $.trim(conditions[0]);
            var fieldVal = $.trim(conditions[1]);

            try {
                var val = parent.Helper.getValue(Response.formId, $('#'+fieldId));
                val = $.trim(val);

                if(fieldVal != val) {
                    return parent.Helper.getResult(Response, parent.CODE_SUCCESS);
                }
            } catch(e) {
                if (parent.DEBUG_MODE == true) {
                    Response.elmCurrErrorMsg = parent.msgs['isFillError'];
                    Response.elmCurrErrorMsg = Response.elmCurrErrorMsg.replace(/\{condition\}/i, cond);
                    return parent.Helper.getResult(Response, parent.CODE_FAIL);
                }

                return parent.Helper.getResult(Response, parent.CODE_SUCCESS);
            }
        }

        //Radio 나 Checkbox의 경우 선택한값이 있는지 여부를 체크함
        if (Response.elmCurrFieldType == 'radio' || Response.elmCurrFieldType == 'checkbox') {

            var sName = Response.elmCurrField.attr('name');
            var result = parent.Helper.getResult(Response, parent.CODE_FAIL);

            $('input[name="'+sName+'"]').each(function(i){
                if ($(this).get(0).checked === true) {
                    result = parent.Helper.getResult(Response, parent.CODE_SUCCESS);
                }
            });

            return result;

        }

        //일반 텍스트 박스
        if (Response.elmCurrValue != '') {
            return parent.Helper.getResult(Response, parent.CODE_SUCCESS);
        }

        return parent.Helper.getResult(Response, parent.CODE_FAIL);
    }
};

FwValidator.msgs = {

    //기본
    'isFill' : '{label} 항목은 필수 입력값입니다.',

    'isNumber' : '{label} 항목이 숫자 형식이 아닙니다.',

    'isEmail' : '{label} 항목이 이메일 형식이 아닙니다.',

    'isIdentity' : '{label} 항목이 아이디 형식이 아닙니다.',

    'isMax' : '{label} 항목이 {max}자(개) 이하로 해주십시오.',

    'isMin' : '{label} 항목이 {min}자(개) 이상으로 해주십시오 .',

    'isRegex' : '{label} 항목이 올바른 입력값이 아닙니다.',

    'isAlpha' : '{label} 항목이 영문이 아닙니다',

    'isAlphaLower' : '{label} 항목이 영문 소문자 형식이 아닙니다',

    'isAlphaUpper' : '{label} 항목이 영문 대문자 형식이 아닙니다',

    'isAlphaNum' : '{label} 항목이 영문이나 숫자 형식이 아닙니다.',

    'isAlphaNumLower' : '{label} 항목이 영문 소문자 혹은 숫자 형식이 아닙니다.',

    'isAlphaNumUpper' : '{label} 항목이 영문 대문자 혹은 숫자 형식이 아닙니다.',

    'isAlphaDash' : '{label} 항목이 [영문,숫자,_,-] 형식이 아닙니다.',

    'isAlphaDashLower' : '{label} 항목이 [영문 소문자,숫자,_,-] 형식이 아닙니다.',

    'isAlphaDashUpper' : '{label} 항목이 [영문 대문자,숫자,_,-] 형식이 아닙니다.',

    'isKorean' : '{label} 항목이 한국어 형식이 아닙니다.',

    'isUrl' : '{label} 항목이 URL 형식이 아닙니다.',

    'isSsn' : '{label} 항목이 주민등록번호 형식이 아닙니다.',

    'isForeignerNo' : '{label} 항목이 외국인등록번호 형식이 아닙니다.',

    'isBizNo' : '{label} 항목이 사업자번호 형식이 아닙니다.',

    'isPhone' : '{label} 항목이 전화번호 형식이 아닙니다.',

    'isMobile' : '{label} 항목이 핸드폰 형식이 아닙니다.',

    'isZipcode' : '{label} 항목이 우편번호 형식이 아닙니다.',

    'isJuriNo' : '{label} 항목이 법인번호 형식이 아닙니다.',

    'isIp' : '{label} 항목이 아이피 형식이 아닙니다.',

    'isDate' : '{label} 항목이 날짜 형식이 아닙니다.',

    'isMatch' : '{label} 항목과 {match} 항목이 같지 않습니다.',

    'isSuccess' : '{label} 항목의 데이터는 전송할 수 없습니다.',

    'isSimplexEditorFill' : '{label}(을/를) 입력하세요',

    'isPassport' : '{label} 항목이 여권번호 형식이 아닙니다.',

    'isMaxByte' : '{label} 항목은 {max}bytes 이하로 해주십시오.',

    'isMinByte' : '{label} 항목은 {min}bytes 이상으로 해주십시오.',

    'isByteRange' : '{label} 항목은 {min} ~ {max}bytes 범위로 해주십시오.',

    'isLengthRange' : '{label} 항목은 {min} ~ {max}자(개) 범위로 해주십시오.',

    'isNumberMin' : '{label} 항목은 {min} 이상으로 해주십시오.',

    'isNumberMax' : '{label} 항목은 {max} 이하로 해주십시오.',

    'isNumberRange' : '{label} 항목은 {min} ~ {max} 범위로 해주십시오.',


    //디버깅
    'notMethod' : '{label} 항목에 존재하지 않는 필터를 사용했습니다.',

    'isFillError' : "[{label}] 필드의 isFill {condition} 문장이 잘못되었습니다.\r\n해당 필드의 아이디를 확인하세요."

};

FwValidator.Handler.overrideMsgs({

    //기본
    'isFill' : sprintf(__('%s 항목은 필수 입력값입니다.'), '{label}'),

    'isNumber' : sprintf(__('%s 항목이 숫자 형식이 아닙니다.'), '{label}'),

    'isEmail' : sprintf(__('%s 항목이 이메일 형식이 아닙니다.'), '{label}'),

    'isIdentity' : sprintf(__('%s 항목이 아이디 형식이 아닙니다.'), '{label}'),

    'isMax' : sprintf(__('%1$s 항목이 %2$s자(개) 이하로 해주십시오.'), '{label}', '{max}'),

    'isMin' : sprintf(__('%1$s 항목이 %2$s자(개) 이상으로 해주십시오.'), '{label}', '{min}'),

    'isRegex' : sprintf(__('%s 항목이 올바른 입력값이 아닙니다.'), '{label}'),

    'isAlpha' : sprintf(__('%s 항목이 영문이 아닙니다.'), '{label}'),

    'isAlphaLower' : sprintf(__('%s 항목이 영문 소문자 형식이 아닙니다.'), '{label}'),

    'isAlphaUpper' : sprintf(__('%s 항목이 영문 대문자 형식이 아닙니다.'), '{label}'),

    'isAlphaNum' : sprintf(__('%s 항목이 영문이나 숫자 형식이 아닙니다.'), '{label}'),

    'isAlphaNumLower' : sprintf(__('%s 항목이 영문 소문자 혹은 숫자 형식이 아닙니다.'), '{label}'),

    'isAlphaNumUpper' : sprintf(__('%s 항목이 영문 대문자 혹은 숫자 형식이 아닙니다.'), '{label}'),

    'isAlphaDash' : sprintf(__('%s 항목이 [영문,숫자,_,-] 형식이 아닙니다.'), '{label}'),

    'isAlphaDashLower' : sprintf(__('%s 항목이 [영문 소문자,숫자,_,-] 형식이 아닙니다.'), '{label}'),

    'isAlphaDashUpper' : sprintf(__('%s 항목이 [영문 대문자,숫자,_,-] 형식이 아닙니다.'), '{label}'),

    'isKorean' : sprintf(__('%s 항목이 한국어 형식이 아닙니다.'), '{label}'),

    'isUrl' : sprintf(__('%s 항목이 URL 형식이 아닙니다.'), '{label}'),

    'isSsn' : sprintf(__('%s 항목이 주민등록번호 형식이 아닙니다.'), '{label}'),

    'isForeignerNo' : sprintf(__('%s 항목이 외국인등록번호 형식이 아닙니다.'), '{label}'),

    'isBizNo' : sprintf(__('%s 항목이 사업자번호 형식이 아닙니다.'), '{label}'),

    'isPhone' : sprintf(__('%s 항목이 전화번호 형식이 아닙니다.'), '{label}'),

    'isMobile' : sprintf(__('%s 항목이 핸드폰 형식이 아닙니다.'), '{label}'),

    'isZipcode' : sprintf(__('%s 항목이 우편번호 형식이 아닙니다.'), '{label}'),

    'isJuriNo' : sprintf(__('%s 항목이 법인번호 형식이 아닙니다.'), '{label}'),

    'isIp' : sprintf(__('%s 항목이 아이피 형식이 아닙니다.'), '{label}'),

    'isDate' : sprintf(__('%s 항목이 날짜 형식이 아닙니다.'), '{label}'),

    'isMatch' : sprintf(__('%1$s 항목과 %2$s 항목이 같지 않습니다.'), '{label}', '{match}'),

    'isSuccess' : sprintf(__('%s 항목의 데이터는 전송할 수 없습니다.'), '{label}'),

    'isSimplexEditorFill' : sprintf(__('%s(을/를) 입력하세요.'), '{label}'),

    'isPassport' : sprintf(__('%s 항목이 여권번호 형식이 아닙니다.'), '{label}'),

    'isMaxByte' : sprintf(__('%1$s 항목은 %2$sbytes 이하로 해주십시오.'), '{label}', '{max}'),

    'isMinByte' : sprintf(__('%1$s 항목은 %2$sbytes 이상으로 해주십시오.'), '{label}', '{min}'),

    'isByteRange' : sprintf(__('%1$s 항목은 %2$s ~ %3$sbytes 범위로 해주십시오.'), '{label}', '{min}', '{max}'),

    'isLengthRange' : sprintf(__('%1$s 항목은 %2$s ~ %3$s자(개) 범위로 해주십시오.'), '{label}', '{min}', '{max}'),

    'isNumberMin' : sprintf(__('%1$s 항목은 %2$s 이상으로 해주십시오.'), '{label}', '{min}'),

    'isNumberMax' : sprintf(__('%1$s 항목은 %2$s 이하로 해주십시오.'), '{label}', '{max}'),

    'isNumberRange' : sprintf(__('%1$s 항목은 %2$s ~ %3$s 범위로 해주십시오.'), '{label}', '{min}', '{max}'),


    //디버깅
    'notMethod' : sprintf(__('%s 항목에 존재하지 않는 필터를 사용했습니다.'), '{label}'),

    'isFillError' : sprintf(__('[%1$s] 필드의 isFill %2$s 문장이 잘못되었습니다.\r\n해당 필드의 아이디를 확인하세요.'), '{label}', '{condition}')

});
/**
 * 엘리먼트 종류별 값 가져오기 form 에 의한 동일한 name 값 구별
 *
 * - 오브젝트를 받아서 사용할 수 있게함.
 *
 * @param String id
 * @return
 * @author 박난하 <nhpark@simplexi.com>, 백충덕 <cdbaek@simplexi.com>, 이재욱 <jwlee03@simplexi.com>
 */
AuthSSLManager.getValue = function(id) {
    //id 가 string인 경우
    if (typeof id == 'string') {
        var divide, o, type;

        divide = id.split('::');
        if (divide.length == 1) {
            o = document.getElementsByName(id);
        } else {
            var frm = divide[0], id = divide[1];

            // radio, checkbox
            if ($('#'+id).length==0) {
                val = this.checkbox({'name': id, 'mode': 'val'});
                return val;
            }
            o = document.forms[frm][id];
        }

        if ( o == null || o == undefined || o.value == null || o.value == undefined ) {
            o = document.getElementsByName(id);
            // 전체 html 에선 id 값이 있지만 form 밖에 있을수 있으므로 조건추가 (ECHOSTING-265537)
            val = (o[0] == undefined) ? '' : o[0].value;
        } else {
            val = o.value;
        }

        return val;

    } else if (typeof id == 'object') {
        //id가 object인 경우

        //오직 하나의 오브젝트에 대해서만 처리
        if ($(id).length == 1) {
            return $(id).val();
        } else {
            return ''
        }

    } else {
        // id가 string 또는 object가 아닐 경우 빈 값 리턴
        return '';
    }
};

/**
 * 엘리먼트 종류별 값 가져오기 form 에 의한 동일한 name 값 구별
 * @param String id
 * @return
 * @author 박난하 <nhpark@simplexi.com>, 백충덕 <cdbaek@simplexi.com>
 */
AuthSSLManager.getValuePay = function(id) {
    var divide, o, type;

    // id가 string이 아닐 경우 빈 값 리턴
    if (typeof id != 'string') return '';

    divide = id.split('::');
    var frm = divide[0], id = divide[1];

    // radio, checkbox
    if ($('#'+id).length==0) {
        val = this.checkbox({'name': id, 'mode': 'val'});
        return val;
    }

    o = document.forms[frm][id];

    if ( o == null || o == undefined || o.value == null || o.value == undefined ) {
        o = document.getElementsByName(id);
        val = o[0].value;
    } else {
        val = o.value;
    }

    return val;
};

/**
 * 암호화 param 데이터 세팅
 * @param array param 암호화 관련
 * @return string p 암호화 param
 * @author 박난하 <nhpark@simplexi.com>
 * */
AuthSSLManager.setParam = function(param) {
    var p = [];
        if (param['auth_mode'] == 'encrypt1.9') {
            p.push('auth_mode=encrypt');
        } else {
            p.push('auth_mode=' + param['auth_mode']);
        }
        p.push('auth_callbackName=' + param['auth_callbackName']);
    switch(param['auth_mode']) {
        case 'encrypt1.9':
            var aEle = param['aEleId'], o, p2 = {}, v;
            var divide = '';
            var id = '';
            for ( var i in aEle ) {
                if (aEle.hasOwnProperty(i) == false) continue;
                v = this.getValuePay(aEle[i]);

                if ( v == -1 ) continue;

                divide = aEle[i].split('::');
                id = divide[1];

                p2[id] = this.getValuePay(aEle[i]);
            }
            p.push('auth_string=' + encodeURIComponent(__JSON.stringify(p2)));
            break;
        case 'encrypt':
            var aEle = param['aEleId'], o, p2 = {}, v;
            for ( var i in aEle ) {
                if (aEle.hasOwnProperty(i) == false) continue;
                v = this.getValue(aEle[i]);

                if ( v == -1 ) continue;

                //암호화 대상이 오브젝트인경우 id값이 key가 된다.
                if (typeof aEle[i] == 'object') {
                    p2[$(aEle[i]).attr('id')] = this.getValue(aEle[i]);
                } else {
                    p2[aEle[i]] = this.getValue(aEle[i]);
                }
            }
            p.push('auth_string=' + encodeURIComponent(__JSON.stringify(p2)));
            break;
        case 'decrypt':
        case 'decryptClient':
            p.push('auth_string=' + encodeURIComponent(param['auth_string']));
            break;
    }

    return p;
};


/**
 * radio, checkbox 값 가져오기
 * @param object options 옵션
 * @return string radio 또는 checkbox value 반환
 * @author 박난하 <nhpark@simplexi.com>, 백충덕 <cdbaek@simplexi.com>
 * */
AuthSSLManager.checkbox = function(options)
{
    var o = document.getElementsByName(options.name);
    if ( o == null ) return;

    // element 없음
    if (o.length<1) {
        var chk = false;
        var o = document.getElementById(options.name);
        if ( o == null ) return '';
        if ( o.checked == true ) var chk = true;
        return chk == true ? o.value : '';
    }

    var bChecked = false;
    var aChk = new Array();
    for ( var i = 0; i < o.length; i++ ) {
        var el = $('#'+o[i].id);

        if ( el.attr('checked') == true ) {
            // RADIO
            if (el.attr('type') == 'radio') return el.val();
            // CHECKBOX
            else if (el.attr('type') == 'checkbox') {
                aChk.push(el.val());
                bChecked = true;
            }
        }
    }

    if ( options.mode == 'val' ) {
        if (bChecked == false) return '';

        if (aChk.length>0) return aChk.join('|');
    }
};






/**
 * AuthSSL을 통해 submit을 할 폼 클래스
 * @author 백충덕 <cdbaek@simplexi.com>
 * @since 2011. 6. 16
 * */
var FormSSL = function()
{
    /**
     * 폼 아이디
     * @var string
     * */
    this.sFormId = null;
    /**
     * 암호화 시킬 엘리먼트 id 배열
     * @var array
     * */
    this.aEleId  = null;

    /**
     * onsubmit bind
     * @param string sFormId bind 할 폼 아이디
     * @param array  aEleId  암호화할 엘리먼트 id 배열
     * */
    this.bind = function(sFormId, aEleId)
    {
        var self = this;

        this.sFormId = sFormId;
        this.aEleId  = aEleId;

        var oForm = $('#'+sFormId);
        oForm.unbind('submit');
        oForm.bind('submit', function(){
            AuthSSL.Submit(self.sFormId, self.aEleId);

            return false;
        });
    };

    /**
     * AuthSSL submit 실행
     * */
    this.submit = function()
    {
        AuthSSL.Submit(this.sFormId, this.aEleId);
        return false;
    };
};


/**
 * AuthSSL 폼 객체 리스트 관리
 * @author 백충덕 <cdbaek@simplexi.com>
 * @since 2011. 6. 16
 * */
var FormSSLContainer = {
    /**
     * 폼 객체 리스트
     * @var object
     * */
    aFormSSL: {},

    /**
     * 폼 객체 생성 및 리스트에 추가
     * @param string sFormId 객체로 생성할 폼 아이디
     * @param array  aEleId  암호화 할 엘리먼트 아이디
     * */
    create: function (sFormId, aEleId)
    {
        if (this.formExists(sFormId)==false) {
            var oFormSSL = new FormSSL();
            oFormSSL.bind(sFormId, aEleId);
            this.aFormSSL[sFormId] = oFormSSL;
        }
    },

    /**
     * 폼 아이디로 AuthSSL submit 실행
     * @param string sFormId 폼 아이디
     * */
    submit: function (sFormId)
    {
        if (this.formExists(sFormId)==false) return;

        this.aFormSSL[sFormId].submit();
    },

    /**
     * 폼 아이디로 FormSSLContainer에 해당 폼이 있는지 체크
     * @param string sFormId 체크할 폼 아이디
     * @return bool 폼이 있으면 true, 없으면 false
     * */
    formExists: function (sFormId)
    {
        if (!this.aFormSSL[sFormId]) return false;
        else return true;
    }
};



/**
 * AuthSSL 클래스
 * @author 백충덕 <cdbaek@simplexi.com>
 * @since 2011. 6. 16
 * */
var AuthSSL = {
    /**
     * SSL on/off
     * @var bool
     * */
    bIsSsl : true,
    /**
     * 폼 아이디
     * @var string
     * */
    sFormId : null,
    /**
     * 엘리먼트 아이디
     * @var array
     * */
    aEleId : null,
    /**
     * 폼 객체 (jQuery)
     * @var object
     * */
    oFormSubmit: null,
    /**
     * 암호화 된 문자열이 저장될 input hidden id
     * @var string
     * */
    sEncryptId : 'encrypted_str',
    /**
     * callback 함수 이름
     * @var string
     * */
    sCallbackName : 'AuthSSL.encryptSubmit_Complete',

    /**
     * 멤버변수 세팅
     * @param string sFormId 폼 아이디
     * @param array  aEleId  엘리먼트 아이디
     * */
    init: function(sFormId, aEleId)
    {
        this.sFormId = sFormId;
        this.aEleId  = aEleId;
        this.oFormSubmit = $('#' + sFormId);
    },

    /**
     * AuthSSLManager 존재여부 체크
     * @return bool 존재하면 true, 아니면 false 반환
     * */
    checkAvailable: function()
    {
        // AuthSSLManager가 없음
        if (typeof AuthSSLManager!='object') {
            alert('[Error]\nneed SSL Manager');
            return false;
        }

        return true;
    },

    /**
     * onsubmit bind
     * @param string sFormId 폼 아이디
     * @param array  aEleId  암호화하고자 하는 필드의 id
     * */
    Bind: function(sFormId, aEleId)
    {
        FormSSLContainer.create(sFormId, aEleId);
    },

    /**
     * 암호화 요청 함수 - submit
     * @param string sFormId 폼 아이디
     * @param array  aEleId  엘리먼트 아이디
     * */
    Submit: function(sFormId, aEleId) {
        // AuthSSLManager 존재여부 체크
        if (this.checkAvailable()==false) return false;

        // 폼 아이디, 엘리먼트 아이디 세팅
        this.init(sFormId, aEleId);

        // 암호화 요청이 아닐 경우 그냥 submit
        if (this.bIsSsl == false) {
            this.disabledSslSubmit();
            return false;
        }

        // 암호화 된 값을 받을 input_hidden 생성
        var oInput = document.createElement('input');
        oInput.type = 'hidden';
        oInput.name = oInput.id = this.sEncryptId;
        this.oFormSubmit.append(oInput);

        // 암호화 요청
        this.encrypt(this.aEleId, this.sCallbackName);
    },

    /**
     * 암호화 요청
     * @param array aEleId 암호화할 엘리먼트 id
     * @param string sCallbackName 콜백함수 이름
     * */
    encrypt: function(aEleId, sCallbackName) {
        AuthSSLManager.weave({
            'auth_mode'        : 'encrypt',
            'aEleId'           : aEleId,
            'auth_callbackName': sCallbackName
        });
    },

    /**
     * 암호화 처리결과 callback 함수
     * @param string sOutput 암호화 된 처리결과
     * */
    encryptSubmit_Complete: function(sOutput) {
        // Error
        if ( AuthSSLManager.isError(sOutput) == true ) {
            alert('[Error]\n'+sOutput);
            return;
        }

        // 암호화 처리된 엘리먼트의 value 제거
        this.delInputValue();

        // input_hidden에 암호화 된 결과값 대입
        this.oFormSubmit.find('[id="'+this.sEncryptId+'"]').val(sOutput);

        // Form Submit
        this.oFormSubmit.unbind('submit');

        this.delInputValue();

        this.oFormSubmit.submit();
    },

    /**
     * INPUT.RADIO, INPUT.CHECKBOX의 value 지움
     * @param string sName 값을 지우고자 하는 element의 name
     * */
    delRadioValue: function(sName) {
        var oEle = document.getElementsByName(sName);
        if (oEle.length>0) {

            for (var i = 0; i < oEle.length; i++) {

                oEle[i].value = '';

                if (oEle[i].defaultValue) {

                    oEle[i].defaultValue = '';
                }
            }
        }
    },

    /**
     * 암호화 될 폼 요소들의 값을 지움
     */
    delInputValue : function() {
        for (var i=0; i<this.aEleId.length; i++) {

            // 값을 지울 element의 id 가져오기
            var sID = AuthSSL.getEleId(this.aEleId[i]);
            var oEle = this.oFormSubmit.find('[id="' + sID + '"]');

            // id를 표기하지 않고 name만 표기한 radio, checkbox
            if (oEle.length == 0) {

                this.delRadioValue(sID);
                continue;
            }

            // SELECT
            if (oEle.is('SELECT')) {

                var oSelect = oEle.children('option:selected');
                oSelect.val('');
                oSelect.attr('value', '');
                oSelect.attr('defaultValue', '');
            }
            // INPUT.TEXT, INPUT.PASSWORD, TEXTAREA
            else {

                oEle.val('');
                oEle.attr('value', '');
                oEle.attr('defaultValue', '');
            }
        } // for
    },

    /**
     * 넘겨받은 id에서 폼 아이디와 구분자를 제거하여 가져오기
     * @param string sOrgID 원본 폼 아이디
     * @return string 폼 아이디와 구분자가 제거된 아이디 반환
     * */
    getEleId: function(sOrgID)
    {
        var sID = sOrgID;
        if (/::/.test(sID)==true) {
            var aTmp = sID.split('::');
            sID = aTmp[1];
        }

        return sID;
    },

    /**
     * bIsSsl이 false 일때 실행
     */
    disabledSslSubmit : function() {
        this.oFormSubmit.unbind('submit');
        this.oFormSubmit.submit();
    }
};


// validator submit hook
$(document).ready(function(){
    if (typeof FwValidator == 'undefined') return;

    FwValidator.Handler.setBeforeSubmit(function(elmForm){
        // AuthSSL 사용폼
        if (FormSSLContainer.formExists(elmForm.attr('id'))==true) {
            if (!FormSSLContainer) return true;

            FormSSLContainer.submit(elmForm.attr('id'));
            return false;
        }

        // AuthSSL 사용폼이 아닐 경우 그냥 submit
        return true;
    });
});

/**
 * 접속통계 & 실시간접속통계
 */
$(document).ready(function(){
    // 이미 weblog.js 실행 되었을 경우 종료 
    if ($('#log_realtime').length > 0) {
        return;
    }
    /*
     * QueryString에서 디버그 표시 제거
     */
    function stripDebug(sLocation)
    {
        if (typeof sLocation != 'string') return '';

        sLocation = sLocation.replace(/^d[=]*[\d]*[&]*$/, '');
        sLocation = sLocation.replace(/^d[=]*[\d]*[&]/, '');
        sLocation = sLocation.replace(/(&d&|&d[=]*[\d]*[&]*)/, '&');

        return sLocation;
    }

    if (window.self == window.top) {
        var rloc = escape(document.location);
        var rref = escape(document.referrer);
    } else {
        var rloc = (document.location).pathname;
        var rref = '';
    }

    // realconn & Ad aggregation
    var _aPrs = new Array();
    _sUserQs = window.location.search.substring(1);
    _sUserQs = stripDebug(_sUserQs);
    _aPrs[0] = 'rloc='+rloc;
    _aPrs[1] = 'rref='+rref;
    _aPrs[2] = 'udim='+window.screen.width+'*'+window.screen.height;
    _aPrs[3] = 'rserv='+aLogData.log_server2;
    _aPrs[4] = 'cid='+eclog.getCid();
    _aPrs[5] = 'role_path=' + $('meta[name="path_role"]').attr('content');

    // 모바일웹일 경우 추가 파라미터 생성
    var _sMobilePrs = '';
    if (mobileWeb === true) _sMobilePrs = '&mobile=T&mobile_ver=new';

    _sUrlQs = _sUserQs + '&' + _aPrs.join('&') + _sMobilePrs;
    
    var _sUrlFull = '/exec/front/eclog/main/?'+_sUrlQs;
    
    var node = document.createElement('iframe');
    node.setAttribute('src', _sUrlFull);
    node.setAttribute('id', 'log_realtime');
    document.body.appendChild(node);
    
    $('#log_realtime').hide();
    
    // eclog2.0, eclog1.9
    var sTime = new Date().getTime();//ECHOSTING-54575

    // 접속통계 서버값이 있다면 weblog.js 호출 
    if (aLogData.log_server1 != null && aLogData.log_server1 != '') {
        var sScriptSrc = '//' + aLogData.log_server1 + '/weblog.js?uid=' + aLogData.mid + '&uname=' + aLogData.mid + '&r_ref=' + document.referrer;
        if (mobileWeb === true) sScriptSrc += '&cafe_ec=mobile';
        sScriptSrc += '&t=' + sTime;//ECHOSTING-54575
        var node = document.createElement('script');
        node.setAttribute('type', 'text/javascript');
        node.setAttribute('src', sScriptSrc);
        node.setAttribute('id', 'log_script');
        document.body.appendChild(node);
    }
});

/**
 * 비동기식 데이터
 */
var CAPP_ASYNC_METHODS = {
    DEBUG: false,
    IS_LOGIN: (document.cookie.match(/(?:^| |;)iscache=F/) ? true : false),
    EC_PATH_ROLE: $('meta[name="path_role"]').attr('content') || '',
    aDatasetList: [],
    $xansMyshopMain: $('.xans-myshop-main'),
    init : function()
    {
    	var bDebug = CAPP_ASYNC_METHODS.DEBUG;

        var aUseModules = [];
        var aNoCachedModules = [];

        $(CAPP_ASYNC_METHODS.aDatasetList).each(function(){
            var sKey = this;

            var oTarget = CAPP_ASYNC_METHODS[sKey];

            if (bDebug) {
                console.log(sKey);
            }
            var bIsUse = oTarget.isUse();
            if (bDebug) {
                console.log('   isUse() : ' + bIsUse);
            }

            if (bIsUse === true) {
                aUseModules.push(sKey);

                if (oTarget.restoreCache === undefined || oTarget.restoreCache() === false) {
                    if (bDebug) {
                        console.log('   restoreCache() : true');
                    }
                    aNoCachedModules.push(sKey);
                }
            }
        });

        if (aNoCachedModules.length > 0) {
            var sEditor = '';
            try {
                if (bEditor === true) {
                    // 에디터에서 접근했을 경우 임의의 상품 지정
                    sEditor = '&PREVIEW_SDE=1';
                }
            } catch(e) { }

            var sPathRole = '&path_role=' + CAPP_ASYNC_METHODS.EC_PATH_ROLE;

            $.ajax(
            {
                url : '/exec/front/manage/async?module=' + aNoCachedModules.join(',') + sEditor + sPathRole,
                dataType : 'json',
                success : function(aData)
                {
                	CAPP_ASYNC_METHODS.setData(aData, aUseModules);
                }
            });

        } else {
        	CAPP_ASYNC_METHODS.setData({}, aUseModules);

        }
    },
    setData : function(aData, aUseModules)
    {
        aData = aData || {};

        $(aUseModules).each(function(){
            var sKey = this;

            var oTarget = CAPP_ASYNC_METHODS[sKey];

            if (oTarget.setData !== undefined && aData.hasOwnProperty(sKey) === true) {
                oTarget.setData(aData[sKey]);
            }

            if (oTarget.execute !== undefined) {
                oTarget.execute();
            }
        });
    }
};
/**
 * 비동기식 데이터 - 최근 본 상품 - 보여줄 갯수
 */
CAPP_ASYNC_METHODS.aDatasetList.push('recentViewConfig');
CAPP_ASYNC_METHODS.recentViewConfig = {
    STORAGE_KEY: 'localRecentViewConfig' +  EC_SDE_SHOP_NUM,

    __iViewCount: null,
    __sAdult19Warning: 'F',
    __sAdult19BaseImage: null,

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.recent.isUse() === false) {
            return false;
        }

        if (window.sessionStorage === undefined) {
            return false;
        }

        return true;
    },

    restoreCache: function()
    {
        if (window.sessionStorage === undefined) {
            return false;
        }

        var sSessionStorageDataWrapedJson = window.sessionStorage.getItem(this.STORAGE_KEY);
        if (sSessionStorageDataWrapedJson === null) {
            return false;
        }
        this.__setConfigs(sSessionStorageDataWrapedJson);
        return true;
    },

    setData: function(sData)
    {
        var aData = new Array();
        aData.push('"adult19BaseTinyImage":"' + sData.adult19BaseTinyImage + '"');
        aData.push('"adult19Warning":"' + sData.adult19Warning + '"');
        aData.push('"viewCount":"' + sData.viewCount + '"');

        var sDataWrapedJson = '{' + aData.join(",") + '}'; //JSON.stringify(sData); IE7 NOT COMPATIBLE

        try {
            window.sessionStorage.setItem(this.STORAGE_KEY, sDataWrapedJson);
        } catch (error) {
        }
        this.__setConfigs(sDataWrapedJson);
    },

    getViewCount: function()
    {
        return this.__iViewCount;
    },

    getAdult19Warning: function()
    {
        return this.__sAdult19Warning;
    },

    getAdult19BaseImage: function()
    {
        return this.__sAdult19BaseImage;
    },


    __setConfigs: function(sDataJson)
    {
        var aRecentViewConfig = $.parseJSON(sDataJson);

        var sAdult19Warning = aRecentViewConfig['adult19Warning'];
        if (sAdult19Warning !== 'T') {
            sAdult19Warning = 'F'
        };
        this.__sAdult19Warning = sAdult19Warning;

        this.__sAdult19BaseImage = aRecentViewConfig['adult19BaseTinyImage'];
        this.__iViewCount = Number(aRecentViewConfig['viewCount']);

    }

};
/**
 * 비동기식 데이터 - 회원 정보
 */
CAPP_ASYNC_METHODS.aDatasetList.push('member');
CAPP_ASYNC_METHODS.member = {
    __sEncryptedString: null,
    __isAdult: 'F',

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.IS_LOGIN === true) {
            if ($('.xans-layout-statelogon, .xans-layout-logon').length > 0) {
                return true;
            }

            if (CAPP_ASYNC_METHODS.recentViewConfig.getAdult19Warning() === 'T' && CAPP_ASYNC_METHODS.recent.isUse() === true) {
                return true;
            }
        }
        return false;
    },

    setData: function(oData)
    {
        this.__sEncryptedString = oData.memberData;
        this.__isAdult = oData.memberIsAdult;
    },

    execute: function()
    {
        AuthSSLManager.weave({
            'auth_mode'          : 'decryptClient',
            'auth_string'        : this.__sEncryptedString,
            'auth_callbackName'  : 'CAPP_ASYNC_METHODS.member.setDataCallback'
       });
    },

    setDataCallback: function(output)
    {
        try {
            var output = decodeURIComponent(output);

            if ( AuthSSLManager.isError(output) == true ) {
                alert(output);
                return;
            }

            var aData = AuthSSLManager.unserialize(output);
            
            // 친구초대
            if ($('.xans-myshop-asyncbenefit').size() > 0) {
                $('#reco_url').attr({value: $('#reco_url').val() + aData['id']});
            }

            for (var k in aData) {
                $('.xans-member-var-' + k).html(aData[k]);
            }
        } catch(e) {}
    },

    getMemberIsAdult: function()
    {
        return this.__isAdult;
    }
};

/**
 * 비동기식 데이터 - 예치금
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Ordercnt');
CAPP_ASYNC_METHODS.Ordercnt = {
    __iOrderShppiedBeforeCount: null,
    __iOrderShppiedStandbyCount: null,
    __iOrderShppiedBeginCount: null,
    __iOrderShppiedComplateCount: null,
    __iOrderShppiedCancelCount: null,
    __iOrderShppiedExchangeCount: null,
    __iOrderShppiedReturnCount: null,

    __$target: $('#xans_myshop_orderstate_shppied_before_count'),
    __$target2: $('#xans_myshop_orderstate_shppied_standby_count'),
    __$target3: $('#xans_myshop_orderstate_shppied_begin_count'),
    __$target4: $('#xans_myshop_orderstate_shppied_complate_count'),
    __$target5: $('#xans_myshop_orderstate_order_cancel_count'),
    __$target6: $('#xans_myshop_orderstate_order_exchange_count'),
    __$target7: $('#xans_myshop_orderstate_order_return_count'),

    isUse: function()
    {
        if ($('.xans-myshop-orderstate').length > 0) {
            return true; 
        }

        return false;
    },

    setData: function(aData)
    {
        this.__iOrderShppiedBeforeCount = aData['shipped_before_count'];
        this.__iOrderShppiedStandbyCount = aData['shipped_standby_count'];
        this.__iOrderShppiedBeginCount = aData['shipped_begin_count'];
        this.__iOrderShppiedComplateCount = aData['shipped_complate_count'];
        this.__iOrderShppiedCancelCount = aData['order_cancel_count'];
        this.__iOrderShppiedExchangeCount = aData['order_exchange_count'];
        this.__iOrderShppiedReturnCount = aData['order_return_count'];
    },

    execute: function()
    {
        this.__$target.html(this.__iOrderShppiedBeforeCount);
        this.__$target2.html(this.__iOrderShppiedStandbyCount);
        this.__$target3.html(this.__iOrderShppiedBeginCount);
        this.__$target4.html(this.__iOrderShppiedComplateCount);
        this.__$target5.html(this.__iOrderShppiedCancelCount);
        this.__$target6.html(this.__iOrderShppiedExchangeCount);
        this.__$target7.html(this.__iOrderShppiedReturnCount);
    }
};
/**
 * 비동기식 데이터 - 장바구니 갯수
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Basketcnt');
CAPP_ASYNC_METHODS.Basketcnt = {
    __iBasketCount: null,

    __$target: $('.xans-layout-orderbasketcount span a'),
    __$target2: $('#xans_myshop_basket_cnt'),
    __$target3: CAPP_ASYNC_METHODS.$xansMyshopMain.find('.xans_myshop_main_basket_cnt'),
    __$target4: $('.EC-Layout-Basket-count'),

    isUse: function()
    {
        if (this.__$target.length > 0) {
            return true;
        }
        if (this.__$target2.length > 0) {
            return true;
        }
        if (this.__$target3.length > 0) {
            return true;
        }
        
        if (this.__$target4.length > 0) {
            return true;
        }

        return false;
    },
    restoreCache: function()
    {
        var sCookieName = 'basketcount_' + EC_SDE_SHOP_NUM;
        var re = new RegExp('(?:^| |;)' + sCookieName + '=([^;]+)');
        var aCookieValue = document.cookie.match(re);
        if (aCookieValue) {
            this.__iBasketCount = parseInt(aCookieValue[1], 10);
            return true;
        }
        
        return false;
    },
    setData: function(sData)
    {
        this.__iBasketCount = Number(sData);
    },
    execute: function()
    {
        this.__$target.html(this.__iBasketCount);

        if (SHOP.getLanguage() === 'ko_KR') {
            this.__$target2.html(this.__iBasketCount + '개');
        } else {
            this.__$target2.html(this.__iBasketCount);
        }

        this.__$target3.html(this.__iBasketCount);
        
        this.__$target4.html(this.__iBasketCount);
        
        if (this.__iBasketCount > 0 && this.__$target4.length > 0) {
        	var $oCountDisplay = $('.EC-Layout_Basket-count-display');
        	
        	if ($oCountDisplay.length > 0) {
        		$oCountDisplay.removeClass('displaynone');
        	}
        	
        }
    }
};
/**
 * 비동기식 데이터 - 장바구니 금액
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Basketprice');
CAPP_ASYNC_METHODS.Basketprice = {
    __sBasketPrice: null,

    __$target: $('#xans_myshop_basket_price'),

    isUse: function()
    {
        if (this.__$target.length > 0) {
            return true;
        }

        return false;
    },
    restoreCache: function()
    {
        var sCookieName = 'basketprice_' + EC_SDE_SHOP_NUM;
        var re = new RegExp('(?:^| |;)' + sCookieName + '=([^;]+)');
        var aCookieValue = document.cookie.match(re);
        if (aCookieValue) {
            this.__sBasketPrice = decodeURIComponent((aCookieValue[1]+ '').replace(/\+/g, '%20'));
            return true;
        }
        
        return false;
    },
    setData: function(sData)
    {
        this.__sBasketPrice = sData;
    },

    execute: function()
    {
        this.__$target.html(this.__sBasketPrice);
    }
};
/**
 * 비동기식 데이터 - 쿠폰 갯수
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Couponcnt');
CAPP_ASYNC_METHODS.Couponcnt = {
    __iCouponCount: null,

    __$target: $('.xans-layout-myshopcouponcount'),
    __$target2: $('#xans_myshop_coupon_cnt'),
    __$target3: CAPP_ASYNC_METHODS.$xansMyshopMain.find('.xans_myshop_main_coupon_cnt'),
    __$target4: $('#xans_myshop_bankbook_coupon_cnt'),

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.IS_LOGIN === true) {
            if (this.__$target.length > 0) {
                return true;
            }
            
            if (this.__$target2.length > 0) {
                return true;
            }
            
            if (this.__$target3.length > 0) {
                return true;
            }
            
            if (this.__$target4.length > 0) {
                return true;
            }            
        }

        return false;
    },
    
    restoreCache: function()
    {
        var sCookieName = 'couponcount_' + EC_SDE_SHOP_NUM;
        var re = new RegExp('(?:^| |;)' + sCookieName + '=([^;]+)');
        var aCookieValue = document.cookie.match(re);
        if (aCookieValue) {
            this.__iCouponCount = parseInt(aCookieValue[1], 10);
            return true;
        }
        
        return false;
    },
    setData: function(sData)
    {
        this.__iCouponCount = Number(sData);
    },

    execute: function()
    {
        this.__$target.html(this.__iCouponCount);

        if (SHOP.getLanguage() === 'ko_KR') {
            this.__$target2.html(this.__iCouponCount + '개');
        } else {
            this.__$target2.html(this.__iCouponCount);
        }

        this.__$target3.html(this.__iCouponCount);
        this.__$target4.html(this.__iCouponCount);
    }
};
/**
 * 비동기식 데이터 - 적립금
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Mileage');
CAPP_ASYNC_METHODS.Mileage = {
    __sMileage: null,
    __sUsedMileage: null,
    __sTotalMileage: null,
    __sUnavailMileage: null,
    __sReturnedMileage: null,

    __$target: $('#xans_myshop_mileage'),
    __$target2: $('#xans_myshop_bankbook_avail_mileage, #xans_myshop_summary_avail_mileage'),
    __$target3: $('#xans_myshop_bankbook_used_mileage, #xans_myshop_summary_used_mileage'),
    __$target4: $('#xans_myshop_bankbook_total_mileage, #xans_myshop_summary_total_mileage'),
    __$target5: $('#xans_myshop_summary_unavail_mileage'),
    __$target6: $('#xans_myshop_summary_returned_mileage'),

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.IS_LOGIN === true) {
            if (this.__$target.length > 0) {
                return true;
            }
      
            if (this.__$target2.length > 0) {
                return true;
            }
            
            if (this.__$target3.length > 0) {
                return true;
            }       
            
            if (this.__$target4.length > 0) {
                return true;
            }     
            
            if (this.__$target5.length > 0) {
                return true;
            }  
            
            if (this.__$target6.length > 0) {
                return true;
            }              
        }

        return false;
    },

    setData: function(aData)
    {
        this.__sMileage = aData['avail_mileage'];
        this.__sUsedMileage = aData['used_mileage'];
        this.__sTotalMileage = aData['total_mileage'];
        this.__sUnavailMileage = aData['unavail_mileage'];
        this.__sReturnedMileage = aData['returned_mileage'];
    },

    execute: function()
    {
        this.__$target.html(this.__sMileage);
        this.__$target2.html(this.__sMileage);
        this.__$target3.html(this.__sUsedMileage);
        this.__$target4.html(this.__sTotalMileage);
        this.__$target5.html(this.__sUnavailMileage);
        this.__$target6.html(this.__sReturnedMileage);
    }
};
/**
 * 비동기식 데이터 - 예치금
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Deposit');
CAPP_ASYNC_METHODS.Deposit = {
    __sDeposit: null,
    __sAllDeposit: null,
    __sUsedDeposit: null,
    __sRefundWaitDeposit: null,

    __$target: $('#xans_myshop_deposit'),
    __$target2: $('#xans_myshop_bankbook_deposit'),
    __$target3: $('#xans_myshop_summary_deposit'),
    __$target4: $('#xans_myshop_summary_all_deposit'),
    __$target5: $('#xans_myshop_summary_used_deposit'),
    __$target6: $('#xans_myshop_summary_refund_wait_deposit'),

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.IS_LOGIN === true) {
            if (this.__$target.length > 0) {
                return true;
            }
            
            if (this.__$target2.length > 0) {
                return true;
            }
            
            if (this.__$target3.length > 0) {
                return true;
            }  
            
            if (this.__$target4.length > 0) {
                return true;
            }  
            
            if (this.__$target5.length > 0) {
                return true;
            }  
            
            if (this.__$target6.length > 0) {
                return true;
            }  
        }

        return false;
    },

    setData: function(aData)
    {
        this.__sDeposit = aData['total_deposit'];
        this.__sAllDeposit = aData['all_deposit'];
        this.__sUsedDeposit = aData['used_deposit'];
        this.__sRefundWaitDeposit = aData['deposit_refund_wait'];
        this.__sDepositUnit = aData['deposit_unit'];
    },

    execute: function()
    {
        this.__$target.html(this.__sDeposit);
        this.__$target2.html(this.__sDeposit);
        this.__$target3.html(this.__sDeposit);
        this.__$target4.html(this.__sAllDeposit);
        this.__$target5.html(this.__sUsedDeposit);
        this.__$target6.html(this.__sRefundWaitDeposit);        
    }
};
/**
 * 비동기식 데이터 - 관심상품 갯수
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Wishcount');
CAPP_ASYNC_METHODS.Wishcount = {
    __iWishCount: null,

    __$target: $('#xans_myshop_interest_prd_cnt'),
    __$target2: CAPP_ASYNC_METHODS.$xansMyshopMain.find('.xans_myshop_main_interest_prd_cnt'),

    isUse: function()
    {
        if (this.__$target.length > 0) {
            return true;
        }
        if (this.__$target2.length > 0) {
            return true;
        }
        return false;
    },

    restoreCache: function()
    {
        var sCookieName = 'wishcount_' + EC_SDE_SHOP_NUM;
        var re = new RegExp('(?:^| |;)' + sCookieName + '=([^;]+)');
        var aCookieValue = document.cookie.match(re);
        if (aCookieValue) {
            this.__iWishCount = parseInt(aCookieValue[1], 10);
            return true;
        }

        return false;
    },

    setData: function(sData)
    {
        this.__iWishCount = Number(sData);
    },

    execute: function()
    {
        if (SHOP.getLanguage() === 'ko_KR') {
            this.__$target.html(this.__iWishCount + '개');
        } else {
            this.__$target.html(this.__iWishCount);
        }

        this.__$target2.html(this.__iWishCount);
    }
};
/**
 * 비동기식 데이터 - 최근 본 상품
 */
CAPP_ASYNC_METHODS.aDatasetList.push('recent');
CAPP_ASYNC_METHODS.recent = {
    STORAGE_KEY: 'localRecentProduct' +  EC_SDE_SHOP_NUM,

    __$target: $('.xans-layout-productrecent'),

    __aData: null,

    isUse: function()
    {
        this.__$target.hide();

        if (this.__$target.find('.xans-record-').length > 0) {
            return true;
        }

        return false;
    },

    restoreCache: function()
    {
        this.__aData = [];

        var iTotalCount = CAPP_ASYNC_METHODS.RecentTotalCount.getData();
        if (iTotalCount == 0) {
            // 총 갯수가 없는 경우 복구할 것이 없으므로 복구한 것으로 리턴
            return true;
        }

        var sAdultImage = '';

        if (window.sessionStorage === undefined) {
            return false;
        }

        var sSessionStorageData = window.sessionStorage.getItem(this.STORAGE_KEY);
        if (sSessionStorageData === null) {
            return false;
        }

        var iViewCount = CAPP_ASYNC_METHODS.recentViewConfig.getViewCount();

        this.__aData = [];
        var aStorageData = $.parseJSON(sSessionStorageData);
        var iCount = 1;
        var bDispRecent = true;
        for (var iKey in aStorageData) {
            var sProductImgSrc = aStorageData[iKey].sImgSrc;

            if (isFinite(iKey) === false) {
                continue;
            }

            var aDataTmp = [];
            aDataTmp.recent_img = getImageUrl(sProductImgSrc);
            aDataTmp.name = aStorageData[iKey].sProductName;
            aDataTmp.disp_recent = true;
            aDataTmp.is_adult_product = aStorageData[iKey].isAdultProduct;
            aDataTmp.link_product_detail = aStorageData[iKey].link_product_detail;

            //aDataTmp.param = '?product_no=' + aStorageData[iKey].iProductNo + '&cate_no=' + aStorageData[iKey].iCateNum + '&display_group=' + aStorageData[iKey].iDisplayGroup;
            aDataTmp.param = filterXssUrlParameter(aStorageData[iKey].sParam);
            if ( iViewCount < iCount ) {
                bDispRecent = false;
            }
            aDataTmp.disp_recent = bDispRecent;

            iCount++;
            this.__aData.push(aDataTmp);
        }

        return true;

        /**
         * get SessionStorage image url
         * @param sNewImgUrl DB에 저장되어 있는 tiny값
         */
        function getImageUrl(sImgUrl)
        {
            if ( typeof(sImgUrl) === 'undefined' || sImgUrl === null) {
                return;
            }
            var sNewImgUrl = '';

            if ( sImgUrl.indexOf('http://') >= 0 || sImgUrl.indexOf('https://')  >= 0 || sImgUrl.substr(0, 2) === '//') {
                sNewImgUrl = sImgUrl;
            } else {
                sNewImgUrl = '/web/product/tiny/' +  sImgUrl;
            }

            return sNewImgUrl;
        }

        /**
         * 파라미터 URL에서 XSS 공격 관련 파라미터를 필터링합니다. ECHOSTING-162977
         * @param string sParam 파라미터
         * @return string 필터링된 파라미터
         */
        function filterXssUrlParameter(sParam)
        {
            sParam = sParam || '';

            var sPrefix = '';
            if (sParam.substr(0, 1) === '?') {
                sPrefix = '?';
                sParam = sParam.substr(1);
            }

            var aParam = {};

            var aParamList = (sParam).split('&');
            $.each(aParamList, function() {
                var aMatch = this.match(/^([^=]+)=(.*)$/);
                if (aMatch) {
                    aParam[aMatch[1]] = aMatch[2];
                }
            });

            return sPrefix + $.param(aParam);
        }

    },

    setData: function(aData)
    {
        this.__aData = aData;

        // 쿠키엔 있지만 sessionStorage에 없는 데이터 복구
        if (window.sessionStorage) {

            var oNewStorageData = [];

            for ( var i = 0 ; i < aData.length ; i++) {
                if (aData[i].bNewProduct !== true) {
                    continue;
                }

                var aNewStorageData = {
                    'iProductNo': aData[i].product_no,
                    'sProductName': aData[i].name,
                    'sImgSrc': aData[i].recent_img,
                    'sParam': aData[i].param,
                    'link_product_detail': aData[i].link_product_detail
                };

                oNewStorageData.push(aNewStorageData);
            }

            if ( oNewStorageData.length > 0 ) {
                sessionStorage.setItem(this.STORAGE_KEY , $.toJSON(oNewStorageData));
            }
        }
    },

    execute: function()
    {
        var sAdult19Warning = CAPP_ASYNC_METHODS.recentViewConfig.getAdult19Warning();

        var aData = this.__aData;

        var aNodes = this.__$target.find('.xans-record-');
        var iRecordCnt = aNodes.length;
        var iAddedElementCount = 0;

        var aNodesParent = $(aNodes[0]).parent();
        for ( var i = 0 ; i < aData.length ; i++) {
            if (!aNodes[i]) {
                $(aNodes[iRecordCnt - 1]).clone().appendTo(aNodesParent);
                iAddedElementCount++;
            }
        }

        if (iAddedElementCount > 0) {
            aNodes = this.__$target.find('.xans-record-');
        }

        if (aData.length > 0) {
            this.__$target.show();
        }

        for ( var i = 0 ; i < aData.length ; i++) {
            assignVariables(aNodes[i], aData[i]);
        }

        // 종료 카운트 지정
        if (aData.length < aNodes.length) {
            iLength = aData.length;
            deleteNode();
        }

        recentBntInit(this.__$target);

        /**
         * 패치되지 않은 노드를 제거
         */
        function deleteNode()
        {
            for ( var i = iLength ; i < aNodes.length ; i++) {
                $(aNodes[i]).remove();
            }
        }

        /**
         * oTarget 엘레먼트에 aData의 변수를 어싸인합니다.
         * @param Element oTarget 변수를 어싸인할 엘레먼트
         * @param array aData 변수 데이터
         */
        function assignVariables(oTarget, aData)
        {
            var recentImage = aData.recent_img;

            if (sAdult19Warning === 'T' && CAPP_ASYNC_METHODS.member.getMemberIsAdult() === 'F' && aData.is_adult_product === 'T') {
                    recentImage = CAPP_ASYNC_METHODS.recentViewConfig.getAdult19BaseImage();
            };

            var $oTarget = $(oTarget);

            var sHtml = $oTarget.html();

            sHtml = sHtml.replace('about:blank', recentImage)
                         .replace('##param##', aData.param)
                         .replace('##name##',aData.name)
                         .replace('##link_product_detail##', aData.link_product_detail);
            $oTarget.html(sHtml);

            if (aData.disp_recent === true) {
                $oTarget.removeClass('displaynone');
            }
        }

        function recentBntInit($target)
        {
            // 화면에 뿌려진 갯수
            var iDisplayCount = 0;
            // 보여지는 style
            var sDisplay = '';
            var iIdx = 0;
            //
            var iDisplayNoneIdx = 0;

            var nodes = $target.find('.xans-record-').each(function()
            {
                sDisplay = $(this).css('display');
                if (sDisplay != 'none') {
                    iDisplayCount++;
                } else {
                    if (iDisplayNoneIdx == 0) {
                        iDisplayNoneIdx = iIdx;
                    }

                }
                iIdx++;
            });

            var iRecentCount = nodes.length;
            var bBtnActive = iDisplayCount > 0;
            $('.xans-layout-productrecent .prev').unbind('click').click(function()
            {
                if (bBtnActive !== true) return;
                var iFirstNode = iDisplayNoneIdx - iDisplayCount;
                if (iFirstNode == 0 || iDisplayCount == iRecentCount) {
                    alert(__('최근 본 첫번째 상품입니다.'));
                    return;
                } else {
                    iDisplayNoneIdx--;
                    $(nodes[iDisplayNoneIdx]).hide();
                    $(nodes[iFirstNode - 1]).removeClass('displaynone');
                    $(nodes[iFirstNode - 1]).fadeIn('fast');

                }
            }).css(
            {
                cursor : 'pointer'
            });

            $('.xans-layout-productrecent .next').unbind('click').click(function()
            {
                if (bBtnActive !== true) return;
                if ( (iRecentCount ) == iDisplayNoneIdx || iDisplayCount == iRecentCount) {
                    alert(__('최근 본 마지막 상품입니다.'));
                } else {
                    $(nodes[iDisplayNoneIdx]).fadeIn('fast');
                    $(nodes[iDisplayNoneIdx]).removeClass('displaynone');
                    $(nodes[ (iDisplayNoneIdx - iDisplayCount)]).hide();
                    iDisplayNoneIdx++;
                }
            }).css(
            {
                cursor : 'pointer'
            });

        }

    }
};

/**
 * 비동기식 데이터 - 최근본상품 총 갯수
 */
CAPP_ASYNC_METHODS.aDatasetList.push('RecentTotalCount');
CAPP_ASYNC_METHODS.RecentTotalCount = {
    __iRecentCount: null,

    __$target: CAPP_ASYNC_METHODS.$xansMyshopMain.find('.xans_myshop_main_recent_cnt'),

    isUse: function()
    {
        if (this.__$target.length > 0) {
            return true;
        }

        return false;
    },

    restoreCache: function()
    {
        var sCookieName = 'recent_plist';
        if (EC_SDE_SHOP_NUM > 1) {
            sCookieName = 'recent_plist' + EC_SDE_SHOP_NUM;
        }
        var re = new RegExp('(?:^| |;)' + sCookieName + '=([^;]+)');
        var aCookieValue = document.cookie.match(re);
        if (aCookieValue) {
            this.__iRecentCount = decodeURI(aCookieValue[1]).split('|').length;
        } else {
            this.__iRecentCount = 0;
        }
    },

    execute: function()
    {
        this.__$target.html(this.__iRecentCount);
    },

    getData: function()
    {
        if (this.__iRecentCount === null) {
            // this.isUse값이 false라서 복구되지 않았는데 이 값이 필요한 경우 복구
            this.restoreCache();
        }

        return this.__iRecentCount;
    }
};
/**
 * 비동기식 데이터 - 주문정보
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Order');
CAPP_ASYNC_METHODS.Order = {
    __iOrderCount: null,
    __iOrderTotalPrice: null,
    __iGradeIncreaseValue: null,

    __$target: $('#xans_myshop_bankbook_order_count'),
    __$target2: $('#xans_myshop_bankbook_order_price'),
    __$target3: $('#xans_myshop_bankbook_grade_increase_value'),

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.IS_LOGIN === true) {        
            if (this.__$target.length > 0) {
                return true;
            }
            
            if (this.__$target2.length > 0) {
                return true;
            }
            
            if (this.__$target3.length > 0) {
                return true;
            }            
        }
        
        return false;        
    },

    setData: function(aData)
    {
        this.__iOrderCount = aData['total_order_count'];
        this.__iOrderTotalPrice = aData['total_order_price'];
        this.__iGradeIncreaseValue = Number(aData['grade_increase_value']);
    },

    execute: function()
    {
        this.__$target.html(this.__iOrderCount);
        this.__$target2.html(this.__iOrderTotalPrice);
        this.__$target3.html(this.__iGradeIncreaseValue);
    }
};
/**
 * 비동기식 데이터 - Benefit
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Benefit');
CAPP_ASYNC_METHODS.Benefit = {
    __aBenefit: null,
    __$target: $('.xans-myshop-asyncbenefit'),

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.IS_LOGIN === true) {
            if (this.__$target.length > 0) {
                return true;
            }
        }

        return false;
    },

    setData: function(aData)
    {
        this.__aBenefit = aData;
    },

    execute: function()
    {
        var aFilter = ['group_image_tag', 'group_icon_tag', 'display_no_benefit', 'display_with_all', 'display_mobile_use_dc', 'display_mobile_use_mileage'];
        var __aData = this.__aBenefit;
        
        // 그룹이미지
        $('.myshop_benefit_group_image_tag').attr({alt: __aData['group_name'], src: __aData['group_image']});

        // 그룹아이콘
        $('.myshop_benefit_group_icon_tag').attr({alt: __aData['group_name'], src: __aData['group_icon']});

        if (__aData['display_no_benefit'] === true) {
            $('.myshop_benefit_display_no_benefit').removeClass('displaynone').show();
        }
        
        if (__aData['display_with_all'] === true) {
            $('.myshop_benefit_display_with_all').removeClass('displaynone').show();
        }
        
        if (__aData['display_mobile_use_dc'] === true) {
            $('.myshop_benefit_display_mobile_use_dc').removeClass('displaynone').show();
        } 
        
        if (__aData['display_mobile_use_mileage'] === true) {
            $('.myshop_benefit_display_mobile_use_mileage').removeClass('displaynone').show();
        }

        $.each(__aData, function(key, val) {
            if ($.inArray(key, aFilter) === -1) {
                $('.myshop_benefit_' + key).html(val);
            }
        });
    }    
};
/**
 * 비동기식 데이터 - 비동기장바구니 레이어
 */
CAPP_ASYNC_METHODS.aDatasetList.push('BasketLayer');
CAPP_ASYNC_METHODS.BasketLayer = {
    __sBasketLayerHtml: null,
    __$target: $('#ec_async_basket_layer_container'),

    isUse: function()
    {
        if (this.__$target.length > 0) {
            return true;
        }
        return false;
    },

    execute: function()
    {
        $.ajax({
            url: '/order/async_basket_layer.html?__popupPage=T',
            async: false,
            success: function(data) {
                var sBasketLayerHtml = data;
                var sBasketLayerStyle = '';
                var sBasketLayerBody = '';

                sBasketLayerHtml = sBasketLayerHtml.replace(/<script([\s\S]*?)<\/script>/gi,''); // 스크립트 제거
                sBasketLayerHtml = sBasketLayerHtml.replace(/<link([\s\S]*?)\/>/gi,''); // 옵티마이져 제거

                var regexStyle = /<style([\s\S]*?)<\/style>/; // Style 추출
                if (regexStyle.exec(sBasketLayerHtml) != null) sBasketLayerStyle = regexStyle.exec(sBasketLayerHtml)[0];

                var regexBody = /<body[\s\S]*?>([\s\S]*?)<\/body>/; // Body 추출
                if (regexBody.exec(sBasketLayerHtml) != null) sBasketLayerBody = regexBody.exec(sBasketLayerHtml)[1];

                CAPP_ASYNC_METHODS.BasketLayer.__sBasketLayerHtml = sBasketLayerStyle + sBasketLayerBody;
            }
        });
        this.__$target.html(this.__sBasketLayerHtml);
    }
};
/**
 * 비동기식 데이터 - Benefit
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Grade');
CAPP_ASYNC_METHODS.Grade = {
    __aGrade: null,
    __$target: $('.xans-myshop-asyncbenefit'),

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.IS_LOGIN === true) {
            if (this.__$target.length > 0) {
                return true;
            }
        }

        return false;
    },

    setData: function(aData)
    {
        this.__aGrade = aData;
    },

    execute: function()
    {
        var __aData = this.__aGrade;
        var aFilter = ['bChangeMaxTypePrice', 'bChangeMaxTypePriceAndCount', 'bChangeMaxTypePriceOrCount', 'bChangeMaxTypeCount'];

        var aMaxDisplayJson = {
            "bChangeMaxTypePrice": [
                {"sId": "sChangeMaxTypePriceArea"}
            ],
            "bChangeMaxTypePriceAndCount": [
                {"sId": "sChangeMaxTypePriceAndCountArea"}
            ],
            "bChangeMaxTypePriceOrCount": [
                {"sId": "sChangeMaxTypePriceOrCountArea"}
            ],
            "bChangeMaxTypeCount": [
                {"sId": "sChangeMaxTypeCountArea"}
            ]
        };

        if ($('.sNextGroupIconArea').length > 0) {
            if (__aData['bDisplayNextGroupIcon'] === true) {
                $('.sNextGroupIconArea').removeClass('displaynone').show();
                $('.myshop_benefit_next_group_icon_tag').attr({alt: __aData['sNextGrade'], src: __aData['sNextGroupIcon']});
            } else {
                $('.sNextGroupIconArea').addClass('displaynone');
            }
        }

        var sIsAutoGradeDisplay = "F";
        $.each(__aData, function(key, val) {
            if ($.inArray(key, aFilter) === -1) {
                return true;
            }
            if (val === true) {
                if ($('#'+aMaxDisplayJson[key][0].sId).length > 0) {
                    $('#' + aMaxDisplayJson[key][0].sId).removeClass('displaynone').show();
                }
                sIsAutoGradeDisplay = "T";
            }
        });
        if (sIsAutoGradeDisplay == "T" && $('#sGradeAutoDisplayArea .sAutoGradeDisplay').length > 0) {
            $('#sGradeAutoDisplayArea .sAutoGradeDisplay').addClass('displaynone');
        }

        $.each(__aData, function(key, val) {
            if ($.inArray(key, aFilter) === -1) {
                if ($('.xans-member-var-' + key).length > 0) {
                    $('.xans-member-var-' + key).html(val);
                }
            }
        });
    }    
};
/**
 * 비동기식 데이터 - 비동기장바구니 레이어
 */
CAPP_ASYNC_METHODS.aDatasetList.push('MobileMutiPopup');
CAPP_ASYNC_METHODS.MobileMutiPopup = {
    __$target: $('div[class^="ec-async-multi-popup-layer-container"]'),

    isUse: function()
    {
        if (this.__$target.length > 0) {
            return true;
        }
        return false;
    },

    execute: function()
    {
        for (var i=0; i < this.__$target.length ; i++) {
            $.ajax({
                url: '/exec/front/popup/AjaxMultiPopup?index='+i,
                data : EC_ASYNC_MULTI_POPUP_OPTION[i],
                dataType: "json",
                success : function (oResult) {
                    switch (oResult.code) {
                        case '0000' :
                            if (oResult.data.length < 1) {
                                break;
                            }
                            $('.ec-async-multi-popup-layer-container-' + oResult.data.html_index).html(oResult.data.html_text);
                            if (oResult.data.type == 'P') {
                                BANNER_POPUP_OPEN.setPopupSetting();
                                BANNER_POPUP_OPEN.setPopupWidth();
                                BANNER_POPUP_OPEN.setPopupClose();
                            } else {
                                /**
                                 * 이중 스크롤 방지 클래스 추가(비동기) 
                                 *
                                 */
                                $('body').addClass('eMobilePopup');
                                $('body').width('100%');

                                BANNER_POPUP_OPEN.setFullPopupSetting();
                                BANNER_POPUP_OPEN.setFullPopupClose();
                            }
                            break;
                        default :
                            break;
                    }
                },
                error : function () {
                }
            });
        }
    }
};
/**
 * 비동기식 데이터 - 좋아요 상품 갯수
 */
CAPP_ASYNC_METHODS.aDatasetList.push('MyLikeProductCount');
CAPP_ASYNC_METHODS.MyLikeProductCount = {
    __iMyLikeCount: null,

    __$target: $('#xans_myshop_like_prd_cnt'),

    isUse: function()
    {
        if (this.__$target.length > 0 && SHOP.getLanguage() === 'ko_KR') {
            return true;
        }

        return false;
    },

    setData: function(sData)
    {
        this.__iMyLikeCount = Number(sData);
    },

    execute: function()
    {
        if (SHOP.getLanguage() === 'ko_KR') {
            this.__$target.html(this.__iMyLikeCount + '개');
        }
    }
};
/**
 * 라이브 링콘 on/off이미지
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Livelinkon');
CAPP_ASYNC_METHODS.Livelinkon = {
    __$target: $('#ec_livelinkon_campain_on'),
    __$target2: $('#ec_livelinkon_campain_off'),

    isUse: function()
    {
        if (this.__$target.length > 0 && this.__$target2.length > 0) {
            return true;
        }
        return false;
    },

    execute: function()
    {
        var sCampaignid = '';
        if (EC_ASYNC_LIVELINKON_ID != undefined) {
            sCampaignid = EC_ASYNC_LIVELINKON_ID
        }
        $.ajax({
            url: '/exec/front/Livelinkon/Campaignajax?campaign_id='+sCampaignid,
            async: false,
            success: function(data) {
                if (data == 'on') {
                    CAPP_ASYNC_METHODS.Livelinkon.__$target.removeClass('displaynone').show();
                    CAPP_ASYNC_METHODS.Livelinkon.__$target2.removeClass('displaynone').hide();
                } else if (data == 'off') {
                    CAPP_ASYNC_METHODS.Livelinkon.__$target.removeClass('displaynone').hide();
                    CAPP_ASYNC_METHODS.Livelinkon.__$target2.removeClass('displaynone').show();
                } else {
                    CAPP_ASYNC_METHODS.Livelinkon.__$target.removeClass('displaynone').hide();
                    CAPP_ASYNC_METHODS.Livelinkon.__$target2.removeClass('displaynone').hide();
                }
            }
        });
    }
};
/**
 * 비동기식 데이터 - 마이쇼핑 > 주문 카운트 (주문 건수 / CS건수 / 예전주문)
 */
CAPP_ASYNC_METHODS.aDatasetList.push('OrderHistoryCount');
CAPP_ASYNC_METHODS.OrderHistoryCount = {
    __sTotalOrder: null,
    __sTotalOrderCs: null,
    __sTotalOrderOld: null,

    __$target: $('#ec_myshop_total_orders'),
    __$target2: $('#ec_myshop_total_orders_cs'),
    __$target3: $('#ec_myshop_total_orders_old'),

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.IS_LOGIN === true) {
            if (this.__$target.length > 0) {
                return true;
            }

            if (this.__$target2.length > 0) {
                return true;
            }

            if (this.__$target3.length > 0) {
                return true;
            }
        }

        return false;
    },

    setData: function(aData)
    {
        this.__sTotalOrder = aData['total_orders'];
        this.__sTotalOrderCs = aData['total_orders_cs'];
        this.__sTotalOrderOld = aData['total_orders_old'];

    },

    execute: function()
    {
        this.__$target.html(this.__sTotalOrder);
        this.__$target2.html(this.__sTotalOrderCs);
        this.__$target3.html(this.__sTotalOrderOld);
    }
};
$(document).ready(function()
{
	CAPP_ASYNC_METHODS.init();
});
// 썸네일 이미지 엑박일경우 기본값 설정
$(window).load(function() {
    $(".thumbnail img, img.thumbImage, img.bigImage").each(function($i,$item){
        var $img = new Image();
        $img.onerror = function () {
            $item.src="//img.echosting.cafe24.com/thumb/img_product_big.gif";
        }
        $img.src = this.src;
    });
});

$(document).ready(function(){
    // 토글
    $('div.eToggle .title').click(function(){
        var toggle = $(this).parent('.eToggle');
        if(toggle.hasClass('disable') == false){
            $(this).parent('.eToggle').toggleClass('selected')
        }
    });

    $('dl.eToggle dt').click(function(){
        $(this).toggleClass('selected');
        $(this).next('dd').toggleClass('selected');
    });

    //장바구니 페이지 수량폼 Type 변경
    $('[id^="quantity"]').each(function() {
        $(this).get(0).type = 'tel';
    });

    // 모바일에서 공급사 테이블 th 강제조절
    $('.xans-mall-supplyinfo, .supplyInfo').find('table > colgroup').find('col').eq(0).width(98);
    $('.xans-mall-supplyinfo, .supplyInfo').find('th, td').css({padding:'13px 10px 12px'});

    /**
     *  메인카테고리 toggle
     */
    $('.xans-product-listmain h2').toggle(function(){
        $(this).css('background-image', 'url("//img.echosting.cafe24.com/skin/mobile_ko_KR/layout/bg_title_open.gif")');
        $(this).siblings().hide();
        $(this).parent().find('div.paginate').hide();
        $(this).parent().next('div.xans-product-listmore').hide();
    }, function() {
        $(this).css('background-image', 'url("//img.echosting.cafe24.com/skin/mobile_ko_KR/layout/bg_title_close.gif")');
        $(this).siblings().show();
        $(this).parent().find('div.paginate').show();
        $(this).parent().next('div.xans-product-listmore').show();
    });

    /**
     *  상단탑버튼
     */
    var globalTopBtnScrollFunc = function() {
        // 탑버튼 관련변수
        var $btnTop = $('#btnTop');

        $(window).scroll(function() {
            try {
                var iCurScrollPos = $(this).scrollTop();

                if (iCurScrollPos > ($(this).height() / 2)) {
                    $btnTop.fadeIn('fast');
                } else {
                    $btnTop.fadeOut('fast');
                }
            } catch(e) { }
        });
    };

    /**
     *  구매버튼
     */
    var globalBuyBtnScrollFunc = function() {
        // 구매버튼 관련변수
        var sFixId = $('#orderFixItem').size() > 0  ? 'orderFixItem' : 'fixedActionButton',
            $area = $('#orderFixArea'),
            $item = $('#' + sFixId + '').not($area);

        $(window).scroll(function(){
            try {
                 // 구매버튼 관련변수
                var iCurrentHeightPos = $(this).scrollTop() + $(this).height(),
                    iButtonHeightPos = $item.offset().top;

                if (iCurrentHeightPos > iButtonHeightPos || iButtonHeightPos < $(this).scrollTop() + $item.height()) {
                    if (iButtonHeightPos < $(this).scrollTop() - $item.height()) {
                        $area.fadeIn('fast');
                    } else {
                        $area.hide();
                    }
                } else {
                    $area.fadeIn('fast');
                }
            } catch(e) { }
        });
    };

    globalTopBtnScrollFunc();
    globalBuyBtnScrollFunc();
});

// 공통레이어팝업 오픈
var globalLayerOpenFunc = function(_this) {
    this.id = $(_this).data('id');
    this.param = $(_this).data('param');
    this.basketType = $('#basket_type').val();
    this.url = $(_this).data('url');
    this.layerId = 'ec_temp_mobile_layer';
    this.layerIframeId = 'ec_temp_mobile_iframe_layer';

    var _this = this;

    function paramSetUrl() {
        if (this.param) {
            // if isset param
        } else {
            this.url = this.basketType ?  this.url + '?basket_type=' + this.basketType : this.url;
        }
    };

    if (this.url) {
        window.ecScrollTop = $(window).scrollTop();
        $.ajax({
            url : this.url,
            success : function (data) {
                if (data.indexOf('404 페이지 없음') == -1) {
                    // 있다면 삭제
                    try { $(_this).remove(); } catch ( e ) { }

                    var $layer = $('<div>', {
                        html: $("<iframe>", { src: _this.url, id: _this.layerIframeId, scrolling: 'auto', css: { width: '100%', height: '100%', overflowY: 'auto', border: 0 } } ),
                        id: _this.layerId,
                        css : { position: 'absolute', top: 0, left:0, width: '100%', height: $(window).height(), 'z-index': 9999 }
                    });

                    $('body').append($layer);
                    $('html, body').css({'overflowY': 'hidden', height: '100%', width: '100%'});
                    $('#' + this.layerId).show();
                }
            }
        });
    }
};

// 공통레이어팝업 닫기
var globalLayerCloseFunc = function() {
    this.layerId = 'ec_temp_mobile_layer';

    if (window.parent === window)
        self.clse();
    else {
        parent.$('html, body').css({'overflowY': 'auto', height: 'auto', width: '100%'});
        parent.$('html, body').scrollTop(parent.window.ecScrollTop);
        parent.$('#' + this.layerId).remove();
    }
};

/**
 * document.location.href split
 * return array Param
 */
var getQueryString = function(sKey)
{
    var sQueryString = document.location.search.substring(1);
    var aParam = {};

    if (sQueryString) {
        var aFields = sQueryString.split("&");
        var aField  = [];
        for (var i=0; i<aFields.length; i++) {
            aField = aFields[i].split('=');
            aParam[aField[0]] = aField[1];
        }
    }

    aParam.page = aParam.page ? aParam.page : 1;
    return sKey ? aParam[sKey] : aParam;
};

// PC버전 바로 가기
var isPCver = function() {
    var sUrl = window.location.hostname;
    var aTemp = sUrl.split(".");

    var pattern = /^(mobile[\-]{2}shop[0-9]+)$/;

    if (aTemp[0] == 'm' || aTemp[0] == 'skin-mobile' || aTemp[0] == 'mobile') {
        sUrl = sUrl.replace(aTemp[0]+'.', '');
    } else if (pattern.test(aTemp[0]) === true) {
        var aExplode = aTemp[0].split('--');
        aTemp[0] = aExplode[1];
        sUrl = aTemp.join('.');
    }
    window.location.href = '//'+sUrl+'/?is_pcver=T';
};
