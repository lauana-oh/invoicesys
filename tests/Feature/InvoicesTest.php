<?php

namespace Tests\Feature;

use App\Company;
use App\Invoice;
use App\Status;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvoicesTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    
    public function test_unauthenticated_user_cannot_access_to_invoices_list()
    {
        $response = $this->get(route('invoices.index'));
        
        $response->assertRedirect(route('login'));
    }
    
    public function test_authenticated_user_has_access_to_invoices_list()
    {
        $user = factory(User::class)->create();
        
        $this->actingAs($user)->get(route('invoices.index'))->assertSuccessful();
        
        $this->assertAuthenticatedAs($user);
    }
    
    public function test_invoices_list_contains_a_list_of_invoices()
    {
        $user = factory(User::class)->create();
        factory(Company::class, 10)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoices = factory(Invoice::class, 5)->create();
        
        $response = $this->actingAs($user)->get(route('invoices.index'));
        
        $response->assertSuccessful();
        $response->assertViewHas('invoices');
        $response->assertViewIs('invoice.index');
        $response->assertSeeText($invoices->shuffle()->first()->name);
    }
    
    public function test_unauthenticated_user_cannot_create_a_invoice()
    {
        $this->seed(\StatusesTableSeeder::class);
        $client = factory(Company::class)->create();
        $vendor = factory(Company::class)->create();
        $dueDate = $this->faker->dateTimeThisYear('+3 month')->format('Y-m-d');
        $deliveryDate = $this->faker->dateTimeThisYear($dueDate)->format('Y-m-d');
        $invoiceDate = $this->faker->dateTimeThisYear($deliveryDate)->format('Y-m-d');
        $status = Status::all()->shuffle()->first();
        
        $this->post(route('invoices.store'), [
            'client_id' => $client->id,
            'vendor_id' => $vendor->id,
            'due_date' => $dueDate,
            'delivery_date' => $deliveryDate,
            'invoice_date' => $invoiceDate,
            'status_id' => $status->id,
        ])->assertRedirect('login');
        
        $invoice = Invoice::where('client_id', $client->id)
            ->where('vendor_id', $vendor->id)
            ->where('due_date', $dueDate)
            ->where('delivery_date', $deliveryDate)
            ->where('invoice_date', $invoiceDate)
            ->where('status_id', $status->id)
            ->first();
        $this->assertNull($invoice);
    }
    
    public function test_a_invoice_can_be_created()
    {
        $user = factory(User::class)->create();
        factory(Company::class, 10)->create();
        $this->seed(\StatusesTableSeeder::class);
        $client = factory(Company::class)->create();
        $vendor = factory(Company::class)->create();
        $dueDate = $this->faker->dateTimeThisYear('+3 month')->format('Y-m-d');
        $deliveryDate = $this->faker->dateTimeThisYear($dueDate)->format('Y-m-d');
        $invoiceDate = $this->faker->dateTimeThisYear($deliveryDate)->format('Y-m-d');
        $status = Status::all()->shuffle()->first();
    
        $this->actingAs($user)->post(route('invoices.store'), [
            'client' => $client->name,
            'vendor' => $vendor->name,
            'due_date' => $dueDate,
            'delivery_date' => $deliveryDate,
            'invoice_date' => $invoiceDate,
            'status_id' => $status->id,
        ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();
    
        $invoice = Invoice::where('client_id', $client->id)
            ->where('vendor_id', $vendor->id)
            ->where('due_date', $dueDate)
            ->where('delivery_date', $deliveryDate)
            ->where('invoice_date', $invoiceDate)
            ->where('status_id', $status->id)
            ->first();
        $this->assertNotNull($invoice);
    }
    
    public function test_unauthenticated_user_cannot_update_a_invoice()
    {
        factory(Company::class, 10)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoice = factory(Invoice::class)->create();
        $client = factory(Company::class)->create();
        $vendor = factory(Company::class)->create();
        $dueDate = $this->faker->dateTimeThisYear('+3 month')->format('Y-m-d');
        $deliveryDate = $this->faker->dateTimeThisYear($dueDate)->format('Y-m-d');
        $invoiceDate = $this->faker->dateTimeThisYear($deliveryDate)->format('Y-m-d');
        $status = Status::all()->shuffle()->first();
        
        $this->put(route('invoices.update', $invoice), [
            'client' => $client->name,
            'vendor' => $vendor->name,
            'due_date' => $dueDate,
            'delivery_date' => $deliveryDate,
            'invoice_date' => $invoiceDate,
            'status_id' => $status->id,
        ])->assertRedirect(route('login'));
        
        $this->assertDatabaseHas('invoices', compact($invoice));
    }
    
    public function test_a_category_can_be_updated()
    {
        $user = factory(User::class)->create();
        factory(Company::class, 10)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoice = factory(Invoice::class)->create();
        $client = factory(Company::class)->create();
        $vendor = factory(Company::class)->create();
        $dueDate = $this->faker->dateTimeThisYear('+3 month')->format('Y-m-d');
        $deliveryDate = $this->faker->dateTimeThisYear($dueDate)->format('Y-m-d');
        $invoiceDate = $this->faker->dateTimeThisYear($deliveryDate)->format('Y-m-d');
        $status = Status::all()->shuffle()->first();
        
        $this->actingAs($user)->put(route('invoices.update', $invoice), [
            'client' => $client->name,
            'vendor' => $vendor->name,
            'due_date' => $dueDate,
            'delivery_date' => $deliveryDate,
            'invoice_date' => $invoiceDate,
            'status_id' => $status->id,
        ])
            ->assertRedirect();
        
        $updatedInvoice = Invoice::find($invoice->id);
        $this->assertEquals($updatedInvoice->client_id, $client->id);
        $this->assertEquals($updatedInvoice->vendor_id, $vendor->id);
        $this->assertEquals($updatedInvoice->due_date, $dueDate);
        $this->assertEquals($updatedInvoice->due_date, $dueDate);
        $this->assertEquals($updatedInvoice->delivery_date, $deliveryDate);
        $this->assertEquals($updatedInvoice->invoice_date, $invoiceDate);
        $this->assertEquals($updatedInvoice->status_id, $status->id);
    }
    
    public function test_can_be_details_of_a_invoice()
    {
        $user = factory(User::class)->create();
        factory(Company::class, 10)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoice = factory(Invoice::class)->create();
        
        $response =$this->actingAs($user)->get(route('invoices.show', $invoice));
        
        $response->assertSuccessful();
        $response->assertSeeText($invoice->due_date);
        $response->assertSeeText($invoice->delivery_date);
        $response->assertSeeText($invoice->status->name);
        
        $response->assertSeeText($invoice->client->name);
        $response->assertSeeText($invoice->client->nit);
    
        $response->assertSeeText($invoice->vendor->name);
        $response->assertSeeText($invoice->vendor->nit);
    }
    
    
    public function test_confirm_delete_shows_invoices_details()
    {
        $user = factory(User::class)->create();
        factory(Company::class, 10)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoice = factory(Invoice::class)->create();
        
        $response =$this->actingAs($user)->get(route('invoices.confirmDelete', $invoice));
        
        $response->assertSuccessful();
        $response->assertSeeText($invoice->due_date);
        $response->assertSeeText($invoice->delivery_date);
        $response->assertSeeText($invoice->status->name);
    
        $response->assertSeeText($invoice->client->name);
        $response->assertSeeText($invoice->client->nit);
    
        $response->assertSeeText($invoice->vendor->name);
        $response->assertSeeText($invoice->vendor->nit);
    }
    
    public function test_unauthenticated_user_cannot_delete_a_invoice()
    {
        factory(Company::class, 10)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoice = factory(Invoice::class)->create();
        
        $this->delete(route('invoices.destroy', $invoice))
            ->assertRedirect(route('login'));
        
        $this->assertDatabaseHas('invoices', compact($invoice));
    }
    
    public function test_a_invoice_can_be_deleted()
    {
        $user = factory(User::class)->create();
        factory(Company::class, 10)->create();
        $this->seed(\StatusesTableSeeder::class);
        $invoice = factory(Invoice::class)->create();
        
        $this->actingAs($user)->delete(route('invoices.destroy', $invoice))
            ->assertRedirect(route('invoices.index'))
            ->assertSessionHasNoErrors();
        
        $this->assertSoftDeleted($invoice);
    }
}
