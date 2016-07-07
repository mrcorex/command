<?php

namespace CoRex\Command;

class Path
{
	/**
	 * Get path to root of site (works outside Joomla).
	 *
	 * @param array $segments Default [].
	 * @return string
	 */
	public static function getRoot($segments = [])
	{
		$path = dirname(dirname(dirname(dirname(__DIR__))));
		$path = str_replace('\\', '/', $path);
		if (count($segments) > 0) {
			$path .= '/' . implode('/', $segments);
		}
		return $path;
	}

	/**
	 * Get path to framework.
	 *
	 * @param array $segments Default [].
	 * @return string
	 */
	public static function getFramework(array $segments = [])
	{
		$path = dirname(__DIR__);
		$path = str_replace('\\', '/', $path);
		if (count($segments) > 0) {
			$path .= '/' . implode('/', $segments);
		}
		return $path;
	}

	/**
	 * Get full path + filename "vendor/autoload.php".
	 *
	 * @return string
	 */
	public static function getAutoload()
	{
		return self::getRoot(['vendor', 'autoload.php']);
	}
}
