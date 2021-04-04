<?php

namespace App\Http\Controllers;

use App\GeneratedCode;
use App\Services\ExcelExport;
use App\Services\PDFExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PDF;

/**
 * Class ExportController
 * @package App\Http\Controllers
 */
class ExportController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     * only authenticated user allow to access this function. Because middleware "auth" is added in the Routes(routes/web.php)
     * Based on input request we will load export class(pdf or excel) & creates an instance from that class.
     * PDFExport or Export class is implemented by ExportInterface. Interface method must be defined in the child class.
     * Child class method generates & save the file & returns filename to the controller
     * Once response sends to the browser file will be downloaded.
     * After downloaded File(pdf or excel) will be automatically deleted from the server.
     */
    public function index(Request $request)
    {
        $data = GeneratedCode::pluck('random_code');

        if ($data->count() == 0) {
            return Redirect::back()->withErrors('No data found for export')->withInput();
        }

        //based on request it will load the pdf or excel class file for exporting
        if ($request->export_pdf) {
            $export = resolve(PDFExport::class);
            $path = storage_path($export::PDF_PATH);
        }
        if ($request->export_excel) {
            $export = resolve(ExcelExport::class);
            $path = storage_path($export::EXCEL_PATH);
        }
        try {
            $file = $export->processFile($data);
        } catch (\Exception $e) {
            \Log::info(['export-error', $e->getMessage()]);
        }
        return response()->download($path . $file)->deleteFileAfterSend(true);
    }
}
