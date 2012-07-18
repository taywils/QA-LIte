<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
    	<div class="container">
    		<a class="brand" href="/">Q&amp;A Lite</a>
    		<ul class="nav">
 			 	<li><a href="/questions/ask">Ask A Question</a></li>
  				<li><a href="/questions/view">View All Questions</a></li>

                <!-- Display user account menu if the user is logged in -->
                <?php if(!empty($user)):?>
  				<li class="dropdown">
					<a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-white"></i> My Account <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li class="nav-header">Q&amp;A</li>
						<li><a href="/users/myQuestions"><i class="icon-question-sign"></i> My Questions</a></li>
						<li><a href="/users/myAnswers"><i class="icon-comment"></i> My Answers</a></li>
						<li class="divider"></li>
						<li class="nav-header">Profile</li>
                        <li><a href="/users/aboutMe"><i class="icon-pencil"></i> About Me</a></li>
					</ul>
            	</li>
            	<?php endif;?>

			</ul>
			<ul class="nav pull-right">
				<?php if(empty($user)):?>
            		<li><a href="/users/login" id="navbarLogin" rel="popover">Login</a></li>
            	<?php else:?>
            		<li><a href="/users/logout">Logout</a></li>
            	<?php endif;?>
            	<li class="divider-vertical"></li>
            	<li><a href="/users/register">Register</a></li>
          	</ul>
    	</div>
  	</div>
</div>