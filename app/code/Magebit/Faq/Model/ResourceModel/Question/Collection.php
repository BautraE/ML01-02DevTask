<?php

declare(strict_types=1);

namespace Magebit\Faq\Model\ResourceModel\Question;

use Magebit\Faq\Model\Question;
use Magebit\Faq\Model\ResourceModel\Question as ResourceQuestion;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(Question::class, ResourceQuestion::class);
    }

}
