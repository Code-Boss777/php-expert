function updateCategory(id) {
    var name = $('#catName_' + id).val();
    var parentId = $('#catParent_' + id).val();
    
    $.ajax({
        type: 'POST',
        url: '/admin/updatecategory/',
        data: { id: id, name: name, parent_id: parentId },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert('Категория сохранена!');
            } else {
                alert('Ошибка: ' + response.message);
            }
        },
        error: function() {
            alert('Ошибка соединения с сервером');
        }
    });
}