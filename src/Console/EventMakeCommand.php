<?php

namespace Jetlabs\Generators\Console;

use Jetlabs\Generators\Concerns\ResolvesStubPath;
use Jetlabs\Generators\GeneratorCommand;

class EventMakeCommand extends GeneratorCommand
{
	use ResolvesStubPath;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'make:event';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new event class';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Event';

	/**
	 * Determine if the class already exists.
	 *
	 * @param  string  $rawName
	 * @return bool
	 */
	protected function alreadyExists($rawName)
	{
		return class_exists($rawName);
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return $this->resolveStubPath('/stubs/event.stub');
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace.'\Domain\Events';
	}
}
