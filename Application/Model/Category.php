<?php

namespace SmileyThane\CategoryMediaPropertiesExt\Application\Model;

use OxidEsales\Eshop\Core\Model\ListModel;

/**
 * Category model.
 * Collects category information (articles, etc.)
 *
 */
class Category extends Category_parent
{
    /** @var $_aMediaUrls */
    protected $_aMediaUrls = null;

    /**
     * Return category media URL
     *
     * @return array
     */
    public function getMediaUrls()
    {
        if ($this->_aMediaUrls === null) {
            $this->_aMediaUrls = oxNew(ListModel::class);
            $this->_aMediaUrls->init("oxmediaurl");
            $this->_aMediaUrls->getBaseObject()->setLanguage($this->getLanguage());

            $sViewName = getViewName("oxmediaurls", $this->getLanguage());
            $this->_aMediaUrls->selectString(
                "select * from {$sViewName} where oxobjectid = :oxobjectid",
                [
                    ':oxobjectid' => $this->getId()
                ]
            );
        }

        return $this->_aMediaUrls;
    }
}