<?php
	require_once '../../../../wp-config.php';

	$headers     = 'From: ' . sanitize_email( $_POST["email"] );
	$subject     = 'New ' . $_POST["type"] . ' from MonsterPost';
	$messageBody = '';

	if ( $_POST['name'] !='' ) {
		$messageBody .= '<p>Name: '. sanitize_user( $_POST['name'], 1 ) . '</p>' . "\n";
		$messageBody .= '<br>' . "\n";
	}

	$messageBody .= '<p>Email: '. sanitize_email( $_POST['email'] ) . '</p>' . "\n";
	$messageBody .= '<br>' . "\n";

	if ( $_POST['type'] == 'subscribe' ) {
		if ( isset($_POST['fr']) ) {
			$messageBody .= '<p>Newsletter Frequency: '. $_POST['fr'] . '</p>' . "\n";
		} else {
			$messageBody .= '<p>Newsletter Frequency: six times a week</p>' . "\n";
		}
		$messageBody .= '<br>' . "\n";
	}

	if ( $_POST['phone'] !='' ) {
		$messageBody .= '<p>Phone: '. $_POST['phone'] . '</p>' . "\n";
		$messageBody .= '<br>' . "\n";
	}

	if ( $_POST['msg'] !='' ) {
		$messageBody .= '<p>Message: '. $_POST['msg'] . '</p>' . "\n";
		$messageBody .= '<br>' . "\n";
	}

	$messageBody = strip_tags( $messageBody );

	if ( isset($_POST['owner_email']) ) {
		$owner_email = $_POST['owner_email'];
	} else {
		$owner_email = get_option('admin_email');
	}

	try {
		if ( !mail($owner_email, $subject, $messageBody, $headers) ) {
			throw new Exception('mail failed');
		} else {
			echo 'mail sent';
		}
	} catch (Exception $e){
		echo $e->getMessage() ."\n";
	}
?>