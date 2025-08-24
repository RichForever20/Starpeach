<?php
require_once __DIR__ . '/../../config.php'; session_start();
if($_SERVER['REQUEST_METHOD']==='POST'){ $u=$_POST['u']??''; $p=$_POST['p']??'';
  if($u===ADMIN_USERNAME && $p===ADMIN_PASSWORD){ $_SESSION['admin']=true; header("Location: admin-approvals.php"); exit; }
  $error="Invalid credentials";
} ?>
<!doctype html><html><head><meta charset="utf-8"><title>Admin Login</title>
<link rel="stylesheet" href="../../public/assets/css/styles.css"></head>
<body class="container">
<h2>Consultation Approvals - Login</h2>
<?php if(!empty($error)): ?><p style="color:red;"><?=htmlspecialchars($error)?></p><?php endif; ?>
<form method="post">
<label>Username <input type="text" name="u" required></label><br><br>
<label>Password <input type="password" name="p" required></label><br><br>
<button type="submit" class="btn">Login</button>
</form>
</body></html>
