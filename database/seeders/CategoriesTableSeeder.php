<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'user_id' => 1,
                'title' => 'Dolor laboriosam aut.',
                'slug' => 'tempore-distinctio',
                'created_at' => '2022-07-23 08:45:23',
                'updated_at' => '2022-07-23 08:45:23',
                'description' => 'Et qui esse dolore distinctio laborum optio quos. Fugit minus quasi minus ut ut perferendis.',
            ),
            1 => 
            array (
                'user_id' => 1,
                'title' => 'Reprehenderit saepe distinctio dolorum.',
                'slug' => 'qui-consequuntur',
                'created_at' => '2022-07-23 08:45:23',
                'updated_at' => '2022-07-23 08:45:23',
                'description' => 'Blanditiis earum dolores illum adipisci at. Voluptatem quidem qui praesentium.',
            ),
            2 => 
            array (
                'user_id' => 1,
                'title' => 'Sit voluptas aut mollitia.',
                'slug' => 'neque-accusamus-enim',
                'created_at' => '2022-07-23 08:45:23',
                'updated_at' => '2022-07-23 08:45:23',
                'description' => 'Eveniet occaecati ducimus fugit vel cupiditate porro dolorem.',
            ),
            3 => 
            array (
                'user_id' => 1,
                'title' => 'Consequuntur et provident exercitationem.',
                'slug' => 'eos-voluptate',
                'created_at' => '2022-07-23 08:45:23',
                'updated_at' => '2022-07-23 08:45:23',
                'description' => 'Et neque tempore distinctio totam rem at voluptatum nam.',
            ),
            4 => 
            array (
                'user_id' => 1,
                'title' => 'Perferendis ut itaque.',
                'slug' => 'nemo-soluta',
                'created_at' => '2022-07-23 08:45:23',
                'updated_at' => '2022-07-23 08:45:23',
                'description' => 'Facilis suscipit veniam ut rerum eum sit tenetur. Quae omnis nihil asperiores rerum officia voluptas.',
            ),
            5 => 
            array (
                'user_id' => 3,
                'title' => 'Fugit sequi omnis.',
                'slug' => 'et-amet',
                'created_at' => '2022-07-23 08:45:23',
                'updated_at' => '2022-07-23 08:45:23',
                'description' => 'Exercitationem ex reiciendis qui minima incidunt in. Vel nisi saepe ex provident incidunt ut tenetur.',
            ),
            6 => 
            array (
                'user_id' => 4,
                'title' => 'Placeat consequatur qui quas.',
                'slug' => 'velit-vel-et',
                'created_at' => '2022-07-23 08:45:23',
                'updated_at' => '2022-07-23 08:45:23',
                'description' => 'Vero quis soluta maxime.',
            ),
            7 => 
            array (
                'user_id' => 5,
                'title' => 'Aut est labore consectetur.',
                'slug' => 'natus-dolor-officia',
                'created_at' => '2022-07-23 08:45:23',
                'updated_at' => '2022-07-23 08:45:23',
                'description' => 'Amet natus provident adipisci animi quia iusto.',
            ),
            8 => 
            array (
                'user_id' => 5,
                'title' => 'Esse officiis ipsum earum.',
                'slug' => 'voluptatem-consequatur-aspernatur',
                'created_at' => '2022-07-23 08:45:23',
                'updated_at' => '2022-07-23 08:45:23',
                'description' => 'Ut ipsam ipsa natus in magnam et maxime. Exercitationem sunt soluta hic saepe deleniti.',
            ),
            9 => 
            array (
                'user_id' => 2,
                'title' => 'Debitis ut minima.',
                'slug' => 'qui-suscipit',
                'created_at' => '2022-07-23 08:45:23',
                'updated_at' => '2022-07-23 08:45:23',
                'description' => 'Animi dolor id voluptates molestias natus.',
            ),
        ));
        
        
    }
}