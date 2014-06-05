<?php

/**
 * Author: Sandeep Raul
 * This file is defined to store application UI contents as key/value pair in English language
 * This file will have any text that is shown on the page (exception of data retreived from database)
 * For example: Page titles/headings, lables of fields/buttons, success, error and information messages etc
 */

// ----------- Heading/titles/labels/help/tootip etc - begin success messages with prefix 'lable'
// Format: type.feature.fieldname
// Do not create multiple copies. Try to use same key throught app. If a different value is required only then define it separately

// ------------ General lables
$lang['lable.action'] 				= "Action";
$lang['lable.list'] 				= "List";
$lang['lable.title'] 				= "Title";
$lang['lable.name'] 				= "Name";
$lang['lable.status'] 				= "Status";

// ------------ Feature headings
$lang['lable.dashboard'] 			= "Dashboard";
$lang['lable.posting'] 				= "Posting";
$lang['lable.user'] 				= "User";
$lang['lable.brand'] 				= "Brand";
$lang['lable.locations'] 			= "Countries";
$lang['lable.categories'] 			= "Categories";
$lang['lable.giftcard'] 			= "GiftCard";



// ----------- Information/Warning messages - begin error messages with prefix 'info'
$lang['info.duplicate.category'] 			= "This Category name already exists. Try another.";
$lang['info.duplicate.subCategory'] 		= "This Subcategory name already exists. Try another.";
$lang['info.duplicate.subCategory.type'] 	= "This Subcategory Type name already exists. Try another.";
$lang['info.duplicate.country']				= "This Country name already exists. Try another.";
$lang['info.duplicate.state'] 				= "This State name already exists. Try another.";
$lang['info.duplicate.city'] 				= "This City name already exists. Try another.";
$lang['info.duplicate.area'] 				= "This Area name already exists. Try another.";
$lang['info.duplicate.brand'] 				= "This Brand name already exists. Try another.";

// ----------- links - begin with prefix 'link'
$lang['link.add'] 							= "Add New";
$lang['link.edit'] 							= "Edit";
$lang['link.delete'] 						= "Delete";

// ----------- Button labels - begin success messages with prefix 'button'
$lang['button.search'] 						= "Search";

// ----------- Success messages - begin success messages with prefix 'success'
$lang['success.add'] 			= "Add Successful";
$lang['success.edit'] 			= "Edit Successful";
$lang['success.delete'] 		= "Delete Successful";

// ----------- Error messages - begin error messages with prefix 'error'
$lang['error.add'] 				= "Add Failed";
$lang['error.edit'] 			= "Edit Failed";
$lang['error.delete'] 			= "Delete Failed";





/* End of file properties_lang.php */