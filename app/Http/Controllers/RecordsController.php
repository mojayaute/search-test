<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecordCollection;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Models\User;

class RecordsController extends Controller
{
    public function index(Request $request)
    {   
        $user = Auth::user();
        return Inertia::render('Records/Index', [
            'filters' => Request::all('search'),
            'records' => new RecordCollection(
                $user->records()
            ->orderBy('date', 'DESC')
            ->filter(Request::only('search'))
            ->paginate(10)
            ->appends(Request::all()),
            ),
            'balance' => $user->user_balance,
        ]);
    }
}
