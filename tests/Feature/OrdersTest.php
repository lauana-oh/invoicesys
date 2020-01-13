<?php

namespace Tests\Feature;

use App\Category;
use App\Company;
use App\Invoice;
use App\Order;
use App\Product;
use App\Status;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrdersTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    
    public function test_unauthenticated_user_cannot_access_to_orders_list()
    {
        factory(Company::class, 10)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoice = factory(Invoice::class)->create();
        
        $response = $this->get(route('invoices.show', compact('invoice')));
        
        $response->assertRedirect(route('login'));
    }
    
    public function test_authenticated_user_has_access_to_orders_list()
    {
        $user = factory(User::class)->create();
        factory(Company::class, 10)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoice = factory(Invoice::class)->create();
        
        $this->actingAs($user)->get(route('invoices.show', compact('invoice')));
    
        $this->assertAuthenticatedAs($user);
    }
    
    public function test_a_invoice_contains_a_list_of_orders()
    {
        $user = factory(User::class)->create();
        
        factory(Company::class, 10)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoice = factory(Invoice::class)->create();
        
        factory(Category::class,3)->create();
        factory(Product::class,10)->create();
        $orders = factory(Order::class,5)->create();
        
        $response = $this->actingAs($user)->get(route('invoices.show', compact('invoice')));
        $response->assertSuccessful();
        $response->assertViewHas('orders');
        $response->assertViewIs('invoice.show');
        $response->assertSeeText($orders->shuffle()->first()->name);
    }
}
