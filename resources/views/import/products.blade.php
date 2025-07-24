<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ज्वेलरी प्रोडक्ट्स इम्पोर्ट</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <style>
        .card { border-radius: 15px; }
        table th { background-color: #0d6efd; color: white; }
        .alert-success { background-color: #d1e7dd; border-color: #badbcc; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h3 class="text-center"><i class="bi bi-upload me-2"></i> एक्सेल से ज्वेलरी प्रोडक्ट्स इम्पोर्ट करें</h3>
            </div>
            <div class="card-body">
                @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
        
        @if(session('stats'))
            <div class="mt-3">
                <strong>Import Statistics:</strong>
                <ul>
                    <li>Imported: {{ session('stats')['imported'] }}</li>
                    <li>Failed: {{ session('stats')['failed'] }}</li>
                </ul>
            </div>
        @endif
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
                <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="file" class="form-label">
                            <i class="bi bi-file-earmark-spreadsheet me-2"></i> एक्सेल फाइल चुनें (.xlsx, .xls)
                        </label>
                        <input class="form-control form-control-lg" type="file" name="file" required>
                        <div class="form-text">फाइल साइज 10MB से कम होनी चाहिए</div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-upload me-2"></i> इम्पोर्ट करें
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-5 card shadow">
            <div class="card-header bg-info text-white">
                <h5><i class="bi bi-info-circle me-2"></i> एक्सेल फॉर्मेट नमूना</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>products_id</th>
                                <th>products_name</th>
                                <th>products_sku</th>
                                <th>image_path</th>
                                <th>variation_sku</th>
                                <th>variation_price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>सोने की अंगूठी</td>
                                <td>GOLD-RING-01</td>
                                <td>ring.jpg</td>
                                <td>VAR-RING-01</td>
                                <td>18500</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>हीरे की नई बाली</td>
                                <td>DIAMOND-EAR-01</td>
                                <td>earring.jpg</td>
                                <td>VAR-EAR-01</td>
                                <td>28500</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="alert alert-warning mt-4">
                    <h5><i class="bi bi-exclamation-triangle me-2"></i> महत्वपूर्ण निर्देश:</h5>
                    <ul>
                        <li>पहली रो में हेडर अवश्य रखें</li>
                        <li>नए प्रोडक्ट के लिए <code>products_id</code> खाली छोड़ें</li>
                        <li>इमेज और वेरिएशन के फ़ील्ड्स में प्रीफ़िक्स का उपयोग करें:
                            <ul>
                                <li>इमेज: <code>image_</code> (image_path, image_is_featured)</li>
                                <li>वेरिएशन: <code>variation_</code> (variation_sku, variation_price)</li>
                            </ul>
                        </li>
                        <li>डेट टाइम फॉर्मेट: <code>YYYY-MM-DD HH:MM:SS</code></li>
                        <li>वेरिएशन इमेजेस को कॉमा सेपरेटेड डालें: <code>img1.jpg,img2.jpg</code></li>
                    </ul>
                </div>
                
                <div class="text-center mt-3">
                    <a href="/sample/combined-products-import.xlsx" class="btn btn-primary">
                        <i class="bi bi-download me-2"></i> नमूना एक्सेल फाइल डाउनलोड करें
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>