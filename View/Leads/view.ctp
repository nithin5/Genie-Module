<!-- File: /app/View/Quote/view.ctp -->
<?php echo $this->Html->css('bootstrap');?>
<div class='upper-right-opt'>
    <?php 
	//echo $this->Form->button('A Button');

	//echo $this->Html->link( 'List Quotes', array( 'action' => 'index' ) ); ?>
</div>
<button class="btn btn-info" onclick="window.location.href='<?php echo Router::url(array('controller'=>'quotes', 'action'=>'index'))?>'">View Quotes</button><p></p>

<?php echo "<div class='panel panel-primary'><div class='panel-heading'>View/ Enquiry Details</div><div class='panel-body'>";?>  
<h4>Enquiry No: <?php echo h($quotes['Quote']['quoteid']); ?></h4>

<p>Enquiry Time: <?php echo $this->Time->format($quotes['Quote']['enquiry_time'],'%d-%m-%Y %H:%M %p'); ?></p>

<p>Expected Buying date: <?php echo $this->Time->format($quotes['Quote']['buyingdate'],'%d-%m-%Y'); ?></p>



<p>Product Requirements:<?php echo h($quotes['Quote']['productspec']); ?></p>
<?php
//echo $this->Form->input('productspec', array('rows' => '3','cols' =>'6','class'=>'form-control','label'=>'Share Your Requirements'));
echo"</div></div>";	
?>