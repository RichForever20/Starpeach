 
// define('DB_HOST','localhost');
//  define('DB_USER','root'); define('DB_PASS','');
//   define('DB_NAME','studiova_payments');
// define('BASE_URL','http://localhost/studiova-payments');
// define('ADMIN_USERNAME','admin'); 
// define('ADMIN_PASSWORD','studiova123');
// define('NOTIFY_ADMIN_EMAIL','consultant@example.com');
//  define('NOTIFY_FROM_EMAIL','no-reply@studiova.local');
// define('PAYPAL_TEST', true);
// define('PAYSTACK_PUBLIC_KEY','pk_test_xxxxxxxx');
//  define('PAYSTACK_SECRET_KEY','sk_test_xxxxxxxx');
// define('FLUTTERWAVE_PUBLIC_KEY','FLWPUBK_TEST-xxxxxxxxxxxxxxxx'); 
// define('FLUTTERWAVE_SECRET_KEY','FLWSECK_TEST-xxxxxxxxxxxxxxxx');
// function db(){ static $c; if($c===null){ $c=new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME); if($c->connect_error){ die('DB connect fail: '.$c->connect_error);} } return $c; }
// function notify_email($to,$sub,$msg){ $h="From: ".NOTIFY_FROM_EMAIL."\r\nMIME-Version: 1.0\r\nContent-Type: text/html; charset=UTF-8\r\n"; @mail($to,$sub,$msg,$h); }
// function clean($s){ return htmlspecialchars(trim($s ?? ''), ENT_QUOTES, 'UTF-8'); } 



<?php
// Database connection details
define('DB_HOST','localhost');       // DB host (leave as 'localhost' in cPanel too)
define('DB_USER','root');            // Local dev user (change to cPanel MySQL user later)
define('DB_PASS','');                // Local dev password (set real password in cPanel)
define('DB_NAME','studiova_payments'); // Database name (must exist in phpMyAdmin)

// Base URL for redirects and links
define('BASE_URL','http://localhost/studiova-payments');

// Default admin login credentials (for offline testing)
define('ADMIN_USERNAME','admin');
define('ADMIN_PASSWORD','studiova123');

// Email settings for consultant notifications
define('NOTIFY_ADMIN_EMAIL','consultant@example.com'); 
define('NOTIFY_FROM_EMAIL','no-reply@studiova.local');

// Payment gateway keys (test mode)
define('PAYPAL_TEST', true);

define('PAYSTACK_PUBLIC_KEY','pk_test_xxxxxxxx');
define('PAYSTACK_SECRET_KEY','sk_test_xxxxxxxx');

define('FLUTTERWAVE_PUBLIC_KEY','FLWPUBK_TEST-xxxxxxxxxxxxxxxx');
define('FLUTTERWAVE_SECRET_KEY','FLWSECK_TEST-xxxxxxxxxxxxxxxx');

// Function for database connection
function db(){
  static $c;
  if($c===null){
    $c=new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    if($c->connect_error){
      die('DB connect fail: '.$c->connect_error);
    }
  }
  return $c;
}

// Send notification emails
function notify_email($to,$sub,$msg){
  $h="From: ".NOTIFY_FROM_EMAIL."\r\nMIME-Version: 1.0\r\nContent-Type: text/html; charset=UTF-8\r\n";
  @mail($to,$sub,$msg,$h);
}

// Clean input
function clean($s){
  return htmlspecialchars(trim($s ?? ''), ENT_QUOTES, 'UTF-8');
}
