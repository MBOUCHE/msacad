<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

define('MOT_DE_BIENVENUE','mot-de-bienvenue');
define('HISTORIQUE','historique');
define('CHIFFRES_CLES','chiffres-cles');
define('PERSONNEL_APPUI','personnel-appui');
define('PERSONNEL_PEDAGOGIQUE','personnel-pedagogique');
define('PRESENTATION','presentation');
define('CONTACTS','contacts');
define('SERVICES','services');



if ( ! function_exists('get_static_page')) {
    function get_static_page($pageKey)
    {

        $pages = array(
            "mot-de-bienvenue" => array(
                'title' => "Mot de bienvenue",
            ),
            "historique" => array(
                'title' => "Historique",
            ),
            "chiffres-cles" => array(
                'title' => "Chiffres clés",
            ),
            "personnel-appui" => array(
                'title' => "Personel d'appui",
            ),
            "personnel-pedagogique" => array(
                'title' => "Personel pédagogique",
            ),
            "presentation" => array(
                'title' => "Présentation du centre",
            ),
            "contacts" => array(
                'title' => "Contacts",
            ),
            "services" => array(
                'title' => "Nos services",
            ),
        );

        if (isset($pages[$pageKey]))
            return $pages[$pageKey];
        return false;
    }


}

    if ( ! function_exists('updateVisit')) {
        function updateVisit()
        {
            $CI =& get_instance();
            $CI->load->model('public/general_model', 'mGeneral');
            $CI->mGeneral->newVisitor();
        }
    }

