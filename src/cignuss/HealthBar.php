<?php

declare(strict_types=1);

namespace cignuss;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\TextFormat;

class HealthBar extends PluginBase{

	public function onEnable() : void{
		$this->getScheduler()->scheduleDelayedRepeatingTask(new ClosureTask(function(int $currentTick) : void{
			foreach($this->getServer()->getOnlinePlayers() as $player){
				if($player->getGamemode() !== Player::SURVIVAL){
					continue;
				}
				$player->setScoreTag(TextFormat::RESET . TextFormat::WHITE . round($player->getHealth() / 2, 2) . TextFormat::RED . " ❤");
			}
		}), 10, 10);
	}
}