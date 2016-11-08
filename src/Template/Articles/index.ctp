<div class="row">
    <!-- tags -->
    <div class="col-xs-12 hidden-md hidden-lg">
        <!-- charger les tags -->
        <div class="well boxshadow">

        </div>
    </div>
    <div class="col-md-2 pull-right hidden-xs hidden-sm">
        <!-- charger les tags -->
        <div class="well boxshadow">

        </div>
    </div>
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
                    </div>
                    <div class="panel-tags-text-right">
                        Catégorie :
                        <?= $this->Html->link(h($article->tag->name),['action' => 'index',h($article->tag->name)]) ?>
                    </div>
                </div>
                <div class="panel-body">
                    <?= h($article->content) ?>
                </div>
                <div class="panel-footer panel-footer-articles">
                    <!-- infos créateur -->
                    <?= $this->Html->image('avatars/40x40/'.$article->user->picture_url,['class' => 'img-responsive img-circle img-articles']) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>