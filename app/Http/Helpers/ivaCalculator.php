<?php

namespace App\Http\Helpers;

class ivaCalculator
{
    private $ivaInteger;
    private $ivaPercent;
    
    public function convertIvaIntoPercentage()
    {
        return $this->calculateIvaPercent();
    }
    
    private function calculateIvaPercent()
    {
        $iva =$this->getIvaInteger();
        $this->ivaPercent=$iva*100;
        return $this->ivaPercent;
    }
    
    private function getIvaInteger()
    {
        return $this->ivaInteger;
    }
    
    public function setIvaInteger($ivaInteger)
    {
        $this->ivaInteger = $ivaInteger;
    }
    

    public function convertIvaIntoInteger()
    {
        return $this->calculateIvaInteger();
    }
    
    private function calculateIvaInteger()
    {
        $iva = $this->getIvaPercent();
        $this->ivaInteger = $iva/100;
        return $this->ivaInteger;
    }
    
    private function getIvaPercent()
    {
        return $this->ivaPercent;
    }
    
    public function setIvaPercent($ivaPercent)
    {
        $this->ivaPercent = $ivaPercent;
    }
}