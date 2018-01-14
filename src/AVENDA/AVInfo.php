<?php

namespace AVENDA;

use pocketmine\plugin\PluginBase;
use VultrM\VultrM;
use pocketmine\Player;
use pocketmine\scheduler\PluginTask;

class AVInfo extends PluginBase {
	public function onEnable() {
		$this->getServer ()->getScheduler ()->scheduleRepeatingTask ( new Task ( $this ), 20 );
	}
	public function info(Player $player) {
		$n = $player->getName ();
		$pl = count ( $this->getServer ()->getOnlinePlayers () );
		$mpl = $this->getServer ()->getMaxPlayers ();
		$tps = ($this->getServer ()->getTicksPerSecond () * 5);
		$motd = $this->getServer ()->getMotd ();
		$mem = $this->getServer ()->getTickUsage ();
		$player->sendPopup ( "§f§l[{$motd}§f]\n{$n}의 §7§l돈 : " . VultrM::getInstance ()->mymoney ( $player ) . "\n서버 인원 : " . $pl . "/" . $mpl . "\n메모리 사용량 : " . $mem . "\nTPS : " . $tps . "(퍼센트)" );
	}
}
class Task extends PluginTask {
	protected $owner;
	public function __construct(AVInfo $owner) {
		$this->owner = $owner;
	}
	public function onRun($currentTick) {
		foreach ( $this->owner->getServer ()->getOnlinePlayers () as $player ) {
			$this->owner->info ( $player );
		}
	}
}
