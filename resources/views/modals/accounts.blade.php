<!-- Modal -->
{{-- <div class="modal fade login-modal" id="addaccount" tabindex="-1" role="dialog" aria-labelledby="addaccountLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">

                <div class="modal-header" id="addaccountLabel">
                <h4 class="modal-title">Add Account</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                </div>
                <div class="modal-body">
                <form class="mt-0 needs-validation" novalidate method="post" action="{{ route('account') }}">
                    @csrf
                    <div class="form-group">
                        <select class="placeholder js-states form-control select" name="type" id="type" {{ (request()->query('id') != '')?'readonly':''}} required>
                            <option value="" selected disabled>Choose Account Type...</option>
                            <option value="1" {{ (request()->query('type') == 'income')?'selected':''}}>Income</option>
                            <option value="2" {{ (request()->query('type') == 'expense')?'selected':''}}>Expense</option>
                        </select>
                        <div class="invalid-feedback">
                            Please enter Account type
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="date" placeholder="Account Date" name="date">
                        <div class="invalid-feedback">
                            Please enter Account date
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="source" placeholder="Account Source *" name="source" value="{{ (request()->query('id') != '')?'INVOICE':''}}" {{ (request()->query('id') != '')?'readonly':''}} required>
                        <div class="invalid-feedback">
                            Please enter Account source
                        </div>
                    </div>

                    <div class="form-group">
                        <select class="placeholder js-states form-control select" name="paymentstatus" id="paymentstatus" required>
                            <option value="" selected disabled>Choose Payment Status...</option>
                            <option value="0">Not Paid</option>
                            <option value="1">Partially Paid</option>
                            <option value="2">Paid</option>
                        </select>                        
                        <div class="invalid-feedback">
                            Please enter Payment Status
                        </div>
                    </div>                    
                    <div class="form-group">
                        <span class="text-dark">Balance: {{ request()->has('bvalue') ? request()->get('bvalue') : '' }}</span>
                        <input type="number" class="form-control mb-2" id="amount" placeholder="Account Amount" name="amount" {{ request()->has('bvalue') ? "max=".request()->get('bvalue') : '' }}>
                        <div class="invalid-feedback">
                            Please enter Account amount
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="notes" placeholder="Notes" name="notes">
                        <div class="invalid-feedback">
                            Please enter Account notes
                        </div>
                    </div>
                    <input type="hidden" id="invoiceid" name="invoiceid" value="{{ request()->has('id') ? request()->get('id') : '' }}">
                    <button type="submit" id="submitBtn" class="btn btn-primary mt-2 mb-2 btn-block">Submit</button>
                </form>
                </div>
            </div>
            </div>
        </div>
    <!-- Modal End-->

    <!-- Edit  Modal -->
    <div class="modal fade login-modal" id="editaccount" tabindex="-1" role="dialog" aria-labelledby="editaccountLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header" id="editaccountLabel">
                <h4 class="modal-title">Edit Account</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                </div>
                <div class="modal-body">
                <form class="mt-0 needs-validation" novalidate method="post" action="{{ route('accountEdit') }}">
                    @csrf
                    <input type="hidden" class="form-control mb-2" id="id" name="id">
                    <div class="form-group">
                        <select class="placeholder js-states form-control select" name="type" id="edittype" required>
                            <option value="" selected disabled>Choose Account Type...</option>
                            <option value="1">Income</option>
                            <option value="2">Expense</option>
                        </select>
                        <div class="invalid-feedback">
                            Please enter Account type
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="editdate" placeholder="Account Date" name="date">
                        <div class="invalid-feedback">
                            Please enter Account date
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="editsource" placeholder="Account Source *" name="source" required>
                        <div class="invalid-feedback">
                            Please enter Account source
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="placeholder js-states form-control select" name="paymentstatus" id="editpaymentstatus" required>
                            <option value="" selected disabled>Choose Payment Status...</option>
                            <option value="0">Not Paid</option>
                            <option value="1">Paid</option>
                            <option value="2">Partially Paid</option>
                        </select> 
                        <div class="invalid-feedback">
                            Please enter Payment Status
                        </div>
                    </div>                    
                    <div class="form-group">
                        <input type="number" class="form-control mb-2" id="editamount" placeholder="Account Amount" name="amount">
                        <div class="invalid-feedback">
                            Please enter Account amount
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="editnotes" placeholder="Notes" name="notes">
                        <div class="invalid-feedback">
                            Please enter Account notes
                        </div>
                    </div>
                    <input type="hidden" id="editinvoiceid" name="invoiceid" value="{{ request()->has('id') ? request()->get('id') : '' }}">
                    <button type="submit" id="editsubmitBtn" class="btn btn-primary mt-2 mb-2 btn-block">Submit</button>
                </form>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Edit Modal End-->