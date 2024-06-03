<?php
namespace App\Console\Commands\commandsFcr; 

class CompleteMigrations
{

    public function index($table){
        $text = '';
        switch($table){
            case 'users': 
                $text.= '       $table->string(\'name\')->nullable();'.PHP_EOL;
                $text.= '       $table->string(\'username\')->unique()->index();'.PHP_EOL;
                $text.= '       $table->string(\'email\')->unique()->index();'.PHP_EOL;
                $text.= '       $table->timestamp(\'email_verified_at\')->nullable();'.PHP_EOL;
                $text.= '       $table->string(\'password\');'.PHP_EOL;
                $text.= '       $table->rememberToken();'.PHP_EOL;
                $text.= '       $table->timestamps();'.PHP_EOL;
            break;
            case 'company_has_users': 
                $text.= '       $table->string(\'name\')->nullable();'.PHP_EOL;
                $text.= '       $table->string(\'username\')->unique()->index();'.PHP_EOL;
                $text.= '       $table->string(\'email\')->unique()->index();'.PHP_EOL;
                $text.= '       $table->timestamp(\'email_verified_at\')->nullable();'.PHP_EOL; 
                $text.= '       $table->rememberToken();'.PHP_EOL;
                $text.= '       $table->timestamps();'.PHP_EOL;
                $text.= '       $table->bigInteger(\'company_id\')->unsigned()->nullable();'.PHP_EOL; 
                $text.= '       $table->bigInteger(\'users_id\')->unsigned()->nullable();'.PHP_EOL; 
                $text.= '       $table->foreign(\'company_id\')'.PHP_EOL; 
                $text.= '            ->references(\'id\')'.PHP_EOL; 
                $text.= '            ->on(\'companies\')'.PHP_EOL; 
                $text.= '            ->onCascade(\'delete\');'.PHP_EOL; 
                $text.= '       $table->foreign(\'users_id\')'.PHP_EOL; 
                $text.= '            ->references(\'id\')'.PHP_EOL; 
                $text.= '            ->on(\'users\')'.PHP_EOL; 
                $text.= '            ->onCascade(\'delete\');'.PHP_EOL; 
            break; 
            case 'password_resets': 
                $text.= '       $table->string(\'email\')->index();'.PHP_EOL;
                $text.= '       $table->string(\'token\');'.PHP_EOL;
                $text.= '       $table->timestamp(\'created_at\')->nullable();'.PHP_EOL; 
            break;
            case 'tags': 
                $text.= '       $table->increments(\'id\');'.PHP_EOL;
                $text.= '       $table->string(\'name\');'.PHP_EOL;
                $text.= '       $table->string(\'slug\');'.PHP_EOL;
                $text.= '       $table->timestamps();'.PHP_EOL; 
            break;
            case 'categories':  
                $text.= '       $table->string(\'name\')->index();'.PHP_EOL;
                $text.= '       $table->string(\'slug\');'.PHP_EOL;
                $text.= '       $table->string(\'image\')->default(\'default.png\');'.PHP_EOL;
                $text.= '       $table->timestamps();'.PHP_EOL; 
            break;
            case 'posts':  
                $text.= '       $table->integer(\'user_id\')->unsigned();'.PHP_EOL;
                $text.= '       $table->string(\'title\')->index();'.PHP_EOL;
                $text.= '       $table->string(\'slug\')->unique();'.PHP_EOL;
                $text.= '       $table->string(\'image\')->default(\'default.png\');'.PHP_EOL;
                $text.= '       $table->text(\'body\');'.PHP_EOL;
                $text.= '       $table->integer(\'view_count\')->default(0);'.PHP_EOL;
                $text.= '       $table->boolean(\'status\')->default(false);'.PHP_EOL;
                $text.= '       $table->boolean(\'is_approved\')->default(false);'.PHP_EOL;
                $text.= '       $table->foreign(\'user_id\')->references(\'id\')->on(\'users\')->onDelete(\'cascade\');'.PHP_EOL;
                $text.= '       $table->timestamps();'.PHP_EOL; 
            break;
            case 'categorieshas_posts':  
                $text.= '       $table->integer(\'category_id\')->unsigned();'.PHP_EOL;
                $text.= '       $table->integer(\'post_id\')->unsigned();'.PHP_EOL;
                $text.= '       $table->timestamps();'.PHP_EOL; 
            break;
            case 'post_tags':  
                $text.= '       $table->integer(\'post_id\')->unsigned();'.PHP_EOL;
                $text.= '       $table->integer(\'tag_id\')->unsigned();'.PHP_EOL;
                $text.= '       $table->timestamps();'.PHP_EOL; 
            break;
            case 'features':  
                $text.= '       $table->string(\'name\');'.PHP_EOL;
                $text.= '       $table->string(\'slug\');'.PHP_EOL;
                $text.= '       $table->timestamps();'.PHP_EOL;
            break;
            case 'features_has_properties': 
                $text.= '       feature_property'.PHP_EOL;
                $text.= '       $table->integer(\'property_id\');'.PHP_EOL;
                $text.= '       $table->integer(\'feature_id\');'.PHP_EOL;
                $text.= '       $table->timestamps();'.PHP_EOL; 
            break;
            case 'properties_image_galleries':  
                $text.= '       $table->integer(\'property_id\')->unsigned();'.PHP_EOL;
                $text.= '       $table->string(\'name\');'.PHP_EOL;
                $text.= '       $table->string(\'size\')->nullable();'.PHP_EOL;
                $text.= '       $table->timestamps();'.PHP_EOL; 
            break;
            case 'ratings':  
                $text.= '       $table->integer(\'user_id\');'.PHP_EOL;
                $text.= '       $table->integer(\'property_id\');'.PHP_EOL;
                $text.= '       $table->decimal(\'rating\', 8, 2);'.PHP_EOL;
                $text.= '       $table->string(\'type\');'.PHP_EOL;
                $text.= '       $table->timestamps();'.PHP_EOL; 
            break;
            case 'services':  
                $text.= '       $table->string(\'title\');'.PHP_EOL;
                $text.= '       $table->text(\'description\');'.PHP_EOL;
                $text.= '       $table->string(\'icon\');'.PHP_EOL;
                $text.= '       $table->integer(\'service_order\')->default(1);'.PHP_EOL;
                $text.= '       $table->timestamps();'.PHP_EOL; 
            break;
            case 'properties':  
                $text.= '       $table->string(\'title\');'.PHP_EOL;
                $text.= '       $table->string(\'slug\')->unique();'.PHP_EOL;
                $text.= '       $table->double(\'price\', 8, 2);'.PHP_EOL;
                $text.= '       $table->boolean(\'featured\')->default(false);'.PHP_EOL;
                $text.= '       $table->enum(\'purpose\', [\'sale\', \'rent\']);'.PHP_EOL;
                $text.= '       $table->enum(\'type\', [\'house\', \'apartment\']);'.PHP_EOL;
                $text.= '       $table->string(\'image\')->nullable();'.PHP_EOL;
                $text.= '       $table->integer(\'bedroom\');'.PHP_EOL;
                $text.= '       $table->integer(\'bathroom\');'.PHP_EOL;
                $text.= '       $table->string(\'city\');'.PHP_EOL;
                $text.= '       $table->string(\'city_slug\');'.PHP_EOL;
                $text.= '       $table->string(\'address\');'.PHP_EOL;
                $text.= '       $table->integer(\'area\');'.PHP_EOL;
                $text.= '       $table->integer(\'agent_id\');'.PHP_EOL;
                $text.= '       $table->text(\'description\');'.PHP_EOL;
                $text.= '       $table->string(\'video\')->nullable();'.PHP_EOL;
                $text.= '       $table->string(\'floor_plan\')->nullable();'.PHP_EOL;
                $text.= '       $table->string(\'location_latitude\');'.PHP_EOL;
                $text.= '       $table->string(\'location_longitude\');'.PHP_EOL;
                $text.= '       $table->text(\'nearby\')->nullable();'.PHP_EOL;
                $text.= '       $table->timestamps();'.PHP_EOL; 
            break;
            case 'companies':  
                $text.= '       $table->string(\'ruc\')->nullable()->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->string(\'business_name\')->nullable()->comment(\'Razon social\');'.PHP_EOL; 
                $text.= '       $table->string(\'tradename\')->nullable()->comment(\'Nombre comercial\');'.PHP_EOL; 
                $text.= '       $table->string(\'tax_domain\')->nullable()->comment(\'Dominio fiscal\');'.PHP_EOL; 
                $text.= '       $table->bigInteger(\'country_id\')->unsigned()->nullable();'.PHP_EOL; 
                $text.= '       $table->bigInteger(\'dpto_id\')->unsigned()->nullable();'.PHP_EOL; 
                $text.= '       $table->bigInteger(\'prov_id\')->unsigned()->nullable();'.PHP_EOL; 
                $text.= '       $table->bigInteger(\'dist_id\')->unsigned()->nullable();'.PHP_EOL; 
                $text.= '       $table->string(\'logo\')->nullable()->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->string(\'taxpaying_state\')->nullable()->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->string(\'taxpayer_condition\')->nullable()->comment(\'\');'.PHP_EOL; 
                //$text.= '       $table->bigInteger(\'company_id\')->unsigned()->nullable();'.PHP_EOL; 
                $text.= '       $table->bigInteger(\'operat_id\')->unsigned()->nullable();'.PHP_EOL; 
                $text.= '       $table->bigInteger(\'coin_id\')->unsigned()->nullable();'.PHP_EOL; 
                $text.= '       $table->decimal(\'IGV\',10,2)->nullable(10)->comment();'.PHP_EOL; 
                $text.= '       $table->decimal(\'IR\',10,2)->nullable(8)->comment();'.PHP_EOL; 
                $text.= '       $table->bigInteger(\'regimen_id\')->unsigned()->nullable();'.PHP_EOL; 
                $text.= '       $table->string(\'retent_agent\')->nullable()->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->string(\'retent_agent_resol\')->nullable()->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->string(\'good_taxpayer\')->nullable()->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->string(\'good_taxpayer_resol\')->nullable()->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->string(\'perception_agent\')->nullable()->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->string(\'perception_agent_resol\')->nullable()->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->string(\'excepted_igv_1\')->nullable()->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->string(\'excepted_igv_2\')->nullable()->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->char(\'status\',1)->default(\'A\')->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->integer(\'parent\')->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->timestamps();'.PHP_EOL; 
                $text.= '       $table->foreign(\'regimen_id\')'.PHP_EOL; 
                $text.= '             ->references(\'id\')'.PHP_EOL; 
                $text.= '             ->on(\'regimens\')'.PHP_EOL; 
                $text.= '             ->onCascade(\'delete\');'.PHP_EOL; 
                // $text.= ' $table->foreign(\'operat_id\')'.PHP_EOL; 
                // $text.= '           ->references(\'id\')'.PHP_EOL; 
                // $text.= '            ->on(\'operations_indicator\')'.PHP_EOL; 
                // $text.= '            ->onCascade(\'delete\');'.PHP_EOL;  
                $text.= '       $table->foreign(\'coin_id\')'.PHP_EOL; 
                $text.= '            ->references(\'id\')'.PHP_EOL; 
                $text.= '            ->on(\'coin_types\')'.PHP_EOL; 
                $text.= '            ->onCascade(\'delete\');'.PHP_EOL; 
                $text.= '       $table->foreign(\'country_id\')'.PHP_EOL; 
                $text.= '            ->references(\'id\')'.PHP_EOL; 
                $text.= '            ->on(\'countries\')'.PHP_EOL; 
                $text.= '            ->onCascade(\'delete\');'.PHP_EOL; 
                $text.= '       $table->foreign(\'dpto_id\')'.PHP_EOL; 
                $text.= '            ->references(\'id\')'.PHP_EOL; 
                $text.= '            ->on(\'departments\')'.PHP_EOL; 
                $text.= '            ->onCascade(\'delete\');'.PHP_EOL; 
                $text.= '       $table->foreign(\'prov_id\')'.PHP_EOL; 
                $text.= '            ->references(\'id\')'.PHP_EOL; 
                $text.= '            ->on(\'provinces\')'.PHP_EOL; 
                $text.= '            ->onCascade(\'delete\');'.PHP_EOL; 
                $text.= '       $table->foreign(\'dist_id\')'.PHP_EOL; 
                $text.= '            ->references(\'id\')'.PHP_EOL; 
                $text.= '            ->on(\'districts\')'.PHP_EOL; 
                $text.= '            ->onCascade(\'delete\');'.PHP_EOL; 
            break;
            case 'branch_offices': 
                $text.= '       $table->string(\'ruc\')->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->string(\'business_name\')->nullable()->comment(\'Razon social\');'.PHP_EOL; 
                $text.= '       $table->string(\'tradename\')->nullable()->comment(\'Nombre comercial\');'.PHP_EOL; 
                $text.= '       $table->string(\'tax_domain\')->nullable()->comment(\'Dominio fiscal\');'.PHP_EOL; 
                $text.= '       $table->bigInteger(\'coin_id\')->unsigned()->nullable();'.PHP_EOL; 
                $text.= '       $table->bigInteger(\'country_id\')->unsigned()->nullable();'.PHP_EOL; 
                $text.= '       $table->bigInteger(\'dpto_id\')->unsigned()->nullable();'.PHP_EOL; 
                $text.= '       $table->bigInteger(\'prov_id\')->unsigned()->nullable();'.PHP_EOL; 
                $text.= '       $table->bigInteger(\'dist_id\')->unsigned()->nullable();'.PHP_EOL; 
                $text.= '       $table->char(\'status\',1)->default(\'A\')->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->timestamps();'.PHP_EOL; 
                $text.= '       $table->foreign(\'coin_id\')'.PHP_EOL; 
                $text.= '            ->references(\'id\')'.PHP_EOL; 
                $text.= '            ->on(\'coins\')'.PHP_EOL; 
                $text.= '            ->onCascade(\'delete\');'.PHP_EOL; 
                $text.= '       $table->foreign(\'country_id\')'.PHP_EOL; 
                $text.= '            ->references(\'id\')'.PHP_EOL; 
                $text.= '            ->on(\'countries\')'.PHP_EOL; 
                $text.= '            ->onCascade(\'delete\');'.PHP_EOL; 
                $text.= '       $table->foreign(\'dpto_id\')'.PHP_EOL; 
                $text.= '            ->references(\'id\')'.PHP_EOL; 
                $text.= '            ->on(\'departments\')'.PHP_EOL; 
                $text.= '            ->onCascade(\'delete\');'.PHP_EOL; 
                $text.= '       $table->foreign(\'prov_id\')'.PHP_EOL; 
                $text.= '            ->references(\'id\')'.PHP_EOL; 
                $text.= '            ->on(\'provinces\')'.PHP_EOL; 
                $text.= '            ->onCascade(\'delete\');'.PHP_EOL; 
                $text.= '       $table->foreign(\'dist_id\')'.PHP_EOL; 
                $text.= '             ->references(\'id\')'.PHP_EOL; 
                $text.= '             ->on(\'districts\')'.PHP_EOL; 
                $text.= '             ->onCascade(\'delete\');'.PHP_EOL; 
            break; 
            case 'regimen':  
                $text.= '       $table->string(\'code\')->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->string(\'description\')->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->char(\'status\', 1)->default(\'A\')->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->timestamps();'.PHP_EOL; 
            break;
            
            case 'coin_types': 
                $text.= '       $table->string(\'code\')->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->string(\'description\')->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->bigInteger(\'country_id\')->unsigned()->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->bigInteger(\'coin_id\')->unsigned()->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->char(\'status\',1)->default(\'A\')->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->timestamps();'.PHP_EOL; 
                $text.= '       $table->foreign(\'country_id\')'.PHP_EOL; 
                $text.= '             ->references(\'id\')'.PHP_EOL; 
                $text.= '             ->on(\'countries\')'.PHP_EOL; 
                $text.= '             ->onCascade(\'delete\');'.PHP_EOL; 
                $text.= '       $table->foreign(\'coin_id\')'.PHP_EOL; 
                $text.= '             ->references(\'id\')'.PHP_EOL; 
                $text.= '             ->on(\'coins\')'.PHP_EOL; 
                $text.= '             ->onCascade(\'delete\');'.PHP_EOL; 
            break;
            case 'coins': 
                $text.= '       $table->string(\'name\')->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->string(\'description\')->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->string(\'country\')->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->char(\'status\',1)->default(\'A\')->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->timestamps();'.PHP_EOL; 
            break;
            case 'countries': 
                $text.= '       $table->string(\'description\', 50);'.PHP_EOL; 
                $text.= '       $table->boolean(\'active\')->default(true);'.PHP_EOL; 
                $text.= '       $table->timestamps();'.PHP_EOL; 
            break;
            case 'departments': 
                $text.= '       $table->string(\'name\')->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->string(\'description\')->nullable()->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->char(\'status\',1)->default(\'A\')->comment(\'\');'.PHP_EOL;  
                $text.= '       $table->bigInteger(\'country_id\')->unsigned()->nullable();'.PHP_EOL; 
                $text.= '       $table->timestamps();'.PHP_EOL; 
                $text.= '       $table->foreign(\'country_id\')'.PHP_EOL; 
                $text.= '             ->references(\'id\')'.PHP_EOL; 
                $text.= '             ->on(\'countries\')'.PHP_EOL; 
                $text.= '             ->onDelete(\'cascade\')'.PHP_EOL;  
                $text.= '             ->onUpdate(\'cascade\');'.PHP_EOL;  
            break;
            case 'provinces': 
                $text.= '       $table->string(\'name\')->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->string(\'description\')->nullable()->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->char(\'status\',1)->default(\'A\')->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->bigInteger(\'department_id\')->unsigned();'.PHP_EOL; 
                $text.= '       $table->timestamps();'.PHP_EOL; 
                $text.= '       $table->foreign(\'department_id\')'.PHP_EOL; 
                $text.= '             ->references(\'id\')'.PHP_EOL; 
                $text.= '             ->on(\'departments\')'.PHP_EOL; 
                $text.= '             ->onCascade(\'delete\');'.PHP_EOL; 
            break;
            case 'districts': 
                $text.= '       $table->string(\'name\')->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->string(\'description\')->nullable()->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->char(\'status\',1)->default(\'A\')->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->bigInteger(\'province_id\')->unsigned();'.PHP_EOL; 
                $text.= '       $table->timestamps();'.PHP_EOL; 
                $text.= '       $table->foreign(\'province_id\')'.PHP_EOL; 
                $text.=  '            ->references(\'id\')'.PHP_EOL; 
                $text.=  '            ->on(\'provinces\')'.PHP_EOL; 
                $text.=  '            ->onCascade(\'delete\');'.PHP_EOL; 
            break;
            case 'dashboards': 
                $text.= '       $table->string(\'title\');'.PHP_EOL;
                $text.= '       $table->string(\'slug\')->unique();'.PHP_EOL; 
                $text.= '       $table->boolean(\'featured\')->default(false);'.PHP_EOL;
                $text.= '       $table->enum(\'purpose\', [\'sale\', \'rent\']);'.PHP_EOL;
                $text.= '       $table->enum(\'type\', [\'house\', \'apartment\']);'.PHP_EOL;
                $text.= '       $table->string(\'image\')->nullable();'.PHP_EOL;
                $text.= '       $table->string(\'theme\');'.PHP_EOL;
                $text.= '       $table->string(\'class\');'.PHP_EOL;
                $text.= '       $table->double(\'profile\');'.PHP_EOL;
                $text.= '       $table->double(\'fixed_head\');'.PHP_EOL;
                $text.= '       $table->double(\'fixed_sidebar\');'.PHP_EOL;
                $text.= '       $table->double(\'search\');'.PHP_EOL;
                $text.= '       $table->timestamps();'.PHP_EOL; 
            break;
            case 'company_has_dashboards': 
                $text.= '       $table->string(\'name\')->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->string(\'description\')->nullable()->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->char(\'status\',1)->default(\'A\')->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->bigInteger(\'company_id\')->unsigned()->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->bigInteger(\'dashboard_id\')->unsigned()->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->timestamps();'.PHP_EOL; 
                $text.= '       $table->foreign(\'company_id\')'.PHP_EOL; 
                $text.= '             ->references(\'id\')'.PHP_EOL; 
                $text.= '             ->on(\'companies\')'.PHP_EOL; 
                $text.= '             ->onCascade(\'delete\');'.PHP_EOL; 
                $text.= '       $table->foreign(\'dashboard_id\')'.PHP_EOL; 
                $text.= '             ->references(\'id\')'.PHP_EOL; 
                $text.= '             ->on(\'dashboards\')'.PHP_EOL; 
                $text.= '             ->onCascade(\'delete\');'.PHP_EOL; 
            break;
            case 'menus': 
                $text.= '       $table->string(\'name\')->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->string(\'description\')->nullable()->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->char(\'status\',1)->default(\'A\')->comment(\'\');'.PHP_EOL; 
                $text.= '       $table->bigInteger(\'company_id\')->unsigned();'.PHP_EOL; 
                $text.= '       $table->bigInteger(\'dashboard_id\')->unsigned();'.PHP_EOL; 
                $text.= '       $table->timestamps();'.PHP_EOL;  
                $text.= '$table->foreign(\'dashboard_id\')'.PHP_EOL; 
                $text.=  '      ->references(\'id\')'.PHP_EOL; 
                $text.=  '      ->on(\'dashboards\')'.PHP_EOL; 
                $text.=  '      ->onCascade(\'delete\');'.PHP_EOL; 
                $text.= '$table->foreign(\'company_id\')'.PHP_EOL; 
                $text.=  '      ->references(\'id\')'.PHP_EOL; 
                $text.=  '      ->on(\'companies\')'.PHP_EOL; 
                $text.=  '      ->onCascade(\'delete\');'.PHP_EOL; 
            break;
            case 'dashboard_has_menus': 
                $text.= '$table->string(\'name\')->comment(\'\');'.PHP_EOL; 
                $text.= '$table->string(\'description\')->nullable()->comment(\'\');'.PHP_EOL; 
                $text.= '$table->char(\'status\',1)->default(\'A\')->comment(\'\');'.PHP_EOL; 
                $text.= '$table->bigInteger(\'dashbaord_id\')->unsigned();'.PHP_EOL; 
                $text.= '$table->bigInteger(\'menu_id\')->unsigned();'.PHP_EOL; 
                $text.= '$table->timestamps();'.PHP_EOL; 
                $text.= '$table->foreign(\'dashbaord_id\')'.PHP_EOL; 
                $text.=  '      ->references(\'id\')'.PHP_EOL; 
                $text.=  '      ->on(\'dashboards\')'.PHP_EOL; 
                $text.=  '      ->onCascade(\'delete\');'.PHP_EOL; 
                $text.= '$table->foreign(\'menu_id\')'.PHP_EOL; 
                $text.=  '      ->references(\'id\')'.PHP_EOL; 
                $text.=  '      ->on(\'menus\')'.PHP_EOL; 
                $text.=  '      ->onCascade(\'delete\');'.PHP_EOL; 
            break;
            // case '': 
            //     $text.= ''.PHP_EOL;
            //     $text.= ''.PHP_EOL;
            //     $text.= ''.PHP_EOL;
            //     $text.= ''.PHP_EOL;
            //     $text.= ''.PHP_EOL;
            //     $text.= ''.PHP_EOL;
            //     $text.= ''.PHP_EOL;
            //     $text.= ''.PHP_EOL;
            //     $text.= ''.PHP_EOL;
            //     $text.= ''.PHP_EOL;
            //     $text.= ''.PHP_EOL;
            //     $text.= ''.PHP_EOL;
            // break;
            // case '': 
            //     $text.= ''.PHP_EOL;
            //     $text.= ''.PHP_EOL;
            //     $text.= ''.PHP_EOL;
            //     $text.= ''.PHP_EOL;
            //     $text.= ''.PHP_EOL;
            //     $text.= ''.PHP_EOL;
            //     $text.= ''.PHP_EOL;
            //     $text.= ''.PHP_EOL;
            //     $text.= ''.PHP_EOL;
            //     $text.= ''.PHP_EOL;
            //     $text.= ''.PHP_EOL;
            //     $text.= ''.PHP_EOL;
            // break;
        }
        return $text;
    }
}