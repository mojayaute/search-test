<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculatorStoreRequest;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Models\Operation;
use App\Models\Record;
use Illuminate\Support\Carbon;

class CalculatorController extends Controller
{
    public function create()
    {
        return Inertia::render('Calculator/Create', [
            'operations' => Operation::all()
        ]);
    }

    public function store(CalculatorStoreRequest $request)
    {
            $request->validated();
            $params = Request::all();
            $operationObj = Operation::where('id', $params['operation'])->firstOrFail();
            $params['operation'] = $operationObj->type;
            $operationResult = $this->calculateOperation($params);
            $newBalance = Auth::user()->user_balance - $operationObj->cost;

            if ($newBalance < 0) {
                return redirect()->back()->with('error', 'Insufficient balance.');
            }

            Record::create([
                'operation_id' => $operationObj->id,
                'user_id' =>  Auth::user()->id,
                'amount' => $operationObj->cost,
                'user_balance' => $newBalance,
                'operation_response' => $operationResult,
                'date' => Carbon::now()
                
            ]);

            return redirect()->back()->with('success', 'Operation created successfully. Result for this operation: ' . $operationResult);
        
    }

    private function calculateOperation($params)
    {
    $operation = $params['operation'];
    $value1 = $params['value1'] ?? 1;
    $value2 = $params['value2'] ?? 1;

    $operations = [
        'addition' => function ($a, $b) { return $a + $b; },
        'subtraction' => function ($a, $b) { return $a - $b; },
        'multiplication' => function ($a, $b) { return $a * $b; },
        'division' => function ($a, $b) { return $a / $b; },
        'square_root' => function ($a) { return sqrt($a); },
        'random_string' => function () { return $this->generateRandomString(); },
    ];

    if (array_key_exists($operation, $operations)) {
        return $operations[$operation]($value1, $value2 ?? null);
    } else {
        return 'Invalid operation';
    }
}

    private function generateRandomString()
    {
        $url = 'https://www.random.org/strings/?num=1&len=2&digits=on&unique=on&format=plain&rnd=new';
        $options = [
            'http' => [
                'method' => 'GET',
                'header' => 'Content-type: application/x-www-form-urlencoded',
            ],
        ];
        $context = stream_context_create($options);
        $response = fopen($url, 'r', false, $context);
        $responseContent = stream_get_contents($response);
        fclose($response);
        return json_decode($responseContent);
    }
}
