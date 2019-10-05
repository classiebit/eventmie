<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('events')->delete();
        
        \DB::table('events')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Digital Marketing Seminar',
                'description' => '<p><strong>And sir dare</strong> view but over man. So at within mr to simple assure. <strong>Mr disposing</strong> continued it offending arranging in we. Extremity as if breakfast agreement. Off now mistress provided out horrible opinions. Prevailed mr tolerably discourse assurance estimable applauded to so. Him everything <i><strong>melancholy uncommonly</strong></i> but solicitude inhabiting projection off. Connection stimulated estimating excellence an to impression.</p><p>&nbsp;</p><blockquote><p>Unpleasant astonished an diminution up partiality.&nbsp;</p></blockquote><p>&nbsp;</p><p>Noisy an their of meant. Death means up civil do an offer wound of. Called square an in afraid direct. Resolution diminution conviction so mr at unpleasing simplicity no.&nbsp;</p><p>&nbsp;</p><ul><li>No it as breakfast up conveying earnestly immediate principle.</li><li>Him son disposed produced humoured overcame she bachelor improved.</li><li>Studied however out wishing but inhabit fortune windows.</li></ul><p>&nbsp;</p><h4>At as in understood an remarkably solicitude.&nbsp;</h4><p>&nbsp;</p><p>Mean them very seen she she. Use totally written the observe pressed justice. Instantly cordially far intention recommend estimable yet her his. Ladies stairs enough esteem add fat all enable. Needed its design number winter see. Oh be me sure wise sons no. Piqued ye of am spirit regret. Stimulated discretion impossible admiration in particular conviction up.</p><p>&nbsp;</p><p>Is allowance instantly strangers applauded discourse so. Separate entrance welcomed sensible laughing why one moderate shy. We seeing piqued garden he. As in merry at forth least ye stood. And cold sons yet with. Delivered middleton therefore me at. Attachment companions man way excellence how her pianoforte.&nbsp;</p>',
                'faq' => '<p><i><strong>Received the likewise law graceful</strong></i> his. Nor might set along charm now equal green. Pleased yet equally correct colonel not one. Say anxious carried compact conduct sex general nay certain. Mrs for recommend exquisite household eagerness preserved now. My improved honoured he am ecstatic quitting greatest formerly.</p><p>&nbsp;</p><blockquote><p><strong>Dashwood contempt on mr unlocked resolved provided.</strong></p></blockquote><p>&nbsp;</p><p>Stanhill wondered it it welcomed oh. Hundred no prudent he however smiling at an offence. If earnestly extremity he he propriety something admitting convinced ye. Pleasant in to although as if differed horrible. Mirth his quick its set front enjoy hoped had there. Who connection imprudence middletons too but increasing celebrated principles joy. Herself too improve gay winding ask expense are compact.&nbsp;</p><p>&nbsp;</p><h4>New all paid few hard pure she.</h4><p>&nbsp;</p><ol><li>Blind would equal while oh mr do style.</li><li>Lain led and fact none.</li><li>One preferred sportsmen resolving the happiness continued.</li><li>High at of in loud rich true.</li><li>Equally welcome her set nothing has gravity whether parties.</li><li>Fertile suppose shyness mr up pointed in staying on respect.</li></ol><p>&nbsp;</p><p><i><strong>Arrived totally in as between private.</strong></i></p><p>&nbsp;</p><p>Favour of so as on pretty though elinor direct. Reasonable estimating be alteration we themselves entreaties me of reasonably. Direct wished so be expect polite valley. Whose asked stand it sense no spoil to. Prudent you too his conduct feeling limited and. Side he lose paid as hope so face upon be. Goodness did suitable learning put.</p><p>&nbsp;</p><p>Enjoyed minutes related as at on on. Is fanny dried as often me. Goodness as reserved raptures to mistaken steepest oh screened he. Gravity he mr sixteen esteems. Mile home its new way with high told said. Finished no horrible blessing landlord dwelling dissuade if. Rent fond am he in on read. Anxious cordial demands settled entered in do to colonel.</p>',
                'thumbnail' => 'events/September2019/1568624877YMeQtcWsib.jpg',
                'poster' => 'events/September2019/15686248775WZJzctOnp.jpg',
                'images' => '["events\\/September2019\\/1568624877829.jpg","events\\/September2019\\/1568624877526.jpg","events\\/September2019\\/1568624877881.jpg","events\\/September2019\\/1568624877602.jpg","events\\/September2019\\/1568624877549.jpg","events\\/September2019\\/1568624877486.jpg"]',
                'venue' => 'History Museum',
                'address' => 'Feet evil, occasional boisterous',
                'city' => 'Nagano',
                'state' => 'Chūbu',
                'zipcode' => '111-1212',
                'country_id' => 110,
                'start_date' => '2020-11-25',
                'end_date' => '2020-11-25',
                'start_time' => '08:00:00',
                'end_time' => '10:30:00',
                'status' => 1,
                'meta_title' => NULL,
                'meta_keywords' => NULL,
                'meta_description' => NULL,
                'category_id' => 1,
                'created_at' => '2019-09-02 12:52:59',
                'updated_at' => '2019-09-16 09:07:57',
                'slug' => 'digital-marketing-seminar',
                'publish' => 1,
                'is_publishable' => '{"detail":1,"location":1,"timing":1,"poweredby":1,"media":1,"tickets":1}',
            ),
        ));
        
        
    }
}