<?= $this->Form->create($comment) ?>
<?= $this->Form->input('name',['label'=>'Titre']) ?>
<?= $this->Form->input('content',['label'=>'Message']) ?>
<?= $this->Form->end() ?>
