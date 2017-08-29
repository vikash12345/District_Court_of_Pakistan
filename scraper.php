<?
require 		'scraperwiki.php';
require 		'scraperwiki/simple_html_dom.php';
$BaseLink	=	'http://202.61.43.40:8080/';
$SiteURL	=	'http://202.61.43.40:8080/index.php?r=site%2Fsearchbyvalue&page=';
	
	//	Page pagination
	for($PageLoop = 1; $PageLoop < 2; $PageLoop++){

		$FinalURL	=	$SiteURL . $PageLoop;
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
					$DetailPg	=	file_get_html($CaseLink);
						
					if ($DetailPg) {
						//	Assign fields to varilables
						//This is for Case Details
					 	 $info['CaseNo']			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[1]", 0)->plaintext;
						 $InstDte			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[2]", 0)->plaintext;
						 $nstDte1st			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[1]", 1)->plaintext;
						 $Status			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[2]", 1)->plaintext;
						 $CourtName2			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[1]", 2)->plaintext;
						 $CaseFlDte			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[2]", 2)->plaintext;
						 $RestrCode			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[1]", 3)->plaintext;
						 $USCode			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[2]", 3)->plaintext;
						 $AdvPSide1			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[1]", 4)->plaintext;
						 $AdvPSide2			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[2]", 4)->plaintext;
		
												
						scraperwiki::save_sqlite(array('name'), 
									 array('name' => $info['CaseNo']))
					}
						
					}
					
				}
				
				
			} 
					}	    
				/*		
						scraperwiki::save_sqlite(array('name'), array('name' => $CaseNo , 'InstDte' => $InstDte, 'nstDte1st' => $nstDte1st, 'Status' => $Status, 'CourtName2' => $CourtName2, 'CaseFlDte' => $CaseFlDte, 'RestrCode' => $RestrCode, 'USCode' => $USCode, 'AdvPSide1' => $AdvPSide1, 'AdvPSide2' => $AdvPSide2));
						}
	 scraperwiki::save_sqlite(array('CaseNo','CaseNo'), 
    array('CaseNo' => $PageLoop, 
	  
	  
	  
          'InstDte' => (trim($info['InstDte'])), 
	  
          'nstDte1st' => (trim($info['nstDte1st'])),
	  
          'Status' => (trim($info['Status'])),
          'CourtName2' => (trim($info['CourtName2'])),
          'CaseFlDte' => (trim($info['CaseFlDte'])),
          'RestrCode' => (trim($info['RestrCode'])),
          'USCode' => (trim($info['USCode'])),
          'AdvPSide1' => (trim($info['AdvPSide1'])),
          'AdvPSide2' => (trim($info['AdvPSide2']))	 
    ));					
						/* scraperwiki::save_sqlite(array('CourtName'), array('CaseNo' => $CaseNo, 
										'CourtName' => $CourtName,
										'PageLoop' =>  $PageLoop,
										'InstDte1st' =>  $InstDte1st
										
										)); */
							
						
					
?>
