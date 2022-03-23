<?php

namespace App\Telegram\Commands;

use App\Actions\Translit;
use App\Models\Classes;
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

        $args = explode(' ', $response->getMessage()->text);

//        if (count($args) >= 1) {
//            $text = 'Слишком много аргуметов';
//            $this->replyWithMessage(compact('text'));
//            return;
//        }
//
//        $className = Translit::translitInEn($args[1]);
//
//        $class = Classes::where('alias', $className)->get();
//
//        $text = $class;

        $text = count($args);

        $this->replyWithMessage(compact('text'));

    }
}
