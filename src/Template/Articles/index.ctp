<div class="row">
    <!-- tags -->
    <?= $this->cell('Tags') ?>
    <!-- articles -->
    <div class="col-xs-12 col-md-6 col-md-offset-1">
        <?php foreach($articles as $article): ?>
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
                            <?php
                            $content = h($article->content);
                            $crop = mb_substr($content,0,300);
                            (strlen($content) > strlen($crop)) ? $crop .= '...' : $crop = $content;
                            ?>
                            <?= nl2br($crop) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <?= $this->Html->link('Voir l\'article',['action' => 'view',$article->id],['class' => 'btn btn-xs btn-success pull-right','escape' => false]) ?>
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
        <?php endforeach; ?>
    </div>
</div>