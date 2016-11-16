<div class="row">
    <div class="col-xs-12 text-center">
        <h1 class="h1 text-shadow">Catégories</h1>
    </div>
    <div class="col-xs-12 col-md-2">
        <div class="list-group">
            <span class="list-group-item list-group-item-title"><span class="glyphicon glyphicon-tags"></span> Catégories</span>
            <?= $this->Html->link('<span class="glyphicon glyphicon-plus text-gold"></span> - Ajouter une catégorie',['action' => 'add'],['class' => 'list-group-item','escape' => false]) ?>
            <span class="list-group-item list-group-item-title"><span class="glyphicon glyphicon-th-list"></span> Articles</span>
            <?= $this->Html->link('<span class="glyphicon glyphicon-share text-gold"></span> - Gérer',['controller' => 'Articles','action' => 'index'],['class' => 'list-group-item','escape' => false]) ?>
            <span class="list-group-item list-group-item-title"><span class="glyphicon glyphicon-user"></span> Utilisateurs</span>
            <?= $this->Html->link('<span class="glyphicon glyphicon-share text-gold"></span> - Gérer',['controller' => 'Users','action' => 'index'],['class' => 'list-group-item','escape' => false]) ?>
        </div>
    </div>

    <div id="users" class="col-xs-12 col-md-10">
        <table class="table table-striped table-responsive">
            <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col">Nombre d'articles</th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if(sizeof($tags) < 1): ?>
                <tr>
                    <td colspan="6" class="text-center">Il n'y a aucune catégorie</td>
                </tr>
            <?php endif; ?>
            <?php foreach ($tags as $tag): ?>
                <tr>
                    <td><?= $this->Number->format($tag->id) ?></td>
                    <td><?= h($tag->name) ?></td>
                    <td><?= count($tag->articles) ?></td>
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
                                <li><?= $this->Html->link('Voir', ['action' => 'view', $tag->id,toUrl(h($tag->name))]) ?></li>
                                <li><?= $this->Html->link('Editer', ['action' => 'edit', $tag->id,toUrl(h($tag->name))]) ?></li>
                                <!-- ban -->
                                <li><?= $this->Form->postLink('Supprimer', ['action' => 'delete', $tag->id], ['confirm' => __('Supprimer # {0}?', $tag->id)]) ?></li>
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
