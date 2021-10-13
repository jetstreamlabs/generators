<?php

namespace Serenity\Generators\Console;

use Serenity\Generators\GeneratorCommand;
use Serenity\Generators\Concerns\ResolvesStubPath;

class ContractMakeCommand extends GeneratorCommand
{
	use ResolvesStubPath;

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $name = 'make:contract';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new interface contract.';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Contract';

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return $this->resolveStubPath('/stubs/contract.stub');
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace . '\Domain\Contracts';
	}
}
