<?php
//save to wordpress options
function cocoricoSaveFilter($value){//$name=null, $component
	@list($name, $component) = array_slice(func_get_args(), 1);
	if (!$component){
		$component = $name;
		$name = $component->getName();
	}
	
	$component->getStore()->set($name, $value);
	return $value;
}
CocoDictionary::register(CocoDictionary::FILTER, 'save', 'cocoricoSaveFilter');

//strips backslahes
function cocoricoStripSlashFilter($value){
	if (is_array($value)){
		foreach ($value as &$val){
			$val = stripslashes($val);
		}
	}
	else{
		$value = stripslashes($value);
	}
	
	return $value;
}
CocoDictionary::register(CocoDictionary::FILTER, 'stripslashes', 'cocoricoStripSlashFilter');

//nonce validation
function cocoricoNonceFilter($value, $action, $component){
	$result = wp_verify_nonce($value, $action);
	
	if (!$result) $component->preventFilters();
	return $value;
}
CocoDictionary::register(CocoDictionary::FILTER, 'nonce', 'cocoricoNonceFilter');