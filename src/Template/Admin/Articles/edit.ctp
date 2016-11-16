<div class="row">
    <div class="col-xs-12 col-md-6 col-md-offset-3">
        <div class="panel panel-default boxshadow">
            <div class="panel-heading panel-heading-articles text-center">
                <h3 class="h3">Editer l'article</h3>
            </div>
            <div class="panel-body">
                <?= $this->Form->create($article,['class' => 'form-group']) ?>
                <?php
                echo $this->Form->input('name',['label' => 'Titre','class' => 'form-control']);
                echo $this->Form->input('content',['label' => 'Contenu','class' => 'form-control']);
                ?>
                <div>
                    <label>Etat de l'article</label>
                    <div class="radio">
                        <label><input type="radio" name="state" value=0>Enregistrer comme brouillon</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="state" value=1>Publier directement</label>
                    </div>
                    <?php if($article->state == 1): ?>
                    <div class="radio">
                        <label><input type="radio" name="state" value=2>Ne plus publier</label>
                    </div>
                    <?php endif; ?>
                </div>
                <?php
                echo $this->Form->input('tag_id', ['label' => 'Catégorie','options' => $tags,'class' => 'form-control']);
                ?>
            </div>
            <div class="panel-footer panel-footer-articles text-center">
                <?= $this->Form->button('Valider',['class' => 'btn btn-lg btn-success']) ?>
                <?= $this->Html->link('Annuler',['controller' => 'Articles','action' => 'index'],['class' => 'btn btn-lg btn-danger']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

