<?php
namespace App\Console\Commands\commandsFcr;
use Illuminate\Console\Command; 
use Illuminate\Support\Facades\Process;
use App\Console\Commands\commandsFcr\CompleteRequest;
use App\Console\Commands\commandsFcr\CompleteModel;
use App\Console\Commands\commandsFcr\CompleteMigrations; 

class OptionCreate extends Command
{
    /**  
     * The name and signature of the console command.
     *
     * @var string
     */ 
    //php artisan OptionCreate --option=dashboard --auto=true
    //php artisan OptionCreate --option=table --auto=true
    protected $signature = 'OptionCreate {--option=} {--name=} {--auto=}';
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
        $option = $this->option('option');
        $name = $this->option('name');
        $auto = $this->option('auto') ; 
        /*****************Crear migration*************************/
        switch ($option) {
            case 'dashboard':
                if ($auto == true) {
                   $this->generateDashboard();
                }
                else { 
                }
                break;
            
            default: 
                break;
        }
        
    }
    
    public function generateDashboard(){    

        $tableOption = ['Country' => 'countries','Department' => 'departments','Province' =>'provinces','District' =>'districts',
                   'Coin' => 'coins','Coin_type' =>'coin_types','Branch_office' => 'branch_offices','Dashboard' =>'dashboards',
                   'Regimen' => 'regimens','Company' => 'companies',
                   'Company_has_dashboard' => 'company_has_dashboards','Menu' => 'menus','Dashboard_has_menu' =>'dashboard_has_menus',
                   'Company_has_user' =>'company_has_users'
                  ];

        //$tableOption = explode(',',$tables);
        $seq = 100000;
        $completeMigrations = new CompleteMigrations(); 
        $matches = array();
        $migration_files = [];
        foreach ($tableOption as $key => $table) {
            //$tablep = ngettext($table);
            $fecha = "2012_01_01_"; 
            $sec = str_pad($seq, 6, "0", STR_PAD_LEFT);
            $seq++;
            $filename = $fecha.$sec."_create_".$table."_table.php";
            /**********************BUSCAR SI LA MIGRACIÓN EXISTE*********************************************/
            $migration_exists = base_path()."\database\migrations\\"; 
            $file_search_id = "create_".$table."_table"; 
            /************************************************************************************************/
            foreach(scandir($migration_exists) as $file) { 
                $exists = false; 
                if(preg_match('/' . $file_search_id . '/', $file)) {
                    $migration_files[$table] = $migration_exists.$file;
                    $exists = true;
                    break;
                }
                if ($exists == false) {
                    /***********************************************************************************************/
                    $file_handle = fopen(base_path()."\database\migrations\\".$filename, 'w');
                    $data_to_write = '<?php'.PHP_EOL;
                    $data_to_write .= 'use Illuminate\Database\Migrations\Migration;'.PHP_EOL;
                    $data_to_write .= 'use Illuminate\Database\Schema\Blueprint;'.PHP_EOL;
                    $data_to_write .= 'use Illuminate\Support\Facades\Schema;'.PHP_EOL;
                    $data_to_write .= 'class Create'.ucfirst(str_replace('_','',$table)).'Table extends Migration'.PHP_EOL;
                    $data_to_write .= '{'.PHP_EOL;
                    $data_to_write .= '/**'.PHP_EOL;
                    $data_to_write .= '* Run the migrations.'.PHP_EOL;
                    $data_to_write .= '*/'.PHP_EOL;
                    $data_to_write .= '   public function up(): void'.PHP_EOL;
                    $data_to_write .= '   {'.PHP_EOL;
                    $data_to_write .= '     Schema::create(\''.$table.'\', function (Blueprint $table) {'.PHP_EOL;
                    $data_to_write .= '       $table->id();'.PHP_EOL;
                    $data_to_write .= $completeMigrations->index($table);
                    $data_to_write .= '     });'.PHP_EOL;
                    $data_to_write .= '   }'.PHP_EOL;
                    $data_to_write .= '/**'.PHP_EOL;
                    $data_to_write .= '* Reverse the migrations.'.PHP_EOL;
                    $data_to_write .= '*/'.PHP_EOL;
                    $data_to_write .= '   public function down(): void'.PHP_EOL;
                    $data_to_write .= '   {'.PHP_EOL;
                    $data_to_write .= '     Schema::dropIfExists(\''.$table.'\');'.PHP_EOL;
                    $data_to_write .= '   }'.PHP_EOL;
                    $data_to_write .= '};'.PHP_EOL;
                    fwrite($file_handle, $data_to_write);
                    fclose($file_handle);   
                }
            }
            //echo 'exists:--->'.$exists;
        }

        //print_r($migration_files); exit; 
        foreach($migration_files as $key => $file) {  
                $handle = fopen($file,'rb'); 
                while (!feof($handle)) {
                    $buffer = fgets($handle);
                    if (preg_match("/->on\(.*?\)/", $buffer)) {
                        $matches[$key]['references'][] =  trim(
                                                            str_replace('"', '',
                                                            str_replace("'", '',
                                                            str_replace(')', '',
                                                            str_replace('(', '', 
                                                            preg_replace('/(->|on)/', '', $buffer)))))
                                                        ); 
                    } 
                } 
                fclose($handle);  
        }
        
        //print_r($matches); exit;
        
        foreach ($matches as $kmat => $items) {
            if (isset($items['references'])) {
                foreach ($items['references'] as $key => $reference) {
                    $matches[$reference]['belows'][] = $kmat;
                }
            }
        }
        print_r($matches); exit;
        /*************Creando migraciones****************************************************************/
        $result = Process::run('php artisan db:wipe');
        $result = Process::run('php artisan migrate:fresh');
        //echo $result->output();
        //echo '-----begin----'; exit; 
        /*******************CREANDO OTROS ARCHIVOS*******************************************************/
        $ruta_views =  base_path()."\\app\\Http\\Controllers\\AdminLte";
        if (!file_exists($ruta_views)) {
            mkdir($ruta_views, 0700); //creando directorio para las vistas
        }
        $ruta_views =  base_path()."\\app\\models\\AdminLte";
        if (!file_exists($ruta_views)) {
            mkdir($ruta_views, 0700); //creando directorio para las vistas
        }
        $ruta_views =  base_path()."\\app\\models\\AdminLte\\dashboards\\";
        if (!file_exists($ruta_views)) {
            mkdir($ruta_views, 0700); //creando directorio para las vistas
        }
        $ruta_views =  base_path()."\\resources\\views\\dashboards\\";
        if (!file_exists($ruta_views)) {
            mkdir($ruta_views, 0700); //creando directorio para las vistas
        }
        $ruta_views =  base_path()."\\resources\\views\\dashboards\\1\\";
        if (!file_exists($ruta_views)) {
            mkdir($ruta_views, 0700); //creando directorio para las vistas
        }
        $ruta_views =  base_path()."\\app\\Http\\Controllers\\AdminLte\\dashboards\\";
        if (!file_exists($ruta_views)) {
            mkdir($ruta_views, 0700); //creando directorio para las vistas
        }
        /********************CREAR ADMIN CONTROLLER*******************************************************/
        $file_handle = fopen(base_path()."\\app\\Http\\Controllers\\AdminLte\\dashboards\\AdminController.php", 'w');   
        $data_to_write = '<?php'.PHP_EOL;
        $data_to_write .= 'namespace App\Http\Controllers;'.PHP_EOL; 
        $data_to_write .= 'use Illuminate\Http\Request;'.PHP_EOL.PHP_EOL; 
        $data_to_write .= 'class AdminController extends Controller'.PHP_EOL;
        $data_to_write .= '{'.PHP_EOL;
        $data_to_write .= '    public function index(Request $request)'.PHP_EOL;
        $data_to_write .= '    {'.PHP_EOL;
        $data_to_write .= '        return view(\'dashboard.index\');'.PHP_EOL;
        $data_to_write .= '    }'.PHP_EOL;
        $data_to_write .= '}'.PHP_EOL;
        fwrite($file_handle, $data_to_write);
        fclose($file_handle);
        /***************************************VIEWS - index global*********************************************************/
        $file_handle = fopen(base_path()."\\resources\\views\\dashboards\\index.blade.php", 'w');   
        $data_to_write = '<div class="container" style="margin-top:50px;">'.PHP_EOL;  
        $data_to_write .= '    <div class="row">'.PHP_EOL;  
        $data_to_write .= '     @foreach($dashboards as $item){'.PHP_EOL;  
        $data_to_write .= '        <div class="col-md-4">'.PHP_EOL;  
        $data_to_write .= '            <div class="card-sl">'.PHP_EOL;  
        $data_to_write .= '                <div class="card-image">'.PHP_EOL;  
        $data_to_write .= '                    <img src="{{$item->image}}" />'.PHP_EOL;  
        $data_to_write .= '                </div> '.PHP_EOL;  
        $data_to_write .= '                <a class="card-action" href="#"><i class="fa fa-heart"></i></a>'.PHP_EOL;  
        $data_to_write .= '                <div class="card-heading">'.PHP_EOL;  
        $data_to_write .= '                    {{$item->title}}'.PHP_EOL;  
        $data_to_write .= '                </div>'.PHP_EOL;  
        $data_to_write .= '                <div class="card-text">'.PHP_EOL;  
        $data_to_write .= '                    {{$item->description}}'.PHP_EOL;  
        $data_to_write .= '                </div>'.PHP_EOL;   
        $data_to_write .= '                <a href="#" class="card-button">ACCEDER</a>'.PHP_EOL;  
        $data_to_write .= '            </div>'.PHP_EOL;  
        $data_to_write .= '        </div>'.PHP_EOL;  
        $data_to_write .= '     }'.PHP_EOL;  
        $data_to_write .= '    </div> '.PHP_EOL;     
        $data_to_write .= '</div>'.PHP_EOL;  
        fwrite($file_handle, $data_to_write);
        fclose($file_handle);
        /*****************************************************************************************************************************************************/
        /***************************************VIEWS - index admin 1*****************************************************************************************/
        $file_handle = fopen(base_path()."\\resources\\views\\dashboards\\1\\index.blade.php", 'w');   
        $data_to_write = '@extends(\'adminlte::page\')'.PHP_EOL; 
        $data_to_write .= '@section(\'title\', \'Dashboard Administración\')'.PHP_EOL.PHP_EOL; 
        $data_to_write .= '@section(\'content_header\')'.PHP_EOL.PHP_EOL; 
        $data_to_write .= '<h1>Dashboard</h1>'.PHP_EOL.PHP_EOL; 
        $data_to_write .= '@stop'.PHP_EOL.PHP_EOL; 
        $data_to_write .= '@section(\'content\')'.PHP_EOL.PHP_EOL; 
        $data_to_write .= '<p>Bienvenido al panel de administración de AdminLTE.</p>'.PHP_EOL.PHP_EOL; 
        $data_to_write .= '@stop'.PHP_EOL;   
        fwrite($file_handle, $data_to_write);
        fclose($file_handle);
        /*************************************GENERADOR DE DASHBOARD*********************************************************************************************************/
        $ruta_views = base_path()."\\app\\Http\\Controllers\\dashboardgenerator\\";
        if (!file_exists($ruta_views)) {
            mkdir($ruta_views, 0700); //creando directorio para las vistas
        }
        /*********************************************************************************************************************************************************************/
        $CompleteModel = new CompleteModel(); 
        $CompleteRequest = new CompleteRequest();  
        /************Company**************************************************************************************************************************************************/
        $CompleteModel->index($tableOption,$matches); //model
        //$CompleteRequest->index('company');     //request
        /*********************************************************************************************************************************************************************/
        $file_handle = fopen(base_path()."\\app\\Http\\Controllers\\dashboardgenerator\\CompanyController.php", 'w'); 
        $data_to_write = '<?php'.PHP_EOL;
        $data_to_write .= 'namespace App\Http\Controllers;'.PHP_EOL; 
        $data_to_write .= 'use Illuminate\Http\Request;'.PHP_EOL.PHP_EOL;  
        $data_to_write .= 'use App\Models\Company;'.PHP_EOL; 
        $data_to_write .= 'use App\Http\Requests\CompanyRequest;'.PHP_EOL.PHP_EOL; 
        $data_to_write .= 'class CompanyController extends Controller'.PHP_EOL;
        $data_to_write .= '{'.PHP_EOL;
        $data_to_write .= '    public function index()'.PHP_EOL;
        $data_to_write .= '    {'.PHP_EOL;
        $data_to_write .= '       return view(\'modules.company.index\');'.PHP_EOL;
        $data_to_write .= '    }'.PHP_EOL;
        $data_to_write .= '    public function list()'.PHP_EOL;
        $data_to_write .= '    {'.PHP_EOL;
        $data_to_write .= '       $company = bank::latest()->paginate(10);'.PHP_EOL;
        $data_to_write .= '       return view(\'modules.companies.list\', compact(\'company\'));'.PHP_EOL;
        $data_to_write .= '    }'.PHP_EOL;
        $data_to_write .= '    public function create()'.PHP_EOL;
        $data_to_write .= '    {'.PHP_EOL;
        $data_to_write .= '       $company = new company();'.PHP_EOL;
        $data_to_write .= '       $list_company = company::latest()->paginate(10);'.PHP_EOL;
        $data_to_write .= '       return view(\'modules.company.create\', compact(\'list_company\'));'.PHP_EOL;
        $data_to_write .= '    }'.PHP_EOL;
        $data_to_write .= '    public function store(BankRequest $request)'.PHP_EOL;
        $data_to_write .= '    {'.PHP_EOL;
        $data_to_write .= '       \DB::beginTransaction();'.PHP_EOL;
        $data_to_write .= '       try {'.PHP_EOL;
        $data_to_write .= '              bank::create($request->validated());'.PHP_EOL;
        $data_to_write .= '              \DB::commit();'.PHP_EOL;
        $data_to_write .= '              \Session::flash(\'message\', \'bank created\');'.PHP_EOL;
        $data_to_write .= '            } catch (\Exception $e) {'.PHP_EOL;
        $data_to_write .= '              \DB::rollBack();'.PHP_EOL;
        $data_to_write .= '               throw $e;'.PHP_EOL;
        $data_to_write .= '            } catch (\Throwable $e) {'.PHP_EOL;
        $data_to_write .= '              \DB::rollBack();'.PHP_EOL;
        $data_to_write .= '               throw $e;'.PHP_EOL;
        $data_to_write .= '            }'.PHP_EOL;
        $data_to_write .= '       return redirect()->route(\'banks.list\')->with(\'message\', \'Company Created Successfully\');'.PHP_EOL;
        $data_to_write .= '    }'.PHP_EOL;
        $data_to_write .= '    public function show($id)'.PHP_EOL;
        $data_to_write .= '    {'.PHP_EOL;
        $data_to_write .= '       $company = bank::find($id);'.PHP_EOL;
        $data_to_write .= '       return view(\'modules.company.show\', compact(\'company\'));'.PHP_EOL;
        $data_to_write .= '    }'.PHP_EOL;
        $data_to_write .= '    public function edit($id)'.PHP_EOL;
        $data_to_write .= '    {'.PHP_EOL;
        $data_to_write .= '       $company = bank::find($id);'.PHP_EOL;
        $data_to_write .= '       return view(\'modules.company.edit\', compact(\'company\'));'.PHP_EOL;
        $data_to_write .= '    }'.PHP_EOL;
        $data_to_write .= '    public function update(BankRequest $request,bank $bank)'.PHP_EOL;
        $data_to_write .= '    {'.PHP_EOL;
        $data_to_write .= '       \DB::beginTransaction();'.PHP_EOL;
        $data_to_write .= '       try {'.PHP_EOL;
        $data_to_write .= '              $bank->update(['.PHP_EOL;
        $data_to_write .= '                \'name\' => $request->name,'.PHP_EOL;
        $data_to_write .= '                \'description\' => $request->description'.PHP_EOL;
        $data_to_write .= '              ]);'.PHP_EOL;
        $data_to_write .= '              \DB::commit();'.PHP_EOL;
        $data_to_write .= '              \Session::flash(\'message\', \'bank update\');'.PHP_EOL;
        $data_to_write .= '            } catch (\Exception $e) {'.PHP_EOL;
        $data_to_write .= '              \DB::rollBack();'.PHP_EOL;
        $data_to_write .= '              throw $e;'.PHP_EOL;
        $data_to_write .= '            } catch (\Throwable $e) {'.PHP_EOL;
        $data_to_write .= '              \DB::rollBack();'.PHP_EOL;
        $data_to_write .= '              throw $e;'.PHP_EOL;
        $data_to_write .= '            }'.PHP_EOL.PHP_EOL;
        $data_to_write .= '       return redirect()->route(\'company.list\')->with(\'message\', \'Company updated Successfully\');'.PHP_EOL;
        $data_to_write .= '    }'.PHP_EOL;
        $data_to_write .= '}'.PHP_EOL;     
        
        fwrite($file_handle, $data_to_write);
        fclose($file_handle);

        $ruta_views =  base_path()."\\resources\\views\\dashboardgenerator\\";
        if (!file_exists($ruta_views)) {
            mkdir($ruta_views, 0700); //creando directorio para las vistas
        }
        /********************DASHBOARD - COMPANY*******************************************************/
        $file_handle = fopen(base_path()."\\resources\\views\\dashboardgenerator\\company.blade.php", 'w');   
        $data_to_write = ''.PHP_EOL;
        $data_to_write .= '<form class="well form-horizontal" action="" method="post"  id="contact_form">'.PHP_EOL;
        $data_to_write .= '  <fieldset>'.PHP_EOL.PHP_EOL; 
        $data_to_write .= '  <!-- Form Name -->'.PHP_EOL;
        $data_to_write .= '  <legend><center><h2><b>Registro de empresa</b></h2></center></legend><br>'.PHP_EOL.PHP_EOL;
        $data_to_write .= '  <!-- Text input-->'.PHP_EOL; 
        $data_to_write .= '  <div class="row">'.PHP_EOL; 
        $data_to_write .= '    <div class="col-md-6">'.PHP_EOL; 
        $data_to_write .= '      <div class="form-group">'.PHP_EOL;
        $data_to_write .= '         <label class="col-md-4 control-label">Razon social</label>'.PHP_EOL;  
        $data_to_write .= '         <div class="col-md-4 inputGroupContainer">'.PHP_EOL;
        $data_to_write .= '            <div class="input-group">'.PHP_EOL;
        $data_to_write .= '              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>'.PHP_EOL;
        $data_to_write .= '              <input  name="razon_social" placeholder="Eazón social" class="form-control"  type="text">'.PHP_EOL;
        $data_to_write .= '            </div>'.PHP_EOL;
        $data_to_write .= '          </div>'.PHP_EOL;
        $data_to_write .= '      </div>'.PHP_EOL; 
        $data_to_write .= '      <!-- Text input-->'.PHP_EOL; 
        $data_to_write .= '      <div class="form-group">'.PHP_EOL;
        $data_to_write .= '          <label class="col-md-4 control-label">Nombre comercial</label>'.PHP_EOL;
        $data_to_write .= '          <div class="col-md-4 inputGroupContainer">'.PHP_EOL;
        $data_to_write .= '            <div class="input-group">'.PHP_EOL;
        $data_to_write .= '                 <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>'.PHP_EOL;
        $data_to_write .= '                 <input name="nombre_comercial" placeholder="Nombre comercial" class="form-control"  type="text">'.PHP_EOL;
        $data_to_write .= '            </div>'.PHP_EOL;
        $data_to_write .= '          </div>'.PHP_EOL;
        $data_to_write .= '      </div>'.PHP_EOL;
        $data_to_write .= '      <!-- Text input-->'.PHP_EOL; 
        $data_to_write .= '      <div class="form-group">'.PHP_EOL;
        $data_to_write .= '          <label class="col-md-4 control-label">Dominio fiscal</label>'.PHP_EOL;
        $data_to_write .= '          <div class="col-md-4 inputGroupContainer">'.PHP_EOL;
        $data_to_write .= '            <div class="input-group">'.PHP_EOL;
        $data_to_write .= '                 <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>'.PHP_EOL;
        $data_to_write .= '                 <input name="dominio_fiscal" placeholder="Ingrese dominio fiscal" class="form-control"  type="text">'.PHP_EOL;
        $data_to_write .= '            </div>'.PHP_EOL;
        $data_to_write .= '          </div>'.PHP_EOL;
        $data_to_write .= '      </div>'.PHP_EOL;
        $data_to_write .= '      <div class="form-group">'.PHP_EOL;
        $data_to_write .= '          <label class="col-md-4 control-label">Pais</label>'.PHP_EOL;
        $data_to_write .= '          <div class="col-md-4 selectContainer">'.PHP_EOL;
        $data_to_write .= '            <div class="input-group">'.PHP_EOL;
        $data_to_write .= '                <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>'.PHP_EOL;
        $data_to_write .= '                <select name="country" class="country form-control select2">'.PHP_EOL;
        $data_to_write .= '                   @foreach($countries as $item)'.PHP_EOL;
        $data_to_write .= '                    <option value="">Seleccione pais</option> '.PHP_EOL; 
        $data_to_write .= '                    <option value="{{$item->value}}">{{$item->text}}</option> '.PHP_EOL;
        $data_to_write .= '                   @endforeach'.PHP_EOL;
        $data_to_write .= '                </select>'.PHP_EOL;
        $data_to_write .= '            </div>'.PHP_EOL;
        $data_to_write .= '        </div>'.PHP_EOL;
        $data_to_write .= '      </div>'.PHP_EOL;
        $data_to_write .= '      <div class="form-group">'.PHP_EOL;
        $data_to_write .= '           <label class="col-md-4 control-label">Departamento</label>'.PHP_EOL;
        $data_to_write .= '           <div class="col-md-4 selectContainer">'.PHP_EOL;
        $data_to_write .= '             <div class="input-group">'.PHP_EOL;
        $data_to_write .= '                <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>'.PHP_EOL;
        $data_to_write .= '                <select name="department" class="department form-control select2">'.PHP_EOL; 
        $data_to_write .= '                    <option value="">Seleccione un departamento</option> '.PHP_EOL; 
        $data_to_write .= '                </select>'.PHP_EOL;
        $data_to_write .= '             </div>'.PHP_EOL;
        $data_to_write .= '          </div>'.PHP_EOL;
        $data_to_write .= '      </div>'.PHP_EOL;
        $data_to_write .= '   </div>'.PHP_EOL; 
        $data_to_write .= '      <div class="col-md-6">'.PHP_EOL; 
        $data_to_write .= '         <div class="form-group">'.PHP_EOL;
        $data_to_write .= '           <label class="col-md-4 control-label">Provincia</label>'.PHP_EOL;
        $data_to_write .= '           <div class="col-md-4 selectContainer">'.PHP_EOL;
        $data_to_write .= '             <div class="input-group">'.PHP_EOL;
        $data_to_write .= '                <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>'.PHP_EOL;
        $data_to_write .= '                <select name="province" class="province form-control select2">'.PHP_EOL; 
        $data_to_write .= '                    <option value="">Seleccione provincia</option> '.PHP_EOL; 
        $data_to_write .= '                </select>'.PHP_EOL;
        $data_to_write .= '             </div>'.PHP_EOL;
        $data_to_write .= '           </div>'.PHP_EOL;
        $data_to_write .= '       </div>'.PHP_EOL;
        $data_to_write .= '       <div class="form-group">'.PHP_EOL;
        $data_to_write .= '          <label class="col-md-4 control-label">Distrito</label>'.PHP_EOL;
        $data_to_write .= '          <div class="col-md-4 selectContainer">'.PHP_EOL;
        $data_to_write .= '            <div class="input-group">'.PHP_EOL;
        $data_to_write .= '                <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>'.PHP_EOL;
        $data_to_write .= '                <select name="district" class="district form-control select2">'.PHP_EOL; 
        $data_to_write .= '                    <option value="">Seleccione distrito</option> '.PHP_EOL; 
        $data_to_write .= '                </select>'.PHP_EOL;
        $data_to_write .= '            </div>'.PHP_EOL;
        $data_to_write .= '          </div>'.PHP_EOL;
        $data_to_write .= '       </div>'.PHP_EOL;    
        $data_to_write .= '       <div class="form-group">'.PHP_EOL;
        $data_to_write .= '          <label class="col-md-4 control-label">Regimen</label>'.PHP_EOL;
        $data_to_write .= '          <div class="col-md-4 selectContainer">'.PHP_EOL;
        $data_to_write .= '            <div class="input-group">'.PHP_EOL;
        $data_to_write .= '                <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>'.PHP_EOL;
        $data_to_write .= '                <select name="regimen" class="district form-control select2">'.PHP_EOL; 
        $data_to_write .= '                    <option value="">Seleccione regimen</option> '.PHP_EOL; 
        $data_to_write .= '                    @foreach($countries as $item)'.PHP_EOL;
        $data_to_write .= '                      <option value="">Seleccione pais</option> '.PHP_EOL; 
        $data_to_write .= '                      <option value="{{$item->value}}">{{$item->text}}</option> '.PHP_EOL;
        $data_to_write .= '                    @endforeach'.PHP_EOL;
        $data_to_write .= '                </select>'.PHP_EOL;
        $data_to_write .= '            </div>'.PHP_EOL;
        $data_to_write .= '          </div>'.PHP_EOL;
        $data_to_write .= '       </div>'.PHP_EOL;   
        $data_to_write .= '       <div class="form-group">'.PHP_EOL;
        $data_to_write .= '         <label class="col-md-4 control-label">Monedas</label>'.PHP_EOL;
        $data_to_write .= '         <div class="col-md-4 selectContainer">'.PHP_EOL;
        $data_to_write .= '            <div class="input-group">'.PHP_EOL;
        $data_to_write .= '                <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>'.PHP_EOL;
        $data_to_write .= '                <select name="coins" class="district form-control select2" multiple="multiple">'.PHP_EOL; 
        $data_to_write .= '                    <option value="">Seleccione monedas</option> '.PHP_EOL; 
        $data_to_write .= '                    @foreach($countries as $item)'.PHP_EOL;
        $data_to_write .= '                      <option value="">Seleccione pais</option> '.PHP_EOL; 
        $data_to_write .= '                      <option value="{{$item->value}}">{{$item->text}}</option> '.PHP_EOL;
        $data_to_write .= '                    @endforeach'.PHP_EOL;
        $data_to_write .= '                </select>'.PHP_EOL;
        $data_to_write .= '             </div>'.PHP_EOL;
        $data_to_write .= '         </div>'.PHP_EOL;
        $data_to_write .= '       </div>'.PHP_EOL;   
        $data_to_write .= '    </div>'.PHP_EOL; 
        $data_to_write .= '  </div>'.PHP_EOL; 
        $data_to_write .= '  <div class="form-group">'.PHP_EOL;
        $data_to_write .= '        <button type="submit" class="btn btn-warning">SUBMIT <span class="glyphicon glyphicon-send"></span></button>'.PHP_EOL; 
        $data_to_write .= '  </div>'.PHP_EOL; 
        $data_to_write .= ' </form>'.PHP_EOL;     
        fwrite($file_handle, $data_to_write);
        fclose($file_handle);
    }
    
    private function renderMigrationsTable(): void
    {
        $migrations = \DB::table('migrations')->get();
        $rows = $migrations->mapWithKeys(fn($std, $key) => [$key => ['step' => ($migrations->count() - $key), 'migration' => $std->migration]]);

        $this->table(headers: ['Step', 'Migrations',], rows: $rows);
    }
}