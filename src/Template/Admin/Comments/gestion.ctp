<?php if (count($comments) < 1): ?>
    <div class="row comments">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 media boxshadow">
            <div class="media-body text-center">
                Aucun commentaire pour cet article
            </div>
        </div>
    </div>
<?php endif; ?>

<?php foreach ($comments as $comment): ?>
    <div class="row comments">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 media boxshadow">
            <div class="media-left">
                <br>
                <?= $this->Html->image('avatars/40x40/' . h($comment->user->picture_url), ['class' => 'img-circle img-comments']) ?>
            </div>
            <div class="media-body">
                <span class="comment-title"><?= h($comment->name) ?></span>
                <br>
                <span class="comment-sub text-muted">
                    <?php if (h($comment['created']) !== h($comment['modified'])): ?>
                        Modifié le : <?= h($comment->modified->i18nformat('EEEE dd MMMM YYYY hh:mm:ss')) ?>
                    <?php else: ?>
                        Commenté le : <?= h($comment->created->i18nformat('EEEE dd MMMM YYYY hh:mm:ss')) ?>
                    <?php endif; ?>
                    - Par : <?= $this->Html->link(h($comment->user->username), ['controller' => 'Users', 'action' => 'view', $comment->user->id, toUrl(h($comment->user->username))], ['class' => 'description']) ?>
                    <!-- pop-up -->
                        <div class="panel panel-success description-box boxshadow collapse">
                            <div class="panel-heading text-center">Informations</div>
                            <div class="panel-body">
                                <label>Prénom : </label> <?= h($comment->user->firstname) ?>
                                <br>
                                <label>Email : </label> <?= h($comment->user->email) ?>
                                <?= $this->Html->image('avatars/200x200/' . h($comment->user->picture_url), ['class' => 'img-responsive img-circle center-block']) ?>
                            </div>
                        </div>
                    </span>
                <div class="likes">
                    <?php $likes = ['up' => 0, 'down' => 0];
                    $canVote = true;
                    foreach ($comment->likes as $like) {
                        if ($like->state) {
                            $likes['up'] += 1;
                        } else {
                            $likes['down'] += 1;
                        }
                        // verification : if an user has already liked a comment, he can't again
                        if ($like->user_id == $this->request->session()->read('Auth.User.id') && $like->comment_id == $comment->id) {
                            $canVote = false;
                        }
                    }
                    ?>
                    <?= ($canVote && $this->request->session()->read('Auth.User.id') !== null) ? $this->Form->postLink('<span class="glyphicon glyphicon-thumbs-up"></span> J\'aime (' . $likes['up'] . ')', ['controller' => 'Likes', 'action' => 'thumb', $comment->id, 1], ['escape' => false, 'class' => 'btn btn-xs btn-success']) : '<span class="btn btn-xs btn-success"><span class="glyphicon glyphicon-thumbs-up"></span>' . ' (' . $likes['up'] . ') ont aimé</span>' ?>
                    -
                    <?= ($canVote && $this->request->session()->read('Auth.User.id') !== null) ? $this->Form->postLink('<span class="glyphicon glyphicon-thumbs-down"></span> Je n\'aime pas (' . $likes['down'] . ')', ['controller' => 'Likes', 'action' => 'thumb', $comment->id, 1], ['escape' => false, 'class' => 'btn btn-xs btn-danger']) : '<span class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-thumbs-down"></span>' . ' (' . $likes['down'] . ') n\'ont pas aimé</span>' ?>
                </div>
                <p><?= h($comment->content) ?></p>
            </div>
            <?php if ($this->request->session()->read('Auth.User.role_id') == 1): ?>
                <div class="media-right">
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span>', ['controller' => 'Comments', 'action' => 'delete', 'prefix' => 'admin', $comment->id], ['confirm' => 'Supprimer ce commentaire ?', 'class' => 'btn btn-sm btn-danger', 'escape' => false]) ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
<?php endforeach; ?>
<div class="paginator text-center">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ') ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(' >') ?>
    </ul>
</div>
