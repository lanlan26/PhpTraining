<?php

namespace App\Http\Controllers;

use Validator;
use Auth;
use Illuminate\Http\Request;
use App\Repositories\Post\PostRepositoryInterface;

class PostController extends Controller
{
    protected $postRepo;

    public function __construct(PostRepositoryInterface $postRepo)
    {
        $this->postRepo = $postRepo;
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
        $posts = $this->postRepo->paging($data);

        $request->exists('pagesize') ? $pagesize = $data['pagesize'] : $pagesize = 5;
        $request->exists('keyword') ? $keyword = $data['keyword'] : $keyword = '';
        $request->exists('field') ? $field = $data['field'] : $field = '';
        $request->exists('type') ? $type = $data['type'] : $type = '';

        return view('post.index')->with('posts', $posts)->with('pagesize',$pagesize)->with('keyword', $keyword)->with('field', $field)->with('type', $type);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
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
            'seo_title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'meta_description' => 'required',
            'keywords' => 'required',
            ]);
        if($validate->fails()){
            return redirect()->back()->withInput()->withErrors($validate);
        }
        $user = ['user_id' => Auth::user()->id];
        $data = array_merge($request->all(),$user);
        $this->postRepo->create($data);
        $request->session()->flash('message-type','success');
        $request->session()->flash('message-content','Category created');
        return redirect('/post');
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
        $post = $this->postRepo->find($id);
        if (!$post) {
            return redirect()->route('post.index')->withInput()->with('error', 'Destroy not Success');
        }

        return view('post.update', compact('post'));
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
        $post = $this->postRepo->updatePost($id, $request->all());
        if (!$post) {
            return redirect()->action('PostController@index')->withInput()->with('error', 'Update not Success');
        }

        return redirect()->action('PostController@index')->withInput()->with('error', 'Update Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
