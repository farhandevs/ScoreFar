<?php

declare(strict_types=1);

/*
 *  _   _           _       _       _   _       _   _  __ _
 * | | | |         | |     | |     | \ | |     | | (_)/ _(_)
 * | | | |_ __   __| | __ _| |_ ___|  \| | ___ | |_ _| |_ _  ___ _ __
 * | | | | '_ \ / _` |/ _` | __/ _ \ . ` |/ _ \| __| |  _| |/ _ \ '__|
 * | |_| | |_) | (_| | (_| | ||  __/ |\  | (_) | |_| | | | |  __/ |
 *  \___/| .__/ \__,_|\__,_|\__\___\_| \_/\___/ \__|_|_| |_|\___|_|
 *       | |
 *       |_|
 *
 * UpdateNotifier, a updater virion for PocketMine-MP
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

namespace farhandevs\ScoreFar\libs\farhandevs\UpdateNotifier\task;

use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;
use pocketmine\utils\Internet;
use function json_decode;
use function version_compare;
use function vsprintf;

class UpdateNotifyTask extends AsyncTask{

	/** @var string */
	private const POGGIT_RELEASES_URL = "https://poggit.pmmp.io/releases.json?name=";

	/** @var string */
	private $pluginName;
	/** @var string */
	private $pluginVersion;

	public function __construct(string $pluginName, string $pluginVersion){
		$this->pluginName = $pluginName;
		$this->pluginVersion = $pluginVersion;
	}

	public function onRun() : void{
		$json = Internet::getURL(self::POGGIT_RELEASES_URL . $this->pluginName, 10, [], $err);
		$highestVersion = $this->pluginVersion;
		$artifactUrl = "";
		$api = "";
		if($json !== false){
			$releases = json_decode($json, true);
			foreach($releases as $release){
				if(version_compare($highestVersion, $release["version"], ">=")){
					continue;
				}
				$highestVersion = $release["version"];
				$artifactUrl = $release["artifact_url"];
				$api = $release["api"][0]["from"] . " - " . $release["api"][0]["to"];
			}
		}

		$this->setResult([$highestVersion, $artifactUrl, $api, $err]);
	}

	public function onCompletion(Server $server) : void{
		$plugin = Server::getInstance()->getPluginManager()->getPlugin($this->pluginName);
		if($plugin === null){
			return;
		}

		[$highestVersion, $artifactUrl, $api, $err] = $this->getResult();
		if($err !== null){
			$plugin->getLogger()->error("Update notify error: " . $err);
		}

		if($highestVersion !== $this->pluginVersion){
			$artifactUrl = $artifactUrl . "/" . $this->pluginName . "_" . $highestVersion . ".phar";
			$plugin->getLogger()->notice(vsprintf("Version %s has been released for API %s. Download the new release at %s", [$highestVersion, $api, $artifactUrl]));
		}
	}
}