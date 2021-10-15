<?php

namespace Serenity\Generators\Console;

use Illuminate\Support\Str;
use Serenity\Generators\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Serenity\Generators\Concerns\ResolvesStubPath;

class ActionMakeCommand extends GeneratorCommand
{
	use ResolvesStubPath;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'make:action';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new action class';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Action';

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		$stub = '/stubs/action.stub';
	
		if ($this->option('sc')) {
			$type = $this->option('type');
			$stub = "/scaffold/action.{$type}.stub";
		}
	
		return $this->resolveStubPath($stub);
	}

	/**
	 * Build the class with the given name.
	 *
	 * @param  string  $name
	 * @return string
	 *
	 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
	 */
	protected function buildClass($name)
	{
		$stub = $this->files->get($this->getStub());

		if ($this->option('service')) {
			$stub = $this->replaceServiceName($stub);
		}

		return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
	}

	protected function replaceServiceName($stub)
	{
		$stub = str_replace('DummyService', Str::singular($this->option('service')), $stub);

		return $stub;
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace . '\Actions';
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['sc', null, InputOption::VALUE_NONE, 'Use the scaffold stubs.'],
			['type', null, InputOption::VALUE_NONE, 'Stub type for a given action.'],
			['service', null, InputOption::VALUE_NONE, 'The name of the service for replacements.']
		];
	}
}
