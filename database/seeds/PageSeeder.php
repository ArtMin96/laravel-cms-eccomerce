<?php

use Illuminate\Database\Seeder;
use App\Page;
use App\Banner;
use App\Seo;

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
          'page_number' => null,
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
          'page_number' => 4,
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
          'page_number' => 5,
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
          'page_number' => 6,
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
          'page_number' => 7,
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
          'page_number' => null,
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
          'page_number' => null,
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
          'page_number' => 8,
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
          'page_number' => 9,
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
            'base_page' => 1,
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
        ], // 15
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
      }
    }
}
