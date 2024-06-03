<?php
namespace App\Console\Commands\commandsFcr; 

class CompleteRequest
{
    public function index($table){
        $text = '';
        $ruta_views =  base_path()."\\app\\Http\\Requets\\";
        if (!file_exists($ruta_views)) {
            mkdir($ruta_views, 0700); //creando directorio para las vistas
        }

        switch($table){
            case 'company':  
                $text .= '<?php'.PHP_EOL;
                $text .= 'namespace App\Http\Requests;'.PHP_EOL;
                $text .= 'use Illuminate\Http\Request;'.PHP_EOL;
                $text .= 'use Illuminate\Foundation\Http\FormRequest;'.PHP_EOL.PHP_EOL;
                $text .= 'class CompanyRequest extends FormRequest'.PHP_EOL;
                $text .= '{'.PHP_EOL;
                $text .= '    /**'.PHP_EOL;
                $text .= '     * Determine if the user is authorized to make this request.'.PHP_EOL;
                $text .= '     *'.PHP_EOL;
                $text .= '     * @return bool'.PHP_EOL;
                $text .= '      */'.PHP_EOL;
                $text .= '    public function authorize()'.PHP_EOL;
                $text .= '    {'.PHP_EOL;
                $text .= '        return true;'.PHP_EOL;
                $text .= '    }'.PHP_EOL.PHP_EOL; 
                $text .= '     /**'.PHP_EOL;
                $text .= '      * Get the validation rules that apply to the request.'.PHP_EOL;
                $text .= '      *'.PHP_EOL;
                $text .= '      * @return array<string, mixed>'.PHP_EOL;
                $text .= '      */'.PHP_EOL.PHP_EOL;
                $text .= '     public function rules()'.PHP_EOL;
                $text .= '     {'.PHP_EOL;
                $text .= '         return ['.PHP_EOL;
                $text .= '                  \'ruc\'              => [\'required\', \'numeric\', \'digits:11\'],'.PHP_EOL;
                $text .= '                  \'business_name\'    => [\'required\'],'.PHP_EOL;
                $text .= '                  \'tradename\'        => \'\','.PHP_EOL;
                $text .= '                  \'tax_domain\'       => [\'required\'],'.PHP_EOL;
                $text .= '                  \'dpto_id\'          => [\'required\'],'.PHP_EOL;
                $text .= '                  \'prov_id\'          => [\'required\'],'.PHP_EOL;
                $text .= '                  \'dist_id\'          => [\'required\'],'.PHP_EOL;
                $text .= '                  \'logo\'             => \'mimes:jpg,png,jpeg,gif,svg|max:2048\','.PHP_EOL;
                $text .= '                  \'taxpaying_state\'  => \'\','.PHP_EOL;
                $text .= '                  \'taxpayer_condition\'  => \'\','.PHP_EOL;
                $text .= '                  \'accout_plan_id\'   => [\'required\'],'.PHP_EOL;
                $text .= '                  \'accout_plan_version_id\'  => [\'required\'],'.PHP_EOL;
                $text .= '                  \'operat_id\'        => [\'required\'],'.PHP_EOL;
                $text .= '                  \'coin_id\'          => [\'required\'],'.PHP_EOL;
                $text .= '                  \'IGV\'              => [\'required\'],'.PHP_EOL;
                $text .= '                  \'IR\'               => [\'required\'],'.PHP_EOL;
                $text .= '                  \'regime_id\'        => [\'required\'],'.PHP_EOL;
                $text .= '                  \'retent_agent\'     => \'\','.PHP_EOL;
                $text .= '                  \'retent_agent_resol\'  => \'\','.PHP_EOL;
                $text .= '                  \'good_taxpayer\'    => \'\','.PHP_EOL;
                $text .= '                  \'good_taxpayer_resol\'  => \'\','.PHP_EOL;
                $text .= '                  \'perception_agent\'  => \'\','.PHP_EOL;
                $text .= '                  \'perception_agent_resol\'  => \'\','.PHP_EOL;
                $text .= '                  \'excepted_igv_1\'  => \'\','.PHP_EOL;
                $text .= '                  \'excepted_igv_2\'  => \'\','.PHP_EOL;
                $text .= '                ];'.PHP_EOL;
                $text .= '    }'.PHP_EOL; 
                $text .= '    /**'.PHP_EOL;
                $text .= '     * Get custom attributes for validator errors.'.PHP_EOL;
                $text .= '     *'.PHP_EOL;
                $text .= '     * @return array'.PHP_EOL;
                $text .= '     */'.PHP_EOL;
                $text .= '    public function attributes()'.PHP_EOL;
                $text .= '    {'.PHP_EOL;
                $text .= '        return ['.PHP_EOL;
                $text .= '                  \'ruc\' => \'RUC\','.PHP_EOL;
                $text .= '                  \'business_name\'  => \'razón social\','.PHP_EOL;
                $text .= '                  \'tax_domain\'      => \'domicilio fiscal\','.PHP_EOL;
                $text .= '                  \'dpto_id\'         => \'departamento\','.PHP_EOL;
                $text .= '                  \'prov_id\'         => \'provincia\','.PHP_EOL;
                $text .= '                  \'dist_id\'         => \'distrito\','.PHP_EOL;
                $text .= '                  \'accout_plan_id\'  => \'plan contable\','.PHP_EOL;
                $text .= '                  \'operat_id\'       => \'indicador de operaciones\','.PHP_EOL;
                $text .= '                  \'coin_id\'         => \'moneda\','.PHP_EOL;
                $text .= '                  \'IGV\'             => \'IGV\','.PHP_EOL;
                $text .= '                  \'IR\'              => \'IR\','.PHP_EOL;
                $text .= '                  \'regime_id\'       => \'régimen\','.PHP_EOL;
                $text .= '                  \'retent_agent\'    => \'agente de retención\','.PHP_EOL;
                $text .= '                  \'retent_agent_resol\'  => \'agente de retención\','.PHP_EOL;
                $text .= '                  \'good_taxpayer\'   => \'buenos contribuyentes\','.PHP_EOL;
                $text .= '                  \'good_taxpayer_resol\'  => \'buenos contribuyentes\','.PHP_EOL;
                $text .= '                  \'perception_agent\'  => \'agente de percepción\','.PHP_EOL;
                $text .= '                  \'perception_agent_resol\'  => \'agente de percepción\','.PHP_EOL;
                $text .= '                  \'excepted_igv_1\'  => \'exceptuados de percepción\','.PHP_EOL;
                $text .= '                  \'excepted_igv_2\'  => \'exceptuados de percepción\','.PHP_EOL;
                $text .= '               ];'.PHP_EOL;
                $text .= '    }'.PHP_EOL;
                $text .= '}'.PHP_EOL; 
                $file_handle = fopen(base_path()."\\app\\Http\\Requets\\CompanyRequest.php", 'w');  
            break;
        }  
        
        fwrite($file_handle, $text);
        fclose($file_handle); 
        return $text;
    }
}