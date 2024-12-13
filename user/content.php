<?php
include_once 'db.php'; // Pastikan file koneksi berada di direktori yang sama

$query = "SELECT id_movie, title, image, description, release_date FROM movies ORDER BY release_date DESC";
$result = mysqli_query($koneksi, $query);

if (!$result) {
	die("Query error: " . mysqli_error($koneksi));
}
?>

<section id="center" class="center_home">
	<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
		<div class="carousel-indicators">
			<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
				aria-label="Slide 1"></button>
			<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"
				class="" aria-current="true"></button>
			<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
				aria-label="Slide 3"></button>
		</div>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img src="img/slide.jpg" class="d-block w-100" alt="..." width="1600" height="600">
				<div class="carousel-caption d-md-block">
					<h5 class="text-uppercase bg_red d-inline-block p-2 text-white">Releasing On</h5>
					<h1>The Good Dinosaur</h1>
					<p>There are many variations of passages available but the majority have suffered
						alteration in some form by injected humour or randomised words.</p>
					<ul class="mb-0 mt-3">
					</ul>
				</div>
			</div>
			<div class="carousel-item">
				<img src="img/slide2.jpg" class="d-block w-100" alt="..." width="1600" height="600">
				<div class="carousel-caption d-md-block">
					<h5 class="text-uppercase bg_red d-inline-block p-2 text-white">Releasing On</h5>
					<h1>Luca</h1>
					<p>There are many variations of passages available but the majority have suffered
						alteration in some form by injected humour or randomised words.</p>
					<ul class="mb-0 mt-3">
					</ul>
				</div>
			</div>
			<div class="carousel-item">
				<img src="img/slide3.jpg" class="d-block w-100" alt="..." width="1600" height="600">
				<div class="carousel-caption d-md-block">
					<h5 class="text-uppercase bg_red d-inline-block p-2 text-white">Releasing On</h5>
					<h1>Inside Out 2</h1>
					<p>There are many variations of passages available but the majority have suffered
						alteration in some form by injected humour or randomised words.</p>
					<ul class="mb-0 mt-3">
					</ul>
				</div>
			</div>
		</div>
		<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
			data-bs-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Previous</span>
		</button>
		<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
			data-bs-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Next</span>
		</button>
	</div>
</section>

<section id="upcome" class="p_3 bg-light">
	<div class="container-xl">
		<div class="row upcome_1 text-center">
			<div class="col-md-12">
				<h3 class="mb-0">MOVIES</h3>
				<hr class="line me-auto ms-auto">
				<ul class="nav nav-tabs justify-content-center border-0 mb-0 mt-4">
					<li class="nav-item">
						<a href="#home" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
							<span class="d-md-block">Now Playing</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="row upcome_2 mt-4">
			<div class="tab-content">
				<div class="tab-pane active" id="home">
					<div class="upcome_2i row">
						<?php
						// Query untuk mengambil data film yang sedang tayang
						$query = "SELECT * FROM movies WHERE release_date <= CURDATE() ORDER BY release_date DESC";
						$result = mysqli_query($koneksi, $query);
						if (mysqli_num_rows($result) > 0) {
							while ($movie = mysqli_fetch_assoc($result)) {
								echo "
                <div class='col-md-3'>
                  <div class='upcome_2i1 clearfix position-relative'>
                    <div class='upcome_2i1i clearfix'>
                      <img src='../img/{$movie['image']}' class='w-100' alt='{$movie['title']}' width='270px' height='330px'>
                    </div>
                    <div class='upcome_2i1i1 clearfix position-absolute top-0 text-center w-100'>
                      <h6 class='text-uppercase mb-0'><a class='button_2' href='desc.php?id={$movie['id_movie']}'>View Details</a></h6>
                    </div>
                  </div>
                  <div class='upcome_2i_last bg-white p-3'>
                    <div class='upcome_2i_lasti row'>
                      <div class='col-md-9 col-9'>
                        <div class='upcome_2i_lastil'>
                          <h5><a href='#'>{$movie['title']}</a></h5>
                          <h6 class='text-muted'>{$movie['age_rating']}</h6>
                          <span class='col_red'>
                            <i class='fa fa-star'></i>
                            <i class='fa fa-star'></i>
                            <i class='fa fa-star'></i>
                            <i class='fa fa-star'></i>
                            <i class='fa fa-star-o'></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                ";
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="release" style="background-image: url('img/bg1.jpg">
	<div class="release_m clearfix">
		<div class="container-xl">
			<div class="row release_1">
				<div class="col-md-7">
					<div class="release_1i">

					</div>
				</div>
				<div class="col-md-5">
					<div class="release_1i1 text-center">
						<h6 class="text-uppercase bg_red d-inline-block p-2 pe-4 ps-4 text-white">Releasing On</h6>
						<h3 class="text-white icon_line mt-3 text-uppercase">30 JAN 2025</h3>
						<h1 class="text-uppercase font_50 text-white mt-3">KESEMPATAN KEDUA</h1>
						<h4 class="text-white mt-3 mb-0">A Presenter Film Production</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>