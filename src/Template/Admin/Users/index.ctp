<div class="row">
    <div class="col-xs-12 text-center">
        <h1 class="h1 text-shadow">Utilisateurs</h1>
    </div>
    <div class="col-xs-12 col-md-2">
        <div class="list-group">
            <span class="list-group-item list-group-item-title"><span class="glyphicon glyphicon-user"></span> Utilisateurs</span>
            <?= $this->Html->link('<span class="glyphicon glyphicon-ok-sign text-green"></span> - Actifs','#',['id' => 'btn-actives','class' => 'list-group-item','escape' => false]) ?>
            <?= $this->Html->link('<span class="glyphicon glyphicon-remove-sign text-red"></span> - Inactifs','#',['id' => 'btn-inactives','class' => 'list-group-item','escape' => false]) ?>
            <span class="list-group-item list-group-item-title"><span class="glyphicon glyphicon-th-list"></span> Articles</span>
            <?= $this->Html->link('<span class="glyphicon glyphicon-share text-gold"></span> - Gérer',['controller' => 'Articles','action' => 'index'],['class' => 'list-group-item','escape' => false]) ?>
            <span class="list-group-item list-group-item-title"><span class="glyphicon glyphicon-tags"></span> Catégories</span>
            <?= $this->Html->link('<span class="glyphicon glyphicon-share text-gold"></span> - Gérer',['controller' => 'Tags','action' => 'index'],['class' => 'list-group-item','escape' => false]) ?>
        </div>
    </div>

    <div id="users" class="col-xs-12 col-md-10">

    </div>
</div>

<script>
    $(document).ready(function() {
        callUsersStatus(1);
    });
    $('#btn-actives').on('click',function() {
        callUsersStatus(1);
    });
    $('#btn-inactives').on('click',function() {
        callUsersStatus(0);
    });
    $('#btn-banned').on('click',function() {
        callUsersStatus(2);
    });
    function callUsersStatus(state)
    {
        $.ajax({
            type:"GET",
            url:"<?= $this->Url->build(['action' => 'listajax']) ?>",
            data:{state:state},
            success:function (data) {
                $('#users').hide().delay(100).html(data).show("slide", { direction: "right" }, 600);
            }
        })
    }
</script>