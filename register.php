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
	                <h3 class="opacity">REGISTER</h3>
	                <form method="post" enctype="multipart/form-data">
	                    <input type="text" placeholder="USERNAME" name="user" />
	                    <input type="password" name="pass" placeholder="PASSWORD" />
	                    <input type="file" name="image" />
	                    <button class="opacity" name="btnsub">SUBMIT</button>
	                </form>
	                <div class="register-forget opacity">
	                    <a href="login.php">LOGIN</a>
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

<?php
include 'db.php';
global $con;

if (isset($_POST['btnsub'])) {
    $name = $_POST['user'];
    $password = $_POST['pass'];
    $img = $_FILES['image']['name'];
    $temp = $_FILES['image']['tmp_name'];

    if (move_uploaded_file($temp, 'images/' . $img)) {
        $query = "INSERT INTO `admin` (username, password, image) VALUES ('$name','$password','$img')";
        $run = mysqli_query($con, $query);

        if ($run) {
            echo "Registration successful!";
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Error uploading image.";
    }
}
?>