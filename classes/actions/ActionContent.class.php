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

class PluginMagicrules_ActionContent extends PluginMagicrules_Inherits_ActionTopic {

    protected function EventAdd() {

        $xResult = E::Module('PluginMagicrules\Rule')->CheckRuleAction('create_topic', $this->oUserCurrent);
        if ($xResult === true) {
            return parent::EventAdd();
        } else {
            if (is_string($xResult)) {
                E::ModuleMessage()->AddErrorSingle(
                    $xResult, E::ModuleLang()->Get('attention')
                );
                return Router::Action('error');
            } else {
                E::ModuleMessage()->AddErrorSingle(
                    E::ModuleLang()->Get(
                        'plugin.magicrules.check_rule_action_error'
                    ), E::ModuleLang()->Get('attention')
                );
                return Router::Action('error');
            }
        }
    }
}

// EOF