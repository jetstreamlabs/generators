<?php

namespace Jetlabs\Generators\Console;

use Jetlabs\Generators\Concerns\ResolvesStubPath;
use Jetlabs\Generators\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class JobMakeCommand extends GeneratorCommand
{
	use ResolvesStubPath;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'make:job';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new job class';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Job';

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return $this->option('sync')
			? $this->resolveStubPath('/stubs/job.stub')
			: $this->resolveStubPath('/stubs/job-queued.stub');
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace.'\Domain\Jobs';
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['sync', null, InputOption::VALUE_NONE, 'Indicates that job should be synchronous.'],
		];
	}
}
