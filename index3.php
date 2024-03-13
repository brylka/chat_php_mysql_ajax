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
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
	</div>
	<form id="messageForm">
		<?php echo $_COOKIE['name']; ?>
		<input type="text" name="message" id="message" placeholder="Napisz coś..." required>
		<button>Wyślij...</button>
	</form>
<?php else: // Gdy cookie nie jest ustawione ?> 
	<form action="" method="POST">
		<label for="name">Podaj swoje imię:</label>
		<input id="name" name="name" placeholder="Podaj swoje imię..." required>
		<button>Wyślij</button>
	</form>

<?php endif; ?>

<script>
$(document).ready(function() {
	
	fetchMessages()
	
	setInterval(fetchMessages, 1000)
	
	function fetchMessages() {
		$.ajax({
			type: "GET",
			url: "fetchMessages.php",
			success: function(response) {
				$('#chatBox').html(response)
				$('#chatBox').scrollTop($('#chatBox')[0].scrollHeight)
			}
		})
	}
	
	
	$('#messageForm').submit(function(event) {
		event.preventDefault()
		$.ajax({
			type: "POST",
			url: "sendMessage.php",
			data: "message=" + $('#message').val(),
			success: function(response) {
				$('#message').val('')
				fetchMessages()
			}
		})
	})
	
	
	
})
</script>
</body>
</html>
