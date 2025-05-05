<?php include '../db.php'; ?>
<h2>Daftar Transaksi</h2>
<a href="add.php">+ Tambah Transaksi</a>
<table border="1" cellpadding="8">
  <tr>
    <th>No</th>
    <th>Judul Buku</th>
    <th>Nama Member</th>
    <th>Tanggal Pinjam</th>
    <th>Jatuh Tempo</th>
    <th>Tanggal Kembali</th>
    <th>Denda</th>
    <th>Aksi</th>
  </tr>

  <?php
  $no = 1;
  $result = $conn->query("
    SELECT t.*, b.title, m.name
    FROM transaksi t
    JOIN buku b ON t.book_id = b.book_id
    JOIN member m ON t.member_id = m.member_id
    ORDER BY t.transaction_id DESC
  ");

  while($row = $result->fetch_assoc()):
  ?>
  <tr>
    <td><?= $no++ ?></td>
    <td><?= $row['title'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['borrow_date'] ?></td>
    <td><?= $row['due_date'] ?></td>
    <td><?= $row['return_date'] ?? '-' ?></td>
    <td>
      <?php
        if (!is_null($row['return_date'])) {
          echo 'Rp ' . number_format($row['fine'], 0, ',', '.');
        } else {
          echo '-';
        }
      ?>
    </td>
    <td>
      <a href="edit.php?id=<?= $row['transaction_id'] ?>">Edit</a> |
      <a href="delete.php?id=<?= $row['transaction_id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
    </td>
  </tr>
  <?php endwhile; ?>
</table>
