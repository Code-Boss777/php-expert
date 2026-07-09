<?php
//модель для работы с таблицей categories

//создаем функцию rsCategories

//return adday массив категорий
function getAllMainCatsWithChildren() {
    global $db;
    $sql = 'SELECT *
           FROM categories
           WHERE parent_id = 0';
           $rs = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
           $smartyRs = array();
           foreach ($rs as $row) {
            $rsChildren = getChildrenForCat($row['id']);
            if ($rsChildren) {
                $row['children'] = $rsChildren;
            }
            $smartyRs[] = $row;
           }
           return $smartyRs;
}
function getChildrenForCat($catId) {
    global $db;
    $sql = "SELECT *
            FROM categories
            WHERE parent_id = {$catId}";
    $rs = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    return $rs;
}

