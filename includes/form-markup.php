<?php
	
//Include Options
$wcusp_options = get_option('wcusp_settings');
//Remove Pipe from Icon Class
$pipe_weg = "|";
$leerzeichen_hin = " ";  

$wcusp_options_front = str_replace ( $pipe_weg , $leerzeichen_hin , $wcusp_options );

// CHeck if all icons are blank
$hide_icons = false;

if ( (empty($wcusp_options_front['icon1']) || strstr($wcusp_options_front['icon1'], 'blank')) && (empty($wcusp_options_front['icon2']) || strstr($wcusp_options_front['icon2'], 'blank')) && (empty($wcusp_options_front['icon3']) || strstr($wcusp_options_front['icon3'], 'blank'))  && (empty($wcusp_options_front['icon4']) || strstr($wcusp_options_front['icon4'], 'blank'))  && (empty($wcusp_options_front['icon5']) || strstr($wcusp_options_front['icon5'], 'blank')) ) {
	$hide_icons = true;
}




//Define Markup as Variables
//Div Container
$my_usps_start = '<div class="product-usps-wrapper">
    <div class="product-usps">';

//First USP  
$icon1 = $hide_icons ? '' : '<div class="usp-image"><i style="color:' . $wcusp_options['wcusp_icon_color'] . '" class="' . $wcusp_options_front['icon1'] . '"></i></div>';

$my_first_usp = 	'<div class="product-usp-block">'
                		. $icon1 .
                		'<div class="usp-title">
                			<span> ' . $wcusp_options['usp1'] . ' </span> 
                    	</div>
    	          	</div> ';
//Second USP
$icon2 = $hide_icons ? '' : '<div class="usp-image"><i style="color:' . $wcusp_options['wcusp_icon_color'] . '" class=" ' . $wcusp_options_front['icon2'] . ' "></i></div>';

$my_second_usp = 	'<div class="product-usp-block">'
                		. $icon2 . 
                		'<div class="usp-title">
                			<span> ' . $wcusp_options['usp2'] . ' </span> 
                		</div>
    	           	</div>';
//Third USP
$icon3 = $hide_icons ? '' : '<div class="usp-image"><i style="color:' . $wcusp_options['wcusp_icon_color'] . '" class=" ' . $wcusp_options_front['icon3'] . ' "></i></div>';

$my_third_usp = 	'<div class="product-usp-block">'
						. $icon3 . 
						'<div class="usp-title">
                	   		<span> ' . $wcusp_options['usp3'] . ' </span> 
                		</div>
    	           	</div>';
//Fourth USP
$icon4 = $hide_icons ? '' : '<div class="usp-image"><i style="color:' . $wcusp_options['wcusp_icon_color'] . '" class=" ' . $wcusp_options_front['icon4'] . ' "></i></div>';

$my_fourth_usp = 	'<div class="product-usp-block">'
						. $icon4 . 
						'<div class="usp-title">
							<span> ' . $wcusp_options['usp4'] . ' </span> 
						</div>
					</div> ';
//Fifth USP
$icon5 = $hide_icons ? '' : '<div class="usp-image"><i style="color:' . $wcusp_options['wcusp_icon_color'] . '" class=" ' . $wcusp_options_front['icon5'] . ' "></i></div>';

$my_fifth_usp = 	'<div class="product-usp-block">'
						. $icon5 . 
						'<div class="usp-title">
                        	<span> ' . $wcusp_options['usp5'] . ' </span> 
                    	</div>
                   	</div>';
//End USP Div Container
$my_usps_end = '</div>
</div>';

//Output Markup as defined in Variables
echo $my_usps_start;
if (!empty($wcusp_options['usp1'])) {
    echo $my_first_usp;
}
if (!empty($wcusp_options['usp2'])) {
    echo $my_second_usp;
}
if (!empty($wcusp_options['usp3'])) {
    echo $my_third_usp;
}
if (!empty($wcusp_options['usp4'])) {
    echo $my_fourth_usp;
}
if (!empty($wcusp_options['usp5'])) {
    echo $my_fifth_usp;
}
echo $my_usps_end;


?>