<?php

namespace Serenity\Generators\Console;

use Serenity\Generators\GeneratorCommand;
use Serenity\Generators\Concerns\ResolvesStubPath;

class ChannelMakeCommand extends GeneratorCommand
{
	use ResolvesStubPath;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'make:channel';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new channel class';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Channel';

	/**
	 * Build the class with the given name.
	 *
	 * @param  string  $name
	 * @return string
	 */
	protected function buildClass($name)
	{
		return str_replace(
			'DummyUser',
			class_basename(config('auth.providers.users.model')),
			parent::buildClass($name)
		);
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return $this->resolveStubPath('/stubs/channel.stub');
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace . '\Domain\Broadcasting';
	}
}
