<?php
namespace App\Console\Commands\commandsFcr; 

class CompleteModel
{
    public function index($modelos,$foreigns){
 
        $parentsModel =  []; 

        foreach($modelos as $model => $tablaItem){
            $databaseName = \DB::connection()->getDatabaseName(); 
            $nameModel = ucfirst(strtolower($model));
            //echo $nameModel;
            $data_to_write = '<?php'.PHP_EOL;
            $data_to_write .= 'namespace App\Models;'.PHP_EOL;
            $data_to_write .= 'use Illuminate\Database\Eloquent\Factories\HasFactory;'.PHP_EOL;
            $data_to_write .= 'use Illuminate\Database\Eloquent\Model;'.PHP_EOL.PHP_EOL;   
            $data_to_write .= 'class '.ucfirst($model).' extends Model'.PHP_EOL;  
            $data_to_write .= '{'.PHP_EOL;  
            $data_to_write .= '   use HasFactory;'.PHP_EOL.PHP_EOL;   
            $data_to_write .= '}'.PHP_EOL;   
            $modelDB = fopen(base_path()."\app\Models\\$nameModel.php", 'w'); 
            fwrite($modelDB, $data_to_write);
            fclose($modelDB); 
            //$modelDB = \App::make('App\Models\\'.$model);  
            include(base_path()."\app\Models\\$nameModel.php"); 
            //$nameModel = '//App//Models//'.ucfirst($model);
            
            $tableName = resolve('\\App\\Models\\'.$nameModel)->getTable();
            $columns = \Schema::getColumnListing($tableName);  

            $data_to_write = '<?php'.PHP_EOL;
            $data_to_write .= PHP_EOL;                    
            $data_to_write .= 'namespace App\Models;'.PHP_EOL;
            $fillable = ''; $i_fill = 0; 

            $data_to_write .= 'use Illuminate\Database\Eloquent\Factories\HasFactory;'.PHP_EOL;
            $data_to_write .= 'use Illuminate\Database\Eloquent\Model;'.PHP_EOL;
            $data_to_write .= PHP_EOL;    
            $data_to_write .= 'class '.$nameModel.' extends Model'.PHP_EOL;  
            $data_to_write .= '{'.PHP_EOL;  
            $data_to_write .= '   use HasFactory;'.PHP_EOL.PHP_EOL;  
            $data_to_write .= '   protected $fillable = ['.PHP_EOL;  
            $data_to_write .= '    '.$fillable.PHP_EOL;
            $data_to_write .= '   ];'.PHP_EOL;  
            $metodos_model = array();
            /*************************************BUSCAR RELACIONES FORANEAS****************************************************************************************/
            // $query_ref = "select distinct table_name as foreign_table, '>-' as rel, referenced_table_name as primary_table from information_schema.key_column_usage 
            //               where referenced_table_name = '$tableName' and table_schema = '$databaseName' order by foreign_table;"; 
            // $foreign = \DB::select($query_ref); 
            if (isset($foreigns[$tableName])) {
                //print_r($tableName.'->'.$foreign[0]->foreign_table); exit;
                $subModel = array_search($foreign[0]->foreign_table, $modelos); 
                //echo $subModel.'-'.$nameModel; exit; 

                if (isset($parentsModel[$nameModel])) {
                    /***********************FUNCION tabla child**************************************************/
                    $funcModel = strtolower($parentsModel[$nameModel]);
                    $data_to_write .= "  public function $funcModel()".PHP_EOL; 
                    $data_to_write .= '  {'.PHP_EOL; 
                    $data_to_write .= '    return $this->belongsTo('.$parentsModel[$nameModel].'::class);'.PHP_EOL; 
                    $data_to_write .= '  }'.PHP_EOL; 
                    /*******************************************************************************************/
                }
                    
                /********FUNCION tabla parent **************************************************************/
                $funcModel = strtolower($subModel);
                $data_to_write .= "  public function $funcModel()".PHP_EOL; 
                $data_to_write .= '  {'.PHP_EOL; 
                $capModel = ucfirst($subModel);
                $data_to_write .= '    return $this->belongsTo('.$capModel.'::class);'.PHP_EOL; 
                $data_to_write .= '  }'.PHP_EOL; 
                //} 
                if (!isset($parentsModel[$subModel])) {
                    $parentsModel[$subModel] = $nameModel;
                }
            }
            /****************************************************************************************************************************************************/
        
        
        $data_to_write .= '}'.PHP_EOL;   
        $file_handle = fopen(base_path()."\\app\\Models\\$nameModel.php", 'w'); 
        fwrite($file_handle, $data_to_write);
        fclose($file_handle); 
        }
    }                            
}
