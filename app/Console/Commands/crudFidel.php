<?php

namespace App\Console\Commands;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use App\Models\category; 
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Process;
//use App\Helpers\loadModels;

class crudFidel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */ 
    //php artisan crud-fidel --controller=CategoryController --model=category --prefijo=modules
    protected $signature = 'crud-fidel {--controller=} {--model=} {--prefijo=} {--auth=}';
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
        $databaseName = \DB::connection()->getDatabaseName();
        $controller = $this->option('controller');
        $model = $this->option('model');
        $auth = $this->option('auth') == '' ? false : true;
        //$migration = $this->option('migration');
        $prefijo = $this->option('prefijo') == '' ? '' : $this->option('prefijo');  
        /************ Comprobar si existe controllers, Model y migration *******************/
        if (!file_exists(base_path()."\app\Http\Controllers\\".$controller.".php")) {
            echo 'No existe el controlador'; exit;
        }
        if (!file_exists(base_path()."\app\models\\".$model.".php")) {
            echo 'No existe el modelo'; exit;
        }
        /*if (!file_exists(base_path()."\database\migrations\\".$migration.".php")) {
            echo 'No existe la migración'; exit;
        }*/
        /************ Cargando model de forma dinamica **********************/
        include(base_path().'\app\Models\\'.$model.'.php');
        $modelDB = \App::make('App\Models\\'.$model); 
        /******* Obteniendo nombre de tabla a partit del model ****************/
        $tableName = $modelDB->getTable();
        $columns = \DB::select("SHOW COLUMNS FROM ".$tableName);
        //dd($columns); exit; 
        ////////////// BUILD REQUEST ////////////////////////////////////////////
        /********** Aqui se construye el archivo request ********************************/
        $data_to_write = '<?php'.PHP_EOL;
        $data_to_write .= ' namespace App\Http\Requests;'.PHP_EOL;
        $data_to_write .= ' use Illuminate\Foundation\Http\FormRequest;'.PHP_EOL;
        $data_to_write .= "\n class ".ucfirst($model)."Request extends FormRequest".PHP_EOL;
        $data_to_write .= '{'.PHP_EOL;
        $data_to_write .= ' public function authorize()'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL;
        $data_to_write .= '      return true;'.PHP_EOL;
        $data_to_write .= '  }'.PHP_EOL;
        $data_to_write .= ' public function rules()'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL;
        $data_to_write .= '   return ['.PHP_EOL;
        $col_req = ''; $col_req2 = ''; $i = 0; $j = 0;
        /********* Cargando columnas de la tabla a partir del model *******************/
            foreach ($columns as $key => $value) {
                /******* Ignorar las columnas id, created_at y updated_at **********************/
                if (strtolower($value->Field) !== "id" && $value->Field !== "created_at" && $value->Field !== "updated_at") {
                    /*************** Logica para la concatenación de comas ********************/
                    if ($i != 0) {
                        $col_req.= ','.PHP_EOL;
                    }
                    $i++;
                    /**************** Fin de logica *******************************************/
                    $col_req .= "      '".$value->Field."' => "; 
                    /********** Si la columna es requerida agregar atributo required al array del metodo reglas ****************/
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
        /************* CREAR CARPETA PREFIJO PARA VIEWS ****************************************/ 
        if ($prefijo != '' && !file_exists(base_path()."\\resources\\views\\".$prefijo)) { 
            mkdir(base_path()."\\resources\\views\\".$prefijo, 0700);
        }
        /************* CREAR VISTAS PARA CRUD **************************************************/
        $ruta_views = $prefijo == '' ? base_path()."\\resources\\views\\".$tableName."\\" : base_path()."\\resources\\views\\".$prefijo."\\".$tableName."\\";
        if ($prefijo != '' && !file_exists($ruta_views)) {
            mkdir($ruta_views, 0700); //creando directorio para las vistas
        }
        /************ VIEW INDEX *************************************************************************/
        $menu_op = ['Lista de '.$tableName,'Crear '.$model, 
                    'Gráfico de registros por año / '.$model, 'Gráfico de registros por mes / '.$model,
                    'Gráfico de registros mes por mes / '.$model,
                   ];
        $menu_cat = ['List','Register','Graphic','Graphic','Graphic'];      
        $menu_rut = ["'".$tableName.'.list'."'","'".$tableName.'.create'."'","'".$tableName.'.YearRegister'."', date('Y') ",
                    "'".$tableName.'.MonthRegister'."',['year' => date('Y') ,'mes' => date('m') ]",
                    "'".$tableName.'.BetweenMonthRegister'."',['year' => date('Y') ,'f_mes' => date('m'),'l_mes' => date('m')+1]"];    

        $data_to_write =  "@extends('layouts.app')".PHP_EOL;
        $data_to_write .= "@section('content')".PHP_EOL;
        $data_to_write .= '<div class="container">'.PHP_EOL;
        $data_to_write .= ' <div class="row">'.PHP_EOL;
        foreach ($menu_op as $k => $title) {
            $data_to_write .= ' <div class="col-4">'.PHP_EOL;
            $data_to_write .= '  <a href="{{ route('.$menu_rut[$k].') }}" class="text-white link_card">'.PHP_EOL;
            $data_to_write .= '   <div class="card text-white bg-primary">'.PHP_EOL; 
            $data_to_write .= '       <div class="card-header text-uppercase">'.$menu_cat[$k].'</div>'.PHP_EOL;
            $data_to_write .= '       <div class="card-body bg-secondary">'.PHP_EOL;
            $data_to_write .= '         <h5 class="card-title">'.$title.'</h5>'.PHP_EOL;
            $data_to_write .= '         <p class="card-text"></p>'.PHP_EOL;
            $data_to_write .= '       </div>'.PHP_EOL; 
            $data_to_write .= '       <div class="card-footer bg-dark border-success">Footer</div>'.PHP_EOL; 
            $data_to_write .= '   </div>'.PHP_EOL; 
            $data_to_write .=  ' </a>'.PHP_EOL; 
            $data_to_write .= ' </div>'.PHP_EOL;  
        }
        $data_to_write .= ' </div>'.PHP_EOL; 
        $data_to_write .= '</div>'.PHP_EOL;  
        $data_to_write .= "@endsection".PHP_EOL;
        $file_handle = fopen($ruta_views."index.blade.php", 'w'); 
        fwrite($file_handle, $data_to_write);
        fclose($file_handle);
        /*********** VIEW LISTA **************************************************************************/
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
        $data_to_write .= '    <a href="{{ route(\''.$tableName.'.create\') }}"'.PHP_EOL; 
        $data_to_write .= '     class="px-4 py-2 rounded-md bg-sky-500 text-sky-100 hover:bg-sky-600">Crear '.$tableName.'</a>'.PHP_EOL; 
        $data_to_write .= '   </div>'.PHP_EOL; 
        $data_to_write .= ' </div>'.PHP_EOL; 
        $data_to_write .= ' <div class="flex flex-col">'.PHP_EOL; 
        $data_to_write .= '   <div class="overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">'.PHP_EOL; 
        $data_to_write .= '     <div class="table-responsive inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">'.PHP_EOL; 
        $data_to_write .= '       <table class="table min-w-full">'.PHP_EOL; 
        $data_to_write .= '          <thead class="thead-dark">'.PHP_EOL; 
        $data_to_write .= '            <tr>'.PHP_EOL; 
                                    foreach ($columns as $key => $value) {
                                        if ($value->Field !== "created_at" && $value->Field !== "updated_at") {
        $data_to_write .= '               <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">'.PHP_EOL; 
        $data_to_write .= '                 '.$value->Field.PHP_EOL; 
        $data_to_write .= '               </th>'.PHP_EOL; 
                                        }
                                    } 
        $data_to_write .= '               <th class="px-6 py-3 text-sm text-left text-gray-500 border-b border-gray-200 bg-gray-50" colspan="2">'.PHP_EOL; 
        $data_to_write .= '                 Action'.PHP_EOL; 
        $data_to_write .= '               </th>'.PHP_EOL; 
        $data_to_write .= '             </tr>'.PHP_EOL;
        $data_to_write .= '          </thead>'.PHP_EOL;
        $data_to_write .= '          <tbody class="bg-white">'.PHP_EOL;
        $data_to_write .= '           @foreach ($'.$model.' as $item)'.PHP_EOL;
        $data_to_write .= '           <tr>'.PHP_EOL; 
                                    foreach ($columns as $key => $value) {
                                         if ($value->Field !== "created_at" && $value->Field !== "updated_at" ) {
        $data_to_write .= '               <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">'.PHP_EOL;
        $data_to_write .= '                 <div class="flex items-center">'.PHP_EOL; 
        $data_to_write .= '                        {{ $item->'.$value->Field.' }}'.PHP_EOL; 
        $data_to_write .= '                 </div>'.PHP_EOL;
        $data_to_write .= '               </td>'.PHP_EOL; 
                                         }
                                    } 
        $data_to_write .= '               <td>'.PHP_EOL;  
        $data_to_write .= '                 <form action="{{ route(\''.$tableName.'.destroy\',$item->id) }}" method="POST">'.PHP_EOL; 
        $data_to_write .= '                   <a class="fa-regular fa-eye" href="{{ route(\''.$tableName.'.show\',$item->id) }}"></a>'.PHP_EOL;
        $data_to_write .= '                   <a class="fa-solid fa-square-pen" href="{{ route(\''.$tableName.'.edit\',$item->id) }}"></a>'.PHP_EOL;
        $data_to_write .= '                   @csrf'.PHP_EOL; 
        $data_to_write .= "                   @method('DELETE')".PHP_EOL; 
        $data_to_write .= '                   <button type="submit" class="fa-solid fa-trash-can"></button>'.PHP_EOL; 
        $data_to_write .= '                 </form>'.PHP_EOL; 
        $data_to_write .= '               </td>'.PHP_EOL;         
        $data_to_write .= '            </tr>'.PHP_EOL; 
        $data_to_write .= '            @endforeach()'.PHP_EOL; 
        $data_to_write .= '           </tbody>'.PHP_EOL; 
        $data_to_write .= '       </table>'.PHP_EOL; 
        $data_to_write .= '    </div>'.PHP_EOL; 
        $data_to_write .= '   </div>'.PHP_EOL; 
        $data_to_write .= ' </div>'.PHP_EOL; 
        $data_to_write .= '</div>'.PHP_EOL; 
        $data_to_write .= "@endsection".PHP_EOL;
        $data_to_write .= "@push('footer')".PHP_EOL; 
        $data_to_write .= "@endpush('footer')".PHP_EOL; 
        $file_handle = fopen($ruta_views."list.blade.php", 'w'); 
        fwrite($file_handle, $data_to_write);
        fclose($file_handle);
        /*************************** VISTA CREATE **************************************************/
        $data_to_write = "@extends('layouts.app')".PHP_EOL;
        $data_to_write .= "@section('content')".PHP_EOL;
        $data_to_write .= '<div class="container">'.PHP_EOL; 
        $data_to_write .= '  <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">'.PHP_EOL;  
        $data_to_write .= '    <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-4xl">'.PHP_EOL; 
        $data_to_write .= '        <div class="mb-4">'.PHP_EOL; 
        $data_to_write .= '            <h1 class="font-serif text-3xl font-bold">Crear '.$model.'</h1>'.PHP_EOL; 
        $data_to_write .= '        </div>'.PHP_EOL; 
        $data_to_write .= '  <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">'.PHP_EOL; 
        $data_to_write .= '      <form method="POST" action="{{ route(\''.$tableName.'.store\') }}">'.PHP_EOL; 
        $data_to_write .= '        @csrf'.PHP_EOL; 
                            foreach ($columns as $key => $value) {
                                if ($value->Field !== "id" && $value->Field !== "created_at" && $value->Field !== "updated_at") {
                                    $type_input = strpos('bigint unsigned', $value->Type)  === false ? '' :'select';
                                    $type_input = strpos('bigint', $value->Type)  === false ? $type_input : 'select';
                                    $type_input = strpos('double', $value->Type)  === false ? $type_input : 'number';
                                    $type_input = strpos('float', $value->Type)  === false ? $type_input : 'number';
                                    $type_input = strpos('int', $value->Type)  === false ? $type_input : 'number';
                                    $type_input = strpos('text', $value->Type)  === false ? $type_input : 'text';
                                    $type_input = strpos('varchar', $value->Type)  === false ? $type_input : 'varchar';
                                    $type_input = $value->Type == 'date' ? 'date' : $type_input ;
                                    $type_input = $value->Type == 'timestamp' ? 'date' : $type_input;

        $data_to_write .= '          <!-- '.$value->Type.' '.$type_input.'-->'.PHP_EOL; 
        $data_to_write .= '          <div>'.PHP_EOL; 
        $data_to_write .= '              <label class="block text-sm font-medium text-gray-700" for="'.$model.'_'.$value->Field.'">'.PHP_EOL; 
        $required = $value->Null == 'NO' ? '*' : '';
        $data_to_write .= '                '.$value->Field.' '.$required.PHP_EOL; 
        $data_to_write .= '              </label>'.PHP_EOL;  

                                    switch ($type_input) {
                                        case 'select':
        $data_to_write .= '                <select id="'.$model.'_'.$value->Field.'"'.PHP_EOL;
        $data_to_write .= '                class="form-control block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"'.PHP_EOL;
        $data_to_write .= '                 name="'.$value->Field.'" placeholder="180" value="{{old(\''.$value->Field.'\')}}">'.PHP_EOL; 
                                                if ($value->Field == 'parent_id') {
        $data_to_write .= '                          <option value="0">Superior</option>'.PHP_EOL;                                             
                                                }
                                                else{
        $data_to_write .= '                          <option value="">Seleccione '.$value->Field.'</option>'.PHP_EOL;                                             
                                                } 
        $data_to_write .= '                  @foreach ($list_'.$value->Field.' as $item)'.PHP_EOL;  
        $data_to_write .= '                    <option value="{{ $item->id }}">'.PHP_EOL; 
        $data_to_write .= '                        @if(isset($item->name))'.PHP_EOL; 
        $data_to_write .= '                          {{ $item->name }}'.PHP_EOL; 
        $data_to_write .= '                        @else'.PHP_EOL; 
        $data_to_write .= '                          @if(isset($item->title))'.PHP_EOL; 
        $data_to_write .= '                           {{ $item->title }}'.PHP_EOL; 
        $data_to_write .= '                          @else'.PHP_EOL;
        $data_to_write .= '                           @if(isset($item->description))'.PHP_EOL; 
        $data_to_write .= '                           {{ $item->description }}'.PHP_EOL;
        $data_to_write .= '                           @endif'.PHP_EOL;
        $data_to_write .= '                          @endif'.PHP_EOL;                                    
        $data_to_write .= '                        @endif'.PHP_EOL;  
        $data_to_write .= '                    </option>'.PHP_EOL;  
        $data_to_write .= '                  @endforeach()'.PHP_EOL;  
        $data_to_write .= '                </select>'.PHP_EOL;  
                                            break;
                                        case 'text':
        $data_to_write .= '                <text id="'.$model.'_'.$value->Field.'"'.PHP_EOL;
        $data_to_write .= '                class="form-control block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"'.PHP_EOL;
        $data_to_write .= '                 name="'.$value->Field.'" placeholder="Input '.$value->Field.'" value="{{old(\''.$value->Field.'\')}}"></text>'.PHP_EOL;  
                                            break;
                                            
                                        default:
        $data_to_write .= '                <input id="'.$model.'_'.$value->Field.'"'.PHP_EOL;
        $data_to_write .= '                class="form-control block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"'.PHP_EOL;
        $data_to_write .= '                type="text" name="'.$value->Field.'" placeholder="Input '.$value->Field.'" value="{{old(\''.$value->Field.'\')}}">'.PHP_EOL;  
                                           break;
                                    }
        
        $data_to_write .= '              @error(\''.$value->Field.'\')'.PHP_EOL;  
        $data_to_write .= '              <span class="text-red-600 text-sm">'.PHP_EOL;  
        $data_to_write .= '                {{ $message }}'.PHP_EOL;  
        $data_to_write .= '              </span>'.PHP_EOL;  
        $data_to_write .= '              @enderror'.PHP_EOL;  
        $data_to_write .= '         </div>'.PHP_EOL; 
                                }
                            }        
        $data_to_write .= '                    <br>'.PHP_EOL;                                           
        $data_to_write .= '                    <button type="submit" class="btn btn-primary">Crear '.$model.'</button>'.PHP_EOL;  
        $data_to_write .= '            </form>'.PHP_EOL;  
        $data_to_write .= '        </div>'.PHP_EOL;  
        $data_to_write .= '    </div>'.PHP_EOL;  
        $data_to_write .= '</div>'.PHP_EOL;  
        $data_to_write .= '</div>'.PHP_EOL;  
        $file_handle = fopen($ruta_views."create.blade.php", 'w'); 
        fwrite($file_handle, $data_to_write);
        fclose($file_handle); 
        /*************************** VISTA EDIT **************************************************/
        $data_to_write = "@extends('layouts.app')".PHP_EOL;
        $data_to_write .= "@section('content')".PHP_EOL;
        $data_to_write .= '<div class="container">'.PHP_EOL; 
        $data_to_write .= '  <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">'.PHP_EOL;  
        $data_to_write .= '    <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-4xl">'.PHP_EOL; 
        $data_to_write .= '        <div class="mb-4">'.PHP_EOL; 
        $data_to_write .= '            <h1 class="font-serif text-3xl font-bold">Editar '.$model.'</h1>'.PHP_EOL; 
        $data_to_write .= '        </div>'.PHP_EOL; 
        $data_to_write .= '    <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">'.PHP_EOL; 
        $data_to_write .= '      <form method="POST" action="{{ route(\''.$tableName.'.update\',$'.$model.'->id) }}">'.PHP_EOL; 
        $data_to_write .= '        @csrf'.PHP_EOL;  
        $data_to_write .= "        @method('PUT')".PHP_EOL;  
                            foreach ($columns as $key => $value) {
                                if ($value->Field !== "id" && $value->Field !== "created_at" && $value->Field !== "updated_at") {
                                    $type_input = strpos('bigint unsigned', $value->Type)  === false ? '' :'select';
                                    $type_input = strpos('bigint', $value->Type)  === false ? $type_input : 'select';
                                    $type_input = strpos('double', $value->Type)  === false ? $type_input : 'number';
                                    $type_input = strpos('float', $value->Type)  === false ? $type_input : 'number';
                                    $type_input = strpos('int', $value->Type)  === false ? $type_input : 'number';
                                    $type_input = strpos('text', $value->Type)  === false ? $type_input : 'text';
                                    $type_input = strpos('varchar', $value->Type)  === false ? $type_input : 'varchar';
                                    $type_input = $value->Type == 'date' ? 'date' : $type_input ;
                                    $type_input = $value->Type == 'timestamp' ? 'date' : $type_input;

        $data_to_write .= '          <!-- '.$value->Type.' '.$type_input.'-->'.PHP_EOL; 
        $data_to_write .= '          <div>'.PHP_EOL; 
        $data_to_write .= '              <label class="block text-sm font-medium text-gray-700" for="'.$model.'_'.$value->Field.'">'.PHP_EOL; 
        $required = $value->Null == 'NO' ? '*' : '';
        $data_to_write .= '                '.$value->Field.' '.$required.PHP_EOL; 
        $data_to_write .= '              </label>'.PHP_EOL;  

                                    switch ($type_input) {
                                        case 'select':
        $data_to_write .= '                <select id="'.$model.'_'.$value->Field.'"'.PHP_EOL;
        $data_to_write .= '                class="form-control block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"'.PHP_EOL;
        $data_to_write .= '                 name="'.$value->Field.'" placeholder="180">'.PHP_EOL; 
                                                if ($value->Field == 'parent_id') {
        $data_to_write .= '                          <option value="0">Superior</option>'.PHP_EOL;                                             
                                                }
                                                else{
        $data_to_write .= '                          <option value="">Seleccione '.$value->Field.'</option>'.PHP_EOL;                                             
                                                } 
        $data_to_write .= '                  @foreach ($'.$value->Field.' as $item)'.PHP_EOL;  
        $data_to_write .= '                    <option value="{{ $item->id }}">'.PHP_EOL; 
        $data_to_write .= '                        @if(isset($item->name))'.PHP_EOL; 
        $data_to_write .= '                          {{ $item->name }}'.PHP_EOL; 
        $data_to_write .= '                        @else'.PHP_EOL; 
        $data_to_write .= '                          @if(isset($item->title))'.PHP_EOL; 
        $data_to_write .= '                           {{ $item->title }}'.PHP_EOL; 
        $data_to_write .= '                          @else'.PHP_EOL;
        $data_to_write .= '                           @if(isset($item->description))'.PHP_EOL; 
        $data_to_write .= '                           {{ $item->description }}'.PHP_EOL;
        $data_to_write .= '                           @endif'.PHP_EOL;
        $data_to_write .= '                          @endif'.PHP_EOL;                                    
        $data_to_write .= '                        @endif'.PHP_EOL;  
        $data_to_write .= '                    </option>'.PHP_EOL;  
        $data_to_write .= '                  @endforeach()'.PHP_EOL;  
        $data_to_write .= '                </select>'.PHP_EOL;  
                                            break;
                                        case 'text':
        $data_to_write .= '                <text id="'.$model.'_'.$value->Field.'"'.PHP_EOL;
        $data_to_write .= '                class="form-control block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"'.PHP_EOL;
        $data_to_write .= '                 name="'.$value->Field.'" placeholder="Input '.$value->Field.'" value="{{ $'.$model.'->'.$value->Field.' }}"></text>'.PHP_EOL;  
                                            break;
                                            
                                        default:
        $data_to_write .= '                <input id="'.$model.'_'.$value->Field.'"'.PHP_EOL;
        $data_to_write .= '                class="form-control block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"'.PHP_EOL;
        $data_to_write .= '                type="text" name="'.$value->Field.'" placeholder="Input '.$value->Field.'" value="{{ $'.$model.'->'.$value->Field.' }}">'.PHP_EOL;  
                                           break;
                                    }
        
        $data_to_write .= '              @error(\''.$value->Field.'\')'.PHP_EOL;  
        $data_to_write .= '              <span class="text-red-600 text-sm">'.PHP_EOL;  
        $data_to_write .= '                {{ $message }}'.PHP_EOL;  
        $data_to_write .= '              </span>'.PHP_EOL;  
        $data_to_write .= '              @enderror'.PHP_EOL;  
        $data_to_write .= '         </div>'.PHP_EOL; 
                                }
                            }        
        $data_to_write .= '                    <br>'.PHP_EOL;                                           
        $data_to_write .= '                    <button type="submit" class="btn btn-primary">Actualizar '.$model.'</button>'.PHP_EOL;  
        $data_to_write .= '            </form>'.PHP_EOL;  
        $data_to_write .= '        </div>'.PHP_EOL;  
        $data_to_write .= '    </div>'.PHP_EOL;  
        $data_to_write .= '</div>'.PHP_EOL;  
        $data_to_write .= '</div>'.PHP_EOL;  
        $file_handle = fopen($ruta_views."edit.blade.php", 'w'); 
        fwrite($file_handle, $data_to_write);
        fclose($file_handle); 
        /*************************** VISTA SHOW **************************************************/
        $data_to_write = "@extends('layouts.app')".PHP_EOL;
        $data_to_write .= "@section('content')".PHP_EOL;
        $data_to_write .= '<div class="container">'.PHP_EOL; 
        $data_to_write .= ' <div class="max-w-4xl mx-auto mt-8">'.PHP_EOL; 
        $data_to_write .= '  <div class="mb-4">'.PHP_EOL; 
        $data_to_write .= '    <h1 class="text-3xl font-bold">'.PHP_EOL; 
        $data_to_write .= '        Mostrar '.$model.PHP_EOL; 
        $data_to_write .= '    </h1>'.PHP_EOL; 
        $data_to_write .= '    <div class="flex justify-end mt-5">'.PHP_EOL; 
        $data_to_write .= '        <a class="px-2 py-1 rounded-md bg-sky-500 text-sky-100 hover:bg-sky-600" href="{{ route(\''.$tableName.'.index\') }}">< Atrás</a>'.PHP_EOL; 
        $data_to_write .= '    </div>'.PHP_EOL; 
        $data_to_write .= '  </div>'.PHP_EOL; 
        $data_to_write .= ' </div>'.PHP_EOL;   
        foreach ($columns as $key => $value) {
            if ($value->Field !== "id") {
        $data_to_write .= '<div class="flex flex-col mt-5">'.PHP_EOL;   
        $data_to_write .= '  <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">'.PHP_EOL;   
        $data_to_write .= '    <h3 class="text-2xl font-semibold"> '.$value->Field.' </h3>'.PHP_EOL;   
        $data_to_write .= '    <p class="text-base text-gray-700 mt-5">{{ $'.$model.'->'.$value->Field.' }}</p>'.PHP_EOL;   
        $data_to_write .= '  </div>'.PHP_EOL;   
        $data_to_write .= '</div>'.PHP_EOL;   
            }  
        }
        $data_to_write .= '</div>'.PHP_EOL;   
        $file_handle = fopen($ruta_views."show.blade.php", 'w'); 
        fwrite($file_handle, $data_to_write);
        fclose($file_handle); 
        /*********************DATE: YearRegister***********************************/
        $data_to_write = "@extends('layouts.app')".PHP_EOL;
        $data_to_write .= "@section('content')".PHP_EOL;
        $data_to_write .= '<div class="container">'.PHP_EOL; 
        $data_to_write .= ' <div class="max-w-4xl mx-auto mt-8">'.PHP_EOL; 
        $data_to_write .= '  <div class="mb-4">'.PHP_EOL; 
        $data_to_write .= '    <h1 class="text-3xl font-bold">'.PHP_EOL; 
        $data_to_write .= '        Gráfico de registros por año / '.$model.PHP_EOL; 
        $data_to_write .= '    </h1>'.PHP_EOL;  
        $data_to_write .= '  </div>'.PHP_EOL; 
        $data_to_write .= ' </div>'.PHP_EOL;   
        $data_to_write .= ' <div class="chart-container row" style="position: relative; ">'.PHP_EOL;   
        $data_to_write .= '   <div class="col">'.PHP_EOL;   
        $data_to_write .= '     <canvas id="myChartBar" width="400px" height="100%"></canvas>'.PHP_EOL;   
        $data_to_write .= '   </div>'.PHP_EOL;   
        $data_to_write .= '   <div class="col">'.PHP_EOL;  
        $data_to_write .= '     <canvas id="myChartLine" width="400px" height="100%"></canvas>'.PHP_EOL;  
        $data_to_write .= '   </div> '.PHP_EOL;  
        $data_to_write .= ' </div>'.PHP_EOL;   
        $data_to_write .= '</div>'.PHP_EOL;   
        $data_to_write .= "@endsection".PHP_EOL;
        $data_to_write .= "@push('scripts')".PHP_EOL;  
        $data_to_write .= ' <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>'.PHP_EOL; 
        $data_to_write .= ' <script type="text/javascript">'.PHP_EOL; 
        $data_to_write .= '  var labels =  {{ Js::from($labels) }};'.PHP_EOL; 
        $data_to_write .= '  var datos =  {{ Js::from($data) }};'.PHP_EOL; 
        $data_to_write .= '  const data = {'.PHP_EOL; 
        $data_to_write .= '  labels: labels,'.PHP_EOL; 
        $data_to_write .= '  datasets: [{'.PHP_EOL; 
        $data_to_write .= '   label: {{ Js::from($label) }},'.PHP_EOL; 
        $data_to_write .= '   backgroundColor: \'rgb(255, 99, 132)\','.PHP_EOL; 
        $data_to_write .= '   borderColor: \'rgb(255, 99, 132)\','.PHP_EOL; 
        $data_to_write .= '   data: datos,'.PHP_EOL; 
        $data_to_write .= '  }]'.PHP_EOL; 
        $data_to_write .='  };'.PHP_EOL; 
        $data_to_write .='  const config1 = {'.PHP_EOL; 
        $data_to_write .='     type: \'bar\','.PHP_EOL; 
        $data_to_write .='     data: data,'.PHP_EOL; 
        $data_to_write .='     options: {}'.PHP_EOL; 
        $data_to_write .='   };'.PHP_EOL;  
        $data_to_write .='  const config2 = {'.PHP_EOL; 
        $data_to_write .='     type: \'line\','.PHP_EOL; 
        $data_to_write .='     data: data,'.PHP_EOL; 
        $data_to_write .='     options: {}'.PHP_EOL; 
        $data_to_write .='   };'.PHP_EOL;  
        $data_to_write .='  const myChart1 = new Chart('.PHP_EOL; 
        $data_to_write .='   document.getElementById(\'myChartBar\'),'.PHP_EOL; 
        $data_to_write .='   config1'.PHP_EOL; 
        $data_to_write .='  );'.PHP_EOL; 
        $data_to_write .='  const myChart2 = new Chart('.PHP_EOL; 
        $data_to_write .='   document.getElementById(\'myChartLine\'),'.PHP_EOL; 
        $data_to_write .='   config2'.PHP_EOL; 
        $data_to_write .='  );'.PHP_EOL; 
        $data_to_write .=' </script>'.PHP_EOL; 
        $data_to_write .= "@endpush('scripts')".PHP_EOL; 
        $file_handle = fopen($ruta_views."date_year_register.blade.php", 'w'); 
        fwrite($file_handle, $data_to_write);
        fclose($file_handle);
        /********************************** CONSTRUYENDO LAS RUTAS *************************************/
        $data_to_write = file_get_contents(base_path()."\\routes\\web.php"); 
        $file_handle = fopen(base_path()."\\routes\\web.php", 'w');  
        $data_to_write .= PHP_EOL;
        //Agregar autenticación a las rutas en caso se defina desde el comando
        $auth_b = $auth == true ? "->middleware(['auth']);" : "";
        $data_to_write .= "/********************** RUTAS DE $tableName *********************************************************"."/".PHP_EOL;
        $data_to_write .= "Route::get('/$tableName', [App\Http\Controllers\\".$controller."::class, 'index'])->name('".$tableName.".index')$auth_b;".PHP_EOL;
        $data_to_write .= "Route::get('/$tableName/list', [App\Http\Controllers\\".$controller."::class, 'list'])->name('".$tableName.".list')$auth_b;".PHP_EOL;
        $data_to_write .= "Route::get('/$tableName/create', [App\Http\Controllers\\".$controller."::class, 'create'])->name('".$tableName.".create')$auth_b;".PHP_EOL;
        $data_to_write .= "Route::post('/$tableName/store', [App\Http\Controllers\\".$controller."::class, 'store'])->name('".$tableName.".store')$auth_b;".PHP_EOL;
        $data_to_write .= "Route::get('/$tableName/show/{id}', [App\Http\Controllers\\".$controller."::class, 'show'])->name('".$tableName.".show')$auth_b;".PHP_EOL;
        $data_to_write .= "Route::get('/$tableName/edit/{id}', [App\Http\Controllers\\".$controller."::class, 'edit'])->name('".$tableName.".edit')$auth_b;".PHP_EOL;
        $data_to_write .= "Route::put('/$tableName/update/{".$model."}', [App\Http\Controllers\\".$controller."::class, 'update'])->name('".$tableName.".update')$auth_b;".PHP_EOL;
        $data_to_write .= "Route::delete('/$tableName/destroy/{id}', [App\Http\Controllers\\".$controller."::class, 'destroy'])->name('".$tableName.".destroy')$auth_b;".PHP_EOL;
        $ruta_year = $model.'YearRegister';
        $ruta_mes = $model.'MonthRegister';
        $ruta_entre_mes = $model.'BetweenMonthRegister';
        $data_to_write .= "Route::get('/$tableName/$ruta_year/{year}', [App\Http\Controllers\\".$controller."::class, '$ruta_year'])->name('".$tableName.".YearRegister')$auth_b;".PHP_EOL;
        $data_to_write .= "Route::get('/$tableName/$ruta_mes/{year}/{mes}', [App\Http\Controllers\\".$controller."::class, '$ruta_mes'])->name('".$tableName.".MonthRegister')$auth_b;".PHP_EOL;
        $data_to_write .= "Route::get('/$tableName/$ruta_entre_mes/{year}/{f_mes}/{l_mes}', [App\Http\Controllers\\".$controller."::class, '$ruta_entre_mes'])->name('".$tableName.".BetweenMonthRegister')$auth_b;".PHP_EOL;
        $data_to_write .= "/******************** FIN RUTAS DE $tableName ***************************************************"."/".PHP_EOL;
        fwrite($file_handle, $data_to_write);
        fclose($file_handle);       
        /////////////////////////////// CONSTRUYENDO EL MODELO ////////////////////////////////////////////
        $query_ref = "SELECT RefCons.constraint_schema, RefCons.table_name, RefCons.referenced_table_name, RefCons.constraint_name, KeyCol.column_name
                      FROM information_schema.referential_constraints RefCons
                      JOIN information_schema.key_column_usage KeyCol ON RefCons.constraint_schema = KeyCol.table_schema
                            AND RefCons.table_name = KeyCol.table_name
                            AND RefCons.constraint_name = KeyCol.constraint_name
                      WHERE RefCons.constraint_schema = '$databaseName' and RefCons.constraint_name = '".$tableName."_";

        $data_to_write = '<?php'.PHP_EOL;
        $data_to_write .= PHP_EOL;                    
        $data_to_write .= 'namespace App\Models;'.PHP_EOL;
        $fillable = ''; $i_fill = 0;
        foreach ($columns as $key => $value) {
            $type_input = strpos('bigint unsigned', $value->Type)  === false ? false : true; 
            if ($type_input == true && $value->Field !== "id") {
            /**********Query mysql para capturar tabla de referencia de llave foranea */
                $foreign = \DB::select($query_ref.$value->Field."_foreign'"); 
                if (count($foreign)) {
                    $foreign_table = trim($foreign[0]->REFERENCED_TABLE_NAME);
                    $className =  Str::studly(Str::singular($foreign_table));
        $data_to_write .= 'use App\\Models\\'.$className.';'.PHP_EOL;
                }
            }
            if ($value->Field !== "id" && $value->Field !== "created_at" && $value->Field !== "updated_at") {
                if ($i_fill != 0) {
                    $fillable .= ',';
                }
                $fillable .= "'".$value->Field."'"; $i_fill++;
            }
        } 
        $data_to_write .= 'use Illuminate\Database\Eloquent\Factories\HasFactory;'.PHP_EOL;
        $data_to_write .= 'use Illuminate\Database\Eloquent\Model;'.PHP_EOL;
        $data_to_write .= PHP_EOL;    
        $data_to_write .= 'class '.$model.' extends Model'.PHP_EOL;  
        $data_to_write .= '{'.PHP_EOL;  
        $data_to_write .= '   use HasFactory;'.PHP_EOL.PHP_EOL;  
        $data_to_write .= '   protected $fillable = ['.PHP_EOL;  
        $data_to_write .=  $fillable.PHP_EOL;
        $data_to_write .= '];'.PHP_EOL;  
        $metodos_model = array();
        foreach ($columns as $key => $value2) {
            $type_input = strpos('bigint unsigned', $value2->Type)  === false ? false : true; 
            if ($type_input == true && $value2->Field !== "id") {
            /**********Query mysql para capturar tabla de referencia de llave foranea */
                $foreign = \DB::select($query_ref.$value2->Field."_foreign'"); 
                if (count($foreign)) {
                    //dd($foreign[0]->REFERENCED_TABLE_NAME); exit; 
                    $metodos_model[] = $value2->Field;
        $data_to_write .= '   public function list_'.$value2->Field.'()'.PHP_EOL;  
        $data_to_write .= '   {'.PHP_EOL;
                                //$name_field = $value->Field;
                                //$className = get_class($faq->foreign_table()->getRelated());
        $data_to_write .= '      return '.$className."::get();".PHP_EOL;  
        //$data_to_write .= '     return $this->hasMany('."'App\\Models\\$foreign_table'::class,'$name_field');".PHP_EOL;  
        $data_to_write .= '   }'.PHP_EOL;
                }
            }  
             
            //if ($value->Field === "parent_id") {
            $type_input2 = strpos('parent_id', $value2->Field) === false ? false : true; 
            if ($type_input2 == true && $value2->Field !== "id") {
                //echo 'fidel';
                $metodos_model[] = $value2->Field;
        $data_to_write .= '   public function list_'.$value2->Field.'()'.PHP_EOL;    
        $data_to_write .= '   {';    
        $data_to_write .= '      return '.$model.'::get();'.PHP_EOL;     
        $data_to_write .= '   }'.PHP_EOL;     
        $data_to_write .= '   public function parent(): BelongsTo'.PHP_EOL; 
        $data_to_write .= '   {'.PHP_EOL; 
        $data_to_write .= '     return $this->belongsTo(self::class, \'parent_id\');'.PHP_EOL; 
        $data_to_write .= '   }'.PHP_EOL;  
        $data_to_write .= PHP_EOL;  
        $data_to_write .= '   public function parentRecursive(): BelongsTo'.PHP_EOL; 
        $data_to_write .= '   {'.PHP_EOL; 
        $data_to_write .= '     /***Ejemplo: Obtener todos los nodos del padre (Estructura arbol)**/';
        $data_to_write .= '     /*$user = '.$model."::find(8); **/".PHP_EOL; 
        $data_to_write .= '     /*$parent = '.$model.'->parentRecursive;  4,2,1 */'.PHP_EOL; 
        $data_to_write .= '     return $this->parent()->with(\'parentRecursive\');'.PHP_EOL; 
        $data_to_write .= '   }'.PHP_EOL;
        $data_to_write .= PHP_EOL;   
        $data_to_write .= '   public function children(): HasMany'.PHP_EOL; 
        $data_to_write .= '   {'.PHP_EOL; 
        $data_to_write .= '     return $this->hasMany(self::class, \'parent_id\');'.PHP_EOL; 
        $data_to_write .= '   }'.PHP_EOL; 
        $data_to_write .= '   public function childrenRecursive(): HasMany'.PHP_EOL; 
        $data_to_write .= '   {'.PHP_EOL; 
        $data_to_write .= '     return $this->children()->with(\'childrenRecursive\');'.PHP_EOL; 
        $data_to_write .= '   }'.PHP_EOL; 
            }
            //}   
        }
        $data_to_write .= '}'.PHP_EOL;   
        $file_handle = fopen(base_path()."\\app\\Models\\$model.php", 'w'); 
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
        $data_to_write .= '  private $meses = [\'Enero\',\'Febrero\',\'Marzo\',\'Abril\',\'Mayo\',\'Junio\',\'Julio\',\'Agosto\',\'Setiembre\',\'Octubre\',\'Noviembre\',\'Diciembre\'];'.PHP_EOL;
        /******************* Método index *****************************************************/
        $data_to_write .= '  public function index()'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL; 
        $data_to_write .= "    return view('".$prefijo.".".$tableName.".index');".PHP_EOL;
        $data_to_write .= '  }'.PHP_EOL; 
        /******************* Método List *****************************************************/
        $data_to_write .= '  public function list()'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL;
        $data_to_write .= '    $'.$model.' = '.$model.'::latest()->paginate(10);'.PHP_EOL;
        $data_to_write .= "    return view('".$prefijo.".".$tableName.".list', compact('".$model."'));".PHP_EOL;
        $data_to_write .= '  }'.PHP_EOL; 
        /******************* Método create *****************************************************/
        $data_to_write .= '  public function create()'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL;
        $data_to_write .= '     $'.$model.' = new '.$model.'();'.PHP_EOL;    
        $data_to_write .= '     $list_'.$model.' = '.$model.'::latest()->paginate(10);'.PHP_EOL;
        $compact = '';
        if (count($metodos_model)) {
            foreach ($metodos_model as $key => $value) {
        $data_to_write .= '     $list_'.$value.' = $'.$model.'->list_'.$value.'();'.PHP_EOL;
                $compact.=",'list_$value'";
            }
        }
        $data_to_write .= "     return view('".$prefijo.".".$tableName.".create', compact('list_".$model."'$compact));".PHP_EOL;
        $data_to_write .= '  }'.PHP_EOL; 
        /*******************Método store ******************************************************************/
        $data_to_write .= '  public function store('.ucfirst($model).'Request $request)'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL;
        $data_to_write .= '     \DB::beginTransaction();'.PHP_EOL;
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
        $data_to_write .= PHP_EOL;
        $data_to_write .= "     return redirect()->route('".$tableName.".list')->with('message', '".$model." Created Successfully');".PHP_EOL;
        $data_to_write .= '  }'.PHP_EOL; 
        /********************Método show *****************************************************************/
        $data_to_write .= '  public function show($id)'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL; 
        $data_to_write .= '     $'.$model.' = '.$model.'::find($id);'.PHP_EOL;    
        $data_to_write .= "     return view('".$prefijo.".".$tableName.".show', compact('".$model."'));".PHP_EOL;
        $data_to_write .= '  }'.PHP_EOL;
        /********************Método edit ******************************************************************/
        $data_to_write .= '  public function edit($id)'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL; 
        $data_to_write .= '     $'.$model.' = '.$model.'::find($id);'.PHP_EOL;     
            $compact = '';
        if (count($metodos_model)) {
            foreach ($metodos_model as $key => $value) {
        $data_to_write .= '     $'.$value.' = $'.$model.'->list_'.$value.'();'.PHP_EOL;
                $compact.=",'$value'";
            }
        }
        $data_to_write .= "     return view('".$prefijo.".".$tableName.".edit', compact('".$model."'$compact));".PHP_EOL;
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
        $data_to_write .= "     return redirect()->route('".$tableName.".list')->with('message', '".$model." updated Successfully');".PHP_EOL;
        $data_to_write .= '  }'.PHP_EOL;
        /*********Método destroy *****************************************************/
        $data_to_write .= '  public function destroy($id)'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL;
        $data_to_write .= '     \DB::beginTransaction();'.PHP_EOL;
        $data_to_write .= '     try {'.PHP_EOL;
        $data_to_write .= '          \DB::commit();'.PHP_EOL;
        $data_to_write .= '          $'.$model.' = '.$model.'::find($id)->delete();'.PHP_EOL;      
        $data_to_write .= "          \Session::flash('message', '".$model." deleted');".PHP_EOL;
        $data_to_write .= '     } catch (\Exception $e) {'.PHP_EOL;
        $data_to_write .= '         \DB::rollBack();'.PHP_EOL;
        $data_to_write .= '         throw $e;'.PHP_EOL;
        $data_to_write .= '     } catch (\Throwable $e) {'.PHP_EOL;
        $data_to_write .= '         \DB::rollBack();'.PHP_EOL;
        $data_to_write .= '         throw $e;'.PHP_EOL;
        $data_to_write .= '     }'.PHP_EOL;  
        $data_to_write .= "     return redirect()->route('".$tableName.".list')->with('message', '".$model." Deleted Successfully');".PHP_EOL;
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
        $data_to_write .= '                          $query->orWhere(\''.$value->Field.'\', \'LIKE\', "%{$search}%");'.PHP_EOL;
                }
            }      
        $data_to_write .= '                       })'.PHP_EOL; 
        $data_to_write .= '                       ->paginate(10);'.PHP_EOL; 
        $data_to_write .= '     return view(\''.$prefijo.".".$tableName.'.list\', compact(\'origin\', \'search\',\'resultsSearch\'));'.PHP_EOL;  
        $data_to_write .= '  }'.PHP_EOL;
        /*************** Método  FECHAS ******************************************************/
        $data_to_write .= '  public function '.$model.'YearRegister($year = \'\')'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL;
        $data_to_write .= '     $year = $year == \'\' ? date(\'Y\') : $year;'.PHP_EOL; 
        $data_to_write .= '     $result = '.$model.'::select(\DB::raw("COUNT(*) as count"), \DB::raw("MONTH(created_at) as month_name"))'.PHP_EOL; 
        $data_to_write .= '     ->whereYear(\'created_at\', $year)'.PHP_EOL; 
        $data_to_write .= '     ->groupBy(\DB::raw("Month(created_at)"))'.PHP_EOL; 
        $data_to_write .= "     ->pluck('count', 'month_name');".PHP_EOL; 
        $data_to_write .= '     $label_data = $result->keys();'.PHP_EOL; 
        $data_to_write .= '     $labels = [];'.PHP_EOL; 
        $data_to_write .= '     foreach ($label_data as $key => $value) {'.PHP_EOL; 
        $data_to_write .= '       $labels[$key] = $this->meses[$value-1];'.PHP_EOL; 
        $data_to_write .= '     }'.PHP_EOL; 
        $data_to_write .= '     $data = $result->values();'.PHP_EOL; 
        $data_to_write .= '     $label = \'Cantidad de registros del año \'.$year;'.PHP_EOL; 
        $data_to_write .= '     return view(\''.$prefijo.".".$tableName.'.date_year_register\', compact(\'label\',\'labels\',\'data\'));'.PHP_EOL;  
        $data_to_write .= '  }'.PHP_EOL;
        $data_to_write .= '  public function '.$model.'MonthRegister($year = \'\',$mes = \'\')'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL;
        $data_to_write .= '     $year = $year == \'\' ? date(\'Y\') : $year;'.PHP_EOL;
        $data_to_write .= '     $mes = $mes == \'\' ? date(\'m\') : $mes;'.PHP_EOL;
        $data_to_write .= '     $result = '.$model.'::whereYear(\'created_at\', $year)'.PHP_EOL;
        $data_to_write .= '     ->whereMonth(\'created_at\',$mes)'.PHP_EOL;
	    $data_to_write .= "     ->get();".PHP_EOL;
        $data_to_write .= '     $labels = $result->keys();'.PHP_EOL;
        $data_to_write .= '     $data = $result->values();'.PHP_EOL;
        $data_to_write .= '     return view(\''.$prefijo.".".$tableName.'.index\', compact(\'labels\',\'data\'));'.PHP_EOL;  
        $data_to_write .= '  }'.PHP_EOL;
        $data_to_write .= '  public function '.$model.'BetweenMonthRegister($year = \'\',$f_mes = \'\',$l_mes= \'\')'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL;
        $data_to_write .= '     $year = $year == \'\' ? date(\'Y\') : $year;'.PHP_EOL;
        $data_to_write .= '     $f_mes = $f_mes == \'\' ? date(\'m\') : $f_mes;'.PHP_EOL;
        $data_to_write .= '     $l_mes = $l_mes == \'\' ? date(\'m\') : $l_mes;'.PHP_EOL;
        $data_to_write .= '     $result = '.$model.'::whereYear(\'created_at\', $year)'.PHP_EOL;
        $data_to_write .= '     ->whereMonth(\'created_at\',\'>=\' , $f_mes)'.PHP_EOL;
        $data_to_write .= '     ->whereMonth(\'created_at\',\'<=\' , $l_mes)'.PHP_EOL;
	    $data_to_write .= "     ->get();".PHP_EOL;
        $data_to_write .= '     $labels = $result->keys();'.PHP_EOL;
        $data_to_write .= '     $data = $result->values();'.PHP_EOL;
        $data_to_write .= '     return view(\''.$prefijo.".".$tableName.'.index\', compact(\'labels\',\'data\'));'.PHP_EOL;  
        $data_to_write .= '  }'.PHP_EOL;
        /********* Fin de método *************************************************************/
        $data_to_write .= '}'.PHP_EOL; 
        $file_handle = fopen(base_path()."\\app\\Http\\Controllers\\$controller.php", 'w'); 
        fwrite($file_handle, $data_to_write);
        fclose($file_handle);  
        /*********EJECUTAR COMANDOS LARAVEL********+ */ 
        $result = Process::run('php artisan route:cache');
        $result = Process::run('php artisan cache:clear');
        echo 'Crud construido con éxito!!! (Rutas, Solicitud,Controller, Model.)';
        //echo $controller,' ->'.$migration." \n";
        //Obteniendo datos de migrations
        //echo "database/migrations/".$migration.'.php ';
        /*********************************************************/
        //Mejorando el modelo 
        //require ($base_model.$model.'.php');
        //include(base_path().'\app\Models\\'.$model.'.php');
        //$modelDB = \App::make('App\Models\\'.$model); 
        //$modelDB = eval("new $model();");
        // switch ($model) {
        //     case 'category': $modelDB = new category();break; 
        //     default: break;
        // }

        
        //echo 'table:'.$modelDB->getTable();         
        /********************************************************/
        //Creando vistas (blade)

        /*****************************************/
    }
}
