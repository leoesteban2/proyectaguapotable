<aside class="main-sidebar">

	 <section class="sidebar">

		<ul class="sidebar-menu">
			<?php

			if(strpos($_SESSION["perfil"], "Administrador") !== false || 
			strpos($_SESSION["perfil"], "Secretario") !== false || 
			strpos($_SESSION["perfil"], "Tesorero") !== false){ 

			echo ' <li class="active">

				<a href="inicio">

					<i class="fa fa-home"></i>
					<span>Dashboard</span>

				</a>

			</li>

			';
			}

			?>

			<?php
			if($_SESSION["perfil"] == "Administrador"){ 
			echo '<li>
				<a href="usuarios">

					<i class="fa fa-user"></i>
					<span>Usuarios Sistema</span>

				</a>

			</li>';
		}

			?>

		<?php

		if(strpos($_SESSION["perfil"], "Administrador") !== false || 
			strpos($_SESSION["perfil"], "Secretario") !== false){ 

			echo '<li>


				<a href="usuariosproyecto">

					<i class="fa fa-users"></i>
					<span>Usuarios Proyecto</span>

				</a>

			</li>	

			<li>

				<a href="certificado">

					<i class="fa fa-file"></i>
					<span>Certificados</span>

				</a>

			</li>';
				 }
			?>

				 

			<?php

			if(strpos($_SESSION["perfil"], "Administrador") !== false || 
				strpos($_SESSION["perfil"], "Tesorero") !== false){ 

				echo'<li>
				<a href="tarifas">

				<i class="fa fa-money"></i>
				<span>Tarifas</span>

				</a>

			</li>';
			 }
			 ?>


			<?php

			if(strpos($_SESSION["perfil"], "Administrador") !== false || 
				strpos($_SESSION["perfil"], "Fontanero") !== false){ 

			echo'

			<li> 

				<a href="lectura">

				<i class="fa fa-compass"></i>
				<span>Lecturas</span>

				</a>

			</li>';
				}
			?>


			<?php
			if(strpos($_SESSION["perfil"], "Administrador") !== false || 
			strpos($_SESSION["perfil"], "Tesorero") !== false || 
			strpos($_SESSION["perfil"], "Fontanero") !== false){ 
		
			echo'
			<li> 

				<a href="pagos">

				<i class="fa fa-check-square-o"></i>
				<span>Pagos</span>

				</a>

				</li>';
						}

				?>

			<?php
			if(strpos($_SESSION["perfil"], "Administrador") !== false ||  
			strpos($_SESSION["perfil"], "Tesorero") !== false){ 

				echo'
				<!-- para modulo de cobros y que puede desplegar opciones -->
				<li class="treeview">

				<a href="#">

					<i class="fa fa-list-ul"></i>
					
					<span>Cobros</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="exceso">
							
							<i class="fa fa-circle-o"></i>
							<span>Cobros por Excesos</span>

						</a>

					</li>

					<li>

						<a href="crear-cobros">
							
							<i class="fa fa-circle-o"></i>
							<span>Crear Cobros</span>

						</a>

					</li>

				</ul>

			</li>';

			}
			?>

			

			<?php
			if(strpos($_SESSION["perfil"], "Administrador") !== false ||  
			strpos($_SESSION["perfil"], "Secretario") !== false){ 
			echo '
			<!-- para modulo de CONTADORES y que puede desplegar opciones -->
			<li class="treeview">

				<a href="#">

					<i class="fa fa-dashboard"></i>
					
					<span>Contadores</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="contadores">
							
							<i class="fa fa-circle-o"></i>
							<span>Administrar Contador</span>

						</a>

					</li>

					<li>

						<a href="asignarcontador">
							
							<i class="fa fa-circle-o"></i>
							<span>Asignar Contador</span>

						</a>

					</li>



					</ul>

			</li>';

			}
			?>

			<?php
			if(strpos($_SESSION["perfil"], "Administrador") !== false ||
			strpos($_SESSION["perfil"], "Secretario") !== false ||    
			strpos($_SESSION["perfil"], "Tesorero") !== false){ 

			echo '<li> 

			<a href="estadocuenta">

			<i class="fa  fa-search"></i>
			<span>Estado Cuenta</span>

			</a>

			</li>';

			}


			?>

			<?php
			if(strpos($_SESSION["perfil"], "Administrador") !== false ||
			strpos($_SESSION["perfil"], "Secretario") !== false ||    
			strpos($_SESSION["perfil"], "Tesorero") !== false){ 

			echo'
			<!-- para modulo de Reportes y que puede desplegar opciones -->
			<li class="treeview">

				<a href="#">

					<i class="fa fa-folder"></i>
					
					<span>Reportes</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="reportecobros">
							
							<i class="fa fa-circle-o"></i>
							<span>Cobros Base</span>

						</a>

					</li>

					<li>

						<a href="reportes">
							
							<i class="fa fa-circle-o"></i>
							<span>Cobros por exceso</span>

						</a>

					</li>

					<li>

						<a href="reportepagos">
							
							<i class="fa fa-circle-o"></i>
							<span>Pagos</span>

						</a>

					</li>

					<li>

						<a href="reportelectura">
							
							<i class="fa fa-circle-o"></i>
							<span>Lecturas</span>

						</a>

					</li>



				</ul>

			</li> ';
			}
			?>

		</ul>




	 </section>

</aside>