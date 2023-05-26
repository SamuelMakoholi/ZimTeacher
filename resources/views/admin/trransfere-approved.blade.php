@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
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

                <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Teacher Name</th>
                            <th>Current School</th>
                            <th>New School</th>
                            <th>Reason For_Transfer</th>
                            <th>Date</th>
                            <th>Status</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transfers as $transfer)
                            <tr>
                                <td>{{ $transfer->id }}</td>
                                <td>{{ $transfer->name }}</td>
                                <td>{{ $transfer->from_school }}</td>
                                <td>{{ $transfer->to_school}}</td>
                                <td>{{ $transfer->reason_for_transfer }}</td>
                                <td>{{ $transfer->date_of_transfer }}</td>
                                <td><p class="text-xs font-weight-bold text-success text-uppercase mb-1">{{ $transfer->status }}</p></td>
                                <td>
                                <td>
                                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edittransferModal{{$transfer->id}}">Approve</button> --}}
                                {{-- <form action="{{ route('transfer.destroy', $transfer->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form> --}}
                            </td>
                            </tr>
        <div class="modal fade" id="edittransferModal{{$transfer->id}}" tabindex="-1" role="dialog" aria-labelledby="edittransferModal{{ $transfer->id }}Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edittransferModal{{ $transfer->id }}Label">Approve</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
            <div class="modal-body">
                <form action="{{ route('transfer.update', $transfer->id )}}" method="POST">
                    @csrf
                    @method('PUT')
                    <h3><b>Approve this Transfer</b></h3>
                    <input type="text" name="status" value="approved" id="hidden_textbox" hidden>
                    <input type="text" name="id" value="{{ $transfer->id}}" id="hidden_textbox" hidden>
                    
                    <div class="form-group">
                        {{-- <label for="start_date">Current Place</label> --}}
                        <input type="text" class="form-control" id="start_date" hidden value="{{ $transfer->current_place}}" name="current_place">
                    </div>

                    <div class="form-group">
                        {{-- <label for="start_date">From School</label> --}}
                        <input type="text" class="form-control" id="start_date"hidden value="{{ $transfer->from_school}}" name="from_school">
                    </div>

                    <div class="form-group">
                        {{-- <label for="start_date">To School</label> --}}
                        <input type="text" class="form-control" id="start_date" hidden value="{{ $transfer->to_school}}" name="to_school">
                    </div>

                    <div class="form-group">
                        {{-- <label for="reason_for_transfer">Reason for transfer</label> --}}
                        <input type="text" class="form-control" id="reason_for_transfer" hidden name="reason_for_transfer" value="{{ $transfer->reason_for_transfer}}" >
                    </div>
                    <div class="form-group">
                        {{-- <label for="start_date">Date For Transfer</label> --}}
                        <input type="date" class="form-control" id="start_date" hidden name="date_of_transfer" value="{{ $transfer->date_of_transfer}}">
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
                            {{-- <td colspan="5">
                                <a href="/transfers/create" class="btn btn-primary">Add transfer</a>
                            </td> --}}
                        </tr>
                    </tfoot>
                </table>

                    

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
