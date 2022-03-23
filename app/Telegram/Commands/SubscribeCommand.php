<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use Telegram;

class SubscribeCommand extends Command
{
    protected $name = 'subscribe';

    protected $description = 'Команда просмотра расписания для класса';

    /**
     * {@inheritdoc}
     */
    public function handle()
    {
        $response = $this->getArguments();

//        \Log::info((string)$response);
        $text = 'Данная команда пока не работает';

        $this->replyWithMessage(compact('text'));

    }
}
