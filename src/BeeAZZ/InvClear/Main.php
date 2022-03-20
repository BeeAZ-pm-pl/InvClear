<?php

namespace BeeAZZ\InvClear;

use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener{
  
  public function onEnable(): void{
   $this->getServer()->getPluginManager()->registerEvents($this, $this);
   $this->saveDefaultConfig();
  }
  public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
   switch($cmd->getName()){
    case "clearinv":
     if(!$sender instanceof Player){
      $sender->sendMessage("Please use command in game");
      return true;
     }
     if($sender->hasPermission("invclear.command.inv")){
     if(isset($args[0])){
     if($this->getServer()->getPlayerByPrefix($args[0]) !== null){
      $player = $this->getServer()->getPlayerByPrefix($args[0]);
      $player->getInventory()->clearAll();
      $sender->sendMessage(str_replace("{player}", $this->getServer()->getPlayerByPrefix($args[0]), $this->getConfig()->get("clearinv-msg")));
     }else{
       $sender->sendMessage($this->getConfig()->get("no-player"));
     }
     }else{
       $sender->sendMessage($this->getConfig()->get("usage-inv"));
     }
     break;
     }
     case "cleararmor":
     if(!$sender instanceof Player){
      $sender->sendMessage("Please use command in game");
      return true;
     }
     if($sender->hasPermission("invclear.command.armor")){
     if(isset($args[0])){
     if($this->getServer()->getPlayerByPrefix($args[0]) !== null){
      $player = $this->getServer()->getPlayerByPrefix($args[0]);
      $player->getArmorInventory()->clearAll();
      $sender->sendMessage(str_replace("{player}", $this->getServer()->getPlayerByPrefix($args[0]), $this->getConfig()->get("cleararmor-msg")));
     }else{
       $sender->sendMessage($this->getConfig()->get("no-player"));
     }
     }else{
       $sender->sendMessage($this->getConfig()->get("usage-armor"));
     }
     break;
     }
   return true;
   }
 return true;
  }
}