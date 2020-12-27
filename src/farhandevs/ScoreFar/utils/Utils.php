<?php<br/>declare(strict_types = 1);<div></div>/**<br/> *     _____                    _   _           _<br/> *    /  ___|                  | | | |         | |<br/> *    \ `--.  ___ ___  _ __ ___| |_| |_   _  __| |<br/> *     `--. \/ __/ _ \| '__/ _ \  _  | | | |/ _` |<br/> *    /|<br/> *    <br/> *<br/> * ScoreFar, a Scoreboard plugin for PocketMine-MP
<br/> * Copyright (c) 2020 farhandevs  < https://github.com/farhandevs >
<br/> *
<br/> * Discord: Rey#6127

<br/> *
<br/> * This software is distributed under "GNU General Public License v3.0".
<br/> * This license allows you to use it and/or modify it but you are not at
<br/> * all allowed to sell this plugin at any cost. If found doing so the
<br/> * necessary action required would be taken.
<br/> *
<br/> * ScoreFar is distributed in the hope that it will be useful,
<br/> * but WITHOUT ANY WARRANTY; without even the implied warranty of
<br/> * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
<br/> * GNU General Public License v3.0 for more details.
<br/> *
<br/> * You should have received a copy of the GNU General Public License v3.0
<br/> * along with this program. If not, see
<br/> * <https://opensource.org/licenses/GPL-3.0>.
<br/> * ------------------------------------------------------------------------<br/> */<div></div>namespace farhandevs\ScoreFar\utils;<div></div><br/>use farhandevs\ScoreFar\libs\farhandevs\ConfigUpdater\ConfigUpdater;<br/>use farhandevs\ScoreFar\libs\farhandevs\ScoreFactory\ScoreFactory;<br/>use farhandevs\ScoreFar\ScoreFar;<br/>use farhandevs\ScoreFar\libs\farhandevs\UpdateNotifier\UpdateNotifier;<br/>use pocketmine\Server;<br/>use RuntimeException;<div></div>class Utils{<div></div>	/**<br/>	 * Checks if the required virions/libraries are present before enabling the plugin.<br/>	 */<br/>	public static function checkVirions(): void{<br/>		$requiredVirions = [<br/>			ScoreFactory::class,<br/>			UpdateNotifier::class,<br/>			ConfigUpdater::class<br/>		];<div></div>		foreach($requiredVirions as $class){<br/>			if(!class_exists($class)){<br/>				throw new RuntimeException("ScoreFar plugin will only work if you use the plugin phar from Poggit.");<br/>			}<br/>		}<br/>	}<div></div>	/**<br/>	 * @param $timezone<br/>	 * @return bool<br/>	 */<br/>	public static function setTimezone($timezone): bool{<br/>		if($timezone !== false){<br/>			Server::getInstance()->getLogger()->notice(ScoreFar::PREFIX . "Server timezone successfully set to " . $timezone);<div></div>			return date_default_timezone_set($timezone);<br/>		}<div></div>		return false;<br/>	}<br/>}
