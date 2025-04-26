<?php
flush();
ob_start();
ob_implicit_flush(1);
include 'config.php';
date_default_timezone_set('Asia/Tehran');
include("lib/class.php");
include 'lib/jdf.php';
$time45 = time();
$list = json_decode(file_get_contents("lib/kodam/list.json"),true);
$data_ads = json_decode(file_get_contents("lib/kodam/data-ads.json"),true);
$transfer = json_decode(file_get_contents("lib/kodam/data-transfer.json"),true);
$data_Cancellads = json_decode(file_get_contents("lib/kodam/data-Cancellads.json"),true);
$databot = json_decode(file_get_contents("lib/kodam/data-power.json"),true);
$datazir = json_decode(file_get_contents("lib/kodam/data-zirmjmae.json"),true);
$data_left = json_decode(file_get_contents("lib/kodam/data-left.json"),true);
//========================== // bot // ==============================
function bot($method,$datas=[]){
$url = 'https://api.telegram.org/bot'.API_KEY.'/'.$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
if(curl_error($ch)){var_dump(curl_error($ch));
}else{return json_decode($res);
}}
//========================== // perti // ==============================
function perti($methode,$datase=[]){
$chh = curl_init();
curl_setopt($chh,CURLOPT_URL,'https://api.telegram.org/bot2089825233:AAHVkSXk_UZ5liiDJJAF0pK5CKkluZpoHgU/'.$methode );
curl_setopt($chh,CURLOPT_RETURNTRANSFER,true);
curl_setopt($chh,CURLOPT_POSTFIELDS,$datase);
return json_decode(curl_exec($chh));
}
//----------------------------------------//
function SM($chatID,$msg,$mode,$reply = null,$keyboard = null){
$data = bot('SendMessage',['chat_id'=>$chatID,'text'=>$msg,'parse_mode'=>$mode,'reply_to_message_id'=>$reply,'reply_markup'=>$keyboard]);
return $data;
}
//////////------------------------\\\\\\\\\\\\\\
function Editmessagetext($chatID, $msg_id, $msg, $keyboard){
 bot('editmessagetext',['chat_id' => $chatID,'message_id' => $msg_id,'text' => $msg,'reply_markup' => $keyboard]);
}
//////////------------------------\\\\\\\\\\\\\\ 
function sendmessage($chatID,$msg){
bot('sendMessage',['chat_id'=>$chatID,'text'=>$msg,'parse_mode'=>"html"]);
}
//////////------------------------\\\\\\\\\\\\\\
function save($filename, $data){
$file = fopen($filename, 'w');fwrite($file, $data);fclose($file);
}
//////////------------------------\\\\\\\\\\\\\\
function saveJson($file,$data){
$new_data = json_encode($data,true);file_put_contents($file,$new_data);
}
//////////------------------------\\\\\\\\\\\\\\
function GCMB($chatID){$data = bot('getChat',['chat_id'=>$chatID]);
return $data['ok'];
}
//////////------------------------\\\\\\\\\\\\\\
//////////------------------------\\\\\\\\\\\\\\
function top($number,$invite){
$usersscan = scandir('melat');
foreach ($usersscan as $userlist){
$users = json_decode(file_get_contents('melat/'.$userlist),true);
$userlistsave[$userlist] = $users[$invite]; } 
$chakhesh = $userlistsave; 
arsort($chakhesh,SORT_NUMERIC); 
$charkhesharray = array();
foreach ($chakhesh as $key=>$value){
$charkhesharray[] = $key;  }
$neshonbde = str_replace('.json','',$charkhesharray[$number]);
return $neshonbde;}
//##############دریافت اپدیت های ربات#####################################
$update = json_decode(file_get_contents('php://input'));
//################متغیر های کاربران################################
$message = $update->message;
$msg = $message->text;
$callback_query = $update->callback_query;
$data = $callback_query->data;
$shareing = $update->inline_query->query;
if(isset($message)){
$chatID = $message->chat->id;
$msg_id = $message->message_id;
$userID = $message->from->id;
$first_name = $message->from->first_name;
$username = $message->from->username;
$Tc = $message->chat->type;
}
if(isset($callback_query)){
$data_id = $callback_query->id;
$chatID = $callback_query->message->chat->id;
$inline_keyboard = $callback_query->message->reply_markup->inline_keyboard;
$userID = $callback_query->from->id;
$first_name = $callback_query->from->first_name;
$username = $callback_query->from->username;
$Tc = $callback_query->message->chat->type;
$msg_id = $callback_query->message->message_id;
}
//##################دیتای کاربران###############################
$user = json_decode(file_get_contents("melat/$userID.json"), true);
if($user["Points"] < 0 ){
$user["Points"] = "0";
saveJson("melat/$userID.json",$user);
}
if(isset($userID) and is_file("melat/$userID.json")){
$user = json_decode(file_get_contents("melat/$userID.json"),true);
$step = $user["step"];
$inv = $user["zirmjmae"];
$Points = $user["Points"];
$timer = $user["time-day"];
$dayaes = $user['days'];
$adss = $user['ads'];
$recivecoins = $user["enteghal_as"];
$sentcoins = $user["enteghal_to"];
$panels = $user['type-panel'];
$dates = $user['date-start'];
$sefaresh = $user["sefaresh"];
$warn = $user["warn"];
$coin_admin = $user["send-coin-admin"];
$invcoin = $user["zirmjmae-porsant"];
$invjoin = $user["zirmjmae-join"];
}
//=====================================================
if(is_file("lib/kodam/list.json")){
$list = json_decode(file_get_contents("lib/kodam/list.json"),true);
$ban = $list['ban'];
}
//=====================================================
if(in_array($chatID,$ban) and $userID != $list['admins']){
exit();
}
//////////------------------------\\\\\\\\\\\\\\/
if(file_exists("block")){
SM($chatID,"این ربات توسط کارگروه تعیین مصادیق بلاک شده است",'html');
exit();   
}
//=====================================================
//##############متغیر های اضافی#################################
$time = jdate("H:i:s");
$date = jdate("Y/m/d");
$channel = file_get_contents("lib/kodam/channel.txt");
$channel2 = file_get_contents("lib/kodam/channel2.txt");
$chads = file_get_contents("lib/kodam/cht.txt");
$giftch = file_get_contents("lib/kodam/giftch.txt");
$check = json_decode(file_get_contents("https://api.telegram.org/bot$tokens_bot/getChatMember?chat_id=@".$channel."&user_id=".$userID), true);
$check2 = json_decode(file_get_contents("https://api.telegram.org/bot$tokens_bot/getChatMember?chat_id=@".$channel2."&user_id=".$userID), true);
$stats = $check['result']['status'];
$stats2 = $check2['result']['status'];
$melat = json_decode(file_get_contents("melat.json"),true);
$member_online = $melat["members"];
//#######################################################
//function checkLeave($FromId){
if(!empty($userID) and $msg == "$dok5"){
$TimeStamp = date('Y-m-d', strtotime("-{$data_left['leftday']} day"));
foreach(glob('ads/*.json') as $ads){
$id = str_replace(['ads/', '.json'], '', $ads);
@$order = json_decode(file_get_contents("ads/$id.json"),true);
if($order['stamp']> strtotime($TimeStamp)){
if(bot('getChatMember', ['chat_id'=> "@{$order['channel']}", 'user_id'=> $userID])->result->status== 'left'){
if((in_array($userID, $order['members'])) && (!in_array($userID, $order['left']))){
$user = json_decode(file_get_contents("melat/$userID.json"),true);
$coin1 = $user['Points'] - $data_left['ksrleft'];
$user['Points'] = $coin1;
saveJson("melat/$userID.json",$user);
SM($userID, "به دلیل ترک @{$order['channel']} مقدار {$data_left['ksrleft']} $money از حساب شما کسر شد❗️", 'html');
$order['left'][]= "$userID";
saveJson("ads/$id.json",$order);
$datas2 = json_decode(file_get_contents("melat/{$order['admin']}.json"),true);
$coin2 = $datas2['Points'] + $data_left['afzleft'];
$datas2['Points'] = $coin2;
saveJson("melat/{$order['admin']}.json",$datas2);
SM($order['admin'], "کاربر {$userID} از @{$order['channel']} خارج شد و مقدار {$data_left['afzleft']} $money به حساب شما افزوده شد ✔️", 'html');
}}}}}
//#######################################################
function Spam($userID){
$spam_status = json_decode(file_get_contents("lib/spam/$userID.json"),true);
if($spam_status != null){
if(mb_strpos($spam_status[0],"time") !== false){
if(str_replace("time ",null,$spam_status[0]) >= time())
exit(false);
else
$spam_status = [1,time()+2];
}
elseif(time() < $spam_status[1]){
if($spam_status[0]+1 > 3){
$time = time() + 15;
$spam_status = ["time $time"];
file_put_contents("lib/spam/$userID.json",json_encode($spam_status,true));
bot('SendMessage',[
'chat_id'=>$userID,
'text'=>"⚠️کمی اهسته تر با ربات کار کنید

⛔️حساب شما به مدت ۱۵ ثانیه محدود شد",
]);
exit(false);
}else{
$spam_status = [$spam_status[0]+1,$spam_status[1]];
}}else{
$spam_status = [1,time()+2];
}}else{
$spam_status = [1,time()+2];
}
file_put_contents("lib/spam/$userID.json",json_encode($spam_status,true));
}
Spam($userID);
//#######################################################
if($warn >= 3){
bot('sendMessage',['chat_id'=>$chatID,'text'=>"📍 شما سه اخطار دریافت کردید و از ربات مسدود شدید",'parse_mode'=>"HTML",
]); exit();}
//#################کیبورد مدیریت###################################
$Button_Panel = json_encode(['keyboard'=>[
[['text'=>"⛔️ بلاک و آنبلاک کردن ✅"]],
[['text'=>"📈 آمار ربات"],['text'=>"📨 ارسال پیام"],['text'=>"♾‌دکمه ها"]],
[['text'=>"🎉 کد هدیه"],['text'=>"🏦 مبادلات $money"],['text'=>"📌ثبت سفارش"]],
[['text'=>"♻️پنـل ها"],['text'=>"🎯تغییر پنل"],['text'=>"👤ادمین ها"]],
[['text'=>"🆔آیدی یاب"],['text'=>"🏆 برترین اعضا"],['text'=>"🛍 فروشـگاه"]],
[['text'=>"⚠️اخطاردهی"],['text'=>"⚙️ زیرمجموعه گیری"],['text'=>"📇 تنظیم متن"]],
[['text'=>"🆔 تنظیم کانال"],['text'=>"🎗تکمیل سفارش"],['text'=>"🛐پیگیری کاربر"]],
[['text'=>"📚راهنـما"],['text'=>"⏳اشتراک باقی مانده"],['text'=>"♻️بروزرسانی"]],
[['text'=>"✂️تنظیمات لغو سفارش"],['text'=>"$icmoney تنظیمات انتقال $money"]],
[['text'=>"$back"],['text'=>"🔕خاموش و روشن🔔"]],
],'resize_keyboard'=>true]);
$Button_back_panel = json_encode(['keyboard'=>[
[['text'=>"🔙بازگشت به منو"]],
],'resize_keyboard'=>true]);
//##############دکمه منوی اصلی#################################
if(in_array($chatID,$list['admins'])){
$Button_Home = json_encode(['keyboard'=>[
[['text'=>"👤 پنل مدیریت 👤"]],
[['text'=>"$line1_1"],['text'=>"$line1_2"],['text'=>"$line1_3"],['text'=>"$line1_4"]],
[['text'=>"$line2_1"],['text'=>"$line2_2"],['text'=>"$line2_3"],['text'=>"$line2_4"]],
[['text'=>"$line3_1"],['text'=>"$line3_2"],['text'=>"$line3_3"],['text'=>"$line3_4"]],
[['text'=>"$line4_1"],['text'=>"$line4_2"],['text'=>"$line4_3"],['text'=>"$line4_4"]],
[['text'=>"$line5_1"],['text'=>"$line5_2"],['text'=>"$line5_3"],['text'=>"$line5_4"]],
[['text'=>"$line6_1"],['text'=>"$line6_2"],['text'=>"$line6_3"],['text'=>"$line6_4"]],
[['text'=>"$line7_1"],['text'=>"$line7_2"],['text'=>"$line7_3"],['text'=>"$line7_4"]],
[['text'=>"$line8_1"],['text'=>"$line8_2"],['text'=>"$line8_3"],['text'=>"$line8_4"]],
],'resize_keyboard'=>true]);
}else{
$Button_Home = json_encode(['keyboard'=>[
[['text'=>"$line1_1"],['text'=>"$line1_2"],['text'=>"$line1_3"],['text'=>"$line1_4"]],
[['text'=>"$line2_1"],['text'=>"$line2_2"],['text'=>"$line2_3"],['text'=>"$line2_4"]],
[['text'=>"$line3_1"],['text'=>"$line3_2"],['text'=>"$line3_3"],['text'=>"$line3_4"]],
[['text'=>"$line4_1"],['text'=>"$line4_2"],['text'=>"$line4_3"],['text'=>"$line4_4"]],
[['text'=>"$line5_1"],['text'=>"$line5_2"],['text'=>"$line5_3"],['text'=>"$line5_4"]],
[['text'=>"$line6_1"],['text'=>"$line6_2"],['text'=>"$line6_3"],['text'=>"$line6_4"]],
[['text'=>"$line7_1"],['text'=>"$line7_2"],['text'=>"$line7_3"],['text'=>"$line7_4"]],
[['text'=>"$line8_1"],['text'=>"$line8_2"],['text'=>"$line8_3"],['text'=>"$line8_4"]],
],'resize_keyboard'=>true]);
}
//##############################################################
$password = $_GET['password'];
$am = $_GET['coin'];
$amount = $_GET['amount'];
$hurice = number_format($amount);
$frmid = $_GET['from_id'];
$type = $_GET['type'];
$factor = $_GET['factor'];
$panel = $_GET['panel'];
$daypanel = $_GET['daypanel'];
if($password == "sendaction"){
$user2 = json_decode(file_get_contents("melat/$frmid.json"), 1);
//===================\\
if(!in_array($factor,$user2['factor'])){
if($type == "cucrobot-membergir-coin"){
$jtime = date("Y/m/d | H:i:s");
$coin = $user2['Points'] + $am;
$user2['Points']= $coin;
$user2['factor'][] = "$factor";
saveJson("melat/$frmid.json",$user2);
$dsepds = $shops + $amount; 
Save("lib/Button/shops.txt",$dsepds);
SM($frmid,"✅ پرداخت موفق\n$icmoney پرداخت شما به مبلغ $hurice ریال معادل $am $money پرداخت شد.\n\n💠 موجودی جدید شما: $coin $money\n⏱ زمان پرداخت: $jtime",'html');
SM($admin,"#خرید_موفق
💡> تعداد $am $money توسط کاربر $frmid خریداری شد !
💡> مبلغ $hurice ریال به کیف پول شما واریز شد !

جهت برداشت از کیف پول به پنل مدیریت ربات مراجعه کنید!",'html');
$lj = jdate('l'); //نام روز در هفته - کامل
$Fj = jdate('F'); //نام ماه از سال - کامل
$dj = jdate('d'); //شماره ی روز از ماه - ۲ رقمی
$yj = jdate('y'); //سال (به عدد) دو رقمی
$Hj = jdate('H:i'); //ساعت در روز - ۲۴ساعته -
$user3 = json_decode(file_get_contents("shop-factor.json"), 1);
$user3['factor']["$factor"]['fromid'] = $frmid;
$user3['factor']["$factor"]['coin'] = $am;
$user3['factor']["$factor"]['amount'] = $amount;
$user3['factor']["$factor"]['type'] = $type;
$user3['factor']["$factor"]['time'] = "📆 $lj $dj $Fj ۱۴$yj ⏰ $Hj";
saveJson("shop-factor.json",$user3);
}
//##########################################################
if($type == "cucrobot-membergir-panel"){
$jtime = date("Y/m/d | H:i:s");
if ($panel == 1) $caller = 'حرفه ای';
if ($panel == 2) $caller = 'ویژه';
$user2['type-panel'] = "$caller";
$user2['days'] = "$daypanel";
$user2['factor'][] = "$factor";
saveJson("melat/$frmid.json",$user2);
$dsepds = $shops + $amount; 
Save("lib/Button/shops.txt",$dsepds);
SM($frmid,"✅ پرداخت موفق
$icmoney پرداخت شما به مبلغ $hurice ریال برای پنل $caller پرداخت شد.

💠 پنل جدید شما: $caller معادل $daypanel روز
⏱ زمان پرداخت: $jtime",'html');
SM($admin,"#خرید_موفق
💡> پنل $caller معادل $daypanel روز توسط کاربر $frmid خریداری شد !
💡> مبلغ $hurice ریال به کیف پول شما واریز شد !

جهت برداشت از کیف پول به پنل مدیریت ربات مراجعه کنید!",'html');
$lj = jdate('l'); //نام روز در هفته - کامل
$Fj = jdate('F'); //نام ماه از سال - کامل
$dj = jdate('d'); //شماره ی روز از ماه - ۲ رقمی
$yj = jdate('y'); //سال (به عدد) دو رقمی
$Hj = jdate('H:i'); //ساعت در روز - ۲۴ساعته -
$user3 = json_decode(file_get_contents("shop-factor.json"), 1);
$user3['factor']["$factor"]['fromid'] = $frmid;
$user3['factor']["$factor"]['panel'] = "$caller-$daypanel";
$user3['factor']["$factor"]['amount'] = $amount;
$user3['factor']["$factor"]['type'] = $type;
$user3['factor']["$factor"]['time'] = "📆 $lj $dj $Fj ۱۴$yj ⏰ $Hj";
saveJson("shop-factor.json",$user3);
}}else{
SM($chatID,"فاکتور با شماره $factor منقضی شده است",'html');
}}
//##########################################################
if($databot['power']=='خاموش' && !in_array($userID,$list['admins'])){
if($databot['power-text']=='✅فعال'){
bot('sendMessage',['chat_id'=>$chatID,'text'=>"{$databot['powertext']}",'parse_mode'=>'HTML']);
}exit();}
//################استارت ربات#################################
if($msg == '/start' and $Tc == 'private'){
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"$starttext",
'parse_mode'=>'HTML',
'reply_to_message_id'=>$msg_id,
'reply_markup'=>$Button_Home
]);
if(!is_file("melat/$userID.json")){
$user["step"] = "none";
$user["date-start"] = "$date";
$user["zirmjmae"] = "0";
$user["type-panel"] = 'عادی';
$user['time-panel'] = '0';
$user["Points"] = "10";
$user["warn"] = "0";
$user["ads"] = "0";
$user['enteghal_as'] = 0;
$user['ENTEQALAT'] = null;
$user['enteghal_to'] = 0;
$user["send-coin-admin"] = "0";
$user["sefaresh"] = "0";
$user["sub"] = null;
$user["zirmjmae-porsant"] = "0";
$user["zirmjmae-join"] = "0";
$user['time-day'] = "0";
}else{
$user['step'] = 'none';
}
saveJson("melat/$userID.json",$user);
}
//###############استارت زیرمجموعه###############################
else if(strpos($msg , '/start ') !== false and $Tc == 'private'){
if($datazir["power"] == '✅فعال'){
$id = str_replace("/start ",null,$msg);
if(strpos($start,"-100") !== false or strpos($start,'@') !== false){
exit();
}
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"$starttext",
'parse_mode'=>'HTML',
'reply_to_message_id'=>$msg_id,
'reply_markup'=>$Button_Home
]);
if(!is_file("melat/$userID.json")){
$user["step"] = "none";
$user["date-start"] = "$date";
$user["zirmjmae"] = "0";
$user["type-panel"] = 'عادی';
$user['time-panel'] = '0';
$user["Points"] = "10";
$user["warn"] = "0";
$user["ads"] = "0";
$user['enteghal_as'] = 0;
$user['enteghal_to'] = 0;
$user['ENTEQALAT'] = null;
$user["send-coin-admin"] = "0";
$user["sefaresh"] = "0";
$user["sub"] = $id;
$user["zirmjmae-porsant"] = "0";
$user["zirmjmae-join"] = "0";
$user['time-day'] = "0";
saveJson("melat/$userID.json",$user);
if($datazir["Report"] == '✅فعال'){
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"کاربر $id با لینک $userID به ربات پیوست.",
'parse_mode'=>'HTML',
]);
}
$datas12 = json_decode(file_get_contents("melat/$id.json"),true);
$invite1 = $datas12["zirmjmae"];
settype($invite1,"integer");
$newinvite = $invite1 + 1;
$datas12["zirmjmae"] = $newinvite;
saveJson("melat/$id.json",$datas12);
//##########################
$datas1234 = json_decode(file_get_contents("melat/$id.json"),true);
$invite122 = $datas1234["Points"];
if($datas1234['type-panel'] == 'عادی'){
bot('sendMessage',[
'chat_id'=>$id,
'text'=>"اطلاعیه 👈 زیرمجموعه جدید 

یک کاربر با لینک فعال سازی شما عضو ربات شد و  $invitecoin1 $money به شما تعلق گرفت ✅

$icmoney همچنین $porsant $money پس از اولین عضویت زیرمجموعه تان به شما افزوده میشود.",
'parse_mode'=>"HTML",
]);
$newinvite664 = $invite122 + $invitecoin1;}
if($datas1234['type-panel'] == 'حرفه ای'){
bot('sendMessage',[
'chat_id'=>$id,
'text'=>"اطلاعیه 👈 زیرمجموعه جدید 

یک کاربر با لینک فعال سازی شما عضو ربات شد و  $invitecoin2 $money به شما تعلق گرفت ✅

$icmoney همچنین $porsant $money پس از اولین عضویت زیرمجموعه تان به شما افزوده میشود.",
'parse_mode'=>"HTML",
]);
$newinvite664 = $invite122 + $invitecoin2;}
if($datas1234['type-panel'] == 'ویژه'){
bot('sendMessage',[
'chat_id'=>$id,
'text'=>"اطلاعیه 👈 زیرمجموعه جدید 

یک کاربر با لینک فعال سازی شما عضو ربات شد و  $invitecoin3 $money به شما تعلق گرفت ✅

$icmoney همچنین $porsant $money پس از اولین عضویت زیرمجموعه تان به شما افزوده میشود.",
'parse_mode'=>"HTML",
]);
$newinvite664 = $invite122 + $invitecoin3;}
saveJson("melat/$id.json",$datas1234);}}}
//##################جویین اجباری#########################
elseif($stats != 'creator' and $stats != 'administrator' and $stats != 'member'and is_file("lib/kodam/channel.txt") and $chatID != $admin  and $Tc == 'private'){
if($stats2 != 'creator' and $stats2 != 'administrator' and $stats2 != 'member'and is_file("lib/kodam/channel2.txt") and $chatID != $admin  and $Tc == 'private'){
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"🔐 کاربر گرامی؛جهت ادامه کار در ربات و همچنین حمایت از سازنده ربات لطفا در کانال زیر عضو شوید.

🆔 @$channel
🆔 @$channel2

✅ پس از عضویت در ربات دستور /start را ارسال کنید.",
'reply_markup'=>json_encode([
'disable_web_page_preview' => true,
'parse_mode'=>"HTML",
'KeyboardRemove'=>[],
'remove_keyboard'=>true,
])]);exit();
}else{
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"🔐 کاربر گرامی؛جهت ادامه کار در ربات و همچنین حمایت از سازنده ربات لطفا در کانال زیر عضو شوید.

🆔 @$channel
🆔 @$channel

✅ پس از عضویت در ربات دستور /start را ارسال کنید.",
'reply_markup'=>json_encode([
'disable_web_page_preview' => true,
'parse_mode'=>"HTML",
'KeyboardRemove'=>[],
'remove_keyboard'=>true,
])]);exit();}}
if($stats2 != 'creator' and $stats2 != 'administrator' and $stats2 != 'member' and is_file("lib/kodam/channel2.txt") and $chatID != $admin  and $Tc == 'private'){
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"🔐 کاربر گرامی؛جهت ادامه کار در ربات و همچنین حمایت از سازنده ربات لطفا در کانال زیر عضو شوید.

🆔 @$channel2
🆔 @$channel2

✅ پس از عضویت در ربات دستور /start را ارسال کنید.",
'reply_markup'=>json_encode([
'disable_web_page_preview' => true,
'parse_mode'=>"HTML",
'KeyboardRemove'=>[],
'remove_keyboard'=>true,
])]);exit();}
//##################بازگشت به منوی اصلی##########################
elseif($msg == "$back" and $Tc == 'private'){
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
bot('sendmessage',['chat_id'=>$chatID,'text'=>"$starttext",'parse_mode'=>'Markdown', 'reply_markup'=>$Button_Home]);
}
//################دریافت الماس رایگان##########################
elseif($msg == "$dok1" and $Tc == 'private'){
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"$doktxt1",
'parse_mode'=>'HTML',
'reply_markup'=>json_encode([
'inline_keyboard' => [ 
[["text"=>"$dokday", 'callback_data'=>"dailygiftt"],["text" => "$dokchannel", 'url' => "https://t.me/$chads"]],
]])]);
}
//################الماس روزانه#############################
else if($data == "dailygiftt"){
$times = time();
if($times >= $timer){
$user['step'] = 'none';
//##########################
if($user['type-panel'] == 'عادی'){
bot('answercallbackquery', [
'callback_query_id' => $data_id,
'text' => "✅ تبریک!
👈 برای امروز به شما $mdailys1 $money هدیه تعلق گرفت
برای دریافت مجدد $money فردا مجدد امتحان کنید",
'show_alert' => true
]);
$mdailys = $Points + $mdailys1;}
if($user['type-panel'] == 'حرفه ای'){
bot('answercallbackquery', [
'callback_query_id' => $data_id,
'text' => "✅ تبریک!
👈 برای امروز به شما $mdailys2 $money هدیه تعلق گرفت
برای دریافت مجدد $money فردا مجدد امتحان کنید",
'show_alert' => true
]);
$mdailys = $Points + $mdailys2;}
if($user['type-panel'] == 'ویژه'){
bot('answercallbackquery', [
'callback_query_id' => $data_id,
'text' => "✅ تبریک!
👈 برای امروز به شما $mdailys3 $money هدیه تعلق گرفت
برای دریافت مجدد $money فردا مجدد امتحان کنید",
'show_alert' => true
]);
$mdailys = $Points + $mdailys3;}
//###########################
$user['Points'] = $mdailys;
$user['time-day'] = $times + 86400;
saveJson("melat/$userID.json",$user);
}else{
bot('answercallbackquery', [
'callback_query_id' => $data_id,
'text' => "
شما قبلا هدیه روزانه خود را دریافت کردید",
'show_alert' => false
]);
}}
//##############حساب کاربری######################################
elseif($msg == "$dok2" and $Tc == 'private'){
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
if($user['type-panel'] == 'عادی'){
$userinfotext = "
🔰شماره کاربری : $userID
📆تاریخ عضویت : $dates
♻️نوع پنل : $panels
⌛️ اعتبار پنل : نامحدود

⚠️اخطار : $warn از 3
✔️ تعداد سفارشات : $sefaresh تا
🔷 تعداد عضویت : $adss
🎁هدیه مدیریت : $coin_admin

💳 انتقالات 
📥دریافتی : $recivecoins
📤واریزی : $sentcoins

👥 زیر مجموعه ها
✔️ مجموع : $inv
✔️ تعداد عضویت : $invjoin
✔️ پورسانت دریافتی : $invcoin

✅ موجودی : $Points
";
}else{
$userinfotext = "
🔰شماره کاربری : $userID
📆تاریخ عضویت : $dates
♻️نوع پنل : $panels
⌛️ اعتبار پنل : {$user['time-panel']} روز

⚠️اخطار : $warn از 3
✔️ تعداد سفارشات : $sefaresh تا
🔷 تعداد عضویت : $adss
🎁هدیه مدیریت : $coin_admin

💳 انتقالات 
📥دریافتی : $recivecoins
📤واریزی : $sentcoins

👥 زیر مجموعه ها
✔️ مجموع : $inv
✔️ تعداد عضویت : $invjoin
✔️ پورسانت دریافتی : $invcoin

✅ موجودی : $Points
";
}
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"$userinfotext",
'parse_mode'=>"html",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text' => "به اشتراک گذاشتن کد کاربری","switch_inline_query"=>"ShareCodeUser"]],
]])]); 
}
//###################اشتراک کد کاربری به صورت اینلاین###########################
elseif($shareing == "ShareCodeUser"){
$usershare = $update->inline_query->from->id;
bot("answerInlineQuery",[
"inline_query_id"=>$update->inline_query->id,
"results"=>json_encode([[
"type"=>"article",
"id"=>base64_encode(rand(5,555)),
"title"=>"اشتراک گذاری کد کاربری",
"input_message_content"=>["parse_mode"=>"html","message_text"=>"$usershare
کد کاربری من در ربات @$boter_id"],
]])]);
}
//#######################ثبت سفارش############################
else if($msg == "$dok3"  and $Tc == 'private'){
if($data_ads['Lock-sabtads']=='❌غیر فعال'){
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
if($orderkey == 1){
$Button_MemOrder = json_encode([
'inline_keyboard' => [
[["text" => "$dokt2", 'callback_data' => "cr-$mmbrsabt2-$mmbrsabt22-$mmbrs2"],["text" => "$dokt1", 'callback_data' => "cr-$mmbrsabt1-$mmbrsabt11-$mmbrs1"]],
[["text" => "$dokt4", 'callback_data' => "cr-$mmbrsabt4-$mmbrsabt44-$mmbrs4"],["text" => "$dokt3", 'callback_data' => "cr-$mmbrsabt3-$mmbrsabt3-$mmbrs3"]],
[["text" => "$dokt6", 'callback_data' => "cr-$mmbrsabt6-$mmbrsabt66-$mmbrs6"],["text" => "$dokt5", 'callback_data' => "cr-$mmbrsabt5-$mmbrsabt55-$mmbrs5"]],
]]);
}
if($orderkey == 2){
$Button_MemOrder = json_encode([
'inline_keyboard' => [
[["text" => "$dokt1", 'callback_data' => "cr-$mmbrsabt1-$mmbrsabt11-$mmbrs1"]],
[["text" => "$dokt2", 'callback_data' => "cr-$mmbrsabt2-$mmbrsabt22-$mmbrs2"],["text" => "$dokt3", 'callback_data' => "cr-$mmbrsabt3-$mmbrsabt33-$mmbrs3"]],
[["text" => "$dokt4", 'callback_data' => "cr-$mmbrsabt4-$mmbrsabt44-$mmbrs4"],["text" => "$dokt5", 'callback_data' => "cr-$mmbrsabt5-$mmbrsabt55-$mmbrs5"]],
[["text" => "$dokt6", 'callback_data' => "cr-$mmbrsabt6-$mmbrsabt66-$mmbrs6"]],
]]);
}
if($orderkey == 3){
$Button_MemOrder = json_encode([
'inline_keyboard' => [
[["text" => "$dokt1", 'callback_data' => "cr-$mmbrsabt1-$mmbrsabt11-$mmbrs1"]],
[["text" => "$dokt2", 'callback_data' => "cr-$mmbrsabt2-$mmbrsabt22-$mmbrs2"]],
[["text" => "$dokt3", 'callback_data' => "cr-$mmbrsabt3-$mmbrsabt33-$mmbrs3"]],
[["text" => "$dokt4", 'callback_data' => "cr-$mmbrsabt4-$mmbrsabt44-$mmbrs4"]],
[["text" => "$dokt5", 'callback_data' => "cr-$mmbrsabt5-$mmbrsabt55-$mmbrs5"]],
[["text" => "$dokt6", 'callback_data' => "cr-$mmbrsabt6-$mmbrsabt66-$mmbrs6"]],
]]);
}
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"$doktxt3",
'parse_mode'=>'HTML',
'reply_to_message_id'=>$msg_id,
'reply_markup'=>$Button_MemOrder]);
}else{
bot('sendMessage', [
'chat_id' => $chatID,
'text'=>"✔️ثبت سفارش موقتا غیر فعال است",
]);
}}
//#####################زیرمجموعه گیری################################
elseif($msg=="$dok4" and $Tc == 'private'){
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"$doktxt4",
'parse_mode'=>'HTML',
'reply_markup'=>json_encode([
 "resize_keyboard"=>true,'one_time_keyboard' => true,
'inline_keyboard' => [
[['text' => "📌دریافت بنر زیرمجموعه گیری", 'callback_data' => "banerzir"]],
]])]);
}
//######################دریافت بنر زیرمجموعه#########################
elseif($data == "banerzir"){
if($datazir["banerzir"] == '🖼عکس دار'){
if($piclink != null){
bot('sendphoto',[
 'chat_id'=>$chatID,
 'photo'=>$piclink,
 'caption'=>"$zirtext\n\nhttps://t.me/$boter_id?start=$chatID",
 ]);
}else{
bot('sendMessage',['chat_id'=>$chatID,'text'=>"عکس این بخش باید از پنل مدیریت تنظیم شود",'parse_mode'=>"MarkDown",]);}}
if($datazir["banerzir"] == '📝متنی'){
bot('sendMessage',['chat_id'=>$chatID,'text'=>"$zirtext\n\nhttps://t.me/$boter_id?start=$chatID",'parse_mode'=>"MarkDown",]);}}
//######################بانگ انتقال########################################
elseif($msg == "$dok5" and $Tc == 'private'){
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"$doktxt5",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"تاریخچه دریافت"],['text'=>"تاریخچه انتقال"],['text'=>"انتقال $money"]],
[['text'=>"$back"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,])]);}
//#####################انتقال الماس######################################
elseif($msg == "انتقال $money" and $Tc == 'private'){
if($transfer["Condition"] == '✅فعال'){
$user['step'] = 'sendcoin';
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"✅ شماره کاربری فرد مورد نظر که قصد انتقال $money به آن را دارید وارد کنید

⚠️ شماره کاربری هر شخص در قسمت حساب کاربری قابل دریافت است",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>null,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"$back"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
])]);
saveJson("melat/$userID.json",$user);
}else{
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"این بخش غیرفعال است",
'parse_mode' => "MarkDown",
]);}}
//########################تاریخچه دریافت###############################
else if($msg == "تاریخچه دریافت" and $Tc == 'private'){
$PERTI = count($user["daryafti"]);
if($PERTI == '0'){
$user['step'] = 'none';
SM($chatID,"تاریخچه ای وجود ندارد",'html',null);
saveJson("melat/$userID.json",$user);	
}else{
$user['step'] = 'none';
$i = 0;
foreach ($user['daryafti'] as $b0y){
$PERTI = count($user["daryafti"]);
if ($i == $PERTI){
break;
}
$amunt = explode('|',$b0y)[0];
$cholate = explode('|',$b0y)[1];
$rnd = explode('|',$b0y)[2];
$mylist = $mylist.= "

شماره کاربر ارسال کننده : $amunt
 تاریخ انتقال : $cholate
مقدار $money دریافت شده : $rnd
-----------------------\n";
$i++;
}
SM($chatID,"$mylist",'html',null);
saveJson("melat/$userID.json",$user);
}}
//######################تاریخچه انتقال#####################################
else if($msg == "تاریخچه انتقال" and $Tc == 'private'){
$PERTI = count($user["ENTEQALAT"]);
if($PERTI == '0'){
$user['step'] = 'none';
SM($chatID,"تاریخچه ای وجود ندارد",'html',null);
saveJson("melat/$userID.json",$user);	
}else{
$user['step'] = 'none';
$i = 0;
foreach ($user['ENTEQALAT'] as $b0y){
$PERTI = count($user["ENTEQALAT"]);
if ($i == $PERTI){
break;
}
$amunt = explode('|',$b0y)[0];
$cholate = explode('|',$b0y)[1];
$rnd = explode('|',$b0y)[2];
$mylist = $mylist.= "
شماره کاربر دریافت کننده : $amunt
 تاریخ انتقال : $cholate
مقدار $money انتقال داده شده : $rnd
-----------------------\n";
$i++;
}
SM($chatID,"$mylist",'html',null);
saveJson("melat/$userID.json",$user);
}}
//##########################################################################
else if($step == 'sendcoin' and $Tc == 'private'){
$msg_txt = bot('sendMessage', [
'chat_id' => $chatID,
'text' => "در حال دریافت اطلاعات شما از سرور...",
'reply_to_message_id' => null,
])->result->message_id;
sleep(1.5);
$user['step'] = "transfer-$msg";
bot('editMessageText',[ 
'chat_id'=>$chatID, 
'message_id'=>$msg_txt, 
'text'=>"
چه تعداد $money میخواهید انتقال دهید؟

👈🏼حداقل مقدار مجاز انتقال  {$transfer["mintrnfr"]} $money میباشد 
✅حداکثر انتقال مجاز برای شما : {$transfer["maxtrnfr"]}
$icmoney موجودی شما : $Points
", 
]); 
saveJson("melat/$userID.json",$user);
}
//##########################################################################
elseif(preg_match('/^transfer-(.*)/', $step, $match)){
if($transfer["Condition"] == '✅فعال'){
if(preg_match('/^([0-9])/',$msg)){
if(preg_match('/^([0-9])/',$match[1]) and is_file("melat/$match[1].json") and $match[1] != $userID){
if(preg_match('/^([0-9])/',$msg) and $Points >= "$msg" and $msg > $transfer["mintrnfr"] and $msg <= $transfer["maxtrnfr"]){
$user = json_decode(file_get_contents("melat/{$userID}.json"), 1);
$coin = $Points - $msg;
$user['Points'] = $coin;
$Poiplus = $user['enteghal_to'] + $msg;
$user['enteghal_to'] = $Poiplus;
saveJson("melat/$userID.json",$user);
$user['ENTEQALAT'][] = "$match[1]|$date|$msg";
bot('sendmessage',[ 
'chat_id'=>$chatID,
'text'=>"✅ تعداد $msg $money در تاریخ $date ساعت $time با موفقیت به کاربر {$match[1]} انتقال داده شد.",
'reply_to_message_id'=>$msg_id,
  'reply_markup'=>$Button_Home
]);
if($transfer["Report"] == '✅فعال'){
bot('sendmessage',[ 
'chat_id'=>$admin,
'text'=>"
تعداد $msg $money از $userID به کاربر {$match[1]} منتقل شد",
]);
}
$users = json_decode(file_get_contents("melat/$match[1].json"),true);
$getusercoin = $users['Points'] + $msg;
$users['Points'] = $getusercoin;
$Poiplus = $users['enteghal_as'] + $msg;
$users['enteghal_as'] = $Poiplus;
bot('sendmessage',[ 
'chat_id'=>$match[1],
'text'=>"✅ تعداد $msg $money در تاریخ $date ساعت $time با موفقیت از کاربر $userID دریافت شد.",
]);
$users['daryafti'][] = "$userID|$date|$msg";
saveJson("melat/$match[1].json",$users);
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
}else{
bot('sendmessage',[ 
'chat_id'=>$chatID,
'text'=>"⚠️ تعداد $money های شما برای انتقال کافی نمیباشد !

👈🏼حداقل مقدار مجاز انتقال  10 $money میباشد 
✅حداکثر انتقال مجاز برای شما : 1000",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>$Button_Home
]);
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
}}else{
bot('sendmessage',[ 
'chat_id'=>$chatID,
'text'=>"⚠️ فردی با شناسه کاربری وارد شده در ربات یافت نشد ! لطفا شناسه فرد را با دقت وارد کنید
🎫 شناسه کاربری هر فرد در قسمت حساب من درج شده است  .",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>$Button_Home
]);
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
}}else{
bot('sendmessage',[ 
'chat_id'=>$chatID,
'text'=>"شما حداقل میتونید 10 $money انتقال بدید",
]);}}}
//###############بخش پیگیری####################################
elseif($msg == "$dok6" and $Tc == 'private'){
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"$doktxt6",
'parse_mode'=>"HTML",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$dokp1", 'callback_data'=> 'payorders']],
[['text'=>"$dokp2", 'callback_data'=> 'cancelorders'],['text'=>"$dokp3", 'callback_data'=> 'rules']],
]])]);}
//#################برگشت به پیگیری سفارش##############################
elseif($data == "backpaybutton"){
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"👈️ گزینه مورد نظر را انتخاب نمائید.",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$dokp1", 'callback_data'=> 'payorders']],
[['text'=>"$dokp2", 'callback_data'=> 'cancelorders'],['text'=>"$dokp3", 'callback_data'=> 'rules']],
]])]);}
//###################پیگیری سفارش############################
elseif($data == "payorders"){
$chatID = $update->callback_query->message->chat->id; 
if(!isset($user['ads-id'][0])){
$user['step'] = 'none';
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"سفارشی یافت نشد",
'parse_mode'=>"HTML",
]);
saveJson("melat/$userID.json",$user);
}else{
foreach (str_replace('.json',NULL,array_diff(scandir('ads'),['.','..'])) as $rand){
if (json_decode(file_get_contents('ads/'.$rand.'.json'),true)['admin'] == $userID){
$order = json_decode(file_get_contents("ads/$rand.json"),true);
$blk = count($order['members'])-1;
$left = count($order['left'])-1;
if($data_Cancellads["Condition"] == '✅فعال'){
$Vaue = $Vaue . "❇️ شماره سفارش: $rand
🌐 آیدی کانال : @{$order['channel']}
📆 تاریخ درخواست: {$order['date']}
⏰ساعت درخواست: {$order['time']}
⏳ ممبر درخواستی: {$order['member']}
👥️ ممبردریافتی: $blk
💔تعداد لفت ها : $left
‍📇مشاهده سفارش : /ord_$rand
❌لغو سفارش : /cancel_$rand
‼️ وضعیت سفارش: {$order['stats']}
—----------------------------
";
}else{
$Vaue = $Vaue . "❇️ شماره سفارش: $rand
🌐 آیدی کانال : @{$order['channel']}
📆 تاریخ درخواست: {$order['date']}
⏰ساعت درخواست: {$order['time']}
⏳ ممبر درخواستی: {$order['member']}
👥️ ممبردریافتی: $blk
💔تعداد لفت ها : $left
‍📇مشاهده سفارش : /ord_$rand
‼️ وضعیت سفارش: {$order['stats']}
—----------------------------
";
}}}
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"سفارشات اخیر شما:
$Vaue",
'parse_mode' => "html",
'reply_markup' => json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backpaybutton"]],
]])]);}}
//##########################################################################
elseif(strpos($msg,"/ord_") !== false  and $Tc == 'private'){
$id = str_replace("/ord_","",$msg);
if(is_file("ads/$id.json")){
$order = json_decode(file_get_contents("ads/$id.json"),true);
if($userID == $order['admin']){
if($order['stats'] == 'در حال اجرا ♻️'){
bot('ForwardMessage',[
'chat_id'=>$userID,
'from_chat_id'=>"@$chads",
'message_id'=>$order['postid'],
]);
}else{
$user['step'] = 'none';
SM($chatID,"👈🏻 این سفارش فعال نمیباشد",'html',$Button_Home);
saveJson("melat/$userID.json",$user);
}}else{
$user['step'] = 'none';
SM($chatID,"👈🏻 این سفارش متعلق به شما نمیباشد",'html',$Button_Home);
saveJson("melat/$userID.json",$user);
}}else{
$user['step'] = 'none';
SM($chatID,"👈🏻 کد پیگیری سفارش نامعتبر میباشد",'html',$Button_Home);
saveJson("melat/$userID.json",$user);
}}
//##########################################################################
elseif(strpos($msg,"/cancel_") !== false  and $Tc == 'private'){
if($data_Cancellads["Condition"] == '✅فعال'){
$id = str_replace("/cancel_","",$msg);
if(is_file("ads/$id.json")){
$order = json_decode(file_get_contents("ads/$id.json"),true);
if($userID == $order['admin']){
if($order['stats'] == 'در حال اجرا ♻️'){
$msgid = bot('ForwardMessage',[
'chat_id'=>$userID,
'from_chat_id'=>"@$chads",
'message_id'=>$order['postid'],
])->result->message_id;
$Buton_poin = json_encode(['inline_keyboard'=>[
[['text'=>"✅بله",'callback_data'=>"cancell-$id"],['text'=>"❌خیر",'callback_data'=>'backpaybutton']],
]]);
SM($chatID,"⁉️آیا مایل به لغو این تبلیغ هستید؟

⚠️توجه داشته باشید با ضریب {$data_Cancellads["Coefficientadscoin"]} معادل بازدید های باقی مانده $money به حساب شما بازگشت داده خواهد شد",'html',$msgid,$Buton_poin);
}else{
$user['step'] = 'none';
SM($chatID,"👈🏻 این سفارش فعال نمیباشد",'html',$Button_Home);
saveJson("melat/$userID.json",$user);
}}else{
$user['step'] = 'none';
SM($chatID,"👈🏻 این سفارش متعلق به شما نمیباشد",'html',$Button_Home);
saveJson("melat/$userID.json",$user);
}}else{
$user['step'] = 'none';
SM($chatID,"👈🏻 کد پیگیری سفارش نامعتبر میباشد",'html',$Button_Home);
saveJson("melat/$userID.json",$user);
}}}
//##########################################################################
elseif(preg_match('/^cancell-(.*)/', $data, $match)){
if($data_Cancellads["Condition"] == '✅فعال'){
$order = json_decode(file_get_contents("ads/$match[1].json"),true);
if($order['member'] >= $data_Cancellads['mincancell']){
$timecreate = $order['time-cancell'] + $data_Cancellads['timecancell'];
if($time45 >= $timecreate){
$coins = $order['Points'] - $order['tedad'];
$coin = $coins * $data_Cancellads["Coefficientadscoin"];
Editmessagetext($chatID, $msg_id,"تبلیغ شما با موفقیت لغو شد و مقدار $coin $money به حساب  شما بازگردانده شد ✅
",null);
bot('deletemessage', [
'chat_id' =>"@$chads",
'message_id' => "{$order['postid']}"
]);
$order['stats'] = 'کنسل شده❌';
//========
file_put_contents("ads/$match[1].json", json_encode($order, 448));
$ustart = json_decode(file_get_contents("melat/$userID.json"),true);
$Pointsplus = $ustart['Points'] + $coin;
$ustart['Points'] = $Pointsplus;
saveJson("melat/$userID.json",$ustart);
}else{
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"⚠️شما بعد از گذشت {$data_Cancellads['timecancell']} ثانیه از سفارش امکان لغو سفارش را دارید",
'parse_mode' => "html",
]);
}}else{
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"❌خطا

👈🏼درصورتی که سفارش شما کمتر از {$data_Cancellads['mincancell']} ممبر باشد امکان لغو تبلیغ را ندارید",
'parse_mode' => "html",
]);
}}}
//################ارتباط با ما#############################
elseif($data == "cancelorders"){
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"یکی از گزینه های زیر را انتخاب نمایید👇",
'parse_mode' => "html",
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text'=>"📮ارسال پیام", 'callback_data'=> '0'],['text'=>"✉️ صندوق پیام", 'callback_data'=> '0']],
[["text"=>"➡️ بازگشت", 'callback_data' => "backpaybutton"]],
]])]);
}
//###############ارتقا پنل################################
elseif($msg == "$dok7" and $Tc == 'private'){
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"$doktxt7",
'parse_mode'=>"HTML",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"♻️پنل فعلی شما : $panels ♻️", 'callback_data'=> '0']],
[['text'=>"💢 ارتقا به پنل حرفه ای 💢", 'callback_data'=> "panel-حرفه ای-$coinpanel1"]],
[['text'=>"🌀 ارتقا به پنل ویژه🌀", 'callback_data'=> "panel-ویژه-$coinpanel2"]],
]])]);
}
//##############ارتقا به پنل###############################
elseif(preg_match('/^panel-(.*)-(.*)/', $data, $match)){
if($user["zirmjmae"] >= $match[2]){
bot('answercallbackquery', [
'callback_query_id' => $data_id,
'text' => "🎉تبریک

پنل شما با موفقیت به پنل $match[1] ارتقا یافت
",
'show_alert' => true
]);
bot('EditMessageReplyMarkup',[
'chat_id'=>$chatID,
'message_id'=>$msg_id,
	'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"♻️پنل فعلی شما : {$match[1]} ♻️", 'callback_data'=> '0']],
[['text'=>"💢 ارتقا به پنل حرفه ای 💢", 'callback_data'=> "panel-حرفه ای-$coinpanel1"]],
[['text'=>"🌀 ارتقا به پنل ویژه🌀", 'callback_data'=> "panel-ویژه-$coinpanel2"]],
]])]);
$user['type-panel'] = "$match[1]";
$user['zirmjmae'] = $inv - $match[2];
saveJson("melat/$userID.json",$user);
}else{
bot('answercallbackquery', [
'callback_query_id' => $data_id,
'text' => "❌خطا
برای ارتقا به پنل $match[1] باید $match[2] زیرمجموعه داشته باشید
",
'show_alert' => true
]);
}}
//##################برترین عا#############################
elseif($msg == "$dok8" and $Tc == 'private'){
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"$doktxt8",
'parse_mode' => "html",
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text'=>"$best1", 'callback_data'=> 'best1']],
[['text'=>"$best2", 'callback_data'=> 'best2'],['text'=>"$best3", 'callback_data'=> 'best3']],
]])]);
}
//################بازگشت به برترین ها###############################
elseif($data == "backbestsbutton"){
$chatID = $update->callback_query->message->chat->id; 
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"تمایل به مشاهده برترین کاربران کدام بخش دارید؟",
'parse_mode' => "html",
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text'=>"$best1", 'callback_data'=> 'best1']],
[['text'=>"$best2", 'callback_data'=> 'best2'],['text'=>"$best3", 'callback_data'=> 'best3']],
]])]);
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
}
//======//
//////////------------------------\\\\\\\\\\\\\\///
else if($data == 'best1' and $Tc == 'private'){
$Buttonoin = json_encode(['inline_keyboard'=>[
[['text'=>"🔙 بازگشت",'callback_data'=>'backbestsbutton']],
]]);
for ($t=1;$t<=10;$t++){
$users = json_decode(file_get_contents('melat/' . top($t,'zirmjmae') . '.json'),true);
$invite = $users['zirmjmae'];
$getid = top($t,'zirmjmae');
if ($invite == ''){
$invite = 0;
} else {
$invite = $invite;
}
if ($getid == ''){
$getid = 0;
} else {
$getid = $getid;
}
$textbartar = $textbartar .= "♾ شماره کاربری : $getid
👤 تعداد جذب زیر مجموعه : $invite\n\n
";
}
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"🏆 برترین کاربران در زیرمجموعه گیری 🏆
$textbartar
",
'parse_mode' => "html",
'reply_markup' => json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backbestsbutton"]],
]])]);}
//==========[تعداد عضویت]==============//
elseif($data == "best2"){
for ($t=1;$t<=10;$t++){
$users = json_decode(file_get_contents('melat/' . top($t,'ads') . '.json'),true);
$invite = $users['ads'];
$getid = top($t,'ads');
if ($invite == ''){
$invite = 0;
} else {
$invite = $invite;
}
if ($getid == ''){
$getid = 0;
} else {
$getid = $getid;
}
$textbartar = $textbartar .= "♾ شماره کاربری : $getid
👤 تعداد عضویت : $invite\n\n
";
}
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"🏆 برترین کاربران عضویت کانال 🏆
$textbartar",
'parse_mode' => "html",
'reply_markup' => json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backbestsbutton"]],
]])]);}
//==========[تعداد ثبت تبلیغ]==============//
elseif($data == "best3"){
for ($t=1;$t<=10;$t++){
$users = json_decode(file_get_contents('melat/' . top($t,'sefaresh') . '.json'),true);
$invite = $users['sefaresh'];
$getid = top($t,'sefaresh');
if ($invite == ''){
$invite = 0;
} else {
$invite = $invite;
}
if ($getid == ''){
$getid = 0;
} else {
$getid = $getid;
}
$textbartar = $textbartar .= "♾ شماره کاربری : $getid
👤 تعداد سفارشات : $invite\n\n
";
}
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"🏆 برترین کاربران در ثبت سفارش 🏆
$textbartar",
'parse_mode' => "html",
'reply_markup' => json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backbestsbutton"]],
]])]);}
//###############فروشگاه##################################
elseif($msg == "$dok9" and $Tc == 'private'){
if($user['phone'] != null){
$Button_Shop = json_encode(['inline_keyboard'=>[
[["text"=>"$money$icmoney", 'callback_data' => "shop-coin"],["text"=>"♻️خرید پنل♻️", 'callback_data' => "shop-panel"]],
],'resize_keyboard'=>true]); 
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"$doktxt9",
'parse_mode'=>"HTML",
'reply_to_message_id'=>null,
'reply_markup'=>$Button_Shop]);
}else{
$user['step'] = "phone";
saveJson("melat/$userID.json",$user);
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"📱 لطفا شماره موبایل خود را تایید نمایید.

⚠️ طبق دستور پلیس فتا جهت جلوگیری از خرید با کارت های جعلی و دزدی و همچنین احراز هویت نیاز است شماره تلفن خود را تایید نمایید.

✔️ شماره تلفن شما نزد ما محفوظ است و هیچ شخصی به آن دسترسی نخواهد شد..",
'reply_markup' => json_encode([
'resize_keyboard'=>true,
'keyboard' => [
 [['text'=>"⏳تایید شماره⏳",'request_contact'=>true],['text'=>"$back"]],
],])]);}}
//################################################################
if($data == "shop-back"){
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"$doktxt9",
'parse_mode' => "html",
'reply_markup' =>json_encode(['inline_keyboard'=>[
[["text"=>"$money$icmoney", 'callback_data' => "shop-coin"],
["text"=>"♻️خرید پنل♻️", 'callback_data' => "shop-panel"]],

],'resize_keyboard'=>true])]);}
//#################تایید شماره###############################
elseif($step == "phone" and isset($message->contact)){
if($update->message->contact->user_id == $userID){
$phone_number =$message->contact->phone_number;
if (substr($phone_number,0,-10) == '98'){
$user['phone'] = "$phone_number";
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
SendMessage($userID,"✅ شماره تلفن شما با موفقیت ثبت و احراز هویت انجام شد.",$msg_id);
bot('sendmessage',[
'chat_id'=>$userID,
'text'=>"👇",
'parse_mode'=>"HTML",
'reply_markup'=>$Button_Home]);
}else{
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
bot('sendmessage',[
'chat_id'=>$userID,
'text'=>"🇮🇷 فقط از شماره ایران جهت تایید هویت خود استفاده کنید.",
'parse_mode'=>"HTML",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>$Button_Home]);
}}else{
bot('sendmessage',[
'chat_id'=>$userID,
'text'=>"فقط از دکمه زیر میتوانید هویت خود را تایید کنید",
'reply_markup' => json_encode([
'resize_keyboard'=>true,
'keyboard' => [
 [['text'=>"⏳تایید شماره⏳",'request_contact'=>true],['text'=>"$back"]],
],])]);}}
//################################################################
if($data == "shop-coin"){
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"$shoptxt1",
'parse_mode' => "html",
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text'=>"$aytem1",'callback_data'=>"shop-$coinshop1-$amount1"]],
[['text'=>"$aytem2",'callback_data'=>"shop-$coinshop2-$amount2"]],
[['text'=>"$aytem3",'callback_data'=>"shop-$coinshop3-$amount3"]],
[['text'=>"$aytem4",'callback_data'=>"shop-$coinshop4-$amount4"]],
[['text'=>"$aytem5",'callback_data'=>"shop-$coinshop5-$amount5"]],
[["text"=>"➡️ بازگشت", 'callback_data' => "shop-back"]],
]])]);}
elseif(preg_match('/^shop-(.*)-(.*)/', $data, $match)){
$link = "https://roz-robot.ir/PayLink/api.php?from_id=$userID&&amount={$match[2]}&&type=cucrobot-membergir-coin&&coin={$match[1]}&&robot=$botsaz_id&&username=$boter_id";
bot('answercallbackquery', [
'callback_query_id' => $data_id,
'text' => "♻️در حال ساخت لینک پرداخت....",
'show_alert' => false
]);
$get = file_get_contents($link);
$array = json_decode($get,true);
$links = $array['link'];
$Buttonshop = json_encode(['inline_keyboard'=>[
[['text'=>"پرداخت",'url'=>"$links"]],
]]);
SM($chatID,"لینک پرداخت برای شما با موفقیت ساخته شد✅

⚠️لینک پرداخت پس از چند دقیقه منقضی می شود و تنها یکبار قابل استفاده است",'html',null,$Buttonshop);
}
//################################################################
if($data == "shop-panel"){
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"$shoptxt2",
'parse_mode' => "html",
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text'=>"$aytems1",'callback_data'=>"panelshop-حرفه ای-$daypanel1-$amounts1"]],
[['text'=>"$aytems2",'callback_data'=>"panelshop-ویژه-$daypanel2-$amounts2"]],
[['text'=>"$aytems3",'callback_data'=>"panelshop-حرفه ای-$daypanel3-$amounts3"]],
[['text'=>"$aytems4",'callback_data'=>"panelshop-ویژه-$daypanel4-$amounts4"]],
[["text"=>"➡️ بازگشت", 'callback_data' => "shop-back"]],
]])]);}
elseif(preg_match('/^panelshop-(.*)-(.*)-(.*)/', $data, $match)){
if ($match[1] == 'حرفه ای') $caller = 1;
if ($match[1] == 'ویژه') $caller = 2;
$link = "https://roz-robot.ir/PayLink/api.php?from_id=$userID&&amount={$match[3]}&&type=cucrobot-membergir-panel&&panel=$caller&&daypanel={$match[2]}&&robot=$botsaz_id&&username=$boter_id";
bot('answercallbackquery', [
'callback_query_id' => $data_id,
'text' => "♻️در حال ساخت لینک پرداخت....",
'show_alert' => false
]);
$get = file_get_contents($link);
$array = json_decode($get,true);
$links = $array['link'];
$Buttonshop = json_encode(['inline_keyboard'=>[
[['text'=>"پرداخت",'url'=>"$links"]],
]]);
SM($chatID,"لینک پرداخت برای شما با موفقیت ساخته شد✅

⚠️لینک پرداخت پس از چند دقیقه منقضی می شود و تنها یکبار قابل استفاده است",'html',null,$Buttonshop);
}
//########################کد هدیه####################################
elseif($msg == "$dok0" and $Tc == 'private'){
$user["step"] = "giftcodesnew";
saveJson("melat/$userID.json",$user);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"$doktxt0",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"$back"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
])
]);
}
if($step == "giftcodesnew" and $msg != "$back"){
if(file_exists("lib/others/codes/$msg.txt")){
$pricegift = file_get_contents("lib/others/codes/$msg.txt");
$coinspop = $user["Points"];
$newin = $coinspop + $pricegift;
$user["Points"] = "$newin";
saveJson("melat/$userID.json",$user);
SendMessage($chatID,"تبریک🎉
کد شما صحیح بود و شما برنده $pricegift $money شدید");
unlink("lib/others/codes/$msg.txt");
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
bot('sendMessage', [
'chat_id' =>"@$giftch",
'text' => "✅کد $msg با موفقیت استفاده شد

⏰ ساعت ↙️
⏰ $time
📆تاریخ↙️
📆 $date


👤 توسط :
➖➖➖➖➖➖➖➖➖➖➖➖

👤Name: $first_name
🆔Username: @$username
🌐UserID: $userID

➖➖➖➖➖➖➖➖➖➖➖➖

💠$money های دریافت شده
$icmoney $pricegift",
]);
}else{
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"کد هدیه نامعتبر است",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"$back"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
])]);
}}
//########################کد هدیه####################################
elseif($msg == "$dok11" and $Tc == 'private'){
$user["step"] = "none";
saveJson("melat/$userID.json",$user);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"$doktxt11",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"$back"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
])
]);
}
//###############قوانین###########################
elseif($data == "rules"){
$chatID = $update->callback_query->message->chat->id;
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"$ghavanin",
'parse_mode' => "html",
'reply_markup' => json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backpaybutton"]],
]
])
]);
}
//#################دریافت ایدی##################################
elseif(preg_match('/^cr-(.*)-(.*)-(.*)/', $data, $match)){
if($data_ads['Lock-sabtads']=='❌غیر فعال'){
if($match[1] !== 'تنظیم نشده' and $match[2] !== 'تنظیم نشده' and $match[3] !== 'null'){
if($Points >= "$match[2]"){
$user["step"] = "memsabt-$match[1]-$match[2]";
saveJson("melat/$userID.json",$user);
bot('sendMessage', [
'chat_id' => $chatID,
'text'=>"✅جهت دریافت ممبر باید ابتدا ربات را ادمین کانال مورد نظر کنید سپس آیدی کانال را ارسال نمایید

👈نمونه : @durov

📌درصورتی که مشکلی در ادمین کردن ربات دارید دستور زیر را ارسال نمایید
/help",
'parse_mode' => "html",
'reply_markup' => json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"$back"]],
],])]);
}else{
bot('answercallbackquery', [
'callback_query_id' => $data_id,
'text' => "❌موجودی کافی نیست",
'show_alert' => true
]);
}}else{
bot('answercallbackquery', [
'callback_query_id' => $data_id,
'text' => "❌تنظیمات آیتم مورد نظر انجام نشده است",
'show_alert' => false
]);
}}else{
bot('sendMessage', [
'chat_id' => $chatID,
'text'=>"✔️ثبت سفارش موقتا غیر فعال است",
]);
}}
//################ثبت سفارس شیشه ای##########################################
elseif(preg_match('/^memsabt-(.*)-(.*)/', $step, $match) and $msg != "$back" and $msg != "/help"){
 $msg = strtolower($msg);
$msg = str_replace('@', '', $msg);
$msg = str_replace('https://', '', $msg);
$msg = str_replace('http://', '', $msg);
$msg = str_replace('telegram.me/', '', $msg);
$msg = str_replace('t.me/', '', $msg);
$msg = str_replace('/', '', $msg);
$get = bot('getChat', [
'chat_id' => '@' . $msg
]);
$msg_txt = bot('sendMessage', [
'chat_id' => $chatID,
'text' => "لطفا کمی صبر کنید ...",
'reply_to_message_id' => null,
])->result->message_id;
if ($get->result->type == 'channel' || $get->result->type == 'supergroup') {
$channels255 = json_decode(file_get_contents("https://api.telegram.org/bot$tokens_bot/getChatMember?chat_id=@$msg&user_id=$id_adady"));
$channels2553 = json_decode(file_get_contents("https://api.telegram.org/bot$tokens_bot/getChat?chat_id=@$msg"));
$tod = $channels255->result->status;
$descch1 = $channels2553->result->title;
$descch2 = $channels2553->result->username;
$descch3 = $channels2553->result->id;
$descch4 = $channels2553->result->description;
$descch5 = $channels2553->result->photo->big_file_id;
if($tod == 'administrator'){
if ($descch4 == null) $descch4 = "فاقد توضیحات";
if ($descch1 == null) $descch1 = "فاقد عنوان️";
$al = $match[1];
$Scan = scandir('ads');
$Scan = array_diff($Scan, ['.','..']);
$members = 0;
foreach($Scan as $Value){
if(is_file("ads/$Value")){
$members++;
}}
$rand = $members + 1;
if(file_exists("lib/Button/dokc0.txt")){$dokc0 = file_get_contents("lib/Button/dokc0.txt");
$dokc0 = str_replace('/ozv/',"$al",$dokc0);
}else{$dokc0 = "👤 سفارش $al ممبر 👤";}
if(file_exists("lib/Button/dokc2.txt")){$dokc2 = file_get_contents("lib/Button/dokc2.txt");
}else{$dokc2 = "$icmoney دریافت $money $icmoney";}
if ($keyboard_ch ==  1){
$Button_ch1 = json_encode(['inline_keyboard'=>[
[["text"=>"$dokc0", 'callback_data' => "0"]],
[["text" => "$dokc2", 'callback_data' => "getcoin-$rand"]],
[["text" => "$dokc1","url" => "https://t.me/$descch2"]],
[["text" => "$dokc3", 'callback_data' => "goz-$rand"]],
[["text" => "$dokc4", 'url' => "https://t.me/$boter_id"]],
],'resize_keyboard'=>true]); 
}
if ($keyboard_ch ==  2){
$Button_ch1 = json_encode(['inline_keyboard'=>[
[["text"=>"$dokc0", 'callback_data' => "0"]],
[["text" => "$dokc2", 'callback_data' => "getcoin-$rand"],["text" => "$dokc1","url" => "https://t.me/$descch2"]],
[["text" => "$dokc3", 'callback_data' => "goz-$rand"],["text" => "$dokc4", 'url' => "https://t.me/$boter_id"]],
],'resize_keyboard'=>true]); 
}
if ($keyboard_ch ==  3){
$Button_ch1 = json_encode(['inline_keyboard'=>[
[["text"=>"$dokc0", 'callback_data' => "0"]],
[["text" => "$dokc2", 'callback_data' => "getcoin-$rand"],["text" => "$dokc1","url" => "https://t.me/$descch2"],["text" => "$dokc3", 'callback_data' => "goz-$rand"],["text" => "$dokc4", 'url' => "https://t.me/$boter_id"]],
],'resize_keyboard'=>true]); 
}
if($data_ads['noeeads']=='عکس دار'){
if(isset($channels2553->result->photo)){
$patch = bot('getfile',['file_id'=>$descch5])->result->file_path;
$piclink = file_get_contents("https://api.telegram.org/file/bot$tokens_bot/$patch");
file_put_contents("photos/$msg.jpg",$piclink);
$post_id = bot('SendPhoto', [
'chat_id' =>"@$chads",
'photo' =>new CURLFile("photos/$msg.jpg"),
'caption' => "‼️نام کانال : $descch1

📝توضیحات کانال: $descch4

🆔@$descch2",
'parse_mode' => "html",
'reply_markup' => $Button_ch1
])->result->message_id;
unlink("photos/$msg.jpg");
}else{
$post_id = bot('SendPhoto', [
'chat_id' =>"@$chads",
'photo' =>"$piclink",
'caption' => "‼️نام کانال : $descch1

📝توضیحات کانال: $descch4

🆔@$descch2",
'parse_mode' => "html",
'reply_markup' => $Button_ch1
])->result->message_id;
}}
if($data_ads['noeeads']=='متنی'){
$post_id = bot('sendMessage', [
'chat_id' =>"@$chads",
'text' => "‼️نام کانال : $descch1

📝توضیحات کانال: $descch4

🆔@$descch2",
'parse_mode' => "html",
'reply_markup' => $Button_ch1
])->result->message_id;
}
$order['admin'] = $userID;
$order['Points'] = $match[2];
$order['postid'] = $post_id;
$order['channel'] = "$descch2";
$order['tedad'] = '0';
$order['stamp']= $time45;
$order['left'][] = '';
$lj = jdate('l'); //نام روز در هفته - کامل
$Fj = jdate('F'); //نام ماه از سال - کامل
$dj = jdate('d'); //شماره ی روز از ماه - ۲ رقمی
$yj = jdate('y'); //سال (به عدد) دو رقمی
$Hj = jdate('H:i'); //ساعت در روز - ۲۴ساعته 
$order['time-cancell'] = "$time45";
$order['time'] = "$Hj";
$order['date'] = "$dj $Fj ۱۴$yj";
$order['time-sabt'] = '0';
$order['Report'][] = '';
$order['members'][] = '';
$order['member'] = $match[1];
$order['stats'] = 'در حال اجرا ♻️';
file_put_contents("ads/$rand.json", json_encode($order, 448));
$user['step'] = 'none';
$user['Points'] = $Points - $match[2];
$user['sefaresh'] = $sefaresh + 1;
$user['ads-id'][] = "$rand";
saveJson("melat/$userID.json",$user);
bot('editMessageText',[ 
'chat_id'=>$chatID, 
'message_id'=>$msg_txt, 
'text'=>"‼️نام کانال : $descch1

📝توضیحات کانال: $descch4

🆔@$descch2", 
]); 
bot('sendMessage', [
'chat_id' => $chatID,
'text' => "✅سفارش شما با موفقیت ثبت شد

🔍 کد پیگیری سفارش شما $post_id می باشد
 
👥سفارش شما در قسمت پیگیری سفارشات قابل پیگیری است.

✅ ثبت سفارش با موفقیت انجام شد.",
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text'=>'مشاهده ی سفارش️','url'=>"http://t.me/$chads/$post_id"]],
]
])
]);
}else{
bot('editMessageText',[ 
'chat_id'=>$chatID, 
'message_id'=>$msg_txt, 
'text'=>"❌ربات @$boter_id ادمین کانال @$msgادمین نیست

👈جهت دریافت ممبر باید ابتدا ربات را ادمین کانال مورد نظر کنید سپس آیدی کانال خود را ارسال نمایید

📌درصورتی که مشکلی در ادمین کردن ربات دارید دستور زیر را ارسال نمایید
/help", 
]); 
}
}else{
bot('editMessageText',[ 
'chat_id'=>$chatID, 
'message_id'=>$msg_txt, 
'text'=>"⚠️ برای ثبت سفارش نیاز است ایدی کانال یا گروه ارسال کنید : ", 
]);
}}
//#################دریافت الماس ثبت سفارش################################
elseif(preg_match('/^getcoin-(.*)/', $data, $match)){
$userID = $update->callback_query->from->id;
if(is_file("melat/$userID.json")){
$order = json_decode(file_get_contents("ads/$match[1].json"), 1);
/////////////چک عضویت در کانال سفارش////////////
$gets = json_decode(file_get_contents("https://api.telegram.org/bot$tokens_bot/getChatMember?chat_id=@{$order['channel']}&user_id=$userID"));
$tod31 = $gets->result->status;
if($tod31 == 'member' or $tod31 == 'creator' or $tod31 == 'administrator'){
/////////////چک عضویت در کانال ممبرگیر////////////
$getes = json_decode(file_get_contents("https://api.telegram.org/bot$tokens_bot/getChatMember?chat_id=@$chads&user_id=$userID"));
$tod3 = $getes->result->status;
if($tod3 == 'member' or $tod3 == 'creator' or $tod3 == 'administrator'){
/////////////////////////
if($userID !== $order['admin']){
/////////////////////////
$channels23 = json_decode(file_get_contents("https://api.telegram.org/bot$tokens_bot/getChatMember?chat_id=@{$order['channel']}&user_id=$id_adady"));
$tod30 = $channels23->result->status;
if($tod30 != 'administrator'){
/////////////////////////
bot('answercallbackquery', [
'callback_query_id' => $data_id,
'text' => "❌خطا

‼️امکان دریافت $money از این سفارش وجود ندارد 

👈ربات ممبرگیر ادمین کانال سفارش دهنده نیست.

✅به کاربر ثبت کننده سفارش اطلاع رسانی گردید",
'show_alert' => true
]);
bot('deletemessage', [
'chat_id' =>"@$chads",
'message_id' => "{$order['postid']}"
]);
bot('sendMessage', [
'chat_id' => $order['admin'],
'text'=>"❌خطا در ممبرگیری برای کانال @{$order['channel']}

👈جهت ممبرگیری باید ربات را ادمین کانال @{$order['channel']} کنید و مجدد ثبت سفارش کنید

⚠️سفارش شما لغو شد",
'parse_mode' =>"html",
]);
$order['stats'] = 'کنسل شده❌';
//========
file_put_contents("ads/$match[1].json", json_encode($order, 448));
die();
}
if(in_array($userID,$order['members'])){
bot('answercallbackquery', [
'callback_query_id' => $data_id,
'text' => "❌ شما قبلا $money این پست را دریافت کرده اید",
'show_alert' => false
]);
die();
}
$get = bot('getChatMember',[
'chat_id'=>'@'.$order['channel'],
'user_id'=>$userID
]);
if($get->result->status == 'administrator' or $get->result->status == 'creator'){
bot('answercallbackquery', [
'callback_query_id' => $data_id,
'text' => "❌امکان دریافت $money از پست خودتان ندارید❌",
'show_alert' => false
]);
die();
}
if($order['stats'] == "در حال اجرا ♻️"){
if($user['type-panel'] == 'عادی'){
$coin = $order['tedad'] + 1;
$order['tedad']= $coin;
$order['members'][] = $userID;
file_put_contents("ads/$match[1].json", json_encode($order, 448));
$ustart = json_decode(file_get_contents("melat/$userID.json"),true);
$Posplus = $ustart['ads'] + 1;
$ustart['ads'] = $Posplus;
$Pointsplus = $ustart['Points'] + $coinamount1;
$ustart['Points'] = $Pointsplus;
saveJson("melat/$userID.json",$ustart);
bot('answercallbackquery', [
'callback_query_id' => $data_id,
'text' => "$icmoney $coinamount1 $money کسب کردید | موجودی $Pointsplus",
'show_alert' => false
]);
}
if($user['type-panel'] == 'حرفه ای'){
$coin = $order['tedad'] + 1;
$order['tedad']= $coin;
$order['members'][] = $userID;
file_put_contents("ads/$match[1].json", json_encode($order, 448));
$ustart = json_decode(file_get_contents("melat/$userID.json"),true);
$Posplus = $ustart['ads'] + 1;
$ustart['ads'] = $Posplus;
$Pointsplus = $ustart['Points'] + $coinamount2;
$ustart['Points'] = $Pointsplus;
saveJson("melat/$userID.json",$ustart);
bot('answercallbackquery', [
'callback_query_id' => $data_id,
'text' => "$icmoney $coinamount2 $money کسب کردید | موجودی $Pointsplus",
'show_alert' => false
]);
}
if($user['type-panel'] == 'ویژه'){
$coin = $order['tedad'] + 1;
$order['tedad']= $coin;
$order['members'][] = $userID;
file_put_contents("ads/$match[1].json", json_encode($order, 448));
$ustart = json_decode(file_get_contents("melat/$userID.json"),true);
$Posplus = $ustart['ads'] + 1;
$ustart['ads'] = $Posplus;
$Pointsplus = $ustart['Points'] + $coinamount3;
$ustart['Points'] = $Pointsplus;
saveJson("melat/$userID.json",$ustart);
bot('answercallbackquery', [
'callback_query_id' => $data_id,
'text' => "$icmoney $coinamount3 $money کسب کردید | موجودی $Pointsplus",
'show_alert' => false
]);
}}
if($order['tedad'] >= $order['member']){
bot('deletemessage', [
'chat_id' =>"@$chads",
'message_id' => "{$order['postid']}"
]);
bot('sendMessage', [
'chat_id'=>$order['admin'],
'text' => "✅ سفارش ممبرگیری برای کانال @{$order['channel']} با کد پیگیری {$order['postid']} به پایان رسید
💯💯💯",
'parse_mode' =>"html",
]);
$order['stats'] = 'تکمیل شده✅';
}
file_put_contents("ads/$match[1].json", json_encode($order, 448));
$sub = $user["sub"];
if($sub != null){
$users = json_decode(file_get_contents("melat/$sub.json"),true);
if($user['ads'] == $datazir['zirjoinads']){
$invcoin = $users["zirmjmae-porsant"];
$newinvcoin= $invcoin + $datazir['coin-join'];
$users["zirmjmae-porsant"] = "$newinvcoin";
$tiksh = $users['Points'];
$ziiii = $tiksh + $datazir['coin-join'];
$users["Points"] = "$ziiii";
bot('sendMessage',[
'chat_id'=>$sub,
'text'=>"✅ تبریک کاربر عزیز!
👤 زیرمجموعه شما ($userID) {$datazir['zirjoinads']} عضویت خود را در کانال انجام داد!
🔖 و {$datazir['coin-join']} $money پورسانت دریافت کردید.",
]);
saveJson("melat/$userID.json",$user);
}
$Pointlus = $users['zirmjmae-join'] + 1;
$users['zirmjmae-join'] = $Pointlus;
saveJson("melat/$sub.json",$users);
}
//========
}else{
bot('answercallbackquery', [
'callback_query_id' => $data_id,
'text' => "❌امکان دریافت $money از پست خودتان ندارید❌",
'show_alert' => true
]);
}
//========
}else{
bot('answercallbackquery', [
'callback_query_id' => $data_id,
'text' => "‼️ابتدا در کانال ممبرگیر عضو شوید .",
'show_alert' => true
]);
}
//========
}else{
bot('answercallbackquery', [
'callback_query_id' => $data_id,
'text' => "شما هنوز در کانال عضو نشده اید ⛔️",
'show_alert' => true
]);
}
//========
}else{
bot('answercallbackquery', [
'callback_query_id' => $data_id,
'text' => "❌ شما عضو ربات نمیباشید",
'show_alert' => true
]);
}}
//#####################گزارش پست###########################################
elseif(preg_match('/^goz-(.*)/', $data, $match)){
$userID = $update->callback_query->from->id;
if(is_file("melat/$userID.json")){
$order = json_decode(file_get_contents("ads/$match[1].json"), 1);
if($userID == $admin){
$math = json_decode(file_get_contents("lib/kodam/data.json"),true);
if($math["takmil_ads"] == '✅فعال'){
bot('answercallbackquery', [
'callback_query_id' => $data_id,
'text' => "✅ سفارش با موفقیت به پایان رسید",
'show_alert' => true
]);
bot('deletemessage', [
'chat_id' =>"@$chads",
'message_id' => "{$order['postid']}"
]);
bot('sendMessage', [
'chat_id'=>$order['admin'],
'text' => "✅ سفارش ممبرگیری برای کانال @{$order['channel']} با کد پیگیری {$order['postid']} به پایان رسید
💯💯💯",
'parse_mode' =>"html",
]);
$order['stats'] = 'تکمیل شده✅';
file_put_contents("ads/$match[1].json", json_encode($order, 448));
}
die();
}
if(in_array($userID,$order['Report'])){
bot('answercallbackquery', [
'callback_query_id' => $data_id,
'text' => "شما قبلا این پست را گزارش داده بودید ❌",
'show_alert' => true
]);
die();
}
bot('answercallbackquery', [
'callback_query_id' => $data_id,
'text' => "گزارش شما با موفقیت ثبت شد",
'show_alert' => true
]);
$order['Report'][] = $userID;
file_put_contents("ads/$match[1].json", json_encode($order, 448));
bot('sendMessage', [
'chat_id'=>$admin,
'text' => "🚫گزارش جدید!
مشخصات پست 👇

آیدی سفارش دهنده ممبر : {$order['admin']}
آیدی ثبت کننده گزارش : $userID
ممبر درخواستی: {$order['member']}
تاریخ ثبت پست: {$order['date']}",
'parse_mode' =>"html",
]);
}else{
bot('answercallbackquery', [
'callback_query_id' => $data_id,
'text' => "❌ شما عضو ربات نمیباشید",
'show_alert' => true
]);
}}
//#########################################################
//#########################################################
//#########################################################
//#########################################################
//#########################################################
//#########################################################

