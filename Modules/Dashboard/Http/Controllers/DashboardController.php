<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Dashboard\Entities\Repository\Interfaces\Contacts as ContactsRepository;

class DashboardController extends Controller
{
    protected $repo;

    public function __construct(ContactsRepository $repo)
    {
        $this->repo = $repo;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {//return $request;
        $contacts = $this->repo->getList();
        return view('dashboard::index', compact('contacts'));
    }

    public function filter(Request $request)
    {        
        $filter = $request->only('name_operator','name_value','email_operator','email_value', 'phone_operator','phone_value',	'gender_value', 'age_operator','age_value');
        $contacts = $this->repo->getFilteredList(array_filter($filter));

        return view('dashboard::index', compact('contacts'))->withInput($request->all());
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('dashboard::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('dashboard::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
