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
						 $CaseNo			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[1]", 0);
						 $InstDte			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[2]", 0);
						 $InstDte1st		=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[1]", 1);
						 $Status			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[2]", 1);
						 $CourtName2		=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[1]", 2);
						 $CaseFlDte			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[2]", 2);
						 $RestrCode			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[1]", 3);
						 $USCode			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[2]", 3);
						 $AdvPSide1			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[1]", 4);
						 $AdvPSide2			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[2]", 4);
						 //This is for Parties Side
						 $Partyside1		=	$DetailPg->find("//*[@id='party_side_1']/tbody/tr/td", 0);
						 $Partyside2		=	$DetailPg->find("//*[@id='party_side_2']/tbody/tr/td", 0);
						 //This is for FIR DETAILS
						 $FIR				=	$DetailPg->find("//div[@class='container']/table[2]/tbody/tr[1]/td[1]", 0);
						 $FIRReg			=	$DetailPg->find("//div[@class='container']/table[2]/tbody/tr[1]/td[2]", 0);
						 $Offence			=	$DetailPg->find("//div[@class='container']/table[2]/tbody/tr[2]/td[1]", 0);
						 $IncidentDate 		=	$DetailPg->find("//div[@class='container']/table[2]/tbody/tr[2]/td[2]", 0);
						 $CaseProperty		=	$DetailPg->find("//div[@class='container']/table[2]/tbody/tr[3]/td[1]", 0);
						 $NameofIO			=	$DetailPg->find("//div[@class='container']/table[2]/tbody/tr[3]/td[2]", 0);
						 $ChallanDetail 	=   $DetailPg->find("//div[@class='container']/table[2]/tbody/tr[4]/td", 0);
						 $FIRDesc 			= 	$DetailPg->find("//div[@class='container']/table[2]/tbody/tr[5]/td", 0);	
						 $accuesdname 		=	$DetailPg->find("//*[@id='w0']/table/tbody/tr/td[2]", 0);
						 $fatherName 		=	$DetailPg->find("//*[@id='w0']/table/tbody/tr/td[3]", 0);				
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
		  , 'DetailPg' => $DetailPg);
						
						
           scraperwiki::save(array('caseno','InstDte','InstDte1st','Status','CourtName2','CaseFlDte','RestrCode','USCode','AdvPSide1','AdvPSide2','Partyside1','Partyside2','FIR','FIRReg','Offence','CaseProperty','NameofIO','ChallanDetail','FIRDesc','accuesdname','fatherName','DetailPg'), $record);
				
	}}}}
	
	
	}	
			
?>
