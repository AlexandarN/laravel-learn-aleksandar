<?php

use App\Model\Product;
use Illuminate\Database\Seeder;


class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        
        DB::table('products')->insert([
            'name' => "MODAL SCARF",
            'slug' => "modal-scarf",
            'details' => "Modal Scarf Prince of Wales",
            'price' => 145,
            'description' => "Scarf in modal fabric with fantasy Prince of Wales in iron grey and red. The signature Tonino Lamborghini is elegantly embroidered with tone on tone stitching.",
            'active' => 1,
            'deleted' => 0
        ]);
        
        DB::table('products')->insert([
            'name' => "GINEVRA BAG",
            'slug' => "ginevra-bag",
            'details' => "Ginevra bag with two pockets and shoulder strap, Black col.",
            'price' => 980,
            'description' => "Ginevra bag model with two pockets and manufactured with black calf Gredos. Adjustable and removable leather shoulder strap with two hooks and adjustable buckle. The customization, shield-shaped with the famous Miura bull of the Tonino Lamborghini logo, is made of silver coloured rhodium nickel. The closure has two magnets under the flaps. Interior lining in gray alcantara, with inside zip pocket. The calf Gredos leather with hand-grained print and tanning in natural soft hand aniline is a rich and durable material, treated with advanced tanning technique. This leather gets its name from the Sierra de Gredos, a mountain chain in the central Spain, because the skin texture recalls the roughness of the terrain, the elegant and at the same time wild nature of those mountains. This bag is completely handmade in Italy by Italian artisans who have carefully chosen the leather and have been involved in all the manufacturing phases - modeling, cutting, preparation, assembly, finishing and packaging - to emphasize the values of Italian heritage and timeless style of the Tonino Lamborghini brand.",
            'active' => 1,
            'deleted' => 0
        ]);
        
        DB::table('products')->insert([
            'name' => "WALLET DOLCE VITA",
            'slug' => "wallet-dolce-vita",
            'details' => "Wallet DOLCE VITA mod. PATL8775",
            'price' => 235,
            'description' => "Ladies calf-skin French wallet, 6 credit cards slots, DOLCE VITA line",
            'active' => 1,
            'deleted' => 0
        ]);
        
        DB::table('products')->insert([
            'name' => "BRIEFCASE DIAGONAL CUT",
            'slug' => "briefcase-diagonal-cut",
            'details' => "Briefcase diagonal cut, Mud col.",
            'price' => 1190,
            'description' => "Two-compartments briefcase in Adria hammered calf leather in Mud colour, buckle closure. Original cut of the flap with diagonal design inspired by sportscars world. Two customization: a shield with the famous Miura bull of the Tonino Lamborghini logoin relief in silver coloured rhodium nickel, and the Tonino Lamborghini sign in brass with nickel finish. Inside, functional compartments, like a zip pocket, a document pocket, two small pens holder pockets and a business card holder pocket. Leather handle. This bag is completely handmade in Italy by Italian artisans who have carefully chosen the leather and have been involved in all the manufacturing phases - modeling, cutting, preparation, assembly, finishing and packaging - to emphasize the values of Italian heritage and timeless style of the Tonino Lamborghini brand.",
            'active' => 1,
            'deleted' => 0
        ]);
        
    }
}
