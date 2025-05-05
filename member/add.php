<?php
include '../db.php'; // koneksi ke database

// Debugging koneksi
if ($conn->connect_error) {
    die("❌ Koneksi gagal: " . $conn->connect_error);
}
?>

<h2>Tambah Member</h2>
<form method="post">
    Nama: <input type="text" name="name"><br>
    Email: <input type="email" name="email"><br>
    Telepon: <input type="text" name="phone"><br>
    Alamat: <textarea name="address"></textarea><br>
    <button type="submit" name="submit">Simpan</button>
</form>

<?php
if (isset($_POST['submit'])) {
    // ✅ DEBUG: Tampilkan data dari form
    echo "<h3>🔍 Debug: Data dari Form (print_r)</h3>";
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    // Blok ini hanya untuk testing sebelum redirect
    // Jika ingin lanjut simpan data, hapus baris `die();` di bawah
    //die("<p style='color:red'>⛔ Hentikan sementara untuk melihat debug. Hapus <code>die()</code> untuk lanjut simpan.</p>");

    // Data dari form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO member (name, email, phone, address) VALUES (?, ?, ?, ?)");

    if (!$stmt) {
        die("❌ Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssss", $name, $email, $phone, $address);

    if (!$stmt->execute()) {
        die("❌ Execute failed: " . $stmt->error);
    }

    echo "✅ Data berhasil disimpan.";

    header("Location: list.php");
    exit;
}
?>
