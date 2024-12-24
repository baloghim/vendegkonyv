<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendégkönyv</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <h1 class="text-center my-3">Vendégkönyv</h1>

        <!-- Vendégkönyv űrlap -->
        <div class="p-4 bg-dark rounded-3">
            <form action="append.php" method="post">
                <div class="input-group mb-3">
                    <span class="input-group-text">Név: </span>
                    <input type="text" name="uname" id="uname" class="form-control" required>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">E-mail: </span>
                    <input type="text" name="umail" id="umail" class="form-control" required>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Üzenet: </span>
                    <textarea name="umessage" id="umessage" cols="30" rows="10" class="form-control" maxlength="1000"
                        required></textarea>
                </div>
                <div id="charCount" class="text-end text-white mb-3">Még 1000 karakter használható.</div>
                <div class="d-flex justify-content-end ms-3 gap-3">
                    <button type="submit" class="btn btn-primary">Elküld</button>
                    <button type="reset" class="btn btn-danger">Újrakezd</button>
                </div>
            </form>
        </div>

        <!-- Üzenetek táblázata -->
        <div class="mt-5">
            <h2 class="text-center mb-3">Bejegyzések</h2>

            <table class="table table-bordered table-striped">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Dátum</th>
                        <th>Név</th>
                        <th>E-mail</th>
                        <th>Üzenet</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Adatbázis kapcsolat
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "vendegkonyv";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Kapcsolódási hiba: " . $conn->connect_error);
                    }

                    // Adatok lekérdezése
                    $sql = "SELECT timestamp, name, email, message FROM messages ORDER BY timestamp DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Adatok megjelenítése soronként
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['timestamp']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td>" . nl2br(htmlspecialchars($row['message'])) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-center'>Nincs még bejegyzés</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Sárga gomb elhelyezése középen -->
        <div class="text-center my-5">
            <form action="reset.php" method="post">
                <button type="submit" name="delete_all" class="btn btn-warning">Minden bejegyzés törlése</button>
            </form>
        </div>




    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script src="charcount.js"></script>
    <script src="check.js"></script>
</body>

</html>