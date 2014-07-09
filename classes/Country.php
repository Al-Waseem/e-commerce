<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Country
 *
 * @author WASEEM
 */
class Country extends Application {

    public function getCountries() {
        $sql = "SELECT * FROM `countries` ORDER BY `name` ASC";

        return $this->db->fetchAll($sql);
    }

    public function getCountry($id = null) {
        if (!empty($id)) {
            $sql = "SELECT * FROM `country` WHERE `id` = '" . $this->db->escape($id) . "'";
            return $this->db->fetchOne($sql);
        }
    }

}
