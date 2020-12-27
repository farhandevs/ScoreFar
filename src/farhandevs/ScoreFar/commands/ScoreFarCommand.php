<?php
declare(strict_types = 1);

/**
 * ScoreFar, a Scoreboard plugin for PocketMine-MP
 * Copyright (c) 2020 farhandevs  < https://github.com/farhandevs >
 *
 * Discord: Rey#6127

 *
 * This software is distributed under "GNU General Public License v3.0".
 * This license allows you to use it and/or modify it but you are not at
 * all allowed to sell this plugin at any cost. If found doing so the
 * necessary action required would be taken.
 *
 * ScoreFar is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License v3.0 for more details.
 *
 * You should have received a copy of the GNU General Public License v3.0
 * along with this program. If not, see
 * <https://opensource.org/licenses/GPL-3.0>.
 * ------------------------------------------------------------------------
 */

namespace farhandevs\ScoreFar\commands;

use farhandevs\ScoreFar\libs\farhandevs\ScoreFactory\ScoreFactory;
use farhandevs\ScoreFar\ScoreFar;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;

class ScoreFarCommand extends PluginCommand{

	/** @var ScoreFar */
	private $plugin;

	/**
	 * ScoreFarCommand constructor.
	 *
	 * @param ScoreFar $plugin
	 */
	public function __construct(ScoreFar $plugin){
		parent::__construct("ScoreFar", $plugin);
		$this->setDescription("Shows ScoreFar Commands");
		$this->setUsage("/ScoreFar <on|off|about|help>");
		$this->setAliases(["sh"]);
		$this->setPermission("sh.command.sh");

		$this->plugin = $plugin;
	}

	/**
	 * @param CommandSender $sender
	 * @param string        $commandLabel
	 * @param array         $args
	 * @return bool|mixed
	 */
	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(!$this->testPermission($sender)){
			return true;
		}
		if(!$sender instanceof Player){
			$sender->sendMessage(ScoreFar::PREFIX . "§cYou can only use this command in-game.");

			return false;
		}
		if(!isset($args[0])){
			$sender->sendMessage(ScoreFar::PREFIX . "§cUsage: /ScoreFar <on|off|about|help>");

			return false;
		}
		switch($args[0]){
			case "about":
				$sender->sendMessage(ScoreFar::PREFIX . "§6Score§eHud §av" . $this->plugin->getDescription()->getVersion() . "§a.Plugin by §dfarhandevs§a. Contact on §bTwitter: JackMTaylor_ §aor §bDiscord: farhandevs#3717§a.");
				break;

			case "on":
				if(isset($this->plugin->disabledScoreFarPlayers[strtolower($sender->getName())])){
					unset($this->plugin->disabledScoreFarPlayers[strtolower($sender->getName())]);
					$sender->sendMessage(ScoreFar::PREFIX . "§aSuccessfully enabled ScoreFar.");
				}else{
					$sender->sendMessage(ScoreFar::PREFIX . "§cScoreFar is already enabled for you.");
				}
				break;

			case "off":
				if(!isset($this->plugin->disabledScoreFarPlayers[strtolower($sender->getName())])){
					ScoreFactory::removeScore($sender);

					$this->plugin->disabledScoreFarPlayers[strtolower($sender->getName())] = 1;
					$sender->sendMessage(ScoreFar::PREFIX . "§cSuccessfully disabled ScoreFar.");
				}else{
					$sender->sendMessage(ScoreFar::PREFIX . "§aScoreFar is already disabled for you.");
				}
				break;

			case "help":
			default:
				$sender->sendMessage(ScoreFar::PREFIX . "§cUsage: /ScoreFar <on|off|about|help>");
				break;
		}

		return false;
	}
}
