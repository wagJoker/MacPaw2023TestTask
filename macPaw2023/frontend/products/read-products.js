jQuery(($) => {

    // Показать список товаров при первой загрузке
    showProducts();
});

// Здесь будет метод showProducts()
// При нажатии кнопки
$(document).on("click", ".read-products-button", () => {
    showProducts();
});
// Функция для показа списка товаров
function showProducts() {
// Получить список товаров из API
    $.getJSON("http://rest-api/api/product/read.php", data => {

    });
}
// HTML для списка товаров
let read_products_html = `

    <!-- При нажатии загружается форма создания товара -->
    <div id="create-product" class="btn btn-primary pull-right m-b-15px create-product-button">
        <span class="glyphicon glyphicon-plus"></span> Создание товара
    </div>
    
    <!-- Таблица товаров -->
<table class="table table-bordered table-hover">

    <!-- Создание заголовков таблицы -->
    <tr>
        <th class="w-15-pct">Название</th>
        <th class="w-10-pct">Цена</th>
        <th class="w-15-pct">Категория</th>
        <th class="w-25-pct text-align-center">Действие</th>
    </tr>`;

// Здесь будут строки
// Перебор списка возвращаемых данных
$.each(data.records, function (key, val) {

    // Создание новой строки таблицы для каждой записи
    read_products_html += `
        <tr>
            <td>` + val.name + `</td>
            <td>` + val.price + `</td>
            <td>` + val.category_name + `</td>

            <!-- Кнопки "действий" -->
            <td>
                <!-- Кнопка чтения товара -->
                <button class="btn btn-primary m-r-10px read-one-product-button" data-id="` + val.id + `">
                    <span class="glyphicon glyphicon-eye-open"></span> Просмотр
                </button>
                <!-- Кнопка редактирования -->
                <button class="btn btn-info m-r-10px update-product-button" data-id="` + val.id + `">
                    <span class="glyphicon glyphicon-edit"></span> Редактирование
                </button>
                <!-- Кнопка удаления товара -->
                <button class="btn btn-danger delete-product-button" data-id="` + val.id + `">
                    <span class="glyphicon glyphicon-remove"></span> Удаление
                </button>
            </td>
        </tr>`;
});

read_products_html += `</table>`;