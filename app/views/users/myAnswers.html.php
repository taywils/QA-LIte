<script type="text/coffeescript">
    $("#viewSearch").focus () ->
        $("#viewSearch").switchClass "span2", "span3", 1000
</script>

<div class="page-header" style="overflow: hidden">
    <h3 class="span2">
        My Answers
    </h3>
    <div class="span4">
        <div class="control-group">
            <div class="controls">
                <div class="input-prepend">
                    <form id="myAnswersSearchForm" method="post" action="/users/myAnswers" class="form-search">
                        <button type="submit" class="btn btn-small">Search</button>
                        <input type="search" class="span2" placeholder="Search Answers" name="search" id="viewSearch"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    if(count($answers) > 0) {
        for($i = 0, $j = count($answers); $i < $j; ++$i) {
            echo $this->_render('element', 'elementAnswer', array('answer' => $answers[$i], 'index' => $i, 'read' => true));
        }
    } else if(isset($searched) && !empty($search) && $searched == true) {
        echo "<b>No results for &quot;$search&quot;</b>";
    }
    else {
        echo "<b>You haven't answered any questions.</b>";
    }
?>