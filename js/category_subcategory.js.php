
<script type="text/javascript">

	$(document).ready(function(){

		// On category selection, populate sub-categories			
		$("#categoryId").change(function(){
			//alert("something is changed");
			var categoryId = $("#categoryId").val();
			
			//first remove all existing elements
			$("#subCategoryId").empty();
			
			//Now, make ajax call and populate list
			  $.ajax({
					url:"<?php echo $this->config->item('subCategoryBeAction').'/getList'; ?>", 
					type: "POST",
					data: "categoryId="+categoryId,
					dataType: "json",	
					success:function(resultData){
						//alert(resultData);
						$("#subCategoryId").append(new Option("--Subcategory--", "0"));
						for(var i=0; i<resultData.length ;i++){
							//alert(resultData[i].name);
							// $("#subCategoryId").append(new Option("text", "value"));	
							 $("#subCategoryId").append(new Option(resultData[i].name, resultData[i].id));																								
						}							
					}}
				);								
		});
	});//end of document.ready

</script>
	
