@extends('app')

@section('title', 'Data List')

@section('content')
    <h2>Submitted Data</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataList as $data)
                <tr>
                    <td>{{ $data['name'] }}</td>
                    <td>{{ $data['email'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
