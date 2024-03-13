<?php

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
	
	$conn->close();
}