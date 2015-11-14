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
class PluginMagicrules_ModuleTopic_MapperTopic extends PluginMagicrules_Inherit_ModuleTopic_MapperTopic {

    /**
     * Возвращает количество топиков созданных пользователем за последние {{$iSecond}} секунд.
     * Учитываются только опубликованные топики
     *
     * @param ModuleUser_EntityUser $oUser
     * @param int $iSecond
     * @return int
     */
    public function GetCountUsersTopicByTimeLast($oUser, $iSecond) {

        $sql = "SELECT
                  COUNT(topic_id)
                FROM
                  ?_topic
                WHERE
                  user_id = ?d
                  AND topic_publish = ?d
                  AND topic_date_show > DATE_SUB(NOW(), INTERVAL ?d SECOND)";

        return (int)$this->oDb->selectCell($sql, $oUser->getId(), 1, $iSecond);

    }

    /**
     * Возвращает отрицательное значение секунд, означающее количество секунд до истечения
     * ограничения или положительное число секунд если ограничение истекло
     *
     * @param $oUser
     * @param $iSecond
     * @return int
     */
    public function CheckLastTopicTime($oUser, $iSecond) {

        $sql = "SELECT
                  TIMESTAMPDIFF(SECOND, DATE_ADD(topic_date_show, INTERVAL ?d SECOND), NOW())
                FROM
                  ?_topic
                WHERE
                  user_id = ?d
                  AND topic_publish = ?d
                ORDER BY
                  topic_date_show DESC
                LIMIT 1";

        return (int)$this->oDb->selectCell($sql, $iSecond, $oUser->getId(), 1);
    }

}