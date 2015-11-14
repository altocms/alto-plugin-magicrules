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
 * @property PluginMagicrules_ModuleWall_MapperWall oMapper
 */
class PluginMagicrules_ModuleWall extends PluginMagicrules_Inherit_ModuleWall {

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
    public function GetCountUsersWallByTimeLast($oUser, $iSecond) {

        return $this->oMapper->GetCountUsersWallByTimeLast($oUser, $iSecond);

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
    public function CheckLastWallTime($oUser, $iSecond) {

        $xResult = $this->oMapper->CheckLastWallTime($oUser, $iSecond);
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