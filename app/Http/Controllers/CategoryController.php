<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryController extends Controller
{

    protected $categoryRepo;


    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();
        //search eloquent reposotory and paginate
        $categories = $this->categoryRepo->paging($data);

        $request->exists('pagesize') ? $pagesize = $data['pagesize'] : $pagesize = 5;
        $request->exists('keyword') ? $keyword = $data['keyword'] : $keyword = '';
        $request->exists('field') ? $field = $data['field'] : $field = '';
        $request->exists('type') ? $type = $data['type'] : $type = '';

        return view('category.index')->with('categories', $categories)->with('pagesize',$pagesize)->with('keyword', $keyword)->with('field', $field)->with('type', $type);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'title' => 'required|max:255',
            'slug' => 'required|unique:categories|alpha_dash|max:255',
            ]);
        if($validate->fails()){
            return redirect()->back()->withInput()->withErrors($validate);
        }
        $data = $request->all();
        $this->categoryRepo->create($data);
        $request->session()->flash('message-type','success');
        $request->session()->flash('message-content','Category created');
        return redirect('/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $category = $this->categoryRepo->whereSlug($slug);
        return view('category.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $validate = Validator::make($request->all(),[
            'title' => 'required|max:255',
            'slug' => [
                    'required',
                    Rule::unique('categories')->ignore($slug,'slug'),
                    'alpha_dash',
                    'max:255'
                ]
            ]);
        if($validate->fails()){
            return redirect()->back()->withInput()->withErrors($validate);
        }
        $data = $request->all();
        $this->categoryRepo->update($slug,$data);
        $request->session()->flash('message-type','success');
        $request->session()->flash('message-content','Category updated');
        return redirect('/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $slug)
    {
        $this->categoryRepo->delete($slug);
        $request->session()->flash('message-type','danger');
        $request->session()->flash('message-content','Category deleted');
        return redirect('/category');
    }
}
