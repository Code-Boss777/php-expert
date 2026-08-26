<?php

/**
 * Добавить товар в корзину
 * 
 * @param int $productId
 * @return array
 */
function addToCart($productId) {
    // Если корзины нет — создаём
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // Если товар уже есть — увеличиваем количество
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]++;
    } else {
        $_SESSION['cart'][$productId] = 1;
    }
    
    return $_SESSION['cart'];
}

/**
 * Получить общее количество товаров в корзине
 * 
 * @return int
 */
function getCartCount() {
    if (!isset($_SESSION['cart'])) {
        return 0;
    }
    
    return array_sum($_SESSION['cart']);
}

/**
 * Получить содержимое корзины
 * 
 * @return array
 */
function getCartItems() {
    if (!isset($_SESSION['cart'])) {
        return [];
    }
    
    return $_SESSION['cart'];
}