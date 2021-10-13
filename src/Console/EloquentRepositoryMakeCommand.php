<?php

namespace Serenity\Generators\Console;

use Serenity\Generators\GeneratorCommand;
use Serenity\Generators\Concerns\ResolvesStubPath;

class EloquentRepositoryMakeCommand extends GeneratorCommand
{
	use ResolvesStubPath;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'make:eloquent-repository';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create Eloquent repository.';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Repository';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return $this->resolveStubPath('/stubs/repository.stub');
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace . '\Domain\Repositories\Eloquent';
	}
}
