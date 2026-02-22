<button type="button" id="addSponsorTrigger" class="btn btn-primary"><span class="material-icons">add</span> <span
        class="ml-2">Add sponsor</span></button>

<div id="add-sponsor-modal" class="modal fade add-sponsor-modal" tabindex="-1" role="dialog" aria-labelledby="modal-standard-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-add-sponsor" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-standard-title">Add sponsor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> <!-- // END .modal-header -->
            <div class="modal-body">
                <form id="addSponsorForm" class="modal-form-grid" action="{{ route('user.sponsors.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">

                    <div class="card-header card-header-tabs-basic nav" role="tablist">
                        <a href="#basic" class="active" data-toggle="tab" role="tab" aria-controls="basic"
                            aria-selected="true">Basic</a>
                        <a href="#advanced" data-toggle="tab" role="tab" aria-selected="false">Advanced</a>
                    </div>
                    <div class="tab-content mt-2">
                        <div class="tab-pane active show fade" id="basic">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger" aria-hidden="true">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" required placeholder="Sponsor name">
                                </div>
                                <div class="form-group">
                                    <label for="place">Place <span class="text-danger" aria-hidden="true">*</span></label>
                                    <input type="text" class="form-control" id="place" name="place" required placeholder="Location">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="phone">Phone <span class="text-danger" aria-hidden="true">*</span></label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required placeholder="Phone number">
                                </div>
                                <div class="form-group">
                                    <label for="amount">Amount <span class="text-danger" aria-hidden="true">*</span></label>
                                    <input type="number" min="0" step="1" class="form-control" id="amount" name="amount" required placeholder="0">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="amount_received">Amount received <span class="text-danger" aria-hidden="true">*</span></label>
                                    <select name="amount_received" id="amount_received" class="form-control" required>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="payment_type">Payment type <span class="text-danger" aria-hidden="true">*</span></label>
                                    <select name="payment_type" id="payment_type" class="form-control" required>
                                        <option value="One time">One time</option>
                                        <option value="Recurring">Recurring</option>
                                    </select>
                                </div>
                            </div>
                            <div id="recurring-payment-options">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="payment_type_interval">Interval</label>
                                        <select name="payment_type_interval" id="payment_type_interval" class="form-control">
                                            <option value="Monthly">Monthly</option>
                                            <option value="Yearly">Yearly</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="payment_type_times">Times</label>
                                        <input type="number" min="1" name="payment_type_times" id="payment_type_times" class="form-control" placeholder="No. of times">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="advanced">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="whatsapp">Whatsapp</label>
                                    <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="Whatsapp number">
                                </div>
                                <div class="form-group">
                                    <label for="mode">Mode</label>
                                    <select name="mode" id="mode" class="form-control">
                                        <option value="">Select mode</option>
                                        <option value="1" selected>Cash</option>
                                        <option value="2">Bank transfer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="transaction_id">Transaction ID</label>
                                    <input type="text" class="form-control" id="transaction_id" name="transaction_id" placeholder="If available">
                                </div>
                                <div class="form-group">
                                    <label for="bank">Bank</label>
                                    <select name="bank" id="bank" class="form-control">
                                        <option value="">Select bank</option>
                                        <option value="1">HDFC BANK</option>
                                        <option value="2">KERALA GRAMIN BANK</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="receipt_no">Receipt no</label>
                                <input type="number" min="0" class="form-control" id="receipt_no" name="receipt_no" placeholder="Optional">
                            </div>
                        </div>
                    </div>
                </form>
            </div> <!-- // END .modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button form="addSponsorForm" type="submit" class="btn btn-primary">Save</button>
            </div> <!-- // END .modal-footer -->
        </div> <!-- // END .modal-content -->
    </div> <!-- // END .modal-dialog -->
</div> <!-- // END .modal -->

@section('scripts')    
<script>
    $(function(){
        const recurringPaymentOptions = $('#recurring-payment-options');

        recurringPaymentOptions.hide();

        $('#payment_type').change(function(){
            if($(this).val() === 'Recurring') {
                recurringPaymentOptions.show();
            } else {
                recurringPaymentOptions.hide();
            }
        })
    })
</script>
@endsection