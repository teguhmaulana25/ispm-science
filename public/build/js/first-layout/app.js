"use strict";$(document).ready(function(){function o(o){$(o).block({message:"<div class='sk-three-bounce'><div class='sk-child sk-bounce1'></div><div class='sk-child sk-bounce2'></div><div class='sk-child sk-bounce3'></div></div>",css:{border:"none",backgroundColor:"transparent"},overlayCSS:{backgroundColor:"#FAFEFF",opacity:.5,cursor:"wait"}})}function t(o){$(o).unblock()}$(".hamburger-menu").on("click",function(){$(this).toggleClass("active"),$("body").toggleClass("sidebar-toggled")}),$(".sidebar-control").on("click",function(){$("body").toggleClass("sidebar-unpin"),$(this).find("i").toggleClass("ti-pin2 ti-pin-alt")}),$(".search-bar-toggle").on("click",function(){$(".search-bar").toggleClass("closed")}),$(".right-sidebar-toggle").on("click",function(){$(".right-sidebar").toggleClass("closed")}),$(".conversation-toggle").on("click",function(){$(".conversation").toggleClass("closed")}),$(".setting-toggle").on("click",function(){$(".setting").toggleClass("closed")}),$("[data-toggle='tooltip']").tooltip(),$("[data-toggle='popover']").popover(),$(".widget-collapse").on("click",function(){$(this).closest(".widget").find(".widget-body").slideToggle(300),$(this).find("i").toggleClass("ti-angle-up ti-angle-down")}),$(".widget-reload").on("click",function(){var e=$(this).closest(".widget");o(e),window.setTimeout(function(){t(e)},3e3)}),$(".widget-remove").on("click",function(){$(this).closest(".widget").hide()}),$(".progress").length>0&&$(".progress .progress-bar").progressbar(),$(".custombox").length>0&&$(".custombox").on("click",function(o){Custombox.open({target:$(this).attr("href"),effect:$(this).attr("data-effect")||"fadein",overlayColor:$(this).attr("data-overlay-color")||"#000",overlayOpacity:$(this).attr("data-overlay-opacity")||.8}),o.preventDefault()}),$(".animated").animo({duration:.2})});
$(document).ready(function() {

  // User Profile
  // --------------------------------------------------

  $('#esp-user-profile').easyPieChart({
      barColor: '#0667D6',
      trackColor: 'rgba(0,0,0,0)',
      scaleColor: false,
      scaleLength: 0,
      lineCap: 'round',
      lineWidth: 3,
      size: 130,
      animate: {
          duration: 2000,
          enabled: true
      }
  });

});