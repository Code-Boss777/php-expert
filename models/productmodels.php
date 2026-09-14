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
//получаем данныые продукта по id
function getProductById($itemId, $db) {
    $itemId = intval($itemId);
    $sql = "SELECT * FROM products WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute(['id' => $itemId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Получить список товаров по массиву ID
 * 
 * @param array $itemIds Массив ID товаров
 * @param PDO $db Подключение к БД
 * @return array
 */
function getProductsFromArray($itemIds, $db) {
    if (empty($itemIds)) {
        return [];
    }

//создаем плейсхолдеры для подготовленного запроса
 $placeholders = implode(',', array_fill(0, count($itemIds), '?'));

    $sql = "SELECT * FROM products WHERE id IN ({$placeholders})";
    $stmt = $db->prepare($sql);
    $stmt->execute($itemIds);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
