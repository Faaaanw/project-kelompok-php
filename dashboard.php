<?php
session_start();
include_once("includes/header.php");

// Simulasi data transaksi dan film
$dummy_data_transactions = [
    ['payment_status' => 'pending', 'count' => 10],
    ['payment_status' => 'paid', 'count' => 30],
    ['payment_status' => 'failed', 'count' => 5],
];

// Simulasi data film yang ditonton
$dummy_data_movies = [
    ['title' => 'Movie A', 'movie_count' => 12],
    ['title' => 'Movie B', 'movie_count' => 18],
    ['title' => 'Movie C', 'movie_count' => 9],
    ['title' => 'Movie D', 'movie_count' => 15],
];

// Simulasi data transaksi
$dummy_data_recent_transactions = [
    ['movie_title' => 'Movie A', 'theater_name' => 'Theater 1', 'quantity' => 2, 'price' => 20.00, 'payment_status' => 'paid', 'transaction_date' => '2024-12-01 10:00:00'],
    ['movie_title' => 'Movie B', 'theater_name' => 'Theater 2', 'quantity' => 3, 'price' => 30.00, 'payment_status' => 'pending', 'transaction_date' => '2024-12-02 12:00:00'],
    ['movie_title' => 'Movie C', 'theater_name' => 'Theater 3', 'quantity' => 1, 'price' => 15.00, 'payment_status' => 'failed', 'transaction_date' => '2024-12-03 14:00:00'],
    ['movie_title' => 'Movie D', 'theater_name' => 'Theater 4', 'quantity' => 4, 'price' => 40.00, 'payment_status' => 'paid', 'transaction_date' => '2024-12-04 16:00:00'],
    ['movie_title' => 'Movie A', 'theater_name' => 'Theater 1', 'quantity' => 2, 'price' => 20.00, 'payment_status' => 'paid', 'transaction_date' => '2024-12-05 18:00:00'],
];

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    <!-- Dashboard Stats Cards -->
    <div class="row">
        <!-- Total Transactions -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Transactions</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($dummy_data_recent_transactions) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-film fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add more cards here if necessary -->
    </div>

    <!-- Chart Section -->
    <div class="row">
        <!-- Transactions by Payment Status Chart -->
        <div class="col-xl-6 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Transactions by Payment Status</h6>
                </div>
                <div class="card-body">
                    <canvas id="paymentStatusChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Movie Count Chart -->
        <div class="col-xl-6 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Movies Watched</h6>
                </div>
                <div class="card-body">
                    <canvas id="movieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Transactions</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Movie Title</th>
                                <th>Theater</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Payment Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($dummy_data_recent_transactions as $transaction):
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($transaction['movie_title']) ?></td>
                                <td><?= htmlspecialchars($transaction['theater_name']) ?></td>
                                <td><?= htmlspecialchars($transaction['quantity']) ?></td>
                                <td><?= number_format($transaction['price'], 2) ?></td>
                                <td><?= ucfirst(htmlspecialchars($transaction['payment_status'])) ?></td>
                                <td><?= htmlspecialchars($transaction['transaction_date']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php include_once("includes/footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart for Payment Status
    var ctx1 = document.getElementById('paymentStatusChart').getContext('2d');
    var paymentStatusChart = new Chart(ctx1, {
        type: 'pie',
        data: {
            labels: ['Pending', 'Paid', 'Failed'],
            datasets: [{
                label: 'Payment Status',
                data: [<?= $dummy_data_transactions[0]['count'] ?>, <?= $dummy_data_transactions[1]['count'] ?>, <?= $dummy_data_transactions[2]['count'] ?>],
                backgroundColor: ['#f39c12', '#28a745', '#dc3545'],
                borderColor: ['#f39c12', '#28a745', '#dc3545'],
                borderWidth: 1
            }]
        }
    });

    // Chart for Movies Watched
    var ctx2 = document.getElementById('movieChart').getContext('2d');
    var movieChart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: [<?= implode(',', array_map(function($item) { return "'{$item['title']}'"; }, $dummy_data_movies)) ?>],
            datasets: [{
                label: 'Movies Watched',
                data: [<?= implode(',', array_map(function($item) { return $item['movie_count']; }, $dummy_data_movies)) ?>],
                backgroundColor: '#4e73df',
                borderColor: '#4e73df',
                borderWidth: 1
            }]
        }
    });
</script>
