<?php
class CocoRequest{
	
	private static $requests = array();
	private static $restored = array();
	
	public static function request($name){
		array_push(CocoRequest::$requests, $name);
		
		if (isset(CocoRequest::$restored[$name])){
			return CocoRequest::$restored[$name];
		}
		else{
			return false;
		}
	}
	
	public static function restore(){
		$stored = get_option('cocostore_values');
		if (!$stored) $stored = serialize(array());
		CocoRequest::$restored = array_merge(unserialize($stored), $_POST);
		update_option('cocostore_values', serialize(array()));//clears the cache
	}
	
	public static function backup(){
		$names = unserialize(get_option('cocostore_names'));
		$values = array();
		
		if (is_array($names)){
			foreach ($names as $name){
				if ($name && array_key_exists($name, $_POST)) $values[$name] = $_POST[$name];
			}
		}
		
		update_option('cocostore_values', serialize($values));
//		remove_action('shutdown', array('CocoStore', 'prepareBackup'));
	}
	
	public static function prepareBackup(){
		if (count(CocoRequest::$requests) === 0) return;
		
		$ser = serialize(CocoRequest::$requests);
		update_option('cocostore_names', $ser);
	}
	
}
add_action('init', array('CocoRequest', 'restore'));
add_action('save_post', array('CocoRequest', 'backup'));
add_action('shutdown', array('CocoRequest', 'prepareBackup'));