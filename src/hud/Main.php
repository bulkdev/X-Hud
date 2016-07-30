<?php

namespace hud;


use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\scheduler\PluginTask;

Class Main extends PluginBase implements Listener{

    public function onEnable()
    {
        @mkdir($this->getDataFolder());
        $config = new Config($this->getDataFolder() . "config.yml", Config::YAML,array("Message" => "X-Hud {X} {Y} {Z}"));
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getScheduler()->scheduleRepeatingTask(new Task($this), 20);

    }



}
