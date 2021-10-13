<?php

namespace Serenity\Generators\Console;

use Serenity\Generators\GeneratorCommand;
use Serenity\Generators\Concerns\ResolvesStubPath;

class RepositoryInterfaceMakeCommand extends GeneratorCommand
{
	use ResolvesStubPath;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'make:repository-contract';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create repository interface.';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Interface';

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return $this->resolveStubPath('/stubs/repository-interface.stub');
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace . '\Domain\Repositories\Contracts';
	}
}
