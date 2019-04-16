<?php
declare(strict_types=1);

namespace LaraMarketing\Libraries\Mail\MailGun;

use LaraMarketing\Libraries\Mail\Exceptions\MailException;
use LaraMarketing\Libraries\Mail\MailingListInterface;
use Mailgun\Api\MailingList as MailGunMailingList;

final class MailingMailingList implements MailingListInterface
{
    /**
     * @var \Mailgun\Api\MailingList
     */
    private $mailingList;

    /**
     * MailList constructor.
     *
     * @param \Mailgun\Api\MailingList $mailingList
     */
    public function __construct(MailGunMailingList $mailingList)
    {
        $this->mailingList = $mailingList;
    }

    /**
     * Create mailing list.
     *
     * @param string $listId
     * @param null|mixed[] $data
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function create(string $listId, ?array $data = null)
    {
        $result = null;

        try {
            $result = $this->mailingList->create(
                $listId,
                $data['name'] ?? 'Default Name',
                $data['description'] ?? 'Default Description',
                $data['access_level'] ?? 'readonly'
            );
        } catch (\Exception $exception) {
            throw new MailException($exception->getMessage());
        }

        return $result;
    }
}
