<?php

use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('notifications')->delete();
        
        \DB::table('notifications')->insert(array (
            0 => 
            array (
                'id' => '02b5610f-4905-4c5c-8922-6c49e23258c4',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 4,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Booking Successfully","line":"Thank you for using our application!","n_type":"New Bookings"},"n_type":"New Bookings"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 06:03:43',
                'updated_at' => '2019-10-05 06:03:43',
                'n_type' => 'New Bookings',
            ),
            1 => 
            array (
                'id' => '13869456-f73c-4d0e-86ff-1e7ab099439a',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 3,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Booking Successfully","line":"Thank you for using our application!","n_type":"New Bookings"},"n_type":"New Bookings"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 06:04:31',
                'updated_at' => '2019-10-05 06:04:31',
                'n_type' => 'New Bookings',
            ),
            2 => 
            array (
                'id' => '25f306b7-b3d5-45d9-a4e8-36a3452e13fd',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Booking Successfully","line":"Thank you for using our application!","n_type":"New Bookings"},"n_type":"New Bookings"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 06:03:43',
                'updated_at' => '2019-10-05 06:03:43',
                'n_type' => 'New Bookings',
            ),
            3 => 
            array (
                'id' => '2896e702-4e67-4443-8225-254f9b3811d9',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 2,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Booking Successfully","line":"Thank you for using our application!","n_type":"New Bookings"},"n_type":"New Bookings"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 06:03:21',
                'updated_at' => '2019-10-05 06:03:21',
                'n_type' => 'New Bookings',
            ),
            4 => 
            array (
                'id' => '28f576af-438d-4e74-956e-133711117395',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 2,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Booking Successfully","line":"Thank you for using our application!","n_type":"New Bookings"},"n_type":"New Bookings"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 06:04:22',
                'updated_at' => '2019-10-05 06:04:22',
                'n_type' => 'New Bookings',
            ),
            5 => 
            array (
                'id' => '2b803691-30b4-4bf4-8408-42044020ef35',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Booking Successfully","line":"Thank you for using our application!","n_type":"New Bookings"},"n_type":"New Bookings"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 06:04:05',
                'updated_at' => '2019-10-05 06:04:05',
                'n_type' => 'New Bookings',
            ),
            6 => 
            array (
                'id' => '4106c2bd-1754-476b-bb68-250204aec4d2',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Booking Successfully","line":"Thank you for using our application!","n_type":"New Bookings"},"n_type":"New Bookings"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 06:03:56',
                'updated_at' => '2019-10-05 06:03:56',
                'n_type' => 'New Bookings',
            ),
            7 => 
            array (
                'id' => '46b3adce-ca9d-49fd-88ca-0d9e970646e8',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 4,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Booking Successfully","line":"Thank you for using our application!","n_type":"New Bookings"},"n_type":"New Bookings"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 06:04:39',
                'updated_at' => '2019-10-05 06:04:39',
                'n_type' => 'New Bookings',
            ),
            8 => 
            array (
                'id' => '4affce7f-8603-4ffc-a6d2-2b31ad51e987',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 2,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Booking Successfully","line":"Thank you for using our application!","n_type":"New Bookings"},"n_type":"New Bookings"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 06:11:09',
                'updated_at' => '2019-10-05 06:11:09',
                'n_type' => 'New Bookings',
            ),
            9 => 
            array (
                'id' => '4e43066b-8d5c-4301-ad80-8d90efac5617',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Booking Successfully","line":"Thank you for using our application!","n_type":"New Bookings"},"n_type":"New Bookings"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 06:05:01',
                'updated_at' => '2019-10-05 06:05:01',
                'n_type' => 'New Bookings',
            ),
            10 => 
            array (
                'id' => '57d74d78-faae-4fa2-97d9-7775014bfa0a',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Booking Successfully","line":"Thank you for using our application!","n_type":"New Bookings"},"n_type":"New Bookings"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 06:04:31',
                'updated_at' => '2019-10-05 06:04:31',
                'n_type' => 'New Bookings',
            ),
            11 => 
            array (
                'id' => '57e2cefd-0b1c-4ec7-a3ef-c0d1c6a581aa',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Event Created Successfully","line":"Thank you for using our application!","n_type":"New Events"},"n_type":"New Events"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 05:39:48',
                'updated_at' => '2019-10-05 05:39:48',
                'n_type' => 'New Events',
            ),
            12 => 
            array (
                'id' => '6938027e-5af2-4c4f-bb74-a1b25fbe8a86',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 5,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Booking Successfully","line":"Thank you for using our application!","n_type":"New Bookings"},"n_type":"New Bookings"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 06:04:05',
                'updated_at' => '2019-10-05 06:04:05',
                'n_type' => 'New Bookings',
            ),
            13 => 
            array (
                'id' => '6cf97e72-8696-4514-82b6-bc1ce5205ad9',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Booking Successfully","line":"Thank you for using our application!","n_type":"New Bookings"},"n_type":"New Bookings"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 06:03:21',
                'updated_at' => '2019-10-05 06:03:21',
                'n_type' => 'New Bookings',
            ),
            14 => 
            array (
                'id' => '6e24a032-bb89-4084-bef8-31e5a04d1690',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 4,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Booking Successfully","line":"Thank you for using our application!","n_type":"New Bookings"},"n_type":"New Bookings"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 06:05:10',
                'updated_at' => '2019-10-05 06:05:10',
                'n_type' => 'New Bookings',
            ),
            15 => 
            array (
                'id' => '6eaa2b3e-7f81-4577-a3a7-4acc4e25fcf5',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 3,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Booking Successfully","line":"Thank you for using our application!","n_type":"New Bookings"},"n_type":"New Bookings"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 06:05:01',
                'updated_at' => '2019-10-05 06:05:01',
                'n_type' => 'New Bookings',
            ),
            16 => 
            array (
                'id' => '75e0439d-8e30-44eb-8c79-d00353d82fcc',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 3,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Booking Successfully","line":"Thank you for using our application!","n_type":"New Bookings"},"n_type":"New Bookings"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 06:03:34',
                'updated_at' => '2019-10-05 06:03:34',
                'n_type' => 'New Bookings',
            ),
            17 => 
            array (
                'id' => 'a1951fca-03cd-4b38-b6bb-a4bbf054ace0',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Booking Successfully","line":"Thank you for using our application!","n_type":"New Bookings"},"n_type":"New Bookings"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 06:11:09',
                'updated_at' => '2019-10-05 06:11:09',
                'n_type' => 'New Bookings',
            ),
            18 => 
            array (
                'id' => 'a414c575-4ea3-45fe-bbc9-ae6018f629fa',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 5,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Booking Successfully","line":"Thank you for using our application!","n_type":"New Bookings"},"n_type":"New Bookings"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 06:04:48',
                'updated_at' => '2019-10-05 06:04:48',
                'n_type' => 'New Bookings',
            ),
            19 => 
            array (
                'id' => 'b3c6c5b8-5de6-411f-815f-6a007cea3fc5',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 4,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Booking Successfully","line":"Thank you for using our application!","n_type":"New Bookings"},"n_type":"New Bookings"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 06:03:56',
                'updated_at' => '2019-10-05 06:03:56',
                'n_type' => 'New Bookings',
            ),
            20 => 
            array (
                'id' => 'b707eb41-f076-439b-9e10-f8135e3b0663',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Booking Successfully","line":"Thank you for using our application!","n_type":"New Bookings"},"n_type":"New Bookings"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 06:04:39',
                'updated_at' => '2019-10-05 06:04:39',
                'n_type' => 'New Bookings',
            ),
            21 => 
            array (
                'id' => 'd201240c-6ac0-4be5-8126-3154e7c759f7',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Booking Successfully","line":"Thank you for using our application!","n_type":"New Bookings"},"n_type":"New Bookings"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 06:03:34',
                'updated_at' => '2019-10-05 06:03:34',
                'n_type' => 'New Bookings',
            ),
            22 => 
            array (
                'id' => 'd25a150d-86b0-49d3-9ada-602f7fcc80c1',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Booking Successfully","line":"Thank you for using our application!","n_type":"New Bookings"},"n_type":"New Bookings"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 06:05:10',
                'updated_at' => '2019-10-05 06:05:10',
                'n_type' => 'New Bookings',
            ),
            23 => 
            array (
                'id' => 'f418ef5f-65d1-4769-965b-7df8552a6ac0',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 2,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Booking Successfully","line":"Thank you for using our application!","n_type":"New Bookings"},"n_type":"New Bookings"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 06:11:33',
                'updated_at' => '2019-10-05 06:11:33',
                'n_type' => 'New Bookings',
            ),
            24 => 
            array (
                'id' => 'fd396635-575d-423d-abd4-f166d4e16363',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Booking Successfully","line":"Thank you for using our application!","n_type":"New Bookings"},"n_type":"New Bookings"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 06:11:33',
                'updated_at' => '2019-10-05 06:11:33',
                'n_type' => 'New Bookings',
            ),
            25 => 
            array (
                'id' => 'fe1c942f-9846-4596-b84b-ae40be9141fd',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Booking Successfully","line":"Thank you for using our application!","n_type":"New Bookings"},"n_type":"New Bookings"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 06:04:22',
                'updated_at' => '2019-10-05 06:04:22',
                'n_type' => 'New Bookings',
            ),
            26 => 
            array (
                'id' => 'fe940a90-dedf-42c4-b28d-64801de754a8',
                'type' => 'Classiebit\\Eventmie\\Notifications\\MailNotification',
                'notifiable_type' => 'Classiebit\\Eventmie\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"notification":{"mail_message":"Email message body","greeting":"Greetings","mail_subject":"Booking Successfully","line":"Thank you for using our application!","n_type":"New Bookings"},"n_type":"New Bookings"}',
                'read_at' => NULL,
                'created_at' => '2019-10-05 06:04:48',
                'updated_at' => '2019-10-05 06:04:48',
                'n_type' => 'New Bookings',
            ),
        ));
        
        
    }
}