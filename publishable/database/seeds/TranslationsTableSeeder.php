<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Translation;

class TranslationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $translation = Translation::firstOrNew(['id' => 1]);
        if (!$translation->exists) {
        
            \DB::table('translations')->insert(array (
                0 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_singular',
                    'foreign_key' => 5,
                    'locale' => 'pt',
                    'value' => 'Post',
                ),
                1 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_singular',
                    'foreign_key' => 6,
                    'locale' => 'pt',
                    'value' => 'Página',
                ),
                2 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_singular',
                    'foreign_key' => 1,
                    'locale' => 'pt',
                    'value' => 'Utilizador',
                ),
                3 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_singular',
                    'foreign_key' => 4,
                    'locale' => 'pt',
                    'value' => 'Categoria',
                ),
                4 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_singular',
                    'foreign_key' => 2,
                    'locale' => 'pt',
                    'value' => 'Menu',
                ),
                5 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_singular',
                    'foreign_key' => 3,
                    'locale' => 'pt',
                    'value' => 'Função',
                ),
                6 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_plural',
                    'foreign_key' => 5,
                    'locale' => 'pt',
                    'value' => 'Posts',
                ),
                7 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_plural',
                    'foreign_key' => 6,
                    'locale' => 'pt',
                    'value' => 'Páginas',
                ),
                8 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_plural',
                    'foreign_key' => 1,
                    'locale' => 'pt',
                    'value' => 'Utilizadores',
                ),
                9 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_plural',
                    'foreign_key' => 4,
                    'locale' => 'pt',
                    'value' => 'Categorias',
                ),
                10 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_plural',
                    'foreign_key' => 2,
                    'locale' => 'pt',
                    'value' => 'Menus',
                ),
                11 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_plural',
                    'foreign_key' => 3,
                    'locale' => 'pt',
                    'value' => 'Funções',
                ),
                12 => 
                array (
                    'table_name' => 'categories',
                    'column_name' => 'slug',
                    'foreign_key' => 1,
                    'locale' => 'pt',
                    'value' => 'categoria-1',
                ),
                13 => 
                array (
                    'table_name' => 'categories',
                    'column_name' => 'name',
                    'foreign_key' => 1,
                    'locale' => 'pt',
                    'value' => 'Categoria 1',
                ),
                14 => 
                array (
                    'table_name' => 'categories',
                    'column_name' => 'slug',
                    'foreign_key' => 2,
                    'locale' => 'pt',
                    'value' => 'categoria-2',
                ),
                15 => 
                array (
                    'table_name' => 'categories',
                    'column_name' => 'name',
                    'foreign_key' => 2,
                    'locale' => 'pt',
                    'value' => 'Categoria 2',
                ),
                16 => 
                array (
                    'table_name' => 'pages',
                    'column_name' => 'title',
                    'foreign_key' => 1,
                    'locale' => 'pt',
                    'value' => 'Olá Mundo',
                ),
                17 => 
                array (
                    'table_name' => 'pages',
                    'column_name' => 'slug',
                    'foreign_key' => 1,
                    'locale' => 'pt',
                    'value' => 'ola-mundo',
                ),
                18 => 
                array (
                    'table_name' => 'pages',
                    'column_name' => 'body',
                    'foreign_key' => 1,
                    'locale' => 'pt',
                    'value' => '<p>Olá Mundo. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>
    <p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>',
                ),
                19 => 
                array (
                    'table_name' => 'menu_items',
                    'column_name' => 'title',
                    'foreign_key' => 1,
                    'locale' => 'pt',
                    'value' => 'Painel de Controle',
                ),
                20 => 
                array (
                    'table_name' => 'menu_items',
                    'column_name' => 'title',
                    'foreign_key' => 2,
                    'locale' => 'pt',
                    'value' => 'Media',
                ),
                21 => 
                array (
                    'table_name' => 'menu_items',
                    'column_name' => 'title',
                    'foreign_key' => 12,
                    'locale' => 'pt',
                    'value' => 'Publicações',
                ),
                22 => 
                array (
                    'table_name' => 'menu_items',
                    'column_name' => 'title',
                    'foreign_key' => 3,
                    'locale' => 'pt',
                    'value' => 'Utilizadores',
                ),
                23 => 
                array (
                    'table_name' => 'menu_items',
                    'column_name' => 'title',
                    'foreign_key' => 11,
                    'locale' => 'pt',
                    'value' => 'Categorias',
                ),
                24 => 
                array (
                    'table_name' => 'menu_items',
                    'column_name' => 'title',
                    'foreign_key' => 13,
                    'locale' => 'pt',
                    'value' => 'Páginas',
                ),
                25 => 
                array (
                    'table_name' => 'menu_items',
                    'column_name' => 'title',
                    'foreign_key' => 4,
                    'locale' => 'pt',
                    'value' => 'Funções',
                ),
                26 => 
                array (
                    'table_name' => 'menu_items',
                    'column_name' => 'title',
                    'foreign_key' => 5,
                    'locale' => 'pt',
                    'value' => 'Ferramentas',
                ),
                27 => 
                array (
                    'table_name' => 'menu_items',
                    'column_name' => 'title',
                    'foreign_key' => 6,
                    'locale' => 'pt',
                    'value' => 'Menus',
                ),
                28 => 
                array (
                    'table_name' => 'menu_items',
                    'column_name' => 'title',
                    'foreign_key' => 7,
                    'locale' => 'pt',
                    'value' => 'Base de dados',
                ),
                29 => 
                array (
                    'table_name' => 'menu_items',
                    'column_name' => 'title',
                    'foreign_key' => 10,
                    'locale' => 'pt',
                    'value' => 'Configurações',
                ),
                30 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_singular',
                    'foreign_key' => 7,
                    'locale' => 'fr',
                    'value' => 'Event',
                ),
                31 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_plural',
                    'foreign_key' => 7,
                    'locale' => 'fr',
                    'value' => 'Events',
                ),
                32 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_singular',
                    'foreign_key' => 9,
                    'locale' => 'fr',
                    'value' => 'Country',
                ),
                33 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_plural',
                    'foreign_key' => 9,
                    'locale' => 'fr',
                    'value' => 'Countries',
                ),
                34 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_singular',
                    'foreign_key' => 13,
                    'locale' => 'fr',
                    'value' => 'Currency',
                ),
                35 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_plural',
                    'foreign_key' => 13,
                    'locale' => 'fr',
                    'value' => 'Currencies',
                ),
                36 => 
                array (
                    'table_name' => 'menu_items',
                    'column_name' => 'title',
                    'foreign_key' => 19,
                    'locale' => 'fr',
                    'value' => 'Currencies',
                ),
                37 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_singular',
                    'foreign_key' => 14,
                    'locale' => 'fr',
                    'value' => 'Ticket',
                ),
                38 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_plural',
                    'foreign_key' => 14,
                    'locale' => 'fr',
                    'value' => 'Tickets',
                ),
                39 => 
                array (
                    'table_name' => 'menu_items',
                    'column_name' => 'title',
                    'foreign_key' => 20,
                    'locale' => 'fr',
                    'value' => 'Tickets',
                ),
                40 => 
                array (
                    'table_name' => 'menu_items',
                    'column_name' => 'title',
                    'foreign_key' => 21,
                    'locale' => 'fr',
                    'value' => '',
                ),
                41 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_singular',
                    'foreign_key' => 15,
                    'locale' => 'fr',
                    'value' => 'Category',
                ),
                42 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_plural',
                    'foreign_key' => 15,
                    'locale' => 'fr',
                    'value' => 'Categories',
                ),
                43 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_singular',
                    'foreign_key' => 16,
                    'locale' => 'fr',
                    'value' => 'Speaker',
                ),
                44 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_plural',
                    'foreign_key' => 16,
                    'locale' => 'fr',
                    'value' => 'Speakers',
                ),
                45 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_singular',
                    'foreign_key' => 17,
                    'locale' => 'fr',
                    'value' => 'Sponsor',
                ),
                46 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_plural',
                    'foreign_key' => 17,
                    'locale' => 'fr',
                    'value' => 'Sponsors',
                ),
                47 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_singular',
                    'foreign_key' => 18,
                    'locale' => 'fr',
                    'value' => 'Schedule',
                ),
                48 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_plural',
                    'foreign_key' => 18,
                    'locale' => 'fr',
                    'value' => 'Schedules',
                ),
                49 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_singular',
                    'foreign_key' => 20,
                    'locale' => 'fr',
                    'value' => 'Tax',
                ),
                50 => 
                array (
                    'table_name' => 'data_types',
                    'column_name' => 'display_name_plural',
                    'foreign_key' => 20,
                    'locale' => 'fr',
                    'value' => 'Taxes',
                ),
            ));
        }
        
        
    }
}