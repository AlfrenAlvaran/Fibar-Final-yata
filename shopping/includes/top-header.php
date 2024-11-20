<?php
//session_start();

?>

<div class="top-bar animate-dropdown">
	<div class="container">
		<div class="header-top-inner">
			<div class="cnt-account">
				<ul class="list-unstyled">

					<?php if (strlen($_SESSION['login'])) {   ?>
						<li><a href="#"><i class="icon fa fa-user"></i>Welcome -<?php echo htmlentities($_SESSION['username']); ?></a></li>
					<?php } ?>

					<li style="list-style: none; margin: 5px 0;">
    <a href="my-account.php" style="color: #333; text-decoration: none; padding: 
	2px; display: flex; align-items: center; transition: color 0.3s;">
        <i class="icon fa fa-user" style="margin-right: 8px;"></i>My Account
    </a>
</li>
					<li style="list-style: none; margin: 5px 0;">
    <a href="my-wishlist.php" style="color: #333; text-decoration: none; padding: 
	2px; display: flex; align-items: center; transition: color 0.3s;">
        <i class="icon fa fa-user" style="margin-right: 8px;"></i>Wishlist
    </a>
</li>

<li style="list-style: none; margin: 5px 0;">
    <a href="my-cart.php" style="color: #333; text-decoration: none; padding: 
	2px; display: flex; align-items: center; transition: color 0.3s;">
        <i class="icon fa fa-shopping-cart" style="margin-right: 8px;"></i>My Cart
    </a>
</li>
<li style="list-style: none; margin: 5px 0;">
    <a href="messages.php" style="color: #333; text-decoration: none; padding: 
	2px; display: flex; align-items: center; transition: color 0.3s;">
        <i class="icon fa fa-shopping-cart" style="margin-right: 8px;"></i>Messages
    </a>
</li>					
					<?php if (strlen($_SESSION['login']) == 0) {   ?>
						<li style="list-style: none; margin: 5px 0;">
    <a href="login.php" style="color: #333; text-decoration: none; padding: 
	2px; display: flex; align-items: center; transition: color 0.3s;">
        <i class="icon fa fa-user" style="margin-right: 8px;"></i>Login
    </a>
</li>
					
					<?php } else { ?>

						<li><a href="logout.php"><i class="icon fa fa-sign-out"></i>Logout</a></li>
					<?php } ?>
				</ul>
			</div><!-- /.cnt-account -->

			<div class="cnt-block">
				<ul class="list-unstyled list-inline">
					<li class="dropdown dropdown-small">
					<a href="track-orders.php" class="dropdown-toggle" style="color: #fff; background-color: #007bff; padding: 10px 15px; text-decoration: none; border-radius: 5px; transition: background-color 0.3s; display: inline-block;">
    <span class="key" style="font-weight: bold;">Track Order</span>
</a>
					</li>


				</ul>
			</div>

			<div class="clearfix"></div>
		</div><!-- /.header-top-inner -->
	</div><!-- /.container -->
</div><!-- /.header-top -->