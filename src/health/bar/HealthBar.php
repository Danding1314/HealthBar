<?php

declare(strict_types=1);

namespace health\bar;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat;

class HealthBar extends PluginBase{

	public function onEnable() : void{
		$this->getScheduler()->scheduleDelayedRepeatingTask(new class($this) extends Task{
			
			/** @var HealthBar */
			private $plugin;

			public function __construct(HealthBar $plugin){
				$this->plugin = $plugin;
			}

			public function onRun(int $currentTick) : void{
				foreach($this->plugin->getServer()->getOnlinePlayers() as $player){
					if($player->getGamemode() === 0){
						$player->setScoreTag(TextFormat::RESET . TextFormat::WHITE . $player->getHealth() / 2 . TextFormat::RED . " ❤");
					}
				}
			}
		}, 10, 10);
	}
}