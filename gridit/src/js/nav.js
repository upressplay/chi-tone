;(function(obj, undefined){
	"use strict";

	var id = "nav",
	color = "dark",
	trace = site.utilities.trace,
    utils = site.utils,
    menuOpen = false,
    dom = {},
    navCollapsed = false,
    breakPoint = "";

	function init() {

        render();    
    }

    function render() {

    	
        trace.log(id+" render utils.getBreakPoint = "+utils.getBreakPoint());

        dom.navBtns = $("#nav-btns");
        dom.menuBtnClose = $("#menu-btn-close");    
        dom.menuBtn = $("#menu-btn");


        dom.menuBtn.click(function(event) {
            openMenu();
        });

        dom.menuBtnClose.click(function(event) {
            openMenu();
        });

    }

    /*
        openMenu opens and closes the mobile nav
     */
    function openMenu() {
        trace.push('openMenu');

        if(menuOpen) {
            menuOpen = false;
            TweenMax.to(dom.navBtns, 0.5, {opacity:0, onComplete:utils.divDisplay, onCompleteParams:[undefined,"none",dom.navBtns], ease:"Power1.easeIn", overwrite:2});
            TweenMax.to(dom.menuBtnClose, 0.5, {autoAlpha:0, ease:"Power1.easeIn", overwrite:2});
        } else {
            menuOpen = true;
            TweenMax.to(dom.navBtns, 0.5, {opacity:1, onStart:utils.divDisplay, onStartParams:[undefined,"block",dom.navBtns], ease:"Power1.easeIn", overwrite:2});
            TweenMax.to(dom.menuBtnClose, 0.5, {autoAlpha:1, ease:"Power1.easeIn", overwrite:2});
            
        }
        

    }

	site.nav = {
	};

	$(function(){
		init();
	});

})(window.site=window.site || {});
