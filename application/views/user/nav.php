<div class="nav-dashboard">
	<h3>Iklan</h3>
    <div>
        <ul>
        	<li class="navv"><?=anchor('post/pasang','Pasang Iklan',array('class'=>'ui'))?></li>
            <li class="navv"><?=anchor('post/active','Iklan Aktif',array('class'=>'ui'))?></li>
            <li class="navv"><?=anchor('post/nonactive','Iklan Non Aktif',array('class'=>'ui'))?></li>
            <li class="navv"><?=anchor('post/rejected','Iklan Ditolak',array('class'=>'ui'))?></li>
        </ul>
    </div>
    
    <h3>Profil</h3>
    <div>
        <ul>
            <li class="navv"><?=anchor(site_url('user/editprofil/'.getUserLogin('UserName')),'Edit Profil',array('class'=>'ui'))?></li>
            <li class="navv"><?=anchor('user/changepassprofile','Ganti Password',array('class'=>'ui'))?></li>
        </ul>
    </div>
    
</div>