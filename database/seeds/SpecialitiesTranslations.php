<?php

use Illuminate\Database\Seeder;

class SpecialitiesTranslations extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialities = [
            'Hematologie' => 'Hematology',
            'Hematologie Adulti' => 'Hematology for adults',
            'Hematologie Pediatrie' => 'Pediatric Hematology',
            'Oncologie' => 'Oncology',
            'Oncologie Adulti' => 'Oncology for adults',
            'Oncologie Pediatrie' => 'Pediatric Oncology',
            'Radioterapie' => 'Radiotherapy',
            'Radioterapie Adulti' => 'Radiotherapy for adults',
            'Radioterapie Pediatrie' => 'Radiotherapy for children',
            'test' => 'test',
            'Transplant Adulti' => 'Pediatric Bone Marrow Transplant',
            'Transplant Medular' => 'Bone Marrow Transplant',
            'Transplant Pediatrie' => 'Pediatric Bone Marrow Transplant',
        ];

        \App\Speciality::all()->each(function (\App\Speciality $speciality) use ($specialities) {
            $speciality->name_en = $specialities[$speciality->name];
            $speciality->save();
        });
    }
}
