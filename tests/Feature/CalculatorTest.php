<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Operation;
use App\Models\Record;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;

class CalculatorTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $account = Account::create(['name' => 'Calculator']);

        $this->user = User::factory()->make([
            'account_id' => $account->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'owner' => true,
        ]);
        Auth::login($this->user);
    }
    
    public function test_create_view()
    {
        $response = $this->actingAs($this->user)->get('/calculator');
        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page->component('Calculator/Create'));
    }

    public function test_store_operation_success()
    {
        $operation = Operation::factory()->create(['type' => 'addition', 'cost' => 10]);

        $response = $this->actingAs($this->user)->post('/calculator', [
            'operation' => $operation->id,
            'value1' => 5,
            'value2' => 3,
        ]);

        $this->assertDatabaseHas('records', [
            'operation_id' => $operation->id,
            'user_id' => $this->user->id,
            'operation_response' => '8',
            'date' => now(),
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
    }

    public function test_store_operation_insufficient_balance()
    {
        $operation = Operation::factory()->create(['type' => 'addition', 'cost' => 9999]);

        $response = $this->actingAs($this->user)->post('/calculator', [
            'operation' => $operation->id,
            'value1' => 5,
            'value2' => 3,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Insufficient balance.');
    }
}
