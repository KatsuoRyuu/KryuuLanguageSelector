<?php
/*~ class.LanguageSelector.php
 * 
 */

if (version_compare(PHP_VERSION, '5.0.0', '<') ) exit("Sorry, this version of PHPMailer will only run on PHP version 5 or greater!\n");

/**
 * Main PHPMailer class definition
 */
class KryuuLanguageSelector {

	protected $languages;
	protected $defaultLanguage = "en_US";

	public function getLanguage()
	{
		$this->setLanguageArray();
		if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
			$language = @\Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
			if (array_key_exists($language,$this->languages))
				return $this->languages[$language];
			else
				return $this->defaultLanguage;
		}
		else 
		{
			return $this->defaultLanguage;
		}
	}
	
	private function setLanguageArray()
	{
		$array = array(
			'da' 	=> "da_DK",
			'da_DK' => "da_DK",
			'en' 	=> "en_US",
			'en_GB'	=> "en_US",
			'en_US'	=> "en_US",
		);
		$this->languages = $array;	
	}

}
