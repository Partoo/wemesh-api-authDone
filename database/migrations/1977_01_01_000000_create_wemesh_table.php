<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWemeshTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20)->nullable();
            $table->string('mobile', 12);
            $table->string('email')->nullable();
            $table->text('avatar')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->boolean('is_admin')->default(false);
            $table->string('wx_id')->nullable();
            $table->string('description')->nullable();
            $table->string('password');
            $table->string('login_ip')->nullable();
            $table->timestamp('login_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->json('mp');
            $table->unsignedInteger('admin_id');
            $table->boolean('is_auth')->default(false);
            $table->timestamps();
        });

        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20);
            $table->string('alias', 60);
            $table->string('desc', 50)->nullable();
            $table->json('menu');
            $table->decimal('price', 6, 2);
            $table->boolean('activated')->default(true);
            $table->unsignedTinyInteger('period')->default(1)->comments('0:永久 1:每年 2:每月 3:每日');
            $table->timestamps();
        });


        Schema::create('unit_module', function (Blueprint $table) {
            $table->unsignedInteger('module_id');
            $table->unsignedInteger('unit_id');
            $table->dateTime('started_at');
            $table->dateTime('ended_at');
            $table->timestamps();

            $table->foreign('module_id')
                ->references('id')
                ->on('modules')
                ->onDelete('cascade');

            $table->primary(['module_id', 'unit_id']);
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('users');
        Schema::dropIfExists('units');
        Schema::dropIfExists('modules');
        Schema::dropIfExists('unit_module');
        Schema::dropIfExists('password_resets');
        Schema::enableForeignKeyConstraints();
    }
}
