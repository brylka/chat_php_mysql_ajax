<?php
// Sprawdzenie, czy formularz z imieniem został wysłany
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['name'])) {
	// Ustawienie ciasteczka
	setcookie("name", $_POST['name'], time() + 60 * 60, "/");
	// Przekierowanie pod ten sam adres
	header("Location: " . $_SERVER['PHP_SELF']);
	exit;
}

// Sprawdzenie, czy wysłano żądanie wylogowania 
if (isset($_GET['logout'])) {
	setcookie("name", "", time() - 60 * 60, "/");
	header("Location: " . $_SERVER['PHP_SELF']);
	exit;
}

// Konfiguracja bazy danych i połączenie z bazą
$dbHost = "localhost"; $dbUser = "root"; $dbPass = ""; $dbName = "chat";
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Dodanie wiadomości do bazy danych
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['message'])) {
	// Przygotowanie danych
	$name = $_COOKIE['name'];
	$message = $_POST['message'];
	$time = date("Y-m-d H:i:s");

	// Przygotowanie zapytania i wykonanie zapytania
	$query = "INSERT INTO chat (name, message, time) VALUES (?, ?, ?)";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("sss", $name, $message, $time);
	$stmt->execute();
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<!-- Odświeżanie strony co 10 sekund -->
	<meta http-equiv="refresh" content="10">
	<title>Chat</title>
	<style>
		#chatBox {
			height: 300px;
			overflow-y: scroll;
			border: 1px solid #999;
		}
	</style>
</head>
<body>

<?php if (isset($_COOKIE['name'])): // Gdy cookie jest ustawione ?>
	<form action="" method="GET"><button name="logout">Wyloguj</button></form>
	<div id="chatBox">
<?php
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
?>
	</div>
	<form action="" method="POST">
		<?php echo $_COOKIE['name']; ?>
		<input type="text" name="message" id="message" placeholder="Napisz coś..." required>
		<button>Wyślij...</button>
	</form>
	<script>
		// Scrollowanie diva na sam dół
		document.getElementById('chatBox').scrollTop = chatBox.scrollHeight;
	</script>

<?php else: // Gdy cookie nie jest ustawione ?> 
	<form action="" method="POST">
		<label for="name">Podaj swoje imię:</label>
		<input id="name" name="name" placeholder="Podaj swoje imię..." required>
		<button>Wyślij</button>
	</form>

<?php endif; ?>
</body>
</html>
<?php $conn->close(); // Zakończenie połączenia z bazą ?>