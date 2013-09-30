// If JavaScript is enabled remove 'no-js' class and give 'js' class
jQuery('html').removeClass('no-js').addClass('js');

// Add .osx class to html if on Os/x
if ( navigator.appVersion.indexOf("Mac")!=-1 ) 
	jQuery('html').addClass('osx');

// When DOM is fully loaded
jQuery(document).ready(function($) {

	(function() {

	/* --------------------------------------------------------	
		Twitter bootstrap - carousel, tooltip, popover 
	   --------------------------------------------------------	*/	

		// initialize carousel
		$('[rel=carousel]').carousel()
		// initialize tooltip
		$('[rel=tooltip]').tooltip();
		// initialize popover
		$('[rel=popover]').popover();


	    $('.accordion').on('show', function (e) {
	         $(e.target).prev('.accordion-heading').find('.accordion-toggle').addClass('active');
	    });

	    $('.accordion').on('hide', function (e) {
	        $(this).find('.accordion-toggle').not($(e.target)).removeClass('active');
	    });


	/* --------------------------------------------------------	
		External links
	   --------------------------------------------------------	*/	

	    $(window).load(function() {

			$('a[rel=external]').attr('target','_blank');
			
		});

	})();



/* --------------------------------------------------------	
	Flickr feed
   --------------------------------------------------------	*/	

	(function() {

		$('.flickr-feed').each(function(){

			var flickr_id 	   = $(this).data('flickr-id'),
				flickr_limit   = $(this).data('flickr-limit')	? $(this).data('flickr-limit') 		: 12,
				flickr_tags    = $(this).data('flickr-tags')   	? $(this).data('flickr-tags') 		: '',
				flickr_tagmode = $(this).data('flickr-tagmode')	? $(this).data('flickr-tagmode')	: 'any';

			$(this).jflickrfeed({

				limit: flickr_limit,
				qstrings: {
					id: flickr_id,
					tags: flickr_tags,
					tagmode: flickr_tagmode
				},
				itemTemplate: '<a href="{{link}}" rel="external"><img src="{{image_s}}" alt="{{title}}" /></a>'

			});
		})

	})();

/* --------------------------------------------------------	
	Zoom and link overlays (e.g. for thumbnails)
   --------------------------------------------------------	*/	

	(function() {

		$(window).load(function() {

			$('.link').each(function(){
				var $this = $(this);
				var $height = $this.find('img').height();
				var span = $('<span>').addClass('link-overlay').html('&nbsp;').css('top',$height/2).click(function(){
					if (href = $this.find('a:first').attr('href')) {
						top.location.href=href;
					}
				});
				$this.append(span);
			})
			$('.zoom').each(function(){
				var $this = $(this);
				var $height = $this.find('img').height();
				var span = $('<span>').addClass('zoom-overlay').html('&nbsp;').css('top',$height/2);
				$this.append(span);
			})

		});

	})();

/* --------------------------------------------------------	
	Responsible navigation
   --------------------------------------------------------	*/	
	
	(function() {

		var $mainNav    = $('.navbar .nav'),
			responsibleNav = '<option value="" selected>Navigate...</option>';

		// Responsive nav
		$mainNav.find('li').each(function() {
			var $this   = $(this),
				$link = $this.children('a'),
				depth   = $this.parents('ul').length - 1,
				indent  = '';

			if( depth ) {
				while( depth > 0 ) {
					indent += ' - ';
					depth--;
				}
			}

			if ($link.text())
				responsibleNav += '<option ' + ($this.hasClass('active') ? 'selected="selected"':'') + ' value="' + $link.attr('href') + '">' + indent + ' ' + $link.text() + '</option>';

		}).end().after('<select class="nav-responsive">' + responsibleNav + '</select>');

		$('.nav-responsive').on('change', function() {
			window.location = $(this).val();
		});
			
	})();


/* --------------------------------------------------------	
	Portfolio 
   --------------------------------------------------------	*/	

   (function() {

		$(window).load(function(){

			// container
			var $container = $('#portfolio-items');

			function filter_projects(tag)
			{
			  // filter projects
			  $container.isotope({ filter: tag });
			  // clear active class
			  $('li.active').removeClass('active');
			  // add active class to filter selector
			  $('#portfolio-filter').find("[data-filter='" + tag + "']").parent().addClass('active');
			  // update location hash
			  if (tag!='*')
				window.location.hash=tag.replace('.','');
			  if (tag=='*')
			  	window.location.hash='';
			}

			if ($container.length) {

				// conver data-tags to classes
				$('.project').each(function(){
					$this = $(this);
					var tags = $this.data('tags');
					if (tags) {
						var classes = tags.split(',');
						for (var i = classes.length - 1; i >= 0; i--) {
							$this.addClass(classes[i]);
						};
					}
				})

				// initialize isotope
				$container.isotope({
				  // options...
				  itemSelector : '.project',
				  layoutMode   : 'fitRows'
				});

				// filter items
				$('#portfolio-filter li a').click(function(){
					var selector = $(this).attr('data-filter');
					filter_projects(selector);
					return false;
				});

				// filter tags if location.has is available. e.g. http://example.com/work.html#design will filter projects within this category
				if (window.location.hash!='')
				{
					filter_projects( '.' + window.location.hash.replace('#','') );
				}
			}
		})

	})();


/* --------------------------------------------------------	
	Back to top button
   --------------------------------------------------------	*/	

	(function() {

   			$('<i id="back-to-top"></i>').appendTo($('body'));

			$(window).scroll(function() {

				if($(this).scrollTop() != 0) {
					$('#back-to-top').fadeIn();	
				} else {
					$('#back-to-top').fadeOut();
				}

			});
			
			$('#back-to-top').click(function() {
				$('body,html').animate({scrollTop:0},600);
			});	

	})();



/* --------------------------------------------------------	
	Keyboard shortcuts
   --------------------------------------------------------	*/	

   (function() {

		$('a[rel=shortcut]').each(function(){

			var $this = $(this);
			var key = $this.data('key');
			var href = $this.attr('href');

			if (key && href) {
				$(document).bind('keydown', key, function(){
					top.location.href = href;
				});
			}
		})

	})();


})