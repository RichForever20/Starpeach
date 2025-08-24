<?php
require_once __DIR__ . '/../../config.php'; header('Content-Type: application/json');
$email=clean($_GET['email']??''); $plan=strtolower(clean($_GET['plan']??'launch'));
$conn=db(); $stmt=$conn->prepare("SELECT status FROM payments WHERE user_email=? AND plan=? ORDER BY id DESC LIMIT 1");
$stmt->bind_param("ss",$email,$plan); $stmt->execute(); $res=$stmt->get_result(); $row=$res->fetch_assoc(); $stmt->close();
$status=$row['status']??'none'; $approved=($status==='consultation_approved'); echo json_encode(['approved'=>$approved,'status'=>$status]);
