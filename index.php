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
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<title>Chat</title>
</head>
<body>

<?php
// Zawartośc gdy ustawione jest ciasteczko
if (isset($_COOKIE['name'])) {
	echo "<p>Witaj " . $_COOKIE['name'] . "!</p>";
	echo '<form action="" method="GET"><button name="logout">Wyloguj</button></form>';
} else {
// Zawartość gdy ciasteczko nie jest ustawione
?>
	<form action="" method="POST">
		<label for="name">Podaj swoje imię:</label>
		<input id="name" name="name" placeholder="Podaj swoje imię..." required>
		<button>Wyślij</button>
	</form>
<?php
}
?>
</body>
</html>