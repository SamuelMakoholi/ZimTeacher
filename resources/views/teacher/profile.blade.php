@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>{{ $profile->name }}'s Profile</h1>
        <table class="table">
            <tbody>
                <tr>
                    <th>Teacher ID</th>
                    <td>{{ $profile->id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $profile->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $profile->email }}</td>
                </tr>
                <tr>
                    <th>Dirt Of Birth</th>
                    <td>{{ $profile->dob }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $profile->phone }}</td>
                </tr>
                <tr>
                    <th>Qualification</th>
                    <td>{{ $profile->qualification }}</td>
                </tr>
                    <tr>
                    <th>School</th>
                    <td>{{ $profile->school }}</td>
                </tr>
                <tr>
                    <th>Subjects</th>
                    <td>{{ $profile->district }}</td>
                </tr>
                <tr>
                    <th>Experience</th>
                    <td>{{ $profile->province }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
