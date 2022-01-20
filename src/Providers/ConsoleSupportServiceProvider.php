<?php

namespace Jetlabs\Generators\Providers;

use Illuminate\Foundation\Providers\ArtisanServiceProvider;
use Illuminate\Foundation\Providers\ComposerServiceProvider;
use Illuminate\Support\AggregateServiceProvider;

class ConsoleSupportServiceProvider extends AggregateServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * The provider class names.
	 *
	 * @var array
	 */
	protected $providers = [
		ArtisanServiceProvider::class,
		ArtisanExtendProvider::class,
		MigrationServiceProvider::class,
		ComposerServiceProvider::class,
	];
}
