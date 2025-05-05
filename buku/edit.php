<?php
include '../db.php';
$id = $_GET['id'];

// Ambil data buku yang akan diedit
$stmt = $conn->prepare("SELECT * FROM buku WHERE book_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
?>

<h2>Edit Buku</h2>
<form method="post">
  Judul: <input type="text" name="title" value="<?= $data['title'] ?>"><br>
  Penulis: <input type="text" name="author" value="<?= $data['author'] ?>"><br>
  ISBN: <input type="text" name="isbn" value="<?= $data['isbn'] ?>"><br>
  Jumlah: <input type="number" name="quantity" value="<?= $data['quantity'] ?>"><br>
  <button type="submit" name="submit">Update</button>
</form>

<?php
if (isset($_POST['submit'])) {
  $title = $_POST['title'];
  $author = $_POST['author'];
  $isbn = $_POST['isbn'];
  $quantity = $_POST['quantity'];

  $stmt = $conn->prepare("UPDATE buku SET title = ?, author = ?, isbn = ?, quantity = ? WHERE book_id = ?");
  $stmt->bind_param("sssii", $title, $author, $isbn, $quantity, $id);
  $stmt->execute();

  header("Location: list.php");
  exit;
}
?>
