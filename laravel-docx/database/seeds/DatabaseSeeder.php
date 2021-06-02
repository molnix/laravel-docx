<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(VotingSeeder::class);
        $this->call(VotingTypesSeeder::class);
        $this->call(VotingWorkerSeeder::class);
        $this->call(WorkersSeeder::class);
        $this->call(WorkerTypesSeeder::class);
    }
}
