<?php
class Country_Info_AjaxFunctions{

  private $curlWrapClass;

  public function __construct($curlWrapClass)
  {
      $this->curlWrapClass = $curlWrapClass;
  }

  //process ajax data and send response
  function returnSearchResults(){
		$country_text = $_POST["country_text"];
		$rest_url = "https://restcountries.eu/rest/v1/name/" . $country_text;
		$this->curlWrapClass->exec($rest_url);
		if ($this->curlWrapClass->getHttpCode()!='200') {
			print "ERROR: Failed to fetch url. ". $this->curlWrapClass->getError(). "\n";
		} else {
			$res = $this->curlWrapClass->getExecResponse();
			$countries = json_decode($res);
			$country_html = '';
			$country_html .= '<table>';
			$country_html .= '<tr>';
			$country_html .= '<td>Country</td>';
			$country_html .= '<td>Calling Codes</td>';
			$country_html .= '</tr>';
			foreach ($countries as $country) {
				$country_name = $country->name;
				$country_calling_codes = $country->callingCodes;
				$country_html .= '<tr>';
				$country_html .= '<td>' . $country_name . '</td>';
				$country_html .= '<td>';
				foreach ($country_calling_codes as $country_calling_code) {
					if ($country_calling_code == '') {
						$country_html .= 'None found';
					} else {
						$country_html .= $country_calling_code . ' ';
					}
					
				}
				$country_html .= '</td>';
			}
			$country_html .= '</table>';
			echo $country_html;
			
			die();
		}
  }
}