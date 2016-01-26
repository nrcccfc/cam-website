<ul class="nav navbar-nav">
    <li><?= $this->Html->link('Home', '/') ?></li>
    <?php if($this->Session->check('Auth.User')): ?>
    <li><?= $this->Html->link('Announcements', ['controller'=>'Announcements', 'action'=>'index']) ?></li>
    <li><?= $this->Html->link('Members', ['controller'=>'Members', 'action'=>'index']) ?></li>
    <li><?= $this->Html->link('Domains', ['controller'=>'Domains', 'action'=>'index']) ?></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Prestige <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li><?= $this->Html->link('PrestigeCategories', ['controller'=>'PrestigeCategories', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link('PrestigeTypes', ['controller'=>'PrestigeTypes', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link('PrestigeItems', ['controller'=>'PrestigeItems', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link('PrestigeLogs', ['controller'=>'PrestigeLogs', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link('MembershipClasses', ['controller'=>'MembershipClasses', 'action'=>'index']) ?></li>
        </ul>
    </li>
    <li>
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Misc <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li class="dropdown-header">Internal</li>
            <li><?= $this->Html->link('Games', ['controller'=>'Games', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link('Affiliates', ['controller'=>'Affiliates', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link('DomainTypes', ['controller'=>'DomainTypes', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link('Continuities', ['controller'=>'Continuities', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link('Venues', ['controller'=>'Venues', 'action'=>'index']) ?></li>
            <li class="divider"></li>
            <li class="dropdown-header">Security</li>
            <li><?= $this->Html->link('Assignments', ['controller'=>'Assignments', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link('Roles', ['controller'=>'Roles', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link('Resources', ['controller'=>'Resources', 'action'=>'index']) ?></li>
            <li class="divider"></li>
            <li class="dropdown-header">Published Content</li>
            <li><?= $this->Html->link('Publishers', ['controller'=>'Publishers', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link('Books', ['controller'=>'Books', 'action'=>'index']) ?></li>
        </ul>
    </li>
    <?php endif; ?>
</ul>
<ul class="nav navbar-nav navbar-right">
    <?php
        if( $this->Session->check('Auth.User')){
            $member = $this->Session->read('Auth.User');
    ?>
        <li><span class="navbar-text">Logged in as <?= $this->Html->link($member['username'], ['controller'=>'Members', 'action'=>'view', $member['id']]) ?></span></li>
        <li><?= $this->Html->link('Logout', ['controller'=>'Members', 'action'=>'logout']) ?></li>
    <?php
        } else {
    ?>
        <li><?= $this->Html->link('Login', ['controller'=>'Members', 'action'=>'login']) ?></li>
        <li><?= $this->Html->link('Register', ['controller'=>'Members', 'action'=>'register']) ?></li>
        <li><?= $this->Html->link('Forgot Password', ['controller'=>'Members', 'action'=>'forgotPassword']) ?></li>
    <?php
        }
    ?>
</ul>