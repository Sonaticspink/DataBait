@extends('layouts.maets')

@section('title', 'Checkout - MAETS')

@section('content')
<style>
    /* Profile Header */
    .profile-header {
        background: linear-gradient(90deg, #2e2e2e, #1c1c1c);
        padding: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        margin-top: 40px;
        box-shadow: 0 0 10px rgba(0,0,0,0.5);
    }
    .profile-header img {
        width: 120px;
        height: 120px;
        border-radius: 5px;
        margin-right: 30px;
        border: 2px solid #555;
    }
    .profile-header h2 {
        color: #fff;
        margin-bottom: 5px;
    }
    .profile-header p {
        color: #bbb;
        margin: 0;
    }

    /* Details Section */
    .profile-details {
        margin-top: 40px;
    }
    .detail-card {
        background: rgba(30, 30, 30, 0.85);
        border: 1px solid #555;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .detail-card h4 {
        color: #979797ff;
        margin-bottom: 10px;
    }
    .detail-card p {
        color: #ccc;
    }
</style>

<div class="">
        <h2>Payment Method</h2>
        <form>
            @csrf
            <div class="mb-3">
                <label>Card Type</label>
                <input type="radio" id="visa" name="cardType" required>
                <label for="visa">Visa</label>
            </div>
            <div class="mb-3">
                <label>Card Number</label>
                <input type="number" name="cardNum" required>
            </div> 
            <div class="mb-3">
                <label>Expiration Date</label>
                <input type="month" name="expDate" required>
            </div> 
            <div class="mb-3">
                <label>Security Code</label>
                <input type="number" name="secuCode" required>
            </div>
        </form>
        <h2>Billing Information</h2>
        <form>
            @csrf
            <div class="mb-3">
                <label>First Name</label>
                <input type="text" name="fname" required>
            </div> 
            <div class="mb-3">
                <label>Last Name</label>
                <input type="text" name="lname" required>
            </div> 
            <div class="mb-3">
                <label>Billing Address</label>
                <input type="text" name="billAddr" required>
            </div> 
            <div class="mb-3">
                <label>Zip or Postal Code</label>
                <input type="number" name="zip" required>
            </div> 
            <div class="mb-3">
                <label>Country</label>
                <input type="text" name="country" required>
            </div> 
            <div class="mb-3">
                <label>Phone Number</label>
                <input type="number" name="phone" required>
            </div>
        </form>

        <div class="confirm">
        <form method="POST" action="{{ route('checkout.confirm') }}">
            @csrf
            <button type="submit" class="btn-checkout">
                Purchase
            </button>
        </form>
        </div>

    </div>

@endsection