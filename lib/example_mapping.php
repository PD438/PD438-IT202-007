<?php

function map_data($api_data){
    $records = [];
    foreach($api_data as $data){
        $record["user_id"] = $data["user_id"];
        $record["RecipeID"] = $data["RecipeID"];
        array_push($records, $record);
    }
    return $records;
}
