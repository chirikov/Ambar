<?
error_reporting(E_ALL ^ E_NOTICE);
$body="@day7@ [F]@month3@, [F]@day@.<br><font size=+2>@hour@:@minute@</font>"; #������� ����
$date=manlix_russian_time(time()); # time() - ������� �����
function manlix_russian_time($time)
{
global $manlix_russian_time;
if (!$time){$manlix_russian_time = "�� �� ������� ����� ��� ��������� ��� ������";}
else if (!is_numeric($time)){$manlix_russian_time = "�� ������� ������������ ����� ��� ��������� ��� ������";}
else {
	$months1= array("������","�������","����","������","���","����","����","������","��������","�������","������","�������");
	$months3= array("������","�������","�����","������","���","����","����","�������","��������","�������","������","�������");
	$days1	= array("�����������","�����������","�������","�����","�������","�������","�������");
	if (date(w,$time) == "0")	{$num_day_of_the_week = "7";}
	else {$num_day_of_the_week = date(w,$time);}
		$manlix_russian_time = array(
	month	=> $months1[date(m,$time) - 1],
	month3	=> $months3[date(m,$time) - 1],
	month8	=> date(m,$time),
	day		=> $days1[date(w,$time)],
	day6	=> $num_day_of_the_week,
	day7	=> date(j,$time),
	day8	=> date(z,$time),
	hour	=> date(H,$time),
	hour2	=> date(h,$time),
	minute	=> date(i,$time),
	second	=> date(s,$time)
	);
	return $manlix_russian_time;
}
}
$array_time=array(day=>8,month=>8,year=>2,hour=>2,minute=>1,second=>1);
while(list($key,$value)=each($array_time))
{
for ($i=0;$i<=$value;$i++)
{
$body=eregi_replace("\[f\]@".$key."@",ucfirst($date[$key]),$body);
	$body=eregi_replace("\[f\]@".$key.$i."@",ucfirst($date[$key.$i]),$body);
$body=eregi_replace("\[up\]@".$key."@",strtoupper($date[$key]),$body);
	$body=eregi_replace("\[up\]@".$key.$i."@",strtoupper($date[$key.$i]),$body);
$body=eregi_replace("@".$key."@",$date[$key],$body);
	$body=eregi_replace("@".$key.$i."@",$date[$key.$i],$body);
}}
echo $body;
//error_reporting(E_ALL);
?>