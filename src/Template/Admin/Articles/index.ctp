<div class="row">
    <div class="col-xs-12 text-center">
        <h1 class="h1 text-shadow">Articles</h1>
    </div>
    <div class="col-xs-12 col-md-2">
        <div class="list-group">
            <span class="list-group-item list-group-item-title"><span class="glyphicon glyphicon-th-list"></span> Articles</span>
            <?= $this->Html->link('<span class="glyphicon glyphicon-send"></span> - Publiés',['action' => 'index',1],['class' => 'list-group-item','escape' => false]) ?>
            <?= $this->Html->link('<span class="glyphicon glyphicon-floppy-remove"></span> - Retirés',['action' => 'index',2],['class' => 'list-group-item','escape' => false]) ?>
            <?= $this->Html->link('<span class="glyphicon glyphicon-floppy-disk"></span> - Brouillons',['action' => 'index',0],['class' => 'list-group-item','escape' => false]) ?>
            <?= $this->Html->link('<span class="glyphicon glyphicon-plus"></span> - Ajouter un nouvel article',['action' => 'add'],['class' => 'list-group-item','escape' => false]) ?>
        </div>
    </div>

    <div class="col-xs-12 col-md-10">
        <table class="table table-striped table-responsive">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('tag_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($articles as $article): ?>
                <tr>
                    <td><?= $this->Number->format($article->id) ?></td>
                    <td><?= h($article->name) ?></td>
                    <td><?= $article->has('tag') ? $this->Html->link($article->tag->name, ['controller' => 'Tags', 'action' => 'view', $article->tag->id]) : '' ?></td>
                    <td><?= h($article->created) ?></td>
                    <td><?= h($article->modified) ?></td>
                    <td class="actions">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Actions
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu3">
                                <li class="dropdown-header"></li>
                            </ul>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu3">
                                <li class="dropdown-header">Choix</li>
                                <li><?= $this->Html->link('Voir', ['action' => 'view', $article->id]) ?></li>
                                <li><?= $this->Html->link('Editer', ['action' => 'edit', $article->id]) ?></li>
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
            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->prev('< ') ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(' >') ?>
                </ul>
            </div>
        </div>
    </div>
</div>
