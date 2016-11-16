<div class="row">
    <!-- article -->
    <div class="col-xs-12 col-md-8 col-md-offset-2">
        <div class="panel panel-default boxshadow">
            <div class="panel-heading panel-heading-articles text-center">
                <?= h($article->name) ?>
                <?= $this->Html->link('Editer',['action' => 'edit', $article->id,toUrl(h($article->name))],['class' => 'btn btn-md btn-info']) ?>
            </div>
            <div class="panel-tags">
                <div class="panel-tags-text-left">
                    Posté le : <?= h($article['created']) ?>
                    <?php if(h($article['modified']) !== h($article['created'])): ?>
                        - Modifié le : <?= h($article['modified']) ?>
                    <?php endif; ?>
                </div>
                <div class="panel-tags-text-right">
                    Catégorie :
                    <?= $this->Html->link(h($article->tag->name),['action' => 'index',$article->tag->id,toUrl(h($article->tag->name))]) ?>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12">
                        <?= nl2br(h($article->content)) ?>
                    </div>
                </div>
            </div>
            <div class="panel-footer panel-footer-articles">
                <!-- infos créateur -->
                <div class="row">
                    <div class="col-xs-12">
                        <?= $this->Html->image('avatars/40x40/'.h($article->user->picture_url),['class' => 'img-circle img-articles']) ?>
                        Article publié par <?= $this->Html->link($article->user->username,['controller' => 'Users','action' => 'view','prefix' => false,$article->user->id,toUrl(h($article->user->username))],['class' => 'description']) ?>
                        <!-- pop-up -->
                        <div class="panel panel-success description-box boxshadow collapse">
                            <div class="panel-heading text-center">Informations</div>
                            <div class="panel-body">
                                <label>Prénom : </label> <?= $article->user->firstname ?>
                                <br>
                                <label>Email : </label> <?= $article->user->email ?>
                                <?= $this->Html->image('avatars/200x200/'.h($article->user->picture_url),['class' => 'img-responsive img-circle center-block']) ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <br>
        <?php if($this->request->session()->read('Auth.User.id') != null): ?>
            <div class="text-center">
                <button id="btn-view-comments" class="btn btn-md btn-warning">Voir les commentaires</button>
                <button id="btn-add-comments" class="btn btn-md btn-success">Ajouter un commentaire</button>
                <button id="btn-remove-comments" class="btn btn-md btn-danger collapse">Annuler</button>
            </div>
        <?php endif; ?>
        <br>
        <!-- zone du formulaire d'ajout des commentaires -->
        <div id="add-comments" class="collapse">
            <div class="row">
                <div class="col-xs-12 col-md-6 col-md-offset-3 well boxshadow">
                    <?= $this->Form->create($comment,['id' => 'form']) ?>
                    <?= $this->Form->input('name',['label' => 'Intitulé','class' => 'form-control']) ?>
                    <?= $this->Form->input('content',['label' => 'Message','class' => 'form-control']) ?>
                    <hr>
                    <div class="text-center">
                        <?= $this->Form->button('Commenter',['class' => 'btn btn-md btn-success']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
            <br>
        </div>
        <!-- zone des commentaires -->
        <div id="comments" class="comments">
            <?php foreach ($comments as $comment): ?>
                <div class="row comments collapse">
                    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 media boxshadow">
                        <div class="media-left">
                            <br>
                            <?= $this->Html->image('avatars/40x40/'.h($comment->user->picture_url),['class' => 'img-circle img-comments']) ?>
                        </div>
                        <div class="media-body">
                            <span class="comment-title"><?= h($comment->name) ?></span>
                            <br>
                            <span class="comment-sub text-muted">
                    <?php if(h($comment['created']) !== h($comment['modified'])): ?>
                        Modifié le : <?= h($comment['modified']) ?>
                    <?php else: ?>
                        Commenté le : <?= h($comment['created']) ?>
                    <?php endif; ?>
                                - Par : <?= $this->Html->link(h($comment->user->username),['controller' => 'Users','action' => 'view',$comment->user->id,toUrl(h($comment->user->username))],['class' => 'description']) ?>
                                <!-- pop-up -->
                        <div class="panel panel-success description-box boxshadow collapse">
                            <div class="panel-heading text-center">Informations</div>
                            <div class="panel-body">
                                <label>Prénom : </label> <?= h($comment->user->firstname) ?>
                                <br>
                                <label>Email : </label> <?= h($comment->user->email) ?>
                                <?= $this->Html->image('avatars/200x200/'.h($comment->user->picture_url),['class' => 'img-responsive img-circle center-block']) ?>
                            </div>
                        </div>
                    </span>
                            <div class="likes">
                                <?php $likes = ['up' => 0,'down' => 0];
                                $canVote = true;
                                foreach($comment->likes as $like) {
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
                                <?= ($canVote && $this->request->session()->read('Auth.User.id') !== null) ?  $this->Form->postLink('<span class="glyphicon glyphicon-thumbs-up"></span> J\'aime ('.$likes['up'].')',['controller' => 'Likes','action' => 'thumb',$comment->id,1],['escape' => false,'class' => 'btn btn-xs btn-success'])  : '<span class="btn btn-xs btn-success"><span class="glyphicon glyphicon-thumbs-up"></span>'. ' ('.$likes['up'].') ont aimé</span>' ?>
                                -
                                <?= ($canVote && $this->request->session()->read('Auth.User.id') !== null) ?  $this->Form->postLink('<span class="glyphicon glyphicon-thumbs-down"></span> Je n\'aime pas ('.$likes['down'].')',['controller' => 'Likes','action' => 'thumb',$comment->id,1],['escape' => false,'class' => 'btn btn-xs btn-danger'])  : '<span class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-thumbs-down"></span>'. ' ('.$likes['down'].') n\'ont pas aimé</span>' ?>
                            </div>
                            <p><?= h($comment->content) ?></p>
                        </div>
                        <?php if($this->request->session()->read('Auth.User.role_id') == 1): ?>
                            <div class="media-right">
                                <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span>',['controller' => 'Comments','action' => 'delete','prefix' => 'admin',$comment->id],['confirm' => 'Supprimer ce commentaire ?','class' => 'btn btn-sm btn-danger','escape' => false]) ?>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if(sizeof($article->comments) > 8): ?>
            <div class="paginator text-center">
                <ul class="pagination">
                    <?= $this->Paginator->prev('< ') ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(' >') ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</div>
<br>
<?= $this->Html->script('scripts.js') ?>
<script>
    $(document).on('click','#btn-add-comments',function(){
        $('#add-comments').slideToggle();
        if($('#btn-add-comments').html() == 'Ajouter un commentaire')
        {
            var text = 'Cacher le formulaire';
        }
        else {
            var text = 'Ajouter un commentaire';
        }
        $('#btn-add-comments').html(text);
        $('#btn-add-comments').toggleClass('btn-danger').toggleClass('btn-success');

    });

    $(document).on('click','#btn-view-comments',function(){
        callComments();
    })
    function callComments()
    {
        $.ajax({
            type:"GET",
            url:"<?= $this->Url->build(['controller' => 'Comments','action' => 'view','prefix' => false]) ?>",
            data:{id:<?= intval($article->id) ?>},
            success:function (data) {
                $('#comments').empty().hide().delay(100).html(data).show("slide", { direction: "left" }, 600);
                $('html, body').animate({ scrollTop: $('#comments').offset().top+300 }, 'slow');
            }
        })
    }
</script>