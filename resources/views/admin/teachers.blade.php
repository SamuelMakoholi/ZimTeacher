@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>TeacherName</th>
                            <th>Email</th>
                            {{-- <th>DOB</th> --}}
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>ID.No</th>
                            {{-- <th>Grade/Level</th> --}}
                            <th>District</th>
                            <th>Province</th>
                            <th>School</th>
                            <th>Qualification</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teachers as $teacher)
                            <tr>
                                <td>{{ $teacher->name }}</td>
                                <td>{{ $teacher->email }}</td>
                                {{-- <td>{{ $teacher->dob }}</td> --}}
                                <td>{{ $teacher->gender }}</td>
                                <td>{{ $teacher->phone }}</td>
                                <td>{{ $teacher->id_no }}</td>
                                {{-- <td>{{ $teacher->grade_level }}</td> --}}
                                <td>{{ $teacher->district }}</td>
                                <td>{{ $teacher->province }}</td>
                                {{-- <td>{{ $teacher->class_course }}</td> --}}
                                <td>{{ $teacher->qualification }}</td>
                                <td>{{ $teacher->school }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            {{-- <td colspan="5">
                                <a href="/teachers/create" class="btn btn-primary">Add Teacher</a>
                            </td> --}}
                        </tr>
                    </tfoot>
                </table>
                 <span>{{ $teachers->links() }}</span>

                 <style>
                 .w-5{
                    display: none;
                 }
                 
                 </style>

                    

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
