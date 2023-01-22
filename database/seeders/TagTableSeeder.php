<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            'name' => 'HTML',
            'postID' => 5
        ]);
        Tag::create([
            'name' => 'LINUX',
            'postID' => 2
        ]);
        Tag::create([
            'name' => 'LARAVEL',
            'postID' => 2
        ]);
        Tag::create([
            'name' => 'PHP',
            'postID' => 2
        ]);
        Tag::create([
            'name' => 'JENKINS',
            'postID' => 3
        ]);
        Tag::create([
            'name' => 'DEVOPS',
            'postID' => 5
        ]);
        Tag::create([
            'name' => 'JAVA',
            'postID' => 4
        ]);
        Tag::create([
            'name' => 'AWS',
            'postID' => 7
        ]);
    }
}
