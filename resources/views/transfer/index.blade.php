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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addtransferModal">Add transfer</button>
                    <thead>
                        <tr>
                           
                            <th>Current Place</th>
                            <th>From School</th>
                            <th>To School</th>
                            <th>Reason for transfer</th>
                            <th>Date of Transfer</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    {{-- @if (!is_null($transfers)) --}}
                    @foreach ($transfers as $transfer)
                        <tr>
                            <td>{{ $transfer->current_place }}</td>
                            <td>{{ $transfer->from_school }}</td>
                            <td>{{ $transfer->to_school }}</td>
                            <td>{{ $transfer->reason_for_transfer }}</td>
                            <td>{{ $transfer->date_of_transfer }}</td>
                            <td>{{ $transfer->status }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edittransferModal{{$transfer->id}}">Edit</button>
                                <form action="{{ route('transfer.destroy', $transfer->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
<!-- Edit transfer Modal -->
        <div class="modal fade" id="edittransferModal{{$transfer->id}}" tabindex="-1" role="dialog" aria-labelledby="edittransferModal{{ $transfer->id }}Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edittransferModal{{ $transfer->id }}Label">Edit transfer Record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
            <div class="modal-body">
                <form action="{{ route('transfer.update', $transfer->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="text" name="user_id" value={{Auth::user()->id}} id="hidden_textbox" hidden>


                    <input type="text" name="status" value="pending" id="hidden_textbox" hidden>

                    <div class="form-group">
                        <label for="start_date">Current Place</label>
                        <input type="text" class="form-control" id="start_date" value="{{ $transfer->current_place}}" name="current_place">
                    </div>

                    <div class="form-group">
                        <label for="start_date">From School</label>
                        <input type="text" class="form-control" id="start_date" value="{{ $transfer->from_school}}" name="from_school">
                    </div>

                    <div class="form-group">
                        <label for="start_date">To School</label>
                        <input type="text" class="form-control" id="start_date" value="{{ $transfer->to_school}}" name="to_school">
                    </div>

                    <div class="form-group">
                        <label for="reason_for_transfer">Reason for transfer</label>
                        <textarea class="form-control" id="reason_for_transfer" name="reason_for_transfer" value="{{ $transfer->reason_for_transfer}}" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Date For Transfer</label>
                        <input type="date" class="form-control" id="start_date" name="date_of_transfer" value="{{ $transfer->date_of_transfer}}">
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add transfer</button>
                    </div>
                    
                </form>
            </div>
        </div>
            @endforeach
     
                </tbody>

    </div>
</div>


                </table>

            <div class="modal fade" id="addtransferModal" tabindex="-1" role="dialog" aria-labelledby="addtransferModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addtransferModalLabel">Add transfer Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('transfer.store')}}" method="POST">
                    @csrf
                    {{-- <div class="form-group">
                        <label for="teacher_id">Teacher ID</label>
                        <input type="text" class="form-control" id="teacher_id" name="teacher_id" value={{Auth::user()->id}} placeholder="Enter teacher ID">
                    </div> --}}
                    <input type="text" name="user_id" value={{Auth::user()->id}} id="hidden_textbox" hidden>


                    <input type="text" name="status" value="pending" id="hidden_textbox" hidden>

                    <div class="form-group">
                        <label for="start_date">Current Place</label>
                        <input type="text" class="form-control" id="start_date" name="current_place">
                    </div>

                    <div class="form-group">
                        <label for="start_date">From School</label>
                        <input type="text" class="form-control" id="start_date" name="from_school">
                    </div>

                    <div class="form-group">
                        <label for="start_date">To School</label>
                        <input type="text" class="form-control" id="start_date" name="to_school">
                    </div>

                    <div class="form-group">
                        <label for="reason_for_transfer">Reason for transfer</label>
                        <textarea class="form-control" id="reason_for_transfer" name="reason_for_transfer" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Date For Transfer</label>
                        <input type="date" class="form-control" id="start_date" name="date_of_transfer">
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add transfer</button>
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
