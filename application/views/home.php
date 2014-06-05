
  
  <!-- start page -->
  <div id="page">
    <div id="page-bgtop">
      
      <div id="front_sidebar1" class="sidebar">
         <h1>Welcome to our site!</h1>
        <h2>What will you find here?</h2>
        <p>A complete information on ... </p>
        <h2>About us?</h2>
        <p>We are one in this industry... </p>
        <h2>Contact Us</h2>
        <p>You can contact us at ... </p>
        <h2>Feedback</h2>
        <p>We will be happy to hear from you..</p>
      </div>

      <!-- start content -->
      <!-- end content -->
      <!-- start sidebars -->
      <div id="front_sidebar2" class="sidebar">
        <ul>
          <li>
            <div><h2>Login ... </h2>
			
			<?php
					if (isset($errorMsg)){ echo "<font color='red'>".$errorMsg ."</font>";}
			?>
			
			<form name="login" action="<?php echo $this->config->item('loginAction');?>" method="post">			
				<table><tr><td>Email</td><td>Password</td><td>&nbsp;</td></tr>
				  <tr>
					<td><label>
					  <input type="text" width="220px" name="email" id="email" />
					</label></td>
					<td><input type="password" name="password" id="password" /></td>
					<td><label>
					  <input type="submit" name="Submit" id="Submit" value="Submit" />
					</label></td>
				  </tr>
				  <tr>
					<td colspan="3">Forgot your password? Click here to get it.</td>
				  </tr>
				</table>
			</form>			
			
            <br />
            </div>
          </li>
        </ul>
        
        
        <ul>
          <li>
            <div><h2>Join us (It's FREE) ...</h2>
			
			<form name="signup" action="<?php echo $this->config->item('f_url_signup');?>" method="post" >		
			
            <table>
              <tr>
                <td><label>First Name</label></td>
                <td><input type="text" name="txt_firstname" id="id_firstname" /></td>
                </tr>
              <tr>
                <td>Last Name</td>
                <td><input type="text" name="txt_lastname" id="id_lastname" /></td>
              </tr>
              <tr>
                <td>Email</td>
                <td><input type="text" name="txt_email" id="id_email" /></td>
              </tr>
              <tr>
                <td>Email (confirm)</td>
                <td><input type="text" name="txt_email_confirm" id="id_email_confirm" /></td>
              </tr>
              <tr>
                <td>Password</td>
                <td><input type="password" name="txt_password" id="id_password" /></td>
              </tr>
              <tr>
                <td>Password (confirm)</td>
                <td><input type="password" name="txt_password_confirm" id="id_password_confirm" /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><label>
                  <input type="submit" name="signup" id="id_signup" value="Register Me!" onCLick="alert('Functionality pending...')" />
                </label></td>
              </tr>
            </table>
			
			</form>			
			
            <br />
            </div>
          </li>
        </ul>
        
        </div>
      <!-- end sidebars -->
      <div style="clear: both;">&nbsp;</div>
      <!-- end page -->
</div>
</div>


