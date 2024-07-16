php
     <?php

     use PHPUnit\Framework\TestCase;
     use Telegram\Bot\Api;

     class BotTest extends TestCase
     {
         public function testBotResponse()
         {
             $telegram = new Api(getenv('TELEGRAM_BOT_API_TOKEN'));
             $response = $telegram->sendMessage([
                 'chat_id' => 'your_chat_id',
                 'text' => 'Test message'
             ]);

             $this->assertNotEmpty($response);
         }
     }
