<?php use Rekamy\Generator\Console\RuleParser; ?>

@php
@endphp

<?php
echo "
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class $className extends Migration
{
    public function up()
    {
        Schema::create('$table', function (Blueprint \$table) {\n" ?>
<?php
    foreach ($columnRules as $i=> $rule) :
        echo "\t\t\t$rule\n";
    endforeach;
?><?= "
        });
    }

    public function down()
    {
        Schema::dropIfExists('$table');
    }
}

" 
?>
