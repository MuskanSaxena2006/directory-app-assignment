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

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">1. Bulk Data Import</h5>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('import')); ?>" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
                <?php echo csrf_field(); ?>
                <input type="file" name="file" class="form-control me-3" required accept=".csv, .xlsx">
                <button type="submit" class="btn btn-success">Import Data</button>
            </form>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
            <h5 class="mb-0">2. Duplicate Data Management</h5>
            <form action="<?php echo e(route('merge.duplicates')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-dark btn-sm">Merge All Duplicates</button>
            </form>
        </div>
        <div class="card-body">
            <h6>List of Duplicates (Based on Name + Area + City)</h6>
            <?php if($duplicateGroups->isEmpty()): ?>
                <p class="text-muted">No duplicates found.</p>
            <?php else: ?>
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
                        <?php $__currentLoopData = $duplicateGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $duplicate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($duplicate->business_name); ?></td>
                            <td><?php echo e($duplicate->area); ?></td>
                            <td><?php echo e($duplicate->city); ?></td>
                            <td><span class="badge bg-danger"><?php echo e($duplicate->count); ?></span></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
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
                        <h3><?php echo e($totalName); ?></h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 border rounded bg-white">
                        <h6>Unique Listings</h6>
                        <h3><?php echo e($uniqueListing); ?></h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 border rounded bg-white">
                        <h6>Duplicate Listings</h6>
                        <h3><?php echo e($duplicateListingCount); ?></h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 border rounded bg-white">
                        <h6>Incomplete Listings</h6>
                        <h3><?php echo e($incompleteListing); ?></h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <h6>City-Wise Data</h6>
                    <ul class="list-group list-group-flush border">
                        <?php $__currentLoopData = $cityWise; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo e($data->city ?: 'Unknown'); ?>

                                <span class="badge bg-secondary rounded-pill"><?php echo e($data->total); ?></span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>

                <div class="col-md-4">
                    <h6>Category + City-Wise Data</h6>
                    <ul class="list-group list-group-flush border overflow-auto" style="max-height: 300px;">
                        <?php $__currentLoopData = $categoryCityWise; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo e($data->category ?: 'N/A'); ?> (<?php echo e($data->city ?: 'Unknown'); ?>)
                                <span class="badge bg-secondary rounded-pill"><?php echo e($data->total); ?></span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>

                <div class="col-md-4">
                    <h6>Category + Area-Wise Data</h6>
                    <ul class="list-group list-group-flush border overflow-auto" style="max-height: 300px;">
                        <?php $__currentLoopData = $categoryAreaWise; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo e($data->category ?: 'N/A'); ?> (<?php echo e($data->area ?: 'Unknown'); ?>)
                                <span class="badge bg-secondary rounded-pill"><?php echo e($data->total); ?></span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH /Users/gauravsaxena/Desktop/directory-app/resources/views/dashboard.blade.php ENDPATH**/ ?>