<?php
class Validate
{
	private $_passed = false,
			$_errors = array(),
			$_db = null;
	public function __construct()
	{
		$this->_db = DB::getInstance();
	}
	public function check($source, $items = array())
	{
		foreach($items as $item => $rules)
		{
			foreach($rules as $rule => $rule_value)
			{
				//This displays each rule in Validate()
				//echo "{$item} {$rule} must be {$rule_value} <br />";
				$value = trim($source[$item]);
				$item = escape($item);
				if($rule === 'required' && empty($value))
				{
					$this->addError("{$item} is required.");
					//item is now going to == field name of that value
					// add a name to be displayed in the register validate()
				}
				// Check each rule in register.php
				else if(!empty($value))
				{
					switch($rule)
					{
						case 'minimum':
							if(strlen($value) < $rule_value)
							{
								$this->addError("{$item} must be a minimum of {$rule_value} characters.");
							}
						break;
						case 'maximum':
						if(strlen($value) > $rule_value)
							{
								$this->addError("{$item} must be a maximum of {$rule_value} characters.");
							}
						break;
						case 'matches':
							if($value != $source[$rule_value])
							{
								$this->addError("This {$rule_value} must match {$item}.");
							}
						break;
						case 'unique':
							$check = $this->_db->get($rule_value, array($item, '=', $value));
							if($check->count())
							{
								$this->addError("{$item} already exists.");
							}
						break;
						default:
						break;
					}
				}
			}
		}
		if(empty($this->_errors))
		{
			$this->_passed = true;
		}
		return $this;
	}
	private function addError($error)
	{
		$this->_errors[] = $error;
	}
	public function errors()
	{
		return $this->_errors;
	}
	public function passed()
	{
		return $this->_passed;
	}
}
?>