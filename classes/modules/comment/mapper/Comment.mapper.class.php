<?php

/**
 * Topic.mapper.class.php
 * Файл маппера для модуля Topic плагина Magicrules
 *
 * @author      Андрей Воронов <andreyv@gladcode.ru>
 * @copyrights  Copyright © 2015, Андрей Воронов
 *              Является частью плагина Magicrules
 * @version     0.0.1 от 11.11.2015 11:01
 */
class PluginMagicrules_ModuleComment_MapperComment extends PluginMagicrules_Inherit_ModuleComment_MapperComment {

    /**
     * Возвращает количество топиков созданных пользователем за последние {{$iSecond}} секунд.
     * Учитываются только опубликованные топики
     *
     * @param ModuleUser_EntityUser $oUser
     * @param int $iSecond
     * @return int
     */
    public function GetCountUsersCommentByTimeLast($oUser, $iSecond) {

        $sql = "SELECT
                  COUNT(comment_id)
                FROM
                  ?_comment
                WHERE
                  user_id = ?d
                  AND comment_publish = ?d
                  AND target_type = ?
                  AND comment_date > DATE_SUB(NOW(), INTERVAL ?d SECOND)";

        return (int)$this->oDb->selectCell($sql, $oUser->getId(), 1, 'topic', $iSecond);

    }

    /**
     * Возвращает отрицательное значение секунд, означающее количество секунд до истечения
     * ограничения или положительное число секунд если ограничение истекло
     *
     * @param ModuleUser_EntityUser $oUser
     * @param $iSecond
     * @return int
     */
    public function CheckLastCommentTime($oUser, $iSecond) {

        $sql = "SELECT
                  TIMESTAMPDIFF(SECOND, DATE_ADD(comment_date, INTERVAL ?d SECOND), NOW())
                FROM
                  ?_comment
                WHERE
                  user_id = ?d
                  AND target_type = ?
                  AND comment_publish = ?d
                ORDER BY
                  comment_date DESC
                LIMIT 1";

        return (int)$this->oDb->selectCell($sql, $iSecond, $oUser->getId(), 'topic', 1);
    }

}