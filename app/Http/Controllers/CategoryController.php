<?php
 namespace App\Http\Controllers;
 use Illuminate\Http\Request;
 use App\Models\category;
 use App\Http\Requests\CategoryRequest;

 class CategoryController extends Controller
 {
  public function index()
  {
    $category = category::latest()->paginate(10);
    return view('modules.categories.index', compact('category'));
  }
  public function create()
  {
     $category = new category();
     $list_category = category::latest()->paginate(10);
     $list_parent_id = $category->list_parent_id();
     $list_user_id = $category->list_user_id();
     return view('modules.categories.create', compact('list_category','list_parent_id','list_user_id'));
  }
  public function store(CategoryRequest $request)
  {
     \DB::beginTransaction();
     try {
          category::create($request->validated());
          \DB::commit();
          \Session::flash('message', 'category created');
     } catch (\Exception $e) {
         \DB::rollBack();
         throw $e;
     } catch (\Throwable $e) {
         \DB::rollBack();
         throw $e;
     }

     return redirect()->route('categories.index')->with('message', 'category Created Successfully');
  }
  public function show($id)
  {
     $category = category::find($id);
     return view('modules.categories.show', compact('category'));
  }
  public function edit($id)
  {
     $category = category::find($id);
     $parent_id = $category->list_parent_id();
     $user_id = $category->list_user_id();
     return view('modules.categories.edit', compact('category','parent_id','user_id'));
  }
  public function update(CategoryRequest $request,category $category)
  {
    \DB::beginTransaction();
     try {
           $category->update([
              'name' => $request->name,
              'description' => $request->description,
              'short' => $request->short,
              'parent_id' => $request->parent_id,
              'reference' => $request->reference,
              'user_id' => $request->user_id
          ]);
          \DB::commit();
          \Session::flash('message', 'category update');
     } catch (\Exception $e) {
         \DB::rollBack();
         throw $e;
     } catch (\Throwable $e) {
         \DB::rollBack();
         throw $e;
     }
     return redirect()->route('categories.index')->with('message', 'category updated Successfully');
  }
  public function destroy($id)
  {
     \DB::beginTransaction();
     try {
          \DB::commit();
          $category = category::find($id)->delete();
          \Session::flash('message', 'category deleted');
     } catch (\Exception $e) {
         \DB::rollBack();
         throw $e;
     } catch (\Throwable $e) {
         \DB::rollBack();
         throw $e;
     }
     return redirect()->route('categories.index')->with('message', 'category Deleted Successfully');
  }
  public function search(Request $request)
  {
     $origin = "search";
     $search = $request->input('search');

     $resultsSearch = category::where(function($query) use ($search) {
                          $query->orWhere('name', 'LIKE', "%{$search}%");
                          $query->orWhere('description', 'LIKE', "%{$search}%");
                          $query->orWhere('short', 'LIKE', "%{$search}%");
                          $query->orWhere('parent_id', 'LIKE', "%{$search}%");
                          $query->orWhere('reference', 'LIKE', "%{$search}%");
                          $query->orWhere('user_id', 'LIKE', "%{$search}%");
                       })
                       ->paginate(10);
     return view('modules.categories.index', compact('origin', 'search','resultsSearch'));
  }
  public function categoryYearRegister($year = '')
  {
     $year = $year == '' ? date('Y') : $year;
     $result = category::whereYear('created_at', $year)
     ->get();
     $labels = $result->keys();
     $data = $result->values();
     return view('modules.categories.date_year_register', compact('labels','data'));
  }
  public function categoryMonthRegister($year = '',$mes = '')
  {
     $year = $year == '' ? date('Y') : $year;
     $mes = $mes == '' ? date('m') : $mes;
     $result = category::whereYear('created_at', $year)
     ->whereMonth('created_at',$mes)
     ->get();
     $labels = $result->keys();
     $data = $result->values();
     return view('modules.categories.index', compact('labels','data'));
  }
  public function categoryBetweenMonthRegister($year = '',$f_mes = '',$l_mes= '')
  {
     $year = $year == '' ? date('Y') : $year;
     $f_mes = $f_mes == '' ? date('m') : $f_mes;
     $l_mes = $l_mes == '' ? date('m') : $l_mes;
     $result = category::whereYear('created_at', $year)
     ->whereMonth('created_at','>=' , $f_mes)
     ->whereMonth('created_at','<=' , $l_mes)
     ->get();
     $labels = $result->keys();
     $data = $result->values();
     return view('modules.categories.index', compact('labels','data'));
  }
}
