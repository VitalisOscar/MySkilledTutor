<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paper_type_id')->constrained('paper_types');
            $table->foreignId('academic_level_id')->constrained('academic_levels');
            $table->foreignId('subject_id')->constrained('subjects');
            $table->foreignId('user_id')->constrained('users');
            $table->string('pages')->nullable();
            $table->string('title')->nullable();
            $table->text('instructions')->nullable();
            $table->string('formatting')->nullable();
            $table->integer('urgency')->nullable();
            $table->double('price')->nullable();
            $table->string('status')->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
