<?php
// Подключаемся к базе данных
$dsn = 'mysql:host=localhost;dbname=world_info;charset=utf8';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
$countries = $pdo->query("SELECT * FROM Countries ORDER BY country ASC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список стран и городов</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container fade-in">
    <h1>Выберите страну</h1>
    <select id="countrySelect">
        <option value="">-- Выберите страну --</option>
        <?php foreach ($countries as $country): ?>
            <option value="<?= $country['id']; ?>"><?= htmlspecialchars($country['country']); ?></option>
        <?php endforeach; ?>
    </select>
    <table id="citiesTable">
        <thead>
        <tr>
            <th>Город</th>
        </tr>
        </thead>
        <tbody id="citiesTableBody">
        </tbody>
    </table>
</div>
<script src="scripts.js"></script>
</body>
</html>