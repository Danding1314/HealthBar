<?php

declare(strict_types=1);

namespace health\bar\task;

use health\bar\HealthBar;
use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat;

class HealthBarTask extends Task{

	/** @var HealthBar */
	private $plugin;

	public function __construct(HealthBar $plugin){
		$this->plugin = $plugin;
	}

	public function onRun(int $currentTick) : void{
		foreach($this->plugin->getServer()->getOnlinePlayers() as $player){
			if($player->getGamemode() === 0){
				switch($this->plugin->getConfig()->get("style")){
					case "number-symbol":
						$player->setScoreTag(TextFormat::RESET . TextFormat::WHITE . round($player->getHealth() / 2, 2) . TextFormat::RED . " ❤");
						break;
					case "lines":
						$str = "";
						$i = 0;
						while($i < $player->getMaxHealth()){
							if(round($player->getHealth() / 2) > $i){
								$str .= TextFormat::GREEN . "'";
							}else{
								$str .= TextFormat::RED . "'";
							}
							$i++;
						}
						if($player->getScoreTag() !== $str){
							$player->setScoreTag($str);
						}
						break;
				}
			}
		}
	}
}