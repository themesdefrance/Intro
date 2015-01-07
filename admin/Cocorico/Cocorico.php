<?php

if (!defined('COCORICO_PATH')){
	define('COCORICO_PATH', str_replace('\\', '/', dirname(__FILE__)));
	
	//autoload cocorico core
	foreach (array('core', 'plugins') as $dir){
		foreach (glob(COCORICO_PATH.'/'.$dir.'/*.php') as $file){
			require_once $file;
		}
	}
	
	if (!function_exists('cocorico_enqueue')){
		function cocorico_enqueue(){
			//Cocorico is supposed to be dropped in a plugin or a theme-get the url either way
			if (strpos(COCORICO_PATH, str_replace('\\', '/', get_theme_root())) === 0){
				$rootlessPath = substr(COCORICO_PATH, strlen(get_theme_root()));
				$coco_path = get_theme_root_uri().str_replace('\\', '/', $rootlessPath);
			}
			else{
				$url = plugin_dir_url(__FILE__);
				$coco_path = substr($url, 0, strlen($url)-1);
			}
			
			wp_register_script('cocorico', $coco_path.'/frontend/cocorico.js', array('jquery'), '1', true);
			wp_enqueue_script('cocorico');

			wp_enqueue_style('wp-color-picker');
			wp_enqueue_script('wp-color-picker');
			
			wp_enqueue_media();
		}
	}
	add_action('admin_enqueue_scripts', 'cocorico_enqueue');
}

//load local extensions
$localCocoPath = dirname(__FILE__);

foreach (glob($localCocoPath.'/extensions/*', GLOB_ONLYDIR) as $extension){
	foreach (glob($extension.'/*.php') as $file){
		require_once $file;
	}
}