<?php

use Illuminate\Database\Seeder;
use App\Models\Work;
use Illuminate\Database\Eloquent\Model;

class WorkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Work::class, 5)->create();
    }
}
