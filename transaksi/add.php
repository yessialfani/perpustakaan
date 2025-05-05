<?php include '../db.php'; ?>
<h2>Tambah Transaksi (Pakai Stored Procedure)</h2>
<form method="post">
  Buku:
  <select name="book_id">
    <?php
    $buku = $conn->query("SELECT * FROM buku");
    while ($b = $buku->fetch_assoc()):
    ?>
      <option value="<?= $b['book_id'] ?>"><?= $b['title'] ?></option>
    <?php endwhile; ?>
  </select><br>

  Member:
  <select name="member_id">
    <?php
    $member = $conn->query("SELECT * FROM member");
    while ($m = $member->fetch_assoc()):
    ?>
      <option value="<?= $m['member_id'] ?>"><?= $m['name'] ?></option>
    <?php endwhile; ?>
  </select><br>

  Tanggal Pinjam: <input type="date" name="borrow_date"><br>
  Tanggal Kembali: <input type="date" name="due_date"><br>
  <button type="submit" name="submit">Simpan</button>
</form>

<?php
if (isset($_POST['submit'])) {
  $stmt = $conn->prepare("CALL add_transaksi(?, ?, ?, ?)");
  $stmt->bind_param("iiss", $_POST['book_id'], $_POST['member_id'], $_POST['borrow_date'], $_POST['due_date']);
  $stmt->execute();
  header("Location: list.php");
  exit;
}
?>
