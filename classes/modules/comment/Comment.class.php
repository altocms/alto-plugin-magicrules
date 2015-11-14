<?php

/**
 * Topic.class.php
 * Файл модуля Topic плагина magicrules
 *
 * @author      Андрей Воронов <andreyv@gladcode.ru>
 * @copyrights  Copyright © 2015, Андрей Воронов
 *              Является частью плагина magicrules
 * @version     0.0.1 от 11.11.2015 10:59
 *
 * @property PluginMagicrules_ModuleComment_MapperComment oMapper
 */
class PluginMagicrules_ModuleComment extends PluginMagicrules_Inherit_ModuleComment {

    /**
     * Возвращает количество топиков созданных пользователем за последние {{$iSecond}} секунд.
     * Учитываются только опубликованные топики
     *
     * Не кэшируется, поскольку запрос берётся от текущего времени
     *
     * @param ModuleUser_EntityUser $oUser
     * @param int $iSecond
     * @return int
     */
    public function GetCountUsersCommentByTimeLast($oUser, $iSecond) {

        return $this->oMapper->GetCountUsersCommentByTimeLast($oUser, $iSecond);

    }

    /**
     * Проверяет истёк ли указанный временной интервал с момента публикации
     * крайнего топика. Возвращает или TRUE, если интервал истёк или количество
     * секунд до истечения интервала
     *
     * @param ModuleUser_EntityUser $oUser
     * @param int $iSecond
     * @return bool
     */
    public function CheckLastCommentTime($oUser, $iSecond) {

        $xResult = $this->oMapper->CheckLastCommentTime($oUser, $iSecond);
        if ($xResult >= 0) {
            return TRUE;
        }

        return array(
            'h' => gmdate("H", abs($xResult)),
            'm' => gmdate("i", abs($xResult)),
            's' => gmdate("s", abs($xResult))
        );

    }

}