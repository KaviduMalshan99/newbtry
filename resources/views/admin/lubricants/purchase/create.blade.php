@extends('layouts.simple.master')
@section('title', 'Add Lubricant Purchase')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Add Lubricant Purchase</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('lubricant_purchases.store') }}" method="POST">
                @csrf

                <div class="row">
                    
                    <div class="col-sm-6">
                        <div class="form-group my-2">
                            <label for="lubricant_id" class="py-3">Lubricant</label>
                            <select name="lubricant_id" class="form-control" required>
                                @foreach($lubricants as $lubricant)
                                    <option value="{{ $lubricant->id }}">{{ $lubricant->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group my-2">
                            <label for="supplier_id" class="py-3">Supplier</label>
                            <select name="supplier_id" class="form-control" required>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
               


                <div class="row">
                    
                    <div class="col-sm-6">
                        <div class="form-group my-2">
                            <label for="purchase_date" class="py-3">Purchase Date</label>
                            <input type="date" name="purchase_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        

                        <div class="form-group my-2">
                            <label for="unit_type" class="py-3">Unit Type</label>
                            <select name="unit_type" class="form-control" required>
                                <option value="Drum">Drum</option>
                                <option value="Bottle">Bottle</option>
                                <option value="Liter">Liter</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="row">

                    <div class="col-sm-6">
                        {{-- <div class="form-group my-2">
                            <label for="total_cost"  class="py-3">Total Cost</label>
                            <input type="text" name="total_cost" class="form-control" required>
                        </div> --}}

                        <div class="form-group my-2">
                            <label for="quantity_purchased" class="py-3"> Purchased Price</label>
                            <input type="text" name="purchase_price" class="form-control" placeholder="Enter One quantity purchased price" required>
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="form-group my-2">
                            <label for="quantity_purchased" class="py-3">Quantity Purchased</label>
                            <input type="text" name="quantity_purchased" placeholder="Enter quantity " class="form-control" required>
                        </div>
                    </div>
                   
                </div>
                


                <div class="row">
                    
                    <div class="col-sm-6">
                        <div class="form-group my-2">
                            <label for="quantity_purchased" class="py-3"> sale Price</label>
                            <input type="text" name="sale_price" class="form-control" placeholder=" Enter sale price" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group my-2">
                            <label for="total_cost"  class="py-3">Total Cost</label>
                            <input type="text" name="total_cost" class="form-control" placeholder=" Enter Total Cost" required>
                        </div>
                    </div>
                </div>
                
                
                
                <div class="row">
                    
                    <div class="col-sm-6">
                        <div class="form-group my-2">
                            <label for="payment_status" class="py-3">Payment Status</label>
                            <select name="payment_status" class="form-control" required>
                                <option value="full payment">Full Payment</option>
                                <option value="half payment">Half Payment</option>
                                <option value="online payment">Online Payment</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group my-2">
                            <label for="status" class="py-3">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="Pending">Pending </option>
                                <option value="Completed">Completed </option>
                                <option value="Processing">Processing </option>
                                <option value="Cancelled">Cancelled </option>
                                <option value="On Hold">On Hold </option>
                            </select>
                        </div>
                        
                    </div>
                </div>
                
               
               
                
                <button type="submit" class="btn btn-primary mt-3">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection
