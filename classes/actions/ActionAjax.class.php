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

class PluginMagicrules_ActionAjax extends PluginMagicrules_Inherits_ActionAjax {

    /**
     * @return string|void
     */
    protected function EventVoteComment() {

        // * Пользователь авторизован?
        if (!E::IsUser()) {
            E::ModuleMessage()->AddErrorSingle(E::ModuleLang()->Get('need_authorization'), E::ModuleLang()->Get('error'));
            return;
        }

        $xResult = E::Module('PluginMagicrules\Rule')->CheckRuleAction(
                'vote_comment', E::User(),
                array('vote_value' => (int)$this->getPost('value'))
            );
        if (true === $xResult) {
            return parent::EventVoteComment();
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

    /**
     * @return string|void
     */
    protected function EventVoteTopic() {

        // * Пользователь авторизован?
        if (!E::IsUser()) {
            E::ModuleMessage()->AddErrorSingle(
                E::ModuleLang()->Get('need_authorization'), E::ModuleLang()->Get('error')
            );
            return;
        }

        $xResult = E::Module('PluginMagicrules\Rule')->CheckRuleAction(
            'vote_topic', E::User(),
            array('vote_value' => (int)$this->getPost('value'))
        );

        if (true === $xResult) {
            return parent::EventVoteTopic();
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

    /**
     * @return string|void
     */
    protected function EventVoteUser() {

        // * Пользователь авторизован?
        if (!E::IsUser()) {
            E::ModuleMessage()->AddErrorSingle(
                E::ModuleLang()->Get('need_authorization'), E::ModuleLang()->Get('error')
            );
            return;
        }

        $xResult = E::Module('PluginMagicrules\Rule')->CheckRuleAction(
                'vote_user', E::User(),
                array('vote_value' => (int)$this->getPost('value'))
            );

        if (true === $xResult) {
            return parent::EventVoteUser();
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