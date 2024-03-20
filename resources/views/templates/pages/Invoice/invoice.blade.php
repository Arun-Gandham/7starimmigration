<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Invoice</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
  }
  .invoice {
    max-width: 800px;
    margin: 0 auto;
    background: #fff;
    border-radius: 8px;
    padding: 30px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
  }
  .invoice h1 {
    text-align: center;
    color: #333;
  }
  .invoice .details {
    margin-top: 10px;
    border-top: 2px solid #ccc;
    padding-top: 20px;
  }
  .invoice .details p {
    margin: 10px 0;
  }
  .invoice .items {
    margin-top: 30px;
  }
  .invoice .items table {
    width: 100%;
    border-collapse: collapse;
  }
  .invoice .items th, .invoice .items td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
  }
  .invoice .items th {
    background: #f4f4f4;
  }
  .logo {
    text-align: center;
    /* margin-bottom: 20px; */
  }

  .invoice-number h1 
  {
    margin: 0;
  }
  .invoice-number
  {
    float: right;
    margin-top: 50px;
  }
  td{
    text-align: center;
  }
</style>
</head>
<body>
<div class="invoice">
  <div class="header">
    <div class="logo">
        <img src="{{ public_path('assets/img/illustrations/LOGO.png') }}" alt="Company Logo" width="150">
    </div>
    <div class="invoice-number">
        <div>
          <p>{{ $invoice_date }}</p>
        <h1>Invoice</h1>
        <strong>#12312</strong>
        
        </div>
    </div>
  </div>
  <div class="details">
    <div class="details-inner">
    <div class="from-details">
        <p><strong>Name:</strong> {{ $name }}</p>
        <p><strong>Phone:</strong> {{ $phone }}</p>
        <p><strong>Country:</strong> {{ $country }}</p>
        <p><strong>Enquiry Date:</strong> {{ $date }}</p>
        <p><strong>Total Amount:</strong> {{ $amount }}</p>
        <p><strong>Pending Amount:</strong> {{ $pen_amount }}</p>
    </div>
    </div>
  </div>
  <div class="items">
    <table>
      <thead>
        <tr>
            <th>S.No</th>
          <th>Date</th>
          <th>Note</th>
          <th>Amount</th>
        </tr>
      </thead>
      <tbody>
        @php
        $count = 1;
        @endphp
        @foreach($histories as $history)
            <tr>
                <td>{{ $count }}</td>
                <td>
                    @php
                                $dateString = $history->created_at;
                                $date = new DateTime($dateString);
                                echo $date->format('jS F Y');
                            @endphp</td>
                <td>{{ $history->note ?? "-" }}</td>
                <td>{{ $history->amount }}</td>
            </tr>
        @endforeach
        <tr>
            <th colspan="3">Total</th>
            <td>{{ $paid_amount }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>
