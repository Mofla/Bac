<?= $this->layout = false ?>
<table class="table table-striped table-responsive">
    <thead>
    <tr>
        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('name') ?></th>
        <th scope="col"><?= $this->Paginator->sort('tag_id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('created') ?></th>
        <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
        <th scope="col"><span class="glyphicon glyphicon-comment"></span></th>
        <th scope="col" class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php if(sizeof($articles) < 1): ?>
        <tr>
            <td colspan="6" class="text-center">Il n'y a aucun article</td>
        </tr>
    <?php endif; ?>
    <?php foreach ($articles as $article): ?>
        <tr>
            <td><?= $this->Number->format($article->id) ?></td>
            <td><?= h($article->name) ?></td>
            <td><?= $article->has('tag') ? $this->Html->link($article->tag->name, ['controller' => 'Tags', 'action' => 'view', $article->tag->id]) : '' ?></td>
            <td><?= h($article->created) ?></td>
            <td><?= h($article->modified) ?></td>
            <td><?= count($article->comments) ?></td>
            <td class="actions">
                <div class="dropdown">
                    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Actions
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu3">
                        <li class="dropdown-header"></li>
                    </ul>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu3">
                        <li class="dropdown-header">Choix</li>
                        <li><?= $this->Html->link('Voir', ['action' => 'view', $article->id,toUrl(h($article->name))]) ?></li>
                        <li><?= $this->Html->link('Editer', ['action' => 'edit', $article->id,toUrl(h($article->name))]) ?></li>
                        <?php if($article->state == 0 || $article->state == 2): ?>
                            <li><?= $this->Form->postLink('Publier', ['action' => 'publish', $article->id], ['confirm' => __('Publier cet article ?', $article->id)]) ?></li>
                        <?php elseif($article->state == 1): ?>
                            <li><?= $this->Form->postLink('Retirer', ['action' => 'retire', $article->id], ['confirm' => __('Retirer cet article ?', $article->id)]) ?></li>
                        <?php endif; ?>
                        <li><?= $this->Form->postLink('Supprimer', ['action' => 'delete', $article->id], ['confirm' => __('Supprimer # {0}?', $article->id)]) ?></li>
                    </ul>
                </div>
            </td>
            <td class="actions">



            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="text-center">
    <div class="text-center">
        <ul class="pagination pagination-large">
            <?php
            echo $this->Paginator->prev('< ', [], null,['class'=>'disabled']);
            echo $this->Paginator->numbers(['class' => 'numbers']);
            echo $this->Paginator->next(' >', [], null, ['class' => 'disabled']);
            ?>
        </ul>
    </div>
</div>

<script>
    // pagination in ajax
    $('.pagination a').unbind().bind('click',function(event){
        event.preventDefault();
        if($(this).closest('li').hasClass('active') || $(this).closest('li').hasClass('disabled'))
        {
            return false;
        }
        var url = $(this).attr('href');
        $('#articles').load(url).unbind();
        return false;
    })
</script>