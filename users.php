<?php
//print_r($users);
?>

  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
  	<div class="d-flex">
		<table class="table table-responsive">
			<thead>
				<tr>
					<th>ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Role</th>
					<th>Status</th>
					<th>Created</th>
					<th>Note</th>
					<th>Last Login</th>
					<th>IP</th>
				</tr>
			</thead>
			<tbody>
	  		<?php 
	  		foreach ($usersList as $user):
	  			//foreach ($user as $key=>$val):
	  				//echo "<br>[".$key."] = ".$val;
	  				echo "<tr>";
	  				echo "<td>".$user['userid']."</td>";
	  				echo "<td>".$user['firstname']."</td>";
	  				echo "<td>".$user['lastname']."</td>";
	  				echo "<td>".$user['email']."</td>";
	  				echo "<td>".$user['phone']."</td>";
	  				echo "<td>".$user['role']."</td>";
	  				echo "<td>".$user['status']."</td>";
	  				echo "<td>".$user['createdate']."</td>";
	  				echo "<td>".$user['note']."</td>";
	  				echo "<td>".$user['lastlogin']."</td>";
	  				echo "<td>".$user['ipaddress']."</td>";

	  				echo "</tr>";
	  			//endforeach;
			endforeach;
	  		?>
		  	</tbody>
	  	</table>
  	</div>
  </main>