<?php
declare(strict_types = 1);

/**
 *
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

namespace farhandevs\ScoreFar\updater;

use farhandevs\ScoreFar\addon\Addon;
use farhandevs\ScoreFar\ScoreFar;
use farhandevs\ScoreFar\updater\task\AddonUpdateNotifyTask;

class AddonUpdater{

	/** @var ScoreFar */
	private $plugin;

	/**
	 * AddonUpdater constructor.
	 *
	 * @param ScoreFar $plugin
	 */
	public function __construct(ScoreFar $plugin){
		$this->plugin = $plugin;
	}

	/**
	 * @param Addon $addon
	 */
	public function check(Addon $addon): void{
		$plugin = $this->plugin;
		$description = $addon->getDescription();

		$addonName = $description->getName();
		$addonVersion = $description->getVersion();

		if($addonVersion === "0.0.0"){
			$plugin->getLogger()->warning("(Addon Update Notice) Addon $addonName is outdated. A new version has been released. Download the latest version from https://github.com/farhandevs/ScoreFar-Addons");

			return;
		}

		$plugin->getServer()->getAsyncPool()->submitTask(new AddonUpdateNotifyTask($addonName, $addonVersion));
	}
}
