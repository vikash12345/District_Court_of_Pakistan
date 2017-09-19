<?
require 		'scraperwiki.php';
require 		'scraperwiki/simple_html_dom.php';
$BaseLink	=	'http://202.61.43.40:8080/';
	$SiteURL	=	'http://202.61.43.40:8080/index.php?r=site%2Fsearchbyvalue&page=0';
	$Pagination = 	file_get_html($SiteURL);
	$numberforloop = $Pagination->find("//*[@id='w0']/div/b[2]",0)->plaintext;
	$text = str_replace(',', '', $numberforloop);
	$loop = $text/20;
	
	// echo $AllPages = (int)$numberforloop;
	
	
	
	//	Page pagination
	for($PageLoop = 0 ; $PageLoop < 1; $PageLoop++){
	$FinalURL  		=  'http://202.61.43.40:8080/index.php?r=site%2Fsearchbyvalue&page='.$PageLoop;
		$Html		=	file_get_html($FinalURL);
		$RowNumb	=	-1;

		if ($Html) {

			//	Paginate all 'View' buttons
			foreach ($Html->find("//div[@id='w0']/table[contains(@class,'table-striped')]/tbody/tr") as $element) {
				$RowNumb	+=	1;
				if ($RowNumb != 0) {
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
		  
					
					//	Visit link inside 'View' button
					$DetailPg	=	file_get_html($URL);

					if ($DetailPg!= null) {
						//	Assign fields to varilables
							//This is for Case Details
						// echo "$DetailPg...\n";
						 $CaseNo			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[1]", 0)->plaintext;
						 echo "$CaseNo...\n";
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
						 				
  
			/*	$record = array( 'caseno' => $CaseNo, 'instdte' => $instdte,);
						scraperwiki::save(array('caseno' , 'instdte'), $record); */
	
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
		   'caselink' => $CaseLink);
						
						
           scraperwiki::save(array('caseno','instdte','instdtest','status','courtname2','caseflde','restrcode','uscode','fir','firreg','offence','caseproperty','nameofio','challandetail','firdesc','mainpage','caselink'), $record);
				
				}}}
	}}
	
	}	
			
?>
