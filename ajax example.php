
============ View page ==============

// -------------- AJAX ------------------

	$(document).ready(function(){
		$('#deleteSelected').click(function() {

			var selectedIds = document.getElementById("selectedIds").value;
			var deleteAction = document.getElementById("deleteAction").value;
						
			if (selectedIds != ""){
				
				$.ajax({
					url : deleteAction,
					type : 'POST',
					dataType : 'text',
					data: {ids : selectedIds},
					success : function(retData){
						;// do nothing
					},
					error : function(XMLHttpRequest, textStatus, errorThrown) {}
				});

				return false;

			}//end if
		});
		
	});
	
	
	
============ Controller page ==============

// This function deletes the user selected record
	function delete()	
	{	
		//read inputs		
		$ids = $this->input->post("ids");  //ids will be comma separated. For example: 123,124,125
				
		// Set operation type
		$viewArr['oprType'] = OPR_DELETE;
		
		if (!empty($ids)){
			// Execute query
			$queryFlag = $this->category_model->delete($ids);
			
			// Send status and message to view
			$viewArr['oprStatus'] 	= ($queryFlag == true) ? OPR_SUCCESS : OPR_FAILED;		
			$viewArr['message'] 	= ($queryFlag == true) ? "Delete Successful" : "Delete Failed"  ;		
							
			// Write operation details to log file	
			log_message('info', ( $queryFlag == true ? "Category delete successful" : "Error in deleting category" ) ); 														
		}
			
		// Show listing page, send the $viewArr for further processing
		$this->listing($viewArr);
		
		echo "";
				
	}
	
	




