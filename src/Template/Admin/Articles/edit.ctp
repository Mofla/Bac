<div class="row">
    <div class="col-xs-12 col-md-8 col-md-offset-2">
        <div class="panel panel-default boxshadow">
            <div class="panel-heading panel-heading-articles text-center">
                <h3 class="h3">Editer l'article</h3>
            </div>
            <div class="panel-body">
                <?= $this->Form->create($article,['class' => 'form-group','type' => 'file']) ?>
                <div class="col-xs-12 col-md-4">
                    <?= $this->Html->image('articles/320x320/'.h($article->picture_url),['id' => 'file','class' => 'img-responsive img-thumbnail','width' => '320px','height' => '320px']) ?>
                    <?= $this->Form->input('picture_url',['label' => 'Photo','type' => 'file','id' => 'file_input','accept' => 'image/*','onchange' => 'imgPreview(event)']) ?>
                </div>
                <div class="col-xs-12 col-md-8">
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
            </div>
            <div class="panel-footer panel-footer-articles text-center">
                <?= $this->Form->button('Valider',['class' => 'btn btn-lg btn-success']) ?>
                <?= $this->Html->link('Annuler',['controller' => 'Articles','action' => 'index'],['class' => 'btn btn-lg btn-danger']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<?= $this->Html->script('scripts.js') ?>
