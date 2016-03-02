<nav class="navbar navbar-fixed-top" role="navigation">
	<div class="container">
		<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
		<button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse" type="button">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>

		<?= $this->Html->link(
    		$this->Html->image('logo.png', ['alt' => $cakeDescription, 'border' => '0']), 
    			'/', 
    			['class'=>'navbar-brand', 'escape' => false]
        	)
    	?>
		
		<div class="collapse navbar-collapse navbar-responsive-collapse">
			<ul class="nav navbar-nav">
				<li class="active"><?= $this->Html->link('Home', '/') ?></li>
				<?php if($this->request->session()->check('Auth.User')): ?>
				<li><?= $this->Html->link('Members', ['controller'=>'Members', 'action'=>'index']) ?></li>
    			<li><?= $this->Html->link('Domains', ['controller'=>'Domains', 'action'=>'index']) ?></li>
			    <li class="dropdown">
			        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Prestige <span class="caret"></span></a>
			        <ul class="dropdown-menu" role="menu">
			            <li><?= $this->Html->link('PrestigeCategories', ['controller'=>'PrestigeCategories', 'action'=>'index']) ?></li>
			            <li><?= $this->Html->link('PrestigeTypes', ['controller'=>'PrestigeTypes', 'action'=>'index']) ?></li>
			            <li><?= $this->Html->link('PrestigeItems', ['controller'=>'PrestigeItems', 'action'=>'index']) ?></li>
			            <li><?= $this->Html->link('PrestigeLogs', ['controller'=>'PrestigeLogs', 'action'=>'view']) ?></li>
			            <li><?= $this->Html->link('MembershipClasses', ['controller'=>'MembershipClasses', 'action'=>'index']) ?></li>
			            <li><?= $this->Html->link('Approve Prestige', ['controller'=>'PrestigeLogs', 'action'=>'approve']) ?></li>
			        </ul>
			    </li>
			    <li>
			        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Misc <span class="caret"></span></a>
			        <ul class="dropdown-menu" role="menu">
			            <li class="dropdown-header">Internal</li>
			            <li><?= $this->Html->link('Announcements', ['controller'=>'Announcements', 'action'=>'index']) ?></li>
			            <li><?= $this->Html->link('Affiliates', ['controller'=>'Affiliates', 'action'=>'index']) ?></li>
			            <li><?= $this->Html->link('Books', ['controller'=>'Books', 'action'=>'index']) ?></li>
			            <li><?= $this->Html->link('Continuities', ['controller'=>'Continuities', 'action'=>'index']) ?></li>
			            <li><?= $this->Html->link('Games', ['controller'=>'Games', 'action'=>'index']) ?></li>
			            <li><?= $this->Html->link('DomainTypes', ['controller'=>'DomainTypes', 'action'=>'index']) ?></li>
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
			        </ul><!-- end dropdown-menu -->
		    	</li>
				<?php endif; ?>
			</ul>
			
			<!--
			<form class="navbar-form pull-left">
				<input type="text" class="form-control" placeholder="Search this site..." id="searchInput">
				<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
			</form>
			-->
			<!-- end navbar-form -->
			
			<ul class="nav navbar-nav pull-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> My Account <strong class="caret"></strong></a>
					<?php if($this->request->session()->check('Auth.User')): ?>

					<ul class="dropdown-menu">
						<li><p class="navbar-text"><?=$this->request->session()->read('Auth.User.username'); ?></p></li>

						<li> <?= $this->Html->link(
							'<span class="glyphicon glyphicon-wrench"></span> Settings',
							['controller'=>'Members', 'action'=>'view', $this->request->session()->read('Auth.User.id')], 
							['escape'=>false]) ?> 
						</li>

						<li> <?= $this->Html->link(
							'<span class="glyphicon glyphicon-refresh"></span> Update Profile',
							['controller'=>'Members', 'action'=>'edit', $this->request->session()->read('Auth.User.id')], 
							['escape'=>false]) ?> 
						</li>
						
						<li>
							<a href="#"><span class="glyphicon glyphicon-briefcase"></span> Membership</a>
						</li>
						
						<li class="divider"></li>
						

						<li> <?= $this->Html->link(
							'<span class="glyphicon glyphicon-off"></span> Sign out', 
							['controller'=>'Members', 'action'=>'logout'], 
							['escape'=>false]) ?> 
						</li>
					</ul>
					<?php else: ?>
					<ul class="dropdown-menu">
						<li> <?= $this->Html->link(
							'<span class="glyphicon glyphicon-ok"></span> Sign in', 
							['controller'=>'Members', 'action'=>'login'], 
							['escape'=>false]) ?> 
						</li>
						<li> <?= $this->Html->link(
							'<span class="glyphicon glyphicon-pencil"></span> Register', 
							['controller'=>'Members', 'action'=>'register'], 
							['escape'=>false]) ?> 
						</li>
						<li> <?= $this->Html->link(
							'<span class="glyphicon glyphicon-question-sign"></span> Forgot Password', 
							['controller'=>'Members', 'action'=>'forgotPassword'], 
							['escape'=>false]) ?> 
						</li>
					</ul>
					<?php endif; ?>
				</li>
			</ul><!-- end nav pull-right -->
		</div><!-- end nav-collapse -->
	</div><!-- end container -->
</nav><!-- end navbar -->