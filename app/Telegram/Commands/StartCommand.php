<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use Telegram;

/**
 * Class HelpCommand.
 */
class StartCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'start';

    /**
     * @var array Command Aliases
     */
    protected $aliases = ['listcommands'];

    /**
     * @var string Command Description
     */
    protected $description = 'Команда начала работы бота';

    /**
     * {@inheritdoc}
     */
    public function handle()
    {
        $response = $this->getUpdate();

        $text = 'Привет, это бот расписания Лицея №6 Перспектива'.chr(10).chr(10);
        $text .= 'Также есть сайт:'.chr(10).chr(10);
        $text .= env('APP_URL').chr(10).chr(10);


        $this->replyWithMessage(compact('text'));

    }
}
