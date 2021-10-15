<?php

namespace Serenity\Generators\Console;

use Illuminate\Support\Str;
use Serenity\Generators\GeneratorCommand;
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
	protected $type = 'Action Set';

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
	'Delete'
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
		// all default vue responders
		// form requests for create and edit
		// service
		// lang file

		if ($this->option('entity')) {
			// entity
	  // repository & interface
	  // factory
	  // migration
		}
	}

	/**
	 * Create a model factory for the model.
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
	 * Create an action for the model.
	 *
	 * @return void
	 */
	protected function createActions()
	{
		$dirname = Str::studly(class_basename($this->argument('name')));

		foreach ($this->actions as $action) {
			$this->call('make:action', [
		'name' => "{$dirname}/{$action}",
		'--sc' => true,
		'--type' => $this->actionType($action),
		'--service' => "{$dirname}"
	  ]);
		}
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		//
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace . '\Domain\Entities';
	}

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
			['force', null, InputOption::VALUE_NONE, 'Create the action set even if it already exists.']
		];
	}
}
