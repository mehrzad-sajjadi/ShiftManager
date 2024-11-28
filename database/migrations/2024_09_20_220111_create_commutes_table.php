<?php

use App\Enums\Day;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commutes', function (Blueprint $table) {
            $table->id();
            $table->time("enter");
            $table->time("exit");

            $table->unsignedBigInteger("employee_id");
            $table->foreign("employee_id")->references("id")->on("employees")->onDelete("cascade");

            $table->enum("day",array_column(Day::cases(),"value"));


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commutes');
    }
};
