<?php

namespace App\Services;

use App\Interfaces\ExportInterface;
use Illuminate\Database\Eloquent\Collection;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * Class ExcelExport
 * @package App\Services
 */
class ExcelExport implements ExportInterface
{
    /**
     * path for storing the excel file
     */
    const EXCEL_PATH = 'app/public/';

    /**
     * @param $generatedCodes
     * @return string
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     * method will generates & save the excel in the specified path & returns the file name to the controller.
     */
    public function processFile($generatedCodes)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $header = 'No of Code '.$generatedCodes->count();
        foreach($generatedCodes->chunk(7) as $key=>$rows) {
            foreach($rows as $row) {
                $insertData[$key][] = $row;
            }
        }

        $sheet->mergeCells("A1:G1");

        $sheet->setCellValue('A1', $header)->getStyle('A1')
            ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getFont()->setBold(true);

        $sheet->fromArray($insertData, '', 'A2');

        foreach ( range('A', 'G') as $column_key) {
            $sheet->getColumnDimension($column_key)->setAutoSize(true);
        }
        //custom styling for formatting
        $styleArray = array(
            'font'  => array(
                'size'  => 8,
                'name'  => 'Verdana'
            ));

        $sheet->getStyle( $sheet->calculateWorksheetDimension() )
            ->applyFromArray($styleArray);
        //custom styling for formatting
        $sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);

        $sheet->getPageSetup()->setPrintArea('A1:G150');

        $fileName = 'generated-code-' . time() . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        $path = \Storage::disk('public')->path($fileName);
        $writer->save($path);
        return $fileName;
    }
}
