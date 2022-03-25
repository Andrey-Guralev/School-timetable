<?php

namespace App\Jobs;

use App\Models\TelegramSubscribers;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramTimetableUpdateNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $class_id;

    public function __construct($class_id)
    {
        $this->class_id = $class_id;
    }

    public function handle()
    {
//        if (env('APP_ENV') == 'production') {
            $subs = TelegramSubscribers::where('class_id', $this->class_id)->get();

            foreach ($subs as $sub) {
                Telegram::sendMessage([
                    'chat_id' => $sub->chat_id,
                    'text' => 'У тебя изменилось расписание'.chr(10).chr(10).'Посмотреть: '.env('APP_URL'),
                ]);
            }
//        } else {
//            \Log::info('Обрновление расписания у класса: ' . $this->class_id);
//        }
    }
}
