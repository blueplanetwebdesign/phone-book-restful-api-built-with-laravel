@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>



            <div class="panel panel-default">
                <div class="panel-heading">API Control Panel</div>

                <div class="panel-body">
                    {!! Form::open() !!}
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-2">Name:</div>
                            <div class="col-md-4">{{ $data->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Email:</div>
                            <div class="col-md-4">{{ $data->email }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">API Token:</div>
                            <siv class="col-md-4">{{ $data->api_token }}</siv>
                        </div>
                        <div class="row center-block">
                            {{ Form::submit('Reset Token', ['class' => 'center-block']) }}
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Phone Book</div>
                <div class="container-fluid">
                    <table>
                        <th width="10%">Name</th>
                        <th width="10%">Email</th>
                        <th width="10%">Phone Number</th>

                        @foreach($data->phoneBook AS $row)
                            <tr>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->phone_number }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
