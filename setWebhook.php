php
<?php

require 'vendor/autoload.php';

use Telegram\Bot\Api;

$telegram = new Api(getenv('TELEGRAM_BOT_API_TOKEN'));
$telegram->setWebhook(['url' => 'https://yourdomain.com/bot.php']);
