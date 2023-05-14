<?php
    // $url = "https://b81155ba-05ce-415b-9ca4-b83d935e46a6-asia-south1.apps.astra.datastax.com/api/rest/v2/keyspaces/test/users/rows";
    // $token = "AstraCS:PXhWiFwCPFWfmLXqOGtkOlCU:ef2043b13fcc33dd3e63368eabf3a4379cf561fda6dec8ae2490832acde2ab39";
    function uuid()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

            // 32 bits for "time_low"
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),

            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,

            // 48 bits for "node"
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }

    // 3 tables
    function getData($table)
    {
        $url = "https://b81155ba-05ce-415b-9ca4-b83d935e46a6-asia-south1.apps.astra.datastax.com/api/rest/v2/keyspaces/test/" + $table + "/rows/";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                "Content-Type: application/json",
                "Accept: application/json",
                "X-Cassandra-Token: AstraCS:PXhWiFwCPFWfmLXqOGtkOlCU:ef2043b13fcc33dd3e63368eabf3a4379cf561fda6dec8ae2490832acde2ab39"
            )
        );
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response);
        return $data;
    }

    //admin - users and devices
    function deleteData($table, $primaryKey, $clusterKey)
    {
        $url = "https://b81155ba-05ce-415b-9ca4-b83d935e46a6-asia-south1.apps.astra.datastax.com/api/rest/v2/keyspaces/test/" + $table + "/" + $primaryKey + "/" + $clusterKey;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                "Content-Type: application/json",
                "Accept: application/json",
                "X-Cassandra-Token: AstraCS:PXhWiFwCPFWfmLXqOGtkOlCU:ef2043b13fcc33dd3e63368eabf3a4379cf561fda6dec8ae2490832acde2ab39"
            )
        );

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response);
    }

    function updateData($table, $data, $primaryKey, $clusterKey)
    {
        $url = "https://b81155ba-05ce-415b-9ca4-b83d935e46a6-asia-south1.apps.astra.datastax.com/api/rest/v2/keyspaces/test/" + $table + "/" + $primaryKey + "/" + $clusterKey;

        $data_string = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                "Content-Type: application/json",
                "Accept: application/json",
                "X-Cassandra-Token: AstraCS:PXhWiFwCPFWfmLXqOGtkOlCU:ef2043b13fcc33dd3e63368eabf3a4379cf561fda6dec8ae2490832acde2ab39",
            )
        );

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response);

    }

    //users, layouts
    function postData($url, $data)
    {
        $data_string = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Accept: application/json",
            "X-Cassandra-Token: AstraCS:PXhWiFwCPFWfmLXqOGtkOlCU:ef2043b13fcc33dd3e63368eabf3a4379cf561fda6dec8ae2490832acde2ab39",
        )
        );

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response);
    }

    //Example
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $favorite_color = $_POST['favorite_color'];

    $exampleData = [
        "firstname" => $name,
        "email" => $email,
        "password" => $password,
        "favorite color" => $favorite_color
    ];
?>