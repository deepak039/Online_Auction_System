<?php 
session_start();
include('db.php');
include('pro_table_check.php');

if(isset($_SESSION['user'])) {
    $row_c = $_SESSION['user'];
}

if(!isset($_SESSION['user'])) {
    header("location:index.php");
}

$home = true;
$view = false;
$bids = false;
$products = false;

?>





<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>

<style>
/* Body Background */
body {
    background-color: #f4f6f9;
    font-family: Arial, sans-serif;
}

/* NavBar */
.bg-nav {
    background-color: #283747 !important;
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    z-index: 5;
}

.bg-darkblue {
    background-color: #283747 !important;
}

/* Flexbox container */
.container_flex {
    background-color: #ecf0f1;
    display: flex;
    flex-direction: row-reverse;
}

/* Updated Card Styles */
.card {
    background-color: #ffffff;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    border-radius: 12px;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    overflow: hidden;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

/* Product Image with hover effect */
.product_img {
    background-size: cover;
    border-radius: 12px 12px 0 0;
    transition: transform 0.3s ease-in-out;
    object-fit: cover;
}

.card:hover .product_img {
    transform: scale(1.05);
}

/* Card Body with better spacing */
.card-body {
    padding: 20px;
    text-align: center;
}

.bg-gray {
    background-color: #f7f9f9;
    padding: 20px;
}

.card-body h5 {
    font-size: 1.5rem;
    color: #2c3e50;
    font-weight: 700;
}

.card-body h4 {
    font-size: 1.2rem;
    color: #16a085;
    margin-top: 10px;
    font-weight: 600;
}

/* Buttons with updated style */
.btn-light {
    background-color: #16a085 !important;
    color: #ffffff;
    border-radius: 30px;
    padding: 10px 20px;
    font-size: 1rem;
    transition: background-color 0.3s ease;
}

.btn-light:hover {
    background-color: #1abc9c !important;
}

/* Card Footer with added padding and font adjustments */
.bg-card-footer {
    background-color: #ecf0f1;
    color: #95a5a6;
    padding: 15px;
    text-align: center;
    font-size: 0.9rem;
    font-weight: 500;
}

/* Card Title Link */
a.card-title {
    text-decoration: none;
}

a.card-title:hover {
    text-decoration: underline;
}

/* Enhanced Typography */
.text-info {
    font-size: 1.2rem;
    color: #3498db !important;
    font-weight: 600;
}

.text {
    color: #7f8c8d !important;
    font-weight: 500;
}

a.text:hover,
a.text:focus {
    color: #34495e !important;
}

/* Row adjustments */
.row {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    margin: 0 -15px;
}

.col-xl-3, .col-lg-4, .col-md-6, .col-sm-12 {
    padding: 15px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .max-width {
        max-width: 100%;
    }

    .card-body h5 {
        font-size: 1.3rem;
    }

    .card-body h4 {
        font-size: 1rem;
    }
}

/* Miscellaneous */
.text-muted {
    color: #95a5a6 !important;
}

h4 {
    margin-top: 20px;
    color: #2c3e50;
    font-weight: 600;
}

a.text-info:hover {
    color: #2980b9 !important;
}
</style>



<body>

	<?php include 'nav.php'; ?>

		
<br><br><br>

    <?php
    $query1 = "select * from tbl_product where status = 'On Sale' ORDER BY pro_id DESC;";
	$run_q1 = $con->query($query1);
	$showing_products = $run_q1->num_rows;
    ?>

    <h4 class="m-3 text-info">Showing <?php echo $showing_products; ?>&nbsp;Products&nbsp;for&nbsp;Sale</h4>

    <form>
		    <div class="container mt-5 mb-5">
				<?php

				?>
				<div class="row">
				<?php
				
				while ($row_q1 = $run_q1->fetch_object()) {
					$bid_s_time = $row_q1->bidstarttime;
        			$bid_e_time = $row_q1->bidendtime;
        			$product_id = $row_q1->pro_id;

        			$nt = new DateTime($bid_s_time);
        			$bid_s_time = $nt->getTimestamp();


        			$nt = new DateTime($bid_e_time);
        			$bid_e_time = $nt->getTimestamp();

        			$date = time();

					$pro_id = $row_q1->pro_id;
					$query5 = "select * from tbl_bid where pro_id = $pro_id;";
					$run_q5 = $con->query($query5);
					$total_bids = $run_q5->num_rows;
						?>
							<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">	
								<div class="card mt-3 mb-3">
									<?php  
									$query6 = "select * from tbl_img where pro_id = $pro_id LIMIT 1";
									$run_q6 = $con->query($query6);
									$row_q6 = $run_q6->fetch_object();
									$image_name = $row_q6->img_name;
									$image_destination = "product_images/".$image_name;
									?>
									<h4 class="btn btn-sm btn-light mt-3"><?php echo "Bid ends : $row_q1->bidendtime"; ?></h4>
									<img class="product_img card-img-top" src="<?php echo $image_destination; ?>"  height="200vh" width="100%" alt="Product Image">
									<div class="card-body bg-gray">
										<a class="card-title text-dark" href="view_product.php?pro_id=<?php echo $pro_id; ?>"><h5><?php echo $row_q1->name; ?></h5></a>
										
										<h4 class="font-weight-light">&nbsp;&#8377;<?php echo $row_q1->price; ?></h4>
										
										<?php if($bid_s_time < $date) { ?>
										<a href="buyer_bid.php?pro_id=<?php echo $row_q1->pro_id;?>" class="btn btn-sm btn-light mt-3">Bid</a>
										<?php }
										else { ?>
										<h4 class="btn btn-sm btn-light mt-3"><?php echo "Bid has not started"; ?></h4>
										<?php } ?>

									</div>
									<div class="card-footer bg-card-footer text-muted">
										<?php

										echo $total_bids." ";
										($total_bids >1 ? $printing = "bids on this product" : $printing = "bid on this product");
										echo $printing;
										?>  
									</div>
								</div>
							</div>
						<?php
				}
				?>
				</div>
			</div>
	</form>

	
	

	


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>