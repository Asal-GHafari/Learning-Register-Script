<?php
define("userclass_lang_11", 'کلمه عبور های وارد شده یکسان نیستند .' );
define("userclass_lang_12", 'کلمه عبور باید حداقل 6 کاراکتر باشد .' );
define("userclass_lang_13", 'کلمه عبور خارج از حد مجاز است !' );
define("userclass_lang_14", 'نام کاربری خارج از حد مجاز است' );
define("userclass_lang_15", 'ایمیل وارد شده صحیح نمی باشد .' );
define("userclass_lang_16", 'خطایی در هنگام ثبت نام رخ داد .' );
define("userclass_lang_17", 'نام کاربری مورد نظر شما فعال نیست ، لطفا نام دیگری انتخاب کنید.' );
define("userclass_lang_18", 'خطایی در هنگام ثبت نام رخ داد .' );
define("userclass_lang_19", 'کلمه عبور خارج از حد مجاز است !' );
define("userclass_lang_20", 'نام کاربری خارج از حد مجاز است .' );
define("userclass_lang_21", 'نام کاربری یا کلمه عبور اشتباه است.' );
define("userclass_lang_22", 'کلمه عبور های وارد شده یکسان نیستند .' );
define("userclass_lang_23", 'کلمه عبور باید حداقل 6 کاراکتر باشد .' );
define("userclass_lang_24", 'کلمه عبور خارج از حد مجاز است !' );
define("userclass_lang_25", 'ایمیل وارد شده صحیح نمی باشد .' );
define("userclass_lang_26", 'خطایی در سیستم رخ داد، لطفا مجددا امتحان کنید.' );
define("userclass_lang_27", 'خطایی در سیستم رخ داد، لطفا مجددا امتحان کنید.' );

// Lang Functions
function userclass_lang_mail_active ($username,$email,$activationcode)
{
	$message  = 'سلام /r/n';
	$message .= 'ما درخواستی در سایت '. _domain .' برای فعالسازی کاربر "'. $username .'" دریافت کرده ایم. /r/n';
	$message .= "کد فعالسازی شما عبارت است از ". $activationcode ." /r/n";
	$message .= "همچنین شما می توانید برای فعالسازی اکانت خود روی لینک مقابل کلیک کنید : ". '<a href="http://' . _domain . _sitepath . 'active.php?code=' . $activationcode . '">http://' . _domain . _sitepath . 'active.php?code=' . $activationcode . '</a>' ." /r/n";
	$message .= "درصورتی که شما چنین درخواستی نداده اید لطفا این ایمیل را نادیده بگیرید . /r/n";
	
	sendmail($email,'Activate your accont on '. _domain ,$message);
}

?>