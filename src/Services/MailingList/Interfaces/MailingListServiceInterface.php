<?php
declare(strict_types=1);

namespace LaraMarketing\Services\MailingList\Interfaces;

interface MailingListServiceInterface
{
    /**
     * Create mailing list.
     *
     * @param string $listName
     * @param null|mixed[] $data
     *
     * @return mixed
     */
    public function createList(string $listName, ?array $data = []);
}
