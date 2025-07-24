<!DOCTYPE html>
<html>
<head>
    <title>Invoice - {{ $order->order_id }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial, sans-serif; }
        .invoice-container { display: flex; gap: 1.5rem; max-width: 1000px; margin: 0 auto; padding: 1.25rem; }
        .invoice-left { flex: 0 0 65%; border: 1px solid #e0e0e0; border-radius: 8px; padding: 1.25rem; background: #fff; }
        .invoice-right { flex: 0 0 30%; display: flex; flex-direction: column; gap: 1rem; }
        .card-header-plain { background-color: #f8f9fa; font-weight: 600; }
        .invoice-table th, .invoice-table td { border: 1px solid #dee2e6; padding: 0.75rem; }
        .invoice-table th { background-color: #f1f1f1; font-weight: 600; }
        .summary-row { display: flex; justify-content: space-between; margin-bottom: 0.5rem; }
        .badge { padding: 0.35em 0.65em; border-radius: 0.25rem; }
        .bg-secondary { background-color: #6c757d; }
        .bg-primary { background-color: #0d6efd; }
        .bg-info { background-color: #0dcaf0; }
        .bg-success { background-color: #198754; }
        .bg-danger { background-color: #dc3545; }
        .bg-warning { background-color: #ffc107; }
        .text-muted { color: #6c757d; }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

@php
    // Process item details
    $items = json_decode($order->item_details, true);
    
    // Prepare items with names
    $processedItems = [];
    
    if (isset($items['diamond'])) {
        foreach ($items['diamond'] as $diamond) {
            $id = $diamond['id'] ?? null;
            $processedItems[] = [
                'id' => $id,
                'name' => $diamondNames[$id] ?? 'Diamond',
                'type' => 'diamond',
                'quantity' => $diamond['quantity'] ?? 1,
                'price' => $diamond['price'] ?? 0,
                'certificate_number' => $diamond['certificate_number'] ?? null,
            ];
        }
    }
    
    if (isset($items['jewelry'])) {
        foreach ($items['jewelry'] as $jewelry) {
            $id = $jewelry['id'] ?? null;
            $processedItems[] = [
                'id' => $id,
                'name' => $jewelryNames[$id] ?? 'Jewelry',
                'type' => 'jewelry',
                'quantity' => $jewelry['quantity'] ?? 1,
                'price' => $jewelry['price'] ?? 0,
                'metal_type' => $jewelry['metal_type'] ?? null,
                'metal_color' => $jewelry['metal_color'] ?? null,
                'metal_purity' => $jewelry['metal_purity'] ?? null,
                'size' => $jewelry['size'] ?? null,
            ];
        }
    }
    
    // Separate items by type
    $diamondItems = array_filter($processedItems, fn($item) => $item['type'] === 'diamond');
    $jewelryItems = array_filter($processedItems, fn($item) => $item['type'] === 'jewelry');
@endphp

  
  <div class="invoice-container">
    <div class="invoice-left">
      <div class="mb-4 text-center">
        <h2 class="fw-bold">INVOICE</h2>
        <p><strong>Order ID:</strong> {{ $order->order_id }}</p>
        <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
      </div>

      <div class="mb-4">
        <h5 class="fw-semibold">Customer Information</h5>
        <p><strong>Name:</strong> {{ $order->user_name }}</p>
        <p><strong>Email:</strong> {{ $order->user->email ?? ($order->address['email'] ?? '') }}</p>
        <p><strong>Contact:</strong> {{ $order->contact_number }}</p>
        <p><strong>Address:</strong> {{ $order->formatted_address }}</p>
      </div>

      @if(count($diamondItems) > 0)
        <div class="mb-4">
            <h5 class="fw-semibold text-primary">💎 Diamond Details</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price (₹)</th>
                            <th>Certificate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($diamondItems as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>₹{{ number_format($item['price'], 2) }}</td>
                            <td>{{ $item['certificate_number'] ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        @if(count($jewelryItems) > 0)
        <div class="mb-4">
            <h5 class="fw-semibold text-warning">💍 Jewelry Details</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-warning">
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price (₹)</th>
                            <th>Metal</th>
                            <th>Size</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jewelryItems as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>₹{{ number_format($item['price'], 2) }}</td>
                            <td>
                                @if($item['metal_type'])
                                    {{ $item['metal_type'] }} 
                                    ({{ $item['metal_color'] }}, {{ $item['metal_purity'] }})
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $item['size'] ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <h5 class="fw-semibold">Order Summary</h5>
        <table class="invoice-table" style="width:100%; margin-bottom:1rem;">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Type</th>
                    <th class="text-center">Qty</th>
                    <th class="text-end">Price</th>
                    <th class="text-end">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($processedItems as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ ucfirst($item['type']) }}</td>
                    <td class="text-center">{{ $item['quantity'] }}</td>
                    <td class="text-end">₹{{ number_format($item['price'], 2) }}</td>
                    <td class="text-end">
                        ₹{{ number_format($item['price'] * $item['quantity'], 2) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

      <div class="mb-4">
        <div class="summary-row">
          <span>Subtotal:</span>
          <span>₹{{ number_format($order->total_price, 2) }}</span>
        </div>
        <div class="summary-row">
          <span>Shipping:</span>
          <span>₹{{ number_format($order->shipping_cost, 2) }}</span>
        </div>
        <div class="summary-row">
          <span>Discount:</span>
          <span class="text-danger">-₹{{ number_format($order->discount, 2) }}</span>
        </div>
        <div class="summary-row fw-semibold border-top pt-2">
          <span>Grand Total:</span>
          <span>₹{{ number_format($order->total_price + $order->shipping_cost - $order->discount, 2) }}</span>
        </div>
      </div>
    </div>

    <div class="invoice-right">
      <div class="card">
        <div class="card-header card-header-plain">Order Status</div>
        <div class="card-body">
          <select id="statusSelect" class="form-select mb-2" {{ in_array($order->order_status, ['cancelled', 'returned']) ? 'disabled' : '' }}>
            <option value="" disabled selected>Select status</option>
            <option value="confirmed" {{ $order->order_status === 'pending' ? '' : 'disabled' }}>Confirmed</option>
            <option value="shipped" {{ $order->order_status === 'confirmed' ? '' : 'disabled' }}>Shipped</option>
            <option value="delivered" {{ $order->order_status === 'shipped' ? '' : 'disabled' }}>Delivered</option>
            <option value="returned" {{ $order->order_status === 'delivered' ? '' : 'disabled' }}>Returned</option>
            <option value="cancelled">Cancel</option>
          </select>
          
          <div class="mb-2">
            <strong>Current:</strong>
            <span class="badge bg-{{ 
                $order->order_status === 'pending' ? 'secondary' : 
                ($order->order_status === 'confirmed' ? 'primary' : 
                ($order->order_status === 'shipped' ? 'info' : 
                ($order->order_status === 'delivered' ? 'success' : 
                ($order->order_status === 'returned' ? 'warning' : 'danger'))))
            }}">
              {{ $order->status_label }}
            </span>
          </div>
          
          <button id="updateStatusBtn" class="btn btn-primary" {{ in_array($order->order_status, ['cancelled', 'returned']) ? 'disabled' : '' }}>
            Update Status
          </button>
          <div id="statusMessage" class="mt-2" style="display: none;"></div>
        </div>
      </div>

      <div class="card">
        <div class="card-header card-header-plain">Invoice Actions</div>
        <div class="card-body">
          <select id="actionSelect" class="form-select mb-2">
            <option selected disabled>Select Action</option>
            <option value="download">Download Invoice</option>
            <option value="send_user">Send to Customer</option>
            <option value="send_admin">Send to Admin</option>
          </select>
          <button id="performActionBtn" class="btn btn-success">
            Execute
          </button>
          <div id="actionMessage" class="mt-2" style="display: none;"></div>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(function(){
      const orderId = {{ $order->id }};
      const currentStatus = "{{ $order->order_status }}";
      const downloadUrl  = '{{ route("orders.invoice.download", $order->id) }}';
      const sendUrlBase  = '{{ route("orders.invoice.send", $order->id) }}';
      const statusUrl    = '{{ route("orders.changeStatus", $order->id) }}';

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          'Accept': 'application/json'
        }
      });

      function showMessage(elementId, message, type) {
        const element = $('#' + elementId);
        element.removeClass().addClass(type === 'success' ? 'alert-success' : 'alert-danger')
               .text(message).show().delay(3000).fadeOut();
      }

      $('#updateStatusBtn').on('click', function(){
          const newStatus = $('#statusSelect').val();
          const btn = $(this);
          
          btn.prop('disabled', true).html('Updating...');
          
          $.ajax({
              url: statusUrl,
              method: 'PATCH',
              data: { 
                  order_status: newStatus,
                  _token: "{{ csrf_token() }}"
              },
              success: function() {
                  showMessage('statusMessage', 'Status updated!', 'success');
                  setTimeout(() => location.reload(), 1500);
              },
              error: function(xhr) {
                  btn.prop('disabled', false).text('Update Status');
                  showMessage('statusMessage', xhr.responseJSON?.message || 'Error updating status', 'danger');
              }
          });
      });

      $('#performActionBtn').on('click', function(){
        const action = $('#actionSelect').val();
        const btn = $(this);
        
        if (!action) {
          showMessage('actionMessage', 'Select an action first', 'danger');
          return;
        }
        
        btn.prop('disabled', true).html('Processing...');
        
        if (action === 'download') {
          window.open(downloadUrl, '_blank');
          showMessage('actionMessage', 'Download started!', 'success');
          btn.prop('disabled', false).text('Execute');
        }
        else {
          const to = action === 'send_user' ? 'user' : 'admin';
          
          $.get(sendUrlBase + '?to=' + to, function(res) {
            showMessage('actionMessage', res.message || 'Invoice sent!', 'success');
            btn.prop('disabled', false).text('Execute');
          }).fail(function(xhr) {
            showMessage('actionMessage', xhr.responseJSON?.message || 'Sending failed', 'danger');
            btn.prop('disabled', false).text('Execute');
          });
        }
      });
    });
  </script>
</body>
</html>