<?php

namespace Magebit\PageListWidget\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magebit\PageListWidget\Block\Source\CMSPages\CMSPages;

class PageList extends Template implements BlockInterface
{
    protected $cmsPages;

    public function __construct(Template\Context $context,
            CMSPages $cmsPages, array $data = [] ) {
        parent::__construct($context, $data);
        $this->cmsPages = $cmsPages;
    }

    /**
     * Gets the full list of all CMS pages from CMSPages.php
     * @function getCMSPageOptions
     */
    public function getCMSPageOptions()
    {
        return $this->cmsPages->toOptionArray();
    }

    protected function _prepareLayout()
    {
        $this->setData('cms_page_data', $this->getCMSPageOptions());
        parent::_prepareLayout();
    }

    protected $_template = "page-list.phtml";
}
