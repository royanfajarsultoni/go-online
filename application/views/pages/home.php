		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li><a href="<?php echo base_url()?>">Home</a></li>
						<?php foreach ($categories as $category): ?>
							<li <?php echo ($selectedCategory === $category->name) ? ' class="active"' : ''; ?>>
								<a href="<?php echo base_url('pages/view?category=' . urlencode($category->name)); ?>">
									<?php echo $category->name; ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->

		<!-- Section -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- product -->
						<?php foreach ($products as $product) : ?>
						<div class="col-md-3 col-xs-6">
								<div class="product">
									<div class="product-img">
										<img src="<?php echo base_url('assets/images/products/' . $product['image']); ?>" alt="">
										<div class="product-label">
											<span class="sale">NEW</span>
										</div>
									</div>
									<div class="product-body">
										<?php if (isset($product['category_name'])) : ?>
											<p class="product-category"><?php echo $product['category_name']; ?></p>
										<?php endif; ?>
										<h3 class="product-name"><a href="#"><?php echo $product['product_name']; ?></a></h3>
										<h4 class="product-price"><?php echo $product['save_price']; ?> <del class="product-old-price"><?php echo $product['price']; ?></del></h4>
										<div class="product-rating">
										</div>
										<div class="product-btns">
											<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
											<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
											<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
										</div>
									</div>
									<div class="add-to-cart">
										<?php echo anchor('detail-product/' . $product['id'], 
											'<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>'); 
										?>
									</div>
								</div>
							</a>
						</div>
						<?php endforeach; ?>
						<!-- /product -->
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
		<!-- /Section -->

		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
							</form>
							<!-- <ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul> -->
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->