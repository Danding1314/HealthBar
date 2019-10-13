<?php

declare(strict_types=1);

namespace health\bar;

use health\bar\task\HealthBarTask;
use pocketmine\plugin\PluginBase;

class HealthBar extends PluginBase{

	public function onEnable() : void{
		if(!is_dir($this->getDataFolder())){
			mkdir($this->getDataFolder());
		}
		$this->saveDefaultConfig();
		if($this->getConfig()->get("style") !== "number-symbol" || $this->getConfig()->get("style") !== "lines"){
			$this->getLogger()->warning("Invalid health bar style. Plugin disabled.");
			$this->getServer()->getPluginManager()->disablePlugin($this);
			return;
		}
		$this->getScheduler()->scheduleDelayedRepeatingTask(new HealthBarTask($this), 10, 10);
	}
}