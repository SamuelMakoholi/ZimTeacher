@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                   
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
                    <table class="table">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addLeaveModal">Add Leave</button>
                    <thead>
                        <tr>
                           
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Leave Type</th>
                            <th>Reason for Leave</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    {{-- @if (!is_null($leaves)) --}}
                    @foreach ($leaves as $leave)
                        <tr>
                            <td>{{ $leave->start_date }}</td>
                            <td>{{ $leave->end_date }}</td>
                            <td>{{ $leave->leave_type }}</td>
                            <td>{{ $leave->reason_for_leave }}</td>
                            <td>{{ $leave->status }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editLeaveModal{{$leave->id}}">Edit</button>
                                <form action="{{ route('leave.destroy', $leave->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                                        <!-- Edit Leave Modal -->
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
                    <input type="text" name="user_id" value="{{ Auth::user()->id}}" name="hidden_textbox" id="hidden_textbox" hidden>
                    <input type="text" name="status" value="pending" id="hidden_textbox" hidden>



                    <div class="form-group">
                        <label for="start_date">Start Date:</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $leave->start_date }}" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date:</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $leave->end_date }}" required>
                    </div>
                    <div class="form-group">
                        <label for="leave_type">Leave Type:</label>
                        <select name="leave_type" id="leave_type" class="form-control" required>
                            <option value="sick" {{ $leave->leave_type == 'sick' ? 'selected' : '' }}>Sick</option>
                            <option value="personal" {{ $leave->leave_type == 'personal' ? 'selected' : '' }}>Personal</option>
                            <option value="annual" {{ $leave->leave_type == 'annual' ? 'selected' : '' }}>Annual</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="reason_for_leave">Reason for Leave:</label>
                        <textarea name="reason_for_leave" id="reason_for_leave" class="form-control" rows="3" required>{{ $leave->reason_for_leave }}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
            @endforeach
            {{-- @endif --}}
                </tbody>

    </div>
</div>


                </table>

            <div class="modal fade" id="addLeaveModal" tabindex="-1" role="dialog" aria-labelledby="addLeaveModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLeaveModalLabel">Add Leave Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('leave.store')}}" method="POST">
                    @csrf
                    {{-- <div class="form-group">
                        <label for="teacher_id">Teacher ID</label>
                        <input type="text" class="form-control" id="teacher_id" name="teacher_id" value={{Auth::user()->id}} placeholder="Enter teacher ID">
                    </div> --}}
                    <input type="text" name="user_id" value={{Auth::user()->id}} id="hidden_textbox" hidden>


                    <input type="text" name="status" value="pending" id="hidden_textbox" hidden>

                    
                    <div class="form-group">
                        <label for="leave_type">Leave Type</label>
                        <select class="form-control" id="leave_type" name="leave_type">
                        <option value="sick leaver">Sick Leave</option>
                        <option value="Personal Leave">Personal Leave</option>
                        <option value="Family Leave">Family Leave</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="reason_for_leave">Reason for Leave</label>
                        <textarea class="form-control" id="reason_for_leave" name="reason_for_leave" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date">
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Leave</button>
                    </div>
                    </form>
                </div>
                </div>
            </div>
            </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
