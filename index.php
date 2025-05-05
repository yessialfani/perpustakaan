<?php
include 'db.php';

// Ambil jumlah buku
$buku = $conn->query("SELECT COUNT(*) AS total FROM buku")->fetch_assoc();

// Ambil jumlah member
$member = $conn->query("SELECT COUNT(*) AS total FROM member")->fetch_assoc();

// Ambil jumlah transaksi
$transaksi = $conn->query("SELECT COUNT(*) AS total FROM transaksi")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard Perpustakaan</title>
  <style>
    body { font-family: Arial; margin: 30px; }
    .card {
      display: inline-block;
      padding: 20px;
      margin: 10px;
      background: #f7f7f7;
      border-radius: 10px;
      width: 200px;
      text-align: center;
      box-shadow: 2px 2px 10px #ccc;
    }
    .count { font-size: 32px; font-weight: bold; color: #333; }
    a { text-decoration: none; color: #007bff; display: block; margin-top: 10px; }
  </style>
</head>
<body>
  <h1>📊 Dashboard Perpustakaan</h1>

  <div class="card">
    <div class="count"><?= $buku['total'] ?></div>
    <div>Total Buku</div>
    <a href="buku/list.php">Lihat Detail</a>
  </div>

  <div class="card">
    <div class="count"><?= $member['total'] ?></div>
    <div>Total Member</div>
    <a href="member/list.php">Lihat Detail</a>
  </div>

  <div class="card">
    <div class="count"><?= $transaksi['total'] ?></div>
    <div>Total Transaksi</div>
    <a href="transaksi/list.php">Lihat Detail</a>
  </div>

</body>
</html>
