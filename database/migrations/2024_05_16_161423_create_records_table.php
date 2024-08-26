<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->integer('operation_id')->nullable()->index();
            $table->integer('user_id')->nullable()->index();
            $table->decimal('amount', 8, 2);
            $table->decimal('user_balance', 8, 2);
            $table->string('operation_response')->nullable();
            $table->timestamp('date');
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('records');
    }
}
