<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../includes/mailer.php';
$name=clean($_POST['name']??''); $email=clean($_POST['email']??''); $phone=clean($_POST['phone']??'');
$plan=strtolower(clean($_POST['plan']??'launch')); $gateway=strtolower(clean($_POST['gateway']??'paystack'));
$prices=['launch'=>699.00,'scale'=>1699.00,'elevate'=>3499.00]; if(!isset($prices[$plan])) $plan='launch'; $amount=$prices[$plan];
$conn=db(); $stmt=$conn->prepare("SELECT id,status FROM payments WHERE user_email=? AND plan=? ORDER BY id DESC LIMIT 1");
$stmt->bind_param("ss",$email,$plan); $stmt->execute(); $res=$stmt->get_result(); $row=$res->fetch_assoc(); $stmt->close();
if(!$row || $row['status']!=='consultation_approved'){ header("Location: ".BASE_URL."/public/checkout-plan.html?plan=$plan&error=approval_required"); exit; }
$ref=strtoupper($gateway).'-'.time().'-'.substr(md5(uniqid('',true)),0,6); $status='plan_paid';
$stmt2=$conn->prepare("INSERT INTO payments (user_name,user_email,user_phone,plan,amount,gateway,transaction_ref,status) VALUES (?,?,?,?,?,?,?,?)");
$stmt2->bind_param("ssssdsss",$name,$email,$phone,$plan,$amount,$gateway,$ref,$status); $stmt2->execute(); $stmt2->close();
send_user_plan_receipt($email,$plan,$amount,$ref,$gateway);
header("Location: ".BASE_URL."/public/thank-you-plan.html?plan=$plan&ref=$ref"); exit;
