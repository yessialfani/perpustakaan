<?php include '../db.php'; ?>
<h2>Daftar Buku</h2>
<a href="add.php">+ Tambah Buku</a>
<table border="1" cellpadding="8">
  <tr>
    <th>No</th>
    <th>Judul</th>
    <th>Penulis</th>
    <th>ISBN</th>
    <th>Stok</th>
    <th>Aksi</th>
  </tr>

  <?php
  $no = 1;
  $stmt = $conn->prepare("SELECT * FROM buku ORDER BY book_id ASC");
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0):
    while ($row = $result->fetch_assoc()):
  ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($row['title']) ?></td>
      <td><?= htmlspecialchars($row['author']) ?></td>
      <td><?= htmlspecialchars($row['isbn']) ?></td>
      <td><?= $row['quantity'] ?></td>
      <td>
        <a href="edit.php?id=<?= $row['book_id'] ?>">Edit</a> |
        <a href="delete.php?id=<?= $row['book_id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
      </td>
    </tr>
  <?php
    endwhile;
  else:
  ?>
    <tr><td colspan="6" align="center">Tidak ada data buku.</td></tr>
  <?php endif; ?>
</table>
