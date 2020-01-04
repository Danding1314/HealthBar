<?php

declare(strict_types=1);

namespace cignuss\HealthBar;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\TextFormat;

class Main extends PluginBase{

	public function onEnable() : void{
		$this->getScheduler()->scheduleDelayedRepeatingTask(new ClosureTask(function(int $currentTick) : void{
			foreach($this->getServer()->getOnlinePlayers() as $player){
				if(!$player->isSurvival() || !$player->isAdventure()){
					continue;
				}
				$player->setScoreTag(TextFormat::RESET . TextFormat::WHITE . round($player->getHealth() / 2, 2) . TextFormat::RED . " ❤");
			}
		}), 10, 10);
	}
}