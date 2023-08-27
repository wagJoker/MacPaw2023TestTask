<?php
namespace api\controllers;

use api\models\CollectionModel;

class CollectionController
{
    public function actionIndex()
    {
        try {
            $collections = CollectionModel::findAll();

            // Повернути список зборів у форматі JSON
            echo json_encode($collections);
        } catch (\Exception $e) {
            // Обробка помилки
            echo json_encode(['error' => 'An error occurred']);
        }
    }

    public function actionCreate()
    {
        try {
            // Отримати дані з запиту POST
            $title = $_POST['title'];
            $description = $_POST['description'];
            $targetAmount = $_POST['target_amount'];
            $link = $_POST['link'];

            // Валідація даних
            if (empty($title) || empty($description) || !is_numeric($targetAmount)) {
                echo json_encode(['error' => 'Invalid data']);
                return;
            }

            // Створити новий збір
            $collection = new CollectionModel();
            $collection->setTitle($title);
            $collection->setDescription($description);
            $collection->setTargetAmount($targetAmount);
            $collection->setLink($link);
            $collection->setCreatedAt(date('Y-m-d H:i:s'));
            $collection->save();

            // Повернути результат створення у форматі JSON
            echo json_encode(['message' => 'Collection created successfully']);
        } catch (\Exception $e) {
            // Обробка помилки
            echo json_encode(['error' => 'An error occurred']);
        }
    }
    public function actionUpdate($id)
    {
        try {
            // Знайти і оновити збір
            $collection = CollectionModel::findById($id);
            if (!$collection) {
                echo json_encode(['error' => 'Collection not found']);
                return;
            }

            // Отримати дані з запиту PUT
            parse_str(file_get_contents("php://input"), $putData);
            $title = $putData['title'];
            $description = $putData['description'];
            $targetAmount = $putData['target_amount'];
            $link = $putData['link'];

            // Валідація даних
            if (empty($title) || empty($description) || !is_numeric($targetAmount)) {
                echo json_encode(['error' => 'Invalid data']);
                return;
            }

            // Оновити збір
            $collection->setTitle($title);
            $collection->setDescription($description);
            $collection->setTargetAmount($targetAmount);
            $collection->setLink($link);
            $collection->save();

            // Повернути результат оновлення у форматі JSON
            echo json_encode(['message' => 'Collection updated successfully']);
        } catch (\Exception $e) {
            // Обробка помилки
            echo json_encode(['error' => 'An error occurred']);
        }
    }

    public function actionDelete($id)
    {
        try {
            // Знайти і видалити збір
            $collection = CollectionModel::findById($id);
            if (!$collection) {
                echo json_encode(['error' => 'Collection not found']);
                return;
            }

            $collection->delete();

            // Повернути результат видалення у форматі JSON
            echo json_encode(['message' => 'Collection deleted successfully']);
        } catch (\Exception $e) {
            // Обробка помилки
            echo json_encode(['error' => 'An error occurred']);
        }
    }
    public function getCollectionDetails($collectionId) {
        // Виклик методу моделі для отримання деталей збору
        $collectionModel = new CollectionModel();
        $details = $collectionModel->getCollectionDetails($collectionId);

        // Перевірка, чи є деталі збору
        if (!$details) {
            return ['error' => 'Collection not found'];
        }

        // Повернення деталей збору
        return json_encode($details);

    }

    public function getCollectionsByRemainingAmount() {
        $collectionModel = new CollectionModel();
        $collections = $collectionModel->getCollectionsByRemainingAmount();

        // Повернення списку зборів, що відповідають фільтру
        return json_encode($collections);
    }
    public function getCollectionsWithLessContributions() {
        $collectionModel = new CollectionModel();
        $collections = $collectionModel->getCollectionsWithLessContributions();

        // Повернення списку зборів з меншою сумою внесків
        return json_encode($collections);
    }




    // TODO:Додати інші методи для оновлення, видалення та перегляду зборів з валідацією і обробкою помилок
}