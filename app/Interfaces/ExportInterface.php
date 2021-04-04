<?php

namespace App\Interfaces;

/**
 * Interface ExportInterface
 * @package App\Interfaces
 */
interface ExportInterface
{
    /**
     * @param $generatedCodes
     * @return string filename
     */
    public function processFile($generatedCodes);
}
