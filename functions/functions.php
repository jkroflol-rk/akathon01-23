<?php
    function sanitise_input($data)
    {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    
    
    function array_data_fetch($arr, $key, $default)
    {
        if (array_key_exists($key, $arr))
            return $arr[$key];

        return $default;
    }
?>