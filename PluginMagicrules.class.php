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
 * Запрещаем напрямую через браузер обращение к этому файлу.
 */
if (!class_exists('Plugin')) {
    die('Hacking attempt!');
}

class PluginMagicrules extends Plugin {

    protected $aInherits
        = array(
            'action' => array(
                'ActionAjax',
                'ActionBlog',
                'ActionContent',
            ),
            'module' => array(
                'ModuleVote' => '_ModuleVote',
            )
        );

    /**
     * Активация плагина
     */
    public function Activate() {

        if (!$this->isTableExists('?_magicrule_block')) {
            $this->ExportSQL(__DIR__ . '/install/db/init.sql');
        }
        return true;
    }

    /**
     * Инициализация плагина
     */
    public function Init() {

        return true;
    }
}

// EOF