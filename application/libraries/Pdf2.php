<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once 'application/third_party/dompdf2/autoload.inc.php';
  require_once('application/third_party/dompdf2/autoload.inc.php');

use Dompdf2\Dompdf;

class Pdf2 extends Dompdf
{
 public function __construct()
 {
   parent::__construct();
 }
}

?>
