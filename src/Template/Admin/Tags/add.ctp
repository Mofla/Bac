<div class="row">
    <div class="col-xs-12 col-md-6 col-md-offset-3">
        <div class="panel panel-default boxshadow">
            <div class="panel-heading panel-heading-articles text-center">
                <h3 class="h3">Ajouter une catégorie</h3>
            </div>
            <div class="panel-body">
                <?= $this->Form->create($tag,['class' => 'form-group']) ?>
                <?= $this->Form->input('name',['label' => 'Nom de la catégorie','class' => 'form-control']) ?>
                <hr>
                <div class="text-center">
                    <?= $this->Form->submit('Valider',['class' => 'btn btn-lg btn-success']) ?>
                    <?= $this->Html->link('Annuler',['controller' => 'Tags','action' => 'index'],['class' => 'btn btn-lg btn-danger']) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
