<?php
/**
 * Manager Report HTML
 * 
 * @since 1.0.2
 */
if((isset($override) && $override == true)){
	$assessmentResults->overrides = $assessmentResults->overrides[0];
	$first_content = ucwords(strtolower($assessmentResults->overrides->details->rankedTemperaments[0]) );
	$sec_content = ucwords(strtolower($assessmentResults->overrides->details->rankedTemperaments[1]));
	$trd_content = ucwords(strtolower($assessmentResults->overrides->details->rankedTemperaments[2]));
}else{
	$first_content = ucwords(strtolower($assessmentResults->details->preferenceRankedTemperaments[0]) );
	$sec_content = ucwords(strtolower($assessmentResults->details->preferenceRankedTemperaments[1]));
	$trd_content = ucwords(strtolower($assessmentResults->details->preferenceRankedTemperaments[2]));
}

$report_pattern = (isset($override) && $override == true) ? ucwords(strtolower($assessmentResults->overrides->details->patternTitle)):  ucwords(strtolower($assessmentResults->details->preferencePatternTitle));

/*
// D-I = Executive
$first_content = "Choleric";
$sec_content = "Sanguine";
$report_pattern = "Executive";

// D-S = Executive
$first_content = "Choleric";
$sec_content = "Phlegmatic";
$report_pattern = "Director";

// D-C = Strategist
$first_content = "Choleric";
$sec_content = "Melancholy";
$report_pattern = "Strategist";



// I-D = Strategist
$first_content = "Sanguine";
$sec_content = "Choleric";
$report_pattern = "Negotiator";

// I-S = Relater
$first_content = "Sanguine";
$sec_content = "Phlegmatic";
$report_pattern = "Relater";

// I-C = Performer
$first_content = "Sanguine";
$sec_content = "Melancholy";
$report_pattern = "Performer";




// S-D = Inspector
$first_content = "Phlegmatic";
$sec_content = "Choleric";
$report_pattern = "Inspector";

// S-I = Harmonizer
$first_content = "Phlegmatic";
$sec_content = "Sanguine";
$report_pattern = "Harmonizer";

// S-C = Helper
$first_content = "Phlegmatic";
$sec_content = "Melancholy";
$report_pattern = "Helper";



// C-D = Instructor
$first_content = "Melancholy";
$sec_content = "Choleric";
$report_pattern = "Instructor";

// C-I = Diplomat
$first_content = "Melancholy";
$sec_content = "Sanguine";
$report_pattern = "Diplomat";

// C-S = Analyst
$first_content = "Melancholy";
$sec_content = "Phlegmatic";
$report_pattern = "Analyst";
*/

$the_report_pattern = "The ".$report_pattern;

if($first_content=="Choleric"){
	$Top_one = "D";
}else if($first_content=="Sanguine"){
	$Top_one = "I";
}else if($first_content=="Phlegmatic"){
	$Top_one = "S";
}else if($first_content=="Melancholy"){
	$Top_one = "C";
}

if($sec_content=="Choleric"){
	$Top_two = "D";
}else if($sec_content=="Sanguine"){
	$Top_two = "I";
}else if($sec_content=="Phlegmatic"){
	$Top_two = "S";
}else if($sec_content=="Melancholy"){
	$Top_two = "C";
}

if($trd_content=="Choleric"){
	$Top_trd = "D";
}else if($trd_content=="Sanguine"){
	$Top_trd = "I";
}else if($trd_content=="Phlegmatic"){
	$Top_trd = "S";
}else if($trd_content=="Melancholy"){
	$Top_trd = "C";
}

?>

<style>
   <!--
h2, h3, h4{font-family: 'proxima_novabold';}
h1{ font-family: 'proxima_novaextrabold';}
p{color:#555655; font-family: 'proxima_novaregular';font-size: 1.5em;line-height: 31px;}
-->
</style>
<page_footer>
	<table style="width: 100%; margin-top:10px;">
		<tr>
			<td style="font-family: 'proxima_novaregular';font-size: 10pt;text-align: left;width: 50%">Copyright &copy; <?=date("Y")?> Temperament Dynamics, LLC.</td>
			<td style="font-family: 'proxima_novaregular';font-size: 10pt;text-align: right;width: 50%">Page [[page_cu]] of [[page_nb]]</td>
		</tr>
	</table>
</page_footer>
<!--page1 starts here-->
<!--page1 starts here-->
<div class="" style="height:1060px;float:left;width:100%;padding-left:0px;margin-left:0px; ">
	<table style="width: 100%; display:inline-block;">
		<tr style="width: 100%; display:inline-block;">
			<td align="center" style="width: 100%; display:inline-block; padding-top:90px;">
				<table style="width: 100%; display:inline-block;" align="center">
					<tr style="width: 100%; display:inline-block;">
						<td align="center" style="background:#000000;color:#ffffff;padding-top:5px; padding-bottom:5px; padding-left:25px; padding-right:25px;">
							<h3 style="font-family: 'proxima_novabold'; font-size:28pt;margin-top:0px;margin-bottom:0;padding-bottom:0;text-align: center; text-transform: uppercase;">MANAGER'S REPORT</h3>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr style="width: 100%; display:inline-block;">
			<td align="center" style="width: 100%; display:inline-block;padding-top:35px;">
				<h4 style="font-size:18pt;color:#000;text-align:center;margin-bottom:8px; padding-bottom:0px;font-weight:600;">How to engage, coach, and lead</h4>
				<h2 style="font-family: 'proxima_novabold'; font-size:50pt;margin-top:0px;line-height: 80px;margin-bottom: 5px;text-align: center; text-transform: uppercase;"><?=$participantName?></h2> 
			</td>
		</tr>
		<tr>
			<td align="center"> <img style="width: 500px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/border-line-02.png"> </td>
		</tr>
		<tr style="width: 100%; display:inline-block;">
			<td align="center" style="width: 100%; display:inline-block; ">
				<h2 style="font-family: 'proxima_novabold'; font-size:25pt;margin-top:0px;line-height: 53px;margin-top: 40px; margin-bottom:0px; padding-bottom:0px;text-align: center; color:#a3a2a2; padding-bottom:0px;"> <?=$first_content?>-<?=$sec_content?></h2> 
			</td>
		</tr>
		<tr>
			<td>
				<table style="width: 100%; display:inline-block;" align="center">
					<tr style="width: 100%; display:inline-block;">
						<td align="center" style="width:60px;border: 2px solid #494949; padding:3px;padding-top:3px;">
							<?php if($Top_one == "D"){ ?>
								<div class="text-center" style="color:#633319;font-size: 23px;position:relative; top:0px;height:60px; display: block; left:-35px;  width:100%;background-color: #f36d6c; ">
									<h4 class="text-center" style="color:#992253;font-size: 23px;position:relative; top:1px;width:100%;background-color: #f36d6c; padding:0px; margin:18px 0px;height:60px; ">Chol</h4> 
								</div>
							<?php }else if($Top_one == "I"){ ?>
								<div class="text-center" style="color:#653e1d;font-size: 23px;position:relative; top:0px;height:60px; display: block; left:-35px;  width:100%;background-color: #fdf380; ">
									<h4 class="text-center" style="color:#653e1d;font-size: 23px;position:relative; top:1px;width:100%;background-color: #fdf380; padding:0px; margin:18px 0px;height:60px; ">San</h4> 
								</div>
							<?php }else if($Top_one == "S"){ ?>
								<div class="text-center" style="color:#1d1b1c;font-size: 23px;position:relative; top:0px;height:60px; display: block; left:-35px;  width:100%;background-color: #acd0dd; ">
									<h4 class="text-center" style="color:#1d1b1c;font-size: 23px;position:relative; top:1px;width:100%;background-color: #acd0dd; padding:0px; margin:18px 0px;height:60px; ">Phleg</h4> 
								</div>
							<?php }else if($Top_one == "C"){ ?>
								<div class="text-center" style="color:#1f415c;font-size: 23px;position:relative; top:0px;height:60px; display: block; left:-35px;  width:100%;background-color: #69be49; ">
									<h4 class="text-center" style="color:#1f415c;font-size: 23px;position:relative; top:1px;width:100%;background-color: #69be49; padding:0px; margin:18px 0px;height:60px; ">Mel</h4> 
								</div>
							<?php } ?>
						</td>
						<td align="center" style="width:10px;"> </td>
						<td align="center" style="width:60px; height:0px;border: 2px solid #494949; padding:3px; padding-top:3px;padding-bottom:1px;">
							<?php if($Top_two == "D"){ ?>
								<div class="text-center" style="color:#971e4b;font-size: 23px;position:relative; top:0px;height:60px; display: block; left:-35px;  width:100%;background-color: #f36d6c; ">
									<h4 class="text-center" style="color:#971e4b;font-size: 23px;position:relative; top:1px;width:100%;background-color: #f36d6c; padding:0px; margin:18px 0px;height:60px; ">Chol</h4> 
								</div>
							<?php }else if($Top_two == "I"){ ?>  
								<div class="text-center" style="color:#653e1d;font-size: 23px;position:relative; top:0px;height:60px; display: block; left:-35px;  width:100%;background-color: #fdf380; ">
									<h4 class="text-center" style="color:#653e1d;font-size: 23px;position:relative; top:1px;width:100%;background-color: #fdf380; padding:0px; margin:18px 0px;height:60px; ">San</h4> 
								</div>
							<?php }else if($Top_two == "S"){ ?>
								<div class="text-center" style="color:#1d1b1c;font-size: 23px;position:relative; top:0px;height:60px; display: block; left:-35px;  width:100%;background-color: #acd0dd; ">
									<h4 class="text-center" style="color:#1d1b1c;font-size: 23px;position:relative; top:1px;width:100%;background-color: #acd0dd; padding:0px; margin:18px 0px;height:60px; ">Phleg</h4> 
								</div>
							<?php }else if($Top_two == "C"){ ?>
								<div class="text-center" style="color:#1f415c;font-size: 23px;position:relative; top:0px;height:60px; display: block; left:-35px;  width:100%;background-color: #69be49; ">
									<h4 class="text-center" style="color:#1f415c;font-size: 23px;position:relative; top:1px;width:100%;background-color: #69be49; padding:0px; margin:18px 0px;height:60px; ">Mel</h4> 
								</div>
							<?php } ?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr style="width: 100%; display:inline-block;">
			<td align="center" style="width: 100%; display:inline-block;">
				<h4 style="font-size:35pt;color:#a3a2a2;text-align:center;margin-bottom:10px; padding-bottom:0px; text-transform:uppercase; font-weight:600;" align="center; text-transform: uppercase;">The <?=$report_pattern?></h4> 
			</td>
		</tr>
		
		<tr style="width: 100%; display:inline-block;">
			<td align="center" style="width: 100%; display:inline-block; padding-top:250px;"> 
				<img style="width: 250px; text-align:center; " src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/4T-logo.png"> 
				<p style="font-family: 'proxima_novaregular'; font-size:13pt;margin-top:0px;line-height: 80px;margin-top: 20px; margin-bottom:0px; padding-bottom:0px;text-align: center; color:#000;">Developed by <span style="font-family: 'proxima_novabold';">Dr. John T. Cocoris</span></p>
			</td>
		</tr>
		
	</table>
</div>
<!--page1 ends here-->
<!--page2 starts here-->
<div class="" style="float:left;width:1000px;padding-left:0px;margin-left:0px;">
	<table style="width: 100% margin-left:38px;margin-right:40px;">
		<tr style="margin-bottom:0px;">
			<td align="center" style="margin-bottom:0px;">
				<h1 class="text-center" style="font-size: 25pt;margin-bottom: 5px; padding-top:15px; line-height:25pt;">HOW TO ENGAGE, COACH, AND LEAD<br><?=strtoupper($participantName)?></h1> 
				<img style="width: 500px; margin-bottom:0px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/border-line-02.png"> 
			</td>
		</tr>
		<tr style="margin-top:0px;">
			<td align="center" style="margin-top:0px;">
				<table style="width: 100%; display:inline-block;margin-top:0px;">
					<tr style="margin-top:0px;">
						<td align="center" style="width: 100%; display:inline-block;margin-top:0px;">
							<h3 style="font-size: 20pt;margin-bottom: 0px; padding-top:0px; margin-top:0px; line-height:20pt;"><?=$participantFirstName?>'s temperament combination</h3>
						</td>
					</tr>
					<tr>
						<td style="margin-bottom:0px;margin-top:0px;">
							<table style="width: 100%; display:inline-block;" align="center">
								<tr style="width: 100%; display:inline-block;">
									<td align="center" style="width:30px;border: 2px solid #494949; padding:3px;padding-top:3px;">
										<?php if($Top_one == "D"){ ?>
											<div class="text-center" style="color:#633319;font-size: 14px;position:relative; top:0px;height:30px; display: block; left:-20px;  width:100%;background-color: #f36d6c; ">
												<h4 class="text-center" style="color:#992253;font-size: 14px;position:relative; top:1px;width:100%;background-color: #f36d6c; padding:0px; margin:6px 0px;height:30px; ">Chol</h4> 
											</div>
										<?php }else if($Top_one == "I"){ ?>
											<div class="text-center" style="color:#653e1d;font-size: 14px;position:relative; top:0px;height:30px; display: block; left:-20px;  width:100%;background-color: #fdf380; ">
												<h4 class="text-center" style="color:#653e1d;font-size: 14px;position:relative; top:1px;width:100%;background-color: #fdf380; padding:0px; margin:6px 0px;height:30px; ">San</h4> 
											</div>
										<?php }else if($Top_one == "S"){ ?>
											<div class="text-center" style="color:#1d1b1c;font-size: 14px;position:relative; top:0px;height:30px; display: block; left:-20px;  width:100%;background-color: #acd0dd; ">
												<h4 class="text-center" style="color:#1d1b1c;font-size: 14px;position:relative; top:1px;width:100%;background-color: #acd0dd; padding:0px; margin:6px 0px;height:30px; ">Phleg</h4> 
											</div>
										<?php }else if($Top_one == "C"){ ?>
											<div class="text-center" style="color:#1f415c;font-size: 14px;position:relative; top:0px;height:30px; display: block; left:-20px;  width:100%;background-color: #69be49; ">
												<h4 class="text-center" style="color:#1f415c;font-size: 14px;position:relative; top:1px;width:100%;background-color: #69be49; padding:0px; margin:6px 0px;height:30px; ">Mel</h4> 
											</div>
										<?php } ?>
									</td>
									<td align="center" style="width:10px;"> </td>
									<td align="center" style="width:30px; height:0px;border: 2px solid #494949; padding:3px; padding-top:3px;padding-bottom:1px;">
										<?php if($Top_two == "D"){ ?>
											<div class="text-center" style="color:#971e4b;font-size: 14px;position:relative; top:0px;height:30px; display: block; left:-20px;  width:100%;background-color: #f36d6c; ">
												<h4 class="text-center" style="color:#971e4b;font-size: 14px;position:relative; top:1px;width:100%;background-color: #f36d6c; padding:0px; margin:6px 0px;height:30px; ">Chol</h4> 
											</div>
										<?php }else if($Top_two == "I"){ ?>  
											<div class="text-center" style="color:#653e1d;font-size: 14px;position:relative; top:0px;height:30px; display: block; left:-20px;  width:100%;background-color: #fdf380; ">
												<h4 class="text-center" style="color:#653e1d;font-size: 14px;position:relative; top:1px;width:100%;background-color: #fdf380; padding:0px; margin:6px 0px;height:30px; ">San</h4> 
											</div>
										<?php }else if($Top_two == "S"){ ?>
											<div class="text-center" style="color:#1d1b1c;font-size: 14px;position:relative; top:0px;height:30px; display: block; left:-20px;  width:100%;background-color: #acd0dd; ">
												<h4 class="text-center" style="color:#1d1b1c;font-size: 14px;position:relative; top:1px;width:100%;background-color: #acd0dd; padding:0px; margin:6px 0px;height:30px; ">Phleg</h4> 
											</div>
										<?php }else if($Top_two == "C"){ ?>
											<div class="text-center" style="color:#1f415c;font-size: 14px;position:relative; top:0px;height:30px; display: block; left:-20px;  width:100%;background-color: #69be49; ">
												<h4 class="text-center" style="color:#1f415c;font-size: 14px;position:relative; top:1px;width:100%;background-color: #69be49; padding:0px; margin:6px 0px;height:30px; ">Mel</h4> 
											</div>
										<?php } ?>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr style="width: 100%; display:inline-block;margin-top:0px;">
						<td align="center" style="width: 100%; display:inline-block;margin-top:0px;">
							<h3 style="font-size: 20pt;margin-top:0px;margin-bottom: 0px; padding-top:5px; line-height:18pt;">is known as <?=strtoupper($the_report_pattern)?></h3>
						</td>
					</tr>
				</table>

            </td>
		</tr>
		<?php if($Top_one == "D" && $Top_two == "I"){ ?>
			<tr>
				<td align="left">
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin-top:0px;margin-bottom:8px;padding:0px 15px"><?=$the_report_pattern?> is driven by two temperament needs, a primary need to get results and a secondary need to be accepted socially. </p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Executives respond best to a direct, straightforward supervisor with whom they can talk openly and negotiate. They like options to select from and will usually respond well to a challenge and a goal.</b></p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px">They want to be in charge because of their confidence in their ability to make decisions. They have boundless energy and need activity and results or they become bored. They also need others willing to listen to them and carry out their plans. They like to delegate.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px"><?=$the_report_pattern?> is driven by instinct and doesn’t typically have a need to analyze. They usually don’t micromanage the details when achieving their goal.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">Understand that the <?=$report_pattern?> tends to be very impatient and will often take a win/lose approach. They are practical and use direct methods to get quick results but still show an interest in people. They are goal and bottom-line oriented and they can be very persuasive in promoting their ideas. </p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">This versatile, eager, self-starter is very competitive. To be highly motivated, they need freedom and information that will help them get results. They like having power and authority.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">When communicating with the Executive, be brief, direct, to the point, and show confidence. Stress saving time, be results-oriented, and give them options from which to choose.</p>
				</td>
			</tr>
			<tr>
				<td align="center">
					<h3 style="font-size: 20pt;margin-bottom: 5px; margin-top:15px; line-height:20pt;">QUICK REFERENCE GUIDE WHEN ENGAGING<br/><?=strtoupper($participantName)?></h3>
				</td>
			</tr>
			
			<tr>
				<td align="left">
					<table style="margin-right:40px;margin-top:0px;width:720px;" cellspacing="0">
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Top Strengths &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Direct | Self-motivated | Decisive  <a href="#document_full_list">[See full list below]</a></p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Core Needs &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Possibility of quick results | Independence | Authority | To be in control | Brief and direct conversation</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Do's &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Be brief, direct, and to the point | Speed up your responses | Be confident | Discuss how to get better and faster results</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Don'ts &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Do not waste their time | Do not show a lack of confidence | Do not be wordy | Do not allow them to “take over”</p>
							</td>
						</tr>					
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Key Words to Use &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Results | Bottom line | Goals | Save time | Quick | Effective | Productive | “I’ll be brief” | “I’ll be direct” | Efficient</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Concerns &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">May be abrupt | Easily annoyed | May have sudden outbursts | May not respect authority | May be too independent</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Confronting &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Be firm, direct, to the point, and matter-of-fact | Demonstrate strength | Show how different behavior will get better, faster results</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Key to Success &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">In order for the Executive to be successful, they need to show compassion and soften their directness. </p>
							</td>
						</tr>
					</table>
					<p style="color: #555655;font-family: 'proxima_novaregularitalic';font-size: 10pt;line-height: 15px; margin-top:5px;margin-bottom:8px;text-align:left;font-style: italic;">* This Quick Reference Guide is an essential tool for leading this person</p>
				</td>
			</tr>
		<?php }else if($Top_one == "D" && $Top_two == "S"){ ?>
			<tr>
				<td align="left">
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px; margin-top:0px;margin-bottom:8px;padding:0px 15px"><?=$the_report_pattern?> is driven by two needs, a primary need to get results and a secondary need to accommodate others. They are one of the rarest of all the behavioral patterns. </p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px"><b style="font-family: 'proxima_novabold';"><?=$the_report_pattern?> responds best to a direct, straightforward supervisor with whom they can talk openly and negotiate. <?=$the_report_pattern?> likes options to select from and they usually respond well to a challenge.</b></p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px">They will use direct and persistent methods to get results or promote their ideas. They want to be in charge because of confidence in their ability to make decisions.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px">They lack natural people skills and like to work alone or with just one person. It’s important to give them a clear goal and then let them work. At the same time, the <?=$report_pattern?> needs help from others, specifically with the details. They can be very cold and blunt when working with others.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px"><?=$the_report_pattern?> is determined, unemotional, and individualistic. They usually have deep personal goals and may pursue them at the expense of relationships. They need to know the "big picture" (clear direction) before they can function efficiently. <?=$the_report_pattern?> is very practical and can easily detect what’s most important when presented with many details. </p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">To be highly motivated, they need freedom, independence, and information that will help them get quick results.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">When communicating with the Director, be non-emotional and matter-of-fact in conversation. Be brief, direct, and to the point. Show confidence and remove the risk of them being taken advantage of (especially in a business transaction).</p>
				</td>
			</tr>
			<tr>
				<td align="center">
					<h3 style="font-size: 20pt;margin-bottom: 5px; margin-top:15px; line-height:20pt;">QUICK REFERENCE GUIDE WHEN ENGAGING<br/><?=strtoupper($participantName)?></h3>
				</td>
			</tr>
			
			<tr>
				<td align="left">
					<table style="margin-right:40px;margin-top:0px;width:720px;" cellspacing="0">
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Top Strengths &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Directness | Practical problem solver | Self determination  <a href="#document_full_list">[See full list below]</a></p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Core Needs &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Independence | Authority | Opportunity to advance | Freedom to achieve own goals | Brief, direct conversation</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Do's &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Be direct, brief, and to the point | Be prepared for a lack of emotion | Agree with the facts and ideas, not the individual</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Don'ts &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Do not waste their time | Do not show a lack of confidence | Do not be wordy | Do not show much emotion </p>
							</td>
						</tr>					
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Key Words to Use &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Practical | Bottom line | Effective | Goals | Results | Routine | “I’ll be brief”</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Concerns &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">May be too independent | May lack sensitivity toward others | May be extremely stubborn</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Confronting &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Be firm, direct, and to the point | Demonstrate strength | Show how different behavior will get better and faster results</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Key to Success &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">In order for the Director to be successful, they need to soften their bluntness and show empathy. </p>
							</td>
						</tr>
					</table>
					<p style="color: #555655;font-family: 'proxima_novaregularitalic';font-size: 10pt;line-height: 15px; margin-top:5px;margin-bottom:8px;text-align:left;font-style: italic;">* This Quick Reference Guide is an essential tool for leading this person</p>
				</td>
			</tr>
		<?php }else if($Top_one == "D" && $Top_two == "C"){ ?>
			<tr>
				<td align="left">
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px; margin-top:0px;margin-bottom:5px;padding:0px 15px"><?=$the_report_pattern?> is driven by two needs, a primary need to get results and a secondary need to do things right. </p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:5px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Strategists respond best to a direct, straightforward supervisor with whom they can talk openly and negotiate. Strategists like options to select from and they will usually respond well to a challenge. Be direct and bottom-line oriented.</b></p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:5px;padding:0px 15px"><?=$the_report_pattern?> is good at identifying and analyzing the obstacles that prevent achieving a goal. When working on a problem, they often have penetrating insights. They have a desire to delegate to others as long as they can maintain tight control. They want to be in charge because of confidence in their ability to make things happen the "right" way.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:5px;padding:0px 15px"><?=$the_report_pattern?> usually operates from a well-thought-out plan and has creative ideas. They are detail oriented when planning to get the desired results and will naturally initiate change. However, they need to be mindful they don’t initiate unnecessary change.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:5px;padding:0px 15px"><?=$the_report_pattern?> needs to know exactly what is expected before they can function efficiently. They can be very forceful and harsh but also very sensitive. They speak with authority and are usually very productive. To be highly motivated, they need freedom and information that will help them get results and the opportunity to make something better. </p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:5px;padding:0px 15px">When communicating with the Strategist, be brief, direct, and to the point. Show confidence, give them details, options, and remove the risk of them being taken advantage of (especially in a business transaction).</p>	
				</td>
			</tr>
			<tr>
				<td align="center">
					<h3 style="font-size: 18pt;margin-bottom: 5px; margin-top:5px; line-height:18pt;">QUICK REFERENCE GUIDE WHEN ENGAGING<br/><?=strtoupper($participantName)?></h3>
				</td>
			</tr>
			
			<tr>
				<td align="left">
					<table style="margin-right:40px;margin-top:0px;width:720px;" cellspacing="0">
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Top Strengths &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Directness | Operates from a detailed plan | Desire for right results  <a href="#document_full_list">[See full list below]</a></p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Core Needs &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Quick results | Personal challenge | Opportunity to fix something | Brief, direct conversation | Information</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Do's &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Be brief, direct, and to the point | Ask “what” questions instead of “how” | Give reasons why | Be practical and help them save time </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Don'ts &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Do not waste their time or be wordy | Do not show a lack of confidence | Do not withdraw when they get assertive </p>
							</td>
						</tr>					
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Key Words to Use &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Results | Bottom line | Goals | Save time | Quick | Effective | Details | “I’ll be brief” | “I’ll be direct” | Efficient </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Concerns &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Crisis way of communicating | May be critical and blunt | May have sudden outbursts | Easily annoyed </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Confronting &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Be direct, to the point, factual, and logical | Be prepared to reason assertively | Give reasons to change behavior (in order to get better and faster results) | Be willing to negotiate options </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Key to Success &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">In order for the Strategist to be successful, they need to soften their need to control. </p>
							</td>
						</tr>
					</table>
					<p style="color: #555655;font-family: 'proxima_novaregularitalic';font-size: 10pt;line-height: 15px; margin-top:5px;margin-bottom:8px;text-align:left;font-style: italic;">* This Quick Reference Guide is an essential tool for leading this person</p>
				</td>
			</tr>
		<?php }else if($Top_one == "I" && $Top_two == "D"){ ?>
			<tr>
				<td align="left">
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px"><?=$the_report_pattern?> is driven by two needs, a primary need to be accepted socially, and a secondary need to get results. </p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Negotiators respond best to a friendly supervisor who is personable. Negotiators like information but not too many details.</b></p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px">They need to be with people or be active all the time. They are natural, energetic leaders who want to be in charge. They get results by engaging others and have a natural desire to encourage people. They are great cheerleaders and have a warm and friendly way while pushing forward their objectives and selling their point of view.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px">At times, the <?=$report_pattern?> can be impulsive and even manipulative, and these tendencies need to be managed. They can get so excited and jump ahead with a decision without thinking it through. They need to develop a plan before acting, which is difficult for them to do but necessary.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">They do not like to perform routine work. They have a difficult time with details, organization, and consistency. It’s important to make sure they’re with people and to remove as many detailed requirements from them as possible. In some cases, it may be necessary to provide the details for them.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">When communicating with the <?=$report_pattern?>, show excitement, have fun, smile, and be prepared for them to try to persuade you to their point of view. Also, remove the risk of them looking bad or being embarrassed. They want to be your friend.</p>	
				</td>
			</tr>
			<tr>
				<td align="center">
					<h3 style="font-size: 20pt;margin-bottom: 5px; margin-top:15px; line-height:20pt;">QUICK REFERENCE GUIDE WHEN ENGAGING<br/><?=strtoupper($participantName)?></h3>
				</td>
			</tr>
			
			<tr>
				<td align="left">
					<table style="margin-right:40px;margin-top:0px;width:720px;" cellspacing="0">
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Top Strengths &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Persuasive | Enthusiastic | Sociable  <a href="#document_full_list">[See full list below]</a></p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Core Needs &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Social involvement | To influence others | To talk | Freedom to express ideas | Freedom from details </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Do's &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Be friendly, personable | Recognize accomplishments | Give deadlines and have plan to follow through | Be excited | Listen</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Don'ts &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Never embarrass them (may get aggressive) | Do not always talk issues | Do not ask them to sit for long | Do not give many details</p>
							</td>
						</tr>					
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Key Words to Use &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Exciting | Fun | Latest | Accept | Status | Feelings | Influence | Impulsive</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Concerns &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">May work in “spurts” | May play too much | Too optimistic | Difficulty with details | Disorganization</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Confronting &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Be firm, factual, logical | Allow freedom to express feelings | Remain very objective | Be prepared for emotional persuasion </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Key to Success &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">In order for the <?=$report_pattern?> to be successful, they need to control their tendency of impulsive behavior and they need a plan. </p>
							</td>
						</tr>
					</table>
					<p style="color: #555655;font-family: 'proxima_novaregularitalic';font-size: 10pt;line-height: 15px; margin-top:5px;margin-bottom:8px;text-align:left;font-style: italic;">* This Quick Reference Guide is an essential tool for leading this person</p>
				</td>
			</tr>
			
		<?php }else if($Top_one == "I" && $Top_two == "S"){ ?>
			<tr>
				<td align="left">
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px; margin-top:0px;margin-bottom:8px;padding:0px 15px"><?=$the_report_pattern?> is driven by two needs, a primary need to be accepted socially, and a secondary need to accommodate others. </p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Relaters respond well to a friendly supervisor who is personable. Relaters like to form lasting relationships.</b></p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px">They are optimistic, accommodating, and empathetic. They are typically easy to manage because their core drive is to build a relationship. It’s important to spend adequate time with them and get to know them based on their desire for a good relationship with their manager. They respect those in authority, and they work to keep the peace.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px">They are usually excellent managers who are good listeners, but they may have difficulty confronting those they are managing. They may need to be coached to be more direct.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px"><?=$the_report_pattern?> enjoys a measure of routine in their daily schedule, and they prefer a hands-on approach to their work. They may not respond best to classroom instruction. They need clearly identified tasks that allow them to figure out the “how.” </p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">When communicating with the Relater, demonstrate warm, friendly acceptance and stress the importance of lasting relationships. Show excitement, have fun, and don’t be overly detailed or picky about minor issues.</p>	
				</td>
			</tr>
			<tr>
				<td align="center">
					<h3 style="font-size: 20pt;margin-bottom: 5px; margin-top:15px; line-height:20pt;">QUICK REFERENCE GUIDE WHEN ENGAGING<br/><?=strtoupper($participantName)?></h3>
				</td>
			</tr>
			
			<tr>
				<td align="left">
					<table style="margin-right:40px;margin-top:0px;width:720px;" cellspacing="0">
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Top Strengths &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Accepting of others | Gentle friendliness | Empathy  <a href="#document_full_list">[See full list below]</a></p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Core Needs &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Long-term relationships | Exciting activity | Others to be gentle | To serve others | Routine to feel secure</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Do's &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Be warm, personable, friendly, and open | Be prepared to listen | Build a relationship | Give approval | Give deadlines</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Don'ts &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Never embarrass them (may withdraw) | Do not always talk issues | Never push (will become stubborn) | Do not give many details </p>
							</td>
						</tr>					
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Key Words to Use &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Relationships | Family | Routine | Loyal | Fun | Exciting | Friendship </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Concerns &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Too optimistic about the potential of others | May play too much | Difficulty with details | Disorganization | Time awareness </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Confronting &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Be firm, factual, logical, unemotional | Be warm, gentle, friendly | Be prepared for emotional persuasion and remain objective </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Key to Success &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">In order for the Relater to be successful, they need to learn how to confront others. </p>
							</td>
						</tr>
					</table>
					<p style="color: #555655;font-family: 'proxima_novaregularitalic';font-size: 10pt;line-height: 15px; margin-top:5px;margin-bottom:8px;text-align:left;font-style: italic;">* This Quick Reference Guide is an essential tool for leading this person</p>
				</td>
			</tr>
		<?php }else if($Top_one == "I" && $Top_two == "C"){ ?>
			<tr>
				<td align="left">
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px; margin-top:0px;margin-bottom:8px;padding:0px 15px"><?=$the_report_pattern?> is driven by two temperament needs, a primary need to be socially accepted and a secondary need to do things right. </p>
					
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Performers respond best to a friendly supervisor who will be personable and accepting.</b></p>

					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px">They want to be treated with respect. They are very concerned about making a favorable impression and being accepted by others. They tend to be very image conscious and tend to actively seek recognition for their achievements.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px">When managing them, it’s important to give them personal attention and an opportunity to ask questions. If they are not completing a task in a timely manner, it may be because they are unsure of the right thing to do or they may be embarrassed if the results are not correct. The drive of their second temperament (the Melancholy) is not trying to “be” right but to figure out what “is” right.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">They need information, time to think, and a plan before they can function effectively. Although well-organized, the Performer may not be consistent or follow through with their plan.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">To be highly motivated, they need privacy (alone time), freedom of expression, relationships with people, and the opportunity to be creative. Performers may be reluctant to take action until they have confidence that they will not fail.</p>	
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">When communicating with the Performer, show acceptance and respect and remove the risk of them being rejected or embarrassed. Show excitement and be logical and factual in communication. Have some fun, laugh, and smile.</p>	
				</td>
			</tr>
			<tr>
				<td align="center">
					<h3 style="font-size: 20pt;margin-bottom: 5px; margin-top:15px; line-height:20pt;">QUICK REFERENCE GUIDE WHEN ENGAGING<br/><?=strtoupper($participantName)?></h3>
				</td>
			</tr>
			
			<tr>
				<td align="left">
					<table style="margin-right:40px;margin-top:0px;width:720px;" cellspacing="0">
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Top Strengths &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Persuades with facts and emotion | High drive to win | Creative thinking     <a href="#document_full_list">[See full list below]</a></p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Core Needs &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Freedom to express ideas | Time to think and develop a plan | Reasons, facts, logically given | Recognition</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Do's &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Prepare for detailed explanations | Give information, time to think and help to develop a plan | Give deadlines </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Don'ts &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Never embarrass them | Do not always talk about the issues | Do not be general when giving information </p>
							</td>
						</tr>					
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Key Words to Use &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Proud | Latest | Information | Think | Plan | Prestigious | Status | Exciting </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Concerns &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">May withdraw until they know they will not be embarrassed | Frequent mood swings </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Confronting &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Do not embarrass them | Be factual, unemotional, logical | Remain objective | Prepare for emotional persuasion and detailed explanations </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Key to Success &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">In order for the Performer to be successful, they need to overcome their fear of rejection.</p>
							</td>
						</tr>
					</table>
					<p style="color: #555655;font-family: 'proxima_novaregularitalic';font-size: 10pt;line-height: 15px; margin-top:5px;margin-bottom:8px;text-align:left;font-style: italic;">* This Quick Reference Guide is an essential tool for leading this person</p>
				</td>
			</tr>
		<?php }else if($Top_one == "S" && $Top_two == "D"){ ?>
			<tr>
				<td align="left">
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px; margin-top:0px;margin-bottom:8px;padding:0px 15px"><?=$the_report_pattern?> is driven by two temperament needs, a primary need to be accommodating and a secondary need to get results. They are one of the rarest of all the behavioral patterns. </p>
					
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Inspectors respond best to a relaxed, calm supervisor who shows interest in them personally.</b></p>

					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px">They are very determined, industrious, and unemotional. They have an unyielding determination to achieve a goal. Don’t expect them to be personal when interacting with others. They prefer to work alone and set their own pace.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px">This persistent individual brings a deceptively intense approach to the task. Being low-key outwardly, their involvement in a task is not easily observed. They are a dispassionate "anchor of reality." </p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">They are calm, steady, and persevering. Inspectors are successful because of their steadfast determination. After starting a project, they are tenacious and will fight hard for their objectives. They are very independent, questioning, and will follow through. Once their mind is made up, they will resist any other method of approach. They can be very stubborn.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">When communicating with the Inspector, show personal interest, be accepting, and practical. Be specific when explaining concepts. Be persistent, push gently, and use visual aids. They need to see, touch, and feel what you are talking about.</p>	
				</td>
			</tr>
			<tr>
				<td align="center">
					<h3 style="font-size: 20pt;margin-bottom: 5px; margin-top:15px; line-height:20pt;">QUICK REFERENCE GUIDE WHEN ENGAGING<br/><?=strtoupper($participantName)?></h3>
				</td>
			</tr>
			
			<tr>
				<td align="left">
					<table style="margin-right:40px;margin-top:0px;width:720px;" cellspacing="0">
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Top Strengths &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Calmness in crisis | Dependability | Determination      <a href="#document_full_list">[See full list below]</a></p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Core Needs &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">No sudden changes | Independence | To provide support | Clear requirements | Security | One thing to do at a time </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Do's &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Be warm and personal | Give time to figure out the task | Give clear, firm directions (when to start, stop)  </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Don'ts &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Do not suddenly change anything | Do not show excessive emotion | Do not expect them to get excited | Do not infringe on home life  </p>
							</td>
						</tr>					
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Key Words to Use &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Support | Traditional | Realistic | Care | Family | Practical | Results | “I sincerely appreciate…”</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Concerns &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Being stubborn | Being blunt | Either/or thinking | Resistance to change | Passive aggressiveness | Aloofness </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Confronting &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Use low key conversation | Be firm, matter-of-fact | Be specific | Use visual aids | Allow time to adjust | Apply slight pressure  </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Key to Success &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">In order for the Inspector to be successful, they need to overcome their stubbornness.</p>
							</td>
						</tr>
					</table>
					<p style="color: #555655;font-family: 'proxima_novaregularitalic';font-size: 10pt;line-height: 15px; margin-top:5px;margin-bottom:8px;text-align:left;font-style: italic;">* This Quick Reference Guide is an essential tool for leading this person</p>
				</td>
			</tr>
		<?php }else if($Top_one == "S" && $Top_two == "I"){ ?>
			<tr>
				<td align="left">
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px; margin-top:0px;margin-bottom:8px;padding:0px 15px"><?=$the_report_pattern?> is driven by two temperament needs, a primary need to be accommodating and a secondary need to be accepted socially. </p>
					
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Harmonizers respond best to a relaxed, calm supervisor who shows interest in them personally. They want to be your friend.</b></p>

					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px">They are friendly, accepting, and tolerant of others. Their core drive is harmony, and they are very accommodating and easy to be associated with in the work environment and as a friend. They enjoy being with people and talking. When they feel accepted, they may talk excessively.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px">They are loyal, consistent, and dependable. They are also very independent minded and want to set their own pace. They learn by doing. Once their mind is made up, they will usually resist other methods of approach. </p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">Harmonizers need some routine work but also some activity during the day. They have a very difficult time saying no and will often take on more than they can do. </p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">When leading the Harmonizer, remember that they want to accommodate and be accepted socially, which can make it very difficult for them to make a decision. The Harmonizer tends to avoid conflict at all costs. They resist being confronted and also confronting others.</p>	
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">When communicating with the Harmonizer, be emotionally low-key, warm, practical, and show interest in them personally. Be specific when explaining concepts. Be persistent, push gently, and use visual aids.</p>	
				</td>
			</tr>
			<tr>
				<td align="center">
					<h3 style="font-size: 20pt;margin-bottom: 5px; margin-top:15px; line-height:20pt;">QUICK REFERENCE GUIDE WHEN ENGAGING<br/><?=strtoupper($participantName)?></h3>
				</td>
			</tr>
			
			<tr>
				<td align="left">
					<table style="margin-right:40px;margin-top:0px;width:720px;" cellspacing="0">
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Top Strengths &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Accommodating | Predictable | Patient      <a href="#document_full_list">[See full list below]</a></p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Core Needs &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">No sudden changes | Some social involvement | Clear job requirements | Help in making decisions </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Do's &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Be warm and friendly | Show interest in their family | Give clear directions (when to start and stop)</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Don'ts &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Never hurry a conversation | Do not suddenly change anything | Do not ask them to make quick decisions </p>
							</td>
						</tr>					
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Key Words to Use &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Support | Traditional | Realistic | Care | Family | Practical | Relationship | “I sincerely appreciate…” </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Concerns &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Stubbornness | Lack of sense of urgency | Too accommodating | Resistance to change | Willingness to confront | Possessiveness </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Confronting &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Be warm, friendly, personal, and matter-of-fact | Apply slight pressure | Be very specific | Use concrete visual aids </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Key to Success &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">In order for the Harmonizer to be successful, they need to overcome their fear of conflict. </p>
							</td>
						</tr>
					</table>
					<p style="color: #555655;font-family: 'proxima_novaregularitalic';font-size: 10pt;line-height: 15px; margin-top:5px;margin-bottom:8px;text-align:left;font-style: italic;">* This Quick Reference Guide is an essential tool for leading this person</p>
				</td>
			</tr>
		<?php }else if($Top_one == "S" && $Top_two == "C"){ ?>
			<tr>
				<td align="left">
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px; margin-top:0px;margin-bottom:8px;padding:0px 15px"><?=$the_report_pattern?> is driven by two temperament needs, a primary need to be accommodating and a secondary need to do things right. </p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Helpers respond best to a relaxed, calm supervisor who shows interest in them personally. They want to be your  friend.</b></p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px">Their core need is to help others. When they are helping someone, they feel liked and appreciated. Therefore, they are experiencing no tension, which they enjoy.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px"><?=$the_report_pattern?> thrives on having a routine and, once started, they prefer it not to change. Rather than working with a large group of people, they prefer working with one or two people.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">Patience, control, and deliberateness characterize the usual behavior of this amiable and easy going individual. Because they are low-key, their involvement in a task is not easily observed. <?=$the_report_pattern?> brings a deceptively intense approach to the task. </p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">They are very family oriented so be careful their work does not interfere with their family time.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">They are calm, steady, and persevering. Helpers are successful because of persistence. They are independent, questioning, and will follow through. Once their mind is made up, they typically resist any other method of approach.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">When communicating with the <?=$report_pattern?>, show personal interest in their family, and remove the risk of tension or conflict. Do not show much emotion. Be warm, personal, and practical in communication and give them visual aids.</p>
					</td>
			</tr>
			<tr>
				<td align="center">
					<h3 style="font-size: 20pt;margin-bottom: 5px; margin-top:15px; line-height:20pt;">QUICK REFERENCE GUIDE WHEN ENGAGING<br/><?=strtoupper($participantName)?></h3>
				</td>
			</tr>
			
			<tr>
				<td align="left">
					<table style="margin-right:40px;margin-top:0px;width:720px;" cellspacing="0">
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Top Strengths &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Accommodating | Predictable | Loyal  <a href="#document_full_list">[See full list below]</a></p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Core Needs &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">No sudden changes | Help making decisions | Clear direction | One thing to do at a time</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Do's &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Be warm, low-key | Be persistent and non-threatening | Give clear direction (when to start and stop) | Provide slight pressure</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Don'ts &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Never hurry a conversation | Do not suddenly change anything | Do not show excessive emotion</p>
							</td>
						</tr>					
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Key Words to Use &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Support | Traditional | Realistic | Care | Family | Practical | Relationship | “I sincerely appreciate…”</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Concerns &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Stubbornness | Lack of sense of urgency | Passive aggressiveness | Passiveness | Lack of willingness to confront | Resistance to change</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Confronting &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Be low-key, warm, personal | Allow time to adjust | Be matter-of-fact | Be specific | Use concrete visual aids</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Key to Success &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">In order for the <?=$report_pattern?> to be successful, they need to overcome their fear of conflict. </p>
							</td>
						</tr>
					</table>
					<p style="color: #555655;font-family: 'proxima_novaregularitalic';font-size: 10pt;line-height: 15px; margin-top:5px;margin-bottom:8px;text-align:left;font-style: italic;">* This Quick Reference Guide is an essential tool for leading this person</p>
				</td>
			</tr>
		<?php }else if($Top_one == "C" && $Top_two == "D"){ ?>
			<tr>
				<td align="left">
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px; margin-top:0px;margin-bottom:8px;padding:0px 15px"><?=$the_report_pattern?> is driven by two temperament needs, a primary need to do things right and a secondary need to get results. </p>
					
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Instructors respond best to a supervisor that is logical and factual.</b></p>

					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px">They are systematic, precise thinkers, and follow procedures. They are attentive to detail and push to have things done correctly, according to their own predetermined standards. They are not trying to “be” right, they are trying to figure out what “is” right.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px"><?=$the_report_pattern?> can be very forceful in insisting the right way be followed. They are not socially active, preferring work and privacy over people. They tend to have difficulty in relationships because they are not flexible, and they can be abrasive when communicating with others. They make decisions slowly because of collecting and analyzing information until they are sure of the best course of action.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">To be highly motivated, they need a structured environment with clear rules and procedures, time to organize, collect information, think, and the freedom to develop a plan. They are sensitive and conscientious. </p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">When communicating with the Instructor, be specific, factual, stress quality, and understand their need for a plan. Show concern and tolerate their abruptness. Allow them the opportunity to ask questions.</p>	

					
				</td>
			</tr>
			<tr>
				<td align="center">
					<h3 style="font-size: 20pt;margin-bottom: 5px; margin-top:15px; line-height:20pt;">QUICK REFERENCE GUIDE WHEN ENGAGING<br/><?=strtoupper($participantName)?></h3>
				</td>
			</tr>
			
			<tr>
				<td align="left">
					<table style="margin-right:40px;margin-top:0px;width:720px;" cellspacing="0">
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Top Strengths &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Analytical | Creative problem solver | Likes results <a href="#document_full_list">[See full list below]</a></p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Core Needs &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Information logically given | Feedback, reassurance | To know why | Time to think and plan </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Do's &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Be specific, factual, logical | Explain the big picture | Allow opportunity to ask detailed questions </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Don'ts &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Do not speak in general terms | Do not expect high flexibility | Do not treat questions as unimportant </p>
							</td>
						</tr>					
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Key Words to Use &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Logical | Fact | Precise | Practical | Quality | Detail | Efficient | Results</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Concerns &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Frustration that paralyzes | Indecisive | Critical attitude | Resistance to change | Picky | Anticipates negatives </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Confronting &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Use reason, facts, logic, and persistence | Listen carefully to their explanation | Be specific, firm, use visual aids | Allow questions </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Key to Success &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">In order for the Instructor to be successful, they need to overcome their bluntness.</p>
							</td>
						</tr>
					</table>
					<p style="color: #555655;font-family: 'proxima_novaregularitalic';font-size: 10pt;line-height: 15px; margin-top:5px;margin-bottom:8px;text-align:left;font-style: italic;">* This Quick Reference Guide is an essential tool for leading this person</p>
				</td>
			</tr>
		<?php }else if($Top_one == "C" && $Top_two == "I"){ ?>
			<tr>
				<td align="left">
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px; margin-top:0px;margin-bottom:8px;padding:0px 15px"><?=$the_report_pattern?> is driven by two temperament needs, a primary need to do things right and a secondary need to be accepted socially. </p>
					
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Diplomats respond best to a supervisor that is gentle, logical, and factual.</b></p>

					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px">They are well-balanced, systematic, precise thinkers and workers who tend to follow procedures in both their business and personal life. They are friendly, attentive to detail, and like to do things correctly. They are not trying to “be” right, they are trying to figure out what “is” right. </p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px"><?=$the_report_pattern?> is good at solving conflicts between others. They are objective and have the natural ability to see different viewpoints. They can interact with people very effectively. They do not usually seek leadership.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">They may have difficulty saying no to requests so be careful not to overload them.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">They are extremely conscientious, have high personal ambitions, and need some mobility, rather than sitting for long periods of time. The Diplomat is a versatile, productive individual who works well with most everyone. At times they can be sensitive, especially to criticism. They make decisions slowly because of collecting and analyzing information until they are sure of the best course of action.</p>	
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">To be highly motivated, they need a structured environment with clear rules and procedures, time to organize, time to collect information, time to think, and time to develop a plan. They also need social interaction.</p>	
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">When communicating with the Diplomat, be friendly, factual, smile, and be lighthearted. Be logical, specific, and stress quality. Remove the risk for them to make a bad decision or be embarrassed.</p>	

					
				</td>
			</tr>
			<tr>
				<td align="center">
					<h3 style="font-size: 20pt;margin-bottom: 5px; margin-top:15px; line-height:20pt;">QUICK REFERENCE GUIDE WHEN ENGAGING<br/><?=strtoupper($participantName)?></h3>
				</td>
			</tr>
			
			<tr>
				<td align="left">
					<table style="margin-right:40px;margin-top:0px;width:720px;" cellspacing="0">
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Top Strengths &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;"> Analytical | Conscientious | Diplomatic     <a href="#document_full_list">[See full list below]</a></p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Core Needs &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Information logically given | Privacy | To know why | Feedback, reassurance | A detailed plan </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Do's &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Be friendly, non-aggressive, light-hearted | Be prepared for them to talk when under pressure | Show big picture </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Don'ts &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Do not speak in general terms; be specific | Do not expect them to confront others | Do not cause embarrassment </p>
							</td>
						</tr>					
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Key Words to Use &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Logical | Fact | Precise | Practical | Quality | Detail | Efficient | Fun </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Concerns &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;"> Sensitivity | Indecisive | Depression prone | Picky | Critical attitude | Slow making decisions | Anticipates the negative </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Confronting &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Conversation should be non-threatening| | Use reason, facts, logic | Be warm, caring | Give reasons why </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Key to Success &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">In order for the Diplomat to be successful, they need help making a decision and the opportunity to say “no.”</p>
							</td>
						</tr>
					</table>
					<p style="color: #555655;font-family: 'proxima_novaregularitalic';font-size: 10pt;line-height: 15px; margin-top:5px;margin-bottom:8px;text-align:left;font-style: italic;">* This Quick Reference Guide is an essential tool for leading this person</p>
				</td>
			</tr>
		<?php }else if($Top_one == "C" && $Top_two == "S"){ ?>
			<tr>
				<td align="left">
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px; margin-top:0px;margin-bottom:8px;padding:0px 15px"><?=$the_report_pattern?> is driven by two temperament needs, a primary need to do things right and a secondary need to be accommodating. </p>
					
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Analysts respond best to a supervisor that is gentle, logical, and factual.</b></p>

					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px">Analysts are quiet, work well in a structured environment, and require attention to detail. They are systematic, precise thinkers and workers who tend to follow procedures. They make decisions slowly because of collecting and analyzing information until they are sure of the right and best course of action. They are good at anticipating problems but not good at taking action. They are usually very well organized and function best when they have a well-thought-out plan.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px;margin-bottom:8px;padding:0px 15px">They continually analyze because they are not trying to “be” right, they are trying to figure out what “is” right. Because of this, at times they can be misunderstood.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">To be highly motivated, they need a structured environment with clear rules and procedures, time to organize, collect information, think, and time to develop a plan.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">They are uncomfortable around people and don’t enjoy being around others socially. They need a detailed job in order to perform well, and they need a routine. It’s important to give them very specific instructions and opportunities to ask questions. They typically withdraw from aggressive people.</p>	
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 17px;margin:0px; margin-bottom:8px;padding:0px 15px">When communicating with the Analyst, be low-key, specific, and factual. Avoid conflict, tension, being too direct, and being forceful. Show concern about what concerns them. Be willing to answer their many, detailed questions. Remove the risk of them making a bad decision by giving feedback and reassurance. And stress quality.</p>	
					
				</td>
			</tr>
			<tr>
				<td align="center">
					<h3 style="font-size: 20pt;margin-bottom: 5px; margin-top:15px; line-height:20pt;">QUICK REFERENCE GUIDE WHEN ENGAGING<br/><?=strtoupper($participantName)?></h3>
				</td>
			</tr>
			
			<tr>
				<td align="left">
					<table style="margin-right:40px;margin-top:0px;width:720px;" cellspacing="0">
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Top Strengths &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Analytical | Diplomatic | Accommodating <a href="#document_full_list">[See full list below]</a></p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Core Needs &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Information logically given | Privacy | Time alone to think, plan | Feedback, reassurance | To know why</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Do's &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Be warm, personal, factual, logical | Listen carefully to detailed explanations | Show them the big picture</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Don'ts &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Do not speak in general terms | Do not expect high flexibility | Do not rush to complete a task | Do not criticize their work</p>
							</td>
						</tr>					
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Key Words to Use &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Logical | Fact | Precise | Practical | Quality | Detail | Efficient </p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Concerns &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Indecisive | Resists change | Critical attitude | Withdrawal | Anticipates negatives | Unrealistic standards | Overuses analysis</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Confronting &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">Be non-threatening | Use reason, facts, logic, and persistence | Listen carefully to their explanations | Use specific answers, reasons</p>
							</td>
						</tr>
						<tr>
							<td style="width:24%; display:inline-block;background:#1867a2;vertical-align: middle;border-top:1px solid #526791; padding-right:10px; padding-left:5px;">
								<p style="color:#ffffff; font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:0px;margin-bottom:8px;text-align:right;"><b style="font-family: 'proxima_novabold';">Key to Success &nbsp;<img style="width:15px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/mgr-right-arrow.png" /></b></p>
							</td>
							<td style="width:75%; display:inline-block;background:#eaf1fb;padding-top:8px; padding-bottom:8px;padding-left:10px;padding-right:10px;vertical-align: middle;border-top:1px solid #526791;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 16px; margin-top:0px;margin-bottom:8px;">In order for the Analyst to be successful, they may need help making a decision.</p>
							</td>
						</tr>
					</table>
					<p style="color: #555655;font-family: 'proxima_novaregularitalic';font-size: 10pt;line-height: 15px; margin-top:5px;margin-bottom:8px;text-align:left;font-style: italic;">* This Quick Reference Guide is an essential tool for leading this person</p>
				</td>
			</tr>
		<?php } ?>

	</table>
</div>
<!--page2 ends here-->
<!--page3 starts here-->
<div class="" style="float:left;width:1000px;padding-left:0px;margin-left:0px;">
	<table style="width: 100% margin-left:38px;margin-right:40px;">
		<tr>
			<td align="center">
				<h1 class="text-center" style="font-size: 25pt;margin-bottom: 5px; padding-top:30px; line-height:25pt;">INDIVIDUAL NEEDS OF<br><?=strtoupper($participantName)?></h1> 
				<img style="width: 500px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/border-line-02.png"> 
			</td>
		</tr>
		<tr>
			<td align="left" style="padding:0px 20px;"> 
                <h3 style="font-size: 20pt;margin-bottom: 10px; padding-top:5px; line-height:20pt;">Instructions for Manager</h3>
            </td>
		</tr>
		<tr>
			<td align="left">
				<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:15px;padding:0px 15px">Every person has “Core Needs” (as listed above on page 2) that are specific to their temperament combination.</p>
				
				<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px;margin:0px;margin-bottom:15px;padding:0px 15px">However, each person also has individual needs, which they selected in the assessment as important to them. Normally, there is a strong correlation between a person’s core needs and individual needs.</p>
				
				<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px;margin:0px;margin-bottom:15px;padding:0px 15px">It is very important for leaders and managers to understand each person’s needs.  When these “Core Needs” and “Individual Needs” are met, it creates a positive feeling of acceptance and importance in the individual. If these needs are not met, the individual will feel frustrated and not understood, and will not perform at their best.</p>
				
				<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px;margin:0px;margin-bottom:15px;padding:0px 15px">Everyone desires their temperament needs be met. Below are the temperament needs that <?=$participantName?> selected. Meeting these needs shows you not only understand <?=$participantFirstName?> but you also value this person.</p>
				
				<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px;margin:0px; margin-bottom:15px;padding:0px 15px">As a manager, it is important to let the people you are leading know that you are aware of their temperament needs. You may even ask them, “Am I meeting these needs for you?”</p>
				
				<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px;margin:0px; margin-bottom:15px;padding:0px 15px">Always be thinking, how can I better meet <?=$participantFirstName?>’s needs on an ongoing basis.</p>

				<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px;margin:0px; margin-top:15px; margin-bottom:10px;padding:0px 15px"><b style="font-family: 'proxima_novabold';"><?=$participantName?> selected these individual needs: </b></p>
			</td>			
		</tr>
		
		<tr>
			<td>
				<table style="width:100%;display:inline-block; margin-top:20px;" align="center">
					<tr>
						<td style="background:#f3f3f3; width:70%; padding: 20px; padding-top:5px; padding-bottom:25px;text-align: left;">
							<?php if(isset($needsAssessmentChoices->data) && !empty($needsAssessmentChoices->data)): ?>
								<?php foreach($needsAssessmentChoices->data as $index=>$needChoice): ?>
										<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 13pt;line-height: 18px; margin-top:18px;margin-bottom:0px; padding:0px 20px;"><b style="font-family: 'proxima_novabold';  text-align:left;"><?=($index+1)?>. </b><?php echo stripslashes($needChoice->title); ?> </p>
								<?php endforeach; ?>
							<?php endif; ?>
						</td>
					</tr>		
				</table>
			</td>
		</tr>		
	</table>
</div>
<!--page3 ends here-->
<!--page4 starts here-->
<div class="" style="float:left;width:1000px;padding-left:0px;margin-left:0px;">
	<a name="document_full_list"></a>
	<table style="width: 100% margin-left:38px;margin-right:40px;">
		<tr>
			<td align="center" style="margin-bottom:15px;">
				<h1 class="text-center" style="font-size: 22pt;margin-bottom: 15px; padding-top:30px; line-height:22pt;">UNDERSTANDING THE NATURAL TENDENCIES OF<br><?=strtoupper($participantName)?></h1> 
				<img style="width: 500px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/border-line-02.png"> 
			</td>
		</tr>
		<?php if($Top_one == "D" && $Top_two == "I"){ ?>
			<tr>
				<td>
					<table style="width:100%;display:inline-block; margin-top:10px;" align="left">
						<tr>
							<td style="background:#f3f3f3; width:100%; padding-left: 20px; padding-top:5px; padding-bottom:15px;text-align: left;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:10px;margin-bottom:0px;"><b style="font-family: 'proxima_novabold';">Primary Need: <span style="color:#146bac;">To Get Results</span></b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:2px;margin-bottom:5px; "><?=$the_report_pattern?> shapes their environment by overcoming opposition to accomplish results.</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px;"><b style="font-family: 'proxima_novabold';">Secondary Need: <span style="color:#146bac;">To Be Accepted Socially</span></b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:2px;margin-bottom:0px; "><?=$the_report_pattern?> also shapes their environment by bringing others into alliance to accomplish results.</p>
							</td>
						</tr>		
					</table>
					<p style="color: #555655;font-family: 'proxima_novaregularitalic';font-size: 11pt;line-height: 18px;margin:0px;margin-top:5px; margin-bottom:8px;padding:0px 15px;font-style: italic;">If you are new to managing and leading a person based on their temperament, refer to the Quick Reference Guide on page 2 of this report. </p>
				</td>
			</tr>
			
			<tr>
				<td style="margin-top:0px;">
					<table style="margin-right:40px;margin-top:0px;width:720px;">
						<tr>
							<td style="width:49%;float:left;">
								<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Core Needs</h4>
								</p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Possibility of quick results</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Independence</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Authority</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">To be in control</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Brief and direct conversation </b></p>

								

								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Description</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">firm expression</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">quickly annoyed but easily calmed</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">need social involvement</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">high drive to win, work and control</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">impatient, likes quick results</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">risk-taker, may change careers often</b></p>							
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">requires little sleep</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">egotistical</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">can be overbearing</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">likes to influence others</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">very energetic</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">competitive</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">forceful, domineering</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">likes personal challenges</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">dislikes details</b></p>

															
								
								
								<p style="padding:0px 20px; margin:0px; margin-top:0px;padding-bottom:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:0px; padding-bottom:0px;">Uniqueness</h4>
								</p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">The Executive is more forceful and sociable than the other Choleric (High D) blends. They are very impatient and will take a win/lose approach to life.</p>

								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Strengths</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">direct</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">self-motivated</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">decisive</b></p>								
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">confident</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">desire for results</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">practical problem solver</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">possesses social skills</b></p>
							</td>
							
							<td style="width:49%; display:inline-block;">

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Weaknesses</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">impatient</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">easily annoyed</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">explosive</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may be very abrupt and blunt</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">desire to dominate others</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may lack compassion</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may lack empathy</b></p>


								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Fears</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being taken advantage of</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">lack of results</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">loss of influence</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">expressing too much affection</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Response to Pressure</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may become abrasive and impatient</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may release frustration by a sudden outburst of anger or intense activity</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may be very abrupt or blunt</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may become very dictatorial</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Impact upon Others</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">instills confidence</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">sets pace</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">gets results</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">projects a "can do" attitude</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">competitiveness, high need to win</b></p>
								
								

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Traits Needed for Balance</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">accommodating attitude</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">organization</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">empathy and compassion</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">consistent effort</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">more detail planning</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">self-control</b></p>
								
								

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">How to Approach</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be brief, direct and to the point</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">demonstrate strength</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be result-oriented</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not take their abruptness personally</b></p>
								
							</td>
						</tr>
					</table>
				</td>
			</tr>
		<?php }else if($Top_one == "D" && $Top_two == "S"){ ?>
			<tr>
				<td>
					<table style="width:100%;display:inline-block; margin-top:10px;" align="left">
						<tr>
							<td style="background:#f3f3f3; width:100%; padding-left: 20px; padding-top:5px; padding-bottom:15px;text-align: left;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:10px;margin-bottom:0px;"><b style="font-family: 'proxima_novabold';">Primary Need: <span style="color:#146bac;">To Get Results</span></b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:2px;margin-bottom:5px; "><?=$the_report_pattern?> shapes their environment by overcoming opposition to accomplish results.</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px;"><b style="font-family: 'proxima_novabold';">Secondary Need: <span style="color:#146bac;">To Accommodate Others</span></b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:2px;margin-bottom:0px; "><?=$the_report_pattern?> cooperates with others to carry out the task.</p>
							</td>
						</tr>		
					</table>
					<p style="color: #555655;font-family: 'proxima_novaregularitalic';font-size: 11pt;line-height: 18px;margin:0px;margin-top:5px; margin-bottom:8px;padding:0px 15px;font-style: italic;">If you are new to managing and leading a person based on their temperament, refer to the Quick Reference Guide on page 2 of this report. </p>
				</td>
			</tr>
			
			<tr>
				<td style="margin-top:0px;">
					<table style="margin-right:40px;margin-top:0px;width:720px;">
						<tr>
							<td style="width:49%;float:left;">
								<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Core Needs</h4>
								</p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Independence</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Authority</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Opportunity to advance</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Freedom to achieve own goals</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Brief, direct conversation</b></p>

								

								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Description</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">stoic expression (flat affect)</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">unemotional</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">individualistic</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">can be very stubborn</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">very independent, focused</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">not animated or talkative</b></p>							
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">direct, even blunt</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">prefers work to people</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">prefers privacy</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">becomes drowsy when sitting still</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">able to go to sleep quickly</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">domineering</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">easily annoyed</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">impatient, especially when instructing others</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">confident, may appear aloof</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">brief when answering questions</b></p>

								
								
								<p style="padding:0px 20px; margin:0px; margin-top:0px;padding-bottom:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">Uniqueness</h4>
								</p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">Directors are more determined than the other Choleric blends. They are very unemotional and individualistic.</p>

								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Strengths</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">directness</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">practical problem solver</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">self determination</b></p>								
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">confident</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">desire for results</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">stability</b></p>

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">Needed from Others</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">tolerance for a lack of expressing emotion</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">occasional shock</b></p>
							</td>
							
							<td style="width:50%; display:inline-block;">

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Weaknesses</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">bluntness</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">easily annoyed</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">unemotional</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">lacks sympathy</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">lacks compassion</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">too independent</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">sudden bursts of anger</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">too impersonal</b></p>


								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Fears</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being taken advantage of</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">lack of results</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">too much involvement with people</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">expressing emotion</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Response to Pressure</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may become abrasive</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may release frustration by a sudden outburst of anger; they may also rest or sleep</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may withdraw</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may become dictatorial</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may become sarcastic</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Impact upon Others</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">determination to succeed</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">sets pace, gets results</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">"can do" attitude</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">stability</b></p>
								
								

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Traits Needed for Balance</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">friendliness</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">involvement with others</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">diplomacy</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">sensitivity</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">empathy</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">self-control</b></p>
								
								

								<?php /*<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">Needed from Others</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">tolerance for a lack of expressing emotion</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">occasional shock</b></p> */ ?>
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">How to Approach</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be brief, direct and to the point</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">demonstrate strength</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">stress time savings and logic</b></p>								
							</td>
						</tr>
					</table>
				</td>
			</tr>
		<?php }else if($Top_one == "D" && $Top_two == "C"){ ?>
			<tr>
				<td>
					<table style="width:100%;display:inline-block; margin-top:10px;" align="left">
						<tr>
							<td style="background:#f3f3f3; width:100%; padding-left: 20px; padding-top:5px; padding-bottom:15px;text-align: left;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:10px;margin-bottom:0px;"><b style="font-family: 'proxima_novabold';">Primary Need: <span style="color:#146bac;">To Get Results</span></b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:2px;margin-bottom:5px; "><?=$the_report_pattern?> shapes their environment by overcoming opposition to accomplish results.</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px;"><b style="font-family: 'proxima_novabold';">Secondary Need: <span style="color:#146bac;">To Do Things Right</span></b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:2px;margin-bottom:0px; "><?=$the_report_pattern?> also wants quality in products or service.</p>
							</td>
						</tr>		
					</table>
					<p style="color: #555655;font-family: 'proxima_novaregularitalic';font-size: 11pt;line-height: 18px;margin:0px;margin-top:5px; margin-bottom:5px;padding:0px 15px;font-style: italic;">If you are new to managing and leading a person based on their temperament, refer to the Quick Reference Guide on page 2 of this report. </p>
				</td>
			</tr>
			
			<tr>
				<td style="margin-top:0px;">
					<table style="margin-right:40px;margin-top:0px;width:720px;">
						<tr>
							<td style="width:48%;float:left;">
								<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:5px; margin-bottom:5px; padding-bottom:0px;">Core Needs</h4>
								</p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Quick results</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Personal challenge</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Opportunity to fix something</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Brief, direct conversation</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Information</b></p>

								

								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:8px; margin-bottom:5px; padding-bottom:0px;">Description</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">serious, firm expression</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">quickly provoked and easily calmed down</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">can be very direct and blunt</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">confidence in tone of voice</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">needs facts and time alone to think</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">needs a plan</b></p>							
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">prefers work to people</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">can be very competitive</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">creative problem solver</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">tends to ask detailed questions</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">can be very critical, overbearing</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">can be very domineering</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">can be moody, private</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">can be very forceful</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">children easily drawn to them</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">selectively organized</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; margin-top:0px;padding-bottom:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:8px; margin-bottom:0px; padding-bottom:0px;">Uniqueness</h4>
								</p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">Strategists are more detail-oriented than the other Choleric (High D) blends. They initiate change and will operate from a well-thought-through plan of action.</p>

								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:8px; margin-bottom:5px; padding-bottom:0px;">Strengths</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">directness</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">operates from detailed plan</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">desire for right results</b></p>								
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">decisive</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">creative problem solver</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">confidence</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">practical</b></p>
								
							</td>
							
							<td style="width:51%; display:inline-block;">

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:5px; margin-bottom:5px; padding-bottom:0px;">Weaknesses</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">impatience</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">explosiveness</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">moodiness -- negative self-talk, they think too much about the wrong thing</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">crisis communication</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">lack of sensitivity and empathy</b></p>


								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:8px; margin-bottom:5px; padding-bottom:0px;">Fears</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being taken advantage of</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">lack of results</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">loss of control</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">expressing affection</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:8px; margin-bottom:5px; padding-bottom:0px;">Response to Pressure</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may become abrasive, critical and moody</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may release frustration by a sudden burst of anger or may withdraw</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may become impatient and dictatorial</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:8px; margin-bottom:5px; padding-bottom:0px;">Impact upon Others</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">detail planning</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">confidence</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">goal oriented</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">creative thinking</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">competitiveness</b></p>
								
								

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:8px; margin-bottom:5px; padding-bottom:0px;">Traits Needed for Balance</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">sensitivity toward others</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">positive self-talk</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">consistency</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">emotional stability</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">self-control</b></p>
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:0px; padding-bottom:0px;">Needed from Others</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">logical and factual information</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">tolerance of crisis style of communication</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">occasional shock</b></p>



								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:8px; margin-bottom:5px; padding-bottom:0px;">How to Approach</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be brief, direct and to the point</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">demonstrate strength</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be prepared to reason assertively</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give bottom line</b></p>
								
							</td>
						</tr>
					</table>
				</td>
			</tr>
		<?php }else if($Top_one == "I" && $Top_two == "D"){ ?>
			<tr>
				<td>
					<table style="width:100%;display:inline-block; margin-top:10px;" align="left">
						<tr>
							<td style="background:#f3f3f3; width:100%; padding-left: 20px; padding-top:5px; padding-bottom:15px;text-align: left;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:10px;margin-bottom:0px;"><b style="font-family: 'proxima_novabold';">Primary Need: <span style="color:#146bac;">To Be Accepted Socially</span></b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:2px;margin-bottom:5px; "><?=$the_report_pattern?> shapes their environment by bringing  others into alliance to accomplish results.</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px;"><b style="font-family: 'proxima_novabold';">Secondary Need: <span style="color:#146bac;">To Get Results</span></b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:2px;margin-bottom:0px; "><?=$the_report_pattern?> also shapes their environment by overcoming opposition to accomplish results.</p>
							</td>
						</tr>		
					</table>
					<p style="color: #555655;font-family: 'proxima_novaregularitalic';font-size: 11pt;line-height: 18px;margin:0px;margin-top:5px; margin-bottom:8px;padding:0px 15px;font-style: italic;">If you are new to managing and leading a person based on their temperament, refer to the Quick Reference Guide on page 2 of this report. </p>
				</td>
			</tr>
			
			<tr>
				<td style="margin-top:0px;">
					<table style="margin-right:40px;margin-top:0px;width:720px;">
						<tr>
							<td style="width:49%;float:left;">
								<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Core Needs</h4>
								</p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Social involvement</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">To influence others</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">To talk</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Freedom to express ideas</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Freedom from details</b></p>

								

								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Description</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">needs to be with others most of the time</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">likes to control others and events</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">rarely likes being inactive</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">experiences burnout often</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">easily excited</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">can overwhelm with emotion</b></p>							
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may have outbursts of anger</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">very competitive</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">will work in spurts</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">now person; shoots from the hip</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">confident, impatient and egotistical</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">has difficulty with consistency and details</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">very energetic and persuasive</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">socially active; knows lots of people</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">can be assertive without offending</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">likes status things</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">likes variety and a change of pace</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">optimistic, full of hope</b></p>
								
								
								
								
								<p style="padding:0px 20px; margin:0px; margin-top:0px;padding-bottom:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:0px; padding-bottom:0px;">Uniqueness</h4>
								</p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">Negotiators are more assertive than other Sanguine blends. They easily manipulate others.</p>

								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Strengths</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">persuasive</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">enthusiastic</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">sociable</b></p>								
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">friendly</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">open</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">influences others</b></p>
							</td>
							
							<td style="width:49%; display:inline-block;">

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Weaknesses</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">impulsive</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">inconsistent</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">plays too much</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">talks too much</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">lacks organization and planning</b></p>


								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Fears</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">rejection</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">details</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">fixed environment</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">losing</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Response to Pressure</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may become restless and rebel</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may release frustration by verbally attacking</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may need to talk extensively about issues</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may manipulate and persuade with emotion</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may deny the facts or reality</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Impact upon Others</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">open friendships</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">ability to verbalize</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">thoughts and feelings</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">positive outlook on life</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">competitiveness</b></p>
								
								

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Traits Needed for Balance</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">organization</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">patience</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">consistency</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">self-control</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">detail planning, structure and routine</b></p>
								
								

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">How to Approach</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be friendly, open and flexible</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be positive and show excitement</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be objective</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">use facts and logic</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be willing to listen to them</b></p>
								
							</td>
						</tr>
					</table>
				</td>
			</tr>
		<?php }else if($Top_one == "I" && $Top_two == "S"){ ?>
			<tr>
				<td>
					<table style="width:100%;display:inline-block; margin-top:10px;" align="left">
						<tr>
							<td style="background:#f3f3f3; width:100%; padding-left: 20px; padding-top:5px; padding-bottom:15px;text-align: left;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:10px;margin-bottom:0px;"><b style="font-family: 'proxima_novabold';">Primary Need: <span style="color:#146bac;">To Be Accepted Socially</span></b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:2px;margin-bottom:5px; "><?=$the_report_pattern?> shapes their environment by bringing others into alliance to accomplish results.</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px;"><b style="font-family: 'proxima_novabold';">Secondary Need: <span style="color:#146bac;">To Accommodate Others</span></b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:2px;margin-bottom:0px; "><?=$the_report_pattern?> also cooperates with others to carry out the task.</p>
							</td>
						</tr>		
					</table>
					<p style="color: #555655;font-family: 'proxima_novaregularitalic';font-size: 11pt;line-height: 18px;margin:0px;margin-top:5px; margin-bottom:8px;padding:0px 15px;font-style: italic;">If you are new to managing and leading a person based on their temperament, refer to the Quick Reference Guide on page 2 of this report. </p>
				</td>
			</tr>
			
			<tr>
				<td style="margin-top:0px;">
					<table style="margin-right:40px;margin-top:0px;width:720px;">
						<tr>
							<td style="width:49%;float:left;">
								<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Core Needs</h4>
								</p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Long-term relationships</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Exciting activity </b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Others to be gentle</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">To serve others </b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Routine to feel secure</b></p>

								

								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Description</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">needs to be with people most of time</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">needs to be alone some of the time</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">when alone will likely rest</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">dislikes pressuring people</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">easy to tell problems to</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">becomes drowsy when sitting</b></p>							
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">able to go to sleep quickly</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">easy to be with, nice person</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">forms deep, lasting relationships</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">can be stubborn, independent</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">emotionally stable</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">more friendly after warm-up</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">likes some routine</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">children easily drawn to them</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">very trusting of others</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">optimistic and full of hope</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">likes "status" things</b></p>

								
								
								<p style="padding:0px 20px; margin:0px; margin-top:0px;padding-bottom:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:0px; padding-bottom:0px;">Uniqueness</h4>
								</p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">Relaters are more friendship oriented than the other Sanguine (High I) blends. They are very approachable and place high importance on lasting relationships.</p>

								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Strengths</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">accepting of others</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">gentle friendliness</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">empathy</b></p>								
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">compassion</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">understanding</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">lasting personal relationships</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">patience with people</b></p>
							</td>
							
							<td style="width:49%; display:inline-block;">

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Weaknesses</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">reluctant to confront others</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">disorganization</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">impulsiveness</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">likes to play and talk</b></p>



								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Fears</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">loss of friendships</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">unstable environment</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">disunity</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">losing</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Response to Pressure</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may deny reality</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may release frustration by talking or sleeping</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may manipulate with emotion</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may withdraw to rest</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may rebel subtly</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may become very stubborn</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Impact upon Others</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">accepting of others</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">calm control</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">lasting personal relationships</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">stability</b></p>

								
								

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Traits Needed for Balance</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">more directness</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">willingness to state opinion</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">organization</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">more detail planning</b></p>
								
								
								

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">How to Approach</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be friendly, nice and gentle</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be willing to listen</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">show excitement</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be objective, use facts</b></p>

								
							</td>
						</tr>
					</table>
				</td>
			</tr>
		<?php }else if($Top_one == "I" && $Top_two == "C"){ ?>
			<tr>
				<td>
					<table style="width:100%;display:inline-block; margin-top:10px;" align="left">
						<tr>
							<td style="background:#f3f3f3; width:100%; padding-left: 20px; padding-top:5px; padding-bottom:15px;text-align: left;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:10px;margin-bottom:0px;"><b style="font-family: 'proxima_novabold';">Primary Need: <span style="color:#146bac;">To Be Accepted Socailly</span></b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:2px;margin-bottom:5px; "><?=$the_report_pattern?> shapes their environment by bringing others into alliance to accomplish results.</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px;"><b style="font-family: 'proxima_novabold';">Secondary Need: <span style="color:#146bac;">To Do Things Right</span></b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:2px;margin-bottom:0px; "><?=$the_report_pattern?> also wants quality in products or service.</p>
							</td>
						</tr>		
					</table>
					<p style="color: #555655;font-family: 'proxima_novaregularitalic';font-size: 11pt;line-height: 18px;margin:0px;margin-top:5px; margin-bottom:8px;padding:0px 15px;font-style: italic;">If you are new to managing and leading a person based on their temperament, refer to the Quick Reference Guide on page 2 of this report. </p>
				</td>
			</tr>
			
			<tr>
				<td style="margin-top:0px;">
					<table style="margin-right:40px;margin-top:0px;width:720px;">
						<tr>
							<td style="width:48%;float:left;">
								<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:8px; margin-bottom:5px; padding-bottom:0px;">Core Needs</h4>
								</p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Freedom to express ideas</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Time to think and develop a plan</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Reasons and facts, logically given</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Recognition </b></p>

								

								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Description</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">needs to be with people most of the time</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">needs to be alone some of the time</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">deep need to make a favorable impression</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may do things to extreme</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">picky about appearance</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">when alone will likely think and plan</b></p>							
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">has guilt feelings</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">more friendly after warm-up</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">selectively organized</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">emotions may fluctuate widely</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may be restless before sleeping</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">likes "status" and “quality" things</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">can be optimistic and at times pessimistic</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">articulate</b></p>

																
								
								
								<p style="padding:0px 20px; margin:0px; margin-top:0px;padding-bottom:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">Uniqueness</h4>
								</p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">Performers are more formal than the other Sanguine (High I) blends. They are very concerned about making a favorable impression.</p>

								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Strengths</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">persuades with emotions and facts</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">high drive to win</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">creative thinking</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">initiates projects</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">doing things right</b></p>

								<p style="padding:0px 20px; margin:0px; margin-top:0px;padding-bottom:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">Needed from Others</h4>
								</p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">Help to control mood swings and overcome the need to make a favorable impression.</p>
							</td>
							
							<td style="width:51%; display:inline-block;">

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:8px; margin-bottom:5px; padding-bottom:0px;">Weaknesses</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">emotional highs and lows</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">critical thinking; they think too much about the wrong thing (negative self-talk)</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">impractical; high unrealistic standards</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">need to make a favorable impression</b></p>

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Fears</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">rejection</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">embarrassment</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">losing</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">not making a favorable impression</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">not doing the task correctly</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Response to Pressure</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may withdraw, become depressed</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may release frustration by talking, withdrawing, verbally attacking</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may manipulate with emotion</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may deny objective facts and reality</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may become angry, critical</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Impact upon Others</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">logical arguments</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">makes a great group presentation</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">need to gather information</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">creativity</b></p>
								
								

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Traits Needed for Balance</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">control of emotions</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">consistent organization</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">realistic standards</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">relaxation</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">positive self-talk</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">clear, practical goals</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">respect for authority</b></p>
								
								
								<?php /*<p style="padding:0px 20px; margin:0px; margin-top:0px;padding-bottom:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">Needed from Others</h4>
								</p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">Help to control mood swings and overcome the need to make a favorable impression.</p> */ ?>


								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">How to Approach</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be open, friendly and accepting</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">allow them the opportunity to state their opinion; listen carefully</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be ready to answer detailed questions</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be logical and factual</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">allow time to process information</b></p>
								
							</td>
						</tr>
					</table>
				</td>
			</tr>
		<?php }else if($Top_one == "S" && $Top_two == "D"){ ?>
			<tr>
				<td>
					<table style="width:100%;display:inline-block; margin-top:10px;" align="left">
						<tr>
							<td style="background:#f3f3f3; width:100%; padding-left: 20px; padding-top:5px; padding-bottom:15px;text-align: left;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:10px;margin-bottom:0px;"><b style="font-family: 'proxima_novabold';">Primary Need: <span style="color:#146bac;">To Accommodate Others </span></b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:2px;margin-bottom:5px; "><?=$the_report_pattern?> cooperates with others to carry out the task.</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px;"><b style="font-family: 'proxima_novabold';">Secondary Need: <span style="color:#146bac;">To Get Results</span></b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:2px;margin-bottom:0px; "><?=$the_report_pattern?> also shapes their environment by overcoming opposition to accomplish results.</p>
							</td>
						</tr>		
					</table>
					<p style="color: #555655;font-family: 'proxima_novaregularitalic';font-size: 11pt;line-height: 18px;margin:0px;margin-top:5px; margin-bottom:8px;padding:0px 15px;font-style: italic;">If you are new to managing and leading a person based on their temperament, refer to the Quick Reference Guide on page 2 of this report. </p>
				</td>
			</tr>
			
			<tr>
				<td style="margin-top:0px;">
					<table style="margin-right:40px;margin-top:0px;width:720px;">
						<tr>
							<td style="width:49%;float:left;">
								<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Core Needs</h4>
								</p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">No sudden changes</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Independence</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">To provide support</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Clear requirements</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Security</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">One thing at a time</b></p>

								

								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Description</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">needs to be alone most of the time</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">wants to see results</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">rarely shows emotion</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may be sarcastic</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">black or white approach to life</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">somewhat friendly after warm-up</b></p>							
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">can be very stubborn</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">very loyal, service minded</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">very dependable; will work when sick</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">independent (loner) and possessive</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">resists sudden change</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">becomes drowsy when sitting</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">able to go to sleep quickly</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">can be very routine</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">aggressiveness usually related to an attempt to restore harmony</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">has a few close friends</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">fears conflict</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">very focused, practical</b></p>

																
								
								
								<p style="padding:0px 20px; margin:0px; margin-top:0px;padding-bottom:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:0px; padding-bottom:0px;">Uniqueness</h4>
								</p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">Inspectors are more stubborn than the other Phlegmatic (High S) blends. They rarely give up once they set a goal.</p>

								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Strengths</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">calmness in crisis</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">dependability</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">determination</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">not easily distracted</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">accommodating</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">responsible</b></p>
							</td>
							
							<td style="width:49%; display:inline-block;">

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Weaknesses</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">resistance to change</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">possessive</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">blunt</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">stubborn</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">indecisive</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">aloof</b></p>

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Fears</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">too much involvement with people</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">abstract ideas</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">change</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">loss of freedom</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Response to Pressure</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may worry, withdraw</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may release frustration by outbursts of anger and/or sleeping</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may procrastinate</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may become sarcastic</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Impact upon Others</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">determination</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">loyalty</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">stability</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">dependable</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">practical</b></p>
								
								

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Traits Needed for Balance</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">friendliness</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">openness</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">sensitivity</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">social involvement</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">more detail planning</b></p>
								
								

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">How to Approach</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be personal, persistent</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">prepare them prior to change</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">take time to listen</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">show sincere interest in family</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not force, push gently</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be very specific</b></p>
								
							</td>
						</tr>
					</table>
				</td>
			</tr>
		<?php }else if($Top_one == "S" && $Top_two == "I"){ ?>
			<tr>
				<td>
					<table style="width:100%;display:inline-block; margin-top:10px;" align="left">
						<tr>
							<td style="background:#f3f3f3; width:100%; padding-left: 20px; padding-top:5px; padding-bottom:15px;text-align: left;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:10px;margin-bottom:0px;"><b style="font-family: 'proxima_novabold';">Primary Need: <span style="color:#146bac;">To Accommodate Others</span></b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:2px;margin-bottom:5px; "><?=$the_report_pattern?> cooperates with others to carry out the task.</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px;"><b style="font-family: 'proxima_novabold';">Secondary Need: <span style="color:#146bac;">To Be Accepted Socially</span></b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:2px;margin-bottom:0px; "><?=$the_report_pattern?> also shapes their environment by bringing others into alliance to accomplish results.</p>
							</td>
						</tr>		
					</table>
					<p style="color: #555655;font-family: 'proxima_novaregularitalic';font-size: 11pt;line-height: 18px;margin:0px;margin-top:5px; margin-bottom:8px;padding:0px 15px;font-style: italic;">If you are new to managing and leading a person based on their temperament, refer to the Quick Reference Guide on page 2 of this report. </p>
				</td>
			</tr>
			
			<tr>
				<td style="margin-top:0px;">
					<table style="margin-right:40px;margin-top:10px;width:720px;">
						<tr>
							<td style="width:49%;float:left;">
								<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Core Needs</h4>
								</p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">No sudden changes</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Some social involvement</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Clear job requirements</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Help in making decisions</b></p>
								

								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Description</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">needs to be alone most of the time</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">needs to be with people some of the time</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">more friendly after warm-up; at times talkative</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">has difficulty pressuring people</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">very nice, likable person</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">very accommodating, hard to say "no"</b></p>							
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">very loyal, service minded</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">very dependable, will work when sick</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">independent</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">possessive</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">resists sudden change</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">able to go to sleep quickly</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">becomes drowsy when sitting</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">can be very routine, stubborn</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">aggressiveness usually related to an attempt to restore harmony</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">has a few close friends</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">fears conflict</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; margin-top:0px;padding-bottom:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:0px; padding-bottom:0px;">Uniqueness</h4>
								</p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">Harmonizers are more friendly than the other Phlegmatic (High S) blends. They are very accepting and tolerant of others.</p>

								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Strengths</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">accommodating</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">predictable</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">patient</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">soft friendliness</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">accepting</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">dependable</b></p>
							</td>
							
							<td style="width:49%; display:inline-block;">

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Weaknesses</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">resists change</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">possessive</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">fears confronting others</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">stubborn</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">indecisive</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may talk too much</b></p>


								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Fears</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">putting pressure on people</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">disharmony</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">change</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">infringement on home life</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Response to Pressure</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may worry and withdraw</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may release frustration by sleeping or talking</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may procrastinate</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Impact upon Others</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being empathetic</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">having a supportive attitude</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">having a cooperative attitude</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being dependable</b></p>
								
								

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Traits Needed for Balance</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">willingness to confront</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">directness</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">decisiveness</b></p>
								

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">How to Approach</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be warm and friendly</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">prepare them prior to change</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be nice, gentle and listen carefully</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">show sincere interest in family</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not force; push gently</b></p>
								
							</td>
						</tr>
					</table>
				</td>
			</tr>
		<?php }else if($Top_one == "S" && $Top_two == "C"){ ?>
			<tr>
				<td>
					<table style="width:100%;display:inline-block; margin-top:10px;" align="left">
						<tr>
							<td style="background:#f3f3f3; width:100%; padding-left: 20px; padding-top:5px; padding-bottom:15px;text-align: left;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:10px;margin-bottom:0px;"><b style="font-family: 'proxima_novabold';">Primary Need: <span style="color:#146bac;">To Accommodate Others</span></b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:2px;margin-bottom:5px; "><?=$the_report_pattern?> cooperates with others to carry out the task.</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px;"><b style="font-family: 'proxima_novabold';">Secondary Need: <span style="color:#146bac;">To Do Things Right</span></b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:2px;margin-bottom:0px; "><?=$the_report_pattern?> also wants quality in products or service.</p>
							</td>
						</tr>		
					</table>
					<p style="color: #555655;font-family: 'proxima_novaregularitalic';font-size: 11pt;line-height: 18px;margin:0px;margin-top:5px; margin-bottom:8px;padding:0px 15px;font-style: italic;">If you are new to managing and leading a person based on their temperament, refer to the Quick Reference Guide on page 2 of this report. </p>
				</td>
			</tr>
			
			<tr>
				<td style="margin-top:0px;">
					<table style="margin-right:40px;margin-top:0px;width:720px;">
						<tr>
							<td style="width:49%;float:left;">
								<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Core Needs</h4>
								</p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">No sudden changes</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Help making decisions </b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Clear direction </b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">One thing to do at a time </b></p>

								

								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Description</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">rarely shows emotion</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">assertiveness usually related to an attempt to restore harmony</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">very private person, few close friends</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">nice, gracious, stubborn</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">somewhat friendly after warm-up</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">most activity centered around family</b></p>							
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">routine, consistent, loyal</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">has difficulty pressuring others</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">resists sudden change</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">very accommodating, hard to say "no"</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">desires independence</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">very dependable, will work when ill</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">becomes drowsy when sitting</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">able to go to sleep quickly</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">very possessive, service minded</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">fears conflict, too much personal involvement with others</b></p>
								
								
								
								
								<p style="padding:0px 20px; margin:0px; margin-top:0px;padding-bottom:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:0px; padding-bottom:0px;">Uniqueness</h4>
								</p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">Helpers are more consistent than the other Phlegmatic (High S) blends. They are very routine, accommodating and passive.</p>

								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Strengths</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">accommodating</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">predictable</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">loyal</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">patient</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">calm</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">dependable</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">stable</b></p>
							</td>
							
							<td style="width:49%; display:inline-block;">

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Weaknesses</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">stubborn</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">worrisome</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">resists change</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">passive</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">indecisive</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">fears confrontation</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">too accommodating</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">possessive</b></p>


								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Fears</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">putting pressure on people</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">disharmony</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">infringement on home life</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">sudden change</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Response to Pressure</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may worry excessively</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may withdraw</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may release frustration by sleeping</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may procrastinate</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may become critical, sarcastic</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Impact upon Others</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">accommodating nature</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">supportive attitude</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">cooperative attitude</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">dependability</b></p>
								
								

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Traits Needed for Balance</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">show of emotion</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">assertiveness</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">flexibility</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">friendliness</b></p>
								
								

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">How to Approach</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be warm, friendly and very specific</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">prepare them well in advance of change</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">show sincere interest in family</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not force; push gently</b></p>
								
							</td>
						</tr>
					</table>
				</td>
			</tr>
		<?php }else if($Top_one == "C" && $Top_two == "D"){ ?>
			<tr>
				<td>
					<table style="width:100%;display:inline-block; margin-top:10px;" align="left">
						<tr>
							<td style="background:#f3f3f3; width:100%; padding-left: 20px; padding-top:5px; padding-bottom:15px;text-align: left;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:10px;margin-bottom:0px;"><b style="font-family: 'proxima_novabold';">Primary Need: <span style="color:#146bac;">To Do Things Right</span></b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:2px;margin-bottom:5px; "><?=$the_report_pattern?> works with existing circumstances to promote quality in products or service.</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px;"><b style="font-family: 'proxima_novabold';">Secondary Need: <span style="color:#146bac;">To Get Results</span></b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:2px;margin-bottom:0px; "><?=$the_report_pattern?> also shapes their environment by overcoming opposition to accomplish results.</p>
							</td>
						</tr>		
					</table>
					<p style="color: #555655;font-family: 'proxima_novaregularitalic';font-size: 11pt;line-height: 18px;margin:0px;margin-top:5px; margin-bottom:8px;padding:0px 15px;font-style: italic;">If you are new to managing and leading a person based on their temperament, refer to the Quick Reference Guide on page 2 of this report. </p>
				</td>
			</tr>
			
			<tr>
				<td style="margin-top:0px;">
					<table style="margin-right:40px;margin-top:0px;width:720px;">
						<tr>
							<td style="width:49%;float:left;">
								<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:6px; margin-bottom:5px; padding-bottom:0px;">Core Needs</h4>
								</p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Information logically given</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Feedback, reassurance</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">To know why</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Time to think and plan </b></p>
								

								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Description</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">needs information</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">needs time alone to think</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">needs to develop a plan</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">needs to see results</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">strong sense of justice</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">perfectionist</b></p>							
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">conscientious</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">likes to control</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">has guilt feelings</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">moody (emotional lows)</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">likes quality things, privacy</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">difficult to get to know; few close friends</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may have difficulty going to sleep</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">can be blunt and abrasive</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may resist until reasons for change are explained and accepted</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may appear detached</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">self-sacrificing nature</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">apologetic</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">high standards for self and others</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; margin-top:0px;padding-bottom:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">Uniqueness</h4>
								</p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">Instructors are more forceful than the other Melancholy (High C) blends.</p>

								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Strengths</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">analytical</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">creative problem solver</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">likes results</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">sense of justice</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">high standards</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">organization</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">likes to do things right</b></p>
							</td>
							
							<td style="width:50%; display:inline-block;">

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:6px; margin-bottom:5px; padding-bottom:0px;">Weaknesses</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">indecisive</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">resists change</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">easily frustrated</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">withdraws</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">critical attitude</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">moodiness</b></p>


								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Fears</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being wrong</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">work being criticized</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">not having a plan</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">ridicule</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">conflict</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">not having privacy</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Response to Pressure</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may become negative, suspicious</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may release frustration by withdrawing or have an outburst of anger</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may become depressed, want to quit</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Impact upon Others</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">high standards</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">defining procedures</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">doing things right</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">standing for what is right</b></p>
								
								

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Traits Needed for Balance</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">positive thinking (self-talk)</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">friendliness</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">to express opinions without emotion (learn to be matter-of-fact)</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">Needed from Others</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">help to control moodiness</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">tolerance of need to analyze</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">help to become more social</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">help to get through detail</b></p>
								

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">How to Approach</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be factual, logical and firm</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">allow time alone to think</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give reasons why, listen</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">stress quality, rightness</b></p>
								
								
							</td>
						</tr>
					</table>
				</td>
			</tr>
		<?php }else if($Top_one == "C" && $Top_two == "I"){ ?>
			<tr>
				<td>
					<table style="width:100%;display:inline-block; margin-top:10px;" align="left">
						<tr>
							<td style="background:#f3f3f3; width:100%;padding-left:20px;padding-top:5px; padding-bottom:10px; margin-bottom:0px;text-align: left;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:10px;margin-bottom:0px;"><b style="font-family: 'proxima_novabold';">Primary Need: <span style="color:#146bac;">To Do Things Right</span></b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:2px;margin-bottom:5px; "><?=$the_report_pattern?> works with existing circumstances to promote quality in products or service.</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px;"><b style="font-family: 'proxima_novabold';">Secondary Need: <span style="color:#146bac;">To Be Accepted Socially</span></b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:2px;margin-bottom:0px;"><?=$the_report_pattern?> also shapes their environment by bringing others into alliance to accomplish results.</p>
							</td>
						</tr>		
					</table>
					<p style="color: #555655;font-family: 'proxima_novaregularitalic';font-size: 11pt;line-height: 18px;margin:0px;margin-top:5px; margin-bottom:8px;padding:0px 15px;font-style: italic;">If you are new to managing and leading a person based on their temperament, refer to the Quick Reference Guide on page 2 of this report. </p>
				</td>
			</tr>
			
			<tr>
				<td style="margin-top:0px;">
					<table style="margin-right:40px;margin-top:0px;width:720px;">
						<tr>
							<td style="width:49%;float:left;">
								<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Core Needs</h4>
								</p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Information logically given</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Privacy</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">To know why</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">	Feedback, reassurance</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">A detailed plan </b></p>
								

								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Description</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">needs to be alone most of the time</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">needs to be with people sometimes</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">needs information, time alone to think</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">needs to develop a plan</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">	generally, likes to ease into the day</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">assertive to restore harmony</b></p>							
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">strong sense of justice</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">self-sacrificing nature</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">high personal ambitions</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">fears conflict, pressuring others</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">more friendly after warm-up</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">	moody, emotional lows and highs</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">likes quality and status things</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may have difficulty going to sleep; usually planning, reviewing, worrying, etc.</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">selectively organized</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may resist until reasons for change are explained and accepted</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">high standards for self and others</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">apologetic</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">has guilt feelings</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; margin-top:0px;padding-bottom:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:0px; padding-bottom:0px;">Uniqueness</h4>
								</p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;"><?=$the_report_pattern?> is more friendly than the other Melancholy (High C) blends. They have high personal ambitions. They are usually well- balanced.</p>

								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Strengths</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">analytical</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">conscientious</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">diplomatic</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">friendly</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">creative thinking</b></p>

							</td>
							
							<td style="width:49%; display:inline-block;">

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Weaknesses</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">sensitivity</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">moodiness</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">negative self-talk</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">critical attitude</b></p>

								

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Fears</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">conflict</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being wrong</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">loss of emotional control</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">loss of social acceptance</b></p>

								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Response to Pressure</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may become negative and suspicious</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may release frustration by withdrawing, talking, becoming verbally aggressive</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may become depressed, want to quit</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Impact upon Others</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">gentle friendliness</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">diplomacy</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">doing things right</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">conscientious</b></p>
								
								

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Traits Needed for Balance</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">positive self-talk</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">consistency</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">to express opinions without emotion (learn to be matter-of-fact)</b></p>
								
								
																

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">How to Approach</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be warm, friendly, and open</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">control your emotions</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">allow time alone to think</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">listen carefully</b></p>
								
								
							</td>
						</tr>
					</table>
				</td>
			</tr>
		<?php }else if($Top_one == "C" && $Top_two == "S"){ ?>
			<tr>
				<td>
					<table style="width:100%;display:inline-block; margin-top:10px;" align="left">
						<tr>
							<td style="background:#f3f3f3; width:100%; padding-left: 20px; padding-top:5px; padding-bottom:15px;text-align: left;">
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:10px;margin-bottom:0px;"><b style="font-family: 'proxima_novabold';">Primary Need: <span style="color:#146bac;">To Do Things Right</span></b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:2px;margin-bottom:5px; "><?=$the_report_pattern?> works with existing circumstances to promote quality in products or service.</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px;"><b style="font-family: 'proxima_novabold';">Secondary Need: <span style="color:#146bac;">To Accommodate Others</span></b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:2px;margin-bottom:0px; "><?=$the_report_pattern?> also cooperates with others to carry out the task.</p>
							</td>
						</tr>		
					</table>
					<p style="color: #555655;font-family: 'proxima_novaregularitalic';font-size: 11pt;line-height: 18px;margin:0px;margin-top:5px; margin-bottom:8px;padding:0px 15px;font-style: italic;">If you are new to managing and leading a person based on their temperament, refer to the Quick Reference Guide on page 2 of this report. </p>
				</td>
			</tr>
			
			<tr>
				<td style="margin-top:0px;">
					<table style="margin-right:40px;margin-top:0px;width:720px;">
						<tr>
							<td style="width:49%;float:left;">
								<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Core Needs</h4>
								</p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Information logically given</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Privacy</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Time alone to think, plan</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">	Feedback, reassurance</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">To know why</b></p>
								

								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Description</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">needs information, time alone to think</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">needs to develop a plan</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">self-sacrificing, self-critical nature</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">difficulty pressuring others</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may have difficulty going to sleep; usually planning, reviewing, worrying, etc.</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may become assertive to restore harmony to their environment</b></p>							
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">	moody; emotional lows</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">has guilt feelings</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">high standards for self and others</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">likes quality things</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">somewhat friendly after warm-up</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may resist until reasons for change are explained and accepted</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">strong sense of justice</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">operates from a list</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">	picky, conscientious, apologetic</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">needs pushing to be sociable</b></p>
								
								
								<p style="padding:0px 20px; margin:0px; margin-top:0px;padding-bottom:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:0px; padding-bottom:0px;">Uniqueness</h4>
								</p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">Analysts are more conscientious than the other Melancholy (High C) blends. Analysts tend to be very private and nonsocial.</p>

								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Strengths</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">analytical</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">diplomatic</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">accommodating</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">	organized; plans ahead</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">attention to detail</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">solving technical problems</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">likes to do things "right"</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">creative thinking</b></p>
							</td>
							
							<td style="width:49%; display:inline-block;">

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Weaknesses</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">moodiness</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">unrealistic expectations</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">negative self-talk; they tend to think too much about the wrong thing</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">critical attitude</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">sensitivity</b></p>



								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Fears</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">conflict</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being wrong</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">loss of emotional control</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">disorganization</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">not having a plan</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Response to Pressure</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may become negative, depressed</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may release frustration by withdrawing</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may become suspicious</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may want to quit</b></p>
								
								
								
								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Impact upon Others</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">attention to details</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">establishing procedures</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">doing things right</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">desire for quality</b></p>
								
								

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Traits Needed for Balance</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">positive self-talk</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">friendliness</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">follow through with their plan</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">to express opinions without emotion (learn to be matter-of-fact)</b></p>
								
								
							

								<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
									<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">How to Approach</h4>
								</p>

								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be logical, factual</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give reasons why</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give specific answers to their questions</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">control your emotions; listen</b></p>
								<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">allow them time alone to think</b></p>
								
								
							</td>
						</tr>
					</table>
				</td>
			</tr>
		<?php } ?>
	</table>
</div>
<!--page4 ends here-->
<!--page5 starts here-->
<div class="" style="float:left;width:1000px;padding-left:0px;margin-left:0px;">
	<table style="width: 100% margin-left:38px;margin-right:40px;">		
		<tr>
			<td style="margin-top:0px;">
				<table style="margin-right:40px;margin-top:0px;width:760px;">
				<?php if($Top_one == "D" && $Top_two == "I"){ ?>
					<tr>
						<td style="width:49%;float:left;">
							<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Do's</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be brief, direct and to the point</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">ask "what" questions instead of "how"</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">speed up your responses</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">if they interrupt you, ask permission to continue (be matter-of-fact)</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be confident</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be practical</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">help them save time</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">when in agreement, agree with the facts, not the individual</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">focus on goals, objectives and ideas</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be prepared for aggressive responses, even explosive behavior</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">when presenting a new idea, be organized</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give alternatives, state your preference, then ask for their opinion</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be prepared to give them an occasional shock</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be prepared for them to force their ideas; listen patiently, do not react</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">discuss how to get better and faster results</b></p>

							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Don'ts</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not waste their time</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not show a lack of confidence</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not be wordy</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not withdraw when they get assertive</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not allow them to take over the session</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not criticize them personally</b></p>
							
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:0px; padding-bottom:0px;">Driven by an Active Will</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">The Executive has a strong determination to accomplish personal goals.</p>

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">Typical Responses</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">The Executive is usually brief, direct, and to the point (do not be intimidated or offended).</p>
						</td>
							
						<td style="width:50%; display:inline-block;">
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt; margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Key Words to Use</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">bottom line</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">save time</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">results</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">productive</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">goals</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">effective</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">quick</b></p>
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Keys to Relating</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">show confidence</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">remove the risk of being taken advantage of</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be brief, direct and to the point</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">stress saving time</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be result-oriented</b></p>
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Environment Needed</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">difficult assignments</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">challenges</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">activity</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">freedom from details</b></p>
							
							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Response Needed from Others</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be brief, direct and to the point</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">encouragement to be sensitive to others</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">direct answers</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">result-oriented</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">understanding of their assertive style</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">an occasional shock</b></p>
							
							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Characteristics to Compliment</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being inspirational</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being self-motivated</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being decisive</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being confident</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being result-oriented</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being a practical problem solver</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being straightforward</b></p>
							
						</td>
					</tr>
				<?php }else if($Top_one == "D" && $Top_two == "S"){ ?>
					<tr>
						<td style="width:49%;float:left;">
							<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Do's</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be very direct, brief and to the point</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">when in agreement, agree with the facts and ideas more than with the individual</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be practical, help them save time</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">keep the discussion focused on the task, not the relationship</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">if they interrupt you, ask permission to continue</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be prepared for a lack of emotion</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">ask for their opinion</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be confident and matter-of-fact</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may need an occasional shock</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be result-oriented</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">when presenting a new idea, be organized, give alternatives, then state your preference</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">focus on goals and objectives</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">discuss how to get better, faster results</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">ask "what" questions instead of "how"</b></p>

							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Don'ts</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not waste their time</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not show a lack of confidence</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not be wordy</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not withdraw when they get assertive</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not criticize them personally</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not show much emotion</b></p>
							
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:0px; padding-bottom:0px;">Driven by an Active Will</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">Directors have a strong, stubborn will to accomplish goals.</p>


							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Typical Responses</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">brief, direct and to the point (do not be offended)</b></p>
						</td>
						
						<td style="width:50%; display:inline-block;">


							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt; margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Key Words to Use</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">save time</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">results</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">productive</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">goals</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">effective</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">quick</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">practical</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">bottom line</b></p>
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Keys to Relating</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">show confidence</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">remove the risk of being taken advantage of</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">stress saving time</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be brief, direct and to the point</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be result-oriented</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be bottom-line oriented</b></p>
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Environment Needed</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">difficult assignments</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">challenge</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">activity</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">freedom from details</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">independence</b></p>
							
							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Response Needed from Others</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be brief, direct and to the point</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give direct answers</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be result-oriented</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">tolerate their lack of emotion</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give an occasional shock</b></p>
							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Characteristics to Compliment</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being straightforward</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being a practical problem solver</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being determine</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being confident</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being stable</b></p>
							
						</td>
					</tr>
				<?php }else if($Top_one == "D" && $Top_two == "C"){ ?>
					<tr>
						<td style="width:49%;float:left;">
							<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Do's</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be brief, direct and to the point</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">ask "what" questions instead of "how"</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">speed up your responses</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">when in agreement, agree with the facts and ideas, not the individual</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give reasons why</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">discuss how to get better, faster results</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be prepared for many questions -- they can be very abrupt</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">if they interrupt you, ask permission to continue</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be confident</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be practical, help them save time</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">focus on goals and objectives</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give an occasional shock when they are being negative or feeling low</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">help them see that they are thinking too much about the wrong thing -- suggest a more appropriate way of thinking</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">when presenting a new idea, be organized, give reasons, alternatives, state your preference, then ask for their opinion</b></p>

							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Don'ts</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not waste their time or be wordy</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not show a lack of confidence</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not allow them to take over</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not withdraw when they get assertive</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not criticize them personally</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">respond by listening and give facts</b></p>
							
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:0px; padding-bottom:0px;">Driven by an Active Will</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">Strategists have a very strong, determined will to accomplish goals.</p>


							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Typical Responses</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">brief, direct, and to the point (do not be offended)</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">shows confidence</b></p>
						</td>
						
						<td style="width:50%; display:inline-block;">


							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt; margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Key Words to Use</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">bottom line</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">results</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">goals</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">effective</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">quick</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">practical</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">detail</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">plan</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">save time</b></p>
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Keys to Relating</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">show confidence</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">remove risk of being taken advantage of</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">stress saving time</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be brief, direct and to the point</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be result-oriented</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">have a plan</b></p>
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Environment Needed</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">difficult assignments</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">detailed assignments</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">challenges</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">activity</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">independence</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">opportunity to be in charge</b></p>
							
							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Response Needed from Others</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be brief, direct and to the point</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give direct answers</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be result-oriented</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">tolerate their forceful communication</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give an occasional shock</b></p>

							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Characteristics to Compliment</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being direct</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being decisive</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being a creative problem solver</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being confident</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being practical</b></p>
							
						</td>
					</tr>
				<?php }else if($Top_one == "I" && $Top_two == "D"){ ?>
					<tr>
						<td style="width:49%;float:left;">
							<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Do's</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be warm, personable, friendly, open and flexible</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">recognize their efforts</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give them deadlines and have a plan to follow up</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">build a relationship</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be lighthearted</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">ask questions to keep them focused on the main issue: they tend to drift off the subject</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give approval; they trust others easily</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be willing to listen; they need to talk, especially when under pressure</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give facts and logical explanations</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be excited when presenting a new idea</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">have them write down goals, objectives</b></p>

							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Don'ts</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">never embarrass them; they may become aggressive</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not ask them to sit for long periods of time</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not give them too many details</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">never cause them to lose social acceptance</b></p>
							
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:0px; padding-bottom:0px;">Driven by Emotion</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">Negotiators get excited easily and can be very expressive and animated.</p>


							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Typical Responses</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">talkative</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">accepting</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">impulsive</b></p>


						</td>
						
						<td style="width:50%; display:inline-block;">

							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt; margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Key Words to Use</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">exciting</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">latest</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">status</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">fun</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">team</b></p>
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Keys to Relating</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not talk just about supervising issues</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">remove the risk of looking bad</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">show excitement</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">show how they can have fun</b></p>
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Environment Needed</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">open atmosphere</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">opportunity to build relationships</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">recognition</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">freedom from details</b></p>
							
							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Response Needed from Others</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">friendliness (they want to be accepted)</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">to be given the big picture</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">encouragement to follow through</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">acceptance (do not embarrass them)</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">tolerate playful nature</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">help to become organized</b></p>
							
							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Characteristics to Compliment</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being persuasive</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being enthusiastic</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being sociable</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being friendly</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being open</b></p>

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:0px; padding-bottom:0px;">Note</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;text-align:left;">The Sanguine (High I) tends to promise that they will do what you suggest in order to look good but may not follow through. After you have built a relationship, it is appropriate to point this out.</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:5px;margin-bottom:0px; padding:0px 20px;">Sometimes it is best to give them only one thing to do before the next session. Encourage them to write it down to help them remember.</p>
							
						</td>
					</tr>
				<?php }else if($Top_one == "I" && $Top_two == "S"){ ?>
					<tr>
						<td style="width:49%;float:left;">
							<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Do's</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be warm, personable, friendly and open</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">ask questions to keep them focused on the main issue; they tend to be spontaneous and may skip to other issues</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">build a relationship if possible; they need more than a casual friendship</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">recognize their efforts</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be prepared to listen (after they warm up)</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give approval, they trust others easily</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give them deadlines</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">have a plan to follow up</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">help them learn to confront others</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">help them become more organized</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">when presenting a new idea, be excited, provide them with facts, research, and logic (put in writing if possible)</b></p>

							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Don'ts</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">never embarrass them; they may withdraw</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">never cause them to lose social acceptance</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not give them many details</b></p>

							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:0px; padding-bottom:0px;">Driven by Emotion</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">Relaters are naturally excitable, open, assertive and expressive. Relaters are driven to maintain relationships.</p>


							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Typical Responses</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">talkative</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">warm</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">accepting</b></p>


						</td>
						
						<td style="width:50%; display:inline-block;">

							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt; margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Key Words to Use</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">relationship</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">friendship</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">exciting</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">fun</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">loyal</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">routine</b></p>
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Keys to Relating</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">show excitement</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">demonstrate warm friendliness</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">remove the risk of looking bad</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">show how they can have fun</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">stress importance of relationships</b></p>
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Environment Needed</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">open atmosphere</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">opportunity to build relationships</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">freedom from details</b></p>
							
							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Response Needed from Others</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be warm and friendly</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give the big picture</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">encourage follow through</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">to not embarrass them</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">tolerate playful nature</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">help to become organized</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">help to confront others</b></p>
							
							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Characteristics to Compliment</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">accepting of others</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being friendly</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being empathic</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being compassionate</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being understanding</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being relationship oriented</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being patient with people</b></p>


							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:0px; padding-bottom:0px;">Note</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;text-align:left;">The Sanguine (High I) tends to promise that they will do what you suggest in order to look good but may not follow through. After you have built a relationship, it is appropriate to point this out.</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:5px;margin-bottom:0px; padding:0px 20px;">Sometimes it is best to give them only one thing to do before the next session. Encourage them to write it down to help them remember.</p>
							
						</td>
					</tr>
				<?php }else if($Top_one == "I" && $Top_two == "C"){ ?>
					<tr>
						<td style="width:49%;float:left;">
							<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Do's</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be warm, friendly and open</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">show approval; they are driven by a deep need to make a favorable impression</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be prepared to listen to detailed explanations</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give them information, time to think and help to develop a plan</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">help them become more consistently organized</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">they may get too involved with details; help them to be practical</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give them deadlines and have a plan to follow up</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">recognize accomplishments</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">ask questions to keep them focused on the main issue; they may skip to other issues</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be prepared for frequent mood swings</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">when they are being negative or feeling low help them see that they are thinking too much about the wrong  thing; suggest a more appropriate way of thinking</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">when presenting a new idea, be excited, factual, provide them with facts, research, logic, reasons why and time to think (put in writing if possible)</b></p>
							

							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Don'ts</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">never embarrass them; may become very aggressive (explosive) or withdraw</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">never cause them to lose social acceptance</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not be general when giving information</b></p>

							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:0px; padding-bottom:0px;">Driven by the Mind and Emotion</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">Performers are driven by logic, emotion, and a deep need to make a favorable impression. They have an active imagination and will often react with extreme emotion.</p>


							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Typical Responses</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">talkative (usually after warmup)</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">cautious</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">moody</b></p>


						</td>
						
						<td style="width:50%; display:inline-block;">

							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt; margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Key Words to Use</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">proud</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">latest</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">fun</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">plan</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">exciting</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">status</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">prestigious</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">think</b></p>
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Keys to Relating</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">show excitement</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be formal until they relax</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">remove the risk of looking bad</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">show how they can have fun</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be logical and factual</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">stress logic and ideas</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">stress the need for a plan</b></p>
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Environment Needed</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">acceptance</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">opportunity to build relationships</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">public recognition</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">a variety of activities</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">opportunity to be creative</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">alone time</b></p>
							
							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Response Needed from Others</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">to not embarrass them</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">to be warm and friendly</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">to give the big picture</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">encouragement to follow through</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">tolerate playful nature</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">help to become organized</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">help to confront others</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">help to control their emotions</b></p>
							
							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Characteristics to Compliment</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">persuading with emotions and facts</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">having a high drive to win</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">creative thinking</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">doing things "right"</b></p>

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:0px; padding-bottom:0px;">Note</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">The Sanguine (High I) tends to promise that they will do what you suggest in order to look good but may not follow through. After you have built a relationship, it is appropriate to point this out.</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:10px;margin-bottom:0px; padding:0px 20px;">Sometimes it is best to give them only one thing to do before the next session. Encourage them to write it down to help them remember.</p>
							
						</td>
					</tr>
				<?php }else if($Top_one == "S" && $Top_two == "D"){ ?>
					<tr>
						<td style="width:49%;float:left;">
							<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Do's</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be warm and personal</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">provide slight and consistent pressure</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give clear, firm instructions</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">when presenting a new idea, be specific, use visual aids and avoid asking for sudden change (if possible)</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be prepared to repeat instructions</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be very persistent; they take an either/or approach to life</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">tell them you "sincerely" appreciate their efforts</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">ask questions; will likely not ask you questions</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give them time to adjust to new plans or change; prepare them well in advance</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">expect resistance to change</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">show interest in their family</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">slow down your responses</b></p>
							

							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Don'ts</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not suddenly change anything</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not compete with them</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not expect them to get excited, be friendly, or be open about their feelings</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not ask them to do more than one thing at a time</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not show excessive emotion</b></p>

							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:0px; padding-bottom:0px;">Driven by a Passive Will</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">Inspectors have a strong determination to stubbornly resist change and follow their own routine.</p>

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Typical Responses</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">cordial</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">laid-back</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">unemotional (will have stoic or flat affect)</b></p>


						</td>
						
						<td style="width:50%; display:inline-block;">

							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt; margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Key Words to Use</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">support</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">traditional</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">realistic</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">care</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">family</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">practical</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">results</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">“I sincerely appreciate..."</b></p>
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Keys to Relating</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">show personal interest</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be warm and practical, push gently</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be persistent</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be concrete when explaining concepts</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">use visual aids</b></p>
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Environment Needed</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">clear plan to follow</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">instructions on when to start/stop</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">time to change routine</b></p>

							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Response Needed from Others</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give clear directions</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give specific answers</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give time for them to figure it out</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">help them show more affection</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">help them become more sociable</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">tolerate their lack of emotion</b></p>
							
							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Characteristics to Compliment</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">determined</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">dependable</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">patient</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">practical</b></p>
							
						</td>
					</tr>
				<?php }else if($Top_one == "S" && $Top_two == "I"){ ?>
					<tr>
						<td style="width:49%;float:left;">
							<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Do's</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be warm and friendly</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be nonthreatening; slow down your responses</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">show interest in their family</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give clear, firm directions (when to start, stop)</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">provide slight and consistent pressure</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be prepared to repeat instructions</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">tell them you sincerely appreciate their efforts</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">ask specific questions</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give explanations in concrete terms and use visual aids</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">expect resistance to change</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give them time to adjust to new plans</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">avoid asking for sudden change</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">prepare them well in advance for change</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">use facts and logic in your proposals</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">expect them to ask permission to proceed</b></p>
							

							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Don'ts</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">never hurry a conversation</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not suddenly change anything</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not expect them to pressure others</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not expect them to make quick decisions or confront others</b></p>
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:0px; padding-bottom:0px;">Driven by a Passive Will</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">Harmonizers have a strong determination to stubbornly resist change and follow their own routine.</p>

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Typical Responses</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">cordial</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">laid-back</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">talkative</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">nice, pleasant</b></p>


						</td>
						
						<td style="width:50%; display:inline-block;">

							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt; margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Key Words to Use</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">support</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">traditional</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">realistic</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">care</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">family</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">practical</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">relationship</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">I "sincerely appreciate..."</b></p>
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Keys to Relating</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">show personal interest</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be warm and practical, push gently</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be persistent</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be concrete when explaining concepts</b></p>
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Environment Needed</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">concrete, clear plan to follow</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">some activity and play time</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">instructions on when to start/stop</b></p>

							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Response Needed from Others</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">offer encouragement to say no</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give clear directions</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give specific answers</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give freedom for them to figure it out</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">offer sincere appreciation</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">help to become more direct, assertive</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">tolerate their need to rest</b></p>
							
							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Characteristics to Compliment</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">accommodating</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">accepting</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">predictable</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">patient</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">dependable</b></p>
							
						</td>
					</tr>
				<?php }else if($Top_one == "S" && $Top_two == "C"){ ?>
					<tr>
						<td style="width:49%;float:left;">
							<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Do's</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be warm, low-key and persistent</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">tell them you "sincerely" appreciate their efforts </b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be non-threatening; slow down your responses</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">show interest in their family</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give clear directions (when to start/stop)</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">provide slight and consistent pressure</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be prepared to repeat instructions</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">provide a routine</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">ask specific questions</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">allow time to figure out the task at own pace</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give explanations in concrete terms</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be specific, when presenting a new idea</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">expect resistance to change</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be willing to repeat instructions, use visual aids</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give them time to adjust to new plans or change; prepare them well in advance and allow time to adjust</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">avoid asking for sudden change</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">use facts and logic in conversation</b></p>

							

							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Don'ts</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">never hurry a conversation</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not suddenly change anything</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not expect them to get excited or be very friendly</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not ask them to do more than one thing at a time</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not show excessive emotion</b></p>
							
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:0px; padding-bottom:0px;">Driven by a Passive Will</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">Helpers have a strong determination to stubbornly resist change and follow their own routine.</p>

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Typical Responses</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">cordial</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">laid-back</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">non-emotional</b></p>


						</td>
						
						<td style="width:50%; display:inline-block;">

							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt; margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Key Words to Use</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">support</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">traditional</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">realistic</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">care</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">family</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">practical</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">relationship</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">“I sincerely appreciate..."</b></p>
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Keys to Relating</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">show personal interest</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">remove risk of conflict</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be warm, practical and push gently</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be persistent</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be concrete when explaining concepts</b></p>
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Environment Needed</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">concrete, clear plan to follow</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">opportunity to accommodate others</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">instructions on when to start/stop</b></p>
							
							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Response Needed from Others</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">encouragement to say "no"</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">clear directions</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">specific answers</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">freedom to figure it out</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">help to become more direct, assertive</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">tolerate their need to rest</b></p>
							
							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Characteristics to Compliment</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being accommodating</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being predictable</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being loyal</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being patient</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being calm</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being dependable</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being stable</b></p>
							
						</td>
					</tr>
				<?php }else if($Top_one == "C" && $Top_two == "D"){ ?>
					<tr>
						<td style="width:49%;float:left;">
							<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Do's</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be very specific, factual, and logical</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">explain the big picture</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">when they are being negative or feeling low, help them see that they have thought too much about the wrong thing; suggest a more appropriate way of thinking</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">allow opportunity to ask questions</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give personal attention to their projects</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">expect adherence to high standards</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give them detailed assignments</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">help them get through the details</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">when presenting a new idea, have controlled emotions, use logic, facts & visual aids; allow time to think about the proposal and expect resistance until they see that it can be done</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be considerate and personal</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be concerned about doing things right</b></p>

							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Don'ts</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not speak in general terms when giving instructions</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not expect high flexibility</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not rush them to complete an assignment</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not expect much social involvement</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not treat their questions as unimportant</b></p>
							
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:0px; padding-bottom:0px;">Driven by Logic</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">Instructors tend to analyze everything and operate on very high personal standards. They have an active imagination.</p>

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Typical Responses</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">logical</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">inquisitive</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">concerned</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">picky</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">detail</b></p>


						</td>
						
						<td style="width:50%; display:inline-block;">

							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt; margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Key Words to Use</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">logical</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">fact</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">precise</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">practical</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">quality</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">detail</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">efficient</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">results</b></p>
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Keys to Relating</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">show concern</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">remove risk of making a bad decision</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be specific and factual</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">stress quality</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give guarantees</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">tolerate their abruptness</b></p>
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Environment Needed</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">opportunity to collect information and plan</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">concrete, clear, and detailed plan to follow</b></p>
							
							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Response Needed from Others</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give specific, detailed directions/answers</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give freedom for them to think about the task, plan, or problem</b></p>
							
							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Characteristics to Compliment</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being analytical</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being a creative problem solver</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">having a sense of justice</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">having high standards</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being organized</b></p>
							
						</td>
					</tr>
				<?php }else if($Top_one == "C" && $Top_two == "I"){ ?>
					<tr>
						<td style="width:49%;float:left;">
							<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Do's</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be friendly, non-aggressive and lighthearted</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be prepared for them to talk when under pressure; be considerate, warm, and personal</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be factual, logical, and specific</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">when they are being negative or feeling low, help them see that they have thought too much about the wrong thing; suggest a more appropriate way of thinking</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">when presenting a new idea, use logic, facts, visual aids and allow time to think it over</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">allow opportunity to ask questions</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">expect resistance until they see it can be done</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">help them get through the detail, make decisions, and follow through</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be concerned about doing things right</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">slow down your responses</b></p>

							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Don'ts</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not speak in general terms</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not treat their questions as unimportant when giving information</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not cause embarrassment</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not expect them to pressure others</b></p>
							
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:0px; padding-bottom:0px;">Driven by the Mind and Emotion</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">Diplomats are driven by logic and emotion. They tend to analyze everything (twice) and operate on very high personal standards. They have an active imagination. At times they will reason emotionally. They can be very sensitive.</p>

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Typical Responses</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">logical</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">inquisitive</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">concerned</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">friendly</b></p>
						</td>
						
						<td style="width:50%; display:inline-block;">


							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt; margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Key Words to Use</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">logical</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">fact</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">precise</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">practical</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">quality</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">detail</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">efficient</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">fun</b></p>
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Keys to Relating</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be friendly, smile and have fun</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">remove risk of making a bad decision</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be specific and factual</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">stress quality</b></p>
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Environment Needed</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">opportunity to collect information and plan</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">opportunity to do detailed work</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">some social contact</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">some flexibility</b></p>
							
							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Response Needed from Others</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give specific, detailed answers</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">allow them time to think about the plan or problem</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be lighthearted</b></p>
							
							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Characteristics to Compliment</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being analytical</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being conscientious</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being diplomatic</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being friendly</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being a creative thinker</b></p>
							
						</td>
					</tr>
				<?php }else if($Top_one == "C" && $Top_two == "S"){ ?>
					<tr>
						<td style="width:49%;float:left;">
							<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Do's</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be warm, personal, factual, and logical</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">listen carefully to their detailed explanations</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">when they are being negative or feeling low, help them see that they have thought too much about the wrong thing; suggest a more appropriate way of thinking</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be concerned about doing things right</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">allow opportunity to ask questions</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be specific when giving information</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may need help to get through details</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">when presenting a new idea, use logic, facts and visual aids; allow time alone to think and expect resistance until they see that it can be done</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">slow down your responses</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be non-assertive</b></p>

							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Don'ts</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not speak in general terms</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not expect high flexibility</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not expect much social involvement</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not expect them to pressure others</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not treat their questions as unimportant</b></p>
							
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:0px; padding-bottom:0px;">Driven by the Mind</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 20px;">Analysts are driven by logic. They tend to analyze everything (twice) and operate on very high personal standards. They have an active imagination.</p>

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:10px; margin-bottom:5px; padding-bottom:0px;">Typical Responses</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">logical</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">inquisitive</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">concerned</b></p>
						</td>
						
						<td style="width:50%; display:inline-block;">



							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt; margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Key Words to Use</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">logical</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">fact</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">precise</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">practical</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">quality</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">detail</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">efficient</b></p>
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Keys to Relating</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">show concern</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">remove risk of making a bad decision</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be specific and factual</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">stress quality</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give guarantees</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">avoid conflict, tension</b></p>
							
							
							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Environment Needed</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">opportunity to collect information and plan</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">opportunity to do detailed work</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">some flexibility</b></p>
							
							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Response Needed from Others</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give specific, detailed directions and answers</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give time for them to think about the solution, plan, or problem</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">tolerate their need to analyze</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be light-hearted</b></p>
							
							

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style=" color:#000;font-family: 'proxima_novabold';font-size: 12pt;margin-top:15px; margin-bottom:5px; padding-bottom:0px;">Characteristics to Compliment</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:-9px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being analytical</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being diplomatic</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being organized</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being attentive to detail</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being a creative thinker</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 11pt;line-height: 18px; margin-top:6px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">being a creative problem solver</b></p>
							
						</td>
					</tr>
				<?php } ?>
					
				</table>
			</td>
		</tr>
	</table>
</div>
<!--page5 ends here-->
<!--page6 starts here-->
<div class="" style="float:left;width:1000px;padding-left:0px;margin-left:0px;">
	<table style="width: 100% margin-left:38px;margin-right:40px;">		
		<tr>
			<td style="margin-top:0px;">
				<table style="margin-right:40px;margin-top:0px;width:760px;">
				<?php if($Top_one == "D" && $Top_two == "I"){ ?>
					<tr>
						<td style="width:49%;float:left;">
							<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">How They Respond</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:0px; padding:0px 20px;">Executives respond best to a direct, straightforward supervisor with whom they can talk openly and negotiate. They like options to select from and will usually respond well to a challenge.</p>					

							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt; margin-top:20px; margin-bottom:0px; padding-bottom:0px;">Concerns</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:15px; padding:0px 20px;">Executives may be impatient and irritable when things do not happen fast enough or go their way. They tend to have little time for details (unless they believe it will help them accomplish results quicker). Executives may lose interest in accomplishing a goal once the challenge is gone or results are not coming fast enough.</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may be too abrupt</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may lack sensitivity to others</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may not respect authority</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may have sudden outburst of anger</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may intimidate others</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may act without explaining why</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may operate on, "the end justifies the means"</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may try to change everyone but themselves</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">easily annoyed</b></p>
							
							
						</td>
						
						<td style="width:49%; display:inline-block;">
								
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">Causes of Procrastination</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:0px; padding:0px 20px;">Executives will likely procrastinate because they fail to see how doing the activity will help them accomplish their goals or get results. They also tend to promise too much and forget to follow through.</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px; padding:0px 20px;">Show Executives how the activity will enable them to accomplish goals and get better, faster results.</p>


							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:20px; margin-bottom:0px; padding-bottom:0px;">Things to Remember when Confronting</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be firm, direct and to the point</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">demonstrate strength</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">take issue with their behavior, not them personally</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">show them how different behavior will get better, faster results</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Executives may demonstrate a "sudden burst of anger" when opposed. This will usually pass after a few minutes, and it is usually not meant personally</b></p>							
						</td>
					</tr>
				<?php }else if($Top_one == "D" && $Top_two == "S"){ ?>
					<tr>
						<td style="width:49%;float:left;">
							<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">How They Respond</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:0px; padding:0px 20px;">Directors respond best to a direct, straightforward supervisor with whom they can talk openly and negotiate. Directors like options to select from and they usually respond well to a challenge.</p>					

							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt; margin-top:20px; margin-bottom:0px; padding-bottom:0px;">Concerns</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:15px; padding:0px 20px;">Directors may be impatient and irritable when things do not happen fast enough. They have little time for details or people (unless they believe the details or people will then accomplish results quicker). Directors can be cold, blunt and abrupt. They tend to overstep prerogatives.</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">They will often resist being a "team player." Directors may lose interest in accomplishing a goal once the challenge is gone or results are not coming fast enough</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may be too independent</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may be impersonal</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may not respect authority</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may have sudden outburst of anger</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may act without explaining why</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may operate on "the end justifies the means"</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may be too blunt</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may be extremely stubborn</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">easily annoyed</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may have difficulty showing empathy</b></p>
							
							
						</td>
						
						<td style="width:49%; display:inline-block;">
								
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">Causes of Procrastination</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:0px; padding:0px 20px;">Directors will likely procrastinate because they fail to see how doing the activity will help them accomplish goals. Sometimes they procrastinate for no reason. </p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px; padding:0px 20px;">Show Directors how the activity will enable them to accomplish goals and get better, faster results.</p>


							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:20px; margin-bottom:0px; padding-bottom:0px;">Things to Remember when Confronting</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be direct, to the point and matter-of-fact</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">demonstrate strength</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give them the "big picture," stress facts</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">take issue with their behavior, not them personally</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">show how different behavior will get better, faster results</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Directors may demonstrate a "sudden burst of anger" when opposed. This will usually pass quickly, and it is usually not meant personally</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be concrete when explaining concepts</b></p>
							
						</td>
					</tr>
				<?php }else if($Top_one == "D" && $Top_two == "C"){ ?>
					<tr>
						<td style="width:49%;float:left;">
							<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">How They Respond</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:0px; padding:0px 20px;">Strategists respond best to a direct, straightforward supervisor with whom they can talk openly and negotiate. Strategists like options to select from and they will usually respond well to a challenge. Be direct and bottom-line oriented.</p>					

							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt; margin-top:20px; margin-bottom:0px; padding-bottom:0px;">Concerns</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:15px; padding:0px 20px;">Strategists may be impatient and irritable when they cannot accomplish a goal quickly.</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:15px; padding:0px 20px;">They may take excessive time to make a decision and be very forceful carrying out the conclusion. They can be very critical at times. The Strategist's aggressive behavior often causes others to withdraw.</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:15px; padding:0px 20px;"><?=$the_report_pattern?> may lose interest in accomplishing a goal once the challenge is gone or results are not coming fast enough.</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may be too independent</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">crisis way of communicating</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may not respect authority</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may be too critical and blunt</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may act without explaining why</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may operate on, "the end justifies the means"</b></p>
						</td>
						
						<td style="width:49%; display:inline-block;">
								
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">Causes of Procrastination</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:0px; padding:0px 20px;">Strategists will likely procrastinate because they fail to see how doing the activity will help them accomplish their goals. They may also fail to see the reason why it should be done.</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px; padding:0px 20px;">Frustration occurs (therefore, procrastination) when the secondary need to do things right (to think) interferes with the primary need for results.</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px; padding:0px 20px;">Show Strategists how the activity will enable them to accomplish goals and get better, faster results.</p>


							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:20px; margin-bottom:0px; padding-bottom:0px;">Things to Remember when Confronting</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be direct, to the point, factual and logical</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be prepared to reason assertively</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">take issue with their behavior, not them personally</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give reasons why they need to change their behavior</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">show how different behavior will get better, faster results</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">Strategists may demonstrate a "sudden burst of anger" when opposed. This will usually pass after a few minutes, and it is usually not meant personally</b></p>
							
						</td>
					</tr>
				<?php }else if($Top_one == "I" && $Top_two == "D"){ ?>
					<tr>
						<td style="width:49%;float:left;">
							<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">How They Respond</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:0px; padding:0px 20px;">Negotiators respond best to a friendly supervisor who is personable. Negotiators like information but not too many details.</p>					

							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt; margin-top:20px; margin-bottom:0px; padding-bottom:0px;">Concerns</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:15px; padding:0px 20px;">Negotiators tend to be inattentive to the "little things." They may act impulsively without considering the consequences.</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:15px; padding:0px 20px;">Negotiators can be overly enthusiastic and oversell themselves. They tend to oversell their willingness to change behavior. They may be too optimistic. Negotiators tend to overlook obvious personality flaws.</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">difficulty with follow through</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may not take the situation seriously</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">difficulty with details</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">lacks structure and routine</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">wants immediate gratification</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">awareness of time</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may deny reality</b></p>
							
							
						</td>
						
						<td style="width:49%; display:inline-block;">
								
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">Causes of Procrastination</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:0px; padding:0px 20px;">Negotiators will likely procrastinate because they do not remember what they promised to do. (They do mean well.) They often take on more than they can do.</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px; padding:0px 20px;">Encourage them to write down what needs to be done and review the list during the day.</p>


							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:20px; margin-bottom:0px; padding-bottom:0px;">Things to Remember when Confronting</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be firm, factual, logical and unemotional</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">allow the freedom to express feelings and thoughts</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be prepared for them to deny facts</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">remain very objective</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be prepared for emotional persuasion they may try to forcefully convince you of their view</b></p>

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:20px; margin-bottom:5px; padding-bottom:0px;"><?=$the_report_pattern?> Burnout</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:0px; padding:0px 20px;"><?=$the_report_pattern?> has a tendency to "burn out" frequently. Typical symptoms include three to five weeks of excessive activity expending intense energy followed by one to three days of low energy with little or no activity and the need for rest.</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px; padding:0px 20px;"><?=$the_report_pattern?> uses energy quickly. This causes down time, which allows their body to restore the used energy.</p>

							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:20px; margin-bottom:0px; padding-bottom:0px;">How to Control Burnout</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">reduce intensity level</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">take 5-minute pauses during the day</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">become more organized</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">establish a schedule/routine</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">have a variety of activities</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">practice relaxation techniques daily</b></p>
							
						</td>
					</tr>
				<?php }else if($Top_one == "I" && $Top_two == "S"){ ?>
					<tr>
						<td style="width:49%;float:left;">
							<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">How They Respond</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:0px; padding:0px 20px;">Relaters respond well to a friendly supervisor who is personable. Relaters like to form lasting relationships.</p>					

							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt; margin-top:20px; margin-bottom:0px; padding-bottom:0px;">Concerns</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:15px; padding:0px 20px;">Relaters tend to be inattentive to the "little things." They may act impulsively without considering the consequences. They can be overly enthusiastic and over sell their ideas. They tend to have great difficulty confronting others. They may be too optimistic regarding the potential of others. They may overlook obvious flaws in themselves and others.</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">awareness of time</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may deny reality</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may play too much</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">disorganization</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may allow optimism to affect decisions</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">wants immediate gratification</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">has difficulty with details</b></p>
							
							
						</td>
						
						<td style="width:49%; display:inline-block;">
								
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">Causes of Procrastination</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:0px; padding:0px 20px;">Relaters will likely procrastinate when it becomes necessary to confront or put pressure on someone. They may also procrastinate when they are not able to accommodate all concerned, or they have to change their routine.</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px; padding:0px 20px;">Help the Relater see why it is sometimes necessary to confront others. It may be the loving thing to do. Encourage them to write down what needs to be done and review the list during the day.</p>


							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:20px; margin-bottom:0px; padding-bottom:0px;">Things to Remember when Confronting</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be firm, factual, logical and unemotional</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be warm, gentle and friendly</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">allow the Relater the freedom to express their feelings and thoughts</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be prepared for them to deny the facts</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">remain very objective</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be prepared for emotional persuasion; they may try to gently convince you of their view</b></p>
							
						</td>
					</tr>
				<?php }else if($Top_one == "I" && $Top_two == "C"){ ?>
					<tr>
						<td style="width:49%;float:left;">
							<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">How They Respond</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:0px; padding:0px 20px;">Performers respond best to a friendly supervisor who will be personable and accepting.</p>

							

							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt; margin-top:20px; margin-bottom:0px; padding-bottom:0px;">Concerns</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:15px; padding:0px 20px;">Performers are very sensitive to personal criticism. Under pressure they have a tendency to be cautious, tentative and indecisive and demonstrate extreme emotion. Mood swings may occur frequently. They can be caustic and demeaning toward others.</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be prepared for frequent mood swings</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may not follow through with sessions if embarrassed</b></p>
							
							
						</td>
						
						<td style="width:49%; display:inline-block;">
								
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">Causes of Procrastination</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:0px; padding:0px 20px;">Performers will likely procrastinate if they think they may not make a favorable impression, or the risk of failure is great. They may also forget what they promised to do (they do mean well).</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px; padding:0px 20px;">Show them how to handle failure when it occurs and to not to take it personally. Encourage them to write down what needs to be done and review the list during the day.</p>


							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:20px; margin-bottom:0px; padding-bottom:0px;">Things to Remember when Confronting</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">do not embarrass them, be factual, unemotional, and logical</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">they can become very aggressive when criticized</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">reason with them with facts</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">allow them the freedom to express their feelings and ideas</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be prepared for them to deny the facts</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">remain very objective</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">listen carefully to their detailed explanations</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be prepared for emotional persuasion; they may try to convince you of their view with strong emotion</b></p>
							
						</td>
					</tr>
				<?php }else if($Top_one == "S" && $Top_two == "D"){ ?>
					<tr>
						<td style="width:49%;float:left;">
							<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">How They Respond</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:0px; padding:0px 20px;">Inspectors respond best to a relaxed, calm supervisor who shows interest in them personally.</p>

							

							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt; margin-top:20px; margin-bottom:0px; padding-bottom:0px;">Concerns</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:15px; padding:0px 20px;">Inspectors can be very stubborn and opinionated. They may require some pressure to get them to follow instructions or change their approach. Inspectors can be coldly blunt and tactless with people. They may conceal their grievances and be a grudge-holder.</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">stubbornness</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">lack of a sense of urgency</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">either/or thinking</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">resistance to change</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">willingness to confront</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">excessive worry</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">passive aggressiveness</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">possessiveness</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">passiveness</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">aloofness</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">bluntness</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">lack of motivation</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">lack of emotional expression</b></p>
							
							
						</td>
						
						<td style="width:49%; display:inline-block;">
								
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">Causes of Procrastination</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:0px; padding:0px 20px;">Inspectors will likely procrastinate because the activity does not fit their routine, and they do not want to change. Sometimes the Inspector procrastinates because they are not sure how to accommodate everyone involved (trying to avoid conflict).</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px; padding:0px 20px;">Apply slight, but consistent pressure encouraging them to take action. Help them to see it is okay to act although not everyone will be accommodated.</p>


							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:20px; margin-bottom:0px; padding-bottom:0px;">Things to Remember when Confronting</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">have low-key conversation</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be firm, matter-of-fact</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be very specific</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">use concrete illustrations, visual aids</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">apply slight but constant pressure to bring about change</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">allow time to adjust to change</b></p>
							
						</td>
					</tr>
				<?php }else if($Top_one == "S" && $Top_two == "I"){ ?>
					<tr>
						<td style="width:49%;float:left;">
							<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">How They Respond</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:0px; padding:0px 20px;">Harmonizers respond best to a relaxed, calm supervisor who shows interest in them personally. They want to be your friend.</p>

							

							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt; margin-top:20px; margin-bottom:0px; padding-bottom:0px;">Concerns</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:15px; padding:0px 20px;">Harmonizers are very concerned about pleasing others. They can be very stubborn so they may require some pressure to get them to follow instructions or change their behavior. They tend to be too nice when dealing with others and may not confront. They may conceal their grievances and be a grudge-holder.</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">stubbornness</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">lack of a sense of urgency</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">too accommodating</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">resistance to change</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">lack of willingness to confront</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">excessive worry</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">passive aggressiveness</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">possessiveness</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">jealousy</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">passiveness</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">territorial</b></p>
							
							
						</td>
						
						<td style="width:49%; display:inline-block;">
								
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">Causes of Procrastination</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:0px; padding:0px 20px;">Harmonizers will likely procrastinate because the activity does not fit their routine and they do not want to change. Sometimes they procrastinate because they are not sure how to accommodate everyone involved (trying to avoid conflict).</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px; padding:0px 20px;">Apply slight, but consistent pressure to act. Help them to see it is okay to act although not everyone will be accommodated. Encourage them to take action.</p>


							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:20px; margin-bottom:0px; padding-bottom:0px;">Things to Remember when Confronting</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be warm, friendly and personable</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">have your emotions under control; they are sensitive to assertiveness</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be very specific</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">have low-key conversation</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be firm, matter-of-fact</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">use illustrations and concrete, visual aids</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">apply slight but constant pressure to bring about change</b></p>
							
						</td>
					</tr>
				<?php }else if($Top_one == "S" && $Top_two == "C"){ ?>
					<tr>
						<td style="width:49%;float:left;">
							<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">How They Respond</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:0px; padding:0px 20px;">Helpers respond best to a relaxed, calm supervisor who shows interest in them personally. They want to be your  friend.</p>

							

							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt; margin-top:20px; margin-bottom:0px; padding-bottom:0px;">Concerns</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:15px; padding:0px 20px;">Helpers are very concerned about pleasing others. They can be very stubborn so they may require some pressure to get them to follow instructions or change their approach. Helpers may conceal their grievances and be a grudge-holder.</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">stubbornness</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">lack of a sense of urgency</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">can be negative; help them see that they have thought too much about the wrong thing; suggest a more appropriate way of thinking</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">passiveness</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">lack of willingness to confront</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">passive aggressiveness</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">resistance to change</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">too accommodating</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">excessive worry</b></p>
							
							
						</td>
						
						<td style="width:49%; display:inline-block;">
								
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">Causes of Procrastination</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:0px; padding:0px 20px;">Helpers will likely procrastinate because the activity does not fit their routine and they do not want to change. Sometimes they procrastinate because they are not sure how to accommodate everyone involved (trying to avoid conflict).</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px; padding:0px 20px;">Apply slight, but consistent pressure to act. Help them see it is okay to act although not everyone will be accommodated.</p>


							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:20px; margin-bottom:0px; padding-bottom:0px;">Things to Remember when Confronting</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be low-key, warm and personal</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">have low-key conversation</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be firm, matter-of-fact</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be very specific</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">use concrete illustrations; visual aids</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">allow them time to adjust to change</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">apply slight but constant pressure to bring about change</b></p>
							
						</td>
					</tr>
				<?php }else if($Top_one == "C" && $Top_two == "D"){ ?>
					<tr>
						<td style="width:49%;float:left;">
							<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">How They Respond</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:0px; padding:0px 20px;">Instructors respond best to a supervisor that is logical and factual.</p>

							

							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt; margin-top:20px; margin-bottom:0px; padding-bottom:0px;">Concerns</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:15px; padding:0px 20px;">Instructors tend to bog down in details especially when making a decision. They may become overly dependent on their supervisor or established procedures since they hesitate to act without precedent. They may yield their position to avoid conflict or controversy but will fume inside.</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:15px; padding:0px 20px;">Instructors can be insensitive and inflexible with those close to them. They tend to become defensive when pushed to comply or change their behavior and may push back in anger or frustration. They frequently have a critical or abrasive tone in their voice. They become very frustrated when things do not go as planned.</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">frustration may prevent action</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">slow making decisions (indecisive)</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">depression prone</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">resistance to change until it makes sense</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">critical attitude toward others</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">picky</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">may anticipate the negative rather than the positive</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">high standards (sometimes unrealistic)</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">overuses analysis (they think too much)</b></p>
							
							
						</td>
						
						<td style="width:49%; display:inline-block;">
								
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">Causes of Procrastination</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:0px; padding:0px 20px;">Instructors will likely procrastinate because they are not sure of what is the right thing to do.</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px; padding:0px 20px;">Note: Frustration occurs (therefore procrastination) when the secondary need for results interferes with the primary need to think. Instructors usually take lots of time to think through their options.</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px; padding:0px 20px;">Help them reason through the options. Be objective, help them decide on the best approach. Encourage them to take action.</p>


							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:20px; margin-bottom:0px; padding-bottom:0px;">Things to Remember when Confronting</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give reasons why</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be logical</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be factual</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be persistent</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">listen carefully to their explanations</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">allow questions, give specific answers</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">after confrontation, they may withdraw; allow time to be alone to think</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">stress quality, rightness</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be specific and firm</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">use visual aids</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be careful when criticizing their work (they can accept personal criticism easier than criticism concerning their work)</b></p>
							
						</td>
					</tr>
				<?php }else if($Top_one == "C" && $Top_two == "I"){ ?>
					<tr>
						<td style="width:49%;float:left;">
							<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">How They Respond</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:0px; padding:0px 20px;">Diplomats respond best to a supervisor that is gentle, logical, and factual.</p>

							

							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt; margin-top:20px; margin-bottom:0px; padding-bottom:0px;">Concerns</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:15px; padding:0px 20px;">Diplomats tend to bog down in details especially when decisions need to be made. They may become overly dependent on their supervisor or established procedures since they hesitate to act without precedent. They may yield their position to avoid conflict or controversy but hold to what they are thinking. Diplomats tend to become defensive when criticized, threatened, or pushed to complete a task.</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">too sensitive</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">slow when making decisions</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">resists change until it makes sense</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">critical attitude toward others</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">picky</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">anticipates the negative</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">high standards (sometimes unrealistic)</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">overuses analysis</b></p>
							
							
						</td>
						
						<td style="width:49%; display:inline-block;">
								
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">Causes of Procrastination</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:0px; padding:0px 20px;">Diplomats will likely procrastinate because they are not sure of the right thing to do, they do not understand the reason why it needs to be done, they do not accept the reason why it needs to be done, or they may look bad if it does not turn out right.</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px; padding:0px 20px;">Help the Diplomat think through their options. Be objective and help them decide on the best approach. Encourage them to take action.</p>


							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:20px; margin-bottom:0px; padding-bottom:0px;">Things to Remember when Confronting</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give reasons why</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">conversation should be non-threatening</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be careful when criticizing their work (they can accept personal criticism easier than criticism concerning their work)</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">use reason, facts, logic, and persistence</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">listen carefully to their explanations</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">allow for detailed questions, give specific answers</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">after confrontation, they may withdraw; allow time to be alone to think</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">stress quality, rightness</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be specific and firm</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">use visual aids</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be warm and caring; remember, they can be very sensitive</b></p>
							
						</td>
					</tr>
				<?php }else if($Top_one == "C" && $Top_two == "S"){ ?>
					<tr>
						<td style="width:49%;float:left;">
							<p style="padding:0px 20px; margin:0px; margin-top:0px; padding-bottom:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">How They Respond</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:0px; padding:0px 20px;">Analysts respond best to a supervisor that is gentle, logical, and factual.</p>

							

							
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt; margin-top:20px; margin-bottom:0px; padding-bottom:0px;">Concerns</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:15px; padding:0px 20px;">Analysts tend to bog down in details especially when a decision is being made. They may become overly dependent on their supervisor or established procedures since they hesitate to act without precedent. Analysts may yield their position to avoid conflict or controversy. They tend to become defensive when threatened or pushed to complete a task.</p>
							

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:0px; padding:0px 38px; float:left;"><img style="width:4px; margin-right:10px; float:left;padding-top:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">slow when making decisions</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">resists change until it makes sense</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">critical attitude toward others</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">can be picky</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">anticipates the negative</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">negative outlook</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">unrealistic standards</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">overuses analysis</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">withdraws</b></p>
							
							
						</td>
						
						<td style="width:49%; display:inline-block;">
								
							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:10px; margin-bottom:0px; padding-bottom:0px;">Causes of Procrastination</h4>
							</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:-10px;margin-bottom:0px; padding:0px 20px;">Analysts will likely procrastinate because they are not sure of the right or best thing to do.</p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:5px;margin-bottom:0px; padding:0px 20px;">Analysts usually take lots of time to think through their options. Be objective, help them decide on the most effective approach. Encourage them to take action.</p>


							<p style="padding:0px 20px; margin:0px; padding-bottom:0px; margin-top:0px;">
								<h4 style="color:#000;font-family: 'proxima_novabold';font-size: 13pt;margin-top:20px; margin-bottom:0px; padding-bottom:0px;">Things to Remember when Confronting</h4>
							</p>

							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">give reasons why</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">use facts, logic, and persistence</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be careful when criticizing their work (they can accept personal criticism easier than criticism concerning their work)</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">listen carefully to their explanations</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">allow questions, give specific answers</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">after confrontation, they may withdraw; allow them time to be alone</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">stress quality, rightness</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">be specific, firm</b></p>
							<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:8px;margin-bottom:0px; padding:0px 38px;"><img style="width:4px; margin-right:10px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/list-circle.png" /><b style=" margin-top:-6px;">use visual aids</b></p>
							
						</td>
					</tr>
				<?php } ?>
				</table>
			</td>
		</tr>
	</table>
</div>
<!--page6 ends here-->
<!--page7 starts here-->
<div class="" style="float:left;width:1000px;padding-left:0px;margin-left:0px;">
	<table style="width: 100% margin-left:38px;margin-right:40px;">
		<tr>
			<td align="center">
				<h1 class="text-center" style="font-size: 25pt;margin-bottom: 5px; padding-top:30px; line-height:25pt;">WHY PEOPLE WITH THE SAME<br>TEMPERAMENT EXPRESS IT DIFFERENTLY</h1> 
				<img style="width: 500px;" src="<?=MYTEMPERAMENT_PLUGIN_DIR?>/templates/report/images/border-line-02.png"> 
			</td>
		</tr>
		<tr>
			<td align="left" style="padding:0px 15px;"> 
                <h3 style="font-size: 20pt;margin-bottom: 10px; padding-top:5px; line-height:20pt;">Final Note to Managers*</h3>
            </td>
		</tr>
		
			<tr>
				<td align="left">
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:12px;padding:0px 15px">As a manager and leader, we know people who are similar, however, we also recognize that no two people are exactly alike. People have similarities, but also differences. In describing the various temperament combinations (patterns) it is also true that people with the same temperament are alike in many ways, but also different. Understanding the concepts on this page will explain why this is so.</p>

					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px; margin-top:0px;margin-bottom:12px;padding:0px 15px">For example, two people with the same temperament combination of <?=$first_content?>-<?=$sec_content?> (<?=$the_report_pattern?>) can express it very differently even though these two people have the same “Core Needs.” </p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px;margin:0px;margin-bottom:12px;padding:0px 15px">Although there are many variables, the most important ones are <b style="font-family: 'proxima_novabold';">proximity, intensity, the position of the third and fourth temperaments, and self-control (maturity).</b></p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px;margin:0px;margin-bottom:12px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Proximity</b> refers to the innate distance between the primary and secondary temperament. The principle is that the closer the secondary temperament is to the primary temperament, the less you see of the primary temperament tendencies in behavior, and the more tendencies you see of the secondary temperament.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px;margin:0px;margin-bottom:12px;padding:0px 15px">Conversely, the further the secondary temperament is from the primary temperament, the more you see of the primary temperament tendencies in behavior, and the less you see of the secondary temperament.</p>

					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px;margin:0px;margin-bottom:12px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Intensity</b> refers to the strength of presence of a specific temperament, or the extreme to which a temperament combination is expressed. For example, a Choleric can be somewhat direct, direct, or very direct. A Sanguine can be somewhat friendly, friendly, or very friendly. A Phlegmatic can be somewhat routine, routine or very routine and a Melancholy can be somewhat detailed oriented, detailed oriented, or very detailed oriented.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px;margin:0px;margin-bottom:12px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Position</b> refers to the order of the third and fourth temperaments. This alignment may or may not have significant influence on how the primary and secondary temperament combination is expressed in behavior.</p>
					<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px;margin:0px;margin-bottom:12px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Self-Control (maturity)</b> refers to whether or not a person has learned to use their natural strengths and overcome their natural weaknesses.</p>
					
					<?php if($Top_one == "D" && $Top_two == "I"){ ?>
						<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px;margin:0px;margin-bottom:12px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Remember, regardless of their expression, the <?=$report_pattern?> is driven by two temperament needs, a primary need to get results and a secondary need to be accepted socially.</b></p>
					<?php }else if($Top_one == "D" && $Top_two == "S"){ ?>
						<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px;margin:0px;margin-bottom:12px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Remember, regardless of their expression, the <?=$report_pattern?> is driven by two needs, a primary need to get results and a secondary need to accommodate others.</b></p>
					<?php }else if($Top_one == "D" && $Top_two == "C"){ ?>
						<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px;margin:0px;margin-bottom:12px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Remember, regardless of their expression, the <?=$report_pattern?> is driven by two needs, a primary need to get results and a secondary need to do things right.</b></p>
					<?php }else if($Top_one == "I" && $Top_two == "D"){ ?>
						<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px;margin:0px;margin-bottom:12px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Remember, regardless of their expression, the <?=$report_pattern?> has a primary need to be accepted socially, and a secondary need to get results.</b></p>
					<?php }else if($Top_one == "I" && $Top_two == "S"){ ?>
						<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px;margin:0px;margin-bottom:12px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Remember, regardless of their expression, the <?=$report_pattern?> has a primary need to be accepted socially, and a secondary need to accommodate others.</b></p>
					<?php }else if($Top_one == "I" && $Top_two == "C"){ ?>
						<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px;margin:0px;margin-bottom:12px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Remember, regardless of their expression, the <?=$report_pattern?> has a primary need to be socially accepted and a secondary need to do things right.</b></p>
					<?php }else if($Top_one == "S" && $Top_two == "D"){ ?>
						<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px;margin:0px;margin-bottom:12px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Remember, regardless of their expression, the <?=$report_pattern?> is driven by a primary need to be accommodating and a secondary need to get results.</b></p>
					<?php }else if($Top_one == "S" && $Top_two == "I"){ ?>
						<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px;margin:0px;margin-bottom:12px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Remember, regardless of their expression, the <?=$report_pattern?> has a primary need to be accommodating and a secondary need to be accepted socially.</b></p>
					<?php }else if($Top_one == "S" && $Top_two == "C"){ ?>
						<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px;margin:0px;margin-bottom:12px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Remember, regardless of their expression, the <?=$report_pattern?> has a primary need to be accommodating and a secondary need to do things right.</b></p>
					<?php }else if($Top_one == "C" && $Top_two == "D"){ ?>
						<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px;margin:0px;margin-bottom:12px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Remember, regardless of their expression, the <?=$report_pattern?> has a primary need to do things right and a secondary need to get results.</b></p>
					<?php }else if($Top_one == "C" && $Top_two == "I"){ ?>
						<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px;margin:0px;margin-bottom:12px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Remember, regardless of their expression, the <?=$report_pattern?> has a primary need to do things right and a secondary need to be accepted socially.</b></p>
					<?php }else if($Top_one == "C" && $Top_two == "S"){ ?>
						<p style="color: #555655;font-family: 'proxima_novaregular';font-size: 12pt;line-height: 18px;margin:0px;margin-bottom:12px;padding:0px 15px"><b style="font-family: 'proxima_novabold';">Remember, regardless of their expression, the <?=$report_pattern?> has a primary need to do things right and a secondary need to be accommodating.</b></p>
					<?php } ?>
					
					<p style="color: #555655;font-family: 'proxima_novaregularitalic';font-size: 12pt;line-height: 18px;margin:0px; margin-bottom:12px;padding:0px 15px;font-style: italic;">*If you are new to managing and leading a person based on their temperament, refer to the Quick Reference Guide on page 2 of this report.</p>
				</td>
			</tr>
	</table>
</div>
<!--page7 ends here-->
