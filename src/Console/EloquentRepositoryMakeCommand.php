<?php

namespace Serenity\Generators\Console;

use Illuminate\Support\Str;
use Serenity\Generators\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
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

		if ($this->option('entity')) {
			$stub = $this->replaceEntityName($stub);
		}

		return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
	}

	/**
	 * Replace the entity name in the repository.
	 *
	 * @param  string $stub
	 * @return string
	 */
	protected function replaceEntityName($stub)
	{
		$stub = str_replace('DummyEntity', Str::singular($this->option('entity')), $stub);

		return $stub;
	}

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

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
	  ['entity', 'e', InputOption::VALUE_NONE, 'Set the entity name for the repository.']
		];
	}
}
