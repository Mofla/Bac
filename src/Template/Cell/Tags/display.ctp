<div class="col-xs-12 col-sm-12 hidden-md hidden-lg">

</div>
<div class="col-md-2 col-lg-2 hidden-xs hidden-sm pull-right">
    <div class="list-group boxshadow">
        <span class="list-group-item list-group-item-title"><span class="glyphicon glyphicon-tags"></span> Tags</span>
        <?= $this->Html->link('<span class="glyphicon glyphicon-share-alt text-gold"></span> - Tous les articles',['controller' => 'Articles','action' => 'index'],['class' => 'list-group-item','escape' => false]) ?>
        <?php foreach($tags as $tag): ?>
            <?= $this->Html->link('<span class="glyphicon glyphicon-share-alt text-gold"></span> - '.$tag->name,['controller' => 'Articles','action' => 'index',$tag->id,toUrl($tag->name)],['class' => 'list-group-item','escape' => false]) ?>
        <?php endforeach; ?>
    </div>
</div>