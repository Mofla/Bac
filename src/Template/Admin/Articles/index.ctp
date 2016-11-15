<div class="row">
    <div class="col-xs-12 text-center">
        <h1 class="h1 text-shadow">Articles</h1>
    </div>
    <div class="col-xs-12 col-md-2">
        <div class="list-group">
            <span class="list-group-item list-group-item-title"><span class="glyphicon glyphicon-th-list"></span> Articles</span>
            <?= $this->Html->link('<span class="glyphicon glyphicon-send text-green"></span> - Publiés','#',['id' => 'btn-published','class' => 'list-group-item','escape' => false]) ?>
            <?= $this->Html->link('<span class="glyphicon glyphicon-floppy-remove text-red"></span> - Retirés','#',['id' => 'btn-retired','class' => 'list-group-item','escape' => false]) ?>
            <?= $this->Html->link('<span class="glyphicon glyphicon-floppy-disk text-blue"></span> - Brouillons','#',['id' => 'btn-saved','class' => 'list-group-item','escape' => false]) ?>
            <?= $this->Html->link('<span class="glyphicon glyphicon-plus text-gold"></span> - Ajouter un nouvel article',['action' => 'add'],['class' => 'list-group-item','escape' => false]) ?>
            <?= $this->Html->link('<span class="glyphicon glyphicon-tags text-gold"></span> - Gérer les catégories',['controller' => 'Tags','action' => 'index'],['class' => 'list-group-item','escape' => false]) ?>
        </div>
    </div>
    <div id="articles" class="col-xs-12 col-md-10">
    </div>
</div>


<script>
    $(document).ready(function() {
        callArticlesStatus(1);
    });
    $('#btn-saved').on('click',function() {
        callArticlesStatus(0);
    });
    $('#btn-published').on('click',function() {
        callArticlesStatus(1);
    });
    $('#btn-retired').on('click',function() {
        callArticlesStatus(2);
    });
    function callArticlesStatus(state)
    {
        $.ajax({
            type:"GET",
            url:"<?= $this->Url->build(['action' => 'listajax']) ?>",
            data:{state:state},
            success:function (data) {
                $('#articles').hide().delay(100).html(data).show("slide", { direction: "right" }, 600);
            }
        })
    }
</script>
