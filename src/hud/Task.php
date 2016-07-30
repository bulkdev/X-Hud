<?php

namespace hud;

use pocketmine\scheduler\PluginTask;
use pocketmine\utils\TextFormat;
use pocketmine\Plugin;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\utils\Config;

Class Task extends PluginTask{

    public function __construct($plugin)
    {
        $this->plugin = $plugin;
        parent::__construct($plugin);
        $this->getServer()->getPluginManage()->getPlugin("EconomyAPI");
        $this->money = \onebone\economyapi\EconomyAPI::getInstance ();
    }
public function onRun($currentTick)
{
    foreach ($this->getOwner()->getServer()->getOnlinePlayers() as $p){
        $message = $this->plugin->getConfig()->get("Message");
           $faggot = str_replace("{X}",round($p->getX()),$message);
           $faggo = str_replace("{Y}",round($p->getY()),$faggot);
           $fagg = str_replace("{Z}",round($p->getZ()),$faggo);
           $fag = str_replace("{NAME}",$p->getName(),$fagg);
           $fa = str_replace("{WORLD}",$p->getLevel()->getName(),$fag);
           $f = str_replace("{NEXTLINE}","\n",$fa);
           $fu = str_replace("{MONEY}",$this->money->myMoney($p),$f);
        $p->sendTip($fu);

       }
        }

}
