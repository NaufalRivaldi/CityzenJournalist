	<nav class="navbar navbar-inverse navbar-fixed-top">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="index.php">
	      	<img src="../img/icon/icon.png" width="20px">
	      </a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	      	<li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt"></span> Konten  <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="tampilKonten.php">Data Konten</a></li>
	            <li><a href="tampilKontenAcc.php">Data Konten Acc</a></li>
	            <li role="separator" class="divider"></li>
	            <li><a href="uploadKonten.php">Upload Konten</a></li>
	          </ul>
	        </li>
	        <li class="dropdown">
	          <a href="tampilUser.php" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Data User</a>
	        </li>
	        <?php 
	        	if($Level == 1){
	        		echo "
	        			<li class=\"dropdown\">
	          				<a href=\"tampilAdmin.php\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\"><span class=\"glyphicon glyphicon-user\"></span> Data Admin</a>
	        			</li>
	        		";
	        	}
	        ?>
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> User : <?php echo $NamaAdmin; ?> <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="logout.php">Keluar</a></li>
	          </ul>
	        </li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>