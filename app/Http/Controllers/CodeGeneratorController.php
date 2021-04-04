<?php

namespace App\Http\Controllers;

use App\Repositories\CodeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * Class CodeGeneratorController
 * @package App\Http\Controllers
 */
class CodeGeneratorController extends Controller
{
    /**
     * @var CodeRepository
     */
    private $codeRepository;

    /**
     * CodeGeneratorController constructor.
     * @param CodeRepository $codeRepository
     * CodeRepository is injected by using dependency injection
     */
    public function __construct(CodeRepository $codeRepository)
    {
        $this->codeRepository = $codeRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * only authenticated user allow to access this function. Because middleware "auth" is added in the Routes(routes/web.php)
     * add function validates the input request & send the request to the codeRepository generateCode function
     * if validation fails return the error message to the view
     * if records successfully added it returns to the listing page
     */
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_of_code' => 'required|integer|max:9999',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $code = $this->codeRepository->generateCode($request);
        return redirect()->route('code-generator.show');
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * only authenticated user allow to access this function. Because middleware "auth" is added in the Routes(routes/web.php)
     */
    public function showData()
    {
        $code = $this->codeRepository->getCode();
        return view('code-generator.show', compact('code'));
    }
}
