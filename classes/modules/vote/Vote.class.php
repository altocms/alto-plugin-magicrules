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

class PluginMagicrules_ModuleVote extends PluginMagicrules_Inherits_ModuleVote {

    public function AddVote(ModuleVote_EntityVote $oVote) {
        $bResult = parent::AddVote($oVote);
        if ($bResult) {
            E::Module('PluginMagicrules\Rule')->CheckForCreateBlockVote($oVote);
        }
        return $bResult;
    }
}

// EOF