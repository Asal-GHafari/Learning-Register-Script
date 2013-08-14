<?php
define("userclass_lang_11", 'The passwords you entered are not identical.' );
define("userclass_lang_12", 'Your password must contain at least 6 characters.' );
define("userclass_lang_13", 'the password does not meet the requirements!' );
define("userclass_lang_14", 'The username you entered is not valid.' );
define("userclass_lang_15", 'The email you entered is not valid.' );
define("userclass_lang_16", 'An error occurred while signing up.' );
define("userclass_lang_17", 'The username you want to use is not available, please choose another one.' );
define("userclass_lang_18", 'An error occurred while signing up.' );
define("userclass_lang_19", 'the password does not meet the requirements!' );
define("userclass_lang_20", 'The username you entered is not valid.' );
define("userclass_lang_21", 'The username or password is incorrect.' );
define("userclass_lang_22", 'The passwords you entered are not identical.' );
define("userclass_lang_23", 'Your password must contain at least 6 characters.' );
define("userclass_lang_24", 'the password does not meet the requirements!' );
define("userclass_lang_25", 'The email you entered is not valid.' );
define("userclass_lang_26", 'An error occurred while updating.' );
define("userclass_lang_27", 'An error occurred, please try later.' );

// Lang Functions
function userclass_lang_mail_active ($username,$email,$activationcode)
{
	$message  = 'Hi,there /r/n';
	$message .= 'We recive a activation request on '. _domain .' for active username :"'. $username .'" /r/n';
	$message .= "Your activation code is ". $activationcode ." /r/n";
	$message .= "You can also click on this link for activation your accont : ". '<a href="http://' . _domain . _sitepath . 'active.php?code=' . $activationcode . '">http://' . _domain . _sitepath . 'active.php?code=' . $activationcode . '</a>' ." /r/n";
	$message .= "If you don't send this request please don't attention to this E-Mail /r/n";
	
	sendmail($email,'Activate your accont on '. _domain ,$message);
}

?>