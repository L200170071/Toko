<?php
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);


// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006f', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);


$pdf->SetFont('courier', '', 10);








// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

// add a page
$pdf->AddPage();


$html = '<table border="1" cellspacing="3" cellpadding="4">

    <tr>

        <td bgcolor="#cccccc" align="justify">Teknologi informasi sudah berkembang sangat pesat. Hampir semua kalangan masyarakat sudah mulai akrab melakukan transaksi informasi melalui jaringan nirkabel baik itu website maupun media smartphone. Salah satu jenis pelayan publik yang menjadi ujung tombak pembangunan suatu daerah adalah pelayanan perijinan. Dengan memanfaatkan perkembangan Teknologi Informasi ini, tentunya Pelayanan Perijinan akan menjadi lebih efektif, efiasien, akuntabel, mudah, cepat, transparan dan tepat waktu.
	Pelayanan Perijinan di Dinas Perijinan sudah menggunakan aplikasi web-base tetapi masih digunakan dalam lingkup lokal Pelayanan di Dinas Perijinan. Pemanfaatan aplikasi akan lebih maksimal, apabila dikembangkan menjadi sebuah aplikasi pelayanan online.
Dalam pelayanan perijinan membutuhkan pengolahan data yang responsif, cepat dan akurat. Kebutuhan data yang seperti ini akan dimungkinkan apabila tuntutan kecepatan pelayanan semakin tinggi.
</td>
    </tr>
</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');



$pdf->Output('example_006.pdf', 'I');
