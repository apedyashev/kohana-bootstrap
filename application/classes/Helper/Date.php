<?php

class Helper_Date {

  
  public static function createDateTimeFromHhMm( $inTimeHhMm ){
    return DateTime::createFromFormat( 'H:i', $inTimeHhMm );
  }

  public static function getDiffInDaysFromMySqlDates( $inDate1, $inDate2 ){
    $date1= DateTime::createFromFormat( 'Y-m-d', $inDate1 );
    $date2 = DateTime::createFromFormat( 'Y-m-d', $inDate2 );

    $dateInterval = $date2->diff( $date1 );

    return $dateInterval->d;
  }
  
  public static function getDiffInMinsFromMySqlDateTimes( $inDate1, $inDate2 ){
    $date1= DateTime::createFromFormat( 'Y-m-d H:i:s', $inDate1 );
    $date2 = DateTime::createFromFormat( 'Y-m-d H:i:s', $inDate2 );

    $i = ($date2->getTimestamp() - $date1->getTimestamp()) / 60;
    return $i;
//    var_dump($i);die;
//    $dateInterval = $date2->diff( $date1 );
//    return $dateInterval->i;
  }
  
  public static function timeStampToMySqlDate( $inTimeStamp ){
    return date('Y-m-d', $inTimeStamp);
  }
  
  public static function timeStampToMySqlDateGmt( $inTimeStamp ){
    return gmdate('Y-m-d', $inTimeStamp);
  }
  
  public static function timeStampToMySqlDateTimeGmt( $inTimeStamp ){
    return gmdate('Y-m-d H:i:s', $inTimeStamp);
  }
  
  public static function timeStampToMySqlDateWithTimezoneOffset( $inTimeStamp, $inTimeZoneOffset ){
    $gmtDateTime = self::timeStampToMySqlDateTimeGmt( $inTimeStamp );
    return self::addMinutesToMySqlDateTime($gmtDateTime, $inTimeZoneOffset * 60 );
  }

  public static function getCurrentDateMySqlFormat(  ){
    return date('Y-m-d');
  }
  
  public static function getCurrentDatTimeInMySqlFormat(  ){
    return date('Y-m-d H:i:s');
  }
  
  public static function timeStampToMySqlDateTime( $inTimeStamp ){
    return date('Y-m-d H:i:s', $inTimeStamp);
  }
  
  public static function timestampToDayOfWeek( $inTimeStamp ){
    return date('N', $inTimeStamp);
  }
  
  public static function getCurrentDayOfWeek( ){
    return date('N', time());
  }
  
  public static function getCurrentMonthNumeric( ){
    return date('n', time());
  }
  
  public static function getCurrentMonthStr( ){
    return __( date('M', time()) );
  }
  
  public static function getCurrentYear( ){
    return date('Y', time());
  }
  
  public static function mySqlDateTimeToTimestamp( $inMySqlDateTime ){
    if( empty( $inMySqlDateTime ) ){
      return false;
    }
    else{
      $dateTime = DateTime::createFromFormat( 'Y-m-d H:i:s', $inMySqlDateTime );
      return $dateTime->getTimestamp();
    }
  }
  
  public static function mySqlDateToTimestamp( $inMySqlDate ){
    if( empty( $inMySqlDate ) ){
      return false;
    }
    else{
      $dateTime = DateTime::createFromFormat( 'Y-m-d', $inMySqlDate );
      return $dateTime->getTimestamp();
    }
  }
  
  public static function addMinutesToMySqlDateTime( $inMySqlDateTime, $inMinutes ){
    $mins = (int)$inMinutes;
    if( $mins >= 0){
      $date = DateTime::createFromFormat( 'Y-m-d H:i:s', $inMySqlDateTime );
      $date->add( new DateInterval("P0Y0DT0H{$mins}M") );
    }
    else{
      $mins = $mins * -1;
      $date = DateTime::createFromFormat( 'Y-m-d H:i:s', $inMySqlDateTime );
      $date->sub( new DateInterval("P0Y0DT0H{$mins}M") );
    }
     
    return $date->format('Y-m-d H:i:s');
  }
  
  
  public static function isTimeInRange( $inTimeMm, $inMinTimeMm, $inMaxTimeMm){
    $time     = DateTime::createFromFormat( 'H:i', $inTimeMm );
    $minTime  = DateTime::createFromFormat( 'H:i', $inMinTimeMm );
    $maxTime  = DateTime::createFromFormat( 'H:i', $inMaxTimeMm );
    
    if( !$time || !$minTime || !$maxTime ) {
      return false;
    }
    return ( ($minTime->getTimestamp() <= $time->getTimestamp()) &&
            ($time->getTimestamp() < $maxTime->getTimestamp() ) );
  }
  
  
  public static function mySqlDateTimeToStrDateTime( $inMySqlDateTime ){
    if( empty( $inMySqlDateTime ) ){
      return '';
    }
    else{
      $dob = DateTime::createFromFormat( 'Y-m-d H:i:s', $inMySqlDateTime );
      return $dob->format( Kohana::$config->load('config')->get('datetime.format') ) . ' Uhr';
    }
  }
  
  public static function timeStampToCustomDateFormat( $inTimeStamp ){
    return date( Kohana::$config->load('config')->get('date.format'), $inTimeStamp );
  }

  public static function mySqlDateToStrDate( $inMySqlDate ){
    if( empty( $inMySqlDate ) ){
      return '';
    }
    else{
      $dob = DateTime::createFromFormat( 'Y-m-d', $inMySqlDate );
      return $dob->format( Kohana::$config->load('config')->get('date.format') );
    }
  }
  
  public static function mySqlDateTimeToStrDate( $inMySqlDateTime ){
    if( empty( $inMySqlDateTime ) ){
      return '';
    }
    else{
      $dob = DateTime::createFromFormat( 'Y-m-d H:i:s', $inMySqlDateTime );
      return $dob->format( Kohana::$config->load('config')->get('date.format') );
    }
  }
  
  public static function mySqlDateToJsDate( $inMySqlDate ){
    if( empty( $inMySqlDate ) ){
      return '';
    }
    else{
      $dob = DateTime::createFromFormat( 'Y-m-d', $inMySqlDate );
      return $dob->format( Kohana::$config->load('config')->get('date.format.js.php_side') );
    }
  }
  
  public static function mySqlDateTimeToCustomFormat( $inMySqlDateTime, $inFormat ){
    if( empty( $inMySqlDateTime ) ){
      return '';
    }
    else{
      $dob = DateTime::createFromFormat( 'Y-m-d H:i:s', $inMySqlDateTime );
      return $dob->format( $inFormat );
    }
  }
  
}
?>
