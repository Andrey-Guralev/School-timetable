<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram;

class ViewTimetableCommand extends Command
{
    protected $name = 'viewTimetable';

    protected $description = 'Команда просмотра расписания для класса';

    /**
     * {@inheritdoc}
     */
    public function handle()
    {
        $response = $this->getArguments();

        $this->replyWithChatAction(['action' => Actions::TYPING]);

//        \Log::info((string)$response);
        $text = 'Данная команда пока не работает';

        $this->replyWithMessage(compact('text'));

    }
}