//#########################################################
elseif($msg == "♾‌دکمه ها" and $Tc == 'private' and in_array($chatID,$list['admins'])){
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"✅در این بخش می توانید واحد سفارش، آیکون مربوط با واحد سفارش و نام دکمه هارا تنظیم کنید",
'parse_mode'=>'HTML',
'reply_markup'=>json_encode([
'inline_keyboard' => [
[["text" => "$money", 'callback_data' => "uyfuyfuyyf"],["text" => "🎗واحد سفارش", 'callback_data' => "0"]],
[["text" => "$icmoney", 'callback_data' => "tdxytdciyt"],["text" => "🔹آیکون سفارش", 'callback_data' => "0"]],
[["text" => "🔷 تنظیمات نام دکمه های ربات 🔷", 'callback_data' =>"0"]],
[["text" => "$dok1", 'callback_data' => "sets-dok1"]],
[["text" => "$dok2", 'callback_data' => "sets-dok2"],["text" => "$dok3", 'callback_data' => "sets-dok3"]],
[["text" => "$dok4", 'callback_data' => "sets-dok4"],["text" => "$dok5", 'callback_data' => "sets-dok5"]],
[["text" => "$dok6", 'callback_data' => "sets-dok6"],["text" => "$dok7", 'callback_data' => "sets-dok7"]],
[["text" => "$dok8", 'callback_data' => "sets-dok8"],["text" => "$dok9", 'callback_data' => "sets-dok9"]],
[["text" => "$dok10", 'callback_data' => "sets-dok0"],["text" => "$dok11", 'callback_data' => "sets-dok11"]],
[["text" => "🔷 تنظیمات نام دکمه های کانال 🔷", 'callback_data' => "0"]],
[["text" => "$dokc0", 'callback_data' => "0"]],
[["text" => "$dokc2", 'callback_data' => "sets-dokc2"],["text" => "$dokc1", 'callback_data' => "sets-dokc1"],["text" => "$dokc3", 'callback_data' => "sets-dokc3"],["text" => "$dokc4", 'callback_data' => "sets-dokc4"]],
[["text" => "🔘طرح دکمه های کانال🔘", 'callback_data' => "taeh_dokc"],["text" => "🔘چینش دکمه های ربات🔘", 'callback_data' => "chinesh_home"]],
]])]);}
//#########################################################
elseif($msg == "📇 تنظیم متن" and $Tc == 'private' and in_array($chatID,$list['admins'])){
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"👇 یک گزینه را انتخاب کنید 👇",
'parse_mode'=>'HTML',
'reply_markup' => json_encode([
'inline_keyboard' => [
[["text" => "متن استارت", 'callback_data' => "setm-starttext"]],
[["text" => "🔷 تنظیمات متن دکمه های ربات 🔷", 'callback_data' =>"0"]],
[["text" => "$dok1", 'callback_data' => "setm-doktxt1"]],
[["text" => "$dok2", 'callback_data' => "setm-doktxt2"],["text" => "$dok3", 'callback_data' => "setm-doktxt3"]],
[["text" => "$dok6", 'callback_data' => "setm-doktxt6"],["text" => "$dok7", 'callback_data' => "setm-doktxt7"]],
[["text" => "$dok5", 'callback_data' => "setm-doktxt5"],["text" => "$dok8", 'callback_data' => "setm-doktxt8"]],
[["text" => "$dok10", 'callback_data' => "setm-doktxt0"],["text" => "$dok11", 'callback_data' => "setm-doktxt11"]],
]])]);}
//###################################################################
//#########################################################
elseif($msg == "⛔️ بلاک و آنبلاک کردن ✅" and $Tc == 'private' and in_array($chatID,$list['admins'])){
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"گزینه مورد نظر را انتخاب کنید",
'parse_mode'=>'HTML',
'reply_markup' =>json_encode(['keyboard'=>[
[['text'=>"❌مسدودیت کاربر❌"],['text'=>"✅رفع مسدودیت کاربر✅"]],
//[['text'=>"❌مسدودیت کانال❌"],['text'=>"✅رفع مسدودیت کانال✅"]],
[['text'=>"🔙بازگشت به منو"]],
],'resize_keyboard'=>true])]);
}
//#########################################################
elseif($msg == "🏦 مبادلات $money" and $Tc == 'private' and in_array($chatID,$list['admins'])){
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"📌 به بخش مبادلات $money خوش آمدید 🌹

✅ گزینه مورد نظر را انتخاب کنید.",
'parse_mode' => "html",
'reply_markup' => json_encode(['keyboard'=>[
[['text'=>"📤کسر $money"],['text'=>"📥اهدای $money"]],
//[['text'=>"📥اهدای $money"],['text'=>"🎗$money همگانی"]],
[['text'=>"🔙بازگشت به منو"]],
],'resize_keyboard'=>true])]);}
//#########################################################
else if($msg == '🛍 فروشـگاه' and $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = 'none';
$butlt = json_encode(['keyboard'=>[
[['text'=>"🔢آیتم های $money"],['text'=>"🔢آیتم های پنل"]],
[['text'=>"💵موجودی شما"],['text'=>"💳تسویه حساب"]],
[['text'=>"📇تنظیمات متون"],['text'=>"🔙بازگشت به منو"]],
],'resize_keyboard'=>true]);
SM($chatID,"🛍در این بخش می توانید تنظیمات فروشگاه ربات خود را انجام دهید",'html',null,$butlt);
saveJson("melat/$userID.json",$user);
}
//#########################################################
else if($msg == '📇تنظیمات متون' and $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = 'none';
$butlt = json_encode(['keyboard'=>[
[['text'=>"✔️متن اصلی فروشگاه✔️"],['text'=>"♻️متن خرید پنل♻️"]],
[['text'=>"خرید $money $icmoney"],['text'=>"🔙بازگشت به منو"]],
],'resize_keyboard'=>true]);
SM($chatID,"کدام متن را میخواهید تغییر دهید؟",'html',null,$butlt);
saveJson("melat/$userID.json",$user);
}
//#########################################################
//----------------------------------------/////
else if($msg == '💵موجودی شما' and $Tc == 'private' and in_array($chatID,$list['admins'])){
$amount = number_format("$shops");
SM($chatID,"موجودی کیف پول شما در ربات $amount ریال است ❗️

جهت برداشت از کیف پول به بخش `تسویه حساب` مراجعه کنید!

توجه در صورتی که فردی خرید انجام دهد حداکثر تا 12 ساعت مبلغ دریافتی به کیف پول شما واریز خواهد شد.",'html');
}
//----------------------------------------/////
else if($msg == '💳تسویه حساب' and $Tc == 'private' and in_array($chatID,$list['admins'])){
if($shops >= 200000){
$user['step']= "tasvye";
SM($chatID,"👈شماره کارت خودرابدون هیچ توضیح اضافی ارسال نمایید

✅نمونه صحیح : 6396735858026328
❌نمونه غلط : 6396735858026328 به نام مهدی عزیزی

⚠️درصورتی که طبق نمونه شماره کارت خود را ارسال نکرده باشید تسویه حساب انجام نخواهد شد

⚠️مبلغ 1000 تومان جهت کارمزد از موجودی هنگام تسویه کسر می شود

⚠️در صورت ارسال اطلاعات اشتباه و یا ناقص، مسئولیت آن بر عهده خود شما می باشد",'html',null,$Button_back_panel);
saveJson("melat/$userID.json",$user);
}else{
SM($chatID,"موجودی شما برای تسویه حساب کافی نیست⚠️
حداقل موجودی برای تسویه حساب » 20000 تومان",'html');
}}
//----------------------------------------/////
else if(strpos($step,'tasvye') !== false and $Tc == 'private' and isset($msg)){
$me = strlen($msg);
if($me == "16"){
perti('sendmessage',[
'chat_id'=>-1001775432886,
'text'=>"
 درخاست واریز
 شماره کارت : $msg
 مبلغ درخاستی : $shops ریال
 ایدی ربات : @$boter_id
 توسط $userID برداشت انجام شد",
 ]);
SM($chatID,"✅درخواست تسویه حساب شما با موفقیت انجام شد و نهایتا تا ۷۲ ساعت اینده مبلغ واریز خواهد شد

👈 هنگام تسویه حساب از سمت ربات پیامی دریافت خواهید کرد

⚠️در صورتی که بعد از ۷۲ ساعت مبلغ به حساب شما واریز نشد به پشتیبانی ربات اطلاع دهید
 ",'html');
 Save("lib/Button/shops.txt",0);
}else{
SM($chatID,"شماره کارت ارسالی اشتباه میباشد .
توجه کنید شماره ارسالی شماره شبا یا حساب نباشد.",'html');
}}
//----------------------------------------/////
else if($msg == "🔢آیتم های $money" or $data == 'backshop' and $Tc == 'private' and in_array($chatID,$list['admins'])){
$Button_dok0 = json_encode(['inline_keyboard'=>[
[['text'=>"نام ایتم",'callback_data'=>'0'],
['text'=>"مبلغ",'callback_data'=>'0'],
['text'=>"تعداد $money",'callback_data'=>'0']],
[['text'=>"$aytem1",'callback_data'=>"seeats-aytem1"],
['text'=>"$amount1",'callback_data'=>"seaetcs-amount1"],
['text'=>"$coinshop1",'callback_data'=>"seetcs-coinshop1"]],
[['text'=>"$aytem2",'callback_data'=>"seeats-aytem2"],
['text'=>"$amount2",'callback_data'=>"seaetcs-amount2"],
['text'=>"$coinshop2",'callback_data'=>"seetcs-coinshop2"]],
[['text'=>"$aytem3",'callback_data'=>"seeats-aytem3"],
['text'=>"$amount3",'callback_data'=>"seaetcs-amount3"],
['text'=>"$coinshop3",'callback_data'=>"seetcs-coinshop3"]],
[['text'=>"$aytem4",'callback_data'=>"seeats-aytem4"],
['text'=>"$amount4",'callback_data'=>"seaetcs-amount4"],
['text'=>"$coinshop4",'callback_data'=>"seetcs-coinshop4"]],
]]);
SM($chatID,"🛍در این بخش می توانید تنظیمات فروشگاه ربات خود را انجام دهید

شما قادر به تنظیم چهار آیتم خرید هستید",'html',null,$Button_dok0);
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
}
//////////------------------------\\\\\\\\\\\\\\///
elseif(preg_match('/^seeats-(.*)/', $data, $match)){
$dok = $match[1];
$Button_set_dok = json_encode(['inline_keyboard'=>[
[['text'=>"🔙بازگشت",'callback_data'=>"backshop"]],
]]);
$user['step']= "seeats-$dok";
Editmessagetext($chatID, $msg_id,"✅نام آیتم را وارد کنید

👈مثال :
خرید ۵۰۰ $money | ۱۰۰۰ تومان",$Button_set_dok);
saveJson("melat/$userID.json",$user);
}
//////////------------------------\\\\\\\\\\\\\\///
elseif(preg_match('/^seeats-(.*)/', $step, $match)){
$user['step']= 'none';
$doke = $match[1];
Save("lib/Button/$doke.txt",$msg);
$butlt = json_encode(['keyboard'=>[
[['text'=>"🔢آیتم های $money"],['text'=>"🔢آیتم های پنل"]],
[['text'=>"💵موجودی شما"],['text'=>"💳تسویه حساب"]],
[['text'=>"📇تنظیمات متون"],['text'=>"🔙بازگشت به منو"]],
],'resize_keyboard'=>true]);
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"✅با موفقیت تنظیم شد",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>$butlt
]);
saveJson("melat/$userID.json",$user);
}
//----------------------------------------/////
elseif(preg_match('/^seetcs-(.*)/', $data, $match)){
$dok = $match[1];
$Button_set_dok = json_encode(['inline_keyboard'=>[
[['text'=>"🔙بازگشت",'callback_data'=>"backshop"]],
]]);
$user['step']= "seetcs-$dok";
Editmessagetext($chatID, $msg_id,"✅مقدار $money که بعد از خرید این آیتم باید به حساب کاربر واریز شود را ارسال نمایید

⚠️حتما مقدار $money ورودی به صورت عدد ،بدون توضیح و انگلیسی باشد
👈مثال :
10",$Button_set_dok);
saveJson("melat/$userID.json",$user);
}
//////////------------------------\\\\\\\\\\\\\\///
elseif(preg_match('/^seetcs-(.*)/', $step, $match)){
if(preg_match('/^([0-9])/',$msg) and $msg >= 1 && $msg <= 5000){
$user['step']= 'none';
$doke = $match[1];
Save("lib/Button/$doke.txt",$msg);
$butlt = json_encode(['keyboard'=>[
[['text'=>"🔢آیتم های $money"],['text'=>"🔢آیتم های پنل"]],
[['text'=>"💵موجودی شما"],['text'=>"💳تسویه حساب"]],
[['text'=>"📇تنظیمات متون"],['text'=>"🔙بازگشت به منو"]],
],'resize_keyboard'=>true]);
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"✅با موفقیت تنظیم شد",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>$butlt
]);
saveJson("melat/$userID.json",$user);
}else{
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"❗️عدد ارسالی باید لاتین باشد :
❗️عددی بین 1 الی 5000 ارسال کنید :",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>$Button_back_panel
]);
}}
//----------------------------------------/////
elseif(preg_match('/^seaetcs-(.*)/', $data, $match)){
$dok = $match[1];
$Button_set_dok = json_encode(['inline_keyboard'=>[
[['text'=>"🔙بازگشت",'callback_data'=>"backshop"]],
]]);
$user['step']= "seaetcs-$dok";
Editmessagetext($chatID, $msg_id,"✅مبلغ آیتم مورد نظر را وارد نمائید

⚠️حتما مبلغ ورودی به صورت ریال ،بدون توضیح و انگلیسی باشد
👈مثال :
50000",$Button_set_dok);
saveJson("melat/$userID.json",$user);
}
//////////------------------------\\\\\\\\\\\\\\///
elseif(preg_match('/^seaetcs-(.*)/', $step, $match)){
if(preg_match('/^([0-9])/',$msg) and $msg >= 10000 && $msg <= 1000000){
$user['step']= 'none';
$doke = $match[1];
Save("lib/Button/$doke.txt",$msg);
$butlt = json_encode(['keyboard'=>[
[['text'=>"🔢آیتم های $money"],['text'=>"🔢آیتم های پنل"]],
[['text'=>"💵موجودی شما"],['text'=>"💳تسویه حساب"]],
[['text'=>"📇تنظیمات متون"],['text'=>"🔙بازگشت به منو"]],
],'resize_keyboard'=>true]);
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"✅با موفقیت تنظیم شد",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>$butlt
]);
saveJson("melat/$userID.json",$user);
}else{
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"❗️عدد ارسالی باید لاتین باشد :
❗️مبلغی بین 10.000 الی 1.000.000 ریال ارسال کنید :",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>$Button_back_panel
]);
}}
//#########################################################
else if($msg == "🔢آیتم های پنل" or $data == 'backshop' and $Tc == 'private' and in_array($chatID,$list['admins'])){
$Button_dok0 = json_encode(['inline_keyboard'=>[
[['text'=>"نام🔰",'callback_data'=>"0"],
['text'=>"مبلغ💳",'callback_data'=>"0"],
['text'=>"زمان⌛️",'callback_data'=>"0"],
['text'=>"پنل♻️",'callback_data'=>"0"]],
[['text'=>"$aytems1",'callback_data'=>"seeuts-aytems1"],
['text'=>"$amounts1",'callback_data'=>"seepcs-amounts1"],
['text'=>"$daypanel1",'callback_data'=>"semtcs-daypanel1"],
['text'=>"حرفه ای",'callback_data'=>"0"]],
[['text'=>"$aytems2",'callback_data'=>"seeuts-aytems2"],
['text'=>"$amounts2",'callback_data'=>"seepcs-amounts2"],
['text'=>"$daypanel2",'callback_data'=>"semtcs-daypanel2"],
['text'=>"ویژه",'callback_data'=>"0"]],
[['text'=>"$aytems3",'callback_data'=>"seeuts-aytems3"],
['text'=>"$amounts3",'callback_data'=>"seepcs-amounts3"],
['text'=>"$daypanel3",'callback_data'=>"semtcs-daypanel3"],
['text'=>"حرفه ای",'callback_data'=>"0"]],
[['text'=>"$aytems4",'callback_data'=>"seeuts-aytems4"],
['text'=>"$amounts4",'callback_data'=>"seepcs-amounts4"],
['text'=>"$daypanel4",'callback_data'=>"semtcs-daypanel4"],
['text'=>"ویژه",'callback_data'=>"0"]],
]]);
SM($chatID,"🛍در این بخش می توانید تنظیمات فروشگاه ربات خود را انجام دهید

شما قادر به تنظیم چهار آیتم خرید هستید",'html',null,$Button_dok0);
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
}
//#########################################################
elseif(preg_match('/^seeuts-(.*)/', $data, $match)){
$dok = $match[1];
$Button_set_dok = json_encode(['inline_keyboard'=>[
[['text'=>"🔙بازگشت",'callback_data'=>"backshop"]],
]]);
$user['step']= "seeuts-$dok";
Editmessagetext($chatID, $msg_id,"✅نام پنل مورد نظر را ارسال نمایید",$Button_set_dok);
saveJson("melat/$userID.json",$user);
}
//////////------------------------\\\\\\\\\\\\\\///
elseif(preg_match('/^seeuts-(.*)/', $step, $match)){
$user['step']= 'none';
$doke = $match[1];
Save("lib/Button/$doke.txt",$msg);
$butlt = json_encode(['keyboard'=>[
[['text'=>"🔢آیتم های $money"],['text'=>"🔢آیتم های پنل"]],
[['text'=>"💵موجودی شما"],['text'=>"💳تسویه حساب"]],
[['text'=>"📇تنظیمات متون"],['text'=>"🔙بازگشت به منو"]],
],'resize_keyboard'=>true]);
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"✅با موفقیت تنظیم شد",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>$butlt
]);
saveJson("melat/$userID.json",$user);
}
//#########################################################
elseif(preg_match('/^seepcs-(.*)/', $data, $match)){
$dok = $match[1];
$Button_set_dok = json_encode(['inline_keyboard'=>[
[['text'=>"🔙بازگشت",'callback_data'=>"backshop"]],
]]);
$user['step']= "seepcs-$dok";
Editmessagetext($chatID, $msg_id,"✅مبلغ پنل مورد نظر را برحسب ریال ارسال نمایید

⚠️مبلغ وارد شده باید برحسب ریال باشد

✅نمونه صحیح : 3000
❌نمونه غلط : ۳۰۰۰ ، ۳۰۰۰ ریال ، 3000 ریال",$Button_set_dok);
saveJson("melat/$userID.json",$user);
}
//////////------------------------\\\\\\\\\\\\\\///
elseif(preg_match('/^seepcs-(.*)/', $step, $match)){
if(preg_match('/^([0-9])/',$msg)){
$user['step']= 'none';
$doke = $match[1];
Save("lib/Button/$doke.txt",$msg);
$butlt = json_encode(['keyboard'=>[
[['text'=>"🔢آیتم های $money"],['text'=>"🔢آیتم های پنل"]],
[['text'=>"💵موجودی شما"],['text'=>"💳تسویه حساب"]],
[['text'=>"📇تنظیمات متون"],['text'=>"🔙بازگشت به منو"]],
],'resize_keyboard'=>true]);
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"✅با موفقیت تنظیم شد",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>$butlt
]);
saveJson("melat/$userID.json",$user);
}else{
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"❗️عدد ارسالی باید لاتین باشد ",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>$Button_back_panel
]);
}}
//#########################################################
elseif(preg_match('/^semtcs-(.*)/', $data, $match)){
$dok = $match[1];
$Button_set_dok = json_encode(['inline_keyboard'=>[
[['text'=>"🔙بازگشت",'callback_data'=>"backshop"]],
]]);
$user['step']= "semtcs-$dok";
Editmessagetext($chatID, $msg_id,"✅زمان پنل مورد نظر را برحسب روز ارسال کنید

👈کاربر در بازه زمانی تعیین شده مجاز به استفاده از این پنل خواهد بود

✅نمونه صحیح : 3
❌نمونه غلط : ۳ ، ۳ روز ، 3 روز
",$Button_set_dok);
saveJson("melat/$userID.json",$user);
}
//////////------------------------\\\\\\\\\\\\\\///
elseif(preg_match('/^semtcs-(.*)/', $step, $match)){
if(preg_match('/^([0-9])/',$msg) and $msg >= 1 && $msg <= 5000){
$user['step']= 'none';
$doke = $match[1];
Save("lib/Button/$doke.txt",$msg);
$butlt = json_encode(['keyboard'=>[
[['text'=>"🔢آیتم های $money"],['text'=>"🔢آیتم های پنل"]],
[['text'=>"💵موجودی شما"],['text'=>"💳تسویه حساب"]],
[['text'=>"📇تنظیمات متون"],['text'=>"🔙بازگشت به منو"]],
],'resize_keyboard'=>true]);
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"✅با موفقیت تنظیم شد",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>$butlt
]);
saveJson("melat/$userID.json",$user);
}else{
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"❗️عدد ارسالی باید لاتین باشد :
❗️عددی بین 1 الی 5000 ارسال کنید :",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>$Button_back_panel
]);
}}
//#########################################################
else if($msg == '✔️متن اصلی فروشگاه✔️' and $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = 'hjfdgid';
SM($chatID,"متن مورد نظررا وارد نمایید",'html',null,$Button_back_panel);
saveJson("melat/$userID.json",$user);
}
elseif($step == "hjfdgid" and $msg != "🔙بازگشت به منو"){
Save("lib/Button/doktxt9.txt",$msg);
SM($chatID,"✅باموفقیت تنظیم شد",'MarkDown',null,$Button_Panel);
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
}
//#########################################################
else if($msg == '♻️متن خرید پنل♻️' and $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = 'hjfdgffid';
SM($chatID,"متن مورد نظررا وارد نمایید",'html',null,$Button_back_panel);
saveJson("melat/$userID.json",$user);
}
elseif($step == "hjfdgffid" and $msg != "🔙بازگشت به منو"){
Save("lib/Button/shoptxt2.txt",$msg);
SM($chatID,"✅باموفقیت تنظیم شد",'MarkDown',null,$Button_Panel);
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
}
//#########################################################
else if($msg == "خرید $money $icmoney" and $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = 'hjfdsgffid';
SM($chatID,"متن مورد نظررا وارد نمایید",'html',null,$Button_back_panel);
saveJson("melat/$userID.json",$user);
}
elseif($step == "hjfdsgffid" and $msg != "🔙بازگشت به منو"){
Save("lib/Button/shoptxt1.txt",$msg);
SM($chatID,"✅باموفقیت تنظیم شد",'MarkDown',null,$Button_Panel);
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
}
//============================================================================//
elseif($msg == "♻️پنـل ها" and $Tc == 'private' and in_array($chatID,$list['admins'])){
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"✅در این بخش می توانید پنل های کاربری ربات را تنظیم‌نمایید",
'parse_mode'=>'HTML',
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text'=>"$icmoney تنظیمات $money ها $icmoney",'callback_data'=>"0"]],
[['text' => "🌀ویژه", 'callback_data' => "0"],['text' => "💢حرفه ای", 'callback_data' => "0"],['text' => "📍عادی", 'callback_data' => "0"],['text' => "👇 $money 👈", 'callback_data' => "0"]],
[['text' => "$coinamount3", 'callback_data' => "panels-coinamount3"],['text' => "$coinamount2", 'callback_data' => "panels-coinamount2"],['text' => "$coinamount1", 'callback_data' => "panels-coinamount1"],['text' => "👤عضویت", 'callback_data' => "0"]],
[['text' => "$invitecoin3", 'callback_data' => "panels-invitecoin3"],['text' => "$invitecoin2", 'callback_data' => "panels-invitecoin2"],['text' => "$invitecoin1", 'callback_data' => "panels-invitecoin1"],['text' => "👥زیرمجموعه", 'callback_data' => "0"]],
[['text' => "$mdailys3", 'callback_data' => "panels-mdailys3"],['text' => "$mdailys2", 'callback_data' => "panels-mdailys2"],['text' => "$mdailys1", 'callback_data' => "panels-mdailys1"],['text' => "🎉روزانه", 'callback_data' => "0"]],
[['text'=>"🔝 تنظیمات ارتقای پنل کاربران🔝",'callback_data'=>"0"]],
[['text'=>"$coinpanel1",'callback_data'=>"panels-coinpanel1"],['text'=>"حرفه ای💢",'callback_data'=>"0"]],
[['text'=>"$coinpanel2",'callback_data'=>"panels-coinpanel2"],['text'=>"🌀ویژه",'callback_data'=>"0"]],
]])]);}
//----------------------------------------------------------------------
elseif($msg == "🔙بازگشت به منو" or $msg == "👤 پنل مدیریت 👤" and $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"شما وارد منوی مدیریت ربات شدید",
'parse_mode'=>'HTML',
'reply_markup'=>$Button_Panel
]);
}
//////////------------------------\\\\\\\\\\\\\\///
else if($msg == '❌مسدودیت کاربر❌' and $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = 'ban';
SM($chatID,"ایدی عددی کاربری که میخواهید از ربات اخراج شود را وارد کنید",'html',$Button_back_panel);
saveJson("melat/$userID.json",$user);
}
else if($step == 'ban' and $Tc == 'private'){
$ok = GCMB($msg);
if($ok == true){
if(!in_array($msg,$list['ban'])){
SM($chatID,"کاربر $msg از ربات اخراج شد!",'MarkDown',$msg_id);
$user['step'] = 'none';
$list['ban'][] = $msg;
saveJson("lib/kodam/list.json",$list);
}else{
$user['step'] = 'none';
SM($chatID,"⛔️ این کاربر از قبل بلاک بود.",'MarkDown',$msg_id);
}
}else{
$user['step'] = 'none';
SM($chatID,"❌ این کاربر عضو ربات نیست",'MarkDown',$msg_id);
}
saveJson("melat/$userID.json",$user);
}
//////////------------------------\\\\\\\\\\\\\\///
else if($msg == '✅رفع مسدودیت کاربر✅' and $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = 'unban';
SM($chatID,"آیدی عددی کاربر را جهت رفع مسدودیت وارد نمایید",'html',$Button_back_panel);
saveJson("melat/$userID.json",$user);
}
else if($step == 'unban' and $Tc == 'private'){
$ok = GCMB($msg);
if($ok == true){
if(in_array($msg,$list['ban'])){
$user['step'] = 'none';
$key = array_search($msg,$list['ban']);
unset($list['ban'][$key]);
$list['ban'] = array_values($list['ban']);
saveJson("lib/kodam/list.json",$list);
SM($chatID,"کاربر $msg آزاد شد!",'MarkDown');
}else{
SM($chatID,"🔓 این کاربر اصلا بلاک نیست.",'MarkDown',$msg_id);
}
}else{
SM($chatID,"❌ این کاربر عضو ربات نیست",'MarkDown',$msg_id);
}
saveJson("melat/$userID.json",$user);
}

