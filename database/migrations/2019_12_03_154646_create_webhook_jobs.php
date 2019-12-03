<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebhookJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webhook_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->unique();
            $table->bigInteger('user_id')->index();
            $table->bigInteger('webhook_id')->index();
            $table->bigInteger('webhook_trigger_id')->index();
            $table->nullableMorphs('payload');
            $table->boolean('complete')->default(false)->index();
            $table->boolean('success')->default(false)->index();
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
        Schema::dropIfExists('webhook_jobs');
    }
}
