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

class PluginMagicrules_ActionProfile extends PluginMagicrules_Inherits_ActionProfile {
    /**
     * Добавление записи на стену
     */
    public function EventWallAdd() {

        // * Устанавливаем формат Ajax ответа
        E::ModuleViewer()->SetResponseAjax('json');

        // * Пользователь авторизован?
        if (!E::IsUser()) {
            return parent::EventNotFound();
        }

        $xResult = E::Module('PluginMagicrules\Rule')->CheckRuleAction('create_wall', E::User());
        if (true === $xResult) {
            $xResult = E::Module('PluginMagicrules\Rule')->CheckRuleCreateAction('wall', $this->oUserCurrent);
        }
        if ($xResult === true) {
            return parent::EventWallAdd();
        } else {
            if (is_string($xResult)) {
                E::ModuleMessage()->AddErrorSingle(
                    $xResult, E::ModuleLang()->Get('attention')
                );
                return Router::Action('error');
            } else {
                E::ModuleMessage()->AddErrorSingle(
                    E::ModuleLang()->Get('plugin.magicrules.check_rule_action_error'),
                    E::ModuleLang()->Get('attention')
                );
                return Router::Action('error');
            }
        }
    }
}

// EOF