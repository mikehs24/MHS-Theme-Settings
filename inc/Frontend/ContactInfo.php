<?php

namespace Mhs\Frontend;

class ContactInfo
{
    public function __construct()
    {
        add_shortcode( 'mhs_show_contact_info', array($this, 'generateContacInfo') );
    }

    public function generateContacInfo($atts) 
    {
        $companyName = sanitize_text_field( get_option('mhste_company_name') );
        $companyVatNo = sanitize_text_field( get_option('mhste_company_vat_number') );
        $phoneNumber = sanitize_text_field( get_option('mhste_phone_number') );
        $emailAddress = sanitize_email( get_option('mhste_email') );
        $addressLineOne = sanitize_text_field( get_option('mhste_address_line_one') );
        $addressLineTwo = sanitize_text_field( get_option('mhste_address_line_two') );

        extract( 
            shortcode_atts( 
                array(
                'iconcolor' => '#E0E0E0',
                'textcolor' => '#1A202C',
                'linkcolor' => '#990000'
                ), 
                $atts 
            )
        );

        ob_start();

        if( $companyName == '' && $companyVatNo == '' && $phoneNumber == '' && $emailAddress == '' && $addressLineOne == '' ) {  
            esc_html_e( 'No contact info to view.', 'mhste' );
        } else {
            ?>
            <div class="mhs-info-box" style="color:<?php echo sanitize_hex_color($textcolor) ?>;">
            <?php
                echo $companyName == '' ? '' : '<p class="mhs-info-box__contact-method"><span><strong>'.$companyName.'</strong></span></p>';
                echo $companyVatNo == '' ? '' : '<p class="mhs-info-box__contact-method">'.mhs_get_icon('icon-vat', sanitize_hex_color($iconcolor), 20).'<span>'.$companyVatNo.'</span></p>';
                echo $phoneNumber == '' ? '' : '<p class="mhs-info-box__contact-method">'.mhs_get_icon('icon-phone', sanitize_hex_color($iconcolor), 20).'<span><a href="tel:'.$phoneNumber.'" style="color:'.sanitize_hex_color($linkcolor).'">'.$phoneNumber.'</a></span></p>';
                echo $emailAddress == '' ? '' : '<p class="mhs-info-box__contact-method">'.mhs_get_icon('icon-email', sanitize_hex_color($iconcolor), 20).'<span><a href="mailto:'.$emailAddress.'" style="color:'.sanitize_hex_color($linkcolor).'">'.$emailAddress.'</a></span></p>';
                if($addressLineOne !== '' && $addressLineTwo == '') : 
                    echo '<p class="mhs-info-box__contact-method">'.mhs_get_icon('icon-pin', sanitize_hex_color($iconcolor), 20).'<span>'.$addressLineOne.'</span></p>';
                elseif($addressLineOne !== '' && $addressLineTwo !== '') :
                    echo '<p class="mhs-info-box__contact-method">'.mhs_get_icon('icon-pin', sanitize_hex_color($iconcolor), 20).'<span>'.$addressLineOne.'<br>'.$addressLineTwo.'</span></p>';
                endif;
            ?>
            </div>

        <?php }
        
        $html = ob_get_clean();

        return $html;
    }
}