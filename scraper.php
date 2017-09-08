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
		
		
			foreach($Html->find("//[@id='w0']/table/tbody/tr") as $element) {
			if($element){
					echo $num		=	$element->find('./td[1]', 0)->plaintext;
					$Courtname	=	$element->find('./td[2]', 0)->plaintext;
					$Casenumbr	=	$element->find('./td[3]', 0)->plaintext;
					$CaseStats	=	$element->find('./td[4]', 0)->plaintext;
					
				if($num != null){	
scraperwiki::save_sqlite(array('Courtname'), array('Courtname' => $Courtname,
					     'num' => $num ,
					     'Casenumbr' => $Casenumbr ,
					     'CaseStats' => $CaseStats
					     ));
			}
						
			}	
					
				
				
				
			} 
	}	
			
?>
