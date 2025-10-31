@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Debug Booking Form</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('bookings.store') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="branch" class="form-label">Branch *</label>
                            <select class="form-control" id="branch" name="branch" required>
                                <option value="">Select Branch</option>
                                <option value="KHI">Karachi (KHI)</option>
                                <option value="LHR">Lahore (LHR)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="cn_date" class="form-label">C/N Date *</label>
                            <input type="date" class="form-control" id="cn_date" name="cn_date" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="financial_instrument" class="form-label">Financial Instrument *</label>
                            <select class="form-control" id="financial_instrument" name="financial_instrument" required>
                                <option value="">Select</option>
                                <option value="Y">Yes</option>
                                <option value="N">No</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="service" class="form-label">Service *</label>
                            <select class="form-control" id="service" name="service" required>
                                <option value="">Select Service</option>
                                <option value="express">Express</option>
                                <option value="standard">Standard</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="shipper_name" class="form-label">Shipper Name *</label>
                            <input type="text" class="form-control" id="shipper_name" name="shipper_name" value="Test Shipper" required>
                        </div>

                        <div class="mb-3">
                            <label for="shipper_city" class="form-label">Shipper City *</label>
                            <input type="text" class="form-control" id="shipper_city" name="shipper_city" value="Karachi" required>
                        </div>

                        <div class="mb-3">
                            <label for="shipper_country" class="form-label">Shipper Country *</label>
                            <select class="form-control" id="shipper_country" name="shipper_country" required>
                                <option value="">Select Country</option>
                                <option value="PK" selected>Pakistan</option>
                                <option value="US">United States</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="shipper_state" class="form-label">Shipper State *</label>
                            <input type="text" class="form-control" id="shipper_state" name="shipper_state" value="Sindh" required>
                        </div>

                        <div class="mb-3">
                            <label for="shipper_cnic" class="form-label">Shipper CNIC *</label>
                            <input type="text" class="form-control" id="shipper_cnic" name="shipper_cnic" value="12345-1234567-1" required>
                        </div>

                        <div class="mb-3">
                            <label for="consignee_name" class="form-label">Consignee Name *</label>
                            <input type="text" class="form-control" id="consignee_name" name="consignee_name" value="Test Consignee" required>
                        </div>

                        <div class="mb-3">
                            <label for="consignee_city" class="form-label">Consignee City *</label>
                            <input type="text" class="form-control" id="consignee_city" name="consignee_city" value="Lahore" required>
                        </div>

                        <div class="mb-3">
                            <label for="consignee_country" class="form-label">Consignee Country *</label>
                            <select class="form-control" id="consignee_country" name="consignee_country" required>
                                <option value="">Select Country</option>
                                <option value="PK" selected>Pakistan</option>
                                <option value="US">United States</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="consignee_phone" class="form-label">Consignee Phone *</label>
                            <input type="text" class="form-control" id="consignee_phone" name="consignee_phone" value="+92-300-1234567" required>
                        </div>

                        <div class="mb-3">
                            <label for="consignee_email" class="form-label">Consignee Email *</label>
                            <input type="email" class="form-control" id="consignee_email" name="consignee_email" value="consignee@test.com" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit Test Booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



