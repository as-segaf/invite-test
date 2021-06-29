<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('nick_name');
            $table->string('wa_number');
            $table->string('organization_type');
            $table->string('organization_name');
            $table->string('invite_vos_as');
            $table->string('event_type');
            $table->timestamp('event_date');
            $table->timestamp('event_date2')->nullable();
            $table->string('event_duration')->nullable();
            $table->string('event_place');
            $table->text('event_detail');
            $table->string('participant');
            $table->text('additional_note')->nullable();
            $table->string('status');
            $table->string('plakat_status')->default('belum');
            $table->foreignId('sent_by')->constrained('users');
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
        Schema::dropIfExists('invitations');
    }
}
