<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use App\Models\User;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // ファイル用意するやり方
        // $fileName = date('YmdHis') . '_test.jpg';
        // $file = UploadedFile::fake()->image($fileName);
        // $file = File::move($file, storage_path('app/public/images/posts/' . $fileName));

        // f
        $file =$this->faker->image();
        $fileName = basename($file);
        File::move($file, storage_path('app/public/images/posts/' . $fileName));

        return [
            'title' => $this->faker->word(),
            'body' => $this->faker->paragraph(),
            'image' => $fileName,
            'user_id' => Arr::random(Arr::pluck(User::all(), 'id')),
        ];
    }
}
