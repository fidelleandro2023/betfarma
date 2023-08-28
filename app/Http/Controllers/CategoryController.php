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
    $category = category::latest()->paginate(10);
    return view('modules.categories.index', compact('category'));
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
     category::create($request->validated());
     return redirect()->route('modules.categories.index')->with('message', 'category Created Successfully');
  }
  public function show(category $category)
  {
     return view('modules.categories.show', compact('category'));
  }
  public function edit(category $category)
  {
     return view('modules.categories.edit', compact('category'));
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
     return redirect()->route('modules.categories.index')->with('message', 'category Created Successfully');
  }
  public function destroy(category $category)
  {
     \DB::beginTransaction();
     try {
          \DB::commit();
          $category->delete();
          \Session::flash('message', 'category deleted');
     } catch (\Exception $e) {
         \DB::rollBack();
         throw $e;
     } catch (\Throwable $e) {
         \DB::rollBack();
         throw $e;
     }
     return redirect()->route('modules.categories.index')->with('message', 'category Deleted Successfully');
  }
  public function search(Request $request)
  {
     $origin = "search";
     $search = $request->input('search');

     $resultsSearch = category::where(function($query) use ($search) {
                          $query->orWhere('name', 'LIKE', "%{$search}%")
                          $query->orWhere('description', 'LIKE', "%{$search}%")
                          $query->orWhere('short', 'LIKE', "%{$search}%")
                          $query->orWhere('parent_id', 'LIKE', "%{$search}%")
                          $query->orWhere('reference', 'LIKE', "%{$search}%")
                          $query->orWhere('user_id', 'LIKE', "%{$search}%")
                       })
                       ->paginate(10);
     return view('modules.categories.index', compact('origin', 'search','resultsSearch'));
  }}
