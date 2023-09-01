<?php
include("../setting/checksession.php");

include("../setting/conn.php");

extract($_POST);

$month_evaluated = $evaluated_month . "-01";

$inser_header = $conn->query("INSERT INTO tbl_vendor_evaluated
(vendor_id,evaluated_date,evaluated_by,commend_from_evaluator,evaluated_month ) VALUES
('$vendor_id',now(),'$id_users','$commend_from_evaluator','$month_evaluated' ) ");

$lastid = $conn->lastInsertId();

if ($inser_header) {



    $countbox = count($_POST['evaluation_question_id']);

    for ($i = 0; $i < ($countbox); $i++) {

        if ($i == 0) {
            $score = $score_1;
        } else if ($i == 1) {
            $score = $score_2;
        } else if ($i == 2) {
            $score = $score_3;
        } else if ($i == 3) {
            $score = $score_4;
        } else if ($i == 4) {
            $score = $score_5;
        }

        $multi_score = $score * $score_multi[$i];

        extract($_POST);

        $insertItem = $conn->query("  insert into tbl_vendor_evaluated_detail (vendor_evaluated_id,evaluation_question_id,evaluation_score,evaluation_multi_score)
         values 
         ('$lastid','$evaluation_question_id[$i]','$score','$multi_score') ");
    }




    $res = array("res" => "success");
} else {
    $res = array("res" => "failed");
}




echo json_encode($res);
