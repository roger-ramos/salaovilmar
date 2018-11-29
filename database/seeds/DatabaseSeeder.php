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
        // $this->call(UsersTableSeeder::class);
        DB::table('cabeleireiros')->insert([
            'nome' => 'Vilmar de Oliveira',
            'descricao' => 'Cabeleireiro desde os 18 anos',
            'email' => 'vilmarroger@hotmail.com',
            'password' => Hash::make('12345678'),
        ]);

        DB::table('cabeleireiros')->insert([
            'nome' => 'Ana Clara',
            'descricao' => 'Cabeleireiro desde os 18 anos',
            'email' => 'anaclara@hotmail.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
