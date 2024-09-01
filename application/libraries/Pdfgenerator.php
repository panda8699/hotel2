<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Bao gồm autoload của Composer
require_once './vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdfgenerator
{

  public function generate($html, $filename = '', $stream = TRUE, $paper = 'A4', $orientation = "portrait")
  {
    // Tạo instance của Dompdf
    $dompdf = new Dompdf();

    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $dompdf->setOptions($options);

    $dompdf->loadHtml($html);

    $dompdf->setPaper($paper, $orientation);

    $dompdf->render();

    if ($stream) {
      $dompdf->stream($filename . ".pdf", array("Attachment" => 0));
    } else {
      return $dompdf->output();
    }
  }

  public function generate_pdf($booking_id, $html, $filename = '', $stream = FALSE, $paper = 'A4', $orientation = "portrait")
  {
    $filename = (!empty($filename) ? $filename : date("Y-m-d") . "-" . $booking_id . '.pdf');

    $dompdf = new Dompdf();

    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $dompdf->setOptions($options);

    $dompdf->loadHtml($html);

    $dompdf->setPaper($paper, $orientation);

    $dompdf->render();

    if ($stream) {
      $dompdf->stream($filename, array("Attachment" => 0));
    } else {
      $output = $dompdf->output();
      file_put_contents('assets/pdf/' . $filename, $output);
      $file_path = 'assets/pdf/' . $filename;
      return $file_path;
    }
  }
}
