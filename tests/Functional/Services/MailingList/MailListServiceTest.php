<?php
declare(strict_types=1);

namespace Tests\LaraMarketing\Functional\Services\MailingList;

use LaraMarketing\Services\MailingList\Interfaces\MailingListServiceInterface;
use Tests\LaraMarketing\AbstractTestCase;

/**
 * This is a functional test.
 *
 * @covers \LaraMarketing\Services\MailingList\MailingListService
 */
final class MailListServiceTest extends AbstractTestCase
{
    /**
     * Test create list to be successful.
     *
     * @return void
     */
    public function testCreateListSuccessful(): void
    {
        $mailList = $this->app->get(MailingListServiceInterface::class);

        [$listName, $data] = $this->getMailChimpData();

        self::assertNotEmpty($mailList->createList($listName, $data));
    }

    /**
     * Get mail chimp list test data
     *
     * @return mixed[]
     */
    private function getMailChimpData(): array
    {
        return [
            'larakid@gmail.com',
            [
                'name' => 'LaraMeet Developers',
                'permission_reminder' => 'You signed up for updates on Laravel PH economy.',
                'email_type_option' => false,
                'contact' => [
                    'company' => 'Doe Ltd.',
                    'address1' => 'DoeStreet 1',
                    'address2' => '',
                    'city' => 'Doesy',
                    'state' => 'Doedoe',
                    'zip' => '1672-12',
                    'country' => 'US',
                    'phone' => '55533344412'
                ],
                'campaign_defaults' => [
                    'from_name' => 'John Doe',
                    'from_email' => 'john@doe.com',
                    'subject' => 'My new campaign!',
                    'language' => 'US'
                ],
                'visibility' => 'prv',
                'use_archive_bar' => false
            ]
        ];
    }

    /**
     * Get mail gun list test data.
     *
     * @return mixed[]
     */
    private function getMailGunData(): array
    {
        return [
            'my_list3@sandbox7bfd96d5b2394dd6b9f2445bca48dcd8.mailgun.org',
            ['access_level' => 'everyone']
        ];
    }
}
