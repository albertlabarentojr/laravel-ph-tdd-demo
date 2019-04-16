<?php
declare(strict_types=1);

namespace LaraMarketing\Libraries\Mail;

interface MailingListInterface
{
    /**
     * Create mailing list.
     *
     * @param string $listId
     * @param null|mixed[] $data
     *
     * @return mixed
     */
    public function create(string $listId, ?array $data = null);
}