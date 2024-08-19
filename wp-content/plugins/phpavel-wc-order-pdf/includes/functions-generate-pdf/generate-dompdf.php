<?php

if (! defined('ABSPATH')) exit;

require_once PHPAVEL_WC_ORDER_DIR . 'includes/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

function phpavel_generate_dompdf( $data, $ID, $slug = 'admin' )
{
  $dompdf   = new Dompdf();
  $pdf_paths = phpavel_wc_orders_pdf_paths($ID, $slug);
  $template = phpavel_get_template_generate($data);
  $filename = $pdf_paths['filenameDIR'];

  $dompdf->set_option('isRemoteEnabled', TRUE);
  $dompdf->setPaper('A4', 'portrait');
  $dompdf->loadHtml($template, 'UTF-8');
  $dompdf->render();

  $pdf = $dompdf->output();

  if (!is_dir(WC_ORDERS_PDF_DIR)) {
    mkdir(WC_ORDERS_PDF_DIR);
  }

  file_put_contents($filename, $pdf);

  if (!file_exists($filename)) {
    return false;
  }

  return $pdf_paths['filenameURL'];
}

