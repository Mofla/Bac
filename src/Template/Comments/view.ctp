<?= $this->layout = false ?>
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
                <div class="comment-content">
                    <span class="comment-title"><?= h($comment->name) ?></span>
                    <br>
                    <span class="comment-sub text-muted">
                    <?php if (h($comment['created']) !== h($comment['modified'])): ?>
                        Modifié le : <?= h($comment['modified']) ?>
                    <?php else: ?>
                        Commenté le : <?= h($comment['created']) ?>
                    <?php endif; ?>
                        - Par : <?= $this->Html->link(h($comment->user->username), ['controller' => 'Users', 'action' => 'view', $comment->user->id, toUrl(h($comment->user->username))]) ?>
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
                        <?= ($canVote && $this->request->session()->read('Auth.User.id') !== null) ? $this->Form->postLink('<span class="glyphicon glyphicon-thumbs-down"></span> Je n\'aime pas (' . $likes['down'] . ')', ['controller' => 'Likes', 'action' => 'thumb', $comment->id, 0], ['escape' => false, 'class' => 'btn btn-xs btn-danger']) : '<span class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-thumbs-down"></span>' . ' (' . $likes['down'] . ') n\'ont pas aimé</span>' ?>
                    </div>
                    <p><?= h($comment->content) ?></p>
                </div>

                <div class="comment-edit collapse">

                </div>
            </div>
            <?php if ($this->request->session()->read('Auth.User.role_id') == 1 || $this->request->session()->read('Auth.User.id') == $comment->user_id): ?>
                <div class="media-right">
                    <br>
                    <button class="btn btn-xs btn-danger btn-comment-no-edit collapse"><span
                            class="glyphicon glyphicon-edit"></span></button>
                    <button id="<?= $comment->id ?>" class="btn btn-xs btn-primary btn-comment-edit"><span
                            class="glyphicon glyphicon-edit"></span></button>
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span>', ['controller' => 'Comments', 'action' => 'delete', 'prefix' => 'admin', $comment->id], ['confirm' => 'Supprimer ce commentaire ?', 'class' => 'btn btn-xs btn-danger', 'escape' => false]) ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
<?php endforeach; ?>
<div class="text-center">
    <div class="text-center">
        <ul class="pagination pagination-large">
            <?php
            echo $this->Paginator->prev('< ', [], null, ['class' => 'disabled']);
            echo $this->Paginator->numbers(['class' => 'numbers']);
            echo $this->Paginator->next(' >', [], null, ['class' => 'disabled']);
            ?>
        </ul>
    </div>
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
    $('.btn-comment-edit').unbind().bind('click', function () {
        var btn = $(this);
        var id = $(this).attr('id');
        $.ajax({
            type: "GET",
            url: "<?= $this->Url->build(['controller' => 'Comments', 'action' => 'edit']) ?>",
            data: {id: id},
            success: function (data) {
                btn.closest('.media').find('.comment-content').fadeOut(100);
                btn.closest('.media').find('.comment-edit').html(data).fadeIn(100);
                btn.hide().prev('.btn-comment-no-edit').show();
            }
        })
    });

    $('.btn-comment-no-edit').unbind().bind('click', function () {
        $(this).closest('.media').find('.comment-edit').fadeOut(100).empty();
        $(this).closest('.media').find('.comment-content').fadeIn(100);
        $(this).hide().next('.btn-comment-edit').show();
    });
</script>
