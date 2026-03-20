<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directory Data Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h1 class="mb-4">Database Management Dashboard</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">1. Bulk Data Import</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
                @csrf
                <input type="file" name="file" class="form-control me-3" required accept=".csv, .xlsx">
                <button type="submit" class="btn btn-success">Import Data</button>
            </form>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
            <h5 class="mb-0">2. Duplicate Data Management</h5>
            <form action="{{ route('merge.duplicates') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-dark btn-sm">Merge All Duplicates</button>
            </form>
        </div>
        <div class="card-body">
            <h6>List of Duplicates (Based on Name + Area + City)</h6>
            @if($duplicateGroups->isEmpty())
                <p class="text-muted">No duplicates found.</p>
            @else
                <table class="table table-bordered table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>Business Name</th>
                            <th>Area</th>
                            <th>City</th>
                            <th>Occurrences</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($duplicateGroups as $duplicate)
                        <tr>
                            <td>{{ $duplicate->business_name }}</td>
                            <td>{{ $duplicate->area }}</td>
                            <td>{{ $duplicate->city }}</td>
                            <td><span class="badge bg-danger">{{ $duplicate->count }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">3. Data Report Overview</h5>
        </div>
        <div class="card-body">
            <div class="row text-center mb-4">
                <div class="col-md-3">
                    <div class="p-3 border rounded bg-white">
                        <h6>Total Listings</h6>
                        <h3>{{ $totalName }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 border rounded bg-white">
                        <h6>Unique Listings</h6>
                        <h3>{{ $uniqueListing }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 border rounded bg-white">
                        <h6>Duplicate Listings</h6>
                        <h3>{{ $duplicateListingCount }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 border rounded bg-white">
                        <h6>Incomplete Listings</h6>
                        <h3>{{ $incompleteListing }}</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <h6>City-Wise Data</h6>
                    <ul class="list-group list-group-flush border">
                        @foreach($cityWise as $data)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $data->city ?: 'Unknown' }}
                                <span class="badge bg-secondary rounded-pill">{{ $data->total }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-md-4">
                    <h6>Category + City-Wise Data</h6>
                    <ul class="list-group list-group-flush border overflow-auto" style="max-height: 300px;">
                        @foreach($categoryCityWise as $data)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $data->category ?: 'N/A' }} ({{ $data->city ?: 'Unknown' }})
                                <span class="badge bg-secondary rounded-pill">{{ $data->total }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-md-4">
                    <h6>Category + Area-Wise Data</h6>
                    <ul class="list-group list-group-flush border overflow-auto" style="max-height: 300px;">
                        @foreach($categoryAreaWise as $data)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $data->category ?: 'N/A' }} ({{ $data->area ?: 'Unknown' }})
                                <span class="badge bg-secondary rounded-pill">{{ $data->total }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>