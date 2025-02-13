<?php

namespace App\Http\Controllers;

use App\Services\PhpObfuscatorService;
use Illuminate\Http\Request;

class ObfuscatorController extends Controller
{
    private $obfuscator;

    public function __construct(PhpObfuscatorService $obfuscator)
    {
        $this->obfuscator = $obfuscator;
    }

    public function index()
    {
        return view('obfuscator.index');
    }

    public function obfuscate(Request $request)
    {
        $request->validate([
            'source_code' => 'required|string',
            'options' => 'required|array',
            'options.obfuscate_functions' => 'required|boolean',
            'options.obfuscate_variables' => 'required|boolean',
            'options.encrypt_strings' => 'required|boolean',
            'options.minify' => 'required|boolean',
        ]);

        $sourceCode = $request->input('source_code');
        $options = $request->input('options');
        $obfuscatedCode = $this->obfuscator->obfuscate($sourceCode, $options);

        return response()->json([
            'obfuscated_code' => $obfuscatedCode
        ]);
    }
}
