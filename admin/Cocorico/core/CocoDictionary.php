<?php
class CocoDictionary{

	const COMPONENT = 'component';
	const FILTER = 'filter';
	const WRAPPER = 'wrapper';
	const SHORTHAND = 'shorthand';
	
	protected static $register = array();
	
	public static function register($type='component', $aliases, $fn, $priority=0){
		if (!is_array($aliases)) $aliases = array($aliases);
		if (!isset(CocoDictionary::$register[$type])) CocoDictionary::$register[$type] = array();
		
		foreach ($aliases as $alias){
			if (!array_key_exists($alias, CocoDictionary::$register[$type])) CocoDictionary::$register[$type][$alias] = array();
			CocoDictionary::$register[$type][$alias][$priority] = $fn;
		}
	}
	
	public static function translate($alias, $type='component'){		
		if (array_key_exists($type, CocoDictionary::$register) && array_key_exists($alias, CocoDictionary::$register[$type])){
			return end(CocoDictionary::$register[$type][$alias]);
		}
		else{
			//@TODO exeception
			return false;
		}
	}
}