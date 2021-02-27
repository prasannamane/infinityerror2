<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class M_pdf {

    function m_pdf()
    {
        $CI = & get_instance();
     }
    function load($param=NULL)
    {
        //include_once APPPATH.'/third_party/mpdf/mpdf.php';
        require_once('application/third_party/mpdf/mpdf.php');

        if ($params == NULL)
        {
            $param = '"c","A4","","",15,15,35,20,10,10';
            // $param = '"en-GB-x","A4","","",10,10,10,10,6,3';
        }
        // ('c','A4','','',15,15,35,20,10,10);
        return new mPDF($param);
    }
}
