<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../includes/mailer.php';
$name=clean($_POST['name']??''); $email=clean($_POST['email']??''); $phone=clean($_POST['phone']??'');
$plan=strtolower(clean($_POST['plan']??'launch')); $gateway=strtolower(clean($_POST['gateway']??'paystack'));
$consult=['launch'=>49.00,'scale'=>79.00,'elevate'=>129.00]; if(!isset($consult[$plan])) $plan='launch';
$amount=$consult[$plan]; $ref=strtoupper($gateway).'-'.time().'-'.substr(md5(uniqid('',true)),0,6);
$status=($gateway==='bank')?'pending_bank':'consultation_paid'; $notes=($gateway==='bank')?'Awaiting manual bank transfer confirmation':'';
$conn=db(); $stmt=$conn->prepare("INSERT INTO payments (user_name,user_email,user_phone,plan,amount,gateway,transaction_ref,status,notes) VALUES (?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("ssssdsiss",$name,$email,$phone,$plan,$amount,$gateway,$ref,$status,$notes); $stmt->execute(); $stmt->close();
send_admin_new_consultation($name,$email,$phone,$plan,$amount,$ref,$gateway);
header("Location: ".BASE_URL."/public/thank-you-consultation.html?plan=$plan&ref=$ref&status=$status"); exit;
