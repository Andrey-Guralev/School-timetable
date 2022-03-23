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
        $response = $this->getUpdate();

        $args = $this->getArguments();

        \Log::info($args[1] ?? '');
//        \Log::info($response ?? '');

        $text = '1' . $response->text ?? '132312';

        $this->replyWithMessage(compact('text'));

    }
}
