<?php
require_once 'CollectionController.php';
require_once 'ContributorController.php';
require_once 'CollectionModel.php';
require_once 'ContributorModel.php';
require_once 'UserController.php';
require_once 'UserModel.php';

$userController = new UserController();
// Обробка запиту
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($_GET['route'] === 'collections') {
        $controller = new CollectionController();
        $controller->getAllCollections();
    } elseif ($_GET['route'] === 'collection') {
        $controller = new CollectionController();
        $controller->getCollectionDetailsById($_GET['id']);
    } elseif ($_GET['route'] === 'collections-less-contributions') {
        $controller = new CollectionController();
        $controller->getCollectionsWithLessContributions();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['route'] === 'collection-create') {
        $controller = new CollectionController();
        $controller->createCollection($_POST['title'], $_POST['description'], $_POST['target_amount'], $_POST['link']);
    } elseif ($_POST['route'] === 'contribute') {
        $controller = new ContributorController();
        $controller->addContribution($_POST['collection_id'], $_POST['user_name'], $_POST['amount']);
    }
    elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_POST['route'] === 'token-create') {
            $controller = new UserController();
            $controller->registerUser("user123");
        }
}
/*опис маршрутів  API:

GET /collections

Опис: Отримання списку всіх зборів.
Параметри: Немає.
Відповідь:
200 OK: Повертає список зборів у форматі JSON.
GET /collection/{id}

Опис: Отримання деталей конкретного збору за ідентифікатором.
Параметри: id - ідентифікатор збору.
Відповідь:
200 OK: Повертає деталі збору у форматі JSON.
404 Not Found: Збір не знайдено.
GET /collections/less-contributions

Опис: Отримання списку зборів, які мають суму внесків менше за цільову.
Параметри: Немає.
Відповідь:
200 OK: Повертає список зборів у форматі JSON.
POST /collection/create

Опис: Створення нових зборів.
Параметри:
title: Заголовок зборів.
description: Опис зборів.
target_amount: Кінцева сума збору.
link: Посилання на збори.
Відповідь:
201 Created: Збори успішно створені.
400 Bad Request: Некоректні або відсутні дані.
POST /contribute/{collection_id}

Опис: Додавання внеску до збору.
Параметри:
collection_id: Ідентифікатор збору.
user_name: Ім'я користувача.
amount: Сума внеску.
Відповідь:
200 OK: Внесок успішно доданий.
400 Bad Request: Некоректні або відсутні дані.
Це опис маршрутів вашого API разом з HTTP-статусами, параметрами та відповідями. Не забудьте також додати коментарі до вашого коду, якщо це потрібно, для зрозумілості та документації.
*/





