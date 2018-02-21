<?php
  $url =  'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

  // if(!isset($_SESSION['user_id'])){
  //   if($_SERVER['HTTP_HOST'] == 'makeadiff.in')
  //     header('Location :'.'http://makeadiff.in/madapp/index.php/auth/login/' . base64_encode($url));
  //   else
  //     header('Location :'.'http://localhost/makeadiff/madapp/index.php/auth/login/' . base64_encode($url));
  // }

  include ('db/config.php');

  //Find the configuratio files in db/config.php
?>


<!DOCTYPE html>
<html lang="en" >

    <head>
        <meta charset="UTF-8">
        <title>Retention and Sign Up Form - Make A Difference</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
        <link rel="shortcut icon" href="/var/www/html/SignUpForm/favicon.png" type="image/png">
        <link rel="stylesheet" href="css/style.css">
        <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
        <style>
            html{font-size:20pt}
            .choice {
                float: right;
                display: inline;
                margin-left: 3em;
            }
            .choice input {
                vertical-align: left;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h1 class="span12 fs-main-title text-center">Retention and Succession Form</h1>
        </div>
        <!-- MultiStep Form -->
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form id="msform" action="preview.php" method="POST" novalidate>
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active">Personal Details</li>
                        <li>Role Compatibility</li>
                        <li>Sign Up</li>
                        <li>Recommendation</li>
                        <li>Referrals</li>
                        <li>Submit</li>
                        </ul>
                    <!-- fieldsets -->

                    <!-- Verify your details -->
                    <fieldset>
                        <h2 class="fs-title">Personal Information</h2>
                        <h3 class="fs-subtitle"> Verify Your Details</h3><hr>
                        <input type='text' name="user_id" class="hidden" value= "<?php echo $user['id'] ?>"/>
                        <input type='text' name="user_city_id" class="hidden" value= "<?php echo $user['city_id'] ?>"/>
                        <input type="text" name="user_name" placeholder="Your Full Name" value= "<?php echo $user['name'] ?>" required=""/><hr>
                        <input type="email" name="user_email" placeholder="Email Address" value="<?php echo $user['email'] ?>" required=""/><hr>
                        <input type="text" name="user_phone" placeholder="Phone" value = "<?php echo $user['phone'] ?>" required=""/><hr>
                        <select id ="soflow" name="user_sex" value ="f">
                                 <option >Gender</option>
                                 <option value="m" <?php if($user['sex'] == 'm') echo ' selected="selected"'?>>Male</option>
                                 <option value="f" <?php if($user['sex'] == 'f') echo ' selected="selected"'?>>Female</option>
                                 <option value="o" <?php if($user['sex'] == 'o') echo ' selected="selected"'?>>Other</option>
                        </select><br><br><hr>
                        <input type="date" name="user_birthday" placeholder="birthday" value="<?php echo $user['birthday'] ?>" required=""><hr>
                        <input type="text" name="user_address" placeholder="Enter Your Address" value="<?php echo $user['address'] ?>" required=""/><hr><br>
                        <p align="left"> Are you planning to continue next year?</p>
                        <select id ="soflow" name="cont_status" >
                                 <option value="1" >Yes</option>
                                 <option value="0" >No</option>
                        </select><br><br><hr>
                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>

                    <!-- Role Compatibility Survey -->
                    <fieldset>
                        <h2 class="fs-title">Role Compatibility</h2>
                        <h3 class="fs-subtitle">Self Analysis</h3><hr>
                        <?php
                          $indx=1;
                          $last_question_id = 0;
                          foreach ($result as $qna) {

                            $form_input = '<div class="col-sm-12">
                                            <input type="radio" name="survey_question_'.$qna['question_id'].'" value="'.$qna['answer_id'].'">
                                            <label class="radio-inline">
                                              '.$qna['answer'].'
                                            </label>
                                           </div>';

                            if($qna['question_id']==$last_question_id){
                              echo $form_input;
                            }
                            else{
                              if($indx!=1){
                                echo '</div>'.'<hr/>';
                              }
                              echo '<p align=left>'.$indx.'. '.$qna['question'].'</p>'.'<div class="row">';
                              $indx++;
                              $last_question_id = $qna['question_id'];
                              echo $form_input;
                            }
                          }
                        ?>
                          </div>
                          <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                          <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>

                    <!-- SignUp page -->
                    <fieldset>
                        <h2 class="fs-title">Sign Up</h2>
                        <h3 class="fs-subtitle"></h3>
                        <hr>
                        <img src="img/succession.png" alt="Mountain View" style="width:100%;height:auto;">
                        <h3 align=left class="fs-subtitle">Dear MADster,<br><br>Having filled the role compatibility questionnaire, we hope you have gotten a better insight into your current interests and prospective commitment you can make to MAD.<br>If majority of your answers were Yes, then we would highly recommend you to apply for the role of a Fellow, Strategist, Wingman or a Mentor as these role require a higher level of ownership and commitment as you would be multiplying the impact on ground.<br><br>If your answers were majorly kind of and a few no, we would recommend you to really think about whether you are ready to invest the time and effort to build the skills with the support we will be providing you as well as understand the expected commitment towards Make A Difference for the upcoming year and make an informed decision to take on Fellowship, Strategist, Wingman, Mentor and volunteering profiles.<br><br>We believe that every person can make a difference and if you have identified that you will not be able to commit to MAD in the expected collective capacity we would recommend you to join our Alumni network and work towards transforming outcomes for children in an individual capacity.<br><br>We are in this journey together and we look hope you choose wisely.</h3><hr>

                        <p align=left>What Profile would I be interested to sign up for?</p>
                        <!-- pull roles frommuser group table -->
                        <select id ="user_group_preference_id" name="user_group_preference_name" >
                                 <option selected value="">Roles</option>
                                 <option value=0 selected>Fellow</option>
                                 <option value=8>Mentor</option>
                                 <option value=9>ASV(5th-10th)</option>
                                 <option value=349>ASV(11th-12th)</option>
                                 <option value=348>Wingman</option>
                                 <option value=999>Alumni</option>
                        </select><br><hr>

                        <!-- <input type='text' id="other" class="hidden" /><br><br><hr> -->

                        <div id="hidden_div" class="indented">
                          <p align=left>What is Fellowship profile first preference?</p>
                          <select id ="fellow_prefernece1_id" name="fellow_prefernece1_name" value ="">
                             <option selected value="" selected>Select Role</option>
                             <?php echo $options_fellow; ?>
                          </select><br><hr>

                          <p align=left>What is Fellowship profile second preference?</p>
                          <select id ="fellow_prefernece2_id" name="fellow_prefernece2_name" value ="">
                            <option selected value="" selected>Select Role</option>
                            <?php
                              echo $options_fellow;
                              echo $options_volunteer;
                            ?>
                          </select><br><hr>

                          <p align=left>What is Fellowship profile third preference?</p>
                          <select id ="fellow_prefernece3_id" name="fellow_prefernece3_name" value ="">
                            <option selected value="" selected>Select Role</option>
                            <?php
                              echo $options_fellow;
                              echo $options_volunteer;
                            ?>
                          </select><br><hr>
                        </div>

                        <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>

                    <!-- recommendation -->
                    <fieldset>

                        <h2 class="fs-title">Recommendation</h2>
                        <h3 class="fs-subtitle"></h3><hr>
                        <h3 align=left class="fs-subtitle">This is your opportunity to voice your choice of City Managers (Fellows) for your city for the upcoming year.<br>You've gone through the role compatibility screening and read about what it takes to be a fellow.<br><br>Keeping that in mind, fill in the following.
                        </h3><hr>

                        <input type="text" id="tags1" required="" class="auto" name="recommendation1_name" placeholder=" Potential Fellowship/Mentorship Candidate 1" >
                        <p align=left>Recommended Profile:</p>
                            <select id ="recommendation_role1_id" name="recommendation1_role_name" value ="">
                                     <option selected value="">Roles</option>
                                     <?php echo $options_fellow; ?>
                            </select>
                        <br><br><hr>
                        <input type="text" id="tags2" required="" class="auto" name="recommendation2_name" placeholder=" Potential Fellowship/Mentorship Candidate 2" >
                        <p align=left>Recommended Profile:</p>
                            <select id ="recommendation_role2_id" name="recommendation2_role_name" value ="">
                                     <option selected value="">Roles</option>
                                     <?php echo $options_fellow; ?>
                            </select>
                        <br><br><hr>
                        <input type="text" id="tags3" required="" class="auto" name="recommendation3_name" placeholder=" Potential Fellowship/Mentorship Candidate 3" >
                        <p align=left>Recommended Profile:</p>
                            <select id ="recommendation_role3_id" name="recommendation3_role_name" value ="">
                                     <option selected value="">Roles</option>
                                     <?php echo $options_fellow; ?>
                            </select>
                        <br><br><hr>
                        <br><input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>

                    <!--referral-->
                    <fieldset>
                        <h2 class="fs-title">Refer</h2>
                        <h3 align=left class="fs-subtitle">If you know someone who has the spark to join and Make A Difference, refer them.
                        </h3><hr>
                        <h3 class="fs-subtitle">Person 1</h3><hr>
                        <input type="text" name="referral1_name" placeholder="Full Name" value= "" required=""/><hr>
                        <input type="email" name="referral1_email" placeholder="Email Address" value="" required=""/><hr>
                        <input type="text" name="referral1_phone" placeholder="Phone" value = "" required=""/><hr>
                        <h3 class="fs-subtitle">Person 2</h3><hr>
                        <input type="text" name="referral2_name" placeholder="Full Name" value= "" required=""/><hr>
                        <input type="email" name="referral2_email" placeholder="Email Address" value="" required=""/><hr>
                        <input type="text" name="referral2_phone" placeholder="Phone" value = "" required=""/><hr>
                        <h3 class="fs-subtitle">Person 3</h3><hr>
                        <input type="text" name="referral3_name" placeholder="Full Name" value= "" required=""/><hr>
                        <input type="email" name="referral3_email" placeholder="Email Address" value="" required=""/><hr>
                        <input type="text" name="referral3_phone" placeholder="Phone" value = "" required=""/><hr>

                        <br><input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>



                    </fieldset>

                    <!-- Submit -->
                    <fieldset>
                        <h2 class="fs-title">Submit</h2><hr>
                        <h3 class="fs-subtitle">Thank You For Your Response</h3><hr>
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                        <input type="submit" name="submit" class="submit action-button" value="Submit" href="preview.php"/>
                    </fieldset>
                </form>
            </div>
        </div>

        <!-- /.MultiStep Form -->
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
        <script src='https://code.jquery.com/ui/1.10.4/jquery-ui.js'></script>
        <script  src="js/index.js"></script>

        <script>
          document.getElementById('user_group_preference_id').addEventListener('change', function () {
              var style = this.value == 0 ? 'block' : 'none';
              document.getElementById('hidden_div').style.display = style;
              });
          $(function() {
            var availableTags =  <?php echo json_encode($volunteer); ?>;
            console.log(availableTags);
          $( "#tags1" ).autocomplete({
              source: availableTags,
              autoFocus:true
            });
          $( "#tags2" ).autocomplete({
              source: availableTags,
              autoFocus:true
            });
          $( "#tags3" ).autocomplete({
              source: availableTags,
              autoFocus:true
            });
          } );
        </script>


    </body>

</html>
