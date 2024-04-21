<!DOCTYPE html>
<html>
<head>
	<title>Namaste Nepal</title>
</head>
<body>
	<h3>Booking</h3>

	Trip: <?php echo e($body['trip_name']); ?> <br>
	Booked By: <?php echo e($body['first_name'] . " " . $body['middle_name'] . " " . $body['last_name']); ?> <br>
	Country: <?php echo e($body['country']); ?> <br>
	Email: <?php echo e($body['email']); ?> <br>
	Contact No: <?php echo e($body['contact_no']); ?> <br>
	Gender: <?php echo e($body['gender']); ?> <br>
	Date of Birth: <?php echo e($body['dob']); ?> <br>
	Mailing Address: <?php echo e($body['mailing_address']); ?> <br>

	<h3>Trip Details</h3>
	Passport No.: <?php echo e($body['passport_no']); ?> <br>
	Place of Issue: <?php echo e($body['place_of_issue']); ?> <br>
	Issue Date: <?php echo e($body['issue_date']); ?> <br>
	Expiry Date: <?php echo e($body['expiry_date']); ?> <br>
	No. of Travellers: <?php echo e($body['no_of_travellers']); ?> <br>
	Preferred Departure Date: <?php echo e($body['preferred_departure_date']); ?> <br>
	Emergency Contact: <?php echo e($body['emergency_contact']); ?> <br>

	<h4>Traveller Information</h4>
	IP Address: <?php echo e($body['ip_address']); ?>

</body>
</html>
<?php /**PATH /home/tlanders/public_html/resources/views/emails/common.blade.php ENDPATH**/ ?>