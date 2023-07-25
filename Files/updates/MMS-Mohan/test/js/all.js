var $Page, wHeight, wWidth;
var pc = true; var device = true; var ltIE = false;

$(function () {

    $Page = (function () {

        $el = {
            header: $('header'),
            footer: $('footer'),
            nav: $('#nav')
        },
        init = function () {
            detectBrowser();
            size();
            events();
            language();

            $("#loadLogo").fadeTo(200, 1);
        },
        size = function () {
            wHeight = $(window).height();
            wWidth = $(window).width();
            headerHeight = $("#header").outerHeight();
        },
        events = function () {
            if (!$.support.transition)
                $.fn.transition = $.fn.animate;


            var path = location.pathname;
            var home = "/";
            $("a[href='" + [path || home] + "']").each(function () {
                $(this).addClass("current");
            });
            var a = path.indexOf('lookbook');
            if (a != -1) {
                $("a.lookbookNav").addClass("current");
            }

            if (wWidth >= 1024) {
                $(document).on("mouseover", ".open-sub", function () {
                    $(this).find(".submenu").fadeIn('fast');
                }).on("mouseleave", ".open-sub", function () {
                    $(this).find(".submenu").fadeOut('fast');
                });
            }

            $(document).on("click", ".open-nav", function (e) {
                e.preventDefault();
                if ($("nav").is(":hidden")) {
                    $("nav").show().transition({ right: 0 }, 400);
                }
                else {
                    $("nav").transition({ right: "-50%" }, 400, function () {
                        $(this).hide();
                    });
                }
            });
        },
        language = function () {
            if (lang == "it") {
                $(".lang-it").addClass("active");
            }
            else {
                $(".lang-en").addClass("active");
            }
        },
        waiting = function () {
            var waitInterval;
            this.show = function () {
                waitInterval = setInterval(function () {
                    $(".wait").stop(true, true).fadeIn(1000);
                    $(".wait").delay(800).stop(true, true).fadeOut(800);
                }, 1000);
            };

            this.hide = function () {
                $(".wait").hide();
                clearInterval(waitInterval);
            };
        },
        wait = new waiting(),
        detectBrowser = function () {
            if ((navigator.userAgent.indexOf('iPhone') == -1 && navigator.userAgent.indexOf('iPod') == -1 && navigator.userAgent.indexOf('iPad') == -1 && navigator.userAgent.indexOf('Android') == -1)) {
                pc = true;
                device = false;

                if ($("body").hasClass("ie8")) {
                    ltIE = true;
                }
                else {
                    ltIE = false;
                }
            }
            else {
                pc = false;
                device = true;
            }
        },
        headerAnimate = function (delay) {
            setTimeout(function () {
                $(".sx-header,.dx-header").transition({ rotateY: 0, opacity: 1 }, 700, function () {
                    $(".header-section").css("z-index", "50");
                });
            }, delay);
        };
        return { init: init, size: size, header: headerAnimate, wait: wait };
    })();


    $Page.init();

    $(window).resize(function () {
        $Page.size();
    });



});
