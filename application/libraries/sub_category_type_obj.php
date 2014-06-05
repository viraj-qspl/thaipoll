<?php

class Sub_category_type_obj extends Base_master {

	var $categoryId;
	var $subCategoryId;
	
	function __construct(){
	}

	function getCategoryId(){ return $this->subCategoryId;  }
	function setCategoryId($subCategoryId){ 	$this->subCategoryId = $subCategoryId; 	}	
	
	function getSubCategoryId(){ return $this->subCategoryId;  }
	function setSubCategoryId($subCategoryId){ 	$this->subCategoryId = $subCategoryId; 	}
	
}
/*end of file*/