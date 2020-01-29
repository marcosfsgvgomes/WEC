<?php
         
    $https = request('user_website');
    $cmd = ("website-evidence-collector --quiet --yaml --overwrite {$https} -- --no-sandbox"); 

    error_log("WEC(cmd): " . $cmd);

    $descriptorspec = array(
        0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
        1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
        2 => array("pipe", "w") // stderr is a pipe that the child will write to
    );

    $timeout += time();
    $stdin = null; 
    $process = proc_open($cmd, $descriptorspec, $pipes);

    if (!is_resource($process)){
        throw new Exception('Invalid');
    }

    $std_output = '';
    $err_output = '';
    
    if($stdin) {
        // 0 => writeable handle connected to child stdin
        fwrite($pipes[0], $stdin);
    }
    fclose($pipes[0]);

    do {
        $write = null;
        $exceptions = null;
        $timeleft = $timeout - time();

        if ($timeleft <= 0) {
            proc_terminate($process);
            echo "ACABOU O TEMPO 1\n";
        }

        if (!empty($read)) {
            $std_output .= fread($pipes[1], 1024);
            $err_output .= fread($pipes[2], 1024);
        }

        $output_exists = (!feof($pipes[1]) || !feof($pipes[2]));
    } while ($output_exists && $timeleft > 0);

    if ($timeleft <= 0) {
        fclose($pipes[1]);
        fclose($pipes[2]);

        proc_close($process);
        echo "ACABOU O TEMPO 2\n";
    
    }

    fclose($pipes[1]);
    fclose($pipes[2]);

    proc_close($process);

    if($err_output) {
        "ERROR FOUND\n";
    }

    return $std_output;
        
?>