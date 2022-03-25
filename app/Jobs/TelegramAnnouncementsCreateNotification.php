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

class TelegramAnnouncementsCreateNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $announcement;

    public function __construct($announcement)
    {
        $this->announcement = $announcement;
    }

    public function handle()
    {
        if (env('APP_ENV') == 'production')
        {
            if ($this->announcement->type == 1) {
                $subs = TelegramSubscribers::all();
            } else {
                $subs = TelegramSubscribers::where('class_id', $this->announcement->class_id)->get();
            }

            foreach ($subs as $sub) {
                Telegram::sendMessage([
                    'chat_id' => $sub->chat_id,
                    'text' => 'У тебя изменилось расписание'.chr(10).chr(10).'Посмотреть: '.env('APP_URL'),
                ]);
            }
        } else {
            \Log::info("Объявления: " . $this->announcement->id);
        }
    }
}
