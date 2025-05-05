<?php
include '../db.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Siapkan dan jalankan query delete
  $stmt = $conn->prepare("DELETE FROM buku WHERE book_id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
}

header("Location: list.php");
exit;
?>
