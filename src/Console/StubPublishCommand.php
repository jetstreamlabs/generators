<?php

namespace Serenity\Generators\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class StubPublishCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'stub:publish {--force : Overwrite any existing files}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Publish all stubs that are available for customization';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{
		if (!is_dir($stubsPath = $this->laravel->basePath('stubs'))) {
			(new Filesystem)->makeDirectory($stubsPath);
		}

		$files = [
			__DIR__ . '/stubs/action.stub' => $stubsPath . '/action.stub',
			__DIR__ . '/stubs/cast.stub' => $stubsPath . '/cast.stub',
			__DIR__ . '/stubs/channel.stub' => $stubsPath . '/channel.stub',
			__DIR__ . '/stubs/component.stub' => $stubsPath . '/component.stub',
			__DIR__ . '/stubs/console.stub' => $stubsPath . '/console.stub',
			__DIR__ . '/stubs/contract.stub' => $stubsPath . '/contract.stub',
			__DIR__ . '/stubs/criteria.stub' => $stubsPath . '/criteria.stub',
			__DIR__ . '/stubs/entity.stub' => $stubsPath . '/entity.stub',
			__DIR__ . '/stubs/event-handler-queued.stub' => $stubsPath . '/event-handler-queued.stub',
			__DIR__ . '/stubs/event-handler.stub' => $stubsPath . '/event-handler.stub',
			__DIR__ . '/stubs/event.stub' => $stubsPath . '/event.stub',
			__DIR__ . '/stubs/exception-render-report.stub' => $stubsPath . '/exception-render-report.stub',
			__DIR__ . '/stubs/exception-render.stub' => $stubsPath . '/exception-render.stub',
			__DIR__ . '/stubs/exception-report.stub' => $stubsPath . '/exception-report.stub',
			__DIR__ . '/stubs/exception.stub' => $stubsPath . '/exception.stub',
			__DIR__ . '/stubs/factory.stub' => $stubsPath . '/factory.stub',
			__DIR__ . '/stubs/job-queued.stub' => $stubsPath . '/job-queued.stub',
			__DIR__ . '/stubs/job.stub' => $stubsPath . '/job.stub',
			__DIR__ . '/stubs/listener-duck.stub' => $stubsPath . '/listener-duck.stub',
			__DIR__ . '/stubs/listener-queued-duck.stub' => $stubsPath . '/listener-queued-duck.stub',
			__DIR__ . '/stubs/listener-queued.stub' => $stubsPath . '/listener-queued.stub',
			__DIR__ . '/stubs/listener.stub' => $stubsPath . '/listener.stub',
			__DIR__ . '/stubs/mail.stub' => $stubsPath . '/mail.stub',
			__DIR__ . '/stubs/markdown-mail.stub' => $stubsPath . '/markdown-mail.stub',
			__DIR__ . '/stubs/markdown-notification.stub' => $stubsPath . '/markdown-notification.stub',
			__DIR__ . '/stubs/markdown.stub' => $stubsPath . '/markdown.stub',
			__DIR__ . '/stubs/middleware.stub' => $stubsPath . '/middleware.stub',
			__DIR__ . '/stubs/notification.stub' => $stubsPath . '/notification.stub',
			__DIR__ . '/stubs/observer.plain.stub' => $stubsPath . '/observer.plain.stub',
			__DIR__ . '/stubs/observer.stub' => $stubsPath . '/observer.stub',
			__DIR__ . '/stubs/payload.stub' => $stubsPath . '/payload.stub',
			__DIR__ . '/stubs/pivot.entity.stub' => $stubsPath . '/pivot.entity.stub',
			__DIR__ . '/stubs/policy.plain.stub' => $stubsPath . '/policy.plain.stub',
			__DIR__ . '/stubs/policy.stub' => $stubsPath . '/policy.stub',
			__DIR__ . '/stubs/provider.stub' => $stubsPath . '/provider.stub',
			__DIR__ . '/stubs/repository-interface.stub' => $stubsPath . '/repository-interface.stub',
			__DIR__ . '/stubs/repository.stub' => $stubsPath . '/repository.stub',
			__DIR__ . '/stubs/request.stub' => $stubsPath . '/request.stub',
			__DIR__ . '/stubs/resource-collection.stub' => $stubsPath . '/resource-collection.stub',
			__DIR__ . '/stubs/resource.stub' => $stubsPath . '/resource.stub',
			__DIR__ . '/stubs/responder.stub' => $stubsPath . '/responder.stub',
			__DIR__ . '/stubs/rule.stub' => $stubsPath . '/rule.stub',
			__DIR__ . '/stubs/seeder.stub' => $stubsPath . '/seeder.stub',
			__DIR__ . '/stubs/service.stub' => $stubsPath . '/service.stub',
			__DIR__ . '/stubs/trait.stub' => $stubsPath . '/trait.stub',
		];

		$laravel = [
			$this->illuminate_path('Foundation/Console/stubs/test.stub') => $stubsPath . '/test.stub',
			$this->illuminate_path('Foundation/Console/stubs/test.unit.stub') => $stubsPath . '/test.unit.stub',
			$this->illuminate_path('Database/Migrations/stubs/migration.create.stub') => $stubsPath . '/migration.create.stub',
			$this->illuminate_path('Database/Migrations/stubs/migration.stub') => $stubsPath . '/migration.stub',
			$this->illuminate_path('Database/Migrations/stubs/migration.update.stub') => $stubsPath . '/migration.update.stub',
		];

		$files = array_merge($files, $laravel);

		foreach ($files as $from => $to) {
			if (!file_exists($to) || $this->option('force')) {
				file_put_contents($to, file_get_contents($from));
			}
		}

		$this->info('Stubs published successfully.');
	}

	/**
	 * Return the Illuminate path for exporting native
	 * Laravel stubs that aren't overwritten.
	 *
	 * @param  string $path
	 * @return string
	 */
	protected function illuminate_path(string $path = ''): string
	{
		$laravel = $this->laravel->basePath('vendor/laravel/framework/src/Illuminate');

		return $laravel . ($path ? DIRECTORY_SEPARATOR . $path : $path);
	}
}
