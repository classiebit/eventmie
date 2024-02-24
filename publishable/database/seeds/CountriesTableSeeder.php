<?php

use Illuminate\Database\Seeder;
use Classiebit\Eventmie\Models\Country;

class CountriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {   
        $country = Country::count();
        if($country) 
            return true;

        $country = $this->country('id', 1);
        if (!$country->exists) {
            \DB::table('countries')->insert(array (
            0 => 
            array (
                'id' => 1,
                'country_code' => 'AF',
                'country_name' => 'Afghanistan',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'country_code' => 'AL',
                'country_name' => 'Albania',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'country_code' => 'DZ',
                'country_name' => 'Algeria',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'country_code' => 'DS',
                'country_name' => 'American Samoa',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'country_code' => 'AD',
                'country_name' => 'Andorra',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'country_code' => 'AO',
                'country_name' => 'Angola',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'country_code' => 'AI',
                'country_name' => 'Anguilla',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'country_code' => 'AQ',
                'country_name' => 'Antarctica',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'country_code' => 'AG',
                'country_name' => 'Antigua and Barbuda',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'country_code' => 'AR',
                'country_name' => 'Argentina',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'country_code' => 'AM',
                'country_name' => 'Armenia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'country_code' => 'AW',
                'country_name' => 'Aruba',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'country_code' => 'AU',
                'country_name' => 'Australia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'country_code' => 'AT',
                'country_name' => 'Austria',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'country_code' => 'AZ',
                'country_name' => 'Azerbaijan',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'country_code' => 'BS',
                'country_name' => 'Bahamas',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'country_code' => 'BH',
                'country_name' => 'Bahrain',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'country_code' => 'BD',
                'country_name' => 'Bangladesh',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'country_code' => 'BB',
                'country_name' => 'Barbados',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'country_code' => 'BY',
                'country_name' => 'Belarus',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'country_code' => 'BE',
                'country_name' => 'Belgium',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'country_code' => 'BZ',
                'country_name' => 'Belize',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'country_code' => 'BJ',
                'country_name' => 'Benin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'country_code' => 'BM',
                'country_name' => 'Bermuda',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'country_code' => 'BT',
                'country_name' => 'Bhutan',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'country_code' => 'BO',
                'country_name' => 'Bolivia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'country_code' => 'BA',
                'country_name' => 'Bosnia and Herzegovina',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'country_code' => 'BW',
                'country_name' => 'Botswana',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'country_code' => 'BV',
                'country_name' => 'Bouvet Island',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'country_code' => 'BR',
                'country_name' => 'Brazil',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'country_code' => 'IO',
                'country_name' => 'British Indian Ocean Territory',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'country_code' => 'BN',
                'country_name' => 'Brunei Darussalam',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'country_code' => 'BG',
                'country_name' => 'Bulgaria',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'country_code' => 'BF',
                'country_name' => 'Burkina Faso',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'country_code' => 'BI',
                'country_name' => 'Burundi',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'country_code' => 'KH',
                'country_name' => 'Cambodia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            36 => 
            array (
                'id' => 37,
                'country_code' => 'CM',
                'country_name' => 'Cameroon',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'country_code' => 'CA',
                'country_name' => 'Canada',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'country_code' => 'CV',
                'country_name' => 'Cape Verde',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            39 => 
            array (
                'id' => 40,
                'country_code' => 'KY',
                'country_name' => 'Cayman Islands',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            40 => 
            array (
                'id' => 41,
                'country_code' => 'CF',
                'country_name' => 'Central African Republic',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            41 => 
            array (
                'id' => 42,
                'country_code' => 'TD',
                'country_name' => 'Chad',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            42 => 
            array (
                'id' => 43,
                'country_code' => 'CL',
                'country_name' => 'Chile',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            43 => 
            array (
                'id' => 44,
                'country_code' => 'CN',
                'country_name' => 'China',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            44 => 
            array (
                'id' => 45,
                'country_code' => 'CX',
                'country_name' => 'Christmas Island',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            45 => 
            array (
                'id' => 46,
                'country_code' => 'CC',
            'country_name' => 'Cocos (Keeling) Islands',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            46 => 
            array (
                'id' => 47,
                'country_code' => 'CO',
                'country_name' => 'Colombia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            47 => 
            array (
                'id' => 48,
                'country_code' => 'KM',
                'country_name' => 'Comoros',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            48 => 
            array (
                'id' => 49,
                'country_code' => 'CG',
                'country_name' => 'Congo',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            49 => 
            array (
                'id' => 50,
                'country_code' => 'CK',
                'country_name' => 'Cook Islands',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            50 => 
            array (
                'id' => 51,
                'country_code' => 'CR',
                'country_name' => 'Costa Rica',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            51 => 
            array (
                'id' => 52,
                'country_code' => 'HR',
            'country_name' => 'Croatia (Hrvatska)',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            52 => 
            array (
                'id' => 53,
                'country_code' => 'CU',
                'country_name' => 'Cuba',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            53 => 
            array (
                'id' => 54,
                'country_code' => 'CY',
                'country_name' => 'Cyprus',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            54 => 
            array (
                'id' => 55,
                'country_code' => 'CZ',
                'country_name' => 'Czech Republic',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            55 => 
            array (
                'id' => 56,
                'country_code' => 'DK',
                'country_name' => 'Denmark',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            56 => 
            array (
                'id' => 57,
                'country_code' => 'DJ',
                'country_name' => 'Djibouti',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            57 => 
            array (
                'id' => 58,
                'country_code' => 'DM',
                'country_name' => 'Dominica',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            58 => 
            array (
                'id' => 59,
                'country_code' => 'DO',
                'country_name' => 'Dominican Republic',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            59 => 
            array (
                'id' => 60,
                'country_code' => 'TP',
                'country_name' => 'East Timor',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            60 => 
            array (
                'id' => 61,
                'country_code' => 'EC',
                'country_name' => 'Ecuador',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            61 => 
            array (
                'id' => 62,
                'country_code' => 'EG',
                'country_name' => 'Egypt',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            62 => 
            array (
                'id' => 63,
                'country_code' => 'SV',
                'country_name' => 'El Salvador',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            63 => 
            array (
                'id' => 64,
                'country_code' => 'GQ',
                'country_name' => 'Equatorial Guinea',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            64 => 
            array (
                'id' => 65,
                'country_code' => 'ER',
                'country_name' => 'Eritrea',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            65 => 
            array (
                'id' => 66,
                'country_code' => 'EE',
                'country_name' => 'Estonia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            66 => 
            array (
                'id' => 67,
                'country_code' => 'ET',
                'country_name' => 'Ethiopia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            67 => 
            array (
                'id' => 68,
                'country_code' => 'FK',
            'country_name' => 'Falkland Islands (Malvinas)',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            68 => 
            array (
                'id' => 69,
                'country_code' => 'FO',
                'country_name' => 'Faroe Islands',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            69 => 
            array (
                'id' => 70,
                'country_code' => 'FJ',
                'country_name' => 'Fiji',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            70 => 
            array (
                'id' => 71,
                'country_code' => 'FI',
                'country_name' => 'Finland',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            71 => 
            array (
                'id' => 72,
                'country_code' => 'FR',
                'country_name' => 'France',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            72 => 
            array (
                'id' => 73,
                'country_code' => 'FX',
                'country_name' => 'France, Metropolitan',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            73 => 
            array (
                'id' => 74,
                'country_code' => 'GF',
                'country_name' => 'French Guiana',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            74 => 
            array (
                'id' => 75,
                'country_code' => 'PF',
                'country_name' => 'French Polynesia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            75 => 
            array (
                'id' => 76,
                'country_code' => 'TF',
                'country_name' => 'French Southern Territories',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            76 => 
            array (
                'id' => 77,
                'country_code' => 'GA',
                'country_name' => 'Gabon',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            77 => 
            array (
                'id' => 78,
                'country_code' => 'GM',
                'country_name' => 'Gambia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            78 => 
            array (
                'id' => 79,
                'country_code' => 'GE',
                'country_name' => 'Georgia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            79 => 
            array (
                'id' => 80,
                'country_code' => 'DE',
                'country_name' => 'Germany',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            80 => 
            array (
                'id' => 81,
                'country_code' => 'GH',
                'country_name' => 'Ghana',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            81 => 
            array (
                'id' => 82,
                'country_code' => 'GI',
                'country_name' => 'Gibraltar',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            82 => 
            array (
                'id' => 83,
                'country_code' => 'GK',
                'country_name' => 'Guernsey',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            83 => 
            array (
                'id' => 84,
                'country_code' => 'GR',
                'country_name' => 'Greece',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            84 => 
            array (
                'id' => 85,
                'country_code' => 'GL',
                'country_name' => 'Greenland',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            85 => 
            array (
                'id' => 86,
                'country_code' => 'GD',
                'country_name' => 'Grenada',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            86 => 
            array (
                'id' => 87,
                'country_code' => 'GP',
                'country_name' => 'Guadeloupe',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            87 => 
            array (
                'id' => 88,
                'country_code' => 'GU',
                'country_name' => 'Guam',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            88 => 
            array (
                'id' => 89,
                'country_code' => 'GT',
                'country_name' => 'Guatemala',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            89 => 
            array (
                'id' => 90,
                'country_code' => 'GN',
                'country_name' => 'Guinea',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            90 => 
            array (
                'id' => 91,
                'country_code' => 'GW',
                'country_name' => 'Guinea-Bissau',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            91 => 
            array (
                'id' => 92,
                'country_code' => 'GY',
                'country_name' => 'Guyana',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            92 => 
            array (
                'id' => 93,
                'country_code' => 'HT',
                'country_name' => 'Haiti',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            93 => 
            array (
                'id' => 94,
                'country_code' => 'HM',
                'country_name' => 'Heard and Mc Donald Islands',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            94 => 
            array (
                'id' => 95,
                'country_code' => 'HN',
                'country_name' => 'Honduras',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            95 => 
            array (
                'id' => 96,
                'country_code' => 'HK',
                'country_name' => 'Hong Kong',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            96 => 
            array (
                'id' => 97,
                'country_code' => 'HU',
                'country_name' => 'Hungary',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            97 => 
            array (
                'id' => 98,
                'country_code' => 'IS',
                'country_name' => 'Iceland',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            98 => 
            array (
                'id' => 99,
                'country_code' => 'IN',
                'country_name' => 'India',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            99 => 
            array (
                'id' => 100,
                'country_code' => 'IM',
                'country_name' => 'Isle of Man',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            100 => 
            array (
                'id' => 101,
                'country_code' => 'ID',
                'country_name' => 'Indonesia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            101 => 
            array (
                'id' => 102,
                'country_code' => 'IR',
            'country_name' => 'Iran (Islamic Republic of)',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            102 => 
            array (
                'id' => 103,
                'country_code' => 'IQ',
                'country_name' => 'Iraq',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            103 => 
            array (
                'id' => 104,
                'country_code' => 'IE',
                'country_name' => 'Ireland',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            104 => 
            array (
                'id' => 105,
                'country_code' => 'IL',
                'country_name' => 'Israel',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            105 => 
            array (
                'id' => 106,
                'country_code' => 'IT',
                'country_name' => 'Italy',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            106 => 
            array (
                'id' => 107,
                'country_code' => 'CI',
                'country_name' => 'Ivory Coast',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            107 => 
            array (
                'id' => 108,
                'country_code' => 'JE',
                'country_name' => 'Jersey',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            108 => 
            array (
                'id' => 109,
                'country_code' => 'JM',
                'country_name' => 'Jamaica',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            109 => 
            array (
                'id' => 110,
                'country_code' => 'JP',
                'country_name' => 'Japan',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            110 => 
            array (
                'id' => 111,
                'country_code' => 'JO',
                'country_name' => 'Jordan',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            111 => 
            array (
                'id' => 112,
                'country_code' => 'KZ',
                'country_name' => 'Kazakhstan',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            112 => 
            array (
                'id' => 113,
                'country_code' => 'KE',
                'country_name' => 'Kenya',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            113 => 
            array (
                'id' => 114,
                'country_code' => 'KI',
                'country_name' => 'Kiribati',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            114 => 
            array (
                'id' => 115,
                'country_code' => 'KP',
                'country_name' => 'Korea, Democratic People\'s Republic of',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            115 => 
            array (
                'id' => 116,
                'country_code' => 'KR',
                'country_name' => 'Korea, Republic of',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            116 => 
            array (
                'id' => 117,
                'country_code' => 'XK',
                'country_name' => 'Kosovo',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            117 => 
            array (
                'id' => 118,
                'country_code' => 'KW',
                'country_name' => 'Kuwait',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            118 => 
            array (
                'id' => 119,
                'country_code' => 'KG',
                'country_name' => 'Kyrgyzstan',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            119 => 
            array (
                'id' => 120,
                'country_code' => 'LA',
                'country_name' => 'Lao People\'s Democratic Republic',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            120 => 
            array (
                'id' => 121,
                'country_code' => 'LV',
                'country_name' => 'Latvia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            121 => 
            array (
                'id' => 122,
                'country_code' => 'LB',
                'country_name' => 'Lebanon',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            122 => 
            array (
                'id' => 123,
                'country_code' => 'LS',
                'country_name' => 'Lesotho',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            123 => 
            array (
                'id' => 124,
                'country_code' => 'LR',
                'country_name' => 'Liberia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            124 => 
            array (
                'id' => 125,
                'country_code' => 'LY',
                'country_name' => 'Libyan Arab Jamahiriya',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            125 => 
            array (
                'id' => 126,
                'country_code' => 'LI',
                'country_name' => 'Liechtenstein',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            126 => 
            array (
                'id' => 127,
                'country_code' => 'LT',
                'country_name' => 'Lithuania',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            127 => 
            array (
                'id' => 128,
                'country_code' => 'LU',
                'country_name' => 'Luxembourg',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            128 => 
            array (
                'id' => 129,
                'country_code' => 'MO',
                'country_name' => 'Macau',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            129 => 
            array (
                'id' => 130,
                'country_code' => 'MK',
                'country_name' => 'Macedonia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            130 => 
            array (
                'id' => 131,
                'country_code' => 'MG',
                'country_name' => 'Madagascar',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            131 => 
            array (
                'id' => 132,
                'country_code' => 'MW',
                'country_name' => 'Malawi',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            132 => 
            array (
                'id' => 133,
                'country_code' => 'MY',
                'country_name' => 'Malaysia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            133 => 
            array (
                'id' => 134,
                'country_code' => 'MV',
                'country_name' => 'Maldives',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            134 => 
            array (
                'id' => 135,
                'country_code' => 'ML',
                'country_name' => 'Mali',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            135 => 
            array (
                'id' => 136,
                'country_code' => 'MT',
                'country_name' => 'Malta',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            136 => 
            array (
                'id' => 137,
                'country_code' => 'MH',
                'country_name' => 'Marshall Islands',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            137 => 
            array (
                'id' => 138,
                'country_code' => 'MQ',
                'country_name' => 'Martinique',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            138 => 
            array (
                'id' => 139,
                'country_code' => 'MR',
                'country_name' => 'Mauritania',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            139 => 
            array (
                'id' => 140,
                'country_code' => 'MU',
                'country_name' => 'Mauritius',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            140 => 
            array (
                'id' => 141,
                'country_code' => 'TY',
                'country_name' => 'Mayotte',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            141 => 
            array (
                'id' => 142,
                'country_code' => 'MX',
                'country_name' => 'Mexico',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            142 => 
            array (
                'id' => 143,
                'country_code' => 'FM',
                'country_name' => 'Micronesia, Federated States of',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            143 => 
            array (
                'id' => 144,
                'country_code' => 'MD',
                'country_name' => 'Moldova, Republic of',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            144 => 
            array (
                'id' => 145,
                'country_code' => 'MC',
                'country_name' => 'Monaco',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            145 => 
            array (
                'id' => 146,
                'country_code' => 'MN',
                'country_name' => 'Mongolia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            146 => 
            array (
                'id' => 147,
                'country_code' => 'ME',
                'country_name' => 'Montenegro',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            147 => 
            array (
                'id' => 148,
                'country_code' => 'MS',
                'country_name' => 'Montserrat',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            148 => 
            array (
                'id' => 149,
                'country_code' => 'MA',
                'country_name' => 'Morocco',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            149 => 
            array (
                'id' => 150,
                'country_code' => 'MZ',
                'country_name' => 'Mozambique',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            150 => 
            array (
                'id' => 151,
                'country_code' => 'MM',
                'country_name' => 'Myanmar',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            151 => 
            array (
                'id' => 152,
                'country_code' => 'NA',
                'country_name' => 'Namibia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            152 => 
            array (
                'id' => 153,
                'country_code' => 'NR',
                'country_name' => 'Nauru',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            153 => 
            array (
                'id' => 154,
                'country_code' => 'NP',
                'country_name' => 'Nepal',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            154 => 
            array (
                'id' => 155,
                'country_code' => 'NL',
                'country_name' => 'Netherlands',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            155 => 
            array (
                'id' => 156,
                'country_code' => 'AN',
                'country_name' => 'Netherlands Antilles',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            156 => 
            array (
                'id' => 157,
                'country_code' => 'NC',
                'country_name' => 'New Caledonia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            157 => 
            array (
                'id' => 158,
                'country_code' => 'NZ',
                'country_name' => 'New Zealand',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            158 => 
            array (
                'id' => 159,
                'country_code' => 'NI',
                'country_name' => 'Nicaragua',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            159 => 
            array (
                'id' => 160,
                'country_code' => 'NE',
                'country_name' => 'Niger',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            160 => 
            array (
                'id' => 161,
                'country_code' => 'NG',
                'country_name' => 'Nigeria',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            161 => 
            array (
                'id' => 162,
                'country_code' => 'NU',
                'country_name' => 'Niue',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            162 => 
            array (
                'id' => 163,
                'country_code' => 'NF',
                'country_name' => 'Norfolk Island',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            163 => 
            array (
                'id' => 164,
                'country_code' => 'MP',
                'country_name' => 'Northern Mariana Islands',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            164 => 
            array (
                'id' => 165,
                'country_code' => 'NO',
                'country_name' => 'Norway',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            165 => 
            array (
                'id' => 166,
                'country_code' => 'OM',
                'country_name' => 'Oman',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            166 => 
            array (
                'id' => 167,
                'country_code' => 'PK',
                'country_name' => 'Pakistan',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            167 => 
            array (
                'id' => 168,
                'country_code' => 'PW',
                'country_name' => 'Palau',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            168 => 
            array (
                'id' => 169,
                'country_code' => 'PS',
                'country_name' => 'Palestine',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            169 => 
            array (
                'id' => 170,
                'country_code' => 'PA',
                'country_name' => 'Panama',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            170 => 
            array (
                'id' => 171,
                'country_code' => 'PG',
                'country_name' => 'Papua New Guinea',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            171 => 
            array (
                'id' => 172,
                'country_code' => 'PY',
                'country_name' => 'Paraguay',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            172 => 
            array (
                'id' => 173,
                'country_code' => 'PE',
                'country_name' => 'Peru',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            173 => 
            array (
                'id' => 174,
                'country_code' => 'PH',
                'country_name' => 'Philippines',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            174 => 
            array (
                'id' => 175,
                'country_code' => 'PN',
                'country_name' => 'Pitcairn',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            175 => 
            array (
                'id' => 176,
                'country_code' => 'PL',
                'country_name' => 'Poland',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            176 => 
            array (
                'id' => 177,
                'country_code' => 'PT',
                'country_name' => 'Portugal',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            177 => 
            array (
                'id' => 178,
                'country_code' => 'PR',
                'country_name' => 'Puerto Rico',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            178 => 
            array (
                'id' => 179,
                'country_code' => 'QA',
                'country_name' => 'Qatar',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            179 => 
            array (
                'id' => 180,
                'country_code' => 'RE',
                'country_name' => 'Reunion',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            180 => 
            array (
                'id' => 181,
                'country_code' => 'RO',
                'country_name' => 'Romania',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            181 => 
            array (
                'id' => 182,
                'country_code' => 'RU',
                'country_name' => 'Russian Federation',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            182 => 
            array (
                'id' => 183,
                'country_code' => 'RW',
                'country_name' => 'Rwanda',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            183 => 
            array (
                'id' => 184,
                'country_code' => 'KN',
                'country_name' => 'Saint Kitts and Nevis',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            184 => 
            array (
                'id' => 185,
                'country_code' => 'LC',
                'country_name' => 'Saint Lucia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            185 => 
            array (
                'id' => 186,
                'country_code' => 'VC',
                'country_name' => 'Saint Vincent and the Grenadines',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            186 => 
            array (
                'id' => 187,
                'country_code' => 'WS',
                'country_name' => 'Samoa',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            187 => 
            array (
                'id' => 188,
                'country_code' => 'SM',
                'country_name' => 'San Marino',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            188 => 
            array (
                'id' => 189,
                'country_code' => 'ST',
                'country_name' => 'Sao Tome and Principe',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            189 => 
            array (
                'id' => 190,
                'country_code' => 'SA',
                'country_name' => 'Saudi Arabia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            190 => 
            array (
                'id' => 191,
                'country_code' => 'SN',
                'country_name' => 'Senegal',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            191 => 
            array (
                'id' => 192,
                'country_code' => 'RS',
                'country_name' => 'Serbia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            192 => 
            array (
                'id' => 193,
                'country_code' => 'SC',
                'country_name' => 'Seychelles',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            193 => 
            array (
                'id' => 194,
                'country_code' => 'SL',
                'country_name' => 'Sierra Leone',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            194 => 
            array (
                'id' => 195,
                'country_code' => 'SG',
                'country_name' => 'Singapore',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            195 => 
            array (
                'id' => 196,
                'country_code' => 'SK',
                'country_name' => 'Slovakia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            196 => 
            array (
                'id' => 197,
                'country_code' => 'SI',
                'country_name' => 'Slovenia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            197 => 
            array (
                'id' => 198,
                'country_code' => 'SB',
                'country_name' => 'Solomon Islands',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            198 => 
            array (
                'id' => 199,
                'country_code' => 'SO',
                'country_name' => 'Somalia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            199 => 
            array (
                'id' => 200,
                'country_code' => 'ZA',
                'country_name' => 'South Africa',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            200 => 
            array (
                'id' => 201,
                'country_code' => 'GS',
                'country_name' => 'South Georgia South Sandwich Islands',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            201 => 
            array (
                'id' => 202,
                'country_code' => 'SS',
                'country_name' => 'South Sudan',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            202 => 
            array (
                'id' => 203,
                'country_code' => 'ES',
                'country_name' => 'Spain',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            203 => 
            array (
                'id' => 204,
                'country_code' => 'LK',
                'country_name' => 'Sri Lanka',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            204 => 
            array (
                'id' => 205,
                'country_code' => 'SH',
                'country_name' => 'St. Helena',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            205 => 
            array (
                'id' => 206,
                'country_code' => 'PM',
                'country_name' => 'St. Pierre and Miquelon',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            206 => 
            array (
                'id' => 207,
                'country_code' => 'SD',
                'country_name' => 'Sudan',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            207 => 
            array (
                'id' => 208,
                'country_code' => 'SR',
                'country_name' => 'Suriname',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            208 => 
            array (
                'id' => 209,
                'country_code' => 'SJ',
                'country_name' => 'Svalbard and Jan Mayen Islands',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            209 => 
            array (
                'id' => 210,
                'country_code' => 'SZ',
                'country_name' => 'Swaziland',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            210 => 
            array (
                'id' => 211,
                'country_code' => 'SE',
                'country_name' => 'Sweden',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            211 => 
            array (
                'id' => 212,
                'country_code' => 'CH',
                'country_name' => 'Switzerland',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            212 => 
            array (
                'id' => 213,
                'country_code' => 'SY',
                'country_name' => 'Syrian Arab Republic',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            213 => 
            array (
                'id' => 214,
                'country_code' => 'TW',
                'country_name' => 'Taiwan',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            214 => 
            array (
                'id' => 215,
                'country_code' => 'TJ',
                'country_name' => 'Tajikistan',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            215 => 
            array (
                'id' => 216,
                'country_code' => 'TZ',
                'country_name' => 'Tanzania, United Republic of',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            216 => 
            array (
                'id' => 217,
                'country_code' => 'TH',
                'country_name' => 'Thailand',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            217 => 
            array (
                'id' => 218,
                'country_code' => 'TG',
                'country_name' => 'Togo',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            218 => 
            array (
                'id' => 219,
                'country_code' => 'TK',
                'country_name' => 'Tokelau',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            219 => 
            array (
                'id' => 220,
                'country_code' => 'TO',
                'country_name' => 'Tonga',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            220 => 
            array (
                'id' => 221,
                'country_code' => 'TT',
                'country_name' => 'Trinidad and Tobago',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            221 => 
            array (
                'id' => 222,
                'country_code' => 'TN',
                'country_name' => 'Tunisia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            222 => 
            array (
                'id' => 223,
                'country_code' => 'TR',
                'country_name' => 'Turkey',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            223 => 
            array (
                'id' => 224,
                'country_code' => 'TM',
                'country_name' => 'Turkmenistan',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            224 => 
            array (
                'id' => 225,
                'country_code' => 'TC',
                'country_name' => 'Turks and Caicos Islands',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            225 => 
            array (
                'id' => 226,
                'country_code' => 'TV',
                'country_name' => 'Tuvalu',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            226 => 
            array (
                'id' => 227,
                'country_code' => 'UG',
                'country_name' => 'Uganda',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            227 => 
            array (
                'id' => 228,
                'country_code' => 'UA',
                'country_name' => 'Ukraine',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            228 => 
            array (
                'id' => 229,
                'country_code' => 'AE',
                'country_name' => 'United Arab Emirates',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            229 => 
            array (
                'id' => 230,
                'country_code' => 'GB',
                'country_name' => 'United Kingdom',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            230 => 
            array (
                'id' => 231,
                'country_code' => 'US',
                'country_name' => 'United States',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            231 => 
            array (
                'id' => 232,
                'country_code' => 'UM',
                'country_name' => 'United States minor outlying islands',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            232 => 
            array (
                'id' => 233,
                'country_code' => 'UY',
                'country_name' => 'Uruguay',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            233 => 
            array (
                'id' => 234,
                'country_code' => 'UZ',
                'country_name' => 'Uzbekistan',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            234 => 
            array (
                'id' => 235,
                'country_code' => 'VU',
                'country_name' => 'Vanuatu',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            235 => 
            array (
                'id' => 236,
                'country_code' => 'VA',
                'country_name' => 'Vatican City State',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            236 => 
            array (
                'id' => 237,
                'country_code' => 'VE',
                'country_name' => 'Venezuela',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            237 => 
            array (
                'id' => 238,
                'country_code' => 'VN',
                'country_name' => 'Vietnam',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            238 => 
            array (
                'id' => 239,
                'country_code' => 'VG',
            'country_name' => 'Virgin Islands (British)',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            239 => 
            array (
                'id' => 240,
                'country_code' => 'VI',
            'country_name' => 'Virgin Islands (U.S.)',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            240 => 
            array (
                'id' => 241,
                'country_code' => 'WF',
                'country_name' => 'Wallis and Futuna Islands',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            241 => 
            array (
                'id' => 242,
                'country_code' => 'EH',
                'country_name' => 'Western Sahara',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            242 => 
            array (
                'id' => 243,
                'country_code' => 'YE',
                'country_name' => 'Yemen',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            243 => 
            array (
                'id' => 244,
                'country_code' => 'ZR',
                'country_name' => 'Zaire',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            244 => 
            array (
                'id' => 245,
                'country_code' => 'ZM',
                'country_name' => 'Zambia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            245 => 
            array (
                'id' => 246,
                'country_code' => 'ZW',
                'country_name' => 'Zimbabwe',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        }
    }

    protected function country($field, $for)
    {
        return Country::firstOrNew([$field => $for]);
    }
}