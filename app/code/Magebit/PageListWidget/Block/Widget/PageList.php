<?php

declare(strict_types=1);

namespace Magebit\PageListWidget\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\FilterBuilder;

class PageList extends Template implements BlockInterface
{
    /**
     * @var string
     */
    protected $_template = "page-list.phtml";
    /**
     * @var PageRepositoryInterface
     */
    protected $pageRepositoryInterface;
    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;
    /**
     * @var FilterBuilder
     */
    protected $filterBuilder;

    /**
     * @param Template\Context $context
     * @param PageRepositoryInterface $pageRepositoryInterface
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param FilterBuilder $filterBuilder
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        PageRepositoryInterface $pageRepositoryInterface,
        SearchCriteriaBUilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->pageRepositoryInterface = $pageRepositoryInterface;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getRightPages():array {
        $displayMode = $this->getData('display_mode');

        if ($displayMode == "s") {
            $pageIDString = $this->getData('selected_pages');
            $pageIDs = explode(',', $pageIDString);
            $filter = $this->filterBuilder
                ->setField('page_id')
                ->setValue($pageIDs)
                ->setConditionType('in')
                ->create();
            $searchCriteria = $this->searchCriteriaBuilder->addFilters([$filter]);

        }
        $searchCriteria = $this->searchCriteriaBuilder->create();

        $requiredPages = $this->pageRepositoryInterface->getList($searchCriteria)->getItems();
        return $requiredPages;
    }
}
