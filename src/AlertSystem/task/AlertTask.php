<?php

namespace AlertSystem\task;

use pocketmine\scheduler\Task;
use pocketmine\Server;

use AlertSystem\AlertSystem;

class AlertTask extends Task {
    private int $index = 0;

    public function onRun(): void {
        $messages = AlertSystem::getInstance()->getConfig()->get("messages", []);
        $prefix = AlertSystem::getInstance()->getConfig()->get("prefix", "[Alert] ");

        if(empty($messages)) {
            return;
        }
        $message = $messages[$this->index] ?? $messages[0];
        Server::getInstance()->broadcastMessage($prefix . $message);
        $this->index = ($this->index + 1) % count($messages);
    }
}
