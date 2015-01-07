<?php
class CocoComponent{
	
	protected $renderFn;
	protected $name;//html sense of name
	protected $store;
	protected $value = null;
	protected $runFilters = true;
	
	public function __construct($name, $renderFn, $store){
		$this->name = $name;
		$this->renderFn = $renderFn;
		$this->store = $store;
		
		//get the requested value for the filters
		if ($this->value === null){
			$this->value = CocoRequest::request($this->name);
		}
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function getValue(){
		return $this->value;
	}
	
	public function getStore(){
		return $this->store;
	}
	
	public function render($args){
		//get the stored value, because the filter ran by now
		$this->value = $this->store->get($this->name);
		array_unshift($args, $this);
		return call_user_func_array($this->renderFn, $args);
	}
	
	public function preventFilters(){
		$this->runFilters = false;
	}
	
	public function filter($filter){
		//run through the filters
		if ($this->runFilters !== false){
			$args = array_slice(func_get_args(), 1);
			array_unshift($args, $this->value);
			array_push($args, $this);
			$filterFn = CocoDictionary::translate($filter, 'filter');
			$this->value = call_user_func_array($filterFn, $args);
		}
		
		return $this;
	}
}