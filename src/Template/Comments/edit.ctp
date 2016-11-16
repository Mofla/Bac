<?= $this->layout = false ?>
<?= $this->Form->create($comment,['class' => 'form-group']) ?>
<?= $this->Form->input('name',['label'=>'Titre','class' => 'form-control']) ?>
<?= $this->Form->input('content',['label'=>'Message','class' => 'form-control']) ?>
<br>
<?= $this->Form->submit('Editer',['class' => 'btn btn-md btn-info']) ?>
<?= $this->Form->end() ?>
