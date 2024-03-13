<?php

// Konfiguracja bazy danych i połączenie z bazą
$dbHost = "localhost"; $dbUser = "root"; $dbPass = ""; $dbName = "chat";
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Pobranie rekordów z bazy
$query = "SELECT * FROM chat ORDER BY id ASC";
$result = $conn->query($query);
if ($result->num_rows > 0) {
	// Jeżeli są rekordy w bazie, wyświetlenie ich
	while ($row = $result->fetch_assoc()) {
		echo "<p><b>".$row['name']."</b> (".$row['time']."): ".$row['message']."</p>"; 
	}
} else {
	// Informacja gdy w bazie nie ma danych
	echo "<p>Brak wiadomości na chacie.</p>";
}