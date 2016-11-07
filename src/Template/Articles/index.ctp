<div class="row">
    <!-- tags -->
    <div class="col-xs-12 hidden-md hidden-lg">
        <!-- charger les tags -->
        <div class="well">

        </div>
    </div>
    <div class="col-md-2 pull-right hidden-xs hidden-sm">
        <!-- charger les tags -->
        <div class="well">

        </div>
    </div>
    <!-- articles -->
    <div class="col-xs-12 col-md-6 col-md-offset-1">
        <?php foreach($articles as $article): ?>
            <div class="panel panel-success">
                <div class="panel-heading text-center">
                    <?= h($article->name) ?>
                </div>
                <div class="panel-body">
                    <?= h($article->content) ?>
                </div>
                <div class="panel-footer">
                    <!-- infos créateur -->
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>