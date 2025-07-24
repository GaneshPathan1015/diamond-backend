@extends('admin.layouts.master')

@section('main_section')
<div class="container-xxl flex-grow-1 container-p-y">
  <div id="messageContainer" class="position-fixed top-20 end-20 z-9999" style="display:none;">
    <div class="alert alert-dismissible fade show" role="alert">
      <span id="messageText"></span>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  </div>
  
  <div class="card mb-4">
    <div class="card-header d-flex justify-content-between">
      <h4>Diamond & Jewelry Orders</h4>
    </div>
    <div class="card-body table-responsive">
      <table class="table table-hover" id="orderTable">
        <thead class="bg-light">
          <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Type</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="orderTableBody"></tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="invoiceModal" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Order Invoice</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="invoiceContent"></div>
    </div>
  </div>
</div>

<script>
$(function() {
    // Initialize DataTable with server-side processing
    const dataTable = $('#orderTable').DataTable({
        order: [[5, 'desc']],
        pageLength: 10,
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('orders.fetch') }}",
            type: 'GET'
        },
        columns: [
            { data: 'order_id', name: 'order_id' },
            { data: 'user_name', name: 'user_name' },
            { 
                data: 'product_type', 
                name: 'product_type',
                render: function(data) {
                    return data; // Already formatted like "Diamond, Jewelry"
                }
            },
            { 
                data: 'total_price', 
                name: 'total_price',
                render: function(data) {
                    return '₹' + parseFloat(data).toFixed(2);
                }
            },
            {
                data: 'order_status', 
                name: 'order_status',
                render: function(data) {
                    const statusClass = {
                        pending: 'secondary',
                        confirmed: 'primary',
                        shipped: 'info',
                        delivered: 'success',
                        cancelled: 'danger',
                        returned: 'warning'
                    }[data] || 'secondary';
                    
                    // First letter uppercase
                    const label = data.charAt(0).toUpperCase() + data.slice(1);

                    return `<span class="badge bg-${statusClass}">${label}</span>`;
                }
            },
            { 
                data: 'created_at', 
                name: 'created_at',
                render: function(data) {
                    return new Date(data).toLocaleDateString();
                }
            },
            {
                data: 'id',
                name: 'actions',
                orderable: false,
                searchable: false,
                render: function(data) {
                    return `
                        <button class="btn btn-sm btn-primary preview-invoice" data-id="${data}">
                            <i class="fas fa-eye"></i> View
                        </button>
                    `;
                }
            }
        ]
    });

    $('#orderTable').on('click', '.preview-invoice', function() {
        const id = $(this).data('id');
        $.get(`{{ url('admin/orders') }}/${id}`, function(html) {
            $('#invoiceContent').html(html);
            
            // Initialize Bootstrap modal properly
            const invoiceModal = new bootstrap.Modal(document.getElementById('invoiceModal'));
            invoiceModal.show();
        });
    });
});
</script>
@endsection