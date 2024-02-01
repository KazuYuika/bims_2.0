<?php

function includeComponent($componentName, $data = [])
{
    // Extract the data array to variables
    extract($data);

    // Define the path to the components directory
    $componentPath = $_SERVER['DOCUMENT_ROOT'] . '/resources/views/components/' . $componentName . '.php';

    // Check if the component file exists
    if (file_exists($componentPath)) {
        include $componentPath;
    } else {
        // Optionally handle the error if the component does not exist
        echo "Component '{$componentName}' not found!";
    }
}
