<?php

namespace Jetlabs\Generators\Console;

use Illuminate\Support\Str;
use Jetlabs\Generators\Concerns\ResolvesStubPath;
use Jetlabs\Generators\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ServiceMakeCommand extends GeneratorCommand
{
	use ResolvesStubPath;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'make:service';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new domain service class';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Service';

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

		if ($this->option('repo')) {
			$stub = $this->replaceRepoName($stub);
		}

		return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
	}

	/**
	 * Do replacements for the repo name.
	 *
	 * @param  string  $stub
	 * @return string
	 */
	protected function replaceRepoName($stub)
	{
		$stub = str_replace('DummyRepo', Str::singular($this->option('repo')), $stub);
		$stub = str_replace('{{ repovar }}', strtolower($this->option('repo')), $stub);

		return $stub;
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		$stub = '/stubs/service.stub';

		if ($this->option('sc')) {
			$stub = '/scaffold/service.stub';
		}

		return $this->resolveStubPath($stub);
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace.'\Domain\Services';
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
			['repo', null, InputOption::VALUE_NONE, 'The name of the repo for replacements.'],
		];
	}
}
