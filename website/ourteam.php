<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    
    <script src="js/form.js"></script>
    <link rel="stylesheet" href="style/form.css">
    <title>Information</title>
</head>
<body id="ourteam">
    <div class="fixbug">
        <header>
            <nav>
                <h1>TNE:GO</h1>
                <div class="nav_links">
                    <input type="checkbox" id="button">
                    <label for="button" id="nav_icon"><i class="fa-solid fa-bars"></i></label>
                    <ul>
						<li ><a href="index.php">Homepage</a></li>
                        <li><a href="service.php">Service</a></li>
                        <li ><a href="ourteam.php">Our Team</a></li>
                        <li ><a href="login.php">Login</a></li>
                    </ul>

                </div>
            </nav>

        </header>
        
        <main>
			<div class="ourteam_introduction">
				<div class="introduction_content">
					<h1>About <span>TNE:GO</span> Team</h1>
					<p>Transform your office with ease and affordability with our professional network setup services - exceptional quality, unbeatable prices.</p>
					<p><a href="#team_comp" class="introbutton">Explore</a></p>
				</div>
			</div>

			<div class="team_comp" id="team_comp">
				<div class="forming_team">
					<h1>Group formation</h1>
					<p>A group project involves a team working together to achieve a common goal. It requires defining objectives, assigning roles, creating a timeline, and effective communication. Regular feedback and evaluation ensure the project stays on track.
					</p>
					<p>write how the group was made, how we are inspired by the TNE10006</p>
					<img src="images/teamimg.jpg" alt="team picture">
					<div class="our_vision">
						<div class="our_vision_title">
							<h2>Our vision</h2>
							<p>Crafting awesome network office setups with exceptional experiences</p>

						</div>
						<div class="our_vision_content">
							<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem sint eum delectus minus architecto ipsam sed laboriosam fuga, rerum, ea accusantium tempora doloribus facere perspiciatis assumenda vel laborum cumque nobis.</p>
							<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem sint eum delectus minus architecto ipsam sed laboriosam fuga, rerum, ea accusantium tempora doloribus facere perspiciatis assumenda vel laborum cumque nobis.</p>
							<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem sint eum delectus minus architecto ipsam sed laboriosam fuga, rerum, ea accusantium tempora doloribus facere perspiciatis assumenda vel laborum cumque nobis.</p>

						</div>
					</div>

				</div>
			</div>

			<div class="box" id="teamembers">
				<div class="box_title">
					<h1>Team Members</h1>
				</div>

				<div class="swiper mySwiper">
					<div class="swiper-wrapper">
						<div class="swiper-slide card">
							<div class="card_inset">

								<div class="card_image">
									<img src="images/vandai.png" alt="Lake" />
								</div>
				
								<div class="pra">
									<h4> &#9733;  Pham Van Dai</h4>
								</div>
							</div>
						</div>
	
						<div class="swiper-slide card">
							<div class="card_inset">

								<div class="card_image">
									<img src="images/dqt2.jpg" alt="Lake" />
								</div>
				
								<div class="pra">
									<h4>Duong Quang Thanh</h4>
								</div>
							</div>
						</div>
	
						<div class="swiper-slide card">
							<div class="card_inset">

								<div class="card_image">
									<img src="images/lxn.jpg" alt="Lake" />
								</div>
				
								<div class="pra">
									<h4>Le Xuan Nhat</h4>
								</div>
							</div>
						</div>
	
						<div class="swiper-slide card">
							<div class="card_inset">

								<div class="card_image">
									<img src="images/dnk.jpg" alt="Lake" />
								</div>
				
								<div class="pra">
									<h4>Dang Nam Khanh</h4>
								</div>
							</div>
						</div>
	
					</div>
					<div class="swiper-button-next neprebtn"></div>
					<div class="swiper-button-prev neprebtn"></div>
					<div class="swiper-pagination"></div>
				</div>
			</div>

			
		</div>
	</main>
        
    <footer>
	<p>Dang Nam Khanh, Le Xuan Nhat, Duong Quang Thanh</p>
        <p>Copyright &copy; 2023 TNE:GO. All rights Reserved</p>
    </footer>
	<!-- Swiper JS -->
	<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

	<!-- Initialize Swiper -->
	<!-- <script>
	var swiper = new Swiper(".mySwiper", {
		slidesPerView: 2,
		spaceBetween: 30,
		pagination: {
		el: ".swiper-pagination",
		clickable: true,
		},
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},
	});
	</script> -->
	<script>
		const swiper = new Swiper('.swiper', {
		// Optional parameters
		direction: 'horizontal',
		slidesPerView: 1,
		spaceBetween: 40,
		slidesPerGroup: 1,
		centerSlide: "true",
		grabCursor: "true",
		fade: "true",


		// If we need pagination
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
			// dynamicBullets: true;
		},

		// Navigation arrows
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},

		// And if we need scrollbar
		scrollbar: {
			el: '.swiper-scrollbar',
		},

		breakpoints: {
			200:{
				slidesPerView: 1,
				spaceBetween: 30,
			},
			500:{
				slidesPerView: 2,
				spaceBetween: 20,
			},
			800:{
				slidesPerView: 3,
				spaceBetween: 30,
			},
			// 1500:{
			// 	slidesPerView: 3,

			// },
		}
		});
	</script>

</body>
</html>

