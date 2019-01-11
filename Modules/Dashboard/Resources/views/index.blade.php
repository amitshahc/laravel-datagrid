@extends('dashboard::layouts.master')

@section('content')
<h2>Contacts</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <form action="{{ route('contacts_filter') }}" method="GET" class="">
                {{-- @method('POST')
                @csrf --}}
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
                <tr>
                    <th>
                        <input type="submit" value="Filter" class="btn-info">
                    </th>
                    <th>
                        <select name="name_operator" id="" class="form-control-sm">
                            <option value="=" @if (Request::get('name_operator')=='=' ) {{ 'selected' }} @endif>=</option>
                            <option value="<>" @if (Request::get('name_operator')=='<>' ) {{ 'selected' }} @endif>!=</option>
                            <option value="like" @if (Request::get('name_operator')=='like' ) {{ 'selected' }} @endif>like</option>
                        </select>
                        :
                        <input type="text" name="name_value" value="{{Request::get('name_value')}}" style="width:auto"
                            class="form-control-sm" />
                    </th>
                    <th>
                        <select name="email_operator" id="" class="form-control-sm">
                            <option value="=" @if (Request::get('email_operator')=='=' ) {{ 'selected' }} @endif>=</option>
                            <option value="<>" @if (Request::get('email_operator')=='<>' ) {{ 'selected' }} @endif>!=</option>
                            <option value="like" @if (Request::get('email_operator')=='like' ) {{ 'selected' }} @endif>like</option>
                        </select>
                        :
                        <input type="text" name="email_value" value="{{Request::get('email_value')}}" style="width:auto" class="form-control-sm" />
                    </th>
                    <th>
                        <select name="phone_operator" id="" class="form-control-sm">
                                <option value="=" @if (Request::get('phone_operator')=='=' ) {{ 'selected' }} @endif>=</option>
                                <option value="<>" @if (Request::get('phone_operator')=='<>' ) {{ 'selected' }} @endif>!=</option>
                                <option value="like" @if (Request::get('phone_operator')=='like' ) {{ 'selected' }} @endif>like</option>
                        </select>
                        :
                        <input type="text" name="phone_value" value="{{Request::get('phone_value')}}" style="width:auto" class="form-control-sm" />
                    </th>
                    <th>
                        <select name="gender_value" id="" class="form-control-sm">
                            <option value="" @if (Request::get('gender_value')=='' ) {{ 'selected' }} @endif>- Any -</option>
                            <option value="male" @if (Request::get('gender_value')=='male' ) {{ 'selected' }} @endif>male</option>
                            <option value="female" @if (Request::get('gender_value')=='female' ) {{ 'selected' }} @endif>female</option>
                            <option value="other" @if (Request::get('gender_value')=='other' ) {{ 'selected' }} @endif>other</option>
                        </select>
                        {{-- <input type="text" name="id" value="" style="width:auto" class="form-control-sm" /> --}}
                    </th>
                    <th>
                        <select name="age_operator" id="" class="form-control-sm">
                                <option value="=" @if (Request::get('age_operator')=='=' ) {{ 'selected' }} @endif>=</option>
                                <option value="<>" @if (Request::get('age_operator')=='<>' ) {{ 'selected' }} @endif>!=</option>
                                <option value="<" @if (Request::get('age_operator')=='<' ) {{ 'selected' }} @endif><</option>
                                <option value=">" @if (Request::get('age_operator')=='>' ) {{ 'selected' }} @endif>></option>
                        </select>
                        :
                        <input type="text" name="age_value" value="{{Request::get('age_value')}}" style="width:2rem" class="form-control-sm" />
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
