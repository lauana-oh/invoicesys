<?php

namespace Tests\Feature;

use App\Company;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompaniesTest extends TestCase
{
    use RefreshDatabase;
    use withFaker;
    
    public function test_unauthenticated_user_cannot_access_to_companies_list()
    {
        $response = $this->get(route('categories.index'));
        
        $response->assertRedirect('login');
    }
    
    public function test_authenticated_user_has_access_to_companies_list()
    {
        $user = factory(User::class)->create();
        
        $this->actingAs($user)->get(route('categories.index'))->assertSuccessful();
        
        $this->assertAuthenticatedAs($user);
    }
    
    public function test_companies_list_contains_a_list_of_companies()
    {
        $user = factory(User::class)->create();
        $companies = factory(Company::class,10)->create();
        
        $response = $this->actingAs($user)->get(route('companies.index'));
        
        $response->assertSuccessful();
        $response->assertViewIs('company.index');
        $response->assertViewHas('companies');
        $response->assertSeeText($companies->shuffle()->first()->name);
    }
    
    public function test_unauthenticated_user_cannot_create_a_company()
    {
        $name = $this->faker->company;
        $nit = $this->faker->unique()->numerify('###########');
        $email = $this->faker->optional(0.7)->companyEmail;
        $phone = $this->faker->optional(0.7)->numerify('#########');
        $address = $this->faker->optional(0.7)->address;
        
        $this->post(route('categories.store'), [
            'name' => $name,
            'nit' => $nit,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
        ])->assertRedirect('login');
        
        $company = Company::where('nit', $nit)->first();
        $this->assertNull($company);
    }
    
    public function test_a_company_can_be_created()
    {
        $user = factory(User::class)->create();
        $name = $this->faker->company;
        $nit = $this->faker->unique()->numerify('###########');
        $email = $this->faker->optional(0.7)->companyEmail;
        $phone = $this->faker->optional(0.7)->numerify('#########');
        $address = $this->faker->optional(0.7)->address;
    
        $this->actingAs($user)->post(route('companies.store'), [
            'name' => $name,
            'nit' => $nit,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
        ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();
        
        $company = Company::where('nit', $nit)->where('name', $name)->where('email', $email)->where('phone', $phone)
            ->where('address', $address)->first();
        $this->assertNotNull($company);
    }
    
    public function test_unauthenticated_user_cannot_update_a_company()
    {
        $company = factory(Company::class)->create();
        $name = $this->faker->company;
        $nit = $this->faker->unique()->numerify('###########');
        $email = $this->faker->optional(0.7)->companyEmail;
        $phone = $this->faker->optional(0.7)->numerify('#########');
        $address = $this->faker->optional(0.7)->address;
        
        $this->put(route('companies.update', $company), [
            'name' => $name,
            'nit' => $nit,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
        ])->assertRedirect(route('login'));
    
        $company = Company::find($company->id);
        $this->assertNotEquals($company->name, $name);
        $this->assertNotEquals($company->nit, $nit);
    }
    
    public function test_a_company_can_be_updated()
    {
        $user = factory(User::class)->create();
        $company = factory(Company::class)->create();
        $name = $this->faker->company;
        $nit = $this->faker->unique()->numerify('###########');
        $email = $this->faker->optional(0.7)->companyEmail;
        $phone = $this->faker->optional(0.7)->numerify('#########');
        $address = $this->faker->optional(0.7)->address;
        
        $this->actingAs($user)->put(route('companies.update', $company), [
            'name' => $name,
            'nit' => $nit,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
        ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();
    
        $company = Company::find($company->id);
        $this->assertEquals($company->name, $name);
        $this->assertEquals($company->nit, $nit);
        $this->assertEquals($company->email, $email);
        $this->assertEquals($company->phone, $phone);
        $this->assertEquals($company->address, $address);
    }
    
    public function test_can_be_details_of_a_company()
    {
        $user = factory(User::class)->create();
        $company = factory(Company::class)->create();
    
        $response =$this->actingAs($user)->get(route('companies.show', $company));
    
        $response->assertSuccessful();
        $response->assertSeeText($company->id);
        $response->assertSeeText($company->name);
        $response->assertSeeText($company->nit);
    }
    
    public function test_confirm_delete_show_company_details()
    {
        $user = factory(User::class)->create();
        $company = factory(Company::class)->create();
        
        $response =$this->actingAs($user)->get(route('companies.confirmDelete', $company));
        
        $response->assertSuccessful();
        $response->assertSeeText($company->id);
        $response->assertSeeText($company->name);
        $response->assertSeeText($company->nit);
    }
    
    public function test_unauthenticated_user_cannot_delete_a_company()
    {
        $company = factory(Company::class)->create();
        
        $this->delete(route('companies.destroy',$company))
            ->assertRedirect('login');
        
        $this->assertNull($company->softDelete);
    }
    
    public function test_a_company_can_be_deleted()
    {
        $user = factory(User::class)->create();
        $company = factory(Company::class)->create();
    
        $this->actingAs($user)->delete(route('companies.destroy', $company))
            ->assertRedirect()
            ->assertSessionHasNoErrors();
    
        $this->assertSoftDeleted($company);
    }
}
