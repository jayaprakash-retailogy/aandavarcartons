<!-- Modal -->
        <div class="modal fade login-modal" id="addSupplier" tabindex="-1" role="dialog" aria-labelledby="addSupplierLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">

                <div class="modal-header" id="addSupplierLabel">
                <h4 class="modal-title">Add Supplier</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                </div>
                <div class="modal-body">
                <form class="mt-0 needs-validation" novalidate method="post" action="{{ route('supplier') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="name" placeholder="Supplier Name *" name="name" required>
                        <div class="invalid-feedback">
                            Please enter supplier name
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="gst" placeholder="Supplier GST" name="gst">
                        <div class="invalid-feedback">
                            Please enter supplier gst
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="address" placeholder="Supplier Address" name="address">
                        <div class="invalid-feedback">
                            Please enter supplier address
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="phone" placeholder="Supplier Phone *" name="phone" required>
                        <div class="invalid-feedback">
                            Please enter supplier phone
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control mb-2" id="email" placeholder="Supplier Email *" name="email" required>
                        <div class="invalid-feedback">
                            Please enter supplier email
                        </div>
                    </div>
                    <button type="submit" id="submitBtn" class="btn btn-primary mt-2 mb-2 btn-block">Submit</button>
                </form>
                </div>
            </div>
            </div>
        </div>
    <!-- Modal End-->

    <!-- Edit Modal Start -->
        <div class="modal fade login-modal" id="editSupplier" tabindex="-1" role="dialog" aria-labelledby="editSupplierLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">

                <div class="modal-header" id="editSupplierLabel">
                <h4 class="modal-title">Edit Supplier</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                </div>
                <div class="modal-body">
                <form class="mt-0 needs-validation" novalidate method="post" action="{{ route('supplierEdit') }}">
                    @csrf
                    <input type="hidden" class="form-control mb-2" id="id" name="id">
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="editName" placeholder="Supplier Name *" name="name" required>
                        <div class="invalid-feedback">
                            Please enter supplier name
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="editgst" placeholder="Supplier GST" name="gst">
                        <div class="invalid-feedback">
                            Please enter supplier gst
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="editaddress" placeholder="Supplier Address" name="address">
                        <div class="invalid-feedback">
                            Please enter supplier address
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="editphone" placeholder="Supplier Phone *" name="phone" required>
                        <div class="invalid-feedback">
                            Please enter supplier phone
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control mb-2" id="editemail" placeholder="Supplier Email *" name="email" required>
                        <div class="invalid-feedback">
                            Please enter supplier email
                        </div>
                    </div>
                    <button type="submit" id="editsubmitBtn" class="btn btn-primary mt-2 mb-2 btn-block">Submit</button>
                </form>
                </div>
            </div>
            </div>
        </div>
    <!-- Edit Modal End-->