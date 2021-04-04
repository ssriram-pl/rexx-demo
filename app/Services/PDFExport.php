<?php

namespace App\Services;

use App\Interfaces\ExportInterface;
use PDF;
use phpDocumentor\Reflection\Types\Collection;

/**
 * Class PDFExport
 * @package App\Services
 *
 */
class PDFExport implements ExportInterface
{

    /**
     * path for storing the generated pdf
     */
    const PDF_PATH = '/app/public/';

    /**
     * @param $generatedCodes
     * @return string - filename
     * method will generates & save the PDF in the specified path & returns the file name to the controller.
     */
    public function processFile($generatedCodes)
    {
        $code = $generatedCodes;
        $pdf = PDF::loadView('templates.pdf_template', compact('code'));
        $fileName = 'generated-code-' . time() . '.pdf';

        //custom styling for formatting
        $customPaper = array(0,0,600.44,1000.95);
        $pdf->setPaper($customPaper, 'portrait');
        $pdf->save(storage_path(self::PDF_PATH) . $fileName);
        return $fileName;
    }
}
