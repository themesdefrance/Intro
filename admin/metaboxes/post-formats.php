<?php
/**
 * Intro post formats metaboxes registering
 *
 * @package Intro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit; 

/**
 * Register post formats metaboxes
 *
 * @since 1.0
 * @return void
 */
if(!function_exists('intro_add_meta_boxes')){
	function intro_add_meta_boxes(){
		add_meta_box(
					'intro_link',
					__('Link', 'intro'),
					'intro_link_callback',
					 'post',
					 'normal',
					 'high'
					 );
					 
		add_meta_box(
					'intro_quote',
					__('Quote', 'intro'),
					'intro_quote_callback',
					 'post',
					 'normal',
					 'high'
					 );
		
		add_meta_box(
					'intro_video',
					__('Video', 'intro'),
					'intro_video_callback',
					 'post',
					 'normal',
					 'high'
					 );
	}
}
add_action('admin_init', 'intro_add_meta_boxes');


/**
 * Link format callback functtion using the Cocorico Framework
 *
 * @link 		https://github.com/y-lohse/Cocorico
 * @since 1.0
 * @return void
 */
if(!function_exists('intro_link_callback')){
	function intro_link_callback( $post ) {
	
		$form = new Cocorico(INTRO_COCORICO_PREFIX, false);
		$form->startForm();
		
		$form->setting(array('type'=>'url',
						 'name'=>'_link_meta',
						 'label'=>__('Link to feature', 'intro'),
						 'description' => __('Add a link to feature for this post. You\'re free to talk about it in the post content.','intro')
						 )
					  );
		
		$form->endForm();
		$form->render();
	}
}

/**
 * Quote format callback functtion using the Cocorico Framework
 *
 * @link 		https://github.com/y-lohse/Cocorico
 * @since 1.0
 * @return void
 */
if(!function_exists('intro_quote_callback')){
	function intro_quote_callback( $post ) {
		
		$form = new Cocorico(INTRO_COCORICO_PREFIX, false);
		$form->startForm();
		
		$form->setting(array('type'=>'text',
						 'name'=>'_quote_meta',
						 'label'=>__('Quote to feature', 'intro'),
						 'description' => __('Add some wise words and talk about it in the post content.','intro')
						 )
					  );
		
		$form->setting(array('type'=>'text',
						 'name'=>'_quote_author_meta',
						 'label'=>__('Quote author (optional)', 'intro'),
						 'description' => __('Be nice and don\'t forget to credit the quote author.','intro')
						 )
					  );
		
		$form->endForm();
		$form->render();
		
	}
}

/**
 * Video format callback functtion using the Cocorico Framework
 *
 * @link 		https://github.com/y-lohse/Cocorico
 * @since 1.0
 * @return void
 */
if(!function_exists('intro_video_callback')){
	function intro_video_callback( $post ) {
	
		$form = new Cocorico(INTRO_COCORICO_PREFIX, false);
		$form->startForm();
		
		$form->setting(array('type'=>'url',
						 'name'=>'_video_meta',
						 'label'=>__('Video to feature', 'intro'),
						 'description' => __('Add a video link from Youtube, Dailymotion or Vimeo.','intro')
						 )
					  );
		
		$form->endForm();
		$form->render();
	}
}

/**
 * Show the right metabox for each post format
 *
 * @since 1.0
 * @return void
 */
if(!function_exists('intro_display_metaboxes')){
	function intro_display_metaboxes() {
	
	    if ( get_post_type() == "post" ){ ?>
	    
	        <script>
	            jQuery(document).ready(function($) {
	            
		            // Set variables
		            var link_radio = $('#post-format-link'),
		            	quote_radio = $('#post-format-quote'),
		            	video_radio = $('#post-format-video'),
		            	link_metabox = $('#intro_link'),
		            	quote_metabox = $('#intro_quote'),
		            	video_metabox = $('#intro_video'),
		            	all_formats = $('#post-formats-select input');
			            
		            hideAllMetaBoxes();
		            
		            all_formats.change( function() {
					    
				        hideAllMetaBoxes();
				
				        if( $(this).val() == 'link' ) {
							link_metabox.show();
						}
						else if( $(this).val() == 'quote' ) {
						    quote_metabox.show();
						} 
						else if( $(this).val() == 'video' ) {
							video_metabox.show();
						} 
				
					});
				
				    if(link_radio.is(':checked'))
				        link_metabox.show();
				
				    if(quote_radio.is(':checked'))
				        quote_metabox.show();
				        
				    if(video_radio.is(':checked'))
						video_metabox.show();
		            
		            
		            function hideAllMetaBoxes(){
			            link_metabox.hide();
			            quote_metabox.hide();
			            video_metabox.hide();
		            }
	            });
	        </script>
	        
	<?php
		}
	}
}
// Add inline js in admin
add_action( 'admin_print_scripts', 'intro_display_metaboxes',1000);