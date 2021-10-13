<?php

namespace Serenity\Generators\Console;

use Illuminate\Support\Str;
use Serenity\Generators\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Serenity\Generators\Concerns\ResolvesStubPath;

class ListenerMakeCommand extends GeneratorCommand
{
	use ResolvesStubPath;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'make:listener';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new event listener class';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Listener';

	/**
	 * Build the class with the given name.
	 *
	 * @param  string  $name
	 * @return string
	 */
	protected function buildClass($name)
	{
		$event = $this->option('event');

		if (!Str::startsWith($event, [
			$this->serenity->getNamespace(),
			'Illuminate',
			'\\',
		])) {
			$event = $this->serenity->getNamespace() . 'Domain\\Events\\' . $event;
		}

		$stub = str_replace(
			'DummyEvent',
			class_basename($event),
			parent::buildClass($name)
		);

		return str_replace(
			'DummyFullEvent',
			$event,
			$stub
		);
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		if ($this->option('queued')) {
			return $this->option('event')
				? $this->resolveStubPath('/stubs/listener-queued.stub')
				: $this->resolveStubPath('/stubs/listener-queued-duck.stub');
		}

		return $this->option('event')
			? $this->resolveStubPath('/stubs/listener.stub')
			: $this->resolveStubPath('/stubs/listener-duck.stub');
	}

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
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace . '\Domain\Listeners';
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['event', 'e', InputOption::VALUE_OPTIONAL, 'The event class being listened for.'],

			['queued', null, InputOption::VALUE_NONE, 'Indicates the event listener should be queued.'],
		];
	}
}
