<?
require 		'scraperwiki.php';
require 		'scraperwiki/simple_html_dom.php';
$BaseLink	=	'http://202.61.43.40:8080/';
$SiteURL	=	'http://202.61.43.40:8080/index.php?r=site%2Fsearchbyvalue&page=';
	
	//	Page pagination
	for($PageLoop = 0; $PageLoop < 2; $PageLoop++){

		$FinalURL	=	$SiteURL . $PageLoop;
		$Html		=	file_get_html($FinalURL);
		

		if ($Html) {

			//	Paginate all 'View' buttons
			foreach ($Html->find("//div[@id='w0']/table[contains(@class,'table-striped')]/tbody/tr") as $element) {
			
					echo $num		=	$element->find('./td[1]', 0)->plaintext;
				echo "------------";
					$Courtname	=	$element->find('./td[2]', 0)->plaintext;
					$CaseNumbr	=	$element->find('./td[3]', 0)->plaintext;
					$CaseStats	=	$element->find('./td[4]', 0)->plaintext;
					$CaseValue	=	$element->find('./td[5]/button', 0);
					$CaseLinkR	=	$BaseLink . $CaseValue->attr['value'];
					$CaseLink	=	str_replace("amp;", "", $CaseLinkR);
					
scraperwiki::save_sqlite(array('num'), array('num' => $num ,
					     'Courtname' => $Courtname , 
					     'Casenumbr' => $CaseNumbr, 
					     'Casestats' => $CaseStats 
					     ));

						
					
					
				}
				
				
			} 
	}	
			
?>
