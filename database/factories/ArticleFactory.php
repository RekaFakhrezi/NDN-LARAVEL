<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::all()->random()->id ?? \App\Models\User::factory(),
            'category_id' => \App\Models\Category::all()->random()->id ?? \App\Models\Category::factory(),
            'title' => $this->faker->sentence(rand(6, 10)),
            'content' => collect($this->faker->paragraphs(rand(5, 10)))->map(fn($p) => "<p>$p</p>")->implode(''),
            'status' => $this->faker->randomElement(['approved', 'approved', 'approved', 'pending', 'unpublished']),
            'view_count' => rand(0, 5000),
            'featured' => $this->faker->boolean(10), // 10% featured
            'spotlight' => $this->faker->boolean(15), // 15% spotlight
            'image' => 'https://images.unsplash.com/photo-' . $this->faker->randomElement([
                '1504711434969-e33886168f5c',
                '1451187580459-43490279c0fa',
                '1504674900247-0877df9cc836',
                '1489599849927-2ee91cede3ba',
                '1461896836934-ffe607ba8211',
                '1518770660439-4636190af475',
                '1522071820081-009f0129c71c',
                '1538481199705-c710c4e965fc',
                '1540910419892-4a36d2c3266c',
                '1563986768609-322da13575f3',
                '1500485035595-cbe6f645feb1',
                '1427504494785-3a9ca7044f45',
                '1455390582262-044cdead277a',
                '1533105079780-92b9be482077',
                '1590283603385-17ffb3a7f29f',
                '1506126613408-eca07ce68773',
                '1511556532299-8f662fc26c06',
                '1544620347-c4fd4a3d5957',
                '1582213782179-e0d53f98f2ca',
                '1532094349884-543bc11b234d',
                '1505751172876-fa1923c5c528',
                '1523050854058-8df90110c9f1',
                '1517245386807-bb43f82c33c4',
                '1473341304170-971dccb5ac1e'
            ]) . '?auto=format&fit=crop&w=800&q=80',
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }

    public function readingTime(): Attribute
    {
        return Attribute::make(
            get: function () {
                // 1. Bersihkan konten dari tag HTML jika ada
                $cleanContent = strip_tags($this->content);

                // 2. Hitung total kata di dalam konten
                $wordCount = str_word_count($cleanContent);

                // 3. Hitung estimasi menit (asumsi rata-rata 200 kata per menit)
                $minutes = ceil($wordCount / 200);

                // 4. Kembalikan angka menitnya
                return $minutes;
            }
        );
    }
}
