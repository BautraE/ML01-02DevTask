<?php

declare(strict_types=1);

namespace Magebit\Faq\Block;

use Magento\Framework\View\Element\Template;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\LocalizedException;

class QuestionList extends Template
{
    /**
     * @var QuestionRepositoryInterface
     */
    private QuestionRepositoryInterface $questionRepositoryInterface;
    /**
     * @var SearchCriteriaBuilder
     */
    private SearchCriteriaBuilder $searchCriteriaBuilder;

    /**
     * @param Template\Context $context
     * @param array $data
     * @param QuestionRepositoryInterface $questionRepositoryInterface
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        Template\Context $context,
        array $data,
        QuestionRepositoryInterface $questionRepositoryInterface,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        parent::__construct($context, $data);
        $this->questionRepositoryInterface = $questionRepositoryInterface;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @return array
     * @throws LocalizedException
     */
    public function getQuestions(): array
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        return $this->questionRepositoryInterface->getList($searchCriteria)->getItems();
    }
}
