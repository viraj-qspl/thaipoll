<?php


class pollCategory_obj {

	var $id;
	var $category_name;
	
	private $data = array();
	

	
	function __construct(){	}
	
	public function __call($index,$value)					// Use magic method to get and set variables
	{
		if(substr($index,0,3) == 'set')
		{
			$varName = lcfirst(substr($index,3));			
			$this->$varName = $value[0];
		
		}
		elseif( substr($index,0,3) == 'get')
		{
			$varName = lcfirst(substr($index,3));
			return $this->$varName;							
		}
	
	
	}
}	
/*end of file*/