<?php

use Illuminate\Database\Seeder;
use App\Page;
use App\Banner;
use App\Seo;
use App\PageContent;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'id' => 1,
                'en' => [
                    'name' => 'Home'
                ],
                'ru' => [
                    'name' => 'Главный'
                ],
                'hy' => [
                    'name' => 'Գլխավոր'
                ],
                'parent_id' => null,
                'alias' => '/',
                'sort_order' => 0,
                'page_number' => 1,
                'route_number' => 0,
                'base_page' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 1
            [
                'id' => 2,
                'en' => [
                    'name' => 'Services'
                ],
                'ru' => [
                    'name' => 'Сервисы'
                ],
                'hy' => [
                    'name' => 'Ծառայություններ'
                ],
                'parent_id' => null,
                'alias' => 'javascript:void(0);',
                'sort_order' => 1,
                'page_number' => 2,
                'route_number' => 0,
                'base_page' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 2
            [
                'id' => 3,
                'en' => [
                    'name' => 'Industries'
                ],
                'ru' => [
                    'name' => 'Индустрия'
                ],
                'hy' => [
                    'name' => 'Արդյունաբերություններ'
                ],
                'parent_id' => null,
                'alias' => 'javascript:void(0);',
                'sort_order' => 2,
                'page_number' => 3,
                'route_number' => 0,
                'base_page' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 3
            [
                'id' => 4,
                'en' => [
                    'name' => 'Languages'
                ],
                'ru' => [
                    'name' => 'Языки'
                ],
                'hy' => [
                    'name' => 'Լեզուներ'
                ],
                'parent_id' => null,
                'alias' => 'javascript:void(0);',
                'sort_order' => 3,
                'page_number' => 4,
                'route_number' => 0,
                'base_page' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 4
            [
                'id' => 5,
                'en' => [
                    'name' => 'Company'
                ],
                'ru' => [
                    'name' => 'Компания'
                ],
                'hy' => [
                    'name' => 'Ընկերություն'
                ],
                'parent_id' => null,
                'alias' => 'javascript:void(0);',
                'sort_order' => 4,
                'page_number' => null,
                'route_number' => 0,
                'base_page' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 5
            [
                'id' => 6,
                'en' => [
                    'name' => 'About Us'
                ],
                'ru' => [
                    'name' => 'О нас'
                ],
                'hy' => [
                    'name' => 'Մեր մասին'
                ],
                'parent_id' => 5,
                'alias' => 'about-us',
                'sort_order' => 0,
                'page_number' => 5,
                'route_number' => 0,
                'base_page' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 6
            [
                'id' => 7,
                'en' => [
                    'name' => 'Credentials'
                ],
                'ru' => [
                    'name' => 'Полномочия'
                ],
                'hy' => [
                    'name' => 'Հավատարմագրեր'
                ],
                'parent_id' => 5,
                'alias' => 'credentials',
                'sort_order' => 1,
                'page_number' => 6,
                'route_number' => 0,
                'base_page' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 7
            [
                'id' => 8,
                'en' => [
                    'name' => 'Customers'
                ],
                'ru' => [
                    'name' => 'Клиенты'
                ],
                'hy' => [
                    'name' => 'Հաճախորդներ'
                ],
                'parent_id' => 5,
                'alias' => 'customers',
                'sort_order' => 2,
                'page_number' => 7,
                'route_number' => 0,
                'base_page' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 8
            [
                'id' => 9,
                'en' => [
                    'name' => 'Blog'
                ],
                'ru' => [
                    'name' => 'Блог'
                ],
                'hy' => [
                    'name' => 'Բլոգ'
                ],
                'parent_id' => null,
                'alias' => 'blog',
                'sort_order' => 5,
                'page_number' => 8,
                'route_number' => 0,
                'base_page' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 9
            [
                'id' => 10,
                'en' => [
                    'name' => 'Contact Us'
                ],
                'ru' => [
                    'name' => 'Связаться с нами'
                ],
                'hy' => [
                    'name' => 'Կապվեք մեզ հետ'
                ],
                'parent_id' => null,
                'alias' => 'javascript:void(0);',
                'sort_order' => 6,
                'page_number' => null,
                'route_number' => 0,
                'base_page' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 10
            [
                'id' => 11,
                'en' => [
                    'name' => 'Get in touch'
                ],
                'ru' => [
                    'name' => 'Связаться'
                ],
                'hy' => [
                    'name' => 'Կապվեք'
                ],
                'parent_id' => 10,
                'alias' => 'get-in-touch',
                'sort_order' => 0,
                'page_number' => 11,
                'route_number' => 0,
                'base_page' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 11
            [
                'id' => 12,
                'en' => [
                    'name' => 'Help Us Improve'
                ],
                'ru' => [
                    'name' => 'Помогите нам стать лучше'
                ],
                'hy' => [
                    'name' => 'Օգնեք մեզ բարելավել'
                ],
                'parent_id' => 10,
                'alias' => 'help-us-improve',
                'sort_order' => 1,
                'page_number' => 12,
                'route_number' => 0,
                'base_page' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 12
            [
                'id' => 13,
                'en' => [
                    'name' => 'FAQs'
                ],
                'ru' => [
                    'name' => 'Вопросы и ответы'
                ],
                'hy' => [
                    'name' => 'Հարցեր եւ պատասխաններ'
                ],
                'parent_id' => 10,
                'alias' => 'faqs',
                'sort_order' => 2,
                'page_number' => 9,
                'route_number' => 0,
                'base_page' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 13
            [
                'id' => 14,
                'en' => [
                    'name' => 'Join Us'
                ],
                'ru' => [
                    'name' => 'Присоединяйтесь к нам'
                ],
                'hy' => [
                    'name' => 'Միացեք մեզ'
                ],
                'parent_id' => 10,
                'alias' => 'join-us',
                'sort_order' => 3,
                'page_number' => 10,
                'route_number' => 0,
                'base_page' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 14
            [
                'id' => 15,
                'en' => [
                    'name' => 'Rent equipment'
                ],
                'ru' => [
                    'name' => 'Аренда оборудования'
                ],
                'hy' => [
                    'name' => 'Տեխնիկայի վարձույթ'
                ],
                'parent_id' => null,
                'alias' => '/rent-equipment',
                'sort_order' => 7,
                'page_number' => null,
                'route_number' => 0,
                'base_page' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 15
            [
                'id' => 16,
                'en' => [
                    'name' => 'Translation services'
                ],
                'ru' => [
                    'name' => 'Translation services'
                ],
                'hy' => [
                    'name' => 'Translation services'
                ],
                'parent_id' => 2,
                'alias' => 'translation-services',
                'sort_order' => 0,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 16
            [
                'id' => 17,
                'en' => [
                    'name' => 'Certified translation'
                ],
                'ru' => [
                    'name' => 'Certified translation'
                ],
                'hy' => [
                    'name' => 'Certified translation'
                ],
                'parent_id' => 2,
                'alias' => 'certified-translation',
                'sort_order' => 1,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 17
            [
                'id' => 18,
                'en' => [
                    'name' => 'Transcription Services'
                ],
                'ru' => [
                    'name' => 'Transcription Services'
                ],
                'hy' => [
                    'name' => 'Transcription Services'
                ],
                'parent_id' => 2,
                'alias' => 'transcription-services',
                'sort_order' => 2,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 18
            [
                'id' => 19,
                'en' => [
                    'name' => 'Interpreting Services'
                ],
                'ru' => [
                    'name' => 'Interpreting Services'
                ],
                'hy' => [
                    'name' => 'Interpreting Services'
                ],
                'parent_id' => 2,
                'alias' => 'interpreting-services',
                'sort_order' => 3,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 19
            [
                'id' => 20,
                'en' => [
                    'name' => 'Localization'
                ],
                'ru' => [
                    'name' => 'Localization'
                ],
                'hy' => [
                    'name' => 'Localization'
                ],
                'parent_id' => 2,
                'alias' => 'localization',
                'sort_order' => 4,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 20
            [
                'id' => 21,
                'en' => [
                    'name' => 'Business Event Planing'
                ],
                'ru' => [
                    'name' => 'Business Event Planing'
                ],
                'hy' => [
                    'name' => 'Business Event Planing'
                ],
                'parent_id' => 2,
                'alias' => 'business-event-planing',
                'sort_order' => 5,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 21
            [
                'id' => 22,
                'en' => [
                    'name' => 'Legal Translation Services'
                ],
                'ru' => [
                    'name' => 'Legal Translation Services'
                ],
                'hy' => [
                    'name' => 'Legal Translation Services'
                ],
                'parent_id' => 16,
                'alias' => 'legal-translation-services',
                'sort_order' => 0,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 22
            [
                'id' => 23,
                'en' => [
                    'name' => 'Medical Translations'
                ],
                'ru' => [
                    'name' => 'Medical Translations'
                ],
                'hy' => [
                    'name' => 'Medical Translations'
                ],
                'parent_id' => 16,
                'alias' => 'medical-translations',
                'sort_order' => 2,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 23
            [
                'id' => 24,
                'en' => [
                    'name' => 'Finance'
                ],
                'ru' => [
                    'name' => 'Finance'
                ],
                'hy' => [
                    'name' => 'Finance'
                ],
                'parent_id' => 16,
                'alias' => 'finance',
                'sort_order' => 3,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 24
            [
                'id' => 25,
                'en' => [
                    'name' => 'Immigration Services'
                ],
                'ru' => [
                    'name' => 'Immigration Services'
                ],
                'hy' => [
                    'name' => 'Immigration Services'
                ],
                'parent_id' => 16,
                'alias' => 'immigration-services',
                'sort_order' => 4,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 25
            [
                'id' => 26,
                'en' => [
                    'name' => 'Technical & Scientific'
                ],
                'ru' => [
                    'name' => 'Technical & Scientific'
                ],
                'hy' => [
                    'name' => 'Technical & Scientific'
                ],
                'parent_id' => 16,
                'alias' => 'technical-and-scientific',
                'sort_order' => 5,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 26
            [
                'id' => 27,
                'en' => [
                    'name' => 'IT Translations'
                ],
                'ru' => [
                    'name' => 'IT Translations'
                ],
                'hy' => [
                    'name' => 'IT Translations'
                ],
                'parent_id' => 16,
                'alias' => 'it-translations',
                'sort_order' => 6,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 27
            [
                'id' => 28,
                'en' => [
                    'name' => 'Business Translation'
                ],
                'ru' => [
                    'name' => 'Business Translation'
                ],
                'hy' => [
                    'name' => 'Business Translation'
                ],
                'parent_id' => 16,
                'alias' => 'business-translation',
                'sort_order' => 7,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 28
            [
                'id' => 29,
                'en' => [
                    'name' => 'Marketing Translation'
                ],
                'ru' => [
                    'name' => 'Marketing Translation'
                ],
                'hy' => [
                    'name' => 'Marketing Translation'
                ],
                'parent_id' => 16,
                'alias' => 'marketing-translation',
                'sort_order' => 8,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 29
            [
                'id' => 30,
                'en' => [
                    'name' => 'Website Translation'
                ],
                'ru' => [
                    'name' => 'Website Translation'
                ],
                'hy' => [
                    'name' => 'Website Translation'
                ],
                'parent_id' => 16,
                'alias' => 'website-translation',
                'sort_order' => 9,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 30
            [
                'id' => 31,
                'en' => [
                    'name' => 'Document translation'
                ],
                'ru' => [
                    'name' => 'Document translation'
                ],
                'hy' => [
                    'name' => 'Document translation'
                ],
                'parent_id' => 16,
                'alias' => 'document-translation',
                'sort_order' => 10,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 31
            [
                'id' => 32,
                'en' => [
                    'name' => 'Certified translation'
                ],
                'ru' => [
                    'name' => 'Certified translation'
                ],
                'hy' => [
                    'name' => 'Certified translation'
                ],
                'parent_id' => 17,
                'alias' => 'certified-translation',
                'sort_order' => 0,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 32
            [
                'id' => 33,
                'en' => [
                    'name' => 'Notarized translations'
                ],
                'ru' => [
                    'name' => 'Notarized translations'
                ],
                'hy' => [
                    'name' => 'Notarized translations'
                ],
                'parent_id' => 17,
                'alias' => 'notarized-translations',
                'sort_order' => 1,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 33
            [
                'id' => 34,
                'en' => [
                    'name' => 'Apostille'
                ],
                'ru' => [
                    'name' => 'Apostille'
                ],
                'hy' => [
                    'name' => 'Apostille'
                ],
                'parent_id' => 17,
                'alias' => 'apostille',
                'sort_order' => 2,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 34
            [
                'id' => 35,
                'en' => [
                    'name' => 'Video Transcription Services'
                ],
                'ru' => [
                    'name' => 'Video Transcription Services'
                ],
                'hy' => [
                    'name' => 'Video Transcription Services'
                ],
                'parent_id' => 18,
                'alias' => 'video-transcription-services',
                'sort_order' => 0,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 35
            [
                'id' => 36,
                'en' => [
                    'name' => 'Audio Transcription Services'
                ],
                'ru' => [
                    'name' => 'Audio Transcription Services'
                ],
                'hy' => [
                    'name' => 'Audio Transcription Services'
                ],
                'parent_id' => 18,
                'alias' => 'audio-transcription-services',
                'sort_order' => 1,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 36
            [
                'id' => 37,
                'en' => [
                    'name' => 'Interviews Transcription Services'
                ],
                'ru' => [
                    'name' => 'Interviews Transcription Services'
                ],
                'hy' => [
                    'name' => 'Interviews Transcription Services'
                ],
                'parent_id' => 18,
                'alias' => 'interviews-transcription-services',
                'sort_order' => 2,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 37
            [
                'id' => 38,
                'en' => [
                    'name' => 'Other Transcription'
                ],
                'ru' => [
                    'name' => 'Other Transcription'
                ],
                'hy' => [
                    'name' => 'Other Transcription'
                ],
                'parent_id' => 18,
                'alias' => 'other-transcription',
                'sort_order' => 3,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 38
            [
                'id' => 39,
                'en' => [
                    'name' => 'Simultaneous translation'
                ],
                'ru' => [
                    'name' => 'Simultaneous translation'
                ],
                'hy' => [
                    'name' => 'Simultaneous translation'
                ],
                'parent_id' => 19,
                'alias' => 'simultaneous-translation',
                'sort_order' => 0,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 39
            [
                'id' => 40,
                'en' => [
                    'name' => 'Consecutive translation'
                ],
                'ru' => [
                    'name' => 'Consecutive translation'
                ],
                'hy' => [
                    'name' => 'Consecutive translation'
                ],
                'parent_id' => 19,
                'alias' => 'consecutive-translation',
                'sort_order' => 1,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 40
            [
                'id' => 41,
                'en' => [
                    'name' => 'In-Person Interpreting Services'
                ],
                'ru' => [
                    'name' => 'In-Person Interpreting Services'
                ],
                'hy' => [
                    'name' => 'In-Person Interpreting Services'
                ],
                'parent_id' => 19,
                'alias' => 'in-person-interpreting-services',
                'sort_order' => 2,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 41
            [
                'id' => 42,
                'en' => [
                    'name' => 'Over The Phone'
                ],
                'ru' => [
                    'name' => 'Over The Phone'
                ],
                'hy' => [
                    'name' => 'Over The Phone'
                ],
                'parent_id' => 19,
                'alias' => 'over-the-phone',
                'sort_order' => 3,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 42
            [
                'id' => 43,
                'en' => [
                    'name' => 'Conference Interpreting'
                ],
                'ru' => [
                    'name' => 'Conference Interpreting'
                ],
                'hy' => [
                    'name' => 'Conference Interpreting'
                ],
                'parent_id' => 19,
                'alias' => 'conference-interpreting',
                'sort_order' => 4,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 43
            [
                'id' => 44,
                'en' => [
                    'name' => 'Websites'
                ],
                'ru' => [
                    'name' => 'Websites'
                ],
                'hy' => [
                    'name' => 'Websites'
                ],
                'parent_id' => 20,
                'alias' => 'websites',
                'sort_order' => 0,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 44
            [
                'id' => 45,
                'en' => [
                    'name' => 'Software'
                ],
                'ru' => [
                    'name' => 'Software'
                ],
                'hy' => [
                    'name' => 'Software'
                ],
                'parent_id' => 20,
                'alias' => 'software',
                'sort_order' => 1,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 45
            [
                'id' => 46,
                'en' => [
                    'name' => 'App localization'
                ],
                'ru' => [
                    'name' => 'App localization'
                ],
                'hy' => [
                    'name' => 'App localization'
                ],
                'parent_id' => 20,
                'alias' => 'app-localization',
                'sort_order' => 2,
                'page_number' => null,
                'route_number' => 1,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 46
            [
                'id' => 47,
                'en' => [
                    'name' => 'Legal'
                ],
                'ru' => [
                    'name' => 'Legal'
                ],
                'hy' => [
                    'name' => 'Legal'
                ],
                'parent_id' => 3,
                'alias' => 'legal',
                'sort_order' => 0,
                'page_number' => null,
                'route_number' => 2,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 47
            [
                'id' => 48,
                'en' => [
                    'name' => 'Banking and Finance'
                ],
                'ru' => [
                    'name' => 'Banking and Finance'
                ],
                'hy' => [
                    'name' => 'Banking and Finance'
                ],
                'parent_id' => 3,
                'alias' => 'banking-and-finance',
                'sort_order' => 1,
                'page_number' => null,
                'route_number' => 2,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 48
            [
                'id' => 49,
                'en' => [
                    'name' => 'Medical'
                ],
                'ru' => [
                    'name' => 'Medical'
                ],
                'hy' => [
                    'name' => 'Medical'
                ],
                'parent_id' => 3,
                'alias' => 'Medical',
                'sort_order' => 2,
                'page_number' => null,
                'route_number' => 2,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 49
            [
                'id' => 50,
                'en' => [
                    'name' => 'Business'
                ],
                'ru' => [
                    'name' => 'Business'
                ],
                'hy' => [
                    'name' => 'Business'
                ],
                'parent_id' => 3,
                'alias' => 'business',
                'sort_order' => 3,
                'page_number' => null,
                'route_number' => 2,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 50
            [
                'id' => 51,
                'en' => [
                    'name' => 'Tourism'
                ],
                'ru' => [
                    'name' => 'Tourism'
                ],
                'hy' => [
                    'name' => 'Tourism'
                ],
                'parent_id' => 3,
                'alias' => 'tourism',
                'sort_order' => 4,
                'page_number' => null,
                'route_number' => 2,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 51
            [
                'id' => 52,
                'en' => [
                    'name' => 'Marketing'
                ],
                'ru' => [
                    'name' => 'Marketing'
                ],
                'hy' => [
                    'name' => 'Marketing'
                ],
                'parent_id' => 3,
                'alias' => 'marketing',
                'sort_order' => 5,
                'page_number' => null,
                'route_number' => 2,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 52
            [
                'id' => 53,
                'en' => [
                    'name' => 'Technology'
                ],
                'ru' => [
                    'name' => 'Technology'
                ],
                'hy' => [
                    'name' => 'Technology'
                ],
                'parent_id' => 3,
                'alias' => 'technology',
                'sort_order' => 6,
                'page_number' => null,
                'route_number' => 2,
                'base_page' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], // 53
        ];

        foreach ($pages as $key => $value) {
          Page::create($value);
          $banner = new Banner();
          $banner->create([
            'page_id' => $value['id'],
            'en' => [
              'title' => '',
              'description' => '',
            ],
            'ru' => [
              'title' => '',
              'description' => '',
            ],
            'hy' => [
              'title' => '',
              'description' => '',
            ]
          ]);

          Seo::create(['page_id' => $value['id']]);

          $pageContent = new PageContent();
          $pageContent->create([
              'page_id' => $value['id'],
              'en' => [
                  'title' => 'Test',
                  'description' => 'Test desc',
                  'link_title' => 'Test',
              ],
              'ru' => [
                  'title' => 'Test',
                  'description' => 'Test desc',
                  'link_title' => 'Test',
              ],
              'hy' => [
                  'title' => 'Test',
                  'description' => 'Test desc',
                  'link_title' => 'Test',
              ],
              'image' => ''
          ]);
        }
    }
}
