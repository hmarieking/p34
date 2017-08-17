<?php

namespace Vicomage\ImportExport\Controller\Adminhtml\Import;

class Save extends \Vicomage\ImportExport\Controller\Adminhtml\Action
{

    protected $_store    = 0;
    protected $_filePath = '';
    protected $_dir = '';
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        if($this->getRequest()->getParam('theme_path')) {
            $model = $this->_objectManager->get('Vicomage\ImportExport\Model\Import\Import');
            $model->importXml($this->getRequest()->getParams());
        }

        return $resultRedirect->setPath('*/*/index');
    }
}
