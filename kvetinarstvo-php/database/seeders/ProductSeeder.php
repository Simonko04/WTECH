<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([

            // ID = 1
            ['name' => 'Biela ľalia', 'slug' => 'biela-lalia', 'short_description' => 'Symbol pokoja a tichej spomienky.', 'full_description' => 'Biela ľalia je tradičným kvetom vyjadrovania sústrasti a úcty. Jej čistá biela farba symbolizuje pokoj, nevinnosť a večnú pamiatku. Vhodná na pohrebné vence, smútočné kytice aj ako tichý prejav spoluúčasti.', 'price' => 10.99,
            'quantity_available' => 7, 'category_id' => 3, 'color_id' => 1, 'created_at' => now(), 'updated_at' => now()],

            // ID = 2
            ['name' => 'Ružová ruža', 'slug' => 'ruzova-ruza', 'short_description' => 'Jemná a romantická – ideálna na vyjadrenie náklonnosti.', 'full_description' => 'Ružová ruža je symbolom jemnej lásky, vďačnosti a obdivu. Na rozdiel od červenej ruže vyjadruje náklonnosť a priateľskú lásku. Vhodná ako darček k narodeninám, výročiu alebo len tak pre potešenie blízkych. Každá ruža je čerstvá a starostlivo zabalená.',
            'price' => 8.24, 'quantity_available' => 6, 'category_id' => 2, 'color_id' => 2, 'created_at' => now(), 'updated_at' => now()],

            // ID = 3
            ['name' => 'Červená ruža', 'slug' => 'cervena-ruza', 'short_description' => 'Klasický symbol lásky a vášne.', 'full_description' => 'Čerstvá červená ruža pestovaná s láskou. Ideálna voľba na Valentína, výročie alebo narodeniny. Každá ruža je starostlivo vybraná, aby zaručila čerstvosť a krásu. Balená v elegantnom darčekovom papieri.',
            'price' => 12.50, 'quantity_available' => 19, 'category_id' => 2, 'color_id' => 3, 'created_at' => now(), 'updated_at' => now()],

            // ID = 4
            ['name' => 'Biela pivónia', 'slug' => 'biela-pivonia', 'short_description' => 'Elegantná a romantická – obľúbená voľba na svadby.', 'full_description' => 'Biela pivónia je symbolom prosperity, šťastia a lásky. Jej bohaté, plné kvety sú obľúbenou voľbou na svadobné kytice a dekorácie. Dostupná v sezóne jaro–leto, každá pivónia je ručne vyberaná pre maximálnu krásu.',
            'price' => 5.51, 'quantity_available' => 120, 'category_id' => 1, 'color_id' => 1, 'created_at' => now(), 'updated_at' => now()],

            // ID = 5
            ['name' => 'Orchidea', 'slug' => 'orchidea', 'short_description' => 'Luxusný darček, ktorý dlho vydrží.', 'full_description' => 'Orchidea je elegantná izbová rastlina, ktorá dokáže kvitnúť niekoľko týždňov. Vďaka svojej dlhej trvanlivosti a reprezentatívnemu vzhľadu je ideálnou voľbou ako firemný darček alebo dekorácia kancelárie. Dostupná v rôznych farbách.',
            'price' => 25.55, 'quantity_available' => 4, 'category_id' => 4, 'color_id' => 4, 'created_at' => now(), 'updated_at' => now()],

        ]);

        DB::table('product_images')->insert([

            // Produkt 1
            ['product_id' => 1, 'path' => 'img/biela_lalia-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 1, 'path' => 'img/biela_lalia-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 1, 'path' => 'img/biela_lalia-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 1, 'path' => 'img/biela_lalia-4.jpg', 'created_at' => now(), 'updated_at' => now()],

            // Produkt 2
            ['product_id' => 2, 'path' => 'img/ruzova_ruza-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 2, 'path' => 'img/ruzova_ruza-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 2, 'path' => 'img/ruzova_ruza-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 2, 'path' => 'img/ruzova_ruza-4.jpg', 'created_at' => now(), 'updated_at' => now()],

            // Produkt 3
            ['product_id' => 3, 'path' => 'img/cervena_ruza-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 3, 'path' => 'img/cervena_ruza-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 3, 'path' => 'img/cervena_ruza-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 3, 'path' => 'img/cervena_ruza-4.jpg', 'created_at' => now(), 'updated_at' => now()],

            // Produkt 4
            ['product_id' => 4, 'path' => 'img/biela_pivonia-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 4, 'path' => 'img/biela_pivonia-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 4, 'path' => 'img/biela_pivonia-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 4, 'path' => 'img/biela_pivonia-4.jpg', 'created_at' => now(), 'updated_at' => now()],

            // Produkt 5
            ['product_id' => 5, 'path' => 'img/fialova_orchidea-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 5, 'path' => 'img/fialova_orchidea-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 5, 'path' => 'img/fialova_orchidea-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 5, 'path' => 'img/fialova_orchidea-4.jpg', 'created_at' => now(), 'updated_at' => now()],

        ]);
    }
}
