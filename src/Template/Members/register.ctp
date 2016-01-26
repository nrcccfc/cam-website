<!-- src/Template/Members/register.ctp -->
<?= $this->Form->create($member, ['class'=> 'form-horizontal']) ?>
    <h2><?= __('Please register') ?></h2>
    <?= $this->Form->input('email') ?>
    <?= $this->Form->input('username') ?>
    <?= $this->Form->input('first_name') ?>
    <?= $this->Form->input('last_name') ?>
    <?= $this->Form->input('domain_id') ?>
    <?= $this->Form->input('password') ?>
    <?= $this->Form->input('password_confirm', ['type'=>'password']) ?>
    <?= $this->Form->button(__('Submit')); ?>
<?= $this->Form->end() ?>