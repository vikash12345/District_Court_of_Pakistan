<?
require 		'scraperwiki.php';
require 		'scraperwiki/simple_html_dom.php';
$BaseLink	=	'http://202.61.43.40:8080/';
	$SiteURL	=	'http://202.61.43.40:8080/index.php?r=site%2Fsearchbyfir&page=0';
	sleep(5);
	$Pagination = 	file_get_html($SiteURL);
	$numberforloop = $Pagination->find("//*[@id='w0']/div/b[2]",0)->plaintext;
	$text = str_replace(',', '', $numberforloop);
	$loop = $text/20;
	
	
	// echo $AllPages = (int)$numberforloop;
	
	
	
	//	Page pagination
	//
	for($PageLoop = 191; $PageLoop < $loop; $PageLoop++){
	$FinalURL  		=  'http://202.61.43.40:8080/index.php?r=site%2Fsearchbyfir&page='.$PageLoop;
		sleep(5);
		$Html		=	file_get_html($FinalURL);
		sleep(5);
		$RowNumb	=	-1;
		echo"$FinalURL\n";
		if ($Html) {
			sleep(5);
			//	Paginate all 'View' buttons
			foreach ($Html->find("//div[@id='w0']/table[contains(@class,'table-striped')]/tbody/tr") as $element) {
				$RowNumb	+=	1;
				if ($RowNumb != 0) {
					sleep(2);
					$CourtName	=	$element->find('./td[2]', 0);
					$CaseNumbr	=	$element->find('./td[3]', 0);
					$CaseStats	=	$element->find('./td[4]', 0);
					$CaseValue	=	$element->find('./td[5]/button', 0);
					$CaseLinkR	=	$BaseLink . $CaseValue->attr['value'];
					$CaseLink	=	str_replace("amp;", "", $CaseLinkR);
					
	 $data = array($CaseLink);
          for($loopo = 0 ; $loopo < sizeof($data); $loopo++)
          {	
		   $URL = $data[$loopo];
		  
					sleep(2);
					//	Visit link inside 'View' button
					$DetailPg	=	file_get_html($URL);
		  			sleep(5);

					if ($DetailPg != null || $DetailPg != "") {
						sleep(2);
						 $CaseNo			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[1]", 0)->plaintext;
						 $instdte			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[2]", 0)->plaintext;
						 $InstDte1st			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[1]", 1)->plaintext;
						 $Status			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[2]", 1)->plaintext;
						 $CourtName2			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[1]", 2)->plaintext;
						 $CaseFlDte			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[2]", 2)->plaintext;
						 $RestrCode			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[1]", 3)->plaintext;
						 $USCode			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[2]", 3)->plaintext;
						 //This is for FIR DETAILS
						 $FIR				=	$DetailPg->find("//div[@class='container']/table[2]/tbody/tr[1]/td[1]", 0)->plaintext;
						 $FIRReg			=	$DetailPg->find("//div[@class='container']/table[2]/tbody/tr[1]/td[2]", 0)->plaintext;
						 $Offence			=	$DetailPg->find("//div[@class='container']/table[2]/tbody/tr[2]/td[1]", 0)->plaintext;
						 $IncidentDate 			=	$DetailPg->find("//div[@class='container']/table[2]/tbody/tr[2]/td[2]", 0)->plaintext;
						 $CaseProperty			=	$DetailPg->find("//div[@class='container']/table[2]/tbody/tr[3]/td[1]", 0)->plaintext;
						 $NameofIO			=	$DetailPg->find("//div[@class='container']/table[2]/tbody/tr[3]/td[2]", 0)->plaintext;
						 $ChallanDetail 		=   	$DetailPg->find("//div[@class='container']/table[2]/tbody/tr[4]/td", 0)->plaintext;
						 $FIRDesc 			= 	$DetailPg->find("//div[@class='container']/table[2]/tbody/tr[5]/td", 0)->plaintext;	
						 $html_encoded = html_entity_decode($DetailPg); 
								
  
		$record = array( 'caseno' =>$CaseNo, 
		   'instdte' => $instdte,
		   'instdtest' => $InstDte1st, 
		   'status' => $Status, 
		   'courtname2' => $CourtName2, 
		   'caseflde' => $CaseFlDte, 
		   'restrcode' => $RestrCode, 
		   'uscode' => $USCode, 
		   'fir' => $FIR,
		   'firreg' => $FIRReg,
		   'offence' => $Offence,
		   'caseproperty' => $CaseProperty,
		   'nameofio' => $NameofIO,
		   'challandetail' => $ChallanDetail,
		   'firdesc' => $FIRDesc,
		   'mainpage' => $FinalURL,
		   'html_encoded' => $html_encoded,
		   'caselink' => $CaseLink);
						
						
           scraperwiki::save(array('caseno','instdte','instdtest','status','courtname2','caseflde','restrcode','uscode','fir','firreg','offence','caseproperty','nameofio','challandetail','firdesc','mainpage','html_encoded','caselink'), $record);
				
				}}}
	}}
	
	}	
			
?>
