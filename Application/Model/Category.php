<?php

namespace SmileyThane\CategoryExtendModule\Application\Model;

use OxidEsales\Eshop\Core\Model\ListModel;

class Category extends Category_parent
{
    protected $_aMediaUrls = null;

    public function getMediaUrls()
    {
        if ($this->_aMediaUrls === null) {
            $this->_aMediaUrls = oxNew(ListModel::class);
            $this->_aMediaUrls->init("oxmediaurl");
            $this->_aMediaUrls->getBaseObject()->setLanguage($this->getLanguage());

            $sViewName = getViewName("oxmediaurls", $this->getLanguage());
            $sQ = "select * from {$sViewName} where oxobjectid = :oxobjectid";
            $this->_aMediaUrls->selectString($sQ, [
                ':oxobjectid' => $this->getId()
            ]);
        }

        return $this->_aMediaUrls;
    }
}