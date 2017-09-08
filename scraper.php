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
					$Num		=	$element->find('./td[1]', 0);
					$CourtName	=	$element->find('./td[2]', 0);
					$CaseNumbr	=	$element->find('./td[3]', 0);
					$CaseStats	=	$element->find('./td[4]', 0);
					$CaseValue	=	$element->find('./td[5]/button', 0);
					$CaseLinkR	=	$BaseLink . $CaseValue->attr['value'];
					$CaseLink	=	str_replace("amp;", "", $CaseLinkR);
			 scraperwiki::save_sqlite(array('name'), array('Num' => $Num , 'name' => $CourtName , 'InstDte' => $CaseNumbr, 'nstDte1st' => $CaseStats, 'Status' => $CaseValue 'CourtName2' => $CaseLinkR));

						
					}
					
				}
				
				
			} 
					}	    
						
						/* scraperwiki::save_sqlite(array('name'), array('name' => $CaseNo , 'InstDte' => $InstDte, 'nstDte1st' => $nstDte1st, 'Status' => $Status, 'CourtName2' => $CourtName2, 'CaseFlDte' => $CaseFlDte, 'RestrCode' => $RestrCode, 'USCode' => $USCode, 'AdvPSide1' => $AdvPSide1, 'AdvPSide2' => $AdvPSide2));
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
