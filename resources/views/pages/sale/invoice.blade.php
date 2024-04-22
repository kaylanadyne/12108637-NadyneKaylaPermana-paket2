<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Invoice - {{ now( )}}</title>
</head>
<style>
    table {
      width: 100%;
      border-collapse: collapse;
      border-spacing: 0;
      margin-bottom: 20px;
    }
    table .no,
    table .product {
      text-align: left;
    }
    
    table td {
      padding: 20px;
      text-align: center;
    }

    table td.no,
    table td.product {
      vertical-align: top;
    }
</style>
<body>
  <header>
    <h1>Toko</h1>
    <div class="info">
      <p>STAFF : {{ auth()->user()->name}}</p>
    </div>
    <div class="informations">
      <div><span>CLIENT :</span> {{ $name}}</div>
      <div><span>ADDRESS :</span> {{ $address}}</div>
      <div><span>PHONE :</span> {{ $phone}}</div>
      <div><span>DATE : </span> {{ now()->format('d-m-Y')}}</div>
    </div>
  </header>
  <br>
  <main>
    <table>
      <thead> 
        <tr>
          <th>NO</th>
          <th>DESCRIPTION</th>
          <th>PRICE</th>
          <th>QTY</th>
          <th>TOTAL</th>
        </tr>
      </thead>
      <tbody>
        @php
        $total_price = 0;
        @endphp
        @foreach($items as $item)
          @foreach ($products as $product)
            @if ($product["code"] == $item->code)
            <tr>
              <td class="no">{{ $loop->iteration }}</td>
              <td class="product">{{ $item->name }}</td>
              <td class="unit">{{ $item->price }}</td>
              <td class="qty">{{ $product["qty"] }}</td>
              <td class="total">{{ $item->price * $product["qty"] }}</td>
            </tr>
            @php
                $price = $product['qty'] * $item->price;
                $total_price += $price; // Accumulate the total price correctly
                @endphp
            @endif
          @endforeach
        @endforeach
        <tr>
          <td colspan="4" class="grand total">GRAND TOTAL</td>
          <td class="grand total"> Rp{{ number_format($total_price, 2, ',', '.') }}</td>
        </tr>
      </tbody>
    </table>
  </main>
  <footer>
      Terima kasih
  </footer>
  <script>
    window.onload = function() {
      window.print();
      setTimeout(function() {
        window.close();
      }, 3000);
    }

    window.onafterprint = function() {
      window.close();
    }

    window.onbeforeunload = function() {
      window.close();
    }
  </script>
</body>

</html>