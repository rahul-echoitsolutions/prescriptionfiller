<?
/* 
$state_prov == "state_prov" - displays states then provinces
 $state_prov == "prov_state" - displays provinces then states
$state_prov == "state" - displays states
$state_prov == "prov" - displays provinces   
$state_prov == "counties" - displays English counties

$prov_selected == current selected province

$variable_returned == the name of the variable to hold the state/province/county

$states_all == a flag. if set, it gives the option of "ALL"

$class == a  class that you want added to the select tag.

*/
function state_prov($state_prov, $prov_selected,$variable_returned,$states_all,$class)
{
        
if($state_prov=="state_prov")
{
$StateProv["AL"]="Alabama";
$StateProv["AK"]="Alaska";
$StateProv["AZ"]="Arizona";
$StateProv["AR"]="Arkansas";
$StateProv["CA"]="California";
$StateProv["CO"]="Colorado";
$StateProv["CT"]="Connecticut";
$StateProv["DE"]="Delaware";
$StateProv["FL"]="Florida";
$StateProv["GA"]="Georgia";
$StateProv["HI"]="Hawaii";
$StateProv["ID"]="Idaho";
$StateProv["IL"]="Illinois";
$StateProv["IN"]="Indiana";
$StateProv["IA"]="Iowa";
$StateProv["KS"]="Kansas";
$StateProv["KY"]="Kentucky";
$StateProv["LA"]="Louisiana";
$StateProv["ME"]="Maine";
$StateProv["MD"]="Maryland";
$StateProv["MA"]="Massachusetts";
$StateProv["MI"]="Michigan";
$StateProv["MN"]="Minnesota";
$StateProv["MS"]="Mississippi";
$StateProv["MO"]="Missouri";
$StateProv["MT"]="Montana";
$StateProv["NE"]="Nebraska";
$StateProv["NV"]="Nevada";
$StateProv["NH"]="New Hampshire";
$StateProv["NJ"]="New Jersey";
$StateProv["NM"]="New Mexico";
$StateProv["NY"]="New York";
$StateProv["NC"]="North Carolina";
$StateProv["ND"]="North Dakota";
$StateProv["OH"]="Ohio";
$StateProv["OK"]="Oklahoma";
$StateProv["OR"]="Oregon";
$StateProv["PA"]="Pennsylvania";
$StateProv["PR"]="Puerto Rico";
$StateProv["RI"]="Rhode Island";
$StateProv["SC"]="South Carolina";
$StateProv["SD"]="South Dakota";
$StateProv["TN"]="Tennessee";
$StateProv["TX"]="Texas";
$StateProv["UT"]="Utah";
$StateProv["VT"]="Vermont";
$StateProv["VA"]="Virginia";
$StateProv["WA"]="Washington";
$StateProv["WV"]="West Virginia";
$StateProv["WI"]="Wisconsin";
$StateProv["WY"]="Wyoming";
$StateProv["AB"]="Alberta";
$StateProv["BC"]="British Columbia";
$StateProv["SK"]="Saskatchewan";
$StateProv["MB"]="Manitoba";
$StateProv["ON"]="Ontario";
$StateProv["PQ"]="Quebec";
$StateProv["NB"]="New Brunswick";
$StateProv["NS"]="Nova Scotia";
$StateProv["LD"]="Newfoundland";
$StateProv["EI"]="Prince Edward Island";
}


if($state_prov=="prov_state")
{
$StateProv["AB"]="Alberta";
$StateProv["BC"]="British Columbia";
$StateProv["SK"]="Saskatchewan";
$StateProv["MB"]="Manitoba";
$StateProv["ON"]="Ontario";
$StateProv["PQ"]="Quebec";
$StateProv["NB"]="New Brunswick";
$StateProv["NS"]="Nova Scotia";
$StateProv["LD"]="Newfoundland";
$StateProv["EI"]="Prince Edward Island";
$StateProv["AL"]="Alabama";
$StateProv["AK"]="Alaska";
$StateProv["AZ"]="Arizona";
$StateProv["AR"]="Arkansas";
$StateProv["CA"]="California";
$StateProv["CO"]="Colorado";
$StateProv["CT"]="Connecticut";
$StateProv["DE"]="Delaware";
$StateProv["FL"]="Florida";
$StateProv["GA"]="Georgia";
$StateProv["HI"]="Hawaii";
$StateProv["ID"]="Idaho";
$StateProv["IL"]="Illinois";
$StateProv["IN"]="Indiana";
$StateProv["IA"]="Iowa";
$StateProv["KS"]="Kansas";
$StateProv["KY"]="Kentucky";
$StateProv["LA"]="Louisiana";
$StateProv["ME"]="Maine";
$StateProv["MD"]="Maryland";
$StateProv["MA"]="Massachusetts";
$StateProv["MI"]="Michigan";
$StateProv["MN"]="Minnesota";
$StateProv["MS"]="Mississippi";
$StateProv["MO"]="Missouri";
$StateProv["MT"]="Montana";
$StateProv["NE"]="Nebraska";
$StateProv["NV"]="Nevada";
$StateProv["NH"]="New Hampshire";
$StateProv["NJ"]="New Jersey";
$StateProv["NM"]="New Mexico";
$StateProv["NY"]="New York";
$StateProv["NC"]="North Carolina";
$StateProv["ND"]="North Dakota";
$StateProv["OH"]="Ohio";
$StateProv["OK"]="Oklahoma";
$StateProv["OR"]="Oregon";
$StateProv["PA"]="Pennsylvania";
$StateProv["PR"]="Puerto Rico";
$StateProv["RI"]="Rhode Island";
$StateProv["SC"]="South Carolina";
$StateProv["SD"]="South Dakota";
$StateProv["TN"]="Tennessee";
$StateProv["TX"]="Texas";
$StateProv["UT"]="Utah";
$StateProv["VT"]="Vermont";
$StateProv["VA"]="Virginia";
$StateProv["WA"]="Washington";
$StateProv["WV"]="West Virginia";
$StateProv["WI"]="Wisconsin";
$StateProv["WY"]="Wyoming";
$StateProv["OT"]="Not in US or Canada";
}


if($state_prov=="prov")
{

$StateProv["BC"]="British Columbia";
$StateProv["AB"]="Alberta";
$StateProv["SK"]="Saskatchewan";
$StateProv["MB"]="Manitoba";
$StateProv["ON"]="Ontario";
$StateProv["QC"]="Quebec";
$StateProv["NB"]="New Brunswick";
$StateProv["NS"]="Nova Scotia";
$StateProv["NL"]="Newfoundland";
$StateProv["YT"]="Yukon Territory";
$StateProv["NT"]="Northwest Territory";
$StateProv["NU"]="Nunavut Territory";
$StateProv["PE"]="Prince Edward Island";


}

if($state_prov=="state")
{
$StateProv["AL"]="Alabama";
$StateProv["AK"]="Alaska";
$StateProv["AZ"]="Arizona";
$StateProv["AR"]="Arkansas";
$StateProv["CA"]="California";
$StateProv["CO"]="Colorado";
$StateProv["CT"]="Connecticut";
$StateProv["DE"]="Delaware";
$StateProv["FL"]="Florida";
$StateProv["GA"]="Georgia";
$StateProv["HI"]="Hawaii";
$StateProv["ID"]="Idaho";
$StateProv["IL"]="Illinois";
$StateProv["IN"]="Indiana";
$StateProv["IA"]="Iowa";
$StateProv["KS"]="Kansas";
$StateProv["KY"]="Kentucky";
$StateProv["LA"]="Louisiana";
$StateProv["ME"]="Maine";
$StateProv["MD"]="Maryland";
$StateProv["MA"]="Massachusetts";
$StateProv["MI"]="Michigan";
$StateProv["MN"]="Minnesota";
$StateProv["MS"]="Mississippi";
$StateProv["MO"]="Missouri";
$StateProv["MT"]="Montana";
$StateProv["NE"]="Nebraska";
$StateProv["NV"]="Nevada";
$StateProv["NH"]="New Hampshire";
$StateProv["NJ"]="New Jersey";
$StateProv["NM"]="New Mexico";
$StateProv["NY"]="New York";
$StateProv["NC"]="North Carolina";
$StateProv["ND"]="North Dakota";
$StateProv["OH"]="Ohio";
$StateProv["OK"]="Oklahoma";
$StateProv["OR"]="Oregon";
$StateProv["PA"]="Pennsylvania";
$StateProv["PR"]="Puerto Rico";
$StateProv["RI"]="Rhode Island";
$StateProv["SC"]="South Carolina";
$StateProv["SD"]="South Dakota";
$StateProv["TN"]="Tennessee";
$StateProv["TX"]="Texas";
$StateProv["UT"]="Utah";
$StateProv["VT"]="Vermont";
$StateProv["VA"]="Virginia";
$StateProv["WA"]="Washington";
$StateProv["WV"]="West Virginia";
$StateProv["WI"]="Wisconsin";
$StateProv["WY"]="Wyoming";
$StateProv["OT"]="Not in USA";
}


if($state_prov=="county")
{

$StateProv["Avon"]="Avon";
$StateProv["Bedfordshire"]="Bedfordshire";
$StateProv["Berkshire"]="Berkshire";
$StateProv["Borders"]="Borders";
$StateProv["Buckinghamshire"]="Buckinghamshire";
$StateProv["Cambridgeshire"]="Cambridgeshire";
$StateProv["Central"]="Central";
$StateProv["Cheshire"]="Cheshire";
$StateProv["Cleveland"]="Cleveland";
$StateProv["Clwyd"]="Clwyd";
$StateProv["Cornwall"]="Cornwall";
$StateProv["County Antrim"]="County Antrim";
$StateProv["County Armagh"]="County Armagh";
$StateProv["County Down"]="County Down";
$StateProv["County Fermanagh"]="County Fermanagh";
$StateProv["County Londonderry"]="County Londonderry";
$StateProv["County Tyrone"]="County Tyrone";
$StateProv["Cumbria"]="Cumbria";
$StateProv["Derbyshire"]="Derbyshire";
$StateProv["Devon"]="Devon";
$StateProv["Dorset"]="Dorset";
$StateProv["Dumfries and Galloway"]="Dumfries and Galloway";
$StateProv["Durham"]="Durham";
$StateProv["Dyfed"]="Dyfed";
$StateProv["East Sussex"]="East Sussex";
$StateProv["Essex"]="Essex";
$StateProv["Fife"]="Fife";
$StateProv["Gloucestershire"]="Gloucestershire";
$StateProv["Grampian"]="Grampian";
$StateProv["Greater Manchester"]="Greater Manchester";
$StateProv["Gwent"]="Gwent";
$StateProv["Gwynedd County"]="Gwynedd County";
$StateProv["Hampshire"]="Hampshire";
$StateProv["Herefordshire"]="Herefordshire";
$StateProv["Hertfordshire"]="Hertfordshire";
$StateProv["Highlands and Islands"]="Highlands and Islands";
$StateProv["Humberside"]="Humberside";
$StateProv["Isle of Wight"]="Isle of Wight";
$StateProv["Kent"]="Kent";
$StateProv["Lancashire"]="Lancashire";
$StateProv["Leicestershire"]="Leicestershire";
$StateProv["Lincolnshire"]="Lincolnshire";
$StateProv["London"]="London";
$StateProv["Lothian"]="Lothian";
$StateProv["Merseyside"]="Merseyside";
$StateProv["Mid Glamorgan"]="Mid Glamorgan";
$StateProv["Norfolk"]="Norfolk";
$StateProv["North Yorkshire"]="North Yorkshire";
$StateProv["Northamptonshire"]="Northamptonshire";
$StateProv["Northumberland"]="Northumberland";
$StateProv["Nottinghamshire"]="Nottinghamshire";
$StateProv["Oxfordshire"]="Oxfordshire";
$StateProv["Powys"]="Powys";
$StateProv["Rutland"]="Rutland";
$StateProv["Shropshire"]="Shropshire";
$StateProv["Somerset"]="Somerset";
$StateProv["South Glamorgan"]="South Glamorgan";
$StateProv["South Yorkshire"]="South Yorkshire";
$StateProv["Staffordshire"]="Staffordshire";
$StateProv["Strathclyde"]="Strathclyde";
$StateProv["Suffolk"]="Suffolk";
$StateProv["Surrey"]="Surrey";
$StateProv["Tayside"]="Tayside";
$StateProv["Tyne and Wear"]="Tyne and Wear";
$StateProv["Warwickshire"]="Warwickshire";
$StateProv["West Glamorgan"]="West Glamorgan";
$StateProv["West Midlands"]="West Midlands";
$StateProv["West Sussex"]="West Sussex";
$StateProv["West Yorkshire"]="West Yorkshire";
$StateProv["Wiltshire"]="Wiltshire";
$StateProv["Worcestershire"]="Worcestershire";
}


if(!$variable_returned)
{
$variable_returned="prov";
}


$prov_display.="<select name=\"$variable_returned\"  class=\"required stateProv  $class\" required>"; /// note: class required is for validation code. ignored if validation include is not on the page.
if($states_all)
{
$prov_display.="<option selectied  value=\"All\">All</option>";
}

if(!$prov_selected){
$prov_display.="<option  value='' selected>Select from list</option> ";
}

//while(list( $prov,$prov_name)=each($StateProv)){
	
foreach ($StateProv as $prov=>$prov_name){


$prov_select=($prov_selected==$prov)? "selected" : "";

          if($prov<>$prov_name)
          {
          $prov_display.="<option  value='$prov' $prov_select >$prov....$prov_name</option>";
          }else{
          $prov_display.="<option  value='$prov' $prov_select >$prov_name</option>";
          }
}
$prov_display.="</select>";

return $prov_display;

}

