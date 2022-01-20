<?php

namespace Jetlabs\Generators\Console;

use Jetlabs\Generators\Concerns\ResolvesStubPath;
use Jetlabs\Generators\GeneratorCommand;

class ConcernMakeCommand extends GeneratorCommand
{
	use ResolvesStubPath;

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $name = 'make:concern';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new trait.';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Trait';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
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
		return $this->resolveStubPath('/stubs/trait.stub');
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace.'\Domain\Concerns';
	}
}
