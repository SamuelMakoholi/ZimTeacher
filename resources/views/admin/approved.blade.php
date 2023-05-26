@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                <table class="table">
                @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="list-group">
                                        @foreach($errors->all() as $error)
                                            <li class="list-group-item text-danger">
                                                {{$error}}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (Session::has('success'))
                            <div class= "alert alert-success" role="alert">
                            {{ Session::get('success')}}
                            </div>
                            @elseif (Session::has('deleted'))
                            <div class= "alert alert-danger" role="alert">
                            {{ Session::get('deleted')}}
                            </div>
                            @endif

                    <thead>
                        <tr>
                            <th>Teacher Name</th>
                            {{-- <th>Email</th> --}}
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Leave Type</th>
                            <th>Reason For Leave</th>
                            <th>Status</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaves as $leave)
                            <tr>
                                <td>{{ $leave->name }}</td>
                                {{-- <td>{{ $leave->email }}</td> --}}
                                <td>{{ $leave->start_date }}</td>
                                <td>{{ $leave->end_date }}</td>
                                <td>{{ $leave->leave_type}}</td>
                                {{-- <td>{{ $leave->grade_level }}</td> --}}
                                <td>{{ $leave->reason_for_leave }}</td>
                                <td><p class="text-xs font-weight-bold text-success text-uppercase mb-1">{{ $leave->status }}</p></td>
                                {{-- <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editLeaveModal{{$leave->id}}">Approve</button> --}}
</td>
                            </tr>

        <div class="modal fade" id="editLeaveModal{{$leave->id}}" tabindex="-1" role="dialog" aria-labelledby="editLeaveModal{{ $leave->id }}Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editLeaveModal{{ $leave->id }}Label">Edit Leave Record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
            <div class="modal-body">
                <form action="{{ route('leave.update', $leave->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <h3><b>Approve this Leave</b></h3>
                    {{-- <input type="text" name="user_id" value="{{ Auth::user()->id}}" name="hidden_textbox" id="hidden_textbox" hidden> --}}
                     <input type="text" name="status" value="approved" id="hidden_textbox" hidden>
                    <input type="text" name="id" value="{{ $leave->id}}" id="hidden_textbox" hidden>
                    
                    {{-- <input type="text" name="hidden_textbox" id="hidden_textbox" hidden> --}}



                    <div class="form-group">
                        {{-- <label for="start_date">Start Date:</label> --}}
                        <input type="date" name="start_date" id="start_date" hidden class="form-control" value="{{ $leave->start_date }}" required>
                    </div>
                    <div class="form-group">
                        {{-- <label for="end_date">End Date:</label> --}}
                        <input type="date" name="end_date" id="end_date"  hidden class="form-control" value="{{ $leave->end_date }}" required>
                    </div>
                    <div class="form-group">
                        {{-- <label for="leave_type">Leave Type:</label> --}}
                        <select name="leave_type" id="leave_type"  hidden class="form-control" required>
                            <option value="sick" {{ $leave->leave_type == 'sick' ? 'selected' : '' }}>Sick</option>
                            <option value="personal" {{ $leave->leave_type == 'personal' ? 'selected' : '' }}>Personal</option>
                            <option value="annual" {{ $leave->leave_type == 'annual' ? 'selected' : '' }}>Annual</option>
                        </select>
                    </div>
                    <div class="form-group">
                        {{-- <label for="reason_for_leave">Reason for Leave:</label> --}}
                        <textarea name="reason_for_leave" id="reason_for_leave" hidden class="form-control" rows="3" required>{{ $leave->reason_for_leave }}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            
                        </tr>
                    </tfoot>
                </table>

                    

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
