<?php

namespace AlertSystem;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use AlertSystem\task\AlertTask;

class AlertSystem extends PluginBase {

    private static AlertSystem $instance;

    public static function getInstance(): AlertSystem {
        return self::$instance;
    }

    protected function onEnable(): void {
        self::$instance = $this;
        $this->saveResource("config.yml");

        $interval = $this->getConfig()->get("interval", 300);
        $this->getScheduler()->scheduleRepeatingTask(new AlertTask(), $interval * 20);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if (strtolower($command->getName()) === "alert") {
            if (empty($args)) {
                $sender->sendMessage("§cUso: /alert sendtoall <mensaje> o /alert reload");
                return true;
            }

            $sub = strtolower($args[0]);

            switch ($sub) {
                case "sendtoall":
                    if (!$sender->hasPermission("alertmessage.use")) {
                        $sender->sendMessage("§cNo tienes permiso para enviar alertas.");
                        return true;
                    }
                    if (count($args) < 2) {
                        $sender->sendMessage("§cUso: /alert sendtoall <mensaje>");
                        return true;
                    }
                    $message = implode(" ", array_slice($args, 1));
                    $prefix = $this->getConfig()->get("prefix", "§6[Alert] ");
                    Server::getInstance()->broadcastMessage($prefix . $message);
                    return true;

                case "reload":
                    if (!$sender->hasPermission("alertreload.use")) {
                        $sender->sendMessage("§cNo tienes permiso para recargar la configuración.");
                        return true;
                    }
                    $this->reloadConfig();
                    $sender->sendMessage("§aLa configuración fue recargada correctamente.");
                    return true;

                default:
                    $sender->sendMessage("§cSubcomando desconocido. Usa /alert sendtoall o /alert reload.");
                    return true;
            }
        }
        return false;
    }
}
