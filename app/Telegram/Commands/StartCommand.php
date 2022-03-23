<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use Telegram;

class StartCommand extends Command
{
    protected $name = 'start';

    protected $description = 'Команда начала работы бота';

    /**
     * {@inheritdoc}
     */
    public function handle()
    {
        $response = $this->getUpdate();

        $text = 'Привет, это бот расписания Лицея №6 "Перспектива"'.chr(10).chr(10);
        $text .= 'Также есть сайт:'.chr(10);
        $text .= env('APP_URL').chr(10).chr(10);
        $text .= 'Чтобы увидеть список всех команд, надо ввести команду /help'.chr(10);

        $keyboard = [
            ['7', '8', '9'],
            ['4', '5', '6'],
            ['1', '2', '3'],
            ['0']
        ];

        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ]);

        $this->replyWithMessage(compact('text'));

    }
}
