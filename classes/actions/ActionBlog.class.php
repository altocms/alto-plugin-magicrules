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

class PluginMagicrules_ActionBlog extends PluginMagicrules_Inherits_ActionBlog {

    protected function SubmitComment() {
        /**
         * Проверям авторизован ли пользователь
         */
        if (!E::ModuleUser()->IsAuthorization()) {
            E::ModuleMessage()->AddErrorSingle(
                E::ModuleLang()->Get('need_authorization'),
                E::ModuleLang()->Get('error')
            );
            return;
        }

        $xResult = E::Module('PluginMagicrules\Rule')->CheckRuleAction('create_comment', $this->oUserCurrent);
        if (true === $xResult) {
            return parent::SubmitComment();
        } else {
            if (is_string($xResult)) {
                E::ModuleMessage()->AddErrorSingle(
                    $xResult, E::ModuleLang()->Get('attention')
                );
                return;
            } else {
                E::ModuleMessage()->AddErrorSingle(
                    E::ModuleLang()->Get(
                        'plugin.magicrule.check_rule_action_error'
                    ), E::ModuleLang()->Get('attention')
                );
                return;
            }
        }
    }
}

// EOF