<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Kapcsolódás az adatbázishoz
$conn = new mysqli('localhost', 'root', '', 'vendegkonyv');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ha a gombot megnyomták, töröljük az összes bejegyzést
if (isset($_POST['delete_all'])) {
    $sql = "DELETE FROM messages";
    if ($conn->query($sql) === TRUE) {
        // Sikeres törlés után az oldal újratöltése
        header("Location: index.php");
        exit();
    } else {
        echo "Hiba történt a törlés során: " . $conn->error;
    }
}

// Az adatbázis kapcsolódás bezárása
$conn->close();
?>