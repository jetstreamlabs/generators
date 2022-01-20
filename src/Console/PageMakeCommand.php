<?php

namespace Jetlabs\Generators\Console;

use Jetlabs\Generators\Concerns\ResolvesStubPath;
use Jetlabs\Generators\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class PageMakeCommand extends GeneratorCommand
{
	use ResolvesStubPath;

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $name = 'make:page';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new Vue responder page.';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Page';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$name = $this->getNameInput();

		$path = app_path('Responders/').$name.'.vue';

		if ($this->option('sc')) {
			$path = app_path('Responders/App/').$name.'.vue';
		}

		$renamed = str_replace(['\\', '/'], ['.', '.'], $name);

		$class = 'Responders.'.$renamed;

		if ($this->option('sc')) {
			$class = 'Responders.App.'.$renamed;
		}

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

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['sc', null, InputOption::VALUE_NONE, 'Use the scaffold stubs.'],
		];
	}
}
