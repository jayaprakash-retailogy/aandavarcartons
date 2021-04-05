<!-- Modal -->
<div class="modal fade login-modal" id="addemployee" tabindex="-1" role="dialog" aria-labelledby="addemployeeLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">

                <div class="modal-header" id="addemployeeLabel">
                <h4 class="modal-title">Add Employee</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                </div>
                <div class="modal-body">
                <form class="mt-0 needs-validation" novalidate method="post" action="{{ route('employee') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="name" placeholder="Employee Name *" name="name" required>
                        <div class="invalid-feedback">
                            Please enter Employee name
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="address" placeholder="Employee Address" name="address">
                        <div class="invalid-feedback">
                            Please enter Employee address
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="phone" placeholder="Employee Phone *" name="phone" required>
                        <div class="invalid-feedback">
                            Please enter Employee phone
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control mb-2" id="email" placeholder="Employee Email" name="email">
                        <div class="invalid-feedback">
                            Please enter Employee email
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="aadhar" placeholder="Employee Aadhar" name="aadhar">
                        <div class="invalid-feedback">
                            Please enter Employee aahdar
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="pan" placeholder="Employee Pan" name="pan">
                        <div class="invalid-feedback">
                            Please enter Employee pan
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="salary" placeholder="Employee Salary" name="salary">
                        <div class="invalid-feedback">
                            Please enter Employee salary
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
    <div class="modal fade login-modal" id="editemployee" tabindex="-1" role="dialog" aria-labelledby="editemployeeLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header" id="editemployeeLabel">
                <h4 class="modal-title">Edit Employee</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                </div>
                <div class="modal-body">
                <form class="mt-0 needs-validation" novalidate method="post" action="{{ route('employeeEdit') }}">
                    @csrf
                    <input type="hidden" class="form-control mb-2" id="id" name="id">
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="editname" placeholder="Employee Name *" name="name" required>
                        <div class="invalid-feedback">
                            Please enter Employee name
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="editaddress" placeholder="Employee Address" name="address">
                        <div class="invalid-feedback">
                            Please enter Employee address
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="editphone" placeholder="Employee Phone *" name="phone" required>
                        <div class="invalid-feedback">
                            Please enter Employee phone
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control mb-2" id="editemail" placeholder="Employee Email *" name="email">
                        <div class="invalid-feedback">
                            Please enter Employee email
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="editaadhar" placeholder="Employee Aadhar *" name="aadhar">
                        <div class="invalid-feedback">
                            Please enter Employee aadhar
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="editpan" placeholder="Employee Pan *" name="pan">
                        <div class="invalid-feedback">
                            Please enter Employee pan
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="editsalary" placeholder="Employee Pan *" name="salary">
                        <div class="invalid-feedback">
                            Please enter Employee salary
                        </div>
                    </div>
                    <button type="submit" id="editsubmitBtn" class="btn btn-primary mt-2 mb-2 btn-block">Submit</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal End-->