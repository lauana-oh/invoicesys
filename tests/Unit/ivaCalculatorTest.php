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
    
    public function set_parameters()
    {
        $this->ivaInteger= 20;
        $this->ivaPercent= new ivaCalculator($this->ivaInteger);
    }
    
    public function test_convert_iva_into_percentage()
    {
        $calculatedIva = $this->ivaPercent;
        $expectedIva = $this->ivaInteger/100;
        $this->assertEquals($expectedIva,$calculatedIva);
    }
}

