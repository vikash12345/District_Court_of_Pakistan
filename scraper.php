<?
require 		'scraperwiki.php';
require 		'scraperwiki/simple_html_dom.php';
$BaseLink	=	'http://202.61.43.40:8080/';
$SiteURL	=	'http://202.61.43.40:8080/index.php?r=site%2Fsearchbyvalue&page=';
	
	//	Page pagination
	for($PageLoop = 0; $PageLoop < 1; $PageLoop++){

		$FinalURL	=	$SiteURL . $PageLoop;
		$Html		=	file_get_html($FinalURL);
		

			//	Paginate all 'View' buttons
		
		
			foreach($Html->find("//div[@id='w0']/table[contains(@class,'table-striped')]/tbody/tr") as $element) {
			
				
					echo	$CaseStats	=	$element->find('./td[4]', 0)->plaintext;
			/*		$num		=	$element->find('./td[1]', 0)->plaintext;
					$Courtname	=	$element->find('./td[2]', 0);
					$Casenumbr	=	$element->find('./td[3]', 0)->plaintext;
				
				
					
				
				scraperwiki::save_sqlite(array('num'), array('num' => $num,
                                             'casename' => $casename,
                                             'Courtname' => $Courtname,
					     'Casenumbr' => $Casenumbr,
					     'CaseStats' => $CaseStats
                                             ));
					*/

			
						
				
					
				
				
				
			} 
	}	
			
?>
