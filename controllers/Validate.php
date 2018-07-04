<?php
Class Validate{
	private $_passed = false,
			$_errors = array(),
			$_db = null;

	public function __construct(){
		$this->_db = Db::getInstance();
	}

	public  function  check($source, $items = array()){
		foreach($items as $item=> $rules)
		{	
			foreach($rules as $rule=> $ruleValue)
			{
				$value = $source[$item]; // value of the item assigned in validate/check array on view page
				//echo 'testing '; print_r($item);
				if($rule === 'required' && empty($value))
				{
					$this->addError("{$item} item is required!");
				}
				else if($rule ==='min' && strlen($value)< $rules['min']) {
					$this->addError("{$item} must have {$rules['min']} characters!");
				}
				else if($rule ==='max' && strlen($value)> $rules['max']) {
					$this->addError("{$item} maximum {$rules['max']} characters allowed!");
				}

			}
		}
		if(empty($this->_errors))
		{
			$this->_passed = true;
		}
		return $this;
	}
	private function addError($error){
		$this->_errors[] = $error;
	}
	public function errors(){
		return $this->_errors;
	}
	public function passed()
	{
		return $this->_passed;
	}
}