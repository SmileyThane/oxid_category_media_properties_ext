<?php

namespace SmileyThane\CategoryExtendModule\Application\Controller\Admin;

use OxidEsales\Eshop\Application\Model\Category;
use OxidEsales\Eshop\Application\Model\MediaUrl;
use OxidEsales\Eshop\Core\Exception\ExceptionToDisplay;
use OxidEsales\Eshop\Core\Field;
use OxidEsales\Eshop\Core\Registry;

class CategoryMain extends CategoryMain_parent
{
    const NEW_CATEGORY_ID = "-1";

    public function render()
    {
        parent::render();

        /** @var Category $oCategory */
        $oCategory = $this->createCategory();

        /** @var $categoryId */
        $categoryId = $this->getEditObjectId();

        $this->_aViewData["edit"] = $oCategory;
        $this->_aViewData["oxid"] = $categoryId;

        if (isset($categoryId) && $categoryId != self::NEW_CATEGORY_ID) {
            $oCategory->loadInLang($this->_iEditLang, $categoryId);
        }

        $this->_aViewData['aMediaUrls'] = $oCategory->getMediaUrls();

        return "category_main.tpl";
    }

    public function save()
    {
        parent::save();

        $config = $this->getConfig();
        $file = $config->getUploadedFile("myfile");
        $aMediaFile = $config->getUploadedFile("mediaFile");

        if (is_array($file['name']) && reset($file['name']) || $aMediaFile['name']) {
            $config = $this->getConfig();
            if ($config->isDemoShop()) {
                $oEx = oxNew(ExceptionToDisplay::class);
                $oEx->setMessage('ARTICLE_EXTEND_UPLOADISDISABLED');
                Registry::getUtilsView()->addErrorToDisplay($oEx, false);

                return null;
            }
        }

        $soxId = $this->getEditObjectId();
        $sMediaUrl = $this->getConfig()->getRequestParameter("mediaUrl");
        $sMediaDesc = $this->getConfig()->getRequestParameter("mediaDesc");

        if (($sMediaUrl && $sMediaUrl != 'http://') || $aMediaFile['name'] || $sMediaDesc) {
            if (!$sMediaDesc) {
                return Registry::getUtilsView()->addErrorToDisplay('EXCEPTION_NODESCRIPTIONADDED');
            }

            if ((!$sMediaUrl || $sMediaUrl == 'http://') && !$aMediaFile['name']) {
                return Registry::getUtilsView()->addErrorToDisplay('EXCEPTION_NOMEDIAADDED');
            }

            $oMediaUrl = oxNew(MediaUrl::class);
            $oMediaUrl->setLanguage($this->_iEditLang);
            $oMediaUrl->oxmediaurls__oxisuploaded = new Field(0, Field::T_RAW);

            if ($aMediaFile['name']) {
                try {
                    $sMediaUrl = Registry::getUtilsFile()->processFile('mediaFile','out/media/');
                    $oMediaUrl->oxmediaurls__oxisuploaded = new Field(1,Field::T_RAW);
                } catch (Exception $e) {
                    return Registry::getUtilsView()->addErrorToDisplay($e->getMessage());
                }
            }

            $oMediaUrl->oxmediaurls__oxobjectid = new Field($soxId, Field::T_RAW);
            $oMediaUrl->oxmediaurls__oxurl = new Field($sMediaUrl,Field::T_RAW);
            $oMediaUrl->oxmediaurls__oxdesc = new Field($sMediaDesc,Field::T_RAW);
            $oMediaUrl->save();
        }

        return $this->setEditObjectId($soxId);
    }

    public function updateMedia()
    {
        $aMediaUrls = $this->getConfig()->getRequestParameter('aMediaUrls');
        if (($aMediaUrls ?? false) && is_array($aMediaUrls)) {
            foreach ($aMediaUrls as $sMediaId => $aMediaParams) {
                $oMedia = oxNew(MediaUrl::class);
                if ($oMedia->load($sMediaId)) {
                    $oMedia->assign($aMediaParams);
                    $oMedia->setLanguage($this->_iEditLang);
                    $oMedia->save();
                }
            }
        }
    }

    public function deleteMedia()
    {
        $objectId = $this->getEditObjectId();
        $sMediaId = $this->getConfig()->getRequestParameter("mediaid");
        if ($sMediaId && $objectId) {
            $oMediaUrl = oxNew(MediaUrl::class);
            $oMediaUrl->load($sMediaId);
            $oMediaUrl->delete();
        }
    }

}
