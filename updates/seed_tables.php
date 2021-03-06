<?php namespace October\Test\Updates;

use October\Test\Models\User;
use October\Test\Models\Role;
use October\Test\Models\Post;
use October\Test\Models\Phone;
use October\Test\Models\Person;
use October\Test\Models\Review;
use October\Test\Models\Plugin;
use October\Test\Models\Theme;
use October\Test\Models\Country;
use October\Rain\Database\Updates\Seeder;

class SeedAllTables extends Seeder
{

    public function run()
    {
        /*
         * Test 1: People
         */

        $person = Person::create(['name' => 'Eddie Valiant', 'bio' => 'I have a phone set up already', 'favcolor' => '#5fb6f5']);
        $person->phone = Phone::create(['name' => 'Mobile', 'number' => '(360) 733-2263']);
        $person->alt_phone = Phone::create(['name' => 'Home', 'number' => '(360) 867-3563']);
        $person->save();

        Person::create(['name' => 'Baby Herman', 'bio' => 'I have nothing at all', 'favcolor' => '#990000']);
        Phone::create(['name' => 'Work', 'number' => '(360) 595-2146']);
        Phone::create(['name' => 'Fax', 'number' => '(360) 595-2146']);
        Phone::create(['name' => 'Inactive', 'number' => '(xxx) xxx-xxx', 'is_active' => false]);

        /*
         * Test 2: Posts
         */

        $post = Post::create(['name' => 'First post, yay!', 'content' => 'I have some comments!' ]);
        Post::create(['name' => 'A lonely toon', 'content' => 'I have nothing at all' ]);

        $post->comments()->create([
            'name' => 'deadmau5',
            'content' => 'Hai fwiend, hai fwiend, hai fwiend, hai fwiend, hai fwiend. Brrrrrup bloop. Brrrrrp bloop. Brrrrrp bloop. Brrrrrp bloop.'
        ]);

        $post->comments()->create([
            'name' => 'Hidden comment',
            'content' => 'This comment should be hidden as defined in the relationship.',
            'is_visible' => false
        ]);

        /*
         * Test 3: Users
         */

        User::make(['username' => 'Neo', 'security_code' => '1111'])->forceSave();
        User::make(['username' => 'Morpheus', 'security_code' => '8888'])->forceSave();

        $role = Role::create(['name' => 'Chief Executive Orangutan', 'description' => 'You can call this person CEO for short']);
        Role::create(['name' => 'Chief Friendship Organiser', 'description' => 'You can call this person CFO for short']);
        Role::create(['name' => 'Caring Technical Officer', 'description' => 'You can call this person CTO for short']);

        $user = User::first();
        $user->roles()->add($role, null, ['clearance_level' => 'Top Secret', 'is_executive' => true]);

        /*
         * Test 4: Countries
         */
        Country::create([
            'name' => 'Petoria',
            'code' => 'petoria',
            'language' => 'eh',
            'currency' => 'btc',
            'is_active' => false
        ]);

        /*
         * Test 5: Reviews
         */
        Review::create(['content' => 'Orphan review', 'is_positive' => false]);
        $review = Review::create(['content' => 'Excellent design work', 'is_positive' => true]);

        $theme = Theme::create(['name' => 'Bootstrap', 'code' => 'bootstrap', 'content' => 'A bootstrap theme.']);
        $theme->reviews()->add($review);

        Plugin::create(['name' => 'Angular', 'code' => 'angular', 'content' => 'An AngularJS plugin.']);

    }

}
