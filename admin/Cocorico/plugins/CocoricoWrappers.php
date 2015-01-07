<?php
function cocoricoFormWrapper($content){
	$output = '<form method="post">';
	$output .= $content;
	$output .= '</form>';
	return $output;
}
CocoDictionary::register(CocoDictionary::WRAPPER, 'form', 'cocoricoFormWrapper');

function cocoricoFormTableWrapper($content){
	$output = '<table class="form-table">';
	$output .= $content;
	$output .= '</table>';
	return $output;
}
CocoDictionary::register(CocoDictionary::WRAPPER, 'form-table', 'cocoricoFormTableWrapper');

function cocoricoTableRowWrapper($content){
	$output = '<tr valign="top">';
	$output .= $content;
	$output .= '</tr>';
	return $output;
}
CocoDictionary::register(CocoDictionary::WRAPPER, 'tr', 'cocoricoTableRowWrapper');

function cocoricoTableCellWrapper($content){
	$output = '<td>';
	$output .= $content;
	$output .= '</td>';
	return $output;
}
CocoDictionary::register(CocoDictionary::WRAPPER, 'td', 'cocoricoTableCellWrapper');

function cocoricoTableHeaderWrapper($content){
	$output = '<th scope="row">';
	$output .= $content;
	$output .= '</th>';
	return $output;
}
CocoDictionary::register(CocoDictionary::WRAPPER, 'th', 'cocoricoTableHeaderWrapper');

function cocoricoGroupHeaderWrapper($content){
	$output = '<h2 class="nav-tab-wrapper">';
	$output .= $content;
	$output .= '</h2>';
	return $output;
}
CocoDictionary::register(CocoDictionary::WRAPPER, 'group-header', 'cocoricoGroupHeaderWrapper');

function cocoricoTabWrapper($content, $id){
	$output = '<div class="cocorico-tab-wrapper" id="'.$id.'">';
	$output .= $content;
	$output .= '</div>';
	return $output;
}
CocoDictionary::register(CocoDictionary::WRAPPER, 'tab', 'cocoricoTabWrapper');
