<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Operation;
use App\Models\Record;
use App\Models\Account;

class RecordsTest extends TestCase
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
    }
    public function test_filter_records_by_operation_type()
    {
        $operationType = 'addition';

        $operation = Operation::factory()->create(['type' => $operationType]);

        $record = Record::factory()->create([
            'operation_id' => $operation->id,
            'user_id' => $this->user->id,
            'amount' => 5.00,
            'user_balance' => 95.00,
            'operation_response' => '10',
            'date' => now(),
        ]);

        $this->actingAs($this->user)
            ->get('/?search=' . $operationType)
            ->assertStatus(200)
            ->assertSee($record->operation_response);

    }
}
