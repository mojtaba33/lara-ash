<?php

namespace Database\Seeders;

use App\Visit;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class VisitSeeder extends Seeder
{
    protected $dt;

    public function __construct()
    {
        $this->dt = Carbon::now();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Visit::truncate();
        foreach($this->getMonth() as $month)
        {
            Visit::factory()->count(random_int(5,15))->create([
                'created_at' => $month
            ]);
        }
    }

    protected function getMonth()
    {
        $months = [];
        for($i = 1;$i <= 12 ; $i++)
        {
            $months[] = $this->dt->subMonth()->toDateTimeString();
        }
        return $months;
    }
}
