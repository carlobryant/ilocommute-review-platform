<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $city = ['Batac City', 'Laoag City'];

        $brgy = ['3', '4', '5', '6', '8', '9', '11', '12', '13', '14',
                '15', '17', '18', '19', '21', '22', '23', '24', '26', '28',
                '29', '31', '35'];
        
        $plate = ['21', '00', '08', '27', '09', '15', '25', '13', '20', '01'];

        for($i=0;$i<23;$i++){
            Driver::create([
                'plate_no' => $plate[$i % count($plate)] . ($i + 10 + rand(2, 3)),
                'brgy' => $brgy[$i],
                'city'=> $city[0],
            ]);
        }

        for($i=0;$i<23;$i++){
            Driver::create([
                'plate_no' => $plate[$i % count($plate)] . ($i + 70 + rand(2, 3)),
                'brgy' => $brgy[$i],
                'city'=> $city[1],
            ]);
        }
    }
}
