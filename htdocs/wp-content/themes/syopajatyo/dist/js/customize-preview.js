(()=>{"use strict";(function(){wp.customize("blogname",(function(t){t.bind((function(t){document.querySelector(".app-header__title a").textContent=t}))})),wp.customize("blogdescription",(function(t){t.bind((function(t){document.querySelector(".app-header__description").textContent=t}))})),wp.customize("header_textcolor",(function(t){t.bind((function(t){document.querySelectorAll(".app-header__title a, .app-header__description").forEach((function(e){"blank"===t?(e.style.clip="rect(0 0 0 0)",e.style.position="absolute"):(e.style.clip=null,e.style.position=null,e.style.color=t)}))}))}))})()})();