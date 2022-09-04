（function（w）{
	w。Calendar  =  function（opt）{
		//创建日历控件基本结构	
		var cldbox =  document。createElement（“ div ”）;
		cldbox。className  =  ' calendar-container ' ;
		VAR TPL =  “ ” ;
		tpl + =  ' <div class =“calendar-title”> ' ;
		tpl + =  ' <div class =“calendar-prevyear”> <<< / div> ' ;
		tpl + =  ' <div class =“calendar-prevmonth”> << / div> ' ;
		tpl + =  ' <div class =“calendar-year”> </ div> ' ;
		tpl + =  ' <div class =“calendar-month”> </ div> ' ;
		tpl + =  ' <div class =“calendar-nextmonth”>> </ div> ' ;
		tpl + =  ' <div class =“calendar-nextyear”>>> </ div> ' ;
		tpl + =  ' </ div> ' ;
		tpl + =  ' <div class =“calendar-week”> <div>日</ div> <div>一</ div> <div>二</ div> <div> </ DIV> <DIV>五</ DIV> <DIV>六</ DIV> </ DIV> ' ;
		tpl + =  ' <div class =“calendar-content clearfix”> </ div> ' ;
		cldbox。innerHTML = tpl;
		文件。querySelector（选择。EL）。appendChild（cldbox）;
		
		// dom对象
		var omonth =  cldbox。querySelector（“. calendar-month ”）;
		var oyear =  cldbox。querySelector（“. calendar-year ”）;
		var prevyear =  cldbox。querySelector（“. calendar-prevyear ”）;
		var prevmonth =  cldbox。querySelector（“. calendar-prevmonth ”）;
		VAR nextyear =  cldbox。querySelector（“. calendar-nextyear ”）;
		var nextmonth =  cldbox。querySelector（“. calendar-nextmonth ”）;
		var content =  cldbox。querySelector（“. calendar-content ”）;
		
		//时间对象（默认当前）
		var dateObj;
		如果（选择。值）{
			dateObj =  opt。值 ;
		} else {
			dateObj =  new  Date（）;
		}
		//年月获取
		var year =  getYear（dateObj）;
		var month =  getMonth（dateObj）;
		//月年的显示
		omonth。innerHTML  =月+ “月” ;
		oyear。innerHTML  =年+ “年” ;
		//获取本月1号的周值
		var fistWeek =  getCurmonWeeknum（dateObj）;
		//本月总日数
		var monDaynum =  getCurmonDaynum（dateObj）;
		//当前日期
		var nowDay =  getDay（dateObj）;
		//初始化显示本月信息
		setContent（content，fistWeek，monDaynum，nowDay）;
		
		var isSupportMUI =（typeof mui ===  ' function '）;
		var evt = {
			键入： isSupportMUI ？'点击'：'点击'
		}
		//显示当前时间
		内容。的addEventListener（EVT。类型，功能（事件）{
		    如果（事件。目标。的tagName == “ DIV ”  &&  事件。目标。节点类型== “ 1 ”  &&  hasclass（事件。目标。的className，“ canChoose ”））{
				var day =  event。目标。innerHTML ;
				var dateObj =  new  Date（year，month - 1，day）;
				var week =  getWeek（dateObj）;	
				选择。回调（{
					'年'：年，
					'月'：月，
					'天'：天，
					“周”：周
				}）;
			}; 
		}）

		//上一月
		prevmonth。的addEventListener（EVT。类型，函数（）{
			var ddm =  null ;
			var ddy =  null ;
			如果（（选项dateObj。得到月（）- 1）== - 1）{
				ddm =  11 ;
				ddy =  dateObj。getFullYear（）- 1 ;
			} else {
				ddm =  dateObj。getMonth（）- 1 ;
				ddy =  dateObj。getFullYear（）;
			};
			dateObj。setFullYear（ddy）;
		  	dateObj。setMonth（ddm）;
		  	omonth。innerHTML  =  getMonth（dateObj）+ “月” ;
		  	oyear。innerHTML  =  dateObj。getFullYear（）+ “年” ;
		  	clearContent（content）;
		  	fistWeek =  getCurmonWeeknum（dateObj）;
		  	monDaynum =  getCurmonDaynum（dateObj）;
		  	nowDay =  getDay（dateObj）;
		  	setContent（content，fistWeek，monDaynum，nowDay）;
		}）
		
		//下一月
		nextmonth。的addEventListener（EVT。类型，函数（）{
			var ddm =  null ;
			var ddy =  null ;
			如果（（选项dateObj。得到月（）+ 1）== 12）{
				ddm =  0 ;
				ddy =  dateObj。getFullYear（）+ 1 ;
			} else {
				ddm =  dateObj。getMonth（）+ 1 ;
				ddy =  dateObj。getFullYear（）;
			};
			dateObj。setFullYear（ddy）;
			dateObj。setMonth（ddm）;
			omonth。innerHTML  =  getMonth（dateObj）+ “月” ;
			oyear。innerHTML  =  dateObj。getFullYear（）+ “年” ;
			clearContent（content）;
			fistWeek =  getCurmonWeeknum（dateObj）;
			monDaynum =  getCurmonDaynum（dateObj）;
			// nowDay = getDay（dateObj）;
			控制台。日志（nowDay）;
			setContent（content，fistWeek，monDaynum，1）;  
		}）
		
		//上一年
		prevyear。的addEventListener（EVT。类型，函数（）{
			var ddy =  dateObj。getFullYear（）- 1 ;
			dateObj。setFullYear（ddy）;
			oyear。innerHTML  =  dateObj。getFullYear（）+ “年” ;
			clearContent（content）;
			fistWeek =  getCurmonWeeknum（dateObj）;
			monDaynum =  getCurmonDaynum（dateObj）;
			nowDay =  getDay（dateObj）;
			setContent（content，fistWeek，monDaynum，nowDay）;
		}）
		
		//下一年
		nextyear。的addEventListener（EVT。类型，函数（）{
			var ddy =  dateObj。getFullYear（）+ 1 ;
			dateObj。setFullYear（ddy）;
			oyear。innerHTML  =  dateObj。getFullYear（）+ “年” ;
			clearContent（content）;
			fistWeek =  getCurmonWeeknum（dateObj）;
			monDaynum =  getCurmonDaynum（dateObj）;
			nowDay =  getDay（dateObj）;
			setContent（content，fistWeek，monDaynum，nowDay）;  
		}）
	}
	
	//有无指定类名的判断
	函数 hasclass（str，cla）{
	  	var i = str。搜索（cla）;
	  	if（i == - 1）{
	   		返回 假的 ;
	  	} else {
	   		返回 真 ;
	  	};
	}
	
	//初始化日期显示方法
	函数 setContent（el，fistWeek，monDaynum，nowDay）{
		//留空
		for（var i = 1 ; i <= fistWeek; i ++）{
			var subContent =  document。createElement（“ div ”）;
			子内容。innerHTML  =  “ ” ;
			埃尔。appendChild（subContent）;
		}
		//正常区域
		for（var i = 1 ; i <= monDaynum; i ++）{
			var subContent =  document。createElement（“ div ”）;
			子内容。className = “ canChoose ” ;
			if（i == nowDay）{     
				子内容。classList。add（“ today ”）;
			}
			子内容。innerHTML  = i;
			埃尔。appendChild（subContent）;
		}
	}
	
	//清除内容
	function  clearContent（el）{
		埃尔。innerHTML = “ ” ;
	}
	
	//判断闰年
	函数 isLeapYear（year）{
		if（（year ％ 4  ==  0）&&（year ％ 100  ！=  0  || year ％ 400  ==  0））{
			返回 真 ;
		} else {
			返回 假的 ;
		}
	}
	
	//得到当前年份
	function  getYear（dateObj）{
		返回 dateObj。getFullYear（）
	}
	
	//得到当前月份
	function  getMonth（dateObj）{
		var month = dateObj。getMonth（）
		开关（月）{
			情况 0：返回 “ 1 ” ; 打破 ;
		  	情况 1：返回 “ 2 ” ; 打破 ;
		  	情况 2：返回 “ 3 ” ; 打破 ;
		  	情况 3：返回 “ 4 ” ; 打破 ;
		  	情况 4：返回 “ 5 ” ; 打破 ;
		  	情况 5：返回 “ 6 ” ; 打破 ;
		  	情况 6：返回 “ 7 ” ; 打破 ;
		  	情况 7：返回 “ 8 ” ; 打破 ;
		  	情况 8：返回 “ 9 ” ; 打破 ;
		  	情况 9：返回 “ 10 ” ; 打破 ;
		  	情况 10：返回 “ 11 ” ; 打破 ;
		  	案例 11：返回 “ 12 ” ; 打破 ;   
		  	默认值：
		}
	}
	
	//得到当前号数
	function  getDay（dateObj）{
		返回 dateObj。getDate（）;
	}
	
	//得到周期数
	function  getWeek（dateObj）{
		变周
		开关（选项dateObj。getDay（））{
		 	案例 1：week =  “星期一” ; 打破 ;
		 	案例 2：week =  “星期二” ; 打破 ;
		 	案例 3：week =  “星期三” ; 打破 ;
		 	案例 4：week =  “星期四” ; 打破 ;
		 	案例 5：week =  “星期五” ; 打破 ;
		 	例 6：week =  “星期六” ; 打破 ;
		 	默认值：week =  “星期天” ;
		}
		回国周
	}
	
	//获取本月总日数方法
	function  getCurmonDaynum（dateObj）{
		var year = dateObj。getFullYear（）;
		var month = dateObj。getMonth（）;
		如果（isLeapYear（年））{ //闰年
			开关（月）{
				情况 0：返回 “ 31 ” ; 打破 ;
				情况 1：返回 “ 29 ” ; 打破 ; // 2月
				情况 2：返回 “ 31 ” ; 打破 ;
			   	情况 3：返回 “ 30 ” ; 打破 ;
			   	情况 4：返回 “ 31 ” ; 打破 ;
			   	情况 5：返回 “ 30 ” ; 打破 ;
			   	情况 6：返回 “ 31 ” ; 打破 ;
			   	情况 7：返回 “ 31 ” ; 打破 ;
			   	情况 8：返回 “ 30 ” ; 打破 ;
			   	情况 9：返回 “ 31 ” ; 打破 ;
			   	情况 10：返回 “ 30 ” ; 打破 ;
			   	案例 11：返回 “ 31 ” ; 打破 ;   
				默认值：  
			}
		} else { //平年
	   		开关（月）{
	   			情况 0：返回 “ 31 ” ; 打破 ;
	   			情况 1：返回 “ 28 ” ; 打破 ; // 2月
	   			情况 2：返回 “ 31 ” ; 打破 ;
			   	情况 3：返回 “ 30 ” ; 打破 ;
			   	情况 4：返回 “ 31 ” ; 打破 ;
			   	情况 5：返回 “ 30 ” ; 打破 ;
			   	情况 6：返回 “ 31 ” ; 打破 ;
			   	情况 7：返回 “ 31 ” ; 打破 ;
			   	情况 8：返回 “ 30 ” ; 打破 ;
			   	情况 9：返回 “ 31 ” ; 打破 ;
			   	情况 10：返回 “ 30 ” ; 打破 ;
			   	案例 11：返回 “ 31 ” ; 打破 ;   
	   			默认值：  
			}   
		}
	}
	
	//获取本月1号的周值
	function  getCurmonWeeknum（dateObj）{
		var oneyear =  new  Date（）;
		var year =  dateObj。getFullYear（）;
		var month =  dateObj。getMonth（）; // 0是12月
		1年。setFullYear（年）;
		1年。setMonth（月）; // 0是12月
		1年。setDate（1）;
		返回 1年。getDay（）;  
	}
}）（window）;