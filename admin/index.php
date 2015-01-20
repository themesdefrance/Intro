<?php
/**
 * The template for displaying theme options using the Cocorico Framework
 *
 * @package Intro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @link 		https://github.com/y-lohse/Cocorico
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; ?>

<h2 style="font-size: 23px;font-weight: 400;padding: 9px 15px 4px 0px;line-height: 29px;">
	<?php _e('Intro Settings', 'intro'); ?>
</h2>

<?php

// Create a new set of options
$form = new Cocorico(INTRO_COCORICO_PREFIX);

// Registering tabs
$form->groupHeader(array('general'=>__('General', 'intro'),
						 'addons'=>__('Addons', 'intro')));

// General tab
$form->startWrapper('tab', 'general');

	$form->startForm();
		
		$form->setting(array('type'=>'text',
					 'name'=>substr(INTRO_LICENSE_KEY, strlen(INTRO_COCORICO_PREFIX)),
					 'label'=>__("License", 'intro'),
					 'description'=>__('Purchase a licence key in order to receive Intro updates and get access to support. Then paste it in the field above.', 'intro') . '<br><br><a href="https://www.themesdefrance.fr/themes/intro/#acheter?utm_source=theme&utm_medium=licenselink&utm_campaign=intro" target="_blank" class="button button-primary">' . __('Get Intro updates & support', 'intro') . '</a>'));
					 
	
		$form->setting(array('type'=>'color',
					 'name'=>'color',
					 'options'=>array(
					 	'default'=>'#ff625b'
					 ),
					 'label'=>__("Main color", 'intro'),
					 'description'=>__('This color will be used across your website for buttons, links, etc.', 'intro')));

		$form->setting(array('type'=>'upload',
					 'name'=>'logo',
					 'label'=>__('Logo', 'intro'),
					 'description'=>__("Upload a logo to display in the header (if you don't have a logo, the name of your website will be displayed instead).", 'intro')));

		$form->setting(array('type'=>'boolean',
					 'name'=>'show_sidebar',
					 'options'=>array(
					 	'default'=>true
					 ),
					 'label'=>__("Sidebar", 'intro'),
					 'description'=>__("Display a sidebar on the content's right across your website.", 'intro')));
					 
		$form->setting(array('type'=>'textarea',
					 'name'=>'footer_left',
					 'label'=>__("Footer", 'intro'),
					 'description'=>__('Left footer content. The following HTML tags are allowed : &lt;a href=&quot;LINK&quot;&gt;TEXT_LINK&lt;/a&gt;, &lt;strong&gt;BOLD_TEXT&lt;/strong&gt;, &lt;em&gt;ITALIC_TEXT&lt;/em&gt;, &lt;img src=&quot;IMAGE_URL&quot;&gt;.', 'intro'),
					 'options'=>array(
					 	'default'=>sprintf(__('<strong>%s</strong> - Intro by <a href="https://www.themesdefrance.fr/" target="_blank">Themes de France</a>', 'intro'),date('Y'))
					 	)));
					 
		$form->setting(array('type'=>'textarea',
					 'name'=>'custom_css',
					 'label'=>__('Additionnal CSS', 'intro'),
					 'description'=>__('CSS rules added in this field will be added to your site. If you have too many updates, you should download and install the Intro child theme from', 'intro') . ' <a href="https://www.themesdefrance.fr/" target="_blank">' . __('your Themes de France account', 'intro') . '</a>.'));

	$form->endForm();
	
$form->endWrapper('tab');

// Addons tab
$form->startWrapper('tab', 'addons');

	$form->startForm();
	
		$form->startWrapper('td');
		
			$form->component('raw', __('Do you know that Intro can be extended with addons ? Check the addons available below :', 'intro'));
		
		$form->endWrapper('td');
	
	$form->endForm();
	
	$form->startForm();
		
		// Action to hook from addons
		do_action('intro_addons_tab', $form);
	
	$form->endForm();

$form->endWrapper('tab');

$form->component('submit', 'submit', array('value'=>__('Save changes', 'intro')));

$form->render();

?>

<div style="margin-top:20px;">
	<?php $status = get_option('intro_license_status'); ?>
	
	<?php if($status):
		
			_e('Any questions on Intro ? Go to the','intro'); ?> <a href="https://www.themesdefrance.fr/support/?utm_source=theme&utm_medium=supportlink&utm_campaign=intro" target="_blank"><?php _e('Themes de France support page.','intro'); ?></a>
			
	<?php else:
		
			_e('In order to get support, you need to purchase','intro'); ?> <a href="https://www.themesdefrance.fr/themes/intro/#acheter?utm_source=theme&utm_medium=supportlink&utm_campaign=intro" target="_blank"><?php _e('the full version.','intro'); ?></a>
				
	<?php endif;
			
		 _e('If you like Intro, you should','intro'); ?>, <a href="https://www.facebook.com/ThemesDeFrance" target="_blank"><?php _e('follow us on Facebook','intro'); ?></a>.

</div>