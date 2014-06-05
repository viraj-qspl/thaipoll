
		<div id="menu-wrapper">
			<div id="menu">
			  <ul > <!-- note: css for UL and LI is given with respect to its div container, in this case it is "menu" -->
				<li><a href='<?php echo $this->config->item("dashboardBeAction")?>'>Dashboard</a></li>
				<li><a href='<?php echo $this->config->item("userBeAction")?>'>User</a></li>
				<li> | </li>							
				<li><a href='<?php echo $this->config->item("countryBeAction")?>'>Locations</a></li>							
				<li><a href='<?php echo $this->config->item("categoryBeAction")?>'>Categories</a></li>	
				<li> | </li>							
				<li><a href='<?php echo $this->config->item("giftcardBeAction")?>'>GiftCard</a></li>
				<li> | </li>
				<li><a href='<?php echo $this->config->item("logoutBeAction")?>'>Logout</a></li>
			  </ul>			  
			</div>
		</div>
		