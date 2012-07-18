<?php
use app\models\Users;
use app\models\Questions;

$userIconArray = Users::getUserInfo($answer['owner'], array('iconUri'));
$userIcon = $userIconArray['iconUri'];

$questionArray = Questions::find($answer['questionId'], array('fields' => array('title')))->to('array');
$questionTitle = $questionArray['title'];
?>

<?php if(isset($view)): ?>
	<div id="answerView_<?php $index = isset($index) ? $index : ''; echo $index;?>" class="container-fluid" style="margin-bottom: 50px;">
		
		<div class="span0">
			<img src="<?=$userIcon?>" />
			<br />
			<?=$answer['owner']?>
		</div>

		<div class="span2">
			<h5><a href="/questions/read?id=<?=$answer['questionId']?>"><?=$questionTitle?></a></h5>
		</div>

	</div>
<?php elseif(isset($read)): ?>
	<div id="answerRead_<?php $index = isset($index) ? $index : ''; echo $index;?>" class="container-fluid" style="margin-bottom: 50px;">

		<div class="row-fluid">

			<div class="span2">
				<img src="<?=$userIcon?>" />
				<br />
				<?=$answer['owner']?>
	            <br />
	            Answered <?php echo $this->timeHelper->humanTime($answer['dateCreated']); ?>
			</div>

			<div class="span6">
                <?php echo $answer['body']; ?>
			</div>
			
		</div>

	</div>
<?php endif; ?>