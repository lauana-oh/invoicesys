<?php

namespace Tests\Unit;

use App\Http\Helpers\ivaConverter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ivaConverterTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    
    private $ivaConverted;
    private $ivaTested;
    
    
    public function test_convert_iva_into_percentage()
    {
        $ivaConverted = new ivaConverter();
        $ivaTested = mt_rand() / 1000;
        $ivaConverted->setIvaInteger($ivaTested);
        
        $calculatedIva = $ivaConverted->convertIvaIntoPercentage();
        $expectedIva = $ivaTested * 100;
        $this->assertEquals($expectedIva, $calculatedIva);
    }
    
    public function test_convert_iva_into_integer()
    {
        $ivaConverted = new ivaConverter();
        $ivaTested = mt_rand();
        $ivaConverted->setIvaPercent($ivaTested);
        
        $calculatedIva = $ivaConverted->convertIvaIntoInteger();
        $expectedIva = $ivaTested / 100;
        $this->assertEquals($expectedIva, $calculatedIva);
    }
}
