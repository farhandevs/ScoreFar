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
use pocketmine\Server;

/**
 * Use of this class is encouraged instead of Addon.php.
 *
 * Please refer to Addon.php for details on what the methods below do.
 *
 * @see     Addon.php
 *
 * Class AddonBase
 *
 * @package farhandevs\ScoreFar\addon
 */
abstract class AddonBase implements Addon{

	/** @var ScoreFar */
	private $ScoreFar;
	/** @var AddonDescription */
	private $description;

	/**
	 * AddonBase constructor.
	 *
	 * @param ScoreFar         $ScoreFar
	 * @param AddonDescription $description
	 */
	public function __construct(ScoreFar $ScoreFar, AddonDescription $description){
		$this->ScoreFar = $ScoreFar;
		$this->description = $description;
	}

	public function onEnable(): void{
	}

	/**
	 * @return ScoreFar
	 */
	public function getScoreFar(): ScoreFar{
		return $this->ScoreFar;
	}

	/**
	 * @return AddonDescription
	 */
	final public function getDescription(): AddonDescription{
		return $this->description;
	}

	/**
	 * @return Server
	 */
	public function getServer(): Server{
		return $this->ScoreFar->getServer();
	}
}
