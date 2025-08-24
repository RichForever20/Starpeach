<?php
require_once __DIR__ . '/../../config.php'; require_once __DIR__ . '/../../includes/mailer.php'; session_start();
if(empty($_SESSION['admin'])){ header("Location: login.php"); exit; }
$conn=db();
if(isset($_GET['approve'])){ $id=intval($_GET['approve']);
  $stmt=$conn->prepare("SELECT user_email,plan FROM payments WHERE id=?"); $stmt->bind_param("i",$id); $stmt->execute();
  $res=$stmt->get_result()->fetch_assoc(); $stmt->close();
  if($res){ $stmt2=$conn->prepare("UPDATE payments SET status='consultation_approved' WHERE id=?"); $stmt2->bind_param("i",$id); $stmt2->execute(); $stmt2->close();
    send_user_approved($res['user_email'],$res['plan']);
  }
  header("Location: admin-approvals.php"); exit;
}
$rows=[]; $r=$conn->query("SELECT * FROM payments WHERE status IN ('consultation_paid','pending_bank') ORDER BY created_at DESC");
while($row=$r->fetch_assoc()){ $rows[]=$row; }
?>
<!doctype html><html><head><meta charset="utf-8"><title>Consultation Approvals</title>
<link rel="stylesheet" href="../../public/assets/css/styles.css">
<style>table{border-collapse:collapse;width:100%;}th,td{border:1px solid #ddd;padding:8px;}th{background:#f2f2f2;text-align:left;} .actions a{padding:6px 10px;background:#111;color:#fff;text-decoration:none;border-radius:6px;}</style>
</head><body class="container">
<h2>Consultation Approvals</h2><p><a href="logout.php">Logout</a></p>
<table><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Plan</th><th>Amount</th><th>Gateway</th><th>Ref</th><th>Status</th><th>Created</th><th>Actions</th></tr>
<?php foreach($rows as $row): ?>
<tr>
  <td><?= (int)$row['id'] ?></td>
  <td><?= htmlspecialchars($row['user_name']) ?></td>
  <td><?= htmlspecialchars($row['user_email']) ?></td>
  <td><?= htmlspecialchars($row['user_phone']) ?></td>
  <td><?= htmlspecialchars($row['plan']) ?></td>
  <td>$<?= number_format((float)$row['amount'],2) ?></td>
  <td><?= htmlspecialchars($row['gateway']) ?></td>
  <td><?= htmlspecialchars($row['transaction_ref']) ?></td>
  <td><?= htmlspecialchars($row['status']) ?></td>
  <td><?= htmlspecialchars($row['created_at']) ?></td>
  <td class="actions"><a href="?approve=<?= (int)$row['id'] ?>">Approve</a></td>
</tr>
<?php endforeach; ?>
</table>
</body></html>
