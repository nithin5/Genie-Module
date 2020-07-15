<?php 
echo $this->Html->script('jquery.min');
//echo $this->Html->script('jquery-1.10.2');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('alertify.min');

echo $this->Html->css('cake.generic');
echo $this->Html->css('bootstrap');
echo $this->Html->css('alertify.min');

echo "<div class='panel panel-primary'><div class='panel-heading'>List of  Enquiry Details</div>";?>
  <div class="dropdown" style="float:right;margin-top:-38px;margin-right:53px;">
  <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">More Options
  <span class="caret"></span></button>
 <ul class="dropdown-menu">
 <li><a href="/quotes/index" onclick="<?php echo Router::url(array('controller'=>'quotes', 'action'=>'index'))?>">New Enquiries</a></li>
 <li><a href="/quotes/cindex" onclick="<?php echo Router::url(array('controller'=>'quotes', 'action'=>'cindex'))?>">Closed Enquiries</a></li>
 <li><a href="/quotes/listquotes" onclick="<?php echo Router::url(array('controller'=>'quotes', 'action'=>'listquotes'))?>">Search</a></li>
 </ul>
 </div>
 <?php echo"<div class='panel-body'>";?>
<!--h1>Quotes</h1-->
<?php
//$cat_id != '' ? $cat_id : '';
//$city_id != '' ? $city_id : '';
echo $this->Form->create('Quotes',array('action' => 'listquotes','type'=>'get'));
//echo $this->Form->input('cat_id', array('type' => 'text','value'=>$cat_id));
//echo $this->Form->input('city_id', array('type' => 'text','value'=>$city_id));

echo $this->Form->label('Category');
echo $this->Form->select('cat_id',$CategoryList, array('class'=>'form-control','id' =>'cat_id','empty' => 'Select A category','style' => 'margin:0 0 0 3px;font-size:14px;padding-top:0px',
    ));

echo $this->Form->label('City');
echo $this->Form->select('city_id', $CityList,array('class'=>'form-control','id'=>'cat_id','default'=>'1','style' => 'margin:0 0 0 3px;font-size:14px;padding-top:0px','empty' => '-Select City-'));



$options=array('id'=>'findquotes','label'=>'Find Quotes','value'=>'Find Quotes');
echo $this->Form->end($options);
?>
 <script type="text/javascript">
$('#findquotes').click(function(){

var cat_id=$("#cat_id").val();
var city_id=$("#city_id").val();
	if((cat_id == '')||(city_id =='')){
	  alertify.alert('Please Select both City & Category');
	  return false;
    }
	
	
	});
</script>  
<?php
//echo "cat_id".$this->params['url']['cat_id'];
if(count($quotes)>0 ){
	 ?>
     <div class="table-responsive">
    <table class="table table-hover">

<thead>
    <tr>
        <th>Enquiry No</th>
        <th>Buying Date</th>
        <th>Requirement</th>
        <th>Enquired Date</th>
        <th>View Enquiry</th>
    </tr>
</thead>
<tbody>
<!-- Here's where we loop through our $quotes array, printing out quote info -->

    <?php foreach ($quotes as $quote) :?>
    <tr>
       
        <td>
        
            <?php
                echo $quote['Quote']['quoteid'];
                
            ?>
        </td>
         <td>
        <?php echo $this->Time->format($quote['Quote']['buyingdate'], '%d-%m-%Y');?>
         </td>
         <td>
            <?php 
            $result = $this->Text->truncate($quote['Quote']['productspec'], 60);
            echo $result;
            ?>
        </td> 
        <td>
            <?php echo $quote['Quote']['enquiry_time']; ?>(
            <?php echo $this->Time->timeAgoInWords($quote['Quote']['enquiry_time']);?>)
        </td>
        <td>
           <?php
                echo $this->Html->link('View', array('action' => 'edit', $quote['Quote']['quoteid']));
            ?>
        </td>
        
        
    </tr>
    <?php endforeach; ?>
    <ul class="pagination pagination-lg" style="float:right">
     <?php                     
    echo $this->Paginator->first('First', null,null, array('class' => 'disabled'));
    echo " ";
    echo $this->Paginator->prev('« Prev', null, null, array('class' => 'disabled'));
    echo " ";
    echo " ";
    echo $this->Paginator->next('Next»', null, null, array('class' => 'disabled'));
    echo " ";
    echo $this->Paginator->last('Last', null,null, array('class' => 'disabled'));
    echo " ";
    echo " ";
    echo $this->Paginator->numbers(array('class' => 'numbers', 'first' => false, 'last' => false));
    echo"(";
    echo $this->Paginator->counter(array('format' => 'range'));
    echo")";
    ?>
    </ul>
    <?php unset($quote); ?>
</tbody>
</table>
</div>
<?php 
}


if((!empty($_GET['cat_id']))AND count($quotes)==0 )
{
	echo "No Quotes corresponding to this category & city";
}

?>   
<?php echo"</div></div>";?>