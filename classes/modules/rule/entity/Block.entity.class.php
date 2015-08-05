<?php
/* ---------------------------------------------------------------------------
 * @Project: Alto CMS
 * @Plugin Name: Magic Rules
 * @Description: Specific rules for voting and add content
 * @Author: Alto CMS Team
 * @Author URI: http://altocms.com
 * @License: GNU GPL v2
 *----------------------------------------------------------------------------
 * Based on
 *   Plugin Magic Rule for LiveStreet CMS
 *   Author: LiveStreet Developers Team
 *   Site: https://github.com/livestreet/lsplugin-magicrule
 *----------------------------------------------------------------------------
 */

/**
 * Сущность
 *
 */
class PluginMagicrules_ModuleRule_EntityBlock extends EntityORM {

    protected function beforeSave() {

        if ($this->_isNew()) {
            $this->setDateCreate(date('Y-m-d H:i:s'));
        }
        return true;
    }

    public function setData($aData) {

        $this->_aData['data'] = serialize($aData);
    }

    public function getData($sKey = null) {

        $aData = $this->_getDataOne('data');
        $aReturn = @unserialize($aData);
        if (is_null($sKey)) {
            if ($aReturn) {
                return $aReturn;
            }
            return array();
        } else {
            if ($aReturn && array_key_exists($sKey, $aReturn)) {
                return $aReturn[$sKey];
            } else {
                return null;
            }
        }
    }
}

// EOF