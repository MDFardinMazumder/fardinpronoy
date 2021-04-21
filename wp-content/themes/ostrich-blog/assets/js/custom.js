jQuery(document).ready(function($) {


    var loader                  = $('#loader');
    var loader_container        = $('#preloader');
    var scroll                  = $(window).scrollTop();  
    var scrollup                = $('.backtotop');
    var primary_menu_toggle     = $('#masthead .menu-toggle');
    var top_menu_toggle         = $('#top-navigation .menu-toggle');
    var dropdown_toggle         = $('button.dropdown-toggle');
    var primary_nav_menu        = $('#masthead .main-navigation');
    var top_nav_menu            = $('#top-navigation .main-navigation');
    var thumbnail_wrapper       = $('.thumbnail-wrapper');
    var editor_wrapper          = $('.editor-wrapper');
    var travel_slider           = $('.travel-slider');
    var featured_slider          = $('#featured-slider');


    loader_container.delay(1000).fadeOut();
    loader.delay(1000).fadeOut("slow");

    $(window).scroll(function() {
       

        if ($(this).scrollTop() > 1) {
            scrollup.css({bottom:"25px"});
        } 
        else {
            scrollup.css({bottom:"-100px"});
        }
    });

    scrollup.click(function() {
        $('html, body').animate({scrollTop: '0px'}, 800);
        return false;
    });

    primary_menu_toggle.click(function(){
        primary_nav_menu.slideToggle();
        $(this).toggleClass('active');
        $('.menu-overlay').toggleClass('active');
        $('#masthead .main-navigation').toggleClass('menu-open');
    });

    top_menu_toggle.click(function(){
        top_nav_menu.slideToggle();
        $(this).toggleClass('active');
        $('.menu-overlay').toggleClass('active');
        $('#top-navigation .main-navigation').toggleClass('menu-open');
        $('#top-navigation').css({ 'z-index' : '30000' });

        if( $('#masthead .menu-toggle').hasClass('active') ) {
            primary_nav_menu.slideUp();
            $('#masthead .main-navigation').removeClass('menu-open');
            $('#masthead .menu-toggle').removeClass('active');
            $('.menu-overlay').toggleClass('active');
        }
    });

    dropdown_toggle.click(function() {
        $(this).toggleClass('active');
        $(this).parent().find('.sub-menu').first().slideToggle();
        $('#primary-menu > li:last-child button.active').unbind('keydown');
    });

    $('.main-navigation ul li.search-menu a').click(function(event) {
        event.preventDefault();
        $(this).toggleClass('search-active');
        $('.main-navigation #search').fadeToggle();
        $('.main-navigation .search-field').focus();
    });

    $(document).keyup(function(e) {
        if (e.keyCode === 27) {
            $('.main-navigation ul li.search-menu a').removeClass('search-active');
            $('.main-navigation #search').fadeOut();
        }
    });


    $(document).click(function (e) {
        var container = $("#masthead, #top-navigation");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            primary_nav_menu.slideUp();
            $(this).removeClass('active');
            $('.menu-overlay').removeClass('active');
            $('#masthead .main-navigation').removeClass('menu-open');
            $('.menu-toggle').removeClass('active');

            top_nav_menu.slideUp();
            $(this).removeClass('active');
            $('.menu-overlay').removeClass('active');
            $('#top-navigation .main-navigation').removeClass('menu-open');
        }
    });


$('.grid').packery({
    itemSelector: '.grid-item'
});

thumbnail_wrapper.slick({
    responsive: [
    {
        breakpoint: 1025,
        settings: {
            slidesToShow: 2
        }
    },
    {
        breakpoint: 600,
        settings: {
            slidesToShow: 1        
        }
    }
    ]
});

editor_wrapper.slick({
    responsive: [
    {
        breakpoint: 1200,
        settings: {
            slidesToShow: 2
        }
    },
    {
        breakpoint: 900,
        settings: {
            slidesToShow: 1     
       }
    }
    ]
});

travel_slider.slick();

featured_slider.slick();

if( $(window).width() < 1024 ) {
    $('#primary-menu').find("li").last().bind( 'keydown', function(e) {
        if( e.which === 9 ) {
            e.preventDefault();
            $('#masthead').find('.menu-toggle').focus();
        }
    });

    $('#primary-menu > li:last-child button:not(.active)').bind( 'keydown', function(e) {
        if( e.which === 9 ) {
            e.preventDefault();
            $('#masthead').find('.menu-toggle').focus();
        }
    });
}
else {
    $('#primary-menu').find("li").unbind('keydown');
}

$(window).resize(function() {
    if( $(window).width() < 1024 ) {
        $('#primary-menu').find("li").last().bind( 'keydown', function(e) {
            if( e.which === 9 ) {
                e.preventDefault();
                $('#masthead').find('.menu-toggle').focus();
            }
        });

        $('#primary-menu > li:last-child button:not(.active)').bind( 'keydown', function(e) {
            if( e.which === 9 ) {
                e.preventDefault();
                $('#masthead').find('.menu-toggle').focus();
            }
        });
    }
    else {
        $('#primary-menu').find("li").unbind('keydown');
    }
});

primary_menu_toggle.on('keydown', function (e) {
        var tabKey    = e.keyCode === 9;
        var shiftKey  = e.shiftKey;
        if( primary_menu_toggle.hasClass('active') ) {
            if ( shiftKey && tabKey ) {
                e.preventDefault();
                primary_nav_menu.slideUp();
                primary_menu_toggle.removeClass('active');
            };
        }
    });

});


