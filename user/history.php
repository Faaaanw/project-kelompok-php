<?php
session_start();
include_once('header.php'); // Memulai session
require_once("../function.php");
$user_id = $_SESSION['user_id']; // Mengambil id_user dari session
// Pastikan id_user ada dalam session, jika tidak redirect ke login
if (!isset($user_id)) {
  header("Location: login.php"); // Arahkan ke halaman login jika belum login
  exit;
}

// Query untuk mengambil data transaksi dari database berdasarkan user_id
$query = query("SELECT t.*, m.title AS movie_title, th.name AS theater_name, m.image AS movie_image
                FROM transactions t
                JOIN movies m ON t.movie_id = m.id_movie
                JOIN theaters th ON t.theater_id = th.id_theater
                WHERE t.user_id = '$user_id' ORDER BY t.id_transaction DESC");
?>




<section id="schedule" class="p_3">
  <div class="container">
    <div class="row upcome_1 text-center">
      <div class="col-md-12">
        <h3 class="mb-0">Ticket History</h3>
        <hr class="line me-auto ms-auto">
      </div>
    </div>
    <div class="row schedule_1 text-center mt-3">
    </div>
    <div class="row schedule_2 mt-4">
      <div class="tab-content" style="margin-bottom: 30px;">
        <div class="tab-pane active" id="history">
          <?php
          $no = 1;
          foreach ($query as $transaksi):
            ?>
            <div class="news_1ri row mb-4">
              <!-- Gambar Film -->
              <div class="col-md-2 pe-0">
                <div class="news_1ril">
                  <div class="grid clearfix">
                    <figure class="effect-jazz mb-0">
                      <a href="#"><img src="../img/<?= htmlspecialchars($transaksi['movie_image']) ?>" height="300"
                          class="w-100" alt="movie image"></a>
                    </figure>
                  </div>
                </div>
              </div>

              <!-- Detail Transaksi -->
              <div class="col-md-10 ps-0">
                <div class="news_1rir p-4 bg-white">
                  <h4 class="fs-5"><?= htmlspecialchars($transaksi['movie_title']) ?></h4>
                  <h6>
                    <span class="col_red me-3"><?= htmlspecialchars($transaksi['transaction_date']) ?></span>
                    <?= htmlspecialchars($transaksi['quantity']) ?> Seat(s)
                  </h6>
                  <p>
                    Di balik setiap layar lebar ada cerita yang ingin disampaikan, petualangan yang ingin dirasakan, dan
                    emosi yang ingin dibagikan. Nikmati setiap detik perjalanan Anda bersama kami. Selamat menikmati film
                    ini!
                  </p>
                  <h6 class="mb-0">
                    <i class="fa fa-couch col_red me-1"></i> Seat C12
                    <span class="text-muted me-2 ms-2">|</span>
                    <i class="fa fa-tv col_red me-1"></i> Theater <?= htmlspecialchars($transaksi['theater_id']) ?>
                  </h6>
                  <h6 class="mt-2">
                    Price: <strong><?= number_format($transaksi['price'], 2, '.', ',') ?></strong>
                  </h6>
                  <h6 class="mb-0">
                    Payment Status: <span
                      class="badge bg-<?= $transaksi['payment_status'] == 'paid' ? 'success' : ($transaksi['payment_status'] == 'failed' ? 'danger' : 'warning') ?>"><?= ucfirst($transaksi['payment_status']) ?></span>
                  </h6>

                  <!-- Ikon Tong Sampah untuk Hapus -->
                  <button type="button" class="btn btn-danger btn-sm mt-3" data-bs-toggle="modal"
                    data-bs-target="#deleteModal">
                    <i class="fa fa-trash"></i> Hapus
                  </button>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete this item?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              Cancel
            </button>
            <a href="../hapus_transaksi.php?id=<?= $transaksi['id_transaction']; ?>"
              class="btn btn-danger btn-sm">Hapus</a>
          </div>
        </div>
      </div>
    </div>
    