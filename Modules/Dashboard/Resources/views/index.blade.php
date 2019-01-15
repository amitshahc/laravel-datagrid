@extends('dashboard::layouts.master')

@section('content')
<h2>Contacts</h2>

@include('dashboard::layouts.includes.errors')

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <form action="{{ route('create_filter') }}" method="POST" class="">
                @method('POST')
                @csrf
                @if(!$contacts->isEmpty())
                <tr>
                    <td colspan="6">
                        <div class="float-left text-info">
                            Showing {{ $contacts->firstItem() }} to {{ $contacts->lastItem() }} of total
                            {{$contacts->total()}} entries
                        </div>
                        <div class="float-right">
                            {{ $contacts->links() }}
                        </div>
                    </td>
                </tr>
                @endif

                <tr>
                    <td colspan="3">
                        {{-- Save applied Filter : <input type="checkbox" name="filter_save" value="1">
                        &nbsp; --}}
                        <label for="">Save applied Filter :</label>
                        <br />
                        Name: <input type="text" name="filter_name" value="{{ old('filter_name')}} " class="form-control-sm">
                        &nbsp;
                        <label for="filter_type1">Public:</label>  
                        <input type="radio" name="filter_type" id="filter_type1" value="1" @if (old('filter_type') == '1') {{ 'checked' }} @endif />
                        &nbsp;
                        <label for="filter_type0">Private:</label>  
                        <input type="radio" name="filter_type" id="filter_type0" value="0" @if (old('filter_type') == '0') {{ 'checked' }} @endif />
                        <input type="hidden" name="filter_url" value="{{ Request::getPathInfo() .'?'. Request::getQueryString()}}" />
                        <input type="submit" class="btn btn-success btn-sm" value="Save" />
                    </td>

                    <td colspan="3">
                        <label>Apply saved Filter:</label>
                        <br />
                        Public: 
                        <select name="filters_public" id="" style="width:20%" onChange="fillForm(this)" class="form-control-sm">
                            <option value="">-</option>
                            @if(!$filters_public->isEmpty())
                            @foreach ($filters_public as $filter)
                            <option value="{{$filter->url}}">{{$filter->name}}</option>
                            @endforeach
                            @endif
                        </select>
                        &nbsp;
                        Private: 
                        <select name="filters_private" id="" style="width:20%" onChange="fillForm(this)" class="form-control-sm">
                            <option value="">-</option>
                            @if(!$filters_private->isEmpty())
                            @foreach ($filters_private as $filter)
                            <option value="{{$filter->url}}">{{$filter->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </td>
                </tr>
                </form>
                
                <form action="{{ route('contacts_filter') }}" method="GET" class="">
                <tr>
                    <th>
                        <input type="submit" value="Filter" class="btn btn-info btn-sm">
                        <a class="btn btn-danger btn-sm" href="/dashboard">Clear</a>
                    </th>
                    <th>
                        <select name="name_operator" id="" class="form-control-sm">
                            <option value="=" @if (Request::get('name_operator')=='=' ) {{ 'selected' }} @endif>=</option>
                            <option value="<>" @if (Request::get('name_operator')=='<>' ) {{ 'selected' }} @endif>!=</option>
                            <option value="like" @if (Request::get('name_operator')=='like' ) {{ 'selected' }} @endif>like</option>
                        </select>
                        :
                        <input type="text" name="name_value" value="{{Request::old('name_value', Request::get('name_value'))}}"
                            style="width:50%" class="form-control-sm" />
                    </th>
                    <th>
                        <select name="email_operator" id="" class="form-control-sm">
                            <option value="=" @if (Request::get('email_operator')=='=' ) {{ 'selected' }} @endif>=</option>
                            <option value="<>" @if (Request::get('email_operator')=='<>' ) {{ 'selected' }} @endif>!=</option>
                            <option value="like" @if (Request::get('email_operator')=='like' ) {{ 'selected' }} @endif>like</option>
                        </select>
                        :
                        <input type="text" name="email_value" value="{{Request::old('email_value', Request::get('email_value'))}}"
                            style="width:50%" class="form-control-sm" />
                    </th>
                    <th>
                        <select name="phone_operator" id="" class="form-control-sm">
                            <option value="=" @if (Request::get('phone_operator')=='=' ) {{ 'selected' }} @endif>=</option>
                            <option value="<>" @if (Request::get('phone_operator')=='<>' ) {{ 'selected' }} @endif>!=</option>
                            <option value="like" @if (Request::get('phone_operator')=='like' ) {{ 'selected' }} @endif>like</option>
                        </select>
                        :
                        <input type="text" name="phone_value" value="{{Request::old('phone_value', Request::get('phone_value'))}}"
                            style="width:50%" class="form-control-sm" />
                    </th>
                    <th>
                        <select name="gender_value" id="" class="form-control-sm">
                            <option value="" @if (Request::get('gender_value')=='' ) {{ 'selected' }} @endif>- Any -</option>
                            <option value="male" @if (Request::get('gender_value')=='male' ) {{ 'selected' }} @endif>male</option>
                            <option value="female" @if (Request::get('gender_value')=='female' ) {{ 'selected' }}
                                @endif>female</option>
                            <option value="other" @if (Request::get('gender_value')=='other' ) {{ 'selected' }} @endif>other</option>
                        </select>
                        {{-- <input type="text" name="id" value="" style="width:auto" class="form-control-sm" /> --}}
                    </th>
                    <th style="width:10%">
                        <select name="age_operator" id="" class="form-control-sm">
                            <option value="=" @if (Request::get('age_operator')=='=' ) {{ 'selected' }} @endif>=</option>
                            <option value="<>" @if (Request::get('age_operator')=='<>' ) {{ 'selected' }} @endif>!=</option>
                            <option value="<" @if (Request::get('age_operator')=='<' ) {{ 'selected' }} @endif>
                                <</option> <option value=">" @if (Request::get('age_operator')=='>' ) {{ 'selected' }}
                                    @endif>>
                            </option>
                        </select>
                        :
                        <input type="text" name="age_value" value="{{Request::old('age_value', Request::get('age_value'))}}"
                            style="width:30%" class="form-control-sm" />
                    </th>
                </tr>
            </form>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Age</th>
            </tr>
        </thead>
        <tbody>
            @if($contacts->isEmpty())
            <td colspan="6" class="text-center">No Records Matched</td>
            @endif
            @foreach ($contacts as $contact)
            <tr>
                <td>{{$contact->id}}</td>
                <td>{{$contact->name}}</td>
                <td>{{$contact->email}}</td>
                <td>{{$contact->phone}}</td>
                <td>{{$contact->gender}}</td>
                <td>{{$contact->age}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop


@push('post_body')
    <script>
    function fillForm(ctl){
        console.log(ctl.value);
        window.location.href = ctl.value;
    }
    </script>
@endpush