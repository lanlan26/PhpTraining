<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepositoryInterface;

class UserController extends Controller
{

    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
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
        $users = $this->userRepo->paging($data);

        $pagesize = $request->exists('pagesize') ? $data['pagesize'] : 5;
        $keyword = $request->exists('keyword') ? $data['keyword'] : '';
        $field = $request->exists('field') ? $data['field'] : 'name';
        $type = $request->exists('type') ? $data['type'] : 'desc';

        return view('user.index')->with('users', $users)->with('pagesize',$pagesize)->with('keyword', $keyword)->with('field', $field)->with('type', $type);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            ]);
        if($validate->fails()){
            return redirect()->back()->withInput()->withErrors($validate);
        }
        $data = $request->all();
        $this->userRepo->create($data);
        return redirect('/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userRepo->getUser($id);
        if (!$user) {
            return redirect()->route('user.index')->withInput()->with('error', 'Edit not Success');
        }
        return view('user.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->password != '') {
            $validate = Validator::make($request->all(),[
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'password' => 'string|min:6|confirmed',
                ]);
        } else {
            $validate = Validator::make($request->all(),[
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                ]);
        }

        if($validate->fails()){
            return redirect()->back()->withInput()->withErrors($validate);
        }
        $user = $this->userRepo->update($id, $request->all());
        if (!$user) {
            return redirect()->action('UserkController@index')->withInput()->with('error', 'Update not Success');
        }

        return redirect()->action('UserController@index')->withInput()->with('error', 'Update Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->userRepo->delete($id);
        if (!$user) {
            return redirect()->route('user.index')->withInput()->with('error', 'Delete failed');
        }

        return redirect()->route('user.index')->withInput()->with('success', 'Success');

    }
}
