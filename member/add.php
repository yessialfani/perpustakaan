<?php include '../db.php'; ?>
<h2>Tambah Member (Pakai Stored Procedure)</h2>
<form method="post">
  Nama: <input type="text" name="name"><br>
  Email: <input type="email" name="email"><br>
  Telepon: <input type="text" name="phone"><br>
  Alamat: <textarea name="address"></textarea><br>
  <button type="submit" name="submit">Simpan</button>
</form>

<?php
if (isset($_POST['submit'])) {
  $stmt = $conn->prepare("CALL add_member(?, ?, ?, ?)");
  $stmt->bind_param("ssss", $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['address']);
  $stmt->execute();
  header("Location: list.php");
  exit;
}
?>
