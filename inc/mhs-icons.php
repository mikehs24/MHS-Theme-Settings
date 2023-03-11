<?php

function mhs_get_icon($icon='', $color='currentColor', $size=25) {
    if($color == '') :
        $color = 'currentColor';
    endif;

    $output = '<span class="t-icon__box" style="width:'.$size.'px;height:'.$size.'px;">';
    
    switch($icon) {
        case 'icon-info':
            $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'" fill="'.$color.'" viewBox="0 0 16 16">';
            $output .= '<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>';
            $output .= '</svg>';
            break;

        case 'icon-user':
            $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'" fill="'.$color.'" viewBox="0 0 16 16">';
            $output .= '<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>';
            $output .= '<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>';
            $output .= '</svg>';
            break;

        case 'icon-pin':
            $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'" fill="'.$color.'" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">';
            $output .= '<path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>';
            $output .= '</svg>';
            break;
        
        case 'icon-email':
            $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'" fill="'.$color.'" class="bi bi-envelope-fill" viewBox="0 0 16 16">';
            $output .= '<path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>';
            $output .= '</svg>';
            break;
        
        case 'icon-phone':
            $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'" fill="'.$color.'" class="bi bi-envelope-fill" viewBox="0 0 16 16">';
            $output .= '<path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>';
            $output .= '</svg>';
            break;
        
        case 'icon-vat':
            $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'" fill="'.$color.'" class="bi bi-envelope-fill" viewBox="0 0 16 16">';
            $output .= '<path d="M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z"/>';
            $output .= '</svg>';
            break;
    }

    $output .= '</span>';
    return $output;
}
