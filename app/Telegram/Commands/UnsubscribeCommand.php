<?php

namespace App\Telegram\Commands;

use App\Actions\Translit;
use App\Models\Classes;
use App\Models\TelegramSubscribers;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram;

class UnsubscribeCommand extends Command
{
    protected $name = 'subscribe';

    protected $description = 'Команда для подписку на уведомления';

    /**
     * {@inheritdoc}
     */
    public function handle()
    {
        $response = $this->getUpdate();

        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $chatId = $response->getMessage()->chat->id;

        $subs = TelegramSubscribers::where('chat_id', $chatId)->delete();

        $text = 'Вы отписались от уведомлений';

        $this->replyWithMessage(compact('text'));

    }
}
