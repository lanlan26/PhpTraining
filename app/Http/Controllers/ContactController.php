<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contact\ContactEloquentRepository;

class ContactController extends Controller
{

	protected $contactRepo;

    public function __construct(ContactEloquentRepository $contactRepo)
    {
        $this->contactRepo = $contactRepo;
    }

    public function index(Request $request)
    {
    	$data = $request->all();
    	$contacts = $this->contactRepo->paging($data);

    	$pagesize = $request->exists('pagesize') ? $data['pagesize'] : 5;
        $keyword = $request->exists('keyword') ? $data['keyword'] : '';
        $field = $request->exists('field') ? $data['field'] : 'name';
        $type = $request->exists('type') ? $data['type'] : 'desc';

        return view('contact.index')->with('contacts',$contacts)->with('pagesize',$pagesize)->with('keyword', $keyword)->with('field', $field)->with('type', $type);
    }

    public function show($id)
    {
    	$contact = $this->contactRepo->getContact($id);
        return view('contact.detail')->with('contact', $contact);
    }

    public function destroy($id)
    {
        $contact = $this->contactRepo->delete($id);
        if (!$contact) {
            return redirect()->route('contact.index')->withInput()->with('error', 'Delete failed');
        }

        return redirect()->route('contact.index')->withInput()->with('success', 'Success');

    }
}
