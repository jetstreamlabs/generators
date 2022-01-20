<?php

namespace Jetlabs\Generators\Console;

use Jetlabs\Generators\Concerns\ResolvesStubPath;
use Jetlabs\Generators\GeneratorCommand;

class ComponentMakeCommand extends GeneratorCommand
{
	use ResolvesStubPath;

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $name = 'make:component';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new Vue component.';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Component';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$name = $this->getNameInput();
		$path = resource_path('js/components/').$name.'.vue';

		$class = str_replace(['\\', '/'], ['.', '.'], $name);

		$stub = $this->files->get($this->getStub());
		$file = str_replace('DummyClass', $class, $stub);

		$this->makeDirectory($path);

		$this->files->put($path, $file);

		$this->info($this->type.' created successfully.');
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return $this->resolveStubPath('/stubs/component.stub');
	}
}
