<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use Telegram;

/**
 * Class HelpCommand.
 */
class HelpCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'help';

    /**
     * @var array Command Aliases
     */
    protected $aliases = ['listcommands'];

    /**
     * @var string Command Description
     */
    protected $description = 'Help command, Get a list of all commands';

    /**
     * {@inheritdoc}
     */
    public function handle()

    {
        $response = $this->getUpdate();

        $text = 'Команды:'.chr(10).chr(10);
        $text .= '/start - Начало работы с ботом'.chr(10);
        $text .= '/help - Вывод списка всех комманд'.chr(10);
        $text .= '/subscribe ';
//        $text .= '/viewTimetable [название класса] - Вывод расписания (например: /viewTimetable 11ИТ)'.chr(10);

        $this->replyWithMessage(compact('text'));

    }
}
