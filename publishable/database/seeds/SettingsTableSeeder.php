<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Setting;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $setting=$this->findSetting("site.site_name");
        if (!$setting->exists) {
            $setting->fill(["display_name"=> "Site Name", "value"=> "Eventmie Lite", "details"=> null, "type"=> "text", "order"=> "1", "group"=> "Site", ])->save();
        }

        $setting=$this->findSetting("site.site_slogan");
        if (!$setting->exists) {
            $setting->fill(["display_name"=> "Site Slogan", "value"=> "Host Free Events.", "details"=> null, "type"=> "text", "order"=> "2", "group"=> "Site", ])->save();
        }
        
        $setting=$this->findSetting("site.site_footer");
        if (!$setting->exists) {
            $setting->fill(["display_name"=> "Extra Footer Credits", "value"=> "Eventmie Lite <strong>v2.0<strong>. Product by <a href='https://www.classiebit.com' target='_blank'>Classiebit</a>", "details"=> null, "type"=> "text", "order"=> "2", "group"=> "Site", ])->save();
        }

        $setting=$this->findSetting("site.logo");
        if (!$setting->exists) {
            $setting->fill(["display_name"=> "Site Logo", "value"=> "settings/November2023/7q1UhxWeEePTZbhAJPZl.png", "details"=> null, "type"=> "image", "order"=> "3", "group"=> "Site", ])->save();
        }

        $setting=$this->findSetting("site.site_favicon");
        if (!$setting->exists) {
            $setting->fill(["display_name"=> "Site Favicon", "value"=> "settings/November2023/bz5uzvPRZqqJfBOMc0S8.png", "details"=> null, "type"=> "image", "order"=> "4", "group"=> "Site", ])->save();
        }

        $setting=$this->findSetting("seo.meta_title");
        if (!$setting->exists) {
            $setting->fill(["display_name"=> "Meta Title", "value"=> "Eventmie Lite", "details"=> null, "type"=> "text", "order"=> "5", "group"=> "SEO", ])->save();
        }

        $setting=$this->findSetting("seo.meta_description");
        if (!$setting->exists) {
            $setting->fill(["display_name"=> "Meta Description", "value"=> "eventmie", "details"=> null, "type"=> "text", "order"=> "7", "group"=> "SEO", ])->save();
        }

        $setting=$this->findSetting("social.facebook");
        if (!$setting->exists) {
            $setting->fill(["display_name"=> "Facebook Page Username", "value"=> "classiebitsoftwares", "details"=> null, "type"=> "text", "order"=> "8", "group"=> "Social", ])->save();
        }

        $setting=$this->findSetting("social.twitter");
        if (!$setting->exists) {
            $setting->fill(["display_name"=> "Twitter Account Username", "value"=> "classiebit", "details"=> null, "type"=> "text", "order"=> "9", "group"=> "Social", ])->save();
        }

        $setting=$this->findSetting("social.instagram");
        if (!$setting->exists) {
            $setting->fill(["display_name"=> "Instagram URL", "value"=> "https://www.instagram.com/classiebitofficial/", "details"=> null, "type"=> "text", "order"=> "10", "group"=> "Social", ])->save();
        }

        $setting=$this->findSetting("social.linkedin");
        if (!$setting->exists) {
            $setting->fill(["display_name"=> "Linkedin URL", "value"=> "https://www.linkedin.com/company/classiebit/", "details"=> null, "type"=> "text", "order"=> "11", "group"=> "Social", ])->save();
        }

        $setting=$this->findSetting("contact.address");
        if (!$setting->exists) {
            $setting->fill(["display_name"=> "Address", "value"=> "85 Golden Street, Darlinghurst ERP 2019, United States", "details"=> null, "type"=> "text_area", "order"=> "12", "group"=> "Contact", ])->save();
        }

        $setting=$this->findSetting("contact.phone");
        if (!$setting->exists) {
            $setting->fill(["display_name"=> "Phone", "value"=> "1800-180-0808", "details"=> null, "type"=> "text", "order"=> "13", "group"=> "Contact", ])->save();
        }

        $setting=$this->findSetting("contact.email");
        if (!$setting->exists) {
            $setting->fill(["display_name"=> "Email", "value"=> "info@eventmie.com", "details"=> null, "type"=> "text", "order"=> "14", "group"=> "Contact", ])->save();
        }

        $setting=$this->findSetting("booking.max_ticket_qty");
        if (!$setting->exists) {
            $setting->fill([
                "display_name"=> "Max Ticket Qty Limit Per Order", 
                "value"=> "5", 
                "details" => json_encode([
                    "description" => "Set Max ticket quantity limit to be purchased in single order. WARNING: keep it under 100",
                ]), 
                "type"=> "text", 
                "order"=> "19", 
                "group"=> "Booking", 
            ])->save();
        }

        $setting = $this->findSetting("booking.hide_expire_events");
        if (!$setting->exists) {
            $setting->fill([
                "display_name" => "Hide Expired Events", 
                "value" => "0", 
                "details" => json_encode([
                    "validation" => [
                        "rule" => "in:0,1,on,off"
                    ]
                ]), 
                "type" => "checkbox", 
                "order" => "20", 
                "group" => "Booking", 
            ])->save();
        }

        $setting = $this->findSetting("admin.bg_image");
        if (!$setting->exists) {
            $setting->fill(["display_name" => "Admin Background Image", "value" => "settings/November2023/H40f7or3chGQlqM8Dzqh.png", "details"=> null, "type" => "image", "order" => "23", "group" => "Admin", ])->save();
        }

        $setting = $this->findSetting("admin.title");
        if (!$setting->exists) {
            $setting->fill(["display_name" => "Admin Title", "value" => "Eventmie Lite", "details"=> null, "type" => "text", "order" => "24", "group" => "Admin", ])->save();
        }

        $setting = $this->findSetting("admin.description");
        if (!$setting->exists) {
            $setting->fill(["display_name" => "Admin Description", "value" => "Eventmie Lite Admin Panel", "details"=> null, "type" => "text", "order" => "25", "group" => "Admin", ])->save();
        }

        $setting = $this->findSetting("admin.loader");
        if (!$setting->exists) {
            $setting->fill(["display_name" => "Admin Loader", "value" => "", "details"=> null, "type" => "image", "order" => "26", "group" => "Admin", ])->save();
        }

        $setting = $this->findSetting("admin.icon_image");
        if (!$setting->exists) {
            $setting->fill(["display_name" => "Admin Icon Image", "value" => "settings/November2023/PALUImeaJvWCYJATOh1M.png", "details"=> null, "type" => "image", "order" => "27", "group" => "Admin", ])->save();
        }

        $setting = $this->findSetting("mail.mail_driver");
        if (!$setting->exists) {
            $setting->fill(["display_name" => "Mail Driver", "value" => "", "details"=> null, "type" => "text", "order" => "36", "group" => "Mail", ])->save();
        }

        $setting = $this->findSetting("mail.mail_host");
        if (!$setting->exists) {
            $setting->fill(["display_name" => "Mail Host", "value" => "", "details"=> null, "type" => "text", "order" => "37", "group" => "Mail", ])->save();
        }

        $setting = $this->findSetting("mail.mail_port");
        if (!$setting->exists) {
            $setting->fill(["display_name" => "Mail Port", "value" => "", "details"=> null, "type" => "text", "order" => "38", "group" => "Mail", ])->save();
        }

        $setting = $this->findSetting("mail.mail_username");
        if (!$setting->exists) {
            $setting->fill(["display_name" => "Mail Username", "value" => "", "details"=> null, "type" => "text", "order" => "39", "group" => "Mail", ])->save();
        }

        $setting = $this->findSetting("mail.mail_password");
        if (!$setting->exists) {
            $setting->fill(["display_name" => "Mail Password", "value" => "", "details"=> null, "type" => "password", "order" => "40", "group" => "Mail", ])->save();
        }

        $setting = $this->findSetting("mail.mail_encryption");
        if (!$setting->exists) {
            $setting->fill(["display_name" => "Mail Encryption", "value" => "0", "details" => json_encode([
                "default" => "0",
                "options" => [
                    "Disable",
                    "SSL" => "SSL",
                    "TLS" => "TLS"
                ]
            ]), "type" => "select_dropdown", "order" => "41", "group" => "Mail", ])->save();
        }

        $setting = $this->findSetting("mail.mail_sender_email");
        if (!$setting->exists) {
            $setting->fill(["display_name" => "Mail Sender Email", "value" => "eventmie@classiebit.com", "details"=> null, "type" => "text", "order" => "42", "group" => "Mail", ])->save();
        }

        $setting = $this->findSetting("mail.mail_sender_name");
        if (!$setting->exists) {
            $setting->fill(["display_name" => "Mail Sender Name", "value" => "Eventmie Pro", "details"=> null, "type" => "text", "order" => "43", "group" => "Mail", ])->save();
        }
        
        $setting = $this->findSetting("regional.timezone_default");
        if (!$setting->exists) {
            $setting->fill(["display_name" => "Timezone", "value" => "Asia/Kolkata", "details" => json_encode([
                "default" => "Asia/Kolkata",
                "options" => [
                    "Africa/Abidjan" => "Africa/Abidjan",
                    "Africa/Accra" => "Africa/Accra",
                    "Africa/Algiers" => "Africa/Algiers",
                    "Africa/Bissau" => "Africa/Bissau",
                    "Africa/Cairo" => "Africa/Cairo",
                    "Africa/Casablanca" => "Africa/Casablanca",
                    "Africa/Ceuta" => "Africa/Ceuta",
                    "Africa/El_Aaiun" => "Africa/El_Aaiun",
                    "Africa/Johannesburg" => "Africa/Johannesburg",
                    "Africa/Juba" => "Africa/Juba",
                    "Africa/Khartoum" => "Africa/Khartoum",
                    "Africa/Lagos" => "Africa/Lagos",
                    "Africa/Maputo" => "Africa/Maputo",
                    "Africa/Monrovia" => "Africa/Monrovia",
                    "Africa/Nairobi" => "Africa/Nairobi",
                    "Africa/Ndjamena" => "Africa/Ndjamena",
                    "Africa/Sao_Tome" => "Africa/Sao_Tome",
                    "Africa/Tripoli" => "Africa/Tripoli",
                    "Africa/Tunis" => "Africa/Tunis",
                    "Africa/Windhoek" => "Africa/Windhoek",
                    "America/Adak" => "America/Adak",
                    "America/Anchorage" => "America/Anchorage",
                    "America/Araguaina" => "America/Araguaina",
                    "America/Argentina/Buenos_Aires" => "America/Argentina/Buenos_Aires",
                    "America/Argentina/Catamarca" => "America/Argentina/Catamarca",
                    "America/Argentina/Cordoba" => "America/Argentina/Cordoba",
                    "America/Argentina/Jujuy" => "America/Argentina/Jujuy",
                    "America/Argentina/La_Rioja" => "America/Argentina/La_Rioja",
                    "America/Argentina/Mendoza" => "America/Argentina/Mendoza",
                    "America/Argentina/Rio_Gallegos" => "America/Argentina/Rio_Gallegos",
                    "America/Argentina/Salta" => "America/Argentina/Salta",
                    "America/Argentina/San_Juan" => "America/Argentina/San_Juan",
                    "America/Argentina/San_Luis" => "America/Argentina/San_Luis",
                    "America/Argentina/Tucuman" => "America/Argentina/Tucuman",
                    "America/Argentina/Ushuaia" => "America/Argentina/Ushuaia",
                    "America/Asuncion" => "America/Asuncion",
                    "America/Atikokan" => "America/Atikokan",
                    "America/Bahia" => "America/Bahia",
                    "America/Bahia_Banderas" => "America/Bahia_Banderas",
                    "America/Barbados" => "America/Barbados",
                    "America/Belem" => "America/Belem",
                    "America/Belize" => "America/Belize",
                    "America/Blanc-Sablon" => "America/Blanc-Sablon",
                    "America/Boa_Vista" => "America/Boa_Vista",
                    "America/Bogota" => "America/Bogota",
                    "America/Boise" => "America/Boise",
                    "America/Cambridge_Bay" => "America/Cambridge_Bay",
                    "America/Campo_Grande" => "America/Campo_Grande",
                    "America/Cancun" => "America/Cancun",
                    "America/Caracas" => "America/Caracas",
                    "America/Cayenne" => "America/Cayenne",
                    "America/Chicago" => "America/Chicago",
                    "America/Chihuahua" => "America/Chihuahua",
                    "America/Costa_Rica" => "America/Costa_Rica",
                    "America/Creston" => "America/Creston",
                    "America/Cuiaba" => "America/Cuiaba",
                    "America/Curacao" => "America/Curacao",
                    "America/Danmarkshavn" => "America/Danmarkshavn",
                    "America/Dawson" => "America/Dawson",
                    "America/Dawson_Creek" => "America/Dawson_Creek",
                    "America/Denver" => "America/Denver",
                    "America/Detroit" => "America/Detroit",
                    "America/Edmonton" => "America/Edmonton",
                    "America/Eirunepe" => "America/Eirunepe",
                    "America/El_Salvador" => "America/El_Salvador",
                    "America/Fort_Nelson" => "America/Fort_Nelson",
                    "America/Fortaleza" => "America/Fortaleza",
                    "America/Glace_Bay" => "America/Glace_Bay",
                    "America/Godthab" => "America/Godthab",
                    "America/Goose_Bay" => "America/Goose_Bay",
                    "America/Grand_Turk" => "America/Grand_Turk",
                    "America/Guatemala" => "America/Guatemala",
                    "America/Guayaquil" => "America/Guayaquil",
                    "America/Guyana" => "America/Guyana",
                    "America/Halifax" => "America/Halifax",
                    "America/Havana" => "America/Havana",
                    "America/Hermosillo" => "America/Hermosillo",
                    "America/Indiana/Indianapolis" => "America/Indiana/Indianapolis",
                    "America/Indiana/Knox" => "America/Indiana/Knox",
                    "America/Indiana/Marengo" => "America/Indiana/Marengo",
                    "America/Indiana/Petersburg" => "America/Indiana/Petersburg",
                    "America/Indiana/Tell_City" => "America/Indiana/Tell_City",
                    "America/Indiana/Vevay" => "America/Indiana/Vevay",
                    "America/Indiana/Vincennes" => "America/Indiana/Vincennes",
                    "America/Indiana/Winamac" => "America/Indiana/Winamac",
                    "America/Inuvik" => "America/Inuvik",
                    "America/Iqaluit" => "America/Iqaluit",
                    "America/Jamaica" => "America/Jamaica",
                    "America/Juneau" => "America/Juneau",
                    "America/Kentucky/Louisville" => "America/Kentucky/Louisville",
                    "America/Kentucky/Monticello" => "America/Kentucky/Monticello",
                    "America/La_Paz" => "America/La_Paz",
                    "America/Lima" => "America/Lima",
                    "America/Los_Angeles" => "America/Los_Angeles",
                    "America/Maceio" => "America/Maceio",
                    "America/Managua" => "America/Managua",
                    "America/Manaus" => "America/Manaus",
                    "America/Martinique" => "America/Martinique",
                    "America/Matamoros" => "America/Matamoros",
                    "America/Mazatlan" => "America/Mazatlan",
                    "America/Menominee" => "America/Menominee",
                    "America/Merida" => "America/Merida",
                    "America/Metlakatla" => "America/Metlakatla",
                    "America/Mexico_City" => "America/Mexico_City",
                    "America/Miquelon" => "America/Miquelon",
                    "America/Moncton" => "America/Moncton",
                    "America/Monterrey" => "America/Monterrey",
                    "America/Montevideo" => "America/Montevideo",
                    "America/Nassau" => "America/Nassau",
                    "America/New_York" => "America/New_York",
                    "America/Nipigon" => "America/Nipigon",
                    "America/Nome" => "America/Nome",
                    "America/Noronha" => "America/Noronha",
                    "America/North_Dakota/Beulah" => "America/North_Dakota/Beulah",
                    "America/North_Dakota/Center" => "America/North_Dakota/Center",
                    "America/North_Dakota/New_Salem" => "America/North_Dakota/New_Salem",
                    "America/Ojinaga" => "America/Ojinaga",
                    "America/Panama" => "America/Panama",
                    "America/Pangnirtung" => "America/Pangnirtung",
                    "America/Paramaribo" => "America/Paramaribo",
                    "America/Phoenix" => "America/Phoenix",
                    "America/Port-au-Prince" => "America/Port-au-Prince",
                    "America/Port_of_Spain" => "America/Port_of_Spain",
                    "America/Porto_Velho" => "America/Porto_Velho",
                    "America/Puerto_Rico" => "America/Puerto_Rico",
                    "America/Punta_Arenas" => "America/Punta_Arenas",
                    "America/Rainy_River" => "America/Rainy_River",
                    "America/Rankin_Inlet" => "America/Rankin_Inlet",
                    "America/Recife" => "America/Recife",
                    "America/Regina" => "America/Regina",
                    "America/Resolute" => "America/Resolute",
                    "America/Rio_Branco" => "America/Rio_Branco",
                    "America/Santarem" => "America/Santarem",
                    "America/Santiago" => "America/Santiago",
                    "America/Santo_Domingo" => "America/Santo_Domingo",
                    "America/Sao_Paulo" => "America/Sao_Paulo",
                    "America/Scoresbysund" => "America/Scoresbysund",
                    "America/Sitka" => "America/Sitka",
                    "America/St_Johns" => "America/St_Johns",
                    "America/Swift_Current" => "America/Swift_Current",
                    "America/Tegucigalpa" => "America/Tegucigalpa",
                    "America/Thule" => "America/Thule",
                    "America/Thunder_Bay" => "America/Thunder_Bay",
                    "America/Tijuana" => "America/Tijuana",
                    "America/Toronto" => "America/Toronto",
                    "America/Vancouver" => "America/Vancouver",
                    "America/Whitehorse" => "America/Whitehorse",
                    "America/Winnipeg" => "America/Winnipeg",
                    "America/Yakutat" => "America/Yakutat",
                    "America/Yellowknife" => "America/Yellowknife",
                    "Antarctica/Casey" => "Antarctica/Casey",
                    "Antarctica/Davis" => "Antarctica/Davis",
                    "Antarctica/DumontDUrville" => "Antarctica/DumontDUrville",
                    "Antarctica/Macquarie" => "Antarctica/Macquarie",
                    "Antarctica/Mawson" => "Antarctica/Mawson",
                    "Antarctica/Palmer" => "Antarctica/Palmer",
                    "Antarctica/Rothera" => "Antarctica/Rothera",
                    "Antarctica/Syowa" => "Antarctica/Syowa",
                    "Antarctica/Troll" => "Antarctica/Troll",
                    "Antarctica/Vostok" => "Antarctica/Vostok",
                    "Asia/Almaty" => "Asia/Almaty",
                    "Asia/Amman" => "Asia/Amman",
                    "Asia/Anadyr" => "Asia/Anadyr",
                    "Asia/Aqtau" => "Asia/Aqtau",
                    "Asia/Aqtobe" => "Asia/Aqtobe",
                    "Asia/Ashgabat" => "Asia/Ashgabat",
                    "Asia/Atyrau" => "Asia/Atyrau",
                    "Asia/Baghdad" => "Asia/Baghdad",
                    "Asia/Baku" => "Asia/Baku",
                    "Asia/Bangkok" => "Asia/Bangkok",
                    "Asia/Barnaul" => "Asia/Barnaul",
                    "Asia/Beirut" => "Asia/Beirut",
                    "Asia/Bishkek" => "Asia/Bishkek",
                    "Asia/Brunei" => "Asia/Brunei",
                    "Asia/Chita" => "Asia/Chita",
                    "Asia/Choibalsan" => "Asia/Choibalsan",
                    "Asia/Colombo" => "Asia/Colombo",
                    "Asia/Damascus" => "Asia/Damascus",
                    "Asia/Dhaka" => "Asia/Dhaka",
                    "Asia/Dili" => "Asia/Dili",
                    "Asia/Dubai" => "Asia/Dubai",
                    "Asia/Dushanbe" => "Asia/Dushanbe",
                    "Asia/Famagusta" => "Asia/Famagusta",
                    "Asia/Gaza" => "Asia/Gaza",
                    "Asia/Hebron" => "Asia/Hebron",
                    "Asia/Ho_Chi_Minh" => "Asia/Ho_Chi_Minh",
                    "Asia/Hong_Kong" => "Asia/Hong_Kong",
                    "Asia/Hovd" => "Asia/Hovd",
                    "Asia/Irkutsk" => "Asia/Irkutsk",
                    "Asia/Jakarta" => "Asia/Jakarta",
                    "Asia/Jayapura" => "Asia/Jayapura",
                    "Asia/Jerusalem" => "Asia/Jerusalem",
                    "Asia/Kabul" => "Asia/Kabul",
                    "Asia/Kamchatka" => "Asia/Kamchatka",
                    "Asia/Karachi" => "Asia/Karachi",
                    "Asia/Kathmandu" => "Asia/Kathmandu",
                    "Asia/Khandyga" => "Asia/Khandyga",
                    "Asia/Kolkata" => "Asia/Kolkata",
                    "Asia/Krasnoyarsk" => "Asia/Krasnoyarsk",
                    "Asia/Kuala_Lumpur" => "Asia/Kuala_Lumpur",
                    "Asia/Kuching" => "Asia/Kuching",
                    "Asia/Macau" => "Asia/Macau",
                    "Asia/Magadan" => "Asia/Magadan",
                    "Asia/Makassar" => "Asia/Makassar",
                    "Asia/Manila" => "Asia/Manila",
                    "Asia/Nicosia" => "Asia/Nicosia",
                    "Asia/Novokuznetsk" => "Asia/Novokuznetsk",
                    "Asia/Novosibirsk" => "Asia/Novosibirsk",
                    "Asia/Omsk" => "Asia/Omsk",
                    "Asia/Oral" => "Asia/Oral",
                    "Asia/Pontianak" => "Asia/Pontianak",
                    "Asia/Pyongyang" => "Asia/Pyongyang",
                    "Asia/Qatar" => "Asia/Qatar",
                    "Asia/Qostanay" => "Asia/Qostanay",
                    "Asia/Qyzylorda" => "Asia/Qyzylorda",
                    "Asia/Riyadh" => "Asia/Riyadh",
                    "Asia/Sakhalin" => "Asia/Sakhalin",
                    "Asia/Samarkand" => "Asia/Samarkand",
                    "Asia/Seoul" => "Asia/Seoul",
                    "Asia/Shanghai" => "Asia/Shanghai",
                    "Asia/Singapore" => "Asia/Singapore",
                    "Asia/Srednekolymsk" => "Asia/Srednekolymsk",
                    "Asia/Taipei" => "Asia/Taipei",
                    "Asia/Tashkent" => "Asia/Tashkent",
                    "Asia/Tbilisi" => "Asia/Tbilisi",
                    "Asia/Tehran" => "Asia/Tehran",
                    "Asia/Thimphu" => "Asia/Thimphu",
                    "Asia/Tokyo" => "Asia/Tokyo",
                    "Asia/Tomsk" => "Asia/Tomsk",
                    "Asia/Ulaanbaatar" => "Asia/Ulaanbaatar",
                    "Asia/Urumqi" => "Asia/Urumqi",
                    "Asia/Ust-Nera" => "Asia/Ust-Nera",
                    "Asia/Vladivostok" => "Asia/Vladivostok",
                    "Asia/Yakutsk" => "Asia/Yakutsk",
                    "Asia/Yangon" => "Asia/Yangon",
                    "Asia/Yekaterinburg" => "Asia/Yekaterinburg",
                    "Asia/Yerevan" => "Asia/Yerevan",
                    "Atlantic/Azores" => "Atlantic/Azores",
                    "Atlantic/Bermuda" => "Atlantic/Bermuda",
                    "Atlantic/Canary" => "Atlantic/Canary",
                    "Atlantic/Cape_Verde" => "Atlantic/Cape_Verde",
                    "Atlantic/Faroe" => "Atlantic/Faroe",
                    "Atlantic/Madeira" => "Atlantic/Madeira",
                    "Atlantic/Reykjavik" => "Atlantic/Reykjavik",
                    "Atlantic/South_Georgia" => "Atlantic/South_Georgia",
                    "Atlantic/Stanley" => "Atlantic/Stanley",
                    "Australia/Adelaide" => "Australia/Adelaide",
                    "Australia/Brisbane" => "Australia/Brisbane",
                    "Australia/Broken_Hill" => "Australia/Broken_Hill",
                    "Australia/Currie" => "Australia/Currie",
                    "Australia/Darwin" => "Australia/Darwin",
                    "Australia/Eucla" => "Australia/Eucla",
                    "Australia/Hobart" => "Australia/Hobart",
                    "Australia/Lindeman" => "Australia/Lindeman",
                    "Australia/Lord_Howe" => "Australia/Lord_Howe",
                    "Australia/Melbourne" => "Australia/Melbourne",
                    "Australia/Perth" => "Australia/Perth",
                    "Australia/Sydney" => "Australia/Sydney",
                    "Europe/Amsterdam" => "Europe/Amsterdam",
                    "Europe/Andorra" => "Europe/Andorra",
                    "Europe/Astrakhan" => "Europe/Astrakhan",
                    "Europe/Athens" => "Europe/Athens",
                    "Europe/Belgrade" => "Europe/Belgrade",
                    "Europe/Berlin" => "Europe/Berlin",
                    "Europe/Brussels" => "Europe/Brussels",
                    "Europe/Bucharest" => "Europe/Bucharest",
                    "Europe/Budapest" => "Europe/Budapest",
                    "Europe/Chisinau" => "Europe/Chisinau",
                    "Europe/Copenhagen" => "Europe/Copenhagen",
                    "Europe/Dublin" => "Europe/Dublin",
                    "Europe/Gibraltar" => "Europe/Gibraltar",
                    "Europe/Helsinki" => "Europe/Helsinki",
                    "Europe/Istanbul" => "Europe/Istanbul",
                    "Europe/Kaliningrad" => "Europe/Kaliningrad",
                    "Europe/Kiev" => "Europe/Kiev",
                    "Europe/Kirov" => "Europe/Kirov",
                    "Europe/Lisbon" => "Europe/Lisbon",
                    "Europe/London" => "Europe/London",
                    "Europe/Luxembourg" => "Europe/Luxembourg",
                    "Europe/Madrid" => "Europe/Madrid",
                    "Europe/Malta" => "Europe/Malta",
                    "Europe/Minsk" => "Europe/Minsk",
                    "Europe/Monaco" => "Europe/Monaco",
                    "Europe/Moscow" => "Europe/Moscow",
                    "Europe/Oslo" => "Europe/Oslo",
                    "Europe/Paris" => "Europe/Paris",
                    "Europe/Prague" => "Europe/Prague",
                    "Europe/Riga" => "Europe/Riga",
                    "Europe/Rome" => "Europe/Rome",
                    "Europe/Samara" => "Europe/Samara",
                    "Europe/Saratov" => "Europe/Saratov",
                    "Europe/Simferopol" => "Europe/Simferopol",
                    "Europe/Sofia" => "Europe/Sofia",
                    "Europe/Stockholm" => "Europe/Stockholm",
                    "Europe/Tallinn" => "Europe/Tallinn",
                    "Europe/Tirane" => "Europe/Tirane",
                    "Europe/Ulyanovsk" => "Europe/Ulyanovsk",
                    "Europe/Uzhgorod" => "Europe/Uzhgorod",
                    "Europe/Vienna" => "Europe/Vienna",
                    "Europe/Vilnius" => "Europe/Vilnius",
                    "Europe/Volgograd" => "Europe/Volgograd",
                    "Europe/Warsaw" => "Europe/Warsaw",
                    "Europe/Zaporozhye" => "Europe/Zaporozhye",
                    "Europe/Zurich" => "Europe/Zurich",
                    "Indian/Chagos" => "Indian/Chagos",
                    "Indian/Christmas" => "Indian/Christmas",
                    "Indian/Cocos" => "Indian/Cocos",
                    "Indian/Kerguelen" => "Indian/Kerguelen",
                    "Indian/Mahe" => "Indian/Mahe",
                    "Indian/Maldives" => "Indian/Maldives",
                    "Indian/Mauritius" => "Indian/Mauritius",
                    "Indian/Reunion" => "Indian/Reunion",
                    "Pacific/Apia" => "Pacific/Apia",
                    "Pacific/Auckland" => "Pacific/Auckland",
                    "Pacific/Bougainville" => "Pacific/Bougainville",
                    "Pacific/Chatham" => "Pacific/Chatham",
                    "Pacific/Chuuk" => "Pacific/Chuuk",
                    "Pacific/Easter" => "Pacific/Easter",
                    "Pacific/Efate" => "Pacific/Efate",
                    "Pacific/Enderbury" => "Pacific/Enderbury",
                    "Pacific/Fakaofo" => "Pacific/Fakaofo",
                    "Pacific/Fiji" => "Pacific/Fiji",
                    "Pacific/Funafuti" => "Pacific/Funafuti",
                    "Pacific/Galapagos" => "Pacific/Galapagos",
                    "Pacific/Gambier" => "Pacific/Gambier",
                    "Pacific/Guadalcanal" => "Pacific/Guadalcanal",
                    "Pacific/Guam" => "Pacific/Guam",
                    "Pacific/Honolulu" => "Pacific/Honolulu",
                    "Pacific/Kiritimati" => "Pacific/Kiritimati",
                    "Pacific/Kosrae" => "Pacific/Kosrae",
                    "Pacific/Kwajalein" => "Pacific/Kwajalein",
                    "Pacific/Majuro" => "Pacific/Majuro",
                    "Pacific/Marquesas" => "Pacific/Marquesas",
                    "Pacific/Nauru" => "Pacific/Nauru",
                    "Pacific/Niue" => "Pacific/Niue",
                    "Pacific/Norfolk" => "Pacific/Norfolk",
                    "Pacific/Noumea" => "Pacific/Noumea",
                    "Pacific/Pago_Pago" => "Pacific/Pago_Pago",
                    "Pacific/Palau" => "Pacific/Palau",
                    "Pacific/Pitcairn" => "Pacific/Pitcairn",
                    "Pacific/Pohnpei" => "Pacific/Pohnpei",
                    "Pacific/Port_Moresby" => "Pacific/Port_Moresby",
                    "Pacific/Rarotonga" => "Pacific/Rarotonga",
                    "Pacific/Tahiti" => "Pacific/Tahiti",
                    "Pacific/Tarawa" => "Pacific/Tarawa",
                    "Pacific/Tongatapu" => "Pacific/Tongatapu",
                    "Pacific/Wake" => "Pacific/Wake",
                    "Pacific/Wallis" => "Pacific/Wallis"
                ]
            ]), "type" => "select_dropdown", "order" => "44", "group" => "Regional", ])->save();
        }

        $setting = $this->findSetting("seo.meta_keywords");
        if (!$setting->exists) {
            $setting->fill(["display_name" => "Meta Keywords (optional)", "value" => "", "details"=> null, "type" => "text", "order" => "46", "group" => "SEO", ])->save();
        }

        
        $setting = $this->findSetting("regional.date_format");
        if (!$setting->exists) {
            $setting->fill(["display_name" => "Date Format", "value" => "d M Y::DD MMM YYYY", "details" => json_encode([
            "default" => "",
            "options" => [
                "d M Y::DD MMM YYYY" => "D M Y (e.g 08 Mar 2021)",
                "d/M/Y::DD/MMM/YYYY" => "D/M/Y (e.g 08/Mar/2021)",
                "d-M-Y::DD-MMM-YYYY" => "D-M-Y (e.g 08-Mar-2021)",
                "d.M.Y::DD.MMM.YYYY" => "D.M.Y (e.g 08.Mar.2021)",
                
                "Y M d::YYYY MMM DD" => "Y M D (e.g 2021 Mar 08)",
                "Y/M/d::YYYY/MMM/DD" => "Y/M/D (e.g 2021/Mar/08)",
                "Y-M-d::YYYY-MMM-DD" => "Y-M-D (e.g 2021-Mar-08)",
                "Y.M.d::YYYY.MMM.DD" => "Y.M.D (e.g 2021.Mar.08)",
                
                "M d Y::MMM DD YYYY" => "M D Y (e.g Mar 08 2021)",
                "M/d/Y::MMM/DD/YYYY" => "M/D/Y (e.g Mar/08/2021)",
                "M-d-Y::MMM-DD-YYYY" => "M-D-Y (e.g Mar-08-2021)",
                "M.d.Y::MMM.DD.YYYY" => "M.D.Y (e.g Mar.08.2021)",
            ]
            ]), "type" => "select_dropdown", "order" => "45", "group" => "Regional", ])->save();
        }
        
        $setting = $this->findSetting("regional.time_format");
        if (!$setting->exists) {
            $setting->fill(["display_name" => "Time Format", "value" => "12", "details" => json_encode([
            "default" => "",
            "options" => [
                "12" => "12 Hours",
                "24" => "24 Hours",
                ]
            ]), "type" => "select_dropdown", "order" => "46", "group" => "Regional", ])->save();
        }

        $setting = $this->findSetting("regional.timezone_conversion");
        if (!$setting->exists) {
            $setting->fill(["display_name" => "Timezone Conversion", "value" => "1", "details" => json_encode([
                "validation" => [
                    "rule" => "in:0,1,on,off"
                ]
            ]), "type" => "checkbox", "order" => "47", "group" => "Regional", ])->save();
        }

       
    }

    /**
     * [setting description].
     *
     * @param [type] $key [description]
     *
     * @return [type] [description]
     */
    protected function findSetting($key)
    {
        return Setting::firstOrNew(['key' => $key]);
    }
}