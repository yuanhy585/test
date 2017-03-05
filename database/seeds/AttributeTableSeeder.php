<?php

use App\Attribute;
use Illuminate\Database\Seeder;

class AttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Attribute::create([
           'attr1_title'=>'属性1',
           'attr2_title'=>'属性2',
           'attr3_title'=>'属性3',
           'attr4_title'=>'属性4',
           'attr5_title'=>'属性5',
        ]);
    }
}
