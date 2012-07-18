<script type="text/coffeescript">
    $("#viewSearch").focus () ->
        $("#viewSearch").switchClass "span2", "span3", 1000
</script>

<!-- begin Debug -->
<?php
    /*
    if(isset($_REQUEST['search']) && $_REQUEST['search']) {
        $res = $_REQUEST['search'];
        echo "Regular search for: ".$res;
    } 

    if(isset($_REQUEST['tagSearch']) && $_REQUEST['tagSearch']) {
        $res = $_REQUEST['tagSearch'];
        echo "Tag search for: ".$res;
    } 
    */
?>
<!-- end Debug -->

<div class="page-header" style="overflow: hidden">
    <h3 class="span2">
        All Questions
    </h3>
    <div class="span4">
        <div class="control-group">
            <div class="controls">
                <div class="input-prepend">
                    <form id="questionsSearchForm" method="post" action="/questions/view" class="form-search">
                        <button type="submit" class="btn btn-small">Search</button>
                        <input type="search" class="span2" placeholder="Search Questions" name="search" id="viewSearch"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    if($count > 0) {
        for($i = 0; $i < $count; ++$i) {
            echo $this->_render('element', 'questionElement', array('question' => $questions[$i], 'index' => $i, 'view' => true));
        }
    } elseif(!isset($error)) {
        echo "<b>No questions have been asked yet.</b>";
    }
?>

<!-- Check for errors -->
<!-- elementError.php should take array('errorHeader', 'errorMsg', 'alertType') -->
<?php if(isset($error)):?>
    <div class="alert alert-info" align="center">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h4 class="alert-heading">Sorry</h4>
        <?php echo $error ?>
    </div>
<?php endif;?>
