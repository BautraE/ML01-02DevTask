<?php

declare(strict_types=1);

namespace Magebit\PageListWidget\Model\Config\Source;

use Magento\Cms\Model\ResourceModel\Page\CollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;

class CMSPages implements OptionSourceInterface
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Get CMS Pages as $options
     *
     * @var array $options
     * @var collectionFactory $collection
     * @return array
     */
    public function toOptionArray(): array {
        $options = [];
        $collection = $this->collectionFactory->create();
        $collection->addFieldToSelect(['page_id', 'title', 'identifier']);

        foreach ($collection as $cmsPage) {
            $options[] = [
                'value' => $cmsPage->getId(),
                'label' => $cmsPage->getTitle()
            ];
        }

        return $options;
    }
}
