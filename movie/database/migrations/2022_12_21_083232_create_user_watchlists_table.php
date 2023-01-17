<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWatchlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_watchlists', function (Blueprint $table) {
            $table->id('user_watchlist_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('movie_id');
            $table->enum('status', ['Planned', 'Watching', 'Finished']);
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('movie_id')->references('movie_id')->on('movies')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_watchlists');
    }
}
