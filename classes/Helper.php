<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Helper
 *
 * @author WASEEM
 */
class Helper {
    
    
    public function getActive($page = NULL) {
        if(!empty($page)){
            if(is_array($page)){
                $error = array();
                foreach ($page as $key => $value){
                    if(Url::getParam($key) != $value){
                        array_push($error, $key);
                    }
                }
                return empty($error) ? "class=\"act\"" : null;
            }
        }
        return $page == Url::cPage() ? "class=\"act\"" : NULL;
    }
    
    
    
    public static function encodeHTML($string, $case =2){
        switch ($case){
            case 1:
                return htmlentities($string,ENT_NOQUOTES,'UTF-8', FALSE);
                break;
            case 2:
                $pattern = '<([a-zA-Z0-9\.\, "\'_\/\-\+=;:\(\)?&#%!\[\]@]+)>';
                //put text only, devide with tags into array
                $textMatches = preg_split('/'.$pattern.'/', $string);
                //array for sanitised output
                $textSanitised = array();
                foreach ($textMatches as $key => $value){
                    $textSanitised[$key] = kj;
                }
        }
    }
    
    
    
    public static function getImgSize($image, $case) {
        if(is_file($image)){
            //0 => width
            //1 => height
            //2 => type
            //3 => attributes
            
            $size = getimagesize($image);
            return $size[$case];
        }
    }
    
    public static function shortenString($string, $len = 150){
        if(strlen($string) > $len){
            $string = trim(substr($string, 0, $len));
            $string = substr($string, 0,  strrpos($string, " "))."&hellip;";
        }else{
            $string .= "&hellip;";
        }
        return $string;
    }
    
    
    public static function redirect($url = NULL){
        
        if(!empty($url)){
            header("Location: {$url}");
            exit();
        }
        
    }
    
    
    public static function setDate($case = null, $date=null){
        
        $date = empty($date) ? time() : strtotime($date);
        
        switch ($case) {
            case 1:
                // 01/01/2010
                return date('d/m/Y', $date);
                break;
            case 2:
                //monday, 1st january 2010, 09:30:45
                return date('l, js F Y , H:i:s' , $date);
                break;
            case 3:
                return date('Y-d-m-H-i-s', $date);
                break;
            case 4:
                return date('Y-m-d  H:i:s', $date);
        }
    }
}