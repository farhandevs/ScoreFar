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

namespace farhandevs\ScoreFar\addon;

class AddonDescription{

	/** @var array */
	private $map;

	/** @var string */
	private $name;
	/** @var string */
	private $version;
	/** @var string */
	private $main;
	/** @var array */
	private $api = [];
	/** @var array */
	private $depend = [];

	/**
	 * @param string|array $yamlString
	 */
	public function __construct($yamlString){
		$this->loadMap(!is_array($yamlString) ? yaml_parse($yamlString) : $yamlString);
	}

	/**
	 * @param array $addon
	 */
	private function loadMap(array $addon){
		$this->map = $addon;

		$this->name = $addon["name"];

		if(preg_match('/^[A-Za-z0-9 _.-]+$/', $this->name) === 0){
			throw new AddonException("Invalid AddonDescription name.");
		}

		$this->name = str_replace(" ", "_", $this->name);
		$this->version = $addon["version"] ?? "0.0.0";
		$this->main = $addon["main"];

		if(isset($addon["api"])){
			$api = explode(",", $addon["api"]);

			$this->api = $api;
		}else{
			$this->api = [];
		}

		if(isset($addon["depend"])){
			$depend = explode(",", $addon["depend"]);

			$this->depend = $depend;
		}else{
			$this->depend = [];
		}
	}

	/**
	 * @return array
	 */
	public function getMap(): array{
		return $this->map;
	}

	/**
	 * @return string
	 */
	public function getName(): string{
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getVersion(): string{
		return $this->version;
	}

	/**
	 * @return string
	 */
	public function getMain(): string{
		return $this->main;
	}

	/**
	 * @return array
	 */
	public function getCompatibleApis(): array{
		return $this->api;
	}

	/**
	 * @return array
	 */
	public function getDepend(): array{
		return $this->depend;
	}
}
