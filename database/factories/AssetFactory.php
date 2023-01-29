<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asset>
 */
class AssetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // jpgの生成がエラーになるのでGDでpngから変換
        $file = fake()->image(storage_path('fake'), 640, 480, null, true, true, null, false, 'png');
        $file = imagecreatefrompng($file);
        ob_start();
        imagejpeg($file);
        $image = ob_get_contents();
        ob_end_clean();

        return [
            'content' => $image,
            'type'    => 1,
        ];
    }
}
