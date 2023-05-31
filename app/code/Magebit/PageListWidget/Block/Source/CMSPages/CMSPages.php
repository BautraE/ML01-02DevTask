<?php

namespace Magebit\PageListWidget\Block\Source\CMSPages;

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
    public function __construct(CollectionFactory $collectionFactory) {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Get CMS Pages as $options
     *
     * @var array $options
     * @var collectionFactory $collection
     * @return array
     */
    public function toOptionArray() {
        $options = [];
        $collection = $this->collectionFactory->create();
        $collection->addFieldToSelect(['page_id', 'title', 'identifier']);

        foreach ($collection as $cmsPage) {
            $options[] = [
                'value' => $cmsPage->getId(),
                'label' => $cmsPage->getTitle(),
                'url' => $cmsPage->getIdentifier()
            ];
        }

        return $options;
    }
}
