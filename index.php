<?php
require_once "Vendor/autoload.php";
use MongoDB\Client;

$client = new \MongoDB\Client("mongodb://127.0.0.1/");
$db = $client->shop->items;
?>

<!doctype html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>lb1</title>
    <script src = "script.js"></script>
</head>
<body bgcolor="#7fffd4" >
<form action="" method="post">
    <input type="submit" value="Список виробників" name="vendor"><br> <! -- виробники -->

</form>
<br>
<form action="" method="post">
    <input type="submit" value="Відсутні на складі товари" name="items"><br> <! -- пошук по категоріям -->

</form>
<br>
<form action="" method="post">
    <input placeholder="Мінімальна ціна:" type="text" name="min_price"> <! -- Пошук по цінам -->
    <input placeholder="Максимальна ціна:" type="text" name="max_price">
    <input type="submit" value="Пошук"><br>

</form>

<br>

<button onclick="LookData()">
    Вивести збереженні данні
</button>
<button onclick="SaveData()">
    Зберегти данні
</button>

<div id="savedContent"></div>


<?php

if (isset($_POST["vendor"])) {
    $statement = $db->distinct("Vendor");
echo "<div id='content'>";
    foreach ($statement as $value) {
        echo " <br> Виробник: {$value} ";}
}
echo "</div>";

if (isset($_POST["items"])) {
    $statement = $db->find(["Quantity" => 0]);
    echo "<div id='content'>";
    foreach ($statement->toArray() as $data) {
        echo "<br> Назва: {$data['Name']}  . ; Ціна: {$data['Price']}  . ; Кількість: {$data['Quantity']}  . ; Якість: {$data['Quality']} ";}
}
echo "</div>";

// запрос по ценам
if (isset($_POST["min_price"])) {
    $min = intval($_POST["min_price"]);
    $max = intval($_POST["max_price"]);
    $statement = $db->find(["Price" => ['$gte' => $min, '$lte' => $max ]] );
    echo "<div id='content'>";
    foreach ($statement as $data) {
        echo "<br>Назва: {$data['Name']}  . ; Ціна: {$data['Price']}  . ; Кількість: {$data['Quantity']}  . ; Якість: {$data['Quality']} ";}
}
echo "</div>";
?>
</body>
</html>
