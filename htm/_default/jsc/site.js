/** Jquery Trigger fin des chargements **/
$(window).load(function(){

});

/** Jquery Trigger DOM chargé **/
$(document).ready(function(){
  $('nav menu a').click(function(){
    $('#tap').trigger('click');
  });
});

/** Jquery Trigger redimensionnement **/
$(window).resize(function(){
});

/** Jquery Trigger scroll **/
$(window).scroll(function() {
});

/** Jquery Trigger à la fin du redimensionnement navigateur **/
var rtime = new Date(1, 1, 2000, 12,0,0);
var timeout = false;
var delta = 200;

$(window).resize(function() {
    rtime = new Date();
    if (timeout === false) {
        timeout = true;
        setTimeout(resizeend, delta);
    }
});

function resizeend() {
    if (new Date() - rtime < delta) {
        setTimeout(resizeend, delta);
    } else {
        timeout = false;
		//fin du resize
    }
}

/** Javascript Taille de l'ascenceur **/
function getScrollBarWidth () {
    var $outer = $('<div>').css({visibility: 'hidden', width: 100, overflow: 'scroll'}).appendTo('body'),
        widthWithScroll = $('<div>').css({width: '100%'}).appendTo($outer).outerWidth();
    $outer.remove();
    return 100 - widthWithScroll;
}

/** Hamburger **/
(function() {

  "use strict";

  var toggles = document.querySelectorAll(".cmn-toggle-switch");

  for (var i = toggles.length - 1; i >= 0; i--) {
    var toggle = toggles[i];
    toggleHandler(toggle);
  }

  function toggleHandler(toggle) {
    toggle.addEventListener( "click", function(e) {
      e.preventDefault();
      var tap = document.getElementById('tap');
        if (tap.checked) {
            tap.checked = false;
        } else {
            tap.checked = true;
        }
      (this.classList.contains("active") === true) ? this.classList.remove("active") : this.classList.add("active");
    });
  }

})();
