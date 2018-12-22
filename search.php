<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8"/>
        <title>My Search Engine</title>
    </head>
    <body>

    <h1> My Search Engine </h1>

    <form action="search.php" method="get">
        <input type="text" name="query" value=<?php if(isset($_GET["query"])) echo $_GET["query"]; ?>/> <br>
        <input type="submit" name="submit" value="Submit"/><br><br>
    </form>

    <?php
    
        $start_time = microtime(true);

        if(isset($_GET["query"])){
            $query = $_GET["query"];
        }

        $docs = glob("doc/*.txt"); /* all docs in folder doc */
        $count = 0;

        foreach($docs as $file){
            $string = file_get_contents($file);
            if (strpos($string, $query) !== false){
                $count++;
                $strpos = strpos($string, $query);
                $display = basename($file,".txt");
                echo "<ul> <li class=docitem <a href='$file'>" . $display . "</li> </ul>";
                echo "<br>";
                echo substr($string, $strpos-20,$strpos+20);
            }else{
                echo "No results found.";
            }
        }
        
        $execution_time = microtime(true) - $start;
        echo '$execution_time';
        echo '$count'; 
    ?>

    </body>
</html>