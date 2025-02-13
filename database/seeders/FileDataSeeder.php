<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\File_data;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FileDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        
        $ieDataIds = DB::table('ie_datas')->pluck('id')->toArray();// Get all existing IDs from the ie_datas table
        $agentIds = DB::table('agents')->pluck('id')->toArray();// Get all existing IDs from the agents table

        for ($i = 0; $i < 1000; $i++) {
            DB::table('file_datas')->insert([
                'lodgement_no' => $faker->randomNumber(4, true), // 4-digit number
                'lodgement_date' => $faker->date('d/m').'/2025', // Random date
                'manifest_no' => $faker->randomNumber(4, true), // 4-digit number
                'manifest_date' => $faker->date('d/m').'/2025', // Random date
                'group' => null, // Random word
                'ie_type' => null, // Random type
                'ie_group' => null,
                'goods_name' => null,
                'goods_type' => null,
                'be_number' => $faker->randomNumber(6, true), // 6-digit number
                'be_date' => $faker->date('d/m').'/2025',
                'fees' => $faker->randomFloat(2, 100, 10000), // Random float between 100 - 10000
                'page' => $faker->randomDigitNotNull(),
                'no_of_items' => $faker->numberBetween(1, 100),
                'status' => $faker->randomElement(['Received', 'Delivered','Printed']), // Random status
                'ie_data_id' => $faker->randomElement($ieDataIds), // Select a random ID from ie_datas
                'agent_id' => $faker->randomElement($agentIds),
                'reciver_id' => 12,
                'operator_id' => $faker->numberBetween(4, 10),
                'deliverer_id' => null,
                'delivered_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
