<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plants;
class PlantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plants::create([
            'name' => 'jasmin',
            'description' => 'Jasmine is a genus of perennial climbing flowering plants in the family Oleaceae. Native to tropical and warm temperate regions of Eurasia, Oceania, and Australia, these plants are most diverse in southern and southeast Asia.',
            'price' => 15,
            'image' => '/public/images/jasemin.jpg',
            'category_id' =>6,
        ]);
        Plants::create([
            'name' => 'Cedar Tree',
            'description' => 'Cedrus, common English name cedar, is a genus of coniferous trees in the plant family Pinaceae (subfamily Abietoideae). They are native to the mountains of the western Himalayas and the Mediterranean region, occurring at altitudes of 1,500 - 3,200 m in the Himalayas and 1,000 - 2,200 m in the Mediterranean.',
            'price' => 20,
            'image' => '/public/images/cedar.jpg',
            'category_id' =>1,
        ]);
        Plants::create([
            'name' => 'Tulip',
            'description' => 'Tulip, (genus Tulipa), genus of about 100 species of bulbous herbs in the lily family (Liliaceae), native to Central Asia and Turkey. Tulips are among the most popular of all garden flowers, and numerous cultivars and varieties have been developed.',
            'price' => 25,
            'image' => '/public/images/tulip.jpg',
            'category_id' =>2,
        ]);
        Plants::create([
            'name' => 'Button Mushrooms',
            'description' => 'Button mushrooms are one of the most popular types of mushrooms to eat. They are also called baby mushrooms or white mushrooms. Button mushrooms are by far the most common type of mushroom that you arere almost guaranteed to find in grocery stores.',
            'price' => 13,
            'image' => '/public/images/Mushrooms.jpg',
            'category_id' =>3,
        ]);
        Plants::create([
            'name' => 'Tomatoes',
            'description' => 'What is the vegetable plant? More specifically, a vegetable may be defined as "any plant, part of which is used for food", a secondary meaning then being "the edible part of such a plant". A more precise definition is "any plant part consumed for food that is not a fruit or seed, but including mature fruits that are eaten as part of a main meal',
            'price' => 17,
            'image' => '/public/images/vegetbale.jpg',
            'category_id' =>4,
        ]);
        Plants::create([
            'name' => 'Lucky Bamboo',
            'description' => 'A popular gift plant, lucky bamboo can be a long-lived accent to your home or office decor, given the right care. Made popular because the bamboo-like stems are often twisted into fun shapes like swirls, hearts, and weaves, it is a living work of art.',
            'price' => 25,
            'image' => '/public/images/lucky.jpg',
            'category_id' =>5,
        ]);
    }
}
