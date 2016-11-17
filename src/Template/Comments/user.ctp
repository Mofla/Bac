<?= $this->layout = false ?>
<div id="user-comments">
    <table class="table table-responsive table-striped">
        <thead>
        <tr>
            <th>Article</th>
            <th>Commentaire</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php if (count($comments)>0): ?>
            <?php foreach ($comments as $comment): ?>
                <tr>
                    <td><?= h($comment->article->name) ?></td>
                    <td><?= h($comment->name) ?></td>
                    <td>
                        <?php if($this->request->query('id') == $this->request->session()->read('Auth.User.id')): ?>
                        <div class="dropdown">
                            <button class="btn btn-xs btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Actions
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu3">
                                <li class="dropdown-header"></li>
                            </ul>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu3">
                                <li class="dropdown-header">Choix</li>
                                <li>
                                    <?= $this->Html->link('Voir l\'article', [
                                        'controller' => 'Articles',
                                        'action' => 'view',
                                        $comment->article_id,
                                        toUrl(h($comment->article->name))
                                    ]) ?>
                                </li>
                                <li>
                                    <?= $this->Form->postLink('Supprimer', [
                                        'controller' => 'Comments',
                                        'action' => 'delete',
                                        $comment->id
                                    ], ['confirm' => 'Supprimer ce commentaire ?',$comment->id]) ?>
                                </li>
                            </ul>
                        </div>
                        <?php else: ?>
                            <?= $this->Html->link('<span class="glyphicon glyphicon-eye-open"></span>', [
                                'controller' => 'Articles',
                                'action' => 'view',
                                $comment->article_id,
                                toUrl(h($comment->article->name))
                            ],['class' => 'btn btn-xs btn-default','escape' => false]) ?>
                        <?php endif; ?>


                    </td>
                </tr>
            <?php endforeach; ?>

        <?php else: ?>
            <tr>
                <td colspan="3" class="text-center">Aucun commentaire posté</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<div class="paginator text-center">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ') ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(' >') ?>
    </ul>
</div>


<script>
    // pagination in ajax
    $('.pagination a').unbind().bind('click', function (event) {
        event.preventDefault();
        if ($(this).closest('li').hasClass('active') || $(this).closest('li').hasClass('disabled')) {
            return false;
        }
        var url = $(this).attr('href');
        $('#comments').load(url).unbind();
        return false;
    });

</script>