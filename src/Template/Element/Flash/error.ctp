<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message error alert alert-danger text-center box-message"" onclick="this.classList.add('hidden');">
    <?= h($message) ?>
    <span class="pull-right glyphicon glyphicon-remove"></span>
</div>
<!-- <div class="message error" onclick="this.classList.add('hidden');"><?= $message ?></div> -->
