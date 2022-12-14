
<?php

    include("database.php");
    $sql = "SELECT * from users";

    $result = $conn->query($sql);

    while($r = $result->fetch_assoc()){

        $first_name = $r['first_name'];
        $last_name = $r['last_name'];
		$user_name = $r['user_name'];
		$folderpath = "folder/{$first_name}_{$last_name}"; 
        $srcfile = "images/{$first_name}_{$last_name}.png"; 
        $destfile = "folder/{$first_name}_{$last_name}/{$first_name}_{$last_name}.png"; 
        
        mkdir("folder/{$first_name}_{$last_name}");
        fopen("folder/{$first_name}_{$last_name}/index.php", "w");

        if (!file_exists($srcfile)) {
            fopen("folder/{$first_name}_{$last_name}/no_image.php", "w");
			
			$isql = "INSERT INTO folder VALUES (NULL,'{$user_name}',NULL,NULL,NULL,NULL,NULL,NULL,'{$folderpath}',NOW())";
		$iresult = $conn->query($isql);
			
					
        }

        else{
             copy($srcfile,$destfile);
			 $isql = "INSERT INTO folder VALUES (NULL,'{$user_name}',NULL,NULL,NULL,NULL,NULL,NULL,'{$folderpath}',NOW())";
		$iresult = $conn->query($isql);
			 
			
        }

     
       
    }
    


?>