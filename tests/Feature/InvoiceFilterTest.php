<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Tests\TestCase;

class InvoiceFilterTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    
    public function test_filter_invoice_by_delivery_date_starting_after()
    {
        $user = factory(User::class)->create();
        factory(Company::class,10)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoices = factory(Invoice::class,20)->create();
        $date = $this->faker->dateTimeBetween('-1 month', 'today')->format('Y-m-d');

        $response = $this->actingAs($user)->get(route('invoices.index',compact('invoices'), [
            'filter[delivery_date_starts_after]' => $date,
        ]))->assertSuccessful();
    
        $filter = QueryBuilder::for(Invoice::class)
            ->allowedFilters([
                AllowedFilter::scope('delivery_date_starts_after')->ignore(null),
        ])->paginate();
        
        $response->assertSee($filter);
    }
    
    public function test_filter_invoice_by_delivery_date_ending_before()
    {
        $user = factory(User::class)->create();
        factory(Company::class, 10)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoices = factory(Invoice::class, 20)->create();
        $date = $this->faker->dateTimeBetween('-1 month', 'today')->format('Y-m-d');
    
        $response = $this->actingAs($user)->get(route('invoices.index', compact('invoices'), [
            'filter[delivery_date_ends_before]' => $date,
        ]))->assertSuccessful();
    
        $filter = QueryBuilder::for(Invoice::class)
            ->allowedFilters([
                AllowedFilter::scope('delivery_date_ends_before')->ignore(null),
            ])->paginate();
    
        $response->assertSee($filter);
    }
    
    public function test_filter_invoice_by_due_date_starting_after()
    {
        $user = factory(User::class)->create();
        factory(Company::class,10)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoices = factory(Invoice::class,20)->create();
        $date = $this->faker->dateTimeBetween('today', '+3 month')->format('Y-m-d');
        
        $response = $this->actingAs($user)->get(route('invoices.index',compact('invoices'), [
            'filter[due_date_starts_after]' => $date,
        ]))->assertSuccessful();
        
        $filter = QueryBuilder::for(Invoice::class)
            ->allowedFilters([
                AllowedFilter::scope('due_date_starts_after')->ignore(null),
            ])->paginate();
        
        $response->assertSee($filter);
    }
    
    public function test_filter_invoice_by_due_date_ending_before()
    {
        $user = factory(User::class)->create();
        factory(Company::class, 10)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoices = factory(Invoice::class, 20)->create();
        $date = $this->faker->dateTimeBetween('today', '+3 month')->format('Y-m-d');
        
        $response = $this->actingAs($user)->get(route('invoices.index', compact('invoices'), [
            'filter[due_date_ends_before]' => $date,
        ]))->assertSuccessful();
        
        $filter = QueryBuilder::for(Invoice::class)
            ->allowedFilters([
                AllowedFilter::scope('due_date_ends_before')->ignore(null),
            ])->paginate();
        
        $response->assertSee($filter);
    }
    
    public function test_filter_invoice_by_invoice_date_starting_after()
    {
        $user = factory(User::class)->create();
        factory(Company::class,10)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoices = factory(Invoice::class,20)->create();
        $date = $this->faker->dateTimeBetween('-3 month', '-1 month')->format('Y-m-d');
        
        $response = $this->actingAs($user)->get(route('invoices.index',compact('invoices'), [
            'filter[due_date_starts_after]' => $date,
        ]))->assertSuccessful();
        
        $filter = QueryBuilder::for(Invoice::class)
            ->allowedFilters([
                AllowedFilter::scope('due_date_starts_after')->ignore(null),
            ])->paginate();
        
        $response->assertSee($filter);
    }
    
    public function test_filter_invoice_by_invoice_date_ending_before()
    {
        $user = factory(User::class)->create();
        factory(Company::class, 10)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoices = factory(Invoice::class, 20)->create();
        $date = $this->faker->dateTimeBetween('-3 month', '-1 month')->format('Y-m-d');
        
        $response = $this->actingAs($user)->get(route('invoices.index', compact('invoices'), [
            'filter[due_date_ends_before]' => $date,
        ]))->assertSuccessful();
        
        $filter = QueryBuilder::for(Invoice::class)
            ->allowedFilters([
                AllowedFilter::scope('due_date_ends_before')->ignore(null),
            ])->paginate();
        
        $response->assertSee($filter);
    }
    public function test_filter_invoice_by_invoice_min_total()
    {
        $user = factory(User::class)->create();
        factory(Company::class,10)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoices = factory(Invoice::class,20)->create();
        $min = $this->faker->numberBetween(100, 3000);
        
        $response = $this->actingAs($user)->get(route('invoices.index',compact('invoices'), [
            'filter[invoice_min_total]' => $min,
        ]))->assertSuccessful();
        
        $filter = QueryBuilder::for(Invoice::class)
            ->allowedFilters([
                AllowedFilter::scope('invoice_min_total')->ignore(null),
            ])->paginate();
        
        $response->assertSee($filter);
    }
    
    public function test_filter_invoice_by_invoice_max_total()
    {
        $user = factory(User::class)->create();
        factory(Company::class, 10)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoices = factory(Invoice::class, 20)->create();
        $max = $this->faker->numberBetween(2000, 5000);
        
        $response = $this->actingAs($user)->get(route('invoices.index', compact('invoices'), [
            'filter[invoice_max_total]' => $max,
        ]))->assertSuccessful();
        
        $filter = QueryBuilder::for(Invoice::class)
            ->allowedFilters([
                AllowedFilter::scope('invoice_max_total')->ignore(null),
            ])->paginate();
        
        $response->assertSee($filter);
    }
}
