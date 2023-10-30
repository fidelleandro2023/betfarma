<?php
namespace Database\Seeders;
use App\Models\category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class categoryTableSeeder extends Seeder
{
/**
* Seed the application's database.
*
 * @return void 
*/
 public function run()
 {
    $current_time_Limit = ini_get('max_execution_time');
    $current_memory_Limit = ini_get('memory_limit');
    set_time_limit(300);
    ini_set('memory_limit', '2024M');

    $category = [
                   [
                      'name' =>  NULL,
                      'description' =>  NULL,
                      'short' =>  NULL,
                      'parent_id' =>  NULL,
                      'reference' =>  NULL,
                      'user_id' =>  NULL
                   ],
                   [
                      'name' =>  NULL,
                      'description' =>  NULL,
                      'short' =>  NULL,
                      'parent_id' =>  NULL,
                      'reference' =>  NULL,
                      'user_id' =>  NULL
                   ],
                   [
                      'name' =>  NULL,
                      'description' =>  NULL,
                      'short' =>  NULL,
                      'parent_id' =>  NULL,
                      'reference' =>  NULL,
                      'user_id' =>  NULL
                   ],
                   [
                      'name' =>  NULL,
                      'description' =>  NULL,
                      'short' =>  NULL,
                      'parent_id' =>  NULL,
                      'reference' =>  NULL,
                      'user_id' =>  NULL
                   ]
                ];

    $batchSize = 4; 

    foreach (array_chunk($category, $batchSize) as $batch) {
      DB::beginTransaction();
      try {
             foreach ($batch as $categoryData) {
               $category->fill($categoryData);
               $category->save();
             }
             DB::commit();
          } catch (\Exception $e) {
             DB::rollBack();
             $this->command->error('Error during seeder execution: ' . $e->getMessage());
          }
    }

    ini_set('memory_limit', $current_memory_Limit);
    set_time_limit($current_time_Limit);
    $this->command->info('Users table seeding completed successfully.');

 }
}
