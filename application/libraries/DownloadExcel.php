<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// IMPORTANT - Replace the following line with your path to the escpos-php autoload script
  require_once __DIR__ . '/vendor/autoload.php';
  use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

require_once __DIR__ . '/vendor\phpoffice\phpspreadsheet\src/Bootstrap.php';
  class downloadexcel {
    function download($stat,$alldata,$bulan,$tahun,$namastan)
    {
      // $alldata = 'test';
      
      if ($stat == 'stan') {
        $helper = new Sample();
        if ($helper->isCli()) {
            $helper->log('This example should only be run from a Web Browser' . PHP_EOL);

            return;
        }
        // Create new Spreadsheet object
        // $spreadsheet = new Spreadsheet();
        $inputFileType = 'Xlsx'; // Xlsx - Xml - Ods - Slk - Gnumeric - Csv
        // if ($days == '28') {
        //   $inputFileName = __DIR__ .'/template28day.xlsx';
        // }else if ($days == '29') {
        //   $inputFileName = __DIR__ .'/template29day.xlsx';
        // }else if ($days == '30') {
        //   $inputFileName = __DIR__ .'/template30day.xlsx';
        // }else{
        //   $inputFileName = __DIR__ .'/template31day.xlsx';
        // }

        $inputFileName = __DIR__ .'/template.xlsx';

        

        /**  Create a new Reader of the type defined in $inputFileType  **/
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        /**  Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = $reader->load($inputFileName);

        // Set document properties
        $spreadsheet->getProperties()->setCreator('Teabreak')
            ->setLastModifiedBy('Teabreak')
            ->setTitle('Office 2007 XLSX Document')
            ->setSubject('Office 2007 XLSX Document')
            ->setDescription('document for Office 2007 XLSX, generated using PHP classes.')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('result file');

        // Add some data
            $alldata = array_filter($alldata);

            if (!empty($alldata)) {
              $maxdate = end($alldata[0])->tanggal;
              $maxdate = explode('-', $maxdate);
              $maxdate = $maxdate[2];

              $lowestdate = $alldata[0][0]->tanggal;
              $lowestdate = explode('-', $lowestdate);
              $lowestdate = $lowestdate[2];
            }else{
              $maxdate = 0;
              $lowestdate = 0;
            }
            

            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('D2', $bulan)
            ->setCellValue('E2', $tahun)
            ->setCellValue('A1', $namastan);
            $a = 6;

            if ($lowestdate == 0) {
              # empty
              $spreadsheet->setActiveSheetIndex(0)
              ->setCellValue('A6', 'TIDAK ADA DATA');

              $spreadsheet->getActiveSheet()->getStyle('A6')->getFont()->setSize(25);
              

              $spreadsheet->getActiveSheet()->mergeCells('A6:C12');
              $spreadsheet->getActiveSheet()->getStyle('A6:C12')
                      ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
              $spreadsheet->getActiveSheet()->getStyle('A6')->getFont()->setBold(true);
              $spreadsheet->getActiveSheet()->getStyle('A6')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
            }else{
              $cellstart = 'C';
              $header = false;

              foreach ($alldata as $perdata) {

                $spreadsheet->setActiveSheetIndex(0)
                  ->setCellValue('A'.$a, $perdata[0]->id_bahan_jadi)
                  ->setCellValue('B'.$a, $perdata[0]->nama_bahan_jadi);


                  $spreadsheet->getActiveSheet()->getStyle('A'.$a.':'.'C'.$a)
                      ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                  if ($header == false) {
                    foreach ($perdata as $peritembarang) {
                      $harike = $peritembarang->tanggal;
                      $harike = explode('-', $harike);
                      $harike = $harike[2];
                      $helper0 = ++$cellstart;
                      $helper1 = ++$cellstart;
                      $helper2 = ++$cellstart;
                      
                      $spreadsheet->getActiveSheet()->mergeCells($helper0.'4:'.$helper2.'4');
                      $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue($helper0.'4', $harike)
                        ->setCellValue($helper0.'5', 'Masuk')
                        ->setCellValue($helper1.'5', 'Keluar')
                        ->setCellValue($helper2.'5', 'Sisa')
                        ->setCellValue($helper0.$a, $peritembarang->stok_masuk)
                        ->setCellValue($helper1.$a, $peritembarang->stok_keluar)
                        ->setCellValue($helper2.$a, $peritembarang->stok_sisa)
                        ->setCellValue('C'.$a, $peritembarang->stok_sisa);

                    }
                    $patokankolomakhir = $helper2;
                    $header = true;

                  }else{
                      foreach ($perdata as $peritembarang) {
                        $helper0 = ++$cellstart;
                        $helper1 = ++$cellstart;
                        $helper2 = ++$cellstart;

                        $spreadsheet->setActiveSheetIndex(0)
                          ->setCellValue($helper0.$a, $peritembarang->stok_masuk)
                          ->setCellValue($helper1.$a, $peritembarang->stok_keluar)
                          ->setCellValue($helper2.$a, $peritembarang->stok_sisa)
                          ->setCellValue('C'.$a, $peritembarang->stok_sisa);

                      }
                  }

                  $a++;
                  $cellstart='C';
                  
              }

              $spreadsheet->getActiveSheet()->getStyle('D4:'.$patokankolomakhir.($a-1))
                      ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            }

            

            $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Main Data');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="01simple.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
      }else{
        
      }
      
    }
  }