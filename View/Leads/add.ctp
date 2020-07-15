<?php 


echo $this->Html->script('jquery.min');

echo $this->Html->script('bootstrap.min');
echo $this->Html->script('alertify.min');
echo $this->Html->script('jquery-ui');

//echo $this->Html->css('bootstrap.min');
echo $this->Html->css('jquery-ui');
echo $this->Html->css('alertify.min');
echo $this->Html->css('cake.generic');
echo $this->Html->css('displaybuttons');

?>
<style>
	body{
		color: black;
	}
	</style>
<button class="btn btn-info btn-lg" style="float:right;margin-right:61px;margin-bottom:3px;margin-top:-13px" onclick="window.location.href='<?php echo Router::url(array('controller'=>'quotes', 'action'=>'buyerquotes'))?>'">Back to Enquiry Quotelists
</button>


<?php

echo $this->Form->create('Quote',array('enctype' => 'multipart/form-data'));

$options=array('panel','panel-primary');
?>

<p></p>

<?php
echo "<div class='panel panel-primary'>
<div class='panel-heading'>Submit Your Anonymous Enquiry Details</div><div class='panel-body'>";

echo $this->Form->label('Who are you Buying For');
$options = array(''=>'Please Select A Value','1' => 'Personal', '0' => 'Business');
echo $this->Form->select('b2c', $options,array('class'=>'form-control col-sm-10','label'=>'Who are you Buying For','id'=>'b2c','default'=>'Personal','empty' => '-select-','style'=>'font-size:14px;padding-top:0px;width:300px'));

echo $this->Form->input('buyingdate', array('label'=>'Iam planning to Buy on or before','type'=>'text','class'=>'form-control','id' =>'datepicker','style' => 'margin:0 0 0 -6px;width:300px'
	));
echo"<p><span id='datepicker_error'></span></p>";	
echo $this->Form->label('Category');
echo $this->Form->select('cat_id',$CategoryList, array('class'=>'form-control','id' =>'cat_id','empty' => 'Select A category','style' => 'margin:0 0 0 3px;width:300px;font-size:14px;padding-top:0px'
	));
echo $this->Html->image('redgif.gif', array('alt' => 'loading', 'id' => 'load-wait-cat'));
	echo $this->Form->input('subcat_id', array('options'=>$SubCategoryList,'label'=>'Subcategory','class'=>'form-control','id' =>'subcat_id','empty' => '-select subcategory-','style' => 'margin:0 0 0 -3px;width:300px;font-size:14px;padding-top:0px'
	));

echo $this->Form->label('Where do you want the quotes from');
echo $this->Form->select('locarea', $CityList,array('class'=>'form-control','id'=>'locarea','default'=>'1','style' => 'margin:0 0 0 3px;width:210px;font-size:14px;padding-top:0px','empty' => '-Select City-'));
echo $this->Html->image('redgif.gif', array('alt' => 'loading', 'id' => 'load-wait-city'));
echo $this->Form->label('Area');
echo $this->Form->select('locradius',$AreaList,array('class'=>'form-control','id'=>'locradius','style' => 'margin:0 0 0 3px;width:210px;font-size:14px;padding-top:0px','label'=>'Area','empty' => '-Select Area-'));

	
	
/*Setting up the hidden values for formid,b2c and enquiry time*/
echo $this->Form->input('enquiry_time',array('type'=>'hidden','value'=>date('Y-m-d H:i:s')));
echo $this->Form->input('formid',array('type'=>'hidden','value'=>1));
echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$User_Id));

echo"<p></p>";
 echo $this->Form->input('attachmenturl',array('id'=>'attachmenturl','type' => 'file','class'=>'form-control ','label'=>'Upload Attachments(Max Size 1MB)','title' => 'Upload only pdfs or jpgs','style' => 'margin:0 0 0 -2px;width:510px;padding-bottom:37px','data-toggle'=>'tooltip'));
echo"<span id='file_error'></span>";

echo $this->Form->label('Share Your Requirements');
echo $this->Form->input('productspec', array('rows' => '3','cols' =>'6','class'=>'form-control','id'=>'productspec','title'=>'Enter Only Alphanumbers','label'=>'','data-toggle'=>'tooltip'));

/*$login=1;
if($login == 1){
	$options=array('id'=>'quotesave','label'=>'Save Enquiry','value'=>'Save Enquiry');
echo $this->Form->end($options);
}
else{
	echo $this->Form->end('Login to Enquiry');
}*/
 if(!empty($User_Id) && !empty($UserStatus)){
 	//echo $User_Id;echo$UserStatus;
 	 ?>
 	 <!--<div  id="load-wait"></div>-->
<div class="submit" style="margin-top: 6px;width:300px"><input id="quotesave" class="btn btn-primary" value="Submit Enquiry" type="submit">
<?php }
else {?>
<div class="submit" style="margin-top: 6px;width:300px">

<a class="btn btn-primary"  
data-toggle="modal" data-target="#login-popup" onclick="loginajax()">SAVE</a>
<?php }?>
 </div>
<?php echo"</div></div>";	
	
?>
 
 <script type="text/javascript">

