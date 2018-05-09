# Calculate for specific day using strtotime

// Use last monday if week start not given + calculate its next sunday accordingly
if(is_null($week_start_date))
{  
  //If Monday is not the current day then re-calculate accordingly
  if(date('D')!='Mon')
    $week_start_date = date('Y-m-d',strtotime('last monday')) ;
  else
    $week_start_date = date('Y-m-d') ;
  //If Sunday is not the current day then re-calculate accordingly
  if(date('D')!='Sun')
    $week_end_date = date('Y-m-d',strtotime('next Sunday')) ;
  else
    $week_end_date = date('Y-m-d') ;  
}
else
{
  // The following Sunday (with respect to the provided Monday's date!)
  $week_end_date = date('Y-m-d', strtotime("next Sunday", strtotime($week_start_date)));
}
