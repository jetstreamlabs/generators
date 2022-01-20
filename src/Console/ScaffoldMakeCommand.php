<?php

namespace Jetlabs\Generators\Console;

use Illuminate\Support\Str;
use Jetlabs\Generators\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ScaffoldMakeCommand extends GeneratorCommand
{
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'make:scaffold';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Scaffold a new action set.';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Endpoint Scaffold';

	/**
	 * Array of actions that need to be created.
	 *
	 * @var array
	 */
	protected $actions = [
		'Index',
		'Create',
		'Edit',
		'Store',
		'Update',
		'Restore',
		'Delete',
	];

	/**
	 * Array of vue responders that need to be created.
	 *
	 * @var array
	 */
	protected $pages = ['List', 'Create', 'Edit'];

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$this->createActions();
		$this->createVueResponders();
		$this->createFormRequests();

		$makeService = true;

		if ($this->option('entity')) {
			$makeService = false;
			$this->createEntity();
			$this->createService(true);
		}

		if ($makeService) {
			$this->createService();
		}

		$this->info($this->type.' created successfully.');
		$this->info("Don't forget to bind your interfaces and write your routes.");
	}

	/**
	 * Generate actions for the set.
	 *
	 * @return void
	 */
	protected function createActions(): void
	{
		$dirname = Str::studly(class_basename($this->argument('name')));

		foreach ($this->actions as $action) {
			$this->call('make:action', [
				'name' => "{$dirname}/{$action}",
				'--sc' => true,
				'--type' => $this->actionType($action),
				'--service' => "{$dirname}",
			]);
		}
	}

	/**
	 * Generate vue responder files for the set.
	 *
	 * @return void
	 */
	protected function createVueResponders(): void
	{
		$dirname = Str::studly(class_basename($this->argument('name')));

		foreach ($this->pages as $page) {
			$this->call('make:page', [
				'name' => "{$dirname}/{$page}",
				'--sc' => true,
			]);
		}
	}

	/**
	 * Generate form requests for set.
	 *
	 * @return void
	 */
	protected function createFormRequests(): void
	{
		$dirname = Str::studly(class_basename($this->argument('name')));

		$requests = ['Create', 'Edit'];

		$singular = Str::singular($dirname);

		foreach ($requests as $request) {
			$this->call('make:request', [
				'name' => "{$request}{$singular}",
			]);
		}
	}

	/**
	 * Create our domain service for the set.
	 *
	 * @param  bool  $ent
	 * @return void
	 */
	protected function createService($ent = false): void
	{
		$name = Str::studly(class_basename($this->argument('name')));

		$class = Str::singular($name);

		if ($ent) {
			$this->call('make:service', [
				'name' => "{$class}Service",
				'--sc' => true,
				'--repo' => $name,
			]);
		} else {
			$this->call('make:service', [
				'name' => "{$class}Service",
			]);
		}
	}

	protected function createEntity()
	{
		$name = Str::studly(class_basename($this->argument('name')));
		$entity = Str::singular($name);

		$this->call('make:entity', [
			'name' => $entity,
			'--resource' => true,
		]);
	}

	protected function createRepository()
	{
	}

	/**
	 * Create a factory for the entity.
	 *
	 * @return void
	 */
	protected function createFactory()
	{
		$factory = Str::studly(class_basename($this->argument('name')));

		$this->call('make:factory', [
			'name' => "{$factory}Factory",
			'--entity' => $this->argument('name'),
		]);
	}

	/**
	 * Create a migration file for the model.
	 *
	 * @return void
	 */
	protected function createMigration()
	{
		$table = Str::plural(Str::snake(class_basename($this->argument('name'))));

		$this->call('make:migration', [
			'name' => "create_{$table}_table",
			'--create' => $table,
		]);
	}

	/**
	 * Spec the correct action types for methods.
	 *
	 * @param  string  $action
	 * @return string
	 */
	protected function actionType($action): string
	{
		switch ($action) {
	  case 'Index':
	  case 'Create':
	  case 'Edit':
		return 'send';
		break;
	  case 'Store':
	  case 'Update':
	  case 'Restore':
	  case 'Delete':
		return 'redirect';
		break;
	}
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['entity', 'e', InputOption::VALUE_NONE, 'Create an entity, migration and repository for the action set.'],
			['force', null, InputOption::VALUE_NONE, 'Create the action set even if it already exists.'],
		];
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		// no stub for this as it only calls other generators.
	}
}
