<?php

namespace Jetlabs\Generators\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Jetlabs\Generators\Console\ActionMakeCommand;
use Jetlabs\Generators\Console\AppNameCommand;
use Jetlabs\Generators\Console\CastMakeCommand;
use Jetlabs\Generators\Console\ChannelMakeCommand;
use Jetlabs\Generators\Console\ComponentMakeCommand;
use Jetlabs\Generators\Console\ConcernMakeCommand;
use Jetlabs\Generators\Console\ConsoleMakeCommand;
use Jetlabs\Generators\Console\ContractMakeCommand;
use Jetlabs\Generators\Console\CriteriaMakeCommand;
use Jetlabs\Generators\Console\EloquentRepositoryMakeCommand;
use Jetlabs\Generators\Console\EntityMakeCommand;
use Jetlabs\Generators\Console\EventGenerateCommand;
use Jetlabs\Generators\Console\EventMakeCommand;
use Jetlabs\Generators\Console\ExceptionMakeCommand;
use Jetlabs\Generators\Console\FactoryMakeCommand;
use Jetlabs\Generators\Console\JobMakeCommand;
use Jetlabs\Generators\Console\ListenerMakeCommand;
use Jetlabs\Generators\Console\MailMakeCommand;
use Jetlabs\Generators\Console\MiddlewareMakeCommand;
use Jetlabs\Generators\Console\NotificationMakeCommand;
use Jetlabs\Generators\Console\ObserverMakeCommand;
use Jetlabs\Generators\Console\PageMakeCommand;
use Jetlabs\Generators\Console\PayloadMakeCommand;
use Jetlabs\Generators\Console\PolicyMakeCommand;
use Jetlabs\Generators\Console\ProviderMakeCommand;
use Jetlabs\Generators\Console\RepositoryInterfaceMakeCommand;
use Jetlabs\Generators\Console\RepositoryMakeCommand;
use Jetlabs\Generators\Console\RequestMakeCommand;
use Jetlabs\Generators\Console\ResourceMakeCommand;
use Jetlabs\Generators\Console\ResponderMakeCommand;
use Jetlabs\Generators\Console\RuleMakeCommand;
use Jetlabs\Generators\Console\ScaffoldMakeCommand;
use Jetlabs\Generators\Console\SeederMakeCommand;
use Jetlabs\Generators\Console\ServiceMakeCommand;
use Jetlabs\Generators\Console\StubPublishCommand;

class ArtisanExtendProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * The commands to be registered.
	 *
	 * @var array
	 */
	protected $devCommands = [
		'ActionMake' => 'command.action.make',
		'AppName' => 'command.app.name',
		'CastMake' => 'command.cast.make',
		'ChannelMake' => 'command.channel.make',
		'ComponentMake' => 'command.component.make',
		'ConcernMake' => 'command.concern.make',
		'ConsoleMake' => 'command.console.make',
		'ContractMake' => 'command.contract.make',
		'CriteriaMake' => 'command.criteria.make',
		'EloquentRepositoryMake' => 'command.eloquent.repository.make',
		'EntityMake' => 'command.entity.make',
		'EventGenerate' => 'command.event.generate',
		'EventMake' => 'command.event.make',
		'ExceptionMake' => 'command.exception.make',
		'FactoryMake' => 'command.factory.make',
		'JobMake' => 'command.job.make',
		'ListenerMake' => 'command.listener.make',
		'MailMake' => 'command.mail.make',
		'MiddlewareMake' => 'command.middleware.make',
		'NotificationMake' => 'command.notification.make',
		'ObserverMake' => 'command.observer.make',
		'PageMake' => 'command.page.make',
		'PayloadMake' => 'command.payload.make',
		'PolicyMake' => 'command.policy.make',
		'ProviderMake' => 'command.provider.make',
		'RepositoryInterfaceMake' => 'command.repository.contract.make',
		'RepositoryMake' => 'command.repository.make',
		'RequestMake' => 'command.request.make',
		'ResourceMake' => 'command.resource.make',
		'ResponderMake' => 'command.responder.make',
		'RuleMake' => 'command.rule.make',
		'ScaffoldMake' => 'command.scaffold.make',
		'SeederMake' => 'command.seeder.make',
		'ServiceMake' => 'command.service.make',
		'StubPublish' => 'command.stub.publish',
	];

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerCommands($this->devCommands);
	}

	/**
	 * Register the given commands.
	 *
	 * @param  array  $commands
	 * @return void
	 */
	protected function registerCommands(array $commands)
	{
		foreach (array_keys($commands) as $command) {
			call_user_func_array([$this, "register{$command}Command"], []);
		}

		$this->commands(array_values($commands));
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerActionMakeCommand()
	{
		$this->app->singleton('command.action.make', function (Application $app) {
			return new ActionMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerAppNameCommand()
	{
		$this->app->singleton('command.app.name', function (Application $app) {
			return new AppNameCommand($app['composer'], $app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerCastMakeCommand()
	{
		$this->app->singleton('command.cast.make', function ($app) {
			return new CastMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerChannelMakeCommand()
	{
		$this->app->singleton('command.channel.make', function (Application $app) {
			return new ChannelMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerComponentMakeCommand()
	{
		$this->app->singleton('command.component.make', function (Application $app) {
			return new ComponentMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerConcernMakeCommand()
	{
		$this->app->singleton('command.concern.make', function (Application $app) {
			return new ConcernMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerConsoleMakeCommand()
	{
		$this->app->singleton('command.console.make', function (Application $app) {
			return new ConsoleMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerContractMakeCommand()
	{
		$this->app->singleton('command.contract.make', function (Application $app) {
			return new ContractMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerCriteriaMakeCommand()
	{
		$this->app->singleton('command.criteria.make', function (Application $app) {
			return new CriteriaMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerEloquentRepositoryMakeCommand()
	{
		$this->app->singleton('command.eloquent.repository.make', function (Application $app) {
			return new EloquentRepositoryMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerEntityMakeCommand()
	{
		$this->app->singleton('command.entity.make', function (Application $app) {
			return new EntityMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerEventGenerateCommand()
	{
		$this->app->singleton('command.event.generate', function () {
			return new EventGenerateCommand;
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerEventMakeCommand()
	{
		$this->app->singleton('command.event.make', function (Application $app) {
			return new EventMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerExceptionMakeCommand()
	{
		$this->app->singleton('command.exception.make', function (Application $app) {
			return new ExceptionMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerFactoryMakeCommand()
	{
		$this->app->singleton('command.factory.make', function ($app) {
			return new FactoryMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerJobMakeCommand()
	{
		$this->app->singleton('command.job.make', function (Application $app) {
			return new JobMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerListenerMakeCommand()
	{
		$this->app->singleton('command.listener.make', function (Application $app) {
			return new ListenerMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerMailMakeCommand()
	{
		$this->app->singleton('command.mail.make', function (Application $app) {
			return new MailMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerMiddlewareMakeCommand()
	{
		$this->app->singleton('command.middleware.make', function (Application $app) {
			return new MiddlewareMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerNotificationMakeCommand()
	{
		$this->app->singleton('command.notification.make', function (Application $app) {
			return new NotificationMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerObserverMakeCommand()
	{
		$this->app->singleton('command.observer.make', function (Application $app) {
			return new ObserverMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerPageMakeCommand()
	{
		$this->app->singleton('command.page.make', function (Application $app) {
			return new PageMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerPayloadMakeCommand()
	{
		$this->app->singleton('command.payload.make', function (Application $app) {
			return new PayloadMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerPolicyMakeCommand()
	{
		$this->app->singleton('command.policy.make', function (Application $app) {
			return new PolicyMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerProviderMakeCommand()
	{
		$this->app->singleton('command.provider.make', function (Application $app) {
			return new ProviderMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerRepositoryInterfaceMakeCommand()
	{
		$this->app->singleton('command.repository.contract.make', function (Application $app) {
			return new RepositoryInterfaceMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerRepositoryMakeCommand()
	{
		$this->app->singleton('command.repository.make', function (Application $app) {
			return new RepositoryMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerRequestMakeCommand()
	{
		$this->app->singleton('command.request.make', function (Application $app) {
			return new RequestMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerResourceMakeCommand()
	{
		$this->app->singleton('command.resource.make', function (Application $app) {
			return new ResourceMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerResponderMakeCommand()
	{
		$this->app->singleton('command.responder.make', function (Application $app) {
			return new ResponderMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerRuleMakeCommand()
	{
		$this->app->singleton('command.rule.make', function (Application $app) {
			return new RuleMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerScaffoldMakeCommand()
	{
		$this->app->singleton('command.scaffold.make', function ($app) {
			return new ScaffoldMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerSeederMakeCommand()
	{
		$this->app->singleton('command.seeder.make', function ($app) {
			return new SeederMakeCommand($app['files'], $app['composer']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerServiceMakeCommand()
	{
		$this->app->singleton('command.service.make', function (Application $app) {
			return new ServiceMakeCommand($app['files']);
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerStubPublishCommand()
	{
		$this->app->singleton('command.stub.publish', function () {
			return new StubPublishCommand;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array_merge(array_values($this->devCommands));
	}
}
