<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();


if(!function_exists('session_data'))
{
    function session_data($data = '')
    {
        if(!$data)
        {
            return $_SESSION;
        }
        elseif(is_string($data) OR (is_int($data) And $data>=0))
        {
            return isset($_SESSION[$data])? $_SESSION[$data] : NULL;
        }
        elseif(is_array($data))
        {
            $result = array();
            foreach($data as $value)
            {
                $result[$value] = isset($_SESSION[$data])? $_SESSION[$data] : NULL;
            }
            return $result;
        }
        return NULL;
    }
}

if(!function_exists('set_session_data'))
{
    function set_session_data(array $data = array())
    {
        if(is_array($data))
        {
            foreach($data as $key=>$value)
            {
                $_SESSION[$key] = $value;
            }
        }
    }
}

if(!function_exists('unset_session_data'))
{
    function unset_session_data($data='')
    {
        if(!$data)
        {
            if(isset($_SESSION))
            {
                foreach ($_SESSION as $key => $value)
                {
                    unset($_SESSION[$key]);
                }
                unset($_SESSION);
            }
        }
        if(is_string($data))
        {
            if(isset($_SESSION[$data])) unset($_SESSION[$data]);
        }
        if(is_array($data))
        {
            foreach($data as $value)
            {
                if(isset($_SESSION[$value])) unset($_SESSION[$value]);
            }
            if(isset($_SESSION)) unset($_SESSION);
        }
    }
}

if(!function_exists('session_data_isset'))
{
    function session_data_isset($data = '')
    {
        if(!$data)
        {
            return isset($_SESSION);
        }
        elseif(is_string($data) OR (is_int($data) And $data>=0))
        {
            return isset($_SESSION[$data]);
        }
        elseif(is_array($data))
        {
            $result = $data[0];
            if(count($data) != 1)
            {
                array_shift($data);
            }
            else
            {
                $data = $data[0];
            }

            return (session_data_isset($result) And session_data_isset($data));
        }
        return false;
    }
}

if(!function_exists('set_flash_data'))
{
    function set_flash_data($data)
    {
        $_SESSION['flash'] = $data;
    }
}

if(!function_exists('get_flash_data'))
{
    function get_flash_data()
    {
        if(session_data_isset('flash')) {
            $val = $_SESSION['flash'];
            unset_session_data('flash');
            return $val;
        }
    }
}

if(!function_exists('protected_session')){
    function protected_session(array $uri = array('', ''), $roles = ''){
        $unconnect = 1;
        $connect = 0;
        if(!session_data('connect')){
            if($uri[$unconnect]){
                if(in_array(strtolower($uri[$unconnect]),array('404_error', '404', 'show_404'))) {
                    show_404();
                }
                redirect($uri[$unconnect]);
            }
        }
        else{
            if($uri[$connect]){
                redirect($uri[$connect]);
            }elseif($roles And session_data_isset('role')) {
                if (is_numeric($roles) And session_data('role') != $roles) {
                    msa_error("Désolé! Vous n'avez  pas les droits suffisants pour accéder à cette page");
                } elseif (is_array($roles) And !in_array(session_data('role'), $roles)) {
                    msa_error("Désolé! Vous n'avez  pas les droits suffisants pour accéder à cette page");
                }
            }
        }
    }
}

if(!session_data_isset('connect')) set_session_data(array('connect' => false));


define('MEMBER', 1);
define('STUDENT', 2);
define('TRAINER', 3);
define('MODERATOR', 4);
define('MANAGER', 5);
define('ADMIN', 6);


define('MSG_MEMBRE', 0);
define('MSG_SERVICE', 1);
define('MSG_REQUETE', 2);
define('MSG_APPRECIATION', 3);

if(!function_exists('role_tostring')){
    function role_tostring ($role, $lang='fr'){
        $table='role_'.$lang;
        $role_fr = array("Membre", "Apprenant", "Formateur", "Modérateur", "Gérant", "Administrateur");
        $role_en = array("Member", "Student", "Trainer", "Moderator", "Manager", "Admin");
        return ${$table}[$role-1];
    }
}

if(!function_exists('msa_error')){
    function msa_error ($error_texte){
        show_error($error_texte,ACCESS_REFUSE,"Erreur lors du traitement de la requête");
    }
}
if(!function_exists('isSudo')){
    function isSudo (){
        if(session_data_isset('sudo') and session_data('sudo'))
        {
            unset_session_data();
            msa_error("Désolé! Vous devez obligatoirement vous reconnecter avant de continuer cette opération.<br>
            <a href='".base_url('account/login')."' class='btn btn-primary'>Se reconnecter</a> ");
        }
    }
}

if(!function_exists('is_url')){
    function is_url($text=''){
        if($text And is_string($text)){
            $test = array(base_url(), 'http:', 'https:', 'ftp:', 'www');
            foreach ($test as $value) {
                if(strpos($text, $value)===0)
                    return true;
            }
        }
        return false;
    }
}

define('ACCESS_REFUSE', 403);
define('ACCESS_REFUSE_TEXTE', "Désolé! Vous n'avez pas accès à cette page");