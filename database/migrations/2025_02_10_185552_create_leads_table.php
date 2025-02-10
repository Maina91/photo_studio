<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('client_id')->nullable();
            $table->string('lead_name');
            $table->enum('job_type', ['Photography', 'Videography', 'Event Planning']); // Example categories
            $table->dateTime('scheduled_at')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['new', 'follow-up', 'quoted', 'won', 'lost'])->default('new');
            $table->decimal('estimated_budget', 10, 2)->nullable();
            $table->string('source')->nullable(); // How the lead was found (Referral, Social Media, Website, etc.)
            $table->boolean('signed_contract')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('leads');
    }
}
