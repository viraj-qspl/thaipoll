<style type="text/css">
	.question_type_box {
		width:400px;
		height:400px;
	}

</style>

<div id="content" style="margin:auto;width:80%;">
	<?php
		if($action == SELECT_TYPE)
		{?>
			<div><a href="<?php echo $this->config->item('base_url').'/poll/createPoll/SCRATCH'; ?>">Create from Scratch</a></div>
			<div><a href="<?php echo $this->config->item('base_url').'/poll/createPoll/TEMPLATE'; ?>">Create from Template</a></div>	
		<?php 
		}
		elseif($action == ENTER_POLL_DETAILS)
		{

			echo validation_errors(); 
			$options = array();

			foreach($pollCategories as $key=>$value)
				$options[$value->id] = $value->category_name;

			
		
		
			echo form_open_multipart('poll/save',array('name'=>'poll_details'),array('oprType'=>$oprType)) . '<br/><br/>';
			
			echo '<label>Image:</label>' . form_input(array('name'=>'image','type'=>'file')) ;
			
			if(trim($recordObj->getImage())!='')
				echo "Previous Image:<img height='100' src='".$this->config->item('base_url').'/uploads/'.$recordObj->getImage()."' />";
			
			echo "<br/><br/>";

			echo '<label>Title:</label>' . form_input(array('name'=>'title','value'=>$recordObj->getTitle())) . '<br/><br/>';
			
			echo '<label>Category:</label>' . form_dropdown('pollCategory_id',$options,$recordObj->getPollCategory_id())  . '<br/><br/>';
			
			echo '<label>Survey Description:</label>' . form_textarea(array('name'=>'descp','value'=>$recordObj->getDescp())) . '<br/><br/>';
			
			if(trim($recordObj->getImage())!='')
				echo form_hidden('upl_image', $recordObj->getImage());
		
			echo form_submit('mysubmit', 'Submit');
		
			form_close();
		
		}
		elseif($action == CREATE) {
			
			echo "<a href='".$this->config->item('base_url')."/poll/createPoll/ADD_QUESTION/".$poll_id."'>Add Questions</a>";	
				// existing question to be displayed here
			echo "<a href='".$this->config->item('base_url')."/poll/createPoll/ADD_SKIP_LOGIC/".$poll_id."'>Add Skip flow logic</a>";	
				
				
			
		
		}
		elseif($action == ADD_QUESTION) {
		
			echo form_open('poll/addQuestion',array('name'=>'add_question'));
			echo "<label>Question Name:</label>".form_input(array('name'=>'question','id'=>'question'));
			echo "<label>Required:</label>";
			echo "Yes: ".form_radio(array('name'=>'required','value'=>'Y'));
			echo "No: ".form_radio(array('name'=>'required','value'=>'N'));

			?>

				
				<div id="single" style="display:inline;" class="question_type">SINGLE</div> | <div style="display:inline;" id="multiple" class="question_type" >MULTIPLE</div> | <div style="display:inline;" id="scale" class="question_type" >SCALE</div> | <div style="display:inline;" id="text" class="question_type" >TEXT</div> 
				
				
				
				
				
				<div id="single_box" class="question_type_box" style="display:none;">	<!-- Single options box -->
				<?php 
					echo form_input(array('name'=>'sng[]','id'=>'sng_option_1','value'=>'Yes'))."<br/>";
					echo form_input(array('name'=>'sng[]','id'=>'sng_option_2','value'=>'No'));
					echo form_hidden('sng_opt_count',2);
					echo "<div id='sng_add_option'>Add Option</div><br/>";
					echo "Allow Text";				
					echo "Yes:".form_radio(array('name'=>'sng_allow_text','value'=>'Y'));
					echo "No:".form_radio(array('name'=>'sng_allow_text','value'=>'N','checked'=>'checked'));
				?>
				</div>
				
				<div id="multiple_box" class="question_type_box" style="display:none;">		<!-- Multiple options box -->
				<?php
					echo form_input(array('name'=>'mlt[]','id'=>'mlt_option_1','value'=>'Yes'))."<br/>";
					echo form_input(array('name'=>'mlt[]','id'=>'mlt_option_2','value'=>'No'));
					echo form_hidden('mlt_opt_count',2);
					echo "<div id='mlt_add_option'>Add Option</div><br/>";
					echo "Allow Text";					
					echo "Yes:".form_radio(array('name'=>'mlt_allow_text','value'=>'Y'));
					echo "No:".form_radio(array('name'=>'mlt_allow_text','value'=>'N','checked'=>'checked'));
				?>	
				</div>
				
				<div id="scale_box" class="question_type_box" style="display:none;">		<!-- scale options box -->
				<?php
					echo form_input(array('name'=>'scl[]','id'=>'scl_option_1','value'=>'1'))."&nbsp;&nbsp;&nbsp;".form_input(array('name'=>'scl_label[]','id'=>'scl_label_1','value'=>SCALE_LABEL_1))."<br/>";
					echo form_input(array('name'=>'scl[]','id'=>'scl_option_2','value'=>'5'))."&nbsp;&nbsp;&nbsp;".form_input(array('name'=>'scl_label[]','id'=>'scl_label_2','value'=>SCALE_LABEL_2))."<br/>";
					echo "Sub Question title";
					echo form_hidden('scl_sub_ques_count',0); //scl_sub_ques stored question
					echo "<div id='scl_add_ques'>Add Sub Question</div>";	
				?>
				
				
				</div>
				<div id="text_box" class="question_type_box" style="display:none;">			<!-- Text Box -->
					<div id="text_text" >
					TEXT
					</div>
					<div id="text_number"> 
						NUMBER
						<div id="text_number_box" style="display:none;">
							<?php
								echo "<span>Minimum Value</span>".form_input(array('name'=>'min_value','value'=>0))."<br/>";
								echo "<span>Maximum Value</span>".form_input(array('name'=>'max_value','value'=>100));
							?>
						</div>
					</div>
					<?php echo form_hidden('txt_type',''); ?>
				</div>

			<?php
				echo form_hidden(array('type'=>''));
				echo form_hidden(array('poll_id'=>$poll_id));
				
				echo form_submit('Submit','Submit');
				
				
			echo form_close(); // Some minor changes
			
		}
	?>
<div style="clear:both;"></div>	
</div><div style="clear:both;"></div>
<script type="text/javascript" >
	
	
	
	$(document).ready(function()
	{
	
		
		$('.question_type').click(function(){
			
			id = $(this).attr('id');
			$('.question_type_box').css('display','none');
			$('div[id="'+id+'_box'+'"]').css('display','block');
			$("input[name='type']").val(id.toUpperCase());
			

		});
		
		$('#text_text').click(function(){
			$('#text_number_box').css('display','none');
			$('input[name="txt_type"]').val('TEXT');
		});

		$('#text_number').click(function(){
			$('#text_number_box').css('display','block');
			$('input[name="txt_type"]').val('NUMBER');
		})		
	
	})


</script>


