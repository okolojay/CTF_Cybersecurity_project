<?php
$role = $_GET['role'] ?? 'unknown';
$logfile = 'role_log.txt';
$entry = date('Y-m-d H:i:s') . " - Role selected: $role\n";
file_put_contents($logfile, $entry, FILE_APPEND | LOCK_EX);
header("Location: index.php");
exit;
?>
