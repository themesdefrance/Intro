<?php
//starts a table form wrapper
function cocoricoFormTableStartShorthand($cocorico){
	$cocorico->startWrapper('form-table');
}
CocoDictionary::register(CocoDictionary::SHORTHAND, 'startForm', 'cocoricoFormTableStartShorthand');

//ends a table form wrapper
function cocoricoFormTableEndShorthand($cocorico){
	$cocorico->endWrapper('form-table');
}
CocoDictionary::register(CocoDictionary::SHORTHAND, 'endForm', 'cocoricoFormTableEndShorthand');

//input field in a table
function cocoricoSettingShorthand($cocorico, $params){
	$params = array_merge(array(
		'labeless'=>false,
		'filters'=>array(),
	), $params);
	
	$cocorico->startWrapper('tr');
	
	$cocorico->startWrapper('th');
	
	if (in_array($params['type'], array('radio', 'checkbox')) || $params['labeless']){
		$cocorico->component('raw', $params['label']);
	}
	else{
		$cocorico->component('label', $params['name'], $params['label']);
	}
	
	$cocorico->endWrapper('th');
	
	$cocorico->startWrapper('td');
	
	$ui = null;
	switch ($params['type']){
		case 'radio':
			if (!isset($params['options'])) $params['options'] = array();
			$ui = $cocorico->component('radio', $params['name'], $params['radios'], $params['options']);
			break;
		case 'select':
			if (!isset($params['options'])) $params['options'] = array();
			$ui = $cocorico->component('select', $params['name'], $params['selects'], $params['options']);
			break;
		case 'checkbox':
			if (!isset($params['options'])) $params['options'] = array();
			$ui = $cocorico->component('checkbox', $params['name'], $params['checkboxes'], $params['options']);
			break;
		default:
			if (!isset($params['options'])) $params['options'] = array();
			$ui = $cocorico->component($params['type'], $params['name'], $params['options']);
			break;
	}
	
	$ui->filter('stripslashes');
	
	foreach ($params['filters'] as $filter){
		$ui->filter($filter);
	}
	
	$ui->filter('save', $params['name']);
	
	if (isset($params['description'])){
		$cocorico->component('description', $params['description']);
	}
	
	$cocorico->endWrapper('td');
	
	$cocorico->endWrapper('tr');
}
CocoDictionary::register(CocoDictionary::SHORTHAND, 'setting', 'cocoricoSettingShorthand');

function cocoricoGroupHeader($cocorico, $tabNames){
	$cocorico->startWrapper('group-header');
	
	foreach ($tabNames as $tab=>$name){
		if (!is_string($tab)) $tab = $name;
		$cocorico->component('link', '#'.$tab, $name, array('class'=>'nav-tab'));
	}
	
	$cocorico->endWrapper('group-header');
}
CocoDictionary::register(CocoDictionary::SHORTHAND, 'groupHeader', 'cocoricoGroupHeader');