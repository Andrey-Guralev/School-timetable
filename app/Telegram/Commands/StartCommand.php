<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Actions;
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

        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $text = 'Привет, это бот расписания Лицея №6 "Перспектива"'.chr(10).chr(10);
        $text .= 'Также есть сайт:'.chr(10);
        $text .= env('APP_URL').chr(10).chr(10);
        $text .= 'Для вывода всех команд, необходимо использовать команду: /help'.chr(10);


        $this->replyWithMessage(compact('text'));

    }
}
