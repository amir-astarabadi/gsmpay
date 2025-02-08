<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Post;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_views', function (Blueprint $table) {
            $table->id();
            $table->ipAddress('ip_address')->index();
            $table->foreignIdFor(Post::class)->constrained();
            $table->foreignIdFor(User::class)->nullable()->constrained();
            $table->timestamp('viewed_at');

            $table->unique(['post_id', 'ip_address'], 'post_view_uniqe_base_ip');
            $table->unique(['post_id','user_id'], 'post_view_uniqe_base_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_views');
    }
};
