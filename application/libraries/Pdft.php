<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

require_once 'application/third_party/tcpdf/tcpdf.php';
  
class Pdf extends TCPDF
{
 function __construct()
 {
 parent::__construct();
 }
}
?>
