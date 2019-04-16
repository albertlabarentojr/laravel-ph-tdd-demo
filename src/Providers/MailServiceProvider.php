<?php
declare(strict_types=1);

namespace LaraMarketing\Providers;

use Closure;
use DrewM\MailChimp\MailChimp;
use Illuminate\Contracts\Container\Container;
use LaraMarketing\Libraries\Mail\MailingListInterface;
use LaraMarketing\Libraries\Mail\MailChimp\MailingMailingList as MailChimpDecorated;
use LaraMarketing\Libraries\Mail\MailGun\MailingMailingList;
use LaraMarketing\Services\MailingList\Interfaces\MailingListServiceInterface;
use LaraMarketing\Services\MailingList\MailingListService;
use Mailgun\Api\MailingList as MailGunDecorated;
use Mailgun\HttpClient\HttpClientConfigurator;
use Mailgun\HttpClient\RequestBuilder;
use Mailgun\Hydrator\ArrayHydrator;

final class MailServiceProvider
{
    /**
     * @var \Illuminate\Contracts\Container\Container
     */
    private $app;

    /**
     * MailServiceProvider constructor.
     *
     * @param \Illuminate\Contracts\Container\Container $app
     */
    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    /**
     * Register Mail Gun Services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(MailingListInterface::class, $this->getMailChimpConcrete());
        $this->app->singleton(MailingListServiceInterface::class, MailingListService::class);
    }

    /**
     * Get mail chimp concrete class.
     *
     * @return Closure
     */
    private function getMailChimpConcrete(): Closure
    {
        return function (): MailingListInterface {
            return new MailChimpDecorated(new MailChimp('your-mailchimp-api-key'));
        };
    }

    /**
     * Get MailGun service concrete class.
     *
     * @return \Closure
     */
    private function getMailGunConcrete(): Closure
    {
        return function (): MailingListInterface {
            $configuration = new HttpClientConfigurator();
            $configuration->setApiKey('you-mailgun-api-key');

            $mailgunList = new MailGunDecorated(
                $configuration->createConfiguredClient(),
                new RequestBuilder(),
                new ArrayHydrator()
            );

            return new MailingMailingList($mailgunList);
        };
    }
}
