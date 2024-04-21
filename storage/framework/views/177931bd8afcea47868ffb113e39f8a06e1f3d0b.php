<!DOCTYPE html>
<html>
<head>
	<title>Namaste Nepal</title>
</head>
<body>
	<h3>Enquiry</h3>

	Name: <?php echo e($body['name'] ?? ''); ?> <br>
	Email: <?php echo e($body['email'] ?? ''); ?> <br>
	Country: <?php echo e($body['country'] ?? ''); ?> <br>
	Phone No: <?php echo e($body['phone'] ?? ''); ?> <br>
	Message: <?php echo e($body['message'] ?? ''); ?> <br>

	<h4>Traveller Information</h4>
	IP Address: <?php echo e($body['ip_address']); ?>

</body>
</html>
<?php /**PATH /home/tlanders/public_html/resources/views/emails/contact.blade.php ENDPATH**/ ?>