//----------------------------------------------------------------------
elseif($msg == "📈 آمار ربات" and $Tc == 'private' and in_array($chatID,$list['admins'])){
$Scan = scandir('melat');
$Scan = array_diff($Scan, ['.','..']);
$members = 0;
foreach($Scan as $Value){
if(is_file("melat/$Value")){
$members++;
}}
if($member_online == null) $member_online = "برای محاسبه یک پیام همگانی ارسال نمایید";
if($melat["members"] == null){
$memrs = "0";
}else{
$memrs = $members - $member_online;
}
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"👤تعداد ممبر ها : $members
✅اعضای فعال : $member_online
☑️اعضای غیر فعال : $memrs

⚠️جهت بروز رسانی تعداد اعضای فعال وغیرفعال باید پیام همگانی ارسال نمایید",
'parse_mode'=>'HTML',
'reply_markup'=>$Button_Panel
]);
}
##### Buttons ######
elseif($data == "backbuttons"){
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
$Panel_SetButtName = json_encode([
'inline_keyboard' => [
[["text" => "$money", 'callback_data' => "uyfuyfuyyf"],["text" => "🎗واحد سفارش", 'callback_data' => "0"]],
[["text" => "$icmoney", 'callback_data' => "tdxytdciyt"],["text" => "🔹آیکون سفارش", 'callback_data' => "0"]],
[["text" => "🔷 تنظیمات نام دکمه های ربات 🔷", 'callback_data' =>"0"]],
[["text" => "$dok1", 'callback_data' => "sets-dok1"]],
[["text" => "$dok2", 'callback_data' => "sets-dok2"],["text" => "$dok3", 'callback_data' => "sets-dok3"]],
[["text" => "$dok4", 'callback_data' => "sets-dok4"],["text" => "$dok5", 'callback_data' => "sets-dok5"]],
[["text" => "$dok6", 'callback_data' => "sets-dok6"],["text" => "$dok7", 'callback_data' => "sets-dok7"]],
[["text" => "$dok8", 'callback_data' => "sets-dok8"],["text" => "$dok9", 'callback_data' => "sets-dok9"]],
[["text" => "$dok10", 'callback_data' => "sets-dok0"],["text" => "$dok11", 'callback_data' => "sets-dok11"]],
[["text" => "🔷 تنظیمات نام دکمه های کانال 🔷", 'callback_data' => "0"]],
[["text" => "$dokc0", 'callback_data' => "0"]],
[["text" => "$dokc2", 'callback_data' => "sets-dokc2"],["text" => "$dokc1", 'callback_data' => "sets-dokc1"],["text" => "$dokc3", 'callback_data' => "sets-dokc3"],["text" => "$dokc4", 'callback_data' => "sets-dokc4"]],
[["text" => "🔘طرح دکمه های کانال🔘", 'callback_data' => "taeh_dokc"],["text" => "🔘چینش دکمه های ربات🔘", 'callback_data' => "chinesh_home"]],
]]);
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"✅در این بخش می توانید واحد سفارش، آیکون مربوط با واحد سفارش و نام دکمه هارا تنظیم کنید",
'parse_mode'=>'HTML',
'reply_markup'=>$Panel_SetButtName]);
}
//#################تنظیم الماس#####################################
elseif(preg_match('/^uyfuyfuyyf/', $data, $match)){
$user['step'] = "uyfuyfuyyf";
saveJson("melat/$userID.json",$user);
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"✅واحد سفارش ربات را ارسال نمایید",
'parse_mode' => "html",
'reply_markup' => json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backbuttons"]],
]])]);
}
//###################################################################
elseif(preg_match('/^uyfuyfuyyf/', $step, $match)){
$user['step']= 'none';
$doke = $match[1];
Save("lib/Button/money.txt",$msg);
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"✅با موفقیت تنظیم شد",
'reply_markup'=>json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backbuttons"]],
]])]);
saveJson("melat/$userID.json",$user);
}
//#################تنظیم ایکون#####################################
elseif(preg_match('/^tdxytdciyt/', $data, $match)){
$user['step'] = "tdxytdciyt";
saveJson("melat/$userID.json",$user);
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"✅آیکون مرتبط یا واحد سفارش را ارسال نمایید",
'parse_mode' => "html",
'reply_markup' => json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backbuttons"]],
]])]);
}
//###################################################################
elseif(preg_match('/^tdxytdciyt/', $step, $match)){
if(!preg_match('/[ا-ی]/uis',$msg)){
$user['step']= 'none';
$doke = $match[1];
Save("lib/Button/icmoney.txt",$msg);
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"✅با موفقیت تنظیم شد",
'reply_markup'=>json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backbuttons"]],
]])]);
saveJson("melat/$userID.json",$user);
}}
elseif($data == "backpanels"){
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"✅در این بخش می توانید پنل های کاربری ربات را تنظیم‌نمایید",
'parse_mode'=>'HTML',
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text'=>"$icmoney تنظیمات $money ها $icmoney",'callback_data'=>"0"]],
[['text' => "🌀ویژه", 'callback_data' => "0"],['text' => "💢حرفه ای", 'callback_data' => "0"],['text' => "📍عادی", 'callback_data' => "0"],['text' => "👇 $money 👈", 'callback_data' => "0"]],
[['text' => "$coinamount3", 'callback_data' => "panels-coinamount3"],['text' => "$coinamount2", 'callback_data' => "panels-coinamount2"],['text' => "$coinamount1", 'callback_data' => "panels-coinamount1"],['text' => "👤عضویت", 'callback_data' => "0"]],
[['text' => "$invitecoin3", 'callback_data' => "panels-invitecoin3"],['text' => "$invitecoin2", 'callback_data' => "panels-invitecoin2"],['text' => "$invitecoin1", 'callback_data' => "panels-invitecoin1"],['text' => "👥زیرمجموعه", 'callback_data' => "0"]],
[['text' => "$mdailys3", 'callback_data' => "panels-mdailys3"],['text' => "$mdailys2", 'callback_data' => "panels-mdailys2"],['text' => "$mdailys1", 'callback_data' => "panels-mdailys1"],['text' => "🎉روزانه", 'callback_data' => "0"]],
[['text'=>"🔝 تنظیمات ارتقای پنل کاربران🔝",'callback_data'=>"0"]],
[['text'=>"$coinpanel1",'callback_data'=>"panels-coinpanel1"],['text'=>"حرفه ای💢",'callback_data'=>"0"]],
[['text'=>"$coinpanel2",'callback_data'=>"panels-coinpanel2"],['text'=>"🌀ویژه",'callback_data'=>"0"]],
]])]);
}
//#################تنظیم دکمه#####################################
elseif(preg_match('/^sets-(.*)/', $data, $match)){
$dok = $match[1];
$dok1 = $$dok;
$user['step'] = "sete-$dok";
saveJson("melat/$userID.json",$user);
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"✅نام‌دکمه مورد نظر را ارسال نمایید
 نام فعلی : $dok1",
'parse_mode' => "html",
'reply_markup' => json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backbuttons"]],
]])]);
}
//###################################################################
elseif(preg_match('/^sete-(.*)/', $step, $match)){
$user['step']= 'none';
$doke = $match[1];
Save("lib/Button/$doke.txt",$msg);
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"✅با موفقیت تنظیم شد",
'reply_markup'=>json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backbuttons"]],
]])]);
saveJson("melat/$userID.json",$user);
}
//##################تنظیم مقدار پنل ها##################################
elseif(preg_match('/^panels-(.*)/', $data, $match)){
$dok = $match[1];
$user['step'] = "panels-$dok";
saveJson("melat/$userID.json",$user);
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"مقدار جدید برای تنظیم ارسال کنید",
'parse_mode' => "html",
'reply_markup' => json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backpanels"]],
]])]);
}
//###################################################################
elseif(preg_match('/^panels-(.*)/', $step, $match)){
$user['step']= 'none';
$doke = $match[1];
Save("lib/Button/$doke.txt",$msg);
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"✅با موفقیت تنظیم شد",
'reply_markup'=>json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backpanels"]],
]])]);
saveJson("melat/$userID.json",$user);
}
//###################################################################
elseif($data == "backtexts"){
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"کدام متن را میخواهید تغییر دهید؟",
'parse_mode'=>'HTML',
'reply_markup' => json_encode([
'inline_keyboard' => [
[["text" => "متن استارت", 'callback_data' => "setm-starttext"],["text" => "متن بنر زیرمجموعه", 'callback_data' => "setm-zirtext"]],
[["text" => "🔷 تنظیمات متن دکمه های ربات 🔷", 'callback_data' =>"0"]],
[["text" => "$dok1", 'callback_data' => "setm-dok1"]],
[["text" => "$dok2", 'callback_data' => "setm-dok2"],["text" => "$dok3", 'callback_data' => "setm-dok3"]],
[["text" => "$dok4", 'callback_data' => "setm-dok4"],["text" => "$dok5", 'callback_data' => "setm-dok5"]],
[["text" => "$dok6", 'callback_data' => "setm-dok6"],["text" => "$dok7", 'callback_data' => "setm-dok7"]],
[["text" => "$dok8", 'callback_data' => "setm-dok8"],["text" => "$dok9", 'callback_data' => "setm-dok9"]],
[["text" => "$dok10", 'callback_data' => "setm-dok0"],["text" => "$dok11", 'callback_data' => "setm-dok11"]],
]])]);
}
//###################################################################
elseif(preg_match('/^setm-(.*)/', $data, $match)){
$dok = $match[1];
$user['step'] = "setm-$dok";
saveJson("melat/$userID.json",$user);
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"متن مورد نظررا وارد نمایید",
'parse_mode' => "html",
'reply_markup' => json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backtexts"]],
]])]);
}
//###################################################################
elseif(preg_match('/^setm-(.*)/', $step, $match)){
$user['step']= 'none';
$doke = $match[1];
Save("lib/Button/$doke.txt",$msg);
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"✅با موفقیت تنظیم شد",
'reply_markup'=>json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backtexts"]],
]])]);
saveJson("melat/$userID.json",$user);
}
//################################################################
if($msg == "📌ثبت سفارش" and $Tc == 'private' and in_array($chatID,$list['admins'])){
$data_ads = json_decode(file_get_contents("lib/kodam/data-ads.json"),true);
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"💢 به بخش تنظیمات آیتم های سفارش ممبر خوش آمدید

👈در این بخش میتوانید تنظیمات تعداد $money ، تعداد عضو و نام هر آیتم را انجام دهید. 

⚠️توجه نمایید که حتما باید تمامی آیتم هارا کامل نمایید",
'reply_markup'=>json_encode([
'inline_keyboard' => [
[['text'=>"{$data_ads['Lock-sabtads']}",'callback_data'=>"dpo_Lock-sabtads"],['text'=>"🎯قفل ثبت سفارش",'callback_data'=>"0"]],
[['text'=>"{$data_ads['noeeads']}",'callback_data'=>"dpo_noeeads"],['text'=>"🖌نوع سفارش",'callback_data'=>"0"]],
[['text'=>"{$data_ads['eteleatch']}",'callback_data'=>"dpo_eteleatch"],['text'=>"📊دریافت اطلاعات کانال",'callback_data'=>"0"]],
[['text'=>"🚫تنظیمات ترک کانال🚫",'callback_data'=>"0"]],
[['text'=>"{$data_left['leftday']} روز",'callback_data'=>"coin_left-leftday"],['text'=>"⏰ترک کانال",'callback_data'=>"0"]],
[['text'=>"{$data_left['ksrleft']}",'callback_data'=>"ksr_left-ksrleft"],['text'=>"$icmoneyکسر $money",'callback_data'=>"0"]],
[['text'=>"{$data_left['afzleft']}",'callback_data'=>"afz_left-afzleft"],['text'=>"$icmoney$money بازگشتی",'callback_data'=>"0"]],
[['text'=>"🔰تنظیمات آیتم های سفارش ممبر🔰",'callback_data'=>"0"]],
[['text'=>"نام آیتم",'callback_data'=>"0"],['text'=>"تعداد $money",'callback_data'=>"0"],['text'=>"تعداد عضو",'callback_data'=>"0"]],
[['text'=>"$dokt1",'callback_data'=>"aytem_ads-dokt1"],['text'=>"$mmbrsabt11",'callback_data'=>"coin_ads-coinsabt1"],['text'=>"$mmbrsabt1",'callback_data'=>"member_ads-memsabt1"]],
[['text'=>"$dokt2",'callback_data'=>"aytem_ads-dokt2"],['text'=>"$mmbrsabt22",'callback_data'=>"coin_ads-coinsabt2"],['text'=>"$mmbrsabt2",'callback_data'=>"member_ads-memsabt2"]],
[['text'=>"$dokt3",'callback_data'=>"aytem_ads-dokt3"],['text'=>"$mmbrsabt33",'callback_data'=>"coin_ads-coinsabt3"],['text'=>"$mmbrsabt3",'callback_data'=>"member_ads-memsabt3"]],
[['text'=>"$dokt4",'callback_data'=>"aytem_ads-dokt4"],['text'=>"$mmbrsabt44",'callback_data'=>"coin_ads-coinsabt4"],['text'=>"$mmbrsabt4",'callback_data'=>"member_ads-memsabt4"]],
[['text'=>"$dokt5",'callback_data'=>"aytem_ads-dokt5"],['text'=>"$mmbrsabt55",'callback_data'=>"coin_ads-coinsabt5"],['text'=>"$mmbrsabt5",'callback_data'=>"member_ads-memsabt5"]],
[['text'=>"$dokt6",'callback_data'=>"aytem_ads-dokt6"],['text'=>"$mmbrsabt66",'callback_data'=>"coin_ads-coinsabt6"],['text'=>"$mmbrsabt6",'callback_data'=>"member_ads-memsabt6"]],
[['text'=>"فیلم یا متن اموزشی دستور /help",'callback_data'=>"set_help_ads"]],
]])]);
}
elseif(preg_match('/^dpo_(.*)/', $data, $match)){
$dok = $match[1];
$math = json_decode(file_get_contents("lib/kodam/data-ads.json"),true);
if($math["$dok"] == '✅فعال')$slts= '❌غیر فعال';
if($math["$dok"] == '❌غیر فعال')$slts= '✅فعال';
if($math["$dok"] == 'عکس دار')$slts= 'متنی';
if($math["$dok"] == 'متنی')$slts= 'عکس دار';
$math["$dok"]= "$slts";
saveJson("lib/kodam/data-ads.json",$math);
$data_ads = json_decode(file_get_contents("lib/kodam/data-ads.json"),true);
$data_left = json_decode(file_get_contents("lib/kodam/data-left.json"),true);
bot('EditMessageReplyMarkup',[
'chat_id'=>$chatID,
'message_id'=>$msg_id,
	'reply_markup'=>json_encode([
'inline_keyboard' => [
[['text'=>"{$data_ads['Lock-sabtads']}",'callback_data'=>"dpo_Lock-sabtads"],['text'=>"🎯قفل ثبت سفارش",'callback_data'=>"0"]],
[['text'=>"{$data_ads['noeeads']}",'callback_data'=>"dpo_noeeads"],['text'=>"🖌نوع سفارش",'callback_data'=>"0"]],
[['text'=>"{$data_ads['eteleatch']}",'callback_data'=>"dpo_eteleatch"],['text'=>"📊دریافت اطلاعات کانال",'callback_data'=>"0"]],
[['text'=>"🚫تنظیمات ترک کانال🚫",'callback_data'=>"0"]],
[['text'=>"{$data_left['leftday']} روز",'callback_data'=>"coin_left-leftday"],['text'=>"⏰ترک کانال",'callback_data'=>"0"]],
[['text'=>"{$data_left['ksrleft']}",'callback_data'=>"ksr_left-ksrleft"],['text'=>"$icmoneyکسر $money",'callback_data'=>"0"]],
[['text'=>"{$data_left['afzleft']}",'callback_data'=>"afz_left-afzleft"],['text'=>"$icmoney$money بازگشتی",'callback_data'=>"0"]],
[['text'=>"🔰تنظیمات آیتم های سفارش ممبر🔰",'callback_data'=>"0"]],
[['text'=>"نام آیتم",'callback_data'=>"0"],['text'=>"تعداد $money",'callback_data'=>"0"],['text'=>"تعداد عضو",'callback_data'=>"0"]],
[['text'=>"$dokt1",'callback_data'=>"aytem_ads-dokt1"],['text'=>"$mmbrsabt11",'callback_data'=>"coin_ads-coinsabt1"],['text'=>"$mmbrsabt1",'callback_data'=>"member_ads-memsabt1"]],
[['text'=>"$dokt2",'callback_data'=>"aytem_ads-dokt2"],['text'=>"$mmbrsabt22",'callback_data'=>"coin_ads-coinsabt2"],['text'=>"$mmbrsabt2",'callback_data'=>"member_ads-memsabt2"]],
[['text'=>"$dokt3",'callback_data'=>"aytem_ads-dokt3"],['text'=>"$mmbrsabt33",'callback_data'=>"coin_ads-coinsabt3"],['text'=>"$mmbrsabt3",'callback_data'=>"member_ads-memsabt3"]],
[['text'=>"$dokt4",'callback_data'=>"aytem_ads-dokt4"],['text'=>"$mmbrsabt44",'callback_data'=>"coin_ads-coinsabt4"],['text'=>"$mmbrsabt4",'callback_data'=>"member_ads-memsabt4"]],
[['text'=>"$dokt5",'callback_data'=>"aytem_ads-dokt5"],['text'=>"$mmbrsabt55",'callback_data'=>"coin_ads-coinsabt5"],['text'=>"$mmbrsabt5",'callback_data'=>"member_ads-memsabt5"]],
[['text'=>"$dokt6",'callback_data'=>"aytem_ads-dokt6"],['text'=>"$mmbrsabt66",'callback_data'=>"coin_ads-coinsabt6"],['text'=>"$mmbrsabt6",'callback_data'=>"member_ads-memsabt6"]],
]])]);
}
//###################################################################
elseif($data == "backaytemads"){
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
$data_left = json_decode(file_get_contents("lib/kodam/data-left.json"),true);
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"💢 به بخش تنظیمات آیتم های سفارش ممبر خوش آمدید

👈در این بخش میتوانید تنظیمات تعداد $money ، تعداد عضو و نام هر آیتم را انجام دهید. 

⚠️توجه نمایید که حتما باید تمامی آیتم هارا کامل نمایید",
'parse_mode'=>'HTML',
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text'=>"{$data_ads['Lock-sabtads']}",'callback_data'=>"dpo_Lock-sabtads"],['text'=>"🎯قفل ثبت سفارش",'callback_data'=>"0"]],
[['text'=>"{$data_ads['noeeads']}",'callback_data'=>"dpo_noeeads"],['text'=>"🖌نوع سفارش",'callback_data'=>"0"]],
[['text'=>"{$data_ads['eteleatch']}",'callback_data'=>"dpo_eteleatch"],['text'=>"📊دریافت اطلاعات کانال",'callback_data'=>"0"]],
[['text'=>"🚫تنظیمات ترک کانال🚫",'callback_data'=>"0"]],
[['text'=>"{$data_left['leftday']} روز",'callback_data'=>"coin_left-leftday"],['text'=>"⏰ترک کانال",'callback_data'=>"0"]],
[['text'=>"{$data_left['ksrleft']}",'callback_data'=>"ksr_left-ksrleft"],['text'=>"$icmoneyکسر $money",'callback_data'=>"0"]],
[['text'=>"{$data_left['afzleft']}",'callback_data'=>"afz_left-afzleft"],['text'=>"$icmoney$money بازگشتی",'callback_data'=>"0"]],
[['text'=>"🔰تنظیمات آیتم های سفارش ممبر🔰",'callback_data'=>"0"]],
[['text'=>"نام آیتم",'callback_data'=>"0"],['text'=>"تعداد $money",'callback_data'=>"0"],['text'=>"تعداد عضو",'callback_data'=>"0"]],
[['text'=>"$dokt1",'callback_data'=>"aytem_ads-dokt1"],['text'=>"$mmbrsabt11",'callback_data'=>"coin_ads-coinsabt1"],['text'=>"$mmbrsabt1",'callback_data'=>"member_ads-memsabt1"]],
[['text'=>"$dokt2",'callback_data'=>"aytem_ads-dokt2"],['text'=>"$mmbrsabt22",'callback_data'=>"coin_ads-coinsabt2"],['text'=>"$mmbrsabt2",'callback_data'=>"member_ads-memsabt2"]],
[['text'=>"$dokt3",'callback_data'=>"aytem_ads-dokt3"],['text'=>"$mmbrsabt33",'callback_data'=>"coin_ads-coinsabt3"],['text'=>"$mmbrsabt3",'callback_data'=>"member_ads-memsabt3"]],
[['text'=>"$dokt4",'callback_data'=>"aytem_ads-dokt4"],['text'=>"$mmbrsabt44",'callback_data'=>"coin_ads-coinsabt4"],['text'=>"$mmbrsabt4",'callback_data'=>"member_ads-memsabt4"]],
[['text'=>"$dokt5",'callback_data'=>"aytem_ads-dokt5"],['text'=>"$mmbrsabt55",'callback_data'=>"coin_ads-coinsabt5"],['text'=>"$mmbrsabt5",'callback_data'=>"member_ads-memsabt5"]],
[['text'=>"$dokt6",'callback_data'=>"aytem_ads-dokt6"],['text'=>"$mmbrsabt66",'callback_data'=>"coin_ads-coinsabt6"],['text'=>"$mmbrsabt6",'callback_data'=>"member_ads-memsabt6"]],
]])]);
}
//###################################################################
elseif(preg_match('/^coin_left-(.*)/', $data, $match)){
$dok = $match[1];
$user['step'] = "coin_left-$dok";
saveJson("melat/$userID.json",$user);
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"✅مدت زمانی که کاربران مجاز به ترک کانال های عضو شده نیستند را فقط به صورت عدد ارسال نمایید

👈🏼نمونه صحیح : 2
👈🏼نمونه غلط : 2 روز",
'parse_mode' => "html",
'reply_markup' => json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backaytemads"]],
]])]);
}
//###################################################################
elseif(preg_match('/^coin_left-(.*)/', $step, $match)){
if(preg_match('/^([0-9])/',$msg) and $msg >= 1){
$user['step']= 'none';
$slts = $match[1];
$data_left = json_decode(file_get_contents("lib/kodam/data-left.json"),true);
$data_left["$slts"]= "$msg";
saveJson("lib/kodam/data-left.json",$data_left);
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"✅با موفقیت تنظیم شد",
'reply_markup'=>json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backaytemads"]],
]])]);
saveJson("melat/$userID.json",$user);
}}
//###################################################################
elseif(preg_match('/^ksr_left-(.*)/', $data, $match)){
$dok = $match[1];
$user['step'] = "ksr_left-$dok";
saveJson("melat/$userID.json",$user);
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"✅تعداد $money کسر شده در ازای ترک کانال های عضو شده از کاربران را ارسال نمایید

👈🏼نمونه صحیح : 2
👈🏼نمونه غلط : 2 $money",
'parse_mode' => "html",
'reply_markup' => json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backaytemads"]],
]])]);
}
//###################################################################
elseif(preg_match('/^ksr_left-(.*)/', $step, $match)){
if(preg_match('/^([0-9])/',$msg) and $msg >= 1){
$user['step']= 'none';
$slts = $match[1];
$data_left = json_decode(file_get_contents("lib/kodam/data-left.json"),true);
$data_left["$slts"]= "$msg";
saveJson("lib/kodam/data-left.json",$data_left);
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"✅با موفقیت تنظیم شد",
'reply_markup'=>json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backaytemads"]],
]])]);
saveJson("melat/$userID.json",$user);
}}
//###################################################################
elseif(preg_match('/^afz_left-(.*)/', $data, $match)){
$dok = $match[1];
$user['step'] = "afz_left-$dok";
saveJson("melat/$userID.json",$user);
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"✅تعداد $money بازگشتی به کاربر سفارش دهنده ممبر در ازای ترک کانال توسط کاربران را ارسال کنید

👈🏼نمونه صحیح : 2
👈🏼نمونه غلط : 2 $money",
'parse_mode' => "html",
'reply_markup' => json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backaytemads"]],
]])]);
}
//###################################################################
elseif(preg_match('/^afz_left-(.*)/', $step, $match)){
if(preg_match('/^([0-9])/',$msg) and $msg >= 1){
$user['step']= 'none';
$slts = $match[1];
$data_left = json_decode(file_get_contents("lib/kodam/data-left.json"),true);
$data_left["$slts"]= "$msg";
saveJson("lib/kodam/data-left.json",$data_left);
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"✅با موفقیت تنظیم شد",
'reply_markup'=>json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backaytemads"]],
]])]);
saveJson("melat/$userID.json",$user);
}}
//###################################################################
elseif(preg_match('/^aytem_ads-(.*)/', $data, $match)){
$dok = $match[1];
$user['step'] = "aytem_ads-$dok";
saveJson("melat/$userID.json",$user);
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"✅نام آیتم مورد نظر را ارسال کنید

👈نمونه :👤سفارش ۲۵ ممبر",
'parse_mode' => "html",
'reply_markup' => json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backaytemads"]],
]])]);
}
//###################################################################
elseif(preg_match('/^aytem_ads-(.*)/', $step, $match)){
$user['step']= 'none';
$doke = $match[1];
Save("lib/Button/$doke.txt",$msg);
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"✅با موفقیت تنظیم شد",
'reply_markup'=>json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backaytemads"]],
]])]);
saveJson("melat/$userID.json",$user);
}
//###################################################################
elseif(preg_match('/^coin_ads-(.*)/', $data, $match)){
$dok = $match[1];
$user['step'] = "coin_ads-$dok";
saveJson("melat/$userID.json",$user);
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"✅مقدار $money که مایلید برای سفارش این آیتم از کاربران کسر شود را ارسال کنید

✅نمونه صحیح : 100
❌نمونه غلط : ۱۰۰",
'parse_mode' => "html",
'reply_markup' => json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backaytemads"]],
]])]);
}
//###################################################################
elseif(preg_match('/^coin_ads-(.*)/', $step, $match)){
if(preg_match('/^([0-9])/',$msg) and $msg >= 1){
$user['step']= 'none';
$doke = $match[1];
Save("lib/Button/$doke.txt",$msg);
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"✅با موفقیت تنظیم شد",
'reply_markup'=>json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backaytemads"]],
]])]);
saveJson("melat/$userID.json",$user);
}}
//###################################################################
elseif(preg_match('/^member_ads-(.*)/', $data, $match)){
$dok = $match[1];
$user['step'] = "member_ads-$dok";
saveJson("melat/$userID.json",$user);
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"✅مقدار ممبر درخواستی این آیتم را جهت سفارش کاربران ارسال نمایید

✅نمونه صحیح : 100
❌نمونه غلط : ۱۰۰",
'parse_mode' => "html",
'reply_markup' => json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backaytemads"]],
]])]);
}
//###################################################################
elseif(preg_match('/^member_ads-(.*)/', $step, $match)){
if(preg_match('/^([0-9])/',$msg) and $msg >= 1){
$user['step']= 'none';
$doke = $match[1];
Save("lib/Button/$doke.txt",$msg);
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"✅با موفقیت تنظیم شد",
'reply_markup'=>json_encode([
'inline_keyboard' => [
[["text"=>"➡️ بازگشت", 'callback_data' => "backaytemads"]],
]])]);
saveJson("melat/$userID.json",$user);
}}
//###################################################################
if($msg == "🎯تغییر پنل" and $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = "panel id";
saveJson("melat/$userID.json",$user);
bot('sendMessage', [
'chat_id' => $userID,
'text'=>"✅آیدی عددی کاربر مورد نظر را ارسال نمایید",
'parse_mode'=>'HTML',
'reply_to_message_id' => $msg_id,
'reply_markup' => json_encode([
'keyboard' => [
[['text' => "🔙بازگشت به منو"]],
],
"resize_keyboard" => true, 'one_time_keyboard' => true,
])]);}
elseif($step == "panel id" and $msg != "🔙بازگشت به منو"){
if(file_exists("melat/$msg.json")){
$users = json_decode(file_get_contents("melat/$msg.json"), true);
bot('sendmessage',[
'chat_id'=>$userID,
'text'=>"♻️نوع پنل کاربر : {$users['type-panel']}

👈مایلید پنل کاربر $msg به کدام یک از پنل های موجود تغییر یابد⁉️",
'parse_mode' => "MarkDown",
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text'=>"ویژه🌀",'callback_data'=>"panelse-ویژه-$msg"],['text'=>"حرفه ای💢",'callback_data'=>"panelse-حرفه ای-$msg"],['text'=>"عادی📍",'callback_data'=>"panelse-عادی-$msg"]],
]])]);
$user['step']= 'none';
saveJson("melat/$userID.json",$user);
}else{
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"⚠️ این کاربر در دیتابیس ربات شما یافت نشد.",
'parse_mode' => "MarkDown",
]);}}
//###################################################################
elseif(preg_match('/^panelse-(.*)-(.*)/', $data, $match)){
$user['step']= 'none';
saveJson("melat/$userID.json",$user);
$users = json_decode(file_get_contents("melat/$match[2].json"), true);
bot('answercallbackquery', [
'callback_query_id' => $data_id,
'text' => "✅پنل کاربر $match[2] با موفقیت به پنل $match[1] تغییر یافت
",
'show_alert' => true
]);
bot('editmessagetext',[
'chat_id'=>$chatID,
'message_id' => $msg_id,
'text'=>"✅ با موفقیت تنظیم شد",
	'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"♻️پنل فعلی کاربر : {$match[1]} ♻️", 'callback_data'=> '0']],
[['text'=>"👈🏻 تغییر پنل️", 'callback_data'=> "taghirpanel-$match[2]"]],
]])]);
$users['type-panel'] = "$match[1]";
saveJson("melat/$match[2].json",$users);
}
//###################################################################
elseif(preg_match('/^taghirpanel-(.*)/', $data, $match)){
$user['step']= 'none';
saveJson("melat/$userID.json",$user);
$users = json_decode(file_get_contents("melat/$match[1].json"), true);
bot('editmessagetext',[
'chat_id'=>$chatID,
'message_id' => $msg_id,
'text'=>"♻️نوع پنل کاربر : {$users['type-panel']}

👈مایلید پنل کاربر $match[1] به کدام یک از پنل های موجود تغییر یابد⁉️",
	'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"ویژه🌀",'callback_data'=>"panelse-ویژه-$match[1]"],['text'=>"حرفه ای💢",'callback_data'=>"panelse-حرفه ای-$match[1]"],['text'=>"عادی📍",'callback_data'=>"panelse-عادی-$match[1]"]],
]])]);}
//----------------------------------------------------------------------
if($msg == "🆔آیدی یاب" and $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = "search id";
saveJson("melat/$userID.json",$user);
bot('sendMessage', [
'chat_id' => $userID,
'text'=>"✅آیدی عددی کاربر مورد نظر را ارسال نمایید",
'parse_mode'=>'HTML',
'reply_to_message_id' => $msg_id,
'reply_markup' => json_encode([
'keyboard' => [
[['text' => "🔙بازگشت به منو"]],
],
"resize_keyboard" => true, 'one_time_keyboard' => true,
])]);}
elseif($step == "search id" and $msg != "🔙بازگشت به منو"){
if(file_exists("melat/$msg.json")){
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
bot('sendmessage',[
'chat_id'=>$userID,
'text'=>"📌 [$msg](tg://user?id=$msg)",
'parse_mode' => "MarkDown",
]);
}else{
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"⚠️ این کاربر در دیتابیس ربات شما یافت نشد.",
'parse_mode' => "MarkDown",
]);}}
//----------------------------------------------------------------------
else if($msg == '👤ادمین ها' and $Tc == 'private' and in_array($chatID,$list['admins'])){
$butt = json_encode(['keyboard'=>[
[['text' => "🔙بازگشت به منو"]],
[['text'=>'لیست مدیران📜']],($chatID == $admin?[['text'=>'افزودن ➕'],['text'=>'حذف کردن ➖']]:[])
],'resize_keyboard'=>true,'one_time_keyboard'=>true
]);
$user['step'] = 'none';
SM($chatID,"🔹 یکی از گزینه های زیر را انتخاب نمایید :️",'html',$msg_id,$butt);
saveJson("melat/$userID.json",$user);
}
//----------------------------------------------------------------------
else if($msg == 'افزودن ➕' and $Tc == 'private' and in_array($chatID,$list['admins'])){
if($chatID == $admin){
$user['step'] = 'add-admin';
SM($chatID,"آیدی عددی فرد مورد نظرتون رو ارسال کنید 🌱",'html',$msg_id,$Button_back_panel);
saveJson("melat/$userID.json",$user);
}}
else if($step == 'add-admin' and $Tc == 'private'){
if(is_numeric($msg)){
if(!in_array($msg,$list['admins'])){
SM($chatID,'کاربر '.$msg.' به عنوان یکی از مدیران منصوب شد❗️','MarkDown',$msg_id);
$user['step'] = 'none';
$list['admins'][] = $msg;
saveJson("lib/kodam/list.json",$list);
}else{
$user['step'] = 'none';
SM($chatID,"فرد مورد نظر شما از قبل مدیر ربات میباشد !",'MarkDown',$msg_id);
}
}else{
$user['step'] = 'none';
SM($chatID,"فقط ارسال ایدی عددی مجاز است ❗",'MarkDown',$msg_id);
}
saveJson("melat/$userID.json",$user);
}
//----------------------------------------------------------------------
else if($msg == 'حذف کردن ➖' and $Tc == 'private' and in_array($chatID,$list['admins'])){
if($chatID == $admin){
$user['step'] = 'ksr-admin';
SM($chatID,"آیدی عددی فرد مورد نظرتون رو ارسال کنید 🌱",'html',$msg_id,$Button_back_panel);
saveJson("melat/$userID.json",$user);
}}
else if($step == 'ksr-admin' and $Tc == 'private'){
if($msg !== "$admin"){
if(is_numeric($msg)){
if(in_array($msg,$list['admins'])){
SM($chatID,'کاربر '.$msg.' از لیست مدیران حذف گردید❗️️','MarkDown',$msg_id);
$user['step'] = 'none';
$search = array_search($msg,$list['admins']);
unset($list['admins'][$search]);
$list['admins'] = array_values($list['admins']);
saveJson("lib/kodam/list.json",$list);
}else{
$user['step'] = 'none';
SM($chatID,"فرد مورد نظر شما از قبل مدیر ربات نمیباشد !",'MarkDown',$msg_id);
}
}else{
$user['step'] = 'none';
SM($chatID,"فقط ارسال ایدی عددی مجاز است ❗",'MarkDown',$msg_id);
}
saveJson("melat/$userID.json",$user);
}else{
$user['step'] = 'none';
SM($chatID,"این شناسه برای ادمین اصلی میباشد ❗",'MarkDown',$msg_id);
}}
else if($msg == 'لیست مدیران📜' and $Tc == 'private' and in_array($chatID,$list['admins'])){
$admines=null;
foreach($list['admins'] as $id){
$admines = $admines .= "<a href='tg://user?id=$id'>$id</a>\n";
}
$user['step'] = 'none';
SM($chatID,'📍 لیست مدیران به صورت زیر میباشد :'.PHP_EOL.$admines,'html',$msg_id,$Button_back_panel);
saveJson("melat/$userID.json",$user);
}
//----------------------------------------------------------------------
elseif($msg == "🏆 برترین اعضا" or $msg == "📚راهنـما" and $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = "none";
saveJson("melat/$userID.json",$user);
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"به زودی",
]);
}
//----------------------------------------------------------------------
elseif($msg == "🆔 تنظیم کانال" and $Tc == 'private' and in_array($chatID,$list['admins'])){
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"گزینه مورد نظر را انتخاب کنید",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"📋تنظیم کانال تبلیغات"],['text'=>"🎁تنظیم کانال کدهدیه"]],
[['text'=>"🔐کانال جوین اجباری اول"],['text'=>"🔐کانال جوین اجباری دوم"]],
[['text' =>"🔙بازگشت به منو"]]

],'resize_keyboard' => true
])]);
}
//
elseif($msg == "📋تنظیم کانال تبلیغات" and $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = "getchannel";
saveJson("melat/$userID.json",$user);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"آیدی کانال تبلیغات را ارسال کنید",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🔙بازگشت به منو"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
])]);}
elseif($msg != "🔙بازگشت به منو" and $step == "getchannel"){
if(str_replace(['q','w','e','r','t','y','u','i','o','p','a','s','d','f','g','h','j','k','l','z','x','c','v','b','n','m','1','2','3','4','5','6','7','8','9','0','_'],null,strtolower($msg)) == null){ 
$channels23 = json_decode(file_get_contents("https://api.telegram.org/bot$tokens_bot/getChatMember?chat_id=@$msg&user_id=$id_adady"));
$tod30 = $channels23->result->status;
if($tod30 = 'administrator'){
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
file_put_contents("lib/kodam/cht.txt",$msg);
bot('sendMessage',['chat_id'=>$chatID,'text'=>"کانال تبلیغات به @$msg  تنظیم شد",'parse_mode'=>'HTML','reply_to_message_id'=>null,'reply_markup'=>$Button_Panel]);
}else{
bot('sendMessage',['chat_id'=>$chatID,'text'=>"❌ربات ادمین کانال @$msg نیست
برای تنظیم کانال باید ربات را ادمین کانال کنید",'parse_mode'=>"MarkDown",'reply_to_message_id'=>null,'reply_markup'=>json_encode(['keyboard'=>[[['text'=>"🔙بازگشت به منو"]],],"resize_keyboard"=>true,'one_time_keyboard' => true,])]);}}}
//#####################################################################
elseif($msg == "🎁تنظیم کانال کدهدیه" and $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = "ge0tchannel";
saveJson("melat/$userID.json",$user);
bot('sendMessage',['chat_id'=>$chatID,'text'=>"آیدی کانال اطلاع رسانی (کدهدیه) را بدون @ وارد کنید",'parse_mode'=>"MarkDown",'reply_to_message_id'=>$msg_id,'reply_markup'=>json_encode(['keyboard'=>[[['text'=>"🔙بازگشت به منو"]],],"resize_keyboard"=>true,'one_time_keyboard' => true,])]);}
elseif($msg != "🔙بازگشت به منو" and $step == "ge0tchannel"){
if(str_replace(['q','w','e','r','t','y','u','i','o','p','a','s','d','f','g','h','j','k','l','z','x','c','v','b','n','m','1','2','3','4','5','6','7','8','9','0','_'],null,strtolower($msg)) == null){ 
$channels23 = json_decode(file_get_contents("https://api.telegram.org/bot$tokens_bot/getChatMember?chat_id=@$msg&user_id=$id_adady"));
$tod30 = $channels23->result->status;
if($tod30 = 'administrator'){
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
file_put_contents("lib/kodam/giftch.txt",$msg);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"کانال کد هدیه به @$msg  تنظیم شد",
'parse_mode'=>'HTML',
'reply_to_message_id'=>null,
'reply_markup'=>$Button_Panel
]);
}else{
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"❌ربات ادمین کانال @$msg نیست
برای تنظیم کانال باید ربات را ادمین کانال کنید",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>null,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🔙بازگشت به منو"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
])]);}}}
//#####################################################################
elseif($msg == "🔐کانال جوین اجباری اول" and $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = "ge0tc1hannel";
saveJson("melat/$userID.json",$user);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"👈آیدی کانال مورد نظر را ارسال کنید
⚠️توجه : ربات باید ادمین کانال مورد نظر باشد",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🔙بازگشت به منو"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
])]);}
elseif($msg != "🔙بازگشت به منو" and $step == "ge0tc1hannel"){
if(str_replace(['q','w','e','r','t','y','u','i','o','p','a','s','d','f','g','h','j','k','l','z','x','c','v','b','n','m','1','2','3','4','5','6','7','8','9','0','_'],null,strtolower($msg)) == null){ 
$channels23 = json_decode(file_get_contents("https://api.telegram.org/bot$tokens_bot/getChatMember?chat_id=@$msg&user_id=$id_adady"));
$tod30 = $channels23->result->status;
if($tod30 = 'administrator'){
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
file_put_contents("lib/kodam/channel.txt",$msg);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"کانال جوین اجباری اول به @$msg  تنظیم شد",
'parse_mode'=>'HTML',
'reply_to_message_id'=>null,
'reply_markup'=>$Button_Panel
]);
}else{
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"❌ربات ادمین کانال @$msg نیست
برای تنظیم کانال باید ربات را ادمین کانال کنید",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>null,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🔙بازگشت به منو"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
])]);}}}
//#####################################################################
elseif($msg == "🔐کانال جوین اجباری دوم" and $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = "ge0tc2hannel";
saveJson("melat/$userID.json",$user);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"👈آیدی کانال مورد نظر را ارسال کنید
⚠️توجه : ربات باید ادمین کانال مورد نظر باشد",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🔙بازگشت به منو"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
])]);}
elseif($msg != "🔙بازگشت به منو" and $step == "ge0tc2hannel"){
if(str_replace(['q','w','e','r','t','y','u','i','o','p','a','s','d','f','g','h','j','k','l','z','x','c','v','b','n','m','1','2','3','4','5','6','7','8','9','0','_'],null,strtolower($msg)) == null){ 
$channels23 = json_decode(file_get_contents("https://api.telegram.org/bot$tokens_bot/getChatMember?chat_id=@$msg&user_id=$id_adady"));
$tod30 = $channels23->result->status;
if($tod30 = 'administrator'){
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
file_put_contents("lib/kodam/channel2.txt",$msg);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"کانال جوین اجباری دوم به @$msg  تنظیم شد",
'parse_mode'=>'HTML',
'reply_to_message_id'=>null,
'reply_markup'=>$Button_Panel
]);
}else{
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"❌ربات ادمین کانال @$msg نیست
برای تنظیم کانال باید ربات را ادمین کانال کنید",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>null,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🔙بازگشت به منو"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
])]);}}}
//----------------------------------------------------------------------
elseif($msg == "🎉 کد هدیه" and $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = "getid2gg";
saveJson("melat/$userID.json",$user);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"کد  هدیه ای که میخواید ساخته بشه رو وارد کنید",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🔙بازگشت به منو"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
])]);}
elseif($step == "getid2gg" and $msg != "🔙بازگشت به منو"){
$user['step'] = "sendcoin2gg-$msg";
saveJson("melat/$userID.json",$user);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"این کد شامل چند $money باشد؟",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🔙بازگشت به منو"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
])]);}
elseif(preg_match('/^sendcoin2gg-(.*)/', $step, $match) and $msg != "🔙بازگشت به منو" && $Tc == 'private') {
if(is_numeric($msg)){
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
$newgiftm = $match[1];

mkdir("lib/others");
mkdir("lib/others/codes");

file_put_contents("lib/others/codes/$newgiftm.txt",$msg);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"کد  هدیه با مشخصات زیر ساخته شد

👈کد : $newgiftm
 $money : $msg

درصورت تمایل به ارسال کد در کانال دکمه تایید را بزنید",
'parse_mode'=>'MarkDown',
'reply_to_message_id'=>$msg_id,
'reply_markup'=>json_encode([
'inline_keyboard' => [
[["text"=>"✅تایید", 'callback_data' => "sendbchanel-$newgiftm-$msg"]],
]])]);
}else{
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"لطفا عدد ارسال کنید!",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🔙بازگشت به منو"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
])]);}}
elseif(preg_match('/^sendbchanel-(.*)-(.*)/', $data, $match)){
$newgiftm = $match[1];
$newg = $match[2];
bot('sendMessage', [
'chat_id' =>"@$giftch",
'text' => "🎁 کد هدیه جدید ساخته شد👌

➖➖➖➖➖➖➖➖➖➖➖➖
🏷کد⬅️ : $newgiftm

🎈تعداد $money : $newg
➖➖➖➖➖➖➖➖➖➖➖➖
هرکی زود کد بالا رو داخل ربات بخش کد هدیه بزنه برندست🌀😍

⏰ساعت◀️ $date

📆تاریخ◀️ $time",
'parse_mode'=>'MarkDown',
'reply_markup'=>json_encode([
'inline_keyboard' => [
[["text" => "ورود به ربات", 'url' => "https://t.me/$boter_id"]],
]])]);
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"کد به کانال ارسال شد",
'parse_mode' => "html",
'reply_markup' => json_encode([
'inline_keyboard' => [
[["text"=>"❌ منقضی شد", 'callback_data' => "0"]],
]])]);}
elseif($msg == "📨 ارسال پیام" and $Tc == 'private' and in_array($chatID,$list['admins'])){
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"شیوه ارسال پیام را انتخاب کنید",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"پیام همگانی"],['text'=>"فوروارد همگانی"]],
[['text'=>"👤 پیام به کاربر"],['text'=>"🔙بازگشت به منو"]],
],'resize_keyboard' => true
])]);}
//////////------------------------\\\\\\\\\\\\\\///
else if($msg == 'فوروارد همگانی' and $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = 'fortoall-admin';
SM($chatID,"📍 لطفا پیام خود را فوروارد کنید [پیام فوروارد شده میتوانید از شخص یا کانال باشد]",'html',$msg_id,$Button_back_panel);
saveJson("melat/$userID.json",$user);
}
elseif($user['step'] == 'fortoall-admin') {
$user['step']= 'none';
saveJson("melat/$userID.json",$user);
SM($chatID,"پیام مورد نظر با موفقیت تنظیم شد. به زودی به تمامی کاربران ربات فوروارد میگردد❗️",'MarkDown',$msg_id);
foreach(glob('melat/*.json') as $array){
$userID = str_replace(['melat/', '.json'], '', $array);
if(is_numeric($userID)){
bot('forwardMessage', ['chat_id'=> $userID, 'from_chat_id'=> $chatID, 'message_id'=> $msg_id]);
}}
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"پیام مورد نظر به تمامی کاربران ربات فوروارد گردید✅"
]);}
//////////------------------------\\\\\\\\\\\\\\//
else if($msg == 'پیام همگانی' and $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = 'sendtoall-admin';
SM($chatID,"📍 لطفا متن یا رسانه خود را ارسال کنید [میتواند شامل عکس باشد]  همچنین میتوانید رسانه را همراه با کشپن [متن چسپیده به رسانه ارسال کنید]",'html',$msg_id,$Button_back_panel);
saveJson("melat/$userID.json",$user);
}
elseif($user['step'] == 'sendtoall-admin') {
$user['step']= 'none';
saveJson("melat/$userID.json",$user);
SM($chatID,"پیام مورد نظر با موفقیت تنظیم شد. به زودی به تمامی کاربران ربات ارسال میگردد❗️",'MarkDown',$msg_id);
$melat['members'] = 0;
saveJson("melat.json",$melat);
foreach(glob('melat/*.json') as $array){
$userID = str_replace(['melat/', '.json'], '', $array);
if(is_numeric($userID)){
$m = bot('copyMessage', ['chat_id'=> $userID, 'from_chat_id'=> $chatID, 'message_id'=> $msg_id]);
if($m->ok == 1){
$melat = json_decode(file_get_contents("melat.json"),true);
$member_online = $melat["members"];
$melat['members'] = $member_online + 1;
saveJson("melat.json",$melat);
}
}} 
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"پیام مورد نظر به تمامی کاربران ربات ارسال گردید✅",
]);}
//------------------
elseif($msg == "👤 پیام به کاربر" and $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = "getid2000";
saveJson("melat/$userID.json",$user);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"🗳لطفا شناسه کاربری را وارد کنید:",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🔙بازگشت به منو"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
])]);}
elseif($step == "getid2000" and $msg != "🔙بازگشت به منو"){
if(file_exists("melat/$msg.json")){
$user['step'] = "sendcoin2000-$msg";
saveJson("melat/$userID.json",$user);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"پیام خودرا ارسال نمایید",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🔙بازگشت به منو"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
])]);
}else{
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"همچین کاربری در ربات وجود ندارد
آیدی عددی درست ارسال کنید!",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🔙بازگشت به منو"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
])]);}}
elseif(preg_match('/^sendcoin2000-(.*)/', $step, $match) and $msg != "🔙بازگشت به منو" && $Tc == 'private') {
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
bot('sendMessage',[
'chat_id'=>$match[1],
'text'=>"$msg",
'parse_mode'=>"MarkDown",
]);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"ارسال شد",
'parse_mode'=>'MarkDown',
'reply_to_message_id'=>$msg_id,
'reply_markup'=>$Button_Panel
]);}
//////////------------------------\\\\\\\\\\\\\\///
else if($msg == "📥اهدای $money" and $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = 'sendd-admin';
SM($chatID,"📍 لطفا در خط اول ایدی فرد و در خط دوم میزان موجودی را وارد کنید
267785153
20",'html',$msg_id,$Button_back_panel);
saveJson("melat/$userID.json",$user);
}
elseif($user['step'] == 'sendd-admin') {
$user['step']= 'none';
saveJson("melat/$userID.json",$user);
$all = explode("\n", $msg);
SM($chatID,"افزایش موجودی با موفقیت انجام شد ✅",'html',$msg_id,$Button_Admins_Panel);
$user2 = json_decode(file_get_contents("melat/{$all[0]}.json"), 1);
$coin = $user2['Points'] + $all[1];
$user2['Points']= $coin;
saveJson("melat/{$all[0]}.json",$user2);
SM($all[0],"❗️تعداد $all[1] $money از طرف مدیریت به حساب شما واریز شد .",'html',null);
}
//////////------------------------\\\\\\\\\\\\\\///
else if($msg == "📤کسر $money" and $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = 'senddadmin';
SM($chatID,"📍 لطفا در خط اول ایدی فرد و در خط دوم میزان موجودی را وارد کنید
267785153
20",'html',$msg_id,$Button_back_panel);
saveJson("melat/$userID.json",$user);
}
elseif($user['step'] == 'senddadmin') {
$user['step']= 'none';
saveJson("melat/$userID.json",$user);
$all = explode("\n", $msg);
SM($chatID,"کسر موجودی با موفقیت انجام شد ✅",'html',$msg_id,$Button_Admins_Panel);
$user2 = json_decode(file_get_contents("melat/{$all[0]}.json"), 1);
$coin = $user2['Points'] - $all[1];
$user2['Points']= $coin;
saveJson("melat/{$all[0]}.json",$user2);
SM($all[0],"❗️تعداد $all[1] $money از حساب شما توسط مدیریت کسر شد .",'html',null);
}
//////////------------------------\\\\\\\\\\\\\\///
elseif($msg == "⚙️ زیرمجموعه گیری" and $Tc == 'private' and in_array($chatID,$list['admins'])){
$datazir = json_decode(file_get_contents("lib/kodam/data-zirmjmae.json"),true);
$Button_offon = json_encode(['inline_keyboard'=>[
[['text'=>"{$datazir['power']}",'callback_data'=>"ziradit-power"],['text'=>'🤖وضعیت','callback_data'=>'0']],
[['text'=>"{$datazir['Report']}",'callback_data'=>"ziradit-Report"],['text'=>"📢ارسال گزارش",'callback_data'=>"0"]],
[['text'=>"🔷زیرمجموعه فیک🔷",'callback_data'=>'0']],
[['text'=>"{$datazir['zirjoinads']}",'callback_data'=>"ziradsjoin-zirjoinads"],['text'=>'👤تعداد عضویت','callback_data'=>'0']],
[['text'=>"{$datazir['coin-join']}",'callback_data'=>"ziradscoin-coin-join"],['text'=>"تعداد $money",'callback_data'=>'0']],
[['text'=>"🔷تنظیم نوع بنر نمایشی🔷",'callback_data'=>'0']],
[['text'=>"{$datazir['banerzir']}",'callback_data'=>"ziradit-banerzir"],['text'=>'📃نوع بنر','callback_data'=>'0']],
[['text'=>"🔷تنظیمات متن زیرمجموعه🔷",'callback_data'=>'0']],
[['text'=>"📝تنظیم متن بنر",'callback_data'=>"settxtbaner-zirtext"],['text'=>"🖼تنظیم عکس بنر",'callback_data'=>'setphotobaner-piclink']],
[['text'=>"🗣تنظیم توضیحات",'callback_data'=>'settozihbaner-doktxt4']],
]]);
bot('sendMessage', [
'chat_id' => $chatID,
'text' => "گزینه مورد نظر را انتخاب نمایید",
'parse_mode' => "html",
'reply_to_message_id' => null,
'reply_markup' => $Button_offon]);
}
//============================================================================\\
elseif(preg_match('/^ziradit-(.*)/', $data, $match)){
$dok = $match[1];
$math = json_decode(file_get_contents("lib/kodam/data-zirmjmae.json"),true);
if($math["$dok"] == '📝متنی')$slts= '🖼عکس دار';
if($math["$dok"] == '🖼عکس دار')$slts= '📝متنی';
if($math["$dok"] == '✅فعال')$slts= '❌غیر فعال';
if($math["$dok"] == '❌غیر فعال')$slts= '✅فعال';
$math["$dok"]= "$slts";
saveJson("lib/kodam/data-zirmjmae.json",$math);
$datazir = json_decode(file_get_contents("lib/kodam/data-zirmjmae.json"),true);
$butt = json_encode(['inline_keyboard'=>[
[['text'=>"{$datazir['power']}",'callback_data'=>"ziradit-power"],['text'=>'🤖وضعیت','callback_data'=>'0']],
[['text'=>"{$datazir['Report']}",'callback_data'=>"ziradit-Report"],['text'=>"📢ارسال گزارش",'callback_data'=>"0"]],
[['text'=>"🔷زیرمجموعه فیک🔷",'callback_data'=>'0']],
[['text'=>"{$datazir['zirjoinads']}",'callback_data'=>"ziradsjoin-zirjoinads"],['text'=>'👤تعداد عضویت','callback_data'=>'0']],
[['text'=>"{$datazir['coin-join']}",'callback_data'=>"ziradscoin-coin-join"],['text'=>"تعداد $money",'callback_data'=>'0']],
[['text'=>"🔷تنظیم نوع بنر نمایشی🔷",'callback_data'=>'0']],
[['text'=>"{$datazir['banerzir']}",'callback_data'=>"ziradit-banerzir"],['text'=>'📃نوع بنر','callback_data'=>'0']],
[['text'=>"🔷تنظیمات متن زیرمجموعه🔷",'callback_data'=>'0']],
[['text'=>"📝تنظیم متن بنر",'callback_data'=>"settxtbaner-zirtext"],['text'=>"🖼تنظیم عکس بنر",'callback_data'=>'setphotobaner-piclink']],
[['text'=>"🗣تنظیم توضیحات",'callback_data'=>'settozihbaner-doktxt4']],
]]);
bot('editMessageReplyMarkup',['chat_id'=>$userID,'message_id'=>$msg_id,'reply_markup'=>$butt]);
}
//################تنظیم تعداد عضویت در کانال############################
elseif(preg_match('/^ziradsjoin-(.*)/', $data, $match)){
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"✅تعداد عضویت در کانال  را ارسال نمایید

👈🏼بعد ثبت تعداد عضویت تعیین شده در کانال ها، زیرمجموعه جدید برای کاربر محاسبه خواهد شد",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>null,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text' => "🔙بازگشت به منو"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
])]);
$user['step'] = "ziradsjoin-$match[1]";
saveJson("melat/$userID.json",$user);
}
elseif(preg_match('/^ziradsjoin-(.*)/', $step, $match)){
if(is_numeric($msg)){
$math = json_decode(file_get_contents("lib/kodam/data-zirmjmae.json"),true);
$math["$match[1]"]= "$msg";
saveJson("lib/kodam/data-zirmjmae.json",$math);
$datazir = json_decode(file_get_contents("lib/kodam/data-zirmjmae.json"),true);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"✅باموفقیت تنظیم شد",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>json_encode([
'inline_keyboard' => [
[['text'=>"{$datazir['power']}",'callback_data'=>"ziradit-power"],['text'=>'🤖وضعیت','callback_data'=>'0']],
[['text'=>"{$datazir['Report']}",'callback_data'=>"ziradit-Report"],['text'=>"📢ارسال گزارش",'callback_data'=>"0"]],
[['text'=>"🔷زیرمجموعه فیک🔷",'callback_data'=>'0']],
[['text'=>"{$datazir['zirjoinads']}",'callback_data'=>"ziradsjoin-zirjoinads"],['text'=>'👤تعداد عضویت','callback_data'=>'0']],
[['text'=>"{$datazir['coin-join']}",'callback_data'=>"ziradscoin-coin-join"],['text'=>"تعداد $money",'callback_data'=>'0']],
[['text'=>"🔷تنظیم نوع بنر نمایشی🔷",'callback_data'=>'0']],
[['text'=>"{$datazir['banerzir']}",'callback_data'=>"ziradit-banerzir"],['text'=>'📃نوع بنر','callback_data'=>'0']],
[['text'=>"🔷تنظیمات متن زیرمجموعه🔷",'callback_data'=>'0']],
[['text'=>"📝تنظیم متن بنر",'callback_data'=>"settxtbaner-zirtext"],['text'=>"🖼تنظیم عکس بنر",'callback_data'=>'setphotobaner-piclink']],
[['text'=>"🗣تنظیم توضیحات",'callback_data'=>'settozihbaner-doktxt4']],
]])]);
}}
//################تنظیم تعداد الماس در کانال############################
elseif(preg_match('/^ziradscoin-(.*)/', $data, $match)){
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"✅زمانی که زیرمجموعه در تعداد تایین شده , کانال عضو شد چه تعداد $money به کاربر اضافه شود

👈🏼 مثال : اگر در 15 کانال $money کسب کرد 10 $money به کاربری که این فرد زیرمجموعه ان است اضافه میشود.",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>null,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text' => "🔙بازگشت به منو"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
])]);
$user['step'] = "ziradscoin-$match[1]";
saveJson("melat/$userID.json",$user);
}
elseif(preg_match('/^ziradscoin-(.*)/', $step, $match)){
if(is_numeric($msg)){
$math = json_decode(file_get_contents("lib/kodam/data-zirmjmae.json"),true);
$math["$match[1]"]= "$msg";
saveJson("lib/kodam/data-zirmjmae.json",$math);
$datazir = json_decode(file_get_contents("lib/kodam/data-zirmjmae.json"),true);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"✅باموفقیت تنظیم شد",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>json_encode([
'inline_keyboard' => [
[['text'=>"{$datazir['power']}",'callback_data'=>"ziradit-power"],['text'=>'🤖وضعیت','callback_data'=>'0']],
[['text'=>"{$datazir['Report']}",'callback_data'=>"ziradit-Report"],['text'=>"📢ارسال گزارش",'callback_data'=>"0"]],
[['text'=>"🔷زیرمجموعه فیک🔷",'callback_data'=>'0']],
[['text'=>"{$datazir['zirjoinads']}",'callback_data'=>"ziradsjoin-zirjoinads"],['text'=>'👤تعداد عضویت','callback_data'=>'0']],
[['text'=>"{$datazir['coin-join']}",'callback_data'=>"ziradscoin-coin-join"],['text'=>"تعداد $money",'callback_data'=>'0']],
[['text'=>"🔷تنظیم نوع بنر نمایشی🔷",'callback_data'=>'0']],
[['text'=>"{$datazir['banerzir']}",'callback_data'=>"ziradit-banerzir"],['text'=>'📃نوع بنر','callback_data'=>'0']],
[['text'=>"🔷تنظیمات متن زیرمجموعه🔷",'callback_data'=>'0']],
[['text'=>"📝تنظیم متن بنر",'callback_data'=>"settxtbaner-zirtext"],['text'=>"🖼تنظیم عکس بنر",'callback_data'=>'setphotobaner-piclink']],
[['text'=>"🗣تنظیم توضیحات",'callback_data'=>'settozihbaner-doktxt4']],
]])]);
}}
//###############تنظیم متن بنر###############################
elseif(preg_match('/^settxtbaner-(.*)/', $data, $match)){
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"متن مورد نظررا وارد نمایید",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>null,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text' => "🔙بازگشت به منو"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
])]);
$user['step'] = "settxtbaner-$match[1]";
saveJson("melat/$userID.json",$user);
}
elseif(preg_match('/^settxtbaner-(.*)/', $step, $match)){
save("lib/Button/$match[1].txt",$msg);
$datazir = json_decode(file_get_contents("lib/kodam/data-zirmjmae.json"),true);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"✅باموفقیت تنظیم شد",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>json_encode([
'inline_keyboard' => [
[['text'=>"{$datazir['power']}",'callback_data'=>"ziradit-power"],['text'=>'🤖وضعیت','callback_data'=>'0']],
[['text'=>"{$datazir['Report']}",'callback_data'=>"ziradit-Report"],['text'=>"📢ارسال گزارش",'callback_data'=>"0"]],
[['text'=>"🔷زیرمجموعه فیک🔷",'callback_data'=>'0']],
[['text'=>"{$datazir['zirjoinads']}",'callback_data'=>"ziradsjoin-zirjoinads"],['text'=>'👤تعداد عضویت','callback_data'=>'0']],
[['text'=>"{$datazir['coin-join']}",'callback_data'=>"ziradscoin-coin-join"],['text'=>"تعداد $money",'callback_data'=>'0']],
[['text'=>"🔷تنظیم نوع بنر نمایشی🔷",'callback_data'=>'0']],
[['text'=>"{$datazir['banerzir']}",'callback_data'=>"ziradit-banerzir"],['text'=>'📃نوع بنر','callback_data'=>'0']],
[['text'=>"🔷تنظیمات متن زیرمجموعه🔷",'callback_data'=>'0']],
[['text'=>"📝تنظیم متن بنر",'callback_data'=>"settxtbaner-zirtext"],['text'=>"🖼تنظیم عکس بنر",'callback_data'=>'setphotobaner-piclink']],
[['text'=>"🗣تنظیم توضیحات",'callback_data'=>'settozihbaner-doktxt4']],
]])]);
}
//#######################تنظیم عکس بنر############################
elseif(preg_match('/^setphotobaner-(.*)/', $data, $match)){
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"عکس خود را ارسال کنید",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>null,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text' => "🔙بازگشت به منو"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
])]);
$user['step'] = "setphotobaner-$match[1]";
saveJson("melat/$userID.json",$user);
}
elseif(preg_match('/^setphotobaner-(.*)/', $step, $match)){
$filephoto = $update->message->photo;
$photo = $filephoto[count($filephoto)-1]->file_id;
if(isset($photo)){
save("lib/Button/$match[1].txt",$photo);
$datazir = json_decode(file_get_contents("lib/kodam/data-zirmjmae.json"),true);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"✅عکس بنر زیرمجموعه گیری با موفقیت تنظیم شد
⚠️توجه کنید درصورتی که متن زیرمجموعه گیری شما طولانی باشد به علت محدودیت تلگرام بنر  عکس دار زیر مجموعه گیری نمایش داده نخواهد شد!",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>json_encode([
'inline_keyboard' => [
[['text'=>"{$datazir['power']}",'callback_data'=>"ziradit-power"],['text'=>'🤖وضعیت','callback_data'=>'0']],
[['text'=>"{$datazir['Report']}",'callback_data'=>"ziradit-Report"],['text'=>"📢ارسال گزارش",'callback_data'=>"0"]],
[['text'=>"🔷زیرمجموعه فیک🔷",'callback_data'=>'0']],
[['text'=>"{$datazir['zirjoinads']}",'callback_data'=>"ziradsjoin-zirjoinads"],['text'=>'👤تعداد عضویت','callback_data'=>'0']],
[['text'=>"{$datazir['coin-join']}",'callback_data'=>"ziradscoin-coin-join"],['text'=>"تعداد $money",'callback_data'=>'0']],
[['text'=>"🔷تنظیم نوع بنر نمایشی🔷",'callback_data'=>'0']],
[['text'=>"{$datazir['banerzir']}",'callback_data'=>"ziradit-banerzir"],['text'=>'📃نوع بنر','callback_data'=>'0']],
[['text'=>"🔷تنظیمات متن زیرمجموعه🔷",'callback_data'=>'0']],
[['text'=>"📝تنظیم متن بنر",'callback_data'=>"settxtbaner-zirtext"],['text'=>"🖼تنظیم عکس بنر",'callback_data'=>'setphotobaner-piclink']],
[['text'=>"🗣تنظیم توضیحات",'callback_data'=>'settozihbaner-doktxt4']],
]])]);
}}
//################تنظیم متن توضیحات زیرمجموعه##################################
elseif(preg_match('/^settozihbaner-(.*)/', $data, $match)){
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"✅توضیحات بخش زیر مجموعه گیری را ارسال نمایید
این توضیحات می تواند حاوی مزایا ،$money و پورسانت زیرمجموعه گیری باشد",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>null,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text' => "🔙بازگشت به منو"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
])]);
$user['step'] = "settozihbaner-$match[1]";
saveJson("melat/$userID.json",$user);
}
elseif(preg_match('/^settozihbaner-(.*)/', $step, $match)){
save("lib/Button/$match[1].txt",$msg);
$datazir = json_decode(file_get_contents("lib/kodam/data-zirmjmae.json"),true);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"✅باموفقیت تنظیم شد",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>json_encode([
'inline_keyboard' => [
[['text'=>"{$datazir['power']}",'callback_data'=>"ziradit-power"],['text'=>'🤖وضعیت','callback_data'=>'0']],
[['text'=>"{$datazir['Report']}",'callback_data'=>"ziradit-Report"],['text'=>"📢ارسال گزارش",'callback_data'=>"0"]],
[['text'=>"🔷زیرمجموعه فیک🔷",'callback_data'=>'0']],
[['text'=>"{$datazir['zirjoinads']}",'callback_data'=>"ziradsjoin-zirjoinads"],['text'=>'👤تعداد عضویت','callback_data'=>'0']],
[['text'=>"{$datazir['coin-join']}",'callback_data'=>"ziradscoin-coin-join"],['text'=>"تعداد $money",'callback_data'=>'0']],
[['text'=>"🔷تنظیم نوع بنر نمایشی🔷",'callback_data'=>'0']],
[['text'=>"{$datazir['banerzir']}",'callback_data'=>"ziradit-banerzir"],['text'=>'📃نوع بنر','callback_data'=>'0']],
[['text'=>"🔷تنظیمات متن زیرمجموعه🔷",'callback_data'=>'0']],
[['text'=>"📝تنظیم متن بنر",'callback_data'=>"settxtbaner-zirtext"],['text'=>"🖼تنظیم عکس بنر",'callback_data'=>'setphotobaner-piclink']],
[['text'=>"🗣تنظیم توضیحات",'callback_data'=>'settozihbaner-doktxt4']],
]])]);
}
//---------------------------------------------------------------
elseif($msg == "🔕خاموش و روشن🔔" and $Tc == 'private' and in_array($chatID,$list['admins'])){
$databot = json_decode(file_get_contents("lib/kodam/data-power.json"),true);
$Button_offon = json_encode(['inline_keyboard'=>[
[['text'=>"{$databot['power']}",'callback_data'=>"powervaz-power"],['text'=>'🤖وضعیت','callback_data'=>'null']],
[['text'=>"{$databot['power-text']}",'callback_data'=>"powervaz-power-text"],['text'=>'‼️ارسال پیام','callback_data'=>'null']],
[['text'=>'📝تنظیم متن📝','callback_data'=>'set_text_sup']],
]]);
bot('sendMessage', [
'chat_id' => $chatID,
'text' => "✅در این بخش میتوانید در صورت نیاز ربات خود را غیر فعال کنید 

⚠️توجه داشته باشید زمانی که ربات خاموش است تنها مدیران ربات میتوانند با ربات کار کنند",
'parse_mode' => "html",
'reply_to_message_id' => null,
'reply_markup' => $Button_offon]);
}
//============================================================================\\
elseif(preg_match('/^powervaz-(.*)/', $data, $match)){
$dok = $match[1];
$math = json_decode(file_get_contents("lib/kodam/data-power.json"),true);
if($math["$dok"] == 'روشن')$slts= 'خاموش';
if($math["$dok"] == 'خاموش')$slts= 'روشن';
if($math["$dok"] == '✅فعال')$slts= '❌غیر فعال';
if($math["$dok"] == '❌غیر فعال')$slts= '✅فعال';
$math["$dok"]= "$slts";
saveJson("lib/kodam/data-power.json",$math);
$databot = json_decode(file_get_contents("lib/kodam/data-power.json"),true);
$butt = json_encode(['inline_keyboard'=>[
[['text'=>"{$databot['power']}",'callback_data'=>"powervaz-power"],['text'=>'🤖وضعیت','callback_data'=>'null']],
[['text'=>"{$databot['power-text']}",'callback_data'=>"powervaz-power-text"],['text'=>'‼️ارسال پیام','callback_data'=>'null']],
[['text'=>'📝تنظیم متن📝','callback_data'=>'set_text_sup']],
]]);
bot('editMessageReplyMarkup',['chat_id'=>$userID,'message_id'=>$msg_id,'reply_markup'=>$butt]);
}
//=============================================================================
elseif(preg_match('/^set_text_sup/', $data, $match)){
$user['step'] = 'set_text_sup';
saveJson("melat/$userID.json",$user);
bot('sendMessage',['chat_id'=>$userID,'text'=>"✅متن ارسالی ربات به کاربران در زمان خاموش بودن ربات را ارسال نمایید",'reply_to_message_id'=>null,'reply_markup'=>json_encode([
'keyboard' => [
[['text' => "🔙بازگشت به منو"]],
],
"resize_keyboard" => true, 'one_time_keyboard' => true,
])]);} 
elseif($step == "set_text_sup" and $msg != "🔙بازگشت به منو"){
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
$datbot = json_decode(file_get_contents("lib/kodam/data-power.json"),true);
$datbot['powertext'] = $msg;
file_put_contents('kodam/data-power.json',json_encode($datbot,448));
$databot = json_decode(file_get_contents("lib/kodam/data-power.json"),true);
$b00utt = json_encode(['inline_keyboard'=>[
[['text'=>"{$databot['power']}",'callback_data'=>"powervaz-power"],['text'=>'🤖وضعیت','callback_data'=>'null']],
[['text'=>"{$databot['power-text']}",'callback_data'=>"powervaz-power-text"],['text'=>'‼️ارسال پیام','callback_data'=>'null']],
[['text'=>'📝تنظیم متن📝','callback_data'=>'set_text_sup']],
]]);
bot('sendMessage',['chat_id'=>$userID,'text'=>"✅باموفقیت تنظیم شد️",'reply_to_message_id'=>$msg_id,'reply_markup'=>$b00utt]);
}
//=============================================================================
elseif($msg == "⚠️اخطاردهی" && $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = "sendwarn";
saveJson("melat/$userID.json",$user);
bot('sendMessage', [
'chat_id' => $chatID,
'text' => "✅آیدی عددی کاربر مورد نظر را ارسال نمایید",
'parse_mode' => "html",
'reply_to_message_id' => null,
'reply_markup' => json_encode([
'keyboard' => [
[['text' => "🔙بازگشت به منو"]],
],
"resize_keyboard" => true, 'one_time_keyboard' => true,
])]);} 
elseif($step == "sendwarn" and $msg != "🔙بازگشت به منو"){
if(file_exists("melat/$msg.json")){
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
$users = json_decode(file_get_contents("melat/$msg.json"), true);
$warn = $users["warn"];
$newin = $warn + 1;
$msg["warn"] = "$newin";
saveJson("melat/$msg.json",$users);
bot('sendMessage', [
'chat_id' => $chatID,
'text' => "✅ اخطار برای کاربر $msg فرستاده شد

تعداد اخطار های کاربر : $newin از 3",
'parse_mode'=>'HTML',
'reply_to_message_id'=>null,
'reply_markup'=>$Button_Panel
]);
bot('sendMessage', [
'chat_id' => $chatID,
'text' => "❌شما به دلیل رعایت نکردن قوانین ربات یک اخطار دریافت کردید

👈تعداد اخطار های شما : $newin از 3",
]);
}else{
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"⚠️ این کاربر در دیتابیس ربات شما یافت نشد.",
'parse_mode' => "MarkDown",
]);}}
//###################################################################
elseif($msg == "🛐پیگیری کاربر" && $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = "userInfo";
saveJson("melat/$userID.json",$user);
bot('sendMessage', [
'chat_id' => $chatID,
'text' => "✅با استفاده از این بخش می توانید اطلاعات حساب کاربری کاربر مورد نظر را دریافت کنید

👈آیدی عددی کاربر مورد نظر را ارسال نمایید",
'parse_mode' => "html",
'reply_to_message_id' => $msg_id,
'reply_markup' => json_encode([
'keyboard' => [
[['text' => "🔙بازگشت به منو"]],
],
"resize_keyboard" => true, 'one_time_keyboard' => true,
])]);} 
elseif($step == "userInfo" and $msg != "🔙بازگشت به منو"){
if(file_exists("melat/$msg.json")){
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
$users = json_decode(file_get_contents("melat/$msg.json"), true);
$inv = $users["zirmjmae"];
$Points = $users["Points"];
$timer = $users["time-day"];
$dayaes = $users['days'];
$recivecoins = $users["enteghal_as"];
$sentcoins = $users["enteghal_to"];
$panele = $users['type-panel'];
$dates = $users['date-start'];
$sefaresh = $users["sefaresh"];
$warn = $users["warn"];
$coin_admin = $users["send-coin-admin"];
$invcoin = $users["zirmjmae-porsant"];
$invin = $users["zirmjmae-join"];
bot('sendMessage', [
'chat_id' => $chatID,
'text' => "
🔰شماره کاربری : $msg
📆تاریخ عضویت : $dates
♻️نوع پنل : $panele

⚠️اخطار : $warn از 3
🎁هدیه مدیریت : $coin_admin

💳 انتقالات 
📥دریافتی : $recivecoins
📤واریزی : $sentcoins

👥 زیر مجموعه ها
✔️ مجموع : $inv
✔️ تعداد عضویت : $invin
✔️ پورسانت دریافتی : $invcoin

✅ موجودی : $Points
",
'parse_mode'=>'HTML',
'reply_to_message_id'=>null,
'reply_markup'=>$Button_Panel
]);
}else{
bot('sendmessage',[
'chat_id'=>$chatID,
'text'=>"⚠️ این کاربر در دیتابیس ربات شما یافت نشد.",
'parse_mode' => "MarkDown",
]);}}
//###################################################################
elseif($msg == "✂️تنظیمات لغو سفارش" and $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
$data_Cancellads = json_decode(file_get_contents("lib/kodam/data-Cancellads.json"),true);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"⭕️به بخش تنظیمات لغو سفارش خوش آمدید 

✅با استفاده از تنظیمات این بخش میتوانید لغو سفارشات توسط کاربر را کنترل نمایید 


👈جهت تنظیم هر آیتم گزینه مورد نظر را بزنید",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>json_encode([
'inline_keyboard' => [
[['text'=>"{$data_Cancellads['Condition']}",'callback_data'=>"trrnfr_Condition"],['text'=>"♻️وضعیت",'callback_data'=>"0"]],
[['text'=>"{$data_Cancellads['mincancell']}",'callback_data'=>"trnuufr_mincancell"],['text'=>"⬇️حداقل مجاز",'callback_data'=>"0"]],
[['text'=>"{$data_Cancellads['timecancell']} ثانیه",'callback_data'=>"trndgfrs-timecancell"],['text'=>"⌛️مدت زمان",'callback_data'=>"0"]],
[['text'=>"{$data_Cancellads['Coefficientadscoin']}",'callback_data'=>"trnfrse-Coefficientadscoin"],['text'=>"$icmoney ضریب بازگشت $money",'callback_data'=>"0"]],
]])]);
}
//################تغییر وضعیت##################################
elseif(preg_match('/^trrnfr_(.*)/', $data, $match)){
$dok = $match[1];
$math = json_decode(file_get_contents("lib/kodam/data-Cancellads.json"),true);
if($math["$dok"] == '✅فعال')$slts= '❌غیر فعال';
if($math["$dok"] == '❌غیر فعال')$slts= '✅فعال';
$math["$dok"]= "$slts";
saveJson("lib/kodam/data-Cancellads.json",$math);
$data_Cancellads = json_decode(file_get_contents("lib/kodam/data-Cancellads.json"),true);
bot('EditMessageReplyMarkup',[
'chat_id'=>$chatID,
'message_id'=>$msg_id,
	'reply_markup'=>json_encode([
'inline_keyboard' => [
[['text'=>"{$data_Cancellads['Condition']}",'callback_data'=>"trrnfr_Condition"],['text'=>"♻️وضعیت",'callback_data'=>"0"]],
[['text'=>"{$data_Cancellads['mincancell']}",'callback_data'=>"trnuufr_mincancell"],['text'=>"⬇️حداقل مجاز",'callback_data'=>"0"]],
[['text'=>"{$data_Cancellads['timecancell']} ثانیه",'callback_data'=>"trndgfrs-timecancell"],['text'=>"⌛️مدت زمان",'callback_data'=>"0"]],
[['text'=>"{$data_Cancellads['Coefficientadscoin']}",'callback_data'=>"trnfrse-Coefficientadscoin"],['text'=>"$icmoney ضریب بازگشت $money",'callback_data'=>"0"]],
]])]);
}
//###################حداقل سفارش برای لغو############################
elseif(preg_match('/^trnuufr_(.*)/', $data, $match)){
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"✅حداقل سفارش ممبر مجاز جهت لغو سفارش را ارسال نمایید 

👈🏼به طور مثال اگر حداقل سفارش ممبر را روی ۵۰۰ ممبر تنظیم کنید،تبلیغات با سفارش کمتر ۵۰۰ ممبر امکان لغو سفارش را نخواهند داشت

⚠️عدد ارسالی فاقد هرگونه ایموجی و یا موارد دیگر باشد

✅نمونه صحیح: 5
❌نمونه غلط : 5 $money",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>null,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text' => "🔙بازگشت به منو"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
])]);
$user['step'] = "fheswdeg-$match[1]";
saveJson("melat/$userID.json",$user);
}
elseif(preg_match('/^fheswdeg-(.*)/', $step, $match)){
if(is_numeric($msg)){
$math = json_decode(file_get_contents("lib/kodam/data-Cancellads.json"),true);
$math["$match[1]"]= "$msg";
saveJson("lib/kodam/data-Cancellads.json",$math);
$data_Cancellads = json_decode(file_get_contents("lib/kodam/data-Cancellads.json"),true);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"✅باموفقیت تنظیم شد",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>json_encode([
'inline_keyboard' => [
[['text'=>"{$data_Cancellads['Condition']}",'callback_data'=>"trrnfr_Condition"],['text'=>"♻️وضعیت",'callback_data'=>"0"]],
[['text'=>"{$data_Cancellads['mincancell']}",'callback_data'=>"trnuufr_mincancell"],['text'=>"⬇️حداقل مجاز",'callback_data'=>"0"]],
[['text'=>"{$data_Cancellads['timecancell']} ثانیه",'callback_data'=>"trndgfrs-timecancell"],['text'=>"⌛️مدت زمان",'callback_data'=>"0"]],
[['text'=>"{$data_Cancellads['Coefficientadscoin']}",'callback_data'=>"trnfrse-Coefficientadscoin"],['text'=>"$icmoney ضریب بازگشت $money",'callback_data'=>"0"]],
]])]);
}}
//#####################مدت زمان###################################
elseif(preg_match('/^trndgfrs-(.*)/', $data, $match)){
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"❓چند ثانیه پس از ثبت تبلیغ کاربر قادر است تبلیغ را لغو نماید؟

⚠️عدد ارسالی فاقد هرگونه ایموجی و یا موارد دیگر باشد

✅نمونه صحیح: 5
❌نمونه غلط : 5 $money",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>null,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text' => "🔙بازگشت به منو"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
])]);
$user['step'] = "fheheg-$match[1]";
saveJson("melat/$userID.json",$user);
}
elseif(preg_match('/^fheheg-(.*)/', $step, $match)){
if(is_numeric($msg)){
$math = json_decode(file_get_contents("lib/kodam/data-Cancellads.json"),true);
$math["$match[1]"]= "$msg";
saveJson("lib/kodam/data-Cancellads.json",$math);
$data_Cancellads = json_decode(file_get_contents("lib/kodam/data-Cancellads.json"),true);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"✅باموفقیت تنظیم شد",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>json_encode([
'inline_keyboard' => [
[['text'=>"{$data_Cancellads['Condition']}",'callback_data'=>"trrnfr_Condition"],['text'=>"♻️وضعیت",'callback_data'=>"0"]],
[['text'=>"{$data_Cancellads['mincancell']}",'callback_data'=>"trnuufr_mincancell"],['text'=>"⬇️حداقل مجاز",'callback_data'=>"0"]],
[['text'=>"{$data_Cancellads['timecancell']} ثانیه",'callback_data'=>"trndgfrs-timecancell"],['text'=>"⌛️مدت زمان",'callback_data'=>"0"]],
[['text'=>"{$data_Cancellads['Coefficientadscoin']}",'callback_data'=>"trnfrse-Coefficientadscoin"],['text'=>"$icmoney ضریب بازگشت $money",'callback_data'=>"0"]],
]])]);
}}
//################ضریب بازگشت الماس لغو سفارش####################
elseif(preg_match('/^trnfrse-(.*)/', $data, $match)){
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"✅ضریب بازگشت $money پس از لغو سفارش را ارسال نمایید 

👈🏼ضریب ارسالی شما در تعداد ممبر باقی مانده از سفارش کاربر ضرب و سپس به موجودی کاربر اضافه خواهد شد.

⚠️عدد ارسالی فاقد هرگونه ایموجی و یا موارد دیگر باشد

✅نمونه صحیح: 0.2
❌نمونه غلط : 0/2 یا  1,2",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>null,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text' => "🔙بازگشت به منو"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
])]);
$user['step'] = "fheswgheg-$match[1]";
saveJson("melat/$userID.json",$user);
}
elseif(preg_match('/^fheswgheg-(.*)/', $step, $match)){
if(is_numeric($msg)){
$math = json_decode(file_get_contents("lib/kodam/data-Cancellads.json"),true);
$math["$match[1]"]= "$msg";
saveJson("lib/kodam/data-Cancellads.json",$math);
$data_Cancellads = json_decode(file_get_contents("lib/kodam/data-Cancellads.json"),true);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"✅باموفقیت تنظیم شد",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>json_encode([
'inline_keyboard' => [
[['text'=>"{$data_Cancellads['Condition']}",'callback_data'=>"trrnfr_Condition"],['text'=>"♻️وضعیت",'callback_data'=>"0"]],
[['text'=>"{$data_Cancellads['mincancell']}",'callback_data'=>"trnuufr_mincancell"],['text'=>"⬇️حداقل مجاز",'callback_data'=>"0"]],
[['text'=>"{$data_Cancellads['timecancell']} ثانیه",'callback_data'=>"trndgfrs-timecancell"],['text'=>"⌛️مدت زمان",'callback_data'=>"0"]],
[['text'=>"{$data_Cancellads['Coefficientadscoin']}",'callback_data'=>"trnfrse-Coefficientadscoin"],['text'=>"$icmoney ضریب بازگشت $money",'callback_data'=>"0"]],
]])]);
}}
//###################################################################
elseif($msg == "$icmoney تنظیمات انتقال $money" and $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
$data_transfer = json_decode(file_get_contents("lib/kodam/data-transfer.json"),true);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"⭕️به بخش تنظیمات انتقال $money خوش آمدید 

✅با استفاده از تنظیمات این بخش میتوانید انتقالات $money توسط کاربر را کنترل نمایید 


👈جهت تنظیم هر آیتم گزینه مورد نظر را بزنید",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>json_encode([
'inline_keyboard' => [
[['text'=>"{$data_transfer['Condition']}",'callback_data'=>"trnfr_Condition"],['text'=>"♻️وضعیت",'callback_data'=>"0"]],
[['text'=>"{$data_transfer['Report']}",'callback_data'=>"trnfr_Report"],['text'=>"📢ارسال گزارش",'callback_data'=>"0"]],
[['text'=>"{$data_transfer['mintrnfr']}",'callback_data'=>"trnfrs-mintrnfr-حداقل"],['text'=>"⬇️حداقل انتقال",'callback_data'=>"0"]],
[['text'=>"{$data_transfer['maxtrnfr']}",'callback_data'=>"trnfrs-maxtrnfr-حداکثر"],['text'=>"⬆️حداکثر انتقال",'callback_data'=>"0"]],
]])]);
}
elseif(preg_match('/^trnfr_(.*)/', $data, $match)){
$dok = $match[1];
$math = json_decode(file_get_contents("lib/kodam/data-transfer.json"),true);
if($math["$dok"] == '✅فعال')$slts= '❌غیر فعال';
if($math["$dok"] == '❌غیر فعال')$slts= '✅فعال';
$math["$dok"]= "$slts";
saveJson("lib/kodam/data-transfer.json",$math);
$data_transfer = json_decode(file_get_contents("lib/kodam/data-transfer.json"),true);
bot('EditMessageReplyMarkup',[
'chat_id'=>$chatID,
'message_id'=>$msg_id,
	'reply_markup'=>json_encode([
'inline_keyboard' => [
[['text'=>"{$data_transfer['Condition']}",'callback_data'=>"trnfr_Condition"],['text'=>"♻️وضعیت",'callback_data'=>"0"]],
[['text'=>"{$data_transfer['Report']}",'callback_data'=>"trnfr_Report"],['text'=>"📢ارسال گزارش",'callback_data'=>"0"]],
[['text'=>"{$data_transfer['mintrnfr']}",'callback_data'=>"trnfrs-mintrnfr-حداقل"],['text'=>"⬇️حداقل انتقال",'callback_data'=>"0"]],
[['text'=>"{$data_transfer['maxtrnfr']}",'callback_data'=>"trnfrs-maxtrnfr-حداکثر"],['text'=>"⬆️حداکثر انتقال",'callback_data'=>"0"]],
]])]);
}
elseif(preg_match('/^trnfrs-(.*)-(.*)/', $data, $match)){
$dok = $match[2];
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"✅$dok میزان انتقال $money را ارسال نمایید

⚠️عدد ارسالی فاقد هرگونه ایموجی و یا موارد دیگر باشد

✅نمونه صحیح: 5
❌نمونه غلط : 5 $money",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>null,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text' => "🔙بازگشت به منو"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
])]);
$user['step'] = "fheswgddheg-$match[1]";
saveJson("melat/$userID.json",$user);
}
elseif(preg_match('/^fheswgddheg-(.*)/', $step, $match)){
if(is_numeric($msg)){
$math = json_decode(file_get_contents("lib/kodam/data-transfer.json"),true);
$math["$match[1]"]= "$msg";
saveJson("lib/kodam/data-transfer.json",$math);
$data_transfer = json_decode(file_get_contents("lib/kodam/data-transfer.json"),true);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"✅باموفقیت تنظیم شد",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>json_encode([
'inline_keyboard' => [
[['text'=>"{$data_transfer['Condition']}",'callback_data'=>"trnfr_Condition"],['text'=>"♻️وضعیت",'callback_data'=>"0"]],
[['text'=>"{$data_transfer['Report']}",'callback_data'=>"trnfr_Report"],['text'=>"📢ارسال گزارش",'callback_data'=>"0"]],
[['text'=>"{$data_transfer['mintrnfr']}",'callback_data'=>"trnfrs-mintrnfr-حداقل"],['text'=>"⬇️حداقل انتقال",'callback_data'=>"0"]],
[['text'=>"{$data_transfer['maxtrnfr']}",'callback_data'=>"trnfrs-maxtrnfr-حداکثر"],['text'=>"⬆️حداکثر انتقال",'callback_data'=>"0"]],
]])]);
}}
//###################################################################
else if($msg == '♻️بروزرسانی'  and $Tc == 'private' and in_array($chatID,$list['admins'])){
$Button_upd = json_encode(['keyboard'=>[
[['text'=>'♻️انجام بروز رسانی♻️']],
[['text' => "🔙بازگشت به منو"]],
],'resize_keyboard'=>true]);
$user['step'] = 'updeta'; 
  SM($chatID,"⁉️درصورتی که بروز رسانی جدید ربات در دسترس باشد با بروز کردن ربات به نسخه جدید میتوانید ربات خود را بهبود ببخشید

👈بهتر است هر هفته این گزینه را امتحان کنید تا در صورت وجود باگ یا تغییرات ربات شما ارتقا یابد:",'html',null,$Button_upd);
saveJson("melat/$userID.json",$user);
}
//###################################################################
else if($msg == '♻️انجام بروز رسانی♻️' and $step == 'updeta' and $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = 'none';
 SM($chatID,"اپدیت ربات شما در حال انجام می باشد...",'html',null);
sleep(1.5);
bot('editMessageText',[ 
'chat_id'=>$chatID, 
'message_id'=>$msg_id + 1, 
'text'=>'⬛️⬜️⬜️⬜️⬜️ %20' 
]); 
sleep(2.5);
bot('editMessageText',[ 
'chat_id'=>$chatID, 
'message_id'=>$msg_id + 1, 
'text'=>'⬛️⬛️⬜️⬜️⬜️ %40' 
]); 
sleep(2.5); 
bot('editMessageText',[ 
'chat_id'=>$chatID, 
'message_id'=>$msg_id + 1, 
'text'=>'⬛️⬛️⬛️⬜️⬜️ %60' 
]); 
sleep(2.5); 
bot('editMessageText',[ 
'chat_id'=>$chatID, 
'message_id'=>$msg_id + 1, 
'text'=>'⬛️⬛️⬛️⬛️⬜️ %80' 
]); 
sleep(2.5);
bot('editMessageText',[ 
'chat_id'=>$chatID, 
'message_id'=>$msg_id + 1, 
'text'=>'⬛️⬛️⬛️⬛️⬛️ %100' 
]); 
sleep(2.5);
bot('editMessageText',[ 
'chat_id'=>$chatID, 
'message_id'=>$msg_id + 1, 
'text'=>'%100درحال بارگزاری اطلاعات' ]); 
//file_get_contents("http://cactus.plus-server.ir/bot/api.php?password=aliamparsayazd&&type=cactusup&&token=$tokens_bot&&admin=$admins&&idbot=$boter_id");
copy('../../../Source/member/bot.php',"bot.php");
copy('../../../Source/member/lib/class.php',"lib/class.php");
sleep(1); 
bot('editMessageText',[ 
'chat_id'=>$chatID, 
'message_id'=>$msg_id + 1, 
'text'=>'✅ربات شما با موفقیت به اخرین نسخه اپدیت شد
جهت شروع مجدد /start را بزنید' 
]); 
saveJson("melat/$userID.json",$user);
}
//###################################################################
else if($msg == '⏳اشتراک باقی مانده' and $Tc == 'private' and in_array($chatID,$list['admins'])){
date_default_timezone_set('Asia/Tehran'); 
$sharge = file_get_contents("Lite.txt");
$a = date('Y/m/d');
$b = "$sharge";
$sec = strtotime($b)-strtotime($a);
$days = $sec/86400;
$d0ays = explode('.',$days)[0];
SM($chatID,"⏳از شارژ ربات شما <code>$d0ays</code> روز باقی مانده است",'html');
}
//###################################################################
elseif($msg == "🎗تکمیل سفارش" and $Tc == 'private' and in_array($chatID,$list['admins'])){
$user['step'] = 'none';
saveJson("melat/$userID.json",$user);
$data = json_decode(file_get_contents("lib/kodam/data.json"),true);
bot('sendMessage',[
'chat_id'=>$chatID,
'text'=>"✅با استفاده از تنظیمات این بخش می توانید به سفارشات موجود در کانال تبلیغات پایان بدهید

⚠️در صورتی که این بخش فعال باشد ادمین اصلی ربات می تواند با زدن دکمه گزارش تخلف در زیر هر تبلیغ ، به آن تبلیغ پایان دهد",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$msg_id,
'reply_markup'=>json_encode([
'inline_keyboard' => [
[["text"=>"{$data['takmil_ads']}", 'callback_data' => "takmil_ads"]],
]])]);
}
//###################################################################
elseif($data == "takmil_ads"){
$math = json_decode(file_get_contents("lib/kodam/data.json"),true);
if($math["takmil_ads"] == '✅فعال')$slts= '❌غیر فعال';
if($math["takmil_ads"] == '❌غیر فعال')$slts= '✅فعال';
$math["takmil_ads"]= "$slts";
saveJson("lib/kodam/data.json",$math);
bot('EditMessageReplyMarkup', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'reply_markup' => json_encode([
'inline_keyboard' => [
[["text"=>"$slts", 'callback_data' => "takmil_ads"]],
]])]);
}
elseif($data == "0"){
$chatID = $update->callback_query->message->chat->id;
bot('answercallbackquery', [
'callback_query_id' => $data_id,
'text' => "❌ این دکمه کاربرد خاصی ندارد.",
'show_alert' => true
]);
}
//#####################################################################
elseif($data == 'taeh_dokc' and $Tc = 'private'){
if($keyboard_ch == 1) $caller1 = "✅";
if($keyboard_ch == 2) $caller1 = "❌";
if($keyboard_ch == 3) $caller1 = "❌";
if($keyboard_ch == 1) $caller2 = "❌";
if($keyboard_ch == 2) $caller2 = "✅";
if($keyboard_ch == 3) $caller2 = "❌";
if($keyboard_ch == 1) $caller3 = "❌";
if($keyboard_ch == 2) $caller3 = "❌";
if($keyboard_ch == 3) $caller3 = "✅";
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"✅طرح مورد نظر را انتخاب نمائید",
'parse_mode' => "html",
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text'=>"$caller1",'callback_data'=>'keyc-1'],['text'=>"$caller2",'callback_data'=>'keyc-2'],['text'=>"$caller3",'callback_data'=>'keyc-3']],
[["text"=>"➡️ بازگشت", 'callback_data' => "backbuttons"]],
]])
]);
}
//###################################################################
elseif(preg_match('/^keyc-(.*)/', $data, $match)){
$caller = $match[1];
if($caller == 1) $caller1 = "✅";
if($caller == 2) $caller1 = "❌";
if($caller == 3) $caller1 = "❌";
if($caller == 1) $caller2 = "❌";
if($caller == 2) $caller2 = "✅";
if($caller == 3) $caller2 = "❌";
if($caller == 1) $caller3 = "❌";
if($caller == 2) $caller3 = "❌";
if($caller == 3) $caller3 = "✅";
Save("lib/keyboard/channelkey.txt","$caller");
bot('editmessagetext', [
'chat_id' => $chatID,
'message_id' => $msg_id,
'text'=>"✅طرح کیبورد شما بروز شد",
'parse_mode' => "html",
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text'=>"$caller1",'callback_data'=>'keyc-1'],['text'=>"$caller2",'callback_data'=>'keyc-2'],['text'=>"$caller3",'callback_data'=>'keyc-3']],
[["text"=>"➡️ بازگشت", 'callback_data' => "backbuttons"]],
]])
]);
/*

bot('sendMessage', [
'chat_id' => $chatID,
'text' => "",
'parse_mode' => "html",
'reply_markup' => json_encode([
'inline_keyboard' => [

]
])
]);
*/
}
//////////------------------------\\\\\\\\\\\\\\///
elseif($data == 'chinesh_home' and $Tc = 'private'){
if(file_exists("lib/keyboard/home/line11.txt")){
$line1_1 = file_get_contents("lib/keyboard/home/line11.txt");
if($line1_1 != null ){
$line1_1 = str_replace('DOK1',$dok1,$line1_1);
$line1_1 = str_replace('DOK2',$dok2,$line1_1);
$line1_1 = str_replace('DOK3',$dok3,$line1_1);
$line1_1 = str_replace('DOK4',$dok4,$line1_1);
$line1_1 = str_replace('DOK5',$dok5,$line1_1);
$line1_1 = str_replace('DOK6',$dok6,$line1_1);
$line1_1 = str_replace('DOK7',$dok7,$line1_1);
$line1_1 = str_replace('DOK8',$dok8,$line1_1);
$line1_1 = str_replace('DOK9',$dok9,$line1_1);
$line1_1 = str_replace('DOK0',$dok0,$line1_1);
$line1_1 = str_replace('DUQ1',$dok11,$line1_1);
}else{
$line1_1 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line12.txt")){
$line1_2 = file_get_contents("lib/keyboard/home/line12.txt");
if($line1_2 != null ){
$line1_2 = str_replace('DOK1',$dok1,$line1_2);
$line1_2 = str_replace('DOK2',$dok2,$line1_2);
$line1_2 = str_replace('DOK3',$dok3,$line1_2);
$line1_2 = str_replace('DOK4',$dok4,$line1_2);
$line1_2 = str_replace('DOK5',$dok5,$line1_2);
$line1_2 = str_replace('DOK6',$dok6,$line1_2);
$line1_2 = str_replace('DOK7',$dok7,$line1_2);
$line1_2 = str_replace('DOK8',$dok8,$line1_2);
$line1_2 = str_replace('DOK9',$dok9,$line1_2);
$line1_2 = str_replace('DOK0',$dok0,$line1_2);
$line1_2 = str_replace('DUQ1',$dok11,$line1_2);
}else{
$line1_2 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line13.txt")){
$line1_3 = file_get_contents("lib/keyboard/home/line13.txt");
if($line1_3 != null ){
$line1_3 = str_replace('DOK1',$dok1,$line1_3);
$line1_3 = str_replace('DOK2',$dok2,$line1_3);
$line1_3 = str_replace('DOK3',$dok3,$line1_3);
$line1_3 = str_replace('DOK4',$dok4,$line1_3);
$line1_3 = str_replace('DOK5',$dok5,$line1_3);
$line1_3 = str_replace('DOK6',$dok6,$line1_3);
$line1_3 = str_replace('DOK7',$dok7,$line1_3);
$line1_3 = str_replace('DOK8',$dok8,$line1_3);
$line1_3 = str_replace('DOK9',$dok9,$line1_3);
$line1_3 = str_replace('DOK0',$dok0,$line1_3);
$line1_3 = str_replace('DUQ1',$dok11,$line1_3);
}else{
$line1_3 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line14.txt")){
$line1_4 = file_get_contents("lib/keyboard/home/line14.txt");
if($line1_4 != null ){
$line1_4 = str_replace('DOK1',$dok1,$line1_4);
$line1_4 = str_replace('DOK2',$dok2,$line1_4);
$line1_4 = str_replace('DOK3',$dok3,$line1_4);
$line1_4 = str_replace('DOK4',$dok4,$line1_4);
$line1_4 = str_replace('DOK5',$dok5,$line1_4);
$line1_4 = str_replace('DOK6',$dok6,$line1_4);
$line1_4 = str_replace('DOK7',$dok7,$line1_4);
$line1_4 = str_replace('DOK8',$dok8,$line1_4);
$line1_4 = str_replace('DOK9',$dok9,$line1_4);
$line1_4 = str_replace('DOK0',$dok0,$line1_4);
$line1_4 = str_replace('DUQ1',$dok11,$line1_4);
}else{
$line1_4 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line21.txt")){
$line2_1 = file_get_contents("lib/keyboard/home/line21.txt");
if($line2_1 != null ){
$line2_1 = str_replace('DOK1',$dok1,$line2_1);
$line2_1 = str_replace('DOK2',$dok2,$line2_1);
$line2_1 = str_replace('DOK3',$dok3,$line2_1);
$line2_1 = str_replace('DOK4',$dok4,$line2_1);
$line2_1 = str_replace('DOK5',$dok5,$line2_1);
$line2_1 = str_replace('DOK6',$dok6,$line2_1);
$line2_1 = str_replace('DOK7',$dok7,$line2_1);
$line2_1 = str_replace('DOK8',$dok8,$line2_1);
$line2_1 = str_replace('DOK9',$dok9,$line2_1);
$line2_1 = str_replace('DOK0',$dok0,$line2_1);
$line2_1 = str_replace('DUQ1',$dok11,$line2_1);
}else{
$line2_1 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line22.txt")){
$line2_2 = file_get_contents("lib/keyboard/home/line22.txt");
if($line2_2 != null ){
$line2_2 = str_replace('DOK1',$dok1,$line2_2);
$line2_2 = str_replace('DOK2',$dok2,$line2_2);
$line2_2 = str_replace('DOK3',$dok3,$line2_2);
$line2_2 = str_replace('DOK4',$dok4,$line2_2);
$line2_2 = str_replace('DOK5',$dok5,$line2_2);
$line2_2 = str_replace('DOK6',$dok6,$line2_2);
$line2_2 = str_replace('DOK7',$dok7,$line2_2);
$line2_2 = str_replace('DOK8',$dok8,$line2_2);
$line2_2 = str_replace('DOK9',$dok9,$line2_2);
$line2_2 = str_replace('DOK0',$dok0,$line2_2);
$line2_2 = str_replace('DUQ1',$dok11,$line2_2);
}else{
$line2_2 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line23.txt")){
$line2_3 = file_get_contents("lib/keyboard/home/line23.txt");
if($line2_3 != null ){
$line2_3 = str_replace('DOK1',$dok1,$line2_3);
$line2_3 = str_replace('DOK2',$dok2,$line2_3);
$line2_3 = str_replace('DOK3',$dok3,$line2_3);
$line2_3 = str_replace('DOK4',$dok4,$line2_3);
$line2_3 = str_replace('DOK5',$dok5,$line2_3);
$line2_3 = str_replace('DOK6',$dok6,$line2_3);
$line2_3 = str_replace('DOK7',$dok7,$line2_3);
$line2_3 = str_replace('DOK8',$dok8,$line2_3);
$line2_3 = str_replace('DOK9',$dok9,$line2_3);
$line2_3 = str_replace('DOK0',$dok0,$line2_3);
$line2_3 = str_replace('DUQ1',$dok11,$line2_3);
}else{
$line2_3 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line24.txt")){
$line2_4 = file_get_contents("lib/keyboard/home/line24.txt");
if($line2_4 != null ){
$line2_4 = str_replace('DOK1',$dok1,$line2_4);
$line2_4 = str_replace('DOK2',$dok2,$line2_4);
$line2_4 = str_replace('DOK3',$dok3,$line2_4);
$line2_4 = str_replace('DOK4',$dok4,$line2_4);
$line2_4 = str_replace('DOK5',$dok5,$line2_4);
$line2_4 = str_replace('DOK6',$dok6,$line2_4);
$line2_4 = str_replace('DOK7',$dok7,$line2_4);
$line2_4 = str_replace('DOK8',$dok8,$line2_4);
$line2_4 = str_replace('DOK9',$dok9,$line2_4);
$line2_4 = str_replace('DOK0',$dok0,$line2_4);
$line2_4 = str_replace('DUQ1',$dok11,$line2_4);
}else{
$line2_4 = "➕";
}}

//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line31.txt")){
$line3_1 = file_get_contents("lib/keyboard/home/line31.txt");
if($line3_1 != null ){
$line3_1 = str_replace('DOK1',$dok1,$line3_1);
$line3_1 = str_replace('DOK2',$dok2,$line3_1);
$line3_1 = str_replace('DOK3',$dok3,$line3_1);
$line3_1 = str_replace('DOK4',$dok4,$line3_1);
$line3_1 = str_replace('DOK5',$dok5,$line3_1);
$line3_1 = str_replace('DOK6',$dok6,$line3_1);
$line3_1 = str_replace('DOK7',$dok7,$line3_1);
$line3_1 = str_replace('DOK8',$dok8,$line3_1);
$line3_1 = str_replace('DOK9',$dok9,$line3_1);
$line3_1 = str_replace('DOK0',$dok0,$line3_1);
$line3_1 = str_replace('DUQ1',$dok11,$line3_1);
}else{
$line3_1 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line32.txt")){
$line3_2 = file_get_contents("lib/keyboard/home/line32.txt");
if($line3_2 != null ){
$line3_2 = str_replace('DOK1',$dok1,$line3_2);
$line3_2 = str_replace('DOK2',$dok2,$line3_2);
$line3_2 = str_replace('DOK3',$dok3,$line3_2);
$line3_2 = str_replace('DOK4',$dok4,$line3_2);
$line3_2 = str_replace('DOK5',$dok5,$line3_2);
$line3_2 = str_replace('DOK6',$dok6,$line3_2);
$line3_2 = str_replace('DOK7',$dok7,$line3_2);
$line3_2 = str_replace('DOK8',$dok8,$line3_2);
$line3_2 = str_replace('DOK9',$dok9,$line3_2);
$line3_2 = str_replace('DOK0',$dok0,$line3_2);
$line3_2 = str_replace('DUQ1',$dok11,$line3_2);
}else{
$line3_2 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line33.txt")){
$line3_3 = file_get_contents("lib/keyboard/home/line33.txt");
if($line3_3 != null ){
$line3_3 = str_replace('DOK1',$dok1,$line3_3);
$line3_3 = str_replace('DOK2',$dok2,$line3_3);
$line3_3 = str_replace('DOK3',$dok3,$line3_3);
$line3_3 = str_replace('DOK4',$dok4,$line3_3);
$line3_3 = str_replace('DOK5',$dok5,$line3_3);
$line3_3 = str_replace('DOK6',$dok6,$line3_3);
$line3_3 = str_replace('DOK7',$dok7,$line3_3);
$line3_3 = str_replace('DOK8',$dok8,$line3_3);
$line3_3 = str_replace('DOK9',$dok9,$line3_3);
$line3_3 = str_replace('DOK0',$dok0,$line3_3);
$line3_3 = str_replace('DUQ1',$dok11,$line3_3);
}else{
$line3_3 = "➕";
}}//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line34.txt")){
$line3_4 = file_get_contents("lib/keyboard/home/line34.txt");
if($line3_4 != null ){
$line3_4 = str_replace('DOK1',$dok1,$line3_4);
$line3_4 = str_replace('DOK2',$dok2,$line3_4);
$line3_4 = str_replace('DOK3',$dok3,$line3_4);
$line3_4 = str_replace('DOK4',$dok4,$line3_4);
$line3_4 = str_replace('DOK5',$dok5,$line3_4);
$line3_4 = str_replace('DOK6',$dok6,$line3_4);
$line3_4 = str_replace('DOK7',$dok7,$line3_4);
$line3_4 = str_replace('DOK8',$dok8,$line3_4);
$line3_4 = str_replace('DOK9',$dok9,$line3_4);
$line3_4 = str_replace('DOK0',$dok0,$line3_4);
$line3_4 = str_replace('DUQ1',$dok11,$line3_4);
}else{
$line3_4 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line41.txt")){
$line4_1 = file_get_contents("lib/keyboard/home/line41.txt");
if($line4_1 != null ){
$line4_1 = str_replace('DOK1',$dok1,$line4_1);
$line4_1 = str_replace('DOK2',$dok2,$line4_1);
$line4_1 = str_replace('DOK3',$dok3,$line4_1);
$line4_1 = str_replace('DOK4',$dok4,$line4_1);
$line4_1 = str_replace('DOK5',$dok5,$line4_1);
$line4_1 = str_replace('DOK6',$dok6,$line4_1);
$line4_1 = str_replace('DOK7',$dok7,$line4_1);
$line4_1 = str_replace('DOK8',$dok8,$line4_1);
$line4_1 = str_replace('DOK9',$dok9,$line4_1);
$line4_1 = str_replace('DOK0',$dok0,$line4_1);
$line4_1 = str_replace('DUQ1',$dok11,$line4_1);
}else{
$line4_1 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line42.txt")){
$line4_2 = file_get_contents("lib/keyboard/home/line42.txt");
if($line4_2 != null ){
$line4_2 = str_replace('DOK1',$dok1,$line4_2);
$line4_2 = str_replace('DOK2',$dok2,$line4_2);
$line4_2 = str_replace('DOK3',$dok3,$line4_2);
$line4_2 = str_replace('DOK4',$dok4,$line4_2);
$line4_2 = str_replace('DOK5',$dok5,$line4_2);
$line4_2 = str_replace('DOK6',$dok6,$line4_2);
$line4_2 = str_replace('DOK7',$dok7,$line4_2);
$line4_2 = str_replace('DOK8',$dok8,$line4_2);
$line4_2 = str_replace('DOK9',$dok9,$line4_2);
$line4_2 = str_replace('DOK0',$dok0,$line4_2);
$line4_2 = str_replace('DUQ1',$dok11,$line4_2);
}else{
$line4_2 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line43.txt")){
$line4_3 = file_get_contents("lib/keyboard/home/line43.txt");
if($line4_3 != null ){
$line4_3 = str_replace('DOK1',$dok1,$line4_3);
$line4_3 = str_replace('DOK2',$dok2,$line4_3);
$line4_3 = str_replace('DOK3',$dok3,$line4_3);
$line4_3 = str_replace('DOK4',$dok4,$line4_3);
$line4_3 = str_replace('DOK5',$dok5,$line4_3);
$line4_3 = str_replace('DOK6',$dok6,$line4_3);
$line4_3 = str_replace('DOK7',$dok7,$line4_3);
$line4_3 = str_replace('DOK8',$dok8,$line4_3);
$line4_3 = str_replace('DOK9',$dok9,$line4_3);
$line4_3 = str_replace('DOK0',$dok0,$line4_3);
$line4_3 = str_replace('DUQ1',$dok11,$line4_3);
}else{
$line4_3 = "➕";
}}//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line44.txt")){
$line4_4 = file_get_contents("lib/keyboard/home/line44.txt");
if($line4_4 != null ){
$line4_4 = str_replace('DOK1',$dok1,$line4_4);
$line4_4 = str_replace('DOK2',$dok2,$line4_4);
$line4_4 = str_replace('DOK3',$dok3,$line4_4);
$line4_4 = str_replace('DOK4',$dok4,$line4_4);
$line4_4 = str_replace('DOK5',$dok5,$line4_4);
$line4_4 = str_replace('DOK6',$dok6,$line4_4);
$line4_4 = str_replace('DOK7',$dok7,$line4_4);
$line4_4 = str_replace('DOK8',$dok8,$line4_4);
$line4_4 = str_replace('DOK9',$dok9,$line4_4);
$line4_4 = str_replace('DOK0',$dok0,$line4_4);
$line4_4 = str_replace('DUQ1',$dok11,$line4_4);
}else{
$line4_4 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line51.txt")){
$line5_1 = file_get_contents("lib/keyboard/home/line51.txt");
if($line5_1 != null ){
$line5_1 = str_replace('DOK1',$dok1,$line5_1);
$line5_1 = str_replace('DOK2',$dok2,$line5_1);
$line5_1 = str_replace('DOK3',$dok3,$line5_1);
$line5_1 = str_replace('DOK4',$dok4,$line5_1);
$line5_1 = str_replace('DOK5',$dok5,$line5_1);
$line5_1 = str_replace('DOK6',$dok6,$line5_1);
$line5_1 = str_replace('DOK7',$dok7,$line5_1);
$line5_1 = str_replace('DOK8',$dok8,$line5_1);
$line5_1 = str_replace('DOK9',$dok9,$line5_1);
$line5_1 = str_replace('DOK0',$dok0,$line5_1);
$line5_1 = str_replace('DUQ1',$dok11,$line5_1);
}else{
$line5_1 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line52.txt")){
$line5_2 = file_get_contents("lib/keyboard/home/line52.txt");
if($line5_2 != null ){
$line5_2 = str_replace('DOK1',$dok1,$line5_2);
$line5_2 = str_replace('DOK2',$dok2,$line5_2);
$line5_2 = str_replace('DOK3',$dok3,$line5_2);
$line5_2 = str_replace('DOK4',$dok4,$line5_2);
$line5_2 = str_replace('DOK5',$dok5,$line5_2);
$line5_2 = str_replace('DOK6',$dok6,$line5_2);
$line5_2 = str_replace('DOK7',$dok7,$line5_2);
$line5_2 = str_replace('DOK8',$dok8,$line5_2);
$line5_2 = str_replace('DOK9',$dok9,$line5_2);
$line5_2 = str_replace('DOK0',$dok0,$line5_2);
$line5_2 = str_replace('DUQ1',$dok11,$line5_2);
}else{
$line5_2 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line53.txt")){
$line5_3 = file_get_contents("lib/keyboard/home/line53.txt");
if($line5_3 != null ){
$line5_3 = str_replace('DOK1',$dok1,$line5_3);
$line5_3 = str_replace('DOK2',$dok2,$line5_3);
$line5_3 = str_replace('DOK3',$dok3,$line5_3);
$line5_3 = str_replace('DOK4',$dok4,$line5_3);
$line5_3 = str_replace('DOK5',$dok5,$line5_3);
$line5_3 = str_replace('DOK6',$dok6,$line5_3);
$line5_3 = str_replace('DOK7',$dok7,$line5_3);
$line5_3 = str_replace('DOK8',$dok8,$line5_3);
$line5_3 = str_replace('DOK9',$dok9,$line5_3);
$line5_3 = str_replace('DOK0',$dok0,$line5_3);
$line5_3 = str_replace('DUQ1',$dok11,$line5_3);
}else{
$line5_3 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line54.txt")){
$line5_4 = file_get_contents("lib/keyboard/home/line54.txt");
if($line5_4 != null ){
$line5_4 = str_replace('DOK1',$dok1,$line5_4);
$line5_4 = str_replace('DOK2',$dok2,$line5_4);
$line5_4 = str_replace('DOK3',$dok3,$line5_4);
$line5_4 = str_replace('DOK4',$dok4,$line5_4);
$line5_4 = str_replace('DOK5',$dok5,$line5_4);
$line5_4 = str_replace('DOK6',$dok6,$line5_4);
$line5_4 = str_replace('DOK7',$dok7,$line5_4);
$line5_4 = str_replace('DOK8',$dok8,$line5_4);
$line5_4 = str_replace('DOK9',$dok9,$line5_4);
$line5_4 = str_replace('DOK0',$dok0,$line5_4);
$line5_4 = str_replace('DUQ1',$dok11,$line5_4);
}else{
$line5_4 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line61.txt")){
$line6_1 = file_get_contents("lib/keyboard/home/line61.txt");
if($line6_1 != null ){
$line6_1 = str_replace('DOK1',$dok1,$line6_1);
$line6_1 = str_replace('DOK2',$dok2,$line6_1);
$line6_1 = str_replace('DOK3',$dok3,$line6_1);
$line6_1 = str_replace('DOK4',$dok4,$line6_1);
$line6_1 = str_replace('DOK5',$dok5,$line6_1);
$line6_1 = str_replace('DOK6',$dok6,$line6_1);
$line6_1 = str_replace('DOK7',$dok7,$line6_1);
$line6_1 = str_replace('DOK8',$dok8,$line6_1);
$line6_1 = str_replace('DOK9',$dok9,$line6_1);
$line6_1 = str_replace('DOK0',$dok0,$line6_1);
$line6_1 = str_replace('DUQ1',$dok11,$line6_1);
}else{
$line6_1 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line62.txt")){
$line6_2 = file_get_contents("lib/keyboard/home/line62.txt");
if($line6_2 != null ){
$line6_2 = str_replace('DOK1',$dok1,$line6_2);
$line6_2 = str_replace('DOK2',$dok2,$line6_2);
$line6_2 = str_replace('DOK3',$dok3,$line6_2);
$line6_2 = str_replace('DOK4',$dok4,$line6_2);
$line6_2 = str_replace('DOK5',$dok5,$line6_2);
$line6_2 = str_replace('DOK6',$dok6,$line6_2);
$line6_2 = str_replace('DOK7',$dok7,$line6_2);
$line6_2 = str_replace('DOK8',$dok8,$line6_2);
$line6_2 = str_replace('DOK9',$dok9,$line6_2);
$line6_2 = str_replace('DOK0',$dok0,$line6_2);
$line6_2 = str_replace('DUQ1',$dok11,$line6_2);
}else{
$line6_2 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line63.txt")){
$line6_3 = file_get_contents("lib/keyboard/home/line63.txt");
if($line6_3 != null ){
$line6_3 = str_replace('DOK1',$dok1,$line6_3);
$line6_3 = str_replace('DOK2',$dok2,$line6_3);
$line6_3 = str_replace('DOK3',$dok3,$line6_3);
$line6_3 = str_replace('DOK4',$dok4,$line6_3);
$line6_3 = str_replace('DOK5',$dok5,$line6_3);
$line6_3 = str_replace('DOK6',$dok6,$line6_3);
$line6_3 = str_replace('DOK7',$dok7,$line6_3);
$line6_3 = str_replace('DOK8',$dok8,$line6_3);
$line6_3 = str_replace('DOK9',$dok9,$line6_3);
$line6_3 = str_replace('DOK0',$dok0,$line6_3);
$line6_3 = str_replace('DUQ1',$dok11,$line6_3);
}else{
$line6_3 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line64.txt")){
$line6_4 = file_get_contents("lib/keyboard/home/line64.txt");
if($line6_4 != null ){
$line6_4 = str_replace('DOK1',$dok1,$line6_4);
$line6_4 = str_replace('DOK2',$dok2,$line6_4);
$line6_4 = str_replace('DOK3',$dok3,$line6_4);
$line6_4 = str_replace('DOK4',$dok4,$line6_4);
$line6_4 = str_replace('DOK5',$dok5,$line6_4);
$line6_4 = str_replace('DOK6',$dok6,$line6_4);
$line6_4 = str_replace('DOK7',$dok7,$line6_4);
$line6_4 = str_replace('DOK8',$dok8,$line6_4);
$line6_4 = str_replace('DOK9',$dok9,$line6_4);
$line6_4 = str_replace('DOK0',$dok0,$line6_4);
$line6_4 = str_replace('DUQ1',$dok11,$line6_4);
}else{
$line6_4 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line71.txt")){
$line7_1 = file_get_contents("lib/keyboard/home/line71.txt");
if($line7_1 != null ){
$line7_1 = str_replace('DOK1',$dok1,$line7_1);
$line7_1 = str_replace('DOK2',$dok2,$line7_1);
$line7_1 = str_replace('DOK3',$dok3,$line7_1);
$line7_1 = str_replace('DOK4',$dok4,$line7_1);
$line7_1 = str_replace('DOK5',$dok5,$line7_1);
$line7_1 = str_replace('DOK6',$dok6,$line7_1);
$line7_1 = str_replace('DOK7',$dok7,$line7_1);
$line7_1 = str_replace('DOK8',$dok8,$line7_1);
$line7_1 = str_replace('DOK9',$dok9,$line7_1);
$line7_1 = str_replace('DOK0',$dok0,$line7_1);
$line7_1 = str_replace('DUQ1',$dok11,$line7_1);
}else{
$line7_1 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line72.txt")){
$line7_2 = file_get_contents("lib/keyboard/home/line72.txt");
if($line7_2 != null ){
$line7_2 = str_replace('DOK1',$dok1,$line7_2);
$line7_2 = str_replace('DOK2',$dok2,$line7_2);
$line7_2 = str_replace('DOK3',$dok3,$line7_2);
$line7_2 = str_replace('DOK4',$dok4,$line7_2);
$line7_2 = str_replace('DOK5',$dok5,$line7_2);
$line7_2 = str_replace('DOK6',$dok6,$line7_2);
$line7_2 = str_replace('DOK7',$dok7,$line7_2);
$line7_2 = str_replace('DOK8',$dok8,$line7_2);
$line7_2 = str_replace('DOK9',$dok9,$line7_2);
$line7_2 = str_replace('DOK0',$dok0,$line7_2);
$line7_2 = str_replace('DUQ1',$dok11,$line7_2);
}else{
$line7_2 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line73.txt")){
$line7_3 = file_get_contents("lib/keyboard/home/line73.txt");
if($line7_3 != null ){
$line7_3 = str_replace('DOK1',$dok1,$line7_3);
$line7_3 = str_replace('DOK2',$dok2,$line7_3);
$line7_3 = str_replace('DOK3',$dok3,$line7_3);
$line7_3 = str_replace('DOK4',$dok4,$line7_3);
$line7_3 = str_replace('DOK5',$dok5,$line7_3);
$line7_3 = str_replace('DOK6',$dok6,$line7_3);
$line7_3 = str_replace('DOK7',$dok7,$line7_3);
$line7_3 = str_replace('DOK8',$dok8,$line7_3);
$line7_3 = str_replace('DOK9',$dok9,$line7_3);
$line7_3 = str_replace('DOK0',$dok0,$line7_3);
$line7_3 = str_replace('DUQ1',$dok11,$line7_3);
}else{
$line7_3 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line74.txt")){
$line7_4 = file_get_contents("lib/keyboard/home/line74.txt");
if($line7_4 != null ){
$line7_4 = str_replace('DOK1',$dok1,$line7_4);
$line7_4 = str_replace('DOK2',$dok2,$line7_4);
$line7_4 = str_replace('DOK3',$dok3,$line7_4);
$line7_4 = str_replace('DOK4',$dok4,$line7_4);
$line7_4 = str_replace('DOK5',$dok5,$line7_4);
$line7_4 = str_replace('DOK6',$dok6,$line7_4);
$line7_4 = str_replace('DOK7',$dok7,$line7_4);
$line7_4 = str_replace('DOK8',$dok8,$line7_4);
$line7_4 = str_replace('DOK9',$dok9,$line7_4);
$line7_4 = str_replace('DOK0',$dok0,$line7_4);
$line7_4 = str_replace('DUQ1',$dok11,$line7_4);
}else{
$line7_4 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line81.txt")){
$line8_1 = file_get_contents("lib/keyboard/home/line81.txt");
if($line8_1 != null ){
$line8_1 = str_replace('DOK1',$dok1,$line8_1);
$line8_1 = str_replace('DOK2',$dok2,$line8_1);
$line8_1 = str_replace('DOK3',$dok3,$line8_1);
$line8_1 = str_replace('DOK4',$dok4,$line8_1);
$line8_1 = str_replace('DOK5',$dok5,$line8_1);
$line8_1 = str_replace('DOK6',$dok6,$line8_1);
$line8_1 = str_replace('DOK7',$dok7,$line8_1);
$line8_1 = str_replace('DOK8',$dok8,$line8_1);
$line8_1 = str_replace('DOK9',$dok9,$line8_1);
$line8_1 = str_replace('DOK0',$dok0,$line8_1);
$line8_1 = str_replace('DUQ1',$dok11,$line8_1);
}else{
$line8_1 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line82.txt")){
$line8_2 = file_get_contents("lib/keyboard/home/line82.txt");
if($line8_2 != null ){
$line8_2 = str_replace('DOK1',$dok1,$line8_2);
$line8_2 = str_replace('DOK2',$dok2,$line8_2);
$line8_2 = str_replace('DOK3',$dok3,$line8_2);
$line8_2 = str_replace('DOK4',$dok4,$line8_2);
$line8_2 = str_replace('DOK5',$dok5,$line8_2);
$line8_2 = str_replace('DOK6',$dok6,$line8_2);
$line8_2 = str_replace('DOK7',$dok7,$line8_2);
$line8_2 = str_replace('DOK8',$dok8,$line8_2);
$line8_2 = str_replace('DOK9',$dok9,$line8_2);
$line8_2 = str_replace('DOK0',$dok0,$line8_2);
$line8_2 = str_replace('DUQ1',$dok11,$line8_2);
}else{
$line8_2 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line83.txt")){
$line8_3 = file_get_contents("lib/keyboard/home/line83.txt");
if($line8_3 != null ){
$line8_3 = str_replace('DOK1',$dok1,$line8_3);
$line8_3 = str_replace('DOK2',$dok2,$line8_3);
$line8_3 = str_replace('DOK3',$dok3,$line8_3);
$line8_3 = str_replace('DOK4',$dok4,$line8_3);
$line8_3 = str_replace('DOK5',$dok5,$line8_3);
$line8_3 = str_replace('DOK6',$dok6,$line8_3);
$line8_3 = str_replace('DOK7',$dok7,$line8_3);
$line8_3 = str_replace('DOK8',$dok8,$line8_3);
$line8_3 = str_replace('DOK9',$dok9,$line8_3);
$line8_3 = str_replace('DOK0',$dok0,$line8_3);
$line8_3 = str_replace('DUQ1',$dok11,$line8_3);
}else{
$line8_3 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line84.txt")){
$line8_4 = file_get_contents("lib/keyboard/home/line84.txt");
if($line8_4 != null ){
$line8_4 = str_replace('DOK1',$dok1,$line8_4);
$line8_4 = str_replace('DOK2',$dok2,$line8_4);
$line8_4 = str_replace('DOK3',$dok3,$line8_4);
$line8_4 = str_replace('DOK4',$dok4,$line8_4);
$line8_4 = str_replace('DOK5',$dok5,$line8_4);
$line8_4 = str_replace('DOK6',$dok6,$line8_4);
$line8_4 = str_replace('DOK7',$dok7,$line8_4);
$line8_4 = str_replace('DOK8',$dok8,$line8_4);
$line8_4 = str_replace('DOK9',$dok9,$line8_4);
$line8_4 = str_replace('DOK0',$dok0,$line8_4);
$line8_4 = str_replace('DUQ1',$dok11,$line8_4);
}else{
$line8_4 = "➕";
}}
$Button_set0 = json_encode(['inline_keyboard'=>[
[['text'=>"$line1_1",'callback_data'=>'set-line11'],['text'=>"$line1_2",'callback_data'=>'set-line12'],['text'=>"$line1_3",'callback_data'=>'set-line13'],['text'=>"$line1_4",'callback_data'=>'set-line14']],
[['text'=>"$line2_1",'callback_data'=>'set-line21'],['text'=>"$line2_2",'callback_data'=>'set-line22'],['text'=>"$line2_3",'callback_data'=>'set-line23'],['text'=>"$line2_4",'callback_data'=>'set-line24']],
[['text'=>"$line3_1",'callback_data'=>'set-line31'],['text'=>"$line3_2",'callback_data'=>'set-line32'],['text'=>"$line3_3",'callback_data'=>'set-line33'],['text'=>"$line3_4",'callback_data'=>'set-line34']],
[['text'=>"$line4_1",'callback_data'=>'set-line41'],['text'=>"$line4_2",'callback_data'=>'set-line42'],['text'=>"$line4_3",'callback_data'=>'set-line43'],['text'=>"$line4_4",'callback_data'=>'set-line44']],
[['text'=>"$line5_1",'callback_data'=>'set-line51'],['text'=>"$line5_2",'callback_data'=>'set-line52'],['text'=>"$line5_3",'callback_data'=>'set-line53'],['text'=>"$line5_4",'callback_data'=>'set-line54']],
[['text'=>"$line6_1",'callback_data'=>'set-line61'],['text'=>"$line6_2",'callback_data'=>'set-line62'],['text'=>"$line6_3",'callback_data'=>'set-line63'],['text'=>"$line6_4",'callback_data'=>'set-line64']],
[['text'=>"$line7_1",'callback_data'=>'set-line71'],['text'=>"$line7_2",'callback_data'=>'set-line72'],['text'=>"$line7_3",'callback_data'=>'set-line73'],['text'=>"$line7_4",'callback_data'=>'set-line74']],
[['text'=>"$line8_1",'callback_data'=>'set-line81'],['text'=>"$line8_2",'callback_data'=>'set-line82'],['text'=>"$line8_3",'callback_data'=>'set-line83'],['text'=>"$line8_4",'callback_data'=>'set-line84']],
]]);
bot('sendMessage', [
'chat_id' => $chatID,
'text' => "✅با استفاده از تنظیمات این بخش میتوانید چینش کیبورد منوی ساخت ربات را شخصی سازی کنید

پس از اعمال تغییرات جهت بروزرسانی کیبورد /start بزنید",
'parse_mode' => "html",
'reply_markup' => $Button_set0
]);
}
//////////------------------------\\\\\\\\\\\\\\///
elseif(preg_match('/^set-(.*)/', $data, $match)){
$dok = $match[1];
$Button_set_dok = json_encode(['inline_keyboard'=>[
[['text'=>"$dok1",'callback_data'=>"sete-DOK1_$dok"]],
[['text'=>"$dok2",'callback_data'=>"sete-DOK2_$dok"],['text'=>"$dok3",'callback_data'=>"sete-DOK3_$dok"]],
[['text'=>"$dok4",'callback_data'=>"sete-DOK4_$dok"],['text'=>"$dok5",'callback_data'=>"sete-DOK5_$dok"]],
[['text'=>"$dok6",'callback_data'=>"sete-DOK6_$dok"],['text'=>"$dok7",'callback_data'=>"sete-DOK7_$dok"],['text'=>"$dok8",'callback_data'=>"sete-DOK8_$dok"]],
[['text'=>"$dok9",'callback_data'=>"sete-DOK9_$dok"],['text'=>"$dok0",'callback_data'=>"sete-DOK0_$dok"],['text'=>"$dok11",'callback_data'=>"sete-DUQ1_$dok"]],
[['text'=>"🔰خالی🔰",'callback_data'=>"del-$dok"]],
]]);
Editmessagetext($chatID, $msg_id,"👈️ گزینه مورد نظر را انتخاب نمائید.",$Button_set_dok);
saveJson("melat/$userID.json",$user);
}
//////////------------------------\\\\\\\\\\\\\\//
elseif(preg_match('/^sete-(.*)_(.*)/', $data, $match)){
$name = $match[1];
$doke = $match[2];
Save("lib/keyboard/home/$doke.txt",$name);
//////////------------------------\\\\\\\\\\\\\\///
if(file_exists("lib/keyboard/home/line11.txt")){
$line1_1 = file_get_contents("lib/keyboard/home/line11.txt");
if($line1_1 != null ){
$line1_1 = str_replace('DOK1',$dok1,$line1_1);
$line1_1 = str_replace('DOK2',$dok2,$line1_1);
$line1_1 = str_replace('DOK3',$dok3,$line1_1);
$line1_1 = str_replace('DOK4',$dok4,$line1_1);
$line1_1 = str_replace('DOK5',$dok5,$line1_1);
$line1_1 = str_replace('DOK6',$dok6,$line1_1);
$line1_1 = str_replace('DOK7',$dok7,$line1_1);
$line1_1 = str_replace('DOK8',$dok8,$line1_1);
$line1_1 = str_replace('DOK9',$dok9,$line1_1);
$line1_1 = str_replace('DOK0',$dok0,$line1_1);
$line1_1 = str_replace('DUQ1',$dok11,$line1_1);
}else{
$line1_1 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line12.txt")){
$line1_2 = file_get_contents("lib/keyboard/home/line12.txt");
if($line1_2 != null ){
$line1_2 = str_replace('DOK1',$dok1,$line1_2);
$line1_2 = str_replace('DOK2',$dok2,$line1_2);
$line1_2 = str_replace('DOK3',$dok3,$line1_2);
$line1_2 = str_replace('DOK4',$dok4,$line1_2);
$line1_2 = str_replace('DOK5',$dok5,$line1_2);
$line1_2 = str_replace('DOK6',$dok6,$line1_2);
$line1_2 = str_replace('DOK7',$dok7,$line1_2);
$line1_2 = str_replace('DOK8',$dok8,$line1_2);
$line1_2 = str_replace('DOK9',$dok9,$line1_2);
$line1_2 = str_replace('DOK0',$dok0,$line1_2);
$line1_2 = str_replace('DUQ1',$dok11,$line1_2);
}else{
$line1_2 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line13.txt")){
$line1_3 = file_get_contents("lib/keyboard/home/line13.txt");
if($line1_3 != null ){
$line1_3 = str_replace('DOK1',$dok1,$line1_3);
$line1_3 = str_replace('DOK2',$dok2,$line1_3);
$line1_3 = str_replace('DOK3',$dok3,$line1_3);
$line1_3 = str_replace('DOK4',$dok4,$line1_3);
$line1_3 = str_replace('DOK5',$dok5,$line1_3);
$line1_3 = str_replace('DOK6',$dok6,$line1_3);
$line1_3 = str_replace('DOK7',$dok7,$line1_3);
$line1_3 = str_replace('DOK8',$dok8,$line1_3);
$line1_3 = str_replace('DOK9',$dok9,$line1_3);
$line1_3 = str_replace('DOK0',$dok0,$line1_3);
$line1_3 = str_replace('DUQ1',$dok11,$line1_3);
}else{
$line1_3 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line14.txt")){
$line1_4 = file_get_contents("lib/keyboard/home/line14.txt");
if($line1_4 != null ){
$line1_4 = str_replace('DOK1',$dok1,$line1_4);
$line1_4 = str_replace('DOK2',$dok2,$line1_4);
$line1_4 = str_replace('DOK3',$dok3,$line1_4);
$line1_4 = str_replace('DOK4',$dok4,$line1_4);
$line1_4 = str_replace('DOK5',$dok5,$line1_4);
$line1_4 = str_replace('DOK6',$dok6,$line1_4);
$line1_4 = str_replace('DOK7',$dok7,$line1_4);
$line1_4 = str_replace('DOK8',$dok8,$line1_4);
$line1_4 = str_replace('DOK9',$dok9,$line1_4);
$line1_4 = str_replace('DOK0',$dok0,$line1_4);
$line1_4 = str_replace('DUQ1',$dok11,$line1_4);
}else{
$line1_4 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line21.txt")){
$line2_1 = file_get_contents("lib/keyboard/home/line21.txt");
if($line2_1 != null ){
$line2_1 = str_replace('DOK1',$dok1,$line2_1);
$line2_1 = str_replace('DOK2',$dok2,$line2_1);
$line2_1 = str_replace('DOK3',$dok3,$line2_1);
$line2_1 = str_replace('DOK4',$dok4,$line2_1);
$line2_1 = str_replace('DOK5',$dok5,$line2_1);
$line2_1 = str_replace('DOK6',$dok6,$line2_1);
$line2_1 = str_replace('DOK7',$dok7,$line2_1);
$line2_1 = str_replace('DOK8',$dok8,$line2_1);
$line2_1 = str_replace('DOK9',$dok9,$line2_1);
$line2_1 = str_replace('DOK0',$dok0,$line2_1);
$line2_1 = str_replace('DUQ1',$dok11,$line2_1);
}else{
$line2_1 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line22.txt")){
$line2_2 = file_get_contents("lib/keyboard/home/line22.txt");
if($line2_2 != null ){
$line2_2 = str_replace('DOK1',$dok1,$line2_2);
$line2_2 = str_replace('DOK2',$dok2,$line2_2);
$line2_2 = str_replace('DOK3',$dok3,$line2_2);
$line2_2 = str_replace('DOK4',$dok4,$line2_2);
$line2_2 = str_replace('DOK5',$dok5,$line2_2);
$line2_2 = str_replace('DOK6',$dok6,$line2_2);
$line2_2 = str_replace('DOK7',$dok7,$line2_2);
$line2_2 = str_replace('DOK8',$dok8,$line2_2);
$line2_2 = str_replace('DOK9',$dok9,$line2_2);
$line2_2 = str_replace('DOK0',$dok0,$line2_2);
$line2_2 = str_replace('DUQ1',$dok11,$line2_2);
}else{
$line2_2 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line23.txt")){
$line2_3 = file_get_contents("lib/keyboard/home/line23.txt");
if($line2_3 != null ){
$line2_3 = str_replace('DOK1',$dok1,$line2_3);
$line2_3 = str_replace('DOK2',$dok2,$line2_3);
$line2_3 = str_replace('DOK3',$dok3,$line2_3);
$line2_3 = str_replace('DOK4',$dok4,$line2_3);
$line2_3 = str_replace('DOK5',$dok5,$line2_3);
$line2_3 = str_replace('DOK6',$dok6,$line2_3);
$line2_3 = str_replace('DOK7',$dok7,$line2_3);
$line2_3 = str_replace('DOK8',$dok8,$line2_3);
$line2_3 = str_replace('DOK9',$dok9,$line2_3);
$line2_3 = str_replace('DOK0',$dok0,$line2_3);
$line2_3 = str_replace('DUQ1',$dok11,$line2_3);
}else{
$line2_3 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line24.txt")){
$line2_4 = file_get_contents("lib/keyboard/home/line24.txt");
if($line2_4 != null ){
$line2_4 = str_replace('DOK1',$dok1,$line2_4);
$line2_4 = str_replace('DOK2',$dok2,$line2_4);
$line2_4 = str_replace('DOK3',$dok3,$line2_4);
$line2_4 = str_replace('DOK4',$dok4,$line2_4);
$line2_4 = str_replace('DOK5',$dok5,$line2_4);
$line2_4 = str_replace('DOK6',$dok6,$line2_4);
$line2_4 = str_replace('DOK7',$dok7,$line2_4);
$line2_4 = str_replace('DOK8',$dok8,$line2_4);
$line2_4 = str_replace('DOK9',$dok9,$line2_4);
$line2_4 = str_replace('DOK0',$dok0,$line2_4);
$line2_4 = str_replace('DUQ1',$dok11,$line2_4);
}else{
$line2_4 = "➕";
}}

//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line31.txt")){
$line3_1 = file_get_contents("lib/keyboard/home/line31.txt");
if($line3_1 != null ){
$line3_1 = str_replace('DOK1',$dok1,$line3_1);
$line3_1 = str_replace('DOK2',$dok2,$line3_1);
$line3_1 = str_replace('DOK3',$dok3,$line3_1);
$line3_1 = str_replace('DOK4',$dok4,$line3_1);
$line3_1 = str_replace('DOK5',$dok5,$line3_1);
$line3_1 = str_replace('DOK6',$dok6,$line3_1);
$line3_1 = str_replace('DOK7',$dok7,$line3_1);
$line3_1 = str_replace('DOK8',$dok8,$line3_1);
$line3_1 = str_replace('DOK9',$dok9,$line3_1);
$line3_1 = str_replace('DOK0',$dok0,$line3_1);
$line3_1 = str_replace('DUQ1',$dok11,$line3_1);
}else{
$line3_1 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line32.txt")){
$line3_2 = file_get_contents("lib/keyboard/home/line32.txt");
if($line3_2 != null ){
$line3_2 = str_replace('DOK1',$dok1,$line3_2);
$line3_2 = str_replace('DOK2',$dok2,$line3_2);
$line3_2 = str_replace('DOK3',$dok3,$line3_2);
$line3_2 = str_replace('DOK4',$dok4,$line3_2);
$line3_2 = str_replace('DOK5',$dok5,$line3_2);
$line3_2 = str_replace('DOK6',$dok6,$line3_2);
$line3_2 = str_replace('DOK7',$dok7,$line3_2);
$line3_2 = str_replace('DOK8',$dok8,$line3_2);
$line3_2 = str_replace('DOK9',$dok9,$line3_2);
$line3_2 = str_replace('DOK0',$dok0,$line3_2);
$line3_2 = str_replace('DUQ1',$dok11,$line3_2);
}else{
$line3_2 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line33.txt")){
$line3_3 = file_get_contents("lib/keyboard/home/line33.txt");
if($line3_3 != null ){
$line3_3 = str_replace('DOK1',$dok1,$line3_3);
$line3_3 = str_replace('DOK2',$dok2,$line3_3);
$line3_3 = str_replace('DOK3',$dok3,$line3_3);
$line3_3 = str_replace('DOK4',$dok4,$line3_3);
$line3_3 = str_replace('DOK5',$dok5,$line3_3);
$line3_3 = str_replace('DOK6',$dok6,$line3_3);
$line3_3 = str_replace('DOK7',$dok7,$line3_3);
$line3_3 = str_replace('DOK8',$dok8,$line3_3);
$line3_3 = str_replace('DOK9',$dok9,$line3_3);
$line3_3 = str_replace('DOK0',$dok0,$line3_3);
$line3_3 = str_replace('DUQ1',$dok11,$line3_3);
}else{
$line3_3 = "➕";
}}//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line34.txt")){
$line3_4 = file_get_contents("lib/keyboard/home/line34.txt");
if($line3_4 != null ){
$line3_4 = str_replace('DOK1',$dok1,$line3_4);
$line3_4 = str_replace('DOK2',$dok2,$line3_4);
$line3_4 = str_replace('DOK3',$dok3,$line3_4);
$line3_4 = str_replace('DOK4',$dok4,$line3_4);
$line3_4 = str_replace('DOK5',$dok5,$line3_4);
$line3_4 = str_replace('DOK6',$dok6,$line3_4);
$line3_4 = str_replace('DOK7',$dok7,$line3_4);
$line3_4 = str_replace('DOK8',$dok8,$line3_4);
$line3_4 = str_replace('DOK9',$dok9,$line3_4);
$line3_4 = str_replace('DOK0',$dok0,$line3_4);
$line3_4 = str_replace('DUQ1',$dok11,$line3_4);
}else{
$line3_4 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line41.txt")){
$line4_1 = file_get_contents("lib/keyboard/home/line41.txt");
if($line4_1 != null ){
$line4_1 = str_replace('DOK1',$dok1,$line4_1);
$line4_1 = str_replace('DOK2',$dok2,$line4_1);
$line4_1 = str_replace('DOK3',$dok3,$line4_1);
$line4_1 = str_replace('DOK4',$dok4,$line4_1);
$line4_1 = str_replace('DOK5',$dok5,$line4_1);
$line4_1 = str_replace('DOK6',$dok6,$line4_1);
$line4_1 = str_replace('DOK7',$dok7,$line4_1);
$line4_1 = str_replace('DOK8',$dok8,$line4_1);
$line4_1 = str_replace('DOK9',$dok9,$line4_1);
$line4_1 = str_replace('DOK0',$dok0,$line4_1);
$line4_1 = str_replace('DUQ1',$dok11,$line4_1);
}else{
$line4_1 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line42.txt")){
$line4_2 = file_get_contents("lib/keyboard/home/line42.txt");
if($line4_2 != null ){
$line4_2 = str_replace('DOK1',$dok1,$line4_2);
$line4_2 = str_replace('DOK2',$dok2,$line4_2);
$line4_2 = str_replace('DOK3',$dok3,$line4_2);
$line4_2 = str_replace('DOK4',$dok4,$line4_2);
$line4_2 = str_replace('DOK5',$dok5,$line4_2);
$line4_2 = str_replace('DOK6',$dok6,$line4_2);
$line4_2 = str_replace('DOK7',$dok7,$line4_2);
$line4_2 = str_replace('DOK8',$dok8,$line4_2);
$line4_2 = str_replace('DOK9',$dok9,$line4_2);
$line4_2 = str_replace('DOK0',$dok0,$line4_2);
$line4_2 = str_replace('DUQ1',$dok11,$line4_2);
}else{
$line4_2 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line43.txt")){
$line4_3 = file_get_contents("lib/keyboard/home/line43.txt");
if($line4_3 != null ){
$line4_3 = str_replace('DOK1',$dok1,$line4_3);
$line4_3 = str_replace('DOK2',$dok2,$line4_3);
$line4_3 = str_replace('DOK3',$dok3,$line4_3);
$line4_3 = str_replace('DOK4',$dok4,$line4_3);
$line4_3 = str_replace('DOK5',$dok5,$line4_3);
$line4_3 = str_replace('DOK6',$dok6,$line4_3);
$line4_3 = str_replace('DOK7',$dok7,$line4_3);
$line4_3 = str_replace('DOK8',$dok8,$line4_3);
$line4_3 = str_replace('DOK9',$dok9,$line4_3);
$line4_3 = str_replace('DOK0',$dok0,$line4_3);
$line4_3 = str_replace('DUQ1',$dok11,$line4_3);
}else{
$line4_3 = "➕";
}}//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line44.txt")){
$line4_4 = file_get_contents("lib/keyboard/home/line44.txt");
if($line4_4 != null ){
$line4_4 = str_replace('DOK1',$dok1,$line4_4);
$line4_4 = str_replace('DOK2',$dok2,$line4_4);
$line4_4 = str_replace('DOK3',$dok3,$line4_4);
$line4_4 = str_replace('DOK4',$dok4,$line4_4);
$line4_4 = str_replace('DOK5',$dok5,$line4_4);
$line4_4 = str_replace('DOK6',$dok6,$line4_4);
$line4_4 = str_replace('DOK7',$dok7,$line4_4);
$line4_4 = str_replace('DOK8',$dok8,$line4_4);
$line4_4 = str_replace('DOK9',$dok9,$line4_4);
$line4_4 = str_replace('DOK0',$dok0,$line4_4);
$line4_4 = str_replace('DUQ1',$dok11,$line4_4);
}else{
$line4_4 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line51.txt")){
$line5_1 = file_get_contents("lib/keyboard/home/line51.txt");
if($line5_1 != null ){
$line5_1 = str_replace('DOK1',$dok1,$line5_1);
$line5_1 = str_replace('DOK2',$dok2,$line5_1);
$line5_1 = str_replace('DOK3',$dok3,$line5_1);
$line5_1 = str_replace('DOK4',$dok4,$line5_1);
$line5_1 = str_replace('DOK5',$dok5,$line5_1);
$line5_1 = str_replace('DOK6',$dok6,$line5_1);
$line5_1 = str_replace('DOK7',$dok7,$line5_1);
$line5_1 = str_replace('DOK8',$dok8,$line5_1);
$line5_1 = str_replace('DOK9',$dok9,$line5_1);
$line5_1 = str_replace('DOK0',$dok0,$line5_1);
$line5_1 = str_replace('DUQ1',$dok11,$line5_1);
}else{
$line5_1 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line52.txt")){
$line5_2 = file_get_contents("lib/keyboard/home/line52.txt");
if($line5_2 != null ){
$line5_2 = str_replace('DOK1',$dok1,$line5_2);
$line5_2 = str_replace('DOK2',$dok2,$line5_2);
$line5_2 = str_replace('DOK3',$dok3,$line5_2);
$line5_2 = str_replace('DOK4',$dok4,$line5_2);
$line5_2 = str_replace('DOK5',$dok5,$line5_2);
$line5_2 = str_replace('DOK6',$dok6,$line5_2);
$line5_2 = str_replace('DOK7',$dok7,$line5_2);
$line5_2 = str_replace('DOK8',$dok8,$line5_2);
$line5_2 = str_replace('DOK9',$dok9,$line5_2);
$line5_2 = str_replace('DOK0',$dok0,$line5_2);
$line5_2 = str_replace('DUQ1',$dok11,$line5_2);
}else{
$line5_2 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line53.txt")){
$line5_3 = file_get_contents("lib/keyboard/home/line53.txt");
if($line5_3 != null ){
$line5_3 = str_replace('DOK1',$dok1,$line5_3);
$line5_3 = str_replace('DOK2',$dok2,$line5_3);
$line5_3 = str_replace('DOK3',$dok3,$line5_3);
$line5_3 = str_replace('DOK4',$dok4,$line5_3);
$line5_3 = str_replace('DOK5',$dok5,$line5_3);
$line5_3 = str_replace('DOK6',$dok6,$line5_3);
$line5_3 = str_replace('DOK7',$dok7,$line5_3);
$line5_3 = str_replace('DOK8',$dok8,$line5_3);
$line5_3 = str_replace('DOK9',$dok9,$line5_3);
$line5_3 = str_replace('DOK0',$dok0,$line5_3);
$line5_3 = str_replace('DUQ1',$dok11,$line5_3);
}else{
$line5_3 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line54.txt")){
$line5_4 = file_get_contents("lib/keyboard/home/line54.txt");
if($line5_4 != null ){
$line5_4 = str_replace('DOK1',$dok1,$line5_4);
$line5_4 = str_replace('DOK2',$dok2,$line5_4);
$line5_4 = str_replace('DOK3',$dok3,$line5_4);
$line5_4 = str_replace('DOK4',$dok4,$line5_4);
$line5_4 = str_replace('DOK5',$dok5,$line5_4);
$line5_4 = str_replace('DOK6',$dok6,$line5_4);
$line5_4 = str_replace('DOK7',$dok7,$line5_4);
$line5_4 = str_replace('DOK8',$dok8,$line5_4);
$line5_4 = str_replace('DOK9',$dok9,$line5_4);
$line5_4 = str_replace('DOK0',$dok0,$line5_4);
$line5_4 = str_replace('DUQ1',$dok11,$line5_4);
}else{
$line5_4 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line61.txt")){
$line6_1 = file_get_contents("lib/keyboard/home/line61.txt");
if($line6_1 != null ){
$line6_1 = str_replace('DOK1',$dok1,$line6_1);
$line6_1 = str_replace('DOK2',$dok2,$line6_1);
$line6_1 = str_replace('DOK3',$dok3,$line6_1);
$line6_1 = str_replace('DOK4',$dok4,$line6_1);
$line6_1 = str_replace('DOK5',$dok5,$line6_1);
$line6_1 = str_replace('DOK6',$dok6,$line6_1);
$line6_1 = str_replace('DOK7',$dok7,$line6_1);
$line6_1 = str_replace('DOK8',$dok8,$line6_1);
$line6_1 = str_replace('DOK9',$dok9,$line6_1);
$line6_1 = str_replace('DOK0',$dok0,$line6_1);
$line6_1 = str_replace('DUQ1',$dok11,$line6_1);
}else{
$line6_1 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line62.txt")){
$line6_2 = file_get_contents("lib/keyboard/home/line62.txt");
if($line6_2 != null ){
$line6_2 = str_replace('DOK1',$dok1,$line6_2);
$line6_2 = str_replace('DOK2',$dok2,$line6_2);
$line6_2 = str_replace('DOK3',$dok3,$line6_2);
$line6_2 = str_replace('DOK4',$dok4,$line6_2);
$line6_2 = str_replace('DOK5',$dok5,$line6_2);
$line6_2 = str_replace('DOK6',$dok6,$line6_2);
$line6_2 = str_replace('DOK7',$dok7,$line6_2);
$line6_2 = str_replace('DOK8',$dok8,$line6_2);
$line6_2 = str_replace('DOK9',$dok9,$line6_2);
$line6_2 = str_replace('DOK0',$dok0,$line6_2);
$line6_2 = str_replace('DUQ1',$dok11,$line6_2);
}else{
$line6_2 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line63.txt")){
$line6_3 = file_get_contents("lib/keyboard/home/line63.txt");
if($line6_3 != null ){
$line6_3 = str_replace('DOK1',$dok1,$line6_3);
$line6_3 = str_replace('DOK2',$dok2,$line6_3);
$line6_3 = str_replace('DOK3',$dok3,$line6_3);
$line6_3 = str_replace('DOK4',$dok4,$line6_3);
$line6_3 = str_replace('DOK5',$dok5,$line6_3);
$line6_3 = str_replace('DOK6',$dok6,$line6_3);
$line6_3 = str_replace('DOK7',$dok7,$line6_3);
$line6_3 = str_replace('DOK8',$dok8,$line6_3);
$line6_3 = str_replace('DOK9',$dok9,$line6_3);
$line6_3 = str_replace('DOK0',$dok0,$line6_3);
$line6_3 = str_replace('DUQ1',$dok11,$line6_3);
}else{
$line6_3 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line64.txt")){
$line6_4 = file_get_contents("lib/keyboard/home/line64.txt");
if($line6_4 != null ){
$line6_4 = str_replace('DOK1',$dok1,$line6_4);
$line6_4 = str_replace('DOK2',$dok2,$line6_4);
$line6_4 = str_replace('DOK3',$dok3,$line6_4);
$line6_4 = str_replace('DOK4',$dok4,$line6_4);
$line6_4 = str_replace('DOK5',$dok5,$line6_4);
$line6_4 = str_replace('DOK6',$dok6,$line6_4);
$line6_4 = str_replace('DOK7',$dok7,$line6_4);
$line6_4 = str_replace('DOK8',$dok8,$line6_4);
$line6_4 = str_replace('DOK9',$dok9,$line6_4);
$line6_4 = str_replace('DOK0',$dok0,$line6_4);
$line6_4 = str_replace('DUQ1',$dok11,$line6_4);
}else{
$line6_4 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line71.txt")){
$line7_1 = file_get_contents("lib/keyboard/home/line71.txt");
if($line7_1 != null ){
$line7_1 = str_replace('DOK1',$dok1,$line7_1);
$line7_1 = str_replace('DOK2',$dok2,$line7_1);
$line7_1 = str_replace('DOK3',$dok3,$line7_1);
$line7_1 = str_replace('DOK4',$dok4,$line7_1);
$line7_1 = str_replace('DOK5',$dok5,$line7_1);
$line7_1 = str_replace('DOK6',$dok6,$line7_1);
$line7_1 = str_replace('DOK7',$dok7,$line7_1);
$line7_1 = str_replace('DOK8',$dok8,$line7_1);
$line7_1 = str_replace('DOK9',$dok9,$line7_1);
$line7_1 = str_replace('DOK0',$dok0,$line7_1);
$line7_1 = str_replace('DUQ1',$dok11,$line7_1);
}else{
$line7_1 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line72.txt")){
$line7_2 = file_get_contents("lib/keyboard/home/line72.txt");
if($line7_2 != null ){
$line7_2 = str_replace('DOK1',$dok1,$line7_2);
$line7_2 = str_replace('DOK2',$dok2,$line7_2);
$line7_2 = str_replace('DOK3',$dok3,$line7_2);
$line7_2 = str_replace('DOK4',$dok4,$line7_2);
$line7_2 = str_replace('DOK5',$dok5,$line7_2);
$line7_2 = str_replace('DOK6',$dok6,$line7_2);
$line7_2 = str_replace('DOK7',$dok7,$line7_2);
$line7_2 = str_replace('DOK8',$dok8,$line7_2);
$line7_2 = str_replace('DOK9',$dok9,$line7_2);
$line7_2 = str_replace('DOK0',$dok0,$line7_2);
$line7_2 = str_replace('DUQ1',$dok11,$line7_2);
}else{
$line7_2 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line73.txt")){
$line7_3 = file_get_contents("lib/keyboard/home/line73.txt");
if($line7_3 != null ){
$line7_3 = str_replace('DOK1',$dok1,$line7_3);
$line7_3 = str_replace('DOK2',$dok2,$line7_3);
$line7_3 = str_replace('DOK3',$dok3,$line7_3);
$line7_3 = str_replace('DOK4',$dok4,$line7_3);
$line7_3 = str_replace('DOK5',$dok5,$line7_3);
$line7_3 = str_replace('DOK6',$dok6,$line7_3);
$line7_3 = str_replace('DOK7',$dok7,$line7_3);
$line7_3 = str_replace('DOK8',$dok8,$line7_3);
$line7_3 = str_replace('DOK9',$dok9,$line7_3);
$line7_3 = str_replace('DOK0',$dok0,$line7_3);
$line7_3 = str_replace('DUQ1',$dok11,$line7_3);
}else{
$line7_3 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line74.txt")){
$line7_4 = file_get_contents("lib/keyboard/home/line74.txt");
if($line7_4 != null ){
$line7_4 = str_replace('DOK1',$dok1,$line7_4);
$line7_4 = str_replace('DOK2',$dok2,$line7_4);
$line7_4 = str_replace('DOK3',$dok3,$line7_4);
$line7_4 = str_replace('DOK4',$dok4,$line7_4);
$line7_4 = str_replace('DOK5',$dok5,$line7_4);
$line7_4 = str_replace('DOK6',$dok6,$line7_4);
$line7_4 = str_replace('DOK7',$dok7,$line7_4);
$line7_4 = str_replace('DOK8',$dok8,$line7_4);
$line7_4 = str_replace('DOK9',$dok9,$line7_4);
$line7_4 = str_replace('DOK0',$dok0,$line7_4);
$line7_4 = str_replace('DUQ1',$dok11,$line7_4);
}else{
$line7_4 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line81.txt")){
$line8_1 = file_get_contents("lib/keyboard/home/line81.txt");
if($line8_1 != null ){
$line8_1 = str_replace('DOK1',$dok1,$line8_1);
$line8_1 = str_replace('DOK2',$dok2,$line8_1);
$line8_1 = str_replace('DOK3',$dok3,$line8_1);
$line8_1 = str_replace('DOK4',$dok4,$line8_1);
$line8_1 = str_replace('DOK5',$dok5,$line8_1);
$line8_1 = str_replace('DOK6',$dok6,$line8_1);
$line8_1 = str_replace('DOK7',$dok7,$line8_1);
$line8_1 = str_replace('DOK8',$dok8,$line8_1);
$line8_1 = str_replace('DOK9',$dok9,$line8_1);
$line8_1 = str_replace('DOK0',$dok0,$line8_1);
$line8_1 = str_replace('DUQ1',$dok11,$line8_1);
}else{
$line8_1 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line82.txt")){
$line8_2 = file_get_contents("lib/keyboard/home/line82.txt");
if($line8_2 != null ){
$line8_2 = str_replace('DOK1',$dok1,$line8_2);
$line8_2 = str_replace('DOK2',$dok2,$line8_2);
$line8_2 = str_replace('DOK3',$dok3,$line8_2);
$line8_2 = str_replace('DOK4',$dok4,$line8_2);
$line8_2 = str_replace('DOK5',$dok5,$line8_2);
$line8_2 = str_replace('DOK6',$dok6,$line8_2);
$line8_2 = str_replace('DOK7',$dok7,$line8_2);
$line8_2 = str_replace('DOK8',$dok8,$line8_2);
$line8_2 = str_replace('DOK9',$dok9,$line8_2);
$line8_2 = str_replace('DOK0',$dok0,$line8_2);
$line8_2 = str_replace('DUQ1',$dok11,$line8_2);
}else{
$line8_2 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line83.txt")){
$line8_3 = file_get_contents("lib/keyboard/home/line83.txt");
if($line8_3 != null ){
$line8_3 = str_replace('DOK1',$dok1,$line8_3);
$line8_3 = str_replace('DOK2',$dok2,$line8_3);
$line8_3 = str_replace('DOK3',$dok3,$line8_3);
$line8_3 = str_replace('DOK4',$dok4,$line8_3);
$line8_3 = str_replace('DOK5',$dok5,$line8_3);
$line8_3 = str_replace('DOK6',$dok6,$line8_3);
$line8_3 = str_replace('DOK7',$dok7,$line8_3);
$line8_3 = str_replace('DOK8',$dok8,$line8_3);
$line8_3 = str_replace('DOK9',$dok9,$line8_3);
$line8_3 = str_replace('DOK0',$dok0,$line8_3);
$line8_3 = str_replace('DUQ1',$dok11,$line8_3);
}else{
$line8_3 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line84.txt")){
$line8_4 = file_get_contents("lib/keyboard/home/line84.txt");
if($line8_4 != null ){
$line8_4 = str_replace('DOK1',$dok1,$line8_4);
$line8_4 = str_replace('DOK2',$dok2,$line8_4);
$line8_4 = str_replace('DOK3',$dok3,$line8_4);
$line8_4 = str_replace('DOK4',$dok4,$line8_4);
$line8_4 = str_replace('DOK5',$dok5,$line8_4);
$line8_4 = str_replace('DOK6',$dok6,$line8_4);
$line8_4 = str_replace('DOK7',$dok7,$line8_4);
$line8_4 = str_replace('DOK8',$dok8,$line8_4);
$line8_4 = str_replace('DOK9',$dok9,$line8_4);
$line8_4 = str_replace('DOK0',$dok0,$line8_4);
$line8_4 = str_replace('DUQ1',$dok11,$line8_4);
}else{
$line8_4 = "➕";
}}
$Button_sete = json_encode(['inline_keyboard'=>[
[['text'=>"$line1_1",'callback_data'=>'set-line11'],['text'=>"$line1_2",'callback_data'=>'set-line12'],['text'=>"$line1_3",'callback_data'=>'set-line13'],['text'=>"$line1_4",'callback_data'=>'set-line14']],
[['text'=>"$line2_1",'callback_data'=>'set-line21'],['text'=>"$line2_2",'callback_data'=>'set-line22'],['text'=>"$line2_3",'callback_data'=>'set-line23'],['text'=>"$line2_4",'callback_data'=>'set-line24']],
[['text'=>"$line3_1",'callback_data'=>'set-line31'],['text'=>"$line3_2",'callback_data'=>'set-line32'],['text'=>"$line3_3",'callback_data'=>'set-line33'],['text'=>"$line3_4",'callback_data'=>'set-line34']],
[['text'=>"$line4_1",'callback_data'=>'set-line41'],['text'=>"$line4_2",'callback_data'=>'set-line42'],['text'=>"$line4_3",'callback_data'=>'set-line43'],['text'=>"$line4_4",'callback_data'=>'set-line44']],
[['text'=>"$line5_1",'callback_data'=>'set-line51'],['text'=>"$line5_2",'callback_data'=>'set-line52'],['text'=>"$line5_3",'callback_data'=>'set-line53'],['text'=>"$line5_4",'callback_data'=>'set-line54']],
[['text'=>"$line6_1",'callback_data'=>'set-line61'],['text'=>"$line6_2",'callback_data'=>'set-line62'],['text'=>"$line6_3",'callback_data'=>'set-line63'],['text'=>"$line6_4",'callback_data'=>'set-line64']],
[['text'=>"$line7_1",'callback_data'=>'set-line71'],['text'=>"$line7_2",'callback_data'=>'set-line72'],['text'=>"$line7_3",'callback_data'=>'set-line73'],['text'=>"$line7_4",'callback_data'=>'set-line74']],
[['text'=>"$line8_1",'callback_data'=>'set-line81'],['text'=>"$line8_2",'callback_data'=>'set-line82'],['text'=>"$line8_3",'callback_data'=>'set-line83'],['text'=>"$line8_4",'callback_data'=>'set-line84']],
]]);
Editmessagetext($chatID, $msg_id,"👈️ گزینه مورد نظر را انتخاب نمائید.",$Button_sete);
}
elseif(preg_match('/^del-(.*)/', $data, $match)){
$doke = $match[1];
Save("lib/keyboard/home/$doke.txt",null);
//////////------------------------\\\\\\\\\\\\\\///
if(file_exists("lib/keyboard/home/line11.txt")){
$line1_1 = file_get_contents("lib/keyboard/home/line11.txt");
if($line1_1 != null ){
$line1_1 = str_replace('DOK1',$dok1,$line1_1);
$line1_1 = str_replace('DOK2',$dok2,$line1_1);
$line1_1 = str_replace('DOK3',$dok3,$line1_1);
$line1_1 = str_replace('DOK4',$dok4,$line1_1);
$line1_1 = str_replace('DOK5',$dok5,$line1_1);
$line1_1 = str_replace('DOK6',$dok6,$line1_1);
$line1_1 = str_replace('DOK7',$dok7,$line1_1);
$line1_1 = str_replace('DOK8',$dok8,$line1_1);
$line1_1 = str_replace('DOK9',$dok9,$line1_1);
$line1_1 = str_replace('DOK0',$dok0,$line1_1);
$line1_1 = str_replace('DUQ1',$dok11,$line1_1);
}else{
$line1_1 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line12.txt")){
$line1_2 = file_get_contents("lib/keyboard/home/line12.txt");
if($line1_2 != null ){
$line1_2 = str_replace('DOK1',$dok1,$line1_2);
$line1_2 = str_replace('DOK2',$dok2,$line1_2);
$line1_2 = str_replace('DOK3',$dok3,$line1_2);
$line1_2 = str_replace('DOK4',$dok4,$line1_2);
$line1_2 = str_replace('DOK5',$dok5,$line1_2);
$line1_2 = str_replace('DOK6',$dok6,$line1_2);
$line1_2 = str_replace('DOK7',$dok7,$line1_2);
$line1_2 = str_replace('DOK8',$dok8,$line1_2);
$line1_2 = str_replace('DOK9',$dok9,$line1_2);
$line1_2 = str_replace('DOK0',$dok0,$line1_2);
$line1_2 = str_replace('DUQ1',$dok11,$line1_2);
}else{
$line1_2 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line13.txt")){
$line1_3 = file_get_contents("lib/keyboard/home/line13.txt");
if($line1_3 != null ){
$line1_3 = str_replace('DOK1',$dok1,$line1_3);
$line1_3 = str_replace('DOK2',$dok2,$line1_3);
$line1_3 = str_replace('DOK3',$dok3,$line1_3);
$line1_3 = str_replace('DOK4',$dok4,$line1_3);
$line1_3 = str_replace('DOK5',$dok5,$line1_3);
$line1_3 = str_replace('DOK6',$dok6,$line1_3);
$line1_3 = str_replace('DOK7',$dok7,$line1_3);
$line1_3 = str_replace('DOK8',$dok8,$line1_3);
$line1_3 = str_replace('DOK9',$dok9,$line1_3);
$line1_3 = str_replace('DOK0',$dok0,$line1_3);
$line1_3 = str_replace('DUQ1',$dok11,$line1_3);
}else{
$line1_3 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line14.txt")){
$line1_4 = file_get_contents("lib/keyboard/home/line14.txt");
if($line1_4 != null ){
$line1_4 = str_replace('DOK1',$dok1,$line1_4);
$line1_4 = str_replace('DOK2',$dok2,$line1_4);
$line1_4 = str_replace('DOK3',$dok3,$line1_4);
$line1_4 = str_replace('DOK4',$dok4,$line1_4);
$line1_4 = str_replace('DOK5',$dok5,$line1_4);
$line1_4 = str_replace('DOK6',$dok6,$line1_4);
$line1_4 = str_replace('DOK7',$dok7,$line1_4);
$line1_4 = str_replace('DOK8',$dok8,$line1_4);
$line1_4 = str_replace('DOK9',$dok9,$line1_4);
$line1_4 = str_replace('DOK0',$dok0,$line1_4);
$line1_4 = str_replace('DUQ1',$dok11,$line1_4);
}else{
$line1_4 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line21.txt")){
$line2_1 = file_get_contents("lib/keyboard/home/line21.txt");
if($line2_1 != null ){
$line2_1 = str_replace('DOK1',$dok1,$line2_1);
$line2_1 = str_replace('DOK2',$dok2,$line2_1);
$line2_1 = str_replace('DOK3',$dok3,$line2_1);
$line2_1 = str_replace('DOK4',$dok4,$line2_1);
$line2_1 = str_replace('DOK5',$dok5,$line2_1);
$line2_1 = str_replace('DOK6',$dok6,$line2_1);
$line2_1 = str_replace('DOK7',$dok7,$line2_1);
$line2_1 = str_replace('DOK8',$dok8,$line2_1);
$line2_1 = str_replace('DOK9',$dok9,$line2_1);
$line2_1 = str_replace('DOK0',$dok0,$line2_1);
$line2_1 = str_replace('DUQ1',$dok11,$line2_1);
}else{
$line2_1 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line22.txt")){
$line2_2 = file_get_contents("lib/keyboard/home/line22.txt");
if($line2_2 != null ){
$line2_2 = str_replace('DOK1',$dok1,$line2_2);
$line2_2 = str_replace('DOK2',$dok2,$line2_2);
$line2_2 = str_replace('DOK3',$dok3,$line2_2);
$line2_2 = str_replace('DOK4',$dok4,$line2_2);
$line2_2 = str_replace('DOK5',$dok5,$line2_2);
$line2_2 = str_replace('DOK6',$dok6,$line2_2);
$line2_2 = str_replace('DOK7',$dok7,$line2_2);
$line2_2 = str_replace('DOK8',$dok8,$line2_2);
$line2_2 = str_replace('DOK9',$dok9,$line2_2);
$line2_2 = str_replace('DOK0',$dok0,$line2_2);
$line2_2 = str_replace('DUQ1',$dok11,$line2_2);
}else{
$line2_2 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line23.txt")){
$line2_3 = file_get_contents("lib/keyboard/home/line23.txt");
if($line2_3 != null ){
$line2_3 = str_replace('DOK1',$dok1,$line2_3);
$line2_3 = str_replace('DOK2',$dok2,$line2_3);
$line2_3 = str_replace('DOK3',$dok3,$line2_3);
$line2_3 = str_replace('DOK4',$dok4,$line2_3);
$line2_3 = str_replace('DOK5',$dok5,$line2_3);
$line2_3 = str_replace('DOK6',$dok6,$line2_3);
$line2_3 = str_replace('DOK7',$dok7,$line2_3);
$line2_3 = str_replace('DOK8',$dok8,$line2_3);
$line2_3 = str_replace('DOK9',$dok9,$line2_3);
$line2_3 = str_replace('DOK0',$dok0,$line2_3);
$line2_3 = str_replace('DUQ1',$dok11,$line2_3);
}else{
$line2_3 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line24.txt")){
$line2_4 = file_get_contents("lib/keyboard/home/line24.txt");
if($line2_4 != null ){
$line2_4 = str_replace('DOK1',$dok1,$line2_4);
$line2_4 = str_replace('DOK2',$dok2,$line2_4);
$line2_4 = str_replace('DOK3',$dok3,$line2_4);
$line2_4 = str_replace('DOK4',$dok4,$line2_4);
$line2_4 = str_replace('DOK5',$dok5,$line2_4);
$line2_4 = str_replace('DOK6',$dok6,$line2_4);
$line2_4 = str_replace('DOK7',$dok7,$line2_4);
$line2_4 = str_replace('DOK8',$dok8,$line2_4);
$line2_4 = str_replace('DOK9',$dok9,$line2_4);
$line2_4 = str_replace('DOK0',$dok0,$line2_4);
$line2_4 = str_replace('DUQ1',$dok11,$line2_4);
}else{
$line2_4 = "➕";
}}

//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line31.txt")){
$line3_1 = file_get_contents("lib/keyboard/home/line31.txt");
if($line3_1 != null ){
$line3_1 = str_replace('DOK1',$dok1,$line3_1);
$line3_1 = str_replace('DOK2',$dok2,$line3_1);
$line3_1 = str_replace('DOK3',$dok3,$line3_1);
$line3_1 = str_replace('DOK4',$dok4,$line3_1);
$line3_1 = str_replace('DOK5',$dok5,$line3_1);
$line3_1 = str_replace('DOK6',$dok6,$line3_1);
$line3_1 = str_replace('DOK7',$dok7,$line3_1);
$line3_1 = str_replace('DOK8',$dok8,$line3_1);
$line3_1 = str_replace('DOK9',$dok9,$line3_1);
$line3_1 = str_replace('DOK0',$dok0,$line3_1);
$line3_1 = str_replace('DUQ1',$dok11,$line3_1);
}else{
$line3_1 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line32.txt")){
$line3_2 = file_get_contents("lib/keyboard/home/line32.txt");
if($line3_2 != null ){
$line3_2 = str_replace('DOK1',$dok1,$line3_2);
$line3_2 = str_replace('DOK2',$dok2,$line3_2);
$line3_2 = str_replace('DOK3',$dok3,$line3_2);
$line3_2 = str_replace('DOK4',$dok4,$line3_2);
$line3_2 = str_replace('DOK5',$dok5,$line3_2);
$line3_2 = str_replace('DOK6',$dok6,$line3_2);
$line3_2 = str_replace('DOK7',$dok7,$line3_2);
$line3_2 = str_replace('DOK8',$dok8,$line3_2);
$line3_2 = str_replace('DOK9',$dok9,$line3_2);
$line3_2 = str_replace('DOK0',$dok0,$line3_2);
$line3_2 = str_replace('DUQ1',$dok11,$line3_2);
}else{
$line3_2 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line33.txt")){
$line3_3 = file_get_contents("lib/keyboard/home/line33.txt");
if($line3_3 != null ){
$line3_3 = str_replace('DOK1',$dok1,$line3_3);
$line3_3 = str_replace('DOK2',$dok2,$line3_3);
$line3_3 = str_replace('DOK3',$dok3,$line3_3);
$line3_3 = str_replace('DOK4',$dok4,$line3_3);
$line3_3 = str_replace('DOK5',$dok5,$line3_3);
$line3_3 = str_replace('DOK6',$dok6,$line3_3);
$line3_3 = str_replace('DOK7',$dok7,$line3_3);
$line3_3 = str_replace('DOK8',$dok8,$line3_3);
$line3_3 = str_replace('DOK9',$dok9,$line3_3);
$line3_3 = str_replace('DOK0',$dok0,$line3_3);
$line3_3 = str_replace('DUQ1',$dok11,$line3_3);
}else{
$line3_3 = "➕";
}}//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line34.txt")){
$line3_4 = file_get_contents("lib/keyboard/home/line34.txt");
if($line3_4 != null ){
$line3_4 = str_replace('DOK1',$dok1,$line3_4);
$line3_4 = str_replace('DOK2',$dok2,$line3_4);
$line3_4 = str_replace('DOK3',$dok3,$line3_4);
$line3_4 = str_replace('DOK4',$dok4,$line3_4);
$line3_4 = str_replace('DOK5',$dok5,$line3_4);
$line3_4 = str_replace('DOK6',$dok6,$line3_4);
$line3_4 = str_replace('DOK7',$dok7,$line3_4);
$line3_4 = str_replace('DOK8',$dok8,$line3_4);
$line3_4 = str_replace('DOK9',$dok9,$line3_4);
$line3_4 = str_replace('DOK0',$dok0,$line3_4);
$line3_4 = str_replace('DUQ1',$dok11,$line3_4);
}else{
$line3_4 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line41.txt")){
$line4_1 = file_get_contents("lib/keyboard/home/line41.txt");
if($line4_1 != null ){
$line4_1 = str_replace('DOK1',$dok1,$line4_1);
$line4_1 = str_replace('DOK2',$dok2,$line4_1);
$line4_1 = str_replace('DOK3',$dok3,$line4_1);
$line4_1 = str_replace('DOK4',$dok4,$line4_1);
$line4_1 = str_replace('DOK5',$dok5,$line4_1);
$line4_1 = str_replace('DOK6',$dok6,$line4_1);
$line4_1 = str_replace('DOK7',$dok7,$line4_1);
$line4_1 = str_replace('DOK8',$dok8,$line4_1);
$line4_1 = str_replace('DOK9',$dok9,$line4_1);
$line4_1 = str_replace('DOK0',$dok0,$line4_1);
$line4_1 = str_replace('DUQ1',$dok11,$line4_1);
}else{
$line4_1 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line42.txt")){
$line4_2 = file_get_contents("lib/keyboard/home/line42.txt");
if($line4_2 != null ){
$line4_2 = str_replace('DOK1',$dok1,$line4_2);
$line4_2 = str_replace('DOK2',$dok2,$line4_2);
$line4_2 = str_replace('DOK3',$dok3,$line4_2);
$line4_2 = str_replace('DOK4',$dok4,$line4_2);
$line4_2 = str_replace('DOK5',$dok5,$line4_2);
$line4_2 = str_replace('DOK6',$dok6,$line4_2);
$line4_2 = str_replace('DOK7',$dok7,$line4_2);
$line4_2 = str_replace('DOK8',$dok8,$line4_2);
$line4_2 = str_replace('DOK9',$dok9,$line4_2);
$line4_2 = str_replace('DOK0',$dok0,$line4_2);
$line4_2 = str_replace('DUQ1',$dok11,$line4_2);
}else{
$line4_2 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line43.txt")){
$line4_3 = file_get_contents("lib/keyboard/home/line43.txt");
if($line4_3 != null ){
$line4_3 = str_replace('DOK1',$dok1,$line4_3);
$line4_3 = str_replace('DOK2',$dok2,$line4_3);
$line4_3 = str_replace('DOK3',$dok3,$line4_3);
$line4_3 = str_replace('DOK4',$dok4,$line4_3);
$line4_3 = str_replace('DOK5',$dok5,$line4_3);
$line4_3 = str_replace('DOK6',$dok6,$line4_3);
$line4_3 = str_replace('DOK7',$dok7,$line4_3);
$line4_3 = str_replace('DOK8',$dok8,$line4_3);
$line4_3 = str_replace('DOK9',$dok9,$line4_3);
$line4_3 = str_replace('DOK0',$dok0,$line4_3);
$line4_3 = str_replace('DUQ1',$dok11,$line4_3);
}else{
$line4_3 = "➕";
}}//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line44.txt")){
$line4_4 = file_get_contents("lib/keyboard/home/line44.txt");
if($line4_4 != null ){
$line4_4 = str_replace('DOK1',$dok1,$line4_4);
$line4_4 = str_replace('DOK2',$dok2,$line4_4);
$line4_4 = str_replace('DOK3',$dok3,$line4_4);
$line4_4 = str_replace('DOK4',$dok4,$line4_4);
$line4_4 = str_replace('DOK5',$dok5,$line4_4);
$line4_4 = str_replace('DOK6',$dok6,$line4_4);
$line4_4 = str_replace('DOK7',$dok7,$line4_4);
$line4_4 = str_replace('DOK8',$dok8,$line4_4);
$line4_4 = str_replace('DOK9',$dok9,$line4_4);
$line4_4 = str_replace('DOK0',$dok0,$line4_4);
$line4_4 = str_replace('DUQ1',$dok11,$line4_4);
}else{
$line4_4 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line51.txt")){
$line5_1 = file_get_contents("lib/keyboard/home/line51.txt");
if($line5_1 != null ){
$line5_1 = str_replace('DOK1',$dok1,$line5_1);
$line5_1 = str_replace('DOK2',$dok2,$line5_1);
$line5_1 = str_replace('DOK3',$dok3,$line5_1);
$line5_1 = str_replace('DOK4',$dok4,$line5_1);
$line5_1 = str_replace('DOK5',$dok5,$line5_1);
$line5_1 = str_replace('DOK6',$dok6,$line5_1);
$line5_1 = str_replace('DOK7',$dok7,$line5_1);
$line5_1 = str_replace('DOK8',$dok8,$line5_1);
$line5_1 = str_replace('DOK9',$dok9,$line5_1);
$line5_1 = str_replace('DOK0',$dok0,$line5_1);
$line5_1 = str_replace('DUQ1',$dok11,$line5_1);
}else{
$line5_1 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line52.txt")){
$line5_2 = file_get_contents("lib/keyboard/home/line52.txt");
if($line5_2 != null ){
$line5_2 = str_replace('DOK1',$dok1,$line5_2);
$line5_2 = str_replace('DOK2',$dok2,$line5_2);
$line5_2 = str_replace('DOK3',$dok3,$line5_2);
$line5_2 = str_replace('DOK4',$dok4,$line5_2);
$line5_2 = str_replace('DOK5',$dok5,$line5_2);
$line5_2 = str_replace('DOK6',$dok6,$line5_2);
$line5_2 = str_replace('DOK7',$dok7,$line5_2);
$line5_2 = str_replace('DOK8',$dok8,$line5_2);
$line5_2 = str_replace('DOK9',$dok9,$line5_2);
$line5_2 = str_replace('DOK0',$dok0,$line5_2);
$line5_2 = str_replace('DUQ1',$dok11,$line5_2);
}else{
$line5_2 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line53.txt")){
$line5_3 = file_get_contents("lib/keyboard/home/line53.txt");
if($line5_3 != null ){
$line5_3 = str_replace('DOK1',$dok1,$line5_3);
$line5_3 = str_replace('DOK2',$dok2,$line5_3);
$line5_3 = str_replace('DOK3',$dok3,$line5_3);
$line5_3 = str_replace('DOK4',$dok4,$line5_3);
$line5_3 = str_replace('DOK5',$dok5,$line5_3);
$line5_3 = str_replace('DOK6',$dok6,$line5_3);
$line5_3 = str_replace('DOK7',$dok7,$line5_3);
$line5_3 = str_replace('DOK8',$dok8,$line5_3);
$line5_3 = str_replace('DOK9',$dok9,$line5_3);
$line5_3 = str_replace('DOK0',$dok0,$line5_3);
$line5_3 = str_replace('DUQ1',$dok11,$line5_3);
}else{
$line5_3 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line54.txt")){
$line5_4 = file_get_contents("lib/keyboard/home/line54.txt");
if($line5_4 != null ){
$line5_4 = str_replace('DOK1',$dok1,$line5_4);
$line5_4 = str_replace('DOK2',$dok2,$line5_4);
$line5_4 = str_replace('DOK3',$dok3,$line5_4);
$line5_4 = str_replace('DOK4',$dok4,$line5_4);
$line5_4 = str_replace('DOK5',$dok5,$line5_4);
$line5_4 = str_replace('DOK6',$dok6,$line5_4);
$line5_4 = str_replace('DOK7',$dok7,$line5_4);
$line5_4 = str_replace('DOK8',$dok8,$line5_4);
$line5_4 = str_replace('DOK9',$dok9,$line5_4);
$line5_4 = str_replace('DOK0',$dok0,$line5_4);
$line5_4 = str_replace('DUQ1',$dok11,$line5_4);
}else{
$line5_4 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line61.txt")){
$line6_1 = file_get_contents("lib/keyboard/home/line61.txt");
if($line6_1 != null ){
$line6_1 = str_replace('DOK1',$dok1,$line6_1);
$line6_1 = str_replace('DOK2',$dok2,$line6_1);
$line6_1 = str_replace('DOK3',$dok3,$line6_1);
$line6_1 = str_replace('DOK4',$dok4,$line6_1);
$line6_1 = str_replace('DOK5',$dok5,$line6_1);
$line6_1 = str_replace('DOK6',$dok6,$line6_1);
$line6_1 = str_replace('DOK7',$dok7,$line6_1);
$line6_1 = str_replace('DOK8',$dok8,$line6_1);
$line6_1 = str_replace('DOK9',$dok9,$line6_1);
$line6_1 = str_replace('DOK0',$dok0,$line6_1);
$line6_1 = str_replace('DUQ1',$dok11,$line6_1);
}else{
$line6_1 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line62.txt")){
$line6_2 = file_get_contents("lib/keyboard/home/line62.txt");
if($line6_2 != null ){
$line6_2 = str_replace('DOK1',$dok1,$line6_2);
$line6_2 = str_replace('DOK2',$dok2,$line6_2);
$line6_2 = str_replace('DOK3',$dok3,$line6_2);
$line6_2 = str_replace('DOK4',$dok4,$line6_2);
$line6_2 = str_replace('DOK5',$dok5,$line6_2);
$line6_2 = str_replace('DOK6',$dok6,$line6_2);
$line6_2 = str_replace('DOK7',$dok7,$line6_2);
$line6_2 = str_replace('DOK8',$dok8,$line6_2);
$line6_2 = str_replace('DOK9',$dok9,$line6_2);
$line6_2 = str_replace('DOK0',$dok0,$line6_2);
$line6_2 = str_replace('DUQ1',$dok11,$line6_2);
}else{
$line6_2 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line63.txt")){
$line6_3 = file_get_contents("lib/keyboard/home/line63.txt");
if($line6_3 != null ){
$line6_3 = str_replace('DOK1',$dok1,$line6_3);
$line6_3 = str_replace('DOK2',$dok2,$line6_3);
$line6_3 = str_replace('DOK3',$dok3,$line6_3);
$line6_3 = str_replace('DOK4',$dok4,$line6_3);
$line6_3 = str_replace('DOK5',$dok5,$line6_3);
$line6_3 = str_replace('DOK6',$dok6,$line6_3);
$line6_3 = str_replace('DOK7',$dok7,$line6_3);
$line6_3 = str_replace('DOK8',$dok8,$line6_3);
$line6_3 = str_replace('DOK9',$dok9,$line6_3);
$line6_3 = str_replace('DOK0',$dok0,$line6_3);
$line6_3 = str_replace('DUQ1',$dok11,$line6_3);
}else{
$line6_3 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line64.txt")){
$line6_4 = file_get_contents("lib/keyboard/home/line64.txt");
if($line6_4 != null ){
$line6_4 = str_replace('DOK1',$dok1,$line6_4);
$line6_4 = str_replace('DOK2',$dok2,$line6_4);
$line6_4 = str_replace('DOK3',$dok3,$line6_4);
$line6_4 = str_replace('DOK4',$dok4,$line6_4);
$line6_4 = str_replace('DOK5',$dok5,$line6_4);
$line6_4 = str_replace('DOK6',$dok6,$line6_4);
$line6_4 = str_replace('DOK7',$dok7,$line6_4);
$line6_4 = str_replace('DOK8',$dok8,$line6_4);
$line6_4 = str_replace('DOK9',$dok9,$line6_4);
$line6_4 = str_replace('DOK0',$dok0,$line6_4);
$line6_4 = str_replace('DUQ1',$dok11,$line6_4);
}else{
$line6_4 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line71.txt")){
$line7_1 = file_get_contents("lib/keyboard/home/line71.txt");
if($line7_1 != null ){
$line7_1 = str_replace('DOK1',$dok1,$line7_1);
$line7_1 = str_replace('DOK2',$dok2,$line7_1);
$line7_1 = str_replace('DOK3',$dok3,$line7_1);
$line7_1 = str_replace('DOK4',$dok4,$line7_1);
$line7_1 = str_replace('DOK5',$dok5,$line7_1);
$line7_1 = str_replace('DOK6',$dok6,$line7_1);
$line7_1 = str_replace('DOK7',$dok7,$line7_1);
$line7_1 = str_replace('DOK8',$dok8,$line7_1);
$line7_1 = str_replace('DOK9',$dok9,$line7_1);
$line7_1 = str_replace('DOK0',$dok0,$line7_1);
$line7_1 = str_replace('DUQ1',$dok11,$line7_1);
}else{
$line7_1 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line72.txt")){
$line7_2 = file_get_contents("lib/keyboard/home/line72.txt");
if($line7_2 != null ){
$line7_2 = str_replace('DOK1',$dok1,$line7_2);
$line7_2 = str_replace('DOK2',$dok2,$line7_2);
$line7_2 = str_replace('DOK3',$dok3,$line7_2);
$line7_2 = str_replace('DOK4',$dok4,$line7_2);
$line7_2 = str_replace('DOK5',$dok5,$line7_2);
$line7_2 = str_replace('DOK6',$dok6,$line7_2);
$line7_2 = str_replace('DOK7',$dok7,$line7_2);
$line7_2 = str_replace('DOK8',$dok8,$line7_2);
$line7_2 = str_replace('DOK9',$dok9,$line7_2);
$line7_2 = str_replace('DOK0',$dok0,$line7_2);
$line7_2 = str_replace('DUQ1',$dok11,$line7_2);
}else{
$line7_2 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line73.txt")){
$line7_3 = file_get_contents("lib/keyboard/home/line73.txt");
if($line7_3 != null ){
$line7_3 = str_replace('DOK1',$dok1,$line7_3);
$line7_3 = str_replace('DOK2',$dok2,$line7_3);
$line7_3 = str_replace('DOK3',$dok3,$line7_3);
$line7_3 = str_replace('DOK4',$dok4,$line7_3);
$line7_3 = str_replace('DOK5',$dok5,$line7_3);
$line7_3 = str_replace('DOK6',$dok6,$line7_3);
$line7_3 = str_replace('DOK7',$dok7,$line7_3);
$line7_3 = str_replace('DOK8',$dok8,$line7_3);
$line7_3 = str_replace('DOK9',$dok9,$line7_3);
$line7_3 = str_replace('DOK0',$dok0,$line7_3);
$line7_3 = str_replace('DUQ1',$dok11,$line7_3);
}else{
$line7_3 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line74.txt")){
$line7_4 = file_get_contents("lib/keyboard/home/line74.txt");
if($line7_4 != null ){
$line7_4 = str_replace('DOK1',$dok1,$line7_4);
$line7_4 = str_replace('DOK2',$dok2,$line7_4);
$line7_4 = str_replace('DOK3',$dok3,$line7_4);
$line7_4 = str_replace('DOK4',$dok4,$line7_4);
$line7_4 = str_replace('DOK5',$dok5,$line7_4);
$line7_4 = str_replace('DOK6',$dok6,$line7_4);
$line7_4 = str_replace('DOK7',$dok7,$line7_4);
$line7_4 = str_replace('DOK8',$dok8,$line7_4);
$line7_4 = str_replace('DOK9',$dok9,$line7_4);
$line7_4 = str_replace('DOK0',$dok0,$line7_4);
$line7_4 = str_replace('DUQ1',$dok11,$line7_4);
}else{
$line7_4 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line81.txt")){
$line8_1 = file_get_contents("lib/keyboard/home/line81.txt");
if($line8_1 != null ){
$line8_1 = str_replace('DOK1',$dok1,$line8_1);
$line8_1 = str_replace('DOK2',$dok2,$line8_1);
$line8_1 = str_replace('DOK3',$dok3,$line8_1);
$line8_1 = str_replace('DOK4',$dok4,$line8_1);
$line8_1 = str_replace('DOK5',$dok5,$line8_1);
$line8_1 = str_replace('DOK6',$dok6,$line8_1);
$line8_1 = str_replace('DOK7',$dok7,$line8_1);
$line8_1 = str_replace('DOK8',$dok8,$line8_1);
$line8_1 = str_replace('DOK9',$dok9,$line8_1);
$line8_1 = str_replace('DOK0',$dok0,$line8_1);
$line8_1 = str_replace('DUQ1',$dok11,$line8_1);
}else{
$line8_1 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line82.txt")){
$line8_2 = file_get_contents("lib/keyboard/home/line82.txt");
if($line8_2 != null ){
$line8_2 = str_replace('DOK1',$dok1,$line8_2);
$line8_2 = str_replace('DOK2',$dok2,$line8_2);
$line8_2 = str_replace('DOK3',$dok3,$line8_2);
$line8_2 = str_replace('DOK4',$dok4,$line8_2);
$line8_2 = str_replace('DOK5',$dok5,$line8_2);
$line8_2 = str_replace('DOK6',$dok6,$line8_2);
$line8_2 = str_replace('DOK7',$dok7,$line8_2);
$line8_2 = str_replace('DOK8',$dok8,$line8_2);
$line8_2 = str_replace('DOK9',$dok9,$line8_2);
$line8_2 = str_replace('DOK0',$dok0,$line8_2);
$line8_2 = str_replace('DUQ1',$dok11,$line8_2);
}else{
$line8_2 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line83.txt")){
$line8_3 = file_get_contents("lib/keyboard/home/line83.txt");
if($line8_3 != null ){
$line8_3 = str_replace('DOK1',$dok1,$line8_3);
$line8_3 = str_replace('DOK2',$dok2,$line8_3);
$line8_3 = str_replace('DOK3',$dok3,$line8_3);
$line8_3 = str_replace('DOK4',$dok4,$line8_3);
$line8_3 = str_replace('DOK5',$dok5,$line8_3);
$line8_3 = str_replace('DOK6',$dok6,$line8_3);
$line8_3 = str_replace('DOK7',$dok7,$line8_3);
$line8_3 = str_replace('DOK8',$dok8,$line8_3);
$line8_3 = str_replace('DOK9',$dok9,$line8_3);
$line8_3 = str_replace('DOK0',$dok0,$line8_3);
$line8_3 = str_replace('DUQ1',$dok11,$line8_3);
}else{
$line8_3 = "➕";
}}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/keyboard/home/line84.txt")){
$line8_4 = file_get_contents("lib/keyboard/home/line84.txt");
if($line8_4 != null ){
$line8_4 = str_replace('DOK1',$dok1,$line8_4);
$line8_4 = str_replace('DOK2',$dok2,$line8_4);
$line8_4 = str_replace('DOK3',$dok3,$line8_4);
$line8_4 = str_replace('DOK4',$dok4,$line8_4);
$line8_4 = str_replace('DOK5',$dok5,$line8_4);
$line8_4 = str_replace('DOK6',$dok6,$line8_4);
$line8_4 = str_replace('DOK7',$dok7,$line8_4);
$line8_4 = str_replace('DOK8',$dok8,$line8_4);
$line8_4 = str_replace('DOK9',$dok9,$line8_4);
$line8_4 = str_replace('DOK0',$dok0,$line8_4);
$line8_4 = str_replace('DUQ1',$dok11,$line8_4);
}else{$line8_4 = "➕";}}
$Button_sete = json_encode(['inline_keyboard'=>[
[['text'=>"$line1_1",'callback_data'=>'set-line11'],['text'=>"$line1_2",'callback_data'=>'set-line12'],['text'=>"$line1_3",'callback_data'=>'set-line13'],['text'=>"$line1_4",'callback_data'=>'set-line14']],
[['text'=>"$line2_1",'callback_data'=>'set-line21'],['text'=>"$line2_2",'callback_data'=>'set-line22'],['text'=>"$line2_3",'callback_data'=>'set-line23'],['text'=>"$line2_4",'callback_data'=>'set-line24']],
[['text'=>"$line3_1",'callback_data'=>'set-line31'],['text'=>"$line3_2",'callback_data'=>'set-line32'],['text'=>"$line3_3",'callback_data'=>'set-line33'],['text'=>"$line3_4",'callback_data'=>'set-line34']],
[['text'=>"$line4_1",'callback_data'=>'set-line41'],['text'=>"$line4_2",'callback_data'=>'set-line42'],['text'=>"$line4_3",'callback_data'=>'set-line43'],['text'=>"$line4_4",'callback_data'=>'set-line44']],
[['text'=>"$line5_1",'callback_data'=>'set-line51'],['text'=>"$line5_2",'callback_data'=>'set-line52'],['text'=>"$line5_3",'callback_data'=>'set-line53'],['text'=>"$line5_4",'callback_data'=>'set-line54']],
[['text'=>"$line6_1",'callback_data'=>'set-line61'],['text'=>"$line6_2",'callback_data'=>'set-line62'],['text'=>"$line6_3",'callback_data'=>'set-line63'],['text'=>"$line6_4",'callback_data'=>'set-line64']],
[['text'=>"$line7_1",'callback_data'=>'set-line71'],['text'=>"$line7_2",'callback_data'=>'set-line72'],['text'=>"$line7_3",'callback_data'=>'set-line73'],['text'=>"$line7_4",'callback_data'=>'set-line74']],
[['text'=>"$line8_1",'callback_data'=>'set-line81'],['text'=>"$line8_2",'callback_data'=>'set-line82'],['text'=>"$line8_3",'callback_data'=>'set-line83'],['text'=>"$line8_4",'callback_data'=>'set-line84']],
]]);
Editmessagetext($chatID, $msg_id,"👈️ گزینه مورد نظر را انتخاب نمائید.",$Button_sete);
}
//////////------------------------\\\\\\\\\\\\\\//
elseif (!file_exists("melat/$userID.json") and $userID != null){
$user["step"] = "none";
$user["date-start"] = "$date";
$user["zirmjmae"] = "0";
$user["type-panel"] = 'عادی';
$user['time-panel'] = '0';
$user["Points"] = "10";
$user["warn"] = "0";
$user["ads"] = "0";
$user['enteghal_as'] = 0;
$user['enteghal_to'] = 0;
$user['ENTEQALAT'] = null;
$user["send-coin-admin"] = "0";
$user["sefaresh"] = "0";
$user["sub"] = null;
$user["zirmjmae-porsant"] = "0";
$user["zirmjmae-join"] = "0";
$user['time-day'] = "0";
saveJson("melat/$userID.json",$user);
}
if(file_exists(error_log))
unlink(error_log);
?>
