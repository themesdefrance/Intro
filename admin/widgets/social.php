<?php
/**
 * Display social networking links
 *
 * @package Intro
 * @subpackage Widgets
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */
	
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class IntroSocial extends WP_Widget{
	
	/**
	 * Social networks available
	 *
	 * @var array
	 *
	 * @since 1.0
	 */
	private $reseaux = array(
		'facebook'=>'social-facebook',
		'twitter'=>'social-twitter',
		'youtube'=>'social-youtube',
		'google-plus'=>'social-google-plus',
		'vimeo'=>'social-vimeo',
		'linkedin'=>'social-linkedin',
		'pinterest'=>'social-pinterest',
		'instagram'=>'social-instagram',
		'dribbble'=>'social-dribbble',
		'rss'=>'rss'
	);
	
	/**
	 * Error checking
	 *
	 * @var bool
	 *
	 * @since 1.0
	 */
	private $error = false;
	
	/**
	 * How many fields have to be displayed by default
	 *
	 * @var int
	 *
	 * @since 1.0
	 */
	private $hideAfter = 3;
	
	/**
	 * Initializes the object instance
	 *
	 * @since 1.0
	 * @return void
	 */
	public function __construct(){
		parent::__construct(
			'IntroSocial',
			__('Intro - Social', 'intro'),
			array('description'=>__('Display links to your social profiles.', 'intro'),)
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
		
		if (isset($instance['title']) && !empty($instance['title'])){
			echo $args['before_title'].apply_filters('widget_title', $instance['title']).$args['after_title'];
		}
		
		echo '<ul>';
		
		foreach ($this->reseaux as $reseau=>$icon){
			if (isset($instance[$reseau]) && !empty($instance[$reseau])){
				?>
				<li>
					<a href="<?php echo $instance[$reseau]; ?>" title="<?php echo $reseau; ?>" class="typcn typcn-<?php echo $icon; ?>" target="_blank">
						
					</a>
				</li>
				<?php
			}
		}
		
		echo '</ul>';
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
		$fields = array_merge(array('title'), array_keys($this->reseaux));
		
		echo '<style>';
		include 'widgets.css';
		echo '</style>';
		echo '<script>';
		include 'widgets.js';
		echo '</script>';
		
		if ($this->error){
			echo '<div class="error">';
			_e('Please enter a valid url', 'intro');
			echo '</div>';
		}
		
		//verifie si les reseaux masqués par défaut ont une valeur
		$open = '';
		foreach ($instance as $reseau){
			if (in_array($reseau, array_slice($fields, $this->hideAfter+1))) $open = 'open';
		}
		
		foreach ($fields as $count=>$field){
			if ($count === $this->hideAfter+1):?>
			<div>
				<a href="#" class="introsocial-toggle-link">
				</a>
				<h4>
					<?php _e('More networks', 'intro'); ?>
				</h4>
			</div>
			<div class="introsocial-toggle <?php echo $open; ?>">
			<?php endif; ?>
			
			<?php $value = (isset($instance[$field])) ? $instance[$field] : ''; ?>
			<p>
				<label for="<?php echo $this->get_field_id($field); ?>">
					<?php echo ($field == 'title' ? __('Title','intro') : ucfirst(str_replace("-"," ",$field)) ) . ':'; ?>
				</label> 
				
				<input class="widefat" id="<?php echo $this->get_field_id($field); ?>" name="<?php echo $this->get_field_name($field); ?>" type="url" value="<?php echo esc_attr($value); ?>" />
			</p>
			<?php
		}
		echo '</div>';//closing more div
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
		
		foreach ($this->reseaux as $reseau){
			if (isset($new_instance[$reseau]) && !empty($new_instance[$reseau]) && !filter_var($new_instance[$reseau], FILTER_VALIDATE_URL)){
				$new_instance[$reseau] = $old_instance[$reseau];
				$this->error = true;
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
if (!function_exists('intro_widgets_init')){
	function intro_widgets_init(){
		register_widget('IntroSocial');
	}
}
add_action('widgets_init', 'intro_widgets_init');