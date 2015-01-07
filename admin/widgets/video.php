<?php
/**
 * Display a video from Youtube, Dailymotion or Vimeo
 *
 * @package Intro
 * @subpackage Widgets
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */
?>

<?php
	
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class IntroVideo extends WP_Widget{
	
	/**
	 * Error checking
	 *
	 * @var bool
	 *
	 * @since 1.0
	 */
	private $error = false;
	
	/**
	 * Do we have a video ?
	 *
	 * @var bool
	 *
	 * @since 1.0
	 */
	private $novideo = false;
	
	/**
	 * Initializes the object instance
	 *
	 * @since 1.0
	 * @return void
	 */
	public function __construct(){
		parent::__construct(
		
			'IntroVideo',
			__('Intro - Video', 'intro'),
			array('description'=>__('Add a video from Youtube, Dailymotion or Vimeo.', 'intro'))
		);
	}
	
	/**
	 * Display the widget on the website
	 *
	 * @param array $args     Display arguments including before_title, after_title,
	 *                        before_widget, and after_widget.
     * @param array $instance The settings for the particular instance of the widget.
     *
	 * @since 1.0
	 * @return void
	 */
	public function widget($args, $instance){
	
		echo $args['before_widget'];
		?>
				<?php if (isset($instance['title']) && !empty($instance['title'])){
						echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
				} ?>
				
				<?php if (isset($instance['video_link']) && $instance['video_link']!=""){ ?>
				
					<div class="widget-video">
						<?php echo wp_oembed_get($instance['video_link'], array('width'=>287)); ?>
					</div>
					
				<?php }else{ ?>
					
					<p><?php _e('To display a video, please add a Youtube, Dailymotion or Vimeo URL in the widget settings.', 'intro'); ?></p>
				
				<?php } ?>
			
		<?php
		echo $args['after_widget'];
	}
	
	/**
	 * Display the widget form
	 *
     * @param array $instance The settings for the particular instance of the widget.
     *
	 * @since 1.0
	 * @return void
	 */
	public function form($instance){
		
		if ($this->error){
			echo '<div class="error">';
			_e('Please enter a valid url', 'intro');
			echo '</div>';
		}
		
		if ($this->novideo){
			echo '<div class="error">';
			_e('This video url doesn\'t seem to exist.', 'intro');
			echo '</div>';
		}
		
		$fields = array("title" => "", "video_link" => "");
		
		if ( isset( $instance[ 'title' ] ) ) {
			$fields['title'] = $instance[ 'title' ];
		}
	
		if ( isset( $instance[ 'video_link' ] ) ) {
			$fields['video_link'] = $instance[ 'video_link' ];
		}
		
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'intro' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $fields['title'] ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'video_link' ); ?>"><?php _e( 'Video URL (Youtube, Dailymotion or Vimeo):', 'intro' ); ?></label> 
			<input  class="widefat" id="<?php echo $this->get_field_id( 'video_link' ); ?>" name="<?php echo $this->get_field_name( 'video_link' ); ?>" type="url" value="<?php echo esc_attr( $fields['video_link'] ); ?>">
		</p>
		<?php
		
	}
	
	/**
	 * Update the widget settings
	 *
     * @param array $new_instance New settings for this instance as input by the user
     * @param array $old_instance Old settings for this instance.
     *
	 * @since 1.0
	 * @return array Settings to save or bool false to cancel saving.
	 */
	public function update($new_instance, $old_instance){
		
		$new_instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		
		// Check the video link
		if(isset($new_instance['video_link']) && !empty($new_instance['video_link']) && !filter_var($new_instance['video_link'], FILTER_VALIDATE_URL)){
		
			$new_instance['video_link'] = $old_instance['video_link'];
			$this->error = true;
			
		}else{
		
			if(!wp_oembed_get($new_instance['video_link'])){
				$new_instance['video_link'] = $old_instance['video_link'];
				$this->novideo = true;
			}else{
				$new_instance['video_link'] = ( ! empty( $new_instance['video_link'] ) ) ? strip_tags( $new_instance['video_link'] ) : '';
			}
		}
		
		return $new_instance;
	}
}

/**
 * Register the widget in order to make it accessible in the Appearance > Widgets page
 *
 * @since 1.0
 * @return void
 */
if (!function_exists('intro_video_widget_init')){

	function intro_video_widget_init(){
	
		register_widget('IntroVideo');
	}
}
add_action('widgets_init', 'intro_video_widget_init');
