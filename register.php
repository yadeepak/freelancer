<?php
//Check if frontinit.php exists
if(!file_exists('core/frontinit.php')){
	header('Location: install/');        
    exit;
}else{
 require_once 'core/frontinit.php';	
}


//Get Site Settings Data
$query = DB::getInstance()->get("settings", "*", ["id" => 1]);
if ($query->count()) {
 foreach($query->results() as $row) {
 	$title = $row->title;
 	$use_icon = $row->use_icon;
 	$site_icon = $row->site_icon;
 	$tagline = $row->tagline;
 	$description = $row->description;
 	$keywords = $row->keywords;
 	$author = $row->author;
 	$bgimage = $row->bgimage;
 }			
}

//Get Payments Settings Data
$q1 = DB::getInstance()->get("payments_settings", "*", ["id" => 1]);
if ($q1->count()) {
 foreach($q1->results() as $r1) {
 	$currency = $r1->currency; 

 	$membershipid = $r1->membershipid;
 }			
}

//Getting Payement Id from Database
$query = DB::getInstance()->get("membership_freelancer", "*", ["membershipid" => $membershipid]);
if ($query->count() === 1) {
  $q1 = DB::getInstance()->get("membership_freelancer", "*", ["membershipid" => $membershipid]);
} else {
  $q1 = DB::getInstance()->get("membership_agency", "*", ["membershipid" => $membershipid]);
}
if ($q1->count() === 1) {
 foreach($q1->results() as $r1) {
  $bids = $r1->bids;
 }
}



	
?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en" class="no-js"> 
<!--<![endif]-->
<head>

	    <!-- ==============================================
		Title and Meta Tags
		=============================================== -->
		<meta charset="utf-8">
        <title><?php echo escape($title) .' - '. escape($tagline) ; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="<?php echo escape($description); ?>">
        <meta name="keywords" content="<?php echo escape($keywords); ?>">
        <meta name="author" content="<?php echo escape($author); ?>">
		
		<!-- ==============================================
		Favicons
		=============================================== --> 
		<link rel="shortcut icon" href="img/favicons/favicon.ico">
		<link rel="apple-touch-icon" href="img/favicons/apple-touch-icon.png">
		<link rel="apple-touch-icon" sizes="72x72" href="img/favicons/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="114x114" href="img/favicons/apple-touch-icon-114x114.png">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

	    <!-- ==============================================
		CSS
		=============================================== -->
        <!-- Style-->
        <link href="assets/css/login.css" rel="stylesheet" type="text/css" />
				
		<!-- ==============================================
		Feauture Detection
		=============================================== -->
		<script src="assets/js/modernizr-custom.js"></script>
		
		<!--[if lt IE 9]>
		 <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->		
		
</head>

<body>

	<!-- Paste this code after body tag -->
    <div class="loader">
	<div class="se-pre-con"></div>
    </div>
	
    
 <? 
