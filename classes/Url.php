<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Url
 *
 * @author WASEEM
 */
class Url {

    public static $_page = "page";
    public static $_folder = PAGES_DIR;
    public static $_params = array();

    public static function getParam($par) {
        return isset($_GET[$par]) && $_GET[$par] != "" ?
                $_GET[$par] : NULL;
    }

    public static function cPage() {
        return isset($_GET[self::$_page]) ?
                $_GET[self::$_page] : 'index';
    }

    public static function getPage() {
        $page = self::$_folder . DS . self::cPage() . ".php";
        $error = self::$_folder . DS . "error.php";
        return is_file($page) ? $page : $error;
    }

    public function getAll() {
        if (!empty($_GET)) {
            foreach ($_GET as $key => $value) {
                if (!empty($value)) {
                    self::$_params[$key] = $value;
                }
            }
        }
    }

    public static function getCurrentUrl($remove = null) {
        self::getAll();
        $out = array();
        if (!empty($remove)) {
            $remove = !is_array($remove) ? array($remove) : $remove;

            foreach (self::$_params as $key => $value) {
                if (in_array($key, $remove)) {
                    unset(self::$_params[$key]);
                }
            }
        }

        foreach (self::$_params as $key => $value) {
            $out[] = $key . "=" . $value;
        }

        return "/?" . implode("&", $out);
    }

    public static function getReferrerUrl() {
        $page = self::getParam(Login::$_referrer);
        return !empty($page) ? "/?page={$page}" : null;
    }

    public static function getParam4Search($remove = null) {
        self::getAll();
        $out = array();
        if (!empty(self::$_params)) {
            foreach ($out as $key => $value) {
                if (!empty($remove)) {
                    $remove = is_array($remove) ? $remove : array($remove);
                    if (!in_array($key, $remove)) {
                        $input = '<input type="hidden" name="' . $key;
                        $input .= '" value="' . $value . '" />';
                        $out[] = $input;
                    }
                } else {
                    $input = '<input type="hidden" name="' . $key;
                    $input .= '" value="' . $value . '" />';
                    $out[] = $input;
                }
            }

            return implode("", $out);
        }
    }

}
