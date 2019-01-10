@extends('dashboard::layouts.master')

@section('content')
<h2>Contacts</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
        <form action="{{ route('contacts_filter') }}" method="POST" class="">
            @method('POST')
            @csrf
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
                            <option value="=">=</option>                            
                            <option value="like">like</option>
                        </select>
                        :
                        <input type="text" name="name_value" value="" style="width:auto" class="form-control-sm" />
                    </th>
                    <th>
                        <select name="email_operator" id="" class="form-control-sm">
                            <option value="=">=</option>                            
                            <option value="like">like</option>
                        </select>
                        :
                        <input type="text" name="email_value" value="" style="width:auto" class="form-control-sm" />
                    </th>
                    <th>
                        <select name="phone_operator" id="" class="form-control-sm">
                            <option value="=">=</option>                            
                            <option value="like">like</option>
                        </select>
                        :
                        <input type="text" name="phone_value" value="" style="width:auto" class="form-control-sm" />
                    </th>
                    <th>
                        <select name="gender_value" id="" class="form-control-sm">
                            <option value="">- Any -</option>
                            <option value="=">male</option>
                            <option value="<">female</option>
                            <option value=">">other</option>
                        </select>                        
                        {{-- <input type="text" name="id" value="" style="width:auto" class="form-control-sm" /> --}}
                    </th>
                    <th>
                        <select name="age_operator" id="" class="form-control-sm">
                            <option value="=">=</option>
                            <option value="<">
                                <</option> <option value=">">>
                            </option>
                        </select>
                        :
                        <input type="text" name="age_value" value="" style="width:2rem" class="form-control-sm" />
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
