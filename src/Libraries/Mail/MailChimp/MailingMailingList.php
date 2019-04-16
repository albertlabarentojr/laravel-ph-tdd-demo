<?php
declare(strict_types=1);

namespace LaraMarketing\Libraries\Mail\MailChimp;

use DrewM\MailChimp\MailChimp;
use LaraMarketing\Libraries\Mail\Exceptions\MailException;
use LaraMarketing\Libraries\Mail\MailingListInterface;

final class MailingMailingList implements MailingListInterface
{
    /**
     * @var \DrewM\MailChimp\MailChimp
     */
    private $mailChimp;

    public function __construct(MailChimp $mailChimp)
    {
        $this->mailChimp = $mailChimp;
    }

    /**
     * Create mailing list.
     *
     * @param string $listId
     * @param null|mixed[] $data
     *
     * @return mixed
     *
     * @throws \LaraMarketing\Libraries\Mail\Exceptions\MailException
     */
    public function create(string $listId, ?array $data = null)
    {
        $data = $data ?? [];

        $response = $this->mailChimp->post(
            '/lists',
            ['notify_on_subscribe' => $listId, 'notify_on_unsubscribe' => $listId] + $data
        );

        $onError = $response['errors'] ?? null;

        if ($onError !== null) {
            throw new MailException($response['title'] ?? 'Error Occurred!');
        }

        return $response;
    }
}
