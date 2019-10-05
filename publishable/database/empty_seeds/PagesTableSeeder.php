<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pages')->delete();
        
        \DB::table('pages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'author_id' => 1,
                'title' => 'About Us',
                'excerpt' => 'about',
                'body' => '<div id="Content" style="margin: 0px; padding: 0px; position: relative; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; text-align: center;">
<div id="Translation" style="margin: 0px 28.7969px; padding: 0px; text-align: left;">
<h3 style="margin: 15px 0px; padding: 0px; font-size: 14px;">The standard Lorem Ipsum passage, used since the 1500s</h3>
<p style="margin: 0px 0px 15px; padding: 0px; text-align: justify;">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
<h3 style="margin: 15px 0px; padding: 0px; font-size: 14px;">Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC</h3>
<p style="margin: 0px 0px 15px; padding: 0px; text-align: justify;">"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"</p>
<h3 style="margin: 15px 0px; padding: 0px; font-size: 14px;">1914 translation by H. Rackham</h3>
<p style="margin: 0px 0px 15px; padding: 0px; text-align: justify;">"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"</p>
<h3 style="margin: 15px 0px; padding: 0px; font-size: 14px;">Section 1.10.33 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC</h3>
<p style="margin: 0px 0px 15px; padding: 0px; text-align: justify;">"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat."</p>
<h3 style="margin: 15px 0px; padding: 0px; font-size: 14px;">1914 translation by H. Rackham</h3>
<p style="margin: 0px 0px 15px; padding: 0px; text-align: justify;">"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains."</p>
<p>&nbsp;</p>
</div>
</div>',
                'image' => NULL,
                'slug' => 'about',
                'meta_description' => 'About us description',
                'meta_keywords' => 'eventmie',
                'status' => 'ACTIVE',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2019-08-22 06:45:56',
            ),
            1 => 
            array (
                'id' => 2,
                'author_id' => 1,
                'title' => 'Privacy Policy',
                'excerpt' => 'privacy',
                'body' => '<h1>Privacy Policy</h1>
<p>Effective date: August 22, 2019</p>
<p>Eventmie ("us", "we", or "our") operates the https://www.eventmie.com website (hereinafter referred to as the "Service").</p>
<p>This page informs you of our policies regarding the collection, use, and disclosure of personal data when you use our Service and the choices you have associated with that data. The Privacy Policy for Eventmie has been created with the help of <a href="https://www.termsfeed.com/">TermsFeed</a>.</p>
<p>We use your data to provide and improve the Service. By using the Service, you agree to the collection and use of information in accordance with this policy. Unless otherwise defined in this Privacy Policy, the terms used in this Privacy Policy have the same meanings as in our Terms and Conditions, accessible from https://www.eventmie.com</p>
<h2>Definitions</h2>
<ul>
<li>
<p><strong>Service</strong></p>
<p>Service is the https://www.eventmie.com website operated by Eventmie</p>
</li>
<li>
<p><strong>Personal Data</strong></p>
<p>Personal Data means data about a living individual who can be identified from those data (or from those and other information either in our possession or likely to come into our possession).</p>
</li>
<li>
<p><strong>Usage Data</strong></p>
<p>Usage Data is data collected automatically either generated by the use of the Service or from the Service infrastructure itself (for example, the duration of a page visit).</p>
</li>
<li>
<p><strong>Cookies</strong></p>
<p>Cookies are small files stored on your device (computer or mobile device).</p>
</li>
</ul>
<h2>Information Collection and Use</h2>
<p>We collect several different types of information for various purposes to provide and improve our Service to you.</p>
<h3>Types of Data Collected</h3>
<h4>Personal Data</h4>
<p>While using our Service, we may ask you to provide us with certain personally identifiable information that can be used to contact or identify you ("Personal Data"). Personally identifiable information may include, but is not limited to:</p>
<ul>
<li>Cookies and Usage Data</li>
</ul>
<h4>Usage Data</h4>
<p>We may also collect information how the Service is accessed and used ("Usage Data"). This Usage Data may include information such as your computer\'s Internet Protocol address (e.g. IP address), browser type, browser version, the pages of our Service that you visit, the time and date of your visit, the time spent on those pages, unique device identifiers and other diagnostic data.</p>
<h4>Tracking &amp; Cookies Data</h4>
<p>We use cookies and similar tracking technologies to track the activity on our Service and we hold certain information.</p>
<p>Cookies are files with a small amount of data which may include an anonymous unique identifier. Cookies are sent to your browser from a website and stored on your device. Other tracking technologies are also used such as beacons, tags and scripts to collect and track information and to improve and analyse our Service.</p>
<p>You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our Service.</p>
<p>Examples of Cookies we use:</p>
<ul>
<li><strong>Session Cookies.</strong> We use Session Cookies to operate our Service.</li>
<li><strong>Preference Cookies.</strong> We use Preference Cookies to remember your preferences and various settings.</li>
<li><strong>Security Cookies.</strong> We use Security Cookies for security purposes.</li>
</ul>
<h2>Use of Data</h2>
<p>Eventmie uses the collected data for various purposes:</p>
<ul>
<li>To provide and maintain the Service</li>
<li>To notify you about changes to our Service</li>
<li>To allow you to participate in interactive features of our Service when you choose to do so</li>
<li>To provide customer care and support</li>
<li>To provide analysis or valuable information so that we can improve the Service</li>
<li>To monitor the usage of the Service</li>
<li>To detect, prevent and address technical issues</li>
</ul>
<h2>Transfer Of Data</h2>
<p>Your information, including Personal Data, may be transferred to - and maintained on - computers located outside of your state, province, country or other governmental jurisdiction where the data protection laws may differ than those from your jurisdiction.</p>
<p>If you are located outside India and choose to provide information to us, please note that we transfer the data, including Personal Data, to India and process it there.</p>
<p>Your consent to this Privacy Policy followed by your submission of such information represents your agreement to that transfer.</p>
<p>Eventmie will take all steps reasonably necessary to ensure that your data is treated securely and in accordance with this Privacy Policy and no transfer of your Personal Data will take place to an organization or a country unless there are adequate controls in place including the security of your data and other personal information.</p>
<h2>Disclosure Of Data</h2>
<h3>Legal Requirements</h3>
<p>Eventmie may disclose your Personal Data in the good faith belief that such action is necessary to:</p>
<ul>
<li>To comply with a legal obligation</li>
<li>To protect and defend the rights or property of Eventmie</li>
<li>To prevent or investigate possible wrongdoing in connection with the Service</li>
<li>To protect the personal safety of users of the Service or the public</li>
<li>To protect against legal liability</li>
</ul>
<p>As an European citizen, under GDPR, you have certain individual rights. You can learn more about these guides in the <a href="https://termsfeed.com/blog/gdpr/#Individual_Rights_Under_the_GDPR">GDPR Guide</a>.</p>
<h2>Security of Data</h2>
<p>The security of your data is important to us but remember that no method of transmission over the Internet or method of electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your Personal Data, we cannot guarantee its absolute security.</p>
<h2>Service Providers</h2>
<p>We may employ third party companies and individuals to facilitate our Service ("Service Providers"), to provide the Service on our behalf, to perform Service-related services or to assist us in analyzing how our Service is used.</p>
<p>These third parties have access to your Personal Data only to perform these tasks on our behalf and are obligated not to disclose or use it for any other purpose.</p>
<h2>Links to Other Sites</h2>
<p>Our Service may contain links to other sites that are not operated by us. If you click a third party link, you will be directed to that third party\'s site. We strongly advise you to review the Privacy Policy of every site you visit.</p>
<p>We have no control over and assume no responsibility for the content, privacy policies or practices of any third party sites or services.</p>
<h2>Children\'s Privacy</h2>
<p>Our Service does not address anyone under the age of 18 ("Children").</p>
<p>We do not knowingly collect personally identifiable information from anyone under the age of 18. If you are a parent or guardian and you are aware that your Child has provided us with Personal Data, please contact us. If we become aware that we have collected Personal Data from children without verification of parental consent, we take steps to remove that information from our servers.</p>
<h2>Changes to This Privacy Policy</h2>
<p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page.</p>
<p>We will let you know via email and/or a prominent notice on our Service, prior to the change becoming effective and update the "effective date" at the top of this Privacy Policy.</p>
<p>You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective when they are posted on this page.</p>
<h2>Contact Us</h2>
<p>If you have any questions about this Privacy Policy, please contact us:</p>
<ul>
<li>By email: deepak.destinyahead@gmail.com</li>
</ul>',
                'image' => NULL,
                'slug' => 'privacy',
                'meta_description' => 'Privacy Policy',
                'meta_keywords' => 'privacy',
                'status' => 'ACTIVE',
                'created_at' => '2019-07-07 07:48:28',
                'updated_at' => '2019-08-22 06:43:16',
            ),
            2 => 
            array (
                'id' => 3,
                'author_id' => 1,
                'title' => 'Terms and Conditions',
                'excerpt' => 'terms',
            'body' => '<h1>Terms and Conditions ("Terms")</h1>
<p>Last updated: August 22, 2019</p>
<p>Please read these Terms and Conditions ("Terms", "Terms and Conditions") carefully before using the https://eventmie.com website (the "Service") operated by Eventmie ("us", "we", or "our").</p>
<p>Your access to and use of the Service is conditioned on your acceptance of and compliance with these Terms. These Terms apply to all visitors, users and others who access or use the Service.</p>
<p>By accessing or using the Service you agree to be bound by these Terms. If you disagree with any part of the terms then you may not access the Service. The Terms and Conditions agreement for Eventmie has been created with the help of <a href="https://www.termsfeed.com/">TermsFeed</a>.</p>
<h2>Accounts</h2>
<p>When you create an account with us, you must provide us information that is accurate, complete, and current at all times. Failure to do so constitutes a breach of the Terms, which may result in immediate termination of your account on our Service.</p>
<p>You are responsible for safeguarding the password that you use to access the Service and for any activities or actions under your password, whether your password is with our Service or a third-party service.</p>
<p>You agree not to disclose your password to any third party. You must notify us immediately upon becoming aware of any breach of security or unauthorized use of your account.</p>
<h2>Links To Other Web Sites</h2>
<p>Our Service may contain links to third-party web sites or services that are not owned or controlled by Eventmie.</p>
<p>Eventmie has no control over, and assumes no responsibility for, the content, privacy policies, or practices of any third party web sites or services. You further acknowledge and agree that Eventmie shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with use of or reliance on any such content, goods or services available on or through any such web sites or services.</p>
<p>We strongly advise you to read the terms and conditions and privacy policies of any third-party web sites or services that you visit.</p>
<h2>Governing Law</h2>
<p>These Terms shall be governed and construed in accordance with the laws of Rajasthan, India, without regard to its conflict of law provisions.</p>
<p>Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights. If any provision of these Terms is held to be invalid or unenforceable by a court, the remaining provisions of these Terms will remain in effect. These Terms constitute the entire agreement between us regarding our Service, and supersede and replace any prior agreements we might have between us regarding the Service.</p>
<h2>Changes</h2>
<p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material we will try to provide at least 30 days notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>
<p>By continuing to access or use our Service after those revisions become effective, you agree to be bound by the revised terms. If you do not agree to the new terms, please stop using the Service.</p>
<h2>Contact Us</h2>
<p>If you have any questions about these Terms, please contact us.</p>',
                'image' => NULL,
                'slug' => 'terms',
                'meta_description' => 'Terms and Conditions',
                'meta_keywords' => 'Terms and Conditions',
                'status' => 'ACTIVE',
                'created_at' => '2019-07-07 07:48:58',
                'updated_at' => '2019-10-04 10:56:26',
            ),
        ));
        
        
    }
}