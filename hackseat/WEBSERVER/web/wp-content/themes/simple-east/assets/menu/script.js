(function($) {

  $.fn.menumaker = function(options) {
      
      var navmenu = $(this), settings = $.extend({
        title: "Menu",
        format: "dropdown",
        sticky: false
      }, options);

      return this.each(function() {
        navmenu.prepend('<div id="menu-button">' + settings.title + '</div>');
        $(this).find("#menu-button").on('click', function(){
          $(this).toggleClass('menu-opened');
          var mainmenu = $(this).next('ul');
          if (mainmenu.hasClass('open')) { 
            mainmenu.hide().removeClass('open');
          }
          else {
            mainmenu.show().addClass('open');
            if (settings.format === "dropdown") {
              mainmenu.find('ul').show();
            }
          }
        });

        navmenu.find('li ul').parent().addClass('has-sub');

        multiTg = function() {
          navmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
          navmenu.find('.submenu-button').on('click', function() {
            $(this).toggleClass('submenu-opened');
            if ($(this).siblings('ul').hasClass('open')) {
              $(this).siblings('ul').removeClass('open').hide();
            }
            else {
              $(this).siblings('ul').addClass('open').show();
            }
          });
        };

        if (settings.format === 'multitoggle') multiTg();
        else navmenu.addClass('dropdown');

        if (settings.sticky === true) navmenu.css('position', 'fixed');

        resizeFix = function() {
          if ($( window ).width() > 768) {
            navmenu.find('ul').show();
          }

          if ($(window).width() <= 768) {
            navmenu.find('ul').hide().removeClass('open');
          }
        };
        resizeFix();
        return $(window).on('resize', resizeFix);

      });
  };
})(jQuery);

(function($){
$(document).ready(function(){
 
  $("#primary-menu").menumaker({
    title: "Menu",
    format: "multitoggle"
  });

  $("#primary-menu").prepend("<div id='menu-line'></div>");

var foundActive = false, activeElement, linePosition = 0, menuLine = $("#primary-menu #menu-line"), lineWidth, defaultPosition, defaultWidth;

$("#primary-menu > ul > li").each(function() {
  if ($(this).hasClass('active')) {
    activeElement = $(this);
    foundActive = true;
  }
});

if (foundActive === false) {
  activeElement = $("#primary-menu > ul > li").first();
}

defaultWidth = lineWidth = activeElement.width();

defaultPosition = linePosition = activeElement.position().left;

menuLine.css("width", lineWidth);
menuLine.css("left", linePosition);

$("#primary-menu > ul > li").hover(function() {
  activeElement = $(this);
  lineWidth = activeElement.width();
  linePosition = activeElement.position().left;
  menuLine.css("width", lineWidth);
  menuLine.css("left", linePosition);
}, 
function() {
  menuLine.css("left", defaultPosition);
  menuLine.css("width", defaultWidth);
});


	// TOP MENU //
	$("#top-menu").menumaker({
    title: "Menu",
    format: "multitoggle"
  });

  $("#top-menu").prepend("<div id='menu-line'></div>");
	
	var foundActive = false, activeElement, linePosition = 0, menuLine = $("#top-menu #menu-line"), lineWidth, defaultPosition, defaultWidth;
	
	$("#top-menu > ul > li").each(function() {
	  if ($(this).hasClass('active')) {
		activeElement = $(this);
		foundActive = true;
	  }
	});
	
	if (foundActive === false) {
	  activeElement = $("#top-menu > ul > li").first();
	}
	
	defaultWidth = lineWidth = activeElement.width();
	
	defaultPosition = linePosition = activeElement.position().left;
	
	menuLine.css("width", lineWidth);
	menuLine.css("left", linePosition);
	
	$("#top-menu > ul > li").hover(function() {
	  activeElement = $(this);
	  lineWidth = activeElement.width();
	  linePosition = activeElement.position().left;
	  menuLine.css("width", lineWidth);
	  menuLine.css("left", linePosition);
	}, 
	function() {
	  menuLine.css("left", defaultPosition);
	  menuLine.css("width", defaultWidth);
	});
 

});
})(jQuery);
