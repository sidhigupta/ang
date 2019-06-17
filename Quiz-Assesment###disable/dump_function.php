<?php
$con = mysqli_connect("localhost","root","p@ssw0rd","quiz_assesment");
   
// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

function echocsv($fields)
{
	$separator = '';
	foreach ($fields as $field) {
		if (preg_match('/\\r|\\n|,|"/', $field)) {
			$field = '"' . str_replace('"', '""', $field) . '"';
		}
		echo $separator . $field;
		$separator = ',';
	}
	echo "\r\n";
}

if(isset($_POST['download'])){
    $from_date = $_POST['from_date'] ;
    $to_date = $_POST['to_date'];

    $query = sprintf("
        SELECT user_name  AS 'Username',
		phone_number AS 'Phone No.',
		designation AS 'Designation',
		location AS 'Location',
		sec1_q1 AS 'What is \'calisthenics\' ?',
		sec1_q2 AS 'When is \'calisthenics\' enters history ?',
		sec1_q3 AS 'What is the origin of \'calisthenics\'?',
		sec1_q4 AS 'You may have heard a friend whimsically sigh and mention that someone \'has the body of a Greek god\'. This expression has travelled through centuries, and the source of this envy and admiration',
		sec1_q5 AS 'Calisthenics first used as a training method',
		sec1_q6 AS 'A multidisciplinary approach to all-round health and strength made gymnastic a better sport than \'calisthenics\'',
		sec1_q7 AS 'Reasons for the survival of calisthenics throughout the ages',
        sec1_q8 AS 'In 1800 century gymnastics was born. It proved \'calisthenics\' wrong and became most popular form of exercise',
        sec1_per AS 'Section 1 Percentage',
        sec2_q1_a1 AS 'Product 1 Link/URL',
		sec2_q1_a2 AS 'Highlight 1',
		sec2_q1_a3 AS 'Tech Spec 1',
		sec2_q1_a4 AS 'Description 1',
        sec2_q2_a1 AS 'Product 2 Link/URL',
        sec2_q2_a2 AS 'Highlight 2',
        sec2_q2_a3 AS 'Tech Spec 2',
        sec2_q2_a4 AS 'Description 2',
        sec2_q3_a1 AS 'Product 3 Link/URL',
        sec2_q3_a2 AS 'Highlight 3',
        sec2_q3_a3 AS 'Tech Spec 3',
        sec2_q3_a4 AS 'Description 3',
        sec3_q1 AS 'Unfortunately, their house _______ while they were at the restaurant celebrating their anniversary  ',
        sec3_q2 AS ' _______ you to change your mind about handing in your notice, we would be happy for you to stay with us.',
        sec3_q3 AS ' I take great exception _______ the implication that I was not telling the truth.',
        sec3_q4 AS 'English grammar is the worst language of any language. No, it is not. German grammar ___________________.',
        sec3_q5 AS 'We are going to party at the Shyam\'s house.  ______________________ house is on 5th Crossing.',
        sec3_q6 AS 'You can use my car ___________ tomorrow.',
        sec3_q7 AS 'What ____________ your favorite food as a child ?',
        sec3_q8 AS '______________________ you like ? I like Grapes and Mangoes.',
        sec3_q9 AS 'I will speak ______________ Suzy when I see her.',
        sec3_q10 AS 'Discrepancy',
        sec3_q11 AS 'Disdain',
        sec3_q12 AS 'Disheveled',
        sec3_q13 AS 'Windy days are characteristic of December.',
        sec3_q14 AS 'Her moods are as flighty as the weather.',
        sec3_q15 AS 'If you were depressed, why didn\'t to talk to ___________?',
        sec3_q16 AS 'Rain or hail ______ predicted for tomorrow',
        sec3_q17 AS 'Your hands and feet _________ nearly half the bones in your body.',
        sec3_q18 AS 'The books and the magazine ________ placed on the table.',
        sec3_q19 AS 'Most of the newspaper _______ wet',
        sec3_q20 AS 'Which is grammatically correct?',
        sec3_q21 AS 'Punctuate the sentence by putting commas in the right places',
        sec3_q22 AS 'I ( learn) __________ Spanish for 10years now.',
        sec3_q23 AS 'But last year I ( not/work) _____________hard enough as I had to travel a lot.',
        sec3_q24 AS 'During the winters, my parents (send) __________ me to Spain.',
        sec3_q25 AS 'It (be) _____ great',
        sec3_q26 AS 'I (love)_______ the whole trip and experience.',
        sec3_q27 AS 'After Spain, I (go) _________ to Greece.',
        sec3_q28 AS 'While I (do) ________the language course , I met a lot of people from around the world',
        sec3_q29 AS 'I (realise) _________ that it is very important to know foreign languages.',
        sec3_q30 AS 'I am (read) __________ Spanish novels these days',
        sec3_per AS 'Section 3 Percentage',
        sec4_q1 AS 'What does IP stand for?',
        sec4_q2 AS 'What does HDMI stand for ?',
        sec4_q3 AS 'What does IPS stand for',
        sec4_q4 AS 'What is RPM?',
        sec4_q5 AS 'What is MBPS ?',
        sec4_q6 AS 'Which is not a type of Heels',
        sec4_q7 AS 'Is Polo a type of neck design?',
        sec4_q8 AS 'Is clutch a type of women\'s Handbag?',
        sec4_per AS 'Section 4 Percentage',
        submit_date AS 'Submit Date'
        FROM tbl_quiz where DATE(submit_date) BETWEEN '$from_date'  AND '$to_date' order by submit_date ASC");

    $result = mysqli_query($con,$query) or die(mysqli_error($con));

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=quiz_assesment.csv');
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        echocsv(array_keys($row));
    }
    while ($row) {
        echocsv($row);
        $row = mysqli_fetch_assoc($result);
    }

}


?>