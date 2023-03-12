<?php

function mhsContactInfo($atts) {
    $companyName = sanitize_text_field( get_option( 'mep_company_name' ) );
    $companyVatNo = sanitize_text_field( get_option( 'mep_company_vat_number' ) );
    $phoneNumber = sanitize_text_field( get_option( 'mep_phone_number' ) );
    $emailAddress = sanitize_email( get_option( 'mep_email' ) );
    $addressLineOne = sanitize_text_field( get_option( 'mep_address_line_one' ) );
    $addressLineTwo = sanitize_text_field( get_option( 'mep_address_line_two' ) );

    extract( shortcode_atts( array(
        'iconcolor' => '#E0E0E0',
        'textcolor' => '#1A202C',
        'linkcolor' => '#990000'
    ), $atts ) );

    ob_start();

    if($phoneNumber !== '' || $emailAddress !== '' || strcmp($addressLineOne, '') !== 0 || $webSite !== '') :  ?>
        <h4 class="mhs-info-box__title"><?php esc_html_e('Contact', '_pluginname') ?></h4>
        <div class="mhs-info-box" style="color:<?php echo esc_attr( $textcolor ) ?>;">
            <?php
                echo $companyName == '' ? '' : '<p class="mhs-info-box__contact-method"><span><strong>'.$companyName.'</strong></span></p>';
                echo $companyVatNo == '' ? '' : '<p class="mhs-info-box__contact-method">'.mhs_get_icon('icon-vat', esc_attr( $iconcolor ), 20).'<span>'.$companyVatNo.'</span></p>';
                echo $phoneNumber == '' ? '' : '<p class="mhs-info-box__contact-method">'.mhs_get_icon('icon-phone', esc_attr( $iconcolor ), 20).'<span><a href="tel:'.$phoneNumber.'" style="color:'.esc_attr( $linkcolor ).'">'.$phoneNumber.'</a></span></p>';
                echo $emailAddress == '' ? '' : '<p class="mhs-info-box__contact-method">'.mhs_get_icon('icon-email', esc_attr( $iconcolor ), 20).'<span><a href="mailto:'.$emailAddress.'" style="color:'.esc_attr( $linkcolor ).'">'.$emailAddress.'</a></span></p>';
                if(strcmp($addressLineOne, '') !== 0 && strcmp($addressLineTwo, '') === 0) : 
                    echo '<p class="mhs-info-box__contact-method">'.mhs_get_icon('icon-pin', esc_attr( $iconcolor ), 20).'<span>'.$addressLineOne.'</span></p>';
                elseif(strcmp($addressLineOne, '') !== 0 && strcmp($addressLineTwo, '') !== 0) :
                    echo '<p class="mhs-info-box__contact-method">'.mhs_get_icon('icon-pin', esc_attr( $iconcolor ), 20).'<span>'.$addressLineOne.'<br>'.$addressLineTwo.'</span></p>';
                endif;
            ?>
        </div>

    <?php endif;
    
    $html = ob_get_clean();

    return $html;
}
add_shortcode('mhs_show_contact_info', 'mhsContactInfo');