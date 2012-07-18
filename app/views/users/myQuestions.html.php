<script type="text/coffeescript">
    $("#viewSearch").focus () ->
        $("#viewSearch").switchClass "span2", "span3", 1000
</script>

<!-- Check for successful edit update -->
<?php if((isset($_REQUEST['update']) && $_REQUEST['update'] == 'success')):?>
    <div class="alert alert-success" align="center">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <h4 class="alert-heading">Success!</h4>
        <?php echo "You've updated a question" ?>
    </div>
<?php endif;?>

<div class="page-header" style="overflow: hidden">
    <h3 class="span2">
        My Questions
    </h3>
    <div class="span4">
        <div class="control-group">
            <div class="controls">
                <div class="input-prepend">
                    <form id="myQuestionsSearchForm" method="post" action="/users/myQuestions" class="form-search">
                        <button type="submit" class="btn btn-small">Search</button>
                        <input type="search" class="span2" placeholder="Search Questions" name="search" id="viewSearch"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    if(count($questions) > 0) {
        for($i = 0; $i < count($questions); ++$i) {
            echo $this->_render('element', 'questionElement', array('question' => $questions[$i], 'index' => $i, 'view' => true, 'edit' => true));
        }
    } else if(isset($searched) && isset($search) && $searched == true) {
        echo "<b>No results for &quot;$search&quot;</b>";
    } else {
        echo "<b>You haven't asked any questions.</b>";
    }
?>