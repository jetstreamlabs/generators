<?php

namespace Serenity\Generators\Concerns;

trait ResolvesStubPath
{
	/**
	 * Resolve the fully-qualified path to the stub.
	 *
	 * @param  string  $stub
	 * @return string
	 */
	protected function resolveStubPath($stub)
	{
		return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
			? $customPath
			: realpath(__DIR__ . '/../Console' . $stub);
	}
}
