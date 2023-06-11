<?php 


function RenderError(string $message , int $StatusCode ): void
{

    http_response_code($StatusCode);
    echo json_encode($message);


}