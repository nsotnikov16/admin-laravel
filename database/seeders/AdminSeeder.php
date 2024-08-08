<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Insert;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->addInserts();
    }

    protected function addInserts() {
        $array = [
            ['name' => 'Перед </head>', 'code' => 'head_beforeend'],
            ['name' => 'После <body>', 'code' => 'body_afterbegin'],
            ['name' => 'Перед </body>', 'code' => 'body_beforeend'],
        ];
        foreach ($array as $item) {
            $insert = new Insert;
            $insert->name = $item['name'];
            $insert->code = $item['code'];
            $insert->save();
        }
    }
}
