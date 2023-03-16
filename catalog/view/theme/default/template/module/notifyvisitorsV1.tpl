<?php 
#################################################################
## Open Cart Module: NotifiVisitors - Notification Automation	   ##
##-------------------------------------------------------------##
## Copyright © 2015 "NotifiVisitors" All rights reserved.     ##
## http://www.NotifiVisitors.com						       ##
##-------------------------------------------------------------##
## Permission is hereby granted, when purchased, to  use this  ##
## mod on one domain. This mod may not be reproduced, copied,  ##
## redistributed, published and/or sold.				       ##
##-------------------------------------------------------------##
## Violation of these rules will cause loss of future mod      ##
## updates and account deletion				      			   ##
#################################################################
?>
	
<div id='notifyvisitorstag'></div>
<script>	
var notify_visitors = window.notify_visitors || {}; (function() { 
        notify_visitors.auth = { bid_e : '<?php print $data['notifyvisitorsV1_secretkey'];?>',
		bid : '<?php print $data['notifyvisitorsV1_brandid'];?>',
		t : '420'};
var script = document.createElement('script');script.async = true;
script.src = (document.location.protocol == 'https:' ? "//d2933uxo1uhve4.cloudfront.net" : "//cdn.notifyvisitors.com") + '/js/notify-visitors-1.0.js';
var entry = document.getElementsByTagName('script')[0];entry.parentNode.insertBefore(script, entry); })();
</script>



