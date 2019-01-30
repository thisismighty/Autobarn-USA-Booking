dynCalendar_layers=new Array();dynCalendar_mouseoverStatus=false;dynCalendar_mouseX=0;dynCalendar_mouseY=0;function dynCalendar(objName,callbackFunc)
{this.today=new Date();this.date=this.today.getDate();this.month=this.today.getMonth();this.year=this.today.getFullYear();this.objName=objName;this.callbackFunc=callbackFunc;this.imagesPath=arguments[2]?arguments[2]:'images/';this.layerID=arguments[3]?arguments[3]:'dynCalendar_layer_'+dynCalendar_layers.length;this.offsetX=5;this.offsetY=5;this.useMonthCombo=true;this.useYearCombo=true;this.yearComboRange=2;this.currentMonth=this.month;this.currentYear=this.year;this.show=dynCalendar_show;this.writeHTML=dynCalendar_writeHTML;this.setOffset=dynCalendar_setOffset;this.setOffsetX=dynCalendar_setOffsetX;this.setOffsetY=dynCalendar_setOffsetY;this.setImagesPath=dynCalendar_setImagesPath;this.setMonthCombo=dynCalendar_setMonthCombo;this.setYearCombo=dynCalendar_setYearCombo;this.setCurrentMonth=dynCalendar_setCurrentMonth;this.setCurrentYear=dynCalendar_setCurrentYear;this.setYearComboRange=dynCalendar_setYearComboRange;this._getLayer=dynCalendar_getLayer;this._hideLayer=dynCalendar_hideLayer;this._showLayer=dynCalendar_showLayer;this._setLayerPosition=dynCalendar_setLayerPosition;this._setHTML=dynCalendar_setHTML;this._getDaysInMonth=dynCalendar_getDaysInMonth;this._mouseover=dynCalendar_mouseover;dynCalendar_layers[dynCalendar_layers.length]=this;this.writeHTML();}
function dynCalendar_show()
{var month,year,monthnames,numdays,thisMonth,firstOfMonth;var ret,row,i,cssClass,linkHTML,previousMonth,previousYear;var nextMonth,nextYear,prevImgHTML,prevLinkHTML,nextImgHTML,nextLinkHTML;var monthComboOptions,monthCombo,yearComboOptions,yearCombo,html;this.currentMonth=month=arguments[0]!=null?arguments[0]:this.currentMonth;this.currentYear=year=arguments[1]!=null?arguments[1]:this.currentYear;monthnames=new Array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');numdays=this._getDaysInMonth(month,year);thisMonth=new Date(year,month,1);firstOfMonth=thisMonth.getDay();ret=new Array(new Array());for(i=0;i<firstOfMonth;i++){ret[0][ret[0].length]='<td>&nbsp;</td>';}
row=0;i=1;while(i<=numdays){if(ret[row].length==7){ret[++row]=new Array();}
cssClass=(i==this.date&&month==this.month&&year==this.year)?'dynCalendar_today':'dynCalendar_day';linkHTML='<a href="javascript: '+this.callbackFunc+'('+i+', '+(Number(month)+1)+', '+year+'); '+this.objName+'._hideLayer()"  class=dynCalendar_day>'+(i++)+'</a>';ret[row][ret[row].length]='<td align="center" class="'+cssClass+'">'+linkHTML+'</td>';}
for(i=0;i<ret.length;i++){ret[i]=ret[i].join('\n')+'\n';}
previousYear=thisMonth.getFullYear();previousMonth=thisMonth.getMonth()-1;if(previousMonth<0){previousMonth=11;previousYear--;}
nextYear=thisMonth.getFullYear();nextMonth=thisMonth.getMonth()+1;if(nextMonth>11){nextMonth=0;nextYear++;}
prevImgHTML='<img src="'+this.imagesPath+'prev.gif" alt="<<" border="0" />';prevLinkHTML='<a href="javascript: '+this.objName+'.show('+previousMonth+', '+previousYear+')">'+prevImgHTML+'</a>';nextImgHTML='<img src="'+this.imagesPath+'next.gif" alt="<<" border="0" />';nextLinkHTML='<a href="javascript: '+this.objName+'.show('+nextMonth+', '+nextYear+')">'+nextImgHTML+'</a>';if(this.useMonthCombo){monthComboOptions='';for(i=0;i<12;i++){selected=(i==thisMonth.getMonth()?'selected="selected"':'');monthComboOptions+='<option value="'+i+'" '+selected+'>'+monthnames[i]+'</option>';}
monthCombo='<select name="months" onchange="'+this.objName+'.show(this.options[this.selectedIndex].value, '+this.objName+'.currentYear)">'+monthComboOptions+'</select>';}else{monthCombo=monthnames[thisMonth.getMonth()];}
if(this.useYearCombo){yearComboOptions='';for(i=thisMonth.getFullYear()-this.yearComboRange;i<=(thisMonth.getFullYear()+this.yearComboRange);i++){selected=(i==thisMonth.getFullYear()?'selected="selected"':'');yearComboOptions+='<option value="'+i+'" '+selected+'>'+i+'</option>';}
yearCombo='<select style="border: 1px groove" name="years" onchange="'+this.objName+'.show('+this.objName+'.currentMonth, this.options[this.selectedIndex].value)">'+yearComboOptions+'</select>';}else{yearCombo=thisMonth.getFullYear();}
html='<table border="0" bgcolor="#FFFFFF" cellspacing="0" cellpadding=0>';html+='<tr><td class="dynCalendar_header">'+prevLinkHTML+'</td><td colspan="5" align="center" class="dynCalendar_header">'+monthCombo+' '+yearCombo+'</td><td align="right" class="dynCalendar_header">'+nextLinkHTML+'</td></tr>';html+='<tr>';html+='<td class="dynCalendar_dayname">S</td>';html+='<td class="dynCalendar_dayname">M</td>';html+='<td class="dynCalendar_dayname">T</td>';html+='<td class="dynCalendar_dayname">W</td>';html+='<td class="dynCalendar_dayname">T</td>';html+='<td class="dynCalendar_dayname">F</td>';html+='<td class="dynCalendar_dayname">S</td></tr>';html+='<tr><td height=1 colspan=7 bgcolor=#666666></td></tr>';html+='<tr>'+ret.join('</tr>\n<tr>')+'</tr>';html+='</table>';this._setHTML(html);if(!arguments[0]&&!arguments[1]){this._showLayer();this._setLayerPosition();}}
function dynCalendar_writeHTML()
{if(is_ie5up||is_nav6up||is_gecko){document.write('<a href="javascript: '+this.objName+'.show()"><img src="'+this.imagesPath+'dynCalendar.gif" border="0" width="20" height="18" /></a>');document.write('<div class="dynCalendar" id="'+this.layerID+'" onmouseover="'+this.objName+'._mouseover(true)" onmouseout="'+this.objName+'._mouseover(false)"></div>');}}
function dynCalendar_setOffset(Xoffset,Yoffset)
{this.setOffsetX(Xoffset);this.setOffsetY(Yoffset);}
function dynCalendar_setOffsetX(Xoffset)
{this.offsetX=Xoffset;}
function dynCalendar_setOffsetY(Yoffset)
{this.offsetY=Yoffset;}
function dynCalendar_setImagesPath(path)
{this.imagesPath=path;}
function dynCalendar_setMonthCombo(useMonthCombo)
{this.useMonthCombo=useMonthCombo;}
function dynCalendar_setYearCombo(useYearCombo)
{this.useYearCombo=useYearCombo;}
function dynCalendar_setCurrentMonth(month)
{this.currentMonth=month;}
function dynCalendar_setCurrentYear(year)
{this.currentYear=year;}
function dynCalendar_setYearComboRange(range)
{this.yearComboRange=range;}
function dynCalendar_getLayer()
{var layerID=this.layerID;if(document.getElementById(layerID)){return document.getElementById(layerID);}else if(document.all(layerID)){return document.all(layerID);}}
function dynCalendar_hideLayer()
{this._getLayer().style.visibility='hidden';}
function dynCalendar_showLayer()
{this._getLayer().style.visibility='visible';}
function dynCalendar_setLayerPosition()
{this._getLayer().style.top=(dynCalendar_mouseY+this.offsetY)+'px';this._getLayer().style.left=(dynCalendar_mouseX+this.offsetX)+'px';}
function dynCalendar_setHTML(html)
{this._getLayer().innerHTML=html;}
function dynCalendar_getDaysInMonth(month,year)
{monthdays=[31,28,31,30,31,30,31,31,30,31,30,31];if(month!=1){return monthdays[month];}else{return((year%4==0&&year%100!=0)||year%400==0?29:28);}}
function dynCalendar_mouseover(status)
{dynCalendar_mouseoverStatus=status;return true;}
dynCalendar_oldOnmousemove=document.onmousemove?document.onmousemove:new Function;document.onmousemove=function()
{if(is_ie5up||is_nav6up||is_gecko){if(arguments[0]){dynCalendar_mouseX=arguments[0].pageX;dynCalendar_mouseY=arguments[0].pageY;}else{dynCalendar_mouseX=event.clientX+document.body.scrollLeft;dynCalendar_mouseY=event.clientY+document.body.scrollTop;arguments[0]=null;}
dynCalendar_oldOnmousemove();}}
dynCalendar_oldOnclick=document.onclick?document.onclick:new Function;document.onclick=function()
{if(is_ie5up||is_nav6up||is_gecko){if(!dynCalendar_mouseoverStatus){for(i=0;i<dynCalendar_layers.length;++i){dynCalendar_layers[i]._hideLayer();}}
dynCalendar_oldOnclick(arguments[0]?arguments[0]:null);}}