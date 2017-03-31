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
?> 
