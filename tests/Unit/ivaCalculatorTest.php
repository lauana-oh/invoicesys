<?php

namespace Tests\Unit;

use App\Http\Helpers\ivaCalculator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ivaCalculatorTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    
    private $ivaInteger;
    private $ivaPercent;
    
    
    public function test_convert_iva_into_percentage()
    {
        $iva = new ivaCalculator();
        $ivaTest = mt_rand() / 1000;
        $iva->setIvaInteger($ivaTest);
        
        $calculatedIva = $iva->convertIvaIntoPercentage();
        $expectedIva = $ivaTest * 100;
        $this->assertEquals($expectedIva, $calculatedIva);
    }
    
    public function test_convert_iva_into_integer()
    {
        $iva = new ivaCalculator();
        $ivaTest = mt_rand();
        $iva->setIvaPercent($ivaTest);
        
        $calculatedIva = $iva->convertIvaIntoInteger();
        $expectedIva = $ivaTest / 100;
        $this->assertEquals($expectedIva, $calculatedIva);
    }
}
