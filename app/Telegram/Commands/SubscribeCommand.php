<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use Telegram;

class SubscribeCommand extends Command
{
    protected $name = 'subscribe';

    protected $description = 'Команда для подписку на уведомления';

    /**
     * {@inheritdoc}
     */
    public function handle()
    {
        $response = $this->getUpdate()->all();

        $args = $this->getArguments();

        \Log::info($args[1] ?? '');
        \Log::info($response[0] ?? '');

        $text = 'Данная команда пока не работает';

        $this->replyWithMessage(compact('text'));

    }
}
