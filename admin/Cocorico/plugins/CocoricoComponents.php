<?php
//raw text
function cocoricoRawComponent($component){
	return $component->getName();
}
CocoDictionary::register(CocoDictionary::COMPONENT, 'raw', 'cocoricoRawComponent');

//description
function cocoricoDescriptionComponent($component){
	return '<p class="description">'.$component->getName().'</p>';
}
CocoDictionary::register(CocoDictionary::COMPONENT, 'description', 'cocoricoDescriptionComponent');

//link
function cocoricoLinkComponent($component, $content, $options=array()){
	$output = '<a';
	
	$attrs = array(
		'href'=>$component->getName(),
	);
	foreach ($options as $attr=>$value){
		switch ($attr){
			case 'class':
				$attrs['class'] = (is_array($value)) ? implode($value, ' ') : $value;
				break;
			default:
				$attrs[$attr] = $value;
				break;
		}
	}
	
	foreach ($attrs as $name=>$value){
		$output .= ' '.$name.'="'.esc_attr($value).'"';
	}
	
	$output .= '>'.$content.'</a>';
	return $output;
}
CocoDictionary::register(CocoDictionary::COMPONENT, 'link', 'cocoricoLinkComponent');

//nonce
function cocoricoNonceComponent($component, $action, $referer = true){
	return wp_nonce_field($action, $component->getName(), $referer, false);
}
CocoDictionary::register(CocoDictionary::COMPONENT, 'nonce', 'cocoricoNonceComponent');

//label
function cocoricoLabelComponent($component, $label){
	$output = '<label for="'.esc_attr($component->getName()).'">'.$label.'</label>';
	return $output;
}
CocoDictionary::register(CocoDictionary::COMPONENT, 'label', 'cocoricoLabelComponent');

//textarea
function cocoricoTextareaComponent($component, $options=array()){
	$options = array_merge(array(
		'class'=>array('widefat'),
	), $options);
	
	$attrs = array(
		'name'=>$component->getName(),
		'id'=>$component->getName(),
	);
	foreach ($options as $attr=>$value){
		switch ($attr){
			case 'class':
				$attrs['class'] = (is_array($value)) ? implode($value, ' ') : $value;
				break;
			default:
				$attrs[$attr] = $value;
				break;
		}
	}
	
	$output = '<textarea ';
	foreach ($attrs as $name=>$value){
		$output .= ' '.$name.'="'.esc_attr($value).'"';
	}
	
	$output .= '>'. (!is_array($component->getValue())? $component->getValue() : '') .'</textarea>';
	
	return $output;
}
CocoDictionary::register(CocoDictionary::COMPONENT, 'textarea', 'cocoricoTextareaComponent');

//single general input
function cocoricoInputComponent($component, $options=array()){
	$options = array_merge(array(
		'type'=>'text',
		'class'=>array(),
		'name'=>$component->getName(),
		'id'=>$component->getName(),
	), $options);
	
	if ($component->getValue()) $value = $component->getValue();
	else if (isset($options['default'])) $value = $options['default'];
	
	//core attributes
	$attrs = array();
	if (isset($value)) $attrs['value'] = $value;
	
	//optionnal attributes
	foreach ($options as $attr=>$value){
		switch ($attr){
			case 'class':
				$attrs['class'] = (is_array($value)) ? implode($value, ' ') : $value;
				break;
			case 'default':
				break;
			default:
				$attrs[$attr] = $value;
				break;
		}
	}
	
	$output = '<input';
	foreach ($attrs as $name=>$value){
		$output .= ' '.$name.'="'.esc_attr($value).'"';
	}
	$output .= ' />';
	
	return $output;
}
CocoDictionary::register(CocoDictionary::COMPONENT, 'input', 'cocoricoInputComponent');

//text input
function cocoricoTextComponent($component, $options=array()){
	$options = array_merge(array(
		'type'=>'text',
	), $options);
	return cocoricoInputComponent($component, $options);
}
CocoDictionary::register(CocoDictionary::COMPONENT, 'text', 'cocoricoTextComponent');

//url input
function cocoricoURLComponent($component, $options=array()){
	$options = array_merge(array(
		'type'=>'url',
	), $options);
	return cocoricoInputComponent($component, $options);
}
CocoDictionary::register(CocoDictionary::COMPONENT, 'url', 'cocoricoURLComponent');

//email input
function cocoricoNumberComponent($component, $options=array()){
	$options = array_merge(array(
		'type'=>'number',
	), $options);
	return cocoricoInputComponent($component, $options);
}
CocoDictionary::register(CocoDictionary::COMPONENT, 'number', 'cocoricoNumberComponent');

//number input
function cocoricoEmailComponent($component, $options=array()){
	$options = array_merge(array(
		'type'=>'email',
	), $options);
	return cocoricoInputComponent($component, $options);
}
CocoDictionary::register(CocoDictionary::COMPONENT, 'email', 'cocoricoEmailComponent');

//boolean input
function cocoricoBooleanComponent($component, $options=array()){
	$name = $component->getName();
	$value = ($component->getValue() === false && isset($options['default'])) ? $options['default'] : $component->getValue();
	
	$output = '';
	
	$output .= '<input type="hidden" name="'.$name.'" value="0" />';
	$output .= '<input type="checkbox" name="'.$name.'" id="'.$name.'" value="1" '.(($value) ? 'checked="checked"' : '').' />';
	
	return $output;
}
CocoDictionary::register(CocoDictionary::COMPONENT, 'boolean', 'cocoricoBooleanComponent');

