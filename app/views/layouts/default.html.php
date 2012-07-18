<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2011, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
use lithium\security\Auth;

$user = $this->Login->getUserName();
?>

<!doctype html>
<html>
	<head>
		<?php echo $this->html->charset();?>
		<title>Q&A-Lite</title>
		
		<link type="text/css" rel="stylesheet" href="/css/bootstrap.css" />
		
	    <script type="text/javascript" src="/js/jquery-1.7.min.js"></script>
	    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
	    <script type="text/javascript" src="/js/bootstrap-tab.js"></script>
	    <script type="text/javascript" src="/js/coffee-script.js"></script>
	    <script type="text/javascript" src="/js/jquery-ui-1.8.16.min.js"></script>
	            
	    <!-- Favicon loader -->
		<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
	</head>
	<body class="app">
        <div id="header">
            <?php echo $this->_render('element', 'navbar', array('user' => $user));?>
        </div>
        <div id="mainBody" style="clear: left; padding-left: 200px; padding-right: 200px; padding-bottom: 30px; padding-top: 60px">
            <?php echo $this->content();?>
        </div>
	</body>
</html>