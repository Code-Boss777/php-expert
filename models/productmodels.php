<?php
//модель про продукции таблицы 

function getLastProducts(int $limit = null): array {
global $db;
$sql = "SELECT * FROM products ORDER BY id DESC";
$rs = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
return $rs;
}
/**
 * Получить список товаров, принадлежащих определенной категории
 * 
 * @param integer $catId ID категории
 * @return array Массив товаров этой категории
 */
function getProductsByCat(int $catId): array {
    global $db;

    $sql = "SELECT * FROM products WHERE category_id = :catId ORDER BY id DESC";

    $stmt = $db->prepare($sql);
    $stmt->execute(['catId' => $catId]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
