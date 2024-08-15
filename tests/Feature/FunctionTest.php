<?php

namespace Tests\Feature;

use App\Enums\YesNo;
use App\Models\FunctionModel;
use App\Models\UserManagement\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class FunctionTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private FunctionModel $function;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = $this->getUser();
    }

    private function getUser(): User
    {
        return
            User::create([
                "login" => "test",
                "password" => "test",
            ]);
    }


    public function test_store_function(): void
    {
        $function = [
            "name" => "Fonction J",
            "is_for_manager" => 1,
            "description" => "Description de la Fonction J.",
            "min_requis" => "Exigences minimales pour la Fonction J."
        ];
        $response = $this->actingAs($this->user)->post('/functions/store', $function);

        $response->assertStatus(302);
        $last_function = FunctionModel::latest()->first();
        $response->assertRedirect(route('functions.show', $last_function->id));


        $this->assertDatabaseHas('functions', $function);
        $this->assertEquals($last_function['name'], $function['name']);
        $this->assertEquals($last_function['description'], $function['description']);
    }

    public function test_store_function_throws_validation_errors()
    {
        $response = $this->actingAs($this->user)->post('/functions/store', [
            "name" => "",
            "is_for_manager" => null,
            "description" => "",
            "min_requis" => 1
        ]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(["name", "is_for_manager", "min_requis"]);
    }

    public function test_update_function()
    {
        $array = [
            'name' => 'hello',
            'is_for_manager' => YesNo::NO->value,
            'description' => 'Description for hello',
            'min_requis' => 'Minimum requirements for hello',
        ];
        $function = FunctionModel::create([
            'name' => 'FunctionToUpdate',
            'is_for_manager' => YesNo::YES->value,
            'description' => 'Description for FunctionToUpdate',
            'min_requis' => 'Minimum requirements for FunctionToUpdate',
        ]);
        $response = $this->actingAs($this->user)->post("/functions/{$function->id}/update", $array);
        // dd($response);
        $response->assertStatus(302);
        $response->assertRedirect(route('functions.show', $function->id));
        $this->assertNotNull(session('alert'));
        $this->assertEquals(__("functions.updated_notification"), session('alert')['title']);
        $last_function = FunctionModel::latest()->first();

        $this->assertEquals($array['name'], $last_function['name']);
        $this->assertEquals($array['is_for_manager'], $last_function['is_for_manager']);
        $this->assertEquals($array['description'], $last_function['description']);
        $this->assertEquals($array['min_requis'], $last_function['min_requis']);
    }

    public function test_update_function_throws_validation_errors()
    {
        $function = FunctionModel::create([
            'name' => 'FunctionToUpdate',
            'is_for_manager' => YesNo::YES->value,
            'description' => 'Description for FunctionToUpdate',
            'min_requis' => 'Minimum requirements for FunctionToUpdate',
        ]);
        $response = $this->actingAs($this->user)->post("/functions/{$function->id}/update", [
            "name" => "",
            "is_for_manager" => null,
            "description" => "",
            "min_requis" => 1
        ]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(["name", "is_for_manager", "min_requis"]);
    }

    public function test_delete_function()
    {
        $array = [
            'name' => 'FunctionToUpdate',
            'is_for_manager' => YesNo::YES->value,
            'description' => 'Description for FunctionToUpdate',
            'min_requis' => 'Minimum requirements for FunctionToUpdate',
        ];
        $function = FunctionModel::create($array);
        $response = $this->actingAs($this->user)->get("/functions/{$function->id}/delete");
        $response->assertStatus(302);
        $response->assertRedirect(route('functions.index'));
        $this->assertDatabaseMissing('functions', $array);

        $this->assertNotNull(session('alert'));
        $this->assertEquals(__("functions.deleted_notification"), session('alert')['title']);
    }
    public function test_destroy_function()
    {
        $functions = FunctionModel::factory()->count(4)->create();
        $this->actingAs($this->user)->post(route('functions.destroyGroup'), [
            'ids' => $functions->pluck('id')->toArray(),
        ]);

        $this->assertNotNull(session('alert'));
        $this->assertEquals(__('functions.selected_deleted_notification'), session('alert')['title']);
        $this->assertDatabaseCount('functions', 0);
    }
}