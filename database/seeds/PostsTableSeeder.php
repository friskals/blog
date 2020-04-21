<?php

use Illuminate\Database\Seeder;
use App\Tag;
use App\Post;
use App\Category;
use App\User;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $category = Category::create([
           'name' => 'News'
       ]);

       $category1 = Category::create([
            'name' => 'Design'
        ]);
       
        $category2 = Category::create([
            'name' => 'Partnership'
       ]);
        $author = User::create([
            'name' => 'Elsaday Sianturi',
            'email'=> 'elsa@gmail.com',
            'password' => Hash::make('elsa')
        ]);
        $author1 = User::create([
            'name' => 'Jane Sianturi',
            'email'=> 'jane@gmail.com',
            'password' => Hash::make('elsa')
        ]);
        $author2 = User::create([
            'name' => 'Doe Sianturi',
            'email'=> 'doe@gmail.com',
            'password' => Hash::make('elsa')
        ]);
        $author3 = User::create([
            'name' => 'Meghan Sianturi',
            'email'=> 'meghan@gmail.com',
            'password' => Hash::make('elsa')
        ]);
        /**
         * $author->posts()->create menyimpan id author ke dalam post ini sama dengan
         * memasukkan id user(['user_id => blabla ]) ke dalam Post::create([blabla]) 
         */
        $post = $author->posts()->create([
            'title' => 'We relocated our office to a new designed garage',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
            'category_id'=>$category->id,
            'image' => 'posts/1.jpg',
            
       ]);
       $post1 = $author1->posts()->create([
            'title' => 'Congratulate and thank to Maryam for joining our team',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
            'category_id'=>$category1->id,
            'image' => 'posts/2.jpg',
         ]);

        $post2 = $author2->posts()->create([
            'title' => 'New published books to read by a product designer',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
            'category_id'=>$category2->id,
            'image' => 'posts/3.jpg'
        ]);
        
        $post3 = $author3->posts()->create([
            'title' => 'This is why it is time to ditch dress codes at work',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
            'category_id'=>$category2->id,
            'image' => 'posts/4.jpg'
        ]);

        $tag =Tag::create([
            'name' =>'Record'
        ]);
        $tag1 =Tag::create([
            'name' =>'Progress'
        ]);
        $tag2 =Tag::create([
            'name' =>'Job'
        ]);
        
        $post->tags()->attach([$tag->id, $tag2->id]);
        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag->id, $tag1->id]);
        $post3->tags()->attach([$tag->id, $tag1->id,$tag2->id]);

    }
}
