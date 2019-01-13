<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Dashboard\Entities\Repository\Interfaces\Contacts as ContactsRepository;
use Modules\Dashboard\Http\Requests\CantactsRequest;
use Auth;

class DashboardController extends Controller
{
    protected $repo;
    protected $userId;

    public function __construct(ContactsRepository $repo)
    {
        $this->repo = $repo;

        $this->middleware(function ($request, $next) {            
            $this->userId = Auth::user()->id;
            $this->repo->setUserId($this->userId);
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $contacts = $this->repo->getList();
        return view('dashboard::index', compact('contacts'));
    }

    public function filter(CantactsRequest $request)
    {
        $filter = $request->only('name_operator', 'name_value', 'email_operator', 'email_value', 'phone_operator', 'phone_value', 'gender_value', 'age_operator', 'age_value');
        $contacts = $this->repo->getFilteredList(array_filter($filter));
        $contacts->appends($filter)->links(); //Continue pagination with results

        if ($request->input('filter_save')) {            
            
            $data['name'] = $request->input('filter_name');
            $data['public'] = $request->input('filter_type') == '1' ? true : false;
            $data['fields'] = json_encode($filter);

            $this->repo->createFilter($data);
        }
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
