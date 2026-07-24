<?php
//модель про продукции таблицы 

function getLastProducts(int $limit = null): array {
global $db;
$sql = "SELECT * FROM products ORDER BY id DESC";
$rs = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
return $rs;
}
