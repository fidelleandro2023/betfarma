<?php
namespace App\Console\Commands;
use Illuminate\Console\Command; 
use Illuminate\Support\Facades\Process;

class AuthCrudFidel
{
    public function generateAuthBase(){
        /***************************************************/
        $file = base_path()."\app\Http\Kernel.php";
        header('Content-Type: text/plain');
        $contents = file_get_contents($file);
        $class = eval("return $contents");
        print_r($class);
        exit;
        /**************************************************/
        $file = base_path()."\composer.json";
        header('Content-Type: text/plain');
        $contents = file_get_contents($file);
        $searchfor = 'spatie/laravel-permission';
        $pattern = preg_quote($searchfor, '/');
        $pattern = "/^.*$pattern.*\$/m";
        if (!preg_match_all($pattern, $contents, $matches))
        {
            Process::run('composer update spatie/laravel-permission');
            $file = base_path()."\app\Http\.json";
            header('Content-Type: text/plain');
            $contents = file_get_contents($file);
            $searchfor = 'spatie/laravel-permission';
            $pattern = preg_quote($searchfor, '/');
            $pattern = "/^.*$pattern.*\$/m";
            if (!preg_match_all($pattern, $contents, $matches))
            {

            }
        } 
        $searchfor = 'laravel/breeze';
        $pattern = preg_quote($searchfor, '/');
        $pattern = "/^.*$pattern.*\$/m";
        if (!preg_match_all($pattern, $contents, $matches))
        {
            Process::run('composer require laravel/breeze --dev'); 
            Process::run('php artisan breeze:install');
        }  
        /**************** PUBLICAR EN EL VENDOR ****************************/
        Process::run('php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"');

        $file_handle = fopen(base_path()."\app\Models\\User.php", 'w');
        $data_to_write = '<?php'.PHP_EOL;
        $data_to_write .= '  namespace App\Models;'.PHP_EOL;
        $data_to_write .= '  use Illuminate\Database\Eloquent\Factories\HasFactory;'.PHP_EOL;
        $data_to_write .= '  use Illuminate\Foundation\Auth\User as Authenticatable;'.PHP_EOL;
        $data_to_write .= '  use Illuminate\Notifications\Notifiable;'.PHP_EOL;
        $data_to_write .= '  use Laravel\Sanctum\HasApiTokens;'.PHP_EOL;
        $data_to_write .= '  use Spatie\Permission\Traits\HasRoles;'.PHP_EOL;
        $data_to_write .= ''.PHP_EOL;
        $data_to_write .= 'class User extends Authenticatable'.PHP_EOL;
        $data_to_write .= '{'.PHP_EOL;
        $data_to_write .= '    use HasApiTokens, HasFactory, Notifiable;'.PHP_EOL;
        $data_to_write .= '    /**'.PHP_EOL;
        $data_to_write .= '    * The attributes that are mass assignable.'.PHP_EOL;
        $data_to_write .= '    *'.PHP_EOL;
        $data_to_write .= '    * @var array<int, string>'.PHP_EOL;
        $data_to_write .= '    */'.PHP_EOL;
        $data_to_write .= '    protected $fillable = ['.PHP_EOL;
        $data_to_write .= "      'name',".PHP_EOL;
        $data_to_write .= "      'email',".PHP_EOL;
        $data_to_write .= "      'password',".PHP_EOL;
        $data_to_write .= '    ];'.PHP_EOL.PHP_EOL; 
        $data_to_write .= '/**'.PHP_EOL.PHP_EOL;
        $data_to_write .= '* The attributes that should be hidden for serialization.'.PHP_EOL;
        $data_to_write .= '*'.PHP_EOL;;
        $data_to_write .= '* @var array<int, string>'.PHP_EOL;
        $data_to_write .= '*/'.PHP_EOL;
        $data_to_write .= '  protected $hidden = ['.PHP_EOL;;
        $data_to_write .= "   'password',".PHP_EOL;
        $data_to_write .= "   'remember_token',".PHP_EOL;
        $data_to_write .= '  ];'.PHP_EOL;
        $data_to_write .= ''.PHP_EOL;    
        $data_to_write .= '/**'.PHP_EOL;
        $data_to_write .= '* The attributes that should be cast.'.PHP_EOL;
        $data_to_write .= '*'.PHP_EOL;
        $data_to_write .= '* @var array<string, string>'.PHP_EOL;
        $data_to_write .= '*/'.PHP_EOL;
        $data_to_write .= '  protected $casts = ['.PHP_EOL;
        $data_to_write .= "    'email_verified_at' => 'datetime',".PHP_EOL;
        $data_to_write .= "    'password' => 'hashed',".PHP_EOL;
        $data_to_write .= '  ];'.PHP_EOL;
        $data_to_write .= '}'.PHP_EOL;
        fwrite($file_handle, $data_to_write);
        fclose($file_handle);
        /************** CONTROLLER ROL ****************/
        $file_handle = fopen(base_path()."\app\Http\Controllers\\RoleController.php", 'w');
        $data_to_write = '<?php'.PHP_EOL.PHP_EOL; 
        $data_to_write .= 'namespace App\Http\Controllers;'.PHP_EOL.PHP_EOL; 
        $data_to_write .= 'use Illuminate\Http\Request;'.PHP_EOL;
        $data_to_write .= 'use App\Http\Controllers\Controller;'.PHP_EOL;
        $data_to_write .= 'use Illuminate\Support\Facades\DB;'.PHP_EOL;
        $data_to_write .= 'use Spatie\Permission\Models\Role;'.PHP_EOL;
        $data_to_write .= 'use Spatie\Permission\Models\Permission;'.PHP_EOL.PHP_EOL;  
        $data_to_write .= 'class RoleController extends Controller'.PHP_EOL;
        $data_to_write .= '{'.PHP_EOL.PHP_EOL; 
        $data_to_write .= '  function __construct()'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL;
        $data_to_write .= '        $this->middleware([\'permission:role-list|role-create|role-edit|role-delete\'], [\'only\' => [\'index\', \'store\']]);'.PHP_EOL;
        $data_to_write .= '        $this->middleware([\'permission:role-create\'], [\'only\' => [\'create\', \'store\']]);'.PHP_EOL;
        $data_to_write .= '        $this->middleware([\'permission:role-edit\'], [\'only\' => [\'edit\', \'update\']]);'.PHP_EOL;
        $data_to_write .= '        $this->middleware([\'permission:role-delete\'], [\'only\' => [\'destroy\']]);'.PHP_EOL;
        $data_to_write .= '  }'.PHP_EOL.PHP_EOL; 
        $data_to_write .= '  public function index(Request $request)'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL;
        $data_to_write .= '            $roles = Role::orderBy(\'id\', \'DESC\')->paginate(5);'.PHP_EOL;
        $data_to_write .= '            return view(\'roles.index\', compact(\'roles\'));'.PHP_EOL;
        $data_to_write .= '  }'.PHP_EOL.PHP_EOL; 
        $data_to_write .= '  public function create()'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL;
        $data_to_write .= '        $permission = Permission::get();'.PHP_EOL;
        $data_to_write .= "        return view('roles.create', compact('permission'));".PHP_EOL;
        $data_to_write .= '  }'.PHP_EOL.PHP_EOL;
        $data_to_write .= '  public function store(Request $request)'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL;
        $data_to_write .= '        $this->validate($request, ['.PHP_EOL;
        $data_to_write .= "            'name' => 'required|unique:roles,name',".PHP_EOL;
        $data_to_write .= "            'permission' => 'required',".PHP_EOL;
        $data_to_write .= '        ]);'.PHP_EOL.PHP_EOL;
        $data_to_write .= '        $role = Role::create([\'name\' => $request->input(\'name\')]);'.PHP_EOL;
        $data_to_write .= '        $role->syncPermissions($request->input(\'permission\'));'.PHP_EOL.PHP_EOL;
        $data_to_write .= '        return redirect()->route(\'roles.index\')'.PHP_EOL;
        $data_to_write .= '            ->with(\'success\', \'Role created successfully\');'.PHP_EOL;
        $data_to_write .= '  }'.PHP_EOL.PHP_EOL;
        $data_to_write .= '  public function show($id)'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL;
        $data_to_write .= '        $role = Role::find($id);'.PHP_EOL;
        $data_to_write .= '        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")'.PHP_EOL;
        $data_to_write .= '            ->where("role_has_permissions.role_id", $id)'.PHP_EOL;
        $data_to_write .= '            ->get();'.PHP_EOL.PHP_EOL; 
        $data_to_write .= "        return view('roles.show', compact('role', 'rolePermissions'));".PHP_EOL;
        $data_to_write .= '  }'.PHP_EOL.PHP_EOL;
        $data_to_write .= '  public function edit($id)'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL;
        $data_to_write .= '        $role = Role::find($id);'.PHP_EOL;
        $data_to_write .= '        $permission = Permission::get();'.PHP_EOL;
        $data_to_write .= '        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)'.PHP_EOL;
        $data_to_write .= "            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')".PHP_EOL;
        $data_to_write .= '            ->all();'.PHP_EOL.PHP_EOL; 
        $data_to_write .= "        return view('roles.edit', compact('role', 'permission', 'rolePermissions'));".PHP_EOL;
        $data_to_write .= '  }'.PHP_EOL.PHP_EOL; 
        $data_to_write .= '  public function update(Request $request, $id)'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL;
        $data_to_write .= '        $this->validate($request, ['.PHP_EOL;
        $data_to_write .= "          'name' => 'required',".PHP_EOL;
        $data_to_write .= "          'permission' => 'required',".PHP_EOL;
        $data_to_write .= "        ]);".PHP_EOL.PHP_EOL; 
        $data_to_write .= '        $role = Role::find($id);'.PHP_EOL;
        $data_to_write .= '        $role->name = $request->input(\'name\');'.PHP_EOL;
        $data_to_write .= '        $role->save();'.PHP_EOL.PHP_EOL; 
        $data_to_write .= '        $role->syncPermissions($request->input(\'permission\'));'.PHP_EOL;
        $data_to_write .= '        return redirect()->route(\'roles.index\')'.PHP_EOL;
        $data_to_write .= '             ->with(\'success\', \'Role updated successfully\');'.PHP_EOL;
        $data_to_write .= '  }'.PHP_EOL.PHP_EOL;
        $data_to_write .= '  public function destroy($id)'.PHP_EOL;
        $data_to_write .= '  {'.PHP_EOL;
        $data_to_write .= '         DB::table("roles")->where(\'id\', $id)->delete();'.PHP_EOL;
        $data_to_write .= '         return redirect()->route(\'roles.index\')'.PHP_EOL;
        $data_to_write .= '              ->with(\'success\', \'Role deleted successfully\');'.PHP_EOL;
        $data_to_write .= '  }'.PHP_EOL;
        $data_to_write .= '}'.PHP_EOL;
        fwrite($file_handle, $data_to_write);
        fclose($file_handle);
        /************** BLADE ****************/

        /*************************************/
    }
}