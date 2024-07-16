php
<?php

require 'vendor/autoload.php';

use Telegram\Bot\Api;

$telegram = new Api(getenv('TELEGRAM_BOT_API_TOKEN'));

// Функция для выполнения "тапания" в игре Hamster Kombat
function tapInHamsterKombat($userId) {
    // Пример запроса к API Hamster Kombat
    $response = file_get_contents('https://api.hamsterkombat.com/tap?user_id=' . $userId);

    // Обработка ответа API
    if ($response) {
        return json_decode($response, true);
    } else {
        return false;
    }
}

// Функция для получения статуса пользователя в игре Hamster Kombat
function getStatusInHamsterKombat($userId) {
    // Пример запроса к API Hamster Kombat
    $response = file_get_contents('https://api.hamsterkombat.com/status?user_id=' . $userId);

    // Обработка ответа API
    if ($response) {
        return json_decode($response, true);
    } else {
        return false;
    }
}

// Получение обновлений
$updates = $telegram->getWebhookUpdates();

foreach ($updates as $update) {
    $message = $update->getMessage();
    $chatId = $message->getChat()->getId();
    $text = $message->getText();

    if ($text === '/start') {
        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => 'Привет! Я ваш новый бот для взаимодействия с Hamster Kombat.'
        ]);
    } elseif ($text === '/help') {
        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => 'Доступные команды: /start, /help, /tap, /status'
        ]);
    } elseif ($text === '/tap') {
        $result = tapInHamsterKombat($chatId);

        if ($result && $result['success']) {
            $telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => 'Вы успешно тапнули!'
            ]);
        } else {
            $telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => 'Не удалось выполнить тапание.'
            ]);
        }
    } elseif ($text === '/status') {
        $status = getStatusInHamsterKombat($chatId);

        if ($status) {
            $telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => 'Ваш текущий статус: ' . $status['status']
            ]);
        } else {
            $telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => 'Не удалось получить статус.'
            ]);
        }
    } else {
        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => 'Неизвестная команда. Используйте /help для списка доступных команд.'
        ]);
    }
}
