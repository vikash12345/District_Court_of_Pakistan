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
	for($PageLoop = 0 ; $PageLoop < 2; $PageLoop++){
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
					
					//	Visit link inside 'View' button
					$DetailPg	=	file_get_html($CaseLink);

					if ($DetailPg) {
						//	Assign fields to varilables
							//This is for Case Details
						 $CaseNo			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[1]", 0)->plantext;
						 $InstDte			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[2]", 0)->plantext;
						 $InstDte1st			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[1]", 1)->plantext;
						 $Status			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[2]", 1)->plantext;
						 $CourtName2			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[1]", 2)->plantext;
						 $CaseFlDte			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[2]", 2)->plantext;
						 $RestrCode			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[1]", 3)->plantext;
						 $USCode			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[2]", 3)->plantext;
						 $AdvPSide1			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[1]", 4)->plantext;
						 $AdvPSide2			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[2]", 4)->plantext;
						 //This is for Parties Side
						 $Partyside1		=		$DetailPg->find("//*[@id='party_side_1']/tbody/tr/td", 0)->plantext;
						 $Partyside2		=		$DetailPg->find("//*[@id='party_side_2']/tbody/tr/td", 0)->plantext;
						 //This is for FIR DETAILS
						 $FIR				=	$DetailPg->find("//div[@class='container']/table[2]/tbody/tr[1]/td[1]", 0)->plantext;
						 $FIRReg			=	$DetailPg->find("//div[@class='container']/table[2]/tbody/tr[1]/td[2]", 0)->plantext;
						 $Offence			=	$DetailPg->find("//div[@class='container']/table[2]/tbody/tr[2]/td[1]", 0)->plantext;
						 $IncidentDate 			=	$DetailPg->find("//div[@class='container']/table[2]/tbody/tr[2]/td[2]", 0)->plantext;
						 $CaseProperty			=	$DetailPg->find("//div[@class='container']/table[2]/tbody/tr[3]/td[1]", 0)->plantext;
						 $NameofIO			=	$DetailPg->find("//div[@class='container']/table[2]/tbody/tr[3]/td[2]", 0)->plantext;
						 $ChallanDetail 		=   	$DetailPg->find("//div[@class='container']/table[2]/tbody/tr[4]/td", 0)->plantext;
						 $FIRDesc 			= 	$DetailPg->find("//div[@class='container']/table[2]/tbody/tr[5]/td", 0)->plantext;	
						 $accuesdname 			=	$DetailPg->find("//*[@id='w0']/table/tbody/tr/td[2]", 0)->plantext;
						 $fatherName 			=	$DetailPg->find("//*[@id='w0']/table/tbody/tr/td[3]", 0)->plantext;				
   $record = array( 'caseno' =>$CaseNo, 'InstDte' => $InstDte,'InstDte1st' => $InstDte1st , 
		   'Status' => $Status , 'CourtName2' => $CourtName2, 'CaseFlDte' => $CaseFlDte, 'RestrCode' => $RestrCode , 'USCode' => $USCode, 'AdvPSide1' => $AdvPSide1, 'AdvPSide2' => $AdvPSide2
		  , 'Partyside1' => $Partyside1
		  , 'Partyside2' => $Partyside2
		  , 'FIR' => $FIR
		  , 'FIRReg' => $FIRReg
		  , 'Offence' => $Offence
		  , 'CaseProperty' => $CaseProperty
		  , 'NameofIO' => $NameofIO
		  , 'ChallanDetail' => $ChallanDetail
		  , 'FIRDesc' => $FIRDesc
		  , 'accuesdname' => $accuesdname
		  , 'fatherName' => $fatherName
		  , 'CaseLink' => $CaseLink);
						
						
           scraperwiki::save(array('caseno','InstDte','InstDte1st','Status','CourtName2','CaseFlDte','RestrCode','USCode','AdvPSide1','AdvPSide2','Partyside1','Partyside2','FIR','FIRReg','Offence','CaseProperty','NameofIO','ChallanDetail','FIRDesc','accuesdname','fatherName','CaseLink'), $record);
				
	}}}}
	
	
	}	
			
?>
