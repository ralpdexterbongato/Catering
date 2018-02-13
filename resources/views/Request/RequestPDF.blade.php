<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PRINT PDF</title>
  </head>
  <body>
    <style media="all">
      body
      {
        font-family:sans-serif;
      }
      .table-container table
      {
        font-size: 14px;
        border:1px solid black;
        width: 100%;
        border-collapse: collapse;
      	border-spacing: 0;
      }
      .table-container table td,.product-table-container table td
      {
        padding:5px;
        border:1px solid black;
      }
      .table-container table th,.product-table-container table th
      {
        padding:5px;
        border:1px solid black;
      }
      .product-table-container table
      {
        font-size: 14px;
        border:1px solid black;
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
      	border-spacing: 0;
      }
      .product-table-container
      {
        margin-bottom: 20px;
      }
      .underlined
      {
        text-decoration: underline;
      }
      .domain
      {
        float: right;
      }
      .color-samples
      {
        display: inline-block;
        padding:5px;
        border-radius: 3px;
        font-size: 12px;
        margin-top: 5px;
      }
    </style>
    <p class="domain">www.cateringservices.com</p>
    <h4>{{$data[0]->company->name}}</h4>
    <div class="table-container">
      <p>The information below was the request sent by <span class="underlined">{{$data[0]->user->name}}</span></p>
      <table>
        <tr>
          <th>Event</th>
          <td>{{$data[0]->title}}</td>
        </tr>
        <tr>
          <th>Date</th>
          <td>{{$data[0]->date}}</td>
        </tr>
        <tr>
          <th>Time</th>
          <td>{{$data[0]->time_start}}</td>
        </tr>
        <tr>
          <th>Expected<br> visitors</th>
          <td>{{$data[0]->expectedVisitors}}</td>
        </tr>
        <tr>
          <th>Type</th>
          @if ($data[0]->dine_in == 0)
          <td>DINE-IN</td>
          @else
          <td>DINE-OUT</td>
          @endif
        </tr>
        <tr>
          <th>Contact</th>
          <td>{{$data[0]->client_contact}}</td>
        </tr>
        <tr>
          <th>Message</th>
          <td>{{$data[0]->message}}</td>
        </tr>
        <tr>
          <th>Theme color</th>
          <td>
            @foreach ($data[0]->colors as $key => $color)
              <div class="color-samples" style="background-color:{{$color->hex}}">
                color
              </div>
            @endforeach
          </td>
        </tr>
        @if (isset($packageData[0]))
        <tr>
          <th>Package</th>
          <td>{{$packageData[0]->name}}</td>
        </tr>
        <tr>
          <th>Package description</th>
          <td>{{$packageData[0]->description}}</td>
        </tr>
        @endif
        <tr>
          <th>Products</th>
          <th>Prices</th>
        </tr>
        @if (isset($packageData[0]))
          @foreach ($packageData[0]->products as $key => $product)
            <tr>
              <td>{{$product->name}}</td>
              <td>pkg</td>
            </tr>
          @endforeach
        @else
          @foreach ($data[0]->products as $key => $product)
          <tr>
            <td>{{$product->name}}</td>
            @if ($data[0]->company->show_prices==0)
              <td>P{{$product->pivot->current_price}}</td>
            @else
              <td>private</td>
            @endif
          </tr>
          @endforeach
        @endif
        <tr>
          @if (isset($data[0]->package_id))
            <td></td>
            <td>per-head : P {{number_format($data[0]->package_current_price,'2','.',',')}}</td>
          @else
            <td></td>
            <td>per-head : P {{number_format($total,'2','.',',')}}</td>
          @endif
        </tr>
      </table>
    </div>
  </body>
</html>
