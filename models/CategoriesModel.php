<?php
//модель для работы с таблицей categories

//создаем функцию rsCategories 
function getAllMainCatsWithChildren() {
    global $db;
    $sql = 'SELECT *
           FROM categories
           WHERE parent_id = 0';
           $rs = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
           return $rs;
}


