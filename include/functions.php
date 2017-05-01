 <?php
function validate_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function getStateName($statenumber)
    {
         $states= array( 1 => 'Andaman and Nicobar islands' ,'Andhra Pradesh','Arunachal Pradesh',
        'Assam','Bihar','Chandigarh','Chattisgarh','Dadra and Nagar Haveli','Daman and Diu',
        'Delhi','Goa','Gujarat','Haryana','Himachal Pradesh','Jammu and Kashmir','Jharkhand',
        'Karnataka','Kerala','Lakshadweep','Madhya Pradesh','Maharashtra','Manipur','Meghalaya',
        'Mizoram','Nagaland','Orissa','Pondicherry','Punjab','Rajasthan','Sikkim','Tamil Nadu',
        'Telangana','Tripura','Uttar Pradesh','Uttarakhand','West Bengal');

         $statename=$states[$statenumber];
         return  $statename;
    }
 function listStates()
 {
         $states= array( 1 => 'Andaman and Nicobar islands' ,'Andhra Pradesh','Arunachal Pradesh',
        'Assam','Bihar','Chandigarh','Chattisgarh','Dadra and Nagar Haveli','Daman and Diu',
        'Delhi','Goa','Gujarat','Haryana','Himachal Pradesh','Jammu and Kashmir','Jharkhand',
        'Karnataka','Kerala','Lakshadweep','Madhya Pradesh','Maharashtra','Manipur','Meghalaya',
        'Mizoram','Nagaland','Orissa','Pondicherry','Punjab','Rajasthan','Sikkim','Tamil Nadu',
        'Telangana','Tripura','Uttar Pradesh','Uttarakhand','West Bengal');

        global $tempvar;
        foreach ($states as $key => $value) {
            $tempvar=$tempvar.'<option  value="'.$key.'" >'.$value.' </option>';
        } 
        return $tempvar;    
 }
 function listYear()
 {
     $max_age=16;
     $cur_year=date("Y");
     global $tempyear;
     for($year = $cur_year ; $year>= ($cur_year-$max_age) ; $year--)
        $tempyear=$tempyear.'<option  value="'.$year.'" >'.$year.' </option>';
     return $tempyear;  
 }
 function getName($user)
 {
     include ('config.php');
     $getUsername=mysqli_query($conn,"SELECT student_name FROM Student_DB WHERE student_unique_id='$user'");
     $count=mysqli_num_rows($getUsername);
     if($count==1)
     {
         $username=mysqli_fetch_array($getUsername);
        echo $username[0];
     }
     $getUsername=mysqli_query($conn,"SELECT contributer_name FROM Contributer_DB WHERE contributer_unique_id='$user'");
     $username=mysqli_fetch_array($getUsername);
    echo $username[0];
 }
 function getProjects($user)
 {
     include ('config.php');
     $getProject=mysqli_query($conn,"SELECT * FROM Post_DB WHERE student_id IN (SELECT student_id FROM Student_DB WHERE student_unique_id='$user')");
    return mysqli_num_rows($getProject);
 }
 function getDonations($user)
 {
     include ('config.php');
     $getDonations=mysqli_query($conn,"SELECT * FROM Donated_Projects_DB WHERE contributer_id IN (SELECT contributer_id FROM Contributer_DB WHERE contributer_unique_id='$user')");
    return mysqli_num_rows($getDonations);
 }
?> 
