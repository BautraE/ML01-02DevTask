<?php

declare(strict_types=1);

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magebit\Faq\Model\QuestionFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\View\Result\Page;

class Edit extends Action implements HttpPostActionInterface
{
    /**
     * @var QuestionRepositoryInterface
     */
    private QuestionRepositoryInterface $questionRepository;
    /**
     * @var QuestionFactory
     */
    private QuestionFactory $questionFactory;

    /**
     * @param Context $context
     * @param QuestionRepositoryInterface $questionRepository
     * @param QuestionFactory $questionFactory
     */
    public function __construct(
        Context $context,
        QuestionRepositoryInterface $questionRepository,
        QuestionFactory $questionFactory
    ) {
        parent::__construct($context);
        $this->questionRepository = $questionRepository;
        $this->questionFactory = $questionFactory;
    }

    /**
     * @return Page
     */
    protected function _initAction(): Page
    {
        $resultPage =  $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Magento_Faq::faq')
            ->addBreadcrumb(__('FAQ'), __('FAQ'))
            ->addBreadcrumb(__('Manage Questions'), __('Manage Questions'));
        return $resultPage;
    }

    /**
     * @return Redirect | Page
     * @throws LocalizedException
     */
    public function execute():  Redirect | Page
    {
        $questionId = $this->getRequest()->getParam('id');

        if($questionId) {
            $questionModel = $this->questionRepository->get((int) $questionId);
            if (!$questionModel->getId()) {
                $this->messageManager->addErrorMessage(__('This page no longer exists.'));

                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        else {
            $questionModel = $this->questionFactory->create();
        }

        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $questionId ? __('Edit Question') : __('New Question'),
            $questionId ? __('Edit Question') : __('New Question')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('FAQ Question'));
        $resultPage->getConfig()->getTitle()
            ->prepend($questionModel->getId() ? $questionModel->getQuestion() : __('New Question'));
        return  $resultPage;
    }
}
