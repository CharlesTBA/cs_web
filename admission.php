<?php
    include 'connect.php'; 

  
  
    $success_message = "";
    $error_message = "";
    
    // Database connection
    $conn = new mysqli("localhost", "root", "", "cs_db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect all POST data
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
    
        // Insert into student_info
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
                $student_id = $stmt1->insert_id; // Get inserted student_id
    
                // Insert into parents_info
                $stmt2 = $conn->prepare("INSERT INTO parents_info (
                    student_id, fatherfname, fatherlname, fathercontact, fatheraddress,
                    motherfname, motherlname, parentcontactaddress, parentaddress
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
                $stmt2->bind_param("issssssss", $student_id,
                    $fatherfname, $fatherlname, $fathercontact, $fatheraddress,
                    $motherfname, $motherlname, $parentcontactaddress, $parentaddress);
    
                // Insert into guardian_info
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
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta name="keywords" content="Concepcion Holy Cross College, Inc.">
  <meta name="description" content="Concepcion Holy Cross College, Inc. Official Website">
  <meta name="author" content="itsmerealjayson.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Concepcion Holy Cross College, Inc. | Campus Website</title>

  <!-- Favicon -->
  <link rel="shortcut icon"
    href="http://myclass.holycross.edu.ph/pluginfile.php/1/theme_moove/favicon/1610948264/90x90.ico">

  <!-- Google Font -->
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200&display=swap"
    rel="stylesheet">

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
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=campaign" />
  <style>
   
/* Header inside container */
.widget-categories h3 {
  font-size: 1.8rem;
  margin-bottom: 5px;
  font-weight: 700;
  color: #cce6ff; /* light blue */
}

.widget-categories p {
  font-size: 1rem;
  color: #b3d1ff;
  margin-bottom: 20px;
}

/* Form Styles */
#pre_enrollment_form {
  background: #ffffff; /* white background */
  padding: 30px 40px;
  border-radius: 10px;
  box-shadow: 0 6px 12px rgba(0,0,0,0.1);
  color: #004080; /* dark blue text */
  max-width: 700px;
  margin: 0 auto 40px auto;
}

/* Form group spacing */
.form-group {
  margin-bottom: 1.4rem;
}

/* Labels */
.form-group label {
  font-weight: 600;
  color: #004080;
  display: block;
  margin-bottom: 6px;
}

/* Inputs and selects styling */
.form-control {
  width: 100%;
  padding: 10px 14px;
  border: 1.8px solid #004080;
  border-radius: 6px;
  font-size: 1rem;
  transition: border-color 0.3s ease;
  color: #004080;
  background-color: #f0f8ff; /* very light blue */
}

.form-control::placeholder {
  color: #a3c1f0;
}

.form-control:focus {
  border-color: #0066cc;
  outline: none;
  box-shadow: 0 0 8px rgba(0,102,204,0.4);
  background-color: #e6f0ff;
  color: #003366;
}

/* Button styling */
#formsubmitloading {
  background-color: #004080;
  border: none;
  color: white;
  padding: 14px 28px;
  font-size: 1.2rem;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  font-weight: 600;
  width: 100%;
  max-width: 250px;
}

#formsubmitloading:hover {
  background-color: #003366;
}

/* Small note below button */
#pre_enrollment_form small {
  display: block;
  margin-top: 12px;
  color: #004080;
  font-style: italic;
  font-size: 0.9rem;
  text-align: center;
}

#pre_enrollment_form small a {
  color: #004080;
  text-decoration: underline;
}

#pre_enrollment_form small a:hover {
  color: #002244;
  text-decoration: none;
}

/* Responsive tweaks */
@media (max-width: 768px) {
  .widget-categories,
  #pre_enrollment_form {
    padding: 20px;
    margin: 15px;
  }
}

    a {
      overflow: hidden;
      /* Hide scrollbars */
    }

    i {
      overflow: hidden;
      /* Hide scrollbars */
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
    .cnt223 a {
      text-decoration: none;
    }

    .cnt223 u {
      font-weight: bold;
      color: red;
    }

    .popup {
      width: 100%;
      margin: 0 auto;
      display: none;
      position: fixed;
      z-index: 999;
    }

    .cnt223 {
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

    .cnt223 p {
      clear: both;
      color: #555555;
      text-align: justify;
      font-size: 14px;
      font-family: sans-serif;
      line-height: 1.3;
    }

    .cnt223 p a {
      color: #f5ac05;
      font-weight: bold;
    }

    .cnt223 .x {
      float: left;
      height: 35px;
      left: 22px;
      position: relative;
      top: -25px;
      width: 34px;
    }

    .cnt223 .x:hover {
      cursor: pointer;
    }

    /* <blade media|%20(max-width%3A%20540px)%20%7B%0D>.tingle-modal-box__content {
      overflow-y: scroll;
      margin-top: 60px !important;
    }
    } */

    .coures-img img {
      width: 350px;
      /* Set the desired width */
      height: 250px;
      /* Set the desired height */
      object-fit: cover;
      /* Ensures the image fits within the dimensions without distortion */
    }

    .social-icon a {
      display: flex;
      align-items: center;
      gap: 5px;
      /* Reduce spacing */
    }

    .social-icon img {
      width: 20px;
      /* Smaller image */
      height: 20px;
    }

    .contact-icon {
      width: 20px;
      /* Adjust size as needed */
      height: 20px;
      vertical-align: middle;
      margin-right: 10px;
      /* Space between icon and text */
    }

    /* Minimal Icon Style */
    .icon-minimal {
      width: 20px;
      height: 20px;
      object-fit: contain;
      margin-right: 10px;
    }

    /* For contact section */
    .widget .text-primary img {
      width: 20px;
      height: 20px;
      object-fit: contain;
      margin-top: 3px;
    }

    /* Optional: Style for icon links in follow-us section */
    .icon-link {
      display: inline-flex;
      align-items: center;
      margin-bottom: 8px;
      text-decoration: none;
    }

    .icon-minimal {
      width: 10px;
      /* Adjust the width */
      height: 10px;
      /* Adjust the height */
      object-fit: contain;
      /* Ensures the image fits nicely */
      margin-left: 10px;
      /* Space between the text and icon */
      vertical-align: middle;
      /* Aligns the icon in the middle with the text */
    }

    a.d-flex {
      display: flex;
      align-items: center;
    }

    .widget-icons-left {
      display: flex;
      align-items: flex-start;
      gap: 20px;
    }

    .social-icon-stack {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      /* icons aligned to the left */
      gap: 10px;
      list-style: none;
      padding-left: 0;
      margin: 0;
    }

    .icon-minimal {
      width: 28px;
      height: 28px;
      transition: transform 0.2s ease;
    }

    .icon-minimal:hover {
      transform: scale(1.1);
    }

    .follow-title {
      margin: 0;
      font-weight: bold;
    }
     .fixed-button {
  position: fixed;
  bottom: 20px;  /* distance from the bottom */
  right: 20px;   /* distance from the right */
  background-color: #004080;
  color: white;
  padding: 10px 20px;
  text-decoration: none;
  border-radius: 8px;
  font-weight: bold;
  box-shadow: 0 4px 6px rgba(0,0,0,0.2);
}
.fixed-button:hover {
  background-color: #004080;
}
    /* Container for the form and heading */
.widget-categories {
  background-color: #004080; /* deep blue background */
  padding: 30px 40px;
  border-radius: 10px;
  max-width: 700px;
  margin: 20px auto;
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  color: #ffffff;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

  </style>

  <meta property="og:url" content="http://holycross.edu.ph/" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="Holy Cross College | Hail to the Cross, Our only Hope!" />
  <meta property="og:description" content="Concepcion Holy Cross, Inc." />
  <meta property="og:image" content="./hcc/hbgof.png" />
</head>

<body>
  <!-- Load Facebook SDK for JavaScript -->
  <div id="fb-root"></div>
  <script>
    window.fbAsyncInit = function () {
      FB.init({
        xfbml: true,
        version: 'v10.0'
      });
    };

    (function (d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s);
      js.id = id;
      js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>

  <!-- Your Chat Plugin code -->
  <div class="fb-customerchat" attribution="setup_tool" page_id="1025846607460463">
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
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <!-- Navbar toggler END-->

              <!-- Navbar START -->
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                  <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">We Are CHCCI!<img src="down.png" alt="My Icon"
                        width="20"></a>
                    <!-- Dropdown Menu -->
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="board.html">Board of Trustees</a></li>
                          <li><a class="dropdown-item" href="hymn.html">School Hymn</a></li>
                          <li><a class="dropdown-item" href="vision.html">Vision</a></li>
                          <li><a class="dropdown-item" href="mission.html">Mission</a></li>
                          <li><a class="dropdown-item" href="philosophy.html">Philosophy</a></li>
                          <li><a class="dropdown-item" href="corevalues.html">Core Values</a></li>
                          <li><a class="dropdown-item" href="symbols.html">CHCCian Symbols</a></li>
                    </ul>
                  </li>

                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link  dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">Programs<img src="down.png" alt="My Icon" width="20">
                    </a>
                    <!-- Dropdown Menu -->
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="CS/home.php" target="_blank">BS Computer Science</a></li>
                          <li><a class="dropdown-item" href="educ/educ.php" target="_blank">BS Teacher Education</a></li>
                          <li><a class="dropdown-item" href="hm/hm.php" target="_blank">BS Hospitality Management</a></li>
                          <li><a class="dropdown-item" href="crim/crim.php" target="_blank">BS Criminal Justice Education</a></li>
                          <li><a class="dropdown-item" href="nursing/nursing.php" target="_blank">BS Nursing</a></li>
                          <li><a class="dropdown-item" href="ba/page.php" target="_blank">BS Business Administration</a></li>
                    </ul>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link  dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">Admissions<img src="down.png" alt="My Icon" width="20">
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
                    <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false">News<img src="down.png" alt="My Icon" width="20">
                    </a>
                    <!-- Dropdown Menu -->
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="https://www.facebook.com/CHCC.StudentAffairsAndServices">Advisories</a></li>
                    <li><a class="dropdown-item" href="https://www.facebook.com/ConcepcionHolyCrossCollege">Events</a></li>

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
    inner-header -->
  <section class="inner-banner bg-overlay-black-70" style="background-image: url(holycross.jpg); background-size: cover;">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-md-12">
          <div class="text-center">
            <h1 class="text-white">CHCCI E-Admission Form</h1>
          </div>
      
        </div>
      </div>
    </div>
  </section>
  <!--=================================
    inner-header -->

  <!--=================================
    Team -->
  <section class="space-ptb">
    <div class="col-lg-12">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 mb-5 mb-lg-0">

            <!-- Categories -->
           

              <!-- Categories -->

              <!-- Follow on -->
            
        

        
          
            <h3>Register your details here:</h3>
            <p class="text-white mb-0">Fill-out this form to start your #CHCCian journey today!</p>
     

      
          <!-- Personal Info -->
          <div class="form-group col-12">
            <label class="text-dark font-weight-bold">First Name*</label>
            <input type="text" class="form-control" name="firstname" placeholder="First Name" required>
          </div>
          <div class="form-group col-12">
            <label class="text-dark font-weight-bold">Middle Name</label>
            <input type="text" class="form-control" name="middlename" placeholder="Middle Name">
          </div>
          <div class="form-group col-12">
            <label class="text-dark font-weight-bold">Last Name*</label>
            <input type="text" class="form-control" name="lastname" placeholder="Last Name" required>
          </div>
          <div class="form-group col-12">
            <label class="text-dark font-weight-bold">Gender*</label>
            <select name="gender" class="form-control" required>
              <option value="" selected hidden>Select your biological gender identity.</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
          <div class="form-group col-12">
            <label class="text-dark font-weight-bold">Birthdate*</label>
            <input type="date" class="form-control" name="bday" required>
          </div>

          <!-- Address -->
          <div class="form-group col-12">
            <label class="text-dark font-weight-bold">Province*</label>
            <select name="province" id="province" class="form-control" required>
              <option selected hidden value>Choose an option</option>
            </select>
          </div>
          <div class="form-group col-12">
            <label class="text-dark font-weight-bold">City/Municipality*</label>
            <select name="city" id="city" class="form-control" required>
              <option selected hidden value="">Choose an option</option>
            </select>
          </div>
          <div class="form-group col-12">
            <label class="text-dark font-weight-bold">Barangay*</label>
            <select name="barangay" id="barangay" class="form-control" required>
              <option selected hidden value="">Choose an option</option>
            </select>
          </div>
          <div class="form-group col-12">
            <label class="text-dark font-weight-bold">House Number</label>
            <input type="text" class="form-control" name="housenumber" placeholder="House No.">
          </div>

          <!-- Program -->
          <div class="form-group col-12">
            <label class="text-dark font-weight-bold">Grade/Course/Program*</label>
            <select id="program" name="program" class="form-control" required>
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

          <!-- Strand -->
          <div class="form-group col-12" id="myStrand" style="display: none;">
            <label class="text-dark font-weight-bold">Strand <small><i>(for SHS and TESDA only)</i></small></label>
            <select id="strand" name="strand" class="form-control">
              <option value="" selected="">Select the strand you're applying for.</option>
              <option value="ABM">ABM</option>
              <option value="BPP">BPP-NC II</option>
              <option value="CSS">CSS-NC II</option>
              <option value="FANDB">F&B-NC II</option>
              <option value="GAS">GAS</option>
              <option value="HUMSS">HUMSS</option>
              <option value="SMAW">SMAW</option>
              <option value="STEM">STEM</option>
            </select>
          </div>

          <!-- Year Level -->
          <div class="form-group col-12" id="Myyear" style="display: none;">
            <label class="text-dark font-weight-bold">Year <small><i>(for undergraduate only)</i></small></label>
            <select id="year" name="year" class="form-control">
              <option value="" selected hidden="">Select the year</option>
              <option value="1st Yr.">First Year</option>
              <option value="2nd Yr.">Second Year</option>
              <option value="3rd Yr.">Third Year</option>
              <option value="4th Yr.">Fourth Year</option>
            </select>
          </div>

          <!-- Contact Info -->
          <div class="form-group col-12">
            <label class="text-dark font-weight-bold">Student Mobile Number*</label>
            <input type="number" name="mobilenumber" class="form-control" placeholder="Mobile Number" required>
          </div>
          <div class="form-group col-12">
            <label class="text-dark font-weight-bold">Student Email Address*</label>
            <input type="email" class="form-control" name="email" placeholder="Email Address" required>
          </div>



          <!-- Father's Info -->
          <div class="form-group col-12"><label class="text-dark font-weight-bold">Father's Name</label></div>
          <div class="form-group col-6"><input type="text" name="fatherfname" class="form-control"
              placeholder="Firstname"></div>
          <div class="form-group col-6"><input type="text" name="fatherlname" class="form-control"
              placeholder="Lastname"></div>
          <div class="form-group col-12">
            <label class="text-dark font-weight-bold">Contact Number</label>
            <input type="text" name="fathercontact" class="form-control" placeholder="Contact Number">
          </div>
          <div class="form-group col-12">
            <label class="text-dark font-weight-bold">Address</label>
            <input type="text" name="fatheraddress" class="form-control" placeholder="Address">
          </div>



          <!-- Mother's Info -->
          <div class="form-group col-12"><label class="text-dark font-weight-bold">Mother's Name</label></div>
          <div class="form-group col-6"><input type="text" name="motherfname" class="form-control"
              placeholder="Firstname"></div>
          <div class="form-group col-6"><input type="text" name="motherlname" class="form-control"
              placeholder="Lastname"></div>
          <div class="form-group col-12">
            <label class="text-dark font-weight-bold">Contact Number</label>
            <input type="text" name="parentcontactaddress" class="form-control" placeholder="Mobile Number">
          </div>
          <div class="form-group col-12">
            <label class="text-dark font-weight-bold">Address</label>
            <input type="text" name="parentaddress" class="form-control" placeholder="Address">
          </div>


          <!-- Guardian's Info -->
          <div class="form-group col-12"><label class="text-dark font-weight-bold">Guardian's Name</label></div>
          <div class="form-group col-6"><input type="text" name="guardianfname" class="form-control"
              placeholder="Firstname"></div>
          <div class="form-group col-6"><input type="text" name="guardianlname" class="form-control"
              placeholder="Lastname"></div>
          <div class="form-group col-12">
            <label class="text-dark font-weight-bold">Address</label>
            <input type="text" name="guardianaddress" class="form-control" placeholder="Guardian Address">
          </div>
          <div class="form-group col-12">
            <label class="text-dark font-weight-bold">Contact Number</label>
            <input type="text" name="guardiancontact" class="form-control" placeholder="Guardian Contact Number">
          </div>

          <!-- Submit -->
          <div class="form-group col-12 text-center">
            <button type="submit" class="btn btn-primary" id="formsubmitloading">Enroll Now!</button><br>
           
          </div>
        </form>

        <p class="text-center">If you have previously enrolled online, you may validate & confirm your enrollment by
          UPLOADING a copy of your PROOF OF PAYMENT <a href="">here.</a></p>
      </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
  </section>
  <!--=================================
    Call to action -->

  <!--=================================
    Footer-->
  <footer class="space-pt bg-overlay-black-90 bg-holder footer mt-n5"
    style="background-image: url(ok1.jpg);">
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
          <p class="text-white">Our offices and online support team are available every Monday to Friday from 8 AM to 4
            PM only.</p>
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
            <p class="mb-0 text-white">©Copyright 2020 <a href="#">Concepcion Holy Cross College Inc. - Management
                Information Systems</a> <br> All Rights Reserved | Maintained & Made with ❤ by <a
                href="https://www.facebook.com/CHCCIComputerStudiesStudentCouncil">SCS</a></p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <a href="index.php" class="fixed-button">home</a>
  <!--=================================
      Back To Top-->
  
  <!--=================================
      Back To Top-->
  <!--=================================
      Javascript -->

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
  <script src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations-v1.0.0.js"></script>
  <!-- Template Scripts (Do not remove)-->
  <script src="./hcc/custom.js.download"></script>
  <script src="./hcc/tingle.js"></script>
  <script src="./hcc/custom.js"></script>

  <script type="text/javascript">
    $("#program").change(function () {
      if ($(this).val() === 'grade11' || $(this).val() === 'grade12' || $(this).val() === 'tesda') {
        $('#myStrand').show();
        $('#strand').prop('required', true);
        $('#Myyear').hide();
        $('#year').val('');
      } else if ($(this).val() === 'beed' || $(this).val() === 'bsede' || $(this).val() === 'bsedm' || $(this)
        .val() === 'bsa' || $(this).val() === 'bsais' || $(this).val() === 'bsbafm' || $(this).val() === 'bsbamm' ||
        $(this).val() === 'bscs' || $(this).val() === 'bscrim' || $(this).val() === 'bshm') {
        $('#Myyear').show();
        $('#myStrand').hide();
        $('#year').prop('required', true);
        $('#strand').val('');
      } else {
        $('#strand').prop('required', false);
        $('#strand').val('');
        $('#year').prop('required', false);
        $('#year').val('');
        $('#myStrand').hide();
        $('#Myyear').hide();
      }
    });

    $(document).ready(function () {
      // Fetch the JSON data on page load
      $.getJSON(
        'https://raw.githubusercontent.com/flores-jacob/philippine-regions-provinces-cities-municipalities-barangays/master/philippine_provinces_cities_municipalities_and_barangays_2019v2.json',
        function (data) {
          window.philippinesData = data; // Store the data in a global variable

          // Populate provinces
          fetchProvinces();

          // Event listener for province change
          $('#province').on('change', function () {
            var provinceName = $(this).val();
            fetchCities(provinceName);
          });

          // Event listener for city change
          $('#city').on('change', function () {
            var cityName = $(this).val();
            fetchBarangays(cityName);
          });
        });
    });

    function fetchProvinces() {
      var provinces = [];
      $.each(window.philippinesData, function (regionIndex, region) {
        $.each(region.province_list, function (provinceName, province) {
          provinces.push(provinceName);
        });
      });

      provinces.sort(); // Sort provinces alphabetically
      $('#province').empty().append('<option value="">Select Province</option>');
      $.each(provinces, function (index, provinceName) {
        $('#province').append('<option value="' + provinceName + '">' + provinceName + '</option>');
      });
    }

    function fetchCities(provinceName) {
      var cities = [];
      $.each(window.philippinesData, function (regionIndex, region) {
        $.each(region.province_list, function (provName, province) {
          if (provName === provinceName) {
            $.each(province.municipality_list, function (cityName, city) {
              cities.push(cityName);
            });
          }
        });
      });

      cities.sort(); // Sort cities alphabetically
      $('#city').empty().append('<option value="">Select City</option>');
      $.each(cities, function (index, cityName) {
        $('#city').append('<option value="' + cityName + '">' + cityName + '</option>');
      });
    }

    function fetchBarangays(cityName) {
      var barangays = [];
      $.each(window.philippinesData, function (regionIndex, region) {
        $.each(region.province_list, function (provinceName, province) {
          $.each(province.municipality_list, function (muniName, city) {
            if (muniName === cityName) {
              $.each(city.barangay_list, function (index, barangay) {
                barangays.push(barangay);
              });
            }
          });
        });
      });

      barangays.sort(); // Sort barangays alphabetically
      $('#barangay').empty().append('<option value="">Select Barangay</option>');
      $.each(barangays, function (index, barangay) {
        $('#barangay').append('<option value="' + barangay + '">' + barangay + '</option>');
      });
    }
  </script>

</body>

</html>