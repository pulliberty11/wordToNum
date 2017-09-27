<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class wordNumber {
	
	private $ones = array(
		0=>"",1=>"one",2=>"two",3=>"three",4=>"four",5=>"five",6=>"six",7=>"seven",8=>"eight",9=>"nine",
		11=>"eleven",12=>"twelve",13=>"thirteen",14=>"fourteen",15=>"fifteen",16=>"sixteen",17=>"seventeen",
		18=>"eighteen",19=>"nineteen"
	);
	private $tens = array(
		2=>"twenty",3=>"thirty",4=>"forty",5=>"fifty",
		6=>"sixty",7=>"seventy",8=>"eighty",9=>"ninety");
	private $level = array(
		100=>"hundred",1000=>"thousand",1000000=>"million",1000000000=>"billion"
	);
	
	public function numberToWord($number = 0){
		$numLen = strlen($number);
		$splitNum = str_split(strrev($number),3);
		$count = count($splitNum);
		$lvl = [];
		//print_r($splitNum);
		foreach($this->level as $key=>$value){
			//check if level is in hundreds, thousands etc.
			if(((int)$number / $key) >= 1){
				$lvl[] = $value;
			}else{
//break;
			}
//print_r($lvl);

		}
		$output = "";
		for($i = $count-1;$i >= 0;$i--)
		{
			//echo $i." heres I <BR>";
			$toString = strrev($splitNum[$i]);
			if($toString > 0){
				if(strlen($toString) == 3){
					if($toString[0] > 0){
						//echo $this->ones[$toString[0]]." hundred ";
						$output .= $this->ones[$toString[0]]." hundred ";
					}else{
						$output.= $this->ones[$toString[0]];
					}
					if($toString[1] > 1){
						
						if($i == 0){
							$lvl[$i] = " ";
						}
						//echo $this->tens[$toString[1]]." ".$this->ones[$toString[2]]." ".$lvl[$i]." ";
						$output .= $this->tens[$toString[1]]." ".$this->ones[$toString[2]]." ".$lvl[$i]." ";
					}elseif($toString[1] == 0){
						
						if($i == 0){
							$lvl[$i] = " ";
						}
						//echo $this->ones[$toString[2]]." ".$lvl[$i]."";
						$output .= $this->ones[$toString[2]]." ".$lvl[$i]."";
					}else{
						//echo $this->ones[$toString[1].$toString[2]]." ".$lvl[$i]." ";
						$output .= $this->ones[$toString[1].$toString[2]]." ".$lvl[$i]." ";
					}
				}elseif(strlen($toString) == 2){
					if($toString[0] > 1){
						//echo $this->tens[$toString[0]]."-".$this->ones[$toString[1]]." ".$lvl[$i]." ";
						$output .= $this->tens[$toString[0]]."-".$this->ones[$toString[1]]." ".$lvl[$i]." ";
					}else{
						if($toString > 0){
							
						}
						//echo $this->ones[$toString[0].$toString[1]]." ".$lvl[$i]." ";
						$output .= $this->ones[$toString[0].$toString[1]]." ".$lvl[$i]." ";
					}
				}else{
					$output .= $this->ones[$toString[0]]." ".$lvl[$i]." ";
				}
			}
		}
		return $output;
	}
	public function wordToNumber($word = ""){
		$split = explode(" ",$word);
		$output = 0;
		$tmpOutput = 0;
		for($i=0;$i<=count($split)-1;$i++)
		{
			if(array_search($split[$i],$this->ones)){
				$number = array_search($split[$i],$this->ones);
				//echo $split[$i]."-$number<br>";
				$tmpOutput = $tmpOutput + $number;
			}elseif(array_search($split[$i],$this->tens)){
				$number = array_search($split[$i],$this->tens);
				//echo $split[$i]."-$number<br>";				
				$tmpOutput = $tmpOutput + ($number*10);
			}elseif(array_search($split[$i],$this->level)){
				$number = array_search($split[$i],$this->level);
				//echo $split[$i]."-$number<br>";

				if($split[$i] != "hundred"){
					$tmpOutput = $tmpOutput * $number;
					$output += $tmpOutput;
					$tmpOutput = 0;
				}else{
					$tmpOutput = $tmpOutput * $number;
				}
				
			}
			//echo $output."<br>";
			//echo $tmpOutput."<br>";
		}
		$output += $tmpOutput;
		//echo $output;
		//echo "<br>".addComma($output);
		return $output;
	}
	public function addComma($number = 0){
		return number_format($number);
	}
}
