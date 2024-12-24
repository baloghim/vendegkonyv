<?php
// Hibajelentések bekapcsolása fejlesztési környezetben
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Adatbázis kapcsolat beállításai
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vendegkonyv";

// Kapcsolat létrehozása
$conn = new mysqli($servername, $username, $password, $dbname);

// Kapcsolati hiba ellenőrzése
if ($conn->connect_error) {
    die("Kapcsolódási hiba: " . $conn->connect_error);
}

// Űrlapadatok lekérése és tisztítása
$name = htmlspecialchars(trim($_POST['uname'] ?? ''));
$email = htmlspecialchars(trim($_POST['umail'] ?? ''));
$message = htmlspecialchars(trim($_POST['umessage'] ?? ''));

// Ellenőrzés: minden mező ki van-e töltve
if (empty($name) || empty($email) || empty($message)) {
    header("Location: index.php?status=error&message=missing_fields");
    exit();
}

// Adatok beszúrása az adatbázisba
$sql = "INSERT INTO messages (name, email, message) VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("SQL hiba: " . $conn->error);
}

// Paraméterek hozzárendelése és végrehajtás
$stmt->bind_param("sss", $name, $email, $message);

if ($stmt->execute()) {
    // Sikeres beszúrás után átirányítás az index.php-ra
    header("Location: index.php?status=success");
} else {
    // Hiba esetén az index.php-ra irányítás
    header("Location: index.php?status=error&message=insert_failed");
}

// Kapcsolat bezárása
$stmt->close();
$conn->close();
exit();
?>
