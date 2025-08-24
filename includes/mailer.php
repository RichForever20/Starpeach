<?php
require_once __DIR__ . '/../config.php';
function send_admin_new_consultation($name,$email,$phone,$plan,$amount,$ref,$gateway){
  $subject="New consultation payment - $plan ($ref)";
  $msg="<h3>New Consultation Payment</h3>
  <p><b>Name:</b> ".clean($name)."</p>
  <p><b>Email:</b> ".clean($email)."</p>
  <p><b>Phone:</b> ".clean($phone)."</p>
  <p><b>Plan:</b> ".clean($plan)."</p>
  <p><b>Amount:</b> $".number_format((float)$amount,2)."</p>
  <p><b>Gateway:</b> ".clean($gateway)."</p>
  <p><b>Reference:</b> ".clean($ref)."</p>
  <p>Status is now <b>consultation_paid</b> (or <b>pending_bank</b>).</p>
  <p>Approve here: ".clean(BASE_URL)."/backend/admin/admin-approvals.php</p>";
  notify_email(NOTIFY_ADMIN_EMAIL,$subject,$msg);
}
function send_user_approved($email,$plan){
  $subject="Consultation approved - $plan";
  $msg="<p>Your consultation for the <b>".clean($plan)."</b> plan has been approved.</p>
  <p>Proceed to pay: <a href='".clean(BASE_URL)."/public/checkout-plan.html?plan=".clean($plan)."'>Plan checkout</a></p>";
  notify_email($email,$subject,$msg);
}
function send_user_plan_receipt($email,$plan,$amount,$ref,$gateway){
  $subject="Plan payment received - $plan ($ref)";
  $msg="<p>We received your plan payment for the <b>".clean($plan)."</b> plan.</p>
  <p>Amount: $".number_format((float)$amount,2)."</p>
  <p>Gateway: ".clean($gateway)."</p>
  <p>Reference: ".clean($ref)."</p>";
  notify_email($email,$subject,$msg);
}
