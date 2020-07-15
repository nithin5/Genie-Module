<?php 
echo $this->Html->css('bootstrap');
echo $this->Html->script('jquery-1.10.2');
echo $this->Html->script('bootstrap.min');
echo $this->Html->css('cake.generic');

echo "<div class='panel panel-primary'><div class='panel-heading'>List of  Enquiry Details</div>";?>
<div class="dropdown" style="float:right;margin-top:-38px;margin-right:53px;">
  <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">More Options
  <span class="caret"></span></button>
 <ul class="dropdown-menu">
 <li><a href="/quotes/index" onclick="<?php echo Router::url(array('controller'=>'quotes', 'action'=>'index'))?>">New Enquiries</a></li>
 <li><a href="/quotes/listquotes" onclick="<?php echo Router::url(array('controller'=>'quotes', 'action'=>'listquotes'))?>">Search</a></li>
 <li><a href="/quotes/quickquotes" onclick="<?php echo Router::url(array('controller'=>'quotes', 'action'=>'quickstatus'))?>">Quick Quote</a></li>
 </ul>
 </div>


 <?php echo"<div class='panel-body'>";?>
<!--h1>Quotes</h1-->
<?php if(count($quotes)>0){?>
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
                echo $this->Html->link('Admin', array('action' => 'cedit', $quote['Quote']['quoteid']));
            ?>
		</td>
		
		
    </tr>
    <?php endforeach; ?>
	<ul class="pagination pagination-lg" style="float:right">
		<?php echo $this->Paginator->numbers(array('tag' => 'li', 'separator' => '', 'currentClass' => 'active', 'currentTag' => 'a' ));
	 ?>
    </ul>
    <?php unset($quote); ?>
</tbody>
</table>
</div>
<?php }
  else{echo "No Results";}?>
<?php echo"</div></div>";?>