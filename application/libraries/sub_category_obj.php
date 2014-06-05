<?php


class Sub_category_obj extends Base_master {

	var $categoryId;
	
	function __construct(){
	}

		
	function setCategoryId($categoryId){
		$this->categoryId = $categoryId;		
	}
	function getCategoryId(){
		return $this->categoryId;		
	}
	
}
/*end of file*/