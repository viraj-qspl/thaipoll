
<script type="text/javascript">
	$(document).ready(function(){

		// on Country selection, populate its states			
		$("#countryId").change(function(){
			var countryId = $("#countryId").val();

			//first remove all existing elements
			$("#stateId").empty();
			
			//Now, make ajax call and populate list
			  $.ajax({
					url:"<?php echo $this->config->item('stateGetListBeAction'); ?>", 
					type: "POST",
					data: "countryId="+countryId,
					dataType: "json",   // "text",	
					success:function(resultData){									
						$("#stateId").append(new Option("--Select--", "0"));
						for(var i=0; i<resultData.length ;i++){
							 $("#stateId").append(new Option(resultData[i].name, resultData[i].id));																								
						}
													
					}}
				);								
		});

		// on State selection, populate its Cities			
		$("#stateId").change(function(){
			var stateId = $("#stateId").val();
			
			//first remove all existing elements
			$("#cityId").empty();
			
			//Now, make ajax call and populate list
			  $.ajax({
					url:"<?php echo $this->config->item('cityGetListBeAction'); ?>", 
					type: "POST",
					data: "stateId="+stateId,
					dataType: "json",	
					success:function(resultData){
						//alert(resultData);
						
						$("#cityId").append(new Option("--Select--", "0"));
						for(var i=0; i<resultData.length ;i++){
							 $("#cityId").append(new Option(resultData[i].name, resultData[i].id));																								
						}
													
					}}
				);								
		});

		
		// on City selection, populate its area'			
		$("#cityId").change(function(){
			var cityId = $("#cityId").val();
			
			//first remove all existing elements
			$("#areaId").empty();
			
			//Now, make ajax call and populate list
			  $.ajax({
					url:"<?php echo $this->config->item('areaGetListBeAction'); ?>", 
					type: "POST",
					data: "cityId="+cityId,
					dataType: "json",	
					success:function(resultData){
						//alert(resultData);
						
						$("#areaId").append(new Option("--Area--", "0"));
						for(var i=0; i<resultData.length ;i++){
							 $("#areaId").append(new Option(resultData[i].name, resultData[i].id));																								
						}
													
					}}
				);								
		});
				
	});
	
</script>
	
