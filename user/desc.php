 <?php
 include_once('header.php')
 ?>

	<style>
		.btn-buy {
			border: none;
			padding: 20px 215px;
			margin-top: 40px;
			border-radius: 6px;
			transition: 0.3s;
			margin-top: 400px;
		}

		.btn-buy:hover {
			background-color: rgb(200, 200, 200);
			transition: 0.3s;
		}
	</style>

 



	<section id="event" class="p_3 bg-light">
		<div class="container">
			<div class="row upcome_1 text-center">
				<div class="col-md-12">
					<h3 class="mb-0">MOVIE DESCRIPTION</h3>
					<hr class="line me-auto ms-auto">
				</div>
			</div>
			<?php
			// Pastikan koneksi sudah benar
			include_once 'db.php';

			// Ambil id_movie dari URL
			$id_movie = isset($_GET['id']) ? $_GET['id'] : 0;

			// Query untuk mengambil data film berdasarkan id
			$query = "SELECT * FROM movies WHERE id_movie = $id_movie";
			$result = mysqli_query($koneksi, $query);
			$movie = mysqli_fetch_assoc($result);

			if ($movie) {
				?>

				<div class="row event1 mt-3">
					<div class="col-md-6 pe-0">
						<div class="event1l">
							<div class="grid clearfix">
								<figure class="effect-jazz mb-0">
									<a href="#"><img src="../img/<?php echo $movie['image']; ?>" height="689" class="w-100"
											alt="<?php echo $movie['title']; ?>"></a>
								</figure>
							</div>
						</div>
					</div>
					<div class="col-md-6 ps-0">
						<div class="event1r bg-white p-4 shadow_box" style="height: 689px;">
							<h5 class="text-uppercase"><a href="#"><?php echo $movie['title']; ?></a></h5>
							<h6><?php echo $movie['age_rating']; ?> Pictures
								<span class="col_red pull-right">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
								</span>
							</h6>
							<hr>
							<h6><?php echo $movie['release_date']; ?> <span
									class="pull-right"><?php echo $movie['duration']; ?> Min</span></h6>
							<p class="mt-3"><?php echo $movie['description']; ?> Read More</p>
							<button class="btn-buy">Buy Ticket</button>
						</div>
					</div>
				</div <?php
			} else {
				echo "Film not found.";
			}
			?> </div>
	</section>

	<!-- Modal Konfirmasi -->
	<div class="modal fade" id="buyTicketModal" tabindex="-1" aria-labelledby="buyTicketModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="buyTicketModalLabel">Konfirmasi</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					Beli tiket ini?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
					<a href="transaction.php">
						<button type="button" class="btn btn-primary" id="confirmBuyTicket">Ya</button>
					</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Toast Notifikasi -->
	<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 11;">
		<div id="buyTicketToast" class="toast align-items-center text-white bg-success border-0" role="alert"
			aria-live="assertive" aria-atomic="true">
			<div class="d-flex">
				<div class="toast-body">
					Tiket berhasil dipesan, silahkan lihat di History!
				</div>
				<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
					aria-label="Close"></button>
			</div>
		</div>
	</div>

	<script>
		document.addEventListener("DOMContentLoaded", () => {
			const buyButton = document.querySelector(".btn-buy");
			const confirmButton = document.getElementById("confirmBuyTicket");
			const toastElement = document.getElementById("buyTicketToast");
			const toast = new bootstrap.Toast(toastElement);

			// Ketika tombol "Buy Ticket" diklik
			buyButton.addEventListener("click", () => {
				const modal = new bootstrap.Modal(document.getElementById("buyTicketModal"));
				modal.show();
			});

			// Ketika tombol "Ya" di modal diklik
			confirmButton.addEventListener("click", () => {
				const modal = bootstrap.Modal.getInstance(document.getElementById("buyTicketModal"));
				modal.hide(); // Tutup modal
				toast.show(); // Tampilkan toast
			});
		});
	</script>






	<section id="footer" class="p_3">
		<div class="container-xl">
			<div class="row footer_1">
				<div class="col-md-2">
					<div class="footer_1i">
						<h6 class="text-white fw-bold">LANGUAGE MOVIES</h6>
						<hr class="line mb-4">
						<div class="row footer_1i_small">
							<h6 class="col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a
									class="text-muted" href="#">English Movie</a></h6>
							<h6 class="mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a
									class="text-muted" href="#">Tamil Movie</a></h6>
							<h6 class="mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a
									class="text-muted" href="#">Punjabi Movie</a></h6>
							<h6 class="mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a
									class="text-muted" href="#">Hindi Movie</a></h6>
							<h6 class="mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a
									class="text-muted" href="#">Malyalam Movie</a></h6>
							<h6 class="mb-0 mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a
									class="text-muted" href="#"> Action Movie</a></h6>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="footer_1i">
						<h6 class="text-white fw-bold">TAG CLOUD</h6>
						<hr class="line mb-4">
						<ul class="mb-0">
							<li class="d-inline-block"><a class="d-block" href="#">Analyze</a></li>
							<li class="d-inline-block"><a class="d-block" href="#">Audio</a></li>
							<li class="d-inline-block"><a class="d-block" href="#">Blog</a></li>
							<li class="d-inline-block"><a class="d-block" href="#">Business</a></li>
							<li class="d-inline-block"><a class="d-block" href="#">Creative</a></li>
							<li class="d-inline-block"><a class="d-block" href="#">Design</a></li>
							<li class="d-inline-block"><a class="d-block" href="#">Experiment</a></li>
							<li class="d-inline-block"><a class="d-block" href="#">News</a></li>
							<li class="d-inline-block"><a class="d-block" href="#">Expertize</a></li>
							<li class="d-inline-block"><a class="d-block" href="#">Express</a></li>
							<li class="d-inline-block"><a class="d-block" href="#">Share</a></li>
							<li class="d-inline-block"><a class="d-block" href="#">Sustain</a></li>
							<li class="d-inline-block"><a class="d-block" href="#">Video</a></li>
							<li class="d-inline-block"><a class="d-block" href="#">Youtube</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-2">
					<div class="footer_1i">
						<h6 class="text-white fw-bold">BY PRESENTER</h6>
						<hr class="line mb-4">
						<div class="row footer_1i_small">
							<h6 class="col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a
									class="text-muted" href="#">Action Movie</a></h6>
							<h6 class="mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a
									class="text-muted" href="#">Romantic Movie</a></h6>
							<h6 class="mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a
									class="text-muted" href="#">Other Movie</a></h6>
							<h6 class="mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a
									class="text-muted" href="#">Comedy Movie</a></h6>
							<h6 class="mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a
									class="text-muted" href="#">Drama Movie</a></h6>
							<h6 class="mb-0 mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a
									class="text-muted" href="#">Classical Movie</a></h6>
						</div>

					</div>
				</div>
				<div class="col-md-4">
					<div class="footer_1i">
						<h6 class="text-white fw-bold">SUBSCRIPTION</h6>
						<hr class="line mb-4">
						<p class="text-muted">Subscribe your Email address for latest news & updates.</p>
						<input class="form-control bg-transparent" placeholder="Enter Email Address" type="text">
						<h6 class="mb-0 mt-4"><a class="button_1 pt-3 pb-3" href="#">Submit <i
									class="fa fa-check-circle ms-1"></i> </a></h6>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="footer_b" class="pt-3 pb-3">
		<div class="container-xl">
			<div class="row footer_b1">
				<div class="col-md-8">
					<div class="footer_b1l">
						<p class="mb-0 fs-6 text-muted mt-1">© 2013 Your Website Name. All Rights Reserved | Design by
							<a class="col_red" href="http://www.templateonweb.com">TemplateOnWeb</a>
						</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="footer_b1r text-end">
						<ul class="social-network social-circle mb-0">
							<li><a href="#" class="icoRss" title="Rss"><i class="fa fa-rss"></i></a></li>
							<li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-pinterest"></i></a>
							</li>
							<li><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script>
		window.onscroll = function () { myFunction() };

		var navbar_sticky = document.getElementById("navbar_sticky");
		var sticky = navbar_sticky.offsetTop;
		var navbar_height = document.querySelector('.navbar').offsetHeight;

		function myFunction() {
			if (window.pageYOffset >= sticky + navbar_height) {
				navbar_sticky.classList.add("sticky")
				document.body.style.paddingTop = navbar_height + 'px';
			} else {
				navbar_sticky.classList.remove("sticky");
				document.body.style.paddingTop = '0'
			}
		}
	</script>

</body>

</html>