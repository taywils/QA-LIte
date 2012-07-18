<!-- Check for successful login -->
<?php if((isset($_REQUEST['login']) && $_REQUEST['login'] == 'true') && $this->Login->getUserName()):?>
    <div class="alert alert-success" align="center">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h4 class="alert-heading">Welcome Back <?php echo $this->Login->getUserName()?>!</h4>
        <?php echo "Feel free to ask questions and provide insightful answers!" ?>
    </div>
<?php endif;?>

<!-- Check for successful logout -->
<?php if(isset($_REQUEST['logout']) && $_REQUEST['logout'] == 'true'):?>
    <div class="alert alert-info" align="center">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h4 class="alert-heading">Thanks For Stopping By!</h4>
        <?php echo "You have just logged out" ?>
    </div>
<?php endif;?>

<!-- Check for successful registration -->
<?php if(isset($_REQUEST['register']) && $_REQUEST['register'] == 'true'):?>
    <div class="alert alert-info" align="center">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h4 class="alert-heading">Thanks For Registering!</h4>
        <?php echo "Please login to ask questions" ?>

        <!-- Display Login Popover -->
        <script type="text/coffeescript">
            $ () ->
                $("#navbarLogin").popover {title: "Login Now", content:"Click \"Login\" to proceed", placement:'bottom'}
                $("#navbarLogin").popover 'show'
        </script>
    </div>
<?php endif;?>

<div class="container-fluid">
	<div class="row-fluid">
        <!-- Main body content -->
		<div class="span8">
			<!-- tabbable navigation -->
			<div class="tabbable" style="margin-bottom: 18px;">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#newestQuestions" data-toggle="tab">Newest</a></li>
					<li><a href="#popularQuestions" data-toggle="tab">Popular</a></li>
					<li><a href="#unAnsweredQuestions" data-toggle="tab">Unanswered</a></li>
				</ul>
				<div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
					<div class="tab-pane active" id="newestQuestions">
						<?php
							if(isset($newest)) {
                                for($i = 0, $j = count($newest); $i < $j; ++$i) {
                                    echo $this->_render('element', 'questionElement', array('question' => $newest[$i], 'index' => $i, 'view' => true));
                                }
							}
						?>
					</div>
					<div class="tab-pane" id="popularQuestions">
						<?php
							if(isset($popular)) {
                                for($i = 0, $j = count($popular); $i < $j; ++$i) {
                                    echo $this->_render('element', 'questionElement', array('question' => $popular[$i], 'index' => $i, 'view' => true));
                                }
							}
						?>
					</div>
					<div class="tab-pane" id="unAnsweredQuestions">
						<?php
							if(is_string($noAns)) {
								echo $noAns;
							} else {
                                for($i = 0, $j = count($noAns); $i < $j; ++$i) {
                                    echo $this->_render('element', 'questionElement', array('question' => $noAns[$i], 'index' => $i, 'view' => true));
                                }
							}
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="span4">
			<!-- Sidebar content-->
			<!-- View recent answers -->
			<h4>Recent Answers</h4>
            <hr />
            <?php
                if(is_string($answers)) {
                    echo $answers;
                } else {
                    for($i = 0, $j = count($answers); $i < $j; ++$i) {
                        echo $this->_render('element', 'elementAnswer', array('answer' => $answers[$i], 'index' => $i, 'view' => true));
                    }
                }
            ?>
            <!-- Top Tags -->
            <hr />
            <h4>Top Tags</h4>
            <?php
                foreach($tags as $tagName => $tagCount) {
                    //echo "<a id='tag_".$tagName."' href='/questions/view?tagSearch=".$tagName."' class='btn btn-small'>"."<b>".$tagName."</b>"."</a> x ";
                    echo "<a id='tag_".$tagName."' href='/questions/view?tagSearch=".$tagName."' class='btn btn-small'>"."<b>".$tagName."</b>"."</a> ";
                    //echo "<span class='badge'>".$tagCount."</span>"."<br />";
                    //echo "<span class='badge'>".$tagCount."</span>";
                }
            ?>
		</div>
	</div>
</div>