<?= $this->layout = false; ?>
<div class="row">
    <div class="col-xs-12 col-md-6 col-md-offset-3">
        <?= $this->Form->create($comment,['id' => 'form']) ?>
        <?= $this->Form->input('name',['label' => 'Intitulé','class' => 'form-control']) ?>
        <?= $this->Form->input('content',['label' => 'Message','class' => 'form-control']) ?>
        <hr>
        <div class="text-center">
            <?= $this->Form->button('Commenter',['class' => 'btn btn-md btn-success']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>