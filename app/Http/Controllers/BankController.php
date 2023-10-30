<?php
 namespace App\Http\Controllers;
 use Illuminate\Http\Request;
 use App\Models\bank;
 use App\Http\Requests\BankRequest;

 class BankController extends Controller
 {
  private $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre','Noviembre','Diciembre'];
  public function index()
  {
    return view('modules.banks.index');
  }
  public function list()
  {
    $bank = bank::latest()->paginate(10);
    return view('modules.banks.list', compact('bank'));
  }
  public function create()
  {
     $bank = new bank();
     $list_bank = bank::latest()->paginate(10);
     return view('modules.banks.create', compact('list_bank'));
  }
  public function store(BankRequest $request)
  {
     \DB::beginTransaction();
     try {
          bank::create($request->validated());
          \DB::commit();
          \Session::flash('message', 'bank created');
     } catch (\Exception $e) {
         \DB::rollBack();
         throw $e;
     } catch (\Throwable $e) {
         \DB::rollBack();
         throw $e;
     }

     return redirect()->route('banks.list')->with('message', 'bank Created Successfully');
  }
  public function show($id)
  {
     $bank = bank::find($id);
     return view('modules.banks.show', compact('bank'));
  }
  public function edit($id)
  {
     $bank = bank::find($id);
     return view('modules.banks.edit', compact('bank'));
  }
  public function update(BankRequest $request,bank $bank)
  {
    \DB::beginTransaction();
     try {
           $bank->update([
              'name' => $request->name,
              'description' => $request->description
          ]);
          \DB::commit();
          \Session::flash('message', 'bank update');
     } catch (\Exception $e) {
         \DB::rollBack();
         throw $e;
     } catch (\Throwable $e) {
         \DB::rollBack();
         throw $e;
     }
     return redirect()->route('banks.list')->with('message', 'bank updated Successfully');
  }
  public function destroy($id)
  {
     \DB::beginTransaction();
     try {
          \DB::commit();
          $bank = bank::find($id)->delete();
          \Session::flash('message', 'bank deleted');
     } catch (\Exception $e) {
         \DB::rollBack();
         throw $e;
     } catch (\Throwable $e) {
         \DB::rollBack();
         throw $e;
     }
     return redirect()->route('banks.list')->with('message', 'bank Deleted Successfully');
  }
  public function search(Request $request)
  {
     $origin = "search";
     $search = $request->input('search');

     $resultsSearch = bank::where(function($query) use ($search) {
                          $query->orWhere('name', 'LIKE', "%{$search}%");
                          $query->orWhere('description', 'LIKE', "%{$search}%");
                       })
                       ->paginate(10);
     return view('modules.banks.list', compact('origin', 'search','resultsSearch'));
  }
  public function bankYearRegister($year = '')
  {
     $year = $year == '' ? date('Y') : $year;
     $result = bank::select(\DB::raw("COUNT(*) as count"), \DB::raw("MONTH(created_at) as month_name"))
     ->whereYear('created_at', $year)
     ->groupBy(\DB::raw("Month(created_at)"))
     ->pluck('count', 'month_name');
     $label_data = $result->keys();
     $labels = [];
     foreach ($label_data as $key => $value) {
       $labels[$key] = $this->meses[$value-1];
     }
     $data = $result->values();
     $label = 'Cantidad de registros del año '.$year;
     return view('modules.banks.date_year_register', compact('label','labels','data'));
  }
  public function bankMonthRegister($year = '',$mes = '')
  {
     $year = $year == '' ? date('Y') : $year;
     $mes = $mes == '' ? date('m') : $mes;
     $result = bank::whereYear('created_at', $year)
     ->whereMonth('created_at',$mes)
     ->get();
     $labels = $result->keys();
     $data = $result->values();
     return view('modules.banks.index', compact('labels','data'));
  }
  public function bankBetweenMonthRegister($year = '',$f_mes = '',$l_mes= '')
  {
     $year = $year == '' ? date('Y') : $year;
     $f_mes = $f_mes == '' ? date('m') : $f_mes;
     $l_mes = $l_mes == '' ? date('m') : $l_mes;
     $result = bank::whereYear('created_at', $year)
     ->whereMonth('created_at','>=' , $f_mes)
     ->whereMonth('created_at','<=' , $l_mes)
     ->get();
     $labels = $result->keys();
     $data = $result->values();
     return view('modules.banks.index', compact('labels','data'));
  }
}