//submit button
function cocoricoSubmitComponent($component, $options=array()){
	$options = array_merge(array(
		'type'=>'submit',
		'class'=>array('button', 'button-primary'),
		'default'=>__('Save all changes')
	), $options);
	return cocoricoInputComponent($component, $options);
}
CocoDictionary::register(CocoDictionary::COMPONENT, 'submit', 'cocoricoSubmitComponent');

//radio button set
function cocoricoRadioComponent($component, $radios, $options=array()){
	$options = array_merge(array(
		'before'=>'',
		'after'=>''
	), $options);
	
	$output = '';
	$selected = (!$component->getValue() && isset($options['default'])) ? $options['default'] : $component->getValue();

	foreach ($radios as $value=>$label){
		$output .= $options['before'];
		$output .= '
		<label>
			<input type="radio" name="'.$component->getName().'" value="'.$value.'" '.(($selected == $value) ? 'checked="checked"' : '').' />
			'.$label.'
		</label>
		';
		$output .= $options['after'];
	}

	return $output;
}
CocoDictionary::register(CocoDictionary::COMPONENT, 'radio', 'cocoricoRadioComponent');

//select 
function cocoricoSelectComponent($component, $selects, $options=array()){
	$output = '<select name="'.$component->getName().'">';
	$selected = (!$component->getValue() && isset($options['default'])) ? $options['default'] : $component->getValue();

	foreach ($selects as $value=>$label){
		$output .= '
			<option type="radio" value="'.$value.'" '.(($selected == $value) ? 'selected' : '').'>
			'.$label.'</option>
		';
	}
	$output .= '</select>';
	
	return $output;
}
CocoDictionary::register(CocoDictionary::COMPONENT, 'select', 'cocoricoSelectComponent');

//checkbox button set
function cocoricoCheckboxComponent($component, $checkboxes, $options=array()){
	$options = array_merge(array(
		'before'=>'',
		'after'=>''
	), $options);
	
	$output = '';
	$selected = (!$component->getValue() && isset($options['default'])) ? $options['default'] : $component->getValue();
	if (!$selected) $selected = array();
	
	foreach ($checkboxes as $value=>$label){
		$output .= $options['before'];
		$output .= '
		<label>
			<input type="checkbox" name="'.$component->getName().'[]" value="'.$value.'" '.((in_array($value, $selected)) ? 'checked="checked"' : '').' />
			'.$label.'
		</label>
		';
		$output .= $options['after'];
	}

	return $output;
}
CocoDictionary::register(CocoDictionary::COMPONENT, 'checkbox', 'cocoricoCheckboxComponent');

//color picker
function cocoricoColorComponent($component, $options=array()){
	$options = array_merge(array(
		'type'=>'text',
		'class'=>array('cocorico-colorpicker'),
		'default'=>'#333',
	), $options);
	return cocoricoInputComponent($component, $options);
}
CocoDictionary::register(CocoDictionary::COMPONENT, 'color', 'cocoricoColorComponent');

function cocoricoUploadComponent($component, $options=array()){
	$value = (isset($options['value'])) ? $options['value'] : $component->getValue();
	$options = array_merge(array(
		'type'=>'text',
		'class'=>array('cocorico-upload')
	), $options);
	
	$output = '';
	$output .= cocoricoInputComponent($component, $options);
	$output .= '<input type="button" class="button cocorico-upload-button" value="'.__('Select').'" />';
	
	if ($value){
		$matches = array();
		preg_match('/\.[a-zA-Z]+$/', $value, $matches);
		$extension = $matches[0];
		$iconUrl = includes_url().'images/crystal/';

		switch ($extension){
			case '.jpg':
			case '.png':
			case '.jpeg':
			case '.gif':
			case '.ico':
				$src = $value;
				break;
			case '.txt':
			case '.md':
				$src = $iconUrl.'text.png';
				break;
			case '.js':
			case '.php':
			case '.html':
			case '.css':
				$src = $iconUrl.'code.png';
				break;
			case '.zip':
			case '.rar':
			case '.7z':
				$src = $iconUrl.'archive.png';
				break;
			default:
				$src = $iconUrl.'default.png';
				break;
		}
	}
	else{
		$src = '';
	}
	
	$output .= '
		<div class="cocorico-preview-wrapper attachment" style="float: none; '.(($value) ? '' : 'display: none;').'">		
			<div class="attachment-preview" style="width: 150px; height: 150px; cursor: auto;">
				<img src="'.$src.'" alt="'.$component->getName().'" class="cocorico-preview icon" style="max-width: 100%; max-height: 80%;position: absolute; top:0; left: 0;">
				
				<div class="filename">
					<div class="submitbox">
						<a href="#" class="cocorico-remove submitdelete">'.__('Delete').'</a>
					</div>
				</div>			
			</div>
		</div>
	';
	
	return $output;
}
CocoDictionary::register(CocoDictionary::COMPONENT, 'upload', 'cocoricoUploadComponent');
