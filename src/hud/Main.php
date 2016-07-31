<?php

namespace hud;


use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\scheduler\PluginTask;
use pocketmine\Player;

Class Main extends PluginBase implements Listener{

    public function onEnable()
    {
        @mkdir($this->getDataFolder());
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getScheduler()->scheduleRepeatingTask(new Task($this), 20);
        $this->money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
        $this->factions = $this->getServer()->getPluginManager()->getPlugin("FactionsPro");
    }
    
    public function getMessage($current, Player $player){
        $messages = $this->config()->get("Messages");
        return $this->formatMessage($message[$current], $player);
    }
    public function formatMessage($message, Player $player){
        $message = str_replace("{X}", round($player->getX()), $message);
        $message = str_replace("{Y}", round($player->getY()), $message);
        $message = str_replace("{Z}", round($player->getZ()), $message);
        $message = str_replace("{NAME}", $player->getName(), $message);
        $message = str_replace("{WORLD}", $player->getLevel()->getName(), $message);
        $message = str_replace("{NEXTLINE}", "\n", $message);
        $message = str_replace("{N}", "\n", $message);
        $message = str_replace("{LINE}", "\n", $message);
        $message = str_replace("{PLAYERS}", count($this->getServer()->getOnlinePlayers()), $message);
        if($this->money != null){
            $message = str_replace("{MONEY}", $this->money->myMoney($player), $message);
        }
        if($this->factions != null){
            $message = str_replace("{FACNAME}", $this->factions->getPlayerFaction($player), $message);
            $message = str_replace("{FACPOWER}", $this->factions->getFactionPower($this->factions->getPlayerFaction($player)), $message);
        }
        return $message;
        
    }


}
