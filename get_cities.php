<?php

$dsn = 'mysql:host=localhost;dbname=world_info;charset=utf8';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}


if (isset($_GET['countryId'])) {
    $countryId = (int)$_GET['countryId'];


    $stmt = $pdo->prepare("SELECT city FROM Cities WHERE countryId = :countryId");
    $stmt->execute([':countryId' => $countryId]);
    $cities = $stmt->fetchAll(PDO::FETCH_ASSOC);


    echo json_encode($cities);
}
?>
