php
<?php

require 'vendor/autoload.php';

use Telegram\Bot\Api;

$telegram = new Api(getenv('TELEGRAM_BOT_API_TOKEN'));

// Получение обновлений
$updates = $telegram->getWebhookUpdates();

foreach ($updates as $update) {
    $message = $update->getMessage();
    $chatId = $message->getChat()->getId();
    $text = $message->getText();

    if ($text === '/start') {
        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => 'Привет! Я ваш новый бот.'
        ]);
    }

    // Добавьте здесь логику для других команд
}
