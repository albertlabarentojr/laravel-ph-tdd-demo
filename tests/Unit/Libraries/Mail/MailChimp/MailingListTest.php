<?php
declare(strict_types=1);

namespace Tests\LaraMarketing\Unit\Libraries\Mail\MailChimp;

use DrewM\MailChimp\MailChimp;
use LaraMarketing\Libraries\Mail\Exceptions\MailException;
use LaraMarketing\Libraries\Mail\MailChimp\MailingMailingList;
use Mockery\MockInterface;
use Tests\LaraMarketing\AbstractTestCase;

/**
 * @covers \LaraMarketing\Libraries\Mail\MailChimp\MailingMailingList
 */
final class MailingListTest extends AbstractTestCase
{
    /**
     * Test create list successful.
     *
     * @return void
     *
     * @throws \LaraMarketing\Libraries\Mail\Exceptions\MailException
     */
    public function testCreateListSuccessful(): void
    {
        /** @var \DrewM\MailChimp\MailChimp $mailchimp */
        $mailchimp = $this->mock(MailChimp::class, function (MockInterface $mock): void {
            $mock->shouldReceive('post')->once()->with('/lists', [
                'notify_on_subscribe' => 'list-id',
                'notify_on_unsubscribe' => 'list-id'
            ])->andReturn(['response-must-be-array']);
        });

        $mailingList = new MailingMailingList($mailchimp);

        self::assertEquals(['response-must-be-array'], $mailingList->create('list-id'));
    }

    /**
     * Create list should handle error from provider.
     *
     * @return void
     *
     * @throws \LaraMarketing\Libraries\Mail\Exceptions\MailException
     */
    public function testCreateListShouldHandleErrorFromProvider(): void
    {
        $this->expectException(MailException::class);
        $this->expectExceptionMessage('Invalid resource');

        /** @var \DrewM\MailChimp\MailChimp $mailchimp */
        $mailchimp = $this->mock(MailChimp::class, function (MockInterface $mock): void {
            $mock->shouldReceive('post')->once()->with('/lists', [
                'notify_on_subscribe' => 'list-id',
                'notify_on_unsubscribe' => 'list-id',
                'key' => 'invalid-data'
            ])->andReturn([
                'title' => 'Invalid resource',
                'errors' => [
                    'Invalid data has been added'
                ]
            ]);
        });

        $mailingList = new MailingMailingList($mailchimp);

        $mailingList->create('list-id', ['key' => 'invalid-data']);
    }
}
