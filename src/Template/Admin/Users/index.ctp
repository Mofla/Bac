<div class="row">
    <div class="col-xs-12 text-center">
        <h1 class="h1 text-shadow">Utilisateurs</h1>
    </div>
    <div class="col-xs-12 col-md-2">
        <div class="list-group">
            <span class="list-group-item list-group-item-title"><span class="glyphicon glyphicon-th-list"></span> Utilisateurs</span>
            <?= $this->Html->link('<span class="glyphicon glyphicon-ok-sign text-green"></span> - Actifs',['action' => 'index',1],['class' => 'list-group-item','escape' => false]) ?>
            <?= $this->Html->link('<span class="glyphicon glyphicon-remove-sign text-red"></span> - Inactifs',['action' => 'index',0],['class' => 'list-group-item','escape' => false]) ?>
        </div>
    </div>

    <div class="col-xs-12 col-md-10">
        <table class="table table-striped table-responsive">
            <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('username') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $this->Number->format($user->id) ?></td>
                    <td><?= h($user->username) ?></td>
                    <td><?= h($user->email) ?></td>
                    <td><?= h($user->created) ?></td>
                    <td><?= h($user->modified) ?></td>
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
                                <li><?= $this->Html->link('Voir', ['action' => 'view', $user->id]) ?></li>
                                <li><?= $this->Html->link('Editer', ['action' => 'edit', $user->id]) ?></li>
                                <!-- ban ->
                                <li><?= $this->Form->postLink('Supprimer', ['action' => 'delete', $user->id], ['confirm' => __('Supprimer # {0}?', $user->id)]) ?></li>
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
