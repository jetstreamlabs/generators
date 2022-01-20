<?php

namespace Jetlabs\Generators\Console;

use Illuminate\Support\Str;
use Jetlabs\Generators\Concerns\ResolvesStubPath;
use Jetlabs\Generators\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ResourceMakeCommand extends GeneratorCommand
{
	use ResolvesStubPath;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'make:resource';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new resource';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Resource';

	/**
	 * Execute the console command.
	 *
	 * @return bool|null
	 */
	public function handle()
	{
		if ($this->collection()) {
			$this->type = 'Resource collection';
		}

		parent::handle();
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return $this->collection()
			? $this->resolveStubPath('/stubs/resource-collection.stub')
			: $this->resolveStubPath('/stubs/resource.stub');
	}

	/**
	 * Determine if the command is generating a resource collection.
	 *
	 * @return bool
	 */
	protected function collection()
	{
		return $this->option('collection') ||
			Str::endsWith($this->argument('name'), 'Collection');
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace.'\Domain\Resources';
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['collection', 'c', InputOption::VALUE_NONE, 'Create a resource collection.'],
		];
	}
}
