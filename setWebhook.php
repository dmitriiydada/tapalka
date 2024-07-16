php
<?php

require 'vendor/autoload.php';

use Telegram\Bot\Api;

$telegram = new Api(getenv('7376577660:AAHCfC8r4rz7PtReqBq4TmCWWY3KSygsnJI'));
$telegram->setWebhook(['url' => 'https://your-github-pages-url/bot.php']);
