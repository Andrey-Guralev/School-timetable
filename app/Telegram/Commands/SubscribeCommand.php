<?php

namespace App\Telegram\Commands;

use App\Actions\Translit;
use App\Models\Classes;
use App\Models\TelegramSubscribers;
use Telegram\Bot\Actions;
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

        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $args = explode(' ', $response->getMessage()->text);

        if (count($args) > 2) {
            $text = 'Слишком много аргуметов';
            $this->replyWithMessage(compact('text'));
            return;
        }

        if (count($args) == 1) {
            $text = 'Необходимо указать класс'.chr(10);
            $text .= '(например: /subscribe 11ФМ)';
            $this->replyWithMessage(compact('text'));
            return;
        }

        $className = Translit::translitInEn($args[1]);

        $class = Classes::where('alias', $className)->get();

        $this->replyWithMessage(compact('class'));

        return;


        if ($class->isEmpty()) {
            $text = 'Не удалось найти такой класс'.chr(10);
            $this->replyWithMessage(compact('text'));
            return;
        }

        $chatId = $response->getMessage()->chat->id;

        $subs = TelegramSubscribers::where('chat_id', $chatId)->where('class_id', $class->id)->get();

        if ($subs->isNotEmpty()) {
            $text = 'Вы уже подписаны'.chr(10);
            $this->replyWithMessage(compact('text'));
            return;
        }

        $subs = new TelegramSubscribers();

        $subs->chat_id = $chatId;
        $subs->class_id = $class->id;

        $subs->save();

        $text = 'Вы успешно подписались на уведомления, для класса:' . $class->getFullName();

        $this->replyWithMessage(compact('text'));

    }
}
