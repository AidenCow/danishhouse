<?php

//Timezone

date_default_timezone_set('UTC');


//Bootstrap

define('BOOTSTRAP_VERSION', 3);


//WEBSITE

define('WEBSITE_NAME', "Danish House");

define('WEBSITE_DOMAIN', "http://danishhouse.com.my");

//it can be the same as domain (if script is placed on website's root folder) 
//or it can cotain path that include subfolders, if script is located in some subfolder and not in root folder
define('SCRIPT_URL', "http://danishhouse.com.my/danishhouse/");


//DATABASE CONFIGURATION

define('DB_HOST', "localhost"); 

define('DB_TYPE', "mysql"); 

define('DB_USER', "root"); 

define('DB_PASS', "root"); 

define('DB_NAME', "danishhouse"); 


//SESSION CONFIGURATION

define('SESSION_SECURE', false);   

define('SESSION_HTTP_ONLY', true);

define('SESSION_REGENERATE_ID', true);   

define('SESSION_USE_ONLY_COOKIES', 1);


//LOGIN CONFIGURATION

define('LOGIN_MAX_LOGIN_ATTEMPTS', 5); 

define('LOGIN_FINGERPRINT', true); 

define('SUCCESS_LOGIN_REDIRECT', serialize(array( 'default' => "index.php"))); 


//PASSWORD CONFIGURATION

define('PASSWORD_ENCRYPTION', "bcrypt"); //available values: "sha512", "bcrypt"

define('PASSWORD_BCRYPT_COST', "13"); 

define('PASSWORD_SHA512_ITERATIONS', 25000); 

define('PASSWORD_SALT', "qsU2kkMizJ/Gwrby1tB9nc"); //22 characters to be appended on first 7 characters that will be generated using PASSWORD_ info above

define('PASSWORD_RESET_KEY_LIFE', 30); 


//REGISTRATION CONFIGURATION

define('MAIL_CONFIRMATION_REQUIRED', true); 

define('REGISTER_CONFIRM', "http://danishhouse.com.my/danishhouse/confirm.php"); 

define('REGISTER_PASSWORD_RESET', "http://danishhouse.com.my/danishhouse/passwordreset.php"); 


//EMAIL SENDING CONFIGURATION

define('MAILER', "smtp"); // available options are 'mail' for php mail() and 'smtp' for using SMTP server for sending emails

define('SMTP_HOST', "smtp.emailsrvr.com"); 

define('SMTP_PORT', 587); 

define('SMTP_USERNAME', "leehw@silverglobe.com"); 

define('SMTP_PASSWORD', "wisdom83"); 

define('SMTP_ENCRYPTION', "tls"); 


//SOCIAL LOGIN CONFIGURATION

define('SOCIAL_CALLBACK_URI', "http://danishhouse.com.my/danishhouse/vendor/hybridauth/"); 


// GOOGLE

define('GOOGLE_ENABLED', false); 

define('GOOGLE_ID', ""); 

define('GOOGLE_SECRET', ""); 


// FACEBOOK

define('FACEBOOK_ENABLED', false); 

define('FACEBOOK_ID', ""); 

define('FACEBOOK_SECRET', ""); 


// TWITTER

// NOTE: Twitter api for authentication doesn't provide users email address!
// So, if you email address is strictly required for all users, consider disabling twitter login option.

define('TWITTER_ENABLED', false); 

define('TWITTER_KEY', ""); 

define('TWITTER_SECRET', ""); 


// TRANSLATION

define('DEFAULT_LANGUAGE', 'en'); 


