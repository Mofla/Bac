<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message error alert alert-success text-center box-message" onclick="this.classList.add('hidden');">
    <?= h($message) ?>
    <span class="pull-right glyphicon glyphicon-remove"></span>
</div>
<script>
    $('.box-message').delay(1500).fadeOut(1000);
</script>
<!-- <div class="message success" onclick="this.classList.add('hidden')"><?= $message ?></div> -->
