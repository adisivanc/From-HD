/* ==========================================================
 * ie-bootstrap-carousel.js v2.2.2
 * https://github.com/tybruffy/ie-bootstrap-carousel
 * ==========================================================
 * Forked from bootstrap-transition.js v2.2.2
 * http://twitter.github.com/bootstrap/javascript.html#transitions
 *   and
 * http://twitter.github.com/bootstrap/javascript.html#carousel
 * ==========================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */


!function ($) {

	"use strict"; // jshint ;_;


	/* CSS TRANSITION SUPPORT (http://www.modernizr.com/)
	 * ======================================================= */

	$(function () {

		$.support.transition = (function () {

			var transitionEnd = (function () {

				var el = document.createElement('bootstrap')
					, transEndEventNames = {
							 'WebkitTransition' : 'webkitTransitionEnd'
						,  'MozTransition'    : 'transitionend'
						,  'OTransition'      : 'oTransitionEnd otransitionend'
						,  'transition'       : 'transitionend'
						}
					, name

				for (name in transEndEventNames){
					if (el.style[name] !== undefined) {
						return transEndEventNames[name]
					}
				}

			}())

			return transitionEnd && {
				end: transitionEnd
			}

		})()

	})

}(window.jQuery);
!function ($) {

	"use strict"; // jshint ;_;


 /* CAROUSEL CLASS DEFINITION
	* ========================= */
	
	var Carousel = function (element, options) {
    this.$element = $(element)
    this.options = options
    this.options.slide && this.slide(this.options.slide)
    this.options.pause == 'hover' && this.$element
      .on('mouseenter', $.proxy(this.pause, this))
      .on('mouseleave', $.proxy(this.cycle, this))

    if ( !!this.options.pills ) {
      this.$pills = $('<span class="carousel-pills" />').appendTo(this.$element);
      this.pills();
    }
  }
  
  
  
	
	
	

	/*var Carousel = function (element, options) {
		this.$element = $(element)
		this.options = options
		this.options.pause == 'hover' && this.$element
			.on('mouseenter', $.proxy(this.pause, this))
			.on('mouseleave', $.proxy(this.cycle, this))
	}*/

	Carousel.prototype = {
		
		pills: function () {
      var self = this
        , pills = ""
        , numImages = this.$element.find(".item").length;

      for ( var i = 0; i < numImages; i += 1) {
        pills += "<span></span>";
      }

      this.$pills.html(pills).find(":first-child").addClass("active-pill");

      this.$pills.on('click', 'span', function () {
        var image = $(this).index();
        self.to(image);
      });
    }
		
		
		
		
		
		

		,cycle: function (e) {
			if (!e) this.paused = false
			this.options.interval
				&& !this.paused
				&& (this.interval = setInterval($.proxy(this.next, this), this.options.interval))
			return this
		}

	, to: function (pos) {
			var $active = this.$element.find('.item.active')
				, children = $active.parent().children()
				, activePos = children.index($active)
				, that = this

			if (pos > (children.length - 1) || pos < 0) return

			if (this.sliding) {
				return this.$element.one('slid', function () {
					that.to(pos)
				})
			}

			if (activePos == pos) {
				return this.pause().cycle()
			}

			return this.slide(pos > activePos ? 'next' : 'prev', $(children[pos]))
		}

	, pause: function (e) {
			if (!e) this.paused = true
			if (this.$element.find('.next, .prev').length && $.support.transition.end) {
				this.$element.trigger($.support.transition.end)
				this.cycle()
			}
			clearInterval(this.interval)
			this.interval = null
			return this
		}

	, next: function () {
			if (this.sliding) return
			return this.slide('next')
		}

	, prev: function () {
			if (this.sliding) return
			return this.slide('prev')
		}

	, slide: function (type, next) {
			var $active = this.$element.find('.item.active')
				, $next = next || $active[type]()
				, isCycling = this.interval
				, direction = type == 'next' ? 'left' : 'right'
				, fallback  = type == 'next' ? 'first' : 'last'
				, that = this
				, e

			this.sliding = true

			isCycling && this.pause()

			$next = $next.length ? $next : this.$element.find('.item')[fallback]()

			e = $.Event('slide', {
				relatedTarget: $next[0]
			})

			if ($next.hasClass('active')) return

			if ($.support.transition && this.$element.hasClass('slide')) {
				this.$element.trigger(e)
				if (e.isDefaultPrevented()) return
				$next.addClass(type)
				$next[0].offsetWidth // force reflow
				$active.addClass(direction)
				$next.addClass(direction)
				this.$element.one($.support.transition.end, function () {
					$next.removeClass([type, direction].join(' ')).addClass('active')
					$active.removeClass(['active', direction].join(' '))
					that.sliding = false
					setTimeout(function () { that.$element.trigger('slid') }, 0)
				})
			} else {
				this.$element.trigger(e)
				if (e.isDefaultPrevented()) return
				$next.addClass(type)
				$next[0].offsetWidth // force reflow
				var transition_prop = $active.css("transition-property")
				,	transition_time = $active.css("transition-duration")
				,	active_obj = {}
				,	next_obj   = {};

				if(typeof transition_prop == 'undefined') {
					var transition = $active.css("transition")
					,	properties = transition.split(",")
					,	settings  = properties.slice(-1)[0].split(" ")
					,	easing = /ease|bezier|linear/i;

					for (var i = 0; i < settings.length; i++) {
						if ( easing.test(settings[i]) ) {
							continue;
						} else if (!isNaN(parseFloat(settings[i])) 
							&& typeof transition_time == 'undefined') {
							transition_time = parseFloat(settings[i]);
						} else {
							transition_prop = settings[i];
						}
					};
				}
				
				if (transition_prop == "opacity") {
					active_obj[transition_prop] = 0;
					next_obj[transition_prop]   = 1;
					$active.css({
						zIndex : 2,
						opacity: 1
					});
					$next.css({
						zIndex : 1,
						opacity: 0
					});
				} else {
					active_obj[transition_prop] = (direction == "left") ? "-100%" : "100%";
					next_obj[transition_prop]   = 0
				}
				transition_time = transition_time*1000;

				$active.animate( active_obj, transition_time );
				$next.animate( next_obj, transition_time, function(){
					$next.removeClass(type).addClass('active').removeAttr("style")
					$active.removeClass('active').removeAttr("style")
					that.sliding = false
					setTimeout(function () { that.$element.trigger('slid') }, 0)
				});
			}

			isCycling && this.cycle()

			return this
		}

	}


 /* CAROUSEL PLUGIN DEFINITION
	* ========================== */

	var old = $.fn.carousel

	$.fn.carousel = function (option) {
		return this.each(function () {
			var $this = $(this)
				, data = $this.data('carousel')
				, options = $.extend({}, $.fn.carousel.defaults, typeof option == 'object' && option)
				, action = typeof option == 'string' ? option : options.slide
			if (!data) $this.data('carousel', (data = new Carousel(this, options)))
			if (typeof option == 'number') data.to(option)
			else if (action) data[action]()
			else if (options.interval) data.cycle()
		})
	}

	$.fn.carousel.defaults = {
		interval: 5000
	, pause: 'hover'
	}

	$.fn.carousel.Constructor = Carousel


 /* CAROUSEL NO CONFLICT
	* ==================== */

	$.fn.carousel.noConflict = function () {
		$.fn.carousel = old
		return this
	}

 /* CAROUSEL DATA-API
	* ================= */

	$(document).on('click.carousel.data-api', '[data-slide]', function (e) {
		var $this = $(this), href
			, $target = $($this.attr('data-target') || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '')) //strip for ie7
			, options = $.extend({}, $target.data(), $this.data())
		$target.carousel(options)
		e.preventDefault()
	})

}(window.jQuery);