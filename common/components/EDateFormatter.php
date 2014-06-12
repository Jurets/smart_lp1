<?php
class EDateFormatter extends CDateFormatter
{
    public function init()
    {
		
    } 
    //public $locale = 'ru';
    	public function __construct($locale='ru')
	{
		parent::__construct($locale);
            	}
        
    public function formatDayInWeek($pattern, $date) {
        return parent::formatDayInWeek($pattern, $date);
    }   
}
