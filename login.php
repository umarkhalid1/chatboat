<?php
  include 'db.php';
  global $con;

  $count=0;
  if (isset($_POST['btnsub'])) {
   $user = $_POST['user'];
   $password = $_POST['pass'];

   $query = "SELECT * FROM `admin` WHERE username = '$user' and password = '$password'"; 
   $run = mysqli_query($con, $query);
   if ($row = mysqli_fetch_array($run)) {
     $count++;
   }
    if ($count==1) {
      session_start();
      $_SESSION["user"] = $user;
      header("location:index.php");
    }else{
      echo'<h3>'. "Something Went Wrong Please Enter Right Information".'</h3>';
    }
  }

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="images/logo.png" rel="icon">
	<link rel="stylesheet" type="text/css" href="login.css">
	<title>CodeWhisper</title>
</head>
<body>
	<body>
	    <section class="container">
	        <div class="login-container">
	            <div class="circle circle-one"></div>
	            <div class="form-container">
	                <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
	                <h1 class="opacity">Login</h1>
	                <form method="post">
	                    <input type="text" placeholder="USERNAME" name="user" />
	                    <input type="password" placeholder="PASSWORD" name="pass" />
	                    <button class="opacity" name="btnsub">SUBMIT</button>
	                </form>
	                <div class="register-forget opacity">
	                    <a href="register.php">REGISTER</a>
	                </div>
	            </div>
	            <div class="circle circle-two"></div>
	        </div>
	        <div class="theme-btn-container"></div>
	    </section>
	</body>
	<script type="text/javascript">
		const themes = [
	    {
	        background: "#1A1A2E",
	        color: "#FFFFFF",
	        primaryColor: "#0F3460"
	    },
	    {
	        background: "#461220",
	        color: "#FFFFFF",
	        primaryColor: "#E94560"
	    },
	    {
	        background: "#192A51",
	        color: "#FFFFFF",
	        primaryColor: "#967AA1"
	    },
	    {
	        background: "#F7B267",
	        color: "#000000",
	        primaryColor: "#F4845F"
	    },
	    {
	        background: "#F25F5C",
	        color: "#000000",
	        primaryColor: "#642B36"
	    },
	    {
	        background: "#231F20",
	        color: "#FFF",
	        primaryColor: "#BB4430"
	    }
	];

	const setTheme = (theme) => {
	    const root = document.querySelector(":root");
	    root.style.setProperty("--background", theme.background);
	    root.style.setProperty("--color", theme.color);
	    root.style.setProperty("--primary-color", theme.primaryColor);
	    root.style.setProperty("--glass-color", theme.glassColor);
	};

	const displayThemeButtons = () => {
	    const btnContainer = document.querySelector(".theme-btn-container");
	    themes.forEach((theme) => {
	        const div = document.createElement("div");
	        div.className = "theme-btn";
	        div.style.cssText = `background: ${theme.background}; width: 25px; height: 25px`;
	        btnContainer.appendChild(div);
	        div.addEventListener("click", () => setTheme(theme));
	    });
	};

	displayThemeButtons();

	</script>
</body>
</html>

