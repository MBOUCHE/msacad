<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 04/01/2017
 * Time: 08:44
 */

class MY_Profiler extends CI_Profiler {

    function _compile_session() {
        $output  = "\n\n";
        $output .= '<fieldset style="border:1px solid #009999;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee">';
        $output .= "\n";
        $output .= '<legend style="color:#009999;">&nbsp;&nbsp;' . 'DONNEES SESSION' . '&nbsp;&nbsp;</legend>';
        $output .= "\n";

        if(is_object($this->CI->session)) {
            // Le contenu de la session
        }
        else {
            echo 'donnéesbnj,';
            $output .= "<div style='color:#009999;fontweight:normal;padding:4px 0 4px 0'>".'No SESSION data exists'."</div>";
        }

        return $output . "</fieldset>";
    }

    function run() {
        $output = "<div id='codeigniter_profiler' style='clear:both;background-color:#fff;padding:10px;'>";
        $output .= $this->_compile_uri_string();
        $output .= $this->_compile_get();
        $output .= $this->_compile_post();
        $output .= $this->_compile_controller_info();
        $output .= $this->_compile_benchmarks();
        $output .= $this->_compile_queries();
        $output .= $this->_compile_memory_usage();
        $output .= $this->_compile_session();
        $output .= '</div>';
        return $output;
    }



}
