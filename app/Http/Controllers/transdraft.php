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
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @elseif(Session::has('deleted'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('deleted') }}
                        </div>
                    @endif

                    <table class="table">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addtransferModal">Add transfer</button>
                        <thead>
                            <tr>
                                <th>Current Place</th>
                                <th>From School</th>
                                <th>To School</th>
                                <th>Reason for Transfer</th>
                                <th>Date of Transfer</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!is_null($transfers))
                                <!--  -->
                            @endif

                            @foreach($transfers as $transfer)
                                <tr>
                                    <td>{{ $transfer->current_place }}</td>
                                    <td>{{ $transfer->from_school }}</td>
                                    <td>{{ $transfer->to_school }}</td>
                                    <td>{{ $transfer->reason_for_transfer }}</td>
                                    <td>{{ $transfer->date_of_transfer }}</td>
                                    <td>{{ $transfer->status }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edittransferModal{{ $transfer->id }}">Edit</button>
                                        <form action="{{ route('transfer.destroy', $transfer->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                            </table>
                       
