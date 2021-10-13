<?php

namespace Serenity\Generators\Console;

use Illuminate\Support\Str;
use Serenity\Generators\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Serenity\Generators\Concerns\ResolvesStubPath;

class FactoryMakeCommand extends GeneratorCommand
{
	use ResolvesStubPath;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'make:factory';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new entity factory';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Factory';

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return $this->resolveStubPath('/stubs/factory.stub');
	}

	/**
	 * Build the class with the given name.
	 *
	 * @param  string  $name
	 * @return string
	 */
	protected function buildClass($name)
	{
		$factory = class_basename(Str::ucfirst(str_replace('Factory', '', $name)));

		$namespaceEntity = $this->option('entity')
			? $this->qualifyEntity($this->option('entity'))
			: $this->qualifyEntity($this->guessEntityName($name));

		$entity = class_basename($namespaceEntity);

		if (Str::startsWith($namespaceEntity, $this->rootNamespace() . 'Domain\\Entities')) {
			$namespace = Str::beforeLast('Database\\Factories\\' . Str::after($namespaceEntity, $this->rootNamespace() . 'Domain\\Entities\\'), '\\');
		} else {
			$namespace = 'Database\\Factories';
		}

		$replace = [
			'{{ factoryNamespace }}' => $namespace,
			'NamespacedDummyEntity' => $namespaceEntity,
			'{{ namespacedEntity }}' => $namespaceEntity,
			'{{namespacedEntity}}' => $namespaceEntity,
			'DummyEntity' => $entity,
			'{{ entity }}' => $entity,
			'{{entity}}' => $entity,
			'{{ factory }}' => $factory,
			'{{factory}}' => $factory,
		];

		return str_replace(
			array_keys($replace),
			array_values($replace),
			parent::buildClass($name)
		);
	}

	/**
	 * Get the destination class path.
	 *
	 * @param  string  $name
	 * @return string
	 */
	protected function getPath($name)
	{
		$name = (string) Str::of($name)->replaceFirst($this->rootNamespace(), '')->finish('Factory');

		return $this->serenity->databasePath() . '/factories/' . str_replace('\\', '/', $name) . '.php';
	}

	/**
	 * Guess the entity name from the Factory name or return a default entity name.
	 *
	 * @param  string  $name
	 * @return string
	 */
	protected function guessEntityName($name)
	{
		if (Str::endsWith($name, 'Factory')) {
			$name = substr($name, 0, -7);
		}

		$entityName = $this->qualifyEntity(Str::after($name, $this->rootNamespace()));

		if (class_exists($entityName)) {
			return $entityName;
		}

		return $this->rootNamespace() . 'Domain\Entities';
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['entity', 'e', InputOption::VALUE_OPTIONAL, 'The name of the entity'],
		];
	}
}
