<?php
if(file_exists("lib/Button/money.txt")){$money = file_get_contents("lib/Button/money.txt");
}else{$money = "الماس";}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/Button/icmoney.txt")){$icmoney = file_get_contents("lib/Button/icmoney.txt");
}else{$icmoney = "💎";}
//----------------------------------------/////
if(file_exists("lib/Button/shops.txt")){$shops = file_get_contents("lib/Button/shops.txt");
}else{$shops = "0";}
//----------------------------------------/////
if(file_exists("lib/Button/dokt1.txt")){$dokt1 = file_get_contents("lib/Button/dokt1.txt");
}else{$dokt1 = "تنظیم نشده";$mmbrs1 = "null";}
//----------------------------------------/////
if(file_exists("lib/Button/dokt2.txt")){
$dokt2 = file_get_contents("lib/Button/dokt2.txt");
}else{
$dokt2 = "تنظیم نشده";
$mmbrs2 = "null";
}
//----------------------------------------/////
if(file_exists("lib/Button/dokt3.txt")){
$dokt3 = file_get_contents("lib/Button/dokt3.txt");
}else{
$dokt3 = "تنظیم نشده";
$mmbrs3 = "null";
}
//----------------------------------------/////
if(file_exists("lib/Button/dokt4.txt")){
$dokt4 = file_get_contents("lib/Button/dokt4.txt");
}else{
$dokt4 = "تنظیم نشده";
$mmbrs4 = "null";
}
//----------------------------------------/////
if(file_exists("lib/Button/dokt5.txt")){
$dokt5 = file_get_contents("lib/Button/dokt5.txt");
}else{
$dokt5 = "تنظیم نشده";
$mmbrs5 = "null";
}
//----------------------------------------/////
if(file_exists("lib/Button/dokt6.txt")){
$dokt6 = file_get_contents("lib/Button/dokt6.txt");
}else{
$dokt6 = "تنظیم نشده";
$mmbrs6 = "null";
}
//----------------------------------------/////
///////////------//////////-----------////////
if(file_exists("lib/Button/memsabt1.txt")){
$mmbrsabt1 = file_get_contents("lib/Button/memsabt1.txt");
}else{
$mmbrsabt1 = "تنظیم نشده";
}
///////////------//////////-----------////////
if(file_exists("lib/Button/coinsabt1.txt")){
$mmbrsabt11 = file_get_contents("lib/Button/coinsabt1.txt");
}else{
$mmbrsabt11 = "تنظیم نشده";
}
///////////------//////////-----------////////
if(file_exists("lib/Button/memsabt2.txt")){
$mmbrsabt2 = file_get_contents("lib/Button/memsabt2.txt");
}else{
$mmbrsabt2 = "تنظیم نشده";
}
///////////------//////////-----------////////
if(file_exists("lib/Button/coinsabt2.txt")){
$mmbrsabt22 = file_get_contents("lib/Button/coinsabt2.txt");
}else{
$mmbrsabt22 = "تنظیم نشده";
}
///////////------//////////-----------////////
if(file_exists("lib/Button/memsabt3.txt")){
$mmbrsabt3 = file_get_contents("lib/Button/memsabt3.txt");
}else{
$mmbrsabt3 = "تنظیم نشده";
}
///////////------//////////-----------////////
if(file_exists("lib/Button/coinsabt3.txt")){
$mmbrsabt33 = file_get_contents("lib/Button/coinsabt3.txt");
}else{
$mmbrsabt33 = "تنظیم نشده";
}
///////////------//////////-----------////////
if(file_exists("lib/Button/memsabt4.txt")){
$mmbrsabt4 = file_get_contents("lib/Button/memsabt4.txt");
}else{
$mmbrsabt4 = "تنظیم نشده";
}
///////////------//////////-----------////////
if(file_exists("lib/Button/coinsabt4.txt")){
$mmbrsabt44 = file_get_contents("lib/Button/coinsabt4.txt");
}else{
$mmbrsabt44 = "تنظیم نشده";
}
///////////------//////////-----------////////
if(file_exists("lib/Button/memsabt5.txt")){
$mmbrsabt5 = file_get_contents("lib/Button/memsabt5.txt");
}else{
$mmbrsabt5 = "تنظیم نشده";
}
///////////------//////////-----------////////
if(file_exists("lib/Button/coinsabt5.txt")){
$mmbrsabt55 = file_get_contents("lib/Button/coinsabt5.txt");
}else{
$mmbrsabt55 = "تنظیم نشده";
}
///////////------//////////-----------////////
if(file_exists("lib/Button/memsabt6.txt")){
$mmbrsabt6 = file_get_contents("lib/Button/memsabt6.txt");
}else{
$mmbrsabt6 = "تنظیم نشده";
}
///////////------//////////-----------////////
if(file_exists("lib/Button/coinsabt6.txt")){
$mmbrsabt66 = file_get_contents("lib/Button/coinsabt6.txt");
}else{
$mmbrsabt66 = "تنظیم نشده";
}
///////////------//////////-----------////////
if(file_exists("lib/Button/shoptxt1.txt")){$shoptxt1 = file_get_contents("lib/Button/shoptxt1.txt");
}else{$shoptxt1 = "متن این بخش باید از پنل مدیریت تنظیم شود";}
//----------------------------------------/////
if(file_exists("lib/Button/shoptxt2.txt")){$shoptxt2 = file_get_contents("lib/Button/shoptxt2.txt");
}else{$shoptxt2 = "متن این بخش باید از پنل مدیریت تنظیم شود";}
//----------------------------------------/////
//----------------------------------------/////
if(file_exists("lib/Button/coinshop1.txt")){
$coinshop1 = file_get_contents("lib/Button/coinshop1.txt");
}else{
$coinshop1 = "20";
}
//----------------------------------------/////
if(file_exists("lib/Button/coinshop2.txt")){
$coinshop2 = file_get_contents("lib/Button/coinshop2.txt");
}else{
$coinshop2 = "45";
}
//----------------------------------------/////
if(file_exists("lib/Button/coinshop3.txt")){
$coinshop3 = file_get_contents("lib/Button/coinshop3.txt");
}else{
$coinshop3 = "85";
}
//----------------------------------------/////
if(file_exists("lib/Button/coinshop4.txt")){
$coinshop4 = file_get_contents("lib/Button/coinshop4.txt");
}else{
$coinshop4 = "150";
}
//----------------------------------------/////
if(file_exists("lib/Button/coinshop5.txt")){
$coinshop5 = file_get_contents("lib/Button/coinshop5.txt");
}else{
$coinshop5 = "200";
}
//####################################################################
if(file_exists("lib/Button/amount1.txt")){
$amount1 = file_get_contents("lib/Button/amount1.txt");
}else{
$amount1 = "10000";
}
//----------------------------------------/////
if(file_exists("lib/Button/amount2.txt")){
$amount2 = file_get_contents("lib/Button/amount2.txt");
}else{
$amount2 = "20000";
}
//----------------------------------------/////
if(file_exists("lib/Button/amount3.txt")){
$amount3 = file_get_contents("lib/Button/amount3.txt");
}else{
$amount3 = "500000";
}
//----------------------------------------/////\
if(file_exists("lib/Button/amount4.txt")){
$amount4 = file_get_contents("lib/Button/amount4.txt");
}else{
$amount4 = "100000";
}
//----------------------------------------/////
if(file_exists("lib/Button/amount5.txt")){
$amount5 = file_get_contents("lib/Button/amount5.txt");
}else{
$amount5 = "200000";
}
//####################################################################
if(file_exists("lib/Button/aytem1.txt")){
$aytem1 = file_get_contents("lib/Button/aytem1.txt");
}else{
$aytem1 = "$icmoney $coinshop1 $money | $amount1 ریال $icmoney";
}
//----------------------------------------/////
if(file_exists("lib/Button/aytem2.txt")){
$aytem2 = file_get_contents("lib/Button/aytem2.txt");
}else{
$aytem2 = "$icmoney $coinshop2 $money | $amount2 ریال $icmoney";
}
//----------------------------------------/////
if(file_exists("lib/Button/aytem3.txt")){
$aytem3 = file_get_contents("lib/Button/aytem3.txt");
}else{
$aytem3 = "$icmoney $coinshop3 $money | $amount3 ریال $icmoney";
}
//----------------------------------------/////\
if(file_exists("lib/Button/aytem4.txt")){
$aytem4 = file_get_contents("lib/Button/aytem4.txt");
}else{
$aytem4 = "$icmoney $coinshop4 $money | $amount4 ریال $icmoney";
}
//----------------------------------------/////\
if(file_exists("lib/Button/aytem5.txt")){
$aytem5 = file_get_contents("lib/Button/aytem5.txt");
}else{
$aytem5 = "$icmoney $coinshop5 $money | $amount5 ریال $icmoney";
}
//----------------------------------------/////
//####################################################################
if(file_exists("lib/Button/daypanel1.txt")){
$daypanel1 = file_get_contents("lib/Button/daypanel1.txt");
}else{
$daypanel1 = "7";
}
//----------------------------------------/////
if(file_exists("lib/Button/daypanel2.txt")){
$daypanel2 = file_get_contents("lib/Button/daypanel2.txt");
}else{
$daypanel2 = "7";
}
//----------------------------------------/////
if(file_exists("lib/Button/daypanel3.txt")){
$daypanel3 = file_get_contents("lib/Button/daypanel3.txt");
}else{
$daypanel3 = "30";
}
//----------------------------------------/////
if(file_exists("lib/Button/daypanel4.txt")){
$daypanel4 = file_get_contents("lib/Button/daypanel4.txt");
}else{
$daypanel4 = "30";
}
//####################################################################
if(file_exists("lib/Button/amounts1.txt")){
$amounts1 = file_get_contents("lib/Button/amounts1.txt");
}else{
$amounts1 = "50000";
}
//----------------------------------------/////
if(file_exists("lib/Button/amounts2.txt")){
$amounts2 = file_get_contents("lib/Button/amounts2.txt");
}else{
$amounts2 = "100000";
}
//----------------------------------------/////
if(file_exists("lib/Button/amounts3.txt")){
$amounts3 = file_get_contents("lib/Button/amounts3.txt");
}else{
$amounts3 = "200000";
}
//----------------------------------------/////\
if(file_exists("lib/Button/amounts4.txt")){
$amounts4 = file_get_contents("lib/Button/amounts4.txt");
}else{
$amounts4 = "250000";
}
//####################################################################
if(file_exists("lib/Button/aytems1.txt")){
$aytems1 = file_get_contents("lib/Button/aytems1.txt");
}else{
$aytems1 = "پنل حرفه ای 7 روزه 50000 ریال";
}
//----------------------------------------/////
if(file_exists("lib/Button/aytems2.txt")){
$aytems2 = file_get_contents("lib/Button/aytems2.txt");
}else{
$aytems2 = "پنل ویژه 7 روزه 100000 ریال";
}
//----------------------------------------/////
if(file_exists("lib/Button/aytems3.txt")){
$aytems3 = file_get_contents("lib/Button/aytems3.txt");
}else{
$aytems3 = "پنل حرفه ای 30 روزه 200000 ریال";
}
//----------------------------------------/////\
if(file_exists("lib/Button/aytems4.txt")){
$aytems4 = file_get_contents("lib/Button/aytems4.txt");
}else{
$aytems4 = "پنل ویژه 30 روزه 250000 ریال";
}
//####################################################################
if(file_exists("lib/Button/dok1.txt")){$dok1 = file_get_contents("lib/Button/dok1.txt");
$dok1 = str_replace('MONEY',"$money",$dok1);
$dok1 = str_replace('IC',"$icmoney",$dok1);
}else{$dok1 = "$icmoney  دریافت $money رایگان  $icmoney";}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/Button/dok2.txt")){$dok2 = file_get_contents("lib/Button/dok2.txt");
}else{$dok2 = "🖥  حساب کاربری";}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/Button/dok3.txt")){$dok3 = file_get_contents("lib/Button/dok3.txt");
}else{$dok3 = "✅ سفارش ممبر";}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/Button/dok4.txt")){$dok4 = file_get_contents("lib/Button/dok4.txt");
}else{$dok4 = "👥جذب زیرمجموعه";}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/Button/dok5.txt")){$dok5 = file_get_contents("lib/Button/dok5.txt");
}else{$dok5 = "💳 بانک انتقال";}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/Button/dok6.txt")){$dok6 = file_get_contents("lib/Button/dok6.txt");
}else{$dok6 = "🔍 پیگیری ها";}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/Button/dok7.txt")){$dok7 = file_get_contents("lib/Button/dok7.txt");
}else{$dok7 = "〽️ پـنـل هـا";}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/Button/dok8.txt")){$dok8 = file_get_contents("lib/Button/dok8.txt");
}else{$dok8 = "🏆 برترین ها";}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/Button/dok9.txt")){$dok9 = file_get_contents("lib/Button/dok9.txt");
}else{$dok9 = "🛍 فروشگاه";}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/Button/dok0.txt")){$dok0 = file_get_contents("lib/Button/dok0.txt");
}else{$dok0 = "🎁 کد هـدیـه";}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/Button/dok11.txt")){$dok11 = file_get_contents("lib/Button/dok11.txt");
}else{$dok11 = "📚 راهـنـمـا";}
//////////------------------------\\\\\\\\\\\\\\
if(file_exists("lib/Button/dokp1.txt")){$dokp1 = file_get_contents("lib/Button/dokp1.txt");
}else{$dokp1 = "🔍پیگیری سفارشات🔍";}
if(file_exists("lib/Button/dokp2.txt")){$dokp2 = file_get_contents("lib/Button/dokp2.txt");
}else{$dokp2 = "📞تماس با ما";}
if(file_exists("lib/Button/dokp3.txt")){$dokp3 = file_get_contents("lib/Button/dokp3.txt");
}else{$dokp3 = "‼️قوانین";}
///////////------//////////-----------////////
if(file_exists("lib/Button/dokchannel.txt")){$dokchannel = file_get_contents("lib/Button/dokchannel.txt");
}else{$dokchannel = "عضویت در کانال👤";}
///////////------//////////-----------////////
if(file_exists("lib/Button/best1.txt")){ $best1 = file_get_contents("lib/Button/best1.txt"); 
}else{$best1 = "👤جذب زیرمجموعه👤";}
///////////------//////////-----------////////
if(file_exists("lib/Button/best2.txt")){ $best2 = file_get_contents("lib/Button/best2.txt"); 
}else{ $best2 = "عضویت در کانال📢"; }
///////////------//////////-----------////////
if(file_exists("lib/Button/best3.txt")){$best3 = file_get_contents("lib/Button/best3.txt");
}else{$best3 = "ثبت سفارش📇️";}
///////////------//////////-----------////////
if(file_exists("lib/keyboard/orderkey.txt")){$orderkey = file_get_contents("lib/keyboard/orderkey.txt");
}else{$orderkey = "1";}
///////////------//////////-----------////////
if(file_exists("lib/keyboard/channelkey.txt")){$keyboard_ch = file_get_contents("lib/keyboard/channelkey.txt");
}else{$keyboard_ch = "1";}
//----------------------------------------/////
if(file_exists("lib/Button/doktxt1.txt")){$doktxt1 = file_get_contents("lib/Button/doktxt1.txt");
}else{$doktxt1 = "به بخش دریافت الماس رایگان خوش آمدید🌹

📌در این بخش میتونید با استفاده از دوروش زیر برای خودتون الماس جمع آوری کنید سپس با الماس های جمع آوری شده برای کانال خود ممبر سفارش بدید


👈 دو روش برای جمع آوری الماس وجود دارد:

️1⃣ دریافت الماس روزانه: با استفاده از بخش میتوانید در ربات با زدن یک دکمه مقدار  الماس دریافت کنید

2⃣ عضویت در کانال های موجود: در این روش شما میتوانید با عضویت در کانال های موجود و سپس زدن دکمه ی دریافت  اقدام به جمع آوری الماس نمایید";}
//----------------------------------------/////
if(file_exists("lib/Button/doktxt2.txt")){$doktxt2 = file_get_contents("lib/Button/doktxt2.txt");
}else{$doktxt2 = "متن پیش فرض - قابل تنظیم از مدیریت";}
//----------------------------------------/////
if(file_exists("lib/Button/doktxt3.txt")){$doktxt3 = file_get_contents("lib/Button/doktxt3.txt");
}else{$doktxt3 = "❓مقدار ممبر درخواستی خود را انتخاب کنید";}
//----------------------------------------/////
if(file_exists("lib/Button/doktxt4.txt")){$doktxt4 = file_get_contents("lib/Button/doktxt4.txt");
}else{$doktxt4 = "توضیحات این بخش باید از پنل مدیریت ربات تنظیم شود";}
//----------------------------------------/////
if(file_exists("lib/Button/doktxt5.txt")){$doktxt5 = file_get_contents("lib/Button/doktxt5.txt");
}else{$doktxt5 = "به بخش انتقال الماس خوش آمدید🌹

در این بخش گزارشی از انتقالات الماس ها ارائه میگردد

💎  با دکمه انتقال الماس می توانید الماس های خود را به دیگران انتقال دهید.

✅ با دکمه تاریخچه دریافتها می توانید کلیه مشخصات دریافت الماس های خود را مشاهده نمایید.

✔️ با دکمه تاریخچه انتقالها می توانید کلیه مشخصات انتقال الماس های خود را مشاهده نمایید.";}
//----------------------------------------/////
if(file_exists("lib/Button/doktxt6.txt")){$doktxt6 = file_get_contents("lib/Button/doktxt6.txt");
}else{$doktxt6 = "👈️ گزینه مورد نظر را انتخاب نمائید.";}
//----------------------------------------/////
if(file_exists("lib/Button/doktxt7.txt")){$doktxt7 = file_get_contents("lib/Button/doktxt7.txt");
}else{$doktxt7 = "متن این بخش باید از پنل مدیریت تنظیم شود";}
//----------------------------------------/////
if(file_exists("lib/Button/doktxt8.txt")){$doktxt8 = file_get_contents("lib/Button/doktxt8.txt");
}else{$doktxt8 = "تمایل به مشاهده برترین کاربران کدام بخش دارید؟";}
//----------------------------------------/////
if(file_exists("lib/Button/doktxt9.txt")){$doktxt9 = file_get_contents("lib/Button/doktxt9.txt");
}else{$doktxt9 = "متن این بخش باید از پنل مدیریت تنظیم شود";}
//----------------------------------------/////
if(file_exists("lib/Button/doktxt0.txt")){$doktxt0 = file_get_contents("lib/Button/doktxt0.txt");
}else{$doktxt0 = "کد هدیه را وارد کنید";}
//----------------------------------------/////
if(file_exists("lib/Button/doktxt11.txt")){$doktxt11 = file_get_contents("lib/Button/doktxt11.txt");
}else{$doktxt11 = "متن این بخش باید از پنل مدیریت تنظیم شود";}
//----------------------------------------/////
if(file_exists("lib/Button/starttext.txt")){
$username = $message->from->username;
$starttext = file_get_contents("lib/Button/starttext.txt");
$starttext = str_replace('NAME',$first,$starttext);
$starttext = str_replace('LAST',$last,$starttext);
$starttext = str_replace('USER',$username,$starttext);
$starttext = str_replace('ID',$userID,$starttext);
}else{$starttext = "سلام خوش آمدید";}
//----------------------------------------/////
if(file_exists("lib/Button/zirtext.txt")){$zirtext = file_get_contents("lib/Button/zirtext.txt");
}else{$zirtext = "متن این بخش باید از پنل مدیریت تنظیم شود.";}
//----------------------------------------/////
if(file_exists("lib/Button/piclink.txt")){$piclink = file_get_contents("lib/Button/piclink.txt");
}else{$piclink = null;}
//----------------------------------------/////
if(file_exists("lib/Button/banchanneltxt.txt")){$banchanneltxt = file_get_contents("lib/Button/banchanneltxt.txt");
}else{$banchanneltxt = "⚠️ این کانال/گروه به دلیل نقض قوانین ربات ، مسدود شده است.";}
//----------------------------------------/////
if(file_exists("lib/Button/coinamount1.txt")){$coinamount1 = file_get_contents("lib/Button/coinamount1.txt");
}else{$coinamount1 = "1";}
if(file_exists("lib/Button/coinamount2.txt")){$coinamount2 = file_get_contents("lib/Button/coinamount2.txt");
}else{$coinamount2 = "2";}
if(file_exists("lib/Button/coinamount3.txt")){$coinamount3 = file_get_contents("lib/Button/coinamount3.txt");
}else{$coinamount3 = "3";}
/////////////////////////---/////
if(file_exists("lib/Button/invitecoin1.txt")){$invitecoin1 = file_get_contents("lib/Button/invitecoin1.txt");
}else{$invitecoin1 = "10";}
if(file_exists("lib/Button/invitecoin2.txt")){$invitecoin2 = file_get_contents("lib/Button/invitecoin2.txt");
}else{$invitecoin2 = "15";}
if(file_exists("lib/Button/invitecoin3.txt")){$invitecoin3 = file_get_contents("lib/Button/invitecoin3.txt");
}else{$invitecoin3 = "20";}
/////////////////////////---/////
if(file_exists("lib/Button/mdailys1.txt")){$mdailys1 = file_get_contents("lib/Button/mdailys1.txt");
}else{$mdailys1 = "3";}
if(file_exists("lib/Button/mdailys2.txt")){$mdailys2 = file_get_contents("lib/Button/mdailys2.txt");
}else{$mdailys2 = "4";}
if(file_exists("lib/Button/mdailys3.txt")){$mdailys3 = file_get_contents("lib/Button/mdailys3.txt");
}else{$mdailys3 = "5";}
///////////////////////////////////////////////\
if(file_exists("lib/Button/coinpanel1.txt")){$coinpanel1 = file_get_contents("lib/Button/coinpanel1.txt");
}else{$coinpanel1 = "50";}
if(file_exists("lib/Button/coinpanel2.txt")){$coinpanel2 = file_get_contents("lib/Button/coinpanel2.txt");
}else{$coinpanel2 = "100";}
///////////------//////////-----------////////
if(file_exists("lib/Button/dokc1.txt")){$dokc1 = file_get_contents("lib/Button/dokc1.txt");
}else{$dokc1 = "👥عضویت👥";}
if(file_exists("lib/Button/dokc3.txt")){$dokc3 = file_get_contents("lib/Button/dokc3.txt");
}else{$dokc3 = "تخلف🚫";}
///////////------//////////-----------////////
if(file_exists("lib/Button/dokc4.txt")){$dokc4 = file_get_contents("lib/Button/dokc4.txt");
}else{$dokc4 = "🔙 ربات";}
///////////------//////////-----------////////
if(file_exists("lib/Button/dokday.txt")){
$dokday = file_get_contents("lib/Button/dokday.txt");
$dokday = str_replace('MONEY',"$money",$dokday);
$dokday = str_replace('IC',"$icmoney",$dokday);
}else{$dokday = "$money روزانه$icmoney";}
if(file_exists("lib/Button/back.txt")){$back = file_get_contents("lib/Button/back.txt");
}else{$back = "🔙 بازگشت";}
//####################################################################
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
$line1_1 = str_replace('DUQ2',$dok12,$line1_1);
}else{
$line1_1 = "";
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
$line1_2 = str_replace('DUQ2',$dok12,$line1_2);
}else{
$line1_2 = "";
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
$line1_3 = str_replace('DUQ2',$dok12,$line1_3);
}else{
$line1_3 = "";
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
$line1_4 = str_replace('DUQ2',$dok12,$line1_4);
}else{
$line1_4 = "";
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
$line2_1 = str_replace('DUQ2',$dok12,$line2_1);
}else{
$line2_1 = "";
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
$line2_2 = str_replace('DUQ2',$dok12,$line2_2);
}else{
$line2_2 = "";
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
$line2_3 = str_replace('DUQ2',$dok12,$line2_3);
}else{
$line2_3 = "";
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
$line2_4 = str_replace('DUQ2',$dok12,$line2_4);
}else{
$line2_4 = "";
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
$line3_1 = str_replace('DUQ2',$dok12,$line3_1);
}else{
$line3_1 = "";
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
$line3_2 = str_replace('DUQ2',$dok12,$line3_2);
}else{
$line3_2 = "";
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
$line3_3 = str_replace('DUQ2',$dok12,$line3_3);
}else{
$line3_3 = "";
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
$line3_4 = str_replace('DUQ2',$dok12,$line3_4);
}else{
$line3_4 = "";
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
$line4_1 = str_replace('DUQ2',$dok12,$line4_1);
}else{
$line4_1 = "";
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
$line4_2 = str_replace('DUQ2',$dok12,$line4_2);
}else{
$line4_2 = "";
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
$line4_3 = str_replace('DUQ2',$dok12,$line4_3);
}else{
$line4_3 = "";
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
$line4_4 = str_replace('DUQ2',$dok12,$line4_4);
}else{
$line4_4 = "";
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
$line5_1 = str_replace('DUQ2',$dok12,$line5_1);
}else{
$line5_1 = "";
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
$line5_2 = str_replace('DUQ2',$dok12,$line5_2);
}else{
$line5_2 = "";
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
$line5_3 = str_replace('DUQ2',$dok12,$line5_3);
}else{
$line5_3 = "";
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
$line5_4 = str_replace('DUQ2',$dok12,$line5_4);
}else{
$line5_4 = "";
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
$line6_1 = str_replace('DUQ2',$dok12,$line6_1);
}else{
$line6_1 = "";
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
$line6_2 = str_replace('DUQ2',$dok12,$line6_2);
}else{
$line6_2 = "";
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
$line6_3 = str_replace('DUQ2',$dok12,$line6_3);
}else{
$line6_3 = "";
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
$line6_4 = str_replace('DUQ2',$dok12,$line6_4);
}else{
$line6_4 = "";
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
$line7_1 = str_replace('DUQ2',$dok12,$line7_1);
}else{
$line7_1 = "";
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
$line7_2 = str_replace('DUQ2',$dok12,$line7_2);
}else{
$line7_2 = "";
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
$line7_3 = str_replace('DUQ2',$dok12,$line7_3);
}else{
$line7_3 = "";
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
$line7_4 = str_replace('DUQ2',$dok12,$line7_4);
}else{
$line7_4 = "";
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
$line8_1 = str_replace('DUQ2',$dok12,$line8_1);
}else{
$line8_1 = "";
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
$line8_2 = str_replace('DUQ2',$dok12,$line8_2);
}else{
$line8_2 = "";
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
$line8_3 = str_replace('DUQ2',$dok12,$line8_3);
}else{
$line8_3 = "";
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
$line8_4 = str_replace('DUQ2',$dok12,$line8_4);
}else{
$line8_4 = "";
}}
//////////------------------------\\\\\\\\\\\\\\






