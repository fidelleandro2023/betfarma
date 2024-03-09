<?php
namespace App\Console\Commands;
use Illuminate\Console\Command; 
use Illuminate\Support\Facades\Process;

class TableCreate extends Command
{
    /**  
     * The name and signature of the console command.
     *
     * @var string
     */ 
    //php artisan TableCreate --user=admin --email=admin@email.com --password=1234 --seed=4
    protected $signature = 'TableCreate {--tables=} {--email=} {--password=} {--auth=} {--seed=}';
    /**
     * 
     * 
     * 
     * 
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando crea un crud a partir del controller y model';
    /**
     * Execute the console command.
     */
    public function handle(){ 
        $tableOption = explode(',',$this->option('tables'));
        $emailAdmin = $this->option('email');
        $passwordAdmin = $this->option('password'); 
        /*****************Crear migration*************************/
        foreach ($tableOption as $key => $table) {
            $tablep = ngettext($table);
            $fecha = "2020_01_01_";
            $sec = str_pad(time(), 6, "0", STR_PAD_LEFT);
            $filename = $fecha.$sec."_create_".$tablep."_table.php";
            $file_handle = fopen(base_path()."\database\migrations\\".$filename, 'w');
            $data_to_write = '<?php'.PHP_EOL;
            $data_to_write .= 'use Illuminate\Database\Migrations\Migration;'.PHP_EOL;
            $data_to_write .= 'use Illuminate\Database\Schema\Blueprint;'.PHP_EOL;
            $data_to_write .= 'use Illuminate\Support\Facades\Schema;'.PHP_EOL;
            $data_to_write .= 'return new class extends Migration'.PHP_EOL;
            $data_to_write .= '{'.PHP_EOL;
            $data_to_write .= '/**'.PHP_EOL;
            $data_to_write .= '* Run the migrations.'.PHP_EOL;
            $data_to_write .= '*/'.PHP_EOL;
            $data_to_write .= ' public function up(): void'.PHP_EOL;
            $data_to_write .= ' {'.PHP_EOL;
            $data_to_write .= '  Schema::create(\''.$tablep.'\', function (Blueprint $table) {'.PHP_EOL;
            $data_to_write .= $this->completeMigration($tablep).PHP_EOL;
            $data_to_write .= '  });'.PHP_EOL;
            $data_to_write .= ' }'.PHP_EOL;
            $data_to_write .= '/**'.PHP_EOL;
            $data_to_write .= '* Reverse the migrations.'.PHP_EOL;
            $data_to_write .= '*/'.PHP_EOL;
            $data_to_write .= ' public function down(): void'.PHP_EOL;
            $data_to_write .= ' {'.PHP_EOL;
            $data_to_write .= '   Schema::dropIfExists(\''.$tablep.'\');'.PHP_EOL;
            $data_to_write .= ' }'.PHP_EOL;
            $data_to_write .= '};'.PHP_EOL;
        }
    }
    public function completeMigration($table){
        $text = '';
        switch($table){
            case 'user': 
                $text.= '$table->string(\'name\')->nullable();'.PHP_EOL;
                $text.= '$table->string(\'username\')->unique()->index();'.PHP_EOL;
                $text.= '$table->string(\'email\')->unique()->index();'.PHP_EOL;
                $text.= '$table->timestamp(\'email_verified_at\')->nullable();'.PHP_EOL;
                $text.= '$table->string(\'password\');'.PHP_EOL;
                $text.= '$table->rememberToken();'.PHP_EOL;
                $text.= '$table->timestamps();'.PHP_EOL;
            break;
            case 'password_reset': 
                $text.= '$table->string(\'email\')->index();'.PHP_EOL;
                $text.= '$table->string(\'token\');'.PHP_EOL;
                $text.= '$table->timestamp(\'created_at\')->nullable();'.PHP_EOL; 
            break;
            case 'tag': 
                $text.= '$table->increments(\'id\');'.PHP_EOL;
                $text.= '$table->string(\'name\');'.PHP_EOL;
                $text.= '$table->string(\'slug\');'.PHP_EOL;
                $text.= '$table->timestamps();'.PHP_EOL; 
            break;
            case 'category': 
                $text.= '$table->increments(\'id\');'.PHP_EOL;
                $text.= '$table->string(\'name\')->index();'.PHP_EOL;
                $text.= '$table->string(\'slug\');'.PHP_EOL;
                $text.= '$table->string(\'image\')->default(\'default.png\');'.PHP_EOL;
                $text.= '$table->timestamps();'.PHP_EOL; 
            break;
            case 'post': 
                $text.= '$table->increments(\'id\');'.PHP_EOL;
                $text.= '$table->integer(\'user_id\')->unsigned();'.PHP_EOL;
                $text.= '$table->string(\'title\')->index();'.PHP_EOL;
                $text.= '$table->string(\'slug\')->unique();'.PHP_EOL;
                $text.= '$table->string(\'image\')->default(\'default.png\');'.PHP_EOL;
                $text.= '$table->text(\'body\');'.PHP_EOL;
                $text.= '$table->integer(\'view_count\')->default(0);'.PHP_EOL;
                $text.= '$table->boolean(\'status\')->default(false);'.PHP_EOL;
                $text.= '$table->boolean(\'is_approved\')->default(false);'.PHP_EOL;
                $text.= '$table->foreign(\'user_id\')->references(\'id\')->on(\'users\')->onDelete(\'cascade\');'.PHP_EOL;
                $text.= '$table->timestamps();'.PHP_EOL; 
            break;
            case 'category_post': 
                $text.= '$table->increments(\'id\');'.PHP_EOL;
                $text.= '$table->integer(\'category_id\')->unsigned();'.PHP_EOL;
                $text.= '$table->integer(\'post_id\')->unsigned();'.PHP_EOL;
                $text.= '$table->timestamps();'.PHP_EOL; 
            break;
            case 'post_tag': 
                $text.= '$table->increments(\'id\');'.PHP_EOL;
                $text.= '$table->integer(\'post_id\')->unsigned();'.PHP_EOL;
                $text.= '$table->integer(\'tag_id\')->unsigned();'.PHP_EOL;
                $text.= '$table->timestamps();'.PHP_EOL; 
            break;
            case 'feature': 
                $text.= '$table->increments(\'id\');'.PHP_EOL;
                $text.= '$table->string(\'name\');'.PHP_EOL;
                $text.= '$table->string(\'slug\');'.PHP_EOL;
                $text.= '$table->timestamps();'.PHP_EOL;
            break;
            case 'feature_property': 
                $text.= 'feature_property'.PHP_EOL;
                $text.= '$table->integer(\'property_id\');'.PHP_EOL;
                $text.= '$table->integer(\'feature_id\');'.PHP_EOL;
                $text.= '$table->timestamps();'.PHP_EOL; 
            break;
            case 'property_image_gallery': 
                $text.= '$table->increments(\'id\');'.PHP_EOL;
                $text.= '$table->integer(\'property_id\')->unsigned();'.PHP_EOL;
                $text.= '$table->string(\'name\');'.PHP_EOL;
                $text.= '$table->string(\'size\')->nullable();'.PHP_EOL;
                $text.= '$table->timestamps();'.PHP_EOL; 
            break;
            case 'rating': 
                $text.= '$table->increments(\'id\');'.PHP_EOL;
                $text.= '$table->integer(\'user_id\');'.PHP_EOL;
                $text.= '$table->integer(\'property_id\');'.PHP_EOL;
                $text.= '$table->decimal(\'rating\', 8, 2);'.PHP_EOL;
                $text.= '$table->string(\'type\');'.PHP_EOL;
                $text.= '$table->timestamps();'.PHP_EOL; 
            break;
            case 'service': 
                $text.= '$table->increments(\'id\');'.PHP_EOL;
                $text.= '$table->string(\'title\');'.PHP_EOL;
                $text.= '$table->text(\'description\');'.PHP_EOL;
                $text.= '$table->string(\'icon\');'.PHP_EOL;
                $text.= '$table->integer(\'service_order\')->default(1);'.PHP_EOL;
                $text.= '$table->timestamps();'.PHP_EOL; 
            break;
            case 'property': 
                $text.= '$table->increments(\'id\');'.PHP_EOL;
                $text.= '$table->string(\'title\');'.PHP_EOL;
                $text.= '$table->string(\'slug\')->unique();'.PHP_EOL;
                $text.= '$table->double(\'price\', 8, 2);'.PHP_EOL;
                $text.= '$table->boolean(\'featured\')->default(false);'.PHP_EOL;
                $text.= '$table->enum(\'purpose\', [\'sale\', \'rent\']);'.PHP_EOL;
                $text.= '$table->enum(\'type\', [\'house\', \'apartment\']);'.PHP_EOL;
                $text.= '$table->string(\'image\')->nullable();'.PHP_EOL;
                $text.= '$table->integer(\'bedroom\');'.PHP_EOL;
                $text.= '$table->integer(\'bathroom\');'.PHP_EOL;
                $text.= '$table->string(\'city\');'.PHP_EOL;
                $text.= '$table->string(\'city_slug\');'.PHP_EOL;
                $text.= '$table->string(\'address\');'.PHP_EOL;
                $text.= '$table->integer(\'area\');'.PHP_EOL;
                $text.= '$table->integer(\'agent_id\');'.PHP_EOL;
                $text.= '$table->text(\'description\');'.PHP_EOL;
                $text.= '$table->string(\'video\')->nullable();'.PHP_EOL;
                $text.= '$table->string(\'floor_plan\')->nullable();'.PHP_EOL;
                $text.= '$table->string(\'location_latitude\');'.PHP_EOL;
                $text.= '$table->string(\'location_longitude\');'.PHP_EOL;
                $text.= '$table->text(\'nearby\')->nullable();'.PHP_EOL;
                $text.= ' $table->timestamps();'.PHP_EOL; 
            break;
            case '': 
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
            break;
            case '': 
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
            break;
            case '': 
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
            break;
            case '': 
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
                $text.= ''.PHP_EOL;
            break;
        }
        return $text;
    }
}