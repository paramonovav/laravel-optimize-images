<?php

namespace Paramonovav\LaravelOptimizeImages\Commands;

use \DateTime;
use \DateInterval;

use Illuminate\Support\Facades\Config;
use Illuminate\Console\Command;

use Symfony\Component\Console\Formatter\OutputFormatter;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class OptimizeImageCommand extends ParamonovavBaseCommand {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'optimize:images';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Optimize JPG and PNG images.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		$config_commands = Config::get('laravel-optimize-images::commands');
		$config_folders = Config::get('laravel-optimize-images::folders');

		if (empty($config_folders) && empty($config_commands))
		{
			$this-> error('Please make: php artisan config:publish paramonovav/laravel-optimize-images');
			exit();
		}

		foreach (array('jpg', 'png') as $code)
		{
			if (!empty($config_folders[$code]))
			{
				if (empty($config_commands[$code]))
				{
					$this-> error('No commands found in config (laravel-optimize-images::commands.'.$code.') for optimize '.strtoupper($code).' images');
					exit();
				}
			}

			$start[$code] = new DateTime();
			
			$this->line('<yellow>START: '.strtoupper($code).' optimization</yellow>');

			foreach ($config_folders[$code] as $folder)
			{
				$exec_cmd = sprintf($config_commands[$code], $folder);
				$this-> line('<blue>Processing: '.$exec_cmd.'</blue>');
				exec($exec_cmd);
			}

			$end[$code] = new DateTime();
			$interval = $start[$code]->diff($end[$code]);

			$this->line('<yellow>COMPLETE: '.strtoupper($code).' optimization</yellow>');
			
			$this->info('Process started at '.$start[$code]->format('H:i:s').', ended at '.$end[$code]->format('H:i:s'));
			$this->info('Process took '.$this->formatELapsedTime($interval));
		}
		
		/*

		$imagesFolders = array(
			public_path().'/assets/images/'
		);
		
		// jpeg optimization
		foreach($imagesFolders as $imagesFolder)
		{
			$this-> comment('jpegoptim --strip-all '.$imagesFolder.'*.jpg');
			exec('jpegoptim --strip-all '.$imagesFolder.'*.jpg');
		}
		$this->info('jpeg optimization done');
		
		// PNG optimization
		foreach($imagesFolders as $imagesFolder)
		{
			$this-> comment('optipng '.$imagesFolder.'*.png');
			exec('optipng '.$imagesFolder.'*.png');
		}
		$this->info('png optimization done');
		
		$end = new DateTime();
		$interval = $start->diff($end);
		$this->info('Process started at '.$start->format('H:i:s'));
		$this->info('Process ended at '.$end->format('H:i:s'));
		$this->info('Process took '.$this->formatELapsedTime($interval));
		*/
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array();
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array();
	}
	
	/**
	 * Return formatted interval where only the largest unit gets displayes.
	 * @param DateInterval $interval
	 *
	 * @return string
	 */
	function formatELapsedTime(DateInterval $interval) {
		$return = '';
		if ($interval->y !== 0)
			$return .= $interval->format("%y years");
			
		if ($interval->m !== 0)
			$return .= (!empty($return)?' ':'').$interval->format("%m months");
		
		if ($interval->d !== 0)
			$return .= (!empty($return)?' ':'').$interval->format("%d days");
		
		if ($interval->h !== 0)
			$return .= (!empty($return)?' ':'').$interval->format("%h hours");
		
		if ($interval->i !== 0)
			$return .= (!empty($return)?' ':'').$interval->format("%i minutes");
			
		if ($interval->s !== 0)
			$return .= (!empty($return)?' ':'').$interval->format("%s seconds");
		
		return (empty($return))?"0 seconds":$return;
	}

}