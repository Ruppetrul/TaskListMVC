
<?php

if (!is_null($tasks)) {
    for ($i = 0; $i < count($tasks); $i++) {

        $task = $tasks[$i];

        $status = false;

        if ($task -> status == false) {
            $status = "UNREADY";
        } else {
            $status = "READY";
        }


        echo htmlspecialchars($task -> description);

        echo '
            
            <form action="" method="post">
            <button type="submit" name="change_status" value="' .$task -> id.'" >'.$status.'</button>                                  
            <button type="submit" name="delete" value="'.$task -> id.'">DELETE</button>            
            </form>
            <hr>
            ';
    }
}




