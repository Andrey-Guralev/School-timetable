<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use Telegram;

class ViewTimetableCommand extends Command
{
    protected $name = 'viewTimetable';

    protected $description = 'Команда начала работы бота';

    /**
     * {@inheritdoc}
     */
    public function handle()
    {
        $response = $this->getUpdate();

        $text = $response;
        $text .= ' krw0e-jw0';

        $this->replyWithMessage(compact('text'));

    }
}
