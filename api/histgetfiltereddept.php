<?php 
//Added by Sarang
//Added by Sarang - 03/14/2020

//when first round entry is being done  enter dept also to run this file 
include "db.php";

$arr2=array();

        if($_POST['dept'] == "All" )
        {
            
            $iids=array();
            $cursor = $db->prfs->find(array("status"=>"completed"));
            $i=0;
            $j=0;
            $cursor1 = $db->rounds->find(array("status"=>"completed"));
          
            foreach($cursor1 as $d)
            {
                $iids[$j] = $d['iid'];
                $j++;
            }
            // echo count($iids);
            $k=0;
            foreach($cursor as $doc)
            {
                $arr[0]=$doc['prf'];
                $arr[1]=$doc['position'];
                $arr[2]=$doc['zone'];
                $arr[3]=$doc['department'];
                $arr[4]=$doc['pos'];
                $arr[5]=$doc['status'];
                $arr[6]=$iids[$i];
                $arr2[$i] = $arr;
                $i=$i+1;
            }
            // echo $k;

            if(count($arr2) == 0)
            {
                echo "No data";
            }
            else
            {
                 echo(json_encode($arr2));
            }
        }
        else
        {
            $iids=array();
            $cursor = $db->prfs->find(array("department"=>$_POST['dept'],"status"=>"completed"));
            $i=0;
            $j=0;
            $cursor1 = $db->rounds->find(array("status"=>"completed", "dept"=>$_POST['dept']));
          
            foreach($cursor1 as $d)
            {
                $iids[$j] = $d['iid'];
                $j++;
            }
            //echo count($iids);
            $k=0;
            foreach($cursor as $doc)
            {
                $arr[0]=$doc['prf'];
                $arr[1]=$doc['position'];
                $arr[2]=$doc['zone'];
                $arr[3]=$doc['department'];
                $arr[4]=$doc['pos'];
                $arr[5]=$doc['status'];
                $arr[6]=$iids[$i];
                $arr2[$i] = $arr;
                $i=$i+1;
            }
            // echo $k;

            if(count($arr2) == 0)
            {
                echo "No data";
            }
            else
            {
                 echo(json_encode($arr2));
            }
            
        }
       
       
      



?>