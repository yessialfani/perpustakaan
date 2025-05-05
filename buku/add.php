<?php include '../db.php'; ?>
<h2>Tambah Buku (Pakai Stored Procedure)</h2>
<form method="post">
  Judul: <input type="text" name="title"><br>
  Penulis: <input type="text" name="author"><br>
  ISBN: <input type="text" name="isbn"><br>
  Jumlah: <input type="number" name="quantity"><br>
  <button type="submit" name="submit">Simpan</button>
</form>

<?php
if (isset($_POST['submit'])) {
  $stmt = $conn->prepare("CALL add_buku(?, ?, ?, ?)");
  $stmt->bind_param("sssi", $_POST['title'], $_POST['author'], $_POST['isbn'], $_POST['quantity']);
  $stmt->execute();
  header("Location: list.php");
  exit;
}
?>
