<div class="modal fade" id="edittransferModal{{$transfer->id}}" tabindex="-1" role="dialog" aria-labelledby="addtransferModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addtransferModalLabel">Add transfer Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body">
                <form id="transferForm" method="POST" action="{{ route('transfer.update', $transfer->id)}}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="text" name="status" value="pending" id="hidden_textbox" hidden>

                    <div class="form-group">
                        <label for="current_place">Current Place</label>
                        <input type="text" class="form-control" id="current_place" value="{{ $leave->current_place }}" name="current_place" required>
                    </div>
                    <div class="form-group">
                        <label for="from_school">From School</label>
                        <input type="text" class="form-control" id="from_school" value="{{ $leave->from_school }}" name="from_school" required>
                    </div>
                    <div class="form-group">
                        <label for="to_school">To School</label>
                        <input type="text" class="form-control" id="to_school" value="{{ $leave->to_school }}" name="to_school" required>
                    </div>
                    <div class="form-group">
                        <label for="reason_for_transfer">Reason for Transfer</label>
                        <textarea class="form-control" id="reason_for_transfer" value="{{ $leave->reason_for_transfer }}" name="reason_for_transfer" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="date_of_transfer">Date of Transfer</label>
                        <input type="date" class="form-control" id="date_of_transfer" value="{{ $leave->date_of_transfer }}" name="date_of_transfer" required>
                    </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>