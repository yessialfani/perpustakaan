<?php
include '../db.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $stmt = $conn->prepare("DELETE FROM member WHERE member_id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
}

header("Location: list.php");
exit;
?>
