<?php

namespace Jetlabs\Generators\Console;

use Illuminate\Support\Str;
use Jetlabs\Generators\Concerns\ResolvesStubPath;
use Jetlabs\Generators\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class EntityMakeCommand extends GeneratorCommand
{
	use ResolvesStubPath;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'make:entity';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new Eloquent entity class';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Entity';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{
		if (parent::handle() === false && ! $this->option('force')) {
			return;
		}

		if ($this->option('resource')) {
			$this->input->setOption('repo', true);
			$this->input->setOption('factory', true);
			$this->input->setOption('migration', true);
		}

		if ($this->option('repo')) {
			$this->createRepository();
		}

		if ($this->option('factory')) {
			$this->createFactory();
		}

		if ($this->option('migration')) {
			$this->createMigration();
		}
	}

	protected function createRepository()
	{
		$name = Str::studly(class_basename($this->argument('name')));
		$repo = Str::singular($name);

		$this->call('make:repository', [
			'name' => "{$repo}Repository",
			'--entity' => $repo,
		]);
	}

	/**
	 * Create a factory for the entity.
	 *
	 * @return void
	 */
	protected function createFactory(): void
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
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		if ($this->option('pivot')) {
			return $this->resolveStubPath('/stubs/pivot.entity.stub');
		}

		return $this->resolveStubPath('/stubs/entity.stub');
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace.'\Domain\Entities';
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['repo', 's', InputOption::VALUE_NONE, 'Create a new repository for the entity.'],
			['factory', 'f', InputOption::VALUE_NONE, 'Create a new factory for the entity.'],
			['force', null, InputOption::VALUE_NONE, 'Create the class even if the entity already exists.'],
			['migration', 'm', InputOption::VALUE_NONE, 'Create a new migration file for the entity.'],
			['pivot', 'p', InputOption::VALUE_NONE, 'Indicates if the generated entity should be a custom intermediate table entity.'],
			['resource', 'r', InputOption::VALUE_NONE, 'Generate a repository, migration and factory for the entity.'],
		];
	}
}
