<?php 
    session_start();
    include("core/db_config.php");
    include("core/functions.php");
    main_banner(); 

    if (isset($_POST['submit'])) {
       
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password = md5($password);
        if (empty($username) OR empty($password)) {
           $error = 'all fields are required';
        } else{
            $query = $db->get_results("SELECT * FROM admin WHERE username = '$username' AND password = '$password' LIMIT 1");
            foreach ( $query as $result ) {
                $admin_username = $result->username;
                $admin_password = $result->password;
            }

            if ($username == $admin_username && $password == $admin_password) {
                $_SESSION['username'] = $admin_username;
            } else{
                $error = 'wrong login credentials';
            }
        }
    }
?>
<!DOCTYPE HTML>
<html>
<html lang="en">
<head>
    <!--[if IE]>
      <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Prince Ekwe">
    <title>Disease Diagnosis System</title> 
    <link href="css/main.css" rel="stylesheet" type="text/css"/>
    <link href="css/index.css" rel="stylesheet" type="text/css"/>
    <link href="css/banner.css" rel="stylesheet" type="text/css"/>
    <link href="css/slider.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <script src="js/responsiveslides.min.js"></script>
    <script type="text/javascript" src="js/slider.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>

    <script>
      $(".rslides").responsiveSlides({
          speed: 2000,            // Integer: Speed of the transition, in milliseconds
          timeout: 3000,          // Integer: Time between slide transitions, in milliseconds
          before: function(){},   // Function: Before callback
          after: function(){}     // Function: After callback
        });
    </script>
    <div id="content-wrapper">
        <div id="rhs">
            <p><span>What Is Malaria?</span>
                Malaria is a lifethreatening
                disease. It is typically transmitted through the bite of
                an infected Anopheles mosquito. Infected mosquitoes carry the Plasmodium
                parasite. When this mosquito bites you, the parasite is released into your
                bloodstream.
            </p><br/>
			<p><span>What Is Typhoid Fever?</span>
                Typhoid fever is caused by salmonella typhi bacteria. It spreads through 
				contaminated food and water or occasionally through close contact with an 
				infected person. This is common in developing countries and most cases are 
				as a result of poor sanitation.
            </p><br/>
			<p><span>What Is Yellow Fever?</span>
                Yellow Fever is a viral infection spread by a particular specie of mosquito.
				Yellow Fever is an acute viral Haemorrhagic disease transmitted by infected
				mosquitoes. the "Yellow" inthe name refers to the Jaundice that affects some patients.
            </p><br/>
            <p>
                <span>What is Cholera?</span>
                Cholera is an acute diarrhoeal disease that can kill within hours if left untreated.
				Provision of safe water and sanitation is critical to control the transmission of Cholera 
				and other waterborne diseases.
            </p>
        </div>
        <div id="lhs">
            <a id="a-home" class="top-link hide" href="index.php">HOME</a>
            <?php 
                if (isset($_SESSION['username'])) { 
                    $logedin_user = $_SESSION['username'];
                    echo'
                        <nav id="nav_links">
                            <ul>
                                <li id="view-symptom">VIEW SYMPTOMS, LAB REPORT & MEDICAL HISTORY</li> 
                                <li id="add-symptom">ADD SYMPTOM, LAB REPORT & MEDICAL HISTORY</li>
                            </ul>
                        </nav> 
                        <p id="logedin_user">Hello '.$logedin_user.'<a href="signout.php">SIGN OUT</a></p>
                        ';
                } else{
                    echo'<span id="span-signin" class="top-link">ADMIN</span>';
                }
            ?>
            <div id="div-signin" class="hide mid">
                <form id="frm-signin" class="frm" method="post" action="index.php">
                    <h3>Admin Sign In</h3>
                    <label for="username">Username:</label>
                    <input type="text" class="input" id="username" name="username" maxlength="20"/><br/>
                    <label for="password">Password:</label>
                    <input type="password" class="input" id="password" name="password" maxlength="20"/><br/>
                    <input type="submit" name="submit" id="submit" class= "my_button" value="Sign In"/>
                </form>
            </div>
            <div id="div-add-symptom" class="hide mid">
                <h3>Add New Symptom, Medical history or Laboratory Report</h3><br/>
                <form id="frm-add-symptom" class="frm" method="post" action="">
                    <input type="text" class="input" id="txt-symptom" name="txt-symptom"/>
                    <input type="submit" name="submit-symptom" id="submit-symptom" value="Submit"/>
                </form>
            </div>
            <div id="div-view-symptoms" class="hide"><h3>Added Symptoms, Medical History or Laboratory Report</h3><br/><ul id="ul-view-symptoms"></ul></div>
            <div id="cta">START DIAGNOSIS</div>
            <div id="symptoms-wrapper">
                <ul id="ul-symptoms">
                </ul>
                <div id="choice-wrapper">
                    <div id="yes" class="btn-choice">YES</div>
                    <div id="no" class="btn-choice">NO</div>
                    <span class="fake"></span>
                </div>
                <hr/>
                <div id="controls-wrapper">
                    <span id="next" class="my_button">NEXT</span>
                </div>
            </div>
            <span id="btn-result" class="hide my_button">RESULT</span>
            <div id="div-result" class="hide"><p id="p-result"></p><a href="index.php" class="my_button">REFRESH</a></div>
        </div>
        <span class="fake"></span>
    </div>
    
</body>
</html> 
    