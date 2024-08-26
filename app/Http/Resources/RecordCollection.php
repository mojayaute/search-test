<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RecordCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($record) {
            return [
                'id' => $record->id,
                'type' => $record->operation->type, 
                'user_id' => $record->user_id,
                'amount' => $record->amount,
                'user_balance' => $record->user_balance,
                'operation_response' => $record->operation_response,
                'created_at' => $record->created_at,
            ];
        })->all();
    }
}
