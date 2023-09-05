<?php

declare(strict_types=1);

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action implements HttpGetActionInterface
{
    /**
     * @return Page
     */
    public function execute(): Page
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Magebit_Faq::faq');
        $resultPage->getConfig()->getTitle()->prepend(__('Frequently Asked Questions'));
        return $resultPage;
    }
}
