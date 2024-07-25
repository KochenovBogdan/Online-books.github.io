<?php
// Подключение к базе данных
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Запись данных в базу
    $sql = "INSERT INTO feedback (name, email, message) VALUES ('$name', '$email', '$message')";
    if (mysqli_query($conn, $sql)) {
        echo "Сообщение отправлено!";
    } else {
        echo "Ошибка: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <img src="images/logo.png" alt="Логотип" style="width: 150px; height: auto;">
        <h1>Онлайн Книги</h1>
        <nav>
            <ul>
                <li><a href="index.html">Главная</a></li>
                <li><a href="books.html">Книги</a></li>
                <li><a href="about.html">О нас</a></li>
                <li><a href="contact.php">Контакты</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Обратная связь</h2>
        <form method="POST" action="contact.php">
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="message">Сообщение:</label>
            <textarea id="message" name="message" required></textarea>
            <button type="submit">Отправить</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Онлайн Книги. Все права защищены.</p>
    </footer>
</body>
</html>
