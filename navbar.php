<div class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-item-collapse" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#home">
						<img src="img/icon/icon.png" width="25px">
					</a>
					<a class="navbar-brand" href="index.php">
						Cityzen Journalist
					</a>
				</div>

				<div class="collapse navbar-collapse" id="navbar-item-collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="index.php">Beranda</a></li>
					</ul>
					<form class="navbar-form navbar-left" action="index.php" method="POST">
						<div class="form-group">
							<input type="text" name="Search" class="form-control" placeholder="Search">
						</div>
						<button type="submit" class="btn btn-primary">Cari Berita</button>
					</form>
					<ul class="nav navbar-nav navbar-right">
							<?php 
								if(isset($_SESSION['NamaUser'])){
									$NamaUser = $_SESSION['NamaUser'];
									echo "
									<li class=\"dropdown\">
									<a href=\"#\" class=\"data-toggle\" data-toggle=\"dropdown\" rule=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Hello! ".$NamaUser." <span class=\"caret\"></span></a>
									<ul class=\"dropdown-menu\">
										<li><a href=\"profile-user.php\">Profile</a></li>
										<li><a href=\"help.php\">Help</a></li>
										<li role=\"separator\" class=\"divider\"></li>
										<li><a href=\"logout.php\">Logout</a></li>
									</ul>
									</li>
									";
								}else{
									echo "
									<li><a href=\"loginPage.php\" rule=\"button\">Masuk</a></li>
									<li><a href=\"register.php\" rule=\"button\">Daftar</a></li>
									";
								}
							?>
					</ul>
				</div>
			</div>
		</div>