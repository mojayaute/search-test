<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = ['operation_id', 'user_id', 'amount', 'user_balance', 'operation_response', 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function operation()
    {
        return $this->belongsTo(Operation::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->whereHas('operation', function ($query) use ($search) {
                $query->where('type', 'like', '%'.$search.'%');
            });
        });
    }
}
