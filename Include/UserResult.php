<?php
    if(isset($_GET["result"])){
        $res = htmlspecialchars($_GET["result"]);
        echo "<script>alert(\"$res\");";
        echo "<\script>";
    }

    if(isset($_GET["error"])) {
        $err = array();
        $err = unserialize($_GET["error"]);
        $user = htmlspecialchars($_GET['apelido']);
        $str = ":: ";

        foreach ($err as $e)
            $str .= $e . " :: ";

        echo "<script>alert(\"$str\");";
        echo "document.getElementById('user').value = \"$user\";";
        echo "</script>";
    }
?>