$basename = basename($_SERVER["REQUEST_URI"], ".php");
$editname = basename($_SERVER["REQUEST_URI"]);
$test = $_SERVER["REQUEST_URI"];
?>
     <!-- ==============================================
     Navigation Section
     =============================================== -->
	<header id="header" headroom="" role="banner" tolerance="5" offset="700" class="navbar navbar-fixed-top navbar--white ng-isolate-scope headroom headroom--top">
	  <nav role="navigation">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle header-nav__button" data-toggle="collapse" data-target=".navbar-main">
	        <span class="icon-bar header-nav__button-line"></span>
	        <span class="icon-bar header-nav__button-line"></span>
	        <span class="icon-bar header-nav__button-line"></span>
	      </button>
	      <div class="header-nav__logo">
	        <a class="header-nav__logo-link navbar-brand" href="index.php">
	       	<?php if($use_icon === '1'): ?>
	       		<i class="fa <?php echo $site_icon; ?>"></i>
	       	<?php endif; ?>  <?php echo escape($title); ?></a>
	      </div>
	    </div>
	    <div class="collapse navbar-collapse navbar-main navbar-right">
	      <ul class="nav navbar-nav header-nav__navigation">
	        <li class="header-nav__navigation-item
	         <?php echo $active = ($_SERVER['HTTP_HOST'] && $test === '') ? ' active' : ''; echo $active = ($basename == 'index') ? ' active' : ''; ?>">
	          <a href="index.php" class="header-nav__navigation-link">
	            <?php echo $lang['home']; ?>
	          </a>
	        </li>
	        <li class="header-nav__navigation-item <?php echo $active = ($basename == 'jobs') ? ' active' : ''; echo $active = ($editname == 'jobpost.php?title='. Input::get('title').'') ? ' active' : '';?>">
	          <a href="jobs.php" class="header-nav__navigation-link ">
	            <?php echo $lang['jobs']; ?>
	          </a>
	        </li>
	        <li class="header-nav__navigation-item <?php echo $active = ($basename == 'services') ? ' active' : ''; echo $active = ($editname == 'freelancer.php?a='. Input::get('a').'&id='. Input::get('id').'') ? ' active' : ''; ?>">
	          <a href="services.php" class="header-nav__navigation-link ">
	            <?php echo $lang['services']; ?>
	          </a>
	        </li>
	        <li class="header-nav__navigation-item <?php echo $active = ($basename == 'about') ? ' active' : ''; ?>">
	          <a href="about.php" class="header-nav__navigation-link ">
	            <?php echo $lang['about']; ?>
	          </a>
	        </li>
	        <li class="header-nav__navigation-item <?php echo $active = ($basename == 'how') ? ' active' : ''; ?>">
	          <a href="how.php" class="header-nav__navigation-link ">
	            <?php echo $lang['how']; ?> <?php echo $lang['it']; ?> <?php echo $lang['works']; ?>
	          </a>
	        </li>
	        <li class="header-nav__navigation-item <?php echo $active = ($basename == 'faq') ? ' active' : ''; ?>">
	          <a href="faq.php" class="header-nav__navigation-link ">
	            <?php echo $lang['faq']; ?>
	          </a>
	        </li>
	        <li class="header-nav__navigation-item <?php echo $active = ($basename == 'contact') ? ' active' : ''; ?>">
	          <a href="contact.php" class="header-nav__navigation-link ">
	            <?php echo $lang['contact']; ?>
	          </a>
	        </li>
	        
		 <?php
		 //Start new Admin object
		 $admin = new Admin();
		 //Start new Client object
		 $client = new Client();
		 //Start new Freelancer object
		 $freelancer = new Freelancer(); 
		 
		 if ($admin->isLoggedIn()) { ?>
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
            	<?php // echo $profileimg; ?>
                  <img src="Admin/<?php echo escape($admin->data()->imagelocation); ?>" class="user-image" alt="User Image"/>
                
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">
                  	<?php echo escape($admin->data()->name); ?>
                  </span>
                </a>
                <ul class="dropdown-menu">
						<li class="m_2"><a href="Admin/dashboard.php"><i class="fa fa-dashboard"></i><?php echo $lang['dashboard']; ?></a></li>
						<li class="m_2"><a href="Admin/profile.php?a=profile"><i class="fa fa-user"></i><?php echo $lang['view']; ?> <?php echo $lang['profile']; ?></a></li>
						<li class="m_2"><a href="Admin/logout.php"><i class="fa fa-lock"></i> <?php echo $lang['logout']; ?></a></li>	
        		</ul>
              </li>
		<?php } elseif($client->isLoggedIn()) { ?>
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
            	<?php // echo $profileimg; ?>
                  <img src="Client/<?php echo escape($client->data()->imagelocation); ?>" class="user-image" alt="User Image"/>
                
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">
                  	<?php echo escape($client->data()->name); ?>
                  </span>
                </a>
                <ul class="dropdown-menu">
						<li class="m_2"><a href="Client/dashboard.php"><i class="fa fa-dashboard"></i><?php echo $lang['dashboard']; ?></a></li>
						<li class="m_2"><a href="Client/profile.php?a=profile"><i class="fa fa-user"></i><?php echo $lang['view']; ?> <?php echo $lang['profile']; ?></a></li>
						<li class="m_2"><a href="Client/logout.php"><i class="fa fa-lock"></i> <?php echo $lang['logout']; ?></a></li>	
        		</ul>
              </li>
		<?php } elseif($freelancer->isLoggedIn()) { ?>
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
            	<?php // echo $profileimg; ?>
                  <img src="Freelancer/<?php echo escape($freelancer->data()->imagelocation); ?>" class="user-image" alt="User Image"/>
                
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">
                  	<?php echo escape($freelancer->data()->name); ?>
                  </span>
                </a>
                <ul class="dropdown-menu">
						<li class="m_2"><a href="Freelancer/index.php"><i class="fa fa-dashboard"></i><?php echo $lang['dashboard']; ?></a></li>
						<li class="m_2"><a href="Freelancer/profile.php?a=profile"><i class="fa fa-user"></i><?php echo $lang['view']; ?> <?php echo $lang['profile']; ?></a></li>
						<li class="m_2"><a href="Freelancer/logout.php"><i class="fa fa-lock"></i> <?php echo $lang['logout']; ?></a></li>	
        		</ul>
              </li>
		<?php } else { ?>		 		        
	        <li class="header-nav__navigation-item <?php echo $active = ($basename == 'login') ? ' active' : ''; echo $active = ($basename == 'forgot') ? ' active' : ''; echo $active = ($basename == 'reset') ? ' active' : ''; ?>">
	          <a class="header-nav__navigation-link" href="login.php"><?php echo $lang['login']; ?></a>
	        </li>
	        <li class="header-nav__navigation-item <?php echo $active = ($basename == 'register') ? ' active' : ''; ?>">
	          <a class="header-nav__navigation-link header-nav__navigation-link--outline" href="register.php"><?php echo $lang['signup']; ?> <?php echo $lang['for']; ?> <?php echo $lang['free']; ?></a>
	        </li>
		 <?php } ?>              		 	

              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  	<?php echo $lang['languages']; ?>
                </a>
                <ul class="dropdown-menu">
					<li class="m_2"><a href="<?php echo $test; ?>?lang=english">English</a></li>
					<li class="m_2"><a href="<?php echo $test; ?>?lang=french">French</a></li>
					<li class="m_2"><a href="<?php echo $test; ?>?lang=german">German</a></li>	
					<li class="m_2"><a href="<?php echo $test; ?>?lang=portuguese">Portuguese</a></li>
					<li class="m_2"><a href="<?php echo $test; ?>?lang=spanish">Spanish</a></li>
					<li class="m_2"><a href="<?php echo $test; ?>?lang=russian">Russian</a></li>	
					<li class="m_2"><a href="<?php echo $test; ?>?lang=chinese">Chinese</a></li>	
        		</ul>
              </li>


              	        
	      </ul>
	    </div>
	  </nav>
	</header>      
	 
     <!-- ==============================================
	 Header
	 =============================================== -->	 
	 <header class="header-login" style="
    background: linear-gradient(
      rgba(34,34,34,0.7), 
      rgba(34,34,34,0.7)
    ), url('<?php echo $bgimage; ?>') no-repeat center center fixed;
   background-size: cover;
  background-position: center center;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  color: #fff;
  height: 55vh;
  width: 100%;
  
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center; ">
      <div class="container">
	   <div class="content">
	    <div class="row">
	     <h1 class="revealOnScroll" data-animation="fadeInDown">
	       	<?php if($use_icon === '1'): ?>
	       		<i class="fa <?php echo $site_icon; ?>"></i>
	       	<?php endif; ?>  <?php echo escape($title); ?></h1>
		 <div id="typed-strings">
		  <span><?php echo escape($tagline); ?></span>
		 </div>
		 <p id="typed"></p>
        </div><!-- /.row -->
       </div><!-- /.content -->
	  </div><!-- /.container -->
     </header><!-- /header -->
	 
     <!-- ==============================================
     Banner Login Section
     =============================================== -->
	 <section class="banner-login">
	  <div class="container">
	  		  	
	   <div class="row">
	   
	    <main class="main main-signup col-lg-12">
	     <div class="col-lg-6 col-lg-offset-3 text-center">
	     	
        <?php if(isset($memError)) { //If errors are found ?>
        <div class="alert alert-danger fade in">
         <a href="#" class="close" data-dismiss="alert">&times;</a>
         <strong><?php echo $lang['hasError']; ?></strong> <?php echo $lang['mem_error']; ?>
	    </div>
        <?php } ?>
	     	
        <?php if(isset($hasError)) { //If errors are found ?>
        <div class="alert alert-danger fade in">
         <a href="#" class="close" data-dismiss="alert">&times;</a>
         <strong><?php echo $lang['hasError']; ?></strong> <?php echo $lang['login_error']; ?>
	    </div>
        <?php } ?>
        
        <?php if (isset($error)) {
			echo $error;
		} ?>
	     	
		  <div class="form-sign">
		
		   <form method="post" action="">
		    <div class="form-head">
			 <h3><?php echo $lang['register']; ?></h3>
			</div><!-- /.form-head -->
			
            <div class="form-body">

            <!-- List group -->
            <!--<ul class="list-group">
             <li class="list-group-item">
              <div class="material-switch pull-center">
	           <span class="pull-left"><?php // echo $lang['freelancer']; ?></span>
                <?php // echo $lang['freelancer']; ?><input id="someSwitchOptionDefault" name="user_type" type="checkbox"/>
                <label for="someSwitchOptionDefault" class="label-success"></label>
	           <span class="pull-right"><?php // echo $lang['client']; ?></span>
              </div>
             </li>
            </ul>--> 
            
            <!-- List group -->
            <ul class="list-group">
             <li class="list-group-item">
                <label class="checkbox-inline"><input type="checkbox" name="user_type" class="chb" value="1"><?php echo $lang['freelancer']; ?></label>
                <label class="checkbox-inline"><input type="checkbox" name="user_type" class="chb" value="0"><?php echo $lang['client']; ?></label>
             </li>
            </ul>
            
            <script>
                $(document).ready(function(){
                $(".chb").change(function()
                    {
                        //alert(0);
                        $(".chb").prop('checked',false);
                        $(this).prop('checked',true);
				});
				$("form").submit(function(e) {
					console.log($("form").serialize());
					e.preventDefault();
                        $.ajax({
							type:'POST',
							url:'RegisterSubmit.php',
							data:$(this).serialize(),
							success:function(resp){
							//	alert(resp)
							if(resp.includes('otp sent')){
								
								$('#otp').removeClass('hidden');
							}else if(resp=='Freelancer' || resp=='Client'){
								Swal.fire({
							 
							  type: 'success',
							  title: 'Registration successfull.',
							  showConfirmButton: false,
							  timer: 1500
							})
							setTimeout(function(){window.location.href=resp+'/'},1000);
							} 

							else{
								$('.error').html(resp);
							}
							}
						});
                      
				});
                });
            </script>
			
             <div class="form-row">
			  <div class="form-controls">
			   <input type="text" name="name" class="field" value="<?php echo escape(Input::get('name')); ?>"  placeholder="<?php echo $lang['full_name']; ?>">
			  </div><!-- /.form-controls -->
             </div><!-- /.form-row -->			
			
             <div class="form-row">
			  <div class="form-controls">
			   <input type="text" name="email" class="field" value="<?php echo escape(Input::get('email')); ?>"  placeholder="<?php echo $lang['email']; ?>">
			  </div><!-- /.form-controls -->
             </div><!-- /.form-row -->

		     <div class="form-row">
		      <div class="form-controls">
			   <input type="text" name="username" class="field" value="<?php echo escape(Input::get('username')); ?>" placeholder="<?php echo $lang['username']; ?>">
			  </div><!-- /.form-controls -->
		     </div><!-- /.form-row -->
			 
             <div class="form-row">
			  <div class="form-controls">
			   <input type="password" name="password" class="field" placeholder="<?php echo $lang['password']; ?>">
			  </div><!-- /.form-controls -->
             </div><!-- /.form-row -->

			 <div class="form-row">
			  <div class="form-controls">
			   <input type="password" name="confirmPassword" class="field" placeholder="<?php echo $lang['confirm_password']; ?>">
			  </div><!-- /.form-controls -->
             </div><!-- /.form-row -->
		   
			 </div><!-- /.form-body -->
			 <div class="form-row hidden" id="otp" >
			 <label style="color:white">We have sent you otp on your mail id</label>
			  <div class="form-controls">

			   <input type="number" name="otp" class="field" placeholder="Enter your OTP">
			  </div><!-- /.form-controls -->
             </div><!-- /.form-row -->
		   
			 </div>
			 <div class="form-foot">
			  <div class="form-actions">
			 
               <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />

			   <input value="<?php echo $lang['register']; ?>" class="form-btn" type="submit">
			  </div><!-- /.form-actions -->
			 </div><!-- /.form-foot -->
		   </form>
		   <br>
		     <div class="error"></div>
		  </div><!-- /.form-sign -->
	     </div><!-- /.col-lg-6 -->
        </main>
		
	   </div><!-- /.row -->
	  </div><!-- /.container -->
     </section><!-- /section -->
	 
     <!-- ==============================================
	 Scripts
	 =============================================== -->
	 
     <!-- jQuery 2.1.4 -->
     <script src="assets/js/jQuery-2.1.4.min.js" type="text/javascript"></script>
     <!-- Bootstrap 3.3.6 JS -->
     <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
     <!-- Typed JS -->
     <script src="assets/js/typed.min.js" type="text/javascript"></script>
     <!-- Kafe JS -->
     <script src="assets/js/kafe.js" type="text/javascript"></script>

</body>
</html>
