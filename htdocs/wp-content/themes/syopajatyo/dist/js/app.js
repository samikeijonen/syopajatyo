!function(e){var t={};function n(a){if(t[a])return t[a].exports;var s=t[a]={i:a,l:!1,exports:{}};return e[a].call(s.exports,s,s.exports,n),s.l=!0,s.exports}n.m=e,n.c=t,n.d=function(e,t,a){n.o(e,t)||Object.defineProperty(e,t,{configurable:!1,enumerable:!0,get:a})},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="/",n(n.s=0)}({0:function(e,t,n){n("F1kH"),n("BTZ5"),e.exports=n("ttfr")},BTZ5:function(e,t){},F1kH:function(e,t){!function(){var e,t,n,a,s,i,o,r;if((e=document.getElementById("js-menu--primary"))&&void 0!==(t=e.getElementsByTagName("button")[0]))if(n=e.getElementsByTagName("ul")[0],a=document.getElementById("menu__items--social"),void 0!==n){for(n.classList.contains("js-nav-menu")||n.classList.add("js-nav-menu"),t.addEventListener("click",function(){u()}),document.addEventListener("keyup",function(e){27===e.keyCode&&"false"!==t.getAttribute("aria-expanded")&&(u(),t.focus())}),window.addEventListener("resize",function(){"none"===window.getComputedStyle(t,null).getPropertyValue("display")&&(t.setAttribute("aria-expanded","false"),n.classList.remove("is-opened"),a.classList.remove("is-opened"))}),o=0,r=(i=n.getElementsByTagName("a")).length;o<r;o++)i[o].addEventListener("focus",d,!0),i[o].addEventListener("blur",d,!0);if(s=document.getElementById("js-menu--sidebar")){var l=s.querySelectorAll(".children li a");for(o=0,r=l.length;o<r;o++)l[o].insertAdjacentHTML("afterbegin",SyopaJaTyoText.icon)}var c=document.querySelectorAll(".widget--nav-menu .menu__sub-menu li a");if(c)for(o=0,r=c.length;o<r;o++)c[o].insertAdjacentHTML("afterbegin",SyopaJaTyoText.icon);!function(e){var t,n,a=e.querySelectorAll(".menu-item-has-children > a, .page_item_has_children > a");if("ontouchstart"in window)for(t=function(e){var t,n=this.parentNode;if(n.classList.contains("focus"))n.classList.remove("focus");else{for(e.preventDefault(),t=0;t<n.parentNode.children.length;++t)n!==n.parentNode.children[t]&&n.parentNode.children[t].classList.remove("focus");n.classList.add("focus")}},n=0;n<a.length;++n)a[n].addEventListener("touchstart",t,!1)}(e)}else t.style.display="none";function u(){e.classList.toggle("is-toggled"),n.classList.toggle("is-opened"),a.classList.toggle("is-opened");var s="false"===t.getAttribute("aria-expanded")?"true":"false";t.setAttribute("aria-expanded",s)}function d(){for(var e=this;-1===e.className.indexOf("js-nav-menu");)"li"===e.tagName.toLowerCase()&&(-1!==e.className.indexOf("focus")?e.className=e.className.replace(" focus",""):e.className+=" focus"),e=e.parentElement}}()},ttfr:function(e,t){}});