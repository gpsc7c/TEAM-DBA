<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registration Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/registyle.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="./js/registration.js"></script>
  <style>
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    input:required:invalid {
      background-color: lightyellow;
    }
    select:required:invalid {
        background-color: lightyellow;
    }
  </style>
</head>
<body onload="regHandlers();">

<?php
include 'inputvalidation.php';
?>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="container wrapper">
            <div class="wrapper">
                <div id="menubar">
                    <header>
                        <nav>
                            <img src="./img/774FNS.JPG" alt="Logo" style="left: 0; float:left; width: 100px; overflow: auto">
                            <ul>
                                <button><li class="menuitem"><a href="index.php">Home</a></li></button>
                                <button><li class="menuitem"><a href="registration.php">Registration</a></li></button>
                                <button><li class="menuitem"><a href="animations.php">Animations</a></li></button>
                            </ul>
                        </nav>
                    </header>
                </div>
            </div>
        </div>
    </div>
</nav>

<!--onsubmit="return mySubmitFunction(event)"-->

<div class="col-sm-9">
  <h1> Sign up for the newsletter!</h1>
    <p>fields marked with an "*" are required</p>
  <div id="main">
    <form method="POST" id="regi" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" novalidate>

      <div class="cell" id="namediv">
        <label for="username">* Username:</label>
        <input class="has-none" id="username" type="text" name="username"
               value="<?php echo $username; ?>" maxlength="50" minlength="6" placeholder="A" required>
          <span id="nameerr" class ="hidden">Username too short</span>
        <span id="nameerr2" class ="error"> <?php echo $nameErr;?></span>
      </div>
      <div class="cell" id="passdiv">
        <label for="password">* Password:</label>
        <input class="has-none" id="password" type="password" name="password" maxlength="50" minlength="8"
               value="<?php echo $password; ?>" required>
          <span id="passerr" class ="hidden">You did not enter a password of at least length 8</span>
          <span id="passerr2" class ="hidden">Make sure that your password has at least one capital letter, one lowercase letter, one number, and one symbol</span>
        <span id="passerr3" class ="error"> <?php echo $passErr;?></span>
        <div id="passrules"> Must include at least one of each of: capital [A-Z], lowercase [a-z], number [0-9], symbol [!#$%...]</div>
      </div>
      <div class="cell" id="reppassdiv" >
        <label for="passwordrepeat">* Repeat Password:</label>
        <input class="has-none" id="repPass" type="password" name="repPass" maxlength="50" minlength="8"
               value="<?php echo $repPass; ?>" required>
          <span id="reppasserr" class ="hidden">The passwords do not match, re-enter both.</span>
        <span id="reppasserr2" class ="error"> <?php echo $repPassErr;?></span>
      </div>
      <div class="cell" id="firstdiv">
        <label for="firstname">* First Name:</label>
        <input id="firstname" class="has-none" type="text" name="first" maxlength="50" placeholder="Marshall"
               value="<?php echo $first; ?>" required>
          <span id="firstnerr" class ="hidden">No name input</span>
        <span id="firstnerr2" class ="error"> <?php echo $firstErr;?></span>
      </div>
      <div class="cell" id="lastdiv">
        <label for="lastname">* Last Name:</label>
        <input id="lastname" class="has-none" type="text" name="last" maxlength="50" placeholder="Wynters"
               value="<?php echo $last; ?>" required>
          <span id="lastnerr" class ="hidden">No name input</span>
        <span id="lastnerr2" class ="error"> <?php echo $lastErr;?></span>
      </div>
      <div class="cell" id="statediv">
        <label for="usstates">* State:</label>
        <select id="usstates" name="state" class="has-none"
                value= required>
            <option value="" <?php if(empty($state)) echo "selected";?>)>Select a state...</option>
            <option value="AL" <?php if($state == "AL") echo "selected"; ?>>Alabama</option>
            <option value="AK" <?php if($state == "AK") echo "selected"; ?>>Alaska</option>
            <option value="AZ" <?php if($state == "AZ") echo "selected"; ?>>Arizona</option>
            <option value="AR" <?php if($state == "AL") echo "selected"; ?>>Arkansas</option>
            <option value="CA" <?php if($state == "CA") echo "selected"; ?>>California</option>
            <option value="CO" <?php if($state == "CO") echo "selected"; ?>>Colorado</option>
            <option value="CT" <?php if($state == "CT") echo "selected"; ?>>Connecticut</option>
            <option value="DE" <?php if($state == "DE") echo "selected"; ?>>Delaware</option>
            <option value="DC" <?php if($state == "DC") echo "selected"; ?>>District of Columbia</option>
            <option value="FL" <?php if($state == "FL") echo "selected"; ?>>Florida</option>
            <option value="GA" <?php if($state == "GA") echo "selected"; ?>>Georgia</option>
            <option value="HI" <?php if($state == "HI") echo "selected"; ?>>Hawaii</option>
            <option value="ID" <?php if($state == "ID") echo "selected"; ?>>Idaho</option>
            <option value="IL" <?php if($state == "IL") echo "selected"; ?>>Illinois</option>
            <option value="IN" <?php if($state == "IN") echo "selected"; ?>>Indiana</option>
            <option value="IA" <?php if($state == "IA") echo "selected"; ?>>Iowa</option>
            <option value="KS" <?php if($state == "KS") echo "selected"; ?>>Kansas</option>
            <option value="KY" <?php if($state == "KY") echo "selected"; ?>>Kentucky</option>
            <option value="LA" <?php if($state == "LA") echo "selected"; ?>>Louisiana</option>
            <option value="ME" <?php if($state == "ME") echo "selected"; ?>>Maine</option>
            <option value="MD" <?php if($state == "MD") echo "selected"; ?>>Maryland</option>
            <option value="MA" <?php if($state == "Ma") echo "selected"; ?>>Massachusetts</option>
            <option value="MI" <?php if($state == "MI") echo "selected"; ?>>Michigan</option>
            <option value="MN" <?php if($state == "MN") echo "selected"; ?>>Minnesota</option>
            <option value="MS" <?php if($state == "MS") echo "selected"; ?>>Mississippi</option>
            <option value="MO" <?php if($state == "MO") echo "selected"; ?>>Missouri</option>
            <option value="MT" <?php if($state == "MT") echo "selected"; ?>>Montana</option>
            <option value="NE" <?php if($state == "NE") echo "selected"; ?>>Nebraska</option>
            <option value="NV" <?php if($state == "NV") echo "selected"; ?>>Nevada</option>
            <option value="NH" <?php if($state == "NH") echo "selected"; ?>>New Hampshire</option>
            <option value="NJ" <?php if($state == "NJ") echo "selected"; ?>>New Jersey</option>
            <option value="NM" <?php if($state == "NM") echo "selected"; ?>>New Mexico</option>
            <option value="NY" <?php if($state == "NY") echo "selected"; ?>>New York</option>
            <option value="NC" <?php if($state == "NC") echo "selected"; ?>>North Carolina</option>
            <option value="ND" <?php if($state == "ND") echo "selected"; ?>>North Dakota</option>
            <option value="OH" <?php if($state == "OH") echo "selected"; ?>>Ohio</option>
            <option value="OK" <?php if($state == "OK") echo "selected"; ?>>Oklahoma</option>
            <option value="OR" <?php if($state == "OR") echo "selected"; ?>>Oregon</option>
            <option value="PA" <?php if($state == "PA") echo "selected"; ?>>Pennsylvania</option>
            <option value="RI" <?php if($state == "RI") echo "selected"; ?>>Rhode Island</option>
            <option value="SC" <?php if($state == "SC") echo "selected"; ?>>South Carolina</option>
            <option value="SD" <?php if($state == "SD") echo "selected"; ?>>South Dakota</option>
            <option value="TN" <?php if($state == "TN") echo "selected"; ?>>Tennessee</option>
            <option value="TX" <?php if($state == "TX") echo "selected"; ?>>Texas</option>
            <option value="UT" <?php if($state == "UT") echo "selected"; ?>>Utah</option>
            <option value="VT" <?php if($state == "VT") echo "selected"; ?>>Vermont</option>
            <option value="VA" <?php if($state == "VA") echo "selected"; ?>>Virginia</option>
            <option value="WA" <?php if($state == "WA") echo "selected"; ?>>Washington</option>
            <option value="WV" <?php if($state == "WV") echo "selected"; ?>>West Virginia</option>
            <option value="WI" <?php if($state == "WI") echo "selected"; ?>>Wisconsin</option>
            <option value="WY" <?php if($state == "WY") {echo "selected";} ?>>Wyoming</option>
        </select>
          <span id="stateerr" class ="hidden">No selection</span>
        <span id="stateerr2" class ="error"> <?php echo $stateErr;?></span>
      </div>
      <div class="cell" id="citydiv">
        <label for="city">* City:</label>
        <input class="has-none" id="city" type="text" name="city" maxlength="50"
               value="<?php echo $city; ?>" required>
          <span id="cityerr" class ="hidden">No city name</span>
        <span id="cityerr2" class ="error"> <?php echo $cityErr;?></span>
      </div>
      <div class="cell" id="addressdiv">
        <label for="city">* Address:</label>
        <input class="has-none" id="address" type="text" name="address" maxlength="100"
               value="<?php echo $address; ?>" required>
          <span id="addrerr" class ="hidden">No address given</span>
        <span id="addrerr2" class ="error"> <?php echo $addressErr;?></span>
      </div>
      <div class="cell" id="address2div">
        <label for="city">Addr Line 2:</label>
        <input class="has-none" id="address2" type="text" name="address2" maxlength="100" value="<?php echo $address2; ?>">
      </div>
      <div class="cell" id="zipdiv">
        <label for="zipcode">* Zip Code:</label>
        <input class="has-none" id="zipcode" type="text" name="zip" size="10" placeholder="5555-55555" title="xxx-xxxxx"
               value="<?php echo $zip; ?>" required pattern="^[0-9]{5}(?:-[0-9]{4})?$">
          <span id="ziperr" class ="hidden">A zip code should be 5 or 9 digits in length</span>
        <span id="ziperr2" class ="error"> <?php echo $zipErr;?></span>
      </div>
      <div class="cell" id="phonediv">
        <label for="phonenumber">* Phone Number:</label>
        <input class="has-none" id="phonenumber" type="tel" name="phone" maxlength="12"
             value="<?php echo $phone; ?>" required/>
          <span id="phoneerr" class ="hidden">A phone number should be 10 digits in length</span>
        <span id="phoneerr2" class ="error"> <?php echo $phoneErr;?></span>
        <div id="phonerules">Phone number MUST be in ###-###-#### format.</div>
      </div>
      <div class="cell" id="maildiv">
        <label for="email">* Email Address:</label>
        <input class="has-none" id="email" type="email" name="mail"
               value="<?php echo $mail; ?>" name="email" required>
          <span id="mailerr" class ="hidden">An e-mail address should be in the format x@x.x (where x = any number of alphanumeric characters)</span>
        <span id="mailerr2" class ="error"> <?php echo $mailErr;?></span>
      </div>
      <div class="cell" id="gendiv">
        <label for="genidindiv">* Gender Identity:</label>
        <div class="has-none" id = genidindiv>
          <label for="male" id="malelabel">Male</label>
          <input type="radio" id="male" name="genid" value="male" <?php if ($genid == "male") {echo "checked";} ?>  required>
          <label for="fem" id="femlabel">Female</label>
          <input type="radio" id="fem" name="genid" value="female" <?php if ($genid == "female") {echo "checked";} ?>  required>
          <label for="oth" id="othlabel">Other</label>
          <input type="radio" id="oth" name="genid" value="other" <?php if ($genid == "other") {echo "checked";} ?>  required>
        </div>
          <span id="generr" class ="hidden">No gender given.</span>
        <span id="generr2" class ="error"> <?php echo $genErr;?></span>
      </div>
      <div class="cell" id="mardiv">
        <label for="marindiv">* Marital Status:</label>
        <div class="has-none" id = marindiv>
          <label for="single" id="singlabel">Single</label>
          <input type="radio" id="single" name="marid" value="single" <?php if ($marid == "single") {echo "checked";} ?> required>
          <label for="married" id="marlabel">Married</label>
          <input type="radio" id="married" name="marid" value="married" <?php if ($marid == "married") {echo "checked";} ?> required>
        </div>
          <span id="marierr" class ="hidden">No marital status given.</span>
        <span id="marrerr2" class ="error"> <?php echo $marrErr;?></span>
      </div>
      <div class="cell" id="birthdiv">
          <label for="birthday">* Date of Birth:</label>
          <input class="has-none" id="birthday" type="date" name="birth" required
                 value="<?php echo $birth; ?>">
          <span id="birtherr" class ="hidden">No birthday given.</span>
          <span id="birtherr2" class ="error"> <?php echo $birthErr; ?></span>
      </div>
      <div class="cell" id="subdiv">
        <label for="submit">Submit:</label>
        <input class="has-none" type="submit" value="Submit" id="submit">
      </div>
      <div class="cell" id="resdiv">
        <label for="reset">Reset All Values:</label>
        <input type="reset" value="Reset" id="reset">
      </div>
      </table>
    </form>
      <?php

      if ($isValid) {
      ?>

      <form id="hiddenForm" name="hiddenForm" method="POST" action="confirmation.php" >
            <?php
                foreach($_POST as $key => $value) {
                    ?>
                    <input name="<?php echo $key;?>"
                           value="<?php echo $value;?>"
                           type="hidden"/>
                    <?php
                }
          ?>
      </form>
      <script>
          document.createElement('form').submit.call(document.getElementById('hiddenForm'));
      </script>
      <?php
      }
      ?>
  </div>
</div>



<div class="container wrapper">
  <div class="wrapper">
    <div id="footer">
      <nav>
        <ul>
        </ul>
      </nav>
    </div>
  </div>
</div>


</body>
</html>