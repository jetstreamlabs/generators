<?php

namespace Serenity\Generators\Console;

use Serenity\Generators\GeneratorCommand;
use Serenity\Generators\Concerns\ResolvesStubPath;

class SeederMakeCommand extends GeneratorCommand
{
	use ResolvesStubPath;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'make:seeder';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new seeder class';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Seeder';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{
		parent::handle();
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return $this->resolveStubPath('/stubs/seeder.stub');
	}

	/**
	 * Get the destination class path.
	 *
	 * @param  string  $name
	 * @return string
	 */
	protected function getPath($name)
	{
		return $this->serenity->databasePath() . '/seeders/' . $name . '.php';
	}

	/**
	 * Parse the class name and format according to the root namespace.
	 *
	 * @param  string  $name
	 * @return string
	 */
	protected function qualifyClass($name)
	{
		return $name;
	}
}
