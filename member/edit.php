<?php
include '../db.php';
$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM member WHERE member_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
?>

<h2>Edit Member</h2>
<form method="post">
  Nama: <input type="text" name="name" value="<?= $data['name'] ?>"><br>
  Email: <input type="email" name="email" value="<?= $data['email'] ?>"><br>
  Telepon: <input type="text" name="phone" value="<?= $data['phone'] ?>"><br>
  Alamat: <textarea name="address"><?= $data['address'] ?></textarea><br>
  <button type="submit" name="submit">Update</button>
</form>

<?php
if (isset($_POST['submit'])) {
  $stmt = $conn->prepare("UPDATE member SET name=?, email=?, phone=?, address=? WHERE member_id=?");
  $stmt->bind_param("ssssi", $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['address'], $id);
  $stmt->execute();
  header("Location: list.php");
  exit;
}
?>
