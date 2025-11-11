<?php
include "connect.php";
$success_message = "Registered";
$error_message = "Not Registered";

$conn = new mysqli("localhost", "root", "", "cs_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $bday = $_POST['bday'];
    $province = $_POST['province'];
    $city = $_POST['city'];
    $barangay = $_POST['barangay'];
    $housenumber = $_POST['housenumber'];
    $program = $_POST['program'];
    $strand = $_POST['strand'];
    $year = $_POST['year'];
    $mobilenumber = $_POST['mobilenumber'];
    $email = $_POST['email'];

    $fatherfname = $_POST['fatherfname'];
    $fatherlname = $_POST['fatherlname'];
    $fathercontact = $_POST['fathercontact'];
    $fatheraddress = $_POST['fatheraddress'];
    $motherfname = $_POST['motherfname'];
    $motherlname = $_POST['motherlname'];
    $parentcontactaddress = $_POST['parentcontactaddress'];
    $parentaddress = $_POST['parentaddress'];

    $guardianfname = $_POST['guardianfname'];
    $guardianlname = $_POST['guardianlname'];
    $guardianaddress = $_POST['guardianaddress'];
    $guardiancontact = $_POST['guardiancontact'];

    $stmt1 = $conn->prepare("INSERT INTO student_info (
        firstname, middlename, lastname, gender, bday,
        province, city, barangay, housenumber, program,
        strand, year, mobilenumber, email
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt1) {
        $stmt1->bind_param("ssssssssssssss",
            $firstname, $middlename, $lastname, $gender, $bday,
            $province, $city, $barangay, $housenumber, $program,
            $strand, $year, $mobilenumber, $email);

        if ($stmt1->execute()) {
            $student_id = $stmt1->insert_id;

            $stmt2 = $conn->prepare("INSERT INTO parents_info (
                student_id, fatherfname, fatherlname, fathercontact, fatheraddress,
                motherfname, motherlname, parentcontactaddress, parentaddress
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt2->bind_param("issssssss", $student_id,
                $fatherfname, $fatherlname, $fathercontact, $fatheraddress,
                $motherfname, $motherlname, $parentcontactaddress, $parentaddress);

            $stmt3 = $conn->prepare("INSERT INTO guardian_info (
                student_id, guardianfname, guardianlname, guardianaddress, guardiancontact
            ) VALUES (?, ?, ?, ?, ?)");

            $stmt3->bind_param("issss", $student_id,
                $guardianfname, $guardianlname, $guardianaddress, $guardiancontact);

            if ($stmt2->execute() && $stmt3->execute()) {
                $success_message = "Form submitted successfully.";
            } else {
                $error_message = "Error inserting parent or guardian info.";
            }

            $stmt2->close();
            $stmt3->close();
        } else {
            $error_message = "Error inserting student info.";
        }

        $stmt1->close();
    } else {
        $error_message = "Statement failed: " . $conn->error;
    }

    $conn->close();
}
?>
    
    

<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="keywords" content="Concepcion Holy Cross College Sta. Rosa, N.E., Inc.">
    <meta name="description" content="Concepcion Holy Cross College Inc. Official Website">
    <meta name="author" content="charles dungo">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Concepcion Holy Cross College, Inc. | Campus Website</title>


    <!-- Favicon -->
    <link rel="shortcut icon" href="http://myclass.holycross.edu.ph/pluginfile.php/1/theme_moove/favicon/1610948264/90x90.ico">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200&display=swap" rel="stylesheet">

    <!-- CSS Global Compulsory (Do not remove)-->
    <link rel="stylesheet" href="flaticon.css">
    <link rel="stylesheet" href="bootstrap.css">
	<link rel="stylesheet" href="3rd.css">
	<link rel="stylesheet" href="tingle.css">

    <!-- Page CSS Implementing Plugins (Remove the plugin CSS here if site does not use that feature)-->
    <link rel="stylesheet" href="corousel.css">
    <link rel="stylesheet" href="popup.css">
    <link rel="stylesheet" href="swiper.css">
    <link rel="stylesheet" href="animate.css">

    <!-- Template Style -->
    <link rel="stylesheet" href="styles.css">
    
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.8.2.js"></script>
    <script type="text/javascript" src="./hcc/tingle.js"></script>
    <script type="text/javascript" src="./hcc/custom.js"></script>
    
    <!--Google-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=campaign" />
    <style>
    
    a {
  overflow: hidden; /* Hide scrollbars */
}
i {
  overflow: hidden; /* Hide scrollbars */
}

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
     -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox 
    input[type=number] {
     -moz-appearance: textfield;
    }*/
  /*
#overlay {
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
background-image: url("http://holycross.edu.ph/hcc/hcc/bodybackground1.png");
filter:alpha(opacity=70);
-moz-opacity:0.7;
-khtml-opacity: 0.7;
opacity: 0.7;
z-index: 100;
display: none;
}*/
.cnt223 a{
text-decoration: none;
}
.cnt223 u{
font-weight: bold;
color: red;
}
.popup{
width: 100%;
margin: 0 auto;
display: none;
position: fixed;
z-index: 999;
}
.cnt223{
min-width: 400px;
width: 400px;
min-height: 150px;
margin: 100px auto;
background: #f3f3f3;
position: relative;
z-index: 103;
padding: 15px 35px;
border-radius: 5px;
box-shadow: 0 2px 5px #000;
}
.cnt223 p{
clear: both;
    color: #555555;
    text-align: justify;
    font-size: 14px;
    font-family: sans-serif;
    line-height: 1.3;
}
.cnt223 p a{
color: #f5ac05;
font-weight: bold;
}
.cnt223 .x{
float: left;
height: 35px;
left: 22px;
position: relative;x
top: -25px;
width: 34px;
}
.cnt223 .x:hover{
cursor: pointer;
}@media (max-width: 540px){
.tingle-modal-box__content {
    overflow-y: scroll;
    margin-top:60px!important;
}
}
.coures-img img {
  width: 350px; /* Set the desired width */
  height: 250px; /* Set the desired height */
  object-fit: cover; /* Ensures the image fits within the dimensions without distortion */
}
.social-icon a {
  display: flex;
  align-items: center;
  gap: 5px; /* Reduce spacing */
}

.social-icon img {
  width: 20px; /* Smaller image */
  height: 20px;
}
.contact-icon {
  width: 20px; /* Adjust size as needed */
  height: 20px;
  vertical-align: middle;
  margin-right: 10px; /* Space between icon and text */
}







    </style>
    
    <meta property="og:url"                content="http://holycross.edu.ph/" />
    <meta property="og:type"               content="website" />
    <meta property="og:title"              content="Holy Cross College | Hail to the Cross, Our only Hope!" />
    <meta property="og:description"        content="Official Website of COncepcion Holy Cross College, Inc." />
    <meta property="og:image"              content="./hcc/hbgof.png" />
  </head>

  <body>
      <!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v10.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution="setup_tool"
        page_id="1025846607460463">
      </div>

    <!--=================================
    Header -->
    <header class="header header-style-02 header-sticky sticky-top">
      <div class="header-main py-lg-4">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="d-lg-flex align-items-center">
                <!-- logo -->
                <a class="navbar-brand logo text-lg-center" href="http://holycross.edu.ph/hcc/">
                  <img src="logo.png" alt="Logo">
                </a>
                <!-- header contact info -->
                <div class="header-contact-info ml-auto justify-content-center d-none d-lg-flex">
                  <div class="d-flex mr-3">
                    <i class="fa fa-phone fa-flip-horizontal fa-fw align-self-center"></i>
                    <div class="align-self-center">
                      <span class="d-block font-weight-bold mb-1 text-dark">Call Now</span>
                      <span>(+63) 044 940 0237</span>
                    </div>
                  </div>
                  <div class="d-flex mr-3 mb-1 mb-lg-0">
                    <i class="far fa-envelope fa-fw align-self-center"></i>
                    <div class="align-self-center">
                      <span class="d-block font-weight-bold mb-1 text-dark">Send Message</span>
                      <span>info@holycross.edu.ph</span>
                    </div>
                  </div>
                  <div class="d-flex mb-1 mb-lg-0">
                    <img src="down.png" alt="My Icon" width="30">
                    <div class="align-self-center">
                      <span class="d-block font-weight-bold mb-1 text-dark">Our Location</span>
                      <span>Brgy. Minane, Concepcion, Tarlac</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="header-menu bg-light">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <nav class="navbar navbar-expand-lg">
                <!-- Sticky logo -->
                <a class="navbar-brand logo-sticky" href="https://www.facebook.com/ConcepcionHolyCrossCollege">
                  <img src="logo2.png" alt="Logo">
                  <img src="ggg.png" alt="Logo">
              </a>
              
                <!-- Navbar toggler START-->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navbar toggler END-->

<!-- Navbar START -->
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav">
    <!-- We Are CHCCI! Dropdown -->
    <li class="nav-item dropdown active">
      <a class="nav-link dropdown-toggle" href="#" id="weAreCHCCIDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        We Are CHCCI! <img src="down.png" alt="My Icon" width="20">
      </a>
      <ul class="dropdown-menu" aria-labelledby="weAreCHCCIDropdown">
        <li><a class="dropdown-item" href="board.html">Board of Trustees</a></li>
        <li><a class="dropdown-item" href="hymn.html">School Hymn</a></li>
        <li><a class="dropdown-item" href="vision.html">Vision</a></li>
        <li><a class="dropdown-item" href="mission.html">Mission</a></li>
        <li><a class="dropdown-item" href="philosophy.html">Philosophy</a></li>
        <li><a class="dropdown-item" href="corevalues.html">Core Values</a></li>
        <li><a class="dropdown-item" href="symbols.html">CHCCian Symbols</a></li>
      </ul>
    </li>

                    <li class="nav-item dropdown">
                      <a class="nav-link  dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Programs<img src="down.png" alt="My Icon" width="20">
                      </a>
                      <!-- Dropdown Menu -->
                      <ul class="dropdown-menu">
                           <li><a class="dropdown-item" href="cs/home.php">BS Computer Science</a></li>
                          <li><a class="dropdown-item" href="educ/educ.php">BS Teacher Education</a></li>
                          <li><a class="dropdown-item" href="hm/hm.php" >BS Hospitality Management</a></li>
                          <li><a class="dropdown-item" href="crim/crim.php" >BS Criminal Justice Education</a></li>
                          <li><a class="dropdown-item" href="nursing/nursing.php" >BS Nursing</a></li>
                          <li><a class="dropdown-item" href="ba/page.php">BS Business Administration</a></li>
                      </ul>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link  dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admissions<img src="down.png" alt="My Icon" width="20">
                      </a>
                      <!-- Dropdown Menu -->
                      <ul class="dropdown-menu">
                          <li><a class="dropdown-item">Enrollment</a></li>
                        <ul style="list-style-type:none;">
                          <li><a class="dropdown-item" href="admission.php">Enroll Online</a></li>
                          <li><a class="dropdown-item" href="procedures.html">Procedures</a></li>

                        </ul>
                          
                        
                      </ul>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">News<img src="down.png" alt="My Icon" width="20">
                      </a>
                      <!-- Dropdown Menu -->
                      <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="https://www.facebook.com/CHCC.StudentAffairsAndServices">Advisories</a></li>
                          <li><a class="dropdown-item" href="news.html">Events</a></li>
                      </ul>
                    </li>
                    <!--<li class="nav-item">
                      <a class="nav-link" href="contactus.html">Contact Us</a>
                    </li>-->
                  </ul>
                </div>
                <!-- Navbar END-->

                <div class="mr-5 mr-lg-0 d-sm-flex d-none align-items-center">
                  <!-- Button START-->
                  <a class="btn btn-dark" href="admission.php">ENROLL NOW!</a>
                  <!-- Button END-->
                </div>

              </nav>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!--=================================
    Header -->

    <!--=================================
    Banner -->
    <section class="bg-overlay-black-60 space-ptb" style="background-image: url(0504.gif); background-size: cover; background-position: center center;">


<script type='text/javascript'>
$(function(){
var overlay = $('<div id="overlay"></div>');
overlay.show();
overlay.appendTo(document.body);
$('.popup').hide();
$('.close').click(function(){
$('.popup').hide();
overlay.appendTo(document.body).remove();
return false;
});


 

$('.x').click(function(){
$('.popup').hide();
overlay.appendTo(document.body).remove();
return false;
});
});
</script>



      <!-- Swiper Slider 1-->
      <div class="container">
        <div class="row align-items-center mt-2">
          <div class="col-xl-7 col-lg-7">
            <div>
                <h1 class="text-white mb-4" style="text-shadow: 2px 2px #000000; font-size: font-size: 3rem; ">NURTURING EXECELENCE AND TRANSFRORMING LIVES</h1>
                <div class="text-white">
                  <p>"We strive to inspire a lifelong passion for learning, promote meaningful collaboration, and cultivate compassion and understanding toward others in all aspects of life."</p>
                </div>
               
            </div>
          </div>
          <div class="col-xl-5 col-lg-5 mt-5 mt-lg-0">
            <div class="bg-primary p-4 p-sm-5 banner-form border-radius">
            <h3>Concepcion Holy Cross College<br>
            Inc., Portal! </h3>
             <p class="text-white">Log-on to your campus portal here!</p>
             <form class="form-row mt-4 align-items-center" method="POST" action="index.html">
              <div class="form-group col-12">
                  <label class="text-white font-weight-bold">Username / Student ID Number</label>
                  <input type="text" id="sid" name="idnumber" class="form-control " placeholder="Username / Student ID Number" required>
                                </div>
                <div class="form-group col-12">
                  <label class="text-white font-weight-bold">Password</label>
                  <input type="password" id="pw" name="password" class="form-control " placeholder="Password" required>
                                  </div>
                <div class="form-group col-12 mb-4">
                  <label class="d-block text-white font-weight-bold">Remember me</label>
                  <div class="custom-control custom-radio custom-control-inline form-radio">
                    <input type="radio" id="yes" name="yes" class="custom-control-input">
                    <label class="custom-control-label text-white font-weight-bold" for="customRadioInline1">Yes</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline form-radio">
                    <input type="radio" id="no" name="no" class="custom-control-input">
                    <label class="custom-control-label text-white font-weight-bold" for="customRadioInline2">No</label>
                  </div>
                </div>
                <div class="form-group col-sm-12 mb-0">
                  <button type="submit" class="btn btn-dark" name="login">Log-In</button>
                </div>
             </form><br><br>
                 
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=================================
    Banner -->


    <!--Event -->

    <!--=================================
    Team -->
    <section class="space-ptb">
      <div class="container">
                                    <!-- Section Title START -->
            <div>
                <center>
              <img src="gifholy.gif" width="100%">
              </br></br></br>
              </center>
            </div>
            <!-- Section Title END -->
       
    </section>
    
    
    <!--=================================
    Course item -->

    <!--=================================
    Category -->
    <section class="space-ptb bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <h2 class="mb-5">School Departments</h2>
      </div>
    </div>
    <div class="row justify-content-center">
      <!-- Department Card Template -->
      <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
        <div class="category text-center">
          <a href="#" class="category-item bg-dark border-radius py-4 d-block h-100">
            <div class="category-icon overflow-hidden" style="height: 150px;">
              <img src="cs.jpg" alt="Computer Studies" class="img-fluid w-100 h-100 object-fit-cover">
            </div>
            <h5 class="mt-3 text-white">School of Computer Studies</h5>
          </a>
        </div>
      </div>

      <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
        <div class="category text-center">
          <a href="#" class="category-item bg-dark border-radius py-4 d-block h-100">
            <div class="category-icon overflow-hidden" style="height: 150px;">
              <img src="ba.jpg" alt="Business Administration" class="img-fluid w-100 h-100 object-fit-cover">
            </div>
            <h5 class="mt-3 text-white">School of Business Administration</h5>
          </a>
        </div>
      </div>

      <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
        <div class="category text-center">
          <a href="#" class="category-item bg-dark border-radius py-4 d-block h-100">
            <div class="category-icon overflow-hidden" style="height: 150px;">
              <img src="ns.jpg" alt="Nursing" class="img-fluid w-100 h-100 object-fit-cover">
            </div>
            <h5 class="mt-3 text-white">School of Nursing</h5>
          </a>
        </div>
      </div>

      <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
        <div class="category text-center">
          <a href="#" class="category-item bg-dark border-radius py-4 d-block h-100">
            <div class="category-icon overflow-hidden" style="height: 150px;">
              <img src="hm.jpg" alt="Hospitality Management" class="img-fluid w-100 h-100 object-fit-cover">
            </div>
            <h5 class="mt-3 text-white">School of Hospitality Management</h5>
          </a>
        </div>
      </div>

      <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
        <div class="category text-center">
          <a href="#" class="category-item bg-dark border-radius py-4 d-block h-100">
            <div class="category-icon overflow-hidden" style="height: 150px;">
              <img src="ed.jpg" alt="Teacher Education" class="img-fluid w-100 h-100 object-fit-cover">
            </div>
            <h5 class="mt-3 text-white">School of Teacher Education</h5>
          </a>
        </div>
      </div>

      <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
        <div class="category text-center">
          <a href="#" class="category-item bg-dark border-radius py-4 d-block h-100">
            <div class="category-icon overflow-hidden" style="height: 150px;">
              <img src="crim.jpg" alt="Criminal Justice Education" class="img-fluid w-100 h-100 object-fit-cover">
            </div>
            <h5 class="mt-3 text-white">School of Criminal Justice Education</h5>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

    
     <!--=================================
    Skill -->

   <!--=================================
    Event -->
    <section class="space-ptb bg-dark">
      <div class="container">
        <div class="row">
          <div class="col-lg-5">
            <div class="bg-white border-radius">
              <div class="bg-primary rounded-top p-4">
                <h3>Pre-enroll Now!</h3>
                <p class="text-white mb-0">Fill-out this form to start your #HCCian journey today!</p>
              </div>
              <div class="form-group col-sm-12 mb-0">
              <form class="form-row mt-0 align-items-center p-lg-5 p-4" style="padding-bottom: 0px!important;" id="pre_enrollment_form">
                <div class="form-group col-12">
                  <label class="text-dark font-weight-bold">First Name*</label>
                  <input type="text" class="pre_enroll_form form-control" name="firstname" placeholder="First Name" required>
                </div>
                <div class="form-group col-12">
                  <label class="text-dark font-weight-bold">Middle Name</label>
                  <input type="text" class="pre_enroll_form form-control" name="middlename" placeholder="Middle Name">
                </div>
                <div class="form-group col-12">
                  <label class="text-dark font-weight-bold">Last Name*</label>
                  <input type="text" class="pre_enroll_form form-control" name="lastname" placeholder="Last Name" required>
                </div>
                
                <div class="form-group col-12">
                  <label class="text-dark font-weight-bold">Gender*</label>
                  <select id="gender" name="gender" class="pre_enroll_form form-control" required>
                    <option value="" selected hidden>Select gender.</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                </div>
                <div class="form-group col-12">
                  <label class="text-dark font-weight-bold">Birthdate*</label>
                  <input type="date" class="pre_enroll_form form-control" name="bday" placeholder="" required>
                </div>
                <div class="form-group col-12">
                  <label class="text-dark font-weight-bold">Province*</label>
                  <select name="province" id="province" class="pre_enroll_form form-control" required=""></select>
                </div>
                
                <div class="form-group col-12">
                  <label class="text-dark font-weight-bold">City/Municipality*</label>
                  <select name="city" id="city" class="pre_enroll_form form-control" required="">
                    <option selected="" hidden="" value="">Choose an option</option>
                  </select>
                </div>
                <div class="form-group col-12">
                  <label class="text-dark font-weight-bold">Barangay*</label>
                  <select name="barangay" id="barangay" class="pre_enroll_form form-control" required>
                    <option selected="" hidden="" value="">Choose an option</option>
                  </select>
                </div>
                 <div class="form-group col-12">
                  <label class="text-dark font-weight-bold">House Number</label>
                  <input type="text" class="pre_enroll_form form-control" name="housenumber" placeholder="House No.">
                </div>
                
                
                
                <div class="form-group col-12">
                  <label class="text-dark font-weight-bold">Grade/Course/Program*</label>
                  <select id="program" name="program" class="pre_enroll_form form-control" required>
                  <option value="" selected="">Course/Program You're applying for.</option>
                  <option value="beed">Bachelor of Elementary Education</option>
                  <option value="bsede">BSEd Major in English</option>
                  <option value="bsedm">BSEd Major in Mathematics</option>
                  <option value="bsedss">BSEd Major in Social Studies</option>
                  <option value="bsa">BS in Accountancy</option>
                  <option value="bsbafm">BSBA Major in Financial Management</option>
                  <option value="bsbamm">BSBA Major in Marketing Management</option>
                  <option value="bscs">BS in Computer Science</option>
                  <option value="bscrim">BS in Criminology</option>
                  <option value="bshm">BS in Hospitality Management</option>
                  <option value="bsn">BS Nursing</option>
                </select>
                </div>

                <div class="form-group col-12" id="Myyear" style="display: none;">
                  <label class="text-dark font-weight-bold">Year<small><i>(for Undergraduate Programs only)</i></small></label>
                  <select id="year" name="year" class="pre_enroll_form form-control">
                  <option value="" selected="" hidden="">Select the year you're in this academic year.</option>
                  <option value="1st Yr.">First Year College (1st Yr.)</option>
                  <option value="2nd Yr.">Second Year College (2nd Yr.)</option>
                  <option value="3rd Yr.">Third Year College (3rd Yr.)</option>
                  <option value="4th Yr.">Fourth Year College (4th Yr.)</option>
                  </select>
                  </div>
                  
                  <div class="form-group col-12">
                  <label class="text-dark font-weight-bold">Student Mobile Number*</label>
                  <input type="number" name="mobilenumber" class="pre_enroll_form form-control" placeholder="Mobile Number" required>
                </div>
                <div class="form-group col-12">
                  <label class="text-dark font-weight-bold">Student Email Address*</label>
                  <input type="email" class="pre_enroll_form form-control" name="email" placeholder="Email Address" required>
                </div>
                <hr>

                  <div class="form-group col-12 mb-0">
                    <label class="text-dark font-weight-bold">Father's name</label>
                  </div>
                  <div class="form-group col-6">
                    <input type="text" name="fatherfname" class="pre_enroll_form form-control" placeholder="Firstname" >
                  </div>
                  <div class="form-group col-6">
                    <input type="text" name="fatherlname" class="pre_enroll_form form-control" placeholder="Lastname" >
                  </div>
                  <div class="form-group col-12">
                    <label class="text-dark font-weight-bold">Contact Number</label>
                    <input type="text" name="fathercontact" class="pre_enroll_form form-control" placeholder="Contact Number">
                  </div>
                  <div class="form-group col-12">
                    <label class="text-dark font-weight-bold">Address</label>
                    <input type="text" name="fatheraddress" class="pre_enroll_form form-control" placeholder="Address" >
                  </div>
<hr>

                    <div class="form-group col-12 mb-0">
                    <label class="text-dark font-weight-bold">Mother's name</label>
                  </div>
                  <div class="form-group col-6">
                    <input type="text" name="motherfname" class="pre_enroll_form form-control" placeholder="Firstname" >
                  </div>
                  <div class="form-group col-6">
                    <input type="text" name="motherlname" class="pre_enroll_form form-control" placeholder="Lastname" >
                  </div>
                    
                    <div class="form-group col-12">
                    <label class="text-dark font-weight-bold">Contact Number</label>
                    <input type="text" name="parentcontactaddress" class="pre_enroll_form form-control" placeholder="Mobile Number">
                  </div>
                  <div class="form-group col-12">
                    <label class="text-dark font-weight-bold">Address</label>
                    <input type="text" name="parentaddress" class="pre_enroll_form form-control" placeholder="Address" >
                  </div>      
<hr>
                  <div class="form-group col-12 mb-0">
                    <label class="text-dark font-weight-bold">Guardian's name</label>
                  </div>
                  <div class="form-group col-6">
                    <input type="text" name="guarianfname" class="pre_enroll_form form-control" placeholder="Firstname">
                  </div>
                  <div class="form-group col-6">
                    <input type="text" name="guardianlname" class="pre_enroll_form form-control" placeholder="Lastname">
                  </div>
                  <div class="form-group col-12">
                    <label class="text-dark font-weight-bold">Address</label>
                    <input type="text" name="guardianaddress" class="pre_enroll_form form-control" placeholder="Guardian address">
                  </div>
                  <div class="form-group col-12">
                    <label class="text-dark font-weight-bold">Contact Number</label>
                    <input type="text" name="guardianaddress" class="pre_enroll_form form-control" placeholder="Guardian contact number">
                  </div>
                <div class="form-group col-sm-12 mb-0">
                  <button type="submit" name="pre_enrollment" class="btn btn-primary" id="formsubmitloading">
                    Enroll Now!
                  </button><br><i>To verify your enrollment click the "Enroll Now!" button and pay an initial payement of ₱2,000. To learn more about <a href="https://holycross.edu.ph/hcc/payment.html" target="_blank">payments click here.</a></i>
                  <button type="button" disabled="" style="width: 36%;display: none;" class="btn btn-primary p-0 ml-0" id="formsubmitloading12" style="width: 37%;"><img style="height: 45px;width: 100%;" id="loadinggbutton" class="pl-2 pr-2" src="hcc/Pulse-1s-184px.svg"></button>
                  </form>
                  </div>    
              </div>
                  <br>
                  <hr class="mb-0">
                  <div class="form-group col-sm-12 mb-0">
                  <form id="refe_number_tracker" class="form-row mt-0 align-items-center p-4 p-lg-5" enctype="multipart/form-data" method="post">
                    <span id="errormessagehere"></span>
                      <div class="form-group col-12 p-0">
                      <label class="text-dark font-weight-bold">Enrollment Reference Number*</label>
                      <input type="text" class="refnumbercode form-control" name="refcode" placeholder="Please enter the reference number sent to your registered email address to check your enrollment status." required>
                    </div>
                    <span id="proofpaymentinput"></span>
                    <button type="submit" name="pre_enrollment" class="btn btn-primary" id="formsubmitloading1">
                        Validate
                    </button>
                    <span id="loadingbuttonhere"></span>
                </form>
                
                </div>
               </div>
              </div>


          <div class="col-lg-7 mt-5 mt-lg-0">
            <div class="row mb-4 mb-md-0">
              <div class="col-md-8">
                <div class="section-title">
                  <h2>Latest Events & Announcements</h2>
                  <p class="mb-0">Follow and subscribe our official social media accounts and always be in the know, be the first, #HCCians!</p>
                </div>
              </div>
              <div class="col-md-4 text-md-right">
                <a class="btn btn-white" href="https://www.facebook.com/ConcepcionHolyCrossCollege">View All</a>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="event-list bg-white border-radius mb-3 p-3">
                  <div class="d-sm-flex">
                    <div class="event-img">
                      <img class="w-100 border-radius" src="i.jpg" alt="">
                    </div>
                    <div class="event-content pl-sm-4 pt-4 p-sm-0">
                      <a href="#" class="text-dark h5">𝗙𝗶𝗿𝗲 𝗣𝗿𝗲𝘃𝗲𝗻𝘁𝗶𝗼𝗻 𝗠𝗼𝗻𝘁𝗵.</a>
                      <div class="event-meta my-3">
                        <ul class="list-unstyled mb-0 d-flex">
                          <li class="mr-3"><a href="#"><img src="cal.png" alt="My Icon" width="15"></i> 21 Mar, 2025</a></li>
                          <li><a href="#"><img src="clock.png" alt="My Icon" width="20"></i>  11:00 AM</a></li>
                        </ul>
                      </div>
                      <p class="text-dark">Learn on how to protect yourself, your family, and your community. Don’t miss this chance to gain life-saving knowledge and take proactive steps to prevent fires before they happen! Stay safe, stay aware!</p>
                      <a class="btn btn-sm btn-dark btn-round" href="https://www.facebook.com/photo/?fbid=628126740017938&set=a.127929053371045">Learn more</a>
                    </div>
                  </div>
                </div>
                <div class="event-list bg-white border-radius p-3">
                  <div class="d-sm-flex">
                    <div class="event-img">
                      <img class="w-100 border-radius" src="ws.jpg" alt="">
                    </div>
                    <div class="event-content pl-sm-4 pt-4 p-sm-0">
                      <a href="#" class="text-dark h5">𝗡𝗮𝘁𝗶𝗼𝗻𝗮𝗹 𝗪𝗼𝗺𝗲𝗻'𝘀 𝗠𝗼𝗻𝘁𝗵 𝗖𝗲𝗹𝗲𝗯𝗿𝗮𝘁𝗶𝗼𝗻</a>
                      <div class="event-meta my-3">
                        <ul class="list-unstyled mb-0 d-flex">
                          <li class="mr-3"><a href="#"><img src="cal.png" alt="My Icon" width="15"></i> 14 Mar, 2025</a></li>
                          <li><a href="#"><img src="clock.png" alt="My Icon" width="20"></i>  9:00 AM</a></li>
                        </ul>
                      </div>
                      <p class="text-dark">Join us in this initiative, together let's Celebrate National Womens's Month!</p>
                      <a class="btn btn-sm btn-dark btn-round" href="https://www.facebook.com/photo/?fbid=619871840843428&set=a.127929053371045">Learn More</a>
                    </div>
                  </div>
                </div>
                <br>
                <div class="post-container event-list bg-white border-radius p-3">
                  <div class="d-sm-flex">
                    <div class="event-img">
                      <img class="w-100 border-radius" src="p.jpg" alt="">
                    </div>
                    <div class="event-content pl-sm-4 pt-4 p-sm-0">
                      <a href="#" class="text-dark h5">𝐂𝐡𝐚𝐬𝐞 𝐭𝐡𝐞 𝐠𝐚𝐦𝐞. 𝐒𝐞𝐢𝐳𝐞 𝐭𝐡𝐞 𝐰𝐢𝐧!  </a>
                      <div class="event-meta my-3">
                        <ul class="list-unstyled mb-0 d-flex">
                          <li class="mr-3"><img src="cal.png" alt="My Icon" width="15"></i> 17-18 Dec, 2020</a></li>
                          <li><a href=""><img src="clock.png" alt="My Icon" width="20"></i>  8:00 AM</a></li>
                        </ul>
                      </div>
                      <p class="text-dark">𝐂𝐡𝐚𝐬𝐞 𝐭𝐡𝐞 𝐠𝐚𝐦𝐞. 𝐒𝐞𝐢𝐳𝐞 𝐭𝐡𝐞 𝐰𝐢𝐧!  
                        The Sports and Development Unit will conduct its 2-Day OPEN TRY-OUT this December 17 to 18, 2024 for the upcoming PRISAA Games 2025.</p>
                      <a class="btn btn-sm btn-dark btn-round" href="https://www.facebook.com/photo/?fbid=122124913766394741&set=pcb.122124914186394741">Learn more</a>
                    </div>
                  </div>
                 </div>
                 <br>
                <div class="post-container event-list bg-white border-radius p-3">
                  <div class="d-sm-flex">
                    <div class="event-img">
                      <img class="w-100 border-radius" src="b.jpg" alt="">
                    </div>
                    <div class="event-content pl-sm-4 pt-4 p-sm-0">
                      <a href="#" class="text-dark h5">CHCCI Guidance and Testing Unit | 𝐏𝐚𝐭𝐡𝐰𝐚𝐲 𝐭𝐨 𝐒𝐮𝐜𝐜𝐞𝐬𝐬: 𝐈𝐧𝐬𝐩𝐢𝐫𝐢𝐧𝐠 𝐉𝐨𝐮𝐫𝐧𝐞𝐲, 𝐋𝐢𝐦𝐢𝐭𝐥𝐞𝐬𝐬 𝐏𝐨𝐬𝐬𝐢𝐛𝐢𝐥𝐢𝐭𝐢𝐞𝐬(Blended Learning)</a>
                      <div class="event-meta my-3">
                        <ul class="list-unstyled mb-0 d-flex">
                          <li class="mr-3"><img src="cal.png" alt="My Icon" width="15"></i> 21 Apr, 2025</a></li>
                          <li><a href="#"><img src="clock.png" alt="My Icon" width="20"></i>  8:00 AM</a></li>
                        </ul>
                      </div>
                      <p class="text-dark">Calling all Senior High School students! We’re thrilled to invite you to our Career Guidance Conference on February 28, 2025 at 𝟖:𝟎𝟎 𝐀𝐌 in the 𝐌𝐨𝐧𝐭𝐞𝐬𝐬𝐨𝐫𝐢 𝐀𝐮𝐝𝐢𝐨-𝐕𝐢𝐬𝐮𝐚𝐥 𝐑𝐨𝐨𝐦. </p>
                      <a class="btn btn-sm btn-dark btn-round" href="https://www.facebook.com/photo/?fbid=122124913766394741&set=pcb.122124914186394741">Learn more</a>
                    </div>
                  </div>
              </div>
              <br>
                <div class="post-container event-list bg-white border-radius p-3">
                  <div class="d-sm-flex">
                    <div class="event-img">
                      <img class="w-100 border-radius" src="a.jpg" alt="">
                    </div>
                    <div class="event-content pl-sm-4 pt-4 p-sm-0">
                      <a href="#" class="text-dark h5">BS Accountancy & BS Accounting Information System 𝘽𝙚𝙮𝙤𝙣𝙙 𝙩𝙝𝙚 𝙄𝙣𝙩𝙚𝙧𝙣𝙨𝙝𝙞𝙥: 𝘽𝙪𝙞𝙡𝙙𝙞𝙣𝙜 𝙮𝙤𝙪𝙧 𝙋𝙧𝙤𝙛𝙚𝙨𝙨𝙞𝙤𝙣𝙖𝙡 𝙉𝙚𝙩𝙬𝙤𝙧𝙠!!</a>
                      <div class="event-meta my-3">
                        <ul class="list-unstyled mb-0 d-flex">
                          <li class="mr-3"><img src="cal.png" alt="My Icon" width="15"></i> 21 Feb, 2025</a></li>
                          <li><a href="#"><img src="clock.png" alt="My Icon" width="20"></i>  8:00 AM</a></li>
                        </ul>
                      </div>
                      <p class="text-dark">Building Your Professional Network, ” was very helpful for our 4th year On-the-Job Training (OJT) students.
                      </p>
                      <a class="btn btn-sm btn-dark btn-round" href="https://www.facebook.com/photo?fbid=614452311338486&set=pcb.614452634671787">Learn More</a>
                    </div>
                  </div>
                  </div>
            </div>
          </div>
        </div>
      </div>
      </div>
      </div>
    </section>
    <!--=================================
    Event -->
    
    <!--=================================
    Articles -->
   
      <hr>
    <!--=================================
    Category -->

    <!--=================================
    About -->
    <section class="space-ptb">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 mb-4 mb-lg-0 pr-lg-7">
            <div class="position-relative h-100 pr-md-6 pb-md-6">
              <img class="img-fluid border-radius w-100" src="c.jpg" alt="">
              <div class="position-absolute right-0 bottom-0 d-none d-md-block" style="width: 50%; height: auto;">
                <img class="img-fluid border-radius w-100" src="g.jpg" alt="">
              </div>
            </div>
          </div>
          <div class="col-lg-6 pr-lg-6">
            <div class="section-title mb-4">
              <h2 class="title">Higher Education Begins Here</h2>
              <p class="lead mb-0">Holy Cross College aims to produce globally competitive graduates trained with deep spirituality based on sound and strong belief in God. This shall be accomplish by giving quality education, practical training and sound guidance.</p>
            </div>
            <p class="mb-4 mb-md-5">Holy Cross College sees itself as an institution of excellence for the development of the youth in the service of God, country and people.</p>
            <a href="https://www.facebook.com/ConcepcionHolyCrossCollege" class="btn btn-primary btn-round">Read More</a>
          </div>
        </div>
      </div>
    </section>
    <!--=================================
    About -->

    <!--=================================
    Skill -->
   
  
  <!--=================================
    Team -->

    <!--=================================
    Feature-box -->
    <section>
       <div class="container-fluid px-0">
         <div class="row no-gutters">
           <div class="col-lg-6 bg-dark p-0 p-xl-5">
            <div class="feature-box d-block d-sm-flex">
            <div class="feature-icon bg-white mb-4 mb-sm-0">
              <img src="df.png" alt="School Icon" width="100">
              </div>
              <div class="feature-content ml-0 ml-sm-4 ml-lg-5  text-center text-sm-left">
            <h3 class="text-center text-sm-left">Affordable Quality Education</h3>
            <p class="mb-0 text-center text-sm-left">We provides our learners with capabilities they require to become economically productive, develop sustainable livelihoods, contribute to peaceful and democratic societies and enhance individual well-being. </p>
            <a href="#" class="btn btn-white btn-round mt-4">Read More</a>
          </div>
           </div>
         </div>
           <div class="col-lg-6 bg-primary p-0 p-xl-5">
            <div class="feature-box d-block d-sm-flex">
            <div class="feature-icon bg-white mb-4 mb-sm-0">
              <img src="gg.png" alt="School Icon" width="100">
              </div>
              <div class="feature-content ml-0 ml-sm-4 ml-lg-5 text-center text-sm-left">
            <h3 class="text-center text-sm-left">Blended Learning Program</h3>
            <p class="mb-0 text-center text-sm-left">This breaks down the traditional walls of teaching, ones that don't work for all students and now with access to present-day technologies and resources we can tailor the learning experience for each student.</p>
            <a href="#" class="btn btn-white btn-round mt-4 text-center text-sm-left">Read More</a>
          </div>
           </div>
         </div>
         </div>
       </div>
    </section>
     
   
<!--=================================
    Fearture icon -->

    <!--=================================
    Course item -->
    <section class="space-ptb">
      <div class="container">
        <div class="row">
          <div class="col-sm-8">
            <div class="section-title">
              <h2 class="title">Campus Gallery</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="filters-group mb-lg-4">
              <button class="btn-filter  active" data-group="all">All</button>
              <button class="btn-filter" data-group="facilities">Facilities</button>
              <button class="btn-filter" data-group="bed">Basic Education</button>
              <button class="btn-filter" data-group="col">College</button>
              <button class="btn-filter" data-group="events">Campus Events</button>
            </div>
            <div class="my-shuffle-container columns-3 popup-gallery full-screen shuffle" style="position: relative; overflow: hidden; height: 982.594px; transition: height 700ms cubic-bezier(0.4, 0, 0.2, 1) 0s;">
              <!-- item START -->
              <div class="grid-item shuffle-item shuffle-item--visible" data-groups="[&quot;facilities&quot;]" style="position: absolute; top: 0px; left: 0px; visibility: visible; will-change: transform; opacity: 1; transition-duration: 700ms; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-property: transform, opacity;">
                <div class="course-item">
                  <div class="coures-img">
                    <img class="img-fluid" src="gh.jpg" alt="">
                    <div class="course-tag">
                      <a href="#">CHCCI MASS</a>
                    </div>
                  </div>
                 <!-- <div class="course-conten">
                    <a href="#" class="course-author d-flex align-items-center mb-3">
                      <img class="avatar img-fluid" src="./hcc/01(1).jpg" alt="">
                      <span class="author-name">Alice Williams</span>
                    </a>
                    <h5 class="mb-3">
                      <a href="#">Aeronautical &amp; Manufacturing Engineering</a>
                    </h5>
                    <div class="course-rating mb-3 pb-3 border-bottom">
                      <div class="review-rating">
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star"></i>
                      </div>
                    </div>
                    <div class="course-meta">
                      <ul class="list-unstyled mb-0">
                        <li><i class="fa fa-user pr-2"></i>12 students</li>
                        <li><i class="fa fa-book-open pr-2"></i>08 lessons</li>
                        <li class="price"><span>$100</span> $50</li>
                      </ul>
                    </div>
                  </div>-->
                </div>
              </div>
              <!-- item End -->

              <!-- item START -->
              <div class="grid-item shuffle-item shuffle-item--visible" data-groups="[&quot;bed&quot;, &quot;col&quot;, &quot;facilities&quot;]" style="position: absolute; top: 0px; left: 0px; visibility: visible; will-change: transform; opacity: 1; transform: translate(390px, 0px) scale(1); transition-duration: 700ms; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-property: transform, opacity;">
                <div class="course-item">
                  <div class="coures-img">
                    <img class="img-fluid" src="hollow.jpg" alt="">
                    <div class="course-tag">
                      <a href="#">Elementary Holloween Party</a>
                    </div>
                  </div>
                  <!--<div class="course-conten">
                    <a href="#" class="course-author d-flex align-items-center mb-3">
                      <img class="avatar img-fluid" src="./hcc/04.jpg" alt="">
                      <span class="author-name">Mellissa Doe</span>
                    </a>
                    <h5 class="mb-3">
                      <a href="#">Business &amp; Management Studies</a>
                    </h5>
                    <div class="course-rating mb-3 pb-3 border-bottom">
                      <div class="review-rating">
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                    </div>
                    <div class="course-meta">
                      <ul class="list-unstyled mb-0">
                        <li><i class="fa fa-user pr-2"></i>08 students</li>
                        <li><i class="fa fa-book-open pr-2"></i>04 lessons</li>
                        <li class="price"><span>$80</span> $40</li>
                      </ul>
                    </div>
                  </div>-->
                </div>
              </div>
              <!-- item End -->

              <!-- item START -->
              <div class="grid-item shuffle-item shuffle-item--visible" data-groups="[&quot;col&quot;]" style="position: absolute; top: 0px; left: 0px; visibility: visible; will-change: transform; opacity: 1; transform: translate(780px, 0px) scale(1); transition-duration: 700ms; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-property: transform, opacity;">
                <div class="course-item">
                  <div class="coures-img">
                    <img class="img-fluid" src="ff.jpg" alt="">
                    <div class="course-tag">
                      <a href="#">Montessori Career Guidance</a>
                    </div>
                  </div>
                  <!--<div class="course-conten">
                    <a href="#" class="course-author d-flex align-items-center mb-3">
                      <img class="avatar img-fluid" src="./hcc/02(1).jpg" alt="">
                      <span class="author-name">Paul Flavius</span>
                    </a>
                    <h5 class="mb-3">
                      <a href="#">History of Art, Architecture &amp; Design</a>
                    </h5>
                    <div class="course-rating mb-3 pb-3 border-bottom">
                      <div class="review-rating">
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star"></i>
                      </div>
                    </div>
                    <div class="course-meta">
                      <ul class="list-unstyled mb-0">
                        <li><i class="fa fa-user pr-2"></i>16 students</li>
                        <li><i class="fa fa-book-open pr-2"></i>10 lessons</li>
                        <li class="price"><span>$150</span> $80</li>
                      </ul>
                    </div>
                  </div>-->
                </div>
              </div>
              <!-- item End -->

              <!-- item START -->
              <div class="grid-item shuffle-item shuffle-item--visible" data-groups="[&quot;events&quot;]" style="position: absolute; top: 0px; left: 0px; visibility: visible; will-change: transform; opacity: 1; transform: translate(0px, 491px) scale(1); transition-duration: 700ms; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-property: transform, opacity;">
                <div class="course-item">
                  <div class="coures-img">
                    <img class="img-fluid" src="cd.jpg" alt="">
                    <div class="course-tag">
                      <a href="#">Campus Color Fun Run</a>
                    </div>
                  </div>
                  <!--<div class="course-conten">
                    <a href="#" class="course-author d-flex align-items-center mb-3">
                      <img class="avatar img-fluid" src="./hcc/05.jpg" alt="">
                      <span class="author-name">Felica Queen</span>
                    </a>
                    <h5 class="mb-3">
                      <a href="#">Communication &amp; Media Studies</a>
                    </h5>
                    <div class="course-rating mb-3 pb-3 border-bottom">
                      <div class="review-rating">
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star"></i>
                      </div>
                    </div>
                    <div class="course-meta">
                      <ul class="list-unstyled mb-0">
                        <li><i class="fa fa-user pr-2"></i>21 students</li>
                        <li><i class="fa fa-book-open pr-2"></i>09 lessons</li>
                        <li class="price"><span>$180</span> $90</li>
                      </ul>
                    </div>
                  </div>-->
                </div>
              </div>
              <!-- item End -->

              <!-- item START -->
              <div class="grid-item shuffle-item shuffle-item--visible" data-groups="[&quot;design&quot;, &quot;events&quot;]" style="position: absolute; top: 0px; left: 0px; visibility: visible; will-change: transform; opacity: 1; transform: translate(390px, 491px) scale(1); transition-duration: 700ms; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-property: transform, opacity;">
                <div class="course-item">
                  <div class="coures-img">
                    <img class="img-fluid" src="pasko.jpg" alt="">
                    <div class="course-tag">
                      <a href="#"> Paskuhan </a>
                    </div>
                  </div>
                  <!--<div class="course-conten">
                    <a href="#" class="course-author d-flex align-items-center mb-3">
                      <img class="avatar img-fluid" src="./hcc/03(1).jpg" alt="">
                      <span class="author-name">Michael Bean</span>
                    </a>
                    <h5 class="mb-3">
                      <a href="#">Geography &amp; Environmental Science</a>
                    </h5>
                    <div class="course-rating mb-3 pb-3 border-bottom">
                      <div class="review-rating">
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star"></i>
                      </div>
                    </div>
                    <div class="course-meta">
                      <ul class="list-unstyled mb-0">
                        <li><i class="fa fa-user pr-2"></i>25 students</li>
                        <li><i class="fa fa-book-open pr-2"></i>15 lessons</li>
                        <li class="price"><span>$300</span> $200</li>
                      </ul>
                    </div>
                  </div>-->
                </div>
              </div>
              <!-- item End -->

              <!-- item START -->
              <div class="grid-item shuffle-item shuffle-item--visible" data-groups="[&quot;facilities&quot;, &quot;bed&quot;]" style="position: absolute; top: 0px; left: 0px; visibility: visible; will-change: transform; opacity: 1; transform: translate(780px, 491px) scale(1); transition-duration: 700ms; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-property: transform, opacity;">
                <div class="course-item">
                  <div class="coures-img">
                    <img class="img-fluid" src="scs.jpg" alt="">
                    <div class="course-tag">
                      <a href="#">Intramurals</a>
                    </div>
                  </div>
                  <!--<div class="course-conten">
                    <a href="#" class="course-author d-flex align-items-center mb-3">
                      <img class="avatar img-fluid" src="./hcc/06.jpg" alt="">
                      <span class="author-name">Sara Lisbon</span>
                    </a>
                    <h5 class="mb-3">
                      <a href="#">Electrical &amp; Electronic Engineering</a>
                    </h5>
                    <div class="course-rating mb-3 pb-3 border-bottom">
                      <div class="review-rating">
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                    </div>
                    <div class="course-meta">
                      <ul class="list-unstyled mb-0">
                        <li><i class="fa fa-user pr-2"></i>35 students</li>
                        <li><i class="fa fa-book-open pr-2"></i>17 lessons</li>
                        <li class="price"><span>$500</span> $280</li>
                      </ul>
                    </div>
                  </div>-->
                </div>
              </div>
              <!-- item End -->
            </div>
          </div>
        </div>
      </div>
    </section>
   
    <!--=================================
    Articles -->

    <!--=================================
    Call to action -->
   
    <!--=================================
    Call to action -->

    <!--=================================
    Footer-->
    <footer class="space-pt bg-overlay-black-90 bg-holder footer mt-n5" style="background-image: url(ok1.jpg);">
      <div class="container pt-5">
        <div class="row pb-5 pb-lg-6 mb-lg-3">
          <div class="col-sm-6 col-lg-4 mb-4 mb-lg-0 pr-lg-5">
            <a href="#"><img class="img-fluid mb-3 footer-logo" src="logo2.png" alt=""></a>
            <p class="text-white"><i><b>Hail to the Cross, Our only Hope!</b></i></p>
            <h5 class="text-white mb-2 mb-sm-4">Connect with us</h5>
            <div class="social-icon social-icon-style-02">
              <ul>
                <li>
                  <div class="social-icon">
                    <a href="https://www.facebook.com/ConcepcionHolyCrossCollege">
                      <img src="fb.png" alt="Facebook">
                  </a>
                  </div>
                </li>
                <li>
                  <div class="social-icon">
                    <a href="https://www.facebook.com/ConcepcionHolyCrossCollege">
                      <img src="tweet1.png" alt="twitter">
                  </a>
                  </div>
                </li>
                <li>
                  <div class="social-icon">
                    <a href="https://www.facebook.com/ConcepcionHolyCrossCollege">
                      <img src="insta2.png" alt="Instagram">
                  </a>
                  </div>
                </li>
              </ul>
            </div>            
          </div>
          <div class="col-sm-6 col-lg-2 mb-4 mb-lg-0">
            <h5 class="text-white mb-2 mb-sm-4">Quick Links</h5>
            <div class="footer-link">
              <ul class="list-unstyled mb-0">
                <li><a class="text-white" href="#">Research and Extension</a></li>
                <li><a class="text-white" href="#">School Publication</a></li>
                <li><a class="text-white" href="#">Campus Guidance Office</a></li>
                <li><a class="text-white" href="#">Social Media Policy</a></li>
                <li><a class="text-white" href="#">Terms & Conditions</a></li>
                <li><a class="text-white" href="privacy-policy.html">Privacy Policy</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-6 col-lg-2 mb-4 mb-sm-0">
            <h5 class="text-white mb-2 mb-sm-4">Site Map</h5>
            <div class="footer-link">
              <ul class="list-unstyled mb-0">
                <li><a class="text-white" href="#">Home</a></li>
                <li><a class="text-white" href="#">About</a></li>
                <li><a class="text-white" href="#">Programs</a></li>
                <li><a class="text-white" href="#">Admissions</a></li>
                <li><a class="text-white" href="#">News</a></li>
                <li><a class="text-white" href="#">Contact Us</a></li>
              </ul>
            </div>
          </div>
          <!--bading-->
          <div class="col-sm-6 col-lg-4">
            <h5 class="text-white mb-2 mb-sm-4">Reach Us At</h5>
            <p class="text-white">Our offices and online support team are available every Monday to Friday from 8 AM to 4 PM only.</p>
            <div class="footer-contact-info">
              <div class="contact-address mt-4">
                <div class="contact-item">
                  <img src="home.png" alt="Location Icon" class="contact-icon">
                  <p class="ml-3 mb-0 text-white">Brgy. Minane, Concepcion, Tarlac</p>
                </div>
                <div class="contact-item">
                  <img src="tele.png" alt="Phone Icon" class="contact-icon">
                  <p class="mb-0 ml-3 text-white">+(63) 044-940-0237</p>
                </div>
                <div class="contact-item mb-0">
                  <img src="mail.png" alt="Email Icon" class="contact-icon">
                  <a class="text-white ml-3 text-white" href="#">info@holycross.edu.ph</a>
                </div>
              </div>
            </div>
          </div>          
        </div>
      </div>
      <div class="footer-bottom bg-dark py-4">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-12 text-center">
              <p class="mb-0 text-white">©Copyright 2020 <a href="#">Concepcion Holy Cross College Inc. - Management Information Systems</a> <br> All Rights Reserved | Maintained & Made with ❤ by <a href="https://www.facebook.com/CHCCIComputerStudiesStudentCouncil">SCS</a></p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!--=================================
    Footer-->

    <!--=================================
    Back To Top-->
    <div id="back-to-top" class="back-to-top" styles="">up</div>
    <!--=================================
    Back To Top-->

    <!-- JS Global Compulsory (Do not remove)-->
    <script src="./hcc/jquery-3.5.1.min.js.download"></script>
    <script src="./hcc/popper.min.js.download"></script>
    <script src="./hcc/bootstrap.min.js.download"></script>

    <!-- Page JS Implementing Plugins (Remove the plugin script here if site does not use that feature)-->
    <script src="./hcc/jquery.appear.js.download"></script>
    <script src="./hcc/jquery.countTo.js.download"></script>
    <script src="./hcc/owl.carousel.min.js.download"></script>
    <script src="./hcc/swiper.min.js.download"></script>
    <script src="./hcc/SwiperAnimation.min.js.download"></script>
    <script src="./hcc/jquery.magnific-popup.min.js.download"></script>
    <script src="./hcc/shuffle.min.js.download"></script>
    <!-- <script src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations-v1.0.0.js"></script> -->
    <!-- Template Scripts (Do not remove)-->
    <script src="./hcc/custom.js.download"></script>
    <script src="./hcc/tingle.js"></script>
    <script src="./hcc/custom.js"></script>
        <script type="text/javascript">
      $(document).ready(function() {
  // Fetch the JSON data on page load
  $.getJSON('https://raw.githubusercontent.com/flores-jacob/philippine-regions-provinces-cities-municipalities-barangays/master/philippine_provinces_cities_municipalities_and_barangays_2019v2.json', function(data) {
    window.philippinesData = data; // Store the data in a global variable

    // Populate provinces
    fetchProvinces();

    // Event listener for province change
    $('#province').on('change', function() {
      var provinceName = $(this).val();
      fetchCities(provinceName);
    });

    // Event listener for city change
    $('#city').on('change', function() {
      var cityName = $(this).val();
      fetchBarangays(cityName);
    });
  });
});

function fetchProvinces() {
  var provinces = [];
  $.each(window.philippinesData, function(regionIndex, region) {
    $.each(region.province_list, function(provinceName, province) {
      provinces.push(provinceName);
    });
  });

  provinces.sort(); // Sort provinces alphabetically
  $('#province').empty().append('<option value="">Select Province</option>');
  $.each(provinces, function(index, provinceName) {
    $('#province').append('<option value="' + provinceName + '">' + provinceName + '</option>');
  });
}

function fetchCities(provinceName) {
  var cities = [];
  $.each(window.philippinesData, function(regionIndex, region) {
    $.each(region.province_list, function(provName, province) {
      if (provName === provinceName) {
        $.each(province.municipality_list, function(cityName, city) {
          cities.push(cityName);
        });
      }
    });
  });

  cities.sort(); // Sort cities alphabetically
  $('#city').empty().append('<option value="">Select City</option>');
  $.each(cities, function(index, cityName) {
    $('#city').append('<option value="' + cityName + '">' + cityName + '</option>');
  });
}

function fetchBarangays(cityName) {
  var barangays = [];
  $.each(window.philippinesData, function(regionIndex, region) {
    $.each(region.province_list, function(provinceName, province) {
      $.each(province.municipality_list, function(muniName, city) {
        if (muniName === cityName) {
          $.each(city.barangay_list, function(index, barangay) {
            barangays.push(barangay);
          });
        }
      });
    });
  });

  barangays.sort(); // Sort barangays alphabetically
  $('#barangay').empty().append('<option value="">Select Barangay</option>');
  $.each(barangays, function(index, barangay) {
    $('#barangay').append('<option value="' + barangay + '">' + barangay + '</option>');
  });
}


      $("#program").change(function(){
        if ($(this).val() === 'grade11' || $(this).val() === 'grade12' || $(this).val() === 'tesda') {
          $('#myStrand').show();
          $('#strand').prop('required',true);
          $('#Myyear').hide();
          $('#year').val('');
        }else if($(this).val() === 'beed' || $(this).val() === 'bsede' || $(this).val() === 'bsedm' || $(this).val() === 'bsa' || $(this).val() === 'bsais' || $(this).val() === 'bsbafm' || $(this).val() === 'bsbamm' || $(this).val() === 'bscs' || $(this).val() === 'bscrim' || $(this).val() === 'bshm'){
          $('#Myyear').show();
          $('#myStrand').hide();
          $('#year').prop('required',true);
          $('#strand').val('');
        }else{
          $('#strand').prop('required',false);
          $('#strand').val('');
          $('#year').prop('required',false);
          $('#year').val('');
          $('#myStrand').hide();
          $('#Myyear').hide();
        }
      });

    </script>
</body></html>