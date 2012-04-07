<?php 
include 'Entity/PersonalUserEO.php';
    $personalUser = new PersonalUser();
    $ifSend = true;
    $message="";
    $messageLogin="";
    if(isset($_POST['btnRegistrame'])){
        $personalUser->userName=mysql_real_escape_string(trim($_POST['txtName']));
        $personalUser->email=mysql_real_escape_string(trim($_POST['txtEmail']));
        $personalUser->password=mysql_real_escape_string(trim($_POST['txtPassword']));
        $personalUser->gender=isset($_POST['rbnGender'])?$_POST['rbnGender']:false;
        $personalUser->birthday= mysql_real_escape_string(trim($_POST['year'].$_POST['month'].$_POST['day']));
        if(isset($_POST['btnRegistrame']) && (empty($_POST['txtName']) || empty($_POST['txtEmail']))){
            $ifSend = false;
            $message = "Debes llenar todos los campos";
        }else if(isset($_POST['btnRegistrame'])&& $_POST['txtPassword']!=$_POST['txtPassAgain']){
            $ifSend=false;
            $message="Las contrase&ntilde;as son desiguales";
        }else if(isset($_POST['btnRegistrame'])&& empty($_POST['txtPassword']) || empty($_POST['txtPassAgain'])){
            $ifSend=false;
            $message="Debes llenar todos los campos";
        }else if(isset($_POST['btnRegistrame'])&& !isset($_POST['rbnGender']) ){
            $ifSend=false;
            $message="Debes seleccionar tu sexo";
        }else if(isset($_POST['btnRegistrame'])&& ($_POST['year']=="0000" || $_POST['month']=="00" || $_POST['day']=="00")){
             $ifSend=false;
            $message="Debes seleccionar tu fecha";
        }else if(trim($_POST['txtEmail'])!=""&& !preg_match("/^([0-9a-zA-Z]([-\.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$/", $_POST['txtEmail'])){
            $message="Correo invalido";
            $ifSend=false;
        }
        else if($ifSend){
            $personalUser->save();
            //redireccionamiento de la pagina....!! wilkin polla...
        }
           
    }else if(isset($_POST['btnEntrar'])&& empty($_POST['username'])|| empty($_POST['password'])){
            $messageLogin="Debes introducir correo y contraseña";
            
      }else if(isset($_POST['btnEntrar'])){
        $email=$_POST['username'];
        $password=$_POST['password'];
            
        $personalUser->authenticateUser($email, $password);
        
        if($personalUser->authenticated==true){
            header("Location:Bienvenido.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=500, initial-scale=1">
<title>EOTrailer ::: Tu red</title>

<!--Cascading StyleSheet CSS NO TOCAR AL MENOS QUE SEA NECESARIO, esto incluye el fichero que nimporta a su vez los ficheros .css-->
<link href="css/general.css" rel="stylesheet" />

<!--Script Javascript NO SE DEBEN TOCAR A MENOS QUE SEA NECESARIO-->
<script src="scripts/jquery-1.7.2.min.js"></script>
<script src="scripts/modernizr-2.5.3.js"></script>
<script src="scripts/effect.js"></script>
<!--END Script Javascript-->
<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {filter: none;}
  </style>
<![endif]-->
</head>
<body>
<!--Container main content structure-->
<div id="container">	
	<!--FESTIVE Day IMAGE BACKGROUND-->
	<div class="backImg"><img src="images/imagenes/002.jpg" alt="Steve Jobs" /></div>
	<!--END FESTIVE Day IMAGE BACKGROUND-->
	<!--Header container-->
        <!--Esas clases son las culpables de la transparencia-->
	<header id="header" class="gradients-gray shadow-slow1">
		<div id="search">
			<form>
                            <input type="text" name="searchText" class="searchText" placeholder="B&uacute;squeda..."/>
			</form>
		</div>
		<!--LOGO-->
		<div id="logo"> <a href="#"><img src="images/logo.png" /></a> </div>
		<!--END LOGO-->
		<!--Login Form-->
                <form id="formLogin" name="formLogin" method="POST" action="">
                    <div id="login">
                            <ul class="itemsLoginTop">
                                <li><a href="#">¿Se te olvid&oacute; la clave?</a></li>
                                    <li class="last"><a href="#">Ayuda</a></li>
<!--                                    <div class="clear"></div>-->
                            </ul>
                            <!--Elements Related to the LOGIN FORM-->
                            <ul class="itemsLogin">
                                    <li> <span>
                                            <input type="checkbox" name="active" id="active" class="active" />
                                            <label for="active">Mantener mi sesi&oacute;n activada</label>
                                            </span>
                                            <input type="text" name="username" class="user" placeholder="Correo Electr&oacute;nico" />
                                    </li>
                                    <li>
                                        <input type="password" name="password" class="pass" placeholder="Contrase&ntilde;a" />
                                    </li>
                                   
                                    <li>  <button class="tranparent" type="submit" id="btnEntrar" name="btnEntrar"> <img src="images/icons/iconLogin.png"/></buton> </li>
                                    <div class="clear"></div>
                            </ul>  
                            
                            <!--END Elements Related to the LOGIN FORM-->
                    </div>
                    <?php if(isset($_POST['btnEntrar'])  && empty($_POST['username']) || empty($_POST['password'])){echo "<label class='logError'>{$messageLogin}</label>";} ?>
                </form>    
		<!--End Login Form-->
		<div class="clear"></div>
	</header>
	<!--END Header container-->
	<!--FESTIVE Day Message-->
	<div id="msgDay" class="shadow-slow3" hidden="hidden"><strong>Muere steve jobs</strong>, Les informa <b>EOTrailer</b>
	</div>
	<!--END FESTIVE Day Message-->
	
	<!--BANNERS footer Ads-->
		
	<section id="sliderHomeBanners">
			<ul>
				<li><img src="images/imagenes/003.jpg" /></li>
				<li><img src="images/imagenes/003.jpg" /></li>
				<li><img src="images/imagenes/003.jpg" /></li>
				<li><img src="images/imagenes/003.jpg" /></li>
				<li><img src="images/imagenes/003.jpg" /></li>
				<div class="clear"></div>
			</ul>
	</section>
	<!--END BANNERS footer Ads-->
	<section id="content">
		<!--Four(4) section Eotrailer (Business, Entertaiment, Personal and Community ) -->		
		<section id="eoThemes" class="border-radius10">
			<ul>
				<li class="profile border-radius10"><a href="#" class="escaleHover1dot15 transition-dot5"></a></li>
				<li class="business border-radius10 "><a href="#" class="escaleHover1dot15 transition-dot5"></a></li>
				<li class="entertainment border-radius10 last"><a href="#" class="escaleHover1dot15 transition-dot5"></a></li>
				<li class="comunity border-radius10 last"><a href="#" class="escaleHover1dot15 transition-dot5"></a></li>
				<div class="clear"></div>
			</ul>
		</section>
		<!--REGISTER Box Right-->
		<section id="register" class="shadow-slow2 border-radius10<?php if($ifSend){echo ' noError';}else{echo ' onError';} ?>">
                    <form action="" method="POST">
				<h2>Registrate!</h2>
				<span class="descReg">Forma parte de <b>EOTrailer</b> y disfruta con tus amigos!</span>
				<label for="textName"><b>Nombre</b></label>
                                <input type="text" id="textName" class="textReg border-radius10" name="txtName" value="<?php echo $personalUser->userName; ?>"/>
                                <label for="textEmail"><b>Correo Electr&oacute;nico</b></label>
				<input type="text" id="textEmail" class="textReg border-radius10" name="txtEmail" value="<?php echo $personalUser->email; ?>"/>
                                <label for="textPass"><b>Introduzca su contrase&ntilde;a</b></label>
				<input type="password" id="textPass" class="textReg border-radius10" name="txtPassword" value="<?php echo $personalUser->password; ?>"/>
                                <label for="textPassAgain"><b>Introduzca de nuevo su contrase&ntilde;a</b>
				<input type="password" id="textPassAgain" class="textReg border-radius10" name="txtPassAgain" value="<?php echo $personalUser->password; ?>"/>
                                </label>
                                <div><strong>¿Cu&aacute;l es tu sexo?</strong>
					<input type="radio" name="rbnGender" value="Mujer" id="female" class="sexReg" <?php echo ($personalUser->gender=="Mujer")?"checked":""?> />
					<label for="female" class="sexReg">Mujer</label>
					<input type="radio" name="rbnGender" value="Hombre" id="male" clas="sexReg" <?php echo ($personalUser->gender=="Hombre")?"checked":""?>/>
					<label for="male" class="sexReg"> Hombre</label>
				</div>
				<div class="birthDate"><strong>Fecha de Nacimiento</strong></div>
				<div>
                                    <!--asd-->
					<select name="day">                  
                                            <option value="00">Día:</option>
					 <?php
                                        $fechaInicio="1";
                                        $fechaFin= "31";

                                        for($i=$fechaInicio; $i<=$fechaFin; $i++){
                                            $day=substr($personalUser->birthday, 6,8);
                                            if($day==$i && $i<=9 ){                                                                                                          
                                            echo"<option value='0{$i}' selected> ".$i."</option>";                                                 
                                            }else if($day==$i && $i>9){
                                                echo"<option value='{$i}' selected> ".$i."</option>"; 
                                            }else if($day!=$i || $i>9 ){                                                     
                                                echo"<option value='{$i}'> ".$i."</option>";   
                                            }
                                        }                                                                                   
                                        ?>
					</select>
					<select name="month">
                                                <option value="00">Mes:</option>
                                              <?php
                                              $month=substr($personalUser->birthday, 4,-2);
                                              ?>
						<option value="01" <?php echo ($month=="01")? "selected":'';?>>Enero</option>
						<option value="02" <?php echo($month=="02")? "selected":'';?>>Febrero</option>
						<option value="03" <?php echo($month=="03")? "selected":'';?>>Marzo</option>
						<option value="04" <?php echo($month=="04")? "selected":'';?>>Abril</option>
						<option value="05" <?php echo($month=="05")? "selected":'';?>>Mayo</option>
						<option value="06" <?php echo($month=="06")? "selected":'';?>>Junio</option>
						<option value="07" <?php echo($month=="07")? "selected":'';?>>Julio</option>
						<option value="08" <?php echo($month=="08")? "selected":'';?>>Agosto</option>
						<option value="09" <?php echo($month=="09")? "selected":'';?>>Septiembre</option>
						<option value="10" <?php echo($month=="10")? "selected":'';?>>Octubre</option>
						<option value="11" <?php echo($month=="11")? "selected":'';?>>Noviembre</option>
						<option value="12" <?php echo($month=="12")? "selected":'';?>>Diciembre</option>
					</select>
					<select name="year">
				    <option value="0000">Año:</option>
                                           <?php
                                            $fechaInicio="1910";
                                            $fechaFin= "2012";
                                            
                                                for($i=$fechaInicio; $i<=$fechaFin; $i++){
                                                    $year=substr($personalUser->birthday, 0,4);
                                                    if($year==$i){                                                                                                          
                                                    echo"<option value='{$i}' selected> ".$i."</option>";                                                 
                                                    }else {
                                                         echo"<option value='{$i}'> ".$i."</option>";                                                                                                         
                                                    }
                                                }                                                                                   
                                               ?>
					</select>
				</div>
                                <div class="privateRegText"> Al hacer clic en <strong>"Regístrate"</strong> estas de acuerdo con nuestras condiciones y aceptas haber le&iacute;ado y comprendido nuestra <a href="#">Política de Privacidad</a> </div>
                                <input type="submit" id="btnRegistrame" name="btnRegistrame" class="submitReg gradients-button-register" value="¡Reg&iacute;strame!" />
                                <?php if(!$ifSend){echo "<div class='msgError'><div class='bothContainer'><img src='Images/icons/warning.png' alt='Alert'/><label>{$message}</label></div></div>";} ?>  
			</form>
		</section>
		<!-- END REGISTER Box Right-->
		
	</section>
	<!--Footer OF SITE-->
	<footer id="footer" class="shadow-slow1">
		<nav>
			<ul>
                            <li class="eoCopy"><a href="#">&copy; EOTrailer 2012. </a></li>
				<li><a href="#">Sobre nosotros</a></li>
				<li><a href="#">Ayuda</a></li>
				<li><a href="#">Blog</a></li>
				<li><a href="#">Móvil</a></li>
				<li><a href="#">Estado</a></li>
				<li><a href="#">Trabajos</a></li>
				<li><a href="#">Condiciones</a></li>
				<li><a href="#">Privacidad</a></li>
				<li><a href="#">Publicidad</a></li>
				<li><a href="#">Negocios</a></li>
				<li><a href="#">Media</a></li>
				<li><a href="#">Desarrolladores</a></li>
				<li><a href="#">Recursos</a></li>
				<div class="clear"></div>
			</ul>
		</nav>
	</footer>
	<!--END Footer OF SITE-->
</div>
<!-- END Container main content structure-->
</body>
</html>