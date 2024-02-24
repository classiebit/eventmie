<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Translation;
use Classiebit\Eventmie\Models\User;

class TranslationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
        $translation = $this->translation('id', 1);
        if (!$translation->exists) 
        {    
        \DB::table('translations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'table_name' => 'data_types',
                'column_name' => 'display_name_singular',
                'foreign_key' => 5,
                'locale' => 'pt',
                'value' => 'Post',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            1 => 
            array (
                'id' => 2,
                'table_name' => 'data_types',
                'column_name' => 'display_name_singular',
                'foreign_key' => 6,
                'locale' => 'pt',
                'value' => 'Página',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            2 => 
            array (
                'id' => 3,
                'table_name' => 'data_types',
                'column_name' => 'display_name_singular',
                'foreign_key' => 1,
                'locale' => 'pt',
                'value' => 'Utilizador',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            3 => 
            array (
                'id' => 4,
                'table_name' => 'data_types',
                'column_name' => 'display_name_singular',
                'foreign_key' => 4,
                'locale' => 'pt',
                'value' => 'Categoria',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            4 => 
            array (
                'id' => 5,
                'table_name' => 'data_types',
                'column_name' => 'display_name_singular',
                'foreign_key' => 2,
                'locale' => 'pt',
                'value' => 'Menu',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            5 => 
            array (
                'id' => 6,
                'table_name' => 'data_types',
                'column_name' => 'display_name_singular',
                'foreign_key' => 3,
                'locale' => 'pt',
                'value' => 'Função',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            6 => 
            array (
                'id' => 7,
                'table_name' => 'data_types',
                'column_name' => 'display_name_plural',
                'foreign_key' => 5,
                'locale' => 'pt',
                'value' => 'Posts',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            7 => 
            array (
                'id' => 8,
                'table_name' => 'data_types',
                'column_name' => 'display_name_plural',
                'foreign_key' => 6,
                'locale' => 'pt',
                'value' => 'Páginas',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            8 => 
            array (
                'id' => 9,
                'table_name' => 'data_types',
                'column_name' => 'display_name_plural',
                'foreign_key' => 1,
                'locale' => 'pt',
                'value' => 'Utilizadores',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            9 => 
            array (
                'id' => 10,
                'table_name' => 'data_types',
                'column_name' => 'display_name_plural',
                'foreign_key' => 4,
                'locale' => 'pt',
                'value' => 'Categorias',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            10 => 
            array (
                'id' => 11,
                'table_name' => 'data_types',
                'column_name' => 'display_name_plural',
                'foreign_key' => 2,
                'locale' => 'pt',
                'value' => 'Menus',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            11 => 
            array (
                'id' => 12,
                'table_name' => 'data_types',
                'column_name' => 'display_name_plural',
                'foreign_key' => 3,
                'locale' => 'pt',
                'value' => 'Funções',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            12 => 
            array (
                'id' => 13,
                'table_name' => 'categories',
                'column_name' => 'slug',
                'foreign_key' => 1,
                'locale' => 'pt',
                'value' => 'categoria-1',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            13 => 
            array (
                'id' => 14,
                'table_name' => 'categories',
                'column_name' => 'name',
                'foreign_key' => 1,
                'locale' => 'pt',
                'value' => 'Categoria 1',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            14 => 
            array (
                'id' => 15,
                'table_name' => 'categories',
                'column_name' => 'slug',
                'foreign_key' => 2,
                'locale' => 'pt',
                'value' => 'categoria-2',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            15 => 
            array (
                'id' => 16,
                'table_name' => 'categories',
                'column_name' => 'name',
                'foreign_key' => 2,
                'locale' => 'pt',
                'value' => 'Categoria 2',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            16 => 
            array (
                'id' => 17,
                'table_name' => 'pages',
                'column_name' => 'title',
                'foreign_key' => 1,
                'locale' => 'pt',
                'value' => 'Olá Mundo',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            17 => 
            array (
                'id' => 18,
                'table_name' => 'pages',
                'column_name' => 'slug',
                'foreign_key' => 1,
                'locale' => 'pt',
                'value' => 'ola-mundo',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            18 => 
            array (
                'id' => 19,
                'table_name' => 'pages',
                'column_name' => 'body',
                'foreign_key' => 1,
                'locale' => 'pt',
                'value' => '<p>Olá Mundo. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>
<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            19 => 
            array (
                'id' => 20,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 1,
                'locale' => 'pt',
                'value' => 'Painel de Controle',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            20 => 
            array (
                'id' => 21,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 2,
                'locale' => 'pt',
                'value' => 'Media',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            21 => 
            array (
                'id' => 22,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 12,
                'locale' => 'pt',
                'value' => 'Publicações',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            22 => 
            array (
                'id' => 23,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 3,
                'locale' => 'pt',
                'value' => 'Utilizadores',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            23 => 
            array (
                'id' => 24,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 11,
                'locale' => 'pt',
                'value' => 'Categorias',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            24 => 
            array (
                'id' => 25,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 13,
                'locale' => 'pt',
                'value' => 'Páginas',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            25 => 
            array (
                'id' => 26,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 4,
                'locale' => 'pt',
                'value' => 'Funções',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            26 => 
            array (
                'id' => 27,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 5,
                'locale' => 'pt',
                'value' => 'Ferramentas',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            27 => 
            array (
                'id' => 28,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 6,
                'locale' => 'pt',
                'value' => 'Menus',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            28 => 
            array (
                'id' => 29,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 7,
                'locale' => 'pt',
                'value' => 'Base de dados',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            29 => 
            array (
                'id' => 30,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 10,
                'locale' => 'pt',
                'value' => 'Configurações',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            30 => 
            array (
                'id' => 31,
                'table_name' => 'data_types',
                'column_name' => 'display_name_singular',
                'foreign_key' => 7,
                'locale' => 'fr',
                'value' => 'Event',
                'created_at' => '2018-12-22 09:29:05',
                'updated_at' => '2018-12-22 09:29:05',
            ),
            31 => 
            array (
                'id' => 32,
                'table_name' => 'data_types',
                'column_name' => 'display_name_plural',
                'foreign_key' => 7,
                'locale' => 'fr',
                'value' => 'Events',
                'created_at' => '2018-12-22 09:29:05',
                'updated_at' => '2018-12-22 09:29:05',
            ),
            32 => 
            array (
                'id' => 33,
                'table_name' => 'data_types',
                'column_name' => 'display_name_singular',
                'foreign_key' => 9,
                'locale' => 'fr',
                'value' => 'Country',
                'created_at' => '2018-12-22 11:07:43',
                'updated_at' => '2018-12-22 11:07:43',
            ),
            33 => 
            array (
                'id' => 34,
                'table_name' => 'data_types',
                'column_name' => 'display_name_plural',
                'foreign_key' => 9,
                'locale' => 'fr',
                'value' => 'Countries',
                'created_at' => '2018-12-22 11:07:43',
                'updated_at' => '2018-12-22 11:07:43',
            ),
            34 => 
            array (
                'id' => 38,
                'table_name' => 'data_types',
                'column_name' => 'display_name_singular',
                'foreign_key' => 13,
                'locale' => 'fr',
                'value' => 'Currency',
                'created_at' => '2018-12-22 11:37:56',
                'updated_at' => '2018-12-22 11:37:56',
            ),
            35 => 
            array (
                'id' => 39,
                'table_name' => 'data_types',
                'column_name' => 'display_name_plural',
                'foreign_key' => 13,
                'locale' => 'fr',
                'value' => 'Currencies',
                'created_at' => '2018-12-22 11:37:56',
                'updated_at' => '2018-12-22 11:37:56',
            ),
            36 => 
            array (
                'id' => 40,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 19,
                'locale' => 'fr',
                'value' => 'Currencies',
                'created_at' => '2018-12-22 11:38:14',
                'updated_at' => '2018-12-22 11:38:14',
            ),
            37 => 
            array (
                'id' => 41,
                'table_name' => 'data_types',
                'column_name' => 'display_name_singular',
                'foreign_key' => 14,
                'locale' => 'fr',
                'value' => 'Ticket',
                'created_at' => '2018-12-22 11:57:36',
                'updated_at' => '2018-12-22 11:57:36',
            ),
            38 => 
            array (
                'id' => 42,
                'table_name' => 'data_types',
                'column_name' => 'display_name_plural',
                'foreign_key' => 14,
                'locale' => 'fr',
                'value' => 'Tickets',
                'created_at' => '2018-12-22 11:57:36',
                'updated_at' => '2018-12-22 11:57:36',
            ),
            39 => 
            array (
                'id' => 43,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 20,
                'locale' => 'fr',
                'value' => 'Tickets',
                'created_at' => '2018-12-22 11:57:47',
                'updated_at' => '2018-12-22 11:57:47',
            ),
            40 => 
            array (
                'id' => 44,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 21,
                'locale' => 'fr',
                'value' => '',
                'created_at' => '2018-12-22 12:02:59',
                'updated_at' => '2018-12-22 12:02:59',
            ),
            41 => 
            array (
                'id' => 45,
                'table_name' => 'data_types',
                'column_name' => 'display_name_singular',
                'foreign_key' => 15,
                'locale' => 'fr',
                'value' => 'Category',
                'created_at' => '2019-01-11 06:24:37',
                'updated_at' => '2019-01-11 06:24:37',
            ),
            42 => 
            array (
                'id' => 46,
                'table_name' => 'data_types',
                'column_name' => 'display_name_plural',
                'foreign_key' => 15,
                'locale' => 'fr',
                'value' => 'Categories',
                'created_at' => '2019-01-11 06:24:37',
                'updated_at' => '2019-01-11 06:24:37',
            ),
            43 => 
            array (
                'id' => 47,
                'table_name' => 'data_types',
                'column_name' => 'display_name_singular',
                'foreign_key' => 16,
                'locale' => 'fr',
                'value' => 'Speaker',
                'created_at' => '2019-01-11 07:01:39',
                'updated_at' => '2019-01-11 07:01:39',
            ),
            44 => 
            array (
                'id' => 48,
                'table_name' => 'data_types',
                'column_name' => 'display_name_plural',
                'foreign_key' => 16,
                'locale' => 'fr',
                'value' => 'Speakers',
                'created_at' => '2019-01-11 07:01:39',
                'updated_at' => '2019-01-11 07:01:39',
            ),
            45 => 
            array (
                'id' => 49,
                'table_name' => 'data_types',
                'column_name' => 'display_name_singular',
                'foreign_key' => 17,
                'locale' => 'fr',
                'value' => 'Sponsor',
                'created_at' => '2019-01-19 10:54:23',
                'updated_at' => '2019-01-19 10:54:23',
            ),
            46 => 
            array (
                'id' => 50,
                'table_name' => 'data_types',
                'column_name' => 'display_name_plural',
                'foreign_key' => 17,
                'locale' => 'fr',
                'value' => 'Sponsors',
                'created_at' => '2019-01-19 10:54:23',
                'updated_at' => '2019-01-19 10:54:23',
            ),
            47 => 
            array (
                'id' => 51,
                'table_name' => 'data_types',
                'column_name' => 'display_name_singular',
                'foreign_key' => 18,
                'locale' => 'fr',
                'value' => 'Schedule',
                'created_at' => '2019-04-24 05:21:28',
                'updated_at' => '2019-04-24 05:21:28',
            ),
            48 => 
            array (
                'id' => 52,
                'table_name' => 'data_types',
                'column_name' => 'display_name_plural',
                'foreign_key' => 18,
                'locale' => 'fr',
                'value' => 'Schedules',
                'created_at' => '2019-04-24 05:21:28',
                'updated_at' => '2019-04-24 05:21:28',
            ),
            49 => 
            array (
                'id' => 53,
                'table_name' => 'data_types',
                'column_name' => 'display_name_singular',
                'foreign_key' => 20,
                'locale' => 'fr',
                'value' => 'Tax',
                'created_at' => '2019-06-01 05:05:37',
                'updated_at' => '2019-06-01 05:05:37',
            ),
            50 => 
            array (
                'id' => 54,
                'table_name' => 'data_types',
                'column_name' => 'display_name_plural',
                'foreign_key' => 20,
                'locale' => 'fr',
                'value' => 'Taxes',
                'created_at' => '2019-06-01 05:05:37',
                'updated_at' => '2019-06-01 05:05:37',
            ),
        ));
        }
    }

    protected function translation($field, $for)
    {
        return Translation::firstOrNew([$field => $for]);
    }
}