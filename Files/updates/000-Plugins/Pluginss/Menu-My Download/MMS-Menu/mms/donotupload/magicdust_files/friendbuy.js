/*build-2014-07-29T09:30:04.661325*/(function(h,m,U,ra){function O(a){return ca("",{"":a})}function ca(a,b){var c,d,e=v,f,g=b[a];switch(typeof g){case "string":return sa(g);case "number":return isFinite(g)?String(g):"null";case "boolean":case "null":return String(g);case "object":if(!g)return"null";v+=Ja;f=[];if("[object Array]"===Object.prototype.toString.apply(g)){d=g.length;for(c=0;c<d;c+=1)f[c]=ca(c,g)||"null";d=0===f.length?"[]":v?"[\n"+v+f.join(",\n"+v)+"\n"+e+"]":"["+f.join(",")+"]";v=e;return d}for(c in g)Object.prototype.hasOwnProperty.call(g,
c)&&(d=ca(c,g))&&f.push(sa(c)+(v?": ":":")+d);d=0===f.length?"{}":v?"{\n"+v+f.join(",\n"+v)+"\n"+e+"}":"{"+f.join(",")+"}";v=e;return d}}function sa(a){da.lastIndex=0;return da.test(a)?'"'+a.replace(da,function(a){var c=Ka[a];return"string"===typeof c?c:"\\u"+("0000"+a.charCodeAt(0).toString(16)).slice(-4)})+'"':'"'+a+'"'}var ea=window,r=function(a,b,c,d){var e,f,g,k,n;(b?b.ownerDocument||b:x)!==t&&D(b);b=b||t;c=c||[];if(!a||"string"!==typeof a)return c;if(1!==(k=b.nodeType)&&9!==k)return[];if(B&&
!d){if(e=La.exec(a))if(g=e[1])if(9===k)if((f=b.getElementById(g))&&f.parentNode){if(f.id===g)return c.push(f),c}else return c;else{if(b.ownerDocument&&(f=b.ownerDocument.getElementById(g))&&P(b,f)&&f.id===g)return c.push(f),c}else{if(e[2])return E.apply(c,b.getElementsByTagName(a)),c;if((g=e[3])&&p.getElementsByClassName&&b.getElementsByClassName)return E.apply(c,b.getElementsByClassName(g)),c}if(p.qsa&&(!u||!u.test(a))){f=e=q;g=b;n=9===k&&a;if(1===k&&"object"!==b.nodeName.toLowerCase()){k=Q(a);(e=
b.getAttribute("id"))?f=e.replace(Ma,"\\$&"):b.setAttribute("id",f);f="[id='"+f+"'] ";for(g=k.length;g--;)k[g]=f+V(k[g]);g=fa.test(a)&&ga(b.parentNode)||b;n=k.join(",")}if(n)try{return E.apply(c,g.querySelectorAll(n)),c}catch(R){}finally{e||b.removeAttribute("id")}}}return ta(a.replace(W,"$1"),b,c,d)},w=function(){function a(c,d){b.push(c+" ")>l.cacheLength&&delete a[b.shift()];return a[c+" "]=d}var b=[];return a},y=function(a){a[q]=!0;return a},z=function(a){var b=t.createElement("div");try{return!!a(b)}catch(c){return!1}finally{b.parentNode&&
b.parentNode.removeChild(b)}},S=function(a,b){for(var c=a.split("|"),d=a.length;d--;)l.attrHandle[c[d]]=b},va=function(a,b){var c=b&&a,d=c&&1===a.nodeType&&1===b.nodeType&&(~b.sourceIndex||ua)-(~a.sourceIndex||ua);if(d)return d;if(c)for(;c=c.nextSibling;)if(c===b)return-1;return a?1:-1},Na=function(a){return function(b){return"input"===b.nodeName.toLowerCase()&&b.type===a}},Oa=function(a){return function(b){var c=b.nodeName.toLowerCase();return("input"===c||"button"===c)&&b.type===a}},I=function(a){return y(function(b){b=
+b;return y(function(c,d){for(var e,f=a([],c.length,b),g=f.length;g--;)if(c[e=f[g]])c[e]=!(d[e]=c[e])})})},ga=function(a){return a&&typeof a.getElementsByTagName!==L&&a},wa=function(){},V=function(a){for(var b=0,c=a.length,d="";b<c;b++)d+=a[b].value;return d},ha=function(a,b,c){var d=b.dir,e=c&&"parentNode"===d,f=Pa++;return b.first?function(c,b,f){for(;c=c[d];)if(1===c.nodeType||e)return a(c,b,f)}:function(c,b,n){var R,l,h=[A,f];if(n)for(;c=c[d];){if((1===c.nodeType||e)&&a(c,b,n))return!0}else for(;c=
c[d];)if(1===c.nodeType||e){l=c[q]||(c[q]={});if((R=l[d])&&R[0]===A&&R[1]===f)return h[2]=R[2];l[d]=h;if(h[2]=a(c,b,n))return!0}}},ia=function(a){return 1<a.length?function(b,c,d){for(var e=a.length;e--;)if(!a[e](b,c,d))return!1;return!0}:a[0]},X=function(a,b,c,d,e){for(var f,g=[],k=0,n=a.length,l=null!=b;k<n;k++)if(f=a[k])if(!c||c(f,d,e))g.push(f),l&&b.push(k);return g},ja=function(a,b,c,d,e,f){d&&!d[q]&&(d=ja(d));e&&!e[q]&&(e=ja(e,f));return y(function(f,k,n,l){var h,m,xa=[],ka=[],p=k.length,j;
if(!(j=f)){j=b||"*";for(var s=n.nodeType?[n]:n,q=[],t=0,u=s.length;t<u;t++)r(j,s[t],q);j=q}j=a&&(f||!b)?X(j,xa,a,n,l):j;s=c?e||(f?a:p||d)?[]:k:j;c&&c(j,s,n,l);if(d){h=X(s,ka);d(h,[],n,l);for(n=h.length;n--;)if(m=h[n])s[ka[n]]=!(j[ka[n]]=m)}if(f){if(e||a){if(e){h=[];for(n=s.length;n--;)if(m=s[n])h.push(j[n]=m);e(null,s=[],h,l)}for(n=s.length;n--;)if((m=s[n])&&-1<(h=e?J.call(f,m):xa[n]))f[h]=!(k[h]=m)}}else s=X(s===k?s.splice(p,s.length):s),e?e(null,k,s,l):E.apply(k,s)})},la=function(a){var b,c,d,e=
a.length,f=l.relative[a[0].type];c=f||l.relative[" "];for(var g=f?1:0,k=ha(function(a){return a===b},c,!0),n=ha(function(a){return-1<J.call(b,a)},c,!0),h=[function(a,c,d){return!f&&(d||c!==Y)||((b=c).nodeType?k(a,c,d):n(a,c,d))}];g<e;g++)if(c=l.relative[a[g].type])h=[ha(ia(h),c)];else{c=l.filter[a[g].type].apply(null,a[g].matches);if(c[q]){for(d=++g;d<e&&!l.relative[a[d].type];d++);return ja(1<g&&ia(h),1<g&&V(a.slice(0,g-1).concat({value:" "===a[g-2].type?"*":""})).replace(W,"$1"),c,g<d&&la(a.slice(g,
d)),d<e&&la(a=a.slice(d)),d<e&&V(a))}h.push(c)}return ia(h)},M,p,l,Z,ya,Q,ma,ta,Y,F,N,D,t,C,B,u,K,$,P,q="sizzle"+-new Date,x=ea.document,A=0,Pa=0,za=w(),Aa=w(),Ba=w(),na=function(a,b){a===b&&(N=!0);return 0},L="undefined",ua=-2147483648,Qa={}.hasOwnProperty,w=[],Ra=w.pop,Sa=w.push,E=w.push,Ca=w.slice,J=w.indexOf||function(a){for(var b=0,c=this.length;b<c;b++)if(this[b]===a)return b;return-1},Da="(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+".replace("w","w#"),Ea="\\[[\\x20\\t\\r\\n\\f]*((?:\\\\.|[\\w-]|[^\\x00-\\xa0])+)(?:[\\x20\\t\\r\\n\\f]*([*^$|!~]?=)[\\x20\\t\\r\\n\\f]*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|("+
Da+"))|)[\\x20\\t\\r\\n\\f]*\\]",oa=":((?:\\\\.|[\\w-]|[^\\x00-\\xa0])+)(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|"+Ea+")*)|.*)\\)|)",W=RegExp("^[\\x20\\t\\r\\n\\f]+|((?:^|[^\\\\])(?:\\\\.)*)[\\x20\\t\\r\\n\\f]+$","g"),Ta=/^[\x20\t\r\n\f]*,[\x20\t\r\n\f]*/,Ua=/^[\x20\t\r\n\f]*([>+~]|[\x20\t\r\n\f])[\x20\t\r\n\f]*/,Va=RegExp("=[\\x20\\t\\r\\n\\f]*([^\\]'\"]*?)[\\x20\\t\\r\\n\\f]*\\]","g"),Wa=RegExp(oa),Xa=RegExp("^"+Da+"$"),aa={ID:/^#((?:\\.|[\w-]|[^\x00-\xa0])+)/,
CLASS:/^\.((?:\\.|[\w-]|[^\x00-\xa0])+)/,TAG:RegExp("^("+"(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+".replace("w","w*")+")"),ATTR:RegExp("^"+Ea),PSEUDO:RegExp("^"+oa),CHILD:RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\([\\x20\\t\\r\\n\\f]*(even|odd|(([+-]|)(\\d*)n|)[\\x20\\t\\r\\n\\f]*(?:([+-]|)[\\x20\\t\\r\\n\\f]*(\\d+)|))[\\x20\\t\\r\\n\\f]*\\)|)","i"),bool:RegExp("^(?:checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped)$",
"i"),needsContext:RegExp("^[\\x20\\t\\r\\n\\f]*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\([\\x20\\t\\r\\n\\f]*((?:-\\d)?\\d*)[\\x20\\t\\r\\n\\f]*\\)|)(?=[^-]|$)","i")},Ya=/^(?:input|select|textarea|button)$/i,Za=/^h\d$/i,T=/^[^{]+\{\s*\[native \w/,La=/^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,fa=/[+~]/,Ma=/'|\\/g,G=RegExp("\\\\([\\da-f]{1,6}[\\x20\\t\\r\\n\\f]?|([\\x20\\t\\r\\n\\f])|.)","ig"),H=function(a,b,c){a="0x"+b-65536;return a!==a||c?b:0>a?String.fromCharCode(a+65536):String.fromCharCode(a>>10|
55296,a&1023|56320)};try{E.apply(w=Ca.call(x.childNodes),x.childNodes),w[x.childNodes.length].nodeType}catch($a){E={apply:w.length?function(a,b){Sa.apply(a,Ca.call(b))}:function(a,b){for(var c=a.length,d=0;a[c++]=b[d++];);a.length=c-1}}}p=r.support={};ya=r.isXML=function(a){return(a=a&&(a.ownerDocument||a).documentElement)?"HTML"!==a.nodeName:!1};D=r.setDocument=function(a){var b=a?a.ownerDocument||a:x;a=b.defaultView;if(b===t||9!==b.nodeType||!b.documentElement)return t;t=b;C=b.documentElement;B=
!ya(b);a&&a!==a.top&&(a.addEventListener?a.addEventListener("unload",function(){D()},!1):a.attachEvent&&a.attachEvent("onunload",function(){D()}));p.attributes=z(function(a){a.className="i";return!a.getAttribute("className")});p.getElementsByTagName=z(function(a){a.appendChild(b.createComment(""));return!a.getElementsByTagName("*").length});p.getElementsByClassName=T.test(b.getElementsByClassName)&&z(function(a){a.innerHTML="<div class='a'></div><div class='a i'></div>";a.firstChild.className="i";
return 2===a.getElementsByClassName("i").length});p.getById=z(function(a){C.appendChild(a).id=q;return!b.getElementsByName||!b.getElementsByName(q).length});p.getById?(l.find.ID=function(a,b){if(typeof b.getElementById!==L&&B){var e=b.getElementById(a);return e&&e.parentNode?[e]:[]}},l.filter.ID=function(a){var b=a.replace(G,H);return function(a){return a.getAttribute("id")===b}}):(delete l.find.ID,l.filter.ID=function(a){var b=a.replace(G,H);return function(a){return(a=typeof a.getAttributeNode!==
L&&a.getAttributeNode("id"))&&a.value===b}});l.find.TAG=p.getElementsByTagName?function(a,b){if(typeof b.getElementsByTagName!==L)return b.getElementsByTagName(a)}:function(a,b){var e,f=[],g=0,k=b.getElementsByTagName(a);if("*"===a){for(;e=k[g++];)1===e.nodeType&&f.push(e);return f}return k};l.find.CLASS=p.getElementsByClassName&&function(a,b){if(typeof b.getElementsByClassName!==L&&B)return b.getElementsByClassName(a)};K=[];u=[];if(p.qsa=T.test(b.querySelectorAll))z(function(a){a.innerHTML="<select msallowclip=''><option selected=''></option></select>";
a.querySelectorAll("[msallowclip^='']").length&&u.push("[*^$]=[\\x20\\t\\r\\n\\f]*(?:''|\"\")");a.querySelectorAll("[selected]").length||u.push("\\[[\\x20\\t\\r\\n\\f]*(?:value|checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped)");a.querySelectorAll(":checked").length||u.push(":checked")}),z(function(a){var d=b.createElement("input");d.setAttribute("type","hidden");a.appendChild(d).setAttribute("name","D");a.querySelectorAll("[name=d]").length&&
u.push("name[\\x20\\t\\r\\n\\f]*[*^$|!~]?=");a.querySelectorAll(":enabled").length||u.push(":enabled",":disabled");a.querySelectorAll("*,:x");u.push(",.*:")});(p.matchesSelector=T.test($=C.matches||C.webkitMatchesSelector||C.mozMatchesSelector||C.oMatchesSelector||C.msMatchesSelector))&&z(function(a){p.disconnectedMatch=$.call(a,"div");$.call(a,"[s!='']:x");K.push("!=",oa)});u=u.length&&RegExp(u.join("|"));K=K.length&&RegExp(K.join("|"));P=(a=T.test(C.compareDocumentPosition))||T.test(C.contains)?
function(a,b){var e=9===a.nodeType?a.documentElement:a,f=b&&b.parentNode;return a===f||!(!f||!(1===f.nodeType&&(e.contains?e.contains(f):a.compareDocumentPosition&&a.compareDocumentPosition(f)&16)))}:function(a,b){if(b)for(;b=b.parentNode;)if(b===a)return!0;return!1};na=a?function(a,d){if(a===d)return N=!0,0;var e=!a.compareDocumentPosition-!d.compareDocumentPosition;if(e)return e;e=(a.ownerDocument||a)===(d.ownerDocument||d)?a.compareDocumentPosition(d):1;return e&1||!p.sortDetached&&d.compareDocumentPosition(a)===
e?a===b||a.ownerDocument===x&&P(x,a)?-1:d===b||d.ownerDocument===x&&P(x,d)?1:F?J.call(F,a)-J.call(F,d):0:e&4?-1:1}:function(a,d){if(a===d)return N=!0,0;var e,f=0;e=a.parentNode;var g=d.parentNode,k=[a],n=[d];if(!e||!g)return a===b?-1:d===b?1:e?-1:g?1:F?J.call(F,a)-J.call(F,d):0;if(e===g)return va(a,d);for(e=a;e=e.parentNode;)k.unshift(e);for(e=d;e=e.parentNode;)n.unshift(e);for(;k[f]===n[f];)f++;return f?va(k[f],n[f]):k[f]===x?-1:n[f]===x?1:0};return b};r.matches=function(a,b){return r(a,null,null,
b)};r.matchesSelector=function(a,b){(a.ownerDocument||a)!==t&&D(a);b=b.replace(Va,"='$1']");if(p.matchesSelector&&B&&(!K||!K.test(b))&&(!u||!u.test(b)))try{var c=$.call(a,b);if(c||p.disconnectedMatch||a.document&&11!==a.document.nodeType)return c}catch(d){}return 0<r(b,t,null,[a]).length};r.contains=function(a,b){(a.ownerDocument||a)!==t&&D(a);return P(a,b)};r.attr=function(a,b){(a.ownerDocument||a)!==t&&D(a);var c=l.attrHandle[b.toLowerCase()],c=c&&Qa.call(l.attrHandle,b.toLowerCase())?c(a,b,!B):
void 0;return void 0!==c?c:p.attributes||!B?a.getAttribute(b):(c=a.getAttributeNode(b))&&c.specified?c.value:null};r.error=function(a){throw Error("Syntax error, unrecognized expression: "+a);};r.uniqueSort=function(a){var b,c=[],d=0,e=0;N=!p.detectDuplicates;F=!p.sortStable&&a.slice(0);a.sort(na);if(N){for(;b=a[e++];)b===a[e]&&(d=c.push(e));for(;d--;)a.splice(c[d],1)}F=null;return a};Z=r.getText=function(a){var b,c="",d=0;if(b=a.nodeType)if(1===b||9===b||11===b){if("string"===typeof a.textContent)return a.textContent;
for(a=a.firstChild;a;a=a.nextSibling)c+=Z(a)}else{if(3===b||4===b)return a.nodeValue}else for(;b=a[d++];)c+=Z(b);return c};l=r.selectors={cacheLength:50,createPseudo:y,match:aa,attrHandle:{},find:{},relative:{">":{dir:"parentNode",first:!0}," ":{dir:"parentNode"},"+":{dir:"previousSibling",first:!0},"~":{dir:"previousSibling"}},preFilter:{ATTR:function(a){a[1]=a[1].replace(G,H);a[3]=(a[3]||a[4]||a[5]||"").replace(G,H);"~="===a[2]&&(a[3]=" "+a[3]+" ");return a.slice(0,4)},CHILD:function(a){a[1]=a[1].toLowerCase();
"nth"===a[1].slice(0,3)?(a[3]||r.error(a[0]),a[4]=+(a[4]?a[5]+(a[6]||1):2*("even"===a[3]||"odd"===a[3])),a[5]=+(a[7]+a[8]||"odd"===a[3])):a[3]&&r.error(a[0]);return a},PSEUDO:function(a){var b,c=!a[6]&&a[2];if(aa.CHILD.test(a[0]))return null;if(a[3])a[2]=a[4]||a[5]||"";else if(c&&Wa.test(c)&&(b=Q(c,!0))&&(b=c.indexOf(")",c.length-b)-c.length))a[0]=a[0].slice(0,b),a[2]=c.slice(0,b);return a.slice(0,3)}},filter:{TAG:function(a){var b=a.replace(G,H).toLowerCase();return"*"===a?function(){return!0}:function(a){return a.nodeName&&
a.nodeName.toLowerCase()===b}},CLASS:function(a){var b=za[a+" "];return b||(b=RegExp("(^|[\\x20\\t\\r\\n\\f])"+a+"([\\x20\\t\\r\\n\\f]|$)"))&&za(a,function(a){return b.test("string"===typeof a.className&&a.className||typeof a.getAttribute!==L&&a.getAttribute("class")||"")})},ATTR:function(a,b,c){return function(d){d=r.attr(d,a);if(null==d)return"!="===b;if(!b)return!0;d+="";return"="===b?d===c:"!="===b?d!==c:"^="===b?c&&0===d.indexOf(c):"*="===b?c&&-1<d.indexOf(c):"$="===b?c&&d.slice(-c.length)===
c:"~="===b?-1<(" "+d+" ").indexOf(c):"|="===b?d===c||d.slice(0,c.length+1)===c+"-":!1}},CHILD:function(a,b,c,d,e){var f="nth"!==a.slice(0,3),g="last"!==a.slice(-4),k="of-type"===b;return 1===d&&0===e?function(a){return!!a.parentNode}:function(b,c,h){var l,j,m,p,r;c=f!==g?"nextSibling":"previousSibling";var s=b.parentNode,t=k&&b.nodeName.toLowerCase();h=!h&&!k;if(s){if(f){for(;c;){for(j=b;j=j[c];)if(k?j.nodeName.toLowerCase()===t:1===j.nodeType)return!1;r=c="only"===a&&!r&&"nextSibling"}return!0}r=
[g?s.firstChild:s.lastChild];if(g&&h){h=s[q]||(s[q]={});l=h[a]||[];p=l[0]===A&&l[1];m=l[0]===A&&l[2];for(j=p&&s.childNodes[p];j=++p&&j&&j[c]||(m=p=0)||r.pop();)if(1===j.nodeType&&++m&&j===b){h[a]=[A,p,m];break}}else if(h&&(l=(b[q]||(b[q]={}))[a])&&l[0]===A)m=l[1];else for(;j=++p&&j&&j[c]||(m=p=0)||r.pop();)if((k?j.nodeName.toLowerCase()===t:1===j.nodeType)&&++m)if(h&&((j[q]||(j[q]={}))[a]=[A,m]),j===b)break;m-=e;return m===d||0===m%d&&0<=m/d}}},PSEUDO:function(a,b){var c,d=l.pseudos[a]||l.setFilters[a.toLowerCase()]||
r.error("unsupported pseudo: "+a);return d[q]?d(b):1<d.length?(c=[a,a,"",b],l.setFilters.hasOwnProperty(a.toLowerCase())?y(function(a,c){for(var g,k=d(a,b),n=k.length;n--;)g=J.call(a,k[n]),a[g]=!(c[g]=k[n])}):function(a){return d(a,0,c)}):d}},pseudos:{not:y(function(a){var b=[],c=[],d=ma(a.replace(W,"$1"));return d[q]?y(function(a,b,c,k){k=d(a,null,k,[]);for(var n=a.length;n--;)if(c=k[n])a[n]=!(b[n]=c)}):function(a,f,g){b[0]=a;d(b,null,g,c);return!c.pop()}}),has:y(function(a){return function(b){return 0<
r(a,b).length}}),contains:y(function(a){return function(b){return-1<(b.textContent||b.innerText||Z(b)).indexOf(a)}}),lang:y(function(a){Xa.test(a||"")||r.error("unsupported lang: "+a);a=a.replace(G,H).toLowerCase();return function(b){var c;do if(c=B?b.lang:b.getAttribute("xml:lang")||b.getAttribute("lang"))return c=c.toLowerCase(),c===a||0===c.indexOf(a+"-");while((b=b.parentNode)&&1===b.nodeType);return!1}}),target:function(a){var b=ea.location&&ea.location.hash;return b&&b.slice(1)===a.id},root:function(a){return a===
C},focus:function(a){return a===t.activeElement&&(!t.hasFocus||t.hasFocus())&&!(!a.type&&!a.href&&!~a.tabIndex)},enabled:function(a){return!1===a.disabled},disabled:function(a){return!0===a.disabled},checked:function(a){var b=a.nodeName.toLowerCase();return"input"===b&&!!a.checked||"option"===b&&!!a.selected},selected:function(a){a.parentNode&&a.parentNode.selectedIndex;return!0===a.selected},empty:function(a){for(a=a.firstChild;a;a=a.nextSibling)if(6>a.nodeType)return!1;return!0},parent:function(a){return!l.pseudos.empty(a)},
header:function(a){return Za.test(a.nodeName)},input:function(a){return Ya.test(a.nodeName)},button:function(a){var b=a.nodeName.toLowerCase();return"input"===b&&"button"===a.type||"button"===b},text:function(a){var b;return"input"===a.nodeName.toLowerCase()&&"text"===a.type&&(null==(b=a.getAttribute("type"))||"text"===b.toLowerCase())},first:I(function(){return[0]}),last:I(function(a,b){return[b-1]}),eq:I(function(a,b,c){return[0>c?c+b:c]}),even:I(function(a,b){for(var c=0;c<b;c+=2)a.push(c);return a}),
odd:I(function(a,b){for(var c=1;c<b;c+=2)a.push(c);return a}),lt:I(function(a,b,c){for(b=0>c?c+b:c;0<=--b;)a.push(b);return a}),gt:I(function(a,b,c){for(c=0>c?c+b:c;++c<b;)a.push(c);return a})}};l.pseudos.nth=l.pseudos.eq;for(M in{radio:!0,checkbox:!0,file:!0,password:!0,image:!0})l.pseudos[M]=Na(M);for(M in{submit:!0,reset:!0})l.pseudos[M]=Oa(M);wa.prototype=l.filters=l.pseudos;l.setFilters=new wa;Q=r.tokenize=function(a,b){var c,d,e,f,g,k,n;if(g=Aa[a+" "])return b?0:g.slice(0);g=a;k=[];for(n=l.preFilter;g;){if(!c||
(d=Ta.exec(g)))d&&(g=g.slice(d[0].length)||g),k.push(e=[]);c=!1;if(d=Ua.exec(g))c=d.shift(),e.push({value:c,type:d[0].replace(W," ")}),g=g.slice(c.length);for(f in l.filter)if((d=aa[f].exec(g))&&(!n[f]||(d=n[f](d))))c=d.shift(),e.push({value:c,type:f,matches:d}),g=g.slice(c.length);if(!c)break}return b?g.length:g?r.error(a):Aa(a,k).slice(0)};ma=r.compile=function(a,b){var c,d=[],e=[],f=Ba[a+" "];if(!f){b||(b=Q(a));for(c=b.length;c--;)f=la(b[c]),f[q]?d.push(f):e.push(f);var g=0<d.length,k=0<e.length;
c=function(a,b,c,f,h){var j,m,p,s=0,q="0",u=a&&[],v=[],w=Y,x=a||k&&l.find.TAG("*",h),y=A+=null==w?1:Math.random()||0.1,z=x.length;for(h&&(Y=b!==t&&b);q!==z&&null!=(j=x[q]);q++){if(k&&j){for(m=0;p=e[m++];)if(p(j,b,c)){f.push(j);break}h&&(A=y)}g&&((j=!p&&j)&&s--,a&&u.push(j))}s+=q;if(g&&q!==s){for(m=0;p=d[m++];)p(u,v,b,c);if(a){if(0<s)for(;q--;)!u[q]&&!v[q]&&(v[q]=Ra.call(f));v=X(v)}E.apply(f,v);h&&(!a&&0<v.length&&1<s+d.length)&&r.uniqueSort(f)}h&&(A=y,Y=w);return u};c=g?y(c):c;f=Ba(a,c);f.selector=
a}return f};ta=r.select=function(a,b,c,d){var e,f,g,k,h="function"===typeof a&&a,j=!d&&Q(a=h.selector||a);c=c||[];if(1===j.length){f=j[0]=j[0].slice(0);if(2<f.length&&"ID"===(g=f[0]).type&&p.getById&&9===b.nodeType&&B&&l.relative[f[1].type]){if(b=(l.find.ID(g.matches[0].replace(G,H),b)||[])[0])h&&(b=b.parentNode);else return c;a=a.slice(f.shift().value.length)}for(e=aa.needsContext.test(a)?0:f.length;e--;){g=f[e];if(l.relative[k=g.type])break;if(k=l.find[k])if(d=k(g.matches[0].replace(G,H),fa.test(f[0].type)&&
ga(b.parentNode)||b)){f.splice(e,1);a=d.length&&V(f);if(!a)return E.apply(c,d),c;break}}}(h||ma(a,j))(d,b,!B,c,fa.test(a)&&ga(b.parentNode)||b);return c};p.sortStable=q.split("").sort(na).join("")===q;p.detectDuplicates=!!N;D();p.sortDetached=z(function(a){return a.compareDocumentPosition(t.createElement("div"))&1});z(function(a){a.innerHTML="<a href='#'></a>";return"#"===a.firstChild.getAttribute("href")})||S("type|href|height|width",function(a,b,c){if(!c)return a.getAttribute(b,"type"===b.toLowerCase()?
1:2)});(!p.attributes||!z(function(a){a.innerHTML="<input/>";a.firstChild.setAttribute("value","");return""===a.firstChild.getAttribute("value")}))&&S("value",function(a,b,c){if(!c&&"input"===a.nodeName.toLowerCase())return a.defaultValue});z(function(a){return null==a.getAttribute("disabled")})||S("checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",function(a,b,c){var d;if(!c)return!0===a[b]?b.toLowerCase():(d=a.getAttributeNode(b))&&
d.specified?d.value:null});var da=/[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,v,Ja,Ka={"\b":"\\b","\t":"\\t","\n":"\\n","\f":"\\f","\r":"\\r",'"':'\\"',"\\":"\\\\"},S=function(){var a,b,c=1,d,e=this;return{postMessage:function(a,b,d){b&&(d=d||parent,e.postMessage?d.postMessage(a,b.replace(/([^:]+:\/\/[^\/]+).*/,"$1")):b&&(d.location=b.replace(/#.*$/,"")+"#"+ +new Date+c++ +"&"+a))},receiveMessage:function(c,g){if(e.postMessage)if(c&&
(d=function(a){if("string"===typeof g&&a.origin!==g||"[object Function]"===Object.prototype.toString.call(g)&&!1===g(a.origin))return!1;c(a)}),e.addEventListener)e[c?"addEventListener":"removeEventListener"]("message",d,!1);else e[c?"attachEvent":"detachEvent"]("onmessage",d);else a&&clearInterval(a),a=null,c&&(a=setInterval(function(){var a=document.location.hash,d=/^#?\d+&/;a!==b&&d.test(a)&&(b=a,c({data:a.replace(d,"")}))},100))}}}();h.dirtyTrack=!1;h.trackInProgress=!1;h.trackAfterTheFact=!1;
var pa={processCommand:function(a,b){if(a instanceof Array){var c=b[a[0]];c?c.apply(null,a.slice(1)):console.log("No handler to handle command: "+a)}else console.log("Ignore invalid command: "+a)},processQueue:function(a,b){if(a){a.push=function(a){pa.processCommand(a,b)};var c=[],d,e;d=0;for(e=a.length;d<e;d+=1)"widget"===a[d][0]?c.push(a[d]):c.unshift(a[d]);d=0;for(e=c.length;d<e;d+=1)pa.processCommand(c[d],b)}}},j={site:location.host,client_api_site:"https://c.friendbuy.com",campaignId:""},ba=
function(a,b,c,d,e,f){h.track_callback=function(a){h.trackInProgress=!1;O(a);a&&(h.track_data||(h.track_data=a),d&&d(),h.dirtyTrack&&ba(j.client_api_site,j.site,j.campaignId,null,"/track-update.js",h.track_data.embed_load_code))};j.products&&(h.trackAfterTheFact&&h.orderTracked)&&(j["products-only"]=!0);j.order&&(h.orderTracked=!0,"undefined"===typeof j.order.id&&(j.order.id="frndby-"+Fa()));h.dirtyTrack=!1;h.trackInProgress=!0;h.trackAfterTheFact=!0;Ga((a||U.protocol+"//pt.friendbuy.com")+"/"+b.toLowerCase()+
(e||"/track.js")+"?campaign_id="+(c||"")+"&data="+encodeURIComponent(O(j))+(f?"&embed_load_code="+encodeURIComponent(f):""))},Ha=function(){for(var a in h.widgets)h.widgets.hasOwnProperty(a)&&h.widgets[a].load()},qa=function(a,b,c,d,e){this.guid=a;this.init(b,c,d,e);this.MOBILE_MARGIN=20},Ia=function(a){if(!a)return null;var b={},c;for(c in a)b[c]=a[c];return b};qa.prototype={constructor:qa,init:function(a,b,c,d){this.find=r;this.name=b;this.selector=c;this.options=Ia(d);this.params=Ia(a);this.options&&
this.options.parameters&&(this.params.parameters=this.options.parameters);this.options&&this.options.criteria&&(this.params.criteria=this.options.criteria);this.options&&(delete this.options.parameters,delete this.options.criteria);a.site=a.site||U.host;this.site=a.site;this.clientApiSite=a.client_api_site||U.protocol+"//pt.friendbuy.com";this.campaignId=a.campaign_id||"";this.autoDelay=d&&d.configuration&&"undefined"!==typeof d.configuration.auto_delay?d.configuration.auto_delay:null;this.shareButton=
d&&d.configuration&&"undefined"!==typeof d.configuration.share_button?d.configuration.share_button:!0;this.shareWidgetElement=null;this.sharingTargetCode=this.name;this.sharingTargetCode.match(/^raf_/)&&(this.shareButton=!1);this.widgetCreated=!1;this.waitingForRecovery=null;this.force_mobile=d?d.force_mobile:!1;this.widgetCheckSrc=this.widgetSrc=this.error=this.lastClickId=this.widgetType=this.embedLoadCode=this.top=this.height=this.width=this.opacity=this.closeButtonSrc=this.shareButtonSrc=this.embedSite=
null},load:function(){var a=this.params;this.propertiesSrc=this.clientApiSite+"/"+this.site.toLowerCase()+"/"+this.sharingTargetCode+"/widget.js?campaign_id="+this.campaignId+"&embed_load_code="+h.track_data.embed_load_code+"&guid="+this.guid+"&data="+encodeURIComponent(O(a));this.criteria=[];if(a.criteria)for(var b in a.criteria){var c=b+":"+encodeURIComponent(a.criteria[b]);this.criteria.push("criterion="+c.toLowerCase())}this.criteria&&(this.propertiesSrc+="&"+this.criteria.join("&"));Ga(this.propertiesSrc)},
loadPropertiesCallback:function(a){var b=new Image(25,25),c=this.options;b.src=a.shareButtonSrc;this.embedSite=this.embed_site||a.embedSite;this.shareButtonSrc=a.shareButtonSrc;this.closeButtonSrc=a.closeButtonSrc;null===this.autoDelay&&(this.autoDelay=a.autoDelay);this.opacity=a.opacity;this.width=parseInt(a.width);this.height=parseInt(a.height);this.top=a.top?parseInt(a.top):null;this.embedLoadCode=a.embedLoadCode;this.widgetType=a.widgetType;this.widgetResponsive=a.widgetResponsive;this.lastClickId=
a.lastClickId;this.error=a.error;""!==this.error&&console.log&&console.log(this.error);this.embedLoadCode?(b=this.embedSite+"/"+this.site+"/widgets/"+this.guid,this.widgetSrc=b+"/?embed_load_code="+this.embedLoadCode,this.widgetCheckSrc=b+"/check?embed_load_code="+this.embedLoadCode,c&&c.content&&(this.widgetSrc+="&content="+encodeURIComponent(O(c.content))),!a.widgetDisabled&&!this.waitingForRecovery?(this.shareWidgetElement=this.find(this.selector),"embedded"===this.widgetType?this.createWidgetEmbedded():
"popup"===this.widgetType?(this.createShareButton(),this.autoShowWidget()):console.log("no known widgetType:"+this.widgetType)):this.waitingForRecovery&&this.waitingForRecovery()):console.log&&console.log("embed load code is missing")},assignProperty:function(a,b,c){for(var d=0,e=a.length;d<e;d+=1)a[d][b]=c},createShareButton:function(){if(this.shareWidgetElement){this.shareButton&&this.assignProperty(this.shareWidgetElement,"innerHTML","<a href='javascript:void(0);'><img src='"+this.shareButtonSrc+
"' border='0' alt='' /></a>");var a=this;this.assignProperty(this.shareWidgetElement,"onclick",function(b){b=b||window.event;b.preventDefault?b.preventDefault():b.returnValue=!1;a.showWidget()})}},autoShowWidget:function(){if(0<this.autoDelay&&this.shareWidgetElement){var a=this;window.setTimeout(function(){a.showWidget()},this.autoDelay)}},setIframeSrc:function(){m.getElementById(this.guid+"_frndby_iframe").src=this.widgetSrc+"#"+encodeURIComponent(U.href+"#"+this.guid)},assignWidgetSrc:function(){var a=
!1,b=this;if(XMLHttpRequest&&!window.XDomainRequest){var c=new XMLHttpRequest;c.open("GET",this.widgetCheckSrc,!1);c.send();200!==c.status&&(a=!0,this.waitingForRecovery=function(){b.setIframeSrc();b.waitingForRecovery=null},ba(this.clientApiSite,this.site,this.campaignId,Ha))}a||this.setIframeSrc();return a},showWidget:function(){this.ensureWidgetCreated();var a=this;this.checkForMobile(function(){var b=m.getElementById(a.guid+"_frndby_iframe"),c="enabled"!==a.widgetResponsive;if(c)a.setSizeForDesktop(b);
else{var d=m.querySelector("meta[name=viewport]");d?a.previousViewport=d.content:(a.previousViewport="width=980, height=1306",d=document.createElement("meta"),d.name="viewport",m.getElementsByTagName("head")[0].appendChild(d));d.content="width=device-width, height=device-height";window.scrollTo(0,1);a.setSizeForMobile(b)}d=m.getElementById(a.guid+"_frndby_unit");b=c?Math.max(0,(Math.max(window.innerWidth,m.body.clientWidth)-a.width)/2):0;d.style.position="absolute";d.style.left=b+"px";d.style.top=
(c?a.getScrollTop():a.MOBILE_MARGIN)+"px";c?a.setSizeForDesktop(d):a.setSizeForMobile(d);d=m.getElementById(a.guid+"_frndby_close_btn");d.style.position="absolute";d.style.left=b-2+"px";d.style.top=(c?a.getScrollTop():a.MOBILE_MARGIN)+2+"px";d.style.width=c?a.width+"px":(a.force_mobile?320:screen.width)+"px"});m.getElementById(a.guid+"_frndby_container").style.display="block";a.assignWidgetSrc()},hideWidget:function(){m.getElementById(this.guid+"_frndby_container").style.display="none";m.getElementById(this.guid+
"_frndby_iframe").src=""},ensureWidgetCreated:function(){this.widgetCreated||(this.createWidgetPopup(),this.widgetCreated=!0)},checkForMobile:function(a){var b=this;(function(){if(b.force_mobile)return!0;var a=window.matchMedia?window.matchMedia("(max-device-width: "+b.width+"px)").matches:screen.width<this.width;return a&&"enabled"===b.widgetResponsive||a&&"popup"===b.widgetType?!0:!1})()&&a()},createWidgetPopup:function(){var a=this.ele("div",{id:this.guid+"_frndby_container"}),b=this.ele("div",
{id:this.guid+"_frndby_unit"});this.setStyle(b,{display:"block",left:(this.getWidth()-this.width)/2+"px",position:"fixed",top:this.unitTop()+"px","text-align":"left",width:this.width+"px",height:this.height+"px",zIndex:"99999",overflow:"hidden"});b.innerHTML="<img alt='Loading...' border='0' height='80' src='//static-friendbuy-com.s3.amazonaws.com/img/ajax-loader.gif'style='padding-left:302.5px;padding-top:197.5px;' width='80' />";var c=this.createWidgetIframe("absolute"),d=m.createDocumentFragment();
b.appendChild(c);a.appendChild(b);a.appendChild(this.createBlackDiv());a.appendChild(this.createCloseButton());d.appendChild(a);m.getElementsByTagName("body")[0].appendChild(d)},createBlackDiv:function(){var a=this.ele("div",{id:this.guid+"_frndby_blck_div"});this.setStyle(a,{display:"block",position:"fixed",top:"0",left:"0",width:"100%",height:"100%",backgroundColor:"#333",zIndex:"9997"});null!==this.opacity&&this.setStyle(a,{opacity:"."+this.opacity,filter:"alpha(opacity="+this.opacity+")"});return a},
fireEvent:function(a){var b=window._frnd_events;if(b[a])for(var c=Array.prototype.slice.call(arguments).slice(1),d=0,e=b[a].length;d<e;d+=1)b[a][d].apply(null,c)},createCloseButton:function(){var a=this.ele("div",{id:this.guid+"_frndby_close_btn",align:"right"});this.setStyle(a,{display:"block",position:"fixed",top:this.unitTop()+2+"px",left:(this.getWidth()-this.width)/2-2+"px",width:this.width+"px","text-align":"right",zIndex:"999999"});var b=this.ele("a",{href:"javascript:void(0)"}),c=this.ele("img",
{alt:"",border:"0"});c.src=this.closeButtonSrc;b.appendChild(c);a.appendChild(b);var d=this;b.onclick=function(){d.checkForMobile(function(){if("enabled"===d.widgetResponsive){var a=m.querySelector("meta[name=viewport]");a||(a=document.createElement("meta"),a.name="viewport",m.getElementsByTagName("head")[0].appendChild(a));a.content=d.previousViewport}});d.hideWidget();var a=setInterval(function(){"none"===m.getElementById(d.guid+"_frndby_container").style.display&&(d.fireEvent("widget.close",d),
clearInterval(a))},100)};return a},setSizeForDesktop:function(a){a.style.width=this.width+"px";a.style.height=this.height+"px"},setSizeForMobile:function(a){a.style.width=(this.force_mobile?320:screen.width)+"px";a.style.height=(this.force_mobile?480:screen.availHeight)-4*this.MOBILE_MARGIN+"px"},createWidgetEmbedded:function(){for(var a=0,b=this.shareWidgetElement.length;a<b;a+=1){var c=this.createWidgetIframe("relative");this.shareWidgetElement[a].appendChild(c)}this.assignWidgetSrc()},createWidgetIframe:function(a){var b=
this.ele("iframe",{id:this.guid+"_frndby_iframe",frameBorder:"false",scrolling:"no"});this.setStyle(b,{border:"0px",height:this.height+"px",left:"0",position:a,top:"0"});var c=this;c.setSizeForDesktop(b);c.checkForMobile(function(){c.setSizeForMobile(b)});return b},ele:function(a,b){var c=m.createElement(a),d;for(d in b)c.setAttribute(d,b[d]);return c},setStyle:function(a,b){for(var c in b)a.style[c]=b[c]},getScrollTop:function(){return"undefined"!=typeof pageYOffset?pageYOffset:(m.documentElement.clientHeight?
m.documentElement:m.body).scrollTop},getHeight:function(){return"undefined"!=typeof window.innerHeight?window.innerHeight:(m.documentElement.clientHeight?m.documentElement:m.body).clientHeight},getWidth:function(){return"undefined"!=typeof window.innerWidth?window.innerWidth:(m.documentElement.clientWidth?m.documentElement:m.body).clientWidth},unitTop:function(){return 0<=this.top?this.top:this.getScrollTop()+0.1*this.getHeight()}};var Fa=function(){return(65536*(1+Math.random())|0).toString(16).substring(1)+
"-"+(65536*(1+Math.random())|0).toString(16).substring(1)},Ga=function(a){var b,c=m.getElementsByTagName(ra)[0];b=m.createElement(ra);b.async=1;b.src=a;c.parentNode.insertBefore(b,c)};window._frnd_events=window._frnd_events||{};pa.processQueue(h,{site:function(a){j.site=a},_setEmbedSite:function(a){j.embedSite=a},_setClientApiSite:function(a){j.client_api_site=a},_setCampaignId:function(a){j.campaignId=a},track:function(a,b){O(b);j[a]=b;h.dirtyTrack=!0;!h.trackInProgress&&h.trackAfterTheFact&&ba(j.client_api_site,
j.site,j.campaignId,null,"/track-update.js",h.track_data.embed_load_code)},setPage:function(a){j.page=a},setAutoDelay:function(a){j.autoDelay=a},widget:function(a,b,c){var d=Fa();h.widgets=h.widgets||{};"string"!==typeof b&&(c=b,b=null);b||(b=".friendbuy-"+a);h.widgets[d]=new qa(d,j,a,b,c);h.trackAfterTheFact&&h.track_data&&h.widgets[d].load()},subscribe:function(a,b){var c=window._frnd_events;c[a]=c[a]||[];c[a].push(b)}});S.receiveMessage(function(a){if(h.widgets){var b=a.data.split("#");a=h.widgets[b.pop()];
var c=b.shift(),b="share.success"===c?{id:b.shift(),network:b.shift(),message:b.shift()}:a;a&&a.fireEvent(c,b)}},j.embed_site);ba(j.client_api_site,j.site,j.campaignId,Ha)})(window.friendbuy||[],document,location,"script");