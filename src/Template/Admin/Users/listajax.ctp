<?= $this->layout = false ?>
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
    <?php if(sizeof($users) < 1): ?>
        <tr>
            <td colspan="6" class="text-center">Il n'y a aucun utilisateur</td>
        </tr>
    <?php endif; ?>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $this->Number->format($user->id) ?></td>
            <td><?= h($user->username) ?></td>
            <td><?= h($user->email) ?></td>
            <td><?= h($user->created->i18nformat('EEEE dd MMMM YYYY hh:mm:ss')) ?></td>
            <td><?= h($user->modified->i18nformat('EEEE dd MMMM YYYY hh:mm:ss')) ?></td>
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
                        <li><?= $this->Html->link('Voir', ['action' => 'view', $user->id,toUrl(h($user->username))]) ?></li>
                        <li><?= $this->Html->link('Editer', ['action' => 'edit', $user->id,toUrl(h($user->username))]) ?></li>
                        <!-- ban -->
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

<script>
    // pagination in ajax
    $('.pagination a').unbind().bind('click',function(event){
        event.preventDefault();
        if($(this).closest('li').hasClass('active') || $(this).closest('li').hasClass('disabled'))
        {
            return false;
        }
        var url = $(this).attr('href');
        $('#users').load(url).unbind();
        return false;
    })
</script>
