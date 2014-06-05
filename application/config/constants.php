<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Defined by Sandeep Raul - for application
 * Rule - Define contant name with capital letter and separate every word with underscore (_). 
 * Define its value in sentence case. In case, if you want to show them on UI, define them as it is to be shown on UI.
 * Always use defined constant for comparision, html form input values, never use MAGIC NUMBERS (hard-coded values)
 * Exception - in some cases, you can define values in any format.
 * 
 */


// Application
define("APP_BACKEND", "be"); 
define("APP_FRONTEND", "fe"); 

//Define URI SEGMENT uniform positions, For example URI SEGMENTS for State feature is as given below:
//URI Position 	=> 	[1] 		[2]			[3] 		[4] 	[5] 		[6] 		[7] 		[8] 			[9] 		
//State listing	=> 	backend		category	listing		id		otherIds	sortOrder	sortField	searchFlag		limitOffset
define("URI_CONTROLLER_FOLDER", 1); 	
define("URI_CONTROLLER_CLASS", 2); 	
define("URI_CONTROLLER_METHOD", 3); 	
define("URI_ID", 4); 		 // indicates record's id (primary key)
define("URI_OTHER_PARAMS", 5);  // indicates other parameter values (one or more). Multiple values can be sent over by joing them 
							 // with DASH "-" as single parameter. For example: 5-9-15  (here each id will indicate something, which can be internally handled) 
							 // Upon receiving it can be parsed to obtain actual id values. 
define("URI_SORT_ORDER", 6); // asc or desc 			
define("URI_SORT_FIELD", 7); // field number
define("URI_SEARCH_FLAG", 8); // sff or sft -> search flag false or search flag true			
define("URI_LIMIT_OFFSET", 9);  // offset indicates query limit used for paging 	 	

//#################### Define codes for database operations
define("DEFAULT_ID", 0); // This id will be used for listing records
define("DEFAULT_OTHER_PARAMS", 0); // Multiple values can be sent using DASH Separator. For example: E.g.: 101, 101-203, 101-203-104 etc
define("RECORDS_PER_PAGE_BE", 20); // BE - backend
define("RECORDS_PER_PAGE", 20);
define("NAME_MIN_LENGTH", 2);
define("NAME_MAX_LENGTH", 100);
define("THUMB_SMALL_SIZE", 150); // used in listing 
define("THUMB_MEDIUM_SIZE", 300); // used in photo gallery
define("THUMB_LARGE_SIZE", 700); // used to display original image (bigger view)
define("SEARCH_FLAG_TRUE", "sft"); 
define("SEARCH_FLAG_FALSE", "sff"); 
define("SORT_ASC_ORDER", "asc"); 
define("SORT_DESC_ORDER", "desc"); 
define("DEFAULT_SORT_FIELD", 0); 
define("DEFAULT_SORT_ORDER", "asc"); 
define("DEFAULT_SEARCH_FLAG", SEARCH_FLAG_FALSE); 
define("DEFAULT_LIMIT_OFFSET", 0); 

// Define default record ID values for category, subcate, country, state, city etc
define("DEFAULT_CATEGORY_ID", 1); 
define("DEFAULT_SUB_CATEGORY_ID", 1); 
define("DEFAULT_SUB_CATEGORY_TYPE_ID", 1); 
define("DEFAULT_COUNTRY_ID", 1); // Default country id -  India 
define("DEFAULT_STATE_ID", 1); // Default state id -  Goa
define("DEFAULT_CITY_ID", 1); // Default city id -  Panjim 
define("DEFAULT_AREA_ID", 1); // Default area id -  Bus stand 

// Define codes
define("OPR_LIST", "List");
define("OPR_ADD", "Add");
define("OPR_EDIT", "Edit");
define("OPR_DELETE", "Delete");
define("OPR_SEARCH", "Search");
define("OPR_SUCCESS", "Success");
define("OPR_FAILED", "Failed");
define("PARAM_LISTING", "Listing Parameter");
define("PARAM_ADD", "Paging Parameter");
//define("PARAM_SORTING", "Sorting Parameter");
//define("PARAM_OTHER", "Other Parameter");

// Define constants for string used in comparisions
define("ACTIVE", "active"); //Note: this value is defined in database tables.
define("INACTIVE", "inactive"); //Note: this value is defined in database tables.
define("DISABLED", "disabled"); //Note: this value is defined in database tables.

//General
define("OTHER", "Other");
define("BOTH", "Both");
define("MAIN", "Main");
define("SUB", "Sub");
define("PHONE", "Phone");
define("EMAIL", "Email");
define("PHONE_EMAIL", "phone_email"); //Note: this value is defined in post_contact table. 
define("USER", "User");
define("ADMIN", "Admin");
define("SUPER_ADMIN", "superadmin"); //Note: this value is defined in database in user table. Change to this value, will also require change in database or viceversa.
define("MALE", "Male");
define("FEMALE", "Female");

// Constants defined for ThaiPoll Application //

//POLL 
define('SELECT_TYPE','select_type');
define('CHOOSE_CAT','choose_cat');
define('ENTER_POLL_DETAILS','poll_details');
define('ADD_QUESTION','add_question');
define('CREATE','create');


//QUESTION
define('SCALE_LABEL_1','Strongly Agree');
define('SCALE_LABEL_2','Strongly DisAgree');


/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in

| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */