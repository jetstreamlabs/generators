<?php

namespace Serenity\Generators\Providers;

use Illuminate\Support\ServiceProvider;
use Serenity\Generators\Console\AppNameCommand;
use Serenity\Generators\Console\JobMakeCommand;
use Illuminate\Contracts\Foundation\Application;
use Serenity\Generators\Console\CastMakeCommand;
use Serenity\Generators\Console\MailMakeCommand;
use Serenity\Generators\Console\PageMakeCommand;
use Serenity\Generators\Console\RuleMakeCommand;
use Serenity\Generators\Console\EventMakeCommand;
use Serenity\Generators\Console\ActionMakeCommand;
use Serenity\Generators\Console\EntityMakeCommand;
use Serenity\Generators\Console\PolicyMakeCommand;
use Serenity\Generators\Console\SeederMakeCommand;
use Serenity\Generators\Console\ChannelMakeCommand;
use Serenity\Generators\Console\ConcernMakeCommand;
use Serenity\Generators\Console\ConsoleMakeCommand;
use Serenity\Generators\Console\FactoryMakeCommand;
use Serenity\Generators\Console\PayloadMakeCommand;
use Serenity\Generators\Console\RequestMakeCommand;
use Serenity\Generators\Console\ServiceMakeCommand;
use Serenity\Generators\Console\StubPublishCommand;
use Serenity\Generators\Console\ContractMakeCommand;
use Serenity\Generators\Console\CriteriaMakeCommand;
use Serenity\Generators\Console\ListenerMakeCommand;
use Serenity\Generators\Console\ObserverMakeCommand;
use Serenity\Generators\Console\ProviderMakeCommand;
use Serenity\Generators\Console\ResourceMakeCommand;
use Serenity\Generators\Console\ScaffoldMakeCommand;
use Serenity\Generators\Console\ComponentMakeCommand;
use Serenity\Generators\Console\EventGenerateCommand;
use Serenity\Generators\Console\ExceptionMakeCommand;
use Serenity\Generators\Console\ResponderMakeCommand;
use Serenity\Generators\Console\MiddlewareMakeCommand;
use Serenity\Generators\Console\RepositoryMakeCommand;
use Serenity\Generators\Console\NotificationMakeCommand;
use Serenity\Generators\Console\EloquentRepositoryMakeCommand;
use Serenity\Generators\Console\RepositoryInterfaceMakeCommand;

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
