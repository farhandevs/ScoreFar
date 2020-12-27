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

namespace farhandevs\ScoreFar\addon;

use farhandevs\ScoreFar\ScoreFar;
use pocketmine\Player;

/**
 * Instead of implementing this class, AddonBase class should be extended for Addon making.
 * @see AddonBase
 *
 * Interface Addon
 *
 * @package farhandevs\ScoreFar\addon
 */
interface Addon{

	/**
	 * Addon constructor.
	 *
	 * @param ScoreFar         $ScoreFar
	 * @param AddonDescription $description
	 */
	public function __construct(ScoreFar $ScoreFar, AddonDescription $description);

	/**
	 * This is called whenever an Addon is successfully enabled. Depends on your use case.
	 * Almost same as Plugin::onEnable().
	 */
	public function onEnable(): void;

	/**
	 * Returns the ScoreFar plugin for whatever reason an addon would like to use it.
	 *
	 * @return ScoreFar
	 */
	public function getScoreFar(): ScoreFar;

	/**
	 * Returns the description containing name, main etc of the addon.
	 *
	 * @return AddonDescription
	 */
	public function getDescription(): AddonDescription;

	/**
	 * After doing the edits in your script.
	 * Return the final result to be used by ScoreFar using this.
	 *
	 * For example addons refer here: https://github.com/farhandevs/ScoreFar-Addons
	 *
	 * @param Player $player
	 * @return array
	 */
	public function getProcessedTags(Player $player): array;
}
