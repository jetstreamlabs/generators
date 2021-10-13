<?php

namespace Serenity\Generators\Console;

use Illuminate\Support\Str;
use Serenity\Generators\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Serenity\Generators\Concerns\ResolvesStubPath;

class PolicyMakeCommand extends GeneratorCommand
{
	use ResolvesStubPath;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'make:policy';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new policy class';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Policy';

	/**
	 * Build the class with the given name.
	 *
	 * @param  string  $name
	 * @return string
	 */
	protected function buildClass($name)
	{
		$stub = $this->replaceUserNamespace(
			parent::buildClass($name)
		);

		$entity = $this->option('entity');

		return $entity ? $this->replaceEntity($stub, $entity) : $stub;
	}

	/**
	 * Replace the User entity namespace.
	 *
	 * @param  string  $stub
	 * @return string
	 */
	protected function replaceUserNamespace($stub)
	{
		if (!config('auth.providers.users.entity')) {
			return $stub;
		}

		return str_replace(
			$this->rootNamespace() . 'User',
			config('auth.providers.users.entity'),
			$stub
		);
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

		$namespaceEntity = $this->serenity->getNamespace() . $entity;

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

		$dummyUser = class_basename(config('auth.providers.users.entity'));

		$dummyEntity = Str::camel($entity) === 'user' ? 'entity' : $entity;

		$stub = str_replace('DocDummyEntity', Str::snake($dummyEntity, ' '), $stub);

		$stub = str_replace('DummyEntity', $entity, $stub);

		$stub = str_replace('dummyEntity', Str::camel($dummyEntity), $stub);

		$stub = str_replace('DummyUser', $dummyUser, $stub);

		return str_replace('DocDummyPluralEntity', Str::snake(Str::plural($dummyEntity), ' '), $stub);
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return $this->option('entity')
			? $this->resolveStubPath('/stubs/policy.stub')
			: $this->resolveStubPath('/stubs/policy.plain.stub');
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace . '\Domain\Policies';
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['entity', 'e', InputOption::VALUE_OPTIONAL, 'The entity that the policy applies to.'],
		];
	}
}
