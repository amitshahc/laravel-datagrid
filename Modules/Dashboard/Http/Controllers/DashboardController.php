<?php

namespace Modules\Dashboard\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Dashboard\Entities\Repository\Interfaces\Contacts as ContactsRepository;
use Modules\Dashboard\Http\Requests\CantactsRequest;
use Modules\Dashboard\Http\Requests\FilterSaveRequest;

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
        $filters_public = $this->repo->getFilters_public();
        $filters_private = $this->repo->getFilters_private();
        return view('dashboard::index', compact('contacts', 'filters_public', 'filters_private'));
    }

    public function filter(CantactsRequest $request)
    {
        // $filters_public = [];
        // $filters_private = [];

        $filter = $request->only('name_operator', 'name_value', 'email_operator', 'email_value', 'phone_operator', 'phone_value', 'gender_value', 'age_operator', 'age_value');

        $contacts = $this->repo->getFilteredList(array_filter($filter));
        $contacts->appends($filter)->links(); //Continue pagination with results
        $filters_public = $this->repo->getFilters_public();
        $filters_private = $this->repo->getFilters_private();

        $this->repo->commit();
        return view('dashboard::index', compact('contacts', 'filters_public', 'filters_private'))->withInput($filter);
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function createFilter()
    {
        return view('dashboard::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(FilterSaveRequest $request)
    {        
        try
        {
            $this->repo->beginTransaction();
            //if ($request->input('filter_save')) {

            $data['name'] = $request->input('filter_name');
            $data['public'] = $request->input('filter_type') == '1' ? true : false;
            $data['url'] = $request->input('filter_url'); //json_encode($filter);

            $this->repo->createFilter($data);
            //}
        } catch (\Execption $e) {
            $this->repo->rollback();
            report($e);
            return back()->withErrors($e->getMessage())->withInput();
        }

        $this->repo->commit();
        return redirect(url($request->input('filter_url')));
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
