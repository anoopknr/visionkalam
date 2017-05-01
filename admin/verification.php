<?php
  include_once ("../include/config.php");
  include_once ("../include/functions.php");
  include_once ('dashboard.php');

  session_start();
  if(!isset($_SESSION["authenticated"]))
            header('Location:./');

  $pending_projects_Sql="SELECT post_id,contributer_id,donation_id,student_id,donation_address FROM Donation_Process_DB ";
  $pending_projects_Result=mysqli_query($conn,$pending_projects_Sql);
  $pending_projects_count = mysqli_num_rows($pending_projects_Result);
  echo '<link rel="stylesheet" href="http://localhost/vk/css/admin_style.css">';
  echo '<link rel="stylesheet" href="http://localhost/vk/css/form_style.css">';
  echo '<link rel="stylesheet" href="http://localhost/vk/css/message_style.css">';
  echo '<h2>Pending Actions :</h2>';
  if($pending_projects_count==0)
    {
        echo '<div class="message">
  <div class="message_padding">
    !
  </div>
  <div class="message_body">
    <p>No Pending Actions </p>
  </div>
  </div>';
    }
  else
  {
      for($i=1;$i<=$pending_projects_count;$i++)
      {
          $pending_projects_details = mysqli_fetch_array($pending_projects_Result);
          $project_id=$pending_projects_details['post_id'];
          $student_id=$pending_projects_details['student_id'];
          $donation_id=$pending_projects_details['donation_id'];
          $contributer_id=$pending_projects_details['contributer_id'];
          $address=$pending_projects_details['donation_address'];

          $projects_details_Sql="SELECT post_subject,post_link FROM Post_DB WHERE post_id=$project_id";
          $projects_details_Result=mysqli_query($conn,$projects_details_Sql);
          $projects_details = mysqli_fetch_array($projects_details_Result);
          $project_name=$projects_details['post_subject'];
          $project_link=$projects_details['post_link'];

          $student_details_Sql="SELECT student_name,student_unique_id FROM Student_DB WHERE student_id=$student_id";
          $student_details_Result=mysqli_query($conn,$student_details_Sql);
          $student_details = mysqli_fetch_array($student_details_Result);
          $student_name=$student_details['student_name'];
          $student_uid=$student_details['student_unique_id'];
          
          $contributer_details_Sql="SELECT contributer_name,contributer_unique_id,contributer_email FROM Contributer_DB WHERE contributer_id=$contributer_id";
          $contributer_details_Result=mysqli_query($conn,$contributer_details_Sql);
          $contributer_details = mysqli_fetch_array($contributer_details_Result);
          $contributer_uid=$contributer_details['contributer_unique_id'];
          $contributer_name=$contributer_details['contributer_name'];
          $email=$contributer_details['contributer_email'];

            echo '    
  <div class="msgBox">
        <table cellpadding="0" cellspacing="0">
                     
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td> ADDRESS <br/>                            
                                '.nl2br($address).'
                            </td>
                            
                            <td>
                                invoice no  :  '.$i.'
                                <br> donation id :  '.$donation_id.'
                                <br>  '.$email.'
                                <br> '.date("jS F Y h:i:s A").'
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                   Contributor  
                </td>
                
                <td>
                    <a href="http://localhost/vk/donater-profile/index.php?donater='.$contributer_uid.'"> '.$contributer_name.'</a> 
                </td>
            </tr>

            <tr class="heading">
                <td>
                   Project  
                </td>
                
                <td>
                   <a href="http://'.$project_link.'" >'.$project_name.' </a> 
                </td>
            </tr>

          <tr class="heading">
                <td>
                   Student 
                </td>
                
                <td>
                   <a href="http://localhost/vk/student-profile/index.php?student='.$student_uid.'"> '.$student_name.'</a> 
                </td>
            </tr>
            <button style=" width : 200px; float: right;background:#527ABE; margin-right : 10px;"onclick="window.location.href=\'donation_conform.php?donation_id='.$donation_id.'\'"> Verify Donation</button>

        </table>
    </div>';
      }
  }
?>