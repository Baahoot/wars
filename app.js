function Login() {
	$('#LoginResults').html('<div id="Loading" align="center">..Loading..</div>');	
	var email = $('#email').val();
	var password = $('#password').val();
	var dataString = 'login.php?email='+email+'&password='+password;
			$.ajax({
                type: "POST",
                url: "login.php?email="+email+'&password='+password,
                data: dataString,
                cache: false,
                success: function (Message) {
					$('#Mask').fadeIn(300);
					$('#LoginResults').fadeIn(300);
					$('#LoginResults').html(Message);
                }
            });
    return false;	
}
function Thanksgiving() {
	$('#BonusContent').html('<div id="Loading" align="center">..Loading..</div>');
	$('#BonusContent').load('holidays/thanksgiving.php');
}
function Christmas() {
	$('.PopUp').html('<div id="Loading" align="center">..Loading..</div>');
	$('.PopUp').load('holidays/christmas.php');
}
function StPatricks() {
	$('.PopUp').html('<div id="Loading" align="center">..Loading..</div>');
	$('.PopUp').load('holidays/stpatricks.php');
}
function Register() {
	$('#RegisterResults').html('<div id="Loading" align="center">..Loading..</div>');
	var reg_email = $('#reg_email').val();
	var reg_password = $('#reg_password').val();
	var reg_conf_pass = $('#reg_conf_pass').val();
	var reg_username = $('#reg_username').val();
	var dataString = 'reg_email='+reg_email+'&reg_password='+reg_password+'&reg_conf_pass='+reg_conf_pass+'&reg_username='+reg_username;
			$.ajax({
                type: "POST",
                url: "new_user.php?"+dataString,
                data: dataString,
                cache: false,
                success: function (Message) {
					$('#RegisterResults').html(Message);
                }
            });
    return false;	
}
function number_format (number, decimals, dec_point, thousands_sep) {
  number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function (n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}
var pow=Math.pow, floor=Math.floor, abs=Math.abs, log=Math.log;
function round(n, precision) {
    var prec = Math.pow(10, precision);
    return Math.round(n*prec)/prec;
}
function format(n) {
    var base = floor(log(abs(n))/log(1000));
    var suffix = 'KMBTQ+'[base-1];
    return suffix ? round(n/pow(1000,base),2)+suffix : ''+n;
}
function PopUp(Action,ID,Amount,type) {
	$('.PopUp').html('<div id="Loading" align="center">..Loading..</div>');
	$('.PopUp').fadeIn(300);
	$('.PopUp').load(Action+'.php?id='+ID+'&amount='+Amount+'&type='+type);
	$('#Mask').fadeIn(300);
}
function PopUp1(Action,ID,Amount,type) {
	$('.PopUp1').html('<div id="Loading" align="center">..Loading..</div>');
	$('.PopUp1').fadeIn(300);
	$('.PopUp1').load(Action+'.php?id='+ID+'&amount='+Amount+'&type='+type);
	$('#Mask1').fadeIn(300);
}
function ClosePop() {
	$('.PopUp').fadeOut(300);
	$('#Mask').fadeOut(300);
}
function ClosePop1() {
	$('.PopUp1').fadeOut(300);
	$('#Mask1').fadeOut(300);
}
function XML() {
	$.ajax({
    	type: "GET",
    	url: "xmlconnect.php",
    	dataType: "json",	
    	success: function(data) {
		for (var i in data) {
        	var data = data[i]; 
			var level = data[4];
			var cash = data[6];
			var income = data[7];
			var upkeep = data[42];
			var total_income = income - upkeep;
			var eincome = data[46];
			var health = data[10];
			var max_health = data[11];
			var energy = data[12];
			var max_energy = data[13];
			var stamina = data[14];
			var max_stamina = data[15];	
			var Exp = data[8];
			var max_exp = data[9];
			var attack = data[16];
			var defense = data[17];
			var skill_points = data[24];
			var health_width = health / max_health * 100;
			var energy_width = energy / max_energy * 100;
			var stamina_width = stamina / max_stamina * 100;
			var exp_width = Exp / max_exp * 100;	
			var sess_id = data['sess'];	
			if(cash < 1000) {
			var user_cash = number_format(cash);
			}
			else {
			var user_cash = format(cash);
			}
	$('#Cash').html('$'+format(user_cash));		
	$('#Income').html('$'+number_format(total_income));
	$('#EIncome').html(number_format(eincome));
	$('#LevelText').html(level);
	$('#HealthText').html(format(health)+'/'+format(max_health));	
	$('#EnergyText').html(format(energy)+'/'+format(max_energy));	
	$('#StaminaText').html(format(stamina)+'/'+format(max_stamina));
	$('#ExpText').html(number_format(exp_width)+'%');	
	$('#EXPTxt').html('EXP Needed: '+number_format(max_exp-Exp));		
	$('#HealthWidth').css('width',''+health_width+'%');	
	$('#EnergyWidth').css('width',''+energy_width+'%');	
	$('#StaminaWidth').css('width',''+stamina_width+'%');
	$('#ExpWidth').css('width',''+exp_width+'%');	
	$('#Update').load('activity.php');
    }
   }
});
}
function PropXML(ID) {
	$.ajax({
    	type: "GET",
    	url: "prop_connect.php?id="+ID,
    	dataType: "json",	
    	success: function(data) {
		for (var i in data) {
        	var data = data[i]; 
			var owned = data[6];
			if(owned>=0) {
				var cost = data[5];
			}
			else {
				var cost = data[4];
			}
	$('#PropOwn'+ID).html(number_format(owned));	
	$('#PropCost'+ID).html(number_format(cost));		
    }
   }
});
}
function Mastery(ID) {
	$.ajax({
    	type: "GET",
    	url: "mastery_connect.php?id="+ID,
    	dataType: "json",	
    	success: function(data) {
		for (var i in data) {
        	var data = data[i]; 
			var mastery = data[3];
			var max_mastery = data[4];
			var mastery_width = mastery / max_mastery * 100;
			var mastery_level = data[5];
			var mastery_text = mastery_width;
	$('#MasteryWidth'+ID).html('<span style="color: #ffffff; margin-left: 4px;">'+number_format(mastery_text)+'%</span>');	
	$('#MasteryWidth'+ID).css('width',''+mastery_width+'%');
	$('#MasteryLevel'+ID).html(mastery_level);		
    }
   }
});
}
function Weapon(ID,type) {
	$.ajax({
    	type: "GET",
    	url: "weapon_connect.php?id="+ID+"&type="+type,
    	dataType: "json",	
    	success: function(data) {
		for (var i in data) {
        	var data = data[i]; 
			var owned = data[6];
	$('#WeaponOwn'+ID).html(number_format(owned));	
    }
   }
});
}
function BossXML(ID) {
	$.ajax({
    	type: "GET",
    	url: "boss_connect.php?id="+ID,
    	dataType: "json",	
    	success: function(data) {
		for (var i in data) {
        	var data = data[i]; 
			var boss_health = data[5];
			var boss_max = data[6];
	$('#BossHealth'+ID).html(number_format(boss_health));	
    }
   }
});
}
function ImageXML() {
	$.ajax({
    	type: "GET",
    	url: "xmlconnect.php",
    	dataType: "json",	
    	success: function(data) {
		for (var i in data) {
        	var data = data[i]; 
			var image = data[5];		
	$('#Image').html('<img src="'+image+'" width="60" height="60" />');			
    }
   }
});
}
function Achievements() {
	$('#Achievements').load('achievements.php');
}
function FindTab(Tab) {
	$('#Content').html('<div id="Loading" align="center">..Loading..</div>');
	$('#Content').load(Tab+'.php');
	$('#RefreshButton').attr('onClick', 'Refresh(\''+Tab+'\');');
}
function Refresh(Tab) {
	$('#Content').html('<div id="Loading" align="center">..Loading..</div>');
	$('#Content').load(Tab+'.php');
	XML();
}
function SubTab(Tab) {
	$('#SubContent').html('<div id="Loading" align="center">..Loading..</div>');
	$('#SubContent').hide().load(Tab+'.php');
	$('#SubContent').fadeIn(300);
}
function ViewUser(ID) {
	$('#Content').html('<div id="Loading" align="center">..Loading..</div>');
	$('#Content').hide().load('my_stats.php?id='+ID);
	$('#Content').fadeIn(300);
	$('#RefreshButton').attr('onClick', 'ViewUser('+ID+');');
    $(window.opera ? 'html' : 'html, body').animate({
        scrollTop: 0
    }, 'fast');	
	XML();
}
function ViewFamily(ID) {
	$('#Content').html('<div id="Loading" align="center">..Loading..</div>');
	$('#Content').hide().load('family.php?id='+ID);
	$('#Content').fadeIn(300);
	$('#RefreshButton').attr('onClick', 'ViewFamily('+ID+');');	
    $(window.opera ? 'html' : 'html, body').animate({
        scrollTop: 0
    }, 'fast');	
	XML();
}
function RemoveFamily(ID) {
	$('#Results').html('<div id="Loading" align="center">..Loading..</div>');
	$('#Results').load('remove_family.php?id='+ID);
}
function Mission(ID) {
	PopUp('do_mission',ID);
	XML();
	Mastery(ID);	
	Achievements();
}
function Comment(ID) {
	var comment = $('#comment').val();
	var dataString = 'id='+ID+'&comment='+comment;
			$.ajax({
                type: "POST",
                url: 'insert_comment.php?id='+ID+'&comment='+comment,
                data: dataString,
                cache: false,
                success: function (Message) {
					$('#comment').val('');
					$('#Comments').html('<div id="Loading">..Loading..</div>');
					$('#CommentResult').html(Message).delay(3000).slideUp(300);
					$('#Comments').load('comments.php?id='+ID);
                }
            });
    return false;	
}
function DeleteComment(ID) {
	$('#Com'+ID).load('delete_comment.php?id='+ID);
	$('#Com'+ID).slideUp(300);
}
function DeleteNot(ID) {
	$('#NotBlock'+ID).load('delete_not.php?id='+ID);
	$('#NotBlock'+ID).slideUp(300);
}
function QuickHeal() {
	PopUp1('hospital');
}
function BossAttack(ID) {
	PopUp('boss_attack',ID);
	XML();
	BossXML(ID);
}
function Attack(ID) {
	PopUp1('attack',ID);
	XML();
	Achievements();
}
function RetalAttack(ID) {
	PopUp1('retal_attack',ID);
	XML();
	Achievements();
}
function Punch(ID) {
	PopUp1('punch',ID);
	XML();
	Achievements();
}
function SetAmount(ID) {
	$('#SetBountyBlock').html('<div id="Loading" align="center">..Loading..</div>');
	$('#SetBountyBlock').load('set_amount.php?id='+ID);
}
function AddToHitlist(ID) {
	var SetBounty = $('#SetBounty').val();
	$('#SetBountyBlock').html('<div id="Loading" align="center">..Loading..</div>');
	$('#SetBountyBlock').load('addtohitlist.php?id='+ID+'&amount='+SetBounty);
	XML();
}
function isNumber(field) { 
        var re = /^[0-9-'.'-',']*$/; 
        if (!re.test(field.value)) { 
            field.value = field.value.replace(/[^0-9-'.'-',']/g,""); 
			field.value = field.value.replace(/,/g, "")
        } 
    }
function AttackHitlist(ID) {
	PopUp('attack_hitlist',ID);
	XML();
	Achievements();
}
function MobInvite(ID) {
	PopUp('mob_invite',ID);
}
function AcceptMob(ID) {
	PopUp('accept_mob',ID);
	Achievements();
}	
function DeclineMob(ID) {
	PopUp('decline_mob',ID);
}	
function RemoveMob(ID) {
	PopUp('remove_mob',ID);
}
function Promote(ID) {
	PopUp('promote',ID);
}
function Demote(ID) {
	PopUp('demote',ID);
}
function TopMobBonus(ID) {
	PopUp('topmob_bonus',ID);
	$('#Bonus'+ID).html('<div class="Success" align="center" id="Bonus'+ID+'">[Bonus Collected]</div>');
	XML();
}
function TopMobE(ID) {
	PopUp('topmob_energy',ID);
	$('#Energy'+ID).html('<div class="Success" align="center" id="Energy'+ID+'">[Energy Sent]</div>');
}
function Heal() {
	$('#HealResults').html('<br /><div id="Loading" align="center">..Loading..</div>');
	$('#HealResults').load('heal.php');
	XML();
}
function Increase(Att) {
	$.ajax({
    	type: "GET",
    	url: "xmlconnect.php",
    	dataType: "json",	
    	success: function(data) {
		for (var i in data) {
        	var data = data[i]; 
			var max_health = data[11];
			var max_energy = data[13];
			var max_stamina = data[15];	
			var attack = data[16];
			var defense = data[17];
			var skill_points = data[24];	
	$('#AttResults').load('increase.php?att='+Att);		
	$('#Skills').html(number_format(skill_points));
	$('#Att_attack').html(number_format(attack));
	$('#Att_defense').html(number_format(defense));
	$('#Att_max_health').html(number_format(max_health));
	$('#Att_max_energy').html(number_format(max_energy));
	$('#Att_max_stamina').html(number_format(max_stamina));	
	XML();
    }
   }
});		
}
function ChangeImage() {
	var image = $('#new_image').val();
	$('#EditImage').html('<div id="Loading" align="center">..Loading..</div>');
	$('#EditImage').load('edit_image.php?image='+image);
	$('#Image').html('<img src="'+image+'" width="60" height="60" />');
	XML();
}
function Bank(Action) {
	var money = $('#money').val();
	$('#BankMessage').html('<div id="Loading" align="center">..Loading..</div>');		
	$('#BankMessage').load('banking.php?action='+Action+'&money='+money);	
	XML();
}
function Broadcast() {
	var broadcast = $('#bc_message').val();
	var dataString = 'broadcast='+broadcast;
	$('#bc_message').val('');
	$('#Broadcasts').html('<div id="Loading">..Loading..</div>');	
			$.ajax({
                type: "POST",
                url: 'i_bc.php?broadcast='+broadcast,
                data: dataString,
                cache: false,
                success: function (Message) {
					$('#Broadcasts').html(Message);
					$('#bc_message').focus();
                }
            });
    return false;	
}
function FBroadcast() {
	var broadcast = $('#bc_message').val();
	var dataString = 'broadcast='+broadcast;
	$('#bc_message').val('');
	$('#Broadcasts').html('<div id="Loading" align="center">..Loading..</div>');	
			$.ajax({
                type: "POST",
                url: 'f_bc.php?broadcast='+broadcast,
                data: dataString,
                cache: false,
                success: function (Message) {
					$('#FamBroadcasts').html(Message);
                }
            });
    return false;	
}
function Reply(Name) {
	var broadcast = $('#bc_message').val();
	$('#bc_message').val(broadcast+Name+': ');
}
function BuyProperty(ID) {
    var property_number = $('#property_number'+ID).val();		
	PopUp('buy_prop',ID,property_number);
	XML();	
	PropXML(ID);			
}
function SellProperty(ID) {
    var property_number = $('#property_number'+ID).val();		
	PopUp('sell_prop',ID,property_number);
	XML();	
	PropXML(ID);			
}
function BuyWeapon(ID,type) {
    var weapon_number = $('#weapon_number'+ID).val();		
	PopUp('buy_weapon',ID,weapon_number,type);		
	XML();	
	Weapon(ID,type);			
}
function SellWeapon(ID,type) {
    var weapon_number = $('#weapon_number'+ID).val();		
	PopUp('sell_weapon',ID,weapon_number,type);		
	XML();	
	Weapon(ID,type);			
}
function BuyLimitedWeapon(ID,type) {
    var weapon_number = $('#weapon_number'+ID).val();		
	PopUp('buy_le_weapon',ID,weapon_number,type);		
	XML();	
	Weapon(ID,type);			
}
function BuySpecialWeapon(ID,type) {
    var weapon_number = $('#weapon_number'+ID).val();		
	PopUp('buy_spec_weapon',ID,weapon_number,type);		
	XML();	
	Weapon(ID,type);			
}
function Refill(Stat) {
	$('.PopUp').fadeIn(300);
	$('.PopUp').html('<div id="Loading">..Loading..</div>');
	$('.PopUp').load('refill.php?stat='+Stat);
	$('#Mask').fadeIn(300);
	XML();
}
function BuyBossOption(ID) {
	PopUp('buy_boss_option',ID);
}
function ChangeName() {
	var new_name = $('#NameChange').val();
	var dataString = 'new_name='+new_name;
	$('.PopUp').html('<div id="Loading" align="center">..Loading..</div>');
		$.ajax({
                type: "POST",
                url: 'change_name.php',
                data: dataString,
                cache: false,
                success: function (Message) {
					$('.PopUp').fadeIn(300);
					$('.PopUp').html(Message);
					$('#Mask').fadeIn(300);
                }
            });
    return false;	
}
function ResetSkills() {
	PopUp('reset_skills');
}
function popitup(url) {
	newwindow=window.open(url,'name','height=200,width=300');
	if (window.focus) {newwindow.focus()}
	return false;
}
function Travel(ID) {
	PopUp('travel',ID);
}
function SlotMachine(Bet) {
	$('#1000').attr("disabled", "disabled");
	$('#2500').attr("disabled", "disabled");
	$('#5000').attr("disabled", "disabled");
	$('#10000').attr("disabled", "disabled");
	$('#25000').attr("disabled", "disabled");
	$('#SlotResults').html('<img src="images/SlotAnimation.gif" /><img src="images/SlotAnimation.gif" /><img src="images/SlotAnimation.gif" />');
	$('#SlotResults').load('slot_results.php?bet='+Bet).delay(5000);
	$('#YouBet').html('You Bet $'+number_format(Bet));	
	XML();
	setTimeout(function() {
        $('#1000').removeAttr("disabled");
        $('#2500').removeAttr("disabled");
        $('#5000').removeAttr("disabled");
        $('#10000').removeAttr("disabled");
        $('#25000').removeAttr("disabled");
    }, 1000);
}
function JoinTrain() {
	$('.PopUp').fadeIn('300');
	$('#Mask').fadeIn('300');
	$('.PopUp').html('<div id="Loading" align="center">..Loading..</div>');
	$('.PopUp').load('join_train.php');
}
// User Tabs
function TrophyTab() {
	$('#TrophyTab').slideDown('slow');
	$('#EquipmentTab').hide();
	$('#EstateTab').hide();
}
function EquipmentTab() {
	$('#TrophyTab').hide();
	$('#EquipmentTab').slideDown('slow');
	$('#EstateTab').hide();
}
function EstateTab() {
	$('#TrophyTab').hide();
	$('#EquipmentTab').hide();
	$('#EstateTab').slideDown('slow');
}
// Family Functions
function CreateFamily() {
	var fam_name = $('#FamName').val();
	var fam_tag = $('#FamTag').val();
	var dataString = 'fam_name='+fam_name+'&fam_tag='+fam_tag;
	$('#FamilyResults').html('<div id="Loading" align="center">..Loading..</div>');
		$.ajax({
                type: "POST",
                url: 'create_family.php',
                data: dataString,
                cache: false,
                success: function (Message) {
					$('#FamilyResults').html(Message);
                }
            });
    return false;	
}
function ShowInvite() {
	var Message = '<div id="FightResults"><span class="FormText">Invite User: </span><input type="text" id="InviteFamily" maxlength="5" /><input type="submit" value="Invite" onClick="InviteFamily()" /></div>';
	$('#Results').html(Message);	
}
function ShowDelete() {
	var Message = '<div id="FightResults"><span class="FormText">Are You Sure You Want To Delete Your Family? <input type="submit" value="Yes" onClick="DeleteFamily()" /> <input type="submit" value="Cancel" onClick="CancelDelete()" /></div>';
	$('.PopUp').fadeIn(300);
	$('#Mask').fadeIn(300);	
	$('.PopUp').html(Message);	
}
function CancelDelete() {
	var Message = '<span class="Success">Success: Family Not Deleted!</span>';
	$('.PopUp').fadeIn(300);
	$('#Mask').fadeIn(300);
	$('.PopUp').html('<div id="FightResults>"'+Message+'</div>');
}
function InviteFamily() {
	var InviteID = $('#InviteFamily').val();
	PopUp('invite_family',InviteID);	
}
function DeleteFamily() {
	PopUp('delete_family')
}
function LeaveFamily() {
	PopUp('leave_family')
}
// Family Invites
function AcceptFam(ID) {
	PopUp('accept_fam',ID);
	Achievements();
}	
function DeclineFam(ID) {
	PopUp('decline_fam',ID);
}
// Active Gun
function ActiveGun(ID,type) {
	$('#Results'+ID).html('<div id="Loading">..Loading..</div>');
	$('#Results'+ID).load('activate_gun.php?id='+ID+'&type='+type);	
	XML();	
}
function Collect(Bonus) {
	PopUp(Bonus);
	XML();	
}
function LoadBC() {
	$('#Broadcasts').load('broadcasts.php');
}
function BCtime() {
setInterval(function(){ 
    LoadBC();  
}, 35000);
}
function DeleteBC(ID) {
	$('#BroadMessage'+ID).html('<div id="Loading">..Loading..</div>');
	$('#BroadMessage'+ID).load('delete_broadcast.php?comment_id='+ID);
}
function CharLeft() {
	var length = $('#bc_message').val().length;
	var left = (250 - length);
	document.getElementById('BcLeft').innerHTML = (left);
}
// Add Images
function AddImage() {
	var image = $('#new_image').val();
	$('#AddImage').html('<div id="Loading" align="center">..Loading..</div>');
	var dataString = 'image='+image;
		$.ajax({
                type: "POST",
                url: 'add_image.php',
                data: dataString,
                cache: false,
                success: function (Message) {
					$('#AddImage').html(Message);
					$('#UserImages').load('image.php');
					XML();
                }
            });
    return false;	
}
function ChangeImage(ID) {
	PopUp('edit_image',ID);
	ImageXML();
}
function RemoveImage(ID) {
	PopUp('remove_image',ID);
	ImageXML();
}
function Operations(ID) {
	PopUp('do_operation',ID);
}
function CodePopUp() {
	PopUp('code_pop');
}
function ApplyCode() {
	var code = $('#AwardCode').val();
	$('.PopUp').html('<div id="Loading" align="center">..Loading..</div>');
	var dataString = 'code='+code;
		$.ajax({
                type: "POST",
                url: 'apply_code.php',
                data: dataString,
                cache: false,
                success: function (Message) {
					$('.PopUp').html(Message);
					$('.PopUp').fadeIn(300);
					$('#Mask').fadeIn(300);
					XML();
                }
            });
    return false;	
}
function WallLink(ID) {
	$('#WallLink').fadeIn(300);
	$('#Mask').fadeIn(300);
	$('#WallLink').html('http://psychowars.net/app/user?id='+ID);
}
function ScreenShot(Image) {
	$('#MaskSS').fadeIn(300);
	$('#PopUpSS').fadeIn(300);
	$('#PopUpSS').html('<img src="images/screenshots/'+Image+'.jpg" />');
}
function SSClose() {
	$('#PopUpSS').fadeOut(300);
	$('#MaskSS').fadeOut(300);
}
function SearchUser() {
	$('#SearchResults').html('<div id="Loading">..Searching..</div>');
	var users_name = $('#users_name').val();
	var dataString = '&users_name='+users_name;
			$.ajax({
                type: "POST",
                url: 'search_user.php',
                data: dataString,
                cache: false,
                success: function (Message) {
					$('#SearchResults').html(Message);
                }
            });
    return false;	
}
function SearchTopMob() {
	$('#OptResults').html('<center><span id="Loading">Searching Mob For Best TopMob..</span></center>');
	$('#OptResults').delay(4000);
	$('#OptResults').load('opt_tm.php');
}
function OptimizeTopMob() {
	$('#OptResults').html('<center><span id="Loading">Optimizing Top Mob..</span></center>');
	$('#OptResults').load('c_tm.php');
}
function CrackVault() {
	var code1 = $('#vault1').val();
	var code2 = $('#vault2').val();
	var code3 = $('#vault3').val();
	var safe_code = code1+''+code2+''+code3;
	$('#SafeResults').html('<center><span id="Loading">Comparing Vault Codes..</span></center>');
	$('#SafeResults').load('crack_safe.php?code='+safe_code);
}
function ViewVCodes() {
	PopUp('vault_codes');
}
function ShowEXP() {
	$.ajax({
    	type: "GET",
    	url: "xmlconnect.php",
    	dataType: "json",	
    	success: function(data) {
		for (var i in data) {
        	var data = data[i]; 
			var level = data[4];
			var Exp = data[8];
			var MaxExp = data[9];
			var TotalExp = MaxExp - Exp;
			var ExpLeft = "<span style='color: #FFFFFF; font-weight: bold;'>"+number_format(TotalExp)+" EXP Until Next Level!</span>";
	$('.PopUp1').fadeIn(300);		
	$('#Mask1').fadeIn(300);		
	$('.PopUp1').html(ExpLeft);		
    }
   }
});
}
