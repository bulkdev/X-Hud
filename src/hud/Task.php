<?php

namespace hud;

use pocketmine\scheduler\PluginTask;
use pocketmine\utils\TextFormat;
use pocketmine\Plugin;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\utils\Config;

Class Task extends PluginTask{

    const COUNT = 0;

    public function __construct($plugin)
    {
        $this->plugin = $plugin;
        parent::__construct($plugin);
        $this->count = Task::COUNT;
            
    }
public function onRun($currentTick)
{
    foreach ($this->getOwner()->getServer()->getOnlinePlayers() as $p){
        $message = $this->plugin->getMessage($this->count, $p);
        $p->sendTip($message);
        $this->count++;
       }
       
       if($this->count >= $this->plugin->count){
           $this->count-=$this->plugin->count;
       }
        }

}
