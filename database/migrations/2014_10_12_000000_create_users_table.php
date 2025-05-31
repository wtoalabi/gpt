<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('username');
            $table->integer('status')->default(0);
            $table->string('phone')->nullable();
            $table->string('exam');
            $table->string('avatar')->nullable();
            $table->string('subjects');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
    /*
     *
     *
     INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Users\\User', 3, 'postman_', '200be3ff85206ad5c2f4d498c9201178c96f7343e4a148feccdd8a4adcd713ea', '[\"*\"]', '2023-01-27 05:36:04', NULL, '2023-01-26 20:49:10', '2023-01-27 05:36:04'),
(2, 'App\\Models\\Users\\User', 1, 'android_ifN2wuln5tWZXMs_1', 'c76d9d5afd8e892fc073fbccb4ed84dde57f93c527ea15e0f20b00f06d5c071d', '[\"*\"]', '2023-01-27 05:58:52', NULL, '2023-01-27 05:58:46', '2023-01-27 05:58:52');

     * 3: 200be3ff85206ad5c2f4d498c9201178c96f7343e4a148feccdd8a4adcd713ea
     * */
};
