<?php

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
        Schema::create('web_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key', 100)->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Seed default values
        \Illuminate\Support\Facades\DB::table('web_settings')->insert([
            ['key' => 'logo_path',     'value' => null, 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'popup_image',   'value' => null, 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'popup_link',    'value' => null, 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'popup_active',  'value' => '0',  'created_at' => now(), 'updated_at' => now()],
            ['key' => 'theme_color',   'value' => '#dc2626', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_name',     'value' => 'Info Lantas Mojokerto', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_description', 'value' => 'Portal Berita Terkini Wilayah Mojokerto (Kabupaten & Kota)', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'contact_email', 'value' => 'redaksi@infolantasmojokerto.com', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'contact_phone', 'value' => '+62-321-123456', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'social_facebook',  'value' => 'https://www.facebook.com/InfoLantasMojokerto', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'social_instagram', 'value' => 'https://www.instagram.com/infolantasmojokerto', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'social_youtube',   'value' => 'https://www.youtube.com/@InfoLantasMojokerto', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'social_tiktok',    'value' => 'https://www.tiktok.com/@info.lantas.mojokerto', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_settings');
    }
};
