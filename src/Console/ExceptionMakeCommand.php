<?php

namespace Jetlabs\Generators\Console;

use Jetlabs\Generators\Concerns\ResolvesStubPath;
use Jetlabs\Generators\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ExceptionMakeCommand extends GeneratorCommand
{
	use ResolvesStubPath;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'make:exception';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new custom exception class';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Exception';

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		if ($this->option('render')) {
			return $this->option('report')
				? $this->resolveStubPath('/stubs/exception-render-report.stub')
				: $this->resolveStubPath('/stubs/exception-render.stub');
		}

		return $this->option('report')
			? $this->resolveStubPath('/stubs/exception-report.stub')
			: $this->resolveStubPath('/stubs/exception.stub');
	}

	/**
	 * Determine if the class already exists.
	 *
	 * @param  string  $rawName
	 * @return bool
	 */
	protected function alreadyExists($rawName)
	{
		return class_exists($this->rootNamespace().'Domain\\Exceptions\\'.$rawName);
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace.'\Domain\Exceptions';
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['render', null, InputOption::VALUE_NONE, 'Create the exception with an empty render method.'],

			['report', null, InputOption::VALUE_NONE, 'Create the exception with an empty report method.'],
		];
	}
}
