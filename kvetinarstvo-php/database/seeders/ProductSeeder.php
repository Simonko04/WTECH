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
            ['name' => 'Fialová levanduľa', 'slug' => 'fialova-levandula', 'short_description' => 'Upokojujúca vôňa a jemný vzhľad.', 'full_description' => 'Voňavá fialová levanduľa je ideálna na voňavé darčeky alebo ako doplnok do domácnosti.',
            'price' => 6.30, 'quantity_available' => 85, 'category_id' => 4, 'color_id' => 4, 'created_at' => now(), 'updated_at' => now()],

            // ID = 6
            ['name' => 'Biela ruža', 'slug' => 'biela-ruza', 'short_description' => 'Čistota a nevinnosť v každom kvete.', 'full_description' => 'Elegantná biela ruža je symbolom čistoty, úcty a nových začiatkov. Perfektná na svadobné kytice, dekorácie alebo ako prejav úcty. Každá ruža je čerstvá a starostlivo zabalená.',
            'price' => 9.99, 'quantity_available' => 45, 'category_id' => 1, 'color_id' => 1, 'created_at' => now(), 'updated_at' => now()],

            // ID = 7
            ['name' => 'Ružová pivónia', 'slug' => 'ruzova-pivonia', 'short_description' => 'Jemná krása pre romantické chvíle.', 'full_description' => 'Nádherná ružová pivónia s bohatými kvetmi je ideálna na svadby, oslavy a romantické darčeky. Symbolizuje prosperitu a šťastie.',
            'price' => 6.75, 'quantity_available' => 68, 'category_id' => 1, 'color_id' => 2, 'created_at' => now(), 'updated_at' => now()],

            // ID = 8
            ['name' => 'Červená gerbera', 'slug' => 'cervena-gerbera', 'short_description' => 'Veselá a energická kvetina.', 'full_description' => 'Jasná červená gerbera prináša radosť a pozitívnu energiu. Výborná voľba na narodeniny, oslavy alebo ako farebný doplnok do kytice.',
            'price' => 4.99, 'quantity_available' => 92, 'category_id' => 2, 'color_id' => 3, 'created_at' => now(), 'updated_at' => now()],

            // ID = 9
            ['name' => 'Fialová orchidea', 'slug' => 'fialova-orchidea', 'short_description' => 'Luxus a elegancia v jednom.', 'full_description' => 'Exkluzívna fialová orchidea je skvelým firemným darčekom alebo elegantnou dekoráciou do kancelárie. Dlho kvitne a pôsobí veľmi reprezentatívne.',
            'price' => 25.55, 'quantity_available' => 12, 'category_id' => 4, 'color_id' => 4, 'created_at' => now(), 'updated_at' => now()],

            // ID = 10
            ['name' => 'Biela chryzantéma', 'slug' => 'biela-chryzantema', 'short_description' => 'Klasika smútočnej kytice.', 'full_description' => 'Biela chryzantéma je tradičným symbolom úcty a spomienky. Najčastejšie používaná v smútočných vencoch a kyticiach.',
            'price' => 7.49, 'quantity_available' => 55, 'category_id' => 3, 'color_id' => 1, 'created_at' => now(), 'updated_at' => now()],

            // ID = 11
            ['name' => 'Ružový tulipán', 'slug' => 'ruzovy-tulipan', 'short_description' => 'Jarná romantika v plnom kvete.', 'full_description' => 'Jemné ružové tulipány vyjadrujú náklonnosť a šťastie. Ideálne na narodeniny, výročie alebo ako jarný darček.',
            'price' => 5.99, 'quantity_available' => 120, 'category_id' => 2, 'color_id' => 2, 'created_at' => now(), 'updated_at' => now()],

            // ID = 12
            ['name' => 'Červený karafiát', 'slug' => 'cerveny-karafiat', 'short_description' => 'Vášeň a obdiv v klasickom štýle.', 'full_description' => 'Intenzívne červené karafiáty sú symbolom lásky a obdivu. Skvelé na Valentína, výročia aj ako doplnok do kytice.',
            'price' => 4.25, 'quantity_available' => 78, 'category_id' => 3, 'color_id' => 3, 'created_at' => now(), 'updated_at' => now()],

            // ID = 13
            ['name' => 'Fialová ľalia', 'slug' => 'fialova-lalia', 'short_description' => 'Luxusný a exotický vzhľad.', 'full_description' => 'Fialová ľalia prináša do interiéru eleganciu a sofistikovanosť. Výborný ako firemný darček alebo dekorácia.',
            'price' => 22.50, 'quantity_available' => 18, 'category_id' => 4, 'color_id' => 4, 'created_at' => now(), 'updated_at' => now()],

            // ID = 14
            ['name' => 'Biela hortenzia', 'slug' => 'biela-hortenzia', 'short_description' => 'Objem a čistota pre svadby.', 'full_description' => 'Veľké biele hlávky hortenzie sú obľúbené pri svadobných dekoráciách. Symbolizujú čistotu a hojnosť.',
            'price' => 11.90, 'quantity_available' => 34, 'category_id' => 1, 'color_id' => 1, 'created_at' => now(), 'updated_at' => now()],

            // ID = 15
            ['name' => 'Ružová levanduľa', 'slug' => 'ruzova-levandula', 'short_description' => 'Upokojujúca vôňa a jemný vzhľad.', 'full_description' => 'Voňavá ružová levanduľa je ideálna na romantické darčeky, narodeniny alebo ako doplnok do domácnosti.',
            'price' => 6.30, 'quantity_available' => 85, 'category_id' => 2, 'color_id' => 2, 'created_at' => now(), 'updated_at' => now()],

            // ID = 16
            ['name' => 'Červený amaryllis', 'slug' => 'cerveny-amaryllis', 'short_description' => 'Dramatický a veľkolepý kvet.', 'full_description' => 'Impozantný červený amaryllis je skvelou voľbou na výročia a špeciálne príležitosti. Púta pozornosť svojou veľkosťou.',
            'price' => 14.75, 'quantity_available' => 22, 'category_id' => 2, 'color_id' => 3, 'created_at' => now(), 'updated_at' => now()],

            // ID = 17
            ['name' => 'Fialová frézia', 'slug' => 'fialova-frezia', 'short_description' => 'Sladká vôňa a elegantný vzhľad.', 'full_description' => 'Fialová frézia je známa svojou príjemnou vôňou. Perfektná ako súčasť romantickej kytice alebo firemného darčeka.', 
            'price' => 8.99, 'quantity_available' => 47, 'category_id' => 4, 'color_id' => 4, 'created_at' => now(), 'updated_at' => now()],

            // ID = 18
            ['name' => 'Biela eustoma', 'slug' => 'biela-eustoma', 'short_description' => 'Jemná a vzdušná krása.', 'full_description' => 'Biela eustoma (lisianthus) je veľmi obľúbená pri svadobných kyticiach vďaka svojej jemnej elegancii.',
            'price' => 7.80, 'quantity_available' => 63, 'category_id' => 1, 'color_id' => 1, 'created_at' => now(), 'updated_at' => now()],

            // ID = 19
            ['name' => 'Ružový hyacint', 'slug' => 'ruzovy-hyacint', 'short_description' => 'Intenzívna vôňa jari.', 'full_description' => 'Voňavý ružový hyacint je skvelým darčekom na narodeniny alebo ako jarná dekorácia.',
            'price' => 5.49, 'quantity_available' => 51, 'category_id' => 2, 'color_id' => 2, 'created_at' => now(), 'updated_at' => now()],

            // ID = 20
            ['name' => 'Červený antúrium', 'slug' => 'cerveny-anturium', 'short_description' => 'Exotický a moderný vzhľad.', 'full_description' => 'Červené antúrium je modernou voľbou pre firemné priestory aj ako luxusný darček.',
            'price' => 18.90, 'quantity_available' => 29, 'category_id' => 4, 'color_id' => 3, 'created_at' => now(), 'updated_at' => now()],

            // ID = 21
            ['name' => 'Fialová astry', 'slug' => 'fialova-astry', 'short_description' => 'Jesenná elegancia.', 'full_description' => 'Fialové astry prinášajú bohatú farbu a sú vhodné ako smútočná kvetina aj ako súčasť jesenných dekorácií.',
            'price' => 6.95, 'quantity_available' => 40, 'category_id' => 3, 'color_id' => 4, 'created_at' => now(), 'updated_at' => now()],

            // ID = 22
            ['name' => 'Biela calla', 'slug' => 'biela-calla', 'short_description' => 'Elegancia a grácia.', 'full_description' => 'Biela kala (calla) je klasickou svadobnou kvetinou. Symbolizuje čistotu a krásu.',
            'price' => 12.99, 'quantity_available' => 31, 'category_id' => 1, 'color_id' => 1, 'created_at' => now(), 'updated_at' => now()],

            // ID = 23
            ['name' => 'Ružová alstroeméria', 'slug' => 'ruzova-alstroemeria', 'short_description' => 'Dlhotrvajúca krása.', 'full_description' => 'Ružová alstroeméria vydrží dlho vo váze a je ideálna na narodeninové kytice.',
            'price' => 7.25, 'quantity_available' => 88, 'category_id' => 2, 'color_id' => 2, 'created_at' => now(), 'updated_at' => now()],

            // ID = 24
            ['name' => 'Červený tulipán', 'slug' => 'cerveny-tulipan', 'short_description' => 'Vášeň v jarnej podobe.', 'full_description' => 'Intenzívne červené tulipány sú symbolom lásky a vášne. Perfektné na Valentína.',
            'price' => 5.75, 'quantity_available' => 105, 'category_id' => 2, 'color_id' => 3, 'created_at' => now(), 'updated_at' => now()],

            // ID = 25
            ['name' => 'Fialová ruža', 'slug' => 'fialova-ruza', 'short_description' => 'Záhada a očarenie.', 'full_description' => 'Fialová ruža vyjadruje očarenie, tajomstvo a hlbokú náklonnosť. Luxusný darček pre špeciálne osoby.',
            'price' => 13.50, 'quantity_available' => 27, 'category_id' => 2, 'color_id' => 4, 'created_at' => now(), 'updated_at' => now()],

            // ID = 26
            ['name' => 'Biela orchidea', 'slug' => 'biela-orchidea', 'short_description' => 'Čistý luxus.', 'full_description' => 'Biela orchidea je synonymom elegance a vhodná ako prestížny firemný darček alebo svadobná dekorácia.',
            'price' => 29.90, 'quantity_available' => 8, 'category_id' => 4, 'color_id' => 1, 'created_at' => now(), 'updated_at' => now()],

            // ID = 27
            ['name' => 'Ružový antúrium', 'slug' => 'ruzovy-anturium', 'short_description' => 'Jemný exotický akcent.', 'full_description' => 'Ružové antúrium je moderné a vhodné na narodeniny alebo romantické príležitosti.',
            'price' => 17.80, 'quantity_available' => 35, 'category_id' => 2, 'color_id' => 2, 'created_at' => now(), 'updated_at' => now()],

            // ID = 28
            ['name' => 'Čierna ruža (tmavočervená)', 'slug' => 'tmavocervena-ruza', 'short_description' => 'Mystická a dramatická.', 'full_description' => 'Hlboká tmavočervená ruža pôsobí takmer čierne. Ideálna na výnimočné a dramatické príležitosti.',
            'price' => 15.99, 'quantity_available' => 14, 'category_id' => 2, 'color_id' => 3, 'created_at' => now(), 'updated_at' => now()],

            // ID = 29
            ['name' => 'Fialová chryzantéma', 'slug' => 'fialova-chryzantema', 'short_description' => 'Smútočná elegancia.', 'full_description' => 'Fialová chryzantéma je vhodná na prejavy sústrasti a spomienkové vence.',
            'price' => 8.49, 'quantity_available' => 50, 'category_id' => 3, 'color_id' => 4, 'created_at' => now(), 'updated_at' => now()],

            // ID = 30
            ['name' => 'Biela frézia', 'slug' => 'biela-frezia', 'short_description' => 'Čistá vôňa a elegancia.', 'full_description' => 'Voňavá biela frézia je obľúbená pri svadobných kyticiach a jemných aranžmánoch.',
            'price' => 9.25, 'quantity_available' => 42, 'category_id' => 1, 'color_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            
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
            ['product_id' => 5, 'path' => 'img/fialova-levandula-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 5, 'path' => 'img/fialova-levandula-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 5, 'path' => 'img/fialova-levandula-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 5, 'path' => 'img/fialova-levandula-4.jpg', 'created_at' => now(), 'updated_at' => now()],
            
            // Produkt 6
            ['product_id' => 6, 'path' => 'img/biela-ruza-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 6, 'path' => 'img/biela-ruza-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 6, 'path' => 'img/biela-ruza-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 6, 'path' => 'img/biela-ruza-4.jpg', 'created_at' => now(), 'updated_at' => now()],

            // Produkt 7
            ['product_id' => 7, 'path' => 'img/ruzova-pivonia-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 7, 'path' => 'img/ruzova-pivonia-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 7, 'path' => 'img/ruzova-pivonia-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 7, 'path' => 'img/ruzova-pivonia-4.jpg', 'created_at' => now(), 'updated_at' => now()],

            // Produkt 8
            ['product_id' => 8, 'path' => 'img/cervena-gerbera-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 8, 'path' => 'img/cervena-gerbera-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 8, 'path' => 'img/cervena-gerbera-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 8, 'path' => 'img/cervena-gerbera-4.jpg', 'created_at' => now(), 'updated_at' => now()],

            // Produkt 9
            ['product_id' => 9, 'path' => 'img/fialova-orchidea-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 9, 'path' => 'img/fialova-orchidea-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 9, 'path' => 'img/fialova-orchidea-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 9, 'path' => 'img/fialova-orchidea-4.jpg', 'created_at' => now(), 'updated_at' => now()],
            
            // Produkt 10
            ['product_id' => 10, 'path' => 'img/biela-chryzantema-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 10, 'path' => 'img/biela-chryzantema-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 10, 'path' => 'img/biela-chryzantema-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 10, 'path' => 'img/biela-chryzantema-4.jpg', 'created_at' => now(), 'updated_at' => now()],

            // Produkt 11
            ['product_id' => 11, 'path' => 'img/ruzovy-tulipan-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 11, 'path' => 'img/ruzovy-tulipan-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 11, 'path' => 'img/ruzovy-tulipan-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 11, 'path' => 'img/ruzovy-tulipan-4.jpg', 'created_at' => now(), 'updated_at' => now()],

            // Produkt 12
            ['product_id' => 12, 'path' => 'img/cerveny-karafiat-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 12, 'path' => 'img/cerveny-karafiat-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 12, 'path' => 'img/cerveny-karafiat-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 12, 'path' => 'img/cerveny-karafiat-4.jpg', 'created_at' => now(), 'updated_at' => now()],

            // Produkt 13
            ['product_id' => 13, 'path' => 'img/fialova-lalia-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 13, 'path' => 'img/fialovy-lalia-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 13, 'path' => 'img/fialovy-lalia-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 13, 'path' => 'img/fialovy-lalia-4.jpg', 'created_at' => now(), 'updated_at' => now()],

            // Produkt 14
            ['product_id' => 14, 'path' => 'img/biela-hortenzia-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 14, 'path' => 'img/biela-hortenzia-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 14, 'path' => 'img/biela-hortenzia-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 14, 'path' => 'img/biela-hortenzia-4.jpg', 'created_at' => now(), 'updated_at' => now()],
            
            // Produkt 15
            ['product_id' => 15, 'path' => 'img/ruzova-levandula-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 15, 'path' => 'img/ruzova-levandula-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 15, 'path' => 'img/ruzova-levandula-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 15, 'path' => 'img/ruzova-levandula-4.jpg', 'created_at' => now(), 'updated_at' => now()],
            
            // Produkt 16
            ['product_id' => 16, 'path' => 'img/cerveny-amaryllis-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 16, 'path' => 'img/cerveny-amaryllis-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 16, 'path' => 'img/cerveny-amaryllis-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 16, 'path' => 'img/cerveny-amaryllis-4.jpg', 'created_at' => now(), 'updated_at' => now()],

            // Produkt 17
            ['product_id' => 17, 'path' => 'img/fialova-frezia-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 17, 'path' => 'img/fialova-frezia-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 17, 'path' => 'img/fialova-frezia-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 17, 'path' => 'img/fialova-frezia-4.jpg', 'created_at' => now(), 'updated_at' => now()],

            // Produkt 18
            ['product_id' => 18, 'path' => 'img/biela-eustoma-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 18, 'path' => 'img/biela-eustoma-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 18, 'path' => 'img/biela-eustoma-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 18, 'path' => 'img/biela-eustoma-4.jpg', 'created_at' => now(), 'updated_at' => now()],
            
            // Produkt 19
            ['product_id' => 19, 'path' => 'img/ruzovy-hyacint-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 19, 'path' => 'img/ruzovy-hyacint-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 19, 'path' => 'img/ruzovy-hyacint-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 19, 'path' => 'img/ruzovy-hyacint-4.jpg', 'created_at' => now(), 'updated_at' => now()],

            // Produkt 20
            ['product_id' => 20, 'path' => 'img/cerveny-anturium-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 20, 'path' => 'img/cerveny-anturium-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 20, 'path' => 'img/cerveny-anturium-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 20, 'path' => 'img/cerveny-anturium-4.jpg', 'created_at' => now(), 'updated_at' => now()],

            // Produkt 21
            ['product_id' => 21, 'path' => 'img/fialova-astry-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 21, 'path' => 'img/fialova-astry-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 21, 'path' => 'img/fialova-astry-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 21, 'path' => 'img/fialova-astry-4.jpg', 'created_at' => now(), 'updated_at' => now()],

            // Produkt 22
            ['product_id' => 22, 'path' => 'img/biela-calla-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 22, 'path' => 'img/biela-calla-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 22, 'path' => 'img/biela-calla-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 22, 'path' => 'img/biela-calla-4.jpg', 'created_at' => now(), 'updated_at' => now()],

            // Produkt 23
            ['product_id' => 23, 'path' => 'img/ruzova-alstroemeria-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 23, 'path' => 'img/ruzova-alstroemeria-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 23, 'path' => 'img/ruzova-alstroemeria-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 23, 'path' => 'img/ruzova-alstroemeria-4.jpg', 'created_at' => now(), 'updated_at' => now()],

            // Produkt 24
            ['product_id' => 24, 'path' => 'img/cerveny-tulipan-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 24, 'path' => 'img/cerveny-tulipan-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 24, 'path' => 'img/cerveny-tulipan-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 24, 'path' => 'img/cerveny-tulipan-4.jpg', 'created_at' => now(), 'updated_at' => now()],

            // Produkt 25
            ['product_id' => 25, 'path' => 'img/fialova-ruza-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 25, 'path' => 'img/fialova-ruza-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 25, 'path' => 'img/fialova-ruza-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 25, 'path' => 'img/fialova-ruza-4.jpg', 'created_at' => now(), 'updated_at' => now()],

            // Produkt 26
            ['product_id' => 26, 'path' => 'img/biela-orchidea-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 26, 'path' => 'img/biela-orchidea-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 26, 'path' => 'img/biela-orchidea-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 26, 'path' => 'img/biela-orchidea-4.jpg', 'created_at' => now(), 'updated_at' => now()],

            // Produkt 27
            ['product_id' => 27, 'path' => 'img/ruzovy-anturium-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 27, 'path' => 'img/ruzovy-anturium-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 27, 'path' => 'img/ruzovy-anturium-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 27, 'path' => 'img/ruzovy-anturium-4.jpg', 'created_at' => now(), 'updated_at' => now()],

            // Produkt 28
            ['product_id' => 28, 'path' => 'img/tmavocervena-ruza-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 28, 'path' => 'img/tmavocervena-ruza-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 28, 'path' => 'img/tmavocervena-ruza-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 28, 'path' => 'img/tmavocervena-ruza-4.jpg', 'created_at' => now(), 'updated_at' => now()],

            // Produkt 29
            ['product_id' => 29, 'path' => 'img/fialova-chryzantema-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 29, 'path' => 'img/fialova-chryzantema-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 29, 'path' => 'img/fialova-chryzantema-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 29, 'path' => 'img/fialova-chryzantema-4.jpg', 'created_at' => now(), 'updated_at' => now()],

            // Produkt 30
            ['product_id' => 30, 'path' => 'img/biela-frezia-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 30, 'path' => 'img/biela-frezia-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 30, 'path' => 'img/biela-frezia-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 30, 'path' => 'img/biela-frezia-4.jpg', 'created_at' => now(), 'updated_at' => now()],


        ]);
    }
}
