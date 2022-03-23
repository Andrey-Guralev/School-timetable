<?php

namespace App\Telegram\Commands;

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
        $response = $this->getUpdate();

        $text = $response;

        $this->replyWithMessage(compact('text'));

    }
}
