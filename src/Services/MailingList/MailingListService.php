<?php
declare(strict_types=1);

namespace LaraMarketing\Services\MailingList;

use LaraMarketing\Libraries\Mail\MailingListInterface;
use LaraMarketing\Services\MailingList\Interfaces\MailingListServiceInterface;

final class MailingListService implements MailingListServiceInterface
{
    /**
     * @var \LaraMarketing\Libraries\Mail\MailingListInterface
     */
    private $list;

    /**
     * MailingListService constructor.
     *
     * @param \LaraMarketing\Libraries\Mail\MailingListInterface $list
     */
    public function __construct(
        MailingListInterface $list
    ) {
        $this->list = $list;
    }

    /**
     * @param string $listName
     * @param null|mixed[] $data
     *
     * @return mixed
     */
    public function createList(string $listName, ?array $data = null)
    {
        return $this->list->create($listName, $data ?? []);
    }
}
