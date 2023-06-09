<?php if ($error_warning) { ?>
<div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
<?php } ?>
<?php if ($payment_methods) { ?>
	<p><?php echo $text_payment_method; ?></p>
	<?php foreach ($payment_methods as $payment_method) { ?>
		  <div class="col-lg-6 col-md-6 col-xs-6">
		      <div class="payment_method_item" id="<?php echo $payment_method['code']; ?>">
	            <?php if ($payment_method['code'] == $code || !$code) { ?>
	            <?php $code = $payment_method['code']; ?>
	            <input type="radio" name="payment_method" value="<?php echo $payment_method['code']; ?>" title="<?php echo $payment_method['title']; ?>" checked="checked" />
	            <?php } else { ?>
	            <input type="radio" name="payment_method" value="<?php echo $payment_method['code']; ?>" title="<?php echo $payment_method['title']; ?>" />
	            <?php } ?>
	            <?php echo $payment_method['title']; ?>
		      </div>
	      </div>
	<?php } ?>
<?php } ?>
<style type="text/css">
	.payment_method_item {
	    border: 1px solid #1f90bb;
	    margin: 0px 10px 0px 0px;
	    border-radius: 5px;
	    text-align: center;
	    padding: 8px;
	    cursor: pointer;
	    background: #a6cddc;
	    color: #000;
	    font-weight: 600;
	}
	.payment_method_item input[type="radio"] {
	    display: none;
	    float: left;
	}
	.payment_method_item.active {
	    background: #2199c6;
	    color: #fff;
	}
</style>
<script type="text/javascript">
	$( ".payment_method_item" ).click(function() {

  		$('.payment_method_item').removeClass( "active" );

  		$(this).addClass( "active" );

  		$("input[name='payment_method']").prop("checked", false); 

  		$("input[value='"+$(this).attr('id')+"']").prop("checked", true); 
	});
</script>
