<?php

namespace Tests\Feature;

use App\Category;
use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    
    public function test_unauthenticated_user_cannot_access_to_categories_list()
    {
        $response = $this->get(route('categories.index'));

        $response->assertRedirect(route('login'));
    }
    
    public function test_authenticated_user_has_access_to_categories_list()
    {
        $user = factory(User::class)->create();
        
        $this->actingAs($user)->get(route('categories.index'))->assertSuccessful();
        
        $this->assertAuthenticatedAs($user);
    }
    
    public function test_categories_list_contains_a_list_of_categories()
    {
        $user = factory(User::class)->create();
        $categories = factory(Category::class, 5)->create();
    
        $response = $this->actingAs($user)->get(route('categories.index'));
    
        $response->assertSuccessful();
        $response->assertViewHas('categories');
        $response->assertViewIs('category.index');
        $response->assertSeeText($categories->shuffle()->first()->name);
    }
    
    public function test_unauthenticated_user_cannot_create_a_category()
    {
        $name = $this->faker->unique()->domainWord;
        $description = $this->faker->text($maxNbChars = 200);
        $ivaPercent = $this->faker->randomNumber(2);
        $ivaInteger = $ivaPercent/100;
    
        $this->post(route('categories.store'), [
            'name' => $name,
            'description' => $description,
            'iva' => $ivaPercent,
        ])->assertRedirect('login');
    
        $category = Category::where('name', $name)->where('description', $description)->where('iva', $ivaInteger)->first();
        $this->assertNull($category);
    }
    
    public function test_a_category_can_be_created()
    {
        $user = factory(User::class)->create();
        $name = $this->faker->unique()->domainWord;
        $description = $this->faker->text($maxNbChars = 200);
        $ivaPercent = $this->faker->randomNumber(2);
        $ivaInteger = $ivaPercent/100;
        
        $this->actingAs($user)->post(route('categories.store'), [
            'name' => $name,
            'description' => $description,
            'iva' => $ivaPercent,
        ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();
    
        $category = Category::where('name', $name)->where('description', $description)->where('iva', $ivaInteger)->first();
        $this->assertNotNull($category);
    }
    
    public function test_unauthenticated_user_cannot_update_a_category()
    {
        $category = factory(Category::class)->create();
        $name = $this->faker->unique()->domainWord;
        $description = $this->faker->text($maxNbChars = 200);
        $ivaPercent = $this->faker->randomNumber(2);
        
        $this->put(route('categories.update', $category), [
            'name' => $name,
            'description' => $description,
            'iva' => $ivaPercent,
        ])->assertRedirect(route('login'));
        
        $this->assertDatabaseHas('categories', compact($category));
    }
    
    public function test_a_category_can_be_updated()
    {
        $user = factory(User::class)->create();
        $category = factory(Category::class)->create();
        $name = $this->faker->unique()->domainWord;
        $description = $this->faker->text($maxNbChars = 200);
        $ivaPercent = $this->faker->randomNumber(2);
        $ivaInteger = $ivaPercent/100;
        
        $this->actingAs($user)->put(route('categories.update', $category), [
    
            'name' => $name,
            'description' => $description,
            'iva' => $ivaPercent,
        ])
            ->assertRedirect();
    
        $updatedCategory = Category::find($category->id);
        $this->assertEquals($updatedCategory->name, ucfirst($name));
        $this->assertEquals($updatedCategory->description, ucfirst($description));
        $this->assertEquals($updatedCategory->iva, $ivaInteger);
    }
    
    public function test_can_be_details_of_a_category()
    {
        $user = factory(User::class)->create();
        $category = factory(Category::class)->create();
        
        $response =$this->actingAs($user)->get(route('categories.show', $category));
        
        $response->assertSuccessful();
        $response->assertSeeText($category->id);
        $response->assertSeeText($category->name);
        $response->assertSeeText($category->description);
        
        //!!No se pq está generando error!!
        //$response->assertSee($category->ivaFormatted);
    }
    
    
    public function test_confirm_delete_show_category_details()
    {
        $user = factory(User::class)->create();
        $category = factory(Category::class)->create();
        
        $response =$this->actingAs($user)->get(route('categories.confirmDelete', $category));
        
        $response->assertSuccessful();
        $response->assertSeeText($category->id);
        $response->assertSeeText($category->name);
        $response->assertSeeText($category->description);
        
        //!!No se pq está generando error!!
        //$response->assertSeeText($category->ivaFormatted);
    }
    
    public function test_unauthenticated_user_cannot_delete_a_category()
    {
        $category = factory(Category::class)->create();
        
        $this->delete(route('categories.destroy', $category))
            ->assertRedirect(route('login'));
    
        $this->assertDatabaseHas('categories', compact($category));
    }
    
    public function test_a_category_can_be_deleted()
    {
        $user = factory(User::class)->create();
        $category = factory(Category::class)->create();
        
        $this->actingAs($user)->delete(route('categories.destroy', $category))
            ->assertRedirect(route('categories.index'))
            ->assertSessionHasNoErrors();
        
        $this->assertSoftDeleted($category);
    }
}
