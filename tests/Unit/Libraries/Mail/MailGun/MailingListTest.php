<?php
declare(strict_types=1);

namespace Tests\LaraMarketing\Unit\Libraries\Mail\MailGun;

use LaraMarketing\Libraries\Mail\Exceptions\MailException;
use LaraMarketing\Libraries\Mail\MailGun\MailingMailingList;
use Mockery\MockInterface;
use Tests\LaraMarketing\AbstractTestCase;

/**
 * @covers \LaraMarketing\Libraries\Mail\MailGun\MailingMailingList
 */
final class MailingListTest extends AbstractTestCase
{
    /**
     * Test create list must be able to handle error.
     *
     * @throws \Exception
     */
    public function testCreateListMustHandleError(): void
    {
        $this->expectException(MailException::class);

        /** @var \Mailgun\Api\MailingList $mailGun */
        $mailGun = $this->mock(
            \Mailgun\Api\MailingList::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive('create')
                    ->once()
                    ->with('Developers Campaign')
                    ->andThrow(\Exception::class);
            }
        );
        $service = new MailingMailingList($mailGun);

        $service->create('Developers Campaign', []);
    }

    /**
     * Test create list must be successful.
     *
     * @throws \Exception
     */
    public function testCreateListToBeSuccessful(): void
    {
        /** @var \Mailgun\Api\MailingList $mailGun */
        $mailGun = $this->mock(
            \Mailgun\Api\MailingList::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive('create')
                    ->once()
                    ->with('Developers Campaign', 'My Name', 'This is my description', 'member')
                    ->andReturn(['any valid response']);
            }
        );

        $service = new MailingMailingList($mailGun);

        self::assertNotEmpty($service->create('Developers Campaign', [
            'name' => 'My Name',
            'description' => 'This is my description',
            'access_level' => 'member'
        ]));
    }
}
