
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
        if(isset($_POST['btnRegistrame']) && (empty($_POST['txtName']) || empty($_POST['txtEmail']) || empty($_POST['txtPassword']))){
            $ifSend = false;
            $message = "Debes llenar todos los campos";
        }
        else if(isset($_POST['btnRegistrame'])&& !isset($_POST['rbnGender']) ){
            $ifSend=false;
            $message="Debes seleccionar tu sexo";
        }else if(isset($_POST['btnRegistrame'])&& ($_POST['year']=="0000" || $_POST['month']=="00" || $_POST['day']=="00")){
             $ifSend=false;
            $message="Debes seleccionar tu fecha";
        }else if(!preg_match("^([0-9a-zA-Z]([-\.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$", $_POST['textEmail'])){
            $message="Correo invalido";
            $isSend=false;
        }
        else if($ifSend){
            $personalUser->save();
        }
           
    }else if(isset($_POST['btnEntrar'])){
        $email=$_POST['username'];
        $password=$_POST['password'];

             $personalUser->authenticateUser($email, $password);
        if($personalUser->authenticated==true){
            header("Location:Bienvenido.php");
        }else if(isset($_POST['btnEntrar'])&& empty($_POST['username'])|| empty($_POST['password'])){
            $messageLogin="Debes introducir correo y contraseña";
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
				<input type="text" name="searchText" class="searchText" placeholder="Busqueda..."/>
			</form>
		</div>
		<!--LOGO-->
		<div id="logo"> <a href="#"><img src="images/logo.png" /></a> </div>
		<!--END LOGO-->
		<!--Login Form-->
                <form id="formLogin" name="formLogin" method="POST" action="">
                    <div id="login">
                            <ul class="itemsLoginTop">
                                    <li><a href="#">¿Se te olvidó la clave?</a></li>
                                    <li class="last"><a href="#">Ayuda</a></li>
<!--                                    <div class="clear"></div>-->
                            </ul>
                            <!--Elements Related to the LOGIN FORM-->
                            <ul class="itemsLogin">
                                    <li> <span>
                                            <input type="checkbox" name="active" id="active" class="active" />
                                            <label for="active">Mantener mi sesión activada</label>
                                            </span>
                                            <input type="text" name="username" class="user" placeholder="Correo Electrónico" />
                                    </li>
                                    <li>
                                            <input type="password" name="password" class="pass" placeholder="Contraseña" />
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
				<li class="entertainment border-radius10 last"><a href="#" class="escaleHover1dot15 transition-dot5"></a></li>
				<li class="business border-radius10 "><a href="#" class="escaleHover1dot15 transition-dot5"></a></li>
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
                                <input type="text" id="textName" class="textReg border-radius10" name="txtName"/>
				<label for="textEmail"><b>Correo Electrónico</b></label>
				<input type="text" id="textEmail" class="textReg border-radius10" name="txtEmail"/>
				<label for="textPass"><b>Introduzca su contraseña</b></label>
				<input type="password" id="textPass" class="textReg border-radius10" name="txtPassword"/>
				<label for="textPassAgain"><b>Introduzca de nuevo su contraseña</b>
				<input type="password" id="textPassAgain" class="textReg border-radius10" name="txtPassAgain"/>
                                </label>
				<div><strong>¿Cuál es tu sexo?</strong>
					<input type="radio" name="rbnGender" value="Mujer" id="female" class="sexReg" />
					<label for="female" class="sexReg">Mujer</label>
					<input type="radio" name="rbnGender" value="Hombre" id="male" clas="sexReg" />
					<label for="male" class="sexReg"> Hombre</label>
				</div>
				<div class="birthDate"><strong>Fecha de Nacimiento</strong></div>
				<div>
					<select name="day">
						<option value="00">Día:</option>
						<option value="01">1</option>
						<option value="02">2</option>
						<option value="03">3</option>
						<option value="04">4</option>
						<option value="05">5</option>
						<option value="06">6</option>
						<option value="07">7</option>
						<option value="08">8</option>
						<option value="09">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
						<option value="21">21</option>
						<option value="22">22</option>
						<option value="23">23</option>
						<option value="24">24</option>
						<option value="25">25</option>
						<option value="26">26</option>
						<option value="27">27</option>
						<option value="28">28</option>
						<option value="29">29</option>
						<option value="30">30</option>
						<option value="31">31</option>
					</select>
					<select name="month">
						<option value="00">Mes:</option>
						<option value="01">enero</option>
						<option value="02">febrero</option>
						<option value="03">marzo</option>
						<option value="04">abril</option>
						<option value="05">mayo</option>
						<option value="06">junio</option>
						<option value="07">julio</option>
						<option value="08">agosto</option>
						<option value="09">septiembre</option>
						<option value="10">octubre</option>
						<option value="11">noviembre</option>
						<option value="12">diciembre</option>
					</select>
					<select name="year">
						<option value="0000">Año:</option>
						<option value="2012">2012</option>
						<option value="2011">2011</option>
						<option value="2010">2010</option>
						<option value="2009">2009</option>
						<option value="2008">2008</option>
						<option value="2007">2007</option>
						<option value="2006">2006</option>
						<option value="2005">2005</option>
						<option value="2004">2004</option>
						<option value="2003">2003</option>
						<option value="2002">2002</option>
						<option value="2001">2001</option>
						<option value="2000">2000</option>
						<option value="1999">1999</option>
						<option value="1998">1998</option>
						<option value="1997">1997</option>
						<option value="1996">1996</option>
						<option value="1995">1995</option>
						<option value="1994">1994</option>
						<option value="1993">1993</option>
						<option value="1992">1992</option>
						<option value="1991">1991</option>
						<option value="1990">1990</option>
						<option value="1989">1989</option>
						<option value="1988">1988</option>
						<option value="1987">1987</option>
						<option value="1986">1986</option>
						<option value="1985">1985</option>
						<option value="1984">1984</option>
						<option value="1983">1983</option>
						<option value="1982">1982</option>
						<option value="1981">1981</option>
						<option value="1980">1980</option>
						<option value="1979">1979</option>
						<option value="1978">1978</option>
						<option value="1977">1977</option>
						<option value="1976">1976</option>
						<option value="1975">1975</option>
						<option value="1974">1974</option>
						<option value="1973">1973</option>
						<option value="1972">1972</option>
						<option value="1971">1971</option>
						<option value="1970">1970</option>
						<option value="1969">1969</option>
						<option value="1968">1968</option>
						<option value="1967">1967</option>
						<option value="1966">1966</option>
						<option value="1965">1965</option>
						<option value="1964">1964</option>
						<option value="1963">1963</option>
						<option value="1962">1962</option>
						<option value="1961">1961</option>
						<option value="1960">1960</option>
						<option value="1959">1959</option>
						<option value="1958">1958</option>
						<option value="1957">1957</option>
						<option value="1956">1956</option>
						<option value="1955">1955</option>
						<option value="1954">1954</option>
						<option value="1953">1953</option>
						<option value="1952">1952</option>
						<option value="1951">1951</option>
						<option value="1950">1950</option>
						<option value="1949">1949</option>
						<option value="1948">1948</option>
						<option value="1947">1947</option>
						<option value="1946">1946</option>
						<option value="1945">1945</option>
						<option value="1944">1944</option>
						<option value="1943">1943</option>
						<option value="1942">1942</option>
						<option value="1941">1941</option>
						<option value="1940">1940</option>
						<option value="1939">1939</option>
						<option value="1938">1938</option>
						<option value="1937">1937</option>
						<option value="1936">1936</option>
						<option value="1935">1935</option>
						<option value="1934">1934</option>
						<option value="1933">1933</option>
						<option value="1932">1932</option>
						<option value="1931">1931</option>
						<option value="1930">1930</option>
						<option value="1929">1929</option>
						<option value="1928">1928</option>
						<option value="1927">1927</option>
						<option value="1926">1926</option>
						<option value="1925">1925</option>
						<option value="1924">1924</option>
						<option value="1923">1923</option>
						<option value="1922">1922</option>
						<option value="1921">1921</option>
						<option value="1920">1920</option>
						<option value="1919">1919</option>
						<option value="1918">1918</option>
						<option value="1917">1917</option>
						<option value="1916">1916</option>
						<option value="1915">1915</option>
						<option value="1914">1914</option>
						<option value="1913">1913</option>
						<option value="1912">1912</option>
						<option value="1911">1911</option>
						<option value="1910">1910</option>
						<option value="1909">1909</option>
						<option value="1908">1908</option>
						<option value="1907">1907</option>
						<option value="1906">1906</option>
						<option value="1905">1905</option>
					</select>
				</div>
				<div class="privateRegText"> Al hacer clic en <strong>"Regístrate"</strong> estas de acuerdo con nuestras condiciones y aceptas haber leído y comprendido nuestra <a href="#">Política de Privacidad</a> </div>
                                <input type="submit" id="btnRegistrame" name="btnRegistrame" class="submitReg gradients-button-register" value="¡Regístrame!" />
                                <?php if(!$ifSend){echo "<div class='msgError'><div class='bothContainer'><img src='Images/icons/warning.png' alt='Alert'/><label>{$message}</label></div></div>";} ?>  
			</form>
		</section>
		<!-- END REGISTER Box Right-->
		
	</section>
	<!--Footer OF SITE-->
	<footer id="footer" class="shadow-slow1">
		<nav>
			<ul>
				<li class="eoCopy"><a href="#">© EOTrailer 2012. </a></li>
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
