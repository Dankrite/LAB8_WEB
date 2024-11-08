<?php
// Вказуємо URL для отримання даних
$url = 'http://lab.vntu.org/api-server/lab8.php?user=student&pass=p@ssw0rd';

// Отримуємо JSON-дані за допомогою file_get_contents або cURL
$response = file_get_contents($url);

// Перевірка, чи вдалося отримати дані
if ($response === FALSE) {
    die('Помилка при отриманні даних');
}

// Декодуємо JSON-дані в асоціативний масив (це значення true в параметрі json_decode)
$data = json_decode($response, true);

// Перевірка, чи вдалося декодувати JSON
if ($data === NULL) {
    die('Помилка при декодуванні JSON');
}

// Об’єднуємо всі записи про людей в один масив
$people = [];
foreach ($data as $group) {
    foreach ($group as $record) {
        $people[] = $record; // Додаємо кожен запис у масив
    }
}

// Виводимо дані в HTML-таблицю
echo '<table border="1">';
echo '<tr><th>Ім\'я</th><th>Принадлежність</th><th>Ранг</th><th>Локація</th></tr>';

foreach ($people as $person) {
    // Перевіряємо, чи існує кожне значення перед використанням htmlspecialchars
    echo '<tr>';
    echo '<td>' . htmlspecialchars($person['name'] ?? 'N/A') . '</td>';
    echo '<td>' . htmlspecialchars($person['affiliation'] ?? 'N/A') . '</td>';
    echo '<td>' . htmlspecialchars($person['rank'] ?? 'N/A') . '</td>';
    echo '<td>' . htmlspecialchars($person['location'] ?? 'N/A') . '</td>';
    echo '</tr>';
}

echo '</table>';
?>
