<?php

namespace App\Http\Helpers;

class ivaCalculator
{
    private $ivaInteger;
    private $ivaPercent;
    
    public function __construct($ivaInteger)
    {
        $ivaInteger=intval($ivaInteger);
        $this->setIvaInteger($ivaInteger);
    }
    
    public function setIvaInteger($ivaInteger)
    {
        $this->ivaInteger = $ivaInteger;
    }
    
    private function calculateIvaPercent()
    {
        $this->ivaPercent = ($this->ivaInteger/100);
    }
    public function convertIvaIntoPercentage()
    {
        $this->ivaPercent = $this->calculateIvaPercent();
        return $this->ivaPercent;
    }
}