<?php

namespace Jetlabs\Generators\Console;

use Illuminate\Support\Str;
use Jetlabs\Generators\Concerns\ResolvesStubPath;
use Jetlabs\Generators\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ObserverMakeCommand extends GeneratorCommand
{
	use ResolvesStubPath;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'make:observer';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new observer class';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Observer';

	/**
	 * Build the class with the given name.
	 *
	 * @param  string  $name
	 * @return string
	 */
	protected function buildClass($name)
	{
		$stub = parent::buildClass($name);

		$entity = $this->option('entity');

		return $entity ? $this->replaceEntity($stub, $entity) : $stub;
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return $this->option('entity')
			? $this->resolveStubPath('/stubs/observer.stub')
			: $this->resolveStubPath('/stubs/observer.plain.stub');
	}

	/**
	 * Replace the entity for the given stub.
	 *
	 * @param  string  $stub
	 * @param  string  $entity
	 * @return string
	 */
	protected function replaceEntity($stub, $entity)
	{
		$entity = str_replace('/', '\\', $entity);

		$namespaceEntity = $this->Jetlabs->getNamespace().'Domain\\Entities\\'.$entity;

		if (Str::startsWith($entity, '\\')) {
			$stub = str_replace('NamespacedDummyEntity', trim($entity, '\\'), $stub);
		} else {
			$stub = str_replace('NamespacedDummyEntity', $namespaceEntity, $stub);
		}

		$stub = str_replace(
			"use {$namespaceEntity};\nuse {$namespaceEntity};",
			"use {$namespaceEntity};",
			$stub
		);

		$entity = class_basename(trim($entity, '\\'));

		$stub = str_replace('DocDummyEntity', Str::snake($entity, ' '), $stub);

		$stub = str_replace('DummyEntity', $entity, $stub);

		return str_replace('dummyEntity', Str::camel($entity), $stub);
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace.'\Domain\Observers';
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['entity', 'e', InputOption::VALUE_OPTIONAL, 'The entity that the observer applies to.'],
		];
	}
}
