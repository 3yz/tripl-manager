<div class="messages">
  <?php foreach ($messages as $arr): ?>
    <div class="alert alert-<?php echo $arr['type'] ?>">
      <?php echo $arr['key'] ?>
    </div>
  <?php endforeach ?>
</div>