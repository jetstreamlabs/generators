<?php

namespace Serenity\Generators\Console;

use Serenity\Generators\GeneratorCommand;
use Serenity\Generators\Concerns\ResolvesStubPath;

class ProviderMakeCommand extends GeneratorCommand
{
	use ResolvesStubPath;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'make:provider';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new service provider class';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Provider';

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return $this->resolveStubPath('/stubs/provider.stub');
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace . '\Domain\Providers';
	}
}