$(document).ready(function(){
	//$('[data-toggle="tooltip"]').tooltip();//tooltip for prices and offers
    $("#subcat_id").hide();
    $("#load-wait-cat").hide();
    $("#load-wait-city").hide();
	//$("#loding1").hide();
	//$("#loding2").hide();
	$('label[for="subcat_id"]').hide();
	$('[data-toggle="tooltip"]').tooltip();  
	$( "#datepicker" ).datepicker();
    $("#b2c").click(function(){
        if($("#b2c").val()=='0'){$("#subcat_id").show();$('label[for="subcat_id"]').show();}
		 if($("#b2c").val()=='1'){$("#subcat_id").hide();$('label[for="subcat_id"]').hide();}
    });/*Clicking Requirement type list*/
    });
    </script>
    <script>
	/*Display corresponding subcategories based on categories*/
	$("#cat_id").on('change',function(event) {
			var id = $(this).val();
			if(id == ''){

				alertify.alert('Please Select A Category');
				return false;
			}
			
			
           
			$("#subcat_id").find('option').remove();
			if($("#b2c").val()=='0'){
				$("#load-wait-cat").show();
			if (id) {
				var dataString = 'id='+ id;
				
				event.preventDefault();
				$.ajax({
					dataType: 'json',
					type: "POST",
					url: '<?php echo Router::url(array("controller" => "quotes", "action" => "getSubcategories")); ?>' ,
					data: dataString,
					cache: false,
					success: function(data,textStatus,xhr) {
						
						$("#load-wait-cat").hide();
						
						$.each(data, function(key, value) {  
						         
							$('<option>').val('').text('select');
							$('<option>').val(key).text(value).appendTo($("#subcat_id"));
						});
						console.log(key + ":" + value);
					} 
					
				});
			}}
		});
	/*Display corresponding cityareas based on cities*/
		$("#locarea").on('change',function(event) {
			var id = $(this).val();

			if(id == ''){
				alertify.alert('Please Select A City');
				return false;
			}
			$("#load-wait-city").show();
			$("#locradius").find('option').remove();
			event.preventDefault();
			if (id) {
				var dataString = 'id='+ id;
				
				$.ajax({
					dataType: 'json',
					type: "POST",
					url: '<?php echo Router::url(array("controller" => "quotes", "action" => "getAreas")); ?>' ,
					data: dataString,
					cache: false,
					//async:false,
					success: function(data,textStatus,xhr) {
						
						$("#load-wait-city").hide();
                        					
						$.each(data, function(key, value) {  
						       
							$('<option>').val('').text('select');
							$('<option>').val(key).text(value).appendTo($("#locradius"));
						});
						
					} 
					
				});
			}
		});
		

</script>
<script type="text/javascript">
$('input[type=file]').change(function(){
    var file = this.files[0];
    name = file.name;
    size = file.size;
    type = file.type;
	
	if(size > 1048576)	{
		alertify.alert("File Attachment must be less than 1 MB.");
		$("#file_error").css("color","#FF0000");
		$("#file_error").html("File size must be less than 1MB");
		document.getElementById("attachmenturl").value = "";
		//$('form').get(0).reset();
		return false;
	}
	var ext = file.name.split('.').pop().toLowerCase();
	
	if ($.inArray(ext, ['pdf','jpg','jpeg']) == -1) {//if needed add doc,docx
	        $("#file_error").css("color","#FF0000");
		    $("#file_error").html("Please Upload only pdfs or jpgs!");
		    
            alertify.alert('Please Upload only pdfs or jpgs!');
            document.getElementById("attachmenturl").value = "";
			//$('form').get(0).reset();
			return false;
     }
    
});
$('#datepicker').change(function(){
	$("#datepicker_error").text("");
	var buydate=$("#datepicker").val();
	var today=$.datepicker.formatDate('yy-mm-dd', new Date());
	
	if(buydate < today){
		alertify.alert('Please Select a Valid Date');
		 $("#datepicker_error").animate({color: '#FF0000',left:'205px',width: '550px',fontSize: '1.2em'},220);
	    $("#datepicker_error").text("Please Select a Valid Date");
		$('form').get(0).reset();
	    return false;
	}
	
});
$('#productspec').keypress(function(key) {
	
if(((key.charCode < 44 )&&(key.charCode > 32))|| ((key.charCode < 65 )&&(key.charCode > 57))|| ((key.charCode < 48 )&&(key.charCode > 44))){
	return false;
	
}

});
</script>
<script type="text/javascript">
$('#quotesave').click(function(){
		
	var buydate=$("#datepicker").val();
	//alert('buying date');
    //alert(buydate);
	var today=$.datepicker.formatDate('mm/dd/yy', new Date());
    //alert('today');
    //alert(today);
	//return false;
	if(buydate =='')	{ 
	
	 alertify.alert('Select on or before which Date you are planning  to buy');
	 $("#datepicker_error").animate({color: '#FF0000',left:'205px',width: '550px',fontSize: '1.2em'},220);
	 $("#datepicker_error").text("Select on or before which Date you want to buy");
	 
	 
	 $('form').get(0).reset();
	 return false;	
	}
	if(buydate < today){
		alertify.alert('Please Select a Valid Date');
		 $("#datepicker_error").animate({color: '#FF0000',left:'205px',width: '550px',fontSize: '1.2em'},220);
	 $("#datepicker_error").text("Please Select a Valid Date");
		$('form').get(0).reset();
	     
	    return false;
	}
		
	if($("#cat_id").val()=='')	{
	 alertify.alert('Please Select a category');
	 return false;	
	}
	
	if($("#locarea").val()=='')	{
	 alertify.alert('Select a City');
	 return false;	
	}
	
	var productspec=$("#productspec").val();
	if(productspec == '')	{
	  alertify.alert('Please Enter Your Requirements');
	  return false;
    }
	
	
	});
</script>



	