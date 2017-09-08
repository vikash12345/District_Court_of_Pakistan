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
					$num		=	$element->find('./td[1]', 0);
					$Courtname	=	$element->find('./td[2]', 0);
					$CaseNumbr	=	$element->find('./td[3]', 0);
					$CaseStats	=	$element->find('./td[4]', 0);
					$CaseValue	=	$element->find('./td[5]/button', 0);
					$CaseLinkR	=	$BaseLink . $CaseValue->attr['value'];
					$CaseLink	=	str_replace("amp;", "", $CaseLinkR);
					
scraperwiki::save_sqlite(array('num'), array('num' => $num ,
					     'Courtname' => $Courtname , 
					     'Casenumbr' => $CaseNumbr, 
					     'Casestats' => $CaseStats, 
					     'Casevalue' => $CaseValue, 
					     'Link' => $CaseLinkR));

						
					}
					
				}
				
				
			} 
	}	
			
?>
