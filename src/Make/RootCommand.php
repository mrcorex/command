<?php

namespace CoRex\Command\Make;

use CoRex\Command\BaseCommand;
use CoRex\Command\Console;
use CoRex\Command\Path;

class RootCommand extends BaseCommand
{
	protected $component = 'make';
	protected $signature = 'root
		{--delete=: Delete existing crcmd}';
	protected $description = 'Make root-command (crcmd) in current directory';
	protected $visible = true;

	public function run()
	{
		$this->header($this->description);

		$cmdFilename = 'crcmd';
		$currentDirectory = getcwd();

		// Check if existance or delete.
		if (file_exists($currentDirectory . '/' . $cmdFilename)) {
			if ($this->option('delete')) {
				unlink($currentDirectory . '/' . $cmdFilename);
			} else {
				Console::throwError($cmdFilename . ' already exists.');
			}
		}

		// Write stub.
		$stubFilename = Path::getFramework(['stub', 'crcmd.stub']);
		$stub = file_get_contents($stubFilename);
		$stub = str_replace('{autoload}', Path::getAutoload(), $stub);
		file_put_contents($currentDirectory . '/' . $cmdFilename, $stub);
		chmod($currentDirectory . '/' . $cmdFilename, 0700);
		$this->info('crcmd created in ' . $currentDirectory);
	}
}