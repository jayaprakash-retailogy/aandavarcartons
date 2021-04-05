<!-- Modal -->
<div class="modal fade login-modal" id="addcustomer" tabindex="-1" role="dialog" aria-labelledby="addcustomerLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">

                <div class="modal-header" id="addcustomerLabel">
                <h4 class="modal-title">Add Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                </div>
                <div class="modal-body">
                <form class="mt-0 needs-validation" novalidate method="post" action="{{ route('customer') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="name" placeholder="Customer Name *" name="name" required>
                        <div class="invalid-feedback">
                            Please enter Customer name
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="gst" placeholder="Customer GST" name="gst">
                        <div class="invalid-feedback">
                            Please enter Customer gst
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="address" placeholder="Customer Address" name="address">
                        <div class="invalid-feedback">
                            Please enter Customer address
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="phone" placeholder="Customer Phone *" name="phone" required>
                        <div class="invalid-feedback">
                            Please enter Customer phone
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control mb-2" id="email" placeholder="Customer Email *" name="email" required>
                        <div class="invalid-feedback">
                            Please enter Customer email
                        </div>
                    </div>
                    <button type="submit" id="submitBtn" class="btn btn-primary mt-2 mb-2 btn-block">Submit</button>
                </form>
                </div>
            </div>
            </div>
        </div>
    <!-- Modal End-->

    <!-- Edit  Modal -->
    <div class="modal fade login-modal" id="editcustomer" tabindex="-1" role="dialog" aria-labelledby="editcustomerLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">

                <div class="modal-header" id="editcustomerLabel">
                <h4 class="modal-title">Edit Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                </div>
                <div class="modal-body">
                <form class="mt-0 needs-validation" novalidate method="post" action="{{ route('customerEdit') }}">
                    @csrf
                    <input type="hidden" class="form-control mb-2" id="id" name="id">
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="editName" placeholder="Customer Name *" name="name" required>
                        <div class="invalid-feedback">
                            Please enter Customer name
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="editgst" placeholder="Customer GST" name="gst">
                        <div class="invalid-feedback">
                            Please enter Customer gst
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="editaddress" placeholder="Customer Address" name="address">
                        <div class="invalid-feedback">
                            Please enter Customer address
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="editphone" placeholder="Customer Phone *" name="phone" required>
                        <div class="invalid-feedback">
                            Please enter Customer phone
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control mb-2" id="editemail" placeholder="Customer Email *" name="email" required>
                        <div class="invalid-feedback">
                            Please enter Customer email
                        </div>
                    </div>
                    <button type="submit" id="editsubmitBtn" class="btn btn-primary mt-2 mb-2 btn-block">Submit</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal End-->