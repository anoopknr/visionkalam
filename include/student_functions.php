<?php


function isStudentDetailsCompleate($requestStudentUid)
{
    include_once ('config.php');
    $studentFunctionDetails = mysqli_query($conn,"SELECT * FROM Student_DB WHERE student_unique_id='$requestStudentUid' AND student_dream_company!='none' AND student_dream_job!='none'" );
    $resultCount = mysqli_num_rows($studentFunctionDetails);
    return $resultCount;
}


?>