<?php 

// error_reporting(E_ALL);
ini_set('display_errors', '1');

function dump($data)
{
    echo '<br>
    <div 
        style="
            display: inline-block;
            padding: .5rem 1rem;
            max-width: 100%;
            background-color: #cfcfcf;
            border: 1px solid gray;
            border-radius: 10px;
            font-size: 1.4rem;
        "
    >
        <pre>';
            print_r($data);
        echo '</pre>
    </div>
    <br>';
}