<?php

require_once ('PHPMailer/PHPMailer.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Email
 *
 * @author WASEEM
 */
class Email {
    
    private $objMailer;
    
    
    public function __construct() {
        $this->objMailer = new PHPMailer;
        $this->objMailer->IsSMTP();
        $this->objMailer->SMTPAuth = true;
        $this->objMailer->SMTPKeepAlive = TRUE;
        $this->objMailer->Host = "smtb.gmail.com";
        $this->objMailer->Port = 25;
        $this->objMailer->Username = "waseem.khalel@gmail.com";
        $this->objMailer->Password = "password";
        $this->objMailer->SetFrom($this->objMailer->Username, "Waseem ALKHALEL");
        $this->objMailer->AddReplyTo($this->objMailer->Username, "Waseem ALKHALEL");
    }
    
    
    public function process($case = null, $array = null){
        if(!empty($case)){
            switch ($case) {
                case 1:
                    //add url to the array
                    $link = "<a href=\"". SITE_URL."/?page=activate&code=";
                    $link .= $array['hash'];
                    $link .= "\">";
                    $link .= SITE_URL."/?page=activate&code=";
                    $link .=$array['hash'];
                    $link .= "</a>";
                    
                    $array['link'] = $link;
                    
                    $this->objMailer->Subject = "Activate your account";
                    
                    $this->objMailer->MsgHTML($this->fetchEmail($case, $array));
                    $this->objMailer->AddAddress(
                            $array['email'],
                            $array['first_name'].' '. $array['last_name']
                            );
                    
                    break;
            }
            
            //sending email
            if($this->objMailer->Send()){
                $this->objMailer->ClearAddresses();
                return TRUE;
            }
            return false;
        }
    }
    
    
    public function fetchEmail($case = null, $array = null){
        if(!empty($case)){
            if(!empty($array)){
                foreach ($array as $key => $value) {
                    ${$key} = $value;
                }
            }
            
            ob_start();
            require_once (EMAILS_PATH.DS.$case.".php");
            $out = ob_get_clean();
            return $this->wrapEmail($out);
        }
    }
    
    
    
    public function wrapEmail($content = null) {
        
        if(!empty($content)){
            return "<div> style=\"font-family:Arial, Verdana, Sans-serif;"
            . "font-size:12px;color:#333;line-height:21px;\">{$content}</div>";
        }
        
    }
    
}
