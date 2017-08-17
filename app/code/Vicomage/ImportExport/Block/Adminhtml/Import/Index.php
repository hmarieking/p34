<?php

namespace Vicomage\ImportExport\Block\Adminhtml\Import;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\UrlInterface;
use Magento\Backend\Block\Admin\Formkey;
use Vicomage\ImportExport\Model\Import\Tool;
use Magento\Theme\Model\ResourceModel\Theme\Collection;
use Magento\Theme\Model\Theme;
class Index extends \Magento\Backend\Block\Widget\Form\Container
{
    protected $urlBuider;
    protected $formKey;
    protected $tool;
    protected $themeCollection;
    protected $themeModel;

    public function __construct(
        Tool $tool,
        Collection $themeCollection,
        Theme $themeModel,
        Formkey $formKey,
        UrlInterface $urlBuilder,
        Context $context, array $data = [])
    {
        $this->tool = $tool;
        $this->themeCollection = $themeCollection;
        $this->themeModel = $themeModel;
        $this->formKey = $formKey;
        $this->urlBuider = $urlBuilder;
        parent::__construct($context, $data);
    }

    /**
     * Init cms page edit block
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_blockGroup = 'Vicomage_ImportExport';
        $this->_controller = 'adminhtml_import';
        $this->updateButton('save', 'label', __('Submit'));
        $this->removeButton('reset');
        $this->removeButton('back');
    }

    /**
     * Get header text
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        return __('System Import');
    }

    /**
     * Prepare layout
     *
     * @return \Magento\Framework\View\Element\AbstractBlock
     */
    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    /**
     * @return string
     */
    public function getFormUrl()
    {
        return $this->urlBuider->getUrl('importexport/import/save', array('key' => $this->getFormKey()));
    }


    public function getFormKey()
    {
        return $this->formKey->getFormKey();
    }
    /**
     * @return array
     */
    public function getOptionTheme()
    {
        return $this->tool->toOptionArray();
    }

    /**
     * @return array
     */
    public function getImageTheme()
    {
        $themePath = $this->tool->getImage();
        $imgUrl = array();
        foreach($themePath as $path){
            $themeModel =  $this->themeModel->getCollection()->addFieldToFilter('code',array('like' => $path))->getFirstItem();
            if(isset($themeModel)) {
                $imgUrl[strtolower($path)] =[
                    'image' => $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA)
                    . 'theme/preview' . '/' . $themeModel->getPreviewImage(),
                    'title' => $themeModel->getThemeTitle()
                ];
            }
        }
        return $imgUrl;
    }
}