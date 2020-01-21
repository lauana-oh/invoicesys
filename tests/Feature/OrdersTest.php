<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
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
        
        $response = $this->get(route('invoices.show', $invoice));
        
        $response->assertRedirect(route('login'));
    }
    
    public function test_authenticated_user_has_access_to_orders_list()
    {
        $user = factory(User::class)->create();
        factory(Company::class, 10)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoice = factory(Invoice::class)->create();
        
        $this->actingAs($user)->get(route('invoices.show', $invoice));
    
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
        
        $response = $this->actingAs($user)->get(route('invoices.show', $invoice));
        $response->assertSuccessful();
        $response->assertViewHas('orders');
        $response->assertViewIs('invoice.show');
        $response->assertSeeText($orders->shuffle()->first()->name);
    }
    
    public function test_invoice_show_contains_a_list_of_orders()
    {
        $user = factory(User::class)->create();
        factory(Category::class,6)->create();
        factory(Product::class,15)->create();
        factory(Company::class,10)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoice = factory(Invoice::class)->create();
        $orders = factory(Order::class,10)->create();
        
        $response = $this->actingAs($user)->get(route('invoices.show', $invoice));
        
        $response->assertSuccessful();
        $response->assertViewIs('invoice.show');
        $response->assertViewHas('orders');
        $response->assertSeeText($orders->shuffle()->first()->name);
    }
    
    public function test_unauthenticated_user_cannot_create_a_order()
    {
        factory(Category::class,6)->create();
        factory(Company::class,10)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoice = factory(Invoice::class)->create();
        $product = factory(Product::class)->create();
        $quantity =  $this->faker->numberBetween(1,20);

        $this->post(route('orders.store', $invoice),[
            'product' => $product,
            'quantity' => $quantity,
        ])->assertRedirect('login');
        
        $order = Order::where('invoice_id', $invoice->id)
            ->where('product_id', $product->id)
            ->where('quantity', $quantity)
            ->first();
        $this->assertNull($order);
    }
    
    public function test_a_order_can_be_created()
    {
        $user = factory(User::class)->create();
        factory(Category::class,6)->create();
        factory(Company::class,10)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoice = factory(Invoice::class)->create();
        $product = factory(Product::class)->create();
        $quantity =  $this->faker->numberBetween(1,20);
        
        $this->actingAs($user)->post(route('orders.store', $invoice), [
            'product' => $product->name,
            'quantity' => $quantity,
        ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $order = Order::where('invoice_id', $invoice->id)
            ->where('product_id', $product->id)
            ->where('quantity', $quantity)
            ->where('unit_price', $product->unit_price)
            ->where('product_iva', $product->category->iva)
            ->first();
        $this->assertNotNull($order);
    }
    
    public function test_unauthenticated_user_cannot_update_a_order()
    {
        factory(Category::class,6)->create();
        factory(Product::class,15)->create();
        factory(Company::class,10)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoice = factory(Invoice::class)->create();
        $order = factory(Order::class)->create();
        $product = factory(Product::class)->create();
        $quantity =  $this->faker->numberBetween(1,20);

        $this->put(route('orders.update', compact('invoice', 'order')),[
            'product' => $product->name,
            'quantity' => $quantity,
        ])->assertRedirect('login');
    
        $this->assertDatabaseHas('orders', compact($order));
    }
    
    public function test_a_order_can_be_updated()
    {
        $user = factory(User::class)->create();
        factory(Category::class, 6)->create();
        factory(Product::class, 15)->create();
        factory(Company::class, 10)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoice = factory(Invoice::class)->create();
        $order = factory(Order::class)->create();
        $product = Product::all()->shuffle()->first();
        $quantity = $this->faker->numberBetween(1, 20);

        $this->actingAs($user)->put(route('orders.update', compact('invoice', 'order')), [
            'product' => $product->name,
            'quantity' => $quantity,
        ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $updatedOrder = Order::find($order->id);
        $this->assertEquals($updatedOrder->invoice_id, $invoice->id);
        $this->assertEquals($updatedOrder->product_id, $product->id);
        $this->assertEquals($updatedOrder->quantity, $quantity);
        $this->assertEquals($updatedOrder->unit_price, $product->unit_price);
        $this->assertEquals($updatedOrder->product_iva, $product->category->iva);
    }
    
    public function test_can_be_details_of_a_order()
    {
        $user = factory(User::class)->create();
        factory(Category::class)-> create();
        factory(Product::class)->create();
        factory(Company::class,2)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoice = factory(Invoice::class)->create();
        $order = factory(Order::class)->create();
    
        $response =$this->actingAs($user)->get(route('orders.show', compact('invoice', 'order')));
    
        $response->assertSuccessful();
        $response->assertSeeText($order->idFormatted);
        $response->assertSeeText($order->invoice->idFormatted);
        $response->assertSeeText($order->product->name);
        $response->assertSeeText($order->product->category->name);
        $response->assertSeeText($order->unitPriceFormatted);
        $response->assertSeeText($order->quantityFormatted);
        $response->assertSeeText($order->totalPriceFormatted);
       // $response->assertSeeText($order->productIvaFormatted);
       // $response->assertSeeText($order->productIvaPaidFormatted);
    }
    
    public function test_unauthenticated_user_cannot_delete_a_order()
    {
        factory(Category::class)-> create();
        factory(Product::class)->create();
        factory(Company::class,2)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoice = factory(Invoice::class)->create();
        $order = factory(Order::class)->create();
    
        $this->delete(route('orders.destroy', compact('invoice','order')))
            ->assertRedirect(route('login'));
    
        $this->assertDatabaseHas('orders', compact($order));
    }
    
    public function test_a_order_can_be_deleted()
    {
        $user = factory(User::class)->create();
        factory(Category::class)-> create();
        factory(Product::class)->create();
        factory(Company::class,2)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoice = factory(Invoice::class)->create();
        $order = factory(Order::class)->create();
        
        $this->actingAs($user)->delete(route('orders.destroy', compact('invoice', 'order')))
            ->assertRedirect(route('invoices.show', compact('invoice')))
            ->assertSessionHasNoErrors();
        
        $this->assertDatabaseMissing('orders', compact($order));
    }
}
