<?php include '../db.php'; ?>
<h2>Daftar Member</h2>
<a href="add.php">+ Tambah Member</a>
<table border="1" cellpadding="8">
  <tr>
    <th>No</th><th>Nama</th><th>Email</th><th>Telepon</th><th>Alamat</th><th>Aksi</th>
  </tr>

  <?php
  $no = 1;
  $stmt = $conn->prepare("SELECT * FROM member ORDER BY member_id ASC");
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0):
    while ($row = $result->fetch_assoc()):
  ?>
  <tr>
    <td><?= $no++ ?></td>
    <td><?= htmlspecialchars($row['name']) ?></td>
    <td><?= htmlspecialchars($row['email']) ?></td>
    <td><?= $row['phone'] ?></td>
    <td><?= htmlspecialchars($row['address']) ?></td>
    <td>
      <a href="edit.php?id=<?= $row['member_id'] ?>">Edit</a> |
      <a href="delete.php?id=<?= $row['member_id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
    </td>
  </tr>
  <?php endwhile; else: ?>
    <tr><td colspan="6" align="center">Tidak ada data member.</td></tr>
  <?php endif; ?>
</table>
