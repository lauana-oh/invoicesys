<?php

namespace App\Http\Helpers;

class ivaConverter
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
        $this->setIvaPercent($this->ivaPercent);
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
        $this->setIvaInteger($this->ivaInteger);
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