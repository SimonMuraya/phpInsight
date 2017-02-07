<?php
if (PHP_SAPI != 'cli') {
	echo "<pre>";
}

$strings = array(
	1 => 'Weather today is rubbish',
	2 => 'This cake looks amazing',
	3 => 'His skills are mediocre',
	4 => 'He is very talented',
	5 => 'She is seemingly very agressive',
	6 => 'Marie was enthusiastic about the upcoming trip. Her brother was also passionate about her leaving - he would finally have the house for himself.',
	7 => 'To be or not to be?',
);




require_once __DIR__ . '/../autoload.php';
$sentiment = new \PHPInsight\Sentiment();
foreach ($strings as $string) {

	// calculations:
	if(preg_match("/(than|rather|whether|as much as|whereas|assuming|though|unless|nor)/i", $string)){ //added conjuctions
		$scores = array(
			'pos' => 0.3,
			'neg' => 0.3,
			'neu' => 0.3
		);
		$class = 'neu';
	}else{
		$scores = $sentiment->score($string);
		$class = $sentiment->categorise($string);
	}


	// output:
	echo "String: $string\n";
	echo "Dominant: $class, scores: ";
	print_r($scores);
	echo "\n";
}
