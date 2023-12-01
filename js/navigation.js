/**
 * navigation.js
 *
 * add 4 first posts to each second level category
 * show then on hover
 */
( function() {
	var timeout;
	
	jQuery( document ).ready(function() {
		
		addPostToMenu();
		bindUIactions();
		jQuery('.sticky').Stickyfill();		
	});
		
	// bind ui actions	
	function bindUIactions(){
		// menu posts
		jQuery('.ubermenu-item-level-1').hover(
			function(){
				jQuery(this).find('.container-menuPost').addClass('open');
			},function(){
				jQuery(this).find('.container-menuPost').removeClass('open');
			}
		);	
		
		// menu search form
		jQuery('.menu-social-item.menu-search').hover(
			  function() {
				clearTimeout(timeout);
				jQuery(this).find('#menu-searchform').addClass('open');
			  }, function() {
				timeout = setTimeout(function(){
					  jQuery('#menu-searchform').removeClass('open');
				}, 200);
			  }				
		);	
		jQuery('#menu-searchform').hover(
			function() {
				clearTimeout(timeout);
			}, function() {
				timeout = setTimeout(function(){
					  jQuery('#menu-searchform').removeClass('open');
			}, 200);
				
		});				
	}

	// add Post To Menu	
	function addPostToMenu(){
		var cat=[];
		jQuery.ajax({
			url: ajaxurl,
			data: "action=getMenuItems",
			type: "POST",
			success: function(data) {
				var posts = jQuery.parseJSON( data );
				//console.log(posts);
				jQuery.each(posts.result, function() {
					cat.push(this.cat);
					//console.log(this.content);
				});
				jQuery.each(jQuery('.ubermenu-item-level-1'), function() {
					var ul = jQuery('<ul/>')
							.addClass('container-menuPost')
							.appendTo(jQuery(this));
					id = jQuery(this).attr('id').split("-").pop();
					if(jQuery.inArray(id, cat)){
						for(var i =0; i<posts.result.length ; i++){							
							if(posts.result[i].cat == id){
								var li = jQuery('<li/>')
										.addClass('menuPost')
										.html(posts.result[i].content)
										.appendTo(ul);
							}
						}
						
					}	
					if(jQuery(this).is(':first-child')) {
						ul.addClass('default');
					}  
				});
				bindUIactions();
			},
			error: function() {
				console.log('Cannot retrieve data.');
			}
		});			
	}
	
} )();
