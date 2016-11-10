<div class="row">
    <!-- tags -->
    <?= $this->cell('Tags') ?>
    <!-- articles -->
    <div class="col-xs-12 col-md-8 col-md-offset-1">
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
                        <?= $this->Html->link(h($article->tag->name),['action' => 'index',$article->tag->id,toUrl(h($article->tag->name))]) ?>
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
                            <?= $this->Html->image('avatars/40x40/'.h($article->user->picture_url),['class' => 'img-circle img-articles']) ?>
                            Article publié par <?= $this->Html->link(h($article->user->username),['controller' => 'Users','action' => 'view','prefix' => false,$article->user->id,toUrl(h($article->user->username))]) ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>