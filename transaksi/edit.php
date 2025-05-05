<?php
include '../db.php';
$id = $_GET['id'];

// Ambil data transaksi lama
$stmt = $conn->prepare("SELECT * FROM transaksi WHERE transaction_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
?>

<h2>Edit Transaksi</h2>
<form method="post">
  Tanggal Pinjam: <input type="date" name="borrow_date" value="<?= $data['borrow_date'] ?>"><br>
  Tanggal Kembali (Jatuh Tempo): <input type="date" name="due_date" value="<?= $data['due_date'] ?>"><br>
  Tanggal Dikembalikan: <input type="date" name="return_date" value="<?= $data['return_date'] ?>"><br>
  <button type="submit" name="submit">Update</button>
</form>

<?php
if (isset($_POST['submit'])) {
  $borrow = $_POST['borrow_date'];
  $due = $_POST['due_date'];
  $return = $_POST['return_date'];

  $stmt = $conn->prepare("UPDATE transaksi SET borrow_date=?, due_date=?, return_date=? WHERE transaction_id=?");
  $stmt->bind_param("sssi", $borrow, $due, $return, $id);
  $stmt->execute();

  header("Location: list.php");
  exit;
}
?>
