<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\category; 
use Illuminate\Support\Facades\Schema;
//use App\Helpers\loadModels;

class crudFidel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:crud-fidel {--controller=} {--model=} {--prefijo=} {--migration=}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando crea un crud a partir del controller y model';
    /**
     * Execute the console command.
     */
    public function handle()
    { 
        //$controller = $this->argument('controller'); //$this->option('controller');
        $controller = $this->option('controller');
        $model = $this->option('model');
        $migration = $this->option('migration');
        $prefijo = $this->option('prefijo') == '' ? '' : $this->option('prefijo');  
        /************Comprobar si existe controllers, Model y migration */
        if (!file_exists(base_path()."\app\Http\Controllers\\".$controller.".php")) {
            echo 'No existe el controlador'; exit;
        }
        if (!file_exists(base_path()."\app\models\\".$model.".php")) {
            echo 'No existe el modelo'; exit;
        }
        if (!file_exists(base_path()."\database\migrations\\".$migration.".php")) {
            echo 'No existe la migración'; exit;
        }
        /************Cargando model de forma dinamica**********************/
        include(base_path().'\app\Models\\'.$model.'.php');
        $modelDB = \App::make('App\Models\\'.$model); 
        /*******Obteniendo nombre de tabla a partit del model */
        $tableName = $modelDB->getTable();
        $columns = \DB::select("SHOW COLUMNS FROM ".$tableName);
        //dd($columns); exit; 
        //////////////BUILD REQUEST/////////////////////////////////////
        /**Aqui se construye el archivo request ************************/
        $data_to_write = '<?php'.PHP_EOL;
        $data_to_write .= ' namespace App\Http\Requests;'.PHP_EOL;
        $data_to_write .= ' use Illuminate\Foundation\Http\FormRequest;'.PHP_EOL;
        $data_to_write .= "\n class ".ucfirst($model)."Request extends FormRequest".PHP_EOL;
        $data_to_write .= '{'.PHP_EOL;
        $data_to_write .= ' public function authorize()'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL;
        $data_to_write .= '      return false;'.PHP_EOL;
        $data_to_write .= '  }'.PHP_EOL;
        $data_to_write .= ' public function rules()'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL;
        $data_to_write .= '   return ['.PHP_EOL;
            $col_req = ''; $col_req2 = ''; $i = 0; $j = 0;
            /*********Cargando columnas de la tabla a partir del model *******************/
            foreach ($columns as $key => $value) {
                /*******Ignorar las columnas id, created_at y updated_at */
                if (strtolower($value->Field) !== "id" && $value->Field !== "created_at" && $value->Field !== "updated_at") {
                    /******Logica para la concatenación de comas*********/
                    if ($i != 0) {
                        $col_req.= ','.PHP_EOL;
                    }
                    $i++;
                    /****************Fin de logica******************* */
                    $col_req .= "      '".$value->Field."' => "; 
                    /**********Si la columna es requerida agregar atributo required al array del metodo reglas */
                    $col_req .= $value->Null == 'NO' ? "['required']" : '""';
                     
                    if ($value->Null == 'NO') {
                        if ($j != 0) {
                            $col_req2.= ','.PHP_EOL;
                        }
                        $col_req2.= "      '".$value->Field.".required' => ':attribute can not be empty.'"; 
                        $j++;
                    }
                }
            }  
        
        $data_to_write .= $col_req;
        $data_to_write .= '   ];'.PHP_EOL;    
        $data_to_write .= '  }'.PHP_EOL;
        $data_to_write .= '  public function messages(): array'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL;
        $data_to_write .= '    return ['.PHP_EOL; 
        $data_to_write .=          $col_req2;
        $data_to_write .= '    ];'.PHP_EOL;
        $data_to_write .= '  }'.PHP_EOL;
        $data_to_write .= '}'.PHP_EOL;
        //echo $data_to_write; exit;
        if (!file_exists(base_path()."\app\Http\Requests\\")) {
            mkdir(base_path()."\app\Http\Requests\\", 0700);
        }

        $file_handle = fopen(base_path()."\app\Http\Requests\\".ucfirst($model)."Request.php", 'w'); 
        fwrite($file_handle, $data_to_write);
        fclose($file_handle);
        //echo $data_to_write; exit;
        $file_handle = fopen(base_path()."\app\Http\Controllers\\".$controller.".php", 'w'); 
        fwrite($file_handle, $data_to_write);
        fclose($file_handle);
        /*************CREAR CARPETA PREFIJO PARA VIEWS****************************************/ 
        if ($prefijo != '' && !file_exists(base_path()."\\resources\\views\\".$prefijo)) { 
            mkdir(base_path()."\\resources\\views\\".$prefijo, 0700);
        }
        /*************CREAR VISTAS PARA CRUD**************************************************/
        $ruta_views = $prefijo == '' ? base_path()."\\resources\\views\\".$tableName."\\" : base_path()."\\resources\\views\\".$prefijo."\\".$tableName."\\";
        if ($prefijo != '' && !file_exists($ruta_views)) {
            mkdir($ruta_views, 0700);
        }
        echo '$ruta_views:'.$ruta_views;
        /***********VIEW INDEX****************************************************************/
        $data_to_write = "@extends('layouts.app')".PHP_EOL;
        $data_to_write .= "@section('content')".PHP_EOL;
        $data_to_write .= '<div class="container max-w-6xl mx-auto mt-20">'.PHP_EOL;
        $data_to_write .= ' <div class="mb-4">'.PHP_EOL;
        $data_to_write .= '   <h1 class="font-serif text-3xl font-bold underline decoration-gray-400"> '.$tableName.' Index</h1>'.PHP_EOL;
        $data_to_write .= "   @if (session()->has('message'))".PHP_EOL;
        $data_to_write .= '    <div class="p-3 rounded bg-green-500 text-green-100 my-2">'.PHP_EOL;
        $data_to_write .= "      {{ session('message') }}".PHP_EOL;
        $data_to_write .= '    </div>'.PHP_EOL;
        $data_to_write .= '   @endif'.PHP_EOL; 
        $data_to_write .= '   <div class="flex justify-end">'.PHP_EOL; 
        $data_to_write .= "    <a href=\"{{ route('posts.create')}}".PHP_EOL; 
        $data_to_write .= '     class="px-4 py-2 rounded-md bg-sky-500 text-sky-100 hover:bg-sky-600">'.$tableName.' Post</a>'.PHP_EOL; 
        $data_to_write .= '   </div>'.PHP_EOL; 
        $data_to_write .= ' </div>'.PHP_EOL; 
        $data_to_write .= ' <div class="flex flex-col">'.PHP_EOL; 
        $data_to_write .= '   <div class="overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">'.PHP_EOL; 
        $data_to_write .= '     <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">'.PHP_EOL; 
        $data_to_write .= '       <table class="min-w-full">'.PHP_EOL; 
        $data_to_write .= '          <thead>'.PHP_EOL; 
        $data_to_write .= '            <tr>'.PHP_EOL; 
                                    foreach ($columns as $key => $value) {
                                        if ($value->Field !== "created_at" && $value->Field !== "updated_at") {
        $data_to_write .= '             <th';
        $data_to_write .= '               class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">'.PHP_EOL; 
        $data_to_write .= '             '.$value->Field.'</th>'.PHP_EOL; 
                                        }
                                    } 
        $data_to_write .= '             <th class="px-6 py-3 text-sm text-left text-gray-500 border-b border-gray-200 bg-gray-50" colspan="2">'.PHP_EOL; 
        $data_to_write .= '               Action</th>'.PHP_EOL; 
        $data_to_write .= '            </tr>'.PHP_EOL;
        $data_to_write .= '      </thead>'.PHP_EOL;
        $data_to_write .= '      <tbody class="bg-white">'.PHP_EOL;
        $data_to_write .= '        @foreach ($'.$model.' as $item)'.PHP_EOL;
        $data_to_write .= '        <tr>'.PHP_EOL; 
                                        foreach ($columns as $key => $value) {
        $data_to_write .= '              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">'.PHP_EOL;
        $data_to_write .= '                <div class="flex items-center">'.PHP_EOL;
                                                if ($value->Field !== "created_at" && $value->Field !== "updated_at") {
        $data_to_write .= '                        {{ $item->'.$value->Field.' }}'.PHP_EOL;
                                                }
        $data_to_write .= '                 </div>'.PHP_EOL;
        $data_to_write .= '              </td>'.PHP_EOL; 
                                        } 
        $data_to_write .= '              <td'.PHP_EOL;
        $data_to_write .= '               class="text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200">'.PHP_EOL;
        $data_to_write .= '                 <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"'.PHP_EOL;
        $data_to_write .= '                   viewBox="0 0 24 24" stroke="currentColor">'.PHP_EOL;
        $data_to_write .= '                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"'.PHP_EOL;
        $data_to_write .= '                   d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />'.PHP_EOL;
        $data_to_write .= '                 </svg>'.PHP_EOL; 
        $data_to_write .= '              </td>'.PHP_EOL;
        $data_to_write .= '              <td class="text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200 ">'.PHP_EOL; 
        $data_to_write .= '                 <svg xmlns="http://www.w3.org/2000/svg"'.PHP_EOL; 
        $data_to_write .= '                      class="w-6 h-6 text-red-600 hover:text-red-800 cursor-pointer" fill="none"'.PHP_EOL; 
        $data_to_write .= '                      viewBox="0 0 24 24" stroke="currentColor">'.PHP_EOL; 
        $data_to_write .= '                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"'.PHP_EOL; 
        $data_to_write .= '                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />'.PHP_EOL; 
        $data_to_write .= '                 </svg>'.PHP_EOL;  
        $data_to_write .= '              </td>'.PHP_EOL;  
        $data_to_write .= '          </tr>'.PHP_EOL; 
        $data_to_write .= '          @endforeach()'.PHP_EOL; 
        $data_to_write .= '       </tbody>'.PHP_EOL; 
        $data_to_write .= '     </table>'.PHP_EOL; 
        $data_to_write .= '    </div>'.PHP_EOL; 
        $data_to_write .= '   </div>'.PHP_EOL; 
        $data_to_write .= ' </div>'.PHP_EOL; 
        $data_to_write .= '</div>'.PHP_EOL; 
        $data_to_write .= "@endsection".PHP_EOL;
        $data_to_write .= "@push('footer');".PHP_EOL; 
        $data_to_write .= "@endpush('footer')".PHP_EOL; 
        $file_handle = fopen($ruta_views."index.blade.php", 'w'); 
        fwrite($file_handle, $data_to_write);
        fclose($file_handle);
        /******************************CONSTRUYENDO LAS RUTAS*************************************/
        $data_to_write = file_get_contents(base_path()."\\routes\\web.php"); 
        $file_handle = fopen(base_path()."\\routes\\web.php", 'w'); 
        $data_to_write .= PHP_EOL;
        $data_to_write .= PHP_EOL;
        $data_to_write .= "/***********RUTAS DE $tableName ***************************"."/".PHP_EOL;
        $data_to_write .= "Route::get('/$tableName/index', [App\Http\Controllers\$controller::class, 'index'])->name('".$tableName."_index');".PHP_EOL;
        $data_to_write .= "Route::get('/$tableName/create', [App\Http\Controllers\$controller::class, 'create'])->name('".$tableName."_create');".PHP_EOL;
        $data_to_write .= "Route::post('/$tableName', [App\Http\Controllers\$controller::class, 'store'])->name('".$tableName."_store');".PHP_EOL;
        $data_to_write .= "Route::get('/$tableName/{$model}', [App\Http\Controllers\$controller::class, 'show'])->name('".$tableName."_show');".PHP_EOL;
        $data_to_write .= "Route::get('/$tableName/{$model}/edit', [App\Http\Controllers\$controller::class, 'edit'])->name('".$tableName."_edit');".PHP_EOL;
        $data_to_write .= "Route::put('/$tableName/{$model}', [App\Http\Controllers\$controller::class, 'update'])->name('".$tableName."_update');".PHP_EOL;
        $data_to_write .= "Route::delete('/$tableName/{$model}', [App\Http\Controllers\$controller::class, 'destroy'])->name('".$tableName."destroy');".PHP_EOL;
        $data_to_write .= "/***********FIN RUTAS DE $tableName ***********************"."/".PHP_EOL;
        fwrite($file_handle, $data_to_write);
        fclose($file_handle);                              
        //////////////////////CONSTRUYEMDO EL CONTROLADOR/////////////////////////////////////////
        $data_to_write = '<?php'.PHP_EOL;
        $data_to_write .= ' namespace App\Http\Controllers;'.PHP_EOL;
        $data_to_write .= ' use Illuminate\Http\Request;'.PHP_EOL;
        $data_to_write .= ' use App\Models\\'.$model.';'.PHP_EOL;
        $data_to_write .= ' use App\Http\Requests\\'.ucfirst($model).'Request;'.PHP_EOL.PHP_EOL;
        $data_to_write .= " class $controller extends Controller".PHP_EOL;
        $data_to_write .= ' {'.PHP_EOL;
        /*******************Método index *****************************************************/
        $data_to_write .= '  public function index()'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL;
        $data_to_write .= '    $'.$model.' = '.$model.'::latest()->paginate(10);'.PHP_EOL;
        $data_to_write .= "    return view('".$prefijo.".".$tableName.".index', compact('".$model."'));".PHP_EOL;
        $data_to_write .= '  }'.PHP_EOL; 
        /*******************Método create *****************************************************/
        $data_to_write .= '  public function create()'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL;
        $data_to_write .= '    $'.$model.' = '.$model.'::latest()->paginate(10);'.PHP_EOL;
        $data_to_write .= "    return view('".$prefijo.".".$tableName.".index', compact('".$model."'));".PHP_EOL;
        $data_to_write .= '  }'.PHP_EOL; 
        /*******************Método store ******************************************************************/
        $data_to_write .= '  public function store('.ucfirst($model).'Request $request)'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL;
        $data_to_write .= '    \DB::beginTransaction();'.PHP_EOL;
        $data_to_write .= '     try {'.PHP_EOL;
        $data_to_write .= '          '.$model.'::create($request->validated());'.PHP_EOL;
        $data_to_write .= '          \DB::commit();'.PHP_EOL;
        $data_to_write .= "          \Session::flash('message', '".$model." created');".PHP_EOL;
        $data_to_write .= '     } catch (\Exception $e) {'.PHP_EOL;
        $data_to_write .= '         \DB::rollBack();'.PHP_EOL;
        $data_to_write .= '         throw $e;'.PHP_EOL;
        $data_to_write .= '     } catch (\Throwable $e) {'.PHP_EOL;
        $data_to_write .= '         \DB::rollBack();'.PHP_EOL;
        $data_to_write .= '         throw $e;'.PHP_EOL;
        $data_to_write .= '     }'.PHP_EOL;
        $data_to_write .='     '.$model.'::create($request->validated());'.PHP_EOL;
        $data_to_write .= "     return redirect()->route('".$prefijo.".".$tableName.".index')->with('message', '".$model." Created Successfully');".PHP_EOL;
        $data_to_write .= '  }'.PHP_EOL; 
        /********************Método show *****************************************************************/
        $data_to_write .= '  public function show('.$model.' $'.$model.')'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL; 
        $data_to_write .= "     return view('".$prefijo.".".$tableName.".show', compact('".$model."'));".PHP_EOL;
        $data_to_write .= '  }'.PHP_EOL;
        /********************Método edit ******************************************************************/
        $data_to_write .= '  public function edit('.$model.' $'.$model.')'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL; 
        $data_to_write .= "     return view('".$prefijo.".".$tableName.".edit', compact('".$model."'));".PHP_EOL;
        $data_to_write .= '  }'.PHP_EOL;
        /*******************Método update *****************************************************************/
        $data_to_write .= '  public function update('.ucfirst($model).'Request $request,'.$model.' $'.$model.')'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL;
        $data_to_write .= '    \DB::beginTransaction();'.PHP_EOL;
        $data_to_write .= '     try {'.PHP_EOL;
        $data_to_write .= '           $'.$model.'->update(['.PHP_EOL;
        $i = 0;
        foreach ($columns as $key => $value) {
            if (strtolower($value->Field) !== "id" && $value->Field !== "created_at" && $value->Field !== "updated_at") {
                if ($i != 0) {
                    $data_to_write .= ','.PHP_EOL;
                }
                $data_to_write .= "              '".$value->Field."' => ".'$request->'.$value->Field; $i++;
            }
        } 
        $data_to_write .= PHP_EOL;
        $data_to_write .= '          ]);'.PHP_EOL;
        $data_to_write .= '          \DB::commit();'.PHP_EOL;
        $data_to_write .= "          \Session::flash('message', '".$model." update');".PHP_EOL;
        $data_to_write .= '     } catch (\Exception $e) {'.PHP_EOL;
        $data_to_write .= '         \DB::rollBack();'.PHP_EOL;
        $data_to_write .= '         throw $e;'.PHP_EOL;
        $data_to_write .= '     } catch (\Throwable $e) {'.PHP_EOL;
        $data_to_write .= '         \DB::rollBack();'.PHP_EOL;
        $data_to_write .= '         throw $e;'.PHP_EOL;
        $data_to_write .= '     }'.PHP_EOL; 
        $data_to_write .= "     return redirect()->route('".$prefijo.".".$tableName.".index')->with('message', '".$model." Created Successfully');".PHP_EOL;
        $data_to_write .= '  }'.PHP_EOL;
        /*********Método destroy *****************************************************/
        $data_to_write .= '  public function destroy('.$model.' $'.$model.')'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL;
        $data_to_write .= '     \DB::beginTransaction();'.PHP_EOL;
        $data_to_write .= '     try {'.PHP_EOL;
        $data_to_write .= '          \DB::commit();'.PHP_EOL;
        $data_to_write .= "          $".$model."->delete();".PHP_EOL;
        $data_to_write .= "          \Session::flash('message', '".$model." deleted');".PHP_EOL;
        $data_to_write .= '     } catch (\Exception $e) {'.PHP_EOL;
        $data_to_write .= '         \DB::rollBack();'.PHP_EOL;
        $data_to_write .= '         throw $e;'.PHP_EOL;
        $data_to_write .= '     } catch (\Throwable $e) {'.PHP_EOL;
        $data_to_write .= '         \DB::rollBack();'.PHP_EOL;
        $data_to_write .= '         throw $e;'.PHP_EOL;
        $data_to_write .= '     }'.PHP_EOL;  
        $data_to_write .= "     return redirect()->route('".$prefijo.".".$tableName.".index')->with('message', '".$model." Deleted Successfully');".PHP_EOL;
        $data_to_write .= '  }'.PHP_EOL; 
        /*********Método search *****************************************************/
        $data_to_write .= '  public function search(Request $request)'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL;
        $data_to_write .= '     $origin = "search";'.PHP_EOL; 
        $data_to_write .= '     $search = $request->input(\'search\');'.PHP_EOL; 
        $data_to_write .= PHP_EOL; 
        $data_to_write .= '     $resultsSearch = '.$model.'::where(function($query) use ($search) {'.PHP_EOL; 
            foreach ($columns as $key => $value) {
                if ($value->Field !== "id" && $value->Field !== "created_at" && $value->Field !== "updated_at") {
        $data_to_write .= '                          $query->orWhere(\''.$value->Field.'\', \'LIKE\', "%{$search}%")'.PHP_EOL;
                }
            }      
        $data_to_write .= '                       })'.PHP_EOL; 
        $data_to_write .= '                       ->paginate(10);'.PHP_EOL; 
        $data_to_write .= '     return view(\''.$prefijo.".".$tableName.'.index\', compact(\'origin\', \'search\',\'resultsSearch\'));'.PHP_EOL;  
        $data_to_write .= '  }'; 
        /********* Fin de método *************************************************************/
        $data_to_write .= '}'.PHP_EOL; 
        $file_handle = fopen(base_path()."\\app\\Http\\Controllers\\$controller.php", 'w'); 
        fwrite($file_handle, $data_to_write);
        fclose($file_handle);  
        echo $controller,' ->'.$migration." \n";
        //Obteniendo datos de migrations
        echo "database/migrations/".$migration.'.php ';
        /*********************************************************/
        //Mejorando el modelo 
        //require ($base_model.$model.'.php');
        include(base_path().'\app\Models\\'.$model.'.php');
        $modelDB = \App::make('App\Models\\'.$model); 
        //$modelDB = eval("new $model();");
        // switch ($model) {
        //     case 'category': $modelDB = new category();break; 
        //     default: break;
        // }

        
        echo 'table:'.$modelDB->getTable();         
        /********************************************************/
        //Creando vistas (blade)

        /*****************************************/
    }
}
