<div class="row">
    <!-- articles -->
    <div class="col-xs-12 col-md-8 col-md-offset-2">
        <div class="panel panel-default boxshadow">
            <div class="panel-heading panel-heading-articles text-center">
                <?= h($article->name) ?>
            </div>
            <div class="panel-tags">
                <div class="panel-tags-text-left">
                    Posté le : <?= h($article['created']) ?>
                    <?php if(h($article['modified']) !== h($article['created'])): ?>
                        - Modifié le : <?= h($article['modified']) ?>
                    <?php endif; ?>
                </div>
                <div class="panel-tags-text-right">
                    Catégorie :
                    <?= $this->Html->link(h($article->tag->name),['action' => 'index',h($article->tag->name)]) ?>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12">
                        <?= nl2br(h($article->content)) ?>
                    </div>
                </div>
            </div>
            <div class="panel-footer panel-footer-articles">
                <!-- infos créateur -->
                <div class="row">
                    <div class="col-xs-12">
                        <?= $this->Html->image('avatars/40x40/'.$article->user->picture_url,['class' => 'img-circle img-articles']) ?>
                        Article publié par <?= $this->Html->link($article->user->username,['controller' => 'Users','action' => 'view','prefix' => false,$article->user->id]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 text-center">
        <?= $this->Html->link('<span class="glyphicon glyphicon-edit"></span> Editer cet article',['action' => 'edit',$article->id],['class' => 'btn btn-lg btn-success','escape' => false]) ?>
        <?= $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span> Supprimer cet article',['action' => 'edit',$article->id],['confirm' => __('Supprimer cet article ?', $article->id),'class' => 'btn btn-lg btn-danger','escape' => false]) ?>
    </div>
</div>