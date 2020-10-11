<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Repositories\Work\WorkRepositoryInterface;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $workRepository;


    public function __construct(WorkRepositoryInterface $workRepository)
    {
        $this->workRepository = $workRepository;
    }

    public function index(Request $request)
    {
        $data = $request->all();
        $works = $this->workRepository->paging($data);
        //search eloquent reposotory and paginate

        $request->exists('pagesize') ? $pagesize = $data['pagesize'] : $pagesize = 5;
        $request->exists('keyword') ? $keyword = $data['keyword'] : $keyword = '';
        $request->exists('field') ? $field = $data['field'] : $field = 'title';
        $request->exists('type') ? $type = $data['type'] : $type = 'desc';

        return view('work.index')->with('works', $works)->with('pagesize',$pagesize)->with('keyword', $keyword)->with('field', $field)->with('type', $type);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('work.add');
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
        try {
            $work = $this->workRepository->create($request->all());
            if ($work) {
                return redirect()->route('work.index')->with([
                    'flash_level' => 'success',
                    'flash_message' => 'admin.add-work-success',
                ]);
            }
        } catch (Exception $e) {
            return redirect()->route('work.index')->with([
                'flash_level' => 'warning',
                'flash_message' => 'admin.add-work-fail',
            ]);
        }
        //
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
    public function edit($id)
    {
        $work = $this->workRepository->find($id);
        if (!$work) {
            return redirect()->route('work.index')->withInput()->with('error', 'Destroy not Success');
        }

        return view('work.update', compact('work'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $work = $this->workRepository->updateWork($id, $request->all());
        if (!$work) {
            return redirect()->action('WorkController@index')->withInput()->with('error', 'Update not Success');
        }

        return redirect()->action('WorkController@index')->withInput()->with('error', 'Update Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $work = $this->workRepository->delete($id);
        if (!$work) {
            return redirect()->route('work.index')->withInput()->with('error', 'Destroy not Success');
        }

        return redirect()->route('work.index')->withInput()->with('success', 'Success');
    }
}
