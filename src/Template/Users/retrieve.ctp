<?php if($validateForm == null): ?>
    <div class="row">
        <div class="col-xs-12 col-md-6 col-md-offset-3">
            <div class="well form-group">
                <?= $this->Form->create($user) ?>
                <fieldset>
                    <legend class="text-center">Indiquez votre mail</legend>
                    <?= $this->Form->input('email',['label' => 'Email','class' => 'form-control']) ?>
                </fieldset>
                <br>
                <div class="text-center">
                    <?= $this->Form->submit('Envoyer',['class' => 'btn btn-lg btn-success']); ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
            <hr>
            <div class="well text-center">
                Mot de passe oublié ? <?= $this->Html->link('cliquez ici',['action' => 'retrieve']) ?>
                <br>
                Pas encore membre ? <?= $this->Html->link('cliquez ici',['action' => 'register']) ?>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="row">
        <div class="col-xs-12 col-md-6 col-md-offset-3">
            <div class="well form-group">
                Un mail contenu un nouveau password a été envoyé à votre adresse mail.
            </div>
        </div>
    </div>
<?php endif; ?